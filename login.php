<?php
   session_start();
   require('inc/connect.php');

   //register
   if (isset($_POST['username']) && isset($_POST['password'])){
      $name = $_POST['name'];
      $username = $_POST['username'];
      $email = $_POST['email'];
      $password = $_POST['password'];
      $type = $_POST['type'];
      $query = "INSERT INTO `users` (name, username, email, password, type) VALUES ('$name','$username', '$email','$password', '$type')";
      $result = mysql_query($query);
      if($result){
           $msg = "User Created Successfully.";
      }
   }

   //login
   if (isset($_POST['uname']) and isset($_POST['pword'])){
      $username = htmlspecialchars($_POST['uname']);
      $password = htmlspecialchars($_POST['pword']);
      $query = 'SELECT * FROM users WHERE username="'.$username.'" and password="'.$password.'"';
      $result = mysql_query($query) or die(mysql_error());
      $count = mysql_num_rows($result);
      if ($count == 1){
         $_SESSION['username'] = $username;
      }else{
         echo "Invalid Login Credentials.";
      }
   }
   if (isset($_SESSION['username'])){
      $username = $_SESSION['username'];
      echo "Hai " . $username . "
      ";
      echo "This is the Members Area
      ";
      echo "<a href='logout.php'>Logout</a>";

   }else{
?>
<!DOCTYPE html>
<html>
   <head>
      <title>Login | Quiz System</title>
   </head>
   <body>
      <div class="register-form">
         <?php
         	if(isset($msg) & !empty($msg)){
         		echo $msg;
         	}
          ?>
         <h1>Register</h1>
         <form action="" method="POST">
            <p><label>Name : </label>
         	<input id="name" type="text" name="name" placeholder="Full Name" /></p>
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

      <div class="register-form">
         <?php
         	if(isset($msg2) & !empty($msg2)){
         		echo $msg2;
         	}
          ?>
         <h1>Login</h1>
         <form action="" method="POST">
            <p><label>User Name : </label>
         	<input id="uname" type="text" name="uname" required placeholder="UserName" /></p>
            <p><label>Password : </label>
         	<input id="pword" type="password" name="pword" required placeholder="password" /></p>
            <input type="submit" name="submit" value="Register" />
         </form>
      </div>
   </body>
</html>
<?php } ?>
