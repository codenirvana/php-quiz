<?php
   require_once(__DIR__ ."/../../config.php");
   if(isset($_GET['q'])){
      $quiz_name = $_GET['q'];
      $PAGE_TITLE = str_replace("-"," ",$quiz_name).' Details';
   } else{
      header('Location: /quiz');
   }

   include(ROOT_PATH.'/inc/header.php');
?>
<div id="main-wrapper" class="container">
   <h3>Quiz Details</h3>
   <?php
   if (isset($username)){

      reset_quiz_session_variables();

      $details = quiz_details($quiz_name);
      if($details==false) header('Location: /quiz');

      //if form submited
      if(isset($_POST['submit'])){
         $_SESSION['quiz-started']=$quiz_name;
         $_SESSION['question-index']=0;
         $_SESSION['questions']=$details["questions"];
         $_SESSION['correct']=0;
         header('Location: /quiz/'.$quiz_name);
      }
   ?>
   <p><b>Name:</b> <?php echo $details["name"] ?></p>
   <p><b>Author:</b> <?php echo $details["author"] ?></p>
   <p><b>Category:</b> <?php echo $details["category"] ?></p>
   <p><b>Questions:</b> <?php echo $details["questions"] ?></p>
   <p><b>Difficulty:</b> <?php echo $details["difficulty"] ?></p>
   <form method="post">
      <input class="waves-effect waves-light btn blue-grey" type="submit" name="submit" value="Start">
   </form>

<?php
   } else{
      echo "You must be login!";
      echo "<a href='/login'>Login</a>";
   }
?>

</div> <!-- main-wrapper ends -->
<?php include(ROOT_PATH.'/inc/footer.php'); ?>
