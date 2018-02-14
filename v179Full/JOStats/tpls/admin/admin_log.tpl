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

<u><b>admin log viewer</b></u>

<br />
<br />

<table width="600px" id="js_border">
  <tr id="js_text">
    <td>
	  <div align="center">
	  <br />
	  <form method="post" action="{formAction}">
		<table width="600px">
          <tr id="js_text">
            <td><div align="center">
              <select id="js_button" name="logSel">
                {logList}
              </select>
			  &nbsp;&nbsp;
			  <input name="Submit" type="submit" id="js_button" value="go" />
			  <br /><br />
              {main}
			</td>
          </tr>
          <tr id="js_text">
            <td>
			  <table width="600px" id="js_text">
                <tr style="text-decoration:underline; font-weight:bold;">
                  <td>Name</td>
                  <td>IP</td>
                  <td>Action</td>
                  <td>Result</td>
                  <td>Date</td>
                </tr>
                ---loop list start---
			    <tr id="js_text">
                  <td>{list_aid}</td>
                  <td>{list_ip}</td>
                  <td>{list_action}</td>
                  <td>{list_result}</td>
                  <td>{list_date}</td>
                </tr>
			    ---loop list end---
			    <tr id="js_text">
			      <td colspan="5" align="center">
				    ------------------------------------------------------------------------------------------------------------
				  </td>
			    </tr>
			    <tr id="js_text">
			      <td colspan="5">
				    A number in brackets after the action indicates the id 
					number of the affected item in the specific section.
					<br /><br />
					i.e. 'Squad Player Added (1)' means a player was added to the squad with the id number 1.
				  </td>
			    </tr>
              </table>
			</td>
          </tr>
        </table>
		</form>
	  </div>
	</td>
  </tr>
</table>
---section main end---

---section error start---
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

<u><b>admin log viewer</b></u>

<br />
<br />

<table width="500px" id="js_border">
  <tr id="js_text">
    <td>
	  <div align="center">
	  <table width="400px">
        <tr id="js_text">
          <td><div align="center" style="color:#FF0000; font-weight:bold;">You are not authorized to access this page!</div></td>
        </tr>
      </table>
      </div>
	</td>
  </tr>
</table>
---section error end---