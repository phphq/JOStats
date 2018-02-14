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
// File Name     : Common Functions Include                  //
// File Version  : 1.1.7 Standalone                          //
//                                                           //
/////////////////////////////////////////////////////////////*/

/*/////////////////////////////////////////////////////////////
//                                                           //
// Updated Dec 2016 By Novahq.net <scott@novahq.net>         //
// Standalone, PHP 5.6+ Compatible                           //
//                                                           //
/////////////////////////////////////////////////////////////*/

if(!empty($_GET["data"]) &&  $_GET["data"] == "requestVer") {
	echo "1.7.9 (Standalone - BMTV3)";
	exit;
}

$joVersion    = "1.7.9 (Standalone - BMTV3)"; // Release version, do not edit

$teamArray = array(0 => "None", 1 => "Joint Ops", 2 => "Rebels");
 
$gameMod = array(
	array(
		0 => "None"    , 
		1 => "JO:E"    ,
		2 => "IC"      ,
		3 => "Reality" ,
		4 => "SG-Mod"  ,
		5 => "SnA"     ,
		6 => "IC:E"  
	),
	array(
		0 => "None"                           , 
		1 => "Escalation"                     ,
		2 => "International Conflict"         , 
		3 => "Reality"                        , 
		4 => "Star Gate Mod"                  , 
		5 => "Shock n Awe"                    , 
		6 => "International Conflict: Europe"   
	)
);
 
/****************************************** Baboons Babstats MakeTableNames() Function ******************************************/
function MakeTableNames() {
  global $tablepre;
  global $tablepre2;
  $tables = array("adminlogs", "awards", "hof", "last", "layouts", "log", "maps", "mapstats", "monthawards", "monthly", 
                  "playerawards", "players", "ranks", "rating", "records", "squads", "servers", "serverhistory", 
				  "serverstats", "settings", "stats", "style", "weapons", "weaponstats", "vehicles", "vehiclestats");
  $mtables = array("mapstats", "stats", "weaponstats", "vehiclestats");
  foreach($tables as $name) {
    global ${$name."_table"};
    ${$name."_table"} = $tablepre."_".$name;
  }
  foreach($mtables as $m_name) {
    global ${$m_name."_m_table"};
    ${$m_name."_m_table"} = $tablepre2."_".$m_name;
  }
}
/****************************************** Baboons Babstats MakeTableNames() Function ******************************************/


