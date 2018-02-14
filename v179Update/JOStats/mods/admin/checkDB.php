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

$file = "./tpls/admin/admin_checkDB.tpl";

if(!$tpl->getMgtTpl($file)) {

	$varArray["content"] = $tpl->joErrorRet(1, $section." template");	

} else {

	$sub = "main";
	$tables = array("adminlogs", "awards", "last", "log", "maps", "mapstats", "monthawards", "monthly", "playerawards", 
                    "players", "ranks", "rating", "records", "squads", "servers", "serverhistory", "serverstats", 
				    "settings", "stats", "style", "weapons", "weaponstats", "vehicles", "vehiclestats");
  	$mtables = array("mapstats", "stats", "weaponstats", "vehiclestats");

	$tableList = "";
	$varArray["result"] = "";
	
	foreach($tables as $table) {
		if($table == "adminlogs")  {
			$tableList .= "`".$tablepre."_".$table."`";
		} else {
			$tableList .= " , `".$tablepre."_".$table."`";
		}
	}
		
	foreach($mtables as $table) {
		$tableList .= " , `".$tablepre2."_".$table."`";
	}
	
	if(!empty($_POST["check"])) {
		$sql = $tpl->joQuery("CHECK TABLE ".$tableList."", 1);
		while($row = mysqli_fetch_assoc($sql)) {
			$varArray["result"] .= "<tr>
									  <td>".$row["Table"]."</td>
									  <td>".$row["Msg_text"]."</td>
								  </tr>";
		}

		$sub = "check";
	} elseif(!empty($_POST["analyze"])) {
		$sql = $tpl->joQuery("ANALYZE TABLE ".$tableList."", 1);
		while($row = mysqli_fetch_assoc($sql)) {
			$varArray["result"] .= "<tr>
									  <td>".$row["Table"]."</td>
									  <td>".$row["Msg_text"]."</td>
								  </tr>";
		}

		$sub = "analyze";
	} elseif(!empty($_POST["optimize"])) {
		$sql = $tpl->joQuery("OPTIMIZE TABLE ".$tableList."", 1);
		while($row = mysqli_fetch_assoc($sql)) {
			$varArray["result"] .= "<tr>
									  <td>".$row["Table"]."</td>
									  <td>".$row["Msg_text"]."</td>
								  </tr>";
		}

		$sub = "optimize";
	} elseif(!empty($_POST["repair"])) {
		$sql = $tpl->joQuery("REPAIR TABLE ".$tableList."", 1);
		while($row = mysqli_fetch_assoc($sql)) {
			$varArray["result"] .= "<tr>
									  <td>".$row["Table"]."</td>
									  <td>".$row["Msg_text"]."</td>
								  </tr>";
		}

		$sub = "repair";
	}
	
	$varArray["formAction"] = "./admin.php?section=checkDB";

	$varArray["content"] = $tpl->buildMgtTpl($varArray, $sqlArray, 0, $file, $sub);
}