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
                    <a type="button" class="btn btn-primary" href="index2.view.php">Home</a>
                </form>
                <form class="d-flex" role="search">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
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
}
?>
    </div>
    <div class="my-5 mx-5 flexable mainDiv">
        <?php 
    require 'core/queryBuilder.php';
    // var_dump($result[0]["id"]);
    // echo "<pre>";
    // print_r($result);
    // var_dump($result);
    ?>
        <?php foreach ($result as $item): ?>
        <div class="card my-3 mx-3" style="width: 18rem;">
            <img src="<?php echo $item['img_source']; ?>" class="card-img-top" alt="...">

            <p class="bookNamecenter"><span></span><?php echo $item['book_name']; ?></p>
            <div class="more">
                <h5 class="card-title"><span></span><?php echo $item['author']; ?></h5>
                <!-- <a href="readmore.php">read more...</a> -->
                <a href="readmore.php?id=<?php echo $item['id']; ?>">Read More</a>
            </div>
        </div>
        <?php endforeach; ?>

        <script src="index.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N" crossorigin="anonymous">
        </script>
</body>

</html>