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
    {headers}
  </tr>
  ---loop list start---
  <tr id="{list_class}">
    <td width="15px">{list_num}</td>
    <td width="100"><img src="./maps/{list_image}" width="100" alt="" /></td>
    <td align="left"><a href="./?section=map_details&mid={list_map}">{list_m_name}</a></td>
	<td><div align="center">{list_hiScore}</div></td>
    <td><div align="center">{list_mostKills}</div></td>
    <td><div align="center">{list_hiRatio}</div></td>
    <td><div align="center">{list_flawless}</div></td>
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
// Website       : http://www.gamers-central.com             //
// Support       : http://www.babstats.com                   //
//                                                           //
// File Name     : Maps Details Template                     //
// Module Version: {V23}                                     //
// File Version  : 1.0.2 Standalone                          //
//                                                           //
/////////////////////////////////////////////////////////////*/
-->

<br />
<br />

<form id="js_menu" method="get" action="{formAction}">
  <input type="hidden" name="section" value="{section}" />
  <input type="hidden" name="mid" value="{mid}" />
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
<input type="hidden" name="mid" value="{mid}" />
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

<br>

<table id="js_header">
	<tr>
		<td>Map Details for {m_name}</td>
	</tr>
</table>

<br />

<table style="background-color:#202648;
                                       border-bottom:#62677f thin solid;
                                       border-top:#161b33 thin solid;
						               border-left:#62677f thin solid;
						               border-right:#161b33 thin solid;">
	<tr>
		<td>
			<img name="{m_name}" src="./maps/{m_image}" width="203" alt="{m_name}" />		</td>
    </tr>
</table>

<br />
<br />

<table width="600">
  <tr>
    <td valign="top"><table>
      <tr id="js_tableHead">
        <td>Map Stats</td>
        <td width="70" align="center">Total</td>
        <td width="70" align="center">Avg/Game</td>
      </tr>
      <tr id="js_row2">
        <td align="left">Kills</td>
        <td align="right">{m_kills}</td>
        <td align="right">{m_killsPer}</td>
      </tr>
      <tr id="js_row1">
        <td align="left">Assists</td>
        <td align="right">{m_assists}</td>
        <td align="right">{m_assistsPer}</td>
      </tr>
      <tr id="js_row2">
        <td align="left">Deaths</td>
        <td align="right">{m_deaths}</td>
        <td align="right">{m_deathsPer}</td>
      </tr>
      <tr id="js_row1">
        <td align="left">Suicides</td>
        <td align="right">{m_suicides}</td>
        <td align="right">{m_suicidesPer}</td>
      </tr>
      <tr id="js_row2">
        <td align="left">Murders</td>
        <td align="right">{m_murders}</td>
        <td align="right">{m_murdersPer}</td>
      </tr>
      <tr id="js_row1">
        <td align="left">Sniper Kills</td>
        <td align="right">{m_sniperKills}</td>
        <td align="right">{m_sniperKillsPer}</td>
      </tr>
      <tr id="js_row2">
        <td align="left">Multi-Kills</td>
        <td align="right">{m_multiKills}</td>
        <td align="right">{m_multiKillsPer}</td>
      </tr>
      <tr id="js_row1">
        <td align="left">Knifings</td>
        <td align="right">{m_knifings}</td>
        <td align="right">{m_knifingsPer}</td>
      </tr>
    </table></td>
    <td valign="top" align="right"><table width="200">
      <tr id="js_tableHead">
        <td colspan="2">Map Details</td>
      </tr>
      <tr>
        <td id="js_row2" align="left">Games</td>
        <td id="js_row1"><div align="right">{m_games}</div></td>
      </tr>
      <tr>
        <td id="js_row2" align="left">Wins</td>
        <td id="js_row1"><div align="right">{m_wins}</div></td>
      </tr>
      <tr>
        <td id="js_row2" align="left">Loses</td>
        <td id="js_row1"><div align="right">{m_loses}</div></td>
      </tr>
      <tr>
        <td id="js_row2" align="left">Draws</td>
        <td id="js_row1"><div align="right">{m_draws}</div></td>
      </tr>
      <tr>
        <td id="js_row2" align="left">Win %</td>
        <td id="js_row1"><div align="right">{m_winPer}%</div></td>
      </tr>
      <tr>
        <td id="js_row2" align="left">Total Time</td>
        <td id="js_row1"><div align="right">{m_totalTime}</div></td>
      </tr>
      <tr>
        <td id="js_row2" align="left">Hi-Score</td>
        <td id="js_row1"><div align="right">{hiScore}</div></td>
      </tr>
      <tr>
        <td id="js_row2" align="left">Highest Ratio</td>
        <td id="js_row1"><div align="right">{hiRatio}</div></td>
      </tr>
      <tr>
        <td id="js_row2" align="left">Most Kills</td>
        <td id="js_row1"><div align="right">{mostKills}</div></td>
      </tr>
      <tr>
        <td id="js_row2" align="left">Flawless's</td>
        <td id="js_row1"><div align="right">{flawless}</div></td>
      </tr>
    </table></td>
  </tr>
</table>

<br />

<table width="630" id="js_table">
  <tr id="js_tableHead">
    <td align="left" colspan="11">Map Top 25 Players</td>
  </tr>
  <tr id="js_tableHead">
    <td width="15">&nbsp;</td>
    <td width="32"><div align="center">Rank</div></td>
    <td width="120">Player Name</td>
    <td align="center">Wins</td>
    <td align="center">Kills</td>
    <td align="center">Assists</td>
    <td align="center">Ratio</td>
    <td align="center">Headshots</td>
    <td align="center">Multi-Kills</td>
    <td align="center">Time</td>
  </tr>
  ---loop list2 start---
  <tr id="{list2_class}">
    <td><div align="right">{list2_num}</div></td>
    <td title="{list2_rName}: {list2_rating}"><div align="center">
	  <img src="./ranks/{list2_rImage}" height="20" alt="" /></div>
	</td>
    <td align="left"><a href="./?section=player_stats&pid={list2_id}">{list2_name}</a></td>
    <td align="right">{list2_m_wins}</td>
    <td align="right">{list2_m_kills}</td>
    <td align="right">{list2_m_assists}</td>
    <td align="right">{list2_m_ratio}</td>
    <td align="right">{list2_m_headshots}</td>
    <td align="right">{list2_m_multiKills}</td>
    <td align="right">{list2_m_totalTime}</td>
  </tr>
  ---loop list2 end---
</table>
<br />

---section details end---