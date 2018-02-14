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

if(!empty($_POST['add_award'])) {

	$result = "Wut";
	$type = (!empty($_POST['type']) ? intval($_POST['type']) : 1);
	$awValue = (!empty($_POST['awValue']) ? intval($_POST['awValue']) : 100);
	$awStat = (!empty($_POST['awStat']) ? aGlod3($_POST['awStat']) : "id");
	$awName = (!empty($_POST['awName']) ? cMioD4($_POST['awName']) : "");
	$awDesc = (!empty($_POST['awDesc']) ? cMioD4($_POST['awDesc']) : "");
	$awImage = (!empty($_POST['awImage']) ? cMioD4($_POST['awImage']) : "");
	$awImage2 = (!empty($_POST['awImage2']) ? cMioD4($_POST['awImage2']) : "");

	if(!$type || !$awName || !$awDesc || !$awValue || !$awStat) {
		header("location: ./admin.php?section=awards&type=".$type."&msg=6");
		exit;
	}
	
	$imageStatus = 0;
	if($_FILES["awardImage"]["name"] != "" &&  $_FILES["awardImage2"]["name"] != "") {

		joWriteable("./awards/");
		joWriteable("./awards/shadow/");

		$_FILES["awardImage"]["name"] = str_replace("%","",$_FILES["awardImage"]["name"]);
		if($_FILES["awardImage"]["size"] > 0) {
			$imageStatus = 1;
	    }
		
		$filename = cMioD4($_FILES["awardImage"]["name"]);
		if(!joValidImage($_FILES["awardImage"]["tmp_name"])) {
			header("location: ./admin.php?section=awards&type=".$type."&msg=7");
			exit;
		}
		
		$_FILES["awardImage2"]["name"] = str_replace("%","",$_FILES["awardImage2"]["name"]);
		if($_FILES["awardImage2"]["size"] > 0) {
			$imageStatus = 2;
	    }
		
		$filename2 = cMioD4($_FILES["awardImage2"]["name"]);
		if(!joValidImage($_FILES["awardImage2"]["tmp_name"])) {
			header("location: ./admin.php?section=awards&type=".$type."&msg=7");
			exit;
		}
		
		if(!@move_uploaded_file($_FILES["awardImage"]["tmp_name"], "./awards/".$filename)) {

			$result = "Failed";
			$msg = 4;

		} else {

			if($imageStatus == 2) {

				move_uploaded_file($_FILES["awardImage2"]["tmp_name"], "./awards/shadow/".$filename2);
				$tpl->joQuery("INSERT INTO $awards_table VALUES('', '".$awName."', '".$filename."', '".$filename2."', 
				                                  '".$awDesc."', '".$awStat."', '".$awValue."', '".$type."', '0')", 2);
			} elseif ($imageStatus == 1) {
				$tpl->joQuery("INSERT INTO $awards_table VALUES('', '".$awName."', '".$filename."', '".$awImage2."', 
				                                  '".$awDesc."', '".$awStat."', '".$awValue."', '".$type."', '0')", 2);
			} elseif($imageStatus == 0) {
				$tpl->joQuery("INSERT INTO $awards_table VALUES('', '".$awName."', '".$awImage."', '".$awImage2."', '".$awDesc."', 
	                                                '".$awStat."', '".$awValue."', '".$type."', '0')", 2);
			}
			
			$result = "Success";
			$msg = 1;
		}
	} 
	
	if($_FILES["awardImage"]["name"] != "" &&  $_FILES["awardImage2"]["name"] == "") {

		joWriteable("./awards/");
		joWriteable("./awards/shadow/");

		$_FILES["awardImage"]["name"] = str_replace("%","",$_FILES["awardImage"]["name"]);
		if($_FILES["awardImage"]["size"] > 0) {
			$imageStatus = 1;
	    }
		
		$filename = cMioD4($_FILES["awardImage"]["name"]);
		if(!joValidImage($_FILES["awardImage2"]["tmp_name"])) {
			header("location: ./admin.php?section=awards&type=".$type."&msg=7");
			exit;
		}

		if(!@move_uploaded_file($_FILES["awardImage"]["tmp_name"], "./awards/".$filename)) {
			$result = "Failed";
			$msg = 4;
		} else {
			$tpl->joQuery("INSERT INTO $awards_table VALUES('', '".$awName."', '".$filename."', '".$awImage2."', 
				                                  '".$awDesc."', '".$awStat."', '".$awValue."', '".$type."', '0')", 2);

			$result = "Success";
			$msg = 1;
		}
	} 
	
	
	if($_FILES["awardImage"]["name"] == "" &&  $_FILES["awardImage2"]["name"] != "") {

		joWriteable("./awards/");
		joWriteable("./awards/shadow/");


		$_FILES["awardImage2"]["name"] = str_replace("%","",$_FILES["awardImage2"]["name"]);
		if($_FILES["awardImage2"]["size"] > 0) {

			$filename = cMioD4($_FILES["awardImage2"]["name"]);
			if(!joValidImage($_FILES["awardImage2"]["tmp_name"])) {
				header("location: ./admin.php?section=awards&type=".$type."&msg=7");
				exit;
			}
			
			if(!@move_uploaded_file($_FILES["awardImage2"]["tmp_name"], "./awards/shadow/".$filename)) {
				$result = "Failed";
				$msg = 4;
			} else {
				$tpl->joQuery("INSERT INTO $awards_table VALUES('', '".$awName."', '".$awImage."', '".$filename."', 
													  '".$awDesc."', '".$awStat."', '".$awValue."', '".$type."', '0')", 2);
				
				$result = "Success";
				$msg = 1;
			}

	    }

	}
	
	if($_FILES["awardImage"]["name"] == "" &&  $_FILES["awardImage2"]["name"] == "") {
		$tpl->joQuery("INSERT INTO $awards_table VALUES('', '".$awName."', '".$awImage."', '".$awImage2."', 
				                                  '".$awDesc."', '".$awStat."', '".$awValue."', '".$type."', '0')", 2);
			
		$result = "Success";
		$msg = 1;
	}
	
	$tpl->joQuery("INSERT INTO $adminlogs_table VALUES('', 'awards', 'Add Award', '".$result."', '".$joName."', 
	                                                   '".$_SERVER['REMOTE_ADDR']."', '".date("Y-m-d H:i:s")."')", 2);
	
	header("location: ./admin.php?section=awards&type=".$type."&msg=".$msg);
	exit;
}

