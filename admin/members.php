<?php

/*
==============================================
==Manage Member Page
==You Can | Edit | Delete Members From Here
==============================================

*/

session_start();
   $pageTitle = "Members";
 if(isset($_SESSION['username'])){

 	include "init.php";
  
    #condition ? true : false
    $do = isset($_GET['do']) ? $_GET['do'] : 'Manange' ;

    if ($do =="Manage"){//Manage Page 
        $query = '';

if (isset($_GET['page'] == 'pending')){
  $query = ' AND RegStatus = 0';
}
    }
       

//SELECT ALL USERD EXCEPT ADMIN
  $stmt = $con->prepare("SELECT * FROM users WHERE GroupID  != 1 $query");
  //EXCUTE THE STATEMENT
  $stmt->execute();
  //ASIGN TO VARIABLE

  $rows = $stmt->fetchAll(); 
      ?>
    	
           <h1 class="text-center">Add New Member</h1>
             <div class="container">
               <div class="table-responsive">
                <table class="  table table-bordered  text-center main-table">
<!--===============[1=====-->
                  <tr style="color: #fff; background-color:#333">
                    <td>#ID</td>
                    <td>USERNAME</td>
                    <td>EMAIL</td>
                    <td>FULL NAME</td>
                    <td>REGISTER DATE</td>
                    <td> CONTROL</td>
                  </tr>
             <?php
             foreach($rows as $row){
              echo "<tr>";
                  echo "<td>" .$row['userID']. "</td>";
                  echo "<td>" . $row['UserName'] . "</td>";
                    echo "<td>" .$row['Email']. "</td>";
                      echo "<td>" .$row['FullName']. "</td>";
                        echo "<td></td>";
                        echo "<td> 
                              <a href='members.php?do=Edit&userid=" . $row['UserID']." ' class='btn btn-success'><i class='fa fa-fw fa-edit'></i>Edit</a> 
                              <a href='members.php?do=Delete&userid=" . $row['UserID']."' class='btn btn-danger'><i class='fa fa-fw fa-close'></i>Delete</a>";
                          if($row[RegStatus == 1 ]){
                            echo "    <a href='members.php?do=Activite&userid=" . $row['UserID']."' class='btn btn-info activite'><i class='fa fa-fw fa-close'></i>Activite</a>";";
                          }     
                           echo "</td>";
               echo "</tr>"; 
              }
 
             ?>

                    <tr>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td>
                        <a href="#" class="btn btn-success"><i class="fa fa-fw fa-edit"></i>Edit</a>
                        <a href="#" class="btn btn-danger"><i class="fa fa-fw fa-close"></i>Delet</a>
                      </td>
                  </tr>
                


                </table> <!--table-->
                 </div><!--table-responsive-->
                    <a href='members.php?do=Add' class="btn btn-primary">
                           <i class="fa fa-plus"></i>
                  New member 
                  </a>;
              </div><!--container-->
   

      <?php 
         } elseif($do =='Add') { //Add Member Page ?> 
     
      
        <form class="form-horizontal" action="?do=Insert" method="POST" style="margin: 200px 20px 20px 20px">
            
        <!--start user name input-->
          <div class="form-group form-group-lg ">
           <label class="col-sm-2 col-md-3 control-label col-xs-12">User Name</label>
           <div class="col-sm-8  col-md-4 col-xs-12 input-group margin-bottom-sm">

            <input type="text" name="username" class="form-control"  autocomplete="off" placeholder="username to login to shop" />
                <span class="input-group-addon"><i class="fa fa-address-book-o fa-fw"></i></span>
            </div>
            <div class="col-sm-2 col-md-6   "> </div><!--EX:name placeholder-->
          </div>
          <!--End user name input-->
            <!--start user Full Name input-->
          <div class="form-group form-group-lg">
           <label class="col-sm-2 col-md-3 control-label col-xs-12">Full Name</label>
               <div class="col-sm-8  col-md-4 col-xs-12  input-group margin-bottom-sm">
                 <input type="text" name="Full" class="form-control" autocomplete="new-password"  required="required" placeholder="Full Name Appear in your profile Page" />
                  <span class="input-group-addon"><i class="fa fa-address-book-o fa-fw"></i></span>

               </div>
             <div class="col-sm-2 col-md-4  col-xs-4 "> </div><!--EX:Full Name placeholder-->
          </div>
          <!--End user Full Name input-->
          <!--start user Password input-->
          <div class="form-group form-group-lg">
           <label class="col-sm-2 col-md-3 control-label col-xs-12">Password</label>
             <div class="col-sm-8  col-md-4 col-xs-12  input-group margin-bottom-sm">
              <input type="password" name="password" class=" password form-control" autocomplete="off" placeholder="password must be hard & complex" />
                  
                        <span class="input-group-addon"><i class="fa fa-eye show-pass fa-fw"></i></span>
               </div>
             <div class="col-sm-2 col-md-4  col-xs-4 "> </div><!--EX:password placeholder-->
          </div>
          <!--End user Password input-->
          <!--start user Email input-->
          <div class="form-group form-group-lg">
           <label class="col-sm-2 col-md-3 control-label col-xs-12">Email</label>
            <div class="col-sm-8  col-md-4 col-xs-12  input-group margin-bottom-sm">
              <input type="email" name="email" class="form-control"   required="required" placeholder="Enter Valid Email" />
                      <span class="input-group-addon"><i class="fa fa-envelope-o fa-fw"></i></span>
               </div>
             <div class="col-sm-2 col-md-4  col-xs-4 "> </div><!--EX:name Emaial-->
          </div>
          <!--End user Email input-->
        
          <!--start user submit input-->
          <div class="form-group form-group-lg">
           
           <div class=" col-sm-offset-2 col-md-offset-3 col-md-4  col-sm-8 col-xs-12 input-group margin-bottom-sm">
            <input type="submit" value="Add member"  class="btn btn-primary btn-lg btn-block" />
                      
            </div>
          </div>
          <!--End user submit input-->
        </form>
      </div>

     
      <?php 


    }elseif ($do == 'Insert'){

        

        if ($_SERVER['REQUEST_METHOD'] == "POST"){
           echo "<h1 class='text-center'> update Member</h1>";
           echo "<div class='container'>";

            //get variables from the form
         
            $user =$_POST ['username'];
            $pass =$_POST['password'];
            $email = $_POST['email'];
            $name=$_POST ['FullName'];
           
            
            $hashPass = sha1($_POST['password']);
            //validate the form
            $formErrors = array();
            if(strlen($user) < 3){
              echo"<div class='alert alert-danger'>user name must be less than <strong>3 Charcters</strong></div>" ;
            }

             if(strlen($user) > 7){
              echo"user name must be more than <strong>7</strong>" ;
            }


            if (empty($user)) {
               $formErrors[] ="user name cant be <strong> Empty </strong>";
            }

             if (empty( $FullName)) {
                $formErrors[] ="FullName  cant be <strong> Empty </strong>";
            }
              if (empty($pass)) {
               $formErrors[] ="password cant be <strong> Empty </strong>";
            }

             if (empty($email)) {
                $formErrors[] ="email cant be <strong> Empty </strong>";
            }
            foreach($formErrors as $error) {
                echo "<div class='alert alert-danger'>" .$error ."</div>" ;
            }
            //Check If There's no erorr update the Datebase with new Information

            if (empty($formErrors)){

 
             $check  = checkItem("Username", "users", $user);
         if(check == 1) { 

          $theMsg = "<div class='alert alert-danger'>this user is Exist</div>";

          redirectHome(theMsg, 'back');
         } else {



                    //Insert user Info in DataBase
               $stmt = $con->prepare ("INSERT INTO  
                 users( UserName, Password,Email, FullName,RegStatus, Date)values(:Zuser,:Zpass,:Zemail, :zname,1 ,now()) ");

                 $stmt->execute( array(
                  'zuser'     => $user,
                  'zpass'     => $hashPass,
                  'zemail'    => $FullName,
                  'zname'     => $name
                
                   ));

                    //ECHO SUCESS MESSAGE
                $theMsg = "<div class='alert alert-success'>" .$stmt->rowCount(). 'record Inserted</div>';
                    redirectHome($theMsg,'back');
                }
          
      }
            //update the database with thise info
            $stmt = $con->prepare("UPDATE users SET 

                UserName = ?,
                 FullName=? 
                  Email=? ,
                 Password  =? ,

                ");
            $stmt->execute(array($user,$email, $FullName,$pass ));
            echo " SUCESS MESSAGE";
            echo $stmt->rowCount() . 'record updated';


          } else {
            echo "<div class='container'>";

            $theMsg = '<div class="alert alert-danger">sorry tou cant browse thise page directly</div>';

            redirectHome($theMsg,'back' );
            echo "</div>";
        }

        echo "</div>";
  

    
      } elseif ( $do === "Edit") { //Edit Page
        //CHECK IF GET REQUEST IS NUMIRC AND GET THE INTEGER VALUE OF IT

    $userid = isset($_GET['userid']) && is_numeric($_GET['userid']) ? intval($_GET['userid']) :0;
       
               //ceck if the user exist in database

    $stmt = $con->prepare("SELECT 
                               *
                           FROM 
                              users 
                           WHERE
                              UserID = ?

                           LIMIT 1");
// SELECT ALL THE DATA DEPINING ON ID
    $stmt->execute(array($userid)); //EXECUTE THE DATA
    $row = $stmt->fetch();          //FETCING ON DATA
    $count = $stmt->rowCount();     //ROW COUNT 
//IF THERE IS ID SHOW FORM
if ($stmt->rowCount() > 0){   ?>
   

       
    	<h1 class="text-center">Edit Member</h1>
    	<div class="container">
    		<form class="form-horizontal" action="?do=Update" method="POST">
             <input type="hidden" name="userid" value="<?php echo $userid?>">
    		<!--start user name input-->
    		  <div class="form-group form-group-lg">
    		   <label class="col-sm-2 col-md-3 control-label col-xs-12">User Name</label>
    		   <div class="col-sm-8  col-md-6 col-xs-12 input-group margin-bottom-sm">

    		   	<input type="text" name="username" class="form-control" value="<?php echo $row['UserName']?>" autocomplete="off" required="required"/>
                <span class="input-group-addon"><i class="fa fa-address-book-o fa-fw"></i></span>
    		    </div>
    		    <div class="col-sm-2 col-md-6   "> </div><!--EX:name placeholder-->
    		  </div>
    		  <!--End user name input-->
    		    <!--start user Full Name input-->
    		  <div class="form-group form-group-lg">
    		   <label class="col-sm-2 col-md-3 control-label col-xs-12">Full Name</label>
    		       <div class="col-sm-8  col-md-6 col-xs-12  input-group margin-bottom-sm">
    		   	     <input type="text" name="Full" class="form-control" autocomplete="new-password" value="<?php echo $row['FullName']?>" required="required" />
    		   	      <span class="input-group-addon"><i class="fa fa-address-book-o fa-fw"></i></span>
    		       </div>
    		     <div class="col-sm-2 col-md-4  col-xs-4 "> </div><!--EX:Full Name placeholder-->
    		  </div>
    		  <!--End user Full Name input-->
    		  <!--start user Password input-->
    		  <div class="form-group form-group-lg">
    		   <label class="col-sm-2 col-md-3 control-label col-xs-12">Password</label>
    		     <div class="col-sm-8  col-md-6 col-xs-12  input-group margin-bottom-sm">
    		   	  <input type="password" name="newpassword" class="form-control" autocomplete="off" placeholder="Leave Blank if you Dont To Change" />
                  <input type="hidden"   name="oldpassword" value="<?php echo $row['Password'] ?>" required="required" />
                        <span class="input-group-addon"><i class="fa fa-key -o fa-fw"></i></span>
    		       </div>
    		     <div class="col-sm-2 col-md-4  col-xs-4 "> </div><!--EX:password placeholder-->
    		  </div>
    		  <!--End user Password input-->
    		  <!--start user Email input-->
    		  <div class="form-group form-group-lg">
    		   <label class="col-sm-2 col-md-3 control-label col-xs-12">Email</label>
    		    <div class="col-sm-8  col-md-6 col-xs-12  input-group margin-bottom-sm">
    		     	<input type="email" name="email" class="form-control"  value="<?php echo $row['Email']?> " required="required"/>
                      <span class="input-group-addon"><i class="fa fa-envelope-o fa-fw"></i></span>
    		       </div>
    		     <div class="col-sm-2 col-md-4  col-xs-4 "> </div><!--EX:name Emaial-->
    		  </div>
    		  <!--End user Email input-->
    		
    		  <!--start user submit input-->
    		  <div class="form-group form-group-lg">
    		   
    		   <div class=" col-sm-offset-2 col-md-offset-3 col-md-6  col-sm-8 col-xs-8 input-group margin-bottom-sm">
    		   	<input type="submit" value="Save"  class="btn btn-primary btn-lg btn-block" />
                      
    		    </div>
    		  </div>
    		  <!--End user submit input-->
    		</form>
    	</div>
   <?php // SHOW FALSE MESSAGE  IF THERE IS NO ID IN DATABASE
       }else{

            echo "<div class='container'>";

              $theMsg = "there is no such ID";

              redirectHome($theMsg, 'back');

            echo "</div>";
         }

       } elseif($do == 'Update') { //update page
        echo "<h1 class='text-center'> update Member</h1>";

       echo "<div class='container'>";

        if ($_SERVER['REQUEST_METHOD'] == "POST"){

            //get variables from the form
            $id   = $_POST['userid'];
            $user =$_POST ['username'];
            $FullName = $_POST['FullName'];
            $email=$_POST ['email'];


            //password Trick
            $pass = empty($_POST['newpassword']) ? $_POST['oldpassword'] :sha1($_POST['newpassword']);
            
            //validate the form
            $formErrors = array();
            if(strlen($user) < 3){
              echo"<div class='alert alert-danger'>user name must be less than <strong>3 Charcters</strong></div>" ;
            }

             if(strlen($user) > 7){
              echo"user name must be more than <strong>7</strong>" ;
            }


            if (empty($user)) {
               $formErrors[] ="user name cant be <strong> Empty </strong>";
            }

             if (empty( $FullName)) {
                $formErrors[] ="FullName cant be <strong> Empty </strong>";
            }

             if (empty($email)) {
                $formErrors[] ="email cant be <strong> Empty </strong>";
            }
            foreach($formErrors as $error) {
                echo "<div class='alert alert-danger'>" .$error . "</div>" ;
            }
            //Check If There's no erorr update the Datebase with new Information

            if (empty($formErrors)){
                //update the database with thise info
            $stmt = $con->prepare("UPDATE users SET username = ?, Email=? ,  userid =? , FullName =? , Password=? ");
            $stmt->execute(array($user,$FullName, $email, $pass ,$id));
                echo 'succes message';
            echo "<div class='alert alert-success'>" .$stmt->rowCount(). 'record updated</div>';

            
            }

            // update the database with thise info
           $stmt = $con->prepare("UPDATE users SET username = ?, Email=? ,  userid =? , FullName =? , Password=? ");
            $stmt->execute(array($user,$FullName, $email, $pass ,$id));
              echo 'succes message';
            echo $stmt->rowCount(). 'record updated';


        } else {

           $theMsg = "<div class='alert alert-danger'>sorry You cant Browse thise page Directly</div>";
            redirectHome($theMsg);
        }

        echo "</div>";

       } elseif( $do =='Delete'){
           //Delete Member page
           echo "<h1 class='text-center'> Delete Member</h1>";
           echo "<div class='container'>";
                                   //CHECK IF GET REQUEST IS NUMIRC AND GET THE INTEGER VALUE OF IT

                              $userid = isset($_GET['userid']) && is_numeric($_GET['userid']) ? intval($_GET['userid']) :0;
                                 
                                         //ceck if the user exist in database

                                  $check = checkItem('userid', 'users', $userid);


                          //IF THERE IS ID SHOW FORM
                          if ($stmt->rowCount() > 0){
                             
                             $stmt = $con->prepare("DELETE  FROM users WHERE userID=:zuser");
                             $stmt->bindParam(":zuser", $userid);
                             $stmt->execute();
                                  //ECHO SUCESS MESSAGE
                                      $theMsg = "<div class='alert alert-success'>" .$stmt->rowCount(). 'Record Deleted</div>';
                                      redirectHome($theMsg);
                                    } else {

                                   $theMsg =  '<div class="alert alert-danger">Thise ID is not Exist</div>' ;
                                   redirectHome($theMsg);
                                    } ;
            
           echo "</div>";
        } elseif($do == 'Activite'){

           //Activite Member page
           echo "<h1 class='text-center'> Activite Member</h1>";
           echo "<div class='container'>";
                                   //CHECK IF GET REQUEST IS NUMIRC AND GET THE INTEGER VALUE OF IT

                              $userid = isset($_GET['userid']) && is_numeric($_GET['userid']) ? intval($_GET['userid']) :0;
                                 
                                         //ceck if the user exist in database

                                  $check = checkItem('userid', 'users', $userid);


                          //IF THERE IS ID SHOW FORM
                          if ($stmt->rowCount() > 0){
                             
                             $stmt = $con->prepare("UPDATE   users SET RegStatus = 1 WHERE userid = ?");
                            
                             $stmt->execute(array($userid));
                                  //ECHO SUCESS MESSAGE
                                      $theMsg = "<div class='alert alert-success'>" .$stmt->rowCount(). 'Record Deleted</div>';
                                      redirectHome($theMsg);
                                    } else {

                                   $theMsg =  '<div class="alert alert-danger">Thise ID is not Exist</div>' ;
                                   redirectHome($theMsg);
                                    } ;
            
           echo "</div>";
        }
 	   include $tpl."footer.php"; 

  } else {

 	header('Location:index.php');
 	
 	exit();
 }
