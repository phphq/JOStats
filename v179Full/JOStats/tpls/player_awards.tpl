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
<table>
  <tr>
    <td id="js_menu">
	  Player Stats =&gt; 
		<a href="./?section=player_stats&pid={pid}">General</a> - 
		<a href="./?section=player_weapons&pid={pid}">Weapons</a> - 
		<a href="./?section=player_vehicles&pid={pid}">Vehicles</a> - 
		<a href="./?section=player_maps&pid={pid}">Maps</a> - 
		<a href="./?section=player_awards&pid={pid}">Awards</a>
	</td>
  </tr>
</table>

<br />

<table id="js_header">
  <tr>
	<td>Game Awards for {name}</td>
  </tr>
</table>

<br />

<form id="js_menu" method="get" action="{formAction}">
  <input type="hidden" name="section" value="{section}" />
  <input type="hidden" name="pid" value="{pid}" />
  <select id="js_button" name="awt">
    <option value="game" selected="selected">Game Awards</option>
    <option value="weapon">Weapon Awards</option>
  </select>
  &nbsp;
  <input type="submit" id="js_button" value="Go" />
</form>

<br />

<table width="650">
  {awardList}
</table>

<br />
<br />

{joTips}
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
// File Name     : Player Weapon Awards Template             //
// Module Version: {V20}                                     //
// File Version  : 1.0.1 Standalone                          //
//                                                           //
/////////////////////////////////////////////////////////////*/
-->

<table>
  <tr>
    <td id="js_menu">
	  Player Stats =&gt; 
		<a href="./?section=player_stats&pid={pid}">General</a> - 
		<a href="./?section=player_weapons&pid={pid}">Weapons</a> - 
		<a href="./?section=player_vehicles&pid={pid}">Vehicles</a> - 
		<a href="./?section=player_maps&pid={pid}">Maps</a> - 
		<a href="./?section=player_awards&pid={pid}">Awards</a>
	</td>
  </tr>
</table>

<br />

<table id="js_header">
  <tr>
	<td>Weapon Awards for {name}</td>
  </tr>
</table>

<br />

<form id="js_menu" method="get" action="{formAction}"> 
  <input type="hidden" name="section" value="{section}" />
  <input type="hidden" name="pid" value="{pid}" />
  <select id="js_button" name="awt">
    <option value="game">Game Awards</option>
    <option value="weapon" selected="selected">Weapon Awards</option>
  </select>
  &nbsp;
  <input type="submit" id="js_button" value="Go" />
</form>

<br />

<table width="650">
  {awardList}
</table>

<br />
---section weapon end---