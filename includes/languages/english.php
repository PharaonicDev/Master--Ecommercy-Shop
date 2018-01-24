<?php
function lang($phrase) {


 static $lang = array(
   "MESSAGE" =>"Welcome",
   "ADMIN"   => "Adminsitrator"
 	);

 return $lang[$phrase];

}


