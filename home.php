<?php
   session_start();

   $PAGE_TITLE = "Take Quiz";

   require('inc/header.php');

   if (isset($_SESSION['username'])){
      $username = $_SESSION['username'];
      $now = time();
      if ($now > $_SESSION['expire']) {
         echo "<script>
                  alert('Your session has expired, Please Login!');
                  window.location.href='logout.php';
               </script>";
      }
?>

<div class="main">
   <?php
      echo "Hello $username";
      echo "<a href='logout.php'>Logout</a>";
   ?>
</div>

<?php

   } else{
      echo "You must be login!";
      echo "<a href='login.php'>Login</a>";
   }

   require('inc/footer.php');
?>
