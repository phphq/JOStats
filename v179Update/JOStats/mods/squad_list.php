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
// Website       : http://www.gamers-central.com             //
// Support       : http://www.babstats.com                   //
//                                                           //
// File Name     : Squads List Module                        //
// File Version  : 1.0.2 Standalone                          //
//                                                           //
/////////////////////////////////////////////////////////////*/

/*/////////////////////////////////////////////////////////////
//                                                           //
// Updated Dec 2016 By Novahq.net <scott@novahq.net>         //
// Standalone, PHP 5.6+ Compatible                           //
//                                                           //
/////////////////////////////////////////////////////////////*/

$file = "./tpls/squads.tpl";

if(!$tpl->getMgtTpl($file)) {

	$varArray["content"] = $tpl->joErrorRet(1, $section." template");	

} else {

	$page=(!empty($_GET['page']) ? intval($_GET['page']) : 1);
	
	$sql = $tpl->joQuery("SELECT * FROM $squads_table", 1);
	$total = mysqli_num_rows($sql);
	
	$sql = $tpl->joQuery("SELECT * FROM $settings_table", 1);
	$row = mysqli_fetch_assoc($sql);
	
	$perPage = $row["value"];
	
	$offset = ($page-1) * $perPage;

	$varArray["offset"] = $offset;
	
	$sql = $tpl->joQuery("SELECT $squads_table.*                                   ,
						      SUM($stats_table.kills)             AS kills         ,
						      SUM($stats_table.deaths)            AS deaths        , 
						      ROUND(SUM($stats_table.kills)/IF(SUM($stats_table.deaths)=0, 1, 
						      SUM($stats_table.deaths)), 2)       AS ratio      
					      FROM $players_table, $stats_table, $squads_table 
						  WHERE $players_table.squad = $squads_table.id
						  AND $stats_table.player = $players_table.id 
						  GROUP BY $players_table.squad 
						  LIMIT ".$offset.", ".$perPage."", 1);
	
	$num = 1;	
	$varArray["squadList"] = "";
	while($row = mysqli_fetch_assoc($sql)) {

		$row["class"] = $num % 2 == 0 ? "js_row1" : "js_row2";

		$pSql = $tpl->joQuery("SELECT * FROM $players_table WHERE squad = '".$row["id"]."'", 1);
		if(@mysqli_num_rows($pSql) == '0') {$plyrNum = '0';} else {$plyrNum = mysqli_num_rows($pSql);}
		
		$varArray["squadList"] .= '<tr id="'.$row["class"].'">
									   <td><div align="right">'.$num.'</div></td>
									   <td><div align="center">
									       <img src="./logos/'.$row["logo"].'" height="50" alt="" />
									   </div></td>
									   <td align="left">
									       <a href="./?section=squad_details&sqid='.$row["id"].'">'.$row["name"].'</a>
									   </td>
									   <td align="right">'.$row["tag"].'</td>
									   <td align="right">'.$row["kills"].'</td>
									   <td align="right">'.$row["deaths"].'</td>
									   <td align="right">'.$tpl->JoColorRatio($row["ratio"]).'</td>
									   <td align="right">'.$plyrNum.'</td>
									   <td align="right">'.$row["date"].'</td>
								     </tr>';
		$num++;
	}

	$url = "./?section=squad_list&page=";

	$varArray["multiList"] = $tpl->GetJoMultiList($url, $page, $total, $perPage);

	$varArray["content"] = $tpl->buildMgtTpl($varArray, $sqlArray, 1, $file, "list");
}