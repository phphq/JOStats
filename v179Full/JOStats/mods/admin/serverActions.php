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

if(!empty($_POST["select_server"])) {

	$sid = (!empty($_POST['sid']) ? intval($_POST['sid']) : 0);
	header("location: ./admin.php?section=servers&sid=".$sid);
	exit;

} elseif(!empty($_POST["delete_server"])) {

	$sid = (!empty($_POST['sid']) ? intval($_POST['sid']) : 0);

	if(!$sid) {
		header("location: ./admin.php?section=servers&msg=6");
		exit;
	}

	$sSql = $tpl->joQuery("SELECT * FROM $servers_table WHERE id = '".$sid."'", 1);
	$sRow = mysqli_fetch_assoc($sSql);
	$name = $sRow["name"];
	$tpl->joQuery("DELETE FROM $servers_table WHERE id = '".$sid."'", 2);
	$tpl->joQuery("INSERT INTO $adminlogs_table 
				   VALUES('', 'servers', 'Server Deleted_".$name."', 'Success', '".$joName."', 
				   '".$_SERVER['REMOTE_ADDR']."', '".date("Y-m-d H:i:s")."')", 2);

	header("location: ./admin.php?section=servers&msg=1");
	exit;

} elseif(!empty($_POST["add_server"])) {

	$serverName = (!empty($_POST['serverName']) ? $_POST['serverName'] : "");
	$serverId = (!empty($_POST['serverId']) ? $_POST['serverId'] : "");

	if($serverName == "" || $serverId == "") {

		$msg = 5;

	} else {

		if(!$tpl->joQuery("INSERT INTO $servers_table 
					   VALUES('', '".$tpl->joEscape($serverName)."', '".$tpl->joEscape($serverId)."', '', '', 
					   '', '', '', '', '', '', '', '', '', '', '', '', '', '', '')", 2)) {
			$msg = 4;
		
		} else {
			$tpl->joQuery("INSERT INTO $adminlogs_table 
	               VALUES('', 'servers', 'Server Added', 'Success', '".$joName."', 
				   '".$_SERVER['REMOTE_ADDR']."', '".date("Y-m-d H:i:s")."')", 2);

			$msg = 2;
		}

	}
	
	header("location: ./admin.php?section=servers&msg=".$msg);
	exit;

} elseif(!empty($_POST["edit_server"])) {


	$srName = (!empty($_POST['srName']) ? $_POST['srName'] : "");
	$srId = (!empty($_POST['srId']) ? $_POST['srId'] : "");
	$sid = (!empty($_POST['sid']) ? intval($_POST['sid']) : 0);

	if($srName == "" || $srId == "" || !$sid) {

		$msg = 5;

	} else {
		$tpl->joQuery("UPDATE $servers_table SET name = '".$tpl->joEscape($srName)."', serverid = '".$tpl->joEscape($srId)."' WHERE id = '".$sid."'", 2);
		
		$tpl->joQuery("INSERT INTO $adminlogs_table 
		               VALUES('', 'servers', 'Server Edited_".$sid."', 'Success', '".$joName."', 
					   '".$_SERVER['REMOTE_ADDR']."', '".date("Y-m-d H:i:s")."')", 2);		

		$msg = 3;
	}

	header("location: ./admin.php?section=servers&msg=".$msg);
	exit;

}