<?php

try{
   $db = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME, DB_USERNAME, DB_PASSWORD);
   $db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
} catch(Exception $e){
   echo $e->getMessage();
   die();
}
