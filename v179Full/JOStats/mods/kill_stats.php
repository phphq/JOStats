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

$file = "./tpls/kill_stats.tpl";

if(!$tpl->getMgtTpl($file)) {

	$varArray["content"] = $tpl->joErrorRet(1, $section." template");
	
} else {
	
	$headArray = array("Rank" => "rating", "Player Name" => "name");
	$headArray = array_merge($headArray, GetJOHeadArray("kill_stats"));


	$page=(!empty($_GET['page']) ? intval($_GET['page']) : 1);
	$condStats=(!empty($_GET['condStats']) ? intval($_GET['condStats']) : 1);
	$condTeam=(!empty($_GET['condTeam']) ? intval($_GET['condTeam']) : 0);
	$condGame=(!empty($_GET['condGame']) ? cMioD4($_GET['condGame']) : '0');
	$condServer=(!empty($_GET['condServer']) ? $_GET['condServer'] : 0);
	$sort=((!empty($_GET['sort']) && in_array($_GET['sort'], $headArray)) ? aGlod3($_GET['sort']) : "rating");
	$order=((!empty($_GET['order']) && in_array($_GET['order'], array("ASC", "DESC"))) ? aGlod3($_GET['order']) : "DESC");

	
	$varArray["formAction"] = "./?";
	$varArray["section"] = "kill_stats";

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
		$sortUrl = "./?section=kill_stats&page=".$page."&sort=".$stat."&order=".$ord."&condStats=".$condStats."&condTeam=".$condTeam."&condServer=".$condServer."&condGame=".$condGame;
		$varArray["headers"] .= '<td title="Sort table by '.GetJoHeaders($title).' '.$ord.'">
								 <a href="'.$sortUrl.'">'.$title.'</a></td>';
	}
	
	$sql = $tpl->joQuery("SELECT * FROM $players_table", 1);
	$total = mysqli_num_rows($sql);
	
	$sql = $tpl->joQuery("SELECT * FROM $settings_table WHERE setting = 'plyrsPerPage'", 1);
	$row = mysqli_fetch_assoc($sql);
	$perPage = $row["value"];
	
	$offset = ($page-1)*$perPage;
	
	$varArray["offset"] = $offset;
	
	$query = "SELECT 
				  $players_table.name                                          AS name         , 
				  $players_table.id                                            AS id           , 
				  $players_table.awards                                        AS awards       , 
				  $players_table.wpn_awards                                    AS wpn_awards   , 
				  $players_table.veh_awards                                    AS veh_awards   , 
				  $players_table.motm                                          AS motm         , 
				  $players_table.pcid                                          AS pcid         , 
				  $players_table.rating                                        AS rating       , 
				  SUM(".$cond["table"].".kills)                                AS kills        , 
				  SUM(".$cond["table"].".deaths)                               AS deaths       , 
				  ROUND(SUM(".$cond["table"].".kills)/IF(SUM(".$cond["table"].".deaths)=0, 1, 
				  SUM(".$cond["table"].".deaths)), 2)                          AS ratio        , 
				  SUM(".$cond["table"].".headshots)                            AS headshots    , 
				  SUM(".$cond["table"].".knifings)                             AS knifings     , 
				  SUM(".$cond["table"].".assists)                              AS assists      , 
				  SUM(".$cond["table"].".exp)                                  AS exp          , 
				  SUM(".$cond["table"].".multiKills)                           AS multiKills   , 
				  SUM(".$cond["table"].".shotsFired)                           AS shotsFired   , 
				  SUM(".$cond["table"].".timesHit)                             AS timesHit     , 
				  SUM(".$cond["table"].".murders)                              AS murders      , 
				  SUM(".$cond["table"].".suicides)                             AS suicides     , 
				  SUM(".$cond["table"].".medHeal)                              AS medHeal      , 
				  SUM(".$cond["table"].".medSave)                              AS medSave      , 
				  SUM(".$cond["table"].".revived)                              AS revived      , 
				  SUM(".$cond["table"].".flagSaves)                            AS flagSaves    , 
				  SUM(".$cond["table"].".flagCapt)                             AS flagCapt     , 
				  SUM(".$cond["table"].".flagPick)                             AS flagPick     , 
				  SUM(".$cond["table"].".targets)                              AS targets      , 
				  SUM(".$cond["table"].".pspTakeovers)                         AS pspTakeovers , 
				  SUM(".$cond["table"].".flagCarr)                             AS flagCarr     , 
				  SUM(".$cond["table"].".zoneAtt)                              AS zoneAtt      , 
				  SUM(".$cond["table"].".zoneDef)                              AS zoneDef      , 
				  SUM(".$cond["table"].".tkothTime)                            AS tkothTime    , 
				  SUM(".$cond["table"].".neutralTime)                          AS neutralTime  , 
				  SUM(".$cond["table"].".homeTime)                             AS homeTime     , 
				  SUM(".$cond["table"].".zoneHits)                             AS zoneHits     , 
				  SUM(".$cond["table"].".campTakeovers)                        AS campTakeovers, 
				  SUM(".$cond["table"].".medAttempts)                          AS medAttempts  , 
				  SUM(".$cond["table"].".sniperkills)                          AS sniperkills  , 
				  SUM(".$cond["table"].".games)                                AS games        , 
				  SUM(".$cond["table"].".wins)                                 AS wins         , 
				  SUM(".$cond["table"].".draws)                                AS draws        , 
				  MAX(".$cond["table"].".last_played)                          AS last_played  , 
				  SUM(".$cond["table"].".totalTime)                            AS totalTime";
	
