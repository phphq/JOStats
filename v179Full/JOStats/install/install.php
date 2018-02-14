<?php
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
// File Name     : About Module                              //
// File Version  : 1.0.3 Standalone                          //
//                                                           //
/////////////////////////////////////////////////////////////*/

/*/////////////////////////////////////////////////////////////
//                                                           //
// Updated Dec 2016 By Novahq.net <scott@novahq.net>         //
// Standalone, PHP 5.6+ Compatible                           //
//                                                           //
/////////////////////////////////////////////////////////////*/

$file = "./install/install.tpl";

if(!$tpl->getMgtTpl($file)) {

	$varArray["content"] = $tpl->joErrorRet(2, $section);

} else {
	
	$varArray["formAction"] = "./?";
	
	if(!empty($_POST["begin"])) {

		$sub = "install";

	} elseif(!empty($_POST["installDB"])) {

		$sub = "installDB";

	} elseif(!empty($_POST["saveSettings"])) {

		$plyrShow=(!empty($_POST['plyrShow']) ? intval($_POST['plyrShow']) : 50);
		$mapShow=(!empty($_POST['mapShow']) ? intval($_POST['mapShow']) : 25);
		$wpnShow=(!empty($_POST['wpnShow']) ? intval($_POST['wpnShow']) : 50);
		$vehShow=(!empty($_POST['vehShow']) ? intval($_POST['vehShow']) : 50);
		$squadShow=(!empty($_POST['squadShow']) ? intval($_POST['squadShow']) : 50);

		$tpl->joQuery("INSERT INTO ".$tablepre."_settings VALUES 
		 						('', 'plyrsPerPage' , '".$plyrShow."') , 						
		 						('', 'mapsPerPage'  , '".$mapShow."')  , 						
		 						('', 'wpnsPerPage'  , '".$wpnShow."')  , 						
		 						('', 'vehsPerPage'  , '".$vehShow."')  , 						
		 						('', 'squadsPerPage', '".$squadShow."');", 2);
		$sub = "saveSettings";

	} elseif(!empty($_POST["complete"])) {

		$sub = "complete";

	} else {

		$sub = "begin";

	}

	if($sub == "installDB") {

		$newArray = array();
		$linesArray = @file("./install/install.sql");

		if(!$linesArray) exit("Could not read install.sql! Make sure it exists in ./install/install.sql");
		
		$tableArray = array(
			"adminlogs"     ,
			"awards"        ,  
			"last"          , 
			"layouts"       ,
			"log"           , 
			"maps"          , 
			"mapstats"      , 
		    "monthawards"   , 
			"monthly"       , 
			"playerawards"  , 
			"players"       , 
			"ranks"         , 
			"rating"        , 
			"records"       , 
			"serverhistory" ,
			"servers"       ,
			"serverstats"   , 
			"settings"      , 
			"squads"        , 
			"stats"         ,
			"style"         , 
			"vehicles"      , 
			"vehiclestats"  ,
			"weapons"       ,
			"weaponstats"
		);
		
		$tableArray2 = array(
			"mapstats"     , 
			"stats"        , 
			"vehiclestats" , 
			"weaponstats"     
		);
		
		foreach($tableArray as $table) {
			$tpl->joQuery("DROP TABLE `".$tablepre."_".$table."` ;", 2);
		}
		
		foreach($tableArray2 as $table) {
			$tpl->joQuery("DROP TABLE `".$tablepre2."_".$table."` ;", 2);
		}
		
		$i = 0;	
		foreach($linesArray as $line) {
			if(strstr($line, "{prefix}")) {
				$line = str_replace("{prefix}", $tablepre, $line);
			}
			if(strstr($line, "{prefix2}")) {
				$line = str_replace("{prefix2}", $tablepre2, $line);
			}
			$NlinesArray[$i] = $line;
			$i++;
		}
		

		
		foreach($NlinesArray as $line) {
			if($line != "") {
				$tpl->joQuery("".$line."", 2);
			}
		}
		
		$tableCount = 0;
		foreach($tableArray as $table) {
			if($tpl->joQuery("SELECT * FROM ".$tablepre."_".$table."", 2)) {
				$tableCount++;
			}
		}
		
		foreach($tableArray2 as $table) {
			if($tpl->joQuery("SELECT * FROM ".$tablepre2."_".$table."", 2)) {
				$tableCount++;
			}
		}

		if($tableCount < 28) {

			$sub = "dbFailed";

		} else {

			$sub = "dbSuccess";
			$year  = date("Y");
			$month = date("n") - 1;
			$tpl->joQuery("UPDATE ".$tablepre."_monthly SET status = '1' WHERE month = '".$month."' AND year = '".$year."'", 2);

		}
	}
	
	if($sub == "complete") {

		$varArray["formAction"] = "./?";
		
	}
	
	$varArray["content"] = $tpl->buildMgtTpl($varArray, $sqlArray, 0, $file, $sub);
}