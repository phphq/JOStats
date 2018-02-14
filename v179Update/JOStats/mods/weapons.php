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
// File Name     : Weapons List Module                       //
// File Version  : 1.0.2 Standalone                          //
//                                                           //
/////////////////////////////////////////////////////////////*/

/*/////////////////////////////////////////////////////////////
//                                                           //
// Updated Dec 2016 By Novahq.net <scott@novahq.net>         //
// Standalone, PHP 5.6+ Compatible                           //
//                                                           //
/////////////////////////////////////////////////////////////*/

$file = "./tpls/weapons.tpl";

if(!$tpl->getMgtTpl($file)) {

	$varArray["content"] = $tpl->joErrorRet(1, $section." template");	

} else {

	$headArray = array("Shots" => "w_shotsFired", "Kills" => "w_kills", "H-Shots" => "w_headshots", 
	                   "M-Kills" => "w_multiKills", "Accuracy" => "w_accuracy", "Time Used" => "w_totalTime");

	$page=(!empty($_GET['page']) ? intval($_GET['page']) : 1);
	$condStats=(!empty($_GET['condStats']) ? intval($_GET['condStats']) : 1);
	$condTeam=(!empty($_GET['condTeam']) ? intval($_GET['condTeam']) : 0);
	$condGame=(!empty($_GET['condGame']) ? cMioD4($_GET['condGame']) : '0');
	$condServer=(!empty($_GET['condServer']) ? $_GET['condServer'] : 0);
	$sort=((!empty($_GET['sort']) && in_array($_GET['sort'], $headArray)) ? aGlod3($_GET['sort']) : "w_totalTime");
	$order=((!empty($_GET['order']) && in_array($_GET['order'], array("ASC", "DESC"))) ? aGlod3($_GET['order']) : "DESC");

	$varArray["formAction"] = "./?";
	$varArray["section"] = "weapons";

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
	
	//$wnk = join("' AND `name` != '", $wpn_no_kills);
	$wnk = ""; //wut
	$conditions .= " AND `name` != '".$wnk."' ";

	$varArray["headers"] = "";
	foreach($headArray as $title => $stat) {
		if($sort == $stat) {
			if($order == "DESC") {$ord = "ASC";} else {$ord = "DESC";}
		} else {
			$ord = "DESC";
		}
		$sortUrl = "./?section=weapons&page=".$page."&sort=".$stat."&order=".$ord."&condStats=".$condStats."&condTeam=".$condTeam."&condServer=".$condServer."&condGame=".$condGame;
		$varArray["headers"] .= '<td title="Sort table by '.htmlspecialchars(GetJoHeaders($title)).' '.$ord.'">
		                         <a href="'.$sortUrl.'">'.htmlspecialchars($title).'</a></td>';
	}
	
	$sql = $tpl->joQuery("SELECT * FROM $weapons_table WHERE `name` != '".$wnk."'", 1);
	$total = mysqli_num_rows($sql) - 1;
	
	$sql = $tpl->joQuery("SELECT * FROM $settings_table WHERE setting = 'wpnsPerPage'", 1);
	$row = mysqli_fetch_assoc($sql);
	$perPage = $row["value"];
	
	if($perPage < 1) $perPage = 25;
	
	$offset = ($page-1)*$perPage;
	
	$varArray["offset"] = $offset;
	
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
	
	$sqlArray[0]["query"]      = "SELECT ".$joSelect["weapon"].", ".$joSelect[$type].", ".$joSelect[$type2];
	$sqlArray[0]["tables"]     = " $weapons_table, ".$cond["table"].", ".$cond["tableW"]." ";
	$sqlArray[0]["conditions"] = "WHERE $weapons_table.id = ".$cond["tableW"].".weapon 
	                              AND ".$cond["tableW"].".record = ".$cond["table"].".id 
								   ".$conditions."
								  GROUP BY ".$cond["tableW"].".weapon 
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
	
	$url = "./?section=weapons&sort=".$sort."&order=".$order."&condStats=".$condStats."&condTeam=".$condTeam."&condServer=".$condServer."&condGame=".$condGame."&page=";

	$varArray["multiList"] = $tpl->GetJoMultiList($url, $page, $total, $perPage);
	
	$varArray["content"] = $tpl->buildMgtTpl($varArray, $sqlArray, 1, $file, "list");
}