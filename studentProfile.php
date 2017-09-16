<?php require'database.php' ?>
<?php
session_start();
if(!isset($_SESSION['user_id'])){
	header("Location: index.php");
}
$user_id = $_SESSION['user_id'];
$query_user = mysqli_query($conn,"SELECT username, email FROM users WHERE user_id='$user_id' ");
$results_user = mysqli_fetch_array($query_user, MYSQLI_ASSOC);
$query = mysqli_query($conn,"SELECT * FROM test_result WHERE user_id='$user_id' ");
$results = mysqli_fetch_all($query, MYSQLI_ASSOC);
$query_test = mysqli_query($conn,"SELECT test_id,test_name,subject FROM test ");
$results_test = mysqli_fetch_all($query_test, MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>Online Exam Portal - Endeavor</title>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		<link rel="stylesheet" type="text/css" href="css/stylesheet.css">
	</head>
	<body>
		<nav class="navbar navbar-inverse">
		  <div class="container-fluid">
		    <div class="navbar-header">
		      <a class="navbar-brand" href="studentHome.php">Endeavor Edutech</a>
		    </div>
		    <ul class="nav navbar-nav">
		      <li class="active"><a href="studentHome.php">Home</a></li>
		      <li><a href="studentProfile.php">Profile</a></li>
		    </ul>
		    <ul class="nav navbar-nav navbar-right">
		      <li><a href="logout.php"><span class="glyphicon glyphicon-log-in"></span> Logout</a></li>
		    </ul>
		  </div>
		</nav>
    <div class="container">
			<h2>Name: <?php echo $results_user['username'];?></h2>
			<h2>Email: <?php echo $results_user['email'];?></h2><br>
			<table class="table">
        <thead>
          <tr>
						<th>Sr No.</th>
						<th>Subject</th>
						<th>Test Name</th>
            <th>Total Questions</th>
            <th>Correct Answers</th>
            <th>Wrong Answers</th>
            <th>Not Attempted</th>
            <th>Score</th>
						<th>Descriptive Questions Score</th>
          </tr>
        </thead>
        <tbody>
					<?php $i=1; foreach ($results as $res): ?>
          <tr>
						<td><?php echo $i; ?></td>
						<?php foreach ($results_test as $result_test): ?>
							<?php if($res['test_id']==$result_test['test_id']){
									echo '<td>'.$result_test['subject'].'</td>';
									echo '<td>'.$result_test['test_name'].'</td>';
								}
							?>
						<?php endforeach; ?>
            <td><?php echo ($res['right_ans']+$res['wrong_ans']+$res['no_attempt']); ?></td>
            <td><?php echo $res['right_ans']; ?></td>
            <td><?php echo $res['wrong_ans']; ?></td>
            <td><?php echo $res['no_attempt']; ?></td>
            <td><?php echo number_format((float) $res['score'],2, '.', '').' %'; ?></td>
						<?php $result_id=$res['result_id'];
						$marks_q=mysqli_query($conn,"SELECT SUM(marks) FROM test_result_desc WHERE result_id='$result_id' ");
						while($row = mysqli_fetch_array($marks_q)){
       				$marks= $row['SUM(marks)'];
						}
						?>
						<td><?php echo $marks; ?></td>
          </tr>
				<?php $i++; endforeach; ?>
        </tbody>
      </table>
		</div>
	</body>
</html>
