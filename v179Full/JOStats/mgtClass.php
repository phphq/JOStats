<?php
/*/////////////////////////////////////////////////////////////
//                                                           //
// MGT Class is a product of MGT - Messiah Gaming Tools      //
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
// Support       : http://www.gamers-central.com             //
//                                                           //
// File Name     : MGT Template Class (Babstats Specific)    //
// File Version  : 1.1.6 Standalone                          //
//                                                           //
/////////////////////////////////////////////////////////////*/

/*/////////////////////////////////////////////////////////////
//                                                           //
// Updated Dec 2016 By Novahq.net <scott@novahq.net>         //
// Standalone, PHP 5.6+ Compatible                           //
//                                                           //
/////////////////////////////////////////////////////////////*/

class mgtTemplate {

	public $joConn = null;

	function __construct() {
		global $joDbht, $joDbun, $joDbpw, $joDbnm;
		$conn = mysqli_connect($joDbht, $joDbun, $joDbpw) OR exit('<br/>ERROR! - Failure connecting to the database!'); 
		mysqli_select_db($conn, $joDbnm) OR exit('<br />ERROR! - Failure selecting the database!');
		$this->joConn = $conn;
	}

	function joQuery($sqlString, $type) {  
		$sqlString=rtrim($sqlString, ", ");
		$sqlString=rtrim($sqlString, ",");

		switch($type) {
			case 1: 
				$query = mysqli_query($this->joConn, $sqlString);

				//if(mysqli_error($this->joConn)) {
				//	echo $sqlString.mysqli_error($this->joConn);
				//}

				return $query;
			break;
			case 2: 
				if(mysqli_query($this->joConn, $sqlString)) {
					return true;
				} else {
					return false;
				}
			break;
		}
	}

	function joEscape($str) {
		return mysqli_escape_string($this->joConn, $str);
	}

	function joLastId() {
		return mysqli_insert_id($this->joConn);
	}

	function JoColorRatio($ratio) {
		if($ratio > 0.00) {
			$ratio = '<span style="color:#00FF00"; font-weight:bold;>'.$ratio.'</span>';
		} elseif($ratio < 0.00) {
			$ratio = '<span style="color:#FF0000"; font-weight:bold;>'.$ratio.'</span>';
		}
		return $ratio;
	}
	
	function joFormatTime($time) {
		$hrs = ""; $mins = ""; $secs = "";
		if($time > 59) {
			$mins = floor($time/60);
			$secs = floor($time) - ($mins*60);
			if($secs > 0 && $secs < 10) {
				$secs = "0".$secs;
			}
			if($mins > 59) {
				$hrs = floor($mins/60);
				$mins = $mins - ($hrs*60);
				if($mins > 0 && $mins < 10) $mins = "0".$mins;
			} elseif($mins > 0 && $mins < 10) {
				$mins = "0".$mins;
			}
			
			if ($secs < 1) $secs = "00";
			if ($mins < 1) $mins = "00";
			if ($hrs < 1) $hrs = "00";
			if ($hrs > 0 && $hrs < 10) $hrs = "0".$hrs;
			$format = $hrs.":".$mins.":".$secs;
		} elseif($time < 60 && $time > 9) {
			$format = "00:00:".floor($time);
		} else {
			$format = "00:00:0".floor($time);
		}
		return $format;
	}
	
	function GetJoRank($rating) {
		global $ranks_table;
		$sql = $this->joQuery("SELECT * FROM $ranks_table WHERE rating <= '".$rating."' ORDER BY rating DESC", 1);
		$row = mysqli_fetch_assoc($sql);
		if(!$row["image"]) {
			$rank["image"] = "new.gif";
			$rank["name"] = "Recruit";
		} else {
			$rank["image"] = $row["image"];
			$rank["name"] = $row["name"];
		}
		return $rank;
	}
	
	function GetJoMultiList($url, $page, $total, $perPage) {
		if($total <= 1 || $total == "" || !isset($total) || $total < $perPage) {
			$multiPage = "";
		} else {
			$tpages = ceil($total/$perPage);
			
			$multiPage = '<br /><span id="mgt_title"><a href="'.$url.'1" id="mgt_title">First</a> - ';
			
			$start = 1;
			if($page > 3) $start = $page - 2;
			$end = $start + 5;
			if($end > $tpages) $end = $tpages+1;
			for($i = $start; $i < $end; $i++) {
				if($i == $page) {
					$multiPage .= $i." ";
				} else {
					$multiPage .= '<a href="'.$url.$i.'" id="mgt_title">'.$i.'</a> ';
				}
			}
			$multiPage .= ' - <a href="'.$url.$tpages.'" id="mgt_title">Last</a></span>';
		}
		return $multiPage;
	}
	
