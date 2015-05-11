<?php
require('config.php');
require('connect.php');
require('functions.php');

?>
<!DOCTYPE html>
<html>
   <head>
      <title><?php echo $PAGE_TITLE." | ".$SITE_NAME ?></title>
      <link rel="stylesheet" href="css/style.css" media="screen"/>
      <link rel="stylesheet" href="css/normalize.css" media="screen"/>
   </head>
   <body>
      <header>
         <h1>Quiz System</h1>
         <nav>
            <ul>
               <li><a href="index.php">Home</a></li>
               <li><a href="home.php">Quiz</a></li>
               <li><a href="about.php">About</a></li>
               <li><a href="login.php">Login</a></li>
            </ul>
         </nav>
      </header>
      <div class='clear'></div>
