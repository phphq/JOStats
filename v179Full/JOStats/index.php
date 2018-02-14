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
// Website       : http://www.messiahgamingtools.com         //
// Support       : http://www.babstats.com                   //
//                                                           //
// File Name     : Main Index File                           //
// File Version  : 1.0.8 Standalone                          //
//                                                           //
/////////////////////////////////////////////////////////////*/

/*/////////////////////////////////////////////////////////////
//                                                           //
// Updated Dec 2016 By Novahq.net <scott@novahq.net>         //
// Standalone, PHP 5.6+ Compatible                           //
//                                                           //
/////////////////////////////////////////////////////////////*/

require_once "config.php";
require_once "functions.php";
require_once "common.php";
require_once "weapons.php";

require_once "vehicles.php";
require_once "gametypes.php";
require_once "restrictions.php";
require_once "mgtClass.php";

MakeTableNames();

require_once "presetSqls.php";

$sub = !empty($_GET['sub']) ? aGlod3($_GET['sub']) : '';
$pid=(!empty($_GET['pid']) ? intval($_GET['pid']) : 0);
$section = !empty($_GET['section']) ? aGlod3($_GET['section']) : 'logo';
$condStats = (!empty($_GET["condStats"]) ? intval($_GET["condStats"]) : 0);
$condGame = (!empty($_GET["condGame"]) ? cMioD4($_GET["condGame"]) : "");
$condTeam = (!empty($_GET["condTeam"]) ? intval($_GET["condTeam"]) : 0);
$condServer = (!empty($_GET["condServer"]) ? intval($_GET["condServer"]) : 0);

$varArray = array();
$sqlArray = !empty($sqlArray) ? $sqlArray : array();

$tpl = new mgtTemplate();

if(!$tpl->getMgtTpl("tpls/main.tpl")) exit ($tpl->joErrorRet(1, "tpls/main.tpl"));

$sql = $tpl->joQuery("SELECT * FROM $servers_table WHERE state > '0'", 1);
if(@mysqli_num_rows($sql) > 0) {
	while($row = mysqli_fetch_assoc($sql)) {
		$lastUpdate = @strtotime($row["lastUpdate"]);
		$ctime = strtotime(date("Y-m-d H:i:s"));
		$ctimeDiff = $ctime - $lastUpdate;
		if($ctimeDiff > 120) {
			$tpl->joQuery("UPDATE $servers_table SET state = '0' WHERE id = '".$row["id"]."'", 2);
		}
	}
}

if(!$tpl->joQuery("SELECT * FROM $players_table", 2) || $sub == "saveSettings") {

	if(!$tpl->getMgtTpl("install/install.php")) {

		$varArray["content"] = $tpl->joErrorRet(2, "install");

	} else {

		$varArray["jsLink"] = '<link href="./install/joStyle.css" rel="stylesheet" type="text/css" />';
		include "./install/install.php";

	}

} elseif(file_exists("./install/install.php") || file_exists("./install/install.tpl") ||  file_exists("./install/install.sql")) {

	$varArray["jsLink"] = '<link href="'.'install/joStyle.css" rel="stylesheet" type="text/css" />';
	$varArray["content"] = $tpl->joErrorRet(3, "install");   

} elseif($joName == "admin" || $joPass == "pass") {

	$varArray["jsStyle"] = GetJoStyle("main");
	$varArray["content"] = $tpl->joErrorRet(4, "config");  

} elseif($joName == "" || $joPass == "") {

	$varArray["jsStyle"] = GetJoStyle("main");
	$varArray["content"] = $tpl->joErrorRet(5, "config");    

} else {

	$varArray["jsLink"] = "";
	
	if(empty($varArray["content"])) { 

		if(!checkSection($section)) {
			exit("Invalid Parameter Passed!");
		}

		$varArray["jsStyle"] = GetJoStyle("main");
		$varArray["playerList"] = "";

		if(file_exists("./mods/$section.php")) {

		  include "./mods/$section.php";

		  $varArray["playerList"] = '';
		  $sql = $tpl->joQuery("SELECT * FROM ".$players_table." WHERE name!='' ORDER BY name ASC", 1);
		  while($row = mysqli_fetch_assoc($sql)) {
			  $varArray["playerList"] .= '<option value="'.$row["id"].'" '.($row["id"]==$pid ? 'selected="selected"' : '').'>'.htmlspecialchars($row["name"]).'</option>';
		  }

		} else {

		  $varArray["content"] = $tpl->joErrorRet(1, $section." module");   

		}

	}
}

$varArray["quickJump"]    = "./?section=player_stats";
$varArray["websiteTitle"] = $websiteTitle;
$varArray["version"]      = $joVersion;

echo $tpl->buildMgtTpl($varArray, $sqlArray, 0, "tpls/main.tpl", "");