---section list start---
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
<br />

<form id="js_menu" method="get" action="{formAction}">
 <input type="hidden" name="section" value="{section}" />
  Stats: 
  <select id="js_button" name="condStats">
    {statsType}
  </select>
  &nbsp;
  <input type="hidden" name="condTeam" value="{condTeam}" />
  <input type="hidden" name="condServer" value="{condServer}" />
  <input type="hidden" name="condGame" value="{condGame}" />
  <input type="submit" id="js_button" value="Go" />
</form>

<form id="js_menu" method="get" action="{formAction}">
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

<span id="js_multiList">{multiList}</span>

<br />
<br />

<table width="650" id="js_table">
  <tr id="js_tableHead">
    <td colspan="3" width="220">&nbsp;</td>
    <td colspan="3" align="center">Kills</td>
    <td>&nbsp;</td>
  </tr>
  <tr id="js_tableHead">
    <td colspan="3" width="220">Vehicle Name</td>
    {headers}
  </tr>
  ---loop list start---
  <tr id="{list_class}">
    <td>{list_num}</td>
    <td width="100"><img src="./vehicles/{list_v_image}" width="100" alt="" /></td>
    <td align="left"><a href="./?section=vehicle_details&vid={list_v_id}">{list_v_name}</a></td>
	<td><div align="right">{list_v_runover}</div></td>
    <td><div align="right">{list_v_passenger}</div></td>
    <td><div align="right">{list_v_gunner}</div></td>
    <td><div align="right">{list_v_totalTime}</div></td>
  </tr>
  ---loop list end---
</table>

<br />

<span id="js_multiList">{multiList}</span>

<br />
<br />

{joTips}
---section list end---


---section details start---
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
<br />

<form id="js_menu" method="get" action="{formAction}">
  <input type="hidden" name="section" value="{section}" />
  Stats: 
  <select id="js_button" name="condStats">
    {statsType}
  </select>
  &nbsp;
  <input type="hidden" name="condTeam" value="{condTeam}" />
  <input type="hidden" name="condServer" value="{condServer}" />
  <input type="hidden" name="condGame" value="{condGame}" />
  <input type="submit" id="js_button" value="Go" />
</form>

<form id="js_menu" method="get" action="{formAction}">
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

<table id="js_header">
	<tr>
		<td>Vehicle Details for {v_name}</td>
	</tr>
</table>

<br>

<table style="background-color:#202648; border-bottom:#62677f thin solid; border-top:#161b33 thin solid; 
              border-left:#62677f thin solid; border-right:#161b33 thin solid;">
  <tr>
	<td>
	  <img name="{v_name}" src="./vehicles/{v_image}" alt="{v_name}" />
	</td>
  </tr>
</table>

<br /><br />

