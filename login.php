<?php
   session_start();
   require('config.php');
   require_once('inc/connect.php');

   //register
   if (isset($_POST['username']) && isset($_POST['password'])){
      $name = $_POST['name'];
      $username = $_POST['username'];
      $email = $_POST['email'];
      $password = $_POST['password'];
      $type = $_POST['type'];

      //check if username exists
      $sql="SELECT * FROM `users` where username=:uname";
      $q = $db->prepare($sql);
      $q->execute(array(':uname' => $username));
      $result = $q->fetchAll();
      if(count($result)){
         $msg = "User exists!";
      } else{
         //insert data
         $sql="INSERT INTO `users` (name, username, email, password, type) VALUES (:name, :username, :email, :password, :type)";
         $q = $db->prepare($sql);
         $q->execute(array(':name'=>$name,
                           ':username'=>$username,
                           ':email'=>$email,
                           ':password'=>$password,
                           ':type'=>$type
         ));
         if($q){
            $msg = "User Created Successfully.";
         } else{
            $msg = "Error Creating new user, Try again later!";
         }
      }
   }

   //login
   if (isset($_POST['uname']) and isset($_POST['pword'])){
      $username = $_POST['uname'];
      $password = $_POST['pword'];

      $sql = 'SELECT * FROM users WHERE username=:uname and password=:pword';
      $q = $db->prepare($sql);
      $q->execute(array(':uname'=>$username, ':pword'=>$password));
      $result = $q->fetchAll();
      $count = count($result);
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
      <title>Login | <?php echo $SITE_NAME ?></title>
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
<?php } ?>
