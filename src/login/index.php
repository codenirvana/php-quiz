<?php
   require_once(__DIR__ ."/../config.php");

   $PAGE_TITLE = "Login";

   include(ROOT_PATH.'/inc/header.php');

   $msg = "Admin/Organizer Login";

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
         header('Location: /admin');
      }else{
         $msg = "Invalid Login Credentials.";
      }
   }

   /*
    * If user is logged-in
    * redirect to home.php
    */
    if(isset($username)){
      header('Location: /admin');
   }
?>
<div id="main-wrapper" class="container">
   <h4>Login or Register</h4>

   <blockquote class="info-msg">
      <?php if(isset($msg) & !empty($msg)) echo $msg; ?>
   </blockquote>

   <ul class="collapsible popout collapsible-accordion" data-collapsible="accordion">
      <li>
         <div class="collapsible-header active"><i class="mdi-av-subtitles"></i>Login</div>
         <div class="collapsible-body" style="">
            <div class="login-form row">
               <form class="col s8 offset-s2" method="POST">
                  <div class="row">
                     <div class="input-field col s12">
               	     <input id="uname" type="text" name="uname" required />
                       <label for="uname">UserName</label>
                    </div>
                     <div class="input-field col s12">
               	     <input id="pword" type="password" name="pword" required/>
                       <label for="pword">Password</label>
                    </div>
                    <input class="col m3 s12 waves-effect waves-light btn blue-grey" type="submit" name="submit2" value="Login" />
                  </div>
               </form>
            </div>
         </div>
       </li>
       <li>
         <div class="collapsible-header"><i class="mdi-social-person-add"></i>Register</div>
         <div class="collapsible-body" style="display: block;">
            <div class="register-form row">
               <form class="col s8 offset-s2" method="POST">
                  <div class="row">
                     <div class="input-field col s12">
                  	     <input id="username" type="text" name="username" required />
                          <label for="username">UserName</label>
                     </div>
                     <div class="input-field col s12">
                  	     <input id="email" type="email" name="email" required/>
                          <label for="email">Email</label>
                     </div>
                     <div class="input-field col s12">
                  	     <input id="password" type="password" name="password" required placeholder="password" />
                          <label for="password">Password</label>
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
                     <div class="input-field col s12">
                        <label>Account Type</label><br>
                        <select name="type">
                           <option value="333" selected="selected">User</option>
                           <option value="222">Author</option>
                        </select>
                     </div>
                     <input class="col m3 s12 waves-effect waves-light btn blue-grey" type="submit" name="submit1" value="Register" />
                  </div>
               </form>
            </div>
         </div>
       </li>
       <li>
         <div class="collapsible-header"><i class="mdi-action-settings"></i>Forgot Password</div>
         <div class="collapsible-body" style="display: block;">
            <div class="row">
               <div class="forgot col s8 offset-s2">
                  <p>
                     <b>Lost Password?</b><br>
                     Don't worry we will help recovering your password<br><br>
                     <a class="col m5 s12 waves-effect waves-light btn blue-grey" href="/help/forgot">Recover Now</a>
                  </p>
               </div>
            </div>
         </div>
      </li>
    </ul>

</div> <!-- main-wrapper ends -->
<?php include(ROOT_PATH.'/inc/footer.php'); ?>
