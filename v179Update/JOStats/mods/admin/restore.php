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

function GetJoDisplayDate($string) {

	$buString = explode("_", substr($string, 0, -4));
	$date = "";
	$time = "";
	
	if(!empty($buString[1])) {
		$dateString = explode("-", $buString[1]);
		$date = $dateString[2]." ".date("M", $dateString[1])." ".$dateString[0];
	}

	if(!empty($buString[2])) {
		$timeString = explode(".", $buString[2]);
		$time = $timeString[0].":".$timeString[1].":".$timeString[2];
	}

	$display = $date." (time ".$time.")";
	return $display;
}


$file = "./tpls/admin/admin_restore.tpl";

if(!$tpl->getMgtTpl($file)) {

	$varArray["content"] = $tpl->joErrorRet(1, $section." template");	

} else {

	if(!isset($sub) || $sub == "") $sub = "main";
	$varArray["msg"] = "";
	
	if(!empty($_POST["restore_backup"])) {

		$backupSel=(!empty($_POST['backupSel']) ? $_POST['backupSel'] : "");

		if(!$backupSel || !file_exists("./backups/".$backupSel)) {

			$varArray["msg"] = "Backup not found!";

		} else {

			$newArray = array();
			$linesArray2 = file("./backups/".$backupSel);

			$tables = array("awards", "last", "log", "maps", "mapstats", "monthawards", "monthly", "playerawards", 
	                        "players", "ranks", "rating", "records", "squads", "servers", "serverhistory", "serverstats", 
					        "settings", "stats", "style", "weapons", "weaponstats", "vehicles", "vehiclestats");
			$mtables = array("mapstats", "stats", "weaponstats", "vehiclestats");
			
			$newArray = array();
			$linesArray = file("./reset.sql");
			
			foreach($tables as $table) {
				$tpl->joQuery("DROP TABLE `".$tablepre."_".$table."`;", 2);
			}
				
			foreach($mtables as $table) {
				$tpl->joQuery("DROP TABLE `".$tablepre2."_".$table."`;", 2);
			}
			
			$i = 0;	
			$NlinesArray = array();
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
			
			foreach($tables as $table) {
				$tpl->joQuery("TRUNCATE `".$tablepre."_".$table."`;", 2);
			}
				
			foreach($mtables as $table) {
				$tpl->joQuery("TRUNCATE `".$tablepre2."_".$table."`;", 2);
			}
			
			foreach($linesArray2 as $line) {
				if(strstr($line, "INSERT")) {
					$tpl->joQuery("".$line."", 2);
				}
			}
			
			$tpl->joQuery("INSERT INTO $adminlogs_table 
						   VALUES('', 'misc', 'Backup Restore', 'Success', '".$joName."', '".$_SERVER['REMOTE_ADDR']."', 
						   '".date("Y-m-d H:i:s")."')", 2);
			
			$varArray["msg"] = "Backup restored successfully!";

		}

		
	}
	
	$varArray["getFiles"] = "";
	$backupFiles = dir("./backups/");
	while(($backup = $backupFiles->read()) !== false) {
		if($backup != "." && $backup != ".." && $backup != "index.php") {
			$displayString = GetJoDisplayDate($backup);
			$varArray["getFiles"] .= '<option value="'.$backup.'">'.$displayString.'</option>';
		}
	}

	$varArray["formAction"] = "./admin.php?section=restore";
	
	$varArray["content"] = $tpl->buildMgtTpl($varArray, $sqlArray, 0, $file, $sub);

}