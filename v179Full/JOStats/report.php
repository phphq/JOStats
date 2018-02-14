<?php
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
// Website       : http://www.gamers-central.com             //
// Support       : http://www.babstats.com                   //
//                                                           //
// File Name     : Report Procedure                          //
// File Version  : 1.0.3 Standalone                          //
//                                                           //
/////////////////////////////////////////////////////////////*/

/*/////////////////////////////////////////////////////////////
//                                                           //
// Updated Dec 2016 By Novahq.net <scott@novahq.net>         //
// Standalone, PHP 5.6+ Compatible                           //
//                                                           //
/////////////////////////////////////////////////////////////*/

error_reporting(0);

$data = empty($_POST['data']) ? exit("Status Update Failed, No Data Sent!") : $_POST['data'];

$data = base64_decode($data);

if(!$data) {

	echo "Status Update Failed, No Data Sent!";

} else {

	require_once "mgtClass.php";
	require_once "config.php";
	require_once "functions.php";
	require_once "common.php";
	require_once "weapons.php";
	require_once "vehicles.php";
	require_once "gametypes.php";

	$_POST['bmt'] = (empty($_POST['bmt']) ? "" : $_POST['bmt']);
	
	MakeTableNames();
	
	$tpl = new mgtTemplate();
	
	$player_data = array(
		0  => "shotsFired"    ,
		1  => "timesHit"      ,
		2  => "murders"       ,
		3  => "kills"         ,
		4  => "suicides"      ,
		5  => "deaths"        ,
		6  => "medHeal"       ,
		7  => "medSave"       ,
		8  => "revived"       ,
		9  => "flagSaves"     ,
		10 => "flagCapt"      ,
		11 => "flagPick"      ,
		12 => "targets"       ,
		13 => "pspTakeovers"  ,
		14 => "headshots"     ,
		15 => "knifings"      ,
		16 => "flagCarr"      ,
		17 => "score_1"       ,
		18 => "score_2"       ,
		19 => "zoneAtt"       ,
		20 => "zoneDef"       ,
		21 => "assists"       ,
		22 => "exp"           ,
		23 => "tkothTime"     ,
		24 => "neutralTime"   ,
		25 => "homeTime"      ,
		26 => "zoneHits"      ,
		27 => "campTakeovers" , 
		28 => "totalTime"     , 
		29 => "medAttempts"   , 
		30 => "sniperkills"   , 
		31 => "multiKills"
	);

	$dataLines = array();
	$lines = array();
	$awardList = "";
	
	$dataLines = explode("\n", $data);
	$lineNum = count($dataLines);
	
	$i = 0;
	
	foreach($dataLines as $line) {
		$lines[$i] = trim($line);
		$i++;
	}

	$gameType = $lines[0];
	
	for($i = 1; $i < sizeof($lines); $i++) {
		if(!empty($lines[$i])) {
			if(strstr($lines[$i], "plyrData")) {
				$score             = 0;
				$scorePlus         = 0;
				$scoreMinus        = 0;
				$player_new = array();
				$player_old = array();
				
				$found = false;
				$playerDet = explode("__&__", substr($lines[$i], 9));
				GetJoVal($_POST["bmt"]);
				$player_new["name"] = $playerDet[0];
				$player_old["name"] = $playerDet[0];
				
				$sql = $tpl->joQuery("SELECT * FROM $players_table WHERE name = '".$tpl->joEscape($player_old["name"])."'", 1);
				if(@mysqli_num_rows($sql) > 0) {
					$found = true;
					$row = mysqli_fetch_assoc($sql);
					$player_old["id"]     = $row["id"];
					$player_old["rating"] = $row["rating"];
					$ssql = $tpl->joQuery("SELECT * FROM $stats_table WHERE player = '".$row["id"]."'", 1);
					while($srow = mysqli_fetch_assoc($ssql)) {
						foreach($player_data as $index => $stat) {
							@$player_old[$stat] += $srow[$stat];
						}
					}
					//mysql_free_result($sql);
					//mysql_free_result($ssql);
				}
			}

			if(strstr($lines[$i], "PlayerStats")) {
				if($found) {
					$scoresArray = array();			
					$sql = $tpl->joQuery("SELECT * FROM $rating_table WHERE s_type = 'gameBonus'", 1);
					while($row = mysqli_fetch_assoc($sql)) {
						$scoresArray[$row["s_stat"]] = $row["s_pts"];
					}
					//mysql_free_result($sql);
					
					$statArray = explode("_", substr($lines[$i], 12));
					$k = 0;
					foreach($player_data as $index => $stat) {
						$player_new[$stat] = $statArray[$k];
						if($stat == "timesHit" || $stat == "murders" || $stat == "suicides" || $stat == "deaths") {
							@$scoreMinus += $player_new[$stat] * $scoresArray[$stat] ;
						} else {
							@$scorePlus += $player_new[$stat] * $scoresArray[$stat] ;
						}
						$k++;
					}
					
					$score = $scorePlus - $scoreMinus;
					if($score < 0) $score = 0;
					
					$player_new["rating"] = $player_old["rating"] + $score;
					
					$rsql = $tpl->joQuery("SELECT * FROM $ranks_table WHERE rating <= '".$player_new["rating"]."' 
					                                ORDER BY rating DESC LIMIT 0, 1 ", 1);
													
					if(@mysqli_num_rows($rsql) > 0) {
						$rrow = mysqli_fetch_assoc($rsql);
						
						$player_new["rank"] = $rrow["name"];
						mysql_free_result($rsql);
						$ssql = $tpl->joQuery("SELECT * FROM $playerawards_table WHERE player = '".$player_old["id"]."' 
															AND award = '".$player_new["rank"]."'", 1);
						if(!@mysqli_num_rows($ssql)) {
							$tpl->joQuery("INSERT INTO $playerawards_table (`player`, `award`, `date`) VALUES 
												   ('".$player_old["id"]."', '".$player_new["rank"]."', 
												   '".date("Y-m-d H:i:s")."')", 2);
							if($awardList == "") {
								$awardList = htmlspecialchars($player_new["name"])." has been Promoted to ".htmlspecialchars($player_new["rank"]);
							} else {
								$awardList .= "__&__".htmlspecialchars($player_new["name"])." has been Promoted to ".htmlspecialchars($player_new["rank"]);
							}
						}
					}
					
					/*********************************************************************************************/
					$sql = $tpl->joQuery("SELECT * FROM $awards_table WHERE type = '1'", 1);
					while($row = mysqli_fetch_assoc($sql)) {
						$pVal = $player_old[$row["stat"]] + $player_new[$row["stat"]];
						if($pVal >= $row["value"]) {
							$ssql = $tpl->joQuery("SELECT * FROM $playerawards_table WHERE player = '".$player_old["id"]."' 
														AND award = '".$tpl->joEscape($row["name"])."'", 1);
							if(!@mysqli_num_rows($ssql)) {
								$tpl->joQuery("INSERT INTO $playerawards_table (`player`, `award`, `date`) VALUES 
											   ('".$player_old["id"]."', '".$tpl->joEscape($row["name"])."', '".date("Y-m-d H:i:s")."')", 2);
								$tpl->joQuery("UPDATE $awards_table SET gained = gained + 1 
											   WHERE id = '".$row["id"]."'", 2);
								if($awardList == "") {
									$awardList = htmlspecialchars($player_new["name"])." has obtained ".htmlspecialchars($row["name"]);
								} else {
									$awardList .= "__&__".htmlspecialchars($player_new["name"])." has obtained ".htmlspecialchars($row["name"]);
								}
								//mysql_free_result($ssql);
							} 
						}
					}
					//mysql_free_result($sql);
					/*********************************************************************************************/
				}
			}
		}
	}
	
	echo $awardList;
}