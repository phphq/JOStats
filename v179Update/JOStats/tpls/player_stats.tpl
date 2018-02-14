---section stats start---
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
<br />

<table id="js_menu">
  <tr>
	<td rowspan="3" id="js_menu2">
		<img title="{rName}" name="{rName}" src="./ranks/{rImage}" width="96" alt="{rName}" />
	</td>
	<td width="60"><div align="left">Name:</div></td>
	<td><div align="left">{name}</div></td>
  </tr>
  <tr>
	<td><div align="left">Rating:</div></td>
	<td><div align="left">{rating}</div></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
	<td><div align="left">Rank:</div></td>
	<td><div align="left">{rName}</div></td>
    <td>&nbsp;</td>
  </tr>
</table>

<p id="js_header">{selcStatsType}</p>

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

<table width="600">
  <tr>
    <td colspan="3">&nbsp;</td>
  </tr>
  <tr>
    <td width="205" valign="top"><table width="160">
      <tr id="js_tableHead">
        <td colspan="2">Game Details</td>
      </tr>
      <tr>
        <td id="js_row2" width="60%" align="left">Games Played</td>
        <td id="js_row1" width="40%"><div align="right">{games}</div></td>
      </tr>
      <tr>
        <td id="js_row2" align="left">Games Won</td>
        <td id="js_row1"><div align="right">{wins}</div></td>
      </tr>
      <tr>
        <td id="js_row2" align="left">Games Lost</td>
        <td id="js_row1"><div align="right">{loses}</div></td>
      </tr>
      <tr>
        <td id="js_row2" align="left">Games Drawn</td>
        <td id="js_row1"><div align="right">{draws}</div></td>
      </tr>
      <tr>
        <td id="js_row2" align="left">Win Percentage</td>
        <td id="js_row1"><div align="right">{winPer}%</div></td>
      </tr>
    </table></td>
    <td valign="top">
      <table width="160">
        <tr id="js_tableHead">
          <td colspan="2">Gametype Details</td>
        </tr>
        {gametypeDetails}
      </table>
	</td>
    <td valign="top">
	  <div align="right">
      <table width="170">
        <tr id="js_tableHead">
          <td colspan="2">Awards Details</td>
        </tr>
        <tr>
          <td id="js_row2" align="left">Game Awards</td>
          <td id="js_row1"><div align="right">{awards}</div></td>
        </tr>
        <tr>
          <td id="js_row2" align="left">Weapon Awards</td>
          <td id="js_row1"><div align="right">{wpn_awards}</div></td>
        </tr>
        <tr>
          <td id="js_row2" align="left">Motm Awards</td>
          <td id="js_row1"><div align="right">{motm}</div></td>
        </tr>
        <tr>
          <td id="js_row2" align="left">Other Awards</td>
          <td id="js_row1"><div align="right">{others}</div></td>
        </tr>
      </table>
      </div>
	</td>
  </tr>
  <tr>
    <td colspan="2" valign="top">
	
	<br />
	
	<table>
      <tr id="js_tableHead">
        <td>General Stats</td>
        <td><div align="center">Total</div></td>
        <td><div align="center">Per Game</div></td>
        <td width="140"><div align="center"></div></td>
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
        <td id="js_row3" align="left"><img src="./tpls/grad1.png" height="11" width="{killsLen}" alt="" /></td>
      </tr>
      <tr id="js_row2">
        <td align="left">Headshots</td>
        <td align="right">{headshots}</td>
        <td align="right">{headshotsG}</td>
        <td id="js_row3" title="{headshotsPer}% of Kills" align="left">
		  <img src="./tpls/grad1.png" height="11" width="{headshotsLen}" alt="" />
		</td>
      </tr>
      <tr id="js_row1">
        <td align="left" align="left">Sniper Kills</td>
        <td align="right">{sniperkills}</td>
        <td align="right">{sniperkillsG}</td>
        <td id="js_row3" title="{sniperKillsPer}% of Kills" align="left">
		  <img src="./tpls/grad1.png" height="11" width="{sniperkillsLen}" alt="" />
		</td>
      </tr>
      <tr id="js_row2">
        <td align="left">Multi-Kills</td>
        <td align="right">{multiKills}</td>
        <td align="right">{multiKillsG}</td>
        <td id="js_row3" title="{multiKillsPer}% of Kills" align="left">
		  <img src="./tpls/grad1.png" height="11" width="{multiKillsLen}" alt="" />
		</td>
      </tr>
      <tr id="js_row1">
        <td align="left">Knifings</td>
        <td align="right">{knifings}</td>
        <td align="right">{knifingsG}</td>
        <td id="js_row3" title="{knifingsPer}% of Kills" align="left">
		  <img src="./tpls/grad1.png" height="11" width="{knifingsLen}" alt="" />
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
        <td id="js_row3" align="left"><img src="./tpls/grad2.png" height="11" width="{deathsLen}" alt="" /></td>
      </tr>
      <tr id="js_row1">
        <td align="left">Avg Hits/Death</td>
        <td align="right">{avgHdeaths}</td>
        <td align="right">{avgHdeathsG}</td>
        <td>&nbsp;</td>
      </tr>
      <tr id="js_row2">
        <td align="left">K/D Ratio </td>
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
		  <img src="./tpls/grad2.png" height="11" width="{suicidesLen}" alt="" />
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
        <td align="right">&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
	  <tr id="js_row1">
        <td align="left">Last Played</td>
        <td align="right" colspan="2">{last_played}</td>
        <td>&nbsp;</td>
      </tr>
    </table></td>
    <td valign="top"><div align="right">
	
	<br />

	  <table width="170">
        <tr id="js_tableHead">
          <td colspan="3">Gametype Levels & Rank</td>
        </tr>
        <tr>
          <td id="js_row2" width="20%" align="left">Coop</td>
          <td id="js_row1" width="40%"><div align="right">Level {COOPLevel}</div></td>
          <td id="js_row1" width="40%"><div align="right">{COOPRank}</div></td>
        </tr>
        <tr>
          <td id="js_row2" align="left">DM</td>
          <td id="js_row1"><div align="right">Level {DMLevel}</div></td>
          <td id="js_row1"><div align="right">{DMRank}</div></td>
        </tr>
        <tr>
          <td id="js_row2" align="left">TDM</td>
          <td id="js_row1"><div align="right">Level {TDMLevel}</div></td>
          <td id="js_row1"><div align="right">{TDMRank}</div></td>
        </tr>
        <tr>
          <td id="js_row2" align="left">KOTH</td>
          <td id="js_row1"><div align="right">Level {KOTHLevel}</div></td>
          <td id="js_row1"><div align="right">{KOTHRank}</div></td>
        </tr>
        <tr>
          <td id="js_row2" align="left">TKOTH</td>
          <td id="js_row1"><div align="right">Level {TKOTHLevel}</div></td>
          <td id="js_row1"><div align="right">{TKOTHRank}</div></td>
        </tr>
        <tr>
          <td id="js_row2" align="left">S&amp;D</td>
          <td id="js_row1"><div align="right">Level {SDLevel}</div></td>
          <td id="js_row1"><div align="right">{SDRank}</div></td>
        </tr>
        <tr>
          <td id="js_row2" align="left">A&amp;D</td>
          <td id="js_row1"><div align="right">Level {ADLevel}</div></td>
          <td id="js_row1"><div align="right">{ADRank}</div></td>
        </tr>
        <tr>
          <td id="js_row2" align="left">CTF</td>
          <td id="js_row1"><div align="right">Level {CTFLevel}</div></td>
          <td id="js_row1"><div align="right">{CTFRank}</div></td>
        </tr>
        <tr>
          <td id="js_row2" align="left">FB</td>
          <td id="js_row1"><div align="right">Level {FBLevel}</div></td>
          <td id="js_row1"><div align="right">{FBRank}</div></td>
        </tr>
        <tr>
          <td id="js_row2" align="left">AAS</td>
          <td id="js_row1"><div align="right">Level {AASLevel}</div></td>
          <td id="js_row1"><div align="right">{AASRank}</div></td>
        </tr>
        <tr>
          <td id="js_row2" align="left">CAC</td>
          <td id="js_row1"><div align="right">Level {CACLevel}</div></td>
          <td id="js_row1"><div align="right">{CACRank}</div></td>
        </tr>
      </table>
      
	  <br />
      
	  </div>
	</td>
  </tr>
  <tr>
    <td colspan="3" valign="top">
	  
	  <br />
	  <br />
	  
	  <table width="600">
        <tr id="js_tableHead">
          <td colspan="10">Last 5 Games</td>
        </tr>
	    <tr id="js_tableHead">
	      <td>Gametype</td>
	      <td title="Kills">Kills</td>
	      <td title="Deaths">Deaths</td>
	      <td title="Assists">Assists</td>
	      <td title="Medic Saves">Med Svs</td>
	      <td title="Headshots">Headshots</td>
	      <td title="Multi-Kills">Multi-Kills</td>
	      <td title="Knifings">Knifings</td>
	      <td title="Experienced Gained">Exp</td>
	      <td title="Finishing Position">Finished</td>
	    </tr>
	    ---loop list start---
	    <tr id="{list_class}">
          <td align="left">{list_game_type}</td>
          <td><div align="right">{list_kills}</div></td>
          <td><div align="right">{list_deaths}</div></td>
          <td><div align="right">{list_assists}</div></td>
          <td><div align="right">{list_medSave}</div></td>
          <td><div align="right">{list_headshots}</div></td>
          <td><div align="right">{list_multiKills}</div></td>
          <td><div align="right">{list_knifings}</div></td>
          <td><div align="right">{list_exp}</div></td>
          <td><div align="right">{list_finished}</div></td>
        </tr>
	    ---loop list end---
      </table>
	</td>
  </tr>
