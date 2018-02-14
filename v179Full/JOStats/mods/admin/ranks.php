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

$file = "./tpls/admin/admin_ranks.tpl";

if(!$tpl->getMgtTpl($file)) {

	$varArray["content"] = $tpl->joErrorRet(1, $section." template");	

} else {
	
	$varArray["error"] = "";
	$msg = (!empty($_GET['msg']) ? intval($_GET['msg']) : 0);
	
	$i = 1;
	$rankImages = dir("./ranks/");
	$imageList="";
	while(($rankFile = $rankImages->read()) !== false) {
		if($rankFile != "." && $rankFile != ".." && $rankFile != "index.php") {
			$imageList .= '<option value="'.$rankFile.'">'.$rankFile.'</option>';
		}
	}
	
	$varArray["imageList"] = $imageList;
	$varArray["ranksList"] = "";
	
	$sql = $tpl->joQuery("SELECT * FROM $ranks_table ORDER BY rating ASC", 1);

	$i=0;
	$varArray["ranksList"] = "";
	$imageSel = "";
	while($row = mysqli_fetch_assoc($sql)) {
		
		$rankImages = dir("./ranks/");
		while(($rankFile = $rankImages->read()) !== false) {

			if($rankFile == $row["image"]) {
				$imageSel = '<option value="'.$rankFile.'" selected>'.$rankFile.'</option>';
			}

		}
		
		$varArray["ranksList"] .= '<tr>
									<td>'.$i.'</td>
									<td width="27" style="background-color:#161b33;">
									  <img name="'.$row["name"].'" src="'."./ranks/".
									  $row["image"].'" width="64" alt="'.$row["name"].'" />
									</td>
									<td>
									  <input name="rk'.$row["id"].'[]" type="text" value="'.htmlspecialchars($row["name"]).'">
									</td>
									<td>
									  <select name="rk'.$row["id"].'[]">
									  '.$imageSel.$imageList.'	
									  </select>
									</td>
									<td>
									  <input name="rk'.$row["id"].'[]" type="text" id="rk'.$row["id"].'[]" value="'.
									  $row["rating"].'" size="6">
									</td>
									<td>
									  <input type="checkbox" name="checkbox[]" value="'.$row["id"].'">
									</td>
								  </tr>';
		$i++;
	}
	

	switch($msg) {
		case 1: $varArray["msg"] = "Rank Added!"                           ; break;
		case 2: $varArray["msg"] = "Rank(s) Edited!"                       ; break;
		case 3: $varArray["msg"] = "Rank(s) Deleted!"                      ; break;
		case 4: $varArray["msg"] = "Failed: Could not upload rank image!"  ; break;
		case 5: $varArray["msg"] = "Failed: Make a selection" ; break;
		case 6: $varArray["msg"] = "Failed: Blank rank!" ; break;
		case 7: $varArray["msg"] = "Failed: Invalid Image!" ; break;
		default: $varArray["msg"] = "";
	}


	$varArray["content"] = $tpl->buildMgtTpl($varArray, $sqlArray, 0, $file, "");

}