<?php require'database.php' ?>
<?php
error_reporting(0);
$test_id=$_GET['var'];
$t_query=mysqli_query($conn,"SELECT * FROM test WHERE test_id='$test_id' ");
$t_result=mysqli_fetch_array($t_query, MYSQLI_ASSOC);
$q_query=mysqli_query($conn,"SELECT * FROM questions WHERE test_id='$test_id' ");
$q_result=mysqli_fetch_all($q_query, MYSQLI_ASSOC);
if(isset($_POST['add_question'])){
		$question = mysqli_real_escape_string($conn,$_POST['question']);
		$target_dir = "questions/";
		$target_file = $target_dir . basename($_FILES["image"]["name"]);
		$uploadOk = 1;
		$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
		$option_a = $_POST['option_a'];
		$option_b = $_POST['option_b'];
		$option_c = $_POST['option_c'];
		$option_d = $_POST['option_d'];
		$answer = $_POST['answer'];
		$add_question = " INSERT INTO questions(test_id, question, image, option_a, option_b, option_c, option_d, answer) VALUES('$test_id' ,'$question','$target_file','$option_a','$option_b','$option_c','$option_d','$answer') ";
		mysqli_query($conn,$add_question);
		move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
		header("Location: question.php?var="+$test_id);
}
	if(isset($_POST["add_desc_question"])){
		$question_desc = mysqli_real_escape_string($conn,$_POST['question_desc']);
		$target_dir = "questions_desc/";
		$target_file = $target_dir . basename($_FILES["image"]["name"]);
		$uploadOk = 1;
		$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
		mysqli_query($conn,"INSERT INTO questions_desc(test_id, question, image) 	VALUES ('$test_id', '$question_desc','$target_file')");
		move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
		header("Location: question.php?var="+$test_id);
	}
