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

$file = "./tpls/admin/admin_misc.tpl";

if(!$tpl->getMgtTpl($file)) {

	$varArray["content"] = $tpl->joErrorRet(1, $section." template");	
	
} else {
	
	$msg = (!empty($_GET['msg']) ? intval($_GET['msg']) : 0);
	$varArray["error"] = "";
	$varArray["msg"]   = "";
	
	$sql = $tpl->joQuery("SELECT * FROM $settings_table", 1);
	while($row = mysqli_fetch_assoc($sql)) {
		$settings[$row["setting"]] = $row["value"];
	}
	if(mysqli_num_rows($sql) > 0) {
		foreach($settings as $var => $value) {
			$varArray[$var] = $value;
		}
	}
	
	switch($msg) {
		case 1: $varArray["msg"] = "Config settings updated successfully!"      ; break;
		case 2: $varArray["msg"] = "JOStats database backup successful!"        ; break;
		case 3: $varArray["msg"] = "JOStats database backup failed!"            ; break;
		case 4: $varArray["msg"] = "Failed to update config settings!"          ; break;
		case 5: $varArray["msg"] = "JOStats database reset successful!"         ; break;
		case 6: $varArray["msg"] = "JOStats database deleted successful!"       ; break;
		case 7: $varArray["msg"] = "No Monthly Stats to Reset!"                 ; break;
		case 8: $varArray["msg"] = "Monthly stats reset and Awards calculated!" ; break;
		default: $varArray["msg"] = "" ; break;
	}

	////mysqli_free_result($sql);
	$varArray["monthList"] = "";
	
	$sql = $tpl->joQuery("SELECT SUBSTRING(last_played, 1, 7) AS month FROM $stats_m_table GROUP BY month", 1);
	while($row = mysqli_fetch_assoc($sql)){
		$exDate = explode("-", $row["month"]);
		switch($exDate[1]) {
			case '01': $row["fMonth"] = "Jan ".$exDate[0]; break;
			case '02': $row["fMonth"] = "Feb ".$exDate[0]; break;
			case '03': $row["fMonth"] = "Mar ".$exDate[0]; break;
			case '04': $row["fMonth"] = "Apr ".$exDate[0]; break;
			case '05': $row["fMonth"] = "May ".$exDate[0]; break;
			case '06': $row["fMonth"] = "Jun ".$exDate[0]; break;
			case '07': $row["fMonth"] = "Jul ".$exDate[0]; break;
			case '08': $row["fMonth"] = "Aug ".$exDate[0]; break;
			case '09': $row["fMonth"] = "Sep ".$exDate[0]; break;
			case '10': $row["fMonth"] = "Oct ".$exDate[0]; break;
			case '11': $row["fMonth"] = "Nov ".$exDate[0]; break;
			case '12': $row["fMonth"] = "Dec ".$exDate[0]; break;
		}
		
		$varArray["monthList"] .= '<tr id="js_text">
									   <td>'.$row["fMonth"].'</td>
									   <td align="center">
										   <input id="js_button" name="radiobutton" type="radio" value="'.$row["month"].'" />
									   </td>
								   </tr>';
	}
	
	$varArray["content"] = $tpl->buildMgtTpl($varArray, $sqlArray, 0, $file, "");
}