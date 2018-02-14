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

<u><b>Merge Players</b></u>

<br />
<br />

<table width="500px">
  <tr  id="js_text">
    <td><div align="center" style="color:#FF0000;">{error}{msg}</div></td>
  </tr>
</table>

<br />

<form id="js_button" method="post" action="?section=merge">
<table width="400px" id="js_border">
  <tr id="js_text">
    <td width="200">
	  <select name="plyr1" size="10">
	  	{playerList}
	  </select>	</td>
    <td>
	  <select name="plyr2" size="10">
	  	{playerList}
	  </select>    </td>
  </tr>
  <tr id="js_text">
    <td><div align="right"></div></td>
    <td><div align="left"></div></td>
  </tr>
  <tr id="js_text">
    <td colspan="2">
      <div align="center">
	    <br />
		<input name="merge" type="submit" id="js_button" value="Proceed" />
      </div>	</td>
  </tr>
  <tr id="js_text">
    <td colspan="2">
	  <br />
	  <div align="center">
	    The player selected from the list on the left hand side is the player name that will be kept.
	  </div>
	</td>
  </tr>
</table>
</form>