<table width="600">
  <tr>
    <td valign="top"><table width="300px">
      <tr id="js_tableHead">
        <td colspan="3">Vehicle Stats</td>
      </tr>
      <tr id="js_row1">
        <td width="25%" align="left">Kills</td>
        <td width="20%" align="right">{v_kills}</td>
        <td id="js_row3" align="left"><img src="./tpls/grad1.png" height="11" width="{v_killsLen}" alt="" /></td>
      </tr>
      <tr id="js_row2">
        <td align="left">Headshots</td>
        <td align="right">{v_headshots}</td>
        <td id="js_row3" title="{v_headshotsPer}% of Kills" align="left">
		  <img src="./tpls/grad1.png" height="11" width="{v_headshotsLen}" alt="" />
		</td>
      </tr>
      <tr id="js_row1">
        <td align="left">Multi-Kills</td>
        <td align="right">{v_multiKills}</td>
        <td id="js_row3" title="{v_multiKillsPer}% of Kills" align="left">
		  <img src="./tpls/grad1.png" height="11" width="{v_multiKillsLen}" alt="" />
		</td>
      </tr>

      <tr id="js_row2">
        <td align="left">Deaths</td>
        <td align="right">{v_deaths}</td>
        <td id="js_row3" align="left"><img src="./tpls/grad2.png" height="11" width="{v_deathsLen}" alt="" /></td>
      </tr>
      <tr id="js_row1">
        <td align="left">Suicides</td>
        <td align="right">{v_suicides}</td>
        <td id="js_row3" title="{v_suicidesPer}% of Deaths" align="left">
		  <img src="./tpls/grad2.png" height="11" width="{v_suicidesLen}" alt="" />
		</td>
      </tr>
      <tr id="js_row2">
        <td align="left">Murders</td>
        <td align="right">{v_murders}</td>
        <td>&nbsp;</td>
      </tr>

    </table></td>
    <td valign="top" align="right">
	  <table width="200">
        <tr id="js_tableHead">
          <td colspan="2">Weapon Details</td>
        </tr>
        <tr>
          <td id="js_row2" align="left">K/D Ratio</td>
          <td id="js_row1"><div align="right">{v_ratio}</div></td>
        </tr>
        <tr>
          <td id="js_row2" align="left">Accuracy</td>
          <td id="js_row1"><div align="right">{v_accuracy}%</div></td>
        </tr>
        <tr>
          <td id="js_row2" align="left">Total Time</td>
          <td id="js_row1"><div align="right">{v_totalTime}</div></td>
        </tr>
      </table>
	</td>
  </tr>
</table>

<br />

<table width="600" id="js_table">
  <tr id="js_tableHead">
    <td width="80">&nbsp;</td>
    <td>Kills</td>
    <td>H-Shots</td>
    <td>M-Kills</td>
    <td>Accuracy</td>
    <td>Deaths</td>
    <td>Murders</td>
    <td>Suicides</td>
    <td>Ratio</td>
    <td>Time Used</td>
  </tr>
  ---loop list start---
  <tr id="{list_class}">
    <td align="left">{list_attach}</td>
    <td><div align="right">{list_v_kills}</div></td>
    <td><div align="right">{list_v_headshots}</div></td>
    <td><div align="right">{list_v_multiKills}</div></td>
    <td><div align="right">{list_v_accuracy}%</div></td>
    <td><div align="right">{list_v_deaths}</div></td>
    <td><div align="right">{list_v_murders}</div></td>
    <td><div align="right">{list_v_suicides}</div></td>
    <td><div align="right">{list_v_ratio}</div></td>
    <td><div align="right">{list_v_totalTime}</div></td>
  </tr>
  ---loop list end---
</table>

<br />

<table width="630" id="js_table">
  <tr id="js_tableHead">
    <td width="15" colspan="11">Weapon Top 25 Players</td>
  </tr>
  <tr id="js_tableHead">
    <td width="15">&nbsp;</td>
    <td width="32"><div align="center">Rank</div></td>
    <td width="120">Player Name</td>
    <td align="center">Kills</td>
    <td align="center">Deaths</td>
    <td align="center">Ratio</td>
    <td align="center">Headshots</td>
    <td align="center">Multi-Kills</td>
	<td align="center">Assists</td>
    <td align="center">Time</td>
  </tr>
  ---loop list2 start---
  <tr id="{list2_class}">
    <td><div align="right">{list2_num}</div></td>
    <td title="{list2_rName}: {list2_rating}"><div align="center">
	  <img src="./ranks/{list2_rImage}" height="20" alt="" /></div>
	</td>
    <td align="left"><a href="./?section=player_stats&pid={list2_id}">{list2_name}</a></td>
    <td align="right">{list2_v_kills}</td>
    <td align="right">{list2_v_deaths}</td>
    <td align="right">{list2_v_ratio}</td>
    <td align="right">{list2_v_headshots}</td>
    <td align="right">{list2_v_multiKills}</td>
	<td align="right">{list2_v_assists}</td>
    <td align="right">{list2_v_totalTime}</td>
  </tr>
  ---loop list2 end---
</table>

<br />
<br />

{joTips}
---section details end---