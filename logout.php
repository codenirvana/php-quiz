<?php
   /*
    * Unset all the $_SESSION variables
    * Redirect to login.php
    */
   session_start();
   session_unset();
   session_destroy();
   header('Location: login.php');
?>
