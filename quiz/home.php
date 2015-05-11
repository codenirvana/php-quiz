<?php
   require_once(__DIR__ ."/../config.php");
   session_start();

   $PAGE_TITLE = "Take Quiz";

   include(ROOT_PATH.'inc/header.php');

   if (isset($_SESSION['username'])){
      $username = $_SESSION['username'];
      $now = time();
      if ($now > $_SESSION['expire']) {
         echo "<script>
                  alert('Your session has expired, Please Login!');
                  window.location.href='".BASE_URL."logout.php';
               </script>";
      }
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
