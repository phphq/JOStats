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

$file = "./tpls/admin/admin_awards.tpl";

if(!$tpl->getMgtTpl($file)) {

	$varArray["content"] = $tpl->joErrorRet(1, $section." template");	

} else {
	
	$type = (!empty($_GET['type']) ? intval($_GET['type']) : 1);
	$msg = (!empty($_GET['msg']) ? intval($_GET['msg']) : 0);

	$varArray["type"] = $type;
	$varArray["awardsList"] = "";
	
	$varArray["error"] = "";
	$varArray["msg"]   = "";

	$notUse = array("sid", "player", "team", "role", "exp", "gameType", "lastUpdate");
	
	$i = 1;
	
	$awardImages = dir("./awards");
	$imageList = "";
	while(($awardFile = $awardImages->read()) !== false) {
		if($awardFile != "." && $awardFile != "..") {
			$imageList .= '<option value="'.$awardFile.'">'.$awardFile.'</option>';
		}
	}
	
	$awardImages2 = dir("./awards/shadow");
	$imageList2 = "";
	while(($awardFile2 = $awardImages2->read()) !== false) {
		if($awardFile2 != "." && $awardFile2 != "..") {
			$imageList2 .= '<option value="'.$awardFile2.'">'.$awardFile2.'</option>';
		}
	}
	
	$statList = "";
	switch($type) {
		case 1: 
			$sub = "game"; 
			$sql1 = $tpl->joQuery("SHOW COLUMNS FROM $stats_table", 1);
			while($row1 = mysqli_fetch_assoc($sql1)) {
				if(!in_array($row1["Field"], $notUse)) {
					$statList .= '<option value="'.$row1["Field"].'">'.$row1["Field"].'</option>';
				}
			}
		break;
		case 2: 

			exit("this seems to be broken? did it ever work? view the readme and contact me.");

			$sub = "wpns";
			$newAwardArray = array();
			foreach($wpn_name[0] as $wpnName) {
				if(!in_array($wpnName, $newAwardArray)) $newAwardArray[] = htmlspecialchars($wpnName);
			}
			foreach($wpn_name[1] as $wpnName) {
				if(!in_array($wpnName, $newAwardArray)) $newAwardArray[] = htmlspecialchars($wpnName);
			}
			foreach($wpn_name[2] as $wpnName) {
				if(!in_array($wpnName, $newAwardArray)) $newAwardArray[] = htmlspecialchars($wpnName);
			}
			foreach($wpn_name[3] as $wpnName) {
				if(!in_array($wpnName, $newAwardArray)) $newAwardArray[] = htmlspecialchars($wpnName);
			}
			
			asort($newAwardArray);
			
			foreach($newAwardArray as $award) {
				$statList .= '<option value="'.$award.'_kills">'.$award.' Kills</option>';
			}
		break;
	}
	
	$varArray["imageList"] = $imageList;
	$varArray["imageList2"] = $imageList2;
	$varArray["statList"] = $statList;
	
	$sql = $tpl->joQuery("SELECT * FROM $awards_table WHERE type = '$type' ORDER by stat ASC, value ASC", 1);
	while($row = mysqli_fetch_assoc($sql)) {
		$imageSel = "";
		$statSel = "";
		$imageSel2 = "";
		
		$awardImages = dir("./awards");
		while(($awardFile = $awardImages->read()) !== false) {
			if($awardFile == $row["image"]) {
				$imageSel = '<option value="'.$awardFile.'" selected>'.htmlspecialchars($awardFile).'</option>';
			}
		}
		
		$awardImages2 = dir("./awards/shadow");
		while(($awardFile2 = $awardImages2->read()) !== false) {
			if($awardFile2 == $row["shadow"]) {
				$imageSel2 = '<option value="'.$awardFile2.'" selected>'.htmlspecialchars($awardFile2).'</option>';
			}
		}
		
		if($type == 1) {
			$sql1 = $tpl->joQuery("SHOW COLUMNS FROM $stats_table", 1);
			while($row1 = mysqli_fetch_assoc($sql1)) {
				if($row1["Field"] == $row["stat"]) {
					$statSel = '<option value="'.$row1["Field"].'" selected>'.htmlspecialchars($row1["Field"]).'</option>';
				}
			}
		} elseif($type == 2) {
			foreach($newAwardArray as $wpnName) {
				if($wpnName."_kills" == $row["stat"]) {
					$statSel = '<option value="'.$wpnName.'_kills" selected>'.htmlspecialchars($wpnName).' Kills</option>';
				}
			}
		}
		
		$varArray["awardsList"] .= '<tr>
									  <td>'.$i.'</td>
									  <td>
									    <input name="aw'.$row["id"].'[]" type="text" value="'.htmlspecialchars($row["name"]).'">
									  </td>
									  <td>
									    <select name="aw'.$row["id"].'[]">
									    '.$imageSel.$imageList.'	
									    </select>
									  </td>
									  <td>
									    <input name="aw'.$row["id"].'[]" type="text" value="'.htmlspecialchars($row["description"]).'">
									  </td>
									  <td>
									    <select name="aw'.$row["id"].'[]">
										  '.$statSel.$statList.'
									    </select>
									  </td>
									  <td>
									    <input name="aw'.$row["id"].'[]" type="text" id="aw'.
										$row["id"].'[]" value="'.$row["value"].'" size="6">
									  </td>
									  <td>
									    <input type="checkbox" name="checkbox[]" value="'.$row["id"].'">
									  </td>
								    </tr>
									<tr>
									  <td>&nbsp;</td>
									  <td>&nbsp;</td>
									  <td>
									    <select name="aw'.$row["id"].'[]">
									    '.$imageSel2.$imageList2.'	
									    </select>
									  </td>
									  <td>&nbsp;</td>
									  <td>&nbsp;</td>
									  <td>&nbsp;</td>
									  <td>&nbsp;</td>
								    </tr>';
		$i++;
	}

	switch($msg) {
		case 1: $varArray["msg"] = "Award Added!"                          ; break;
		case 2: $varArray["msg"] = "Award(s) Edited!"                      ; break;
		case 3: $varArray["msg"] = "Award(s) Deleted!"                     ; break;
		case 4: $varArray["msg"] = "Failed: Could not upload award image!" ; break;
		case 5: $varArray["msg"] = "Failed: Make a selection" ; break;
		case 6: $varArray["msg"] = "Failed: Blank award!" ; break;
		case 7: $varArray["msg"] = "Failed: Invalid Image!" ; break;
		default: $varArray["msg"] = "" ; break;
	}

	$varArray["content"] = $tpl->buildMgtTpl($varArray, $sqlArray, 0, $file, $sub);

}