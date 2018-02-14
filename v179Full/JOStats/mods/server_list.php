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
// File Name     : Server List Module                        //
// File Version  : 1.0.1 Standalone                          //
//                                                           //
/////////////////////////////////////////////////////////////*/

/*/////////////////////////////////////////////////////////////
//                                                           //
// Updated Dec 2016 By Novahq.net <scott@novahq.net>         //
// Standalone, PHP 5.6+ Compatible                           //
//                                                           //
/////////////////////////////////////////////////////////////*/

$file = "./tpls/server.tpl";

if(!$tpl->getMgtTpl($file)) {

	$varArray["content"] = $tpl->joErrorRet(1, $section." template");	

} else {

	$gameType = array(
		"Team Deathmatch"       => "TDM"   , 
		"Cooperative"           => "COOP"  , 
		"Team King of the Hill" => "TKOTH" , 
		"King of the Hill"      => "KOTH"  , 
		"Search and Destroy"    => "SD"    , 
		"Attack and Defend"     => "AD"    , 
		"Capture the Flag"      => "CTF"   , 
		"Flagball"              => "FB"    , 
		"Advance and Secure"    => "AAS"   , 
		"Conquer and Control"   => "CAC"   , 
		"Deathmatch"            => "DM" 
	);		
	
	$sn = 1;
	$num = 0;
	$varArray["serverList"] = "";
	
	$sql = $tpl->joQuery("SELECT * FROM $servers_table", 1);
	if(mysqli_num_rows($sql) > 0) {

		while($row = mysqli_fetch_assoc($sql)) {

			$row['style'] = $num % 2 == 0 ? "js_row1" : "js_row2";

			switch($row["state"]) {
				case 1: $state = "Loading"  ; break;
				case 3: $state = "Hosting"; break;
				case 4: $state = "Scoring"  ; break;
			}
			
			if($row["lastUpdate"] == "0000-00-00 00:00:00") {

				$row["status"] = '<img src="./tpls/offlineSmall.gif" width="16" alt="" />';
				$state = "Offline";

			} else {

				$lastUpdate = @strtotime($row["lastUpdate"]);
				$ctime = strtotime(date("Y-m-d H:i:s"));
				$ctimeDiff = $ctime - $lastUpdate;

				if($ctimeDiff < 120) {
					$row["status"] = '<img src="./tpls/onlineSmall.gif" width="16" alt="" />';
				} else {
					$row["status"] = '<img src="./tpls/offlineSmall.gif" width="16" alt="" />';
					$state = "Offline";
				}

			}
			
			$serverName = '<a href="./?section=server&sid='.$row["id"].'">'.htmlspecialchars($row["name"]).'</a>';
			
			$varArray["serverList"] .= '<tr id="'.$row["style"].'">
											<td><div align="right">'.$sn.'</div></td>
											<td align="left">'.$serverName.'</td>
											<td align="left">'.$row["server_name"].'</td>';
											
			if($state == "Offline") {
				$varArray["serverList"] .= '<td align="center">&nbsp;</td>
											<td align="center">&nbsp;</td>
											<td align="center">&nbsp;</td>';
			} else {
				$varArray["serverList"] .= '<td align="center" title="'.htmlspecialchars($gameMod[1][$row["game_mod"]]).'">'.
											$gameMod[0][$row["game_mod"]].'</td>
											<td align="center" title="'.$row["game_type"].'">'.htmlspecialchars($gameType[$row["game_type"]]).'</td>
											<td align="center">'.$row["num_players"].'/'.$row["max_players"].'</td>';
			}
			
			$varArray["serverList"] .= '	<td align="center">'.$state.'</td>
											<td align="center">'.$row["status"].'</td>
									    </tr>';
			$sn++;
			$num++;
		}

	} else {
		$varArray["serverList"] = "";
	}
	
	
	$varArray["content"] = $tpl->buildMgtTpl($varArray, $sqlArray, 1, $file, "list");
}