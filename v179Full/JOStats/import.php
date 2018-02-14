<?php
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
// File Name     : Import Procedure                          //
// File Version  : 1.1.1 Standalone                          //
//                                                           //
/////////////////////////////////////////////////////////////*/

/*/////////////////////////////////////////////////////////////
//                                                           //
// Updated Dec 2016 By Novahq.net <scott@novahq.net>         //
// Standalone, PHP 5.6+ Compatible                           //
//                                                           //
/////////////////////////////////////////////////////////////*/

error_reporting(0);

$data = empty($_POST['data']) ? exit("Stats Uploading Failed, No Player Data Sent!") : $_POST['data'];

$data = base64_decode($data);

if(!$data) {

	echo "Stats Uploading Failed, No Data Sent!";

} else {

	require_once "mgtClass.php";
	require_once "config.php";
	require_once "functions.php";
	require_once "common.php";
	require_once "weapons.php";
	require_once "vehicles.php";
	require_once "gametypes.php";

	$_POST['bmt'] = (empty($_POST['bmt']) ? "" : $_POST['bmt']);

	MakeTableNames();

	$tpl = new mgtTemplate();
	
	$dataLines = explode("\n", $data);
	if(empty($dataLines)) exit("Stats Uploading Failed, No Player Data Sent!");

	$lineNum = count($dataLines);
	if(!$lineNum) exit("Stats Uploading Failed, No Player Data Sent!");

	$i = 0;
	$rebel = 0;
	$jo = 0;
	
	foreach($dataLines AS $line) {
		$lines[$i] = trim($line);
		$i++;
	}
	
	if($lines[2] == "") exit("Stats Uploading Failed, No Player Data Sent!");

	$gameData = substr($lines[0], 9);
	$gameArray = explode("__&__", $gameData);

	$game["timer"]    = $gameArray[0];
	$game["gameType"] = $gameArray[1];
	$game["date"]     = $gameArray[2];
	$game["hisDate"]  = date("Y-m-d");
	$game["mapname"]  = $gameArray[3];
	$game["winner"]   = $gameArray[4];
	$game["serverID"] = $gameArray[5];
	$game["mod"]      = $gameArray[6];
	
	$type             = $game["gameType"];
    $game["gameType"] = $gametypes[1][$game["gameType"]];
	
	if(GetJoServer($game["serverID"]) == 0) exit("Stats Uploading Failed, Invalid Server ID!");
	$server_id = GetJoServer($game["serverID"]);
	$serverStatsID = GetJoServerStatsID($server_id, $game["gameType"]);

	if($game["mapname"] == "") exit("Stats Uploading Failed, No Map Name Found!");
	
	$sql = $tpl->joQuery("SELECT * FROM $log_table WHERE server = '".$server_id."' AND datetime = '".$game["date"]."'", 1);
    if(mysqli_num_rows($sql) > 0) {
    	exit("Stats already imported!");
    }
	$tpl->joQuery("INSERT INTO $log_table (`server`, `datetime`) VALUES ('".$server_id."', '".$game["date"]."')", 2);
	
    $map_id = GetJoMap($game["mapname"]);
	
	$tpl->joQuery("UPDATE $maps_table SET 
					   time        = time    + '".$game["timer"]."' ,
					   hosted      = hosted  + 1                    ,
				       last_played = '".$game["date"]."'             
				   WHERE id = '".$map_id."'", 2);
	
	for($i = 1; $i < $lineNum; $i++) {
		if(!empty($lines[$i])) {
			if(substr($lines[$i], 0, 1) == "p") {
			    $player_id         = 0;
			    $player_record_id  = 0; 
			    $weapon_id         = 0;
			    $weapon_record_id  = 0; 
			    $map_record_id     = 0;
			    $vehicle_id        = 0;
			    $vehicle_record_id = 0;
				$score             = 0;
				$scorePlus         = 0;
				$scoreMinus        = 0;
				
				$playerDet = explode("__&__", substr($lines[$i], 9));
			}
			
			if(substr($lines[$i], 0, 1) == "s") {
				$player = explode("_", substr($lines[$i], 10));
				
				
				/*************************************** Gather Player ID and Player Records ID's **************************/
				$player["name"]         = base64_decode($playerDet[0]);
			    $player["team"]         = $playerDet[1];
				$player_team            = GetJoVal($_POST["bmt"]);
				$player_id              = GetJoPlayer($player["name"]);
      			$player_record_id       = GetJoPlayerRecord($player_id, $player["team"], $game["gameType"], $server_id);
				$player_m_record_id     = GetJoMPlayerRecord($player_id, $player["team"], $game["gameType"], 
				                                             $server_id, $game["date"]);
				$map_record_id          = GetJoMapRecord($map_id, $player_record_id);
				$map_m_record_id        = GetJoMMapRecord($map_id, $player_record_id);
				$player_lastStatsID     = GetJoLastStatsID($player_id, $map_id, $game["date"]);
				$player_recordID        = GetJoPlyrRecord($player_id, $game["gameType"]);
				/*************************************** Gather Player ID and Player Records ID's **************************/
				
				
				$serverHistoryID = GetJoServerHistoryID($server_id, $player["name"], $game["date"]);
				
				if($game["gameType"] != "Deathmatch") {
					if($game["winner"] == 1) $jo    = 1;
					if($game["winner"] == 2) $rebel = 1;
				}
					
					
				/*************************************** Calcualte Games/Wins/Draws Stats **************************/
				$player["num_games"] = 0;
				$player["num_wins"]  = 0;
				$player["num_draws"] = 0;
				
				if($game["gameType"] != "Deathmatch") {
					$player["num_games"] = 1;
					if($game["winner"] == $player["team"] && $player["team"] != 0) {
						$player["num_wins"] = 1;
					} elseif($game["winner"] == 0) {
						$player["num_draws"] = 1;
					}
				} else {
					$player["num_games"] = 1;
					$ttlpts = ($player[3] + $player[14]) - ($player[5]/5);
					$tpl->joQuery("UPDATE $players_table SET dm_value = dm_value + '".$ttlpts."' 
						           WHERE id = '".$player_id."'", 2);
				}
				/*************************************** Calcualte Games/Wins/Draws Stats **************************/
				
				
				/*************************************** Add Player Stats **************************/
				$tpl->joQuery("UPDATE $stats_table SET
								   shotsfired    = shotsfired    + '".$player[0]."'           , 
								   timesHit      = timesHit      + '".$player[1]."'           , 
								   murders       = murders       + '".$player[2]."'           , 
								   kills         = kills         + '".$player[3]."'           , 
								   suicides      = suicides      + '".$player[4]."'           , 
								   deaths        = deaths        + '".$player[5]."'           , 
								   medHeal       = medHeal       + '".$player[6]."'           , 
								   medSave       = medSave       + '".$player[7]."'           , 
								   revived       = revived       + '".$player[8]."'           , 
								   flagSaves     = flagSaves     + '".$player[9]."'           , 
								   flagCapt      = flagCapt      + '".$player[10]."'          , 
								   flagPick      = flagPick      + '".$player[11]."'          , 
								   targets       = targets       + '".$player[12]."'          , 
								   pspTakeovers  = pspTakeovers  + '".$player[13]."'          , 
								   headshots     = headshots     + '".$player[14]."'          , 
								   knifings      = knifings      + '".$player[15]."'          , 
								   flagCarr      = flagCarr      + '".$player[16]."'          , 
								   score_1       = score_1       + '".$player[17]."'          , 
								   score_2       = score_2       + '".$player[18]."'          , 
								   zoneAtt       = zoneAtt       + '".$player[19]."'          , 
								   zoneDef       = zoneDef       + '".$player[20]."'          , 
								   assists       = assists       + '".$player[21]."'          , 
								   exp           = exp           + '".$player[22]."'          , 
								   tkothTime     = tkothTime     + '".$player[23]."'          , 
								   neutralTime   = neutralTime   + '".$player[24]."'          , 
								   homeTime      = homeTime      + '".$player[25]."'          , 
								   zoneHits      = zoneHits      + '".$player[26]."'          , 
								   campTakeovers = campTakeovers + '".$player[27]."'          , 
								   totalTime     = totalTime     + '".$player[28]."'          , 
								   medAttempts   = medAttempts   + '".$player[29]."'          , 
								   sniperkills   = sniperkills   + '".$player[30]."'          , 
								   multiKills    = multiKills    + '".$player[31]."'          , 
								   games         = games         + '".$player["num_games"]."' ,
								   wins          = wins          + '".$player["num_wins"]."'  ,
								   draws         = draws         + '".$player["num_draws"]."' ,
								   last_played   = '".$game["date"]."' 
							   WHERE id='".$player_record_id."'", 2);
							   
				$tpl->joQuery("UPDATE $stats_m_table SET
								   shotsfired    = shotsfired    + '".$player[0]."'           , 
								   timesHit      = timesHit      + '".$player[1]."'           , 
								   murders       = murders       + '".$player[2]."'           , 
								   kills         = kills         + '".$player[3]."'           , 
								   suicides      = suicides      + '".$player[4]."'           , 
								   deaths        = deaths        + '".$player[5]."'           , 
								   medHeal       = medHeal       + '".$player[6]."'           , 
								   medSave       = medSave       + '".$player[7]."'           , 
								   revived       = revived       + '".$player[8]."'           , 
								   flagSaves     = flagSaves     + '".$player[9]."'           , 
								   flagCapt      = flagCapt      + '".$player[10]."'          , 
								   flagPick      = flagPick      + '".$player[11]."'          , 
								   targets       = targets       + '".$player[12]."'          , 
								   pspTakeovers  = pspTakeovers  + '".$player[13]."'          , 
								   headshots     = headshots     + '".$player[14]."'          , 
								   knifings      = knifings      + '".$player[15]."'          , 
								   flagCarr      = flagCarr      + '".$player[16]."'          , 
								   score_1       = score_1       + '".$player[17]."'          , 
								   score_2       = score_2       + '".$player[18]."'          , 
								   zoneAtt       = zoneAtt       + '".$player[19]."'          , 
								   zoneDef       = zoneDef       + '".$player[20]."'          , 
								   assists       = assists       + '".$player[21]."'          , 
								   exp           = exp           + '".$player[22]."'          , 
								   tkothTime     = tkothTime     + '".$player[23]."'          , 
								   neutralTime   = neutralTime   + '".$player[24]."'          , 
								   homeTime      = homeTime      + '".$player[25]."'          , 
								   zoneHits      = zoneHits      + '".$player[26]."'          , 
								   campTakeovers = campTakeovers + '".$player[27]."'          , 
								   totalTime     = totalTime     + '".$player[28]."'          , 
								   medAttempts   = medAttempts   + '".$player[29]."'          , 
								   sniperkills   = sniperkills   + '".$player[30]."'          , 
								   multiKills    = multiKills    + '".$player[31]."'          , 
								   games         = games         + '".$player["num_games"]."' ,
								   wins          = wins          + '".$player["num_wins"]."'  ,
								   draws         = draws         + '".$player["num_draws"]."' ,
								   last_played   = '".$game["date"]."' 
							   WHERE id='".$player_m_record_id."'", 2);
				/*************************************** Add Player Stats **************************/
				
				$sql = $tpl->joQuery("SELECT * FROM $awards_table WHERE type = '1'", 1);
				while($row = mysqli_fetch_assoc($sql)) {
					$sql2 = $tpl->joQuery("SELECT SUM(".$row["stat"].") AS ".$row["stat"]." 
					                       FROM $stats_table WHERE player = '".$player_id."' 
										   GROUP BY player", 1);
					$row2 = mysqli_fetch_assoc($sql2);
					if($row2[$row["stat"]] >= $row["value"]) {
						$sql3 = $tpl->joQuery("SELECT * FROM $playerawards_table WHERE player = '".$player_id."' 
						                            AND award = '".$row["name"]."'", 2);
						if(!@mysqli_num_rows($sql3)) {
							$tpl->joQuery("INSERT INTO $playerawards_table (`player`, `award`, `date`) VALUES 
							               ('".$player_id."', '".$row["name"]."', '".$game["hisDate"]."')", 2);
							$tpl->joQuery("UPDATE $awards_table SET gained = gained + 1 
							               WHERE id = '".$row["id"]."'", 2);
						} 
					}
				}
				
				/*************************************** Add Last Game Stats **************************/
				$tpl->joQuery("UPDATE $last_table SET
								   kills         = kills         + '".$player[3]."'  ,
								   deaths        = deaths        + '".$player[5]."'  ,
								   medSave       = medSave       + '".$player[7]."'  ,
								   headshots     = headshots     + '".$player[14]."' ,
								   knifings      = knifings      + '".$player[15]."' ,
								   multiKills    = multiKills    + '".$player[31]."' ,
								   assists       = assists       + '".$player[21]."' ,
								   exp           = exp           + '".$player[22]."' ,
								   totalTime     = totalTime     + '".$player[28]."' ,
								   game_type     = '".$game["gameType"]."'           ,
								   lastUpdate    = '".$game["date"]."'
							   WHERE id = '".$player_lastStatsID."'", 2);
				/*************************************** Add Last Game Stats **************************/
				
				
				/*************************************** Add Mapstats **************************/		 
				$tpl->joQuery("UPDATE $mapstats_table SET 
								   murders       = murders       + '".$player[2]."'           ,
								   kills         = kills         + '".$player[3]."'           , 
								   suicides      = suicides      + '".$player[4]."'           , 
								   deaths        = deaths        + '".$player[5]."'           , 
								   headshots     = headshots     + '".$player[14]."'          , 
								   sniperkills   = sniperkills   + '".$player[30]."'          ,
								   knifings      = knifings      + '".$player[15]."'          , 
								   multiKills    = multiKills    + '".$player[31]."'          , 
								   assists       = assists       + '".$player[21]."'          ,  
								   totalTime     = totalTime     + '".$player[28]."'          ,  
								   games         = games         + '".$player["num_games"]."' ,
								   wins          = wins          + '".$player["num_wins"]."'  ,
								   draws         = draws         + '".$player["num_draws"]."' ,
								   lastPlayed    = '".$game["date"]."' 
							   WHERE id = '".$map_record_id."'", 2);
							   
				$tpl->joQuery("UPDATE $mapstats_m_table SET 
								   murders       = murders       + '".$player[2]."'           ,
								   kills         = kills         + '".$player[3]."'           , 
								   suicides      = suicides      + '".$player[4]."'           , 
								   deaths        = deaths        + '".$player[5]."'           , 
								   headshots     = headshots     + '".$player[14]."'          , 
								   sniperkills   = sniperkills   + '".$player[30]."'          ,
								   knifings      = knifings      + '".$player[15]."'          , 
								   multiKills    = multiKills    + '".$player[31]."'          , 
								   assists       = assists       + '".$player[21]."'          ,  
								   totalTime     = totalTime     + '".$player[28]."'          ,  
								   games         = games         + '".$player["num_games"]."' ,
								   wins          = wins          + '".$player["num_wins"]."'  ,
								   draws         = draws         + '".$player["num_draws"]."' ,
								   lastPlayed    = '".$game["date"]."' 
							   WHERE id = '".$map_m_record_id."'", 2);
				/*************************************** Add Mapstats **************************/
				
							   
				$sql = $tpl->joQuery("SELECT 
								          MAX(hiScore)     , 
										  MAX(mostKills)   , 
										  MAX(hiRatio)     
									  FROM $mapstats_table WHERE id = '".$map_record_id."'", 1);
				$row = mysqli_fetch_assoc($sql);
				$row = array_merge($row, array("hiScore" => "", "mostKills" => "", "hiRatio" => ""));
				if($player[22] > $row["hiScore"]) 
					$tpl->joQuery("UPDATE $mapstats_table SET hiScore = '".$player[22]."' 
					               WHERE id = '".$map_record_id."'", 2);
				if($player[3] > $row["mostKills"]) 
					$tpl->joQuery("UPDATE $mapstats_table SET mostKills = '".$player[3]."' 
					               WHERE id = '".$map_record_id."'", 2);
				if($player[5] == 0) {$dths = 1;} else {$dths = $player[5];}
				$newRatio = $player[3]/$dths;
				if($newRatio > $row["hiRatio"]) 
					$tpl->joQuery("UPDATE $mapstats_table SET hiRatio = '".$newRatio."' 
					               WHERE id = '".$map_record_id."'", 2);
								   
				$sql = $tpl->joQuery("SELECT 
								          MAX(hiScore)     , 
										  MAX(mostKills)   , 
										  MAX(hiRatio)     
									  FROM $mapstats_m_table WHERE id = '".$map_m_record_id."'", 1);
				$row = mysqli_fetch_assoc($sql);
				$row = array_merge($row, array("hiScore" => "", "mostKills" => "", "hiRatio" => ""));
				if($player[22] > $row["hiScore"]) 
					$tpl->joQuery("UPDATE $mapstats_m_table SET hiScore = '".$player[22]."' 
					               WHERE id = '".$map_m_record_id."'", 2);
				if($player[3] > $row["mostKills"]) 
					$tpl->joQuery("UPDATE $mapstats_m_table SET mostKills = '".$player[3]."' 
					               WHERE id = '".$map_m_record_id."'", 2);
				if($player[5] == 0) {$dths = 1;} else {$dths = $player[5];}
				$newRatio = $player[3]/$dths;
				if($newRatio > $row["hiRatio"]) 
					$tpl->joQuery("UPDATE $mapstats_m_table SET hiRatio = '".$newRatio."' 
					               WHERE id = '".$map_m_record_id."'", 2);
				/**************************************** Calculate Rating Points for Stats ***************************/
				$scoresArray = array();			
				$sql = $tpl->joQuery("SELECT * FROM $rating_table WHERE s_type = 'gameBonus'", 1);
				while($row = mysqli_fetch_assoc($sql)) {
					$scoresArray[$row["s_stat"]] = $row["s_pts"];
				}
				$scorePlus += $player[3]          * @$scoresArray["kills"]              ;
				$scorePlus += $player[6]          * @$scoresArray["medHeal"]            ;
				$scorePlus += $player[7]          * @$scoresArray["medSave"]            ;
				$scorePlus += $player[9]          * @$scoresArray["flagSaves"]          ;
				$scorePlus += $player[10]         * @$scoresArray["flagCapt"]           ;
				$scorePlus += $player[11]         * @$scoresArray["flagPick"]           ;
				$scorePlus += $player[12]         * @$scoresArray["targets"]            ;
				$scorePlus += $player[14]         * @$scoresArray["headshots"]          ;
				$scorePlus += $player[31]         * @$scoresArray["multiKills"]         ;
				$scorePlus += $player[16]         * @$scoresArray["flagCarr"]           ;
				$scorePlus += $player[17]         * @$scoresArray["score_1"]            ;
				$scorePlus += $player[18]         * @$scoresArray["score_2"]            ;
				$scorePlus += $player[19]         * @$scoresArray["zoneAtt"]            ;
				$scorePlus += $player[20]         * @$scoresArray["zoneDef"]            ;
				$scorePlus += $player[21]         * @$scoresArray["assists"]            ;
				$scorePlus += ($player[23]/60)    * @$scoresArray["tkothTime"]          ;
				$scorePlus += ($player[24]/60)    * @$scoresArray["neutralTime"]        ;
				$scorePlus += $player[27]         * @$scoresArray["campTakeovers"]      ;
				$scorePlus += $player[13]         * @$scoresArray["pspTakeovers"]       ;
				$scorePlus += $player["num_wins"] * @$scoresArray["wins"]               ;
				
				$scoresArray = array();
				$sql = $tpl->joQuery("SELECT * FROM $rating_table WHERE s_type = 'gamePenalty'", 1);
				while($row = mysqli_fetch_assoc($sql)) {
					$scoresArray[$row["s_stat"]] = $row["s_pts"];
				}
				$scoreMinus += $player[1] * @$scoresArray["timesHit"] ;
				$scoreMinus += $player[2] * @$scoresArray["murders"]  ;
				$scoreMinus += $player[4] * @$scoresArray["suicides"] ;
				$scoreMinus += $player[5] * @$scoresArray["deaths"]   ;
				
				$score = $scorePlus - $scoreMinus;
				$tpl->joQuery("UPDATE $stats_table SET grating = grating + '".$score."' WHERE id = '".$player_record_id."'", 2);
				$tpl->joQuery("UPDATE $stats_m_table SET grating = grating + '".$score."' WHERE id = '".$player_m_record_id."'", 2);
				$tpl->joQuery("UPDATE $players_table SET rating = rating + '".floor($score)."', 
				                      m_rating = m_rating + '".floor($score)."' WHERE id = '".$player_id."'", 2);
				$tpl->joQuery("UPDATE $last_table SET rating = rating + '".$score."'
							 WHERE id = '".$player_lastStatsID."'", 2);
				/**************************************** Calculate Rating Points for Stats ***************************/
				
				
				$tmValue[$player_record_id] = $player["team"] ;
				@$dmValue[$player_record_id] += $player[22];
				
						 
				/**************************************** win/lose streaks ***************************/
				$streakRes = 0;
				if($player["num_draws"] == 0) $streakRes = 0;
				if($player["num_wins"]  == 1) $streakRes = 1;
				if($player["num_wins"]  == 0 && $player["num_draws"] == 0 ) $streakRes = 2;
				$sql = $tpl->joQuery("SELECT * FROM $records_table WHERE id = '".$player_recordID."'", 1);
				$row = mysqli_fetch_assoc($sql);
				if($game["date"] > $row["lastUpdate"]) {
					if($row["lastStreak"] == 0) {
						switch($streakRes) {
							case 1: 
								$tpl->joQuery("UPDATE $records_table SET lastStreak = '1', wStreak = wStreak + 1 
																   WHERE id = '".$player_recordID."'", 2); 
							break;
							case 2: 
								$tpl->joQuery("UPDATE $records_table SET lastStreak = '2', lStreak = lStreak + 1 
																   WHERE id = '".$player_recordID."'", 2); 
							break;
						}
					}
					if($row["lastStreak"] == 1) {
						$hiWin = 0;
						switch($streakRes) {
							case 0: 
								$hiWin = $row["wStreak"];
								$tpl->joQuery("UPDATE $records_table SET lastStreak = '0', wStreak = '0' 
																   WHERE id = '".$player_recordID."'", 2); 
							break;
							case 1: 
								$tpl->joQuery("UPDATE $records_table SET wStreak = wStreak + 1 
								                                   WHERE id = '".$player_recordID."'", 2); 
							break;
							case 2: 
								$hiWin = $row["wStreak"];
								$tpl->joQuery("UPDATE $records_table SET lastStreak = '2', wStreak = '0', 
															   lStreak = lStreak + 1 WHERE id = '".$player_recordID."'", 2); 
							break;
						}
						if($hiWin > '0' && $hiWin > $row["hiWStreak"]) 
							$tpl->joQuery("UPDATE $records_table SET 
							                               hiWStreak = '".$hiWin."' WHERE id = '".$player_recordID."'", 2);
						}
						if($row["lastStreak"] == 2) {
						$hiLose = 0;
						switch($streakRes) {
							case 0: 
								$hiLose = $row["lStreak"];
								$tpl->joQuery("UPDATE $records_table SET lastStreak = 0, lStreak = 0 
															   WHERE id = '".$player_recordID."'", 2); 
							break;
							case 1: 
								$hiLose = $row["lStreak"];
								$tpl->joQuery("UPDATE $records_table SET lastStreak = 1, lStreak = 0, 
															  wStreak = wStreak + 1 WHERE id = '".$player_recordID."'", 2);  
							break;
							case 2: 
								$tpl->joQuery("UPDATE $records_table SET lStreak = lStreak + 1 
								                                   WHERE id = '".$player_recordID."'", 2); 
							break;
						}
						if($hiLose > '0' && $hiLose > $row["hiLStreack"]) 
							$tpl->joQuery("UPDATE $records_table SET hiLStreak = '".$hiLose."' 
							                                    WHERE id = '".$player_recordID."'", 2);
					}
					$tpl->joQuery("UPDATE $records_table SET lastUpdate = '".$game["date"]."' 
					                                   WHERE id = '".$player_recordID."'", 2);
				}
				/**************************************** win/lose streaks ***************************/
				
				@$scSarray[$player_id]  = $player_lastStatsID ;
				@$scIarray[$player_id] += $player[22]         ;
				@$flTime[$player_id]   += $player[28]         ;
				@$flKlls[$player_id]   += $player[3]          ;
				@$flDths[$player_id]   += $player[5]          ;
				@$flMapS[$player_id]    = $map_record_id      ;
			}
			
			
			if(substr($lines[$i], 0, 1) == "w") {
				$weapon = explode("_", substr($lines[$i], 8));
				
				if(!in_array(base64_decode($weapon[35]), $wpn_no_kills)) {
					/*************************************** Gather Weapon ID and Player ID **************************/
					$weapon["name"]         = base64_decode($weapon[35]);
					
					if(!empty($weapon["name"]) || $weapon["name"] != "") {
						$weapon_id              = GetJoWeapon($weapon["name"]);
						$weapon_record_id       = GetJoWeaponRecord($weapon_id, $player_record_id);
						$weapon_m_record_id     = GetJoMWeaponRecord($weapon_id, $player_record_id);
						/*************************************** Gather Weapon ID and Player ID **************************/
						
						if($weapon["name"] == "M9 Bayonet") {
							$tpl->joQuery("UPDATE $stats_table SET
											   knifings      = knifings      + '".$weapon[15]."' 
										   WHERE id='".$player_record_id."'", 2);
										   
							$tpl->joQuery("UPDATE $stats_m_table SET
											   knifings      = knifings      + '".$weapon[15]."' 
										   WHERE id='".$player_m_record_id."'", 2);
						}
						
						/*************************************** Add Weaponstats **************************/
						$tpl->joQuery("UPDATE $weaponstats_table SET 
										  shotsfired    = shotsfired    + '".$weapon[0]."'  , 
										  timesHit      = timesHit      + '".$weapon[1]."'  , 
										  murders       = murders       + '".$weapon[2]."'  , 
										  kills         = kills         + '".$weapon[3]."'  , 
										  suicides      = suicides      + '".$weapon[4]."'  , 
										  deaths        = deaths        + '".$weapon[5]."'  , 
										  medHeal       = medHeal       + '".$weapon[6]."'  , 
										  medSave       = medSave       + '".$weapon[7]."'  , 
										  revived       = revived       + '".$weapon[8]."'  , 
										  flagSaves     = flagSaves     + '".$weapon[9]."'  , 
										  flagCapt      = flagCapt      + '".$weapon[10]."' , 
										  flagPick      = flagPick      + '".$weapon[11]."' , 
										  targets       = targets       + '".$weapon[12]."' , 
										  pspTakeovers  = pspTakeovers  + '".$weapon[13]."' , 
										  headshots     = headshots     + '".$weapon[14]."' , 
										  knifings      = knifings      + '".$weapon[15]."' , 
										  flagCarr      = flagCarr      + '".$weapon[16]."' , 
										  score_1       = score_1       + '".$weapon[17]."' , 
										  score_2       = score_2       + '".$weapon[18]."' , 
										  zoneAtt       = zoneAtt       + '".$weapon[19]."' , 
										  zoneDef       = zoneDef       + '".$weapon[20]."' , 
										  assists       = assists       + '".$weapon[21]."' , 
										  exp           = exp           + '".$weapon[22]."' , 
										  tkothTime     = tkothTime     + '".$weapon[23]."' , 
										  neutralTime   = neutralTime   + '".$weapon[24]."' , 
										  homeTime      = homeTime      + '".$weapon[25]."' , 
										  zoneHits      = zoneHits      + '".$weapon[26]."' , 
										  campTakeovers = campTakeovers + '".$weapon[27]."' , 
										  totalTime     = totalTime     + '".$weapon[28]."' , 
										  medAttempts   = medAttempts   + '".$weapon[29]."' , 
										  sniperkills   = sniperkills   + '".$weapon[30]."' , 
										  multiKills    = multiKills    + '".$weapon[31]."' 
									  WHERE id='".$weapon_record_id."'", 2);
									  
						$tpl->joQuery("UPDATE $weaponstats_m_table SET 
										  shotsfired    = shotsfired    + '".$weapon[0]."'  , 
										  timesHit      = timesHit      + '".$weapon[1]."'  , 
										  murders       = murders       + '".$weapon[2]."'  , 
										  kills         = kills         + '".$weapon[3]."'  , 
										  suicides      = suicides      + '".$weapon[4]."'  , 
										  deaths        = deaths        + '".$weapon[5]."'  , 
										  medHeal       = medHeal       + '".$weapon[6]."'  , 
										  medSave       = medSave       + '".$weapon[7]."'  , 
										  revived       = revived       + '".$weapon[8]."'  , 
										  flagSaves     = flagSaves     + '".$weapon[9]."'  , 
										  flagCapt      = flagCapt      + '".$weapon[10]."' , 
										  flagPick      = flagPick      + '".$weapon[11]."' , 
										  targets       = targets       + '".$weapon[12]."' , 
										  pspTakeovers  = pspTakeovers  + '".$weapon[13]."' , 
										  headshots     = headshots     + '".$weapon[14]."' , 
										  knifings      = knifings      + '".$weapon[15]."' , 
										  flagCarr      = flagCarr      + '".$weapon[16]."' , 
										  score_1       = score_1       + '".$weapon[17]."' , 
										  score_2       = score_2       + '".$weapon[18]."' , 
										  zoneAtt       = zoneAtt       + '".$weapon[19]."' , 
										  zoneDef       = zoneDef       + '".$weapon[20]."' , 
										  assists       = assists       + '".$weapon[21]."' , 
										  exp           = exp           + '".$weapon[22]."' , 
										  tkothTime     = tkothTime     + '".$weapon[23]."' , 
										  neutralTime   = neutralTime   + '".$weapon[24]."' , 
										  homeTime      = homeTime      + '".$weapon[25]."' , 
										  zoneHits      = zoneHits      + '".$weapon[26]."' , 
										  campTakeovers = campTakeovers + '".$weapon[27]."' , 
										  totalTime     = totalTime     + '".$weapon[28]."' , 
										  medAttempts   = medAttempts   + '".$weapon[29]."' , 
										  sniperkills   = sniperkills   + '".$weapon[30]."' , 
										  multiKills    = multiKills    + '".$weapon[31]."' 
									  WHERE id='".$weapon_m_record_id."'", 2);
						/*************************************** Add Weaponstats **************************/
						
						/*************************************** Calculate Rating Points for Weapons **************************/		
						$scorePlus = 0;
						$sql = $tpl->joQuery("SELECT * FROM $rating_table WHERE s_type = 'wpnBonus' 
																		  AND s_name = '".$weapon["name"]."'", 1);
						$row = mysqli_fetch_assoc($sql);
						$scorePlus += $weapon[4]  * $row["s_pts"] ;
						$scorePlus += $weapon[32] * $row["s_pts2"];
						$tpl->joQuery("UPDATE $stats_table SET grating = grating + '".$scorePlus."' 
									   WHERE id = '".$player_record_id."'", 2);
						$tpl->joQuery("UPDATE $stats_m_table SET grating = grating + '".$scorePlus."' 
									   WHERE id = '".$player_m_record_id."'", 2);
						$tpl->joQuery("UPDATE $players_table SET rating = rating + '".floor($scorePlus)."', 
											   m_rating = m_rating + '".floor($scorePlus)."' WHERE id = '".$player_id."'", 2);
						$tpl->joQuery("UPDATE $last_table SET rating = rating + '".$scorePlus."' 
									   WHERE id = '".$player_lastStatsID."'", 2);
						/*************************************** Calculate Rating Points for Weapons **************************/ 
					}
				}
			}
			
			if(substr($lines[$i], 0, 1) == "v") {
				$vehicle = explode("_", substr($lines[$i], 8));
				$vehicle["name"]         = trim(str_replace("Drivable", "", base64_decode($vehicle[35])));
				$vehicle["name"]         = trim(str_replace("Flyable", "", $vehicle["name"]));

				if(!empty($vehicle["name"]) || $vehicle["name"] != "") {
					$vehicle_id              = GetJoVehicle($vehicle["name"]);
					$vehicle_record_id       = GetJoVehicleRecord($vehicle_id, $player_record_id, $vehicle[36]);
					$vehicle_m_record_id     = GetJoMVehicleRecord($vehicle_id, $player_record_id, $vehicle[36]);
					
					$tpl->joQuery("UPDATE $vehiclestats_table SET 
									  shotsfired    = shotsfired    + '".$vehicle[0]."'  , 
									  timesHit      = timesHit      + '".$vehicle[1]."'  , 
									  murders       = murders       + '".$vehicle[2]."'  , 
									  kills         = kills         + '".$vehicle[3]."'  , 
									  suicides      = suicides      + '".$vehicle[4]."'  , 
									  deaths        = deaths        + '".$vehicle[5]."'  , 
									  medHeal       = medHeal       + '".$vehicle[6]."'  , 
									  medSave       = medSave       + '".$vehicle[7]."'  , 
									  revived       = revived       + '".$vehicle[8]."'  , 
									  flagSaves     = flagSaves     + '".$vehicle[9]."'  , 
									  flagCapt      = flagCapt      + '".$vehicle[10]."' , 
									  flagPick      = flagPick      + '".$vehicle[11]."' , 
									  targets       = targets       + '".$vehicle[12]."' , 
									  pspTakeovers  = pspTakeovers  + '".$vehicle[13]."' , 
									  headshots     = headshots     + '".$vehicle[14]."' , 
									  knifings      = knifings      + '".$vehicle[15]."' , 
									  flagCarr      = flagCarr      + '".$vehicle[16]."' , 
									  score_1       = score_1       + '".$vehicle[17]."' , 
									  score_2       = score_2       + '".$vehicle[18]."' , 
									  zoneAtt       = zoneAtt       + '".$vehicle[19]."' , 
									  zoneDef       = zoneDef       + '".$vehicle[20]."' , 
									  assists       = assists       + '".$vehicle[21]."' , 
									  exp           = exp           + '".$vehicle[22]."' , 
									  tkothTime     = tkothTime     + '".$vehicle[23]."' , 
									  neutralTime   = neutralTime   + '".$vehicle[24]."' , 
									  homeTime      = homeTime      + '".$vehicle[25]."' , 
									  zoneHits      = zoneHits      + '".$vehicle[26]."' , 
									  campTakeovers = campTakeovers + '".$vehicle[27]."' , 
									  totalTime     = totalTime     + '".$vehicle[28]."' , 
									  medAttempts   = medAttempts   + '".$vehicle[29]."' , 
									  sniperkills   = sniperkills   + '".$vehicle[30]."' , 
									  multiKills    = multiKills    + '".$vehicle[31]."' 
								WHERE id='".$vehicle_record_id."'", 2);
								
					$tpl->joQuery("UPDATE $vehiclestats_m_table SET 
									  shotsfired    = shotsfired    + '".$vehicle[0]."'  , 
									  timesHit      = timesHit      + '".$vehicle[1]."'  , 
									  murders       = murders       + '".$vehicle[2]."'  , 
									  kills         = kills         + '".$vehicle[3]."'  , 
									  suicides      = suicides      + '".$vehicle[4]."'  , 
									  deaths        = deaths        + '".$vehicle[5]."'  , 
									  medHeal       = medHeal       + '".$vehicle[6]."'  , 
									  medSave       = medSave       + '".$vehicle[7]."'  , 
									  revived       = revived       + '".$vehicle[8]."'  , 
									  flagSaves     = flagSaves     + '".$vehicle[9]."'  , 
									  flagCapt      = flagCapt      + '".$vehicle[10]."' , 
									  flagPick      = flagPick      + '".$vehicle[11]."' , 
									  targets       = targets       + '".$vehicle[12]."' , 
									  pspTakeovers  = pspTakeovers  + '".$vehicle[13]."' , 
									  headshots     = headshots     + '".$vehicle[14]."' , 
									  knifings      = knifings      + '".$vehicle[15]."' , 
									  flagCarr      = flagCarr      + '".$vehicle[16]."' , 
									  score_1       = score_1       + '".$vehicle[17]."' , 
									  score_2       = score_2       + '".$vehicle[18]."' , 
									  zoneAtt       = zoneAtt       + '".$vehicle[19]."' , 
									  zoneDef       = zoneDef       + '".$vehicle[20]."' , 
									  assists       = assists       + '".$vehicle[21]."' , 
									  exp           = exp           + '".$vehicle[22]."' , 
									  tkothTime     = tkothTime     + '".$vehicle[23]."' , 
									  neutralTime   = neutralTime   + '".$vehicle[24]."' , 
									  homeTime      = homeTime      + '".$vehicle[25]."' , 
									  zoneHits      = zoneHits      + '".$vehicle[26]."' , 
									  campTakeovers = campTakeovers + '".$vehicle[27]."' , 
									  totalTime     = totalTime     + '".$vehicle[28]."' , 
									  medAttempts   = medAttempts   + '".$vehicle[29]."' , 
									  sniperkills   = sniperkills   + '".$vehicle[30]."' , 
									  multiKills    = multiKills    + '".$vehicle[31]."' 
								WHERE id='".$vehicle_m_record_id."'", 2);
				}				
			}
		}
	}
	
	
	/*************************************** Calculate Last Match finishing posistion **************************/
	arsort($scIarray);
	$sc = 1;
	foreach($scIarray as $plySid => $expValue) {
		$tpl->joQuery("UPDATE $last_table SET finished = '".$sc."' WHERE id = '".$scSarray[$plySid]."'", 2);
		$sc = $sc + 1;
	}
	/*************************************** Calculate Last Match finishing posistion **************************/
	
	
	/*************************************** Determine if anyone got a flawless **************************/
	foreach($flTime as $plyr => $time) {
		$diff = ($time/$gameArray[0])*100;
		if($flDths[$plyr] == 0 && $flKlls[$plyr] > 10 && $diff > 25) {
			$tpl->joQuery("UPDATE $mapstats_table SET flawless = flawless + 1 WHERE id = '".$flMapS[$plyr]."'", 2);
			$tpl->joQuery("UPDATE $mapstats_m_table SET flawless = flawless + 1 WHERE id = '".$flMapS[$plyr]."'", 2);
		}
	}
	/*************************************** Determine if anyone got a flawless **************************/
	
	
	/*************************************** Calculate Deathmatch win/draw/lose **************************/
	if($game["gameType"] == "Deathmatch") {
		$expNum   = -1;
		$cDraw    = 0;
		$pCount   = 0;
		$mChk     = 0;
		foreach($dmValue as $pid => $exp) {
			if($exp > $expNum) {
				$expNum = $exp;
				$idNum[0] = $pid;
			} elseif($pCount > 0 && $exp == $expNum) {
				$cDraw = 1;
				$idNum[$pCount] = $pid;
			}
			$pCount ++;
		}

		sort($idNum);
		
		if($cDraw == 0) {
			$tpl->joQuery("UPDATE $stats_table SET wins = wins + 1 WHERE id = '".$idNum[0]."'", 2);
			$tpl->joQuery("UPDATE $stats_m_table SET wins = wins + 1 WHERE id = '".$idNum[0]."'", 2);
		}
	}
	
	$tpl->joQuery("UPDATE $players_table SET dm_value = '0'", 2);
	/*************************************** Calculate Deathmatch win/draw/lose **************************/
	
	
	$tpl->joQuery("UPDATE $maps_table SET
				       games      = games      + 1                      ,
					   rebel      = rebel      + '".$rebel."'           ,
					   jo         = jo         + '".$jo."'              ,
					   totalTime  = totalTime  + '".$game["timer"]."'   ,
					   lastPlayed = '".$game["date"]."' 
				   WHERE id = '".$map_id."'", 2);
	
	$tpl->joQuery("UPDATE $serverstats_table SET 
				       games = games + '1'                  , 
					   jo    = jo    + '".$jo."'            ,
					   rebel = rebel + '".$rebel."'         , 
					   time  = time  + '".$game["timer"]."'
				   WHERE id = '".$serverStatsID."'", 2);
	
	$sql = $tpl->joQuery("SELECT COUNT(players) as count, date FROM $serverhistory_table WHERE serverid = '".$server_id."' 
	                      AND players = '0' AND date < '".$game["hisDate"]."' GROUP BY date", 1);
	if(mysqli_num_rows($sql) > 0) {
		while($row = mysqli_fetch_assoc($sql)) {
			$tpl->joQuery("INSERT INTO $serverhistory_table (`serverid`, `players`, `name`, `date`) 
			               VALUES ('".$server_id."', '".$row["count"]."', '', '".$row["date"]."')", 2);
			$tpl->joQuery("DELETE FROM $serverhistory_table WHERE serverid = '".$server_id."' AND players = '0' 
												            AND date = '".$row["date"]."'", 2);
		}
	}
	
	echo "Stats Uploaded Successfully";
}