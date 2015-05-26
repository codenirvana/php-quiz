<?php
   require_once(__DIR__ ."/../config.php");

   $PAGE_TITLE = "Take Quiz";

   include(ROOT_PATH.'inc/header.php');
?>
<div id="main-wrapper" class="container">
   <h3>Take a quiz</h3>
   <?php
   if (isset($username)){
      reset_quiz_session_variables();

      $links = get_quiz_links();
      foreach ($links as $link) {
         $link_name = str_replace("-"," ",$link);
         echo "<a class='quiz-name' href='".BASE_URL."quiz/d/$link'>".$link_name."</a>";
         echo "<br>";
      }
   ?>

<?php
   } else{
      echo "You must be <a href='".BASE_URL."login'>Login</a>";
   }
?>
</div> <!-- main-wrapper ends -->
<?php include(ROOT_PATH.'inc/footer.php'); ?>
