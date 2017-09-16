<?php require'database.php' ?>
<?php
session_start();
if(!isset($_SESSION['admin_id'])){
	header("Location: admin.php");
}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>Online Exam Portal - Endeavor</title>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="css/stylesheet.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<script type="text/javascript" src="js/searchUser.js"></script>
	</head>
	<body>
    <div class="container-fluid">
    	<div class="row">
    		<div id="menu" class="col-md-2">
					<center><h3>Admin Panel</h3></center>
    			<br><br><br>
    			<ul class="nav nav-pills nav-stacked">
    				<li class="active"><a data-toggle="tab" data-target="#subjects"><span class="glyphicon glyphicon-book"></span>&emsp;Subjects</a></li><br>
    				<li><a data-toggle="tab" data-target="#tests"><span class="glyphicon glyphicon-th-list"></span>&emsp;Tests</a></li><br>
    				<li><a data-toggle="tab" data-target="#new-test"><span class="glyphicon glyphicon-pencil"></span>&emsp;New Test</a></li><br>
    				<li><a data-toggle="tab" data-target="#search-users"><span class="glyphicon glyphicon-search"></span>&emsp;Search User</a></li><br>
    				<li><a data-toggle="tab" data-target="#settings"><span class="glyphicon glyphicon-cog"></span>&emsp;Settings</a></li><br>
            <li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span>&emsp;Logout</a></li><br>
    			</ul>
    		</div>
    		<div id="content" class="col-md-8">
    				<div class="tab-content">
    					<?php include"adminHomeContent.php" ?>
    				</div>
    		</div>
    	</div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  </body>
</html>
