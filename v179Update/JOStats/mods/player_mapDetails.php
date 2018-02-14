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
// File Name     : Player Map Details Module                 //
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
	$mid=(!empty($_GET['mid']) ? intval($_GET['mid']) : 0);
	$condStats=(!empty($_GET['condStats']) ? intval($_GET['condStats']) : 1);
	$condTeam=(!empty($_GET['condTeam']) ? intval($_GET['condTeam']) : 0);
	$condGame=(!empty($_GET['condGame']) ? cMioD4($_GET['condGame']) : '0');
	$condServer=(!empty($_GET['condServer']) ? $_GET['condServer'] : 0);

	$varArray["formAction"] = "./?";
	$varArray["section"] = "player_mapDetails";
	$varArray["mid"] = $mid;
	$varArray["pid"] = $pid;
	
	$gameStats = SetGameStats($pid, $mid, "map");
	
	$varArray["condStats"]  = $condStats;
	$varArray["condTeam"]   = $condTeam;
	$varArray["condServer"] = $condServer;
	$varArray["condGame"]   = $condGame;
	
    $cond = $tpl->getjoConditionsS($condServer, $condStats, $condTeam, $condGame, $pid, "map");
	
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
			$type  = "statsm"    ;
			$type2 = "mapstatsm" ; 
		break;
		default: 
			$type  = "stats"    ;
			$type2 = "mapstats" ;
	}
	
	$sql = $tpl->joQuery("SELECT ".$joSelect["map"].", ".$joSelect[$type2].", ".$joSelect[$type]."  
						  FROM $maps_table, ".$cond["tableM"].", ".$cond["table"]." 
						  WHERE $maps_table.id = ".$cond["tableM"].".map   
						  AND ".$cond["tableM"].".record = ".$cond["table"].".id 
						  AND ".$cond["tableM"].".map = '".$mid."' 
						  AND ".$cond["table"].".player = '".$pid."' 
						   ".$conditions." 
						  GROUP BY ".$cond["tableM"].".map", 1);
	if(mysqli_num_rows($sql) > 0) {
		$row = mysqli_fetch_array($sql);
		$row["m_name"] = base64_decode($row["m_name"]);
		$row["m_totalTime"] = $tpl->joFormatTime($row["m_totalTime"]);
		$row["m_ratio"] = $tpl->JoColorRatio($row["m_ratio"]);
		//$row["m_hiRatio"] = $tpl->JoColorRatio($row["m_hiRatio"]);
		$row["m_loses"] = $row["m_games"] - ($row["m_wins"] + $row["m_draws"]);
		
		$mapTop = $tpl->GetJoMapTop($row["m_id"]);
		foreach($mapTop as $stat => $array) {
			if($array[0] == 0) {
				$row[$stat] = "None Recorded";
			} else {
				$row[$stat] = $tpl->JoColorRatio($array[0])."(".$array[1].")";
			}
		}
		
		foreach($row as $tag => $value) {
			$varArray[$tag] = $value;
		}
	} else {
		$varArray["name"] = $gameStats[0]["name"];
		$varArray["m_name"] = base64_decode($gameStats[2]["name"]);
		$varArray["m_image"] = "none.gif";
		
		foreach($gameStats[1] as $tag) {
			$varArray[$tag] = 0;
			$varArray[$tag."Per"] = 0;
		}
	}
	
	$sqlArray[0]["query"]      = " SELECT *  ";
	$sqlArray[0]["tables"]     = " $last_table ";
	$sqlArray[0]["conditions"] = " WHERE player = '".$pid."' 
								   AND map = '".$mid."' 
								   ORDER BY lastUpdate DESC LIMIT 5";
	$sqlArray[0]["type"]       = "multi";
	$sqlArray[0]["prefix"]     = "list";
	
	$varArray["joTips"] = "";
	if($joTips) {
		$varArray["joTips"] = '<table id="js_menu">
						         <tr>
							       <td id="js_aboutText"><u>Tips</u></td>
						         </tr>
								 <tr>
							       <td align="left" id="js_aboutText">1. Hover over a header name to see more info.</td>
						  	     </tr>
						       </table><br /><br />';
	}
	
	$varArray["content"] = $tpl->buildMgtTpl($varArray, $sqlArray, 1, $file, "mapDetails");

}