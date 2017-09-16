<?php require'database.php' ?>
<?php
	session_start();
	if(!isset($_SESSION['admin_id'])){
		header("Location: admin.php");
	}
	$user_id=$_GET['user_id'];
	mysqli_query($conn,"DELETE FROM users WHERE user_id='$user_id' ");
	mysqli_query($conn,"DELETE FROM test_result WHERE user_id='$user_id' ");
	mysqli_query($conn,"DELETE FROM test_result_desc WHERE user_id='$user_id' ");
	header("Location: adminHome.php");
?>
