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

$file = "./tpls/admin/admin_players.tpl";

if(!$tpl->getMgtTpl($file)) {

	$varArray["content"] = $tpl->joErrorRet(1, $section." template");	
	
} else {
	
	$varArray["error"] = "";
	$varArray["getSquad"] = "";
	$varArray["selSquad"] = "";

	$pid = (!empty($_GET['pid']) ? intval($_GET['pid']) : "");
	$msg = (!empty($_GET['msg']) ? intval($_GET['msg']) : 0);
	$findName = (!empty($_GET['findName']) ? $_GET['findName'] : "");
	
	if($pid > 0 || $findName != "") {

		$sub = "playerSelected";

		if($pid > 0) {
			$sql = $tpl->joQuery("SELECT * FROM $players_table WHERE id = '".$pid."'", 1);
		} else {
			$sql = $tpl->joQuery("SELECT * FROM $players_table WHERE name LIKE ('%".$tpl->joEscape($findName)."%')", 1);
		}

		if(mysqli_num_rows($sql) == 0) {

			$sub = "playerSearch";
			$varArray["error"] = "Player not found in the database!";
			$sqlArray[0]["query"]      = " SELECT * ";
			$sqlArray[0]["tables"]     = " $players_table ";
			$sqlArray[0]["conditions"] = " ORDER BY name ASC";
			$sqlArray[0]["type"]       = "multi";
			$sqlArray[0]["prefix"]     = "list";
			$count = 1;

		} elseif(mysqli_num_rows($sql) > 1) {

			$sub = "playerSearch";
			$sqlArray[0]["query"]      = " SELECT * ";
			$sqlArray[0]["tables"]     = " $players_table ";
			$sqlArray[0]["conditions"] = " WHERE name LIKE ('%".$tpl->joEscape($findName)."%') 
			                               ORDER BY name ASC";
			$sqlArray[0]["type"]       = "multi";
			$sqlArray[0]["prefix"]     = "list";
			$count = 1;

		} elseif(mysqli_num_rows($sql) == 1)  {

			$row = mysqli_fetch_assoc($sql);

			if($findName) {
				header("location: ./admin.php?section=players&pid=".$row['id']);
				exit;
			}

			foreach($row as $tag => $value) {
				$varArray[$tag] = $value;
			}

			$sql = $tpl->joQuery("SELECT * FROM $squads_table", 1);
			while($row2 = mysqli_fetch_assoc($sql)) {
				$varArray["getSquad"] .= '<option value="'.$row2["id"].'">'.$tpl->joEscape($row2["name"]).'</option>';
				if($row2["id"] == $row["squad"]) {
					$varArray["selSquad"] = '<option value="'.$row2["id"].'" selected>'.$tpl->joEscape($row2["name"]).'</option>';
				}
			}

			$count = 0;

		}

	} else {

		$sub = "playerSearch";
		$sqlArray[0]["query"]      = " SELECT * ";
		$sqlArray[0]["tables"]     = " $players_table ";
		$sqlArray[0]["conditions"] = " ORDER BY name ASC";
		$sqlArray[0]["type"]       = "multi";
		$sqlArray[0]["prefix"]     = "list";
		$count = 1;

	}

	switch($msg) {
		case 1: $varArray["msg"] = "Player Name Changed!" ; break;
		case 2: $varArray["msg"] = "Player Squad Changed!"; break;
		case 3: $varArray["msg"] = "Player Stats Reset!"  ; break;
		case 4: $varArray["msg"] = "Player Deleted!"  ; break;
		case 5: $varArray["msg"] = "Invalid Name!"  ; break;
		default: $varArray["msg"] = "";
	}

	
	$varArray["formAction"] = "./admin.php?section=playerActions";
	$varArray["pid"] = $pid;

	$varArray["content"] = $tpl->buildMgtTpl($varArray, $sqlArray, $count, $file, $sub);

}