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

$file = "./tpls/awards.tpl";

if(!$tpl->getMgtTpl($file)) {

	$varArray["content"] = $tpl->joErrorRet(1, $section." template");

} else {

	$type=(!empty($_GET['type']) ? intval($_GET['type']) : 1);
	$aid = (!empty($_GET['aid']) ? intval($_GET['aid']) : 0);

	$varArray["formAction"] = "./?";
	$varArray["section"] = "awards";
	
	switch($type) {
		case 2: $varArray["listName"] = "Weapon "; break;	
		default: $varArray["listName"] = "Game "; $type=1; break;	
	}
	
	if($aid == 0) {
		$aSql = $tpl->joQuery("SELECT * FROM $awards_table WHERE type = '".$type."' ORDER BY id ASC LIMIT 1", 1);
		$aRow = mysqli_fetch_assoc($aSql);
		$aid = $aRow["id"];
	}
	
	$sql = $tpl->joQuery("SELECT * FROM $awards_table WHERE id = '".$aid."'", 1);
	$row = mysqli_fetch_assoc($sql);

	if(empty($row)) {

		$varArray["selOption"] = "";
		$varArray["name"] = "N/A";
		$varArray["image"] = "none.gif";
		$varArray["value"] = 0;
		$varArray["stat"] = "N/A";
		$varArray["id"] = 0;
		$varArray["a_players"] = 0;
		$varArray["a_count"] = 0;

	} else {

		$varArray["selOption"] = '<option value="'.$row["id"].'" selected="selected">'.htmlspecialchars($row["name"]).'</option>';
	
		$varArray["image"] = empty($row["image"]) ? "none.gif" : $row["image"];
		$varArray["id"] = intval($row["id"]);
		$varArray["stat"] = $row["stat"];
		$varArray["value"] = $row["value"];
		
		$award2 = $aid+1;
		
		$sql = $tpl->joQuery("SELECT * FROM $ranks_table WHERE id = '".$aid."' OR id = '".$award2."' ORDER by id DESC", 1);
		$row2 = mysqli_fetch_assoc($sql);

		$sql = $tpl->joQuery("SELECT SUM($stats_table.".$row["stat"].") AS ".$row["stat"]."  
		                      FROM $stats_table 
							  GROUP by player 
							  HAVING ".$row["stat"]."  >= '".$row["value"]."' ", 1);

		$varArray["name"] = "";
		$varArray["value"] = "";
		$varArray["stat"] = "";
		$varArray["id"] = "";
		
		$varArray["a_players"] = mysqli_num_rows($sql);
		foreach($row as $tag => $value) {
			$varArray[$tag] = $value;
		}

		$sql = $tpl->joQuery("SELECT * FROM $players_table", 1);
		$varArray["a_count"] = mysqli_num_rows($sql);

		$varArray["name"] = htmlspecialchars($row["name"]);

	}

	$sqlArray[0]["query"]      = "SELECT * ";
	$sqlArray[0]["tables"]     = " $awards_table ";
	$sqlArray[0]["conditions"] = " WHERE type = '".$type."'";
	$sqlArray[0]["type"]       = "multi";
	$sqlArray[0]["prefix"]     = "list";
	
	$varArray["content"] = $tpl->buildMgtTpl($varArray, $sqlArray, 1, $file, "");
}