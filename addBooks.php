<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Books</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="public/index.css">

</head>

<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
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
        <h1>Add a book</h1>
    </div>
    <?php

require 'core/database/connection.php';
// var_dump($_POST);
if(isset($_POST["submitted"])){
    if($_POST['bookname'] == '' || $_POST['author'] == '' || $_POST['description'] == '' || $_FILES["imageupload"]["name"] == ''){
      echo "please enter all the details";
    }else{
      $bookname = $_POST['bookname'];
      $author = $_POST['author'];
      $description = $_POST['description'];
      
      $fileName = $_FILES["imageupload"]["name"];
      $tempName =  $_FILES["imageupload"]["tmp_name"];
      $folder = 'images/'.$fileName;
    //   var_dump($folder);
    //   var_dump($bookname);
    //   var_dump($author);
    //   var_dump($description);
      // var_dump($_FILES["imageupload"]);
      
    
    if (move_uploaded_file($tempName, $folder)) {
    $msg = "Image uploaded successfully";
    // echo $msg;
    }else{
            $msg = "Failed to upload image";
    }
    $insertquery = 'insert into bookdetails(img_source, book_name ,author, description) values(:folder, :bookname, :author, :description)';
    // $stmt = $pdo->exec($insertquery);
    $statement = $pdo->prepare($insertquery);
     $statement->execute([
    ':folder' => $folder,
    ':bookname' => $bookname,
    ':author' => $author,
    ':description' => $description
     ]);
    //   echo "data has been uploaded successfully";
    session_start();
    $_SESSION['success'] = 'Form submitted successfully!';
    header("location: index2.view.php");
   }
};

?>
    <form action="addBooks.php" class=" my-3 container" method="POST" enctype="multipart/form-data">
        <div class="formClass">
            <div class="mb-3 container imageSection">
                <input id="uploadFile" onchange="getImagepreview(event)" class="imageInput" type="file"
                    name="imageupload">
                <div id="preview"></div>
            </div>
            <div class="mb-3 container inputFeilds">
                <label for="book" class="form-label my-2">Book Name</label>
                <input type="text" class="form-control my-2" id="book" name="bookname">
                <label for="author" class="form-label my-2">Author</label>
                <input type="text" class="form-control my-2" id="author" name="author">
                <label for="description" class="form-label my-2">Description</label>
                <textarea class="form-control my-2" id="description" rows="10-" name="description"></textarea>
            </div>
        </div>
        <div class="btnSection">
            <input type="submit" name="submitted" value="save" class="btn btn-primary saveBtn my-3">
        </div>
    </form>

    <script src="public/index.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N" crossorigin="anonymous">
    </script>
</body>

</html>