	function getjoConditionsM($condServer, $condStats, $condTeam, $condGame) {
		global $stats_table, $stats_m_table, $servers_table, $teamArray, $gametypes, $weaponstats_m_table, 
		       $weaponstats_table, $vehiclestats_table, $vehiclestats_m_table, $mapstats_table, $mapstats_m_table;
		
		$statsSelected2 = ""; 
		$statsSelected1 = "";
		$condArray["server"] = "";
		$condArray["team"] = "";
		$condArray["gametype"] = "";
		$i = 0;
		
		switch($condStats) {
			case 1: 
				$condArray["table"]  = " ".$stats_table." "  ; 
				$condArray["tableW"] = " ".$weaponstats_table." "; 
				$condArray["tableV"] = " ".$vehiclestats_table." "; 
				$condArray["tableM"] = " ".$mapstats_table." "; 
				$statsSelected1 = 'selected="selected"'; 
				$condArray["selcStatsType"] = 'Overall Stats'; 
			break;
			case 2: 
				$condArray["table"]  = " ".$stats_m_table." "; 
				$condArray["tableW"] = " ".$weaponstats_m_table." ";
				$condArray["tableV"] = " ".$vehiclestats_m_table." "; 
				$condArray["tableM"] = " ".$mapstats_m_table." "; 
				$statsSelected2 = 'selected="selected"'; 
				$condArray["selcStatsType"] = 'Monthly Stats'; 
			break;
		}
				
		$condArray["statsType"] = '<option value="1" '.$statsSelected1.'>Overall</option>';
		$sql = $this->joQuery("SELECT * FROM $stats_m_table", 1);
		if(mysqli_num_rows($sql) > 0) $condArray["statsType"] .= '<option value="2" '.$statsSelected2.'>Monthly</option>';

		
		if($condServer > 0) {
			$condArray["server"] = " AND ".$condArray["table"].".server = '".$condServer."' ";
		}
		
		$condArray["serverList"] = '<option value="0" selected="selected">All</option>';
		
		$sql = $this->joQuery("SELECT * FROM ".$condArray["table"]." GROUP BY ".$condArray["table"].".server", 1);
		while($row = mysqli_fetch_assoc($sql)) {
			$selected = "";
			if($row["server"] == $condServer) $selected = 'selected="selected"';
			$sql2 = $this->joQuery("SELECT * FROM $servers_table WHERE id = '".$row["server"]."'", 1);
			$row2 = mysqli_fetch_assoc($sql2);
			$condArray["serverList"] .= '<option value="'.$row["server"].'" '.$selected.'>'.$row2["name"].'</option>';
		}
		
		if($condGame != 0 && $condGame != 1) {
			$condArray["gametype"] = " AND ".$condArray["table"].".game_type = '".$condGame."' ";
		} elseif($condGame == 1) {
			$condArray["gametype"] = " AND ".$condArray["table"].".game_type NOT LIKE ('Cooperative') ";
		}
		



		$condArray["gameList"] = '<option value="0" '.($condGame == 0 ? 'selected="selected"' : '').'>All</option>';
		$condArray["gameList"] .= '<option value="1" '.($condGame == 1 ? 'selected="selected"' : '').'>Exclude Coop</option>';
		
		$sql = $this->joQuery("SELECT * FROM ".$condArray["table"]." GROUP BY ".$condArray["table"].".game_type", 1);
		while($row = mysqli_fetch_assoc($sql)) {
			$condArray["gameList"] .= '<option value="'.$row["game_type"].'" '.($row["game_type"] === $condGame ? 'selected="selected"' : '').'>'.$row["game_type"].'</option>';
			$gameTypeRow[$i] = $row["game_type"];
		}
		
		if($condTeam > -1 && $condTeam != "") {
			$condArray["team"] = " AND ".$condArray["table"].".team = '".$condTeam."' ";
		}
		
		if($condGame == "Deathmatch") {
			$condArray["team"] = " ";
		}

		$condArray["teamList"] = '<option value="-1" selected="selected">All</option>';
			
		$sql = $this->joQuery("SELECT * FROM ".$condArray["table"]." GROUP BY ".$condArray["table"].".team", 1);
		while($row = mysqli_fetch_assoc($sql)) {
			$selected = "";
			if($row["team"] == $condTeam) $selected = 'selected="selected"';
			$condArray["teamList"] .= '<option value="'.$row["team"].'" '.$selected.'>'.$teamArray[$row["team"]].'</option>';
		}
		
		return $condArray;
	}
	
