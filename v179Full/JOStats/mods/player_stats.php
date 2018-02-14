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
// File Name     : Player Stats Module                       //
// File Version  : 1.0.7 Standalone                          //
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
	$condStats=(!empty($_GET['condStats']) ? intval($_GET['condStats']) : 1);
	$condTeam=(!empty($_GET['condTeam']) ? intval($_GET['condTeam']) : 0);
	$condGame=(!empty($_GET['condGame']) ? cMioD4($_GET['condGame']) : '0');
	$condServer=(!empty($_GET['condServer']) ? $_GET['condServer'] : 0);

	if(!$pid) {
		header("Location: ./?");
		exit;
	}
	
	$varArray["formAction"] = "./?";
	$varArray["section"] = "player_stats";
	$varArray["pid"] = $pid;
	
	$gameStats = SetGameStats($pid, "", "player");

	$varArray["condStats"]  = $condStats;
	$varArray["condTeam"]   = $condTeam;
	$varArray["condServer"] = $condServer;
	$varArray["condGame"]   = $condGame;

    $cond = $tpl->getjoConditionsS($condServer, $condStats, $condTeam, $condGame, $pid, "player");
	
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
	
	$varArray["gametypeDetails"] = "";
	foreach($detailsArray as $title => $value) {
		$varArray["gametypeDetails"] .= '<tr>
											<td id="js_row2" width="60%" align="left">'.htmlspecialchars($title).'</td>
											<td id="js_row1" width="40%" align="right">{'.htmlspecialchars($value).'}</td>
										 </tr>';
	}

	switch($condStats) {
		case 2: $type = "statsm"; break;
		default: $type = "stats";
	}

	$sqlString  = $joSelect["player"].",".$joSelect[$type];
	$sqlString .= " FROM $players_table, ".$cond["table"]." ";
	$sqlString .= " WHERE ".$cond["table"].".player = $players_table.id ";
	$sqlString .= " AND $players_table.id = '".$pid."' ".$conditions." ";
	$sqlString .= " GROUP BY ".$cond["table"].".player ";

	$sql = $tpl->joQuery("SELECT ".$sqlString, 1);
	if(mysqli_num_rows($sql) > 0) {
		$row = mysqli_fetch_assoc($sql);
		
		$row["neutralTime"] = $tpl->joFormatTime($row["neutralTime"]);
		$row["tkothTime"] = $tpl->joFormatTime($row["tkothTime"]);
		$row["homeTime"] = $tpl->joFormatTime($row["homeTime"]);
		$row["totalTime"] = $tpl->joFormatTime($row["totalTime"]);
		$rank = $tpl->GetJoRank($row["rating"]);
		$row["rImage"] = $rank["image"];
		$row["rName"] = $rank["name"];
		
		if($row["kills"] == 0) {$row["killsM"] = 1;} else {$row["killsM"] = $row["kills"];}
		if($row["deaths"] == 0) {$row["deathsM"] = 1;} else {$row["deathsM"] = $row["deaths"];}
		
		$row["deathsLen"] = 0;
		$row["killsLen"] = 0;

		if($row["deaths"] > $row["kills"]) {
			$row["deathsLen"] = $row["deaths"] * (140/$row["deathsM"]);
			$row["killsLen"]  = $row["kills"]  * (140/$row["deathsM"]);
		}
		
		if($row["kills"] > $row["deaths"]) {
			$row["deathsLen"] = $row["deaths"] * (140/$row["killsM"]);
			$row["killsLen"]  = $row["kills"]  * (140/$row["killsM"]);
		}
		

		$row["headshotsLen"]   = $row["killsLen"] > 0 ? $row["headshots"]   * ($row["killsLen"]/$row["killsM"]) : 0;
		$row["sniperkillsLen"] = $row["killsLen"] > 0 ? $row["sniperkills"] * ($row["killsLen"]/$row["killsM"]) : 0;
		$row["multiKillsLen"]  = $row["killsLen"] > 0 ? $row["multiKills"]  * ($row["killsLen"]/$row["killsM"]) : 0;
		$row["knifingsLen"]    = $row["killsLen"] > 0 ? $row["knifings"]    * ($row["killsLen"]/$row["killsM"]) : 0;
		$row["suicidesLen"]    = $row["deathsLen"] > 0 ? $row["suicides"]    * ($row["deathsLen"]/$row["deathsM"]) : 0;

		$row["awards"] = '0';
		$row["wpn_awards"] = '0';
		$row["veh_awards"] = '0';
		$aSql = $tpl->joQuery("SELECT * FROM $playerawards_table WHERE player = '".$row["id"]."'", 1);
		while($aRow = mysqli_fetch_assoc($aSql)) {
			$awSql = $tpl->joQuery("SELECT * FROM $awards_table", 1);
			while($awRow = mysqli_fetch_assoc($awSql)) {
				if($aRow["award"] == $awRow["name"]) {
					switch($awRow["type"]) {
						case '1': $row["awards"]++; break;
						case '2': $row["wpn_awards"]++; break;
						case '3': $row["veh_awards"]++; break;
					}
					break;
				}
			}
		}
		
		$sql = $tpl->joQuery("SELECT COUNT(player) AS awards 
		                      FROM $monthawards_table 
							  WHERE year_gained != 'Alltime' 
		                      AND player = '".$row["name"]."'", 1);
		$row2 = mysqli_fetch_assoc($sql);
		$row["others"] = $row2["awards"];
		
		foreach($row as $tag => $value) {
			$varArray[$tag] = $value;
			if($row["games"] < 1) {$ttlGames = 1;} else {$ttlGames = $row["games"];}
			$varArray[$tag."G"] = round($value/$ttlGames, 2);
		}
	} else {

		$varArray["last_played"] = "Never";
		$varArray["others"] = "None";
		$varArray["name"] = $gameStats[0]["name"];
		$varArray["rating"] = $gameStats[0]["rating"];
		$rank = $tpl->GetJoRank($varArray["rating"]);
		$varArray["rImage"] = $rank["image"];
		$varArray["rName"] = $rank["name"];
		
		foreach($gameStats[1] as $tag) {
			$varArray[$tag] = 0;
			$varArray[$tag."G"] = 0;
		}
	}
	
	for($i = 1; $i < 12; $i++) {
		$sql = $tpl->joQuery("SELECT 
								SUM($stats_table.kills)                                AS kills          , 
								SUM($stats_table.medSave)                              AS medSave        ,
								SUM($stats_table.assists)                              AS assists        ,
								SUM($stats_table.pspTakeovers)                         AS pspTakeovers   ,
								SUM($stats_table.campTakeovers)                        AS campTakeovers  ,
								SUM($stats_table.tkothTime)                            AS tkothTime      ,
								SUM($stats_table.neutralTime)                          AS neutralTime    ,
								SUM($stats_table.zoneAtt)                              AS zoneAtt        ,
								SUM($stats_table.zoneDef)                              AS zoneDef        ,
								SUM($stats_table.flagSaves)                            AS flagSaves      ,
								SUM($stats_table.flagCapt)                             AS flagCapt       ,
								SUM($stats_table.flagCarr)                             AS flagCarr       ,
								SUM($stats_table.targets)                              AS targets        ,
								SUM($stats_table.score_1)                              AS score_1        ,
								SUM($stats_table.score_2)                              AS score_2        ,
								SUM($stats_table.score_1) + SUM($stats_table.score_2)  AS flagDef        ,
								SUM($stats_table.games)                                AS games          ,
								SUM($stats_table.totalTime)                            AS totalTime      ,
								$stats_table.game_type
							  FROM $stats_table WHERE $stats_table.player = '".$pid."' 
							  AND $stats_table.game_type = '".$gametypes[1][$i]."' GROUP BY $stats_table.player", 1);
							  
		$varArray[$gametypes[0][$i]."Level"] = 0;
		$varArray[$gametypes[0][$i]."Rank"] = "No Rank";
		if(mysqli_num_rows($sql) > 0) {
			$row = mysqli_fetch_assoc($sql);
			$varArray[$gametypes[0][$i]."Rank"] = GetJoGameRanks($row["game_type"], $pid);
			switch($row["game_type"]) {
					case "Team Deathmatch":
						$varArray["TDMLevel"] = GetJoGameLevels($i, $row["games"], $row["totalTime"], 
							                                    $row["kills"], $row["medSaves"], $row["pspTakeovers"]);
					break;
					case "Cooperative":
						$varArray["COOPLevel"] = GetJoGameLevels($i, $row["games"], $row["totalTime"], $row["kills"], 
							                                     $row["medSave"], $row["assists"]);
					break;
					case "Team King of the Hill":
						$varArray["TKOTHLevel"] = GetJoGameLevels($i, $row["games"], $row["totalTime"], 
							                                      $row["tkothTime"], $row["zoneAtt"], $row["zoneDef"]);
					break;
					case "King of the Hill":
						$varArray["KOTHLevel"] = GetJoGameLevels($i, $row["games"], $row["totalTime"], 
							                                     $row["tkothTime"], $row["kills"], 0);
					break;
					case "Search and Destroy":
						$varArray["SDLevel"] = GetJoGameLevels($i, $row["games"], $row["totalTime"], 
							                                   $row["targets"], $row["score_1"], $row["score_2"]);
					break;
					case "Attack and Defend":
						$varArray["ADLevel"] = GetJoGameLevels($i, $row["games"], $row["totalTime"], 
							                                   $row["targets"], $row["score_1"], $row["score_2"]);
					break;
					case "Capture the Flag":
						$varArray["CTFLevel"] = GetJoGameLevels($i, $row["games"], $row["totalTime"], 
							                                    $row["flagCapt"], $row["flagSaves"], $row["flagDef"]);
					break;
					case "Flagball":
						$varArray["FBLevel"] = GetJoGameLevels($i, $row["games"], $row["totalTime"], 
							                                   $row["flagCapt"], $row["flagSaves"], $row["flagDef"]);
					break;
					case "Advance and Secure":
						$varArray["AASLevel"] = GetJoGameLevels($i, $row["games"], $row["totalTime"], 
							                                    $row["campTakeovers"], $row["score_1"], $row["score_2"]);
					break;
					case "Conquer and Control":
						$varArray["CACLevel"] = GetJoGameLevels($i, $row["games"], $row["totalTime"], 
							                                    $row["campTakeovers"], $row["score_1"], $row["score_2"]);
					break;
					case "Deathmatch":
						$varArray["DMLevel"] = GetJoGameLevels($i, $row["games"], $row["totalTime"], $row["kills"], 0, 0);
					break;
			} 
		}
	}
	
	$sqlArray[0]["query"]      = " SELECT *  ";
	$sqlArray[0]["tables"]     = " $last_table ";
	$sqlArray[0]["conditions"] = " WHERE player = '".$pid."' ORDER BY lastUpdate DESC LIMIT 5";
	$sqlArray[0]["type"]       = "multi";
	$sqlArray[0]["prefix"]     = "list";
	
	$sqlArray[1]["query"]      = " SELECT *  ";
	$sqlArray[1]["tables"]     = " $records_table ";
	$sqlArray[1]["conditions"] = " WHERE player = '".$pid."' ORDER BY lastUpdate";
	$sqlArray[1]["type"]       = "multi";
	$sqlArray[1]["prefix"]     = "list2";
	
	if($joTips) {
		$varArray["joTips"] = '<table id="js_menu">
						         <tr>
							       <td id="js_aboutText"><u>Tips</u></td>
						         </tr>
						         <tr>
							       <td align="left" id="js_aboutText">1. Hover over a colored bar to see more info.</td>
						  	     </tr>
								 <tr>
							       <td align="left" id="js_aboutText">2. Hover over a header name to see more info.</td>
						  	     </tr>
						       </table><br /><br />';
	}
	
	$varArray["content"] = $tpl->buildMgtTpl($varArray, $sqlArray, 2, $file, "stats");
}