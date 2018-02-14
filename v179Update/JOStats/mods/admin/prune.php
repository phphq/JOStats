<?php if(!defined('IN_JOSTATS')) exit("You may not access this file directly.");
/*/////////////////////////////////////////////////////////////
//                                                           //
// JOStats is a product of Bab.stats                         //
//                                                           //
// Copyright (c) 2006 - 2007, Peter Jones (AKA Azrael)       //
// All rights reserved.                                      //
//                                                           //
// Redistribution and use with or without modification, are  //
// permitted provided that the following conditions are met: //
//                                                           //
// Redistributions must retain the above copyright notice.   //
// File licence.txt must not be removed from the package.    //
//                                                           //
// Author        : Peter Jones (AKA Azrael)                  //
// E-mail        : Email: p.jones188@btinternet.com          //
// Website       : http://www.messiahgamingtools.com         //
// Support       : http://www.babstats.com                   //
//                                                           //
// File Name     : Awards Module                             //
// File Version  : 1.0.3 Standalone                          //
//                                                           //
/////////////////////////////////////////////////////////////*/

/*/////////////////////////////////////////////////////////////
//                                                           //
// Updated Dec 2016 By Novahq.net <scott@novahq.net>         //
// Standalone, PHP 5.6+ Compatible                           //
//                                                           //
/////////////////////////////////////////////////////////////*/

$file = "./tpls/admin/admin_prune.tpl";

