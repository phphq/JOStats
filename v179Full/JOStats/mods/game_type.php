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

$file = "./tpls/game_type.tpl";

if(!$tpl->getMgtTpl($file)) {

	$varArray["content"] = $tpl->joErrorRet(1, $section." template");

} else {

	$condStats=(!empty($_GET['condStats']) ? intval($_GET['condStats']) : 1);
	$condTeam=(!empty($_GET['condTeam']) ? intval($_GET['condTeam']) : 0);
	$condGame=(!empty($_GET['condGame']) ? cMioD4($_GET['condGame']) : '0');
	$condServer=(!empty($_GET['condServer']) ? $_GET['condServer'] : 0);

	$varArray["formAction"] = "./?";
	$varArray["section"] = "game_type";

	$varArray["condStats"]  = $condStats;
	$varArray["condTeam"]   = $condTeam;
	$varArray["condServer"] = $condServer;
	$varArray["condGame"]   = $condGame;  

    $cond = $tpl->getjoConditionsM($condServer, $condStats, $condTeam, $condGame);

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

	$headArray = array();
	$statArray = array();
	$varArray["width"] = 500;
	$varArray["colCount"] = 10;
	switch($condGame) {
		case '0':
			//$headArray = array("Team", "Kills", "Deaths", "Ratio", "Headshots", "Knifingss", "Multi-Kills", "Time");
			//$statArray = array("team_name", "kills", "deaths", "ratio", "headshots", "knifings", "multiKills", "totalTime");
			$headArray = array("Kills", "Deaths", "Ratio", "Headshots", "Knifingss", "Multi-Kills", "Time");
			$statArray = array("kills", "deaths", "ratio", "headshots", "knifings", "multiKills", "totalTime");
			$varArray["width"]    = '500'; $width = '80';
			$varArray["colCount"] = '10';
		break;
		case '1':
			$headArray = array("Team", "Kills", "Deaths", "Ratio", "Headshots", "Knifingss", "Multi-Kills", "Time");
			$statArray = array("team_name", "kills", "deaths", "ratio", "headshots", "knifings", "multiKills", "totalTime");
			$varArray["width"]    = '500'; $width = '80';
			$varArray["colCount"] = '10';
		break;
		case "Team Deathmatch":
			$headArray = array("Team", "Kills", "Deaths", "PSP's", "Time");
			$statArray = array("team_name", "kills", "deaths", "pspTakeovers", "totalTime");
			$varArray["width"]    = '500'; $width = '80';
			$varArray["colCount"] = '7';
		break;
		case "Cooperative":
			$headArray = array("Team", "Kills", "Deaths", "PSP's", "Targets", "Time");
			$statArray = array("team_name", "kills", "deaths", "pspTakeovers", "targets", "totalTime");
			$varArray["width"]    = '600'; $width = '80';
			$varArray["colCount"] = '8';
		break;
		case "Team King of the Hill":
			$headArray = array("Team", "Kills", "Deaths", "ZoneAtt Kills", "ZoneDef Kills", "Time");
			$statArray = array("team_name", "kills", "deaths", "zoneAtt", "zoneDef", "totalTime");
			$varArray["width"]    = '600'; $width = '80';
			$varArray["colCount"] = '8';
		break;
		case "King of the Hill":
			$headArray = array("Team", "Kills", "Deaths", "ZoneAtt Kills", "ZoneDef Kills", "Time");
			$statArray = array("team_name", "kills", "deaths", "zoneAtt", "zoneDef", "totalTime");
			$varArray["width"]    = '600'; $width = '80';
			$varArray["colCount"] = '8';
		break;
		case "Search and Destroy":
			$headArray = array("Team", "Kills", "Deaths", "Targets", "ZoneAtt Kills", "ZoneDef Kills", "Time");
			$statArray = array("team_name", "kills", "deaths", "targets", "zoneAtt", "zoneDef", "totalTime");
			$varArray["width"]    = '600'; $width = '80';
			$varArray["colCount"] = '9';
		break;
		case "Attack and Defend":
			$headArray = array("Team", "Kills", "Deaths", "Targets", "ZoneAtt Kills", "ZoneDef Kills", "Time");
			$statArray = array("team_name", "kills", "deaths", "targets", "zoneAtt", "zoneDef", "totalTime");
			$varArray["width"]    = '600'; $width = '80';
			$varArray["colCount"] = '9';
		break;
		case "Capture the Flag":
			$headArray = array("Team", "Kills", "Flags Picked Up", "Flags Saved", "Flags Captured", "Carriers Killed", "Time");
			$statArray = array("team_name", "kills", "flagPick", "flagSaves", "flagCapt", "flagCarr", "totalTime");
			$varArray["width"]    = '600'; $width = '80';
			$varArray["colCount"] = '9';
		break;
		case "Flagball":
			$headArray = array("Team", "Kills", "Flags Picked Up", "Flags Saved", "Flags Captured", "Carriers Killed", "Time");
			$statArray = array("team_name", "kills", "flagPick", "flagSaves", "flagCapt", "flagCarr", "totalTime");
			$varArray["width"]    = '600'; $width = '80';
			$varArray["colCount"] = '9';
		break;
		case "Advance and Secure":
			$headArray = array("Team", "LFP's", "Zone Time", "ZoneAtt Kills", "ZoneDef Kills", "Time");
			$statArray = array("team_name", "campTakeovers", "neutralTime", "zoneAtt", "zoneDef", "totalTime");
			$varArray["width"]    = '600'; $width = '80';
			$varArray["colCount"] = '8';
		break;
		case "Conquer and Control":
			$headArray = array("Team", "LFP's", "Zone Time", "ZoneAtt Kills", "ZoneDef Kills", "Time");
			$statArray = array("team_name", "campTakeovers", "neutralTime", "zoneAtt", "zoneDef", "totalTime");
			$varArray["width"]    = '600'; $width = '80';
			$varArray["colCount"] = '8';
		break;
		case "Deathmatch":
			$headArray = array("Kills", "Deaths", "Headshots", "Knifingss", "Multi-Kills", "Time");
			$statArray = array("kills", "deaths", "headshots", "knifings", "multiKills", "totalTime");
			$varArray["width"]    = '600'; $width = '80';
			$varArray["colCount"] = '9';
		break;
	}

	$varArray["headList"] = "";
	$varArray["head2List"] = "";
	foreach($headArray as $header => $name) {
		$varArray["headList"] .= '<td><div align="center">'.$name.'</div></td>';
		if(($condGame == "Deathmatch" && $name != "Team") || ($condGame != "Deathmatch" && $header != "Team")) {
			$varArray["head2List"] .= '<td><div align="center">'.$name.'</div></td>';
		}
	}
	
	$varArray["statList"] = "";
	$varArray["stat2List"] = "";
	foreach($statArray as $header => $name) {
		$varArray["statList"] .= '<td><div align="center">{list_'.$name.'}</div></td>';
		if(($condGame == "Deathmatch" && $name != "Team") || ($condGame != "Deathmatch" && $header != "Team")) {
			$varArray["stat2List"] .= '<td width="'.$width.'"><div align="right">{list2_'.$name.'}</div></td>';
		}
	} 
	
	$query =  " $serverstats_table.time AS totalTime ";   
	$conditions1 = $conditions." GROUP BY ".$cond["table"].".team ";
	
	switch($condStats) {
		case 2: 
			$type  = "statsm"       ; 
		break;
		default: 
			$type  = "stats"       ;
	}
	
	$sqlArray[0]["query"]      = "SELECT ".$joSelect[$type].", ".$query;
	$sqlArray[0]["tables"]     = " ".$cond["table"].", $serverstats_table ";
	$sqlArray[0]["conditions"] = " WHERE $serverstats_table.game_type = ".$cond["table"].".game_type
								 $conditions1 ";
	$sqlArray[0]["type"]       = "multi";
	$sqlArray[0]["prefix"]     = "list";
	
	$sqlArray[1]["query"]      = "SELECT ".$joSelect["player"].", ".$joSelect[$type];
	$sqlArray[1]["tables"]     = " $players_table, ".$cond["table"]." ";
	$sqlArray[1]["conditions"] = " WHERE $players_table.id = ".$cond["table"].".player 
								 $conditions 
								 GROUP BY ".$cond["table"].".player  
								 ORDER BY grating DESC LIMIT 10";
	$sqlArray[1]["type"]       = "multi";
	$sqlArray[1]["prefix"]     = "list2";
	
	$varArray["content"] = $tpl->buildMgtTpl($varArray, $sqlArray, 2, $file, "");
}