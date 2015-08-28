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
               window.location.href='/logout.php';
            </script>";
   } else{
      $_SESSION['ac_time'] = $time;
   }
}

/*
 * Reset all the $_SESSION variables used during a quiz
 */
function reset_quiz_session_variables(){
   $_SESSION['quiz-started']="";
   $_SESSION['question-index']="";
   $_SESSION['questions']="";
   $_SESSION['answer']="";
   $_SESSION['correct']="";
}

/*
 * Total number of quizzes present with status 1(ready)
 * count number of quizzes with status 1 from '-quiz_details' table
 * @return int    $count
 */
function total_quiz_tables(){
   global $db; //from connect.php
   $q = $db->prepare("SELECT name FROM ".DB_NAME.".`-quiz_details` WHERE status=1");
   $q->execute();
   $result = $q->fetchAll();
   $count = count($result);
   return $count;
}

/*
 * List all the quizzes
 * quizzes with status 1 from '-quiz_details' table
 * @return  array    all quizzes names
 */
function get_quiz_links(){
   global $db; //from connect.php
   $q = $db->prepare("SELECT name FROM ".DB_NAME.".`-quiz_details` WHERE status=1");
   $q->execute();
   $rows = $q->fetchAll(PDO::FETCH_COLUMN);
   $result = array();
   foreach ($rows as $row) {
      array_push($result, substr($row,1));
   }
   return $result;
}

/*
 * Get details related to a quiz
 * from '-quiz_details' table
 * @param   string   quiz name
 * @return  array    details generated; false if not found
 */
function quiz_details($quiz_name){
   global $db; //from connect.php
   $quiz_name = '_'.$quiz_name;
   $q = $db->prepare("SELECT * FROM ".DB_NAME.".`-quiz_details` WHERE name=:quizName");
   $q->execute(array(':quizName'=>$quiz_name));
   $rows = $q->fetch(PDO::FETCH_ASSOC);
   //if quiz not ready
   if($rows["status"]==0){
      return false;
   }
   $result = array();
   foreach ($rows as $key => $value) {
      if($key=="name"){
         $value = str_replace("-"," ",substr($value,1));
      } else if($key=="difficulty"){
         switch ($value) {
            case '0': $value="Easy";
                      break;
            case '1': $value="Medium";
                      break;
            case '2': $value="Difficult";
                      break;
         }
      }
      $result[$key] = $value;
   }
   return $result;
}

/*
 * generate quiz data on by one using LIMIT
 * @param   $quiz_name     string   name of table
 *          $index         int      points question to SELECT
 * #return  $row           array    data from pointed row
 */
function quiz_data($quiz_name,$index){
   global $db; //from connect.php
   $quiz_name = '_'.$quiz_name;
   $q = $db->prepare("SELECT * FROM ".DB_NAME.".".$quiz_name." LIMIT ".$index.",".($index+1));
   $q->execute();
   $row = $q->fetch(PDO::FETCH_ASSOC);
   if(empty($row)) return false;
   return $row;
}
