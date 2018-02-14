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

<table id="js_header">
	<tr>
		<td>Rating System</td>
	</tr>
</table>

<p>&nbsp;</p>
<table width="300" id="js_menu">
  <tr>
    <td id="js_aboutText">
	  <div align="center">
      <p id="js_text">Below is a list of all the things you get points for and the amount of points:</p>
	  <div align="left"><p id="js_text">Eample:<br />
	  2 Headshots with the M4 Auto would give you  5.6 pts (2 pts for 2 Kills, 
	  2 pts for 2 Headshots and 1.6 pts for 2 kills with the M4 Auto </div></p>
      </div>
	</td>
  </tr>
</table>

<br />
<br />

<table width="600">
  <tr>
    <td valign="top"><table width="170">
      <tr>
        <td id="js_tableHead" colspan="2">Game Bonus Pts</td>
      </tr>
      ---loop list start---
	  <tr>
        <td id="js_row2" width="70%" align="left">{list_s_name}</td>
        <td id="js_row1" align="right">{list_s_pts} pts</td>
      </tr>
	  ---loop list end---
    </table></td>
    <td align="right" valign="top">
	  <div align="center">
		<table width="210">
          <tr>
            <td id="js_tableHead" colspan="3">Weapon Bonus Pts (Secondary)</td>
          </tr>
          <tr>
            <td id="js_tableHead">&nbsp;</td>
            <td id="js_tableHead" title="Single Kill"><div align="center">Kill</div></td>
            <td id="js_tableHead" title="Multi-Kill"><div align="center">Multi</div></td>
          </tr>
        {wpns1}
	    </table>
	    
	    <br />
		
		<table width="210">
          <tr>
            <td id="js_tableHead" colspan="3">Weapon Bonus Pts (Other)</td>
          </tr>
          <tr>
            <td id="js_tableHead">&nbsp;</td>
            <td id="js_tableHead" title="Single Kill"><div align="center">Kill</div></td>
            <td id="js_tableHead" title="Multi-Kill"><div align="center">Multi</div></td>
          </tr>
        {wpns3}
		</table>
		
		<br />
		
		<table width="210">
          <tr>
            <td id="js_tableHead" colspan="3">Weapon Bonus Pts (Emplaced)</td>
          </tr>
          <tr>
            <td id="js_tableHead">&nbsp;</td>
            <td id="js_tableHead" title="Single Kill"><div align="center">Kill</div></td>
            <td id="js_tableHead" title="Multi-Kill"><div align="center">Multi</div></td>
          </tr>
        {wpns4}
	    </table>
		
		<br />
		
		<table width="210">
          <tr>
            <td id="js_tableHead" colspan="3">Weapon Bonus Pts (Sniper)</td>
          </tr>
          <tr>
            <td id="js_tableHead">&nbsp;</td>
            <td id="js_tableHead" title="Single Kill"><div align="center">Kill</div></td>
            <td id="js_tableHead" title="Multi-Kill"><div align="center">Multi</div></td>
          </tr>
        {wpns5}
	    </table>
	  </div>
	</td>
    <td align="right" valign="top"><table width="220">
      <tr>
        <td id="js_tableHead" colspan="3">Weapon Bonus Pts (Primary)</td>
      </tr>
      <tr>
        <td id="js_tableHead">&nbsp;</td>
        <td id="js_tableHead" title="Single Kill"><div align="center">Kill</div></td>
        <td id="js_tableHead" title="Multi-Kill"><div align="center">Multi</div></td>
      </tr>
		{wpns2}
    </table></td>
  </tr>
</table>

<br />
<br />