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
<br />

<table id="js_header">
	<tr>
		<td>Gametype Stats</td>
	</tr>
</table>
 
 <br />
 
<form id="js_menu" method="get" action="{formAction}">
  <input type="hidden" name="section" value="{section}" />
  Stats: 
  <select id="js_button" name="condStats">
    {statsType}
  </select>
  &nbsp;
  <input type="hidden" name="condTeam" value="{condTeam}" />
  <input type="hidden" name="condServer" value="{condServer}" />
  <input type="hidden" name="condGame" value="{condGame}" />
  <input type="submit" id="js_button" value="Go" />
</form>

<form id="js_menu" method="get" action="{formAction}">
   <input type="hidden" name="section" value="{section}" />
  Team: 
  <select id="js_button" name="condTeam">
    {teamList}
  </select>
  &nbsp;Gametype: 
  <select id="js_button" name="condGame">
    {gtypeList}
  </select>
  &nbsp;Server: 
  <select id="js_button" name="condServer">
    {serverList}
  </select>
  &nbsp;
  <input type="hidden" name="condStats" value="{condStats}" />
  <input id="js_button" type="submit" value="Go" />
</form>


<br />
  
<table width="{width}" id="js_table">
	<tr id="js_tableHead">
		{headList}
	</tr>
	---loop list start---
		<tr id="{list_class}">
			{statList}
		</tr>
	---loop list end---
</table>

<br />
<br />

<table id="js_table">
  <tr id="js_tableHead">
    <td width="15" colspan="{colCount}">Top 10 Players</td>
  </tr>
  <tr id="js_tableHead">
    <td width="15">&nbsp;</td>
    <td width="32"><div align="center">Rank</div></td>
    <td>Player</td>
    {head2List}
  </tr>
  ---loop list2 start---
  <tr id="{list2_class}">
    <td><div align="right">{list2_num}</div></td>
    <td><div align="center"><img src="./ranks/{list2_rImage}" height="20" alt="{list2_rName}" /></div></td>
    <td align="left"><a href="./?section=player_stats&pid={list2_id}">{list2_name}</a></td>
    {stat2List}
  </tr>
  ---loop list2 end---
</table>

<br />