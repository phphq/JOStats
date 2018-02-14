<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<!--
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
/////////////////////////////////////////////////////////////*/
//                                                           //
// Updated Dec 2016 By Novahq.net <scott@novahq.net>         //
// Standalone, PHP 5.6+ Compatible                           //
//                                                           //
/////////////////////////////////////////////////////////////*/
-->
<title>JOStats</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<meta name="Keywords" content="Babstats, Bab.stats, Stats System, JOStats, Multi-Tracker, JO, Joint Operations, Escalation">
<meta name="Description" content="JOStats is program for Joint Operations: Escalation that will track player statistics and upload them to a website.">
<meta name="Author" content="Peter Jones - p.jones188@btinternet.com">
<meta name="rating" content="General">
<meta name="ROBOTS" content="ALL">
<link rel="shortcut icon" href="./favicon.ico">
{jsLink}
<style type="text/css">
{jsStyle}
</style>
</head>
<div align="center" id="js_body">
  <a name=""></a>
  <table width="700">
    <tr id="js_top">
      <td width="518" height="70" id="js_header">
		<div align="left">
		<br />
		<form id="js_tableHead" method="get" action="{quickJump}">
			<input type="hidden" name="section" value="player_stats">
		    Quick Jump:
		    <select name="pid" id="js_button">
		    	<option value="0">Select Player</option>
			  {playerList}
		    </select>
		    &nbsp;
			<input id="js_button" type="submit" value="Go" />
		</form>
		</div>
		<div align="center">
		<table id="js_top">
		  <tr>
		    <td>
			  &nbsp;&nbsp;&nbsp;&nbsp;
			  <img title="{websiteTitle}" src="./tpls/logoSmall.gif" width="32" height="32" alt="Bab.stats JOStats" />
			</td>
			<td>
			  &nbsp;&nbsp;<span style="font-size:24px;">{websiteTitle}</span>
			</td>
		  </tr>
		</table>
		</div>
	  </td>
      <td width="120">
	    <div align="right">
	    <table width="120" height="40">
          <tr id="js_menu2">
            <td id="js_menu2"><a href="./?section=about">About</a></td>
            <td id="js_menu2"><a href="./?section=awards">Awards</a></td>
          </tr>
          <tr id="js_menu2">
            <td id="js_menu2"><a href="./?section=ranks">Ranks</a></td>
            <td id="js_menu2"><a href="./?section=server_list">Server</a></td>
          </tr>
          <tr>
            <td id="js_menu2"><a href="./?section=rating_system">Ratings</a></td>
            <td id="js_menu2"><a href="./admin.php">Admin</a></td>
          </tr>
        </table>
	    </div>
	  </td>
    </tr>
    <tr>
      <td colspan="2" id="js_menu">Main =&gt; 
		<a href="./?section=kill_stats">Kill Stats</a> - 
		<a href="./?section=game_type">Gametype</a> - 
		<a href="./?section=weapons">Weapons</a> - 
		<a href="./?section=vehicles">Vehicles</a> - 
		<a href="./?section=maps">Maps</a> - 
		<a href="./?section=squad_list">Squads</a> - 
		<a href="./?section=compare">Compare</a> - 
		<a href="./?section=monthly_awards">Monthly Awards</a>	  </td>
    </tr>
    <tr id="js_center">
      <td colspan="2"><div align="center">
		{content}
	  </div></td>
    </tr>
    <tr id="js_info">
      <td colspan="2">
	  	JOStats Powered by <a href="javascript:;" onclick="javascript:alert('Powered By: http://www.babstats.com (Navigation may contain virus...)');">Bab.stats</a> :: Version: {version} ::
		PHP 5.6+ by <a href="http://www.novahq.net/?app=JOStats">NovaHQ</a> ::
        &quot;Default&quot; template by <a href="javascript:;" onclick="javascript:alert('http://www.messiahgamingtools.com (Navigation may contain virus...)');">Azrael</a> ::.
	  </td>
    </tr>
  </table>
</div>