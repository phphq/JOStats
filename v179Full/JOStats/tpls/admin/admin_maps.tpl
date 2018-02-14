---section mapMain start---
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

<u><b>Maps Admin</b></u>

<br />
<br />

<table width="600px" id="js_border">
  <tr>
    <td colspan="3"><div align="center" style="color:#FF0000;">{error}</div></td>
  </tr>
  <tr>
	<td>		
	  <form method="post" action="{formAction}">
		<div align="center">
		<select name="mid" size="15" id="js_button">
		---loop list start---
		  <option value="{list_id}">{list_name}</option>
		---loop list end---
		</select>
		<br />
		<br />
		<input name="select_map" type="submit" id="js_button" value="Select">
		</div>
	  </form>
	</td>
	<td>&nbsp;</td>
	<td valign="top">
	  <div align="center">
	  <table id="js_text">
	    <tr>
	      <td colspan="2"><u><b>General Maps Info</b></u></td>
        </tr>
	    <tr>
	      <td>Maps with images:</td>
          <td>{mapImg}</td>
        </tr>
	    <tr>
	      <td>Maps without Images:</td>
          <td>{mapNoImg}</td>
        </tr>
      </table>
      
	  <br />
	  <span id="js_text"><u>Maps without Images</u></span>
	  <form method="post" action="{formAction}">
		<div align="center">
		<select name="mid" size="9" id="js_button">
		---loop list2 start---
		  <option value="{list2_id}">{list2_name}</option>
		---loop list2 end---
		</select>
		<br />
		<br />
		<input name="select_map" type="submit" id="js_button" value="Select">
		</div>
	  </form>
	  </div>
    </td>
  </tr>
</table>
---section mapMain end---


---section mapSelected start---
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

<u><b>Maps Admin for {name}</b></u>

<br />
<br />

<div style="color:#FF0000;">{msg}</div>

<br />

<table id="js_text">
  <tr>
    <td align="center">Current Image</td>
  </tr>
  <tr>
    <td><img name="{name}" src="maps/{image}" width="200px" alt="{name}"></td>
  </tr>
</table>

<br />

<form action="?section=mapActions" method="post" enctype="multipart/form-data">
<input type="hidden" name="mid" value="{mid}">
<table width="500px" id="js_border">
  <tr>
    <td width="180">
      <input name="uploadImage" type="file" id="js_button">    </td>
	<td width="110">
	  <input name="upload_image" type="submit" id="js_button" value="Upload Image">	</td>
    <td>&nbsp;</td>
	<td><div align="center">
	  <input name="delete_image" type="submit" id="js_button" style="text-align:center; width:115px" value="Delete Image" />
	</div></td>
  </tr>
  <tr>
    <td>
      <select name="mapImage" id="js_button">
   	  <option value="0">None</option>
	  	{getMaps}
      </select>	</td>
	<td>
	  <input name="change_image" type="submit" id="js_button" value="Change Image">	</td>
    <td>&nbsp;</td>
    <td><div align="center"></div></td>
  </tr>
</table>
</form>
---section mapSelected end---