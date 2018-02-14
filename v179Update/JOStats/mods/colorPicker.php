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
// File Name     : Color Picker                              //
// File Version  : 1.0.0 Standalone                          //
//                                                           //
/////////////////////////////////////////////////////////////*/

/*/////////////////////////////////////////////////////////////
//                                                           //
// Updated Dec 2016 By Novahq.net <scott@novahq.net>         //
// Standalone, PHP 5.6+ Compatible                           //
//                                                           //
/////////////////////////////////////////////////////////////*/
-->

<script type="text/javascript" language="JavaScript">
function getColor(colorVal) {
	var a = window.location.toString();
	var formField = a.substring(a.indexOf("=")+1);
	opener.document.getElementById(formField).value = colorVal;
    opener.focus();
    window.close(); 
}
</script>

<table width="300">
  <tr>
    <td bgcolor="#000000" onclick="getColor('000000')">&nbsp;</td>
    <td bgcolor="#333333" onclick="getColor('333333')">&nbsp;</td>
    <td bgcolor="#666666" onclick="getColor('666666')">&nbsp;</td>
    <td bgcolor="#999999" onclick="getColor('999999')">&nbsp;</td>
    <td bgcolor="#CCCCCC" onclick="getColor('CCCCCC')">&nbsp;</td>
    <td bgcolor="#FFFFFF" onclick="getColor('FFFFFF')">&nbsp;</td>
  </tr>
  <tr>
    <td bgcolor="#FF0011" onclick="getColor('FF0011')">&nbsp;</td>
    <td bgcolor="#FF0033" onclick="getColor('FF0033')">&nbsp;</td>
    <td bgcolor="#FF0066" onclick="getColor('FF0066')">&nbsp;</td>
    <td bgcolor="#FF0099" onclick="getColor('FF0099')">&nbsp;</td>
    <td bgcolor="#FF00CC" onclick="getColor('FF00CC')">&nbsp;</td>
	<td bgcolor="#FF00FF" onclick="getColor('FF00FF')">&nbsp;</td>
  </tr>
  <tr>
    <td bgcolor="#FF0000" onclick="getColor('FF0000')">&nbsp;</td>
    <td bgcolor="#FF3300" onclick="getColor('FF3300')">&nbsp;</td>
    <td bgcolor="#FF6600" onclick="getColor('FF6600')">&nbsp;</td>
    <td bgcolor="#FF9900" onclick="getColor('FF9900')">&nbsp;</td>
    <td bgcolor="#FFCC00" onclick="getColor('FFCC00')">&nbsp;</td>
	<td bgcolor="#FFFF00" onclick="getColor('FFFF00')">&nbsp;</td>
  </tr>
  <tr>
    <td bgcolor="#FFFF11" onclick="getColor('FFFF11')">&nbsp;</td>
    <td bgcolor="#FFFF33" onclick="getColor('FFFF33')">&nbsp;</td>
    <td bgcolor="#FFFF66" onclick="getColor('FFFF66')">&nbsp;</td>
    <td bgcolor="#FFFF99" onclick="getColor('FFFF99')">&nbsp;</td>
    <td bgcolor="#FFFFBB" onclick="getColor('FFFFBB')">&nbsp;</td>
	<td bgcolor="#FFFFDD" onclick="getColor('FFFFDD')">&nbsp;</td>
  </tr>
  <tr>
    <td bgcolor="#00FF00" onclick="getColor('00FF00')">&nbsp;</td>
    <td bgcolor="#00FF33" onclick="getColor('00FF33')">&nbsp;</td>
    <td bgcolor="#00FF66" onclick="getColor('00FF66')">&nbsp;</td>
    <td bgcolor="#00FF99" onclick="getColor('00FF99')">&nbsp;</td>
    <td bgcolor="#00FFCC" onclick="getColor('00FFCC')">&nbsp;</td>
	<td bgcolor="#00FFFF" onclick="getColor('00FFFF')">&nbsp;</td>
  </tr>
  <tr>
    <td bgcolor="#0000FF" onclick="getColor('0000FF')">&nbsp;</td>
    <td bgcolor="#0033FF" onclick="getColor('0033FF')">&nbsp;</td>
    <td bgcolor="#0066FF" onclick="getColor('0066FF')">&nbsp;</td>
    <td bgcolor="#0099FF" onclick="getColor('0099FF')">&nbsp;</td>
    <td bgcolor="#00CCFF" onclick="getColor('00CCFF')">&nbsp;</td>
	<td bgcolor="#00DDFF" onclick="getColor('00DDFF')">&nbsp;</td>
  </tr>
  <tr>
    <td bgcolor="#0000DD" onclick="getColor('0000DD')">&nbsp;</td>
    <td bgcolor="#0000BB" onclick="getColor('0000BB')">&nbsp;</td>
    <td bgcolor="#000099" onclick="getColor('000099')">&nbsp;</td>
    <td bgcolor="#000077" onclick="getColor('000077')">&nbsp;</td>
    <td bgcolor="#000055" onclick="getColor('000055')">&nbsp;</td>
	<td bgcolor="#000033" onclick="getColor('000033')">&nbsp;</td>
  </tr>
</table>
