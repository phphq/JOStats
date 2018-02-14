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
// File Name     : Player Vehicle Details Module             //
// File Version  : 1.0.3 Standalone                          //
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
	$vid=(!empty($_GET['vid']) ? intval($_GET['vid']) : 0);
	$condStats=(!empty($_GET['condStats']) ? intval($_GET['condStats']) : 1);
	$condTeam=(!empty($_GET['condTeam']) ? intval($_GET['condTeam']) : 0);
	$condGame=(!empty($_GET['condGame']) ? cMioD4($_GET['condGame']) : '0');
	$condServer=(!empty($_GET['condServer']) ? $_GET['condServer'] : 0);

	$varArray["formAction"] = "./?";
	$varArray["section"] = "player_vehicleDetails";
	$varArray["vid"] = $vid;
	$varArray["pid"] = $pid;

	$gameStats = SetGameStats($pid, $vid, "vehicle");
	
	$varArray["condStats"]  = $condStats;
	$varArray["condTeam"]   = $condTeam;
	$varArray["condServer"] = $condServer;
	$varArray["condGame"]   = $condGame;
	
    $cond = $tpl->getjoConditionsS($condServer, $condStats, $condTeam, $condGame, $vid, "vehicle");
	
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
		case 2: 
			$type  = "statsm"       ;
			$type2 = "vehiclestatsm" ; 
		break;
		default: 
			$type  = "stats"       ;
			$type2 = "vehiclestats" ;
	}
	
	$sql = $tpl->joQuery("SELECT ".$joSelect["vehicle"]." , ".$joSelect[$type2].", ".$joSelect[$type].     
						 " FROM $vehicles_table, ".$cond["tableV"].", ".$cond["table"]." 
						   WHERE $vehicles_table.id = ".$cond["tableV"].".vehicle  
						   AND ".$cond["tableV"].".record = ".$cond["table"].".id 
						   AND ".$cond["tableV"].".vehicle = '".$vid."' 
						   AND ".$cond["table"].".player = '".$pid."' 
						    ".$conditions." 
						   GROUP BY ".$cond["tableV"].".vehicle", 1);
	if(mysqli_num_rows($sql) > 0) {
		$row = mysqli_fetch_array($sql);
	
		$row["v_totalTime"] = $tpl->joFormatTime($row["v_totalTime"]);
		$row["v_ratio"] = $tpl->JoColorRatio($row["v_ratio"]);
		$row["v_rank"] = GetJoWpnRanks($wid, $pid);
		
		foreach($veh_common as $vehn => $vehi) {
			if(strstr(strtolower($row["v_name"]), $vehn)) {
				$row["v_image"] = $vehi;
				break;
			}
		}
		
		if($row["v_kills"] == 0) {$row["killsM"] = 1;} else {$row["killsM"] = $row["v_kills"];}
		if($row["v_deaths"] == 0) {$row["deathsM"] = 1;} else {$row["deathsM"] = $row["v_deaths"];}
		
		$row["v_deathsLen"] = 0;
		$row["v_killsLen"] = 0;


		if($row["v_deaths"] > $row["v_kills"]) {
			$row["v_deathsLen"] = $row["v_deaths"] * (160/$row["deathsM"]);
			$row["v_killsLen"]  = $row["v_kills"]  * (160/$row["deathsM"]);
		}
		
		if($row["v_kills"] > $row["v_deaths"]) {
			$row["v_deathsLen"] = $row["v_deaths"] * (160/$row["killsM"]);
			$row["v_killsLen"]  = $row["v_kills"]  * (160/$row["killsM"]);
		}
		
		$row["v_headshotsLen"]   = $row["v_killsLen"] > 0 ? $row["v_headshots"]   * ($row["v_killsLen"]/$row["killsM"]) : 0;
		$row["v_multiKillsLen"]  = $row["v_killsLen"] > 0 ? $row["v_multiKills"]  * ($row["v_killsLen"]/$row["killsM"]) : 0;
		$row["v_suicidesLen"]    = $row["v_deathsLen"] > 0 ? $row["v_suicides"]    * ($row["v_deathsLen"]/$row["deathsM"]) : 0;
		
		foreach($row as $tag => $value) {
			$varArray[$tag] = $value;
		}
	} else {
		$varArray["name"] = $gameStats[0]["name"];
		$varArray["v_name"] = $gameStats[2]["name"];
		$varArray["v_image"] = "none.gif";
		
		foreach($gameStats[1] as $tag) {
			$varArray[$tag] = 0;
			$varArray[$tag."G"] = 0;
		}
	}
	
	
	$sqlArray[0]["query"]      = "SELECT attach , ".$joSelect[$type].", ".$joSelect[$type2];
	$sqlArray[0]["tables"]     = " ".$cond["tableV"].", ".$cond["table"]." ";
	$sqlArray[0]["conditions"] = " WHERE ".$cond["tableV"].".vehicle = '".$vid."' 
								   AND ".$cond["tableV"].".record = ".$cond["table"].".id 
								  ".$conditions."  
								   GROUP BY ".$cond["tableV"].".attach  
								   ORDER BY attach DESC";
	$sqlArray[0]["type"]       = "multi";
	$sqlArray[0]["prefix"]     = "list";
	
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
	
	$varArray["content"] = $tpl->buildMgtTpl($varArray, $sqlArray, 1, $file, "vehicleDetails");

}