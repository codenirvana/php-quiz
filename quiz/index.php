<?php
   require_once(__DIR__ ."/../config.php");

   $PAGE_TITLE = "Take Quiz";

   include(ROOT_PATH.'inc/header.php');

   if (isset($username)){
      reset_quiz_session_variables();
?>

<div class="main">
   <h3>Take a quiz</h3>
   <?php
      $links = get_quiz_links();
      foreach ($links as $link) {
         $link_name = str_replace("-"," ",$link);
         echo "<a href='".BASE_URL."quiz/d/$link'>".$link_name."</a>";
         echo "<br>";
      }
   ?>
</div>

<?php

   } else{
      echo "You must be login!";
      echo "<a href='".BASE_URL."login'>Login</a>";
   }

   include(ROOT_PATH.'inc/footer.php');
?>
