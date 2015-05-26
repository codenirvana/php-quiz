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
      <title> <?php echo $PAGE_TITLE." | ".$SITE_NAME ?></title>

      <link type="text/css" rel="stylesheet" href="<?php echo BASE_URL ?>css/materialize.min.css"  media="screen,projection"/>
      <link type="text/css" rel="stylesheet" href="<?php echo BASE_URL ?>css/style.css"  media="screen,projection"/>

      <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
   </head>
   <body>
      <header>
         <nav class="blue-grey darken-3">
            <div class="nav-wrapper">
               <a href="<?php echo BASE_URL ?>" class="brand-logo">Quiz System</a>
               <a class='button-collapse' data-activates='mobile-demo' href='#'>
                  <svg pointer-events='none' style='vertical-align: middle;' viewBox='0 0 48 48' width='2.7em' xmlns='http://www.w3.org/2000/svg'><path d='M6 36h36v-4H6v4zm0-10h36v-4H6v4zm0-14v4h36v-4H6z'></path></svg>
               </a>
               <ul class="right hide-on-med-and-down">
                  <li><a href="<?php echo BASE_URL ?>">Home</a></li>
                  <li><a href="<?php echo BASE_URL ?>quiz">Quiz</a></li>
                  <li><a href="<?php echo BASE_URL ?>about">About</a></li>
                  <li>
                     <a href="<?php if(isset($username)) echo BASE_URL.'logout.php'; else echo BASE_URL.'login'; ?>">
                        <?php if(isset($username)) echo 'Logout'; else echo 'Login'; ?>
                     </a>
                  </li>
               </ul>
               <ul class='side-nav' id='mobile-demo'>
                  <li><a href="<?php echo BASE_URL ?>">Home</a></li>
                  <li><a href="<?php echo BASE_URL ?>quiz">Quiz</a></li>
                  <li><a href="<?php echo BASE_URL ?>about">About</a></li>
                  <li>
                     <a href="<?php if(isset($username)) echo BASE_URL.'logout.php'; else echo BASE_URL.'login'; ?>">
                        <?php if(isset($username)) echo 'Logout'; else echo 'Login'; ?>
                     </a>
                  </li>
               </ul>
            </div>
         </nav>
      </header>
      <div class='clear'></div>
