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

<u><b>Ranks Admin</b></u>

<br />
<br />

<table width="500px" id="js_text">
  <tr>
	<td><div align="center" style="color:#FF0000;">{error}{msg}</div></td>
  </tr>
</table>

<br />

<form action="?section=ranksActions" method="post" enctype="multipart/form-data">
  <table width="600px" id="js_border">
    <tr id="js_text">
      <td colspan="7"><u><b>Add Rank</b></u></td>
	</tr>
	<tr id="js_text">
	  <td>Name</td>
	  <td><u>Existing Image</u></td>
	  <td>&nbsp;</td>
	  <td><u>New Image</u></td>
	  <td>Value</td>
	</tr>
	<tr id="js_text">
	  <td>
		<input name="rkName" type="text" id="js_button">
	  </td>
	  <td>
		<select name="rkImage" id="js_button">
		  {imageList}
		</select>
	  </td>
	  <td width="20px">or</td>
	  <td>
	    <input id="js_button" name="rankImage" type="file" id="rankImage" />
	  </td>
	  <td>
		<input name="rkScore" type="text" id="js_button" size="6">
	  </td>
	</tr>
	<tr id="js_text">
	  <td colspan="7">
	  	<input name="add_rank" type="submit" id="js_button" value="Add Rank">
	  </td>
    </tr>
  </table>
  
  <br />
  
  <table width="600px" id="js_border">
    <tr id="js_text">
      <td>&nbsp;</td>
	  <td>&nbsp;</td>
      <td>Name</td>
      <td>Image</td>
      <td>Value</td>
      <td>&nbsp;</td>
    </tr>
    {ranksList}
    <tr id="js_text">
      <td colspan="7">&nbsp;</td>
    </tr>
    <tr id="js_text">
      <td colspan="7">
	    <div align="center">
        <input name="edit_ranks" type="submit" id="js_button" value="Edit Selected">
        &nbsp;&nbsp;
	    <input name="delete_ranks" type="submit" id="js_button" value="Delete Selected">
        </div>
	  </td>
    </tr>
  </table>
</form>