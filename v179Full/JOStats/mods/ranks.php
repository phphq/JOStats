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
// File Name     : Ranks Module                              //
// File Version  : 1.0.1 Standalone                          //
//                                                           //
/////////////////////////////////////////////////////////////*/

/*/////////////////////////////////////////////////////////////
//                                                           //
// Updated Dec 2016 By Novahq.net <scott@novahq.net>         //
// Standalone, PHP 5.6+ Compatible                           //
//                                                           //
/////////////////////////////////////////////////////////////*/

$file = "./tpls/ranks.tpl";

if(!$tpl->getMgtTpl($file)) {

	$varArray["content"] = $tpl->joErrorRet(1, $section." template");

} else {

	$type=(!empty($_GET['type']) ? intval($_GET['type']) : 1);
	$rid = (!empty($_GET['rid']) ? intval($_GET['rid']) : 0);

	$varArray["formAction"] = "./?";
	$varArray["section"] = "ranks";

	if($rid == 0) {
		$rSql = $tpl->joQuery("SELECT * FROM $ranks_table ORDER BY id ASC LIMIT 1", 1);
		$rRow = mysqli_fetch_assoc($rSql);
		$rid = $rRow["id"];
	}

	$sql = $tpl->joQuery("SELECT * FROM $ranks_table WHERE id = '".$rid."'", 1);
	$row = mysqli_fetch_assoc($sql);

	if(empty($row)) {

		$varArray["selOption"] ="";
		$varArray["name"] = "N/A";
		$varArray["image"] = "none.gif";
		$varArray["id"] = 0;
		$varArray["rating"] = 0;
		$varArray["r_players"] = 0;

	} else {

		$varArray["selOption"] = '<option value="'.$row["id"].'" selected="selected">'.$row["name"].'</option>';
		
		$rank2 = $rid + 1;
		
		$sql = $tpl->joQuery("SELECT * FROM $ranks_table WHERE id = '".$rid."' OR id = '".$rank2."' ORDER by id DESC", 1);
		$row2 = mysqli_fetch_assoc($sql);
		
		$sql = $tpl->joQuery("SELECT rating FROM $players_table 
							  WHERE rating >= '".$row["rating"]."' AND rating < '".$row2["rating"]."'", 1);
		$varArray["r_players"] = mysqli_num_rows($sql);
		
		foreach($row as $tag => $value) {
			$varArray[$tag] = $value;
		}

	}

	$sqlArray[0]["query"]      = "SELECT * ";
	$sqlArray[0]["tables"]     = " $ranks_table ";
	$sqlArray[0]["conditions"] = "";
	$sqlArray[0]["type"]       = "multi";
	$sqlArray[0]["prefix"]     = "list";
	
	$varArray["content"] = $tpl->buildMgtTpl($varArray, $sqlArray, 1, $file, "");
}