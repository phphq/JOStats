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
// File Name     : Player Awards Module                      //
// File Version  : 1.0.2 Standalone                          //
//                                                           //
/////////////////////////////////////////////////////////////*/

/*/////////////////////////////////////////////////////////////
//                                                           //
// Updated Dec 2016 By Novahq.net <scott@novahq.net>         //
// Standalone, PHP 5.6+ Compatible                           //
//                                                           //
/////////////////////////////////////////////////////////////*/

$file = "./tpls/player_awards.tpl";

if(!$tpl->getMgtTpl($file)) {

	$varArray["content"] = $tpl->joErrorRet(1, $section." template");

} else {

	$pid=(!empty($_GET['pid']) ? intval($_GET['pid']) : 0);
	$sub=((!empty($_GET['awt']) && in_array($_GET['awt'], array("weapon","game"))) ? cMioD4($_GET['awt']) : "game");

	$varArray["formAction"] = "./?";
	$varArray["section"] = "player_awards";
	$varArray["pid"] = $pid;

	$sql = $tpl->joQuery("SELECT * FROM $players_table WHERE id = '".$pid."'", 1);
	$row = mysqli_fetch_array($sql);

	if(empty($row)) {
		exit("Player not found!");
	}
	
	foreach($row as $tag => $value) {
		$varArray[$tag] = $value;
	}
	
	$sqlString  = "SELECT ".$joSelect["player"].",".$joSelect["stats"];
	$sqlString .= " FROM $players_table, $stats_table ";
	$sqlString .= " WHERE $stats_table.player = $players_table.id ";
	$sqlString .= " AND $players_table.id = '".$pid."' ";
	$sqlString .= " GROUP BY $stats_table.player ";
	
	$sql = $tpl->joQuery($sqlString, 1);
	$row = mysqli_fetch_assoc($sql);
	
	switch($sub) {
		case "weapon" : $type = 2; break;
		default: $type = 1; break;
	}
	
	$awardsSql = $tpl->joQuery("SELECT * FROM $awards_table WHERE type = '".$type."'", 1);
	$varArray["awardList"]  = "";
	if(mysqli_num_rows($awardsSql) > 0) {
		if($type == 1) {
			while($arow = mysqli_fetch_assoc($awardsSql)) {
				if($row[$arow["stat"]] >= $arow["value"]) {
					$awardArray[$arow["id"]]["name"] = $arow["name"];
					$awardArray[$arow["id"]]["image"] = "./awards/".$arow["image"];
					$awardArray[$arow["id"]]["description"] = $arow["description"];
				} else {
					$awardArray[$arow["id"]]["name"] = $arow["name"];
					$awardArray[$arow["id"]]["image"] = "./awards/shadow/".$arow["shadow"];
					$awardArray[$arow["id"]]["description"] = $arow["description"];
					$awardArray[$arow["id"]]["progress"] = GetJoAwardProgress($pid, $arow["stat"], $arow["id"], 1);
				}
			}
			
			$awardNum = 0;
			foreach($awardArray as $award) {
				$varArray["awardList"] .= '<td align="center" title="'.$award["name"].": ".$award["description"].'">
										   <img src="'.$award["image"].'" border="0" alt="'.$award["name"].
										   ": ".$award["description"].'">';
										   
				if(!empty($award["progress"])) {
					$varArray["awardList"] .= '<table id="js_menu2" width="60px"><tr><td align="left">
											   <img src="./tpls/grad1.png" width="'.$award["progress"].'" height="10" />
											   </td></tr></table>';
				} else {
					$varArray["awardList"] .= '</td>';
				}
				if(($awardNum+1) % 9 == 0) $varArray["awardList"] .= "</tr><tr>";
				$awardNum++;
			}
		} elseif($type == 2) {
			while($arow = mysqli_fetch_assoc($awardsSql)) {
				$wpnAw = explode("_", $arow["stat"]);
				$wSql = $tpl->joQuery("SELECT SUM($weaponstats_table.kills) AS kills 
				                       FROM $stats_table, $weaponstats_table, $weapons_table 
									   WHERE $weaponstats_table.weapon = $weapons_table.id 
									   AND $weapons_table.name = '".$wpnAw[0]."' 
									   AND $weaponstats_table.record = $stats_table.id 
									   AND $stats_table.player = '".$pid."'", 1);
				$wRow = mysqli_fetch_assoc($wSql);
				if($wRow["kills"] >= $arow["value"]) {
					$awardArray[$arow["id"]]["name"] = $arow["name"];
					$awardArray[$arow["id"]]["image"] = "./awards/".$arow["image"];
					$awardArray[$arow["id"]]["description"] = $arow["description"];
				} else {
					$awardArray[$arow["id"]]["name"] = $arow["name"];
					$awardArray[$arow["id"]]["image"] = "./awards/shadow/".$arow["shadow"];
					$awardArray[$arow["id"]]["description"] = $arow["description"];
					$awardArray[$arow["id"]]["progress"] = GetJoAwardProgress($pid, $wRow["kills"], $arow["value"], 2);
				}
			}
			
			$awardNum = 0;
			foreach($awardArray as $award) {
				$varArray["awardList"] .= '<td align="center" title="'.$award["name"].": ".$award["description"].'">
										   <img src="'.$award["image"].'" border="0" alt="'.$award["name"].
										   ": ".$award["description"].'">';
										   
				if(!empty($award["progress"])) {
					$varArray["awardList"] .= '<table id="js_menu2" width="60px"><tr><td align="left">
											   <img src="./tpls/grad1.png" width="'.$award["progress"].'" height="10" />
											   </td></tr></table>';
				} else {
					$varArray["awardList"] .= '</td>';
				}
				if(($awardNum+1) % 9 == 0) $varArray["awardList"] .= "</tr><tr>";
				$awardNum++;
			}
		}
	
	}
	
	$varArray["joTips"] = "";
	if($joTips) {
		$varArray["joTips"] = '<table id="js_menu">
						         <tr>
							       <td id="js_aboutText"><u>Tips</u></td>
						         </tr>
						         <tr>
							       <td align="left" id="js_aboutText">1. Hover over an Award to see more info.</td>
						  	     </tr>
						       </table><br /><br />';
	}
	
	$varArray["content"] = $tpl->buildMgtTpl($varArray, $sqlArray, 1, $file, $sub);
}