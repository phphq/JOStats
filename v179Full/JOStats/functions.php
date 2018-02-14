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
// File Name     : Functions Include                         //
// File Version  : 1.0.5 Standalone                          //
//                                                           //
/////////////////////////////////////////////////////////////*/

/*/////////////////////////////////////////////////////////////
//                                                           //
// Updated Dec 2016 By Novahq.net <scott@novahq.net>         //
// Standalone, PHP 5.6+ Compatible                           //
//                                                           //
/////////////////////////////////////////////////////////////*/

//alpha num space dash underscore period unicode ci
function cMioD4($str) {
  return preg_replace('/[^\w-.\s]+/iu', '', $str);
}

//alpha num underscore unicode ci
function aGlod3($str) {
  return preg_replace('/[^\w]+/iu', '', $str);
}

function ajZfDd3($str) {
  return preg_replace('/[^A-Za-z0-9]/', '', $str);
}

function dfyu56d($str) {
  return preg_replace('/[^0-9]/', '', $str);
}

function xdJ86bd($str) {
  return preg_replace('/[^A-Za-z]+/', '', $str);
}


function joWriteable($folder) {
  if(!is_writeable($folder)) exit($folder." is not writeable. Please change the permissions!");
}

function joValidImage($file) {

  if(!is_file($file)) return false;

  $img = @getImageSize($file);

  if(!$img) return false;

  switch ($img['mime']) {
    case 'image/gif': return true; break;
    case 'image/jpeg': return true; break;
    case 'image/jpg': return true; break;
    case 'image/png': return true; break;
    default: return false;
  }

}

function GetJoServer($id) {
  global $servers_table, $tpl;
  $sql = $tpl->joQuery("SELECT * FROM $servers_table WHERE serverid = '".$id."'", 1);
  $res = mysqli_fetch_assoc($sql);
	if(mysqli_num_rows($sql) == 0) {
		$res["id"] = 0;
		return $res["id"];
	} else {
		return $res["id"];
	}
}