/*
SELECT jostats_players.name AS name, 
jostats_players.id AS id , 
jostats_players.awards AS awards , 
jostats_players.wpn_awards AS wpn_awards , 
jostats_players.veh_awards AS veh_awards , 
jostats_players.motm AS motm , 
jostats_players.pcid AS pcid , 
jostats_players.rating AS rating , 
SUM(jostats_stats.kills) AS kills , 
SUM(jostats_stats.deaths) AS deaths , 
ROUND(SUM(jostats_stats.kills)/IF(SUM(jostats_stats.deaths)=0, 1, SUM(jostats_stats.deaths)), 2) AS ratio , 
SUM(jostats_stats.headshots) AS headshots , 
SUM(jostats_stats.knifings) AS knifings , 
SUM(jostats_stats.assists) AS assists , 
SUM(jostats_stats.exp) AS exp , 
SUM(jostats_stats.multiKills) AS multiKills , 
SUM(jostats_stats.shotsFired) AS shotsFired , 
SUM(jostats_stats.timesHit) AS timesHit , 
SUM(jostats_stats.murders) AS murders , 
SUM(jostats_stats.suicides) AS suicides , 
SUM(jostats_stats.medHeal) AS medHeal , 
SUM(jostats_stats.medSave) AS medSave , 
SUM(jostats_stats.revived) AS revived , 
SUM(jostats_stats.flagSaves) AS flagSaves , 
SUM(jostats_stats.flagCapt) AS flagCapt , 
SUM(jostats_stats.flagPick) AS flagPick , 
SUM(jostats_stats.targets) AS targets , 
SUM(jostats_stats.pspTakeovers) AS pspTakeovers , 
SUM(jostats_stats.flagCarr) AS flagCarr , 
SUM(jostats_stats.zoneAtt) AS zoneAtt , 
SUM(jostats_stats.zoneDef) AS zoneDef , 
SUM(jostats_stats.tkothTime) AS tkothTime , 
SUM(jostats_stats.neutralTime) AS neutralTime , 
SUM(jostats_stats.homeTime) AS homeTime , 
SUM(jostats_stats.zoneHits) AS zoneHits , 
SUM(jostats_stats.campTakeovers) AS campTakeovers, 
SUM(jostats_stats.medAttempts) AS medAttempts , 
SUM(jostats_stats.sniperkills) AS sniperkills , 
SUM(jostats_stats.games) AS games , 
SUM(jostats_stats.wins) AS wins , 
SUM(jostats_stats.draws) AS draws , 
MAX( jostats_stats.last_played) AS last_played , 
SUM(jostats_stats.totalTime) AS totalTime
FROM jostats_players, jostats_stats 
WHERE jostats_stats .player = jostats_players.id 
GROUP BY jostats_stats .player 
ORDER BY rating DESC LIMIT 0, 50
*/

	$url = "./?section=kill_stats&sort=".$sort."&order=".$order."&condStats=".$condStats."&condTeam=".$condTeam."&condServer=".$condServer."&condGame=".$condGame."&page=";

	$varArray["multiList"] = $tpl->GetJoMultiList($url, $page, $total, $perPage);
	
	$varArray["layout"] = "";
	$varArray["prefix"] = "list_";
	
	$sqlArray[0]["query"]      = $query;
	$sqlArray[0]["tables"]     = " $players_table, ".$cond["table"]." ";
	$sqlArray[0]["conditions"] = " WHERE ".$cond["table"].".player = $players_table.id ".$conditions." 
								 GROUP BY ".$cond["table"].".player 
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
	
	

	$varArray["content"] = $tpl->buildMgtTpl($varArray, $sqlArray, 1, $file, "");

}