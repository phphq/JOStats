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

$file = "./tpls/admin/admin_rating.tpl";

if(!$tpl->getMgtTpl($file)) {

	$varArray["content"] = $tpl->joErrorRet(1, $section." template");

} else {

	$type = ((!empty($_GET['type']) && in_array($_GET['type'], array("weapon", "game"))) ? $_GET['type'] : 'game');

	$varArray["error"] = "";
	$varArray["update"] = "";
	$varArray["type"] = $type;
	
	switch($type) {
		case "game"  :
			$sqlArray[0]["query"]      = " SELECT * ";
			$sqlArray[0]["tables"]     = " $rating_table ";
			$sqlArray[0]["conditions"] = " WHERE s_type = 'gameBonus' ";
			$sqlArray[0]["type"]       = "multi";
			$sqlArray[0]["prefix"]     = "list1";
			
			$sqlArray[1]["query"]      = " SELECT * ";
			$sqlArray[1]["tables"]     = " $rating_table ";
			$sqlArray[1]["conditions"] = " WHERE s_type = 'gamePenalty' ";
			$sqlArray[1]["type"]       = "multi";
			$sqlArray[1]["prefix"]     = "list2";
			
			$sqlCount = 2;
		break;
		case "weapon":
			$sqlArray[0]["query"]      = " SELECT * ";
			$sqlArray[0]["tables"]     = " $rating_table ";
			$sqlArray[0]["conditions"] = " WHERE s_type = 'wpnBonus' 
										   AND s_stat = '2' 
										   ORDER BY s_name";
			$sqlArray[0]["type"]       = "multi";
			$sqlArray[0]["prefix"]     = "list1";
			
			$sqlArray[1]["query"]      = " SELECT * ";
			$sqlArray[1]["tables"]     = " $rating_table ";
			$sqlArray[1]["conditions"] = " WHERE s_type = 'wpnBonus' 
										   AND s_stat = '3' 
										   ORDER BY s_name";
			$sqlArray[1]["type"]       = "multi";
			$sqlArray[1]["prefix"]     = "list2";
			
			$sqlArray[2]["query"]      = " SELECT * ";
			$sqlArray[2]["tables"]     = " $rating_table ";
			$sqlArray[2]["conditions"] = " WHERE s_type = 'wpnBonus' 
										   AND s_stat = '1' 
										   ORDER BY s_name";
			$sqlArray[2]["type"]       = "multi";
			$sqlArray[2]["prefix"]     = "list3";
			
			$sqlArray[3]["query"]      = " SELECT * ";
			$sqlArray[3]["tables"]     = " $rating_table ";
			$sqlArray[3]["conditions"] = " WHERE s_type = 'wpnBonus' 
										   AND s_stat = '4' 
										   ORDER BY s_name";
			$sqlArray[3]["type"]       = "multi";
			$sqlArray[3]["prefix"]     = "list4";
			
			$sqlArray[4]["query"]      = " SELECT * ";
			$sqlArray[4]["tables"]     = " $rating_table ";
			$sqlArray[4]["conditions"] = " WHERE s_type = 'wpnBonus' 
										   AND s_stat = '5' 
										   ORDER BY s_name";
			$sqlArray[4]["type"]       = "multi";
			$sqlArray[4]["prefix"]     = "list5";
			
			$sqlCount = 5;
		break;
	}
	

	switch($msg) {
		case 1: $varArray["msg"] = "Rating System Updated!" ; break;
		case 2: $varArray["msg"] = "Two options expected" ; break;
		default: $varArray["msg"] = "";

	}


	$varArray["content"] = $tpl->buildMgtTpl($varArray, $sqlArray, $sqlCount, $file, $type);

}