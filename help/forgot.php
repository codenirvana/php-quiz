<?php
   require_once(__DIR__ ."/../config.php");


   $PAGE_TITLE = "Forgot Password";

   include(ROOT_PATH.'inc/header.php');

   $msg = "Forgot Password?";

   /*
    * If posted information from forgot form
    */
   if (isset($_POST['submit'])){
      if( !if_user_exists($_POST['username']) ){
         $msg = "User Name '".$_POST['username']."' does not exists!";
      } else{
         $pwd = recover_password($_POST);
         if(empty($pwd)){
            $msg = "Please provide valid information!";
         } else{

            $msg = "You password is '".$pwd."'";
         }
      }
   }

?>

<div class="forgot-form">
   <h3> <?php echo $msg ?> </h3>
   <form action="" method="POST">
      <p><label>User Name : </label>
   	<input id="username" type="text" name="username" required placeholder="UserName" /></p>
      <p><label>Question : </label>
         <select name="question">
           <option value="101" selected="selected">Question1</option>
           <option value="102">Question2</option>
         </select>
      </p>
      <p><label>Answer : </label>
   	<input type="text" name="answer" required placeholder="Answer" /></p>
      <input type="submit" name="submit" value="Submit" />
   </form>
</div>

<?php include(ROOT_PATH.'inc/footer.php'); ?>
