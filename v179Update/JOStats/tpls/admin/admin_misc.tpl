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

<u><b>Misc  Admin</b></u>

<br />
<br />

<table width="500px">
  <tr  id="js_text">
    <td><div align="center" style="color:#FF0000;">{error}{msg}</div></td>
  </tr>
</table>

<br />

<table width="600px" id="js_border">
  <tr  id="js_text">
    <td valign="top">
	  <form method="post" action="?section=miscActions">
	    <table width="240px" id="js_border">
          <tr  id="js_text">
            <td colspan="2"><u><b>Config</b></u></td>
          </tr>
          <tr  id="js_text">
            <td width="161px"><div align="right">Players to show per Page: </div></td>
            <td><input style="text-align:right" name="plyrShow" type="text" id="js_button" value="{plyrsPerPage}" size="3" /></td>
          </tr>
          <tr  id="js_text">
            <td><div align="right">Weapons to show per Page: </div></td>
            <td><input style="text-align:right" name="wpnShow" type="text" id="js_button" value="{wpnsPerPage}" size="3" /></td>
          </tr>
          <tr  id="js_text">
            <td><div align="right">Vehicles to show per Page: </div></td>
            <td><input style="text-align:right" name="vehShow" type="text" id="js_button" value="{vehsPerPage}" size="3" /></td>
          </tr>
          <tr  id="js_text">
            <td><div align="right">Maps to show per Page: </div></td>
            <td><input style="text-align:right" name="mapShow" type="text" id="js_button" value="{mapsPerPage}" size="3" /></td>
          </tr>
          <tr  id="js_text">
            <td><div align="right">Squads to show per Page: </div></td>
            <td>
			  <input style="text-align:right" name="squadShow" type="text" id="js_button" value="{squadsPerPage}" size="3" />
			</td>
          </tr>
          <tr  id="js_text">
            <td colspan="2"><div align="center">
              <input style="text-align:right" name="update_config" type="submit" id="js_button" value="Update Config" />
            </div></td>
          </tr>
        </table>
	  </form>
	  
	  <br /><br />
		
	  <table width="240px" id="js_border">
        <tr  id="js_text">
          <td colspan="2"><u><b>Player Management</b></u></td>
        </tr>
        <tr  id="js_text">
          <td><div align="right">Prune Players:</div></td>
          <td><div align="center">
            <form method="post" action="?section=prune">
			  <input name="prune_plyrs" type="submit" id="js_button" value="Prune" />
			</form>
          </div></td>
        </tr>
        <tr  id="js_text">
          <td><div align="right">Merge Players:</div></td>
          <td><div align="center">
            <form method="post" action="?section=merge">  
			  <input name="merge_players" type="submit" id="js_button" value="Merge" />
			</form>
          </div></td>
        </tr>
      </table>
	</td>
    <td valign="top"><div align="right">
      <table width="240px" id="js_border">
        <tr  id="js_text">
          <td colspan="2"><u><b>Global</b></u></td>
        </tr>
        <tr  id="js_text">
          <td><div align="right">Delete JOStats Database:</div></td>
          <td><div align="center">
            <form method="post" action="?section=caution&action=delete">
              <input name="delete_db" type="submit" id="js_button" value="Delete" />
            </form>
          </div></td>
        </tr>
        <tr  id="js_text">
          <td><div align="right">Reset JOStats: </div></td>
          <td><div align="center">
            <form method="post" action="?section=caution&action=reset">
			  <input name="reset_joStats" type="submit" id="js_button" value="Reset" />
			</form>
          </div></td>
        </tr>
        <tr  id="js_text">
          <td><div align="right">Check Database:</div></td>
          <td><div align="center">
            <form method="post" action="?section=checkDB">
              <input name="check_db" type="submit" id="js_button" value="Check" />
            </form>
          </div></td>
        </tr>
        <tr  id="js_text">
          <td><div align="right">Backup Database:</div></td>
          <td><div align="center">
            <form method="post" action="?section=miscActions">
              <input name="backup_db" type="submit" id="js_button" value="Backup" />
            </form>
          </div></td>
        </tr>
        <tr  id="js_text">
          <td><div align="right">Restore Backup :</div></td>
          <td><div align="center">
            <form method="post" action="?section=restore">
              <input name="restore" type="submit" id="js_button" value="Restore" />
            </form>
          </div></td>
        </tr>
      </table>
	  
	  <br /><br />
	  
	  <form method="post" action="?section=miscActions">
	  <table width="240px" id="js_border">
        <tr  id="js_text">
          <td colspan="2"><u><b>Monthly Stats still to reset</b></u></td>
        </tr>
        {monthList}
        <tr id="js_text">
          <td colspan="2" class="tableheader"><div align="center"><span class="tablerow1">
            <input name="reset_monthly" type="submit" id="js_button" value="Reset"  />
          </span></div></td>
        </tr>
      </table>
	  </form>
    </div></td>
  </tr>
</table>