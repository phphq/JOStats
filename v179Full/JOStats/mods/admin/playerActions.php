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

$pid = (!empty($_POST['pid']) ? intval($_POST['pid']) : 0);

if(!empty($_POST['find_player'])) {

	$findName = (!empty($_POST['findName']) ? $_POST['findName'] : "");

	header("location: ./admin.php?section=players&findName=".urlencode($findName));
	exit;

} elseif(!empty($_POST['select_player'])) {

	header("location: ./admin.php?section=players&pid=".$pid);
	exit;

} elseif(!empty($_POST["change_name"])) {

	$plyrName = (!empty($_POST['plyrName']) ? $_POST['plyrName'] : "");

	if(!$plyrName) {
		header("location: ./admin.php?section=players&pid=".$pid."&msg=5");
		exit;
	}

	$tpl->joQuery("UPDATE $players_table SET name = '".$tpl->joEscape($plyrName)."' WHERE id = '".$pid."'", 2);
	
	$tpl->joQuery("INSERT INTO $adminlogs_table VALUES('', 'players', 'Changed Player Name_".$pid."', 'Success', '".$joName."', 
	                                                   '".$_SERVER['REMOTE_ADDR']."', '".date("Y-m-d H:i:s")."')", 2);

	header("location: ./admin.php?section=players&pid=".$pid."&msg=1");
	exit;

} elseif(!empty($_POST["change_squad"])) {


	$plySquad = (!empty($_POST['plySquad']) ? $_POST['plySquad'] : "");

	$tpl->joQuery("UPDATE $players_table SET squad = '".$tpl->joEscape($plySquad)."' WHERE id = '".$pid."'", 2);
	
	$tpl->joQuery("INSERT INTO $adminlogs_table VALUES('', 'players', 'Changed Player Squad_".$pid."', 'Success', '".$joName."', 
	                                                   '".$_SERVER['REMOTE_ADDR']."', '".date("Y-m-d H:i:s")."')", 2);
	
	header("location: ./admin.php?section=players&pid=".$pid."&msg=2");
	exit;

} elseif(!empty($_POST["delete_player"])) {

	$nSql = $tpl->joQuery("SELECT * FROM $players_table WHERE id = '".$pid."'", 1);
	$nRow = mysqli_fetch_assoc($nSql);
	$name = $nRow["name"];
	$sql = $tpl->joQuery("SELECT * FROM $stats_table WHERE player = '".$pid."'", 1);
	while($row = mysqli_fetch_assoc($sql)) {
		$tpl->joQuery("DELETE FROM $mapstats_table WHERE record = '".$row["id"]."'", 2);
		$tpl->joQuery("DELETE FROM $mapstats_m_table WHERE record = '".$row["id"]."'", 2);
		$tpl->joQuery("DELETE FROM $weaponstats_table WHERE record = '".$row["id"]."'", 2);
		$tpl->joQuery("DELETE FROM $weaponstats_m_table WHERE record = '".$row["id"]."'", 2);
		$tpl->joQuery("DELETE FROM $vehiclestats_table WHERE record = '".$row["id"]."'", 2);
		$tpl->joQuery("DELETE FROM $vehiclestats_m_table WHERE record = '".$row["id"]."'", 2);
	}
	$tpl->joQuery("DELETE FROM $stats_table WHERE player = '".$pid."'", 2);
	$tpl->joQuery("DELETE FROM $stats_m_table WHERE player = '".$pid."'", 2);
	$tpl->joQuery("DELETE FROM $playerawards_table WHERE player = '".$pid."'", 2);
	$tpl->joQuery("DELETE FROM $last_table WHERE player = '".$pid."'", 2);
	$tpl->joQuery("DELETE FROM $players_table WHERE id = '".$pid."'", 2);
	
	$tpl->joQuery("INSERT INTO $adminlogs_table VALUES('', 'players', 'Deleted Player_".$tpl->joEscape($name)."', 'Success', '".$joName."', 
	                                                   '".$_SERVER['REMOTE_ADDR']."', '".date("Y-m-d H:i:s")."')", 2);
	
	header("location: ./admin.php?section=players&msg=4");
	exit;

} elseif(!empty($_POST["reset_plyr_stats"])) {

	$sql = $tpl->joQuery("SELECT * FROM $stats_table WHERE player = '".$pid."'", 1);
	while($row = mysqli_fetch_assoc($sql)) {
		$tpl->joQuery("DELETE FROM $mapstats_table WHERE record = '".$row["id"]."'", 2);
		$tpl->joQuery("DELETE FROM $mapstats_m_table WHERE record = '".$row["id"]."'", 2);
		$tpl->joQuery("DELETE FROM $weaponstats_table WHERE record = '".$row["id"]."'", 2);
		$tpl->joQuery("DELETE FROM $weaponstats_m_table WHERE record = '".$row["id"]."'", 2);
		$tpl->joQuery("DELETE FROM $vehiclestats_table WHERE record = '".$row["id"]."'", 2);
		$tpl->joQuery("DELETE FROM $vehiclestats_m_table WHERE record = '".$row["id"]."'", 2);
	}
	$tpl->joQuery("DELETE FROM $stats_table WHERE player = '".$pid."'", 2);
	$tpl->joQuery("DELETE FROM $stats_m_table WHERE player = '".$pid."'", 2);
	$tpl->joQuery("DELETE FROM $playerawards_table WHERE player = '".$pid."'", 2);
	$tpl->joQuery("DELETE FROM $last_table WHERE player = '".$pid."'", 2);
	$tpl->joQuery("UPDATE $players_table SET 
	                   rating = 0, m_rating = 0, awards = 0,
				       wpn_awards    = 0, veh_awards   = 0, motm    = 0 
				   WHERE id = '".$pid."'", 2);
	
	$tpl->joQuery("INSERT INTO $adminlogs_table VALUES('', 'players', 'Reset Player Stats_".$pid."', 'Success', '".$joName."', 
	                                                   '".$_SERVER['REMOTE_ADDR']."', '".date("Y-m-d H:i:s")."')", 2);
	
	header("location: ./admin.php?section=players&pid=".$pid."&msg=3");
	exit;
}


header("location: ./admin.php?section=players");
