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
		<td>Monthly Awards </td>
	</tr>
</table>
 
<br />
 
<form id="js_menu2" method="get" action="{formAction}">
    <input type="hidden" name="section" value="{section}" />
  Month: 
  <select id="js_button" name="msel">
    <option value="0">Alltime</option>
	{msel}
  </select>
  &nbsp;
  <input type="submit" id="js_button" value="Go" />
</form>

<br />
<br />

<table width="450" id="js_table">
  <tr id="js_tableHead">
    <td colspan="5" align="center">{titleName}</td>
  </tr>
  <tr id="js_tableHead">
    <td>&nbsp;</td>
    <td>Award</td>
    <td>Player</td>
    <td>Value</td>
    <td>Date Gained</td>
  </tr>
  {monthlyAwards}
</table>

<br />