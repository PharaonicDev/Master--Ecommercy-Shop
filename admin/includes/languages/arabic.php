<?php
function lang($phrase) {


 static $lang = array(
   "MESSAGE" =>"Welcome",
   "ADMIN"   => "Arabic admin"
 	);

 return $lang[$phrase];

}