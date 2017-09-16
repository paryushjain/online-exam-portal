<?php require'database.php' ?>
<?php
session_start();
if(isset($_SESSION['user_id'])){
	header("Location: studentHome.php");
}
if(isset($_POST['signin'])){
	$username = mysqli_real_escape_string($conn, $_POST['username']);
	$password = mysqli_real_escape_string($conn,$_POST['password']);
	$res=mysqli_query($conn,"SELECT * FROM users WHERE username='$username'");
  $row = mysqli_fetch_array($res);
  $count = mysqli_num_rows($res);
    if($count == 1 && $row['password']==MD5($password)){
    	  session_start();
        $_SESSION['user_id'] = $row['user_id'];
        header("Location: studentHome.php");
	}else{
        $errMSG = "Incorrect Credentials, Try again...";
    }
}
if(isset($_POST['signup'])){
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $password = mysqli_real_escape_string($conn,$_POST['password']);
        $conf_password = mysqli_real_escape_string($conn,$_POST['conf_password']);
        $res=mysqli_query($conn,"SELECT email FROM users WHERE email='$email'");
        $count = mysqli_num_rows($res);
        if($count==1){
            $errMSG = "email already exist";
        }
        elseif($password==$conf_password){
        $query = "INSERT INTO users(username, email, password) VALUES('$username','$email',MD5('$password'))";
                if(mysqli_query($conn, $query)){
                    $errMSG = "Registered Successfully!";
                } else {
                    echo 'ERROR: '. mysqli_error($conn);
                }
        }
        else{
            $errMSG = "passwords doesn't match";
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
								<a style="position:fixed;bottom:0;left:0;" class="btn btn-primary btn-block" href="admin.php">Go To Admin Section</a>
							</div>
						</div>
						<div class="col-lg-4">
              <div class="login">
								<ul class="nav nav-pills nav-justified">
									<li class="active"><a data-toggle="tab" data-target="#signin">Sign In</a></li>
									<li><a data-toggle="tab" data-target="#signup">Sign Up</a></li>
								</ul>
								<div class="tab-content">
									<div id="signin" class="tab-pane in fade active">
										<form action="index.php" method="post" style="padding-left:20px; padding-right:20px"><br><br>
											<div class="form-group"><input class="form-control" type="text" name="username" placeholder="Username"></div><br>
											<div class="form-group"><input class="form-control" type="password" name="password" placeholder="Password"></div><br><br>
											<div class="form-group"><input class="form-control" type="submit" name="signin" value="Sign In"></div>
										</form>
									</div>
									<div id="signup" class="tab-pane fade" style="padding-left:20px; padding-right:20px">
										<form action="index.php" method="post"><br><br>
											<div class="form-group"><input class="form-control" type="text" name="username" placeholder="Username" required></div><br>
											<div class="form-group"><input class="form-control" type="email" name="email" placeholder="E-mail" required></div><br>
											<div class="form-group"><input class="form-control" type="password" name="password" placeholder="Password" required></div><br>
											<div class="form-group"><input class="form-control" type="password" name="conf_password" placeholder="Confirm Password" required></div><br>
											<div class="form-group"><input class="form-control" type="submit" name="signup" value="Sign Up"></div>
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
