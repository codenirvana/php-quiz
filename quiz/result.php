<?php
   require_once(__DIR__ ."/../config.php");

   include(ROOT_PATH.'inc/header.php');

   if($_SESSION['question-index']<$_SESSION['questions'] OR $_SESSION['questions']==0) header('Location: '.BASE_URL.'quiz');

   echo "You scored: ".$_SESSION['correct']."/".$_SESSION['questions'];

   reset_quiz_session_variables();
?>
