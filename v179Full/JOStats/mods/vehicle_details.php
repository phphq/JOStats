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
// File Name     : Vehicle Details Module                    //
// File Version  : 1.0.2 Standalone                          //
//                                                           //
/////////////////////////////////////////////////////////////*/

/*/////////////////////////////////////////////////////////////
//                                                           //
// Updated Dec 2016 By Novahq.net <scott@novahq.net>         //
// Standalone, PHP 5.6+ Compatible                           //
//                                                           //
/////////////////////////////////////////////////////////////*/

$file = "./tpls/vehicles.tpl";

if(!$tpl->getMgtTpl($file)) {

	$varArray["content"] = $tpl->joErrorRet(1, $section." template");	

} else {
	
	$vid=(!empty($_GET['vid']) ? intval($_GET['vid']) : 0);
	$condStats=(!empty($_GET['condStats']) ? intval($_GET['condStats']) : 1);
	$condTeam=(!empty($_GET['condTeam']) ? intval($_GET['condTeam']) : 0);
	$condGame=(!empty($_GET['condGame']) ? cMioD4($_GET['condGame']) : '0');
	$condServer=(!empty($_GET['condServer']) ? $_GET['condServer'] : 0);

	$varArray["formAction"] = "./?";
	$varArray["section"]="vehicle_details";
	$varArray["vid"] = $vid;

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

	switch($condStats) {
		case 2: 
			$type  = "statsm"        ;
			$type2 = "vehiclestatsm" ; 
		break;
		default: 
		$type  = "stats"        ;
		$type2 = "vehiclestats" ;
	}
	
	$sql = $tpl->joQuery("SELECT ".$joSelect["vehicle"]." , ".$joSelect[$type2].", ".$joSelect[$type].     
						 " FROM $vehicles_table, ".$cond["tableV"].", ".$cond["table"]." 
						   WHERE $vehicles_table.id = ".$cond["tableV"].".vehicle  
						   AND ".$cond["tableV"].".record = ".$cond["table"].".id 
						   AND ".$cond["tableV"].".vehicle = '".$vid."' 
						    ".$conditions." 
						   GROUP BY ".$cond["tableV"].".vehicle", 1);
	$row = mysqli_fetch_array($sql);

	if(empty($row)) {

		$varArray["v_name"] = 'N/A';
		$varArray["v_image"] = 'none.gif';

		$varArray["v_kills"] = 0;
		$varArray["v_headshots"] = 0;
		$varArray["v_multiKills"] = 0;
		$varArray["v_deaths"] = 0;
		$varArray["v_suicides"] = 0;
		$varArray["w_multiKillsLen"] = 0;
		$varArray["v_murders"] = 0;
		$varArray["v_ratio"] = 0;
		$varArray["v_accuracy"] = 0;
		$varArray["v_totalTime"] = 0;

	} else {

		$row["v_totalTime"] = $tpl->joFormatTime($row["v_totalTime"]);
		$row["v_ratio"] = $tpl->JoColorRatio($row["v_ratio"]);
		$row["v_name"] = htmlspecialchars($row["v_name"]);
		$row["v_image"] = "none.gif";
		//$row["v_rank"] = GetJoWpnRanks($wid, $id);
		
		foreach($veh_common as $vehn => $vehi) {
			if(strstr(strtolower($row["v_name"]), $vehn)) {
		  		$row["v_image"] = $vehi;
		 		break;
	    	}
	 	}

	 	$row["v_killsLen"] = 0;
	 	$row["v_deathsLen"] = 0;
		
		if($row["v_kills"] == 0) {$row["killsM"] = 1;} else {$row["killsM"] = $row["v_kills"];}
		if($row["v_deaths"] == 0) {$row["deathsM"] = 1;} else {$row["deathsM"] = $row["v_deaths"];}
		
		if($row["v_deaths"] > $row["v_kills"]) {
			$row["v_deathsLen"] = $row["v_deaths"] * (160/$row["deathsM"]);
			$row["v_killsLen"]  = $row["v_kills"]  * (160/$row["deathsM"]);
		}
		
		if($row["v_kills"] > $row["v_deaths"]) {
			$row["v_deathsLen"] = $row["v_deaths"] * (160/$row["killsM"]);
			$row["v_killsLen"]  = $row["v_kills"]  * (160/$row["killsM"]);
		}
		
		$row["v_headshotsLen"]   = $row["v_headshots"]   * ($row["v_killsLen"]/$row["killsM"]);
		$row["v_multiKillsLen"]  = $row["v_multiKills"]  * ($row["v_killsLen"]/$row["killsM"]);
		$row["v_suicidesLen"]    = $row["v_suicides"]    * ($row["v_deathsLen"]/$row["deathsM"]);
		
		foreach($row as $tag => $value) {
			$varArray[$tag] = $value;
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
	
	
	$sqlArray[1]["query"]      = "SELECT ".$joSelect["player"].", ".$joSelect["stats"].", ".$joSelect["vehiclestats"];
	$sqlArray[1]["tables"]     = " $players_table, ".$cond["table"].", ".$cond["tableV"]." ";
	$sqlArray[1]["conditions"] = " WHERE ".$cond["table"].".player = $players_table.id  
								   AND ".$cond["tableV"].".record = ".$cond["table"].".id
								   AND ".$cond["tableV"].".vehicle = '".$vid."' 
								    ".$conditions." 
								   GROUP BY ".$cond["table"].".player 
								   ORDER BY v_kills, v_ratio DESC 
								   LIMIT 0, 25";
	$sqlArray[1]["type"]       = "multi";
	$sqlArray[1]["prefix"]     = "list2";
	
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
	
	$varArray["content"] = $tpl->buildMgtTpl($varArray, $sqlArray, 2, $file, "details");

}