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
<script type="text/javascript">
function popup(urlPath) {
	window.open(urlPath, 'JOStats Color Picker',		  'toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=no,width=310,height=362,left=100,top=100');
}
</script>
<br />

<u><b><a href="./admin.php?section=style">Style  Admin</a></b></u> / 
<u><b><a href="./admin.php?section=layout">Layout  Admin</a></b></u>

<br />

<table width="500px">
  <tr>
    <td><div align="center" style="color:#FF0000;">{error}{msg}</div></td>
  </tr>
</table>

<br />

<form name="post" method="post" action="./admin.php?section=styleActions">
<u><b>Main Stats</b></u>
<table width="650px" id="js_border">
  <tr>
    <td valign="top">
	    <table width="650">
          <tr>
            <td valign="top">&nbsp;</td>
            <td valign="top"><table width="600">
              <tr>
                <td style="color:#FFFFFF; font-size:14px;" valign="top"><u><b>Backgrounds:</b></u><br />
                    <table width="300px" id="js_border">
                      <tr id="js_text">
                        <td>Indent 1 color </td>
                        <td>
						  <input name="indent1Color" type="text" id="indent1Color" value="{Background 1}" size="8" />
						  &nbsp;&nbsp; 
						  <a href="" onclick="return popup('./mods/colorPicker.php?formField=indent1Color')">
						  Picker</a>
                        </td>
                      </tr>
                      <tr id="js_text">
                        <td>Indent 2 color </td>
                        <td>
						  <input name="indent2Color" type="text" id="indent2Color" value="{Background 2}" size="8" />
						  &nbsp;&nbsp; 
						  <a href="" onclick="return popup('./mods/colorPicker.php?formField=indent2Color')">
						  Picker</a>
						</td>
                      </tr>
                      <tr id="js_text">
                        <td>Indent 3 color </td>
                        <td>
						  <input name="indent3Color" type="text" id="indent3Color" value="{Background 3}" size="8" />
						  &nbsp;&nbsp; 
						  <a href="" onclick="return popup('./mods/colorPicker.php?formField=indent3Color')">
						  Picker</a>
						</td>
                      </tr>
                      <tr id="js_text">
                        <td>Main color </td>
                        <td>
						  <input name="mainColor" type="text" id="mainColor" value="{Background 4}" size="8" />
						  &nbsp;&nbsp; 
						  <a href="" onclick="return popup('./mods/colorPicker.php?formField=mainColor')">
						  Picker</a>
						</td>
                      </tr>
                      <tr id="js_text">
                        <td>Header color </td>
                        <td>
						  <input name="headerColor" type="text" id="headerColor" value="{Background 5}" size="8" />
						  &nbsp;&nbsp; 
						  <a href="" onclick="return popup('./mods/colorPicker.php?formField=headerColor')">
						  Picker</a>
						</td>
                      </tr>
                      <tr id="js_text">
                        <td>Body color </td>
                        <td>
						  <input name="bodyColor" type="text" id="bodyColor" value="{Background 6}" size="8" />
						  &nbsp;&nbsp; 
						  <a href="" onclick="return popup('./mods/colorPicker.php?formField=bodyColor')">
						  Picker</a>
						</td>
                      </tr>
                      <tr id="js_text">
                        <td>Stat row 1 color </td>
                        <td>
						  <input name="stat1Color" type="text" id="stat1Color" value="{Background 7}" size="8" />
						  &nbsp;&nbsp; 
						  <a href="" onclick="return popup('./mods/colorPicker.php?formField=stat1Color')">
						  Picker</a>
						</td>
                      </tr>
                      <tr id="js_text">
                        <td>Stat row 2 color </td>
                        <td>
						  <input name="stat2Color" type="text" id="stat2Color" value="{Background 8}" size="8" />
						  &nbsp;&nbsp; 
						  <a href="" onclick="return popup('./mods/colorPicker.php?formField=stat2Color')">
						  Picker</a>
						</td>
                      </tr>
                    </table>
					<br /><br />
				    Click <a href="http://www.immigration-usa.com/html_colors.html" target="_blank">Here</a> 
				    for HTML color codes.
				  </td>
                  <td style="color:#FFFFFF; font-size:14px;" valign="top"><u><b>Fonts:</b></u><br />
                    <table width="270px" id="js_border">
                      <tr id="js_text">
                        <td>Font 1 size </td>
                        <td><input name="font1Size" type="text" id="font1Size" value="{Font size 1}" size="5" /></td>
                      </tr>
                      <tr id="js_text">
                        <td>Font 2 size </td>
                        <td><input name="font2Size" type="text" id="font2Size" value="{Font size 2}" size="5" /></td>
                      </tr>
                      <tr id="js_text">
                        <td>Font 3 size </td>
                        <td><input name="font3Size" type="text" id="font3Size" value="{Font size 3}" size="5" /></td>
                      </tr>
                      <tr id="js_text">
                        <td>Font 1 color </td>
                        <td>
						  <input name="font1Color" type="text" id="font1Color" value="{Font color 1}" size="8" />
						  &nbsp;&nbsp; 
						  <a href="" onclick="return popup('./mods/colorPicker.php?formField=font1Color')">
						  Picker</a>
						</td>
                      </tr>
                      <tr id="js_text">
                        <td>Font 2 color </td>
                        <td>
						  <input name="font2Color" type="text" id="font2Color" value="{Font color 2}" size="8" />
						  &nbsp;&nbsp; 
						  <a href="" onclick="return popup('./mods/colorPicker.php?formField=font2Color')">
						  Picker</a>
						</td>
                      </tr>
                      <tr id="js_text">
                        <td>Font 3 color </td>
                        <td>
						  <input name="font3Color" type="text" id="font3Color" value="{Font color 3}" size="8" />
						  &nbsp;&nbsp; 
						  <a href="" onclick="return popup('./mods/colorPicker.php?formField=font3Color')">
						  Picker</a>
						</td>
                      </tr>
                      <tr id="js_text">
                        <td>Font Family</td>
                        <td><select name="fontFamily" id="fontFamily">
                            <option value="Arial" {Arial}>Arial</option>
                            <option value="Courier" {Courier}>Courier</option>
                            <option value="Courier New" {Courier new}="New}">Courier New</option>
                            <option value="Geneva" {Geneva}>Geneva</option>
                            <option value="Georgia" {Georgia}>Georgia</option>
                            <option value="Helvetica" {Helvetica}>Helvetica</option>
                            <option value="sans-serif" {sans-serif}>Sans-Serif</option>
                            <option value="Tahoma" {Tahoma}>Tahoma</option>
                            <option value="Verdana" {Verdana}>Verdana</option>
                          </select>
                        </td>
                      </tr>
                      <tr id="js_text">
                        <td>Link color </td>
                        <td>
						  <input name="linkColor" type="text" id="linkColor" value="{Link color}" size="8" />
						  &nbsp;&nbsp; 
						  <a href="" onclick="return popup('./mods/colorPicker.php?formField=linkColor')">
						  Picker</a>
						</td>
                      </tr>
                      <tr id="js_text">
                        <td>Link visited color </td>
                        <td>
						  <input name="visitedcolor" type="text" id="visitedcolor" value="{Visited color}" size="8" />
						  &nbsp;&nbsp; 
						  <a href="" onclick="return popup('./mods/colorPicker.php?formField=visitedcolor')">
						  Picker</a>
						</td>
                      </tr>
                      <tr id="js_text">
                        <td>Link hover color </td>
                        <td>
						  <input name="hoverColor" type="text" id="hoverColor" value="{Hover color}" size="8" />
						  &nbsp;&nbsp; 
						  <a href="" onclick="return popup('./mods/colorPicker.php?formField=hoverColor')">
						  Picker</a>
						</td>
                      </tr>
                  </table></td>
              </tr>
              <tr id="js_text">
                <td colspan="2" align="center"><br />
                    <input name="update_m_styles" type="submit" id="js_button" value="Update Main Styles" />
                </td>
              </tr>
            </table></td>
          </tr>
        </table>
   	  </td>
  </tr>
