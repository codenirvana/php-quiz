<?php
   require_once("config.php");
   /*
    * Unset all the $_SESSION variables
    * Redirect to login.php
    */
   session_start();
   session_unset();
   session_destroy();
   header('Location: '.BASE_URL.'login');
