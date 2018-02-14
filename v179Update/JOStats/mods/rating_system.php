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
// Website       : http://www.gamers-central.com             //
// Support       : http://www.babstats.com                   //
//                                                           //
// File Name     : Rating System Module                      //
// File Version  : 1.0.3 Standalone                          //
//                                                           //
/////////////////////////////////////////////////////////////*/

/*/////////////////////////////////////////////////////////////
//                                                           //
// Updated Dec 2016 By Novahq.net <scott@novahq.net>         //
// Standalone, PHP 5.6+ Compatible                           //
//                                                           //
/////////////////////////////////////////////////////////////*/

$file = "./tpls/rating_system.tpl";

if(!$tpl->getMgtTpl($file)) {

	$varArray["content"] = $tpl->joErrorRet(1, $section." template");	

} else {
	
	$varArray["wpns1"] = "";
	$sql = $tpl->joQuery("SELECT * FROM $rating_table WHERE s_type = 'wpnBonus' AND s_stat = '1' ORDER BY s_name", 1);
	while($row = mysqli_fetch_assoc($sql)) {
		$varArray["wpns1"] .= '<tr>
								   <td id="js_row2" align="left">'.$row["s_name"].'</td>
								   <td id="js_row1" align="right" width="45">'.$row["s_pts"].' pts</td>
								   <td id="js_row1" align="right" width="45">'.$row["s_pts2"].' pts</td>
							   </tr>';
	}
	
	$varArray["wpns2"] = "";
	$sql = $tpl->joQuery("SELECT * FROM $rating_table WHERE s_type = 'wpnBonus' AND s_stat = '2' ORDER BY s_name", 1);
	while($row = mysqli_fetch_assoc($sql)) {
		$varArray["wpns2"] .= '<tr>
								   <td id="js_row2" align="left">'.$row["s_name"].'</td>
								   <td id="js_row1" align="right" width="45">'.$row["s_pts"].' pts</td>
								   <td id="js_row1" align="right" width="45">'.$row["s_pts2"].' pts</td>
							   </tr>';
	}
	
	$varArray["wpns3"] = "";
	$sql = $tpl->joQuery("SELECT * FROM $rating_table WHERE s_type = 'wpnBonus' AND s_stat = '4' ORDER BY s_name", 1);
	while($row = mysqli_fetch_assoc($sql)) {
		$varArray["wpns3"] .= '<tr>
								   <td id="js_row2" align="left">'.$row["s_name"].'</td>
								   <td id="js_row1" align="right" width="45">'.$row["s_pts"].' pts</td>
								   <td id="js_row1" align="right" width="45">'.$row["s_pts2"].' pts</td>
							   </tr>';
	}
	
	$varArray["wpns4"] = "";
	$sql = $tpl->joQuery("SELECT * FROM $rating_table WHERE s_type = 'wpnBonus' AND s_stat = '5' ORDER BY s_name", 1);
	while($row = mysqli_fetch_assoc($sql)) {
		$varArray["wpns4"] .= '<tr>
								   <td id="js_row2" align="left">'.$row["s_name"].'</td>
								   <td id="js_row1" align="right" width="45">'.$row["s_pts"].' pts</td>
								   <td id="js_row1" align="right" width="45">'.$row["s_pts2"].' pts</td>
							   </tr>';
	}
	
	$varArray["wpns5"] = "";
	$sql = $tpl->joQuery("SELECT * FROM $rating_table WHERE s_type = 'wpnBonus' AND s_stat = '3' ORDER BY s_name", 1);
	while($row = mysqli_fetch_assoc($sql)) {
		$varArray["wpns5"] .= '<tr>
								   <td id="js_row2" align="left">'.$row["s_name"].'</td>
								   <td id="js_row1" align="right" width="45">'.$row["s_pts"].' pts</td>
								   <td id="js_row1" align="right" width="45">'.$row["s_pts2"].' pts</td>
							   </tr>';
	}
	
	$sqlArray[0]["query"]      = "SELECT * ";
	$sqlArray[0]["tables"]     = " $rating_table ";
	$sqlArray[0]["conditions"] = " WHERE s_type = 'gameBonus' ";
	$sqlArray[0]["type"]       = "multi";
	$sqlArray[0]["prefix"]     = "list";
	
	$varArray["content"] = $tpl->buildMgtTpl($varArray, $sqlArray, 1, $file, "");
}