</table>

<br /><br />

<u><b>Admin</b></u>
<table width="500px" id="js_border">
  <tr>
    <td valign="top"><div align="center">
      <table width="280px" id="js_border">
        <tr id="js_text">
          <td>Border Color </td>
              <td>
			    <input name="borderColor" type="text" id="borderColor" value="{A_Background 1}" size="8" />
			    &nbsp;&nbsp; 
				<a href="" onclick="return popup('./mods/colorPicker.php?formField=borderColor')">
				Picker</a>
			  </td>
            </tr>
        <tr id="js_text">
          <td>Font size </td>
              <td><input name="font1Size2" type="text" id="font1Size2" value="{A_Font size 1}" size="5" /></td>
            </tr>
        <tr id="js_text">
          <td>Button font size </td>
              <td><input name="font2Size2" type="text" id="font2Size2" value="{A_Font size 2}" size="5" /></td>
            </tr>
        <tr id="js_text">
          <td>Font color </td>
              <td>
			    <input name="font1Color2" type="text" id="font1Color2" value="{A_Font color 1}" size="8" />
			    &nbsp;&nbsp; 
				<a href="" onclick="return popup('./mods/colorPicker.php?formField=font1Color2')">
				Picker</a>
			  </td>
            </tr>
        <tr id="js_text">
          <td>Button font color </td>
              <td>
			    <input name="font3Color2" type="text" id="font3Color2" value="{A_Font color 3}" size="8" />
			    &nbsp;&nbsp; 
				<a href="" onclick="return popup('./mods/colorPicker.php?formField=font3Color2')">
				Picker</a>
			  </td>
            </tr>
        <tr id="js_text">
          <td>Font Family</td>
              <td><select name="fontFamily2" id="fontFamily2">
                  <option value="Arial" {A_Arial}>Arial</option>
                  <option value="Courier" {A_Courier}>Courier</option>
                  <option value="Courier New" {A_Courier new}="New}">Courier New</option>
                  <option value="Geneva" {A_Geneva}>Geneva</option>
                  <option value="Georgia" {A_Georgia}>Georgia</option>
                  <option value="Helvetica" {A_Helvetica}>Helvetica</option>
                  <option value="sans-serif" {A_sans-serif}>Sans-Serif</option>
                  <option value="Tahoma" {A_Tahoma}>Tahoma</option>
                  <option value="Verdana" {A_Verdana}>Verdana</option>
                  </select>              </td>
            </tr>
        <tr id="js_text">
          <td>Link color </td>
              <td>
			    <input name="linkColor2" type="text" id="linkColor2" value="{A_Link color}" size="8" />
			    &nbsp;&nbsp; 
				<a href="" onclick="return popup('./mods/colorPicker.php?formField=linkColor2')">
				Picker</a>
			  </td>
            </tr>
        <tr id="js_text">
          <td>Link visited color </td>
              <td>
			    <input name="visitedcolor2" type="text" id="visitedcolor2" value="{A_Visited color}" size="8" />
			    &nbsp;&nbsp; 
				<a href="" onclick="return popup('./mods/colorPicker.php?formField=visitedcolor2')">
				Picker</a>
			  </td>
            </tr>
        <tr id="js_text">
          <td>Link hover color </td>
              <td>
			    <input name="hoverColor2" type="text" id="hoverColor2" value="{A_Hover color}" size="8" />
			    &nbsp;&nbsp; 
				<a href="" onclick="return popup('./mods/colorPicker.php?formField=hoverColor2')">
				Picker</a>
			  </td>
            </tr>
        <tr id="js_text">
          <td colspan="2" align="center">
            <br />
            <input name="update_a_styles" type="submit" id="js_button" value="Update Admin Styles" />
		  </td>
        </tr>
      </table>
    </div></td>
  </tr>
</table>
</form>