if(!empty($_POST['edit_awards'])) {

	$type = (!empty($_POST['type']) ? intval($_POST['type']) : 1);

	if(empty($_POST['checkbox'])) {
		header("location: ./admin.php?section=awards&type=".$type."&msg=5");
		exit;
	}

	foreach($_POST['checkbox'] as $value) {

		$a = $_POST['aw'.$value];

		$tpl->joQuery("UPDATE $awards_table SET 
						   name        = '".cMioD4($a[0])."' , 
						   image       = '".cMioD4($a[1])."' , 
						   shadow      = '".cMioD4($a[5])."' , 
						   description = '".cMioD4($a[2])."' , 
						   stat        = '".aGlod3($a[3])."' ,
						   value       = '".intval($a[4])."' 
					   WHERE id = '".intval($value)."'", 2);
	}

	$tpl->joQuery("INSERT INTO $adminlogs_table VALUES('', 'awards', 'Edit Awards', 'Success', '".$joName."', 
	                                                   '".$_SERVER['REMOTE_ADDR']."', '".date("Y-m-d H:i:s")."')", 2);

	header("location: ./admin.php?section=awards&type=".$type."&msg=2");
	exit;
}

if(!empty($_POST['delete_awards'])) {

	$type = (!empty($_POST['type']) ? intval($_POST['type']) : 1);
	
	if(empty($_POST['checkbox'])) {
		header("location: ./admin.php?section=awards&type=".$type."&msg=5");
		exit;
	}

	foreach($_POST['checkbox'] as $value) {
		$tpl->joQuery("DELETE FROM $awards_table WHERE id = '".intval($value)."'", 2);
	}
	
	$tpl->joQuery("INSERT INTO $adminlogs_table VALUES('', 'awards', 'Delete Awards', 'Success', '".$joName."', 
	                                                   '".$_SERVER['REMOTE_ADDR']."', '".date("Y-m-d H:i:s")."')", 2);

	header("location: ./admin.php?section=awards&type=".$type."&msg=3");
	exit;
}