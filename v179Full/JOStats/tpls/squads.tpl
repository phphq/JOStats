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

<table id="js_header">
  <tr>
	<td>Squad List</td>
  </tr>
</table>
 
<br />

<span id="js_multiList">{multiList}</span>

<br />
  
<table width="630" id="js_table">
  <tr id="js_tableHead">
	<td width="15">&nbsp;</td>
	<td width="32"><div align="center">Logo</div></td>
	<td width="120">Squad Name</td>
	<td align="center">Tag</td>
	<td align="center">Kills</td>
	<td align="center">Deaths</td>
	<td align="center">Ratio</td>
	<td align="center">Players</td>
	<td align="center">Date Added</td>
  </tr>
  {squadList}
</table>

<span id="js_multiList">{multiList}</span>

<br />
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
<table id="js_menu">
  <tr>
    <td id="js_menu2"><img src="./logos/{logo}" alt="{name}" name="{name}" width="100px" id="{name}" /></td>
    <td id="js_menu2"><div align="center">
      <table id="js_text">
        <tr>
          <td>Website:</td>
          <td><a href="{url}" target="_blank">{url}</a></td>
        </tr>
        <tr>
          <td valign="top">Info:</td>
          <td>{info}</td>
        </tr>
      </table>
    </div></td>
  </tr>
</table>
<br />

<form id="js_menu" method="get" action="{formAction}">
  <input type="hidden" name="section" value="{section}" />
  <input type="hidden" name="sqid" value="{sqid}" />
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
   <input type="hidden" name="sqid" value="{sqid}" />
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

