<?php require'database.php' ?>
<?php
  $test_id=$_GET['var'];
  $q_query=mysqli_query($conn,"SELECT * FROM questions_desc WHERE test_id='$test_id'");
  $q_result=mysqli_fetch_all($q_query, MYSQLI_ASSOC);
  function fetch($var){
    $question_id=$var;
    global $conn, $test_id;
    $a_query=mysqli_query($conn,"SELECT * FROM test_result_desc WHERE test_id='$test_id' AND question_id='$question_id'   ");
    $a_result=mysqli_fetch_all($a_query, MYSQLI_ASSOC);
    return $a_result;
  }
  if(isset($_POST['eval_test'])){
    $question_id=$_POST['question_id'];
    $a_query=mysqli_query($conn,"SELECT * FROM test_result_desc WHERE test_id='$test_id' AND question_id='$question_id' ");
    $a_result=mysqli_fetch_all($a_query, MYSQLI_ASSOC);
    foreach($a_result as $a_res){
      $result_id = $a_res['result_id'];
      $marks = $_POST[$a_res['result_id']];
      mysqli_query($conn,"UPDATE test_result_desc SET marks='$marks' WHERE result_id='$result_id' AND question_id='$question_id' AND test_id='$test_id' " );
    }
  }
?>
<!DOCTYPE html>
<html lang="en">
 	<head>
 		<meta charset="UTF-8">
 		<title>Online Exam Portal - Endeavor</title>
 		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
 		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
 		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
 		<link rel="stylesheet" type="text/css" href="css/stylesheet.css">
 	</head>
  <body>
    <a href="adminHome.php" class="scroll" style="left:10px;top:10px;position:fixed;"><i class="fa fa-close fa-2x"></i></a>
    <div class="container">
      <?php foreach($q_result as $q_res): ?>
        <h1><?php echo $q_res['question']; ?></h1><br>
        <form action="" method="post">
            <?php $a_result=fetch($q_res['question_id']) ?>
              <input  hidden='hidden' name='question_id' value=<?php echo $q_res['question_id']; ?> ><br>
            <?php foreach($a_result as $a_res): ?>
              <?php echo '<pre>'.$a_res['answer'].'</pre>'; ?>
              <input class="form-control" type="number" name=<?php echo $a_res['result_id'];?> value=<?php echo $a_res['marks'];?> placeholder="Marks"><br>
            <?php endforeach; ?>
          <input type="submit" name="eval_test" class="btn btn-success btn-block" value="Save Valuation">
        </form>
      <?php endforeach; ?>
      <br><br><br>
    </div>
  </body>
</html>
