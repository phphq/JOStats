/*/////////////////////////////////////////////////////////////
//                                                           //
// Updated Dec 2016 By Novahq.net <scott@novahq.net>         //
// Standalone, PHP 5.6+ Compatible                           //
// NOVAHQ DID NOT CREATE JOSTATS!                            //
//                                                           //
/////////////////////////////////////////////////////////////*/

This package updates JOStats "1.7.9 (Standalone - BMTV3)" with PHP 5.6+ Support

It is recommended that you use at least PHP >= 5.6 with this release. I cannot confirm
if this works with PHP 5.2, 5.3, 5.4 or 5.5.

There will be no additional release for PHP Nuke, it is way too out of date. (See below)

I will fix bugs if necessary when I have time available.

Since I only had a small sample of stats, I could not test EVERY function / page scenario. 
If you see an error on any page, take a screenshot and send it to me. <scott@novahq.net>

Changelog:

- PHP 5.6+ Support (tested with 5.6.28 VC11 x86 nts)
- Changed mysql to mysqli (tested with mysql-community-5.7.16-win32)
- Better prevention against mysql injection
- Better prevention against malicious file upload
- Replace deprecated functions (ereg, session, etc.)
- Removed super globals
- More secure admin login with salt
- Fixed undefined variable warnings
- error_reporting(E_ALL) compatible (except import scripts... whew...)

ANY QUESTIONS: Post them on the Novahq.net forums.

*************** *************** *************** *************** *************** 
INSTALL STANDALONE FULL:
*************** *************** *************** *************** *************** 
Open config.php in notepad, enter database values for: 

$joDbht
$joDbnm
$joDbun 
$joDbpw

Enter values for your admin login:

$joName
$joPass

Upload the entire package to your webserver and navigate to the folder in your browser i.e.: http://website.com/JOStats/
It will auto run the installer, when done, manually remove the install folder.

*************** *************** *************** *************** *************** 
INSTALL STANDALONE UPDATE: (DO NOT USE FOR PHP NUKE, SEE OPTION BELOW)
*************** *************** *************** *************** *************** 
If you want to install this in another folder (for testing), follow "INSTALL STANDALONE FULL"

Open your current config.php and copy to the new config.php the following:

$joDbht
$joDbnm
$joDbun
$joDbpw

$tablepre
$tablepre2

Enter values for your admin login:

$joName
$joPass

Replace all the files in your installation folder with the provided files. 

Overwrite all.

*************** *************** *************** *************** *************** 
INSTALL STANDALONE FULL: (PHP Nuke Users)
*************** *************** *************** *************** *************** 
Open your current config.php and copy to the new config.php the following:

$joDbht
$joDbnm
$joDbun
$joDbpw

$tablepre
$tablepre2

Enter values for your admin login:

$joName
$joPass

Upload the entire package to your webserver **EXCEPT** the /JOStats/install/ folder.
That should be it, it should now be working. 
Update your BMT and what not to the new website path.