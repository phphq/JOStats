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
// File Name     : Player Map Stats Module                   //
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

	$headArray = array("Maps Name" => "m_name", "Kills" => "m_kills", "Deaths" => "m_deaths", "Ratio" => "m_ratio", 
	               "Games" => "m_games", "Win %" => "m_winPer", "Time Played" => "m_totalTime");
	
	$pid=(!empty($_GET['pid']) ? intval($_GET['pid']) : 0);
	$page=(!empty($_GET['page']) ? intval($_GET['page']) : 1);
	$condStats=(!empty($_GET['condStats']) ? intval($_GET['condStats']) : 1);
	$condTeam=(!empty($_GET['condTeam']) ? intval($_GET['condTeam']) : 0);
	$condGame=(!empty($_GET['condGame']) ? cMioD4($_GET['condGame']) : '0');
	$condServer=(!empty($_GET['condServer']) ? $_GET['condServer'] : 0);
	$sort=((!empty($_GET['sort']) && in_array($_GET['sort'], $headArray)) ? aGlod3($_GET['sort']) : "m_totalTime");
	$order=((!empty($_GET['order']) && in_array($_GET['order'], array("ASC", "DESC"))) ? aGlod3($_GET['order']) : "DESC");

	$varArray["formAction"] = "./?";
	$varArray["section"] = "player_maps";
	$varArray["pid"] = $pid;
	$varArray["page"] = $page;
	
	$varArray["condStats"]  = $condStats;
	$varArray["condTeam"]   = $condTeam;
	$varArray["condServer"] = $condServer;
	$varArray["condGame"]   = $condGame; 

    $cond = $tpl->getjoConditionsM($condServer, $condStats, $condTeam, $condGame, $pid, "map");
	
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
	
	$varArray["headers"] = "";
	foreach($headArray as $title => $stat) {
		if($sort == $stat) {
			if($order == "DESC") {$ord = "ASC";} else {$ord = "DESC";}
		} else {
			$ord = "DESC";
		}
		$sortUrl = "./?section=player_maps&pid=".$pid."&page=".$page."&sort=".$stat."&order=".$ord."&condStats=".$condStats."&condTeam=".$condTeam."&condServer=".$condServer."&condGame=".$condGame;
		if($title == "Maps Name") {
			$varArray["headers"] .= '<td title="Sort table by '.GetJoHeaders($title).' '.$ord.'" colspan="3">
									 <a href="'.$sortUrl.'">'.$title.'</a></td>';
		} else {
			$varArray["headers"] .= '<td title="Sort table by '.GetJoHeaders($title).' '.$ord.'">
									 <a href="'.$sortUrl.'">'.$title.'</a></td>';
		}
	}
	
	$sql = $tpl->joQuery("SELECT ".$cond["tableM"].".map, ".$cond["table"].".player 
	                      FROM ".$cond["tableM"].", ".$cond["table"]."
						  WHERE ".$cond["tableM"].".record = ".$cond["table"].".id 
						  AND ".$cond["table"].".player = '".$pid."' 
						  GROUP BY ".$cond["tableM"].".map", 1);
	$total = mysqli_num_rows($sql) - 1;
	
	$sql = $tpl->joQuery("SELECT * FROM $settings_table WHERE setting = 'mapsPerPage'", 1);
	$row = mysqli_fetch_assoc($sql);
	$perPage = $row["value"];
	
	$offset = ($page-1)*$perPage;
	
	$varArray["offset"] = $offset;
	
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

	$sqlArray[0]["query"]      = "SELECT ".$joSelect["map"].", ".$joSelect[$type].", ".$joSelect[$type2];
	$sqlArray[0]["tables"]     = " $maps_table, ".$cond["table"].", ".$cond["tableM"]." ";
	$sqlArray[0]["conditions"] = "WHERE $maps_table.id = ".$cond["tableM"].".map 
	                              AND ".$cond["tableM"].".record = ".$cond["table"].".id 
								  AND ".$cond["table"].".player = '".$pid."' ".$conditions."
								  GROUP BY ".$cond["table"].".game_type, $maps_table.name 
								  ORDER BY $sort $order 
								  LIMIT ".$offset.", ".$perPage."";
	$sqlArray[0]["type"]       = "multi";
	$sqlArray[0]["prefix"]     = "list";
	
	$varArray["joTips"] = "";
	if($joTips) {
		$varArray["joTips"] = '<table id="js_menu">
						         <tr>
							       <td id="js_aboutText"><u>Tips</u></td>
						         </tr>
							     <tr>
							       <td align="left" id="js_aboutText">1. Click the table headers to sort the table specificly.</td>
						         </tr>
						         <tr>
							       <td align="left" id="js_aboutText">2. Hover over a header name to see a description.</td>
						  	     </tr>
						       </table><br /><br />';
	}

	$url = "./?section=player_maps&pid=".$pid."&sort=".$sort."&order=".$order."&condStats=".$condStats."&condTeam=".$condTeam."&condServer=".$condServer."&condGame=".$condGame."&page=";

	
	$varArray["multiList"] = $tpl->GetJoMultiList($url, $page, $total, $perPage);
	
	$varArray["content"] = $tpl->buildMgtTpl($varArray, $sqlArray, 1, $file, "maps");
}