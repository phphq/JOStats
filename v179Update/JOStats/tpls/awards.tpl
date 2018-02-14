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
/*/////////////////////////////////////////////////////////////
//                                                           //
// Updated Dec 2016 By Novahq.net <scott@novahq.net>         //
// Standalone, PHP 5.6+ Compatible                           //
//                                                           //
/////////////////////////////////////////////////////////////*/
-->
<br />

<table id="js_header">
  <tr>
	<td>{listName}Award List</td>
  </tr>
</table>

<br />

<a href="./?section={section}&type=1" id="js_aboutText" style="font-size:12px; font-weight:bold">Game</a> 
<span  id="js_aboutText" style="font-size:12px; font-weight:bold">/</span> 
<a href="./?section={section}&type=2" id="js_aboutText" style="font-size:12px; font-weight:bold">Weapons</a>

<br />
<br />

<form id="js_menu" method="get" action="{formAction}">
  <input type="hidden" name="section" value="{section}" />
  Award: 
  <select id="js_button" name="aid">
    {selOption}
	---loop list start---
      <option value="{list_id}">{list_name}</option>
	---loop list end---
  </select>
  &nbsp;
  <input type="submit" id="js_button" value="Go" />
</form>

<br />

<table width="400" id="js_menu2">
  <tr>
	<td align="center">
	  <br />
	  <table width="300" id="js_row1">
		<tr id="js_tableHead">
		  <td colspan="2">{name}</td>
		</tr>
		<tr id="js_row1">
		  <td id="js_menu3" width="100"><img name="{name}" src="./{section}/{image}" alt="{name}" /></td>
		  <td align="left">
			Award Number: {id}<br />
			Statistic Used: {stat}<br />
			Points Needed: {value}<br />
			Players Achieved: {a_players}/{a_count}
		  </td>
		</tr>
	  </table>
	  <br />
	</td>
  </tr>
</table>

<br />