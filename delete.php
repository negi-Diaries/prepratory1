<?php
echo "this is delete section";

require 'core/database/connection.php';
var_dump($_GET['id']);
$id = $_GET['id'];
$selectQuery = "select * from bookdetails where id = $id";
$statement = $pdo->query($selectQuery);
$data = $statement->fetch(); 
echo "<pre>";
var_dump($data);
// print_r($data);

$deleteQuery = "DELETE FROM bookdetails WHERE id = :id";
$stmt = $pdo->prepare($deleteQuery);
$result = $stmt->execute([
    ':id' => $id
]);

var_dump($result);
if($result){
echo "the content has been deleted";
    session_start();
    $_SESSION['deletion'] = "Form Deleted successfully";
    header("location: index2.view.php");
}
?>