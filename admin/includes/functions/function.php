<?php
/*v1.0
** Title function:for print defult ditle or $page title in all pages 
*/

function getTitle() {
	global $pageTitle;

	if (isset($pageTitle)){
		echo $pageTitle;
	}else{
		echo "Default";
	}
}
/*
**v1.0
**Home redirect Function [thise Function accept parameters]
**$theMsg = Error Message that you wont appear to user[Error | Sucess |warning]
**$url = the link  you want to redirect to
**$secounds = Secounds before redirecti user to Home page
*/

function redirectHome($theMsg,$url = null ,$secounds = 3){

 if( $url= null){

 	$url= 'index.php';

 	$link = 'Homepage';

 } else {

    if(isset($_SERVER['HTTP_REVERER']) &&  $_SERVER['HTTP_REFERER'] !== ''){
    	
    	$url = $_SERVER['HTTP_REFERER'];

    	$link = 'previous page';

    } else {

    	$url = 'index.php';

    	$link = 'Homepage';
    }
 }
  echo$theMsg;
  echo "<div class='alert alert-info'>you will be redirect to $link after $secounds sec.</div>";

  header("refresh:$secounds;url=$url");
  exit();

}

/*
**Check Items Function v1.0
** Function to Check Item In Database [function accept parameters]
**$select = the item to select [example: user, item, category]
**$from = the table to select from [ExampleLusers, items, categories]
**$value -= the value of select[Example:bakr, box,electronics]
*/

function checkItem($select, $from, $value){
	global $con;

	$statement = $con->prepare('SELECT $select FROM $from WHERE $select = ?');

   $statement->execute(array($value));

   $count = $statement->rowCount();
 
  return $count;
}
/*
** count number of items function v1.0
** function to count number of items rows
**$item = the item to count 
**$table = the table to choose from
*/

function countItems($item, $table) {

global $con;

$stmt2 = $con->prepare("SELECT COUNT($item) FROM $table");

$stmt2->execute();

return $stmt2->fetchColumn();
} 

/*
**Get Latest Records Function v1.0
**Function to get items from database [users, items ,comments]
**$select = faild to select
** $table = the table to choose from
**$order  = the desc order
**$limit = number of records to get 
*/

function getLatest($select , $table, $order, $limit = 5) {

  global $con;

 $getStmt = $con->prepare('SELECT $select  FROM $table ORDER BY $order DESC LIMIT $limit');

$getStmt->execute();

$rows = $getStmt->fetchAll();

return $rows;

}