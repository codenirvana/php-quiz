<?php
   require_once(__DIR__ ."/../config.php");

   session_start();

   $PAGE_TITLE = "Login";

   include(ROOT_PATH.'inc/header.php');

   $msg = "Register or Login for quiz!";

   /*
    * If posted information from register form
    */
   if (isset($_POST['submit1'])){
      if( if_user_exists($_POST['username']) ){
         $msg = "User Name '".$_POST['username']."' already exists!";
      } else{
         $q = add_new_user($_POST);
         if($q){
            $msg = "Registered Successfully, Please Login";
         } else{
            $msg = "Error registering new user, Try again later!";
         }
      }
   }

   /*
    * If posted information from login form
    */
   if (isset($_POST['submit2'])){
      if (check_credentials($_POST)){
         start_session($_POST['uname']);
      }else{
         $msg = "Invalid Login Credentials.";
      }
   }

   /*
    * If user is logged-in
    * redirect to home.php
    */
    if(isset($_SESSION['username'])){
      header('Location: '.BASE_URL.'quiz');
   }
?>

<p class="info-msg">
   <?php if(isset($msg) & !empty($msg)) echo $msg; ?>
</p>

<div class="register-form">
   <h1>Register</h1>
   <form action="" method="POST">
      <p><label>Name : </label>
   	<input id="name" type="text" name="name" required placeholder="Full Name" /></p>
      <p><label>User Name : </label>
   	<input id="username" type="text" name="username" required placeholder="UserName" /></p>
   	<p><label>E-Mail : </label>
   	<input id="email" type="email" name="email" required placeholder="you@website.com" /></p>
      <p><label>Password : </label>
   	<input id="password" type="password" name="password" required placeholder="password" /></p>
      <p><label>Type : </label>
   	<input id="type" type="text" name="type" required placeholder="2/3" /></p>
      <input type="submit" name="submit1" value="Register" />
   </form>
</div>

<div class="login-form">
   <h1>Login</h1>
   <form action="" method="POST">
      <p><label>User Name : </label>
   	<input id="uname" type="text" name="uname" required placeholder="UserName" /></p>
      <p><label>Password : </label>
   	<input id="pword" type="password" name="pword" required placeholder="password" /></p>
      <input type="submit" name="submit2" value="Login" />
   </form>
</div>

<?php include(ROOT_PATH.'inc/footer.php'); ?>
