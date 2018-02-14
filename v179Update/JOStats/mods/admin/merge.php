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

$file = "./tpls/admin/admin_merge.tpl";

if(!$tpl->getMgtTpl($file)) {

	$varArray["content"] = $tpl->joErrorRet(1, $section." template");	
	
} else {

	$varArray["error"] = "";
	$varArray["msg"]   = "";
	
	if(!empty($_POST["merge"])) {

		$plyr1=(!empty($_POST['plyr1']) ? $_POST['plyr1'] : "");
		$plyr2=(!empty($_POST['plyr2']) ? $_POST['plyr2'] : "");

		if($plyr1 == "" || $plyr2 == "") {
			$varArray["msg"] = "Please highlight a player from each list.";
		} elseif($plyr1 == $plyr2) {
			$varArray["msg"] = "You cannot merge the same player!";
		} else {
			$plyrArray = array();
			$statArray = array();
			$statsIds  = array();
			$mapsArray = array();
			$wpnsArray = array();
			$vehsArray = array();
			//records
			
			/************************************** Build Player Array **************************************/
			$plyrSql1 = $tpl->joQuery("SELECT * FROM $players_table WHERE name = '".$tpl->joEscape($plyr1)."' ", 1);
			$plyrRow1 = mysqli_fetch_assoc($plyrSql1);
			$plyrSql2 = $tpl->joQuery("SELECT * FROM $players_table WHERE name = '".$tpl->joEscape($plyr2)."' ", 1);
			$plyrRow2 = mysqli_fetch_assoc($plyrSql2);
			$plyrArray["id"]         = $plyrRow1["id"];
			$plyrArray["name"]       = $plyrRow1["name"];
			$plyrArray["squad"]      = $plyrRow1["squad"];
			$plyrArray["rating"]     = $plyrRow1["rating"]     + $plyrRow2["rating"];
			$plyrArray["m_rating"]   = $plyrRow1["m_rating"]   + $plyrRow2["m_rating"];
			$plyrArray["awards"]     = $plyrRow1["awards"]     + $plyrRow2["awards"];
			$plyrArray["wpn_awards"] = $plyrRow1["wpn_awards"] + $plyrRow2["wpn_awards"];
			$plyrArray["veh_awards"] = $plyrRow1["veh_awards"] + $plyrRow2["veh_awards"];
			$plyrArray["motm"]       = $plyrRow1["motm"]       + $plyrRow2["motm"];
			/************************************** Build Player Array **************************************/
			
			
			/************************************** Build Stats Array **************************************/
			$statSql1 = $tpl->joQuery("SELECT * FROM $stats_table WHERE player = '".$plyrRow1["id"]."' ", 1);
			if(@mysqli_num_rows($statSql1) > 0) {
				$i = 0;
				while($statRow1 = mysqli_fetch_assoc($statSql1)) {
					foreach($statRow1 as $field => $value) {
						$statArray[$i][$field] = $value;
					}
					$i++;
				}
			}
			$statSql2 = $tpl->joQuery("SELECT * FROM $stats_table WHERE player = '".$plyrRow2["id"]."' ", 1);
			if(@mysqli_num_rows($statSql2) > 0) {
				while($statRow2 = mysqli_fetch_assoc($statSql2)) {
					$statRow2["status"] = "";
					foreach($statArray as $index => $existing) {
						if($statArray[$index]["team"]      == $statRow2["team"]      && 
						   $statArray[$index]["game_type"] == $statRow2["game_type"] && 
						   $statArray[$index]["server"]    == $statRow2["server"]) {
							$statsIds[$statRow2["id"]] = $statArray[$index]["id"];
							$statRow2["status"] = $index;
						}
					}
					
					if($statRow2["status"] === "") {
						foreach($statRow2 as $field => $value) {
							$statArray[$i][$field] = $value;
						}
						$i++;
					} else {
						foreach($statRow2 as $field => $value) {	
							if($field != "id" && $field != "player" && $field != "team" && $field != "game_type" &&
							   $field != "server" && $field != "last_played") {

							   	if(isset($statArray[$statRow2["status"]][$field])) {
							   		$statArray[$statRow2["status"]][$field] += $value;
							   	}
						
							}
							if($field == "last_played" && $value > $statArray[$statRow2["status"]]["last_played"]) {
								$statArray[$statRow2["status"]][$field] = $value;
							}
						}
					}
				}
			}
			/************************************** Build Stats Array **************************************/
			
			
			/************************************** Build Mapstats Array **************************************/
			$mapsSql1 = $tpl->joQuery("SELECT $stats_table.team, $stats_table.game_type, 
			                                  $stats_table.server, $mapstats_table.* 
									   FROM $mapstats_table, $stats_table 
			                           WHERE $mapstats_table.record =  $stats_table.id 
									   AND $stats_table.player = '".$plyrRow1["id"]."' ", 1);
			if(@mysqli_num_rows($mapsSql1) > 0) {
				$i = 0;
				while($mapsRow1 = mysqli_fetch_assoc($mapsSql1)) {
					foreach($mapsRow1 as $field => $value) {
						$mapsArray[$i][$field] = $value;
					}
					$i++;
				}
			}
			$mapsSql2 = $tpl->joQuery("SELECT $stats_table.team, $stats_table.game_type, 
			                                  $stats_table.server, $mapstats_table.* 
									   FROM $mapstats_table, $stats_table 
			                           WHERE $mapstats_table.record =  $stats_table.id 
									   AND $stats_table.player = '".$plyrRow2["id"]."' ", 1);
			if(@mysqli_num_rows($mapsSql2) > 0) {
				while($mapsRow2 = mysqli_fetch_assoc($mapsSql2)) {
					$mapsRow2["status"] = "";
					foreach($mapsArray as $index => $existing) {
							if($mapsArray[$index]["team"]      == $mapsRow2["team"]      && 
							   $mapsArray[$index]["map"]       == $mapsRow2["map"]       && 
							   $mapsArray[$index]["game_type"] == $mapsRow2["game_type"] && 
							   $mapsArray[$index]["server"]    == $mapsRow2["server"]) {
								$mapsRow2["status"] = $index;
							}
					}

					
					
					if($mapsRow2["status"] === "") {
						foreach($mapsRow2 as $field => $value) {
							if($field == "record" && !empty($statsIds[$value])) {
								$mapsArray[$i][$field] = $statsIds[$value];
							} else {
								$mapsArray[$i][$field] = $value;
							}
						}
						$i++;
					} else {
						foreach($mapsRow2 as $field => $value) {	
							if($field == "record") $mapsArray[$mapsRow2["status"]][$field] = $statsIds[$value];
							if($field != "id" && $field != "record" && $field != "team" && $field != "map" && 
							   $field != "game_type" && $field != "server" && $field != "lastPlayed") {
							   	if(isset($mapsArray[$mapsRow2["status"]][$field])) {
									$mapsArray[$mapsRow2["status"]][$field] += $value;
							   	}
			
							}
							if($field == "lastPlayed" && $value > $mapsArray[$mapsRow2["status"]]["lastPlayed"]) {
								$mapsArray[$mapsRow2["status"]][$field] = $value;
							}
						}
					} 
				}
			}
			/************************************** Build Mapstats Array **************************************/
			
			
			/************************************** Build Weaponstats Array **************************************/
			$wpnsSql1 = $tpl->joQuery("SELECT $stats_table.team, $stats_table.game_type, 
			                                  $stats_table.server, $weaponstats_table.* 
									   FROM $weaponstats_table, $stats_table 
			                           WHERE $weaponstats_table.record =  $stats_table.id 
									   AND $stats_table.player = '".$plyrRow1["id"]."' ", 1);
			if(@mysqli_num_rows($wpnsSql1) > 0) {
				$i = 0;
				while($wpnsRow1 = mysqli_fetch_assoc($wpnsSql1)) {
					foreach($wpnsRow1 as $field => $value) {
						$wpnsArray[$i][$field] = $value;
					}
					$i++;
				}
			}
			
			$wpnsSql2 = $tpl->joQuery("SELECT $stats_table.team, $stats_table.game_type, 
			                                  $stats_table.server, $weaponstats_table.* 
									   FROM $weaponstats_table, $stats_table 
			                           WHERE $weaponstats_table.record =  $stats_table.id 
									   AND $stats_table.player = '".$plyrRow2["id"]."' ", 1);
			if(@mysqli_num_rows($wpnsSql2) > 0) {
				while($wpnsRow2 = mysqli_fetch_assoc($wpnsSql2)) {
					$wpnsRow2["status"] = "";
					foreach($wpnsArray as $index => $existing) {
							if($wpnsArray[$index]["team"]      == $wpnsRow2["team"]      && 
							   $wpnsArray[$index]["weapon"]    == $wpnsRow2["weapon"]    && 
							   $wpnsArray[$index]["game_type"] == $wpnsRow2["game_type"] && 
							   $wpnsArray[$index]["server"]    == $wpnsRow2["server"]) {
								$wpnsRow2["status"] = $index;
							}
					}

					
					
					if($wpnsRow2["status"] === "") {
						foreach($wpnsRow2 as $field => $value) {
							if($field == "record" && !empty($statsIds[$value])) {
								$wpnsArray[$i][$field] = $statsIds[$value];
							} else {
								$wpnsArray[$i][$field] = $value;
							}
						}
						$i++;
					} else {
						foreach($wpnsRow2 as $field => $value) {	
							if($field == "record") $wpnsArray[$wpnsRow2["status"]][$field] = $statsIds[$value];
							if($field != "id" && $field != "record"  && $field != "team" && $field != "weapon" && 
							   $field != "game_type" && $field != "server" && $field != "lastPlayed") {
							   	if(isset($wpnsArray[$wpnsRow2["status"]][$field])) {
							   		$wpnsArray[$wpnsRow2["status"]][$field] += $value;	
							   	}
								
							}
							if($field == "lastPlayed" && $value > $wpnsArray[$wpnsRow2["status"]]["lastPlayed"]) {
								$wpnsArray[$wpnsRow2["status"]][$field] = $value;
							}
						}
					} 
				}
			}
			/************************************** Build Weaponstats Array **************************************/
			
			
			/************************************** Build Vehiclestats Array **************************************/
			$vehsSql1 = $tpl->joQuery("SELECT $stats_table.team, $stats_table.game_type, 
			                                  $stats_table.server, $vehiclestats_table.* 
									   FROM $vehiclestats_table, $stats_table 
			                           WHERE $vehiclestats_table.record =  $stats_table.id 
									   AND $stats_table.player = '".$plyrRow1["id"]."' ", 1);
			if(@mysqli_num_rows($vehsSql1) > 0) {
				$i = 0;
				while($vehsRow1 = mysqli_fetch_assoc($vehsSql1)) {
					foreach($vehsRow1 as $field => $value) {
						$vehsArray[$i][$field] = $value;
					}
					$i++;
				}
			}
			
			$vehsSql2 = $tpl->joQuery("SELECT $stats_table.team, $stats_table.game_type, 
			                                  $stats_table.server, $vehiclestats_table.* 
									   FROM $vehiclestats_table, $stats_table 
			                           WHERE $vehiclestats_table.record =  $stats_table.id 
									   AND $stats_table.player = '".$plyrRow2["id"]."' ", 1);
			if(@mysqli_num_rows($vehsSql2) > 0) {
				while($vehsRow2 = mysqli_fetch_assoc($vehsSql2)) {
					$vehsRow2["status"] = "";
					foreach($vehsArray as $index => $existing) {
							if($vehsArray[$index]["team"]      == $vehsRow2["team"]      && 
							   $vehsArray[$index]["vehicle"]   == $vehsRow2["vehicle"]   && 
							   $vehsArray[$index]["attach"]    == $vehsRow2["attach"]    && 
							   $vehsArray[$index]["game_type"] == $vehsRow2["game_type"] && 
							   $vehsArray[$index]["server"]    == $vehsRow2["server"]) {
								$vehsRow2["status"] = $index;
							}
					}

					
					
					if($vehsRow2["status"] === "") {
						foreach($vehsRow2 as $field => $value) {
							if($field == "record" && !empty($statsIds[$value])) {
								$vehsArray[$i][$field] = $statsIds[$value];
							} else {
								$vehsArray[$i][$field] = $value;
							}
						}
						$i++;
					} else {
						foreach($vehsRow2 as $field => $value) {	
							if($field == "record") $vehsArray[$vehsRow2["status"]][$field] = $statsIds[$value];
							if($field != "id" && $field != "record"  && $field != "team" && $field != "vehicle" && 
							   $field != "attach" && $field != "game_type" && $field != "server" && $field != "lastPlayed") {
							   	if(isset($vehsArray[$vehsRow2["status"]][$field])) {
							   		$vehsArray[$vehsRow2["status"]][$field] += $value;	
							   	}
							
							}
							if($field == "lastPlayed" && $value > $vehsArray[$vehsRow2["status"]]["lastPlayed"]) {
								$vehsArray[$vehsRow2["status"]][$field] = $value;
							}
						}
					} 
				}
			}
			/************************************** Build Vehiclestats Array **************************************/
			
			
			/************************************** Delete Players Stats **************************************/
			$mstatSql = $tpl->joQuery("SELECT * FROM $stats_m_table WHERE player = '".$plyrRow1["id"]."'", 1);
			if(@mysqli_num_rows($mstatSql) > 0) {
				while($mstatRow = mysqli_fetch_assoc($mstatSql)) {
					$tpl->joQuery("DELETE FROM $mapstats_m_table WHERE record = '".$mstatRow["id"]."'", 2);
					$tpl->joQuery("DELETE FROM $weaponstats_m_table WHERE record = '".$mstatRow["id"]."'", 2);
					$tpl->joQuery("DELETE FROM $vehiclestats_m_table WHERE record = '".$mstatRow["id"]."'", 2);
				}
			}
			
			$mstatSql2 = $tpl->joQuery("SELECT * FROM $stats_m_table WHERE player = '".$plyrRow2["id"]."'", 1);
			if(@mysqli_num_rows($mstatSql2) > 0) {
				while($mstatRow2 = mysqli_fetch_assoc($mstatSql2)) {
					$tpl->joQuery("DELETE FROM $mapstats_m_table WHERE record = '".$mstatRow2["id"]."'", 2);
					$tpl->joQuery("DELETE FROM $weaponstats_m_table WHERE record = '".$mstatRow2["id"]."'", 2);
					$tpl->joQuery("DELETE FROM $vehiclestats_m_table WHERE record = '".$mstatRow2["id"]."'", 2);
				}
			}
				
			$statSql = $tpl->joQuery("SELECT * FROM $stats_table WHERE player = '".$plyrRow1["id"]."'", 1);
			if(@mysqli_num_rows($statSql) > 0) {
				while($statRow = mysqli_fetch_assoc($statSql)) {
					$tpl->joQuery("DELETE FROM $mapstats_table WHERE record = '".$statRow["id"]."'", 2);
					$tpl->joQuery("DELETE FROM $weaponstats_table WHERE record = '".$statRow["id"]."'", 2);
					$tpl->joQuery("DELETE FROM $vehiclestats_table WHERE record = '".$statRow["id"]."'", 2);
				}
			}
			
			$statSql2 = $tpl->joQuery("SELECT * FROM $stats_table WHERE player = '".$plyrRow2["id"]."'", 1);
			if(@mysqli_num_rows($statSql2) > 0) {
				while($statRow2 = mysqli_fetch_assoc($statSql2)) {
					$tpl->joQuery("DELETE FROM $mapstats_table WHERE record = '".$statRow2["id"]."'", 2);
					$tpl->joQuery("DELETE FROM $weaponstats_table WHERE record = '".$statRow2["id"]."'", 2);
					$tpl->joQuery("DELETE FROM $vehiclestats_table WHERE record = '".$statRow2["id"]."'", 2);
				}
			}
			
			$tpl->joQuery("DELETE FROM $stats_m_table WHERE player = '".$plyrRow1["id"]."'", 2);
			$tpl->joQuery("DELETE FROM $stats_table WHERE player = '".$plyrRow1["id"]."'", 2);
			$tpl->joQuery("DELETE FROM $players_table WHERE id = '".$plyrRow1["id"]."'", 2);
			$tpl->joQuery("DELETE FROM $stats_m_table WHERE player = '".$plyrRow2["id"]."'", 2);
			$tpl->joQuery("DELETE FROM $stats_table WHERE player = '".$plyrRow2["id"]."'", 2);
			$tpl->joQuery("DELETE FROM $playerawards_table WHERE player = '".$plyrRow2["id"]."'", 2);
			$tpl->joQuery("DELETE FROM $records_table WHERE player = '".$plyrRow2["id"]."'", 2);
			$tpl->joQuery("DELETE FROM $players_table WHERE id = '".$plyrRow2["id"]."'", 2);
			/************************************** Delete Players Stats **************************************/
			
			
			/*************** Construct combined stats from arrays and store them in an array ***************/		
			$impGlue = "' , '";
			$plyrImp = implode($impGlue, $plyrArray);
			$queryList[] = "INSERT INTO $players_table VALUES('".$plyrImp."', '', '')";

			foreach($statArray as $index => $array) {
				unset($statArray[$index]["status"]);
				$statImp = implode($impGlue, $statArray[$index]);
				$queryList[] .= "INSERT INTO $stats_table VALUES('".$statImp."'); ";
			}

			foreach($mapsArray as $index => $array) {
				unset($mapsArray[$index]["team"]);
				unset($mapsArray[$index]["game_type"]);
				unset($mapsArray[$index]["server"]);
				unset($mapsArray[$index]["status"]);
				$mapsImp = implode($impGlue, $mapsArray[$index]);
				$queryList[] .= "INSERT INTO $mapstats_table VALUES('".$mapsImp."'); ";
			}

			foreach($wpnsArray as $index => $array) {
				unset($wpnsArray[$index]["team"]);
				unset($wpnsArray[$index]["game_type"]);
				unset($wpnsArray[$index]["server"]);
				unset($wpnsArray[$index]["status"]);
				$wpnsImp = implode($impGlue, $wpnsArray[$index]);
				$queryList[] .= "INSERT INTO $weaponstats_table VALUES('".$wpnsImp."'); ";
			}
			
			foreach($vehsArray as $index => $array) {
				unset($vehsArray[$index]["team"]);
				unset($vehsArray[$index]["game_type"]);
				unset($vehsArray[$index]["server"]);
				unset($vehsArray[$index]["status"]);
				$vehsImp = implode($impGlue, $vehsArray[$index]);
				$queryList[] .= "INSERT INTO $vehiclestats_table VALUES('".$vehsImp."'); ";
			}
			/*************** Construct combined stats from arrays and store them in an array ***************/
			
			
			/*************************************** Update Misc Tables ***************************************/
			$tpl->joQuery("UPDATE $monthawards_table SET player = '".$plyr1."' WHERE player = '".$plyr2."' ", 2);
			$tpl->joQuery("UPDATE $last_table SET player = '".$plyrRow1["id"]."' WHERE player = '".$plyrRow2["id"]."' ", 2);
			/*************************************** Update Misc Tables ***************************************/
			
			
			/*********************** Loop through query array and execute each query ***********************/
			foreach($queryList as $sqlQuery) {
				$tpl->joQuery($sqlQuery, 2);
			}
			/*********************** Loop through query array and execute each query ***********************/
			
			
			$varArray["msg"] = "Players Merged!";
		}
	}
	

	$sql = $tpl->joQuery("SELECT * FROM $players_table WHERE name!='' ", 1);
	$varArray["playerList"] = "";
	if(@mysqli_num_rows($sql) > 0) {
		while($row = mysqli_fetch_assoc($sql)) {
			$varArray["playerList"] .= '<option value="'.htmlspecialchars($row["name"]).'">'.htmlspecialchars($row["name"]).'</option>';
		}
	}
	
	$varArray["formAction"] = "./admin.php?section=merge";
	
	$varArray["content"] = $tpl->buildMgtTpl($varArray, $sqlArray, 0, $file, "");
}