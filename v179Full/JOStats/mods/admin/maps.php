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

$file = "./tpls/admin/admin_maps.tpl";

if(!$tpl->getMgtTpl($file)) {

	$varArray["content"] = $tpl->joErrorRet(1, $section." template");	

} else {

	$mid = (!empty($_GET['mid']) ? intval($_GET['mid']) : "");
	$msg = (!empty($_GET['msg']) ? intval($_GET['msg']) : 0);
	$count = 0;

	$varArray["error"] = "";
	$varArray["getMaps"] = "";
	
	if($mid > 0) {

		$sub = "mapSelected";
		$sql = $tpl->joQuery("SELECT * FROM $maps_table WHERE id = '".$mid."'", 1);
		$row = mysqli_fetch_assoc($sql);
		$row["name"] = base64_decode($row["name"]);
		foreach($row as $tag => $value) {
			$varArray[$tag] = $value;
		}
		
		
		$mapImages = dir("./maps/");
		while(($mapFile = $mapImages->read()) !== false) {

			if($mapFile == $row["image"]) {
				$varArray["getMaps"] .= '<option value="'.htmlspecialchars($mapFile).'" selected="selected">'.htmlspecialchars($mapFile).'</option>';
			}
			if($mapFile != "." && $mapFile != ".." && $mapFile != "index.php") {
				$varArray["getMaps"] .= '<option value="'.htmlspecialchars($mapFile).'">'.htmlspecialchars($mapFile).'</option>';
			}
		}


	} else {

		$sub = "mapMain";
		$sql = $tpl->joQuery("SELECT * FROM $maps_table WHERE image = 'none.gif' OR image = ''", 1);
		$varArray["mapNoImg"] = mysqli_num_rows($sql);
		
		$sql = $tpl->joQuery("SELECT * FROM $maps_table WHERE image != 'none.gif' AND image != ''", 1);
		$varArray["mapImg"] = mysqli_num_rows($sql);
		
		$sqlArray[0]["query"]      = " SELECT * ";
		$sqlArray[0]["tables"]     = " $maps_table ";
		$sqlArray[0]["conditions"] = " ORDER BY name ASC";
		$sqlArray[0]["type"]       = "multi";
		$sqlArray[0]["prefix"]     = "list";
		
		$sqlArray[1]["query"]      = " SELECT * ";
		$sqlArray[1]["tables"]     = " $maps_table ";
		$sqlArray[1]["conditions"] = " WHERE image = 'none.gif' OR image = ''  
									   ORDER BY name ASC";
		$sqlArray[1]["type"]       = "multi";
		$sqlArray[1]["prefix"]     = "list2";
		$count = 2;

	}
	

	switch($msg) {
		case 1: $varArray["msg"] = "New Map Image Added!" ; break;
		case 2: $varArray["msg"] = "Map Image Changed!"; break;
		case 3: $varArray["msg"] = "Map Image Deleted!"  ; break;
		case 4: $varArray["msg"] = "Failed: Could not delete map image!"  ; break;
		case 5: $varArray["msg"] = "Failed: Could not upload map image!"  ; break;
		case 9: $varArray["msg"] = "Failed: Invalid image file!"  ; break;
		case 10: $varArray["msg"] = "Failed: Could not delete map image!"  ; break;
		default: $varArray["msg"] = ""  ;
	}

	$varArray["formAction"] = "./admin.php?section=mapActions";
	$varArray["mid"] = $mid;
	
	$varArray["content"] = $tpl->buildMgtTpl($varArray, $sqlArray, $count, $file, $sub);

}