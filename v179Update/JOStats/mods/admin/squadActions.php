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

if(isset($_GET['sqid'])) {
	$sqid = (!empty($_GET['sqid']) ? intval($_GET['sqid']) : 0);
} else {
	$sqid = (!empty($_POST['sqid']) ? intval($_POST['sqid']) : 0);
}

if(!empty($_POST["select_squad"])) {

	$sqid = (!empty($_POST['sqid']) ? intval($_POST['sqid']) : 0);
	header("location: ./admin.php?section=squads&sqid=".$sqid);
	exit;

} elseif(!empty($_POST["delete_squad"])) {

	$sqid = (!empty($_POST['sqid']) ? intval($_POST['sqid']) : 0);
	
	$sSql = $tpl->joQuery("SELECT * FROM $squads_table WHERE id = '".$sqid."'", 1);
	$sRow = mysqli_fetch_assoc($sSql);
	$name = $sRow["name"];
	$sql = $tpl->joQuery("SELECT * FROM $players_table WHERE squad = '".$sqid."'", 1);
	while($row = mysqli_fetch_assoc($sql)) {
		$tpl->joQuery("UPDATE $players_table SET squad = '0' WHERE id = '".$row["id"]."'", 2);
	}
	$tpl->joQuery("DELETE FROM $squads_table WHERE id = '".$sqid."'", 2);
	$tpl->joQuery("INSERT INTO $adminlogs_table VALUES('', 'squads', 'Squad Deleted_".$tpl->joEscape($name)."', 'Success', '".$joName."', 
                                                       '".$_SERVER['REMOTE_ADDR']."', '".date("Y-m-d H:i:s")."')", 2);

	header("location: ./admin.php?section=squads&msg=8");
	exit;

} elseif(!empty($_POST["upload_logo"])) {

	$msg=11;

	if($_FILES["uploadLogo"]["name"]) {

		joWriteable("./logos/");

		$_FILES["uploadLogo"]["name"] = str_replace("%","",$_FILES["uploadLogo"]["name"]);

		if($_FILES["uploadLogo"]["size"] > 0) {

			$filename = cMioD4($_FILES["uploadLogo"]["name"]);
			if(!joValidImage($_FILES["uploadLogo"]["tmp_name"])) {
				header("location: ./admin.php?section=squads&msg=11");
				exit;
			}

			if(@move_uploaded_file($_FILES["uploadLogo"]["tmp_name"], "./logos/".$filename)) {
				$tpl->joQuery("UPDATE $squads_table SET logo = '".$filename."' WHERE id = '".$sqid."'", 2);
				$tpl->joQuery("INSERT INTO $adminlogs_table VALUES('', 'squads', 'Logo Uploaded_".$sqid."', 'Success', '".$joName."', 
	                                                  '".$_SERVER['REMOTE_ADDR']."', '".date("Y-m-d H:i:s")."')", 2);
				$msg = 1;
			} else {
				$tpl->joQuery("INSERT INTO $adminlogs_table VALUES('', 'squads', 'Logo Uploaded_".$sqid."', 'Failed', '".$joName."', 
	                                                  '".$_SERVER['REMOTE_ADDR']."', '".date("Y-m-d H:i:s")."')", 2);
				$msg = 9;
			}
		}
	}

	header("location: ./admin.php?section=squads&sqid=".$sqid."&msg=".$msg);
	exit;

} elseif(!empty($_POST["change_logo"])) {

	$logoImage = (!empty($_POST['logoImage']) ? cMioD4($_POST['logoImage']) : "none.gif");

	$tpl->joQuery("UPDATE $squads_table SET logo = '".$logoImage."' WHERE id = '".$sqid."'", 2);
	
	$tpl->joQuery("INSERT INTO $adminlogs_table  VALUES('', 'squads', 'Logo Changed_".$sqid."', 'Success', '".$joName."', 
	                                                   '".$_SERVER['REMOTE_ADDR']."', '".date("Y-m-d H:i:s")."')", 2);
				 
	header("location: ./admin.php?section=squads&sqid=".$sqid."&msg=2");
	exit;

} elseif(!empty($_POST["delete_logo"])) {

	joWriteable("./logos/");

	$sql = $tpl->joQuery("SELECT * FROM $squads_table WHERE id = '".$sqid."'", 1);
	$row = mysqli_fetch_assoc($sql);

	$logoName = "./logos/".$row["logo"];

	if($row["logo"]=="none.gif") {

		$msg = 10;

	} elseif(!@unlink($logoName)) {

		$tpl->joQuery("INSERT INTO $adminlogs_table VALUES('', 'squads', 'Logo Deleted_".$sqid."', 'Failed', '".$joName."', 
		                                                  '".$_SERVER['REMOTE_ADDR']."', '".date("Y-m-d H:i:s")."')", 2);
		$msg = 10;

	} else {
		$tpl->joQuery("UPDATE $squads_table SET logo = 'none.gif' WHERE id = '".$sqid."'", 2);
		$tpl->joQuery("INSERT INTO $adminlogs_table VALUES('', 'squads', 'Logo Deleted_".$sqid."', 'Success', '".$joName."', 
		                                                  '".$_SERVER['REMOTE_ADDR']."', '".date("Y-m-d H:i:s")."')", 2);
		$msg = 3;				 
	}
	 
	header("location: ./admin.php?section=squads&sqid=".$sqid."&msg=".$msg);
	exit;

} elseif(!empty($_POST["add_player"])) {

	$plyrList = (!empty($_POST['plyrList']) ? intval($_POST['plyrList']) : 0);

	if(!$plyrList) {
		header("location: ./admin.php?section=squads&sqid=".$sqid."&msg=13");
		exit;
	}

	$tpl->joQuery("UPDATE $players_table SET squad = '".$sqid."' WHERE id = '".$plyrList."'", 2);
	
	$tpl->joQuery("INSERT INTO $adminlogs_table VALUES('', 'squads', 'Squad Player Added_".$sqid."', 'Success', '".$joName."', 
	                                                   '".$_SERVER['REMOTE_ADDR']."', '".date("Y-m-d H:i:s")."')", 2);
	
	header("location: ./admin.php?section=squads&sqid=".$sqid."&msg=4");
	exit;

} elseif(!empty($_POST["remove_players"])) {

	$plyrID = ((!empty($_POST['plyrID']) && is_array($_POST['plyrID'])) ? array_map('dfyu56d', $_POST['plyrID']) : array());

	foreach($plyrID as $pId) {
		$tpl->joQuery("UPDATE $players_table SET squad = '0' WHERE id = '".$pId."'", 2);
	}
	
	$tpl->joQuery("INSERT INTO $adminlogs_table VALUES('', 'squads', 'Squad Players Removed_".$sqid."', 'Success', '".$joName."', 
	                                                   '".$_SERVER['REMOTE_ADDR']."', '".date("Y-m-d H:i:s")."')", 2);
	
	header("location: ./admin.php?section=squads&sqid=".$sqid."&msg=5");
	exit;


} elseif(!empty($_POST["edit_squad"])) {

	$squadName = (!empty($_POST['squadName']) ? $_POST['squadName'] : '');
	$squadTag = (!empty($_POST['squadTag']) ? $_POST['squadTag'] : '');
	$squadUrl = (!empty($_POST['squadUrl']) ? $_POST['squadUrl'] : '');
	$squadInfo = (!empty($_POST['squadInfo']) ? $_POST['squadInfo'] : '');

	if(!$squadName || !$squadTag) {
		header("location: ./admin.php?section=squads&msg=12");
		exit;
	}

	if(!strstr(strtolower($squadUrl), "http")) $squadUrl = "http://".$squadUrl;

	if (filter_var($squadUrl, FILTER_VALIDATE_URL) === false) {	
		$squadUrl = "";
	}
	
	$tpl->joQuery("UPDATE $squads_table SET 
				       name = '".$tpl->joEscape($squadName)."' , 
					   tag  = '".$tpl->joEscape($squadTag)."'  , 
					   url  = '".$tpl->joEscape($squadUrl)."'  , 
					   info = '".$tpl->joEscape($squadInfo)."' 
			       WHERE id = '".$sqid."'", 2);
	
	$tpl->joQuery("INSERT INTO $adminlogs_table VALUES('', 'squads', 'Squad Info Edited_".$sqid."', 'Success', '".$joName."', 
	                                                   '".$_SERVER['REMOTE_ADDR']."', '".date("Y-m-d H:i:s")."')", 2);

	header("location: ./admin.php?section=squads&sqid=".$sqid."&msg=6");
	exit;

} elseif(!empty($_POST["add_squad"])) {

	$squadName = (!empty($_POST['squadName']) ? $_POST['squadName'] : '');
	$squadTag = (!empty($_POST['squadTag']) ? $_POST['squadTag'] : '');
	$squadUrl = (!empty($_POST['squadUrl']) ? $_POST['squadUrl'] : '');
	$squadInfo = (!empty($_POST['squadInfo']) ? $_POST['squadInfo'] : '');

	if(!$squadName || !$squadTag) {
		header("location: ./admin.php?section=squads&msg=12");
		exit;
	}

	if(!strstr(strtolower($squadUrl), "http")) $squadUrl = "http://".$squadUrl;

	if (filter_var($squadUrl, FILTER_VALIDATE_URL) === false) {	
		$squadUrl = "";
	}
	
	$tpl->joQuery("INSERT INTO $squads_table VALUES('', 
	                                          '".$tpl->joEscape($squadName)."', 
											  '".$tpl->joEscape($squadTag)."', 
											  '".$tpl->joEscape($squadUrl)."', 
											  '".$tpl->joEscape($squadInfo)."', 
			                                  'none.gif', '".date("Y-m-d")."')", 2);
	
	$tpl->joQuery("INSERT INTO $adminlogs_table VALUES('', 'squads', 'Squad Added', 'Success', '".$joName."', 
	                                                   '".$_SERVER['REMOTE_ADDR']."', '".date("Y-m-d H:i:s")."')", 2);
	
	header("location: ./admin.php?section=squads&msg=7");
	exit;

} else {

	header("location: ./admin.php?section=squads");
	exit;	
	
}