<table width="600px">
  <tr>
    <td valign="top"><table>
      <tr id="js_tableHead">
        <td>General Stats</td>
        <td><div align="center">Total</div></td>
        <td><div align="center">Per Player</div></td>
        <td width="140px"><div align="center"></div></td>
      </tr>
      <tr id="js_row2">
        <td align="left">Assists</td>
        <td align="right">{assists}</td>
        <td align="right">{assistsG}</td>
        <td>&nbsp;</td>
      </tr>
      <tr id="js_row1">
        <td align="left">Kills</td>
        <td align="right">{kills}</td>
        <td align="right">{killsG}</td>
        <td id="js_row3" align="left"><img src="./tpls/grad1.png" height="11px" width="140px" alt="" /></td>
      </tr>
      <tr id="js_row2">
        <td align="left">Headshots</td>
        <td align="right">{headshots}</td>
        <td align="right">{headshotsG}</td>
        <td id="js_row3" title="{headshotsPer}% of Kills" align="left">
		  <img src="./tpls/grad1.png" height="11px" width="{headshotsLen}" alt="" />
		</td>
      </tr>
      <tr id="js_row1">
        <td align="left">Sniper Kills</td>
        <td align="right">{sniperkills}</td>
        <td align="right">{sniperkillsG}</td>
        <td id="js_row3" title="{sniperKillsPer}% of Kills" align="left">
		  <img src="./tpls/grad1.png" height="11px" width="{sniperkillsLen}" alt="" />
		</td>
      </tr>
      <tr id="js_row2">
        <td align="left">Multi-Kills</td>
        <td align="right">{multiKills}</td>
        <td align="right">{multiKillsG}</td>
        <td id="js_row3" title="{multiKillsPer}% of Kills" align="left">
		  <img src="./tpls/grad1.png" height="11px" width="{multiKillsLen}" alt="" />
		</td>
      </tr>
      <tr id="js_row1">
        <td align="left">Knifings</td>
        <td align="right">{knifings}</td>
        <td align="right">{knifingsG}</td>
        <td id="js_row3" title="{knifingsPer}% of Kills" align="left">
		  <img src="./tpls/grad1.png" height="11px" width="{knifingsLen}" alt="" />
		</td>
      </tr>
      <tr id="js_row2">
        <td align="left">Times Hit</td>
        <td align="right">{timesHit}</td>
        <td align="right">{timesHitG}</td>
        <td>&nbsp;</td>
      </tr>
      <tr id="js_row1">
        <td align="left">Deaths</td>
        <td align="right">{deaths}</td>
        <td align="right">{deathsG}</td>
        <td id="js_row3" align="left"><img src="./tpls/grad2.png" height="11px" width="{deathsLen}" alt="" /></td>
      </tr>
      <tr id="js_row1">
        <td align="left">Avg Hits/Death</td>
        <td align="right">{avgHdeaths}</td>
        <td align="right">{avgHdeathsG}</td>
        <td>&nbsp;</td>
      </tr>
      <tr id="js_row2">
        <td align="left">K/D Ratio</td>
        <td align="right">{ratio}</td>
        <td align="right">{ratioG}</td>
        <td>&nbsp;</td>
      </tr>
      <tr id="js_row2">
        <td align="left">Murders</td>
        <td align="right">{murders}</td>
        <td align="right">{murdersG}</td>
        <td>&nbsp;</td>
      </tr>
      <tr id="js_row1">
        <td align="left">Suicides</td>
        <td align="right">{suicides}</td>
        <td align="right">{suicidesG}</td>
        <td id="js_row3" title="{suicidesPer}% of Deaths" align="left">
		  <img src="./tpls/grad2.png" height="11px" width="{suicidesLen}" alt="" />
		</td>
      </tr>
      <tr id="js_row2">
        <td align="left">Medic Attempt</td>
        <td align="right">{medAttempts}</td>
        <td align="right">{medAttemptsG}</td>
        <td>&nbsp;</td>
      </tr>
      <tr id="js_row1">
        <td align="left">Medic Heal</td>
        <td align="right">{medHeal}</td>
        <td align="right">{medHealG}</td>
        <td>&nbsp;</td>
      </tr>
      <tr id="js_row2">
        <td align="left">Medic Save</td>
        <td align="right">{medSave}</td>
        <td align="right">{medSaveG}</td>
        <td>&nbsp;</td>
      </tr>
      <tr id="js_row1">
        <td align="left">Revived</td>
        <td align="right">{revived}</td>
        <td align="right">{revivedG}</td>
        <td>&nbsp;</td>
      </tr>
	  <tr id="js_row1">
        <td align="left">Time Played</td>
        <td align="right">{totalTime}</td>
        <td align="right">{totalTimeG}</td>
        <td>&nbsp;</td>
      </tr>
    </table></td>
    <td valign="top"><div align="right">
	  <table width="160px">
        <tr id="js_tableHead">
          <td colspan="2">Gametype Details</td>
        </tr>
        {gametypeDetails}
      </table>
	  <br />
    </div></td>
  </tr>
  <tr>
    <td colspan="2" valign="top">
	
	<br /><br />
	<table width="630px" id="js_table">
      <tr id="js_tableHead">
        <td width="15px" colspan="11">Squad Members </td>
      </tr>
      <tr id="js_tableHead">
        <td width="15px">&nbsp;</td>
        <td width="32px"><div align="center">Rank</div></td>
        <td width="120px">Player Name</td>
        <td align="center">Kills</td>
		<td align="center">Deaths</td>
		<td align="center">Ratio</td>
        <td align="center">Assists</td>
        <td align="center">Headshots</td>
        <td align="center">Multi-Kills</td>
        <td align="center">Time</td>
      </tr>
	  ---loop list2 start---
      <tr id="{list2_class}">
    	<td><div align="right">{list2_num}</div></td>
		<td><div align="center"><img src="./ranks/{list2_rImage}" height="20px" alt="{list2_rName}" /></div></td>
		<td align="left"><a href="./?section=player_stats&pid={list2_id}">{list2_name}</a></td>
		<td align="right">{list2_kills}</td>
		<td align="right">{list2_deaths}</td>
		<td align="right">{list2_ratio}</td>
		<td align="right">{list2_assists}</td>
		<td align="right">{list2_headshots}</td>
		<td align="right">{list2_multiKills}</td>
		<td align="right">{list2_totalTime}</td>
	  </tr>
	  ---loop list2 end---
    </table></td>
  </tr>
</table>

<br />
---section details end---