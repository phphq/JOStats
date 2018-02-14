---section game start---
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

<u><b>Game Awards Admin</b></u>

<br />
<br />

<a href="./admin.php?section=awards&type=1">Game</a> / <a href="./admin.php?section=awards&type=2">Weapons</a>

<br />

<table width="500px" id="js_text">
  <tr>
	<td><div align="center" style="color:#FF0000;">{error}{msg}</div></td>
  </tr>
</table>

<br />

<form action="?section=awardsActions" method="post" enctype="multipart/form-data">
  <table width="600px" id="js_border">
    <tr id="js_text">
      <td colspan="5"><u><b>Add Award</b></u></td>
	</tr>
	<tr id="js_text">
	  <td>Name</td>
	  <td>&nbsp;</td>
	  <td>Description</td>
	  <td>Stat</td>
	  <td>Value</td>
	</tr>
	<tr id="js_text">
	  <td>
		<input id="js_button" name="awName" type="text">
	  </td>
	  <td>&nbsp;</td>
	  <td>
		<input id="js_button" name="awDesc" type="text">
	  </td>
	  <td>
		<select id="js_button" name="awStat">
		  {statList}
		</select>
	  </td>
	  <td>
		<input name="awValue" type="text" id="js_button" size="6">
	  </td>
	</tr>
	<tr id="js_text">
	  <td><u>Existing Image (Main)</u></td>
	  <td>&nbsp;</td>
	  <td><u>New Image (Main)</u></td>
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
    </tr>
	<tr id="js_text">
	  <td>
	    <select id="js_button" name="awImage">
		  {imageList}
	    </select>	  
	  </td>
	  <td align="center">or</td>
	  <td>
	    <input type="file" id="js_button" name="awardImage" />
	  </td>
	  <td><input type="hidden" name="type" value="{type}" /></td>
	  <td>&nbsp;</td>
    </tr>
	<tr id="js_text">
	  <td><u>Existing Image (Shadow)</u></td>
	  <td align="center">&nbsp;</td>
	  <td><u>New Image (Shadow)</u></td>
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
    </tr>
	<tr id="js_text">
	  <td>
	  	<select id="js_button" name="awImage2">
		  {imageList2}
	    </select>
	  </td>
	  <td align="center">&nbsp;</td>
	  <td><input type="file" id="js_button" name="awardImage2" /></td>
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
    </tr>
	<tr id="js_text">
	  <td colspan="5" align="center">
	    <br />
	  	<input name="add_award" type="submit" id="js_button" value="Add Award">
	  </td>
    </tr>
  </table>
  
  <br />
  
  <table width="600px" id="js_border">
    <tr id="js_text">
      <td>&nbsp;</td>
      <td>Name</td>
      <td>Image(s)</td>
      <td>Description</td>
      <td>Stat</td>
      <td>Value</td>
      <td>&nbsp;</td>
    </tr>
    {awardsList}
    <tr>
      <td colspan="7">&nbsp;</td>
    </tr>
    <tr id="js_text">
      <td colspan="7">
	    <div align="center">
        <input name="edit_awards" type="submit" id="js_button" value="Edit Selected">
        &nbsp;&nbsp;
	    <input name="delete_awards" type="submit" id="js_button" value="Delete Selected">
        </div>
	  </td>
    </tr>
  </table>
</form>
---section game end---

---section wpns start---
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

<u><b>Weapon Awards Admin</b></u>

<br />
<br />

<a href="./?section=awards&type=1">Game</a> / <a href="./?section=awards&type=2">Weapons</a>

<br />

<table width="500px">
  <tr>
	<td><div align="center" style="color:#FF0000;">{error}{msg}</div></td>
  </tr>
</table>

<br />

<form action="?section=awardsActions" method="post" enctype="multipart/form-data">
  <table width="600px" id="js_border">
    <tr id="js_text">
      <td colspan="5"><u><b>Add Award</b></u></td>
	</tr>
	<tr id="js_text">
	  <td>Name</td>
	  <td>&nbsp;</td>
	  <td>Description</td>
	  <td>Stat</td>
	  <td>Value</td>
	</tr>
	<tr id="js_text">
	  <td>
		<input id="js_button" name="awName" type="text">
	  </td>
	  <td>&nbsp;</td>
	  <td>
		<input id="js_button" name="awDesc" type="text">
	  </td>
	  <td>
		<select id="js_button" name="awStat">
		  {statList}
		</select>
	  </td>
	  <td>
		<input name="awValue" type="text" id="js_button" size="6">
	  </td>
	</tr>
	<tr id="js_text">
	  <td><u>Existing Image</u></td>
	  <td>&nbsp;</td>
	  <td><u>New Image</u></td>
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
    </tr>
	<tr id="js_text">
	  <td>
	    <select id="js_button" name="awImage">
	    
		  {imageList}
		
	    
	    </select>
	  </td>
	  <td align="center">or</td>
	  <td>
	    <input type="file" id="js_button" name="awardImage" />
	  </td>
	  <td><input type="hidden" name="type" value="{type}" /></td>
	  <td>&nbsp;</td>
    </tr>
	<tr id="js_text">
	  <td><u>Existing Image (Shadow)</u></td>
	  <td align="center">&nbsp;</td>
	  <td><u>New Image (Shadow)</u></td>
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
    </tr>
	<tr id="js_text">
	  <td>
	  	<select id="js_button" name="awImage2">
		  {imageList2}
	    </select>
	  </td>
	  <td align="center">&nbsp;</td>
	  <td><input type="file" id="js_button" name="awardImage2" /></td>
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
    </tr>
	<tr id="js_text">
	  <td colspan="5" align="center">
	    <br />
	  	<input name="add_award" type="submit" id="js_button" value="Add Award">
	  </td>
    </tr>
  </table>
  
  <br />
  
  <table width="600px" id="js_border">
    <tr id="js_text">
      <td>&nbsp;</td>
      <td>Name</td>
      <td>Image</td>
      <td>Description</td>
      <td>Stat</td>
      <td>Value</td>
      <td>&nbsp;</td>
    </tr>
    {awardsList}
    <tr>
      <td colspan="7">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="7">
	    <div align="center">
        <input name="edit_awards" type="submit" id="js_button" value="Edit Selected">
        &nbsp;&nbsp;
	    <input name="delete_awards" type="submit" id="js_button" value="Delete Selected">
        </div>
	  </td>
    </tr>
  </table>
</form>
---section wpns end---