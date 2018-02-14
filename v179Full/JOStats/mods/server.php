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
// File licence.txt must not be removed from the pack.       //
//                                                           //
// Author        : Peter Jones (AKA Azrael)                  //
// E-mail        : Email: p.jones188@btinternet.com          //
// Website       : http://www.messiahgamingtools.com         //
// Support       : http://www.babstats.com                   //
//                                                           //
// File Name     : Server Module                             //
// File Version  : 1.0.4 Standalone                          //
//                                                           //
/////////////////////////////////////////////////////////////*/

/*/////////////////////////////////////////////////////////////
//                                                           //
// Updated Dec 2016 By Novahq.net <scott@novahq.net>         //
// Standalone, PHP 5.6+ Compatible                           //
//                                                           //
/////////////////////////////////////////////////////////////*/

$file = "./tpls/server.tpl";

if(!$tpl->getMgtTpl($file)) {

	$varArray["content"] = $tpl->joErrorRet(1, $section." template");	
	
} else {

	$sid=(!empty($_GET['sid']) ? intval($_GET['sid']) : 0);
	$sub=((!empty($_GET['spage']) && $_GET['spage']==1) ? "restrictions" : "server");
	
	$varArray["formAction"] = "./?";
	$varArray["section"] = "server";
	$varArray["spage"] = $sub;
	$varArray["sid"] = $sid;
	
	$varArray["jo_list"]          = "";
	$varArray["rebel_list"]       = "";
	$varArray["serverInfo"]       = "";
	$varArray["wpnRestrictions"]  = "";
	$varArray["wpnRestrictions2"] = "";
	$varArray["clsRestrictions"]  = "";
	$varArray["tdmGames"]    = 0;
	$varArray["tdmJo"]       = 0;
	$varArray["tdmRebel"]    = 0;
	$varArray["coopGames"]   = 0;
	$varArray["coopJo"]      = 0;
	$varArray["coopRebel"]   = 0;
	$varArray["tkothGames"]  = 0;
	$varArray["tkothJo"]     = 0;
	$varArray["tkothRebel"]  = 0;
	$varArray["kothGames"]   = 0;
	$varArray["kothJo"]      = 0;
	$varArray["kothRebel"]   = 0;
	$varArray["sdGames"]     = 0;
	$varArray["sdJo"]        = 0;
	$varArray["sdRebel"]     = 0;
	$varArray["adGames"]     = 0;
	$varArray["adJo"]        = 0;
	$varArray["adRebel"]     = 0;
	$varArray["ctfGames"]    = 0;
	$varArray["ctfJo"]       = 0;
	$varArray["ctfRebel"]    = 0;
	$varArray["fbGames"]     = 0;
	$varArray["fbJo"]        = 0;
	$varArray["fbRebel"]     = 0;
	$varArray["aasGames"]    = 0;
	$varArray["aasJo"]       = 0;
	$varArray["aasRebel"]    = 0;
	$varArray["cacGames"]    = 0;
	$varArray["cacJo"]       = 0;
	$varArray["cacRebel"]    = 0;
	$varArray["dmGames"]     = 0;
	$varArray["dmJo"]        = 0;
	$varArray["dmRebel"]     = 0;
	$varArray["totalTime"]   = 0;
	$varArray["totalGames"]  = 0;
	$varArray["joWins"]      = 0;
	$varArray["rebelWins"]   = 0;
	$varArray["lastActive"]  = 0;

	
	$varArray["serverList"]="";
	$sql = $tpl->joQuery("SELECT * FROM $servers_table", 1);
	while($row = mysqli_fetch_assoc($sql)){
		if($row["id"] == $sid) {
			$varArray["serverList"] .= '<option value="'.$row["id"].'" selected="selected">'.htmlspecialchars($row["name"]).'</option>';
		} else {
			$varArray["serverList"] .= '<option value="'.$row["id"].'">'.htmlspecialchars($row["name"]).'</option>';
		}
	}
	
	$sql = $tpl->joQuery("SELECT * FROM $servers_table WHERE id = '".$sid."'", 1);
	$row = mysqli_fetch_assoc($sql);
	$varArray["lastActive"] = $row["lastUpdate"];
	$msql = $tpl->joQuery("SELECT * FROM $maps_table WHERE name = '".$row["map_name"]."'", 1);
	$mrow = mysqli_fetch_assoc($msql);

	$varArray["serverMap"] = (empty($mrow["image"]) ? "./maps/none.gif" : "./maps/".$mrow["image"]);
	$varArray["name"] = empty($row["name"]) ? "N/A" : htmlspecialchars($row["name"]);
	
	$lastUpdate = @strtotime($row["lastUpdate"]);
	$ctime = strtotime(date("Y-m-d H:i:s"));
	$ctimeDiff = $ctime - $lastUpdate;
	
	$sql = $tpl->joQuery("SELECT * FROM $serverstats_table WHERE serverid = '".$sid."'", 1);
	while($row2 = mysqli_fetch_assoc($sql)) {
		$varArray["totalTime"]   += $row2["time"];
		$varArray["totalGames"]  += $row2["games"];
		$varArray["joWins"]      += $row2["jo"];
		$varArray["rebelWins"]   += $row2["rebel"];
		switch($row2["game_type"]) {
			case "Team Deathmatch":
				$varArray["tdmGames"] = $row2["games"];
				$varArray["tdmJo"]    = $row2["jo"];
				$varArray["tdmRebel"] = $row2["rebel"];
			break;
			case "Cooperative":
				$varArray["coopGames"] = $row2["games"];
				$varArray["coopJo"]    = $row2["jo"];
				$varArray["coopRebel"] = $row2["rebel"];
			break;
			case "Team King of the Hill":
				$varArray["tkothGames"] = $row2["games"];
				$varArray["tkothJo"]    = $row2["jo"];
				$varArray["tkothRebel"] = $row2["rebel"];
			break;
			case "King of the Hill":
				$varArray["kothGames"] = $row2["games"];
				$varArray["kothJo"]    = $row2["jo"];
				$varArray["kothRebel"] = $row2["rebel"];
			break;
			case "Search and Destroy":
				$varArray["sdGames"] = $row2["games"];
				$varArray["sdJo"]    = $row2["jo"];
				$varArray["sdRebel"] = $row2["rebel"];
			break;
			case "Attack and Defend":
				$varArray["adGames"] = $row2["games"];
				$varArray["adJo"]    = $row2["jo"];
				$varArray["adRebel"] = $row2["rebel"];
			break;
			case "Capture the Flag":
				$varArray["ctfGames"] = $row2["games"];
				$varArray["ctfJo"]    = $row2["jo"];
				$varArray["ctfRebel"] = $row2["rebel"];
			break;
			case "Flagball":
				$varArray["fbGames"] = $row2["games"];
				$varArray["fbJo"]    = $row2["jo"];
				$varArray["fbRebel"] = $row2["rebel"];
			break;
			case "Advance and Secure":
				$varArray["aasGames"] = $row2["games"];
				$varArray["aasJo"]    = $row2["jo"];
				$varArray["aasRebel"] = $row2["rebel"];
			break;
			case "Conquer and Control":
				$varArray["cacGames"] = $row2["games"];
				$varArray["cacJo"]    = $row2["jo"];
				$varArray["cacRebel"] = $row2["rebel"];
			break;
			case "Deathmatch":
				$varArray["dmGames"] = $row2["games"];
			break;
		}
	}
	
	$varArray["totalTime"] = $tpl->joFormatTime($varArray["totalTime"]);
	
	if($ctimeDiff < 120) {
		foreach($row as $tag => $value) {
			$varArray[$tag] = $value;
		}
		
		$players = explode("_", $row["player_names"]);
		$teams   = explode("_", $row["player_teams"]);
		$weapons = explode("_", $row["player_weapons"]);
		
		$plyrNum = count($players);
		
		for($i = 0; $i < $plyrNum; $i++) {
			if($players[$i] != "Host") {
				if($num % 2 == 0){
					$class = "js_row1";
				} else {
					$class = "js_row2";
				}
				if($teams[$i] == 1) {
					$varArray["jo_list"] .= '<tr id="'.$class.'">
											   <td width="80">'.htmlspecialchars(base64_decode($players[$i])).'</td>
											   <td width="65">'.htmlspecialchars(base64_decode($weapons[$i])).'</td>
										   </tr>';
				} else {
					$varArray["rebel_list"] .= '<tr id="'.$class.'">
												  <td width="80">'.htmlspecialchars(base64_decode($players[$i])).'</td>
												  <td width="65">'.htmlspecialchars(base64_decode($weapons[$i])).'</td>
											   </tr>';
				}
			}
		}
		
		if($row["dedicated"] == 1) {$dedicated = "Yes";} else {$dedicated = "No";}
		
		$rules = explode("_", $row["rules"]);
		
		switch($row["state"]) {
			case 1: $state = "Loading"  ; break;
			case 3: $state = "Hosting"; break;
			case 4: $state = "Scoring"  ; break;
		}
		
		$gameType = array(
			"Team Deathmatch"       => "TDM"   , 
			"Cooperative"           => "COOP"  , 
			"Team King of the Hill" => "TKOTH" , 
			"King of the Hill"      => "KOTH"  , 
			"Search and Destroy"    => "SD"    , 
			"Attack and Defend"     => "AD"    , 
			"Capture the Flag"      => "CTF"   , 
			"Flagball"              => "FB"    , 
			"Advance and Secure"    => "AAS"   , 
		    "Conquer and Control"   => "CAC"   , 
			"Deathmatch"            => "DM" 
		);		
		
		$varArray["serverInfo"] = '<tr>
									 <td id="js_row1" width="60%">Game Mod</td>
									 <td id="js_row2" align="right" title="'.htmlspecialchars($gameMod[1][$row["game_mod"]]).'">'.
									                                         htmlspecialchars($gameMod[0][$row["game_mod"]]).'</td>
								 </tr>
								 <tr>
									 <td id="js_row1" width="60%">Gametype</td>
									 <td id="js_row2" align="right">'.htmlspecialchars($gameType[$row["game_type"]]).'</td>
								 </tr>
								 <tr>
									 <td id="js_row1">Map</td>
									 <td id="js_row2" align="right">
										<marquee behavior=scroll loop=infinite scrollamount=3 direction=left>
											'.htmlspecialchars(base64_decode($row["map_name"])).'
										</marquee>
									 </td>
								 </tr>
								 <tr>
									 <td id="js_row1">Status</td>
									 <td id="js_row2" align="right">'.$state.'</td>
								 </tr>
								 <tr>
									 <td id="js_row1">Players</td>
									 <td id="js_row2" align="right">'.$row["num_players"].'/'.$row["max_players"].'</td>
								 </tr>
								 <tr>
									 <td id="js_row1">Map Timer</td>
									 <td id="js_row2" align="right">'.$tpl->joFormatTime($row["time"]).'</td>
								 </tr>
								 <tr>
									 <td id="js_row1">Dedicated</td>
									 <td id="js_row2" align="right">'.$dedicated.'</td>
								 </tr>
								 <tr>
									 <td id="js_row1">Max FF Kills</td>
									 <td id="js_row2" align="right">'.htmlspecialchars($rules[8]).'</td>
								 </tr>
								 <tr>
									 <td id="js_row1">Start Delay</td>
									 <td id="js_row2" align="right">'.htmlspecialchars($rules[5]).' secs</td>
								 </tr>
								 <tr>
									 <td id="js_row1">Respawn Delay</td>
									 <td id="js_row2" align="right">'.htmlspecialchars($rules[1]).' secs</td>
								 </tr>
								 <tr>
									 <td id="js_row1">PSP Takeovers</td>
									 <td id="js_row2" align="right">'.htmlspecialchars($rules[6]).' secs</td>
								 </tr>
								 <tr>
									 <td id="js_row1">Score Limit</td>
									 <td id="js_row2" align="right">'.htmlspecialchars($rules[3]).' pts</td>
								 </tr>';
								 
		if($row["game_type"] != "Cooperative") $varArray["serverInfo"] .= '<tr>
																<td id="js_row1">Kill Limit</td>
																<td id="js_row2" align="right">'.htmlspecialchars($rules[2]).'</td>
															</tr>';
															
		if($row["game_type"] == "Team King of the Hill" || $row["game_type"] == "King of the Hill") $varArray["serverInfo"] .= '<tr>
																						  <td id="js_row1">Zone Limit</td>
																						  <td id="js_row2" align="right">'.htmlspecialchars($rules[4]).' Mins</td>
																					   </tr>';
																					   
		switch($rules[7]) {
			case 0: $lfp = "Fast"  ; break;
			case 1: $lfp = "Medium"; break;
			case 2: $lfp = "Slow"  ; break;
			default: $lfp = "";
		}
																					   
		if($row["game_type"] == "Advance and Secure" || $row["game_type"] == "Conquer and Control") $varArray["serverInfo"] .= '<tr>
																						  <td id="js_row1">LFP Takeover</td>
																						  <td id="js_row2" align="right">'.$lfp.'</td>
																						</tr>';
		
		if($sub == "restrictions") {
			
			$restSize = sizeof($res[$row["game_mod"]]) + 5;
			
			$servRest = explode("_", $row["restrictions"]);
			for($i = 5; $i < $restSize - 32; $i++) {
				switch($servRest[$i]) {
					case 0: $rest = "Never"  ; break;
					case 1: $rest = "Always" ; break;
					case 2: $rest = "Armory" ; break;
					case 3: $rest = "Mission"; break;
				}
				$varArray["wpnRestrictions"] .= '<tr>
												   <td id="js_row1">'.htmlspecialchars($res[$row["game_mod"]][$i]).'</td>
													<td id="js_row2" align="center">'.htmlspecialchars($rest).'</td>
											   </tr>';
			}
			
			$servRest = explode("_", $row["restrictions"]);
			for($i = 33; $i < $restSize; $i++) {
				switch($servRest[$i]) {
					case 0: $rest = "Never"  ; break;
					case 1: $rest = "Always" ; break;
					case 2: $rest = "Armory" ; break;
					case 3: $rest = "Mission"; break;
				}
				$varArray["wpnRestrictions2"] .= '<tr>
													<td id="js_row1">'.htmlspecialchars($res[$row["game_mod"]][$i]).'</td>
													<td id="js_row2" align="center">'.htmlspecialchars($rest).'</td>
												</tr>';
			}
			
			for($i = 0; $i < 5; $i++) {
				switch($servRest[$i]) {
					case 0: $rest = "Never"  ; break;
					case 1: $rest = "Always" ; break;
					case 2: $rest = "Mission"; break;
				}
				$varArray["clsRestrictions"] .= '<tr>
												   <td id="js_row1">'.htmlspecialchars($classes[$row["game_mod"]][$i]).'</td>
												   <td id="js_row2" align="center">'.htmlspecialchars($rest).'</td>
											   </tr>';
			}
		}
	} else {

		$varArray["serverMap"] = 'tpls/offline.png';

	}
	
	$sql = $tpl->joQuery("SELECT * FROM $serverhistory_table WHERE serverid = '".$sid."' AND date = '".date("Y-m-d")."'", 1);
	$todaysPlyrs = mysqli_num_rows($sql);
	$varArray["todays"] = $todaysPlyrs;
	
	$today = date("Y-m-d", mktime(0, 0, 0, date("m"), date("d"), date("Y")));
	$yesterday = date("Y-m-d", mktime(0, 0, 0, date("m"), date("d")-1, date("Y")));
	$thisWeek = date("Y-m-d", mktime(0, 0, 0, date("m"), date("d")-GetJoThisWeek(), date("Y")));
	$getLastweekS = GetJoThisWeek()+7;
	$getLastweekE = GetJoThisWeek()+1;
	$lastWeekS = date("Y-m-d", mktime(0, 0, 0, date("m"), date("d")-$getLastweekS, date("Y")));
	$lastWeekE = date("Y-m-d", mktime(0, 0, 0, date("m"), date("d")-$getLastweekE, date("Y")));
	$thisMonth = date("Y-m-d", mktime(0, 0, 0, date("m"), 1, date("Y")));
	$lastMonthS = date("Y-m-d", mktime(0, 0, 0, date("m")-1, 1, date("Y")));
	$lastMonthE = date("Y-m-d", mktime(0, 0, 0, date("m"), 0, date("Y")));
	$thisYear = date("Y-m-d", mktime(0, 0, 0, 1, 1, date("Y")));
	$lastYearS = date("Y-m-d", mktime(0, 0, 0, 1, 1, date("Y")-1));
	$lastYearE = date("Y-m-d", mktime(0, 0, 0, 1, 0, date("Y")));
	
	$sql = $tpl->joQuery("SELECT players FROM $serverhistory_table WHERE date = '".$yesterday."' AND serverid = '".$sid."'", 1);
	$row = mysqli_fetch_assoc($sql);
	if(empty($row)) {$varArray["yesterdays"] = 0;} else {$varArray["yesterdays"] = $row["players"];}
	
	$sql = $tpl->joQuery("SELECT SUM(players) AS players FROM $serverhistory_table 
	                      WHERE date >= '".$thisWeek."' AND serverid = '".$sid."' GROUP BY serverid", 1);
	$row = mysqli_fetch_assoc($sql);
	if(empty($row)) {$varArray["this_week"] = $todaysPlyrs;} else {$varArray["this_week"] = $row["players"] + $todaysPlyrs;}
	
	$sql = $tpl->joQuery("SELECT SUM(players) AS players FROM $serverhistory_table 
	                      WHERE date >= '".$lastWeekS."' AND date <= '".$lastWeekE."' AND serverid = '".$sid."' GROUP BY serverid", 1);
	$row = mysqli_fetch_assoc($sql);
	if(empty($row)) {$varArray["last_week"] = 0;} else {$varArray["last_week"] = $row["players"];}
	
	$sql = $tpl->joQuery("SELECT SUM(players) AS players FROM $serverhistory_table 
	                      WHERE date >= '".$thisMonth."' AND serverid = '".$sid."' GROUP BY serverid", 1);
	$row = mysqli_fetch_assoc($sql);
	if(empty($row)) {$varArray["this_month"] = $todaysPlyrs;} else {$varArray["this_month"] = $row["players"] + $todaysPlyrs;}
	
	$sql = $tpl->joQuery("SELECT SUM(players) AS players FROM $serverhistory_table 
	                      WHERE date >= '".$lastMonthS."' AND date <= '".$lastMonthE."' AND serverid = '".$sid."' GROUP BY serverid", 1);
	$row = mysqli_fetch_assoc($sql);
	if(empty($row)) {$varArray["last_month"] = 0;} else {$varArray["last_month"] = $row["players"];}
	
	$sql = $tpl->joQuery("SELECT SUM(players) AS players FROM $serverhistory_table 
	                      WHERE date >= '".$thisYear."' AND serverid = '".$sid."' GROUP BY serverid", 1);
	$row = mysqli_fetch_assoc($sql);
	if(empty($row)) {$varArray["this_year"] = $todaysPlyrs;} else {$varArray["this_year"] = $row["players"] + $todaysPlyrs;}
	
	$sql = $tpl->joQuery("SELECT SUM(players) AS players FROM $serverhistory_table 
	                      WHERE date >= '".$lastYearS."' AND date <= '".$lastYearE."' AND serverid = '".$sid."' GROUP BY serverid", 1);
	$row = mysqli_fetch_assoc($sql);
	if(empty($row)) {$varArray["last_year"] = 0;} else {$varArray["last_year"] = $row["players"];}
	
	$varArray["content"] = $tpl->buildMgtTpl($varArray, $sqlArray, 0, $file, $sub);
}