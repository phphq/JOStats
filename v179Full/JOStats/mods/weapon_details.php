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
// File Name     : Weapon Details Module                     //
// File Version  : 1.0.1 Standalone                          //
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
	
	$wid=(!empty($_GET['wid']) ? intval($_GET['wid']) : 0);
	$condStats=(!empty($_GET['condStats']) ? intval($_GET['condStats']) : 1);
	$condTeam=(!empty($_GET['condTeam']) ? intval($_GET['condTeam']) : 0);
	$condGame=(!empty($_GET['condGame']) ? cMioD4($_GET['condGame']) : '0');
	$condServer=(!empty($_GET['condServer']) ? $_GET['condServer'] : 0);
	
	$varArray["formAction"] = "./?";
	$varArray["section"]="weapon_details";
	$varArray["wid"] = $wid;

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
	
	switch($condStats) {
		case 2: 
			$type  = "statsm"       ;
			$type2 = "weaponstatsm" ; 
		break;
		default: 
			$type  = "stats"       ;
			$type2 = "weaponstats" ;
	}
	
	$sql = $tpl->joQuery("SELECT ".$joSelect["weapon"]." , ".$joSelect[$type2].", ".$joSelect[$type].     
						 " FROM $weapons_table, ".$cond["tableW"].", ".$cond["table"]." 
						   WHERE $weapons_table.id = ".$cond["tableW"].".weapon  
						   AND ".$cond["tableW"].".record = ".$cond["table"].".id 
						   AND ".$cond["tableW"].".weapon = '".$wid."' 
						    ".$conditions." 
						   GROUP BY ".$cond["tableW"].".weapon", 1);
	$row = mysqli_fetch_array($sql);

	if(empty($row)) {

		$varArray["w_name"] = 'N/A';
		$varArray["w_image"] = 'none.gif';
		$varArray["w_totalTime"] = 0;
		$varArray["w_ratio"] = 0;
		$varArray["w_kills"] = 0;
		$varArray["w_deaths"] = 0;
		$varArray["w_deathsLen"] = 0;
		$varArray["w_killsLen"] = 0;
		$varArray["w_headshotsLen"] = 0;
		$varArray["w_multiKillsLen"] = 0;
		$varArray["w_suicidesLen"] = 0;
		$varArray["w_headshots"] = 0;
		$varArray["w_multiKills"] = 0;
		$varArray["w_suicides"] = 0;
		$varArray["w_murders"] = 0;
		$varArray["w_accuracy"] = 0;

	} else {
		
		$row["w_totalTime"] = $tpl->joFormatTime($row["w_totalTime"]);
		$row["w_ratio"] = $tpl->JoColorRatio($row["w_ratio"]);
		//$row["w_rank"] = GetJoWpnRanks($wid, $id);

		$row["w_name"] = htmlspecialchars($row["w_name"]);

		$row["w_image"] = (!empty($wpn_img[$row["w_name"]]) ? $wpn_img[$row["w_name"]] : 'none.gif');
		
		
		if($row["w_kills"] == 0) {$row["killsM"] = 1;} else {$row["killsM"] = $row["w_kills"];}
		if($row["w_deaths"] == 0) {$row["deathsM"] = 1;} else {$row["deathsM"] = $row["w_deaths"];}
		
		if($row["w_deaths"] > $row["w_kills"]) {
			$row["w_deathsLen"] = $row["w_deaths"] * (160/$row["deathsM"]);
			$row["w_killsLen"]  = $row["w_kills"]  * (160/$row["deathsM"]);
		}
		
		if($row["w_kills"] > $row["w_deaths"]) {
			$row["w_deathsLen"] = $row["w_deaths"] * (160/$row["killsM"]);
			$row["w_killsLen"]  = $row["w_kills"]  * (160/$row["killsM"]);
		}
		
		$row["w_headshotsLen"]   = $row["w_headshots"]   * ($row["w_killsLen"]/$row["killsM"]);
		$row["w_multiKillsLen"]  = $row["w_multiKills"]  * ($row["w_killsLen"]/$row["killsM"]);
		$row["w_suicidesLen"]    = $row["w_suicides"]    * ($row["w_deathsLen"]/$row["deathsM"]);
		
		foreach($row as $tag => $value) {
			$varArray[$tag] = $value;
		}

	}

	$sqlArray[0]["query"]      = "SELECT ".$joSelect["player"].", ".$joSelect[$type].", ".$joSelect[$type2];
	$sqlArray[0]["tables"]     = " $players_table, ".$cond["table"].", ".$cond["tableW"]." ";
	$sqlArray[0]["conditions"] = " WHERE ".$cond["table"].".player = $players_table.id  
								   AND ".$cond["tableW"].".record = ".$cond["table"].".id
								   AND ".$cond["tableW"].".weapon = '".$wid."' 
								    ".$conditions." 
								   GROUP BY ".$cond["table"].".player 
								   ORDER BY w_kills, w_ratio DESC 
								   LIMIT 0, 25";
	$sqlArray[0]["type"]       = "multi";
	$sqlArray[0]["prefix"]     = "list2";
	
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
	
	$varArray["content"] = $tpl->buildMgtTpl($varArray, $sqlArray, 1, $file, "details");

}