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

$file = "./tpls/admin/admin_layout.tpl";

if(!$tpl->getMgtTpl($file)) {

	$varArray["content"] = $tpl->joErrorRet(1, $section." template");	
	
} else {
	
	$msg = (!empty($_GET['msg']) ? intval($_GET['msg']) : 0);

	$varArray["error"] = "";
	$varArray["msg"]   = "";
	$varArray["layoutList"] = "";
	
	$fSql = $tpl->joQuery("SELECT * FROM $layouts_table WHERE page = 'kill_stats'", 1);
	if(@mysqli_num_rows($fSql) > '0') {
		$fRow = mysqli_fetch_assoc($fSql);
		$fSplit = explode(",", $fRow["fields"]);
	}
	
	$sql = $tpl->joQuery("SHOW COLUMNS FROM $stats_table", 1);
	$num=0;
	while($row = mysqli_fetch_assoc($sql)) {
		if(!strstr($row["Field"], "score") && $row["Field"] != "team" && $row["Field"] != "server" && 
		           $row["Field"] != "game_type" && $row["Field"] != "grating" && $row["Field"] != "player") {
			$checked = '';
			if(@mysqli_num_rows($fSql) > '0') {
				foreach($fSplit as $field) {
					if($row["Field"] == $field) $checked = 'checked="checked"';
				}
			}
			if($num % 5 == 0){
				$varArray["layoutList"] .= '<tr id="js_text">
												<td><input name="kill_stats['.$row["Field"].']" type="checkbox" id="'.
												$row["Field"].'" value="'.$row["Field"].'" '.$checked.' /></td>
												<td>'.statAlt($row["Field"]).'</td>';
			} elseif($num % 5 == 4){
				$varArray["layoutList"] .= '    <td><input name="kill_stats['.$row["Field"].']" type="checkbox" id="'.
												$row["Field"].'" value="'.$row["Field"].'" '.$checked.' /></td>
												<td>'.statAlt($row["Field"]).'</td>
											</tr>';
			} else {
				$varArray["layoutList"] .= '    <td><input name="kill_stats['.$row["Field"].']" type="checkbox" id="'.
												$row["Field"].'" value="'.$row["Field"].'" '.$checked.' /></td>
												<td>'.statAlt($row["Field"]).'</td>';
			}
			$num++;
		}
	}

	$sql = $tpl->joQuery("SHOW COLUMNS FROM $players_table", 1);
	while($row = mysqli_fetch_assoc($sql)) {
		if($row["Field"] != "id" && $row["Field"] != "name" && $row["Field"] != "squad" && 
		           $row["Field"] != "m_rating" && $row["Field"] != "dm_value" && $row["Field"] != "rating") {
			$checked = '';
			if(@mysqli_num_rows($fSql) > '0') {
				foreach($fSplit as $field) {
					if($row["Field"] == $field) $checked = 'checked="checked"';
				}
			}
			if($num % 5 == 0){
				$varArray["layoutList"] .= '<tr id="js_text">
												<td><input name="kill_stats['.$row["Field"].']" type="checkbox" id="'.
												$row["Field"].'" value="'.$row["Field"].'" '.$checked.' /></td>
												<td>'.statAlt($row["Field"]).'</td>';
			} elseif($num % 5 == 4){
				$varArray["layoutList"] .= '    <td><input name="kill_stats['.$row["Field"].']" type="checkbox" id="'.
												$row["Field"].'" value="'.$row["Field"].'" '.$checked.' /></td>
												<td>'.statAlt($row["Field"]).'</td>
											</tr>';
			} else {
				$varArray["layoutList"] .= '    <td><input name="kill_stats['.$row["Field"].']" type="checkbox" id="'.
												$row["Field"].'" value="'.$row["Field"].'" '.$checked.' /></td>
												<td>'.statAlt($row["Field"]).'</td>';
			}
			$num++;
		}
	}


	switch($msg) {
		case 1: $varArray["msg"] = "Layouts updated!" ; break;
		case 2: $varArray["msg"] = "Could not update layouts!"; break;
		case 3: $varArray["msg"] = "Select something!"; break;
		default: $varArray["msg"] = ""  ;
	}
	
	$varArray["content"] = $tpl->buildMgtTpl($varArray, $sqlArray, 0, $file, "");
}