function GetJoGameLevels($gameType, $crit1, $crit2, $crit3, $crit4, $crit5) {
	
	$criterias = array($crit1, $crit2, $crit3, $crit4, $crit5);
	$i = 0;
	foreach($criterias as $value) {
		if($value < 1) {
			$criterias[$i] = 1;
		}
		$i++;
	}
	
	$cri1 = $criterias[0]/200;       // crit1 = Games
	$cri2 = ($criterias[1]/60)/120;  // crit2 = Time

	$cri3 = 0;
	$cri4 = 0;
	$cri5 = 0;
	$div = '5';
	
	switch($gameType) {
	    case 1:
			$cri3 = $criterias[2]/100; // crit3 = Kills
			$cri4 = $criterias[3]/100; // crit4 = Med Saves
			$cri5 = $criterias[4]/24;  // crit5 = PSP Takeovers
			$div = '5';
		break;
		case 2:
			$cri3 = $criterias[2]/140; // crit3 = Kills
			$cri4 = $criterias[3]/40;  // crit4 = Med Saves
			$cri5 = $criterias[4]/40;  // crit5 = Assists
			$div = '5';
		break;
	    case 3:
			$cri3 = ($criterias[2]/60)/60; // crit3 = Zone Time
			$cri4 = $criterias[3]/80;      // crit4 = Zone Att Kill
			$cri5 = $criterias[4]/80;      // crit5 = Zone Def Kill
			$div = '5';
		break;
	    case 4:
			$cri3 = ($criterias[2]/60)/60; // crit3 = Zone Time
			$cri4 = $criterias[3]/200;     // crit4 = Kills
			$div = '5';
		break;
		case 5:
			$cri3 = $criterias[2]/16;  // crit3 = Targets Destroyed
			$cri4 = $criterias[3]/100; // crit4 = Zone Att Kill
			$cri5 = $criterias[4]/100; // crit5 = Zone Def Kill
			$div = '5';
		break;
		case 6:
			$cri3 = $criterias[2]/16;   // crit3 = Targets Destroyed
			$cri4 = $criterias[3]/100;  // crit4 = Zone Att Kill
			$cri5 = $criterias[4]/100;  // crit5 = Zone Def Kill
			$div = '5';
		break;
	    case 7:
			$cri3 = $criterias[2]/20;   // crit3 = Flag Capture
			$cri4 = $criterias[3]/40;   // crit4 = Flag Save
			$cri5 = $criterias[4]/60;   // crit5 = Flag Defend
			$div = '5';
		break;
		case 8:
			$cri3 = $criterias[2]/20;   // crit3 = Flag Capture
			$cri4 = $criterias[3]/40;   // crit4 = Flag Save
			$cri5 = $criterias[4]/60;   // crit5 = Flag Defend
			$div = '5';
		break;
		case 9:
			$cri3 = $criterias[2]/16;   // crit3 = LFP Takeovers
			$cri4 = $criterias[3]/100;  // crit4 = Zone Att Kill
			$cri5 = $criterias[4]/100;  // crit5 = Zone Def Kill
			$div = '5';
		break;
		case 10:
			$cri3 = $criterias[2]/16;   // crit3 = LFP Takeovers
			$cri4 = $criterias[3]/100;  // crit4 = Zone Att Kill
			$cri5 = $criterias[4]/100;  // crit5 = Zone Def Kill
			$div = '5';
		break;
		case 11:
			$cri3 = $criterias[2]/200;  // crit3 = Kills
			$div = '3';
		break;
	}
	
	$crit = $cri1 + $cri2 + $cri3 + $cri4 + $cri5;
	if($crit < 1){
	  $level = 0;
	} elseif(!($crit)) {
	  $level = 0;
	} else {
	  $level = $crit/$div;
	  if(floor($level) > 49) {$level = "50";} else {$level = floor($level)."";}
    }

  return $level;
}