</table>

<br />
<br />
	
<table width="600">
  <tr id="js_tableHead">
    <td colspan="10">Player Records</td>
  </tr>
  <tr id="js_tableHead">
    <td>Gametype</td>
    <td title="Current Win Streak: wins in a row without losing">Cur. Win Streak</td>
    <td title="Current Lose Streak: loses in a row without winning">Cur. Lose Streak</td>
    <td title="Biggest Win Streak: wins in a row without losing">Biggest Win Streak</td>
    <td title="Biggest Lose Streak: loses in a row without winning">Biggest Lose Streak</td>
  </tr>
  ---loop list2 start---
  <tr id="{list2_class}">
    <td align="left">{list2_game_type}</td>
    <td><div align="right">{list2_wStreak}</div></td>
    <td><div align="right">{list2_lStreak}</div></td>
    <td><div align="right">{list2_hiWStreak}</div></td>
    <td><div align="right">{list2_hiLStreak}</div></td>
  </tr>
  ---loop list2 end---
</table>
	  
<br />
<br />

{joTips}
---section stats end---

---section weapons start---
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
	<td>Weapon Stats for {name} - {selcStatsType}</td>
  </tr>
</table>

<br />

<form id="js_menu" method="get" action="{formAction}">
  <input type="hidden" name="section" value="{section}" />
  <input type="hidden" name="page" value="{page}" />
  <input type="hidden" name="pid" value="{pid}" />
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
     <input type="hidden" name="page" value="{page}" />
  <input type="hidden" name="pid" value="{pid}" />
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
    <td colspan="3" width="220">Weapon Name</td>
    {headers}
    <td title="{name}'s Experience level with this weapon"><div align="center">Exp Level</div></td>
  </tr>
  ---loop list start---
  <tr id="{list_class}">
    <td>{list_num}</td>
    <td width="100"><img src="./weapons/{list_w_image}" width="100" alt="" /></td>
    <td align="left"><a href="./?section=player_weaponDetails&pid={pid}&wid={list_w_id}">{list_w_name}</a></td>
	<td><div align="right">{list_w_shotsFired}</div></td>
    <td><div align="right">{list_w_kills}</div></td>
    <td><div align="right">{list_w_headshots}</div></td>
    <td><div align="right">{list_w_multiKills}</div></td>
    <td><div align="right">{list_w_accuracy}%</div></td>
    <td><div align="right">{list_w_totalTime}</div></td>
    <td><div align="right">{list_w_exp}</td>
  </tr>
  ---loop list end---
