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

$mid = (!empty($_POST['mid']) ? intval($_POST['mid']) : 0);

if(!empty($_POST["select_map"])) {

	header("location: ./admin.php?section=maps&mid=".$mid);
	exit;

} elseif(!empty($_POST["upload_image"])) {

	joWriteable("./maps/");

	$msg=5;

    if($_FILES["uploadImage"]["name"]) {
	  $_FILES["uploadImage"]["name"] = str_replace("%","",$_FILES["uploadImage"]["name"]);

	  if($_FILES["uploadImage"]["size"] > 0) {

		$filename = cMioD4($_FILES["uploadImage"]["name"]);

		if(!joValidImage($_FILES["uploadImage"]["tmp_name"])) {
			header("location: ./admin.php?section=maps&msg=9");
			exit;
		}

		if(move_uploaded_file($_FILES["uploadImage"]["tmp_name"], "./maps/".$filename)) {

			$tpl->joQuery("UPDATE $maps_table SET image = '".$filename."' WHERE id = '".$mid."'", 2);
			$tpl->joQuery("INSERT INTO $adminlogs_table VALUES('', 'maps', 'Uploaded Map Image_".$mid."', 'Success', '".$joName."', 
	                                                   '".$_SERVER['REMOTE_ADDR']."', '".date("Y-m-d H:i:s")."')", 2);
			$msg=1;

		}

	  }

	}

	header("location: ./admin.php?section=maps&mid=".$mid."&msg=".$msg);
	exit;

} elseif(!empty($_POST["change_image"])) {

	$mapImage = (!empty($_POST['mapImage']) ? cMioD4($_POST['mapImage']) : "");

	$tpl->joQuery("UPDATE $maps_table SET image = '".$mapImage."' WHERE id = '".$mid."'", 2);
	
	$tpl->joQuery("INSERT INTO $adminlogs_table VALUES('', 'maps', 'Changed Map Image_".$mid."', 'Success', '".$joName."', 
	                                                   '".$_SERVER['REMOTE_ADDR']."', '".date("Y-m-d H:i:s")."')", 2);
	
	header("location: ./admin.php?section=maps&mid=".$mid."&msg=2");
	exit;

} elseif(!empty($_POST["delete_image"])) {

	joWriteable("./maps/");

	$sql = $tpl->joQuery("SELECT * FROM $maps_table WHERE id = '".$mid."'", 1);
	$row = mysqli_fetch_assoc($sql);
	$imageName = "./maps/".$row["image"];

	if($row["image"]=="none.gif") {

		$msg = 10;

	} elseif(!@unlink($imageName)) {

		$tpl->joQuery("INSERT INTO $adminlogs_table VALUES('', 'maps', 'Deleted Map Image_".$mid."', 'Failed', '".$joName."', 
														   '".$_SERVER['REMOTE_ADDR']."', '".date("Y-m-d H:i:s")."')", 2);
		$msg = 4;

	} else {

		$tpl->joQuery("UPDATE $maps_table SET image = 'none.gif' WHERE id = '".$mid."'", 2);
		
		$tpl->joQuery("INSERT INTO $adminlogs_table VALUES('', 'maps', 'Deleted Map Image_".$mid."', 'Success', '".$joName."', 
														   '".$_SERVER['REMOTE_ADDR']."', '".date("Y-m-d H:i:s")."')", 2);
		$msg = 3;

	}
	
	header("location: ./admin.php?section=maps&mid=".$mid."&msg=".$msg);
	exit;
}