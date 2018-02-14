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

<u><b>Rating System Admin</b></u>

<br />
<br />

<a href="./admin.php?section=rating&type=game">Game Bonuses</a> / 
<a href="./admin.php?section=rating&type=weapon">Weapon Bonuses</a>

<br />
<br />

<table width="500px" id="js_text">
  <tr>
	<td><div align="center" style="color:#FF0000;">{error}{msg}</div></td>
  </tr>
</table>

<br />

<form method="post" action="?section=ratingActions&type={type}">
  <br />
  
  <table width="600px" id="js_border">
  <tr id="js_text">
    <td><u><B>Game Bonus Points</B></u></td>
	<td>&nbsp;</td>
	<td width="265px"><u><b>Game Penalty Points</b></u></td>
  </tr>
  <tr id="js_text">
    <td width="280px"><table>
      <tr id="js_text">
        <td><u><b>Name</b></u></td>
        <td><u><b>Points</b></u></td>
      </tr>
      ---loop list1 start---
  <tr id="js_text">
    <td>{list1_s_name}</td>
    <td><input style="text-align:right" id="js_button" name="sPts[{list1_s_id}]" type="text" value="{list1_s_pts}" size="3" /></td>
  </tr>
      ---loop list1 end---
    </table></td>
	<td width="37px">&nbsp;</td>
	<td valign="top">
	  <table id="js_text">
          <tr>
            <td><u><B>Name</B></u></td>
            <td><u><B>Points</B></u></td>
          </tr>
	    ---loop list2 start---
	    <tr>
	      <td>{list2_s_name}</td>
            <td>
			<input id="js_button" style="text-align:right" name="sPts[{list2_s_id}]" type="text" value="{list2_s_pts}" size="3" />
			</td>
          </tr>
	    ---loop list2 end---
	    </table>
	  </td>
  </tr>
  <tr id="js_text">
    <td colspan="8">&nbsp;</td>
  </tr>
  <tr id="js_text">
    <td colspan="8"><div align="center">
        <input name="edit_rating" type="submit" id="js_button" value="Update Rating System">
    </div></td>
  </tr>
</table>
</form>
---section game end---


---section weapon start---
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

<u><b>Rating System Admin</b></u>

<br />
<br />

<a href="./admin.php?section=rating&type=game">Game Bonuses</a> / 
<a href="./admin.php?section=rating&type=weapon">Weapon Bonuses</a>

<br />
<br />

<table width="500px" id="js_text">
  <tr>
	<td><div align="center" style="color:#FF0000;">{error}{msg}{update}</div></td>
  </tr>
</table>

<br />

<form method="post" action="?section=ratingActions&type={type}">
  <br />
  
  <table width="600px" id="js_border">
    <tr id="js_text">
      <td colspan="3" align="center"><u><B>Weapon Bonus Points</B></u></td>
    </tr>
    <tr id="js_text">
      <td valign="top">
	    <table>
          <tr id="js_text">
            <td><u><b>Primary</b></u></td>
            <td><u><b>Kill Pts</b></u></td>
            <td><u><b>Multi-Kills Pts</b></u></td>
          </tr>
          ---loop list1 start---
          <tr id="js_text">
            <td>{list1_s_name}</td>
            <td><div align="center">
              <input id="js_button" style="text-align:right" name="sPts[{list1_s_id}]" type="text" 
			  value="{list1_s_pts}" size="3" />
            </div></td>
            <td><div align="center">
              <input id="js_button" style="text-align:right" name="sPts2[{list1_s_id}]" type="text" 
			  value="{list1_s_pts2}" size="3" />
            </div></td>
          </tr>
          ---loop list1 end---
        </table>
      </td>
	  <td width="37px">&nbsp;</td>
	  <td valign="top">
	    <br />
	    <table>
          <tr id="js_text">
            <td><u><B>Sniper</B></u></td>
            <td><u><B>Kill Pts</B></u></td>
            <td><u><B>Multi-Kill Pts</B></u></td>
          </tr>
	      ---loop list2 start---
	      <tr id="js_text">
	        <td>{list2_s_name}</td>
            <td><div align="center">
              <input id="js_button" style="text-align:right" name="sPts[{list2_s_id}]" type="text" 
			  value="{list2_s_pts}" size="3" />
            </div></td>
            <td><div align="center">
		      <input id="js_button" style="text-align:right" name="sPts2[{list2_s_id}]" type="text" 
			  value="{list2_s_pts2}" size="3" />
		    </div></td>
	      </tr>
	      ---loop list2 end---
	    </table>
		
		<br />
		
		<table>
          <tr id="js_text">
            <td><u><B>Secondary</B></u></td>
            <td><u><B>Kill Pts</B></u></td>
            <td><u><B>Multi-Kill Pts</B></u></td>
          </tr>
	      ---loop list3 start---
	      <tr id="js_text">
	        <td>{list3_s_name}</td>
            <td><div align="center">
              <input id="js_button" style="text-align:right" name="sPts[{list3_s_id}]" type="text" 
			  value="{list3_s_pts}" size="3" />
            </div></td>
            <td><div align="center">
		      <input id="js_button" style="text-align:right" name="sPts2[{list3_s_id}]" type="text" 
			  value="{list3_s_pts2}" size="3" />
		    </div></td>
	      </tr>
	      ---loop list3 end---
	    </table>
		
		<br />
		
		<table>
          <tr id="js_text">
            <td><u><B>Other</B></u></td>
            <td><u><B>Kill Pts</B></u></td>
            <td><u><B>Multi-Kill Pts</B></u></td>
          </tr>
	      ---loop list4 start---
	      <tr id="js_text">
	        <td>{list4_s_name}</td>
            <td><div align="center">
              <input id="js_button" style="text-align:right" name="sPts[{list4_s_id}]" type="text" 
			  value="{list4_s_pts}" size="3" />
            </div></td>
            <td><div align="center">
		      <input id="js_button" style="text-align:right" name="sPts2[{list4_s_id}]" type="text" 
			  value="{list4_s_pts2}" size="3" />
		    </div></td>
	      </tr>
	      ---loop list4 end---
	    </table>
		
		<br />
		
		<table>
          <tr id="js_text">
            <td><u><B>Emplaced</B></u></td>
            <td><u><B>Kill Pts</B></u></td>
            <td><u><B>Multi-Kill Pts</B></u></td>
          </tr>
	      ---loop list5 start---
	      <tr id="js_text">
	        <td>{list5_s_name}</td>
            <td><div align="center">
              <input id="js_button" style="text-align:right" name="sPts[{list5_s_id}]" type="text" 
			  value="{list5_s_pts}" size="3" />
            </div></td>
            <td><div align="center">
		      <input id="js_button" style="text-align:right" name="sPts2[{list5_s_id}]" type="text" 
			  value="{list5_s_pts2}" size="3" />
		    </div></td>
	      </tr>
	      ---loop list5 end---
	    </table>
	  </td>
    </tr>
    <tr id="js_text">
      <td colspan="8">&nbsp;</td>
    </tr>
    <tr id="js_text">
      <td colspan="8"><div align="center">
        <input name="edit_rating" type="submit" id="js_button" value="Update Rating System">
      </div></td>
    </tr>
  </table>
</form>
---section weapon end---