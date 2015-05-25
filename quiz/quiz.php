<?php
   require_once(__DIR__ ."/../config.php");
   if(isset($_GET['q'])){
      $quiz_name = $_GET['q'];
      $PAGE_TITLE = str_replace("-"," ",$quiz_name).' Quiz';
   } else{
      header('Location: '.BASE_URL.'quiz');
   }

   include(ROOT_PATH.'inc/header.php');

   if (isset($username)){
      if(!isset($_SESSION['quiz-started']) OR empty($_SESSION['quiz-started']) OR $_SESSION['quiz-started']!=$quiz_name)
         header('Location: '.BASE_URL.'quiz');

      //if form posted
      if(isset($_POST['submit'])){
         //check answer for previous question
         if($_POST['answer']==$_SESSION['answer']) $_SESSION['correct']++;

         $_SESSION['question-index']++;
         header('Location: '.BASE_URL.'quiz/'.$quiz_name);
      }

      //get data related to quiz
      $quiz_data = quiz_data($quiz_name,$_SESSION['question-index']);

      if($quiz_data==false){
          header('Location: '.BASE_URL.'quiz');
      } else{
         //store answer for current question
         $_SESSION['answer'] = $quiz_data['a1'];
      }

      //quiz ended, show the result
      if($_SESSION['question-index']>=$_SESSION['questions']){
         header('Location: '.BASE_URL.'quiz/result');
      }

?>

<div class="main">
   <h3>Quiz Started</h3>

   <form class="quiz-test" method="post">
      <p>
         <b> <?php echo $quiz_data['question'] ?></b>
      </p>
      <p>
         <?php
            for($i=0;$i<$quiz_data['options'];$i++){
               echo '<input type="radio" name="answer" value='.$quiz_data['a'.($i+1)].'>'.$quiz_data['a'.($i+1)].'</input><br/>';
            }
         ?>
      </p>
      <input type="submit" name="submit" value="next">
   </form>
</div>

<?php

   } else{
      echo "You must be login!";
      echo "<a href='".BASE_URL."login'>Login</a>";
   }

   include(ROOT_PATH.'inc/footer.php');
?>
