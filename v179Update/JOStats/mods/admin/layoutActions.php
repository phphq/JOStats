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

if(!empty($_POST['update_m_layout'])) {

	$msg=2;

	if(!empty($_POST['kill_stats']) && is_array($_POST['kill_stats'])) {

		$kill_stats = array_map('cMioD4', $_POST['kill_stats']);
		$fieldList = implode(",", $kill_stats);

		$i = 0;

		if($fieldList != "") {
			$sql = $tpl->joQuery("SELECT * FROM $layouts_table WHERE page = 'kill_stats'", 1);
			if(@mysqli_num_rows($sql) > '0') {
				$tpl->joQuery("UPDATE $layouts_table SET fields = '".$fieldList."' WHERE page = 'kill_stats'", 2);
			} else {
				$tpl->joQuery("INSERT INTO $layouts_table VALUES('', 'kill_stats', '".$fieldList."')", 2);
			}
			$i++;
		} else {
			$tpl->joQuery("DELETE FROM $layouts_table WHERE page = 'kill_stats'", 2);
		}

		if($i > 0) {
			$tpl->joQuery("INSERT INTO $adminlogs_table 
						   VALUES('', 'layout', 'Update Layout Settings', 'Success', '".$joName."', '".$_SERVER['REMOTE_ADDR']."', 
						   '".date("Y-m-d H:i:s")."')", 2);
			$msg = 1;
		}

	} else {

		$msg=3;
		
	}
		
	header("location: ./admin.php?section=layout&msg=".$msg);
	exit;
	
}