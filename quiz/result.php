<?php
   require_once(__DIR__ ."/../config.php");

   $PAGE_TITLE = 'Result';

   include(ROOT_PATH.'inc/header.php');
?>

<div id="main-wrapper" class="container">
   <h3>Result</h3>
   <?php
   if($_SESSION['question-index']<$_SESSION['questions'] OR $_SESSION['questions']==0) header('Location: '.BASE_URL.'quiz');

   echo "<h5>You scored: ".$_SESSION['correct']."/".$_SESSION['questions']."</h5>";

   reset_quiz_session_variables();
   ?>

</div> <!-- main-wrapper ends -->
<?php include(ROOT_PATH.'inc/footer.php'); ?>
