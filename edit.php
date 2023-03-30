<?php
require 'core/database/connection.php';
// var_dump($_GET['id']);
if (isset($_GET['id'])){
$id = $_GET['id'];
$selectQuery = "select * from bookdetails where id = $id";
$statement = $pdo->query($selectQuery);
$data = $statement->fetch(); 
// echo "<pre>";
// var_dump($data);
// print_r($data);
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="public/index.css">

</head>

<body>
    <nav class="navbar navbar-expand-lg ">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Virtual Library</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item dropdown">
                    </li>
                </ul>
                <form class="d-flex" role="search">
                    <a type="button" class="btn btn-primary" href="index.php">Back</a>
                </form>
            </div>
        </div>
    </nav>
    <div class="container">
        <h1>Edit book</h1>
    </div>

  
    <form action="" class=" my-3 container" method="POST" enctype="multipart/form-data">
        <div class="formClass">
            <div class="mb-3 container imageSection">
                <input id="uploadFile" onchange="getImagepreview(event)" class="imageInput" type="file"
                    name="uploaded_image">
                <div id="preview">
                    
                    <input type="hidden" name="old_image" value="<?php echo $data['img_source']; ?>">
                </div>
            </div>
            <div class="mb-3 container inputFeilds">
                <input type="hidden" name="book_id" value="<?php echo $data['id']; ?>">
                <label for="book" class="form-label my-2" >Book Name</label>
                <input type="text" class="form-control my-2" id="book" name="bookname" value="<?php echo $data['book_name'] ?>">
                <label for="author" class="form-label my-2">Author</label>
                <input type="text" class="form-control my-2" id="author" name="author" value="<?php echo $data['author'] ?>">
                <label for="description" class="form-label my-2">Description</label>
                <textarea class="form-control my-2" id="description" rows="8" name="description" ><?php echo $data['description'] ?></textarea>
            </div>
        </div>
        <div class="btnSection">
            <input type="submit" name="submitted" value="Update" class="btn btn-primary saveBtn my-3">
        </div>
    </form>

    <?php
//       require 'core/database/connection.php';
// // var_dump($_POST);
if(isset($_POST['submitted'])){   
    if($_POST['bookname'] == '' || $_POST['author'] == '' || $_POST['description'] == ''){
        echo "please enter all the details";
      }else{
    $id = $_POST['book_id'];
    $bookname = $_POST['bookname'];
    $author = $_POST['author'];
    $description = $_POST['description'];
    // $uploaded_image = $_FILES['uploaded_image']['name'];
    $old_image = $_POST['old_image'];
    if($_FILES['uploaded_image']['name'] != null){
        $updated_image = $_FILES['uploaded_image']['name'];
        $fileName = $_FILES["uploaded_image"]["name"];
        $tempName =  $_FILES["uploaded_image"]["tmp_name"];
        $folder = 'images/'.$updated_image;
        // var_dump($updated_image);
        // var_dump($tempName);
    }else{
        $updated_image = $old_image;
        $folder = $updated_image;
        // var_dump($updated_image);
    }

    $updateQuery = "update bookdetails set img_source= :updated_image, book_name= :bookname, author= :author, description= :description where id = :id";
    $stmt = $pdo->prepare($updateQuery);
    $result  = $stmt->execute([
        ':updated_image' => $folder,
        ':bookname' => $bookname,
        ':author' => $author,
        ':description' => $description,
        ':id' => $id
         ]);
         if($result){
            if($_FILES['uploaded_image']['name'] != null){
                move_uploaded_file($tempName, $folder);
                unlink($old_image);
            }
            session_start();
            $_SESSION['updation'] = "Form updated successfully";
            header("location: index2.view.php");
            echo "executer successfully4545";
         }else{
            echo "form not submitted";
         }

        }
}else{
    echo "<font color='blue'>click on update button to save the changes</font>";
}

?>

    <script src="public/index.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N" crossorigin="anonymous">
    </script>
</body>

</html>




