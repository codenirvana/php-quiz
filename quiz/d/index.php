<?php
   require_once(__DIR__ ."/../../config.php");
   if(isset($_GET['q'])){
      $quiz_name = $_GET['q'];
      $PAGE_TITLE = str_replace("-"," ",$quiz_name).' Details';
   } else{
      header('Location: '.BASE_URL.'quiz');
   }

   include(ROOT_PATH.'inc/header.php');

   if (isset($username)){

      reset_quiz_session_variables();

      $details = quiz_details($quiz_name);
      if($details==false) header('Location: '.BASE_URL.'quiz');

      //if form submited
      if(isset($_POST['submit'])){
         $_SESSION['quiz-started']=$quiz_name;
         $_SESSION['question-index']=0;
         $_SESSION['questions']=$details["questions"];
         $_SESSION['correct']=0;
         header('Location: '.BASE_URL.'quiz/'.$quiz_name);
      }
?>

<div class="main">
   <h3>Quiz details</h3>
   <p><b>Name:</b> <?php echo $details["name"] ?></p>
   <p><b>Author:</b> <?php echo $details["author"] ?></p>
   <p><b>Category:</b> <?php echo $details["category"] ?></p>
   <p><b>Questions:</b> <?php echo $details["questions"] ?></p>
   <p><b>Difficulty:</b> <?php echo $details["difficulty"] ?></p>
   <form method="post">
      <input type="submit" name="submit" value="Start">
   </form>
</div>

<?php

   } else{
      echo "You must be login!";
      echo "<a href='".BASE_URL."login'>Login</a>";
   }

   include(ROOT_PATH.'inc/footer.php');
?>