if(isset($_POST['update_test'])){
		$test_name = $_POST['test_name'];
		$sdatetime = $_POST['sdatetime'];
		$edatetime = $_POST['edatetime'];
		$test_duration = $_POST['test_duration'];
		$update_test = " UPDATE test SET test_name = '$test_name', sdatetime = '$sdatetime', edatetime = '$edatetime', test_duration = '$test_duration' WHERE test_id = '$test_id' ";
		mysqli_query($conn,$update_test);
		print_r($update_test);
		header("Location: question.php?var="+$test_id);
}
if(isset($_POST['edit_question'])){
		$question = mysqli_real_escape_string($conn,$_POST['question']);
		$question_id = $_POST['question_id'];
		$target_dir = "questions/";
		$target_file = $target_dir . basename($_FILES["image"]["name"]);
		$uploadOk = 1;
		$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
		$option_a = $_POST['option_a'];
		$option_b = $_POST['option_b'];
		$option_c = $_POST['option_c'];
		$option_d = $_POST['option_d'];
		$answer = $_POST['answer'];
		$edit_question = "UPDATE questions SET question = '$question' ,image= '$target_file', option_a = '$option_a', option_b = '$option_b', option_c = '$option_c', option_d = '$option_d', answer = '$answer' WHERE question_id = '$question_id' ";
		mysqli_query($conn,$edit_question);
		move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
		header("Location: question.php?var="+$test_id);
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
		<script type="text/javascript" src="js/javascript.js"></script>
	</head>
  <body>
    <div class="container">
    <br><br>
      <div style="color:#154360;">
        <h1>UPDATE TEST SETTINGS</h1>
        <h3>TEST NAME: <?php echo $t_result['test_name'] ?> </h3>
        <h3>SUBJECT: <?php echo $t_result['subject'] ?></h3>
      </div>
      <a href="adminHome.php" class="scroll" style="left:10px;top:10px;position:fixed;"><i class="fa fa-close fa-2x"></i></a>
      <h2 class="btn btn-info" data-toggle="collapse" data-target="#add" style="height: 40px; width:100%;">ADD MULTIPLE CHOICE QUESTION</h2><br><br>
      <div id="add" class="collapse">
        <form method="post" action="" enctype="multipart/form-data">
            <div class="form-group">
              <textarea class="form-control" name="question" placeholder="Question" style="width: 1100px;" required></textarea>
            </div>
						<div class="form-group form-inline">
              <input class="form-control" type="file" name="image" style="width: 300px;"> Add Image
            </div>
            <div class="form-inline form-group">
              <input class="form-control" type="text" name="option_a" placeholder="Option A" style="width: 550px;">
              <input class="form-control" type="text" name="option_b" placeholder="Option B" style="width: 550px;">
            </div>
            <div class="form-inline form-group">
              <input class="form-control" type="text" name="option_c" placeholder="Option C" style="width: 550px;">
              <input class="form-control" type="text" name="option_d" placeholder="Option D" style="width: 550px;">
            </div>
            <div class="form-group form-inline" >
              <!--<input class="form-control" type="text" name="answer" placeholder="Answer Option" style="width: 300px;">-->
							<select name="answer" class="form-control" placeholder="Answer Option" style="width: 300px;" required>
				     		<option>a</option>
				     		<option>b</option>
								<option>c</option>
				     		<option>d</option>
				      </select>Correct Answer
            </div>
                <br>
            <input type="submit" name="add_question" value="Add Question" class="btn btn-danger" style="height: 40px; width:300px;">
        </form><br>
      </div>
			<h2 class="btn btn-primary" data-toggle="collapse" data-target="#add_desc" style="height: 40px; width:100%;">ADD DESCRIPTIVE QUESTION</h2><br><br>
			<div id="add_desc" class="collapse">
        <form method="post" action="" enctype="multipart/form-data">
            <div class="form-group">
              <textarea class="form-control" name="question_desc" placeholder="Question" style="width: 1100px;" required></textarea>
            </div>
            <div class="form-group form-inline">
              <input class="form-control" type="file" name="image" style="width: 300px;"> Add Image
            </div>
                <br>
            <input type="submit" name="add_desc_question" value="Add Question" class="btn btn-danger" style="height: 40px; width:300px;">
        </form><br>
      </div>
      <h2 class="btn btn-info" data-toggle="collapse" data-target="#update" style="height: 40px; width:100%;">UPDATE TEST SETTINGS</h2><br><br>
      <div id="update" class="collapse">
        <form method="post" action="">
        <div class="form-inline form-group">
          <input class="form-control" type="text" name="test_name" value="<?php echo $t_result['test_name'] ?>" style="width: 300px;">Test Name
        </div>
        <div class="form-inline form-group">
          <input class="form-control date" type="datetime-local" name="sdatetime" value= <?php echo date('Y-m-d\Th:i', strtotime($t_result['sdatetime']) ); ?> style="width: 300px;">
          Start Date and Time [old: <?php echo $t_result['sdatetime'] ?> ]
          "2017-06-01T08:30"
        </div>
        <div class="form-inline form-group">
          <input class="form-control" type="datetime-local" name="edatetime" value=<?php echo date('Y-m-d\Th:i', strtotime($t_result['edatetime']) ); ?> style="width: 300px;">
          End Date and Time [old: <?php echo $t_result['edatetime'] ?> ]
        </div>
        <div class="form-inline form-group">
          <input class="form-control" type="number" name="test_duration" value="<?php echo $t_result['test_duration'] ?>" style="width: 300px;">Test Duration
        </div>
        <br>
        <input type="submit" name="update_test" value="Update Test" class="btn btn-danger" style="height: 40px; width:300px;">
        </form>
      </div>
      <h2 class="btn btn-primary" data-toggle="collapse" data-target="#edit" style="height: 40px; width:100%;">EDIT QUESTION DETAILS</h2><br><br>
      <div id="edit" class="collapse">
        <?php foreach ($q_result as $q_res): ?>
        <form method="post" action="" enctype="multipart/form-data">
            <div class="form-group">
              <textarea class="form-control" name="question" style="width: 1100px;" required><?php echo $q_res['question'] ?></textarea>
            </div>
						<div class="form-group form-inline">
              <input class="form-control" type="file" name="image" style="width: 300px;"> Add Image
            </div>
            <div class="form-inline form-group">
              <input class="form-control" type="text" name="option_a" value="<?php echo $q_res['option_a'] ?>" style="width: 550px;">
              <input class="form-control" type="text" name="option_b" value="<?php echo $q_res['option_b'] ?>" style="width: 550px;">
            </div>
            <div class="form-inline form-group">
              <input class="form-control" type="text" name="option_c" value="<?php echo $q_res['option_c'] ?>" style="width: 550px;">
              <input class="form-control" type="text" name="option_d" value="<?php echo $q_res['option_d'] ?>" style="width: 550px;">
            </div>
            <div class="form-group">
              <input class="form-control" type="text" name="answer" value="<?php echo $q_res['answer'] ?>" style="width: 300px;">
            </div>
            <input type="number" name="question_id" hidden value="<?php echo $q_res['question_id'] ?>" >
                <br>
            <input type="submit" name="edit_question" value="Update Question" class="btn btn-danger" style="height: 40px; width:300px;">
        </form><br><hr style="border:1px solid black; ">
        <?php endforeach; ?>
      </div>
    </div>
  </body>
</html>
