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
	<td>Server List</td>
  </tr>
</table>
 
<br />
  
<table id="js_table">
  <tr id="js_tableHead">
	<td>&nbsp;</td>
	<td width="150px">Name</td>
	<td width="150px">Game Name</td>
	<td width="60px" align="center">Mod</td>
	<td>Game Type</td>
	<td>Players</td>
	<td align="center">State</td>
	<td width="20" align="center">&nbsp;</td>
  </tr>
  {serverList}
</table>

<br />
---section list end---

---section server start---
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
	<td>Server Details for {name}</td>
  </tr>
</table>

<br />

<form id="js_menu" method="get" action="{formAction}">
  <input type="hidden" name="section" value="{section}" />
  Server 
  <label>
  <select id="js_button" name="sid">
      {serverList}
  </select>
  </label>
  &nbsp;&nbsp;&nbsp;
  Page 
  <label>
  <select id="js_button" name="spage">
    <option value="0" selected="selected">Info/Details</option>
    <option value="1">Restrictions</option>
  </select>
  </label>
  &nbsp;&nbsp;&nbsp;
  <label>
  <input type="submit" id="js_button" value="Go" />
  </label>
</form>

<br />
  
<table width="600px">
  <tr>
    <td width="217px" rowspan="2" valign="top"><div align="center">
	  <table width="215px">
        <tr id="js_tableHead">
          <td align="center"><span style="color:#0066FF;">Joint Ops Team</span></td>
        </tr>
        <tr>
          <td>
			<table width="100%">
			  {jo_list}
			</table>
	      </td>
        </tr>
      </table>
	</div></td>
	<td width="217px" rowspan="2" valign="top"><div align="center">
	  <table width="215px">
        <tr id="js_tableHead">
          <td align="center"><span style="color:#FF0000;">Rebel Team</span></td>
        </tr>
        <tr>
          <td>
		    <table>
			  {rebel_list}
			</table>
		  </td>
        </tr>
      </table>
    </div></td>
    <td width="150px"><div align="center">
	  <table align="center" style="background-color:#202648; border-bottom:#62677f thin solid; border-top:#161b33 thin solid;
						           border-left:#62677f thin solid; border-right:#161b33 thin solid;">
        <tr>
          <td>
		    <p><img src="./{serverMap}" width="150" alt="" /></p>
          </td>
        </tr>
      </table>
	</div></td>
  </tr>
  <tr>
    <td><div align="center">
	  <table width="150px">
        <tr id="js_tableHead">
          <td align="center" colspan="2">Server Info/Rules</td>
        </tr>
        {serverInfo}
      </table>
	</div></td>
  </tr>
  <tr>
    <td colspan="3">&nbsp;</td>
  </tr>
</table>

<br />

