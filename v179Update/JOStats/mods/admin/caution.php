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

$file = "./tpls/admin/admin_caution.tpl";

if(!$tpl->getMgtTpl($file)) {

	$varArray["content"] = $tpl->joErrorRet(1, $section." template");	

} else {

	$varArray["error"] = "";
	$varArray["msg"]   = "";
	
	$varArray["yes"]   = "";
	$varArray["no"]    = "";

	$action = (!empty($_GET['action']) ? $_GET['action'] : "");

	switch($action) {
		case "reset": 
			$varArray["yes"] = "reset_yes";
			$varArray["no"]  = "reset_no";
		break;
		case "delete": 
			$varArray["yes"] = "delete_yes";
			$varArray["no"]  = "delete_no";
		break;
	}
	
	$varArray["content"] = $tpl->buildMgtTpl($varArray, $sqlArray, 0, $file, "");

}