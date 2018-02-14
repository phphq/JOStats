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
---section begin start---
<br />

<table id="js_menu">
  <tr>
	<td>JOStats Installation</td>
  </tr>
</table>
 
<br />
  
<table width="400px" id="js_menu">
  <tr>
    <td align="left">
	  Thank you for downloading JOStats.<br /><br />
	  
	  The next few steps will help you install and setup JOStats to begin 
	  recording stats for your Joint Operations: Escalation game.<br /><br />
	  Please note:<br />
	  &nbsp;&nbsp; - JOStats requires PHP and a MYSQL database.<br /><br />
	  &nbsp;&nbsp; - This is the Standalone version.<br />
	  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Please check 
	  <a href="javascript:;" onclick="javascript:alert('http://www.babstats.com (Navigation may contain virus...)');">
	  www.babstats.com</a> for other versions.<br />
	  <br />
	  <br />
    </td>
  </tr>
  <tr>
    <td>
	  <form method="post" action="{formAction}&sub=begin">
	    <input name="begin" type="submit" id="js_button" value="Begin" />
      </form>
	  <br />
	</td>
  </tr>
</table>

<br />
---section begin end---


---section install start---
<br />

<table id="js_menu">
  <tr>
	<td>JOStats Installation - Step 1</td>
  </tr>
</table>
 
<br />
  
<table width="400px" id="js_menu">
  <tr>
    <td align="left">
	  Clicking 'Install Database' will install the database tables and preset 
	  data into your mysql database that JOStats needs to work correctly.
	  
	  <br />
	  <br />
    </td>
  </tr>
  <tr>
    <td>
	  <form method="post" action="{formAction}&sub=install">
	    <input name="installDB" type="submit" id="js_button" value="Install Database" />
      </form>
	  <br />
	</td>
  </tr>
</table>

<br />
---section install end---


---section dbFailed start---
<br />

<table id="js_menu">
  <tr>
	<td>JOStats Installation - Step 1</td>
  </tr>
</table>
 
<br />
  
<table width="400px" id="js_menu">
  <tr>
    <td align="left">
	  Database Install Failed
	  
	  <br /><br />
	  
	  Note:<br />
	  &nbsp;&nbsp; - Please make sure you have inserted your database details into the<br />
	  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;config.php before clicking 'Install Database'.
	  <br />
	  <br />
    </td>
  </tr>
  <tr>
    <td>
	  <form method="post" action="{formAction}&sub=install">
	    <input name="installDB" type="submit" id="js_button" value="Install Database" />
      </form>
	  <br />
	</td>
  </tr>
</table>

<br />
---section dbFailed end---


---section dbSuccess start---
<br />

<table id="js_menu">
  <tr>
	<td>JOStats Installation - Step 2</td>
  </tr>
</table>
 
<br />
  
<table width="400px" id="js_menu">
  <tr>
    <td>
	  Database Installalation Successful!
	</td>
  </tr>
  <tr>
	<td align="left">
	  <br />
	  Here you can set some display options for the stats pages.
	  <br />
	  <br />
	</td>
  </tr>
  <tr>
    <td align="center">
      <form method="post" action="{formAction}&sub=saveSettings">
	  <table width="240px">
        <tr>
          <td width="161px" id="js_boxleft">Players to show per Page:</td>
          <td id="js_boxright"><input name="plyrShow" type="text" id="js_button" value="20" size="2" />
          </td>
        </tr>
        <tr>
          <td id="js_boxleft">Maps to show per Page:</td>
          <td id="js_boxright"><input name="mapShow" type="text" id="js_button" value="10" size="2" />
          </td>
        </tr>
        <tr>
          <td id="js_boxleft">Weapons to show per Page:</td>
          <td id="js_boxright"><input name="wpnShow" type="text" id="js_button" value="10" size="2" />
          </td>
        </tr>
		<tr>
          <td id="js_boxleft">Vehicles to show per Page:</td>
          <td id="js_boxright"><input name="vehShow" type="text" id="js_button" value="10" size="2" />
          </td>
        </tr>
		<tr>
          <td id="js_boxleft">Squads to show per Page:</td>
          <td id="js_boxright"><input name="squadShow" type="text" id="js_button" value="10" size="2" />
          </td>
        </tr>
        <tr>
          <td colspan="2" align="center">
		    <br />
			<input name="saveSettings" type="submit" id="js_button" value="Save Settings" />
          </td>
        </tr>
      </table>
	  </form>
	</td>
  </tr>
  <tr>
    <td>
	  <br />
	</td>
  </tr>
</table>

<br />
---section dbSuccess end---


---section saveSettings start---
<br />

<table id="js_menu">
  <tr>
	<td>JOStats Installation - Step 3</td>
  </tr>
</table>
 
<br />
  
<table width="450px" id="js_menu">
  <tr>
    <td>
	  Installation Complete!
	</td>
  </tr>
  <tr>
	<td align="left">
	  <br />
	  Before Continuing, please do the following:
	  <br /><br />
	  &nbsp;&nbsp; - Delete the 'install' folder, not deleting this can result in someone <br />
	  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;else reactivating the install procedure and you loosing all the data <br />
	  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;in the database for the stats.<br />
	  <br />
	  
	  <br />
	  What to do next:
	  <br /><br />
	  &nbsp;&nbsp; - Login into the JOStats admninistration section and click 'servers'. <br />
	  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Then add a server and server ID code, but remember the server <br />
	  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ID, as you will need it for the 'Babstats Multi-Tracker'.<br />
	  <br />
	</td>
  </tr>
  <tr>
    <td align="center">
      <form method="post" action="{formAction}">
		<input name="complete" type="submit" id="js_button" value="Continue" />	
	  </form>
	</td>
  </tr>
  <tr>
    <td>
	  <br />
	</td>
  </tr>
</table>

<br />
---section saveSettings end---