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

if(!empty($_POST["add_rank"])) {

	$result = "Wut";
	$rkScore = (!empty($_POST['rkScore']) ? intval($_POST['rkScore']) : 100);
	$rkName = (!empty($_POST['rkName']) ? cMioD4($_POST['rkName']) : "");
	$rkImage = (!empty($_POST['rkImage']) ? cMioD4($_POST['rkImage']) : "");

	if(!$rkScore || !$rkName || !$rkImage) {
		header("location: ./admin.php?section=ranks&msg=6");
		exit;
	}

	if($_FILES["rankImage"]["name"] != "") {

		joWriteable("./ranks/");

		$_FILES["rankImage"]["name"] = str_replace("%","",$_FILES["rankImage"]["name"]);

		if($_FILES["rankImage"]["size"] > 0) {

			$filename = cMioD4($_FILES["rankImage"]["name"]);

			if(!joValidImage($_FILES["rankImage"]["tmp_name"])) {
				header("location: ./admin.php?section=ranks&msg=7");
				exit;
			}
			
			if(!@move_uploaded_file($_FILES["rankImage"]["tmp_name"], "./ranks/".$filename)) {

				header("location: ./admin.php?section=ranks&msg=4");
				exit;

			} else {

				$tpl->joQuery("INSERT INTO $ranks_table VALUES('', '".$tpl->joEscape($rkName)."', '".$tpl->joEscape($filename)."', '".$tpl->joEscape($rkScore)."')", 2);

				header("location: ./admin.php?section=ranks&msg=1");
				exit;

			}
	    }

	} else {

		$tpl->joQuery("INSERT INTO $ranks_table VALUES('', '".$tpl->joEscape($rkName)."', '".$tpl->joEscape($rkImage)."', '".$tpl->joEscape($rkScore)."')", 2);
		header("location: ./admin.php?section=ranks&msg=1");
		exit;

	}

}

if(!empty($_POST["edit_ranks"])) {

	if(empty($_POST['checkbox'])) {
		header("location: ./admin.php?section=ranks&msg=5");
		exit;
	}

	foreach($_POST['checkbox'] as $value) {
		$a = $_POST['rk'.$value];

		$tpl->joQuery("UPDATE $ranks_table SET 
						   name        = '".$tpl->joEscape($a[0])."' , 
						   image       = '".$tpl->joEscape($a[1])."' , 
						   rating       = '".$tpl->joEscape($a[2])."' 
					   WHERE id = '".intval($value)."'", 2);
	}
	
	$tpl->joQuery("INSERT INTO $adminlogs_table VALUES('', 'ranks', 'Ranks Edited', 'Success', '".$joName."', 
	                                                   '".$_SERVER['REMOTE_ADDR']."', '".date("Y-m-d H:i:s")."')", 2);
	
	header("location: ./admin.php?section=ranks&msg=2");
	exit;
}

if(!empty($_POST["delete_ranks"])) {

	if(empty($_POST['checkbox'])) {
		header("location: ./admin.php?section=ranks&msg=5");
		exit;
	}

	foreach($_POST['checkbox'] as $rID) {
		$tpl->joQuery("DELETE FROM $ranks_table WHERE id = '".intval($rID)."'", 2);
	}
	
	$tpl->joQuery("INSERT INTO $adminlogs_table VALUES('', 'ranks', 'Ranks Deleted', 'Success', '".$joName."', 
	                                                   '".$_SERVER['REMOTE_ADDR']."', '".date("Y-m-d H:i:s")."')", 2);
	header("location: ./admin.php?section=ranks&msg=3");
	exit;
}