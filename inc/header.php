<?php
session_start();

require_once(__DIR__ ."/../config.php");
require_once('connect.php');
require_once('functions.php');

//check if session exist
if (isset($_SESSION['username'])){
   $username = $_SESSION['username'];
   check_session();
}

?>
<!DOCTYPE html>
<html>
   <head>
      <title><?php echo $PAGE_TITLE." | ".$SITE_NAME ?></title>

      <link type="text/css" rel="stylesheet" href="<?php echo BASE_URL ?>css/materialize.min.css"  media="screen,projection"/>

      <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
   </head>
   <body>
      <header>
         <h1>Quiz System</h1>
         <nav>
            <ul>
               <li><a href="<?php echo BASE_URL ?>">Home</a></li>
               <li><a href="<?php echo BASE_URL ?>quiz">Quiz</a></li>
               <li><a href="<?php echo BASE_URL ?>about">About</a></li>
               <li>
                  <a href="<?php if(isset($username)) echo BASE_URL.'logout.php'; else echo BASE_URL.'login'; ?>">
                     <?php if(isset($username)) echo 'Logout'; else echo 'Login'; ?>
                  </a>
               </li>
            </ul>
         </nav>
      </header>
      <div class='clear'></div>
