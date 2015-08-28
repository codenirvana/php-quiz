<?php
   require_once(__DIR__ ."/../config.php");

   $PAGE_TITLE = "Forgot Password";

   include(ROOT_PATH.'/inc/header.php');

   $msg = "Please fill out the form below";

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

<div id="main-wrapper" class="container">
   <h4>Recover Password</h4>
   <div class="forgot-form row">
      <form class="col s8 offset-s2" method="POST">
         <blockquote class="info-msg">
            <?php if(isset($msg) & !empty($msg)) echo $msg; ?>
         </blockquote>
         <div class="row">
            <div class="input-field col s12">
              <input id="username" type="text" name="username" required />
              <label for="username">UserName</label>
           </div>
           <div class="input-field col s12">
             <label>Security Question</label><br>
             <select name="question">
                 <option value="101" selected="selected">My favorite book</option>
                 <option value="102">My favorite food</option>
             </select>
           </div>
           <div class="input-field col s12">
                <input id="q-answer" type="text" name="answer" required />
               <label for="q-answer">Answer</label>
           </div>
            <input class="col m3 s12 waves-effect waves-light btn blue-grey" type="submit" name="submit" value="Submit" />
         </div>
      </form>
   </div>
</div>

<?php include(ROOT_PATH.'/inc/footer.php'); ?>
