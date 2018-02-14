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

function formatRow($id, $id2, $table) {
    global $tpl;
    $query = $tpl->joQuery("select * from $table WHERE $id = '$id2'", 1);
    $num_fields = @mysqli_num_fields($query);

    $row = @mysqli_fetch_row($query);
    $string = "  INSERT INTO $table VALUES(";
    for($i = 0; $i < $num_fields; $i++) {
        if($i < ($num_fields-1)) {
	  	    $string .= '"'.addslashes($row[$i]).'", ';
		} else {
	  	    $string .= '"'.addslashes($row[$i]).'"';
    	}
  	}
  	$string .= ");".chr(13).chr(10);
  	return $string;
}

if(!empty($_POST['update_config'])) {

	$plyrShow = (!empty($_POST['plyrShow']) ? intval($_POST['plyrShow']) : 50);
	$wpnShow = (!empty($_POST['wpnShow']) ? intval($_POST['wpnShow']) : 25);
	$vehShow = (!empty($_POST['vehShow']) ? intval($_POST['vehShow']) : 25);
	$mapShow = (!empty($_POST['mapShow']) ? intval($_POST['mapShow']) : 25);
	$squadShow = (!empty($_POST['squadShow']) ? intval($_POST['squadShow']) : 25);

	$tpl->joQuery("DELETE FROM $settings_table", 2);
	$tpl->joQuery("INSERT INTO $settings_table VALUES ('', 'plyrsPerPage', '".$plyrShow."')", 2);
	$tpl->joQuery("INSERT INTO $settings_table VALUES ('', 'wpnsPerPage', '".$wpnShow."')", 2);
	$tpl->joQuery("INSERT INTO $settings_table VALUES ('', 'vehsPerPage', '".$vehShow."')", 2);
	$tpl->joQuery("INSERT INTO $settings_table VALUES ('', 'mapsPerPage', '".$mapShow."')", 2);
	$tpl->joQuery("INSERT INTO $settings_table VALUES ('', 'squadsPerPage', '".$squadShow."')", 2);

	$tpl->joQuery("INSERT INTO $adminlogs_table 
				   VALUES('', 'misc', 'Update Config', 'Success', '".$joName."', '".$_SERVER['REMOTE_ADDR']."', 
				   '".date("Y-m-d H:i:s")."')", 2);

	header("location: ./admin.php?section=misc&msg=1");
	exit;

} elseif(!empty($_POST["reset_no"])) {

	$tpl->joQuery("INSERT INTO $adminlogs_table 
	               VALUES('', 'misc', 'Reset joStats', 'Cancelled', '".$joName."', '".$_SERVER['REMOTE_ADDR']."', 
				   '".date("Y-m-d H:i:s")."')", 2);

	header("location: ./admin.php?section=misc");
	exit;

} elseif(!empty($_POST["reset_yes"])) {
		
	$tables = array("awards", "hof", "last", "log", "maps", "mapstats", "monthawards", "monthly", "playerawards", 
                    "players", "ranks", "rating", "records", "squads", "servers", "serverhistory", "serverstats", 
				    "settings", "stats", "style", "weapons", "weaponstats", "vehicles", "vehiclestats");
	$mtables = array("mapstats", "stats", "weaponstats", "vehiclestats");
		
	$tableList = "";
	foreach($tables as $table) {
		if($table == "awards")  {
			$tableList .= "`".$tablepre."_".$table."`";
		} else {
			$tableList .= " , `".$tablepre."_".$table."`";
		}
	}
			
	foreach($mtables as $table) {
		$tableList .= " , `".$tablepre2."_".$table."`";
	}
		
	$newArray = array();
	$linesArray = file("./reset.sql");
		
	$tpl->joQuery("DROP TABLE ".$tableList."", 2);
		
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
	
	$month = date("n") - 1;
	$tpl->joQuery("UPDATE $monthly_table SET status = '1' WHERE month = '".$month."' AND year = '".date("Y")."'", 2);
	
	$tpl->joQuery("INSERT INTO $adminlogs_table 
	               VALUES('', 'misc', 'Reset joStats', 'Success', '".$joName."', '".$_SERVER['REMOTE_ADDR']."', 
				   '".date("Y-m-d H:i:s")."')", 2);
				   
	header("location: ./admin.php?section=misc&msg=5");
	exit;

} elseif(!empty($_POST["delete_no"])) {
	$tpl->joQuery("INSERT INTO $adminlogs_table 
	               VALUES('', 'misc', 'Delete joStats database', 'Cancelled', '".$joName."', '".$_SERVER['REMOTE_ADDR']."', 
				   '".date("Y-m-d H:i:s")."')", 2);


	header("location: ./admin.php?section=misc");
	exit;

} elseif(!empty($_POST["delete_yes"])) {
	$tables = array("awards", "last", "log", "maps", "mapstats", "monthawards", "monthly", "playerawards", 
                    "players", "ranks", "rating", "records", "squads", "servers", "serverhistory", "serverstats", 
				    "settings", "stats", "style", "weapons", "weaponstats", "vehicles", "vehiclestats");
  	$mtables = array("mapstats", "stats", "weaponstats", "vehiclestats");
	
	$tableList = "";
	foreach($tables as $table) {
		if($table == "awards")  {
			$tableList .= "`".$tablepre."_".$table."`";
		} else {
			$tableList .= " , `".$tablepre."_".$table."`";
		}
	}
		
	foreach($mtables as $table) {
		$tableList .= " , `".$tablepre2."_".$table."`";
	}
	
	$sql = $tpl->joQuery("DROP TABLE ".$tableList."", 1);
							
	$tpl->joQuery("INSERT INTO $adminlogs_table 
	               VALUES('', 'misc', 'Delete joStats database', 'Success', '".$joName."', '".$_SERVER['REMOTE_ADDR']."', 
				   '".date("Y-m-d H:i:s")."')", 2);

	header("location: ./");
	exit;

} elseif(!empty($_POST["backup_db"])) {

  joWriteable("./backups/");

  $file_name = "Backup_".date("Y-m-d_H.i.s").".sql";
  $ver   = phpversion();

  $sql = $tpl->joQuery("SELECT DATABASE()", 1) or die(mysql_error());;
  $row = mysqli_fetch_array($sql);
  $dbName = $row[0];
  
  
  $backup = fopen("./backups/".$file_name, "w", false); 
  $string = "  -- joStats SQL Dump".chr(13)."
  -- version 1.0.0".chr(13)."
  --".chr(13)."
  -- Host: localhost".chr(13)."
  -- Generation Time: ".date("Y-m-d-H.i.s")."".chr(13)."
  -- PHP Version: ".$ver."".chr(13)."
  --".chr(13)."
  -- Database: `".$dbName."`".chr(13)."
  --".chr(13).chr(10);

  
  $array = array( 
	"id_&_".$awards_table         ,  
	"id_&_".$last_table           , 
	"id_&_".$log_table            , 
	"id_&_".$mapstats_m_table     , 
	"id_&_".$stats_m_table        , 
	"id_&_".$vehiclestats_m_table , 
	"id_&_".$weaponstats_m_table  , 
    "id_&_".$maps_table           , 
	"id_&_".$mapstats_table       , 
	"id_&_".$monthawards_table    , 
	"id_&_".$monthly_table        ,
	"id_&_".$playerawards_table   , 
	"id_&_".$players_table        , 
	"id_&_".$ranks_table          , 
	"s_id_&_".$rating_table       , 
	"id_&_".$records_table        , 
	"id_&_".$serverhistory_table  , 
	"id_&_".$servers_table        , 
	"id_&_".$serverstats_table    , 
	"id_&_".$settings_table       , 
	"id_&_".$squads_table         , 
	"id_&_".$stats_table          , 
	"id_&_".$style_table          , 
	"id_&_".$vehicles_table       , 
	"id_&_".$vehiclestats_table   , 
	"id_&_".$weapons_table        , 
	"id_&_".$weaponstats_table   
  );

  foreach($array as $value) {
	$split = explode("_&_", $value);
	$id = $split[0];
	$table = $split[1];
	$string .= chr(13)."
	--".chr(13)."
	-- Dumping data for table `$table`".chr(13)."
	--".chr(13).chr(10).chr(13).chr(10);

	$row_id = array();
	$query = $tpl->joQuery("SELECT * from $table", 1);

	while($row = mysqli_fetch_assoc($query)) {

	  $row_id[] = $row[$id];

	}

	if(!empty($row_id)) {

		foreach($row_id as $id2) {

		  $string .= formatRow($id, $id2, $table);

		}

	} else {

		$string .= chr(13).chr(10);

	}
  }

  $string .= chr(13).chr(10);

  @fwrite($backup, $string);
  
  if(file_exists("./backups/".$file_name)) {

	$tpl->joQuery("INSERT INTO $adminlogs_table 
	               VALUES('', 'misc', 'Backup Database', 'Success', '".$joName."', '".$_SERVER['REMOTE_ADDR']."', 
				   '".date("Y-m-d H:i:s")."')", 2);
	
		header("location: ./admin.php?section=misc&msg=2");
		exit;

  } else {

	$tpl->joQuery("INSERT INTO $adminlogs_table 
	               VALUES('', 'misc', 'Backup Database', 'Failed', '".$joName."', '".$_SERVER['REMOTE_ADDR']."', 
				   '".date("Y-m-d H:i:s")."')", 2);

	header("location: ./admin.php?section=misc&msg=3");
	exit;
  }
}

if(!empty($_POST["reset_monthly"])) {
	global $players_table, $stats_m_table, $mapstats_m_table, $weaponstats_m_table, $vehiclestats_m_table, 
	       $monthawards_table, $monthly_table, $tpl;
	
	$useDate = (!empty($_POST['radiobutton']) ? cMioD4($_POST['radiobutton']) : false );

	$check = $tpl->joQuery("SELECT * FROM $stats_m_table WHERE SUBSTRING(last_played, 1, 7) = '$useDate' ", 1);
	$chkRows = @mysqli_num_rows($check);

	if(!$chkRows || !$useDate){
		header("location: ./admin.php?section=misc&msg=7");
		exit;
	}
	
	$sql = $tpl->joQuery("SELECT SUM(totaltime) as totalTime FROM $stats_m_table 
						  WHERE SUBSTRING(last_played, 1, 7) = '$useDate' 
	                      GROUP BY player ORDER BY totalTime DESC LIMIT 1", 1);
	$row = mysqli_fetch_assoc($sql);
	$qualTime = floor($row["totalTime"]/4);
	$motm = array();
	
	$fdate = explode("-", $useDate);
	$first_day_of_month = strtotime("-" . (date("d", $date)-1) . " days", $date);
	$date = $useDate."-".date("d", strtotime("+" . (date("t", $first_day_of_month)-1) . " days", $first_day_of_month));

	$fmonth = date("M");
	
	/*Highest Rating*/
	
	$sql = $tpl->joQuery("SELECT $players_table.name AS name, SUM($players_table.m_rating) as rating ,
						  SUM($stats_m_table.totalTime) AS qualTime 
	                      FROM $players_table, $stats_m_table WHERE $stats_m_table.player = $players_table.id 
					      AND SUBSTRING($stats_m_table.last_played, 1, 7) = '$useDate' 
						  GROUP BY $stats_m_table.player 
						  HAVING qualTime >= '".$qualTime."' ORDER BY rating DESC LIMIT 1", 1);
	$row = mysqli_fetch_assoc($sql);
	$tpl->joQuery("INSERT INTO $monthawards_table VALUES('', 'Highest Rating', '".$row["name"]."', '".$row["rating"]."', 
	                                                     '".$fmonth."', '".date("Y")."', '".$date."')", 2);
	if(array_key_exists($row["name"], $motm)) {
		$motm[$row["name"]] = $motm[$row["name"]] + 1;
	} else {
		$motm[$row["name"]] = 1;
	}
	$sql = $tpl->joQuery("SELECT * FROM $monthawards_table WHERE id = '1'", 1);
	$row2 = mysqli_fetch_assoc($sql);
	if($row["rating"] > $row2["value"]) {
		$tpl->joQuery("UPDATE $monthawards_table SET player = '".$row["name"]."', value = '".$row["rating"]."', 
		                                   date = '".$date."' WHERE id = '1'", 2);
	}
	
	/*Highest Rating*/
	
	/*Highest No. of Kills*/
	
	$sql = $tpl->joQuery("SELECT $players_table.name AS name, SUM($stats_m_table.kills) as kills ,
						  SUM($stats_m_table.totalTime) AS qualTime 
	                      FROM $players_table, $stats_m_table WHERE $stats_m_table.player = $players_table.id 
					      AND SUBSTRING($stats_m_table.last_played, 1, 7) = '$useDate' 
						  GROUP BY $stats_m_table.player 
						  HAVING qualTime >= '".$qualTime."' ORDER BY kills DESC LIMIT 1", 1);
	$row = mysqli_fetch_assoc($sql);
	$tpl->joQuery("INSERT INTO $monthawards_table VALUES('', 'Highest No. of Kills', '".$row["name"]."', '".$row["kills"]."', 
	                                                     '".$fmonth."', '".date("Y")."', '".$date."')", 2);
	if(array_key_exists($row["name"], $motm)) {
		$motm[$row["name"]] = $motm[$row["name"]] + 1;
	} else {
		$motm[$row["name"]] = 1;
	}
	$sql = $tpl->joQuery("SELECT * FROM $monthawards_table WHERE id = '2'", 1);
	$row2 = mysqli_fetch_assoc($sql);
	if($row["kills"] > $row2["value"]) {
		$tpl->joQuery("UPDATE $monthawards_table SET player = '".$row["name"]."', value = '".$row["kills"]."', 
		                                   date = '".$date."' WHERE id = '2'", 2);
	}
	
	/*Highest No. of Kills*/
	
	/*Highest No. of Assists*/
	
	$sql = $tpl->joQuery("SELECT $players_table.name AS name, SUM($stats_m_table.assists) as assists ,
						  SUM($stats_m_table.totalTime) AS qualTime 
	                      FROM $players_table, $stats_m_table WHERE $stats_m_table.player = $players_table.id 
					      AND SUBSTRING($stats_m_table.last_played, 1, 7) = '$useDate' 
						  GROUP BY $stats_m_table.player 
						  HAVING qualTime >= '".$qualTime."' ORDER BY assists DESC LIMIT 1", 1);
	$row = mysqli_fetch_assoc($sql);
	$tpl->joQuery("INSERT INTO $monthawards_table VALUES('', 'Highest No. of Assists', '".$row["name"]."', 
	                                              '".$row["assists"]."', '".$fmonth."', '".date("Y")."', '".$date."')", 2);
	if(array_key_exists($row["name"], $motm)) {
		$motm[$row["name"]] = $motm[$row["name"]] + 1;
	} else {
		$motm[$row["name"]] = 1;
	}
	$sql = $tpl->joQuery("SELECT * FROM $monthawards_table WHERE id = '3'", 1);
	$row2 = mysqli_fetch_assoc($sql);
	if($row["assists"] > $row2["value"]) {
		$tpl->joQuery("UPDATE $monthawards_table SET player = '".$row["name"]."', value = '".$row["assists"]."', 
		                                   date = '".$date."' WHERE id = '3'", 2);
	}
	
	/*Highest No. of Assists*/
	
	/*Highest No. of Headshots*/
	
	$sql = $tpl->joQuery("SELECT $players_table.name AS name, SUM($stats_m_table.headshots) as headshots ,
						  SUM($stats_m_table.totalTime) AS qualTime 
	                      FROM $players_table, $stats_m_table WHERE $stats_m_table.player = $players_table.id 
					      AND SUBSTRING($stats_m_table.last_played, 1, 7) = '$useDate' 
						  GROUP BY $stats_m_table.player 
						  HAVING qualTime >= '".$qualTime."' ORDER BY headshots DESC LIMIT 1", 1);
	$row = mysqli_fetch_assoc($sql);
	$tpl->joQuery("INSERT INTO $monthawards_table VALUES('', 'Highest No. of Headshots', '".$row["name"]."', 
	                                              '".$row["headshots"]."', '".$fmonth."', '".date("Y")."', '".$date."')", 2);
	if(array_key_exists($row["name"], $motm)) {
		$motm[$row["name"]] = $motm[$row["name"]] + 1;
	} else {
		$motm[$row["name"]] = 1;
	}
	$sql = $tpl->joQuery("SELECT * FROM $monthawards_table WHERE id = '4'", 1);
	$row2 = mysqli_fetch_assoc($sql);
	if($row["headshots"] > $row2["value"]) {
		$tpl->joQuery("UPDATE $monthawards_table SET player = '".$row["name"]."', value = '".$row["headshots"]."', 
		                                   date = '".$date."' WHERE id = '4'", 2);
	}
	
	/*Highest No. of Headshots*/
	
	/*Highest No. of Knifings*/
	
	$sql = $tpl->joQuery("SELECT $players_table.name AS name, SUM($stats_m_table.knifings) as knifings ,
						  SUM($stats_m_table.totalTime) AS qualTime 
	                      FROM $players_table, $stats_m_table WHERE $stats_m_table.player = $players_table.id 
					      AND SUBSTRING($stats_m_table.last_played, 1, 7) = '$useDate' 
						  GROUP BY $stats_m_table.player 
						  HAVING qualTime >= '".$qualTime."' ORDER BY knifings DESC LIMIT 1", 1);
	$row = mysqli_fetch_assoc($sql);
	$tpl->joQuery("INSERT INTO $monthawards_table VALUES('', 'Highest No. of Knifings', '".$row["name"]."', 
	                                              '".$row["knifings"]."', '".$fmonth."', '".date("Y")."', '".$date."')", 2);
	if(array_key_exists($row["name"], $motm)) {
		$motm[$row["name"]] = $motm[$row["name"]] + 1;
	} else {
		$motm[$row["name"]] = 1;
	}
	$sql = $tpl->joQuery("SELECT * FROM $monthawards_table WHERE id = '5'", 1);
	$row2 = mysqli_fetch_assoc($sql);
	if($row["knifings"] > $row2["value"]) {
		$tpl->joQuery("UPDATE $monthawards_table SET player = '".$row["name"]."', value = '".$row["knifings"]."', 
		                                   date = '".$date."' WHERE id = '5'", 2);
	}
	
	/*Highest No. of Knifings*/
	
	/*Highest Kill/Death Ratio*/
	
	$sql = $tpl->joQuery("SELECT $players_table.name AS name, SUM($stats_m_table.kills)/IF(SUM($stats_m_table.deaths)=0, 1, 
			            SUM($stats_m_table.deaths)) AS ratio, SUM($stats_m_table.totalTime) AS qualTime 
	                    FROM $players_table, $stats_m_table WHERE $stats_m_table.player = $players_table.id 
					    AND SUBSTRING($stats_m_table.last_played, 1, 7) = '$useDate' 
						GROUP BY $stats_m_table.player 
						HAVING qualTime >= '".$qualTime."' ORDER BY ratio DESC LIMIT 1", 1);
	$row = mysqli_fetch_assoc($sql);
	$tpl->joQuery("INSERT INTO $monthawards_table VALUES('', 'Highest Kill/Death Ratio', '".$row["name"]."', 
	                                              '".$row["ratio"]."', '".$fmonth."', '".date("Y")."', '".$date."')", 2);
	if(array_key_exists($row["name"], $motm)) {
		$motm[$row["name"]] = $motm[$row["name"]] + 1;
	} else {
		$motm[$row["name"]] = 1;
	}
	$sql = $tpl->joQuery("SELECT * FROM $monthawards_table WHERE id = '6'", 1);
	$row2 = mysqli_fetch_assoc($sql);
	if($row["ratio"] > $row2["value"]) {
		$tpl->joQuery("UPDATE $monthawards_table SET player = '".$row["name"]."', value = '".$row["ratio"]."', 
		                                   date = '".$date."' WHERE id = '6'", 2);
	}
	
	/*Highest Kill/Death Ratio*/
	
	/*Most Time Played*/
	
	$sql = $tpl->joQuery("SELECT $players_table.name AS name, SUM($stats_m_table.totalTime) AS qualTime 
	                    FROM $players_table, $stats_m_table WHERE $stats_m_table.player = $players_table.id 
					    AND SUBSTRING($stats_m_table.last_played, 1, 7) = '$useDate' 
						GROUP BY $stats_m_table.player 
						HAVING qualTime >= '".$qualTime."' ORDER BY qualTime DESC LIMIT 1", 1);
	$row = mysqli_fetch_assoc($sql);
	$tpl->joQuery("INSERT INTO $monthawards_table VALUES('', 'Most Time Played', '".$row["name"]."', '".$row["qualTime"]."', 
	                                                     '".$fmonth."', '".date("Y")."', '".$date."')", 2);
	if(array_key_exists($row["name"], $motm)) {
		$motm[$row["name"]] = $motm[$row["name"]] + 1;
	} else {
		$motm[$row["name"]] = 1;
	}
	$sql = $tpl->joQuery("SELECT * FROM $monthawards_table WHERE id = '7'", 1);
	$row2 = mysqli_fetch_assoc($sql);
	if($row["qualTime"] > $row2["value"]) {
		$tpl->joQuery("UPDATE $monthawards_table SET player = '".$row["name"]."', value = '".$row["qualTime"]."', 
		                                   date = '".$date."' WHERE id = '7'", 2);
	}
	
	/*Most Time Played*/
	
	/*Most Games Played*/
	
	$sql = $tpl->joQuery("SELECT $players_table.name AS name, $stats_m_table.games AS games, 
						SUM($stats_m_table.totalTime) AS qualTime 
	                    FROM $players_table, $stats_m_table WHERE $stats_m_table.player = $players_table.id 
					    AND SUBSTRING($stats_m_table.last_played, 1, 7) = '$useDate' 
						GROUP BY $stats_m_table.player 
						HAVING qualTime >= '".$qualTime."' ORDER BY games DESC LIMIT 1", 1);
	$row = mysqli_fetch_assoc($sql);
	$tpl->joQuery("INSERT INTO $monthawards_table VALUES('', 'Most Games Played', '".$row["name"]."', '".$row["games"]."', 
	                                                     '".$fmonth."', '".date("Y")."', '".$date."')", 2);
	if(array_key_exists($row["name"], $motm)) {
		$motm[$row["name"]] = $motm[$row["name"]] + 1;
	} else {
		$motm[$row["name"]] = 1;
	}
	$sql = $tpl->joQuery("SELECT * FROM $monthawards_table WHERE id = '8'", 1);
	$row2 = mysqli_fetch_assoc($sql);
	if($row["games"] > $row2["value"]) {
		$tpl->joQuery("UPDATE $monthawards_table SET player = '".$row["name"]."', value = '".$row["games"]."', 
		                                   date = '".$date."' WHERE id = '8'", 2);
	}
	
	/*Most Games Played*/
	
	/*Most Games Won*/
	
	$sql = $tpl->joQuery("SELECT $players_table.name AS name, $stats_m_table.wins AS wins, 
						SUM($stats_m_table.totalTime) AS qualTime 
	                    FROM $players_table, $stats_m_table WHERE $stats_m_table.player = $players_table.id 
					    AND SUBSTRING($stats_m_table.last_played, 1, 7) = '$useDate' 
						GROUP BY $stats_m_table.player 
						HAVING qualTime >= '".$qualTime."' ORDER BY wins DESC LIMIT 1", 1);
	$row = mysqli_fetch_assoc($sql);
	$tpl->joQuery("INSERT INTO $monthawards_table VALUES('', 
	            'Most Games Won', '".$row["name"]."', '".$row["wins"]."', '".$fmonth."', '".date("Y")."', '".$date."')", 2);
	if(array_key_exists($row["name"], $motm)) {
		$motm[$row["name"]] = $motm[$row["name"]] + 1;
	} else {
		$motm[$row["name"]] = 1;
	}
	$sql = $tpl->joQuery("SELECT * FROM $monthawards_table WHERE id = '9'", 1);
	$row2 = mysqli_fetch_assoc($sql);
	if($row["wins"] > $row2["value"]) {
		$tpl->joQuery("UPDATE $monthawards_table SET player = '".$row["name"]."', value = '".$row["wins"]."', 
		                                   date = '".$date."' WHERE id = '9'", 2);
	}
	
	/*Most Games Won*/
	
	/*Highest Win %*/
	
	$sql = $tpl->joQuery("SELECT $players_table.name AS name, 
	                    SUM($stats_m_table.wins)/IF(SUM($stats_m_table.games)=0, 1, 
						SUM($stats_m_table.games))*100 AS winPer, 
						SUM($stats_m_table.totalTime) AS qualTime 
	                    FROM $players_table, $stats_m_table WHERE $stats_m_table.player = $players_table.id 
					    AND SUBSTRING($stats_m_table.last_played, 1, 7) = '$useDate' 
						GROUP BY $stats_m_table.player 
						HAVING qualTime >= '".$qualTime."' ORDER BY winPer DESC LIMIT 1", 1);
	$row = mysqli_fetch_assoc($sql);
	$tpl->joQuery("INSERT INTO $monthawards_table VALUES('', 'Highest Win %', '".$row["name"]."', '".$row["winPer"]."', 
	                                                     '".$fmonth."', '".date("Y")."', '".$date."')", 2);
	if(array_key_exists($row["name"], $motm)) {
		$motm[$row["name"]] = $motm[$row["name"]] + 1;
	} else {
		$motm[$row["name"]] = 1;
	}
	$sql = $tpl->joQuery("SELECT * FROM $monthawards_table WHERE id = '10'", 1);
	$row2 = mysqli_fetch_assoc($sql);
	if($row["winPer"] > $row2["value"]) {
		$tpl->joQuery("UPDATE $monthawards_table SET player = '".$row["name"]."', value = '".$row["winPer"]."', 
		                                   date = '".$date."' WHERE id = '10'", 2);
	}
	
	/*Highest Win %*/
	
	arsort($motm);
	$motm = array_flip($motm);
	foreach($motm as $name) {
		$motm_name = $name;
		break;
	}
	
	$recordsIDs = array();
	$sqlGRIDs = $tpl->joQuery("SELECT * FROM $stats_m_table WHERE SUBSTRING(last_played, 1, 7) = '$useDate'", 1);
    while($GRIDsRow = mysqli_fetch_assoc($sqlGRIDs)) {
	    $recordsIDs[] = $GRIDsRow["id"];
	}
	
	
	$tpl->joQuery("DELETE FROM $stats_m_table WHERE SUBSTRING(last_played, 1, 7) = '$useDate' ", 2);
    foreach($recordsIDs AS $record) {
	    $tpl->joQuery("DELETE FROM $mapstats_m_table WHERE record = '$record'", 2);
	    $tpl->joQuery("DELETE FROM $weaponstats_m_table WHERE record = '$record'", 2);
		$tpl->joQuery("DELETE FROM $vehiclestats_m_table WHERE record = '$record'", 2);
    }
    $tpl->joQuery("UPDATE $players_table SET m_rating = 0", 2);
	
	$tpl->joQuery("UPDATE $players_table SET motm = motm + 1 WHERE name = '".$motm_name."'", 2);
	
	header("location: ./admin.php?section=misc&msg=8");
	exit;
}