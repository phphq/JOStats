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

$file = "./tpls/monthly_awards.tpl";

if(!$tpl->getMgtTpl($file)) {

	$varArray["content"] = $tpl->joErrorRet(1, $section." template");	
	
} else {

	$msel=(!empty($_GET['msel']) ? aGlod3($_GET['msel']) : '');

	$varArray["formAction"] = "./?";
	$varArray["section"] = "monthly_awards";

	$conditions = "";

	if(!$msel) {

		$conditions = " WHERE year_gained = 'Alltime' ";
		$varArray["titleName"] = "Alltime";

	} else {
		$monthDiv = explode("_", $msel);

		if(empty($monthDiv[0]) || empty($monthDiv[1])) {
			exit("Invalid month/year selected");
		}

		$conditions = " WHERE month_gained = '".$monthDiv[0]."' AND year_gained = '".$monthDiv[1]."'";
		$varArray['titleName'] = $monthDiv[0]." ".$monthDiv[1];
	}

	$varArray["msel"] = "";
	$sql = $tpl->joQuery("SELECT * FROM $monthawards_table WHERE year_gained <> 'Alltime' GROUP BY month_gained, year_gained", 1);
	while($row = mysqli_fetch_assoc($sql)) {
		$varArray["msel"] .= '<option value="'.$row["month_gained"]."_".$row["year_gained"].'">'.
		                          $row["month_gained"]." ".$row["year_gained"].'</option>';
	}
	
	$varArray["monthlyAwards"] = "";
	$mtNum = 1;
	$mtSql = $tpl->joQuery("SELECT * FROM $monthawards_table $conditions", 1);
	while($mtRow = mysqli_fetch_assoc($mtSql)) {


		$mtClass = $mtNum % 2 == 0 ? "js_row1" : "js_row2";

		if($mtRow["monthaward"] == "Most Time Played") $mtRow["value"] = $tpl->joFormatTime($mtRow["value"]);
		
		$varArray["monthlyAwards"] .= '<tr id="'.$mtClass.'">
										   <td>'.$mtNum.'</td>
										   <td><div align="left">'.$mtRow["monthaward"].'</div></td>
										   <td><div align="left">'.htmlspecialchars($mtRow["player"]).'</div></td>
										   <td><div align="right">'.$mtRow["value"].'</div></td>
										   <td><div align="right">'.$mtRow["date"].'</div></td>
									   </tr>';
									   
		$mtNum++;
	}
	
	$varArray["content"] = $tpl->buildMgtTpl($varArray, $sqlArray, 1, $file, "");
}