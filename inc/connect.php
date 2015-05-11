<?php

try{
   $db = new PDO('mysql:host='.$DataBase_host.';dbname='.$DataBase_name, $DataBase_username, $DataBase_password);
   $db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
} catch(Exception $e){
   echo $e->getMessage();
   die();
}
