<?php
   session_start();
   require('config.php');
   require('inc/connect.php');
   require('inc/functions.php');

   /*
    * If posted information from register form
    */
   if (isset($_POST['username']) && isset($_POST['password'])){
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
   if (isset($_POST['uname']) and isset($_POST['pword'])){
      if (check_credentials($_POST)){
         /*
          * set $_SESSION variable
          * redirect to home.php
          */
         $_SESSION['username'] = $_POST['uname'];
         header('Location: home.php');
      }else{
         $msg = "Invalid Login Credentials.";
      }
   }
?>
<!DOCTYPE html>
<html>
   <head>
      <title>Login | <?php echo $SITE_NAME ?></title>
   </head>
   <body>
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
            <input type="submit" name="submit" value="Register" />
         </form>
      </div>

      <div class="login-form">
         <h1>Login</h1>
         <form action="" method="POST">
            <p><label>User Name : </label>
         	<input id="uname" type="text" name="uname" required placeholder="UserName" /></p>
            <p><label>Password : </label>
         	<input id="pword" type="password" name="pword" required placeholder="password" /></p>
            <input type="submit" name="submit" value="Login" />
         </form>
      </div>
   </body>
</html>
