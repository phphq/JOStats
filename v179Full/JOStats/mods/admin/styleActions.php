<?php if(!defined('IN_JOSTATS')) exit("You may not access this file directly.");
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
// File Name     : Awards Module                             //
// File Version  : 1.0.3 Standalone                          //
//                                                           //
/////////////////////////////////////////////////////////////*/

/*/////////////////////////////////////////////////////////////
//                                                           //
// Updated Dec 2016 By Novahq.net <scott@novahq.net>         //
// Standalone, PHP 5.6+ Compatible                           //
//                                                           //
/////////////////////////////////////////////////////////////*/

if(!empty($_POST['update_m_styles'])) {

	$indent1Color = (!empty($_POST['indent1Color']) ? ajZfDd3($_POST['indent1Color']) : "181C32");
	$indent2Color = (!empty($_POST['indent2Color']) ? ajZfDd3($_POST['indent2Color']) : "161B33");
	$indent3Color = (!empty($_POST['indent3Color']) ? ajZfDd3($_POST['indent3Color']) : "3D5C8B");
	$mainColor = (!empty($_POST['mainColor']) ? ajZfDd3($_POST['mainColor']) : "414142");
	$headerColor = (!empty($_POST['headerColor']) ? ajZfDd3($_POST['headerColor']) : "202648");
	$bodyColor = (!empty($_POST['bodyColor']) ? ajZfDd3($_POST['bodyColor']) : "343D69");
	$stat1Color = (!empty($_POST['stat1Color']) ? ajZfDd3($_POST['stat1Color']) : "366AB6");
	$stat2Color = (!empty($_POST['stat2Color']) ? ajZfDd3($_POST['stat2Color']) : "325C9E");
	$font1Size = (!empty($_POST['font1Size']) ? dfyu56d($_POST['font1Size']) : 12);
	$font2Size = (!empty($_POST['font2Size']) ? dfyu56d($_POST['font2Size']) : 10);
	$font3Size = (!empty($_POST['font3Size']) ? dfyu56d($_POST['font3Size']) : 11);
	$fontFamily = (!empty($_POST['fontFamily']) ? cMioD4($_POST['fontFamily']) : "Tahoma");
	$font1Color = (!empty($_POST['font1Color']) ? ajZfDd3($_POST['font1Color']) : "FFFFFF");
	$font2Color = (!empty($_POST['font2Color']) ? ajZfDd3($_POST['font2Color']) : "FF0000");
	$font3Color = (!empty($_POST['font3Color']) ? ajZfDd3($_POST['font3Color']) : "000000");
	$linkColor = (!empty($_POST['linkColor']) ? ajZfDd3($_POST['linkColor']) : "FFFFFF");
	$visitedcolor = (!empty($_POST['visitedcolor']) ? ajZfDd3($_POST['visitedcolor']) : "FFFFFF");
	$hoverColor = (!empty($_POST['hoverColor']) ? ajZfDd3($_POST['hoverColor']) : "FF0000");

	$invalidColor=false;
	if(strlen($indent1Color)!=6) $invalidColor=true;
	if(strlen($indent2Color)!=6) $invalidColor=true;
	if(strlen($indent3Color)!=6) $invalidColor=true;
	if(strlen($mainColor)!=6) $invalidColor=true;
	if(strlen($headerColor)!=6) $invalidColor=true;;
	if(strlen($bodyColor)!=6) $invalidColor=true;
	if(strlen($stat1Color)!=6) $invalidColor=true;
	if(strlen($stat2Color)!=6) $invalidColor=true;
	if(strlen($font1Color)!=6) $invalidColor=true;
	if(strlen($font2Color)!=6) $invalidColor=true;
	if(strlen($font3Color)!=6) $invalidColor=true;
	if(strlen($linkColor)!=6) $invalidColor=true;
	if(strlen($visitedcolor)!=6) $invalidColor=true;
	if(strlen($hoverColor)!=6) $invalidColor=true;

	if($invalidColor) {
		header("location: ./admin.php?section=style&msg=2");
		exit;
	}

	$tpl->joQuery("UPDATE $style_table SET 
					   `Background 1`  = '".$indent1Color."' ,
					   `Background 2`  = '".$indent2Color."' ,
					   `Background 3`  = '".$indent3Color."' ,
					   `Background 4`  = '".$mainColor."'    ,
					   `Background 5`  = '".$headerColor."'  ,
					   `Background 6`  = '".$bodyColor."'    ,
					   `Background 7`  = '".$stat1Color."'   ,
					   `Background 8`  = '".$stat2Color."'   ,
					   `Font size 1`   = '".$font1Size."'    ,
					   `Font size 2`   = '".$font2Size."'    ,
					   `Font size 3`   = '".$font3Size."'    ,
					   `Font family`   = '".$fontFamily."'   ,
					   `Font color 1`  = '".$font1Color."'   ,
					   `Font color 2`  = '".$font2Color."'   ,
					   `Font color 3`  = '".$font3Color."'   ,
					   `Link color`    = '".$linkColor."'    ,
					   `Visited color` = '".$visitedcolor."' ,
					   `Hover color`   = '".$hoverColor."'
				   WHERE id = '1'", 2);

	$tpl->joQuery("INSERT INTO $adminlogs_table 
				   VALUES('', 'style', 'Update Style Settings', 'Success', '".$joName."', '".$_SERVER['REMOTE_ADDR']."', 
				   '".date("Y-m-d H:i:s")."')", 2);
	$msg = 1;
	
	header("location: ./admin.php?section=style&msg=1");
	exit;
}


if(!empty($_POST["update_a_styles"])) {

	$borderColor = (!empty($_POST['borderColor']) ? ajZfDd3($_POST['borderColor']) : "4D4D4D");
	$font1Size2 = (!empty($_POST['font1Size2']) ? dfyu56d($_POST['font1Size2']) : 12);
	$font2Size2 = (!empty($_POST['font2Size2']) ? dfyu56d($_POST['font2Size2']) : 13);
	$fontFamily2 = (!empty($_POST['fontFamily2']) ? cMioD4($_POST['fontFamily2']) : "Tahoma");
	$font1Color2 = (!empty($_POST['font1Color2']) ? ajZfDd3($_POST['font1Color2']) : "000000");
	$font3Color2 = (!empty($_POST['font3Color2']) ? ajZfDd3($_POST['font3Color2']) : "000000");
	$linkColor2 = (!empty($_POST['linkColor2']) ? ajZfDd3($_POST['linkColor2']) : "000000");
	$visitedcolor2 = (!empty($_POST['visitedcolor2']) ? ajZfDd3($_POST['visitedcolor2']) : "000000");
	$hoverColor2 = (!empty($_POST['hoverColor2']) ? ajZfDd3($_POST['hoverColor2']) : "FF0000");

	$invalidColor=false;
	if(strlen($borderColor)!=6) $invalidColor=true;
	if(strlen($font1Color2)!=6) $invalidColor=true;
	if(strlen($font3Color2)!=6) $invalidColor=true;
	if(strlen($linkColor2)!=6) $invalidColor=true;
	if(strlen($visitedcolor2)!=6) $invalidColor=true;
	if(strlen($hoverColor2)!=6) $invalidColor=true;

	if($invalidColor) {
		header("location: ./admin.php?section=style&msg=2");
		exit;
	}

	$tpl->joQuery("UPDATE $style_table SET 
					   `Background 1`  = '".$borderColor."'   ,
					   `Font size 1`   = '".$font1Size2."'    ,
					   `Font size 2`   = '".$font2Size2."'    ,
					   `Font family`   = '".$fontFamily2."'   ,
					   `Font color 1`  = '".$font1Color2."'   ,
					   `Font color 3`  = '".$font3Color2."'   ,
					   `Link color`    = '".$linkColor2."'    ,
					   `Visited color` = '".$visitedcolor2."' ,
					   `Hover color`   = '".$hoverColor2."'
				   WHERE id = '2'", 2);

	$tpl->joQuery("INSERT INTO $adminlogs_table 
				   VALUES('', 'style', 'Update Style Settings', 'Success', '".$joName."', '".$_SERVER['REMOTE_ADDR']."', 
				   '".date("Y-m-d H:i:s")."')", 2);

	header("location: ./admin.php?section=style&msg=1");
	exit;
}