</table>

<br />

<span id="js_multiList">{multiList}</span>

<br />
<br />

{joTips}
---section weapons end---

---section vehicles start---
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
	<td>Vehicle Stats for {name} - {selcStatsType}</td>
  </tr>
</table>

<br />

<form id="js_menu" method="get" action="{formAction}">
  <input type="hidden" name="section" value="{section}" />
  <input type="hidden" name="page" value="{page}" />
  <input type="hidden" name="pid" value="{pid}" />
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
     <input type="hidden" name="page" value="{page}" />
  <input type="hidden" name="pid" value="{pid}" />
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
    <td align="left"><a href="./?section=player_vehicleDetails&pid={pid}&vid={list_v_id}">{list_v_name}</a></td>
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
---section vehicles end---


---section maps start---
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
	<td>Map Stats for {name} - {selcStatsType}</td>
  </tr>
</table>

<br />

<form id="js_menu" method="get" action="{formAction}">
  <input type="hidden" name="section" value="{section}" />
  <input type="hidden" name="page" value="{page}" />
  <input type="hidden" name="pid" value="{pid}" />
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
     <input type="hidden" name="page" value="{page}" />
  <input type="hidden" name="pid" value="{pid}" />
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
    <td>{list_num}</td>
    <td width="75"><img src="./maps/{list_m_image}" width="75" alt="" /></td>
    <td align="left"><a href="./?section=player_mapDetails&pid={pid}&mid={list_m_id}">{list_m_name}</a></td>
	<td><div align="right">{list_m_kills}</div></td>
    <td><div align="right">{list_m_deaths}</div></td>
    <td><div align="right">{list_m_ratio}</div></td>
    <td><div align="right">{list_m_games}</div></td>
    <td><div align="right">{list_m_winPer}%</div></td>
    <td><div align="right">{list_m_totalTime}</div></td>
  </tr>
  ---loop list end---
