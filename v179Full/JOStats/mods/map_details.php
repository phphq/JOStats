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

$file = "./tpls/maps.tpl";

if(!$tpl->getMgtTpl($file)) {

	$varArray["content"] = $tpl->joErrorRet(1, $section." template");	

} else {

	$mid=(!empty($_GET['mid']) ? intval($_GET['mid']) : 0);
	$condStats=(!empty($_GET['condStats']) ? intval($_GET['condStats']) : 1);
	$condTeam=(!empty($_GET['condTeam']) ? intval($_GET['condTeam']) : 0);
	$condGame=(!empty($_GET['condGame']) ? cMioD4($_GET['condGame']) : '0');
	$condServer=(!empty($_GET['condServer']) ? $_GET['condServer'] : 0);

	$varArray["formAction"] = "./?";
	$varArray["section"] = "map_details";
	$varArray["mid"] = $mid;

	$varArray["condStats"]  = $condStats;
	$varArray["condTeam"]   = $condTeam;
	$varArray["condServer"] = $condServer;
	$varArray["condGame"]   = $condGame;
	
    $cond = $tpl->getjoConditionsS($condServer, $condStats, $condTeam, $condGame, $mid, "map");
	
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

	switch($condStats) {
		case 1: 
			$type  = "stats"       ;
			$type2 = "mapstats" ;
		break;
		default: 
			$type  = "statsm"       ;
			$type2 = "mapstatsm" ; 
	}
	
	$sql = $tpl->joQuery("SELECT ".$joSelect["map"].", ".$joSelect[$type2].", ".$joSelect[$type]."  
						  FROM $maps_table, ".$cond["tableM"].", ".$cond["table"]." 
						  WHERE $maps_table.id = ".$cond["tableM"].".map   
						  AND ".$cond["tableM"].".record = ".$cond["table"].".id 
						  AND ".$cond["tableM"].".map = '".$mid."' 
						   ".$conditions." 
						  GROUP BY ".$cond["tableM"].".map", 1);
	$row = mysqli_fetch_array($sql);

	if(empty($row)) {

		$varArray["m_name"] = "N/A";
		$varArray["m_image"] = "none.gif";
		$varArray["m_kills"] = 0;
		$varArray["m_killsPer"] = 0;
		
		$varArray["m_assists"] = 0;
		$varArray["m_assistsPer"] = 0;
		$varArray["m_deaths"] = 0;
		$varArray["m_deathsPer"] = 0;

		$varArray["m_suicides"] = 0;
		$varArray["m_suicidesPer"] = 0;
		$varArray["m_murders"] = 0;
		$varArray["m_murdersPer"] = 0;
		$varArray["m_sniperKills"] = 0;
		$varArray["m_sniperKillsPer"] = 0;
		$varArray["m_multiKills"] = 0;
		$varArray["m_multiKillsPer"] = 0;
		$varArray["m_knifings"] = 0;
		$varArray["m_knifingsPer"] = 0;
		$varArray["m_games"] = 0;
		$varArray["m_wins"] = 0;
		$varArray["m_loses"] = 0;
		$varArray["m_draws"] = 0;

		$varArray["m_winPer"] = 0;
		$varArray["m_totalTime"] = 0;
		$varArray["hiScore"] = 0;
		$varArray["hiRatio"] = 0;
		$varArray["mostKills"] = 0;
		$varArray["flawless"] = 0;

	} else {

		$row["m_name"] = htmlspecialchars(base64_decode($row["m_name"]));
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

	}


	
	$sqlArray[0]["query"]      = "SELECT ".$joSelect["player"].", ".$joSelect[$type].", ".$joSelect[$type2];
	$sqlArray[0]["tables"]     = " $players_table, ".$cond["table"].", ".$cond["tableM"]." ";
	$sqlArray[0]["conditions"] = " WHERE ".$cond["table"].".player = $players_table.id  
								 AND ".$cond["tableM"].".record = ".$cond["table"].".id
								 AND ".$cond["tableM"].".map = '".$mid."' 
								  ".$conditions." 
								 GROUP BY ".$cond["table"].".player 
								 ORDER BY m_wins, m_kills DESC 
								 LIMIT 0, 25";
	$sqlArray[0]["type"]       = "multi";
	$sqlArray[0]["prefix"]     = "list2";
	
	$varArray["content"] = $tpl->buildMgtTpl($varArray, $sqlArray, 1, $file, "details");
}