<?php
require 'core/database/connection.php';
 require 'core/queryBuilder.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
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
                <form class="d-flex mx-3" role="search">
                    <a type="button" class="btn btn-primary" href="addBooks.php">Add a book</a>
                </form>
                <form class="d-flex" role="search" method="GET" action="index2.view.php">
                    <input class="form-control me-2" name="search_input" type="search" placeholder="Search"
                        aria-label="Search">
                    <!-- <button  class="btn btn-outline-success" value="search_btn">Search</button> -->
                    <input type="submit" class="btn btn-outline-success" name="search_btn">
                    <a type="button" class="btn btn-outline-dark mx-2" href="index2.view.php">reset</a>
                </form>
            </div>
        </div>
    </nav>
    <div>
        <?php
session_start();
if (isset($_SESSION['success'])) {
  echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
  <strong>". $_SESSION['success']  ."<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
</div>";
  unset($_SESSION['success']);
}elseif(isset($_SESSION['updation'])){
  echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
  <strong>". $_SESSION['updation']  ."<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
</div>";
  unset($_SESSION['updation']);
}elseif(isset($_SESSION['deletion'])){
  echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
  <strong>". $_SESSION['deletion']  ."<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
</div>";
  unset($_SESSION['deletion']);
}elseif(isset($_SESSION['blank_string'])){
  echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
          <strong>".$_SESSION['blank_string']."<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
        </div>";
        unset($_SESSION['blank_string']);
}
// if someone clicks on the string with an empty input then an alert will be shown up 
if(isset($_GET["search_btn"])){
  if($_GET['search_input'] == null){
    session_start();
    $_SESSION['blank_string'] = 'Input Box cannot be empty';
    header("location: index2.view.php");
   }
  };
?>
    </div>
    <?php
    if(isset($_GET["search_btn"])){
      $capitalise_word = ucwords($_GET['search_input']);
    echo "<h2>You searched for '$capitalise_word'</h2>";
    }
    ?>
    <!-- here the main div starts  -->
    <div class="my-5 mx-5 flexable mainDiv">
    
    <?php 
          if(isset($_GET["search_btn"])){
            
            $data = '%'.$capitalise_word.'%';
            // make the search query for the search button 
            $search_query = "SELECT * FROM bookdetails WHERE book_name LIKE :data OR author LIKE :data ";
            $statement = $pdo->prepare($search_query);
            $statement->execute([
              ':data'=> $data
            ]);
            $result = $statement->fetchAll();
            // echo "<pre>";
            // var_dump($data);
            // print_r($_GET['search_input']);
            // var_dump($_GET["search_btn"]);
            // print_r($result);
            
            ?>

        <?php if($result){
            foreach ($result as $item): 
              ?>
        <div class="card my-3 mx-3" style="width: 18rem;">
            <img src="<?php echo $item['img_source']; ?>" class="card-img-top" alt="...">
            <p class="bookNamecenter"><span></span><?php echo $item['book_name']; ?></p>
            <div class="more">
                <h5 class="card-title"><span></span><?php echo $item['author']; ?></h5>
                <a href="readmore.php?id=<?php echo $item['id']; ?>">Read More</a>
            </div>
        </div>
        <?php 
                      endforeach; 
                    }else{
                      echo "no data found";
                    }
                      // end of first if statement 
                  } 

          else{
            foreach ($result as $item): 
          ?>
        <div class="card my-3 mx-3" style="width: 18rem;">
            <img src="<?php echo $item['img_source']; ?>" class="card-img-top" alt="...">
            <p class="bookNamecenter"><span></span><?php echo $item['book_name']; ?></p>
            <div class="more">
                <h5 class="card-title"><span></span><?php echo $item['author']; ?></h5>
                <a href="readmore.php?id=<?php echo $item['id']; ?>">Read More</a>
            </div>
        </div>
        <?php 
            endforeach; 
        } ?>
    </div>
    <script src="public/index.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N" crossorigin="anonymous">
    </script>
</body>

</html>