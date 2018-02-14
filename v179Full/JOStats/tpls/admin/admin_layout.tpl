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

<u><b><a href="./admin.php?section=style">Style  Admin</a></b></u> / 
<u><b><a href="./admin.php?section=layout">Layout  Admin</a></b></u>

<br />

<table width="500px">
  <tr>
    <td><div align="center" style="color:#FF0000;">{error}{msg}</div></td>
  </tr>
</table>

<br />

<form name="post" method="post" action="./admin.php?section=layoutActions">
<u><b>Kill Stats List</b></u>
<table width="650px" id="js_border">
  <tr>
    <td valign="top" align="center">
	    <table align="center">
          <tr>
            <td valign="top" align="center"><table align="center">
              <tr>
                <td align="center" style="color:#FFFFFF; font-size:14px;" valign="top"><u><b>Stats to Display:</b></u><br />
                    <table id="js_border">
                        {layoutList}
                    </table>
				  </td>
              </tr>
              <tr id="js_text">
                <td align="center"><br />
                    <input name="update_m_layout" type="submit" id="js_button" value="Update Layouts" />
                </td>
              </tr>
            </table></td>
          </tr>
        </table>
   	  </td>
  </tr>
</table>
</form>
