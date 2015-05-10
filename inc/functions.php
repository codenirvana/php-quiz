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
   $name = $info['name'];
   $username = $info['username'];
   $email = $info['email'];
   $password = $info['password'];
   $type = $info['type'];

   $sql="INSERT INTO `users` (name, username, email, password, type) VALUES (:name, :username, :email, :password, :type)";
   $q = $db->prepare($sql);
   $q->execute(array(':name'=>$name,
                     ':username'=>$username,
                     ':email'=>$email,
                     ':password'=>$password,
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

?>
