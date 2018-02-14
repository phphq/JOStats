---section serverMain start---
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

<u><b>Servers Admin</b></u>

<br />
<br />

<table width="500px" id="js_border">
  <tr>
	<td colspan="3"><div align="center" style="color:#FF0000;">{error}{msg}</div></td>
  </tr>
  <tr>
	<td id="js_text">		
	  <u><b>Server Selection</b></u>
	  <form method="post" action="{formAction}">
	    <!--<select id="js_button" name="sid" size="15">-->
      <select id="js_button" name="sid" size="15">
		  ---loop list start---
		  <option value="{list_id}" selected>{list_name}</option>
		  ---loop list end---
		</select>
		<br />
		<br />
		<input name="select_server" type="submit" id="js_button" value="Select">
    &nbsp;
		<input name="delete_server" type="submit" id="js_button" value="Delete">
	  </form>
	</td>
	<td>&nbsp;</td>
	<td valign="top"><div align="right">
	  <table id="js_text">
        <tr>
          <td colspan="2"><u><b>General Servers Info</b></u></td>
        </tr>
        <tr>
          <td>Servers:</td>
          <td>{serverNum}</td>
        </tr>
      </table>
    </div></td>
  </tr>
</table>

<br />

<form method="post" action="{formAction}">
<table width="500px" id="js_border">
  <tr id="js_text">
    <td colspan="5"><u><b>Add Server</b></u></td>
  </tr>
  <tr id="js_text">
    <td>Name:</td>
    <td><input name="serverName" type="text" id="js_button"></td>
    <td>Server ID:</td>
    <td><input name="serverId" type="text" id="js_button"></td>
  </tr>
  <tr>
    <td colspan="4" valign="top">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="4" valign="top"><div align="center">
      <input name="add_server" type="submit" id="js_button" value="Add Server">
    </div></td>
  </tr>
</table>
</form>
---section serverMain end---


---section serverSelected start---
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
-->

<br />

<u><b>Server Admin for {name}</b></u>

<br />
<br />

<div style="color:#FF0000;">{msg}</div>

<br />
<br />

<form action="{formAction}" method="post">
  <input type="hidden" name="sid" value="{sid}">
  <table width="500px" id="js_border">
    <tr id="js_text">
      <td colspan="5"><u><b>Edit Server Details </b></u></td>
    </tr>
    <tr id="js_text">
      <td>Name:</td>
      <td><input name="srName" type="text" id="js_button" value="{name}"></td>
      <td>Server ID:</td>
      <td><input name="srId" type="text" id="js_button" value="{serverid}"></td>
    </tr>
    <tr id="js_text">
      <td colspan="4" valign="top">&nbsp;</td>
    </tr>
    <tr id="js_text">
      <td colspan="4" valign="top"><div align="center">
          <input name="edit_server" type="submit" id="js_button" value="Edit Server">
      </div></td>
    </tr>
  </table>
</form>
---section serverSelected end---