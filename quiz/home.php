<?php
   require_once(__DIR__ ."/../config.php");

   $PAGE_TITLE = "Take Quiz";

   include(ROOT_PATH.'inc/header.php');

   if (isset($username)){
?>

<div class="main">
   <?php
      echo "Hello $username";
      echo "<a href='".BASE_URL."logout.php'>Logout</a>";
   ?>
</div>

<?php

   } else{
      echo "You must be login!";
      echo "<a href='".BASE_URL."login'>Login</a>";
   }

   include(ROOT_PATH.'inc/footer.php');
?>
