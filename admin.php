<?php require'database.php' ?>
<?php
if(isset($_POST['signin'])){
	$username = mysqli_real_escape_string($conn, $_POST['username']);
	$password = mysqli_real_escape_string($conn,$_POST['password']);
	$res=mysqli_query($conn,"SELECT * FROM admin_users WHERE username='$username'");
  $row = mysqli_fetch_array($res);
  $count = mysqli_num_rows($res);
    if($count == 1 && $row['password']==$password){
    	  session_start();
        $_SESSION['admin_id'] = $row['user_id'];
        header("Location: adminHome.php");
	}else{
        $errMSG = "Incorrect Credentials, Try again...";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>Online Exam Portal - Endeavor</title>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="css/stylesheet.css">
	</head>
	<body>
		<section id="main-section">
			<div class="overlay">
				<div class="container">
					<div class="row">
						<div class="col-lg-8">
							<div class="main-frame text-center">
								<h1 style="font-size:400%;"><strong>ENDEAVOR - EDUTECH</strong></h1>
								<h3>Online Exam Portal</h3>
								<a style="position:fixed;bottom:0;left:0;" class="btn btn-primary btn-block" href="index.php">Go TO Users Section</a>
							</div>
						</div>
						<div class="col-lg-4">
              <div class="login">
								<ul class="nav nav-pills nav-justified">
                  <li class="active"><a>Administrator Sign In</a></li>
								</ul>
								<div class="tab-content">
									<div class="tab-pane in fade active">
										<form action="" method="post" style="padding-left:20px; padding-right:20px"><br><br>
											<div class="form-group"><input class="form-control" type="text" name="username" placeholder="Username"></div><br>
											<div class="form-group"><input class="form-control" type="password" name="password" placeholder="Password"></div><br><br>
											<div class="form-group"><input class="form-control" type="submit" name="signin" value="Sign In"></div>
										</form>
									</div>
								</div>
								<br><center><span><?php if(isset($errMSG)){echo $errMSG;}?></span><center>
							</div>
            </div>
				</div>
			</div>
		</div>
	</section>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	</body>
</html>
