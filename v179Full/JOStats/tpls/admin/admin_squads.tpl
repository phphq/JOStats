---section squadMain start---
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

<u><b>Squads Admin</b></u>

<br />
<br />

<table width="500px" id="js_border">
  <tr>
    <td colspan="3"><div align="center" style="color:#FF0000;">{error}{msg}</div></td>
  </tr>
  <tr id="js_text">
    <td>		
	  <u><b>Squad Selection</b></u>
	  <form method="post" action="{formAction}">
	    <select name="sqid" size="15" id="js_button">
		---loop list start---
		  <option value="{list_id}">{list_name}</option>
		---loop list end---
		</select>
	    <br />
		<br />
		<input name="select_squad" type="submit" id="js_button" value="Select">
		&nbsp;
		<input name="delete_squad" type="submit" id="js_button" value="Delete">
	  </form>
	</td>
	<td>&nbsp;</td>
	<td valign="top"><div align="right">
	  <table id="js_text">
        <tr>
          <td colspan="2"><u><b>General Squads Info</b></u></td>
        </tr>
        <tr>
          <td>Squads:</td>
          <td>{squadNum}</td>
        </tr>
        <tr>
          <td>With Logos:</td>
          <td>{squadLogo}</td>
        </tr>
        <tr>
          <td>Without Logos:</td>
          <td>{squadNoLogo}</td>
        </tr>
        <tr>
          <td>With Url's:</td>
          <td>{squadUrl}</td>
        </tr>
        <tr>
          <td>Without Url's:</td>
          <td>{squadNoUrl}</td>
        </tr>
      </table>
	</div></td>
  </tr>
</table>

<br />

<form method="post" action="{formAction}">
  <table width="500px" id="js_border">
    <tr id="js_text">
      <td colspan="4"><u><b>Add Squad</b></u></td>
    </tr>
    <tr id="js_text">
      <td width="41px">Name:</td>
      <td width="155px">
	    <input name="squadName" type="text" id="js_button">
      </td>
      <td width="16px" rowspan="4" valign="top">Info:</td>
      <td width="266px" valign="top" rowspan="3">
	    <textarea name="squadInfo" cols="40" rows="5" id="js_button"></textarea>
	  </td>
    </tr>
    <tr id="js_text">
      <td>Url:</td>
      <td>
	    <input name="squadUrl" type="text" id="js_button">
	  </td>
    </tr>
    <tr id="js_text">
      <td valign="top">Tag:</td>
      <td valign="top">
	    <input name="squadTag" type="text" id="js_button">
	  </td>
    </tr>
    <tr id="js_text">
      <td colspan="4" valign="top">&nbsp;</td>
    </tr>
    <tr id="js_text">
      <td colspan="4" valign="top"><div align="center">
        <input name="add_squad" type="submit" id="js_button" value="Add Squad">
      </div></td>
    </tr>
  </table>
</form>
---section squadMain end---


---section squadSelected start---
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

<u><b>Squads Admin for {name}</b></u>

<br />
<br />

<div style="color:#FF0000;">{msg}</div>

<br />

<table id="js_text">
  <tr>
    <td align="center">Current Logo</td>
  </tr>
  <tr>
    <td><img name="{name}" src="./logos/{logo}" width="100px" alt="{name}"></td>
  </tr>
</table>

<br />



<table width="500px"  id="js_border">
  <tr id="js_text">
    <td colspan="4"><u><b>Logo Management</b></u></td>
  </tr>
  <tr id="js_text">
 <form action="{formAction}" method="post" enctype="multipart/form-data">
    <td width="180px"  id="js_boxLeft">
      <input name="uploadLogo" type="file" id="js_button">
	</td>
	<td width="110px"  id="js_boxRight">
	  <input name="upload_logo" type="submit" id="js_button" value="Upload Logo">
	</td>
  </form>
	<td>&nbsp;</td>
	<td align="center"  id="js_boxTop">
	  More Options
	</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td align="center" style="border-left:#4D4D4D thin solid; border-right:#4D4D4D thin solid;">&nbsp;</td>
  </tr>
  <tr>
 <form action="{formAction}" method="post" enctype="multipart/form-data">
    <td style="border-top:#4D4D4D thin solid; border-left:#4D4D4D thin solid;  border-bottom:#4D4D4D thin solid;">
      <select name="logoImage" id="js_button">
		{selLogo}
	  	{getLogo}
      </select>
	</td>
	<td style="border-top:#4D4D4D thin solid; border-bottom:#4D4D4D thin solid; border-right:#4D4D4D thin solid;">
	  <input name="change_logo" type="submit" id="js_button" value="Change Logo">
	</td>
</form>
	<td>&nbsp;</td>
	<td style="border-bottom:#4D4D4D thin solid; border-left:#4D4D4D thin solid; border-right:#4D4D4D thin solid;">
	<div align="center">
<form action="{formAction}" method="post" enctype="multipart/form-data">
	  <input name="delete_logo" type="submit" id="js_button" style="text-align:center; width:115px" value="Delete Logo" />
</form>
	</div>
	</td>
  </tr>
</table>



<br/>

<form action="{formAction}" method="post" enctype="multipart/form-data">
<table width="500px" style="border:#4D4D4D thin solid">
  <tr id="js_text">
    <td colspan="4"><u><b>Edit Squad Details</b></u></td>
  </tr>
  <tr id="js_text">
    <td width="41px">Name:</td>
    <td width="155px"><input name="squadName" type="text" id="js_button" value="{name}"></td>
    <td width="16px" rowspan="4" valign="top">Info:</td>
	<td width="266px" valign="top" rowspan="3"><textarea name="squadInfo" cols="40" rows="5" id="js_button">{info}</textarea></td>
  </tr>
  <tr>
    <td>Url:</td>
    <td><input name="squadUrl" type="text" id="js_button" value="{url}"></td>
  </tr>
  <tr id="js_text">
    <td valign="top">Tag:</td>
    <td valign="top"><input name="squadTag" type="text" id="js_button" value="{tag}"></td>
  </tr>
  <tr>
    <td colspan="4" valign="top">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="4" valign="top"><div align="center">
      <input name="edit_squad" type="submit" id="js_button" value="Edit Details">
    </div></td>
  </tr>
</table>
</form>

<br />


<form action="{formAction}" method="post">
<table width="500px" id="js_border">
  <tr id="js_text">
    <td><u><b>Add Players</b></u></td>
  </tr>
  <tr>
    <td>
	  <select name="plyrList" id="js_button">
      {getPlayers}
      </select> <input name="add_player" type="submit" id="js_button" value="Add Player"></td>
  </tr>
</table>
</form>

<br />

<form action="{formAction}" method="post">
<table width="500px" id="js_border">
  <tr id="js_text">
    <td colspan="2"><u><b>Remove Players</b></u></td>
  </tr>
  ---loop list start---
  <tr>
  	<td width="10px">
  	  <input type="checkbox" id="js_button" name="plyrID[]" value="{list_id}">
	</td>
    <td>{list_name}</td>
  </tr>
  ---loop list end---
  <tr>
    <td colspan="2"><input name="remove_players" type="submit" id="js_button" value="Remove Selected"></td>
  </tr>
</table>
</form>
---section squadSelected end---