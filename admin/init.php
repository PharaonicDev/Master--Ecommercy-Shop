<?php
include "connect.php";
//Routes
$tpl  = "includes/templates/"; //Template Directory
$lang = "includes/languages/";//language Directory
$func = "includes/functions/";//function Directory
$css  = "layout/css/";//css Directory
$js   = "layout/js/";//js Directory


//include important files
 include $func."function.php";
 include $lang."english.php";
 include $tpl."header.php";

 #include Navbar on All pages Except the one wih $noNavbar varibale

 if(!isset($noNavbar)){
    include $tpl."navbar.php";	
 }
 