<?php
   require_once("config.php");

   $PAGE_TITLE = "Home";

   include(ROOT_PATH.'/inc/header.php');
?>

<div class="parallax-container valign-wrapper">
   <div class="valign center">
      <h2 class="grey-text text-lighten-5">
      <?php
         if(isset($username)){
            echo 'Welcome back '.$username.'</h2>';
         } else{
            echo 'Let\'s Quiz!</h2>';
         }
      ?>

      <h5 class="grey-text text-darken-3">Total Quizzes: <?php echo total_quiz_tables(); ?></h5><br>
      <a href="/quiz" class="waves-effect waves-light btn-large blue-grey darken-2">Start</a>

   </div>
   <div class="parallax"><img src="/assets/img/parallax.jpg"></div>
</div>

<?php include(ROOT_PATH.'/inc/footer.php'); ?>