</table>

<br />

<span id="js_multiList">{multiList}</span>

<br />
<br />

{joTips}
---section maps end---


---section mapDetails start---
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

<br>

<table id="js_header">
	<tr>
		<td>{m_name} Map Details for {name}</td>
	</tr>
</table>

<br />

<form id="js_menu" method="get" action="{formAction}">
  <input type="hidden" name="section" value="{section}" />
  <input type="hidden" name="mid" value="{mid}" />
  <input type="hidden" name="pid" value="{pid}" />
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
  <input type="hidden" name="pid" value="{pid}" />
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
        <td align="left">Sniper Kills </td>
        <td align="right">{m_sniperKills}</td>
        <td align="right">{m_sniperKillsPer}</td>
      </tr>
      <tr id="js_row2">
        <td align="left">Multi-Kills</td>
        <td align="right">{m_multiKills}</td>
        <td align="right">{m_multiKillsPer}</td>
      </tr>
      <tr id="js_row1">
        <td align="left">Knifings </td>
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
        <td id="js_row2" align="left">Win % </td>
        <td id="js_row1"><div align="right">{m_winPer}%</div></td>
      </tr>
      <tr>
        <td id="js_row2" align="left">Total Time </td>
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
        <td id="js_row2" align="left">Most Kills </td>
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

<table width="600">
  <tr id="js_tableHead">
    <td colspan="10">Last 5 Games</td>
  </tr>
  <tr id="js_tableHead">
	<td>Gametype</td>
	<td title="Kills">Kills</td>
	<td title="Deaths">Deaths</td>
	<td title="Assists">Assists</td>
	<td title="Medic Saves">Med Svs</td>
	<td title="Headshots">Headshots</td>
	<td title="Multi-Kills">Multi-Kills</td>
	<td title="Knifings">Knifings</td>
	<td title="Experienced Gained">Exp</td>
	<td title="Finishing Position">Finished</td>
  </tr>
  ---loop list start---
  <tr id="{list_class}">
    <td align="left">{list_game_type}</td>
    <td><div align="right">{list_kills}</div></td>
    <td><div align="right">{list_deaths}</div></td>
    <td><div align="right">{list_assists}</div></td>
    <td><div align="right">{list_medSave}</div></td>
    <td><div align="right">{list_headshots}</div></td>
    <td><div align="right">{list_multiKills}</div></td>
    <td><div align="right">{list_knifings}</div></td>
    <td><div align="right">{list_exp}</div></td>
    <td><div align="right">{list_finished}</div></td>
  </tr>
  ---loop list end---
</table>
	  
<br />
<br />

{joTips}
---section mapDetails end---


---section weaponDetails start---
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

<br>

<table id="js_header">
	<tr>
		<td>{w_name} Weapon Details for {name}</td>
	</tr>
</table>

<br />

