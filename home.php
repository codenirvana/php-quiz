<?php
   session_start();
   require('inc/header.php');
?>

<div class="main">
   <?php
      if (isset($_SESSION['username'])){
         $username = $_SESSION['username'];
         echo "Hello $username";
         echo "<a href='logout.php'>Logout</a>";
      } else{
         echo "You must be login!";
         echo "<a href='login.php'>Login</a>";
      }
   ?>
</div>

<?php require('inc/footer.php'); ?>