<table width="600px">
  <tr>
    <td colspan="3" id="js_tableHead"><div align="center">Server Stats</div></td>
  </tr>
  <tr>
    <td valign="top"><div align="left">
      <table width="190px">
	    <tr>
          <td colspan="2" id="js_tableHead"><div align="center">Overall</div></td>
        </tr>
        <tr>
          <td width="75px" id="js_row2">Total Uptime:</td>
          <td id="js_row1"><div align="right">{totalTime}</div></td>
        </tr>
        <tr>
          <td id="js_row2">Games Hosted:</td>
          <td id="js_row1"><div align="right">{totalGames}</div></td>
        </tr>
        <tr>
          <td id="js_row2">Jo Wins :</td>
          <td id="js_row1"><div align="right">{joWins}</div></td>
        </tr>
        <tr>
          <td id="js_row2">Rebel Wins :</td>
          <td id="js_row1"><div align="right">{rebelWins}</div></td>
        </tr>
        <tr>
          <td id="js_row2">Last Active:</td>
          <td id="js_row1"><div align="right">{lastActive}</div></td>
        </tr>
      </table>
    </div></td>
    <td valign="top"><div align="center">
      <table width="140px">
        <tr>
          <td colspan="2" id="js_tableHead"><div align="center">Player Logins </div></td>
        </tr>
        <tr>
          <td width="80" id="js_row2" align="left">Today:</td>
          <td id="js_row2"><div align="right">{todays}</div></td>
        </tr>
        <tr>
          <td id="js_row2" align="left">Yesterday:</td>
          <td id="js_row2"><div align="right">{yesterdays}</div></td>
        </tr>
        <tr>
          <td id="js_row1" align="left">This Week:</td>
          <td id="js_row1"><div align="right">{this_week}</div></td>
        </tr>
        <tr>
          <td id="js_row1" align="left">Last Week:</td>
          <td id="js_row1"><div align="right">{last_week}</div></td>
        </tr>
        <tr>
          <td id="js_row2" align="left">This Month:</td>
          <td id="js_row2"><div align="right">{this_month}</div></td>
        </tr>
        <tr>
          <td id="js_row2" align="left">Last Month:</td>
          <td id="js_row2"><div align="right">{last_month}</div></td>
        </tr>
        <tr>
          <td id="js_row1" align="left">This Year:</td>
          <td id="js_row1"><div align="right">{this_year}</div></td>
        </tr>
        <tr>
          <td id="js_row1" align="left">Last Year:</td>
          <td id="js_row1"><div align="right">{last_year}</div></td>
        </tr>
      </table>
    </div></td>
    <td valign="top"><div align="right">
      <table width="200px">
        <tr>
          <td  colspan="3" id="js_tableHead"><div align="center">Gametypes<br />
            Type &nbsp;&nbsp;&nbsp;&nbsp; Games &nbsp;&nbsp;&nbsp;&nbsp; Wins
	      </div></td>
        </tr>
        <tr>
          <td id="js_row2" width="40%" align="left">Co-op Games:</td>
          <td id="js_row1" width="20%"><div align="right">{coopGames}</div></td>
          <td id="js_tableHead"><div align="center">
		    <span style="color:#0066FF;">{coopJo}</span>/<span style="color:#FF0000;">{coopRebel}</span>
		  </div></td>
        </tr>
        <tr>
          <td id="js_row2" align="left">DM Games:</td>
          <td id="js_row1"><div align="right">{dmGames}</div></td>
          <td id="js_tableHead"><div align="center"></div></td>
        </tr>
        <tr>
          <td id="js_row2" align="left">TDM Games:</td>
          <td id="js_row1"><div align="right">{tdmGames}</div></td>
          <td id="js_tableHead"><div align="center">
		    <span style="color:#0066FF;">{tdmJo}</span>/<span style="color:#FF0000;">{tdmRebel}</span>
		  </div></td>
        </tr>
        <tr>
          <td id="js_row2" align="left">KOTH Games:</td>
          <td id="js_row1"><div align="right">{kothGames} </div></td>
          <td id="js_tableHead"><div align="center">
		    <span style="color:#0066FF;">{kothJo}</span>/<span style="color:#FF0000;">{kothRebel}</span>
		  </div></td>
        </tr>
        <tr>
          <td id="js_row2" align="left">TKOTH Games:</td>
          <td id="js_row1"><div align="right">{tkothGames} </div></td>
          <td id="js_tableHead"><div align="center">
			<span style="color:#0066FF;">{tkothJo}</span>/<span style="color:#FF0000;">{tkothRebel}</span>
		  </div></td>
        </tr>
        <tr>
          <td id="js_row2" align="left">CTF Games:</td>
          <td id="js_row1"><div align="right">{ctfGames} </div></td>
          <td id="js_tableHead"><div align="center">
			<span style="color:#0066FF;">{ctfJo}</span>/<span style="color:#FF0000;">{ctfRebel}</span>
		  </div></td>
        </tr>
        <tr>
          <td id="js_row2" align="left">FB Games:</td>
          <td id="js_row1"><div align="right">{fbGames} </div></td>
          <td id="js_tableHead"><div align="center">
			<span style="color:#0066FF;">{fbJo}</span>/<span style="color:#FF0000;">{fbRebel}</span>
		  </div></td>
        </tr>
        <tr>
          <td id="js_row2" align="left">SD Games:</td>
          <td id="js_row1"><div align="right">{sdGames} </div></td>
          <td id="js_tableHead"><div align="center">
			<span style="color:#0066FF;">{sdJo}</span>/<span style="color:#FF0000;">{sdRebel}</span>
		  </div></td>
        </tr>
        <tr>
          <td id="js_row2" align="left">AD Games:</td>
          <td id="js_row1"><div align="right">{adGames} </div></td>
          <td id="js_tableHead"><div align="center">
			<span style="color:#0066FF;">{adJo}</span>/<span style="color:#FF0000;">{adRebel}</span>
		  </div></td>
        </tr>
        <tr>
          <td id="js_row2" align="left">AAS Games:</td>
          <td id="js_row1"><div align="right">{aasGames} </div></td>
          <td id="js_tableHead"><div align="center">
			<span style="color:#0066FF;">{aasJo}</span>/<span style="color:#FF0000;">{aasRebel}</span>
		  </div></td>
        </tr>
        <tr>
          <td id="js_row2" align="left">CAC Games:</td>
          <td id="js_row1"><div align="right">{cacGames} </div></td>
          <td id="js_tableHead"><div align="center">
			<span style="color:#0066FF;">{cacJo}</span>/<span style="color:#FF0000;">{cacRebel}</span>
		  </div></td>
        </tr>
      </table>
    </div></td>
  </tr>
</table>
 
<br />
---section server end---

---section restrictions start---
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
	<td>Server Restrictions for {name}</td>
  </tr>
</table>

<br />

<form id="js_menu" method="get" action="{formAction}">
  <input type="hidden" name="section" value="{section}" />
  Server 
  <select id="js_button" name="sid">

      {serverList}
  </select>
  &nbsp;&nbsp;&nbsp;
  Page 
  <select id="js_button" name="spage">
    <option value="0">Info/Details</option>
    <option value="1" selected="selected">Restrictions</option>
  </select>
  &nbsp;&nbsp;&nbsp;
  <input type="submit" id="js_button" value="Go" />
</form>

<br />
<table width="600px">
  <tr>
    <td valign="top"><div align="left">
      <table width="190px">
        <tr>
          <td id="js_tableHead" colspan="2"><div align="center">Class Restrictions</div></td>
        </tr>
        {clsRestrictions}
      </table>
    </div></td>
    <td valign="top"><div align="center">
      <table width="190px">
        <tr>
          <td id="js_tableHead" colspan="2"><div align="center">Weapon Restrictions</div></td>
        </tr>
        {wpnRestrictions}
      </table>
    </div></td>
    <td valign="top"><div align="right">
      <table width="190px">
        <tr>
          <td id="js_tableHead" colspan="2"><div align="center">Weapon Restrictions</div></td>
        </tr>
        {wpnRestrictions2}
      </table>
    </div></td>
  </tr>
</table>


<br />
---section restrictions end---