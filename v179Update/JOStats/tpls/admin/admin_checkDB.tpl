---section main start---
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

<u><b>Database Checker</b></u>

<br />
<br />

<table width="500px" id="js_border">
  <tr>
    <td>
	  <div align="center">
		<form method="post" action="{formAction}">
		<table width="400px" id="js_border">
          <tr>
            <td colspan="2"><div align="center"><u>Database</u> Options </div></td>
          </tr>
          <tr>
            <td width="50%"><div align="right">Check Database</div></td>
            <td><input name="check" type="submit" id="js_button" value="Go" /></td>
          </tr>
          <tr>
            <td><div align="right">Analyze Database</div></td>
            <td><input name="analyze" type="submit" id="js_button" value="Go" /></td>
          </tr>
          <tr>
            <td><div align="right">Optimize Database</div></td>
            <td><input name="optimize" type="submit" id="js_button" value="Go" /></td>
          </tr>
          <tr>
            <td><div align="right">Repair Database</div></td>
            <td><input name="repair" type="submit" id="js_button" value="Go" /></td>
          </tr>
        </table>
		</form>
	  </div>
	</td>
  </tr>
</table>
---section main end---


---section check start---
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
// File Name     : Admin Check Database Template             //
// File Version  : 1.0.0 Standalone                          //
//                                                           //
/////////////////////////////////////////////////////////////*/
-->

<br />

<u><b>Database Checker</b></u>

<br />
<br />

<table width="500px" id="js_border">
  <tr>
    <td>
	  <div align="center">
		<form id="form1" name="form1" method="post" action="{formAction}">
		<table width="400px" id="js_border">
          <tr>
            <td colspan="2"><div align="center"><u>Database Options</u></div></td>
          </tr>
          <tr>
            <td><div align="right">Check Database</div></td>
            <td><input name="check" type="submit" id="js_button" value="Go" /></td>
          </tr>
          <tr>
            <td><div align="right">Analyze Database</div></td>
            <td><input name="analyze" type="submit" id="js_button" value="Go" /></td>
          </tr>
          <tr>
            <td><div align="right">Optimize Database</div></td>
            <td><input name="optimize" type="submit" id="js_button" value="Go" /></td>
          </tr>
          <tr>
            <td width="50%"><div align="right">Repair Database</div></td>
            <td><input name="repair" type="submit" id="js_button" value="Go" /></td>
          </tr>
        </table>
		
		<br />
		
		<table width="400px" id="js_border">
          <tr>
            <td colspan="2"><div align="center"><b><u>Check Database Results</u></b></div></td>
          </tr>
		  {result}
        </table>
		</form>
	  </div>
	</td>
  </tr>
</table>
---section check end---

---section analyze start---
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
// File Name     : Admin Check Database Template             //
// File Version  : 1.0.0 Standalone                          //
//                                                           //
/////////////////////////////////////////////////////////////*/
-->

<br />

<u><b>Database Checker</b></u>

<br />
<br />

<table width="500px" id="js_border">
  <tr>
    <td>
	  <div align="center">
		<form method="post" action="{formAction}">
		<table width="400px" id="js_border">
          <tr>
            <td colspan="2"><div align="center"><u>Database Options</u></div></td>
          </tr>
          <tr>
            <td width="50%"><div align="right">Check Database</div></td>
            <td><input name="check" type="submit" id="js_button" value="Go" /></td>
          </tr>
          <tr>
            <td><div align="right">Analyze Database</div></td>
            <td><input name="analyze" type="submit" id="js_button" value="Go" /></td>
          </tr>
          <tr>
            <td><div align="right">Optimize Database</div></td>
            <td><input name="optimize" type="submit" id="js_button" value="Go" /></td>
          </tr>
          <tr>
            <td><div align="right">Repair Database</div></td>
            <td><input name="repair" type="submit" id="js_button" value="Go" /></td>
          </tr>
        </table>
		
		<br />
		
		<table width="400px" id="js_border">
          <tr>
            <td colspan="2"><div align="center"><b><u>Analyze Database Results</u></b></div></td>
          </tr>
		  {result}
        </table>
		</form>
	  </div>
	</td>
  </tr>
</table>
---section analyze end---



---section optimize start---
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
// File Name     : Admin Check Database Template             //
// File Version  : 1.0.0 Standalone                          //
//                                                           //
/////////////////////////////////////////////////////////////*/
-->

<br />

<u><b>Database Checker</b></u>

<br />
<br />

<table width="500px" id="js_border">
  <tr>
    <td>
	  <div align="center">
		<form method="post" action="{formAction}">
		<table width="400px" id="js_border">
          <tr>
            <td colspan="2"><div align="center"><u>Database Options</u></div></td>
          </tr>
          <tr>
            <td width="50%"><div align="right">Check Database</div></td>
            <td><input name="check" type="submit" id="js_button" value="Go" /></td>
          </tr>
          <tr>
            <td><div align="right">Analyze Database</div></td>
            <td><input name="analyze" type="submit" id="js_button" value="Go" /></td>
          </tr>
          <tr>
            <td><div align="right">Optimize Database</div></td>
            <td><input name="optimize" type="submit" id="js_button" value="Go" /></td>
          </tr>
          <tr>
            <td><div align="right">Repair Database</div></td>
            <td><input name="repair" type="submit" id="js_button" value="Go" /></td>
          </tr>
        </table>
		
		<br />
		
		<table width="400px" id="js_border">
          <tr>
            <td colspan="2"><div align="center"><b><u>Optimize Database Results</u></b></div></td>
          </tr>
		  {result}
        </table>
		</form>
	  </div>
	</td>
  </tr>
</table>
---section optimize end---



---section repair start---
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
// File Name     : Admin Check Database Template             //
// File Version  : 1.0.0 Standalone                          //
//                                                           //
/////////////////////////////////////////////////////////////*/
-->

<br />

<u><b>Database Checker</b></u>

<br />
<br />

<table width="500px" id="js_border">
  <tr>
    <td>
	  <div align="center">
		<form method="post" action="{formAction}">
		<table width="400px" id="js_border">
          <tr>
            <td colspan="2"><div align="center"><u>Database Options</u></div></td>
          </tr>
          <tr>
            <td width="50%"><div align="right">Check Database</div></td>
            <td><input name="check" type="submit" id="js_button" value="Go" /></td>
          </tr>
          <tr>
            <td><div align="right">Analyze Database</div></td>
            <td><input name="analyze" type="submit" id="js_button" value="Go" /></td>
          </tr>
          <tr>
            <td><div align="right">Optimize Database</div></td>
            <td><input name="optimize" type="submit" id="js_button" value="Go" /></td>
          </tr>
          <tr>
            <td><div align="right">Repair Database</div></td>
            <td><input name="repair" type="submit" id="js_button" value="Go" /></td>
          </tr>
        </table>
		
		<br />
		
		<table width="400px" id="js_border">
          <tr>
            <td colspan="2"><div align="center"><b><u>Repair Database Results</u></b></div></td>
          </tr>
		  {result}
        </table>
		</form>
	  </div>
	</td>
  </tr>
</table>
---section repair end---