<form id="js_menu" method="get" action="{formAction}">
  <input type="hidden" name="section" value="{section}" />
  <input type="hidden" name="wid" value="{wid}" />
  <input type="hidden" name="pid" value="{pid}" />
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
  <input type="hidden" name="wid" value="{wid}" />
  <input type="hidden" name="pid" value="{pid}" />
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

<table style="background-color:#202648; border-bottom:#62677f thin solid; border-top:#161b33 thin solid; 
              border-left:#62677f thin solid; border-right:#161b33 thin solid;">
  <tr>
	<td>
	  <img name="{w_name}" src="./weapons/{w_image}" alt="{w_name}" />
	</td>
  </tr>
</table>

<br /><br />

<table width="600">
  <tr>
    <td valign="top"><table width="300px">
      <tr id="js_tableHead">
        <td colspan="3">Weapon Stats</td>
      </tr>
      <tr id="js_row1">
        <td width="25%" align="left">Kills</td>
        <td width="20%" align="right">{w_kills}</td>
        <td id="js_row3" align="left"><img src="./tpls/grad1.png" height="11" width="{w_killsLen}" alt="" /></td>
      </tr>
      <tr id="js_row2">
        <td align="left">Headshots</td>
        <td align="right">{w_headshots}</td>
        <td id="js_row3" title="{w_headshotsPer}% of Kills" align="left">
		  <img src="./tpls/grad1.png" height="11" width="{w_headshotsLen}" alt="" />
		</td>
      </tr>
      <tr id="js_row1">
        <td align="left">Multi-Kills</td>
        <td align="right">{w_multiKills}</td>
        <td id="js_row3" title="{w_multiKillsPer}% of Kills" align="left">
		  <img src="./tpls/grad1.png" height="11" width="{w_multiKillsLen}" alt="" />
		</td>
      </tr>

      <tr id="js_row2">
        <td align="left">Deaths</td>
        <td align="right">{w_deaths}</td>
        <td id="js_row3" align="left"><img src="./tpls/grad2.png" height="11" width="{w_deathsLen}" alt="" /></td>
      </tr>
      <tr id="js_row1">
        <td align="left">Suicides</td>
        <td align="right">{w_suicides}</td>
        <td id="js_row3" title="{w_suicidesPer}% of Deaths" align="left">
		  <img src="./tpls/grad2.png" height="11" width="{w_suicidesLen}" alt="" />
		</td>
      </tr>
      <tr id="js_row2">
        <td align="left">Murders</td>
        <td align="right">{w_murders}</td>
        <td>&nbsp;</td>
      </tr>

    </table></td>
    <td valign="top" align="right">
	  <table width="200">
        <tr id="js_tableHead">
          <td colspan="2">Weapon Details</td>
        </tr>
        <tr>
          <td id="js_row2" align="left">K/D Ratio </td>
          <td id="js_row1"><div align="right">{w_ratio}</div></td>
        </tr>
        <tr>
          <td id="js_row2" align="left">Accuracy</td>
          <td id="js_row1"><div align="right">{w_accuracy}%</div></td>
        </tr>
        <tr>
          <td id="js_row2" align="left">Total Time </td>
          <td id="js_row1"><div align="right">{w_totalTime}</div></td>
        </tr>
      </table>
	</td>
  </tr>
</table>
	  
<br />
<br />

{joTips}
---section weaponDetails end---


---section vehicleDetails start---
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

<br>

<table id="js_header">
	<tr>
		<td>{v_name} Vehicle Details for {name}</td>
	</tr>
</table>

<br />

<form id="js_menu" method="get" action="{formAction}">
  <input type="hidden" name="section" value="{section}" />
  <input type="hidden" name="vid" value="{vid}" />
  <input type="hidden" name="pid" value="{pid}" />
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
  <input type="hidden" name="vid" value="{vid}" />
  <input type="hidden" name="pid" value="{pid}" />
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
          <td id="js_row2" align="left">K/D Ratio </td>
          <td id="js_row1"><div align="right">{v_ratio}</div></td>
        </tr>
        <tr>
          <td id="js_row2" align="left">Accuracy</td>
          <td id="js_row1"><div align="right">{v_accuracy}%</div></td>
        </tr>
        <tr>
          <td id="js_row2" align="left">Total Time </td>
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
<br />

{joTips}
---section vehicleDetails end---