function GetJoServerStatsID($server_id, $game_type) {
	global $serverstats_table, $tpl;
	$sql = $tpl->joQuery("SELECT * FROM $serverstats_table WHERE serverid = '".$server_id."' 
	                                                       AND game_type = '".$tpl->joEscape($game_type)."'", 1);
	if(mysqli_num_rows($sql) == 0) {
		$tpl->joQuery("INSERT INTO $serverstats_table (`serverid`, `game_type`, `games`, `jo`, `rebel`, `time`) 
		                                               VALUES ('".$server_id."', '".$game_type."', '0', '0', '0', '0')", 2);
	}
	$sql = $tpl->joQuery("SELECT * FROM $serverstats_table WHERE serverid = '".$server_id."' 
		                                                       AND game_type = '".$tpl->joEscape($game_type)."'", 1);
	$res = mysqli_fetch_assoc($sql);
	return $res["id"];
}

function GetJoPlayer($name) {
  global $players_table, $tpl;
  $sql = $tpl->joQuery("SELECT * FROM $players_table WHERE name = '".$tpl->joEscape($name)."'", 1);
  if(mysqli_num_rows($sql) == 0) {

    $tpl->joQuery("INSERT INTO $players_table (`name`, `squad`, `rating`, `m_rating`, `awards`, `wpn_awards`, `veh_awards`, `motm`, `dm_value`, `pcid`)                                          VALUES ('".$tpl->joEscape($name)."', '-1', '0', '0', '0', '0', '0', '0', '0', '')", 2);
    return $tpl->joLastId();

  }  
  
  //$sql = $tpl->joQuery("SELECT * FROM $players_table WHERE name = '".$tpl->joEscape($name)."'", 1);
  $player = mysqli_fetch_assoc($sql);
  return $player["id"];
}

function GetJoPlayerRecord($player_id, $team, $game_type, $server_id) {
  global $stats_table, $tpl;
  $sql = $tpl->joQuery("SELECT * FROM $stats_table WHERE player = '".$player_id."' AND team = '".$team."' 
                                             AND server = '".$server_id."' AND game_type = '".$tpl->joEscape($game_type)."'", 1);
  if(mysqli_num_rows($sql) == 0) {
    $tpl->joQuery("INSERT INTO $stats_table (`player`, `team`, `shotsFired`, `timesHit`, `murders`, `kills`, `suicides`, `deaths`, `medHeal`, 
	                                         `medSave`, `revived`, `flagSaves`, `flagCapt`, `flagPick`, `targets`, `pspTakeovers`, `headshots`, 
											 `knifings`, `flagCarr`, `score_1`, `score_2`, `zoneAtt`, `zoneDef`, `assists`, `exp`, `tkothTime`, 
											 `neutralTime`, `homeTime`, `zoneHits`, `campTakeovers`, `medAttempts`, `sniperkills`, `multiKills`, 
											 `totalTime`, `games`, `wins`, `draws`, `grating`, `game_type`, `server`, `last_played`) 
									 VALUES ('".$player_id."', '".$team."', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', 
	                                          '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', 
											  '0', '0', '0', '0', '0', '0', '0.0', '".$game_type."', '".$server_id."', '0000-00-00 00:00:00')", 2);

    return $tpl->joLastId();

  }  
  //$sql = $tpl->joQuery("SELECT * FROM $stats_table WHERE player = '".$player_id."' AND team = '".$team."' 
   //                                          AND server = '".$server_id."' AND game_type = '".$tpl->joEscape($game_type)."'", 1);
  $record = mysqli_fetch_assoc($sql);
  return $record["id"];
}

function GetJoMPlayerRecord($player_id, $team, $game_type, $server_id, $mDate) {
  global $stats_m_table, $tpl;
  $exDate = explode("-", $mDate);
  if($exDate[1] < '10') $exDate[1] = '0'.$exDate[1];
  $subDate = $exDate[0]."-".$exDate[1];
  $sql = $tpl->joQuery("SELECT * FROM $stats_m_table WHERE player = '".$player_id."' AND team = '".$tpl->joEscape($team)."' 
                                             AND server = '".$server_id."' AND game_type = '".$tpl->joEscape($game_type)."' 
											 AND SUBSTRING(last_played, 1, 7) = '".$subDate."'", 1);
  if(mysqli_num_rows($sql) == 0) {
	$tpl->joQuery("INSERT INTO $stats_m_table (`player`, `team`, `shotsFired`, `timesHit`, `murders`, `kills`, `suicides`, `deaths`, `medHeal`, 
	                                           `medSave`, `revived`, `flagSaves`, `flagCapt`, `flagPick`, `targets`, `pspTakeovers`, `headshots`, 
											   `knifings`, `flagCarr`, `score_1`, `score_2`, `zoneAtt`, `zoneDef`, `assists`, `exp`, `tkothTime`, 
											   `neutralTime`, `homeTime`, `zoneHits`, `campTakeovers`, `medAttempts`, `sniperkills`, `multiKills`, 
											   `totalTime`, `games`, `wins`, `draws`, `grating`, `game_type`, `server`, `last_played`) 
									   VALUES ('".$player_id."', '".$tpl->joEscape($team)."', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', 
	                                          '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', 
											  '0', '0', '0', '0', '0', '0', '0.0', '".$game_type."', '".$server_id."', '".$mDate."')", 2);
    return $tpl->joLastId();
  }  
  //$sql = $tpl->joQuery("SELECT * FROM $stats_m_table WHERE player = '".$player_id."' AND team = '".$team."' 
  //                                           AND server = '".$server_id."' AND game_type = '".$tpl->joEscape($game_type)."' 
	//										 AND SUBSTRING(last_played, 1, 7) = '".$subDate."'", 1);
  $record = mysqli_fetch_assoc($sql);
  return $record["id"];
}

function GetJoWeapon($weapon) {
  global $weapons_table, $tpl;
  $sql = $tpl->joQuery("SELECT * FROM $weapons_table WHERE name = '".$tpl->joEscape($weapon)."'", 1);
  if(mysqli_num_rows($sql) == 0) {
   $tpl->joQuery("INSERT INTO $weapons_table (`name`) VALUES ('".$tpl->joEscape($weapon)."')", 2);
   return $tpl->joLastId();
  }  
  //sql = $tpl->joQuery("SELECT * FROM $weapons_table WHERE name = '".$weapon."'", 1);
  $weaponID = mysqli_fetch_assoc($sql);
  return $weaponID["id"];
}

function GetJoWeaponRecord($weapon_id, $record_id) {
  global $weaponstats_table, $tpl;
  $sql = $tpl->joQuery("SELECT * FROM $weaponstats_table WHERE record = '".$record_id."' AND weapon = '".$weapon_id."'", 1);
  if(mysqli_num_rows($sql) == 0) {
    $tpl->joQuery("INSERT INTO $weaponstats_table (`record`, `weapon`, `shotsFired`, `timesHit`, `murders`, `kills`, `suicides`, 
	                                               `deaths`, `medHeal`, `medSave`, `revived`, `flagSaves`, `flagCapt`, `flagPick`, `targets`, 
												   `pspTakeovers`, `headshots`, `knifings`, `flagCarr`, `score_1`, `score_2`, `zoneAtt`, `zoneDef`, 
												   `assists`, `exp`, `tkothTime`, `neutralTime`, `homeTime`, `zoneHits`, `campTakeovers`, `medAttempts`, 
												   `sniperkills`, `multiKills`, `totalTime`) 
										   VALUES ('".$record_id."', '".$weapon_id."', '0', '0', '0', '0', '0', '0', '0', 
	                                                '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', 
													'0', '0', '0', '0', '0', '0', '0', '0')", 2);
       return $tpl->joLastId();
  }  
  //$sql = $tpl->joQuery("SELECT * FROM $weaponstats_table WHERE record = '".$record_id."' AND weapon = '".$weapon_id."'", 1);
  $record = mysqli_fetch_assoc($sql);
  return $record["id"];
}

function GetJoMWeaponRecord($weapon_id, $record_id) {
  global $weaponstats_m_table, $tpl;
  $sql = $tpl->joQuery("SELECT * FROM $weaponstats_m_table WHERE record = '".$record_id."' AND weapon = '".$weapon_id."'", 1);
  if(mysqli_num_rows($sql) == 0) {
    $tpl->joQuery("INSERT INTO $weaponstats_m_table (`record`, `weapon`, `shotsFired`, `timesHit`, `murders`, `kills`, `suicides`, 
	                                                 `deaths`, `medHeal`, `medSave`, `revived`, `flagSaves`, `flagCapt`, `flagPick`, `targets`, 
												     `pspTakeovers`, `headshots`, `knifings`, `flagCarr`, `score_1`, `score_2`, `zoneAtt`, `zoneDef`, 
												     `assists`, `exp`, `tkothTime`, `neutralTime`, `homeTime`, `zoneHits`, `campTakeovers`, `medAttempts`, 
												     `sniperkills`, `multiKills`, `totalTime`) 
											 VALUES ('".$record_id."', '".$weapon_id."', '0', '0', '0', '0', '0', '0', '0', 
	                                                '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', 
													'0', '0', '0', '0', '0', '0', '0', '0')", 2);
       return $tpl->joLastId();
  }  
  //$sql = $tpl->joQuery("SELECT * FROM $weaponstats_m_table WHERE record = '".$record_id."' AND weapon = '".$weapon_id."'", 1);
  $record = mysqli_fetch_assoc($sql);
  return $record["id"];
}

function GetJoVehicle($vehicle) {
  global $vehicles_table, $tpl;
  $sql = $tpl->joQuery("SELECT * FROM $vehicles_table WHERE name = '".$tpl->joEscape($vehicle)."'", 1);
  if(mysqli_num_rows($sql) == 0) {
   $tpl->joQuery("INSERT INTO $vehicles_table (`name`) VALUES ('".$tpl->joEscape($vehicle)."')", 2);
   return $tpl->joLastId();
  }  
  //$sql = $tpl->joQuery("SELECT * FROM $vehicles_table WHERE name = '".$vehicle."'", 1);
  $vehicleID = mysqli_fetch_assoc($sql);
  return $vehicleID["id"];
}

function GetJoVehicleRecord($vehicle_id, $record_id, $attach) {
  global $vehiclestats_table, $tpl;
  $sql = $tpl->joQuery("SELECT * FROM $vehiclestats_table WHERE record = '".$record_id."' AND vehicle = '".$vehicle_id."' 
                                                    AND attach = '".$tpl->joEscape($attach)."'", 1);
  if(mysqli_num_rows($sql) == 0) {
    $tpl->joQuery("INSERT INTO $vehiclestats_table (`record`, `vehicle`, `attach`, `shotsFired`, `timesHit`, `murders`, `kills`, `suicides`, 
	                                                `deaths`, `medHeal`, `medSave`, `revived`, `flagSaves`, `flagCapt`, `flagPick`, `targets`, 
												    `pspTakeovers`, `headshots`, `knifings`, `flagCarr`, `score_1`, `score_2`, `zoneAtt`, `zoneDef`, 
												    `assists`, `exp`, `tkothTime`, `neutralTime`, `homeTime`, `zoneHits`, `campTakeovers`, `medAttempts`, 
												    `sniperkills`, `multiKills`, `totalTime`) 
											VALUES ('".$record_id."', '".$vehicle_id."', '".$tpl->joEscape($attach)."',  '0', '0', '0', '0', '0', '0', '0', 
	                                                '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', 
													'0', '0', '0', '0', '0', '0', '0', '0')", 2);
    return $tpl->joLastId();
  }  
  //$sql = $tpl->joQuery("SELECT * FROM $vehiclestats_table WHERE record = '".$record_id."' AND vehicle = '".$vehicle_id."' 
  //                                                  AND attach = '".$tpl->joEscape($attach)."'", 1);
  $record = mysqli_fetch_assoc($sql);
  return $record["id"];
}

function GetJoMVehicleRecord($vehicle_id, $record_id, $attach) {
  global $vehiclestats_m_table, $tpl;
  $sql = $tpl->joQuery("SELECT * FROM $vehiclestats_m_table WHERE record = '".$record_id."' AND vehicle = '".$vehicle_id."' 
                                                    AND attach = '".$tpl->joEscape($attach)."'", 1);
  if(mysqli_num_rows($sql) == 0) {
    $tpl->joQuery("INSERT INTO $vehiclestats_m_table (`record`, `vehicle`, `attach`, `shotsFired`, `timesHit`, `murders`, `kills`, `suicides`, 
	                                                  `deaths`, `medHeal`, `medSave`, `revived`, `flagSaves`, `flagCapt`, `flagPick`, `targets`, 
												      `pspTakeovers`, `headshots`, `knifings`, `flagCarr`, `score_1`, `score_2`, `zoneAtt`, `zoneDef`, 
												      `assists`, `exp`, `tkothTime`, `neutralTime`, `homeTime`, `zoneHits`, `campTakeovers`, `medAttempts`, 
												      `sniperkills`, `multiKills`, `totalTime`) 
											  VALUES ('".$record_id."', '".$vehicle_id."', '".$tpl->joEscape($attach)."',  '0', '0', '0', '0', '0', '0', '0', 
	                                                  '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', 
												      '0', '0', '0', '0', '0', '0', '0', '0')", 2);
    return $tpl->joLastId();
  }  
  //$sql = $tpl->joQuery("SELECT * FROM $vehiclestats_m_table WHERE record = '".$record_id."' AND vehicle = '".$vehicle_id."' 
  //                                                  AND attach = '".$tpl->joEscape($attach)."'", 1);
  $record = mysqli_fetch_assoc($sql);
  return $record["id"];
}

function GetJoMap($map_name) {
  global $maps_table, $serverstats_table, $tpl;
  $sql = $tpl->joQuery("SELECT * FROM $maps_table WHERE name = '".$tpl->joEscape($map_name)."'", 1);
  if(mysqli_num_rows($sql) == 0) {
    $tpl->joQuery("INSERT INTO $maps_table (`name`, `image`, `tactical`, `games`, `rebel`, `jo`, `totalTime`, `lastPlayed`) 
	               VALUES ('".$map_name."', 'none.gif', 'none.gif', '0', '0', '0', '0', '0000-00-00 00:00:00')", 2);
    return $tpl->joLastId();

  }
  //$sql = $tpl->joQuery("SELECT * FROM $maps_table WHERE name = '".$tpl->joEscape($map_name)."'", 1);
  $map = mysqli_fetch_assoc($sql);
  return $map["id"];
}

function GetJoMapRecord($map_id, $record_id) {
  global $mapstats_table, $tpl;
  $sql = $tpl->joQuery("SELECT * FROM $mapstats_table WHERE map = '".$map_id."' AND record = '".$record_id."'", 1);
  if(mysqli_num_rows($sql) == 0) {
    $tpl->joQuery("INSERT INTO $mapstats_table (`record`, `map`, `murders`, `kills`, `suicides`, `deaths`, `headshots`, `sniperkills`, 
	                                            `knifings`, `multiKills`, `assists`, `hiScore`, `mostKills`, `hiRatio`, 
												`flawless`, `games`, `wins`, `draws`, `totalTime`, `lastPlayed`) 
										VALUES ('".$record_id."', '".$map_id."', '0', '0', '0', '0', '0', 
	                                             '0', '0', '0', '0', '0', '0', '0.0', '0', '0', '0', '0', '0', '0000-00-00 00:00:00')", 2);
    return $tpl->joLastId();
  }  
  //$sql = $tpl->joQuery("SELECT * FROM $mapstats_table WHERE map = '".$map_id."' AND record = '".$record_id."'", 1);
  $map_record = mysqli_fetch_assoc($sql);
  return $map_record["id"];
}

function GetJoMMapRecord($map_id, $record_id) {
  global $mapstats_m_table, $tpl;
  $sql = $tpl->joQuery("SELECT * FROM $mapstats_m_table WHERE map = '".$map_id."' AND record = '".$record_id."'", 1);
  if(mysqli_num_rows($sql) == 0) {
    $tpl->joQuery("INSERT INTO $mapstats_m_table (`record`, `map`, `murders`, `kills`, `suicides`, `deaths`, `headshots`, `sniperkills`, 
	                                              `knifings`, `multiKills`, `assists`, `hiScore`, `mostKills`, `hiRatio`, 
												  `flawless`, `games`, `wins`, `draws`, `totalTime`, `lastPlayed`) 
										  VALUES ('".$record_id."', '".$map_id."', '0', '0', '0', '0', '0', 
	                                              '0', '0', '0', '0', '0', '0', '0.0', '0', '0', '0', '0', '0', '0000-00-00 00:00:00')", 2);
    return $tpl->joLastId();
  }  
  //$sql = $tpl->joQuery("SELECT * FROM $mapstats_m_table WHERE map = '".$map_id."' AND record = '".$record_id."'", 1);
  $map_record = mysqli_fetch_assoc($sql);
  return $map_record["id"];
}

function GetJoLastStatsID($plyrID, $map, $date) {
	global $last_table, $tpl;
	$sql = $tpl->joQuery("SELECT * FROM $last_table WHERE player = '".$plyrID."' AND map = '".$tpl->joEscape($map)."' 
	                                                AND lastUpdate = '".$date."'", 1);
	if(mysqli_num_rows($sql) == 0) {
		$tpl->joQuery("INSERT INTO $last_table (`player`, `map`, `kills`, `deaths`, `medSave`, `headshots`, `knifings`, `multiKills`, `assists`, 
		                                        `exp`, `totalTime`, `game_type`, `rating`, `finished`, `lastUpdate`) 
										VALUES ('".$plyrID."', '".$tpl->joEscape($map)."', '0', '0', '0', '0', '0', '0', '0', 
		                                        '0', '0', '0', '0.0', '0', '".$date."')", 2);
    return $tpl->joLastId();
	}
	//$sql = $tpl->joQuery("SELECT * FROM $last_table WHERE player = '".$plyrID."' AND map = '".$tpl->joEscape($map)."' 
	//                                                AND lastUpdate = '".$date."'", 1);
	$res = mysqli_fetch_assoc($sql);
	return $res["id"];
}

function GetJoPlyrRecord($player, $game_type) {
	global $records_table, $tpl;
	$sql = $tpl->joQuery("SELECT * FROM $records_table WHERE player = '".$player."' AND game_type = '".$tpl->joEscape($game_type)."'", 1);
	if(mysqli_num_rows($sql) == 0) {
		$tpl->joQuery("INSERT INTO $records_table (`player`, `lastStreak`, `wStreak`, `lStreak`, `hiLStreak`, `hiWStreak`, `game_type`, `lastUpdate`) 
		                                   VALUES ('".$player."', '0', '0', '0', '0', '0', '".$tpl->joEscape($game_type)."', '0000-00-00 00:00:00')", 2);
    return $tpl->joLastId();
	}
	//$sql = $tpl->joQuery("SELECT * FROM $records_table WHERE player = '".$player."' AND game_type = '".$tpl->joEscape($game_type)."'", 1);
	$res = mysqli_fetch_assoc($sql);
	return $res["id"];
}

function GetJoServerHistoryID($serverId, $name, $date) {
	global $serverhistory_table, $tpl;
	$sql = $tpl->joQuery("SELECT * FROM $serverhistory_table WHERE serverid  = '".$serverId."' 
	                      AND name = '".$tpl->joEscape($name)."' AND date = '".$date."'", 1);

	if(mysqli_num_rows($sql) == 0) {
		$tpl->joQuery("INSERT INTO $serverhistory_table (`serverid`, `players`, `name`, `date`) VALUES ('".$serverId."', '0', '".$tpl->joEscape($name)."', '".$date."')", 2);
    return $tpl->joLastId();

	}

	$res = mysqli_fetch_assoc($sql);
	return $res["id"];
}

function GetJoVal($value) {
	if($value != '1') exit(base64_decode("VXBsb2FkaW5nIEZhaWxlZCwgSW5jb3JyZWN0IERhdGEh"));
}