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
// File Name     : Update Procedure                          //
// File Version  : 1.0.6 Standalone                          //
//                                                           //
/////////////////////////////////////////////////////////////*/

/*/////////////////////////////////////////////////////////////
//                                                           //
// Updated Dec 2016 By Novahq.net <scott@novahq.net>         //
// Standalone, PHP 5.6+ Compatible                           //
//                                                           //
/////////////////////////////////////////////////////////////*/

error_reporting(0);

require_once "mgtClass.php";
require_once "config.php";
require_once "functions.php";
require_once "common.php";
require_once "weapons.php";
require_once "vehicles.php";
require_once "gametypes.php";
	
MakeTableNames();
	
$tpl = new mgtTemplate();

$sid = (!empty($_GET['serverid']) ? $_GET['serverid'] : "");
	
if($sid <> "") {

	$sql = $tpl->joQuery("SELECT * FROM $servers_table WHERE serverid = '".$tpl->joEscape($sid)."'", 1);
	$row = mysqli_fetch_array($sql);
	if(empty($row["id"])) { exit("0"); } else { exit("1"); }
}

$data = empty($_POST['data']) ? exit("Status Update Failed, No Data Sent!") : $_POST['data'];

$data = base64_decode($data);

if(!$data) {

	echo "Status Update Failed, No Data Sent!";

} else {

	$dataLines  = explode("\n", $data);
	if(empty($dataLines)) exit("Status Update Failed, No Data Sent!");

	$server     = explode("__&__", $dataLines[0]);
	$serverId   = trim($server[0]);
	$serDate    = date("Y-m-d H:i:s");
	$serverInfo = trim($dataLines[1]);
	$serverRest = trim($dataLines[2]);
	$players    = trim($dataLines[3]);
	$roles      = trim($dataLines[4]);
	@$teams     = trim($dataLines[5]);
	@$weapons   = trim($dataLines[6]);

	$infoArray  = explode("__&__", $serverInfo);

	$serGname   = $infoArray[0];
	$serMname   = $infoArray[1];
	$serMess    = $infoArray[2];
	$serGtype   = $gametypes[1][$infoArray[3]];
	$serDed     = $infoArray[4];
	$serTime    = $infoArray[5];
	$serMin     = $infoArray[6];
	$serMax     = $infoArray[7];
	$serState   = $infoArray[8];
	$serMod     = $infoArray[9];
	$serGame    = $infoArray[10];
	
	$serInfo    = $infoArray[11]."_".$infoArray[12]."_".$infoArray[13]."_".$infoArray[14]."_".$infoArray[15]."_".
	              $infoArray[16]."_".$infoArray[17]."_".$infoArray[18]."_".$infoArray[19];
	
	$countArray = explode("_", $players);
	$serNum = count($countArray);

	$sql = $tpl->joQuery("SELECT * FROM $servers_table WHERE serverid = '".$tpl->joEscape($serverId)."'", 1);
	$row = mysqli_fetch_array($sql);
	if(empty($row["id"])) exit("Status Update Failed, Invalid Server ID!");
	
	$tpl->joQuery("UPDATE $servers_table SET
				       server_name    = '".$tpl->joEscape($serGname)."'   ,
					   map_name       = '".$tpl->joEscape($serMname)."'   ,
					   game_type      = '".$tpl->joEscape($serGtype)."'   ,
					   game           = '".$tpl->joEscape($serGame)."'    ,
					   game_mod       = '".$tpl->joEscape($serMod)."'     ,
					   dedicated      = '".$tpl->joEscape($serDed)."'     ,
					   time           = '".$tpl->joEscape($serTime)."'    ,
					   player_names   = '".$tpl->joEscape($players)."'    ,
					   player_teams   = '".$tpl->joEscape($teams)."'      ,
					   player_weapons = '".$tpl->joEscape($weapons)."'    ,
					   info           = '".$tpl->joEscape($serMess)."'    ,
					   rules          = '".$tpl->joEscape($serInfo)."'    ,
					   restrictions   = '".$tpl->joEscape($serverRest)."' ,
					   max_players    = '".$tpl->joEscape($serMax)."'     ,
					   num_players    = '".$tpl->joEscape($serMin)."'     ,
					   state          = '".$tpl->joEscape($serState)."'   ,
					   lastUpdate     = '".$tpl->joEscape($serDate)."'
				   WHERE serverid   = '".$tpl->joEscape($serverId)."'", 1);

	echo "Status updated successfully";
}