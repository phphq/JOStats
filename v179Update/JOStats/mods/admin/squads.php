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

$file = "./tpls/admin/admin_squads.tpl";

if(!$tpl->getMgtTpl($file)) {

	$varArray["content"] = $tpl->joErrorRet(1, $section." template");	
	
} else {

	$varArray["error"]     = "";

	$sqid = (!empty($_GET['sqid']) ? intval($_GET['sqid']) : "");
	$msg = (!empty($_GET['msg']) ? intval($_GET['msg']) : 0);

	if($sqid > 0) {

		$varArray["formAction"] = "./admin.php?section=squadActions&sqid=".$sqid;
		$varArray["sqid"] = $sqid;

		$sub = "squadSelected";
		$sql = $tpl->joQuery("SELECT * FROM $squads_table WHERE id = '".$sqid."'", 1);

		$row = mysqli_fetch_assoc($sql);

		if(empty($row)) exit("Invalid squad");

		foreach($row as $tag => $value) {
			$varArray[$tag] = $value;
		}

		$varArray["selLogo"] = "";
		$varArray["getLogo"] = "";
		$logoImages = dir("./logos/");
		while(($logoFile = $logoImages->read()) !== false) {
			if($logoFile == $row["logo"]) {
				$varArray["selLogo"] .= '<option value="'.$logoFile.'" selected>'.$logoFile.'</option>';
			}
			if($logoFile != "." && $logoFile != ".." && $logoFile != "index.php") {
				$varArray["getLogo"] .= '<option value="'.$logoFile.'">'.$logoFile.'</option>';
			}
		}
		
		$varArray["getPlayers"] = "";
		$sql = $tpl->joQuery("SELECT * FROM $players_table WHERE squad != '".$sqid."'", 1);
		while($row2 = mysqli_fetch_assoc($sql)) {
			$varArray["getPlayers"] .= '<option value="'.$row2["id"].'">'.$row2["name"].'</option>';
		}
		$sqlArray[0]["query"]      = " SELECT * ";
		$sqlArray[0]["tables"]     = " $players_table ";
		$sqlArray[0]["conditions"] = " WHERE squad = '".$sqid."' ORDER BY name ASC";
		$sqlArray[0]["type"]       = "multi";
		$sqlArray[0]["prefix"]     = "list";
		$count = 1;

	} else {

		$varArray["formAction"] = "./admin.php?section=squadActions";

		$sub = "squadMain";
		$sql = $tpl->joQuery("SELECT * FROM $squads_table", 1);
		$varArray["squadNum"] = mysqli_num_rows($sql);
		
		$sql = $tpl->joQuery("SELECT * FROM $squads_table WHERE logo = 'none.gif' OR logo = ''", 1);
		$varArray["squadNoLogo"] = mysqli_num_rows($sql);
		
		$sql = $tpl->joQuery("SELECT * FROM $squads_table WHERE logo != 'none.gif' AND logo != ''", 1);
		$varArray["squadLogo"] = mysqli_num_rows($sql);
		
		$sql = $tpl->joQuery("SELECT * FROM $squads_table WHERE url = ''", 1);
		$varArray["squadNoUrl"] = mysqli_num_rows($sql);
		
		$sql = $tpl->joQuery("SELECT * FROM $squads_table WHERE url != ''", 1);
		$varArray["squadUrl"] = mysqli_num_rows($sql);
		
		$sqlArray[0]["query"]      = " SELECT * ";
		$sqlArray[0]["tables"]     = " $squads_table ";
		$sqlArray[0]["conditions"] = " ORDER BY name ASC";
		$sqlArray[0]["type"]       = "multi";
		$sqlArray[0]["prefix"]     = "list";
		$count = 1;

	}
	
	

	switch($msg) {
		case 1 : $varArray["msg"] = "New Squad Logo Added!"                 ; break;
		case 2 : $varArray["msg"] = "Squad Logo Changed!"                   ; break;
		case 3 : $varArray["msg"] = "Squad Logo Deleted!"                   ; break;
		case 4 : $varArray["msg"] = "Player added to squad list!"           ; break;
		case 5 : $varArray["msg"] = "Player(s) removed from squad list!"    ; break;
		case 6 : $varArray["msg"] = "Squad Details Updated!"                ; break;
		case 7 : $varArray["msg"] = "Squad Added!"                          ; break;
		case 8 : $varArray["msg"] = "Squad Deleted!"                        ; break;
		case 9 : $varArray["msg"] = "Failed: Could not upload logo image!"  ; break;
		case 10: $varArray["msg"] = "Failed: Could not delete logo image!"  ; break;
		case 11: $varArray["msg"] = "Failed: Invalid Image!" ; break;
		case 12: $varArray["msg"] = "Failed: Squad name/tag cannot be blank!" ; break;
		case 13: $varArray["msg"] = "Failed: Invalid pid!" ; break;
		default: $varArray["msg"] = "";
	}

	
	
	$varArray["content"] = $tpl->buildMgtTpl($varArray, $sqlArray, $count, $file, $sub);

}