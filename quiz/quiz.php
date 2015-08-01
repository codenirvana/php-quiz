<?php
   require_once(__DIR__ ."/../config.php");
   if(isset($_GET['q'])){
      $quiz_name = $_GET['q'];
      $PAGE_TITLE = str_replace("-"," ",$quiz_name).' Quiz';
   } else{
      header('Location: /quiz');
   }

   include(ROOT_PATH.'/inc/header.php');
?>

<div id="main-wrapper" class="container">
   <?php
   echo "<h3>Quiz: ".strtoupper(str_replace("-"," ",$quiz_name))."</h3>";

   if (isset($username)){
      if(!isset($_SESSION['quiz-started']) OR empty($_SESSION['quiz-started']) OR $_SESSION['quiz-started']!=$quiz_name)
         header('Location: /quiz');

      //if form posted
      if(isset($_POST['submit'])){
         //check answer for previous question
         if($_POST['answer']==$_SESSION['answer']) $_SESSION['correct']++;

         $_SESSION['question-index']++;
         header('Location: /quiz/'.$quiz_name);
      }

      //get data related to quiz
      $quiz_data = quiz_data($quiz_name,$_SESSION['question-index']);

      if($quiz_data==false){
          header('Location: /quiz');
      } else{
         //store answer for current question
         $_SESSION['answer'] = $quiz_data['a1'];
      }

      //quiz ended, show the result
      if($_SESSION['question-index']>=$_SESSION['questions']){
         header('Location: /quiz/result');
      }
   ?>
   <form class="quiz-test" method="post">
      <p>
         <b> <?php echo $quiz_data['question'] ?></b>
      </p>
      <p>
         <?php
            for($i=0;$i<$quiz_data['options'];$i++){
               echo '<input type="radio" name="answer" value='.$quiz_data['a'.($i+1)].' id="ans'.$i.'"/>'.
               '<label for="ans'.$i.'">'.$quiz_data['a'.($i+1)].'</label><br/>';
            }
         ?>
      </p>
      <input class="waves-effect waves-light btn blue-grey" type="submit" name="submit" value="next">
   </form>

<?php
   } else{
      echo "You must be login!";
      echo "<a href='/login'>Login</a>";
   }
?>

</div> <!-- main-wrapper ends -->
<?php include(ROOT_PATH.'/inc/footer.php'); ?>
