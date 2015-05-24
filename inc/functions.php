<?php

/*
 * Check if username already exists in users table.
 * username must be unique and duplicate entry will create error while inserting
 * @param   string   $username
 * @return  bool     True if exists else False
 */
function if_user_exists($username){
   global $db; //from connect.php
   $sql="SELECT * FROM users where username=:uname";
   $q = $db->prepare($sql);
   $q->execute(array(':uname' => $username));
   $result = $q->fetchAll();
   if(count($result)){
      return true;
   } else{
      return false;
   }
}

/*
 * Add new record in users table
 * @param   array    $info    actually $_POST
 * @return  object   $q       PDO Object
 */
function add_new_user($info){
   global $db; //from connect.php
   $username = $info['username'];
   $email = $info['email'];
   $password = $info['password'];
   $question = $info['question'];
   $answer = $info['answer'];
   $type = $info['type'];

   $sql="INSERT INTO `users` (username, email, password, forQ, forA) VALUES (:username, :email, :password, :forQ, :forA)";
   $q = $db->prepare($sql);
   $q->execute(array(':username'=>$username,
                     ':email'=>$email,
                     ':password'=>$password,
                     ':forQ'=>$question,
                     ':forA'=>$answer
   ));

   $sql="INSERT INTO `users_details` (username, type) VALUES (:username, :type)";
   $q = $db->prepare($sql);
   $q->execute(array(':username'=>$username,
                     ':type'=>$type
   ));

   return $q;
}

/*
 * Check username and password passed in login form,
 * match credentials with information stored in users table.
 * @param   array    $info    actually $_POST
 * @return  bool     True if credentials matches else False
 */
function check_credentials($info){
   global $db; //from connect.php
   $username = $info['uname'];
   $password = $info['pword'];

   $sql = 'SELECT * FROM users WHERE username=:uname and password=:pword';
   $q = $db->prepare($sql);
   $q->execute(array(':uname'=>$username, ':pword'=>$password));
   $result = $q->fetchAll();
   $count = count($result);
   if(count($result)){
      return true;
   } else{
      return false;
   }
}

/*
 * recover password based on security question and answer provided by user
 * @param   array    $info    actually $_POST
 * @return  string   password 'from users table'
 */
function recover_password($info){
   global $db; //from connect.php
   $username = $info['username'];
   $question = $info['question'];
   $answer = $info['answer'];

   $sql="SELECT password from `users` WHERE forQ=:forQ AND forA=:forA";
   $q = $db->prepare($sql);
   $q->execute(array(':forQ'=>$question,
                     ':forA'=>$answer
   ));
   $pwd = $q->fetch(PDO::FETCH_ASSOC);
   return $pwd['password'];
}

/*
 * Total number of quizzes present
 * count number of tables with quiz prefix '_'
 * @return int    $count
 */
function total_quiz_tables(){
   global $db; //from connect.php
   $q = $db->prepare("SHOW TABLES WHERE TABLES_IN_quiz LIKE '\_%'");
   $q->execute();
   $result = $q->fetchAll();
   $count = count($result);
   return $count;
}

/*
 * Start a new session for user logged in,
 *    store START time()
 * @param   string   $username
 */
function start_session($username){
   $_SESSION['username'] =$username;
   $_SESSION['ac_time'] = time();
}

/*
 * Check session exist
 * compare current time with last access time
 *   if > 300 (5min.) expire session
 *   else update access time
 */
function check_session(){
   $time = time();
   if($time-$_SESSION['ac_time']>300){
      echo "<script>
               alert('Your session has expired, Please Login!');
               window.location.href='".BASE_URL."logout.php';
            </script>";
   } else{
      $_SESSION['ac_time'] = $time;
   }
}
