<?php
// var_dump($pdo);
require 'core/database/connection.php';
$selectQueryy = 'SELECT * FROM  bookdetails';
$statement = $pdo->query($selectQueryy);
$result = $statement->fetchAll(PDO::FETCH_ASSOC);
// var_dump($result);
?>