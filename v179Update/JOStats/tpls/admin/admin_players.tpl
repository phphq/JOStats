---section playerSearch start---
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

<u><b>Players Admin</b></u>

<br />
<br />

<table width="600px" id="js_border">
  <tr>
	<td colspan="3"><div align="center" style="color:#FF0000;">{error}{msg}</div></td>
  </tr>
  <tr>
	<td>		
	  <form method="post" action="{formAction}">
        <div align="center">
		<select name="pid" size="15" id="js_button">
		---loop list start---
		  <option value="{list_id}">{list_name}</option>
		---loop list end---
		</select>
		<br />
		<br />
	    <input name="select_player" type="submit" id="js_button" value="Select">
	    </div>
	  </form>
	</td>
    <td id="js_text"><div align="center">or</div></td>
    <td>
      <form method="post" action="{formAction}">
        <div align="center">
	    <input name="findName" type="text" id="js_button">
	    <br />
	    <br />
	    <input name="find_player" type="submit" id="js_button" value="Find">
        </div>
      </form>
    </td>
  </tr>
</table>
---section playerSearch end---


---section playerSelected start---
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
// File Name     : Admin Players Template                    //
// File Version  : 1.0.0 Standalone                          //
//                                                           //
/////////////////////////////////////////////////////////////*/
-->

<br />

<u id="js_text"><b>Players Admin for {name}</b></u>

<br />
<br />

<div style="color:#FF0000;">{msg}</div>

<br />
<form method="post" action="{formAction}">
<input type="hidden" name="pid" value="{pid}">
<table width="500px" id="js_border">
  <tr>
    <td width="180px">
      <input name="plyrName" type="text" id="js_button" value="{name}" size="25">	</td>
	<td width="110px">
	  <input name="change_name" type="submit" id="js_button" value="Change Name">	</td>
    <td>&nbsp;</td>
	<td><div align="center">
	  <input name="delete_player" type="submit" id="js_button" style="text-align:center; width:115px" value="Delete Player" />
	</div></td>
  </tr>
  <tr>
    <td>
      <select name="plySquad" id="js_button">
      	<option value="0">None</option>
		{selSquad}
	  	{getSquad}
      </select>	</td>
	<td>
	  <input name="change_squad" type="submit" id="js_button" value="Change Squad">	</td>
    <td>&nbsp;</td>
    <td><div align="center">
      <input type="submit" name="reset_plyr_stats" value="Reset Stats" id="js_button" style="text-align:center; width:115px">
    </div></td>
  </tr>
</table>
</form>
---section playerSelected end---