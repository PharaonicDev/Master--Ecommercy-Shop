<?php
session_start();
$noNavbar  ='';
$pageTitle = 'Login';
 if(isset($_SESSION['username'])){
 	header('Location:dashboard.php');//REDIRECT TO DASHBORD
 }
 include "init.php";
 

 //check if user coming from http post request
 if ($_SERVER['REQUEST_METHOD'] == 'POST') {
 	# code...
 	$username = $_POST['user'];
 	$password = $_POST['pass'];
    $hashedpass = sha1($password);

    //ceck if the user exist in database

    $stmt = $con->prepare("SELECT 
                              UserID,Username,Password 
                           FROM 
                              users 
                           WHERE
                              Username = ?  
                           AND  
                             password = ? 
                           AND 
                             GroupID = 1 
                           
                           LIMIT 1");
    $stmt->execute(array($username, $hashedpass));
    $row = $stmt->fetch();
    $count = $stmt->rowCount();
   
   // if count > 0 thise mean data base contain record database
    if ($count > 0 ){
     $_SESSION['username'] = $username ;//REGISTER SEESION NAME
     $_SESSION['ID'] = $row['UserID'] ; //REGISTER SEESION ID
     header('Location:dashboard.php');//REDIRECT TO DASHBORD
     exit();
    
    }
 }
  ?>



<form class="login" action="<?php echo $_SERVER['PHP_SELF']?>" method="POST">
    <h4 class="text-center"> Login</h4>
	<input class="form-control" type="text"     name="user" placeholder="username">
	<input class="form-control" type="password" name="pass" placeholder="password" autocomplete="new-password">
    <input class="btn btn-primary btn-block"    type="submit"   value="login">

    </form>
 <?php include $tpl."footer.php"; ?>