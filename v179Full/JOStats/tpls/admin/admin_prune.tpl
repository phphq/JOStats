---section begin start---
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

<u><b>Prune Players</b></u>

<br />
<br />

<table width="500px">
  <tr  id="js_text">
    <td><div align="center" style="color:#FF0000;">{error}{msg}</div></td>
  </tr>
</table>

<br />

<form id="js_button" method="post" action="?section=prune">
<table width="400px" id="js_border">
  <tr id="js_text">
    <td colspan="2"><u><b>Prune Options</b></u></td>
  </tr>
  <tr id="js_text">
    <td width="200"><div align="right">With less than: </div></td>
    <td><div align="left">
        <input name="killsNum" type="text" id="killsNum" size="3" />
		&nbsp;Kills.
      </div></td>
  </tr>
  <tr id="js_text">
    <td><div align="right">With less time than: </div></td>
    <td><div align="left">
      <input name="timeNum" type="text" id="timeNum" size="3" />
	  &nbsp;Hours play time.
    </div></td>
  </tr>
  <tr id="js_text">
    <td><div align="right">Haven't played for:</div></td>
    <td><div align="left">
      <input name="daysNum" type="text" id="daysNum" size="3" />
	  &nbsp;Days.
    </div></td>
  </tr>
  <tr id="js_text">
    <td><div align="right"></div></td>
    <td><div align="left"></div></td>
  </tr>
  <tr id="js_text">
    <td><div align="right">Don't prune if assigned to a squad: </div></td>
    <td><div align="left">
      <input name="squadChk" type="checkbox" id="squadChk" value="1" />
    </div></td>
  </tr>
  <tr id="js_text">
    <td><div align="right"></div></td>
    <td><div align="left"></div></td>
  </tr>
  <tr id="js_text">
    <td colspan="2">
      <div align="center"><input name="proceed" type="submit" id="js_button" value="Proceed" />
      </div>
	</td>
  </tr>
  <tr id="js_text">
    <td colspan="2" align="center">
		<br />
		***Fields left blank will be ignored!***
		<br /><br />
		After Clicking proceed, you will be presented with a summary of your options 
		and the effect they will have on the database before the actual prunning takes 
		place.
	</td>
  </tr>
</table>
</form>
---section begin end---

---section proceed start---
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

<u><b>Prune Players</b></u>

<br />
<br />

<table width="500px">
  <tr  id="js_text">
    <td><div align="center" style="color:#FF0000;">{error}{msg}</div></td>
  </tr>
</table>

<br />

<form id="js_button" method="post" action="?section=prune">
<table width="400px" id="js_border">
  <tr id="js_text">
    <td width="200"><u><b>Prune Options</b></u></td>
  </tr>
  <tr id="js_text">
    <td>
		<br />
		The options you chose for prunning are as follows:
		<br /><br />
		{pruneOptions}
		<br /><br />
		<div align="center">
		  <input type="hidden" name="killsNum" value="{killsNum}" />
      <input type="hidden" name="timeNum" value="{timeNum}" />
      <input type="hidden" name="daysNum" value="{daysNum}" />
      <input type="hidden" name="squadChk" value="{squadChk}" />
		  <input name="prune" type="submit" id="js_button" value="Prune" />
		  <br /><br />
		  ***Remember, clicking "Prune" now cannot be undone!***
		</div>
	</td>
  </tr>
</table>
</form>
---section proceed end---

---section prune start---
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

<u><b>Prune Players</b></u>

<br />
<br />

<table width="500px">
  <tr  id="js_text">
    <td><div align="center" style="color:#FF0000;">{error}{msg}</div></td>
  </tr>
</table>

<br />

<form id="js_button" method="post" action="?section=prune">
<table width="400px" id="js_border">
  <tr id="js_text">
    <td width="200"><u><b>Prune Options</b></u></td>
  </tr>
  <tr id="js_text">
    <td>
		<br />
		The options you chose for prunning are as follows:
		<br /><br />
		{pruneOptions}
		<br /><br />
		<div align="center">
		  <input name="prune" type="submit" id="js_button" value="Prune" />
		  <br /><br />
		  ***Remember, clicking "Prune" now cannot be undone!***
		</div>
	</td>
  </tr>
</table>
</form>
---section prune end---