<?php
session_start();
 if(isset($_SESSION['username'])){

 	$pageTitle = 'Dashboard';

 	include "init.php";
 	/*start Dashboard page*/
$theLatest = getLatest("*", "users", "userID",3);

foreach ($theLatest as $user  ) {
	echo $user['username'] . "<br>";
}

?>
<div class="home-stats">
<div class="container  text-center">
   <h1>Dashboard</h1>
	<div class="row">

		<div class="col-md-3">
			 <div class="stat st-members">Total member
			   <span><a href='members.php'></a><?php echo countItems('userID', 'users')?></span>
			  </div>
		</div>

		<div class="col-md-3">
			<div class="stat st-pending"> pending members
			<span ><a href='members.php?do=Manage&page=pending'></a>100</span>
	          <?php echo checkItem('RegStatus', 'users', 0)?>
			</div>
		</div>

		<div class="col-md-3">
			<div class="stat st-items">Total items
			<span>100</span>
			</div>
		</div>

		<div class="col-md-3">
			<div class="stat st-comments">Total comments
			<span>100</span>
			</div>
		</div>
	</div><!--row-->
</div>
</div><!--homestate-->
<div class="container latest" style="margin-top: 40px;">
	<div class="row">
		<div class="col-sm-6">
		  <div class="panel panel-default">
		  <?php $latestUsers = 3;?>
		  <div class="panel-heading">
		  	<i class="fa fa-users"></i>latest register users
		  </div>
		  <div class="panel-body">
		<?php 
				$theLatest = getLatest("*", "users", "userID",3);

				foreach ($theLatest as $user  ) {
					echo $user['username'] . "<br>";
				}
		?>
		  </div>
		</div>
	</div>

		<div class="col-sm-6">
		  <div class="panel panel-default">
		  <div class="panel-heading">
		  	<i class="fa fa-tag"></i>latest Items
		  </div>
		  <div class="panel-body">
		  	test
		  </div>
		</div>
	</div>

</div>

<?php
 	/*End Dashboard*/

 	include $tpl."footer.php"; 

 } else {

 	header('location:index.php');

 	exit();
 }