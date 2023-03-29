<?php 


$host= "localhost";
$user= "root";
$password= "";
$db= "prepratory1";

    try{
        $pdo =  new PDO("mysql:host=$host;dbname=$db",$user,$password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // echo "connceted successfully";
        
     }catch(PDOException $e){
        
         die($e->getMessage());
     }



?>