	function getjoConditionsS($condServer, $condStats, $condTeam, $condGame, $id, $type) {
		global $stats_table, $stats_m_table, $servers_table, $teamArray, $gametypes, $weaponstats_m_table, 
		       $weaponstats_table, $vehiclestats_table, $vehiclestats_m_table, $mapstats_table, $mapstats_m_table;
		
		$selectedExc           = "";
		$selectedAll           = "";
		$statsSelected2        = "";
		$statsSelected1        = "";
		$condArray["server"]   = "";
		$condArray["team"]     = "";
		$condArray["gametype"] = "";
		
		switch($condStats) {
			case 1: 
				$condArray["table"]  = " ".$stats_table." "  ; 
				$condArray["tableW"] = " ".$weaponstats_table." "; 
				$condArray["tableV"] = " ".$vehiclestats_table." "; 
				$condArray["tableM"] = " ".$mapstats_table." "; 
				$statsSelected1 = 'selected="selected"'; 
				$condArray["selcStatsType"] = 'Overall Stats'; 
			break;
			case 2: 
				$condArray["table"]  = " ".$stats_m_table." "; 
				$condArray["tableW"] = " ".$weaponstats_m_table." ";
				$condArray["tableV"] = " ".$vehiclestats_m_table." "; 
				$condArray["tableM"] = " ".$mapstats_m_table." "; 
				$statsSelected2 = 'selected="selected"'; 
				$condArray["selcStatsType"] = 'Monthly Stats'; 
			break;
		}
				
		$condArray["statsType"] = '<option value="1" '.$statsSelected1.'>Overall</option>';
		switch($type) {
			case "player": 
				$sql = $this->joQuery("SELECT * FROM $stats_m_table WHERE player = '".$id."'", 1);
			break;
			case "weapon": 
				$sql = $this->joQuery("SELECT $stats_m_table.*, ".$condArray["tableW"].".*  
				                       FROM $stats_m_table, ".$condArray["tableW"]." 
									   WHERE ".$condArray["tableW"].".record = $stats_m_table.id 
									   AND ".$condArray["tableW"].".weapon = '".$id."'", 1);
			break;
			case "weapons": 
				$sql = $this->joQuery("SELECT $stats_m_table.*, ".$condArray["tableW"].".*  
				                       FROM $stats_m_table, ".$condArray["tableW"]." 
									   WHERE ".$condArray["tableW"].".record = $stats_m_table.id 
									   AND $stats_m_table.id = '".$id."'", 1);
			break;
			case "vehicle": 
				$sql = $this->joQuery("SELECT $stats_m_table.*, ".$condArray["tableV"].".*  
				                       FROM $stats_m_table, ".$condArray["tableV"]." 
									   WHERE ".$condArray["tableV"].".record = $stats_m_table.id 
									   AND ".$condArray["tableV"].".vehicle = '".$id."'", 1);
			break;
			case "vehicles": 
				$sql = $this->joQuery("SELECT $stats_m_table.*, ".$condArray["tableV"].".*  
				                       FROM $stats_m_table, ".$condArray["tableV"]." 
									   WHERE ".$condArray["tableV"].".record = $stats_m_table.id 
									   AND $stats_m_table.id = '".$id."'", 1);
			break;
			case "map": 
				$sql = $this->joQuery("SELECT $stats_m_table.*, ".$condArray["tableM"].".*  
				                       FROM $stats_m_table, ".$condArray["tableM"]." 
									   WHERE ".$condArray["tableM"].".record = $stats_m_table.id 
									   AND ".$condArray["tableM"].".map = '".$id."'", 1);
			break;
		}
		if(mysqli_num_rows($sql) > 0) $condArray["statsType"] .= '<option value="2" '.$statsSelected2.'>Monthly</option>';

		
		if($condServer > 0) {
			$condArray["server"] = " AND ".$condArray["table"].".server = '".$condServer."' ";
		}
		
		$condArray["serverList"] = '<option value="0" selected="selected">All</option>';
		
		switch($type) {
			case "player": 
				$sql = $this->joQuery("SELECT * FROM ".$condArray["table"]." WHERE player = '".$id."' 
				                                                             GROUP BY ".$condArray["table"].".server", 1);
			break;
			case "weapon": 
				$sql = $this->joQuery("SELECT ".$condArray["table"].".*, ".$condArray["tableW"].".*  
				                       FROM ".$condArray["table"].", ".$condArray["tableW"]." 
									   WHERE ".$condArray["tableW"].".record = ".$condArray["table"].".id 
									   AND ".$condArray["tableW"].".weapon = '".$id."' 
									   GROUP BY ".$condArray["table"].".server", 1);
			break;
			case "weapons": 
				$sql = $this->joQuery("SELECT ".$condArray["table"].".*, ".$condArray["tableW"].".*  
				                       FROM ".$condArray["table"].", ".$condArray["tableW"]." 
									   WHERE ".$condArray["tableW"].".record = ".$condArray["table"].".id 
									   AND ".$condArray["table"].".id = '".$id."' 
									   GROUP BY ".$condArray["table"].".server", 1);
			break;
			case "vehicle": 
				$sql = $this->joQuery("SELECT ".$condArray["table"].".*, ".$condArray["tableV"].".*  
				                       FROM ".$condArray["table"].", ".$condArray["tableV"]." 
									   WHERE ".$condArray["tableV"].".record = ".$condArray["table"].".id 
									   AND ".$condArray["tableV"].".vehicle = '".$id."' 
									   GROUP BY ".$condArray["table"].".server", 1);
			break;
			case "vehicles": 
				$sql = $this->joQuery("SELECT ".$condArray["table"].".*, ".$condArray["tableV"].".*  
				                       FROM ".$condArray["table"].", ".$condArray["tableV"]." 
									   WHERE ".$condArray["tableV"].".record = ".$condArray["table"].".id 
									   AND ".$condArray["table"].".id = '".$id."' 
									   GROUP BY ".$condArray["table"].".server", 1);
			break;
			case "map": 
				$sql = $this->joQuery("SELECT ".$condArray["table"].".*, ".$condArray["tableM"].".*  
				                       FROM ".$condArray["table"].", ".$condArray["tableM"]." 
									   WHERE ".$condArray["tableM"].".record = ".$condArray["table"].".id 
									   AND ".$condArray["tableM"].".map = '".$id."' 
									   GROUP BY ".$condArray["table"].".server", 1);
			break;
		}
		
		while($row = mysqli_fetch_assoc($sql)) {
			$selected = "";
			if($row["server"] == $condServer) $selected = 'selected="selected"';
			$sql2 = $this->joQuery("SELECT * FROM $servers_table WHERE id = '".$row["server"]."'", 1);
			$row2 = mysqli_fetch_assoc($sql2);
			$condArray["serverList"] .= '<option value="'.$row["server"].'" '.$selected.'>'.$row2["name"].'</option>';
		}

		if($condTeam > -1 && $condTeam != "") {
			$condArray["team"] = " AND ".$condArray["table"].".team = '".$condTeam."' ";
		}
		
		if($condGame == "Deathmatch") {
			$condArray["team"] = " ";
		}
		
		$condArray["teamList"] = '<option value="-1" selected="selected">All</option>';
		
		switch($type) {
			case "player": 
				$sql = $this->joQuery("SELECT * FROM ".$condArray["table"]." WHERE player = '".$id."' 
				                                                             GROUP BY ".$condArray["table"].".team", 1);
			break;
			case "weapon": 
				$sql = $this->joQuery("SELECT ".$condArray["table"].".*, ".$condArray["tableW"].".*  
				                       FROM ".$condArray["table"].", ".$condArray["tableW"]." 
									   WHERE ".$condArray["tableW"].".record = ".$condArray["table"].".id 
									   AND ".$condArray["tableW"].".weapon = '".$id."' 
									   GROUP BY ".$condArray["table"].".team", 1);
			break;
			case "vehicle": 
				$sql = $this->joQuery("SELECT ".$condArray["table"].".*, ".$condArray["tableV"].".*  
				                       FROM ".$condArray["table"].", ".$condArray["tableV"]." 
									   WHERE ".$condArray["tableV"].".record = ".$condArray["table"].".id 
									   AND ".$condArray["tableV"].".vehicle = '".$id."' 
									   GROUP BY ".$condArray["table"].".team", 1);
			break;
			case "map": 
				$sql = $this->joQuery("SELECT ".$condArray["table"].".*, ".$condArray["tableM"].".*  
				                       FROM ".$condArray["table"].", ".$condArray["tableM"]." 
									   WHERE ".$condArray["tableM"].".record = ".$condArray["table"].".id 
									   AND ".$condArray["tableM"].".map = '".$id."' 
									   GROUP BY ".$condArray["table"].".team", 1);
			break;
		}
		
		while($row = mysqli_fetch_assoc($sql)) {
			$selected = "";
			if($row["team"] == $condTeam) $selected = 'selected="selected"';
			$condArray["teamList"] .= '<option value="'.$row["team"].'" '.$selected.'>'.$teamArray[$row["team"]].'</option>';
		}
		
		if($condGame != '0' && $condGame != '1') {
			$condArray["gametype"] = " AND ".$condArray["table"].".game_type = '".$condGame."' ";
		} elseif($condGame == '1') {
			$selectedExc = 'selected="selected"';
			$condArray["gametype"] = " AND ".$condArray["table"].".game_type NOT LIKE ('Cooperative') ";
		}
		
		if($condGame == '0') $selectedAll = 'selected="selected"';
		
		$condArray["gameList"] = '<option value="0" '.$selectedAll.'>All</option>';
		$condArray["gameList"] .= '<option value="1" '.$selectedExc.'>Exclude Coop</option>';
		
		switch($type) {
			case "player": 
				$sql = $this->joQuery("SELECT * FROM ".$condArray["table"]." WHERE player = '".$id."' 
				                                                             GROUP BY ".$condArray["table"].".game_type", 1);
			break;
			case "weapon": 
				$sql = $this->joQuery("SELECT ".$condArray["table"].".*, ".$condArray["tableW"].".*  
				                       FROM ".$condArray["table"].", ".$condArray["tableW"]." 
									   WHERE ".$condArray["tableW"].".record = ".$condArray["table"].".id 
									   AND ".$condArray["tableW"].".weapon = '".$id."' 
									   GROUP BY ".$condArray["table"].".game_type", 1);
			break;
			case "vehicle": 
				$sql = $this->joQuery("SELECT ".$condArray["table"].".*, ".$condArray["tableV"].".*  
				                       FROM ".$condArray["table"].", ".$condArray["tableV"]." 
									   WHERE ".$condArray["tableV"].".record = ".$condArray["table"].".id 
									   AND ".$condArray["tableV"].".vehicle = '".$id."' 
									   GROUP BY ".$condArray["table"].".game_type", 1);
			break;
			case "map": 
				$sql = $this->joQuery("SELECT ".$condArray["table"].".*, ".$condArray["tableM"].".*  
				                       FROM ".$condArray["table"].", ".$condArray["tableM"]." 
									   WHERE ".$condArray["tableM"].".record = ".$condArray["table"].".id 
									   AND ".$condArray["tableM"].".map = '".$id."' 
									   GROUP BY ".$condArray["table"].".game_type", 1);
			break;
		}
		
		while($row = mysqli_fetch_assoc($sql)) {
			$selected = "";
			if($row["game_type"] == $condGame) $selected = 'selected="selected"';
			$condArray["gameList"] .= '<option value="'.$row["game_type"].'" '.$selected.'>'.$row["game_type"].'</option>';
		}
		
		return $condArray;
	}
	
	function GetJoWeaponLevel($kills, $wpnID) {
		global $weaponstats_table;
		$div = 2000/50;
		$row["w_exp"] = "";

		if($kills == 0 || $div == 0) {
			$ws_exp = 'Level <span style="font-weight: bold;">0/50</span>';
		} else {
			$Lkills = $kills/$div;
			if(floor($Lkills) > 49) {
			  $row["w_exp"] = 50;
			} else {
			  $row["w_exp"] = floor($Lkills);
			}
		}
		
		if($row["w_exp"] > 49) {
			$ws_exp = '<img src="./weapons/mastered.gif" />';
		} else {
			switch($row["w_exp"]) {
				case 0: 
					$ws_exp = 'Level <span style="font-weight: bold;">0/50</span>';
				break;
				case $row["w_exp"] < 5: 
					$ws_exp = 'Level <span style="color:#FF0000;font-weight: bold;">'.$row["w_exp"].'</span>'; 
					$ws_exp .= '<span style="font-weight: bold;">/50</span>';
				break;
				case $row["w_exp"] < 10: 
					$ws_exp = 'Level <span style="color:#FF6600;font-weight: bold;">'.$row["w_exp"].'</span>'; 
					$ws_exp .= '<span style="font-weight: bold;">/50</span>';
				break;
				case $row["w_exp"] < 15: 
					$ws_exp = 'Level <span style="color:#FF9900;font-weight: bold;">'.$row["w_exp"].'</span>'; 
					$ws_exp .= '<span style="font-weight: bold;">/50</span>';
				break;
				case $row["w_exp"] < 20: 
					$ws_exp = 'Level <span style="color:#FFCC00;font-weight: bold;">'.$row["w_exp"].'</span>'; 
					$ws_exp .= '<span style="font-weight: bold;">/50</span>';
				break;
				case $row["w_exp"] < 25: 
					$ws_exp = 'Level <span style="color:#FFFF00;font-weight: bold;">'.$row["w_exp"].'</span>'; 
					$ws_exp .= '<span style="font-weight: bold;">/50</span>';
				break;
				case $row["w_exp"] < 30: 
					$ws_exp = 'Level <span style="color:#CCFF00;font-weight: bold;">'.$row["w_exp"].'</span>'; 
					$ws_exp .= '<span style="font-weight: bold;">/50</span>';
				break;
				case $row["w_exp"] < 35: 
					$ws_exp = 'Level <span style="color:#99FF00;font-weight: bold;">'.$row["w_exp"].'</span>'; 
					$ws_exp .= '<span style="font-weight: bold;">/50</span>';
				break;
				case $row["w_exp"] < 42: 
					$ws_exp = 'Level <span style="color:#66FF00;font-weight: bold;">'.$row["w_exp"].'</span>'; 
					$ws_exp .= '<span style="font-weight: bold;">/50</span>';
				break;
				case $row["w_exp"] < 50: 
					$ws_exp = 'Level <span style="color:#00FF00;font-weight: bold;">'.$row["w_exp"].'</span>';
					$ws_exp .= '<span style="font-weight: bold;">/50</span>'; 
				break;
			}
		}
		
		return $ws_exp;
	}
	
	function GetJoMapTop($mid) {
		global $mapstats_table, $stats_table, $players_table;
		$top = array("hiScore", "mostKills", "hiRatio", "flawless");
		foreach($top as $index => $stat) {
			$sql = $this->joQuery("SELECT MAX($mapstats_table.".$stat.") AS ".$stat.", 
			                           $mapstats_table.record, 
			                           $mapstats_table.map, $stats_table.player  
								   FROM $stats_table, $mapstats_table WHERE $mapstats_table.map = '".$mid."' 
								   AND $mapstats_table.record = $stats_table.id GROUP BY $stats_table.player 
								   ORDER BY ".$stat." DESC", 1);
			if(!$row = mysqli_fetch_assoc($sql));
			$mapTop[$stat][0] = $row[$stat];
			$sql = $this->joQuery("SELECT name FROM $players_table WHERE id = '".$row["player"]."'", 1);
			$row = mysqli_fetch_assoc($sql);
			$mapTop[$stat][1] = $row["name"];
		}
		return $mapTop;
	}
	
	function GetJoGameDetails($gametype) {
		switch($gametype) {
			case '0':
				$array = array("PSP Takeovers"  => "pspTakeovers", "LFP Takeovers" => "campTakeovers", 
				               "Zone Time" => "tkothTime"        , "Targets"       => "targets"      , 
							   "Flags Captured" => "flagCapt");
			break;
			case '1':
				$array = array("PSP Takeovers"  => "pspTakeovers", "LFP Takeovers" => "campTakeovers", 
				               "Zone Time" => "tkothTime"        , "Targets"       => "targets"      , 
							   "Flags Captured" => "flagCapt");
			break;
			case "Team Deathmatch":
				$array = array("PSP Takeovers"  => "pspTakeovers");
			break;
			case "Cooperative":
				$array = array("PSP Takeovers"  => "pspTakeovers", "Targets" => "targets");
			break;
			case "Team King of the Hill":
				$array = array("PSP Takeovers"  => "pspTakeovers", "Zone Time"    => "tkothTime", 
				               "Zone A-Kills"   => "score_1"     , "Zone D-Kills" => "score_2");
			break;
			case "King of the Hill":
				$array = array("PSP Takeovers"  => "pspTakeovers", "Zone Time"    => "tkothTime", 
				               "Zone A-Kills"   => "score_1"     , "Zone D-Kills" => "score_2");
			break;
			case "Search and Destroy":
				$array = array("PSP Takeovers"  => "pspTakeovers", "Targets"       => "targets",
				               "Zone A-Kills"   => "zoneAtt"     , "Zone D-Kills" => "zoneDef");
			break;
			case "Attack and Defend":
				$array = array("PSP Takeovers"  => "pspTakeovers", "Targets"       => "targets",
				               "Zone A-Kills"   => "zoneAtt"     , "Zone D-Kills" => "zoneDef");
			break;
			case "Capture the Flag":
				$array = array("Flags Captured"  => "flagCapt", "Flags Saved"     => "flagSaves",
				               "Flags Picked up" => "flagPick", "Carriers Killed" => "flagCarr");
			break;
			case "Flagball":
				$array = array("Flags Captured"  => "flagCapt", "Flags Saved"     => "flagSaves",
				               "Flags Picked up" => "flagPick", "Carriers Killed" => "flagCarr" ,
							   "Flags A-Kills"   => "score_1" , "Flags D-Kills"   => "score_2");
			break;
			case "Advance and Secure":
				$array = array("PSP Takeovers"  => "pspTakeovers", "LFP Takeovers" => "campTakeovers");
			break;
			case "Conquer and Control":
				$array = array("Flags Captured" => "flagCapt"    , "Carriers Killed" => "flagCarr" ,
							   "Flags A-Kills"  => "score_1"     , "Flags D-Kills"   => "score_2"  , 
							   "PSP Takeovers"  => "pspTakeovers", "LFP Takeovers"   => "campTakeovers");
			break;
			case "Deathmatch":
				$array = array();
			break;
		}
		
		return $array;
	}
 
	function getMgtTpl($file) {
		if(!file_exists($file)) {
			return false;
		} else {
			return true;
		}
	}
	
	function buildMgtTpl($varArray, $sqlArray, $size, $file, $section) {
		global $wpn_img, $veh_img, $veh_attach, $teamArray, $vehiclestats_table, $playerawards_table;
		global $awards_table, $layouts_table, $veh_common;
		$tpl = file_get_contents($file);
		if($section != "") {
			$section_start = "---section ".$section." start---";
			$section_end = "---section ".$section." end---";
			$start =  strpos($tpl, $section_start) + strlen($section_start);
			$end =  strpos($tpl, $section_end);
			$sub = substr($tpl, $start, $end - $start);
			$tpl = $sub;
		}
		
		$defaultFields = true;
		$varArray["layout"] = "";
		$fSql = $this->joQuery("SELECT * FROM $layouts_table WHERE page = '".substr($file, 7, -4)."'", 1);
		if(@mysqli_num_rows($fSql) > 0) {

			$defaultFields = false;
			$fRow = mysqli_fetch_assoc($fSql);
			$fSplit = explode(",", $fRow["fields"]);
			foreach($fSplit as $fField) {
				$varArray["layout"] .= '<td align="right">{'.$varArray["prefix"].$fField.'}</td>';
			}
		} else {
			$defaultFields = true;
		}

		if($defaultFields) {

			switch(substr($file, 7, -4)) {
				case "kill_stats":

					$varArray["layout"] = '<td align="right">{'.$varArray["prefix"].'kills}</td>
										   <td align="right">{'.$varArray["prefix"].'deaths}</td>
										   <td align="right">{'.$varArray["prefix"].'ratio}</td>
										   <td align="right">{'.$varArray["prefix"].'headshots}</td>
										   <td align="right">{'.$varArray["prefix"].'multiKills}</td>
										   <td align="right">{'.$varArray["prefix"].'awards}</td>
										   <td align="right">{'.$varArray["prefix"].'totalTime}</td>';
				break;
			}
		}

		if(sizeof($varArray) > 0) {
			foreach($varArray as $tag => $value) {
				$holder = "{".$tag."}";
				$tpl = str_replace($holder, $value, $tpl);
			}
			if(isset($varArray["offset"])) {$num = $varArray["offset"];} else {$num = 1;}
		}
		for($i = 0; $i < $size; $i++) {

			if(empty($sqlArray[$i])) continue;

			$sql = $this->joQuery($sqlArray[$i]["query"]." FROM ".$sqlArray[$i]["tables"].$sqlArray[$i]["conditions"], 1);
			if($sqlArray[$i]["type"] == "single") {
				$row = mysqli_fetch_assoc($sql);
				
				if(isset($row["totalTime"])) $row["totalTime"] = $this->joFormatTime($row["totalTime"]);
				if(isset($row["rating"])) {
					$rank = $this->GetJoRank($row["rating"]);
					$row["rImage"] = $rank["image"];
					$row["rName"] = $rank["name"];
				}
				
				if(isset($row["m_name"])) $row["m_name"] = base64_decode($row["m_name"]);
				
				foreach($row as $tag => $value) {
					$holder = "{".$sqlArray[$i]["prefix"]."_".$tag."}";
					$tpl = str_replace($holder, $value, $tpl);
				}
			} elseif($sqlArray[$i]["type"] == "multi") {


				//print query for debugging!
				//echo "DEBUG MODE:<br /><br />".$sqlArray[$i]['query']." FROM ".
				//$sqlArray[$i]['tables'].$sqlArray[$i]['conditions']."<br><br><br>";

				$h = $i;
				if($sqlArray[$i]["prefix"] == "list2") {
					$num = 0;
				}

				$new_sub = "";
				$num = $num + 1;
				$section_start = "---loop ".$sqlArray[$i]["prefix"]." start---";
				$section_end = "---loop ".$sqlArray[$i]["prefix"]." end---";
				$start =  strpos($tpl, $section_start) + strlen($section_start);
				$end =  strpos($tpl, $section_end);
				$sub = substr($tpl, $start, $end - $start);
				$sql = $this->joQuery($sqlArray[$i]["query"]." FROM ".$sqlArray[$i]["tables"].$sqlArray[$i]["conditions"], 1);

				while($row = @mysqli_fetch_assoc($sql)) {

					$row["class"] = $num % 2 == 0 ? "js_row1" : "js_row2";
	
					if(!isset($row["w_id"])) $row["w_id"] = "";
					if(isset($row["totalTime"])) $row["totalTime"] = $this->joFormatTime($row["totalTime"]);
					if(isset($row["w_totalTime"])) $row["w_totalTime"] = $this->joFormatTime($row["w_totalTime"]);
					if(isset($row["v_totalTime"])) $row["v_totalTime"] = $this->joFormatTime($row["v_totalTime"]);
					if(isset($row["m_totalTime"])) $row["m_totalTime"] = $this->joFormatTime($row["m_totalTime"]);

					if(isset($row["rating"])) {
						$rank = $this->GetJoRank($row["rating"]);
						$row["rImage"] = $rank["image"];
						$row["rName"] = $rank["name"];
					}
					
					if(isset($row["m_name"])) $row["m_name"] = base64_decode($row["m_name"]);
					
					if(isset($row["w_name"])) @$row["w_image"] = $wpn_img[$row["w_name"]];
					if(isset($row["v_name"])) {
						foreach($veh_common as $vehn => $vehi) {
							if(strstr(strtolower($row["v_name"]), $vehn)) {
								@$row["v_image"] = $vehi;
								break;
							}
						}
						if(strlen(@$row["v_image"]) == 0) @$row["v_image"] = $veh_img[$row["v_name"]];
						
					}
					if(isset($row["team"])) $row["team_name"] = $teamArray[$row["team"]];
					
					if(isset($row["ratio"])) $row["ratio"] = $this->JoColorRatio($row["ratio"]);
					if(isset($row["w_ratio"])) $row["w_ratio"] = $this->JoColorRatio($row["w_ratio"]);
					if(isset($row["v_ratio"])) $row["v_ratio"] = $this->JoColorRatio($row["v_ratio"]);
					if(isset($row["m_ratio"])) $row["m_ratio"] = $this->JoColorRatio($row["m_ratio"]);
					
					if(isset($row["attach"])) $row["attach"] = $veh_attach[$row["attach"]];
					
					if(isset($row["awards"]) && isset($row["wpn_awards"]) && isset($row["veh_awards"])) {
						$row["awards"] = '0';
						$row["wpn_awards"] = '0';
						$row["veh_awards"] = '0';
						$aSql = $this->joQuery("SELECT * FROM $playerawards_table WHERE player = '".$row["id"]."'", 1);
						while($aRow = mysqli_fetch_assoc($aSql)) {
							$awSql = $this->joQuery("SELECT * FROM $awards_table", 1);
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
					}
					


					if(strstr($file, "maps")) {
						if(isset($row["map"])) {
							$mapTop = $this->GetJoMapTop($row["map"]);
							foreach($mapTop as $stat => $array) {
								if($array[0] == 0) {
									$row[$stat] = "None<br />Recorded";
								} else {
									$row[$stat] = $array[1]."<br />(".$this->JoColorRatio($array[0]).")";
								}
							}
						}
					}
					
					if(isset($row["v_id"])) {
						$row["v_passenger"] = 0;
						$row["v_runover"]   = 0;
						$row["v_gunner"]    = 0;
						
						$vsql = $this->joQuery("SELECT SUM(kills) AS kills FROM $vehiclestats_table 
						                        WHERE vehicle = '".$row["v_id"]."' AND attach = '1' GROUP BY attach", 1);
						if($vrow = mysqli_fetch_assoc($vsql)) {
							$row["v_runover"] = $vrow["kills"];
						}
						$vsql = $this->joQuery("SELECT SUM(kills) AS kills FROM $vehiclestats_table 
						                        WHERE vehicle = '".$row["v_id"]."' AND attach = '2' GROUP BY attach", 1);
						if($vrow = mysqli_fetch_assoc($vsql)) {
							$row["v_passenger"] = $vrow["kills"];
						}
						$vsql = $this->joQuery("SELECT SUM(kills) AS kills FROM $vehiclestats_table 
						                        WHERE vehicle = '".$row["v_id"]."' AND attach = '3' GROUP BY attach", 1);
						if($vrow = mysqli_fetch_assoc($vsql)) {
							$row["v_gunner"] = $vrow["kills"];
						}
					}
					
					if(isset($row["w_accuracy"])) $row["w_exp"] = $this->GetJoWeaponLevel($row["w_kills"], $row["w_id"]);
					
					if(isset($row["tactical"])) $row["name"] = base64_decode($row["name"]);
					
					if(isset($row["action"])) {
						$logAction = explode("_", $row["action"]);
						$logAction[1] = empty($logAction[1]) ? '' : '('.$logAction[1].')';
						$row["action"] = implode(" ", $logAction);
					}
					
					$sub2 = $sub;
					$row["num"] = $num++;
					foreach($row as $tag => $value) {
						$holder = "{".$sqlArray[$i]["prefix"]."_".$tag."}";
						$sub2 = str_replace($holder, $value, $sub2);
					}
					$new_sub .= $sub2;
					
				}
	
				$tpl = str_replace($sub, $new_sub, $tpl);
				$tpl = str_replace($section_start, "", $tpl);
				$tpl = str_replace($section_end, "", $tpl);

			}
		}
		return $tpl;
	}
	
	function joErrorRet($code, $extra) {
		
		$contents = "<br /><table id=\"js_row3\" width=\"50%\"><tr><td align=\"center\"><br />";
		$contents .= "<u>Error code $code:</u><br><td></tr><tr><td align=\"left\">";
		switch($code) {
			case 1 : $contents .= "'$extra' file not found!"                          ; break;
			case 2 : $contents .= "Installation files not found!"                     ; break;
			case 3 : $contents .= "Please Delete the 'Install' Folder!"               ; break;
			case 4 : $contents .= "Please Change the 'admin name' and 'admin pass' in 
			                       the config.php to something only you will know!"   ; break;
			case 5 : $contents .= "For security purposes, you CANNOT leave the 'admin 
			                       name' or 'admin pass' in the config.php blank!"    ; break;
			default: $contents .= "<u>Error code ???:</u><br>Unknown Error"; 
		}
		
		$contents .= "<br /><br /></td></tr></table><br />";
		
		return $contents;
	}
}