function GetJoGameRanks($gameType, $player) {
	global $stats_table, $tpl;
	$sql = $tpl->joQuery("SELECT 
							player, SUM(grating) as grating FROM $stats_table 
						  WHERE game_type = '".$gameType."' GROUP BY player ORDER BY grating DESC", 1);
	$count = mysqli_num_rows($sql);
	if($count > 0) {
		$i = 1;
		$rank = "";
		while($row = mysqli_fetch_array($sql)) {
			if($row["player"] == $player) {
				$rank = "Rank ".$i;
			}
			$i++;
		}
	} else {
		$rank = "No Rank";
	}
	
	if($rank == "") $rank = "No Rank";
	
	return $rank;
}

function GetJoThisWeek() {
	switch(date("D")) {
		case "Mon": $start = 0; break;
		case "Tue": $start = 1; break;
		case "Wed": $start = 2; break;
		case "Thu": $start = 3; break;
		case "Fri": $start = 4; break;
		case "Sat": $start = 5; break;
		case "Sun": $start = 6; break;
	}
	return $start;
}

function GetJoLastWeek($weekStart) {
	switch($weekStart) {
		case "Mon": $start = date("d")  ; break;
		case "Tue": $start = date("d")-1; break;
		case "Wed": $start = date("d")-2; break;
		case "Thu": $start = date("d")-3; break;
		case "Fri": $start = date("d")-4; break;
		case "Sat": $start = date("d")-5; break;
		case "Sun": $start = date("d")-6; break;
	}
	return $start;
}

function GetJoWpnRanks($wpnID, $player) {
	global $stats_table, $weaponstats_table, $tpl;
	$sql = $tpl->joQuery("SELECT 
							  $stats_table.player, 
							  $weaponstats_table.record, 
							  SUM($weaponstats_table.kills) as kills 
						  FROM $weaponstats_table, $stats_table 
						  WHERE $weaponstats_table.weapon = '".$wpnID."' 
						  AND $weaponstats_table.record = $stats_table.id 
						  GROUP BY $stats_table.player ORDER BY kills DESC", 1);
	$count = mysqli_num_rows($sql);
	if($count > 0) {
		$i = 1;
		$rank = "";
		while($row = mysqli_fetch_array($sql)) {
			if($row["player"] == $player) {
				$rank = "Rank ".$i;
			}
			$i++;
		}
	} else {
		$rank = "No Rank";
	}
	
	if($rank == "") $rank = "No Rank";
	
	return $rank;
}

function GetJOHeadArray($page) {
	global $tpl, $layouts_table;
	$fSql = $tpl->joQuery("SELECT * FROM $layouts_table WHERE page = '".$page."'", 1);
	if(@mysqli_num_rows($fSql) > 0) {
		$fRow = mysqli_fetch_assoc($fSql);
		$fSplit = explode(",", $fRow["fields"]);
		$headArray = array();
		foreach($fSplit as $fField) {
			$headArray[statAlt($fField)] = $fField;
		}
	} else {
		$headArray = array("Rank" => "rating", "Player Name" => "name", "Kills" => "kills", 
						   "Deaths" => "deaths", "Ratio" => "ratio", "Headshots" => "headshots", 
						   "Multi-Kills" => "multiKills", "Awards" => "awards", "Time" => "totalTime");
	}
	return $headArray;
}

function statAlt($stat) {
	$title = $stat;
	switch($stat) {
		case "rating"       : $title = "Rank"              ; break;
		case "kills"        : $title = "Kills"             ; break;
		case "deaths"       : $title = "Deaths"            ; break;
		case "ratio"        : $title = "Ratio"             ; break;
		case "headshots"    : $title = "Headshots"         ; break; 
		case "multiKills"   : $title = "Multi-Kills"       ; break;
		case "awards"       : $title = "Awards"            ; break;
		case "wpn_awards"   : $title = "Wpn Awards"        ; break;
		case "veh_awards"   : $title = "Veh Awards"        ; break;
		case "motm"         : $title = "Motm"              ; break;
		case "pcid"         : $title = "PCID"              ; break;
		case "totalTime"    : $title = "Time"              ; break;
		case "suicides"     : $title = "Suicides"          ; break;
		case "team"         : $title = "Team"              ; break; 
		case "shotsFired"   : $title = "Shots Fired"       ; break;
		case "timesHit"     : $title = "Times Hit"         ; break;
		case "murders"      : $title = "Murders"           ; break;
		case "medHeal"      : $title = "Med Heals"         ; break;
		case "medSave"      : $title = "Med Saves"         ; break;
		case "revived"      : $title = "Revived"           ; break;
		case "flagSaves"    : $title = "Flags saved"       ; break; 
		case "flagCapt"     : $title = "Flags Captured"    ; break;
		case "flagPick"     : $title = "Flag Pickups"      ; break;
		case "targets"      : $title = "Targets"           ; break;
		case "pspTakeovers" : $title = "PSP Takeovers"     ; break;
		case "knifings"     : $title = "Knifings"          ; break;
		case "flagCarr"     : $title = "Flag Carrier Kills"; break;
		case "zoneAtt"      : $title = "Zone Attack Kills" ; break; 
		case "zoneDef"      : $title = "Zone Defend Kills" ; break;
		case "assists"      : $title = "Assists"           ; break;
		case "exp"          : $title = "Experience"        ; break;
		case "tkothTime"    : $title = "TKOTH Time"        ; break;
		case "neutralTime"  : $title = "Neutral Time"      ; break;
		case "homeTime"     : $title = "Home Time"         ; break; 
		case "zoneHits"     : $title = "Zone Hits"         ; break;
		case "campTakeovers": $title = "Camp Takeovers"    ; break;
		case "medAttempts"  : $title = "Med Attempts"      ; break;
		case "sniperkills"  : $title = "Sniper Kills"      ; break;
		case "games"        : $title = "Games"             ; break;
		case "wins"         : $title = "Wins"              ; break; 
		case "draws"        : $title = "Draws"             ; break;
		case "last_played"  : $title = "Last Played"       ; break;
	}
	return $title;
}

function GetJoHeaders($short) {
	$header = "";
	switch($short)  {
		case "Shots"    : $header = "Shots Fired"      ; break;
		case "H-Shots"  : $header = "Headshots"        ; break;
		case "M-Kills"  : $header = "Multi-Kills"      ; break;
		case "Passenger": $header = "Passenger Kills"  ; break;
		case "Gunner"   : $header = "Gunner Kills"     ; break;
		case "Win %"    : $header = "Win Percentage"   ; break;
		case "Ratio"    : $header = "Kill/Death Ratio" ; break;
	}
	if(!$header) $header = $short;
	return $header;
}

function SetGameStats($id, $id2, $type) {
	global $players_table, $weapons_table, $vehicles_table, $maps_table, $tpl;
	$sql = $tpl->joQuery("SELECT * FROM $players_table WHERE id = '".$id."'", 1);
	$row = mysqli_fetch_assoc($sql);
	$gameStatsArray[0] = $row;
	switch($type) {
		case "player": 
			$gameStatsArray[1] = array("assists", "kills", "headshots", "sniperkills", "multiKills", "knifings", "timesHit", 
	                                   "deaths", "avgHdeaths", "ratio", "murders", "suicides", "medAttempts", "medHeal", 
							           "medSave", "revived", "totalTime", "games", "wins", "loses", "draws", "winPer", 
							           "pspTakeovers", "campTakeovers", "tkothTime", "targets", "flagCapt", "awards", 
							           "wpn_awards", "motm");
		break ;
		case "weapon": 
			$gameStatsArray[1] = array("w_kills", "w_headshots", "w_multiKills", "w_deaths", "w_suicides", 
			                           "w_murders", "w_ratio", "w_accuracy", "w_totalTime");
			$sql = $tpl->joQuery("SELECT * FROM $weapons_table WHERE id = '".$id2."'", 1);
			$row = mysqli_fetch_assoc($sql);
			$gameStatsArray[2] = $row;
		break ;
		case "vehicle": 
			$gameStatsArray[1] = array("v_kills", "v_headshots", "v_multiKills", "v_deaths", "v_suicides", 
			                           "v_murders", "v_ratio", "v_accuracy", "v_totalTime");
			$sql = $tpl->joQuery("SELECT * FROM $vehicles_table WHERE id = '".$id2."'", 1);
			$row = mysqli_fetch_assoc($sql);
			$gameStatsArray[2] = $row;
		break ;
		case "map": 
			$gameStatsArray[1] = array("m_kills", "m_assists", "m_deaths", "m_suicides", "m_murders", "m_sniperKills", 
			                           "m_multiKills", "m_knifings", "m_games", "m_wins", "m_loses", "m_draws", "m_winPer", 
									   "m_totalTime", "hiScore", "hiRatio", "mostKills", "flawless");
			$sql = $tpl->joQuery("SELECT * FROM $maps_table WHERE id = '".$id2."'", 1);
			$row = mysqli_fetch_assoc($sql);
			$gameStatsArray[2] = $row;
		break ;
	}

	return $gameStatsArray;
}

function GetJoAwardProgress($id, $stat, $award, $type) {
	global $stats_table, $awards_table, $tpl;
	
	$progress = 0;

	switch($type) {
		case 1:
			$sql = $tpl->joQuery("SELECT player, SUM(".$stat.") AS ".$stat." FROM $stats_table 
								  WHERE player = '".$id."' GROUP BY player", 1);
			$row = mysqli_fetch_array($sql);
			if($row[$stat] == 0) {
				$progress = 1;
			} else {
				$sql = $tpl->joQuery("SELECT * FROM $awards_table 
									  WHERE id = '".$award."'", 1);
				$arow = mysqli_fetch_array($sql);
				if($row[$stat] > 0) {$progress = ($row[$stat]/$arow["value"])*60;} else {$progress = 0;}
			}
		break ;
		case 2:
			if($stat == 0) {
				$progress = 1;
			} else {
				$progress = ($stat/$award)*60;
			}
		break;
	}
	
	return $progress;
}

function GetJoStyle($section) {
	global $tpl, $style_table;
	
	switch($section) {
		case "main":
			$sql = $tpl->joQuery("SELECT * FROM ".$style_table." WHERE id = '1'", 1);
			$row = mysqli_fetch_assoc($sql);
			$style = '

					body {background-color: #'.$row["Background 4"].';}

					#js_menu {
						  font-size: '.$row["Font size 1"].'px;
						  font-weight:bold;
						  font-family:'.$row["Font family"].';
						  color:#'.$row["Font color 1"].';
						  text-align:center;
						  background-color:#'.$row["Background 1"].';
						  border-bottom:#62677f medium solid;
						  border-top:#161b33 medium solid;
						  border-left:#62677f medium solid;
						  border-right:#161b33 medium solid;
					  }
					
					  #js_menu2 {
						  font-size: '.$row["Font size 1"].'px;
						  font-weight:bold;
						  font-family:'.$row["Font family"].';
						  color:#'.$row["Font color 1"].';
						  text-align:center;
						  background-color:#'.$row["Background 2"].';
						  border-bottom:#62677f thin solid;
						  border-top:#161b33 thin solid;
						  border-left:#62677f thin solid;
						  border-right:#161b33 thin solid;
					  }
					
					  #js_info {
						  font-size: '.$row["Font size 1"].'px;
						  font-family:'.$row["Font family"].';
						  color:#'.$row["Font color 1"].';
						  text-align:left;
						  background-color:#'.$row["Background 2"].';
						  border-bottom:#62677f thin solid;
						  border-top:#161b33 thin solid;
						  border-left:#62677f thin solid;
						  border-right:#161b33 thin solid;
					  }
					
					  #js_menu3 {
						  font-size: '.$row["Font size 1"].'px;
						  font-weight:bold;
						  font-family:'.$row["Font family"].';
						  color:#'.$row["Font color 1"].';
						  text-align:center;
						  background-color:#'.$row["Background 3"].';
						  border-bottom:#62677f thin solid;
						  border-top:#161b33 thin solid;
						  border-left:#62677f thin solid;
						  border-right:#161b33 thin solid;
					  }
					
					  #js_menu a:link{color:#'.$row["Link color"].';font-family:'.$row["Font family"].';}
					
					  #js_menu a:visited{color:#'.$row["Visited color"].';font-family:'.$row["Font family"].';}
					  
					  #js_menu a:hover{color:#'.$row["Hover color"].';font-family:'.$row["Font family"].';}
					
					  #js_menu2 a:link{color:#'.$row["Link color"].';font-family:'.$row["Font family"].';}
					
					  #js_menu2 a:visited{color:#'.$row["Visited color"].';font-family:'.$row["Font family"].';}
					  
					  #js_menu2 a:hover{color:#'.$row["Hover color"].';font-family:'.$row["Font family"].';}
					
					  #js_info a:link{color:#'.$row["Link color"].';font-family:'.$row["Font family"].';}
					
					  #js_info a:visited{color:#'.$row["Visited color"].';font-family:'.$row["Font family"].';}
					
					  #js_info a:hover{color:#'.$row["Hover color"].';font-family:'.$row["Font family"].';}
					
					  #js_header {
						  font-weight:bold;
						  font-family:'.$row["Font family"].';
						  color:#'.$row["Font color 1"].';
						  text-align:center;
						  font-size: '.$row["Font size 1"].'px;
					  }
					
					  #js_body {background-color: #'.$row["Background 4"].';}
					
					  #js_top {
						  background-color: #'.$row["Background 5"].';
						  font-family:'.$row["Font family"].';
						  color:#'.$row["Font color 1"].';
					  }
					
					  #js_center {background-color:#'.$row["Background 6"].';}
					
					  #js_tableHead {
						  background-color:#'.$row["Background 5"].';
						  font-weight:bold;
						  font-family:'.$row["Font family"].';
						  color:#'.$row["Font color 1"].';
						  font-size: '.$row["Font size 1"].'px;
					  }
					
					  #js_table {color: #'.$row["Font color 1"].';}
					
					  #js_table a:link {color:#'.$row["Link color"].';font-weight:bold;font-family:'.$row["Font family"].';}
					
					  #js_table a:visited {color:#'.$row["Visited color"].';font-weight:bold;font-family:'.$row["Font family"].';}
					  
					  #js_multiList {
						  font-size: '.$row["Font size 1"].'px;
						  color:#'.$row["Link color"].';
					  }
					
					  #js_multiList a:link {
					      color:#'.$row["Link color"].';
						  font-family:'.$row["Font family"].';
						  font-size: '.$row["Font size 1"].'px;
					  }
					
					  #js_multiList a:visited {
					      color:#'.$row["Visited color"].';
						  font-family:'.$row["Font family"].';
						  font-size: '.$row["Font size 1"].'px;
					  }
					  
					  #js_row1 {
						  background-color: #'.$row["Background 7"].';
						  font-family:'.$row["Font family"].';
						  color:#'.$row["Font color 1"].';
						  font-size:'.$row["Font size 3"].'px;
					  }
					
					  #js_row2 {
						  background-color: #'.$row["Background 8"].';
						  font-family:'.$row["Font family"].';
						  color:#'.$row["Font color 1"].';
						  font-size:'.$row["Font size 3"].'px;
					  }
					
					  #js_row3 {
						  background-color:#'.$row["Background 2"].';
						  border-bottom:#62677f thin solid;
						  border-top:#161b33 thin solid;
						  border-left:#62677f thin solid;
						  border-right:#161b33 thin solid;
						  font-family:'.$row["Font family"].';
						  font-size:'.($row["Font size 1"] - 1).'px;
						  color:#'.$row["Font color 1"].';
					  }
					
					  #infoBox {background-color:#'.$row["Background 1"].';color:#'.$row["Font color 2"].';}
					
					  #js_text {color:#'.$row["Font color 1"].';font-family:'.$row["Font family"].';}
					
					  #js_button {
						  font-family:'.$row["Font family"].';
						  color:#'.$row["Font color 3"].';
						  font-size: '.($row["Font size 1"] + 1).'px;
					  }
					
					  #js_aboutText{
						  color:#'.$row["Font color 1"].';
						  font-family:'.$row["Font family"].';
						  font-weight:normal;
					  }';
		break;
		case "admin":
			$sql = $tpl->joQuery("SELECT * FROM ".$style_table." WHERE id = '2'", 1);
			$row = mysqli_fetch_assoc($sql);
			$style = '

					body {
						   background-color:#414142;
					  }

					#js_border {
						   border:#'.$row["Background 1"].' thin solid;
					  }
					
					  #js_button {
						  font-family:'.$row["Font family"].';
						  color:#'.$row["Font color 3"].';
						  font-size: '.$row["Font size 1"].'px;
					  }
					
					  #js_text {
						  color:#'.$row["Font color 1"].';
						  font-family:'.$row["Font family"].';
						  font-size: '.$row["Font size 1"].'px;
					  }
					
					  #js_text a:link {
						  color:#'.$row["Link color"].';
						  font-family:'.$row["Font family"].';
						  font-size: '.$row["Font size 2"].'px;
					  }
					
					  #js_text a:visited{
						  color:#'.$row["Visited color"].';
						  font-family:'.$row["Font family"].';
						  font-size: '.$row["Font size 2"].'px;
					  }
					
					  #js_text a:hover{
						  color:#'.$row["Hover color"].';
						  font-family:'.$row["Font family"].';
						  font-size: '.$row["Font size 2"].'px;
					  }
					
					  #js_boxLeft {
						  border-top:#'.$row["Background 1"].' thin solid; 
						  border-left:#'.$row["Background 1"].' thin solid;  
						  border-bottom:#'.$row["Background 1"].' thin solid;
					  }
					
					  #js_boxRight {
						  border-top:#'.$row["Background 1"].' thin solid; 
						  border-bottom:#'.$row["Background 1"].' thin solid; 
						  border-right:#'.$row["Background 1"].' thin solid;
					  }';
		break;
	}
	return $style;
}

function checkSection($section) {
	$sectionArray = array(
		"kill_stats", "player_stats", "player_weapons", "player_weaponDetails", "player_vehicles", 
		"player_vehicleDetails", "player_maps", "player_mapDetails", "player_awards", "game_type", 
		"weapons", "weapon_details",  "vehicles", "vehicle_details", "maps", "map_details", 
		"squad_list", "squad_details", "compare", "monthly_awards", "about", "awards", "ranks", 
		"server_list", "server", "rating_system", "logo"
	);

	return in_array($section, $sectionArray);
}