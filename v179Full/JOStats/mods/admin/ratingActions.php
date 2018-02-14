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

if(!empty($_POST["edit_rating"])) {

	$type = ((!empty($_GET['type']) && in_array($_GET['type'], array("weapon", "game"))) ? $_GET['type'] : 'game');
	$sPts = ((!empty($_POST['sPts']) && is_array($_POST['sPts'])) ? $_POST['sPts'] : array());
	$sPts2 = ((!empty($_POST['sPts2']) && is_array($_POST['sPts'])) ? $_POST['sPts2'] : array());

	foreach($sPts AS $index => $value) {
		$tpl->joQuery("UPDATE $rating_table SET s_pts = '".$tpl->joEscape($value)."' WHERE s_id = '".$tpl->joEscape($index)."'", 2);
	}
	
	foreach($sPts2 AS $index => $value) {
		$tpl->joQuery("UPDATE $rating_table SET s_pts2 = '".$tpl->joEscape($value)."' WHERE s_id = '".$tpl->joEscape($index)."'", 2);
	}
	
	$tpl->joQuery("INSERT INTO $adminlogs_table VALUES('', 'scores', 'Ratings Edited', 'Success', '".$joName."', 
	                                                   '".$_SERVER['REMOTE_ADDR']."', '".date("Y-m-d H:i:s")."')", 2);

	header("location: ./admin.php?section=rating&type=".$type."&msg=1");
	exit;
}