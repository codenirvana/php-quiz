<?php
require_once(__DIR__ ."/../config.php");
require_once('connect.php');
require_once('functions.php');

?>
<!DOCTYPE html>
<html>
   <head>
      <title><?php echo $PAGE_TITLE." | ".$SITE_NAME ?></title>
      <link rel="stylesheet" href="<?php echo BASE_URL ?>css/style.css" media="screen"/>
      <link rel="stylesheet" href="<?php echo BASE_URL ?>css/normalize.css" media="screen"/>
   </head>
   <body>
      <header>
         <h1>Quiz System</h1>
         <nav>
            <ul>
               <li><a href="<?php echo BASE_URL ?>">Home</a></li>
               <li><a href="<?php echo BASE_URL ?>quiz">Quiz</a></li>
               <li><a href="<?php echo BASE_URL ?>about">About</a></li>
               <li><a href="<?php echo BASE_URL ?>login">Login</a></li>
            </ul>
         </nav>
      </header>
      <div class='clear'></div>
