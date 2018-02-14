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

	$headArray = array("Maps Name" => "m_name", "Hi-Score" => "hiScore", "Most Kills" => "mostKills", 
	                   "Hi-Ratio" => "hiRatio", "Most Flawless" => "flawless");

	$page=(!empty($_GET['page']) ? intval($_GET['page']) : 1);
	$condStats=(!empty($_GET['condStats']) ? intval($_GET['condStats']) : 1);
	$condTeam=(!empty($_GET['condTeam']) ? intval($_GET['condTeam']) : 0);
	$condGame=(!empty($_GET['condGame']) ? cMioD4($_GET['condGame']) : '0');
	$condServer=(!empty($_GET['condServer']) ? $_GET['condServer'] : 0);
	$sort=((!empty($_GET['sort']) && in_array($_GET['sort'], $headArray)) ? aGlod3($_GET['sort']) : "m_totalTime");
	$order=((!empty($_GET['order']) && in_array($_GET['order'], array("ASC", "DESC"))) ? aGlod3($_GET['order']) : "DESC");

	$varArray["formAction"] = "./?";
	$varArray["section"] = "maps";

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

	$varArray["headers"] = "";
	foreach($headArray as $title => $stat) {
		if($sort == $stat) {
			if($order == "DESC") {$ord = "ASC";} else {$ord = "DESC";}
		} else {
			$ord = "DESC";
		}
		$sortUrl = "./?section=maps&page=".$page."&sort=".$stat."&order=".$ord."&condStats=".$condStats."&condTeam=".$condTeam."&condServer=".$condServer."&condGame=".$condGame;
		if($title == "Maps Name") {
			$varArray["headers"] .= '<td title="Sort table by '.htmlspecialchars(GetJoHeaders($title)).' '.$ord.'" colspan="3">
									 <a href="'.$sortUrl.'">'.htmlspecialchars($title).'</a></td>';
		} else {
			$varArray["headers"] .= '<td title="Sort table by '.htmlspecialchars(GetJoHeaders($title)).' '.$ord.'">
									 <a href="'.$sortUrl.'">'.htmlspecialchars($title).'</a></td>';
		}
	}
	
	$sql = $tpl->joQuery("SELECT * FROM ".$cond["tableM"]." GROUP BY ".$cond["tableM"].".map", 1);
	$total = mysqli_num_rows($sql) - 1;
	
	$sql = $tpl->joQuery("SELECT * FROM $settings_table WHERE setting = 'mapsPerPage'", 1);
	$row = mysqli_fetch_assoc($sql);
	$perPage = empty($row["value"]) ? 50 : intval($row["value"]);
	
	$offset = ($page-1)*$perPage;
	
	$varArray["offset"] = $offset;

	$query = "SELECT 
		          ".$cond["table"].".player                                         ,
			      ".$cond["table"].".id                                             ,
			 	  ".$cond["tableM"].".record                                        ,
			 	  ".$cond["tableM"].".map                                           ,
			 	  $maps_table.name                              AS m_name           ,
			 	  $maps_table.image                                                 ,
			 	  MAX(".$cond["tableM"].".hiScore)              AS hiScore          ,
				  SUM(".$cond["tableM"].".deaths)               AS deaths           ,
				  SUM(".$cond["tableM"].".kills)/IF(SUM(".$cond["tableM"].".deaths)=0, 1, 
				  SUM(".$cond["tableM"].".deaths))              AS ratio            ,
				  SUM(".$cond["tableM"].".games)                AS games            ,
				  SUM(".$cond["tableM"].".wins)/IF(SUM(".$cond["tableM"].".games)=0, 1, 
				  SUM(".$cond["tableM"].".games))*100           AS winPer           ,
				  SUM(".$cond["tableM"].".totalTime)            AS m_totalTime";

	$condition = "WHERE ".$cond["tableM"].".record = ".$cond["table"].".id 
				  AND $maps_table.id = ".$cond["tableM"].".map  
				   ".$conditions."
				  GROUP BY ".$cond["tableM"].".map 
				  ORDER BY $sort $order 
				  LIMIT ".$offset.", ".$perPage."";
		
	$url = "./?section=maps&sort=".$sort."&order=".$order."&condStats=".$condStats."&condTeam=".$condTeam."&condServer=".$condServer."&condGame=".$condGame."&page=";
	$varArray["multiList"] = $tpl->GetJoMultiList($url, $page, $total, $perPage);
		
	$sqlArray[0]["query"]      = $query;
	$sqlArray[0]["tables"]     = " ".$cond["table"].", ".$cond["tableM"].", $maps_table ";
	$sqlArray[0]["conditions"] = $condition;
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
		
		$varArray["content"] = $tpl->buildMgtTpl($varArray, $sqlArray, 1, $file, "list");
}