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
	<td>Rank List</td>
  </tr>
</table>

<br />

<form id="js_menu" method="get" action="{formAction}">
  <input type="hidden" name="section" value="{section}" />
  Rank: 
  <select name="rid" id="js_button">
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
		  <td width="15" colspan="2">{name}</td>
		</tr>
		<tr id="js_row2">
		  <td id="js_menu2" width="100"><img name="{name}" src="./{section}/{image}" width="96" height="40" alt="" /></td>
		  <td align="left">
			Rank Number: {id}<br />
		    Points Needed: {rating}<br />
			Number of players: {r_players}
		  </td>
		</tr>
	  </table>
	  <br />
	</td>
  </tr>
</table>

<br />