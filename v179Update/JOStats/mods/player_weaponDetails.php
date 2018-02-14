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
// File Name     : Player Weapon Details Module              //
// File Version  : 1.0.1 Standalone                          //
//                                                           //
/////////////////////////////////////////////////////////////*/

/*/////////////////////////////////////////////////////////////
//                                                           //
// Updated Dec 2016 By Novahq.net <scott@novahq.net>         //
// Standalone, PHP 5.6+ Compatible                           //
//                                                           //
/////////////////////////////////////////////////////////////*/

$file = "./tpls/player_stats.tpl";

if(!$tpl->getMgtTpl($file)) {

	$varArray["content"] = $tpl->joErrorRet(1, $section." template");	

} else {
	
	$pid=(!empty($_GET['pid']) ? intval($_GET['pid']) : 0);
	$wid=(!empty($_GET['wid']) ? intval($_GET['wid']) : 0);
	$condStats=(!empty($_GET['condStats']) ? intval($_GET['condStats']) : 1);
	$condTeam=(!empty($_GET['condTeam']) ? intval($_GET['condTeam']) : 0);
	$condGame=(!empty($_GET['condGame']) ? cMioD4($_GET['condGame']) : '0');
	$condServer=(!empty($_GET['condServer']) ? $_GET['condServer'] : 0);

	$varArray["formAction"] = "./?";
	$varArray["section"] = "player_weaponDetails";
	$varArray["wid"] = $wid;
	$varArray["pid"] = $pid;

	$gameStats = SetGameStats($pid, $wid, "weapon");
	
	$varArray["condStats"]  = $condStats;
	$varArray["condTeam"]   = $condTeam;
	$varArray["condServer"] = $condServer;
	$varArray["condGame"]   = $condGame;
	
    $cond = $tpl->getjoConditionsS($condServer, $condStats, $condTeam, $condGame, $wid, "weapon");
	
	$varArray["selcStatsType"] = $cond["selcStatsType"];
	$varArray["statsType"]     = $cond["statsType"];
	$varArray["serverList"]    = $cond["serverList"];
	$varArray["teamList"]      = $cond["teamList"];
	$varArray["gtypeList"]     = $cond["gameList"];
	
	$conditions = "";
	if(!empty($cond["server"])) {
		$conditions .= $cond["server"];
	}

	if(!empty($cond["team"])) {
		$conditions .= $cond["team"];
	}

	if(!empty($cond["gametype"])) {
		$conditions .= $cond["gametype"];
	}
	
	$sql = $tpl->joQuery("SELECT * FROM $players_table WHERE id = '".$pid."'", 1);
	$row = mysqli_fetch_array($sql);

	if(empty($row)) {
		exit("Player not found!");
	}

	foreach($row as $tag => $value) {
		$varArray[$tag] = $value;
	}
	
	switch($condStats) {
		case 1: 
			$type  = "stats"       ;
			$type2 = "weaponstats" ;
		break;
		case 2: 
			$type  = "statsm"       ;
			$type2 = "weaponstatsm" ; 
		break;
	}
	
	$sql = $tpl->joQuery("SELECT ".$joSelect["weapon"]." , ".$joSelect[$type2].", ".$joSelect[$type].     
						 " FROM $weapons_table, ".$cond["tableW"].", ".$cond["table"]." 
						   WHERE $weapons_table.id = ".$cond["tableW"].".weapon  
						   AND ".$cond["tableW"].".record = ".$cond["table"].".id 
						   AND ".$cond["tableW"].".weapon = '".$wid."' 
						   AND ".$cond["table"].".player = '".$pid."' 
						    ".$conditions." 
						   GROUP BY ".$cond["tableW"].".weapon", 1);
	if(mysqli_num_rows($sql) > 0) {
		$row = mysqli_fetch_array($sql);
	
		$row["w_totalTime"] = $tpl->joFormatTime($row["w_totalTime"]);
		$row["w_ratio"] = $tpl->JoColorRatio($row["w_ratio"]);
		$row["w_rank"] = GetJoWpnRanks($wid, $pid);
		$row["w_image"] = $wpn_img[$row["w_name"]];
		
		
		if($row["w_kills"] == 0) {$row["killsM"] = 1;} else {$row["killsM"] = $row["w_kills"];}
		if($row["w_deaths"] == 0) {$row["deathsM"] = 1;} else {$row["deathsM"] = $row["w_deaths"];}
		

		$row["w_deathsLen"] = 0;
		$row["w_killsLen"] = 0;

		if($row["w_deaths"] > $row["w_kills"]) {
			$row["w_deathsLen"] = $row["w_deaths"] * (160/$row["deathsM"]);
			$row["w_killsLen"]  = $row["w_kills"]  * (160/$row["deathsM"]);
		}
		
		if($row["w_kills"] > $row["w_deaths"]) {
			$row["w_deathsLen"] = $row["w_deaths"] * (160/$row["killsM"]);
			$row["w_killsLen"]  = $row["w_kills"]  * (160/$row["killsM"]);
		}
		

 			
		$row["w_headshotsLen"]   = $row["w_killsLen"] > 0 ? $row["w_headshots"]   * ($row["w_killsLen"]/$row["killsM"]) : 0;
		$row["w_multiKillsLen"]  = $row["w_killsLen"] > 0 ? $row["w_multiKills"]  * ($row["w_killsLen"]/$row["killsM"]) : 0;
		$row["w_suicidesLen"]    = $row["w_deathsLen"] > 0 ? $row["w_suicides"]    * ($row["w_deathsLen"]/$row["deathsM"]) : 0;
		
		foreach($row as $tag => $value) {
			$varArray[$tag] = $value;
		}
	} else {

		$varArray["name"] = $gameStats[0]["name"];
		$varArray["w_name"] = $gameStats[2]["name"];
		$varArray["w_image"] = "none.gif";
		
		foreach($gameStats[1] as $tag) {
			$varArray[$tag] = 0;
			$varArray[$tag."G"] = 0;
		}

	}
	
	$varArray["joTips"] = "";
	if($joTips) {
		$varArray["joTips"] = '<table id="js_menu">
						         <tr>
							       <td id="js_aboutText"><u>Tips</u></td>
						         </tr>
						         <tr>
							       <td align="left" id="js_aboutText">1. Hover over a colored bar to see more info.</td>
						  	     </tr>
						       </table><br /><br />';
	}
	
	$varArray["content"] = $tpl->buildMgtTpl($varArray, $sqlArray, 0, $file, "weaponDetails");

}