if(!$tpl->getMgtTpl($file)) {

	$varArray["content"] = $tpl->joErrorRet(1, $section." template");

} else {
	
	$varArray["error"] = "";
	$varArray["msg"]   = "";
	
	$sub = (!empty($sub) ? $sub : "begin");
	$killsNum = (!empty($_POST['killsNum']) ? intval($_POST['killsNum']) : 0);
	$timeNum = (!empty($_POST['timeNum']) ? intval($_POST['timeNum']) : 0);
	$daysNum = (!empty($_POST['daysNum']) ? intval($_POST['daysNum']) : 0);
	$squadChk = (!empty($_POST['squadChk']) ? 1 : 0);

	if(!empty($_POST["proceed"])) {
		
		if(!$killsNum && !$timeNum && !$daysNum) {
			$varArray["msg"]   = "You must use atleast one of the prune options to proceed!";
			$sub = "begin";
		} else {
			$conditions = "";
			$conditions2 = "";
			$plyrNum = 0;
			
			$varArray["pruneOptions"] = "";

			if($killsNum > 0) {
				$varArray["pruneOptions"] .= " - Prune players with less than $killsNum Kills.<br />";
				$conditions .= " AND kills < $killsNum ";
			}
			
			if($timeNum > 0) {
				$frmttdTime = (60*$timeNum)*60;
				$varArray["pruneOptions"] .= " - Prune players with less than $timeNum Hours of play time.<br />";
				$conditions .= " AND totalTime < $frmttdTime ";
	
			}
			
			if($daysNum > 0) {
				$varArray["pruneOptions"] .= " - Prune players who haven't played for $daysNum days or more.<br />";
				$fmtDate = date("Y-m-d H:i:s", mktime(date("s"), date("i"), date("H"), date("m"), date("d")-$daysNum, date("Y")));
				$conditions .= " AND last_played < ( CURDATE( ) - INTERVAL $daysNum DAY ) ";
			}
		
			if($squadChk==1) {
				$varArray["pruneOptions"] .= " - Don't Prune players if there assigned to a squad.<br />";
				$conditions .= " AND $players_table.squad = -1 ";
			}
			
			$pruneQuery = "SELECT $players_table.name AS name, $players_table.squad, SUM($stats_table.kills) AS kills, 
			               SUM($stats_table.totalTime) AS totalTime, MAX($stats_table.last_played) AS last_played 
						   FROM $players_table, $stats_table 
			               WHERE $stats_table.player = $players_table.id 
						   ".$conditions." GROUP BY $stats_table.player";

			$sql = $tpl->joQuery($pruneQuery, 1);
			
			$plyrNum = $plyrNum + mysqli_num_rows($sql);
			$varArray["pruneOptions"] .= "<br />With the current options, $plyrNum player(s) will be deleted!.<br /><br />";
			if(@mysqli_num_rows($sql) > 0) {
				$varArray["pruneOptions"] .= '<div align="center"><select name="pruneList" size="10">';
				
				while($row = mysqli_fetch_assoc($sql)) {
					$varArray["pruneOptions"] .= '<option value="'.$row["name"].'">'.$row["name"].'</option>';
				}
				

			}

			$varArray["pruneOptions"] .= '</select></div>';
			$varArray["killsNum"] = $killsNum;
			$varArray["timeNum"] = $timeNum;
			$varArray["daysNum"] = $daysNum;
			$varArray["squadChk"] = $squadChk;
			
			$sub = "proceed";
		}
	} elseif(!empty($_POST["prune"])) {

		$killsNum = (!empty($_POST['killsNum']) ? intval($_POST['killsNum']) : 0);
		$timeNum = (!empty($_POST['timeNum']) ? intval($_POST['timeNum']) : 0);
		$daysNum = (!empty($_POST['daysNum']) ? intval($_POST['daysNum']) : 0);
		$squadChk = (!empty($_POST['squadChk']) ? intval($_POST['squadChk']) : 0);


		$conditions = "";

		if($killsNum > 0) {
			$conditions .= " AND kills < $killsNum ";
		}
		
		if($timeNum > 0) {
			$frmttdTime = (60*$timeNum)*60;
			$conditions .= " AND totalTime < $frmttdTime ";

		}
		
		if($daysNum > 0) {
			$fmtDate = date("Y-m-d H:i:s", mktime(date("s"), date("i"), date("H"), date("m"), date("d")-$daysNum, date("Y")));
			$conditions .= " AND last_played < ( CURDATE( ) - INTERVAL $daysNum DAY ) ";
		}
	
		if($squadChk==1) {
			$conditions .= " AND $players_table.squad = -1 ";
		}

		$pruneQuery = "SELECT $players_table.name AS name, $players_table.squad, SUM($stats_table.kills) AS kills, 
		               SUM($stats_table.totalTime) AS totalTime, MAX($stats_table.last_played) AS last_played 
					   FROM $players_table, $stats_table 
		               WHERE $stats_table.player = $players_table.id 
					   ".$conditions." GROUP BY $stats_table.player";

		$sql = $tpl->joQuery($pruneQuery, 1);

		$pyNum = mysqli_num_rows($sql);
		if($pyNum > 0) {
			while($row = mysqli_fetch_assoc($sql)) {
				$plyrSql = $tpl->joQuery("SELECT * FROM $players_table WHERE name = '".$tpl->joEscape($row["name"])."'", 1);
				$plyrRow = mysqli_fetch_assoc($plyrSql);
				
				$mstatSql = $tpl->joQuery("SELECT * FROM $stats_m_table WHERE player = '".$plyrRow["id"]."'", 1);
				if(@mysqli_num_rows($mstatSql) > 0) {
					while($mstatRow = mysqli_fetch_assoc($mstatSql)) {
						$tpl->joQuery("DELETE FROM $mapstats_m_table WHERE record = '".$mstatRow["id"]."'", 2);
						$tpl->joQuery("DELETE FROM $weaponstats_m_table WHERE record = '".$mstatRow["id"]."'", 2);
						$tpl->joQuery("DELETE FROM $vehiclestats_m_table WHERE record = '".$mstatRow["id"]."'", 2);
					}
				}
				
				$statSql = $tpl->joQuery("SELECT * FROM $stats_table WHERE player = '".$plyrRow["id"]."'", 1);
				if(@mysqli_num_rows($statSql) > 0) {
					while($statRow = mysqli_fetch_assoc($statSql)) {
						$tpl->joQuery("DELETE FROM $mapstats_table WHERE record = '".$statRow["id"]."'", 2);
						$tpl->joQuery("DELETE FROM $weaponstats_table WHERE record = '".$statRow["id"]."'", 2);
						$tpl->joQuery("DELETE FROM $vehiclestats_table WHERE record = '".$statRow["id"]."'", 2);
					}
				}
				$tpl->joQuery("DELETE FROM $last_table WHERE player = '".$plyrRow["id"]."'", 2);
				$tpl->joQuery("DELETE FROM $stats_m_table WHERE player = '".$plyrRow["id"]."'", 2);
				$tpl->joQuery("DELETE FROM $stats_table WHERE player = '".$plyrRow["id"]."'", 2);
				$tpl->joQuery("DELETE FROM $playerawards_table WHERE player = '".$plyrRow["id"]."'", 2);
				$tpl->joQuery("DELETE FROM $records_table WHERE player = '".$plyrRow["id"]."'", 2);
				$tpl->joQuery("DELETE FROM $players_table WHERE id = '".$plyrRow["id"]."'", 2);
			}
			
			$sub = "begin";
			$varArray["msg"]   = $pyNum." Player(s) deleted!";

		} else {

			$sub = "begin";
			$varArray["msg"]   = "No Players to delete!";

		}
		
		
	}
	
	$varArray["formAction"] = "./admin.php?section=prune";
	
	$varArray["content"] = $tpl->buildMgtTpl($varArray, $sqlArray, 0, $file, $sub);
}