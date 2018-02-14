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

$file = "./tpls/compare.tpl";

if(!$tpl->getMgtTpl($file)) {

	$varArray["content"] = $tpl->joErrorRet(1, $section." template");	

} else {

	$player1=(!empty($_GET['player1']) ? $_GET['player1'] : "");
	$player2=(!empty($_GET['player2']) ? $_GET['player2'] : "");
	$condStats=(!empty($_GET['condStats']) ? intval($_GET['condStats']) : 1);
	$condTeam=(!empty($_GET['condTeam']) ? intval($_GET['condTeam']) : 0);
	$condGame=(!empty($_GET['condGame']) ? cMioD4($_GET['condGame']) : '0');
	$condServer=(!empty($_GET['condServer']) ? $_GET['condServer'] : 0);
	$status = 0;

	$varArray["formAction"] = "./?";
	$varArray["section"] = "compare";

	$varArray["condStats"]  = $condStats;
	$varArray["condTeam"]   = $condTeam;
	$varArray["condServer"] = $condServer;
	$varArray["condGame"]   = $condGame;
	
	$varArray["error"]   = "";
	$varArray["player1"] = $player1;
	$varArray["player2"] = $player2;

	$id1 = 0;
	$id2 = 0;

	if($player1=="" || $player2=="") {

		$varArray["error"] = '<span id="js_tableHead" style="color:#FF0000">Please Fill in both fields!</span><br />';
		$sub = "start";

	} else {

		$sql = $tpl->joQuery("SELECT * FROM $players_table", 1);

		while($row = mysqli_fetch_assoc($sql)) {

			//nice! NOVAHQ <no injection>
			if($row["name"] == $player1) {

				$id1 = $row["id"];

			} elseif($row["name"] == $player2) {

				$id2 = $row["id"];

			}
		}

		if(!$id1 && !$id2) {

			$varArray["error"] = '<span id="js_tableHead" style="color:#FF0000">"'.htmlspecialchars($player1).'" and "'.htmlspecialchars($player2).'" not found in the database!</span><br />';
			$sub = "start";

		} elseif($id1 > 0 && $id2 == 0) {

			$varArray["error"] = '<span id="js_tableHead" style="color:#FF0000">"'.htmlspecialchars($player2).'" not found in the database!</span><br />';
			$varArray["player1"] = htmlspecialchars($player1);

			$sub = "start";
		} elseif($id1 == 0 && $id2 > 0) {

			$varArray["error"] = '<span id="js_tableHead" style="color:#FF0000">"'.htmlspecialchars($player1).'" not found in the database!</span><br />';
			$varArray["player2"] = htmlspecialchars($player2);
			$sub = "start";

		} elseif($id1 > 0 && $id2 > 0) {

			$status = 1;

		}

		switch($condStats) {
			case 2:  $type  = "statsm"       ; 
			break;
			default:  $type  = "stats"       ;
		}
	
		if($status > 0) {

			$sub = "compare";

			$genArray = array(
				"Game Awards"    => "awards" ,
				"Weapon Awards"  => "wpn_awards",
				"Vehicle Awards" => "veh_awards",
				"MOTM Awards"    => "motm",
				"Games"          => "games",
				"Wins"           => "wins",
				"Lost"           => "lost",
				"Rating"         => "rating",
				"Win %"          => "winPer"
			);
			$statArray = array(
				"Kills"              => "kills",
				"Deaths"             => "deaths",
				"Ratio"              => "ratio",
				"Murders"            => "murders",
				"Suicides"           => "suicides",
				"Med Attempts"       => "medAttempts",
				"Med Heals"          => "medHeal",
				"Med Saves"          => "medSave",
				"Revived"            => "revived",
				"Headshots"          => "headshots",
				"Sniper Kills"       => "sniperkills",
				"Multi-Kills"        => "multiKills",
				"Knifings"           => "knifings",
				"Assists"            => "assists",
				"PSP's"              => "pspTakeovers",
				"LFP's"              => "campTakeovers",
				"Tkoth Time"         => "tkothTime",
				"AAS Time"           => "neutralTime",
				"Zone Att Kill"      => "zoneAtt",
				"Zone Def Kill"      => "zoneDef",
				"Flags Saves"        => "flagSaves",
				"Flags Captured"     => "flagCapt",
				"Flags Pickedup"     => "flagPick",
				"Flag Carrier Kills" => "flagCarr",
				"Targets Destroyed"  => "targets",
				"Total Time"         => "totalTime"
			);


			$cond = $tpl->getjoConditionsS($condServer, $condStats, $condTeam, $condGame, $id1, "player");

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

			$varArray["selcStatsType"] = $cond["selcStatsType"];
			$varArray["statsType"]     = $cond["statsType"];
			$varArray["serverList"]    = $cond["serverList"];
			$varArray["teamList"]      = $cond["teamList"];
			$varArray["gtypeList"]     = $cond["gameList"];

			$sql1 = $tpl->joQuery("SELECT ".$joSelect["player"].", ".$joSelect[$type]." 
								   FROM $players_table, ".$cond["table"]." 
								   WHERE $players_table.id = ".$cond["table"].".player  
								   AND ".$cond["table"].".player = '".$id1."' 
								   $conditions 
								   GROUP BY ".$cond["table"].".player", 1);
			$row1 = mysqli_fetch_assoc($sql1);

			if(empty($row1)) {
				echo "No data available, click back and select different options.";
				exit;
			}

			$row1["totalTime"] = $tpl->joFormatTime($row1["totalTime"]);
			$varArray["first_p_name"] = htmlspecialchars($row1["name"]);	
						 
			$sql2 = $tpl->joQuery("SELECT ".$joSelect["player"].", ".$joSelect[$type]." 
								   FROM $players_table, ".$cond["table"]." 
								   WHERE $players_table.id = ".$cond["table"].".player  
								   AND ".$cond["table"].".player = '".$id2."' 
								   $conditions 
								   GROUP BY ".$cond["table"].".player", 1);
			
			$row2 = mysqli_fetch_assoc($sql2);


			if(empty($row2)) {
				echo "No data available, click back and select different options.";
				exit;
			}

			$row2["totalTime"] = $tpl->joFormatTime($row2["totalTime"]);
			$varArray["second_p_name"] = htmlspecialchars($row2["name"]);
			
			$varArray["stats"] = "";
			foreach($statArray as $name => $stat) {
				if($name != "Deaths" && $name != "Murders" && $name != "suicides") {
					if($row1[$stat] > $row2[$stat]) {
						$row1[$stat] = '<span style="color:#00FF00; font-weight:bold;">'.$row1[$stat].'</span>';
						$idColor1 = "js_tableHead";
						$idColor2 = "js_row2";
					} elseif($row1[$stat] < $row2[$stat]) {
						$row2[$stat] = '<span style="color:#00FF00; font-weight:bold;">'.$row2[$stat].'</span>';
						$idColor1 = "js_row2";
						$idColor2 = "js_tableHead";
					} else {
						$idColor1 = "js_row2";
						$idColor2 = "js_row2";
					}
				} else {
					if($row1[$stat] < $row2[$stat]) {
						$row1[$stat] = '<span style="color:#00FF00; font-weight:bold;">'.$row1[$stat].'</span>';
						$idColor1 = "js_tableHead";
						$idColor2 = "js_row2";
					} elseif($row1[$stat] > $row2[$stat]) {
						$row2[$stat] = '<span style="color:#00FF00; font-weight:bold;">'.$row2[$stat].'</span>';
						$idColor2 = "js_tableHead";
						$idColor1 = "js_row2";
					} else {
						$idColor1 = "js_row2";
						$idColor2 = "js_row2";
					}
				}
				$varArray["stats"] .= '<tr>
										 <td id="js_row1" align="left">'.$name.'</td>
										 <td id="'.$idColor1.'" align="right">'.$row1[$stat].'</td>
										 <td id="'.$idColor2.'" align="right">'.$row2[$stat].'</td>
									   </tr>';
			}
			
			$varArray["details"] = "";
			foreach($genArray as $name => $stat) {

				if($name != "Lost") {

					if($row1[$stat] > $row2[$stat]) {
						$row1[$stat] = '<span style="color:#00FF00; font-weight:bold;">'.$row1[$stat].'</span>';
						$idColor1 = "js_tableHead";
						$idColor2 = "js_row2";
					} elseif($row1[$stat] < $row2[$stat]) {
						$row2[$stat] = '<span style="color:#00FF00; font-weight:bold;">'.$row2[$stat].'</span>';
						$idColor1 = "js_row2";
						$idColor2 = "js_tableHead";
					} else {
						$idColor1 = "js_row2";
						$idColor2 = "js_row2";
					}

				} else {

					if(!empty($row1[$stat]) && !empty($row2[$stat])) {

						if($row1[$stat] < $row2[$stat]) {
							$row1[$stat] = '<span style="color:#00FF00; font-weight:bold;">'.$row1[$stat].'</span>';
							$idColor1 = "js_tableHead";
							$idColor2 = "js_row2";
						} elseif($row1[$stat] > $row2[$stat]) {
							$row2[$stat] = '<span style="color:#00FF00; font-weight:bold;">'.$row2[$stat].'</span>';
							$idColor2 = "js_tableHead";
							$idColor1 = "js_row2";
						} 

					} else {
						$row1['lost']=0;
						$row2['lost']=0;
						$idColor1 = "js_row2";
						$idColor2 = "js_row2";
					}

					
				}
				$varArray["details"] .= '<tr>
										   <td id="js_row1" align="left">'.$name.'</td>
										   <td id="'.$idColor1.'" align="right">'.$row1[$stat].'</td>
										   <td id="'.$idColor2.'" align="right">'.$row2[$stat].'</td>
									     </tr>';
			}

			$roleArray = array("EngLevel", "GunLevel", "MedLevel", "RifLevel", "SniLevel");
			foreach($roleArray as $rolecrit) {

				if(!empty($varArray[$rolecrit."1"]) && !empty($varArray[$rolecrit."2"])) {

					if($varArray[$rolecrit."1"] > $varArray[$rolecrit."2"]) {
						$varArray[$rolecrit."1"] = '<span style="color:#00FF00; font-weight:bold;">'.$varArray[$rolecrit."1"].'</span>';
						$varArray[$rolecrit."1id"] = "js_tableHead";
						$varArray[$rolecrit."2id"] = "js_row1";
					} elseif($varArray[$rolecrit."2"] > $varArray[$rolecrit."1"]) {
						$varArray[$rolecrit."2"] = '<span style="color:#00FF00; font-weight:bold;">'.$varArray[$rolecrit."2"].'</span>';
						$varArray[$rolecrit."1id"] = "js_row1";
						$varArray[$rolecrit."2id"] = "js_tableHead";
					}

				} else {
					$varArray[$rolecrit."1id"] = "js_row1";
					$varArray[$rolecrit."2id"] = "js_row1";
				}

			
			}
			
			$rankArray = array("EngRank", "GunRank", "MedRank", "RifRank", "SniRank");
			foreach($rankArray as $rankcrit) {

				if(!empty($varArray[$rankcrit."1"]) && !empty($varArray[$rankcrit."2"])) {


					if($varArray[$rankcrit."1"] < $varArray[$rankcrit."2"]) {
						$varArray[$rankcrit."1"] = '<span style="color:#00FF00; font-weight:bold;">'.$varArray[$rankcrit."1"].'</span>';
						$varArray[$rankcrit."1id"] = "js_tableHead";
						$varArray[$rankcrit."2id"] = "js_row1";
					} elseif($varArray[$rankcrit."2"] < $varArray[$rankcrit."1"]) {
						$varArray[$rankcrit."2"] = '<span style="color:#00FF00; font-weight:bold;">'.$varArray[$rankcrit."2"].'</span>';
						$varArray[$rankcrit."1id"] = "js_row1";
						$varArray[$rankcrit."2id"] = "js_tableHead";
					}

				} else {
					$varArray[$rankcrit."1id"] = "js_row1";
					$varArray[$rankcrit."2id"] = "js_row1";
				}


				
			}
			
		}

	}
	
	$varArray["content"] = $tpl->buildMgtTpl($varArray, $sqlArray, 0, $file, $sub);
}