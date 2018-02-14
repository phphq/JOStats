<?php
/*/////////////////////////////////////////////////////////////
//                                                           //
// Updated Dec 2016 By Novahq.net <scott@novahq.net>         //
// Standalone, PHP 5.6+ Compatible                           //
//                                                           //
/////////////////////////////////////////////////////////////*/

//---------------------------------- JOStats Database details ----------------------------------//

$joDbht = "localhost"; //Database host name.
$joDbnm = "";     //Database name.
$joDbun = "";     //Database username.
$joDbpw = "";     //Database password.


/*** Note: '$tablepre' and '$tablepre2' MUST NOT be the same ***/
$tablepre   = "jostats";	   // Table Prefix for Stats Tables			
$tablepre2  = "jostats_m";     // Table Prefix for Monthly Stats Tables

//---------------------------------- JOStats Database details ----------------------------------//


//------------------------------- JOStats Administration details -------------------------------//

$joName = ""; // Admin name
$joPass = "";  // Admin pass

//------------------------------- JOStats Administration details -------------------------------//


//------------------------------- JOStats Miscallaneous Settings -------------------------------//

$joTips = true;   // true  = tips will be displayed at the bottom of stats pages.
                  // false = tips will not be displayed at the bottom of stats pages.

$websiteTitle    = "JOStats"; // Website title

$date      = mktime(0, 0, 0, date("m")  , date("d"), date("Y"));    // Do not edit - todays date.
$today     = date("Y-m-d", $date) ;                                 // Do not edit - formatted date.
$date2     = mktime(0, 0, 0, date("m")  , date("d")-1, date("Y"));  // Do not edit - yesterdays date.
$yesterday = date("Y-m-d", $date2) ;                                // Do not edit - formatted date.
$dow       = date("l");                                             // Do not edit - current day.
$cur_mon   = date("m");                                             // Do not edit - current month.
$cur_year  = date("Y");                                             // Do not edit - current year.

//------------------------------- JOStats Miscallaneous Settings -------------------------------//
















































// Do not edit
// Do not edit
// Do not edit
// Do not edit
// Do not edit
// Do not edit

if(!$joDbnm || !$joDbun) exit("please setup the database information in config.php");
if(!$joName || !$joPass) exit("please setup a username and password in config.php");
if($tablepre==$tablepre2) exit("tablepre and tablepre2 cannot be the same in config.php");

define('IN_JOSTATS', true); // DO NOT EDIT
$joSalt = "3$6x%7.058x.*-3"; // DO NOT EDIT
$joPass = sha1($joSalt.$joPass.$joSalt); // DO NOT EDIT