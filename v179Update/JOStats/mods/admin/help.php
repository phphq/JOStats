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

$file = "./tpls/admin/admin_help.tpl";

if(!$tpl->getMgtTpl($file)) {

	$varArray["content"] = $tpl->joErrorRet(1, $section." template");	
	
} else {

	$sub = (!empty($sub) ? $sub : "main");
	$helpSel = (!empty($_POST['helpSel']) ? cMioD4($_POST['helpSel']) : "main");
	$selected = 'selected="selected"';

	$varArray["helpList"] = '<option value="main" '.($helpSel=="main" ? $selected : "").'>Main</option>
	    <option value="players" '.($helpSel=="players" ? $selected : "").'>Players</option>
		<option value="maps" '.($helpSel=="maps" ? $selected : "").'>Maps</option>
		<option value="squads" '.($helpSel=="squads" ? $selected : "").'>Squads</option>
		<option value="servers" '.($helpSel=="servers" ? $selected : "").'>Servers</option>
		<option value="awards" '.($helpSel=="awards" ? $selected : "").'>Awards</option>
		<option value="ranks" '.($helpSel=="ranks" ? $selected : "").'>Ranks</option>
		<option value="rating" '.($helpSel=="rating" ? $selected : "").'>Rating System</option>
		<option value="misc" '.($helpSel=="misc" ? $selected : "").'>Misc</option>
		<option value="logs" '.($helpSel=="logs" ? $selected : "").'>Logs</option>
		<option value="config" '.($helpSel=="config" ? $selected : "").'>Config</option>';

	
	$varArray["Menu"] = strtoupper($helpSel);
	
	$varArray["formAction"] = "./admin.php?section=help";
	
	$varArray["content"] = $tpl->buildMgtTpl($varArray, $sqlArray, 0, $file, $helpSel);

}