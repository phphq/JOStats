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
// Website       : http://www.messiahgamingtools.com         //
// Support       : http://www.babstats.com                   //
//                                                           //
// File Name     : Main Admin Index File                     //
// File Version  : 1.0.3 Standalone                          //
//                                                           //
/////////////////////////////////////////////////////////////*/

/*/////////////////////////////////////////////////////////////
//                                                           //
// Updated Dec 2016 By Novahq.net <scott@novahq.net>         //
// Standalone, PHP 5.6+ Compatible                           //
//                                                           //
/////////////////////////////////////////////////////////////*/
session_start();

include "config.php";
include "functions.php";
include "common.php";
include "weapons.php";
include "vehicles.php";
include "gametypes.php";
include "mgtClass.php";

$varArray = array();
$sqlArray = !empty($sqlArray) ? $sqlArray : array();
$msg = !empty($_GET['msg']) ? intval($_GET['msg']) : 0;
$section = !empty($_GET['section']) ? aGlod3($_GET['section']) : 'welcome';

if(!empty($_POST['Login'])) {

	$tempName = (!empty($_POST['adminName']) ? $_POST['adminName'] : "");
	$tempPass = (!empty($_POST['adminPass']) ? sha1($joSalt.$_POST['adminPass'].$joSalt) : "");

	if($tempName == $joName && $tempPass == $joPass) {

		$_SESSION['Token']=$joPass;
		header("location: ./admin.php");
		exit;

	} else {

		header("location: ./admin.php?msg=1");
		exit;

	}

}

if($section=="logout") {

	if(!empty($_SESSION['Token'])) {
		$_SESSION['Token']="";
	}
	
	header("location: ./admin.php?msg=2");
	exit;

}

MakeTableNames();

$tpl = new mgtTemplate();

if(!$tpl->getMgtTpl("tpls/admin/admin_main.tpl")) exit($tpl->joErrorRet(1, "tpls/admin/admin_main.tpl"));

if(!empty($_SESSION['Token']) && $_SESSION['Token']==$joPass) {

	if($section == "server") {
		require_once "./restrictions.php";
	}

	if(file_exists("./mods/admin/$section.php")) {

	    include "./mods/admin/$section.php";

	} else {

	    $varArray["content"] = $tpl->joErrorRet(1, "$section");    
	}

} else {

	include "./mods/admin/login.php";

}

$varArray["jsStyle"]   = GetJoStyle("admin");

echo $tpl->buildMgtTpl($varArray, $sqlArray, 0, "tpls/admin/admin_main.tpl", "");