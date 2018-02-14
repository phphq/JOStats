---section main start---
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

<u><b>Restore Backup</b></u>

<br />
<br />

<table width="500px">
  <tr>
    <td><div align="center" style="color:#FF0000;">{msg}</div></td>
  </tr>
</table>

<br />

<table width="500px" id="js_border">
  <tr>
    <td>
	  <div align="center">
	  <form method="post" action="{formAction}">
	    <table width="400px" id="js_border">
          <tr>
            <td colspan="2"><div align="center"><u>Available Restore Files</u></div></td>
          </tr>
          <tr>
            <td width="50%"><div align="right">
              <select name="backupSel" id="js_button">
              	{getFiles}
			  </select>
            </div></td>
            <td><input name="restore_backup" type="submit" id="js_button" value="restore" /></td>
          </tr>
        </table>
	  </form>
	  </div>
	</td>
  </tr>
</table>
---section main end---