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
// Website       : http://www.gamers-central.com             //
// Support       : http://www.babstats.com                   //
//                                                           //
// File Name     : Squad Details Module                      //
// File Version  : 1.0.3 Standalone                          //
//                                                           //
/////////////////////////////////////////////////////////////*/

/*/////////////////////////////////////////////////////////////
//                                                           //
// Updated Dec 2016 By Novahq.net <scott@novahq.net>         //
// Standalone, PHP 5.6+ Compatible                           //
//                                                           //
/////////////////////////////////////////////////////////////*/

$file = "./tpls/squads.tpl";

if(!$tpl->getMgtTpl($file)) {

	$varArray["content"] = $tpl->joErrorRet(1, $section." template");	

} else {
	
	$sqid=(!empty($_GET['sqid']) ? intval($_GET['sqid']) : 0);
	$condStats=(!empty($_GET['condStats']) ? intval($_GET['condStats']) : 1);
	$condTeam=(!empty($_GET['condTeam']) ? intval($_GET['condTeam']) : 0);
	$condGame=(!empty($_GET['condGame']) ? cMioD4($_GET['condGame']) : '0');
	$condServer=(!empty($_GET['condServer']) ? $_GET['condServer'] : 0);
	
	$varArray["formAction"] = "./?";
	$varArray["section"]="squad_details";
	$varArray["sqid"] = $sqid;

	$gameStats = SetGameStats($sqid, "", "player");

	$varArray["condStats"]  = $condStats;
	$varArray["condTeam"]   = $condTeam;
	$varArray["condServer"] = $condServer;
	$varArray["condGame"]   = $condGame;
	
    $cond = $tpl->getjoConditionsS($condServer, $condStats, $condTeam, $condGame, $sqid, "player");
	
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
	
	$detailsArray = $tpl->GetJoGameDetails($condGame);
	
	$sql = $tpl->joQuery("SELECT COUNT($players_table.name) AS plyrNum , $squads_table.* 
						  FROM $players_table, $squads_table 
						  WHERE $players_table.squad = $squads_table.id
						  AND $squads_table.id = '".$sqid."' 
						  GROUP BY $players_table.squad", 1);
	$row = mysqli_fetch_assoc($sql);
	$plyrNum = $row["plyrNum"];   
	
	switch($condStats) {
		case 2: 
			$type  = "statsm"       ; 
		break;
		default: 
			$type  = "stats"       ;
	}
	
	$sql = $tpl->joQuery("SELECT $squads_table.*, ".$joSelect[$type]." 
						  FROM $players_table, ".$cond["table"].", $squads_table 
						  WHERE $players_table.id = ".$cond["table"].".player AND $players_table.squad = '".$sqid."' 
						  AND $squads_table.id = ".$sqid." ".$conditions." GROUP BY $players_table.squad", 1);
			  
	$row = @mysqli_fetch_array($sql);


	if(empty($row)) {

		$varArray["tkothTime"] = 0;
		$varArray["neutralTime"] = 0;
		$varArray["homeTime"] = 0;
		$varArray["assists"] = 0;
		$varArray["assistsG"] = 0;
		$varArray["kills"] = 0;
		$varArray["killsG"] = 0;

		$varArray["headshots"] = 0;
		$varArray["headshotsG"] = 0;
		$varArray["sniperkills"] = 0;
		$varArray["sniperkillsG"] = 0;
		$varArray["multiKills"] = 0;
		$varArray["multiKillsG"] = 0;
		$varArray["knifings"] = 0;
		$varArray["knifingsG"] = 0;
		$varArray["timesHit"] = 0;
		$varArray["timesHitG"] = 0;
		$varArray["deaths"] = 0;
		$varArray["deathsG"] = 0;
		$varArray["avgHdeaths"] = 0;
		$varArray["avgHdeathsG"] = 0;

		$varArray["ratio"] = 0;
		$varArray["ratioG"] = 0;		
		$varArray["murders"] = 0;
		$varArray["murdersG"] = 0;
		$varArray["suicides"] = 0;
		$varArray["suicidesG"] = 0;		
		$varArray["medAttempts"] = 0;
		$varArray["medAttemptsG"] = 0;
		$varArray["medHeal"] = 0;
		$varArray["medHealG"] = 0;		
		$varArray["medSave"] = 0;
		$varArray["medSaveG"] = 0;
		$varArray["revived"] = 0;
		$varArray["revivedG"] = 0;
		$varArray["totalTime"] = 0;
		$varArray["totalTimeG"] = 0;

		$varArray["logo"] = 'none.gif';
		$varArray["name"] = 'N/A';
		$varArray["url"] = 'N/A';
		$varArray["info"] = 'N/A';
		$varArray["gametypeDetails"] = 'N/A';

	} else {

		$row["tkothTime"]   = $tpl->joFormatTime($row["tkothTime"])   ;
		$row["neutralTime"] = $tpl->joFormatTime($row["neutralTime"]) ;
		$row["homeTime"]    = $tpl->joFormatTime($row["homeTime"])    ;

		$row["name"] = htmlspecialchars($row["name"]);

		$varArray["gametypeDetails"] ="";
		switch($condGame) {
			case 0:
				$varArray["gametypeDetails"] = '<tr>
												  <td id="js_row2" width="60%" align="left">PSP Takeovers</td>
												  <td id="js_row1" width="40%" align="right">{pspTakeovers}</td>
											    </tr>
											    <tr>
												  <td id="js_row2" align="left">LFP Takeovers</td>
												  <td id="js_row1" align="right">{campTakeovers}</td>
											    </tr>
											    <tr>
												  <td id="js_row2" align="left">Hill Zone Time</td>
												  <td id="js_row1" align="right">{tkothTime}</td>
											    </tr>
											    <tr>
												  <td id="js_row2" align="left">Targets</td>
												  <td id="js_row1" align="right">{targets}</td>
											    </tr>
											    <tr>
												  <td id="js_row2" align="left">Flags Captured</td>
												  <td id="js_row1" align="right">{flagCapt}</td>
											    </tr>';
			break;
		}
		
		if($row["kills"] == 0) {$row["killsM"] = 1;} else {$row["killsM"] = $row["kills"];}
		if($row["deaths"] == 0) {$row["deathsM"] = 1;} else {$row["deathsM"] = $row["deaths"];}
			
		if($row["deaths"] > $row["kills"]) {
			$row["deathsLen"] = $row["deaths"] * (140/$row["deathsM"]);
			$row["killsLen"]  = $row["kills"]  * (140/$row["deathsM"]);
		}
			
		if($row["kills"] > $row["deaths"]) {
			$row["deathsLen"] = $row["deaths"] * (140/$row["killsM"]);
			$row["killsLen"]  = $row["kills"]  * (140/$row["killsM"]);
		}
			
		$row["headshotsLen"]   = $row["headshots"]   * ($row["killsLen"]/$row["killsM"]);
		$row["sniperkillsLen"] = $row["sniperkills"] * ($row["killsLen"]/$row["killsM"]);
		$row["multiKillsLen"]  = $row["multiKills"]  * ($row["killsLen"]/$row["killsM"]);
		$row["knifingsLen"]    = $row["knifings"]    * ($row["killsLen"]/$row["killsM"]);
		$row["suicidesLen"]    = $row["suicides"]    * ($row["deathsLen"]/$row["deathsM"]);
		
		
		foreach($row as $tag => $value) {
			if($tag == "totalTime") {
				$varArray[$tag]     = $tpl->joFormatTime($value);
				$varArray[$tag."G"] = $tpl->joFormatTime(round($value/$plyrNum, 2));
			} elseif($tag == "ratio") {
				$varArray[$tag]     = $tpl->JoColorRatio($value);
				$varArray[$tag."G"] = $tpl->JoColorRatio(round($value/$plyrNum, 2));
			} else {
				$varArray[$tag]     = $value;
				$varArray[$tag."G"] = round($value/$plyrNum, 2);
			}
		}

	}

	$query = "SELECT 
				  $players_table.name                                                  ,
				  $players_table.id                                                    ,
				  $players_table.rating                                                ,
				  SUM($stats_table.kills)                                AS kills      , 
				  SUM($stats_table.assists)                              AS assists    , 
				  SUM($stats_table.deaths)                               AS deaths     , 
				  ROUND(SUM($stats_table.kills)/IF(SUM($stats_table.deaths)=0, 1, 
				  SUM($stats_table.deaths)), 2)                          AS ratio      ,
				  SUM($stats_table.headshots)                            AS headshots  ,
				  SUM($stats_table.multiKills)                           AS multiKills ,
				  SUM($stats_table.totalTime)                            AS totalTime";
	
	$sqlArray[0]["query"]      = $query;
	$sqlArray[0]["tables"]     = " $players_table, $stats_table";
	$sqlArray[0]["conditions"] = " WHERE $stats_table.player = $players_table.id  
								 AND $players_table.squad = '".$sqid."' 
								 $conditions 
								 GROUP BY $stats_table.player 
								 ORDER BY rating DESC";
	$sqlArray[0]["type"]       = "multi";
	$sqlArray[0]["prefix"]     = "list2";

	$varArray["content"] = $tpl->buildMgtTpl($varArray, $sqlArray, 1, $file, "details");
}