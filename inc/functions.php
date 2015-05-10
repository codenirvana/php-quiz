<?php

function if_user_exists($username){
   global $db;
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

function add_new_user($info){
   global $db;
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

function check_credentials($info){
   global $db;
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

?>
