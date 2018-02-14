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

$file = "./tpls/admin/admin_log.tpl";

if(!$tpl->getMgtTpl($file)) {

	$varArray["content"] = $tpl->joErrorRet(1, $section." template");	
	
} else {

	$sub = (!empty($sub) ? $sub : "main");
	$logSel = (!empty($_POST['logSel']) ? cMioD4($_POST['logSel']) : "main");
	$selected = 'selected="selected"';

	$varArray["logList"] = '<option value="main" '.($logSel=="main" ? $selected : "").'>Main</option>
	                        <option value="players" '.($logSel=="players" ? $selected : "").'>Players</option>
							<option value="maps" '.($logSel=="maps" ? $selected : "").'>Maps</option>
							<option value="squads" '.($logSel=="squads" ? $selected : "").'>Squads</option>
							<option value="servers" '.($logSel=="servers" ? $selected : "").'>Servers</option>
							<option value="awards" '.($logSel=="awards" ? $selected : "").'>Awards</option>
							<option value="ranks" '.($logSel=="ranks" ? $selected : "").'>Ranks</option>
							<option value="rating" '.($logSel=="rating" ? $selected : "").'>Rating</option>
							<option value="style" '.($logSel=="style" ? $selected : "").'>Style</option>
							<option value="misc" '.($logSel=="misc" ? $selected : "").'>Misc</option>';
	
	if($logSel == "main") {
		$varArray["main"] = "<u><b>Last 10 actions performed</b></u><br /><br/>";
		$sqlArray[0]["query"]      = "SELECT * ";
		$sqlArray[0]["tables"]     = " $adminlogs_table ";
		$sqlArray[0]["conditions"] = " ORDER BY date DESC limit 10 ";
		$sqlArray[0]["type"]       = "multi";
		$sqlArray[0]["prefix"]     = "list";
	} else {
		$varArray["main"] = "";
		$sqlArray[0]["query"]      = "SELECT * ";
		$sqlArray[0]["tables"]     = " $adminlogs_table ";
		$sqlArray[0]["conditions"] = " WHERE section = '".$logSel."' ";
		$sqlArray[0]["type"]       = "multi";
		$sqlArray[0]["prefix"]     = "list";
	}

	
	$varArray["formAction"] = "./admin.php?section=log";
	
	$varArray["content"] = $tpl->buildMgtTpl($varArray, $sqlArray, 1, $file, $sub);

}