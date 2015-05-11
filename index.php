<?php
   require_once("config.php");

   $PAGE_TITLE = "Home";

   include(ROOT_PATH.'inc/header.php');
?>


<h3>Total Quizzes: <?php echo total_quiz_tables(); ?></h3>

<?php include(ROOT_PATH.'inc/footer.php'); ?>
