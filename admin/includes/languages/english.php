<?php
function lang($phrase){

 static $lang = array(
  //dashboard page

   #NAVBAR LINKES

 	'HOME_ADMIN' =>'Home',
 	
 	
 	'CATEGORIES' =>'categories',
	'ITEMS'      =>'Items',
	'MEMBERS'    =>'Members',
	'STATISTICS' =>'Statistics',
	'LOGS'       =>'Logs',
	'EDIT_PROFIL'=>'Edit profil',
 	'SETTING'    =>'Setting',
 	'LOGOUT'     =>'logout',
 	);
 return $lang[$phrase];
}
?>

