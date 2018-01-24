<?php
/*
  Categories => [Manange | Edit | Add | Update |Insert |Delete | Statics]
*/
 #condition ? true : false
  $do = isset($_GET['do']) ? $_GET['do'] : 'Manange' ;

 /*

  if ( isset($_GET['do'])){
  	$do = $_GET['do'];
  }else {
  	$do = 'Manange';
  }*/
  //If the Page Is Main Page

  if ($do == 'Manange'){
  	echo 'welcome you are in manange gategory page';
  	echo '<a href="page.php?do=Insert">Add new gategory +</a>'; 
  }elseif ($do == 'Add') {
  	echo "welcome you are in Add gategory page";
  }elseif ($do == 'Insert') {
  	echo "welcome you are in Insert gategory page";
  }else  {
  	echo "Error no page with thise name";
  }