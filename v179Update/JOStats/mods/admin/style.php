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

$file = "./tpls/admin/admin_style.tpl";

if(!$tpl->getMgtTpl($file)) {

	$varArray["content"] = $tpl->joErrorRet(1, $section." template");	

} else {

	$msg = (!empty($_GET['msg']) ? intval($_GET['msg']) : 0);
	
	$varArray["error"] = "";

	$sql = $tpl->joQuery("SELECT * FROM $style_table WHERE id = '1'", 1);
	$row = mysqli_fetch_assoc($sql);
	
	foreach($row as $tag => $value) {
		$varArray[$tag] = $value;
		$varArray[$row["Font family"]] = 'selected="selected"';
	}
	
	$sql = $tpl->joQuery("SELECT * FROM $style_table WHERE id = '2'", 1);
	$row = mysqli_fetch_assoc($sql);
	
	foreach($row as $tag => $value) {
		$varArray["A_".$tag] = $value;
		$varArray["A_".$row["Font family"]] = 'selected="selected"';
	}

	switch($msg) {
		case 1: $varArray["msg"] = "Style settings updated successfully!" ; break;
		case 2: $varArray["msg"] = "Invalid color code entered!" ; break;
		default: $varArray["msg"] = "" ; break;
	}

	$varArray["content"] = $tpl->buildMgtTpl($varArray, $sqlArray, 0, $file, "");
}