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

$file = "./tpls/admin/admin_servers.tpl";

if(!$tpl->getMgtTpl($file)) {

	$varArray["content"] = $tpl->joErrorRet(1, $section." template");	

} else {


	$varArray["error"] = "";

	$sid = (!empty($_GET['sid']) ? intval($_GET['sid']) : "");
	$msg = (!empty($_GET['msg']) ? intval($_GET['msg']) : 0);

	if($sid > 0) {

		$sub = "serverSelected";
		$sql = $tpl->joQuery("SELECT * FROM $servers_table WHERE id = '".$sid."'", 1);
		$row = mysqli_fetch_assoc($sql);
		foreach($row as $tag => $value) {
			$varArray[$tag] = $value;
		}
		
		$count = 0;

	} else {

		$sub = "serverMain";
		$sql = $tpl->joQuery("SELECT * FROM $servers_table", 1);
		$varArray["serverNum"] = mysqli_num_rows($sql);
		
		$sqlArray[0]["query"]      = " SELECT * ";
		$sqlArray[0]["tables"]     = " $servers_table ";
		$sqlArray[0]["conditions"] = " ORDER BY name ASC";
		$sqlArray[0]["type"]       = "multi";
		$sqlArray[0]["prefix"]     = "list";
		$count = 1;

	}

	switch($msg) {
		case 1: $varArray["msg"] = "Server Deleted!" ; break;
		case 2: $varArray["msg"] = "Server Added!"; break;
		case 3: $varArray["msg"] = "Server Details Updated!"  ; break;
		case 4: $varArray["msg"] = "Failed: Could not add server to database!"  ; break;
		case 5: $varArray["msg"] = "Failed: Both Fields MUST be filled in!"  ; break;
		case 6: $varArray["msg"] = "Failed: Could not delete server!"  ; break;
		default: $varArray["msg"] = "";
	}

	$varArray["sid"] = $sid;
	$varArray["formAction"] = "./admin.php?section=serverActions";
	
	$varArray["content"] = $tpl->buildMgtTpl($varArray, $sqlArray, $count, $file, $sub);
}