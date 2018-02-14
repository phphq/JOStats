---section start start---
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
/*/////////////////////////////////////////////////////////////
//                                                           //
// Updated Dec 2016 By Novahq.net <scott@novahq.net>         //
// Standalone, PHP 5.6+ Compatible                           //
//                                                           //
/////////////////////////////////////////////////////////////*/
-->
<br />

<table id="js_header">
  <tr>
	<td>Compare Player Stats</td>
  </tr>
</table>
 
<br />

<form id="js_menu2" method="get" action="{formAction}">
  <input type="hidden" name="section" value="{section}" />
  Player 1: 
  <input name="player1" id="js_button" type="text" value="{player1}" />
  &nbsp;Player 2: 
  <input name="player2" id="js_button" type="text" value="{player2}" />
  &nbsp;
  <input type="submit" id="js_button" name="Submit" value="Go" />
</form> 

<br />

{error}

<br/>
---section start end---

---section compare start---
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

<table id="js_header">
  <tr>
	<td>
	  Comparing Player Stats of 
	  <span style="color:#0066FF; font-weight:bold;">{first_p_name}</span> 
	  and 
	  <span style="color:#FF0000; font-weight:bold;">{second_p_name}</span>
	</td>
  </tr>
</table>
 
<br />

<form id="js_menu" method="get" action="{formAction}">

  <input type="hidden" name="player1" type="text" value="{player1}" />
  <input type="hidden" name="player2" type="text" value="{player2}" />

  <input type="hidden" name="section" value="{section}" />
  Team: 
  <select id="js_button" name="condTeam">
    {teamList}
  </select>
  &nbsp;Gametype: 
  <select id="js_button" name="condGame">
    {gtypeList}
  </select>
  &nbsp;Server: 
  <select id="js_button" name="condServer">
    {serverList}
  </select>
  &nbsp;
  <input type="hidden" name="condStats" value="{condStats}" />
  <input id="js_button" type="submit" value="Go" />
</form>

<br />
 
<table width="600px">
   <tr>
     <td valign="top"><table width="250px">
       <tr>
         <td colspan="3" id="js_tableHead">General Stats</td>
       </tr>
       <tr id="js_tableHead">
         <td>Stat</td>
         <td><div align="center" style="color:#0066FF; font-weight:bold;">{first_p_name}</div></td>
         <td><div align="center" style="color:#FF0000; font-weight:bold;">{second_p_name}</div></td>
       </tr>
       {stats}
     </table></td>
     <td valign="top"><div align="right">
       <table width="250px">
          <tr>
            <td colspan="3" id="js_tableHead">Game Details</td>
          </tr>
          <tr id="js_tableHead">
            <td>Detail</td>
            <td><div align="center" style="color:#0066FF; font-weight:bold;">{first_p_name}</div></td>
            <td><div align="center" style="color:#FF0000; font-weight:bold;">{second_p_name}</div></td>
          </tr>
         {details}
       </table>
	   
	   <br />
	   
     </div></td>
   </tr>
 </table>
 
 <br />
 <br />
---section compare end---