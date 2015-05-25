<?php
   require_once(__DIR__ ."/../config.php");


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
         header('Location: '.BASE_URL.'quiz');
      }else{
         $msg = "Invalid Login Credentials.";
      }
   }

   /*
    * If user is logged-in
    * redirect to home.php
    */
    if(isset($username)){
      header('Location: '.BASE_URL.'quiz');
   }
?>

<p class="info-msg">
   <?php if(isset($msg) & !empty($msg)) echo $msg; ?>
</p>

<div class="register-form">
   <h1>Register</h1>
   <form action="" method="POST">
      <p><label>User Name : </label>
   	<input id="username" type="text" name="username" required placeholder="UserName" /></p>
   	<p><label>E-Mail : </label>
   	<input id="email" type="email" name="email" required placeholder="you@website.com" /></p>
      <p><label>Password : </label>
   	<input id="password" type="password" name="password" required placeholder="password" /></p>
      <p><label>Question : </label>
         <select name="question">
           <option value="101" selected="selected">Question1</option>
           <option value="102">Question2</option>
         </select>
      </p>
      <p><label>Answer : </label>
   	<input type="text" name="answer" required placeholder="Answer" /></p>
      <p><label>Type : </label>
         <select name="type">
           <option value="333" selected="selected">User</option>
           <option value="222">Author</option>
         </select>
      </p>
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
   <span class="forgot"><a href="<?php echo BASE_URL ?>help/forgot">Forgot Password?</a></span>
</div>

<?php include(ROOT_PATH.'inc/footer.php'); ?>
