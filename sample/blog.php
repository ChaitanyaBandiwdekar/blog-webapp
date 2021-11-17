<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <title>Lekhak</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="https://c.cksource.com/a/1/logos/ckeditor5.png">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>

</head>

<body>
    <nav class="navbar sticky-top navbar-expand-lg navbar-dark bg-dark" style="white-space: nowrap;">
        <div class="container-fluid">
            <div class="container">
                <a class="navbar-brand" href="#">
                    <img src="static/logo.png" alt="" width="100">
                </a>
            </div>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarText">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item mx-2">
                        <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                    </li>
                    <li class="nav-item mx-2">
                        <a class="nav-link" href="add.php">Add a blog</a>
                    </li>
                    <li class="nav-item mx-2">
                        <a class="nav-link" href="#">About Us</a>
                    </li>
                    <li class="nav-item mx-2">
                        <a class="nav-link" href="profile.php">Profile</a>
                    </li>
                    <li class="nav-item mx-2">
                        <a href="login.php"><button class="btn btn-warning" type="submit">Login</button></a>
                    </li>
                </ul>

            </div>
        </div>
    </nav>



    <br>
    <?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "lekhak";

    // Create a connection
    $conn = mysqli_connect($servername, $username, $password, $database);
    $id = $_GET['id'];
    $sql = "SELECT * FROM `blog` WHERE id=$id";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);

    $timestamp = strtotime($row['time']);
    $date = date('M d, Y', $timestamp);

    ?>
    <div class="container border shadow p-3 mb-5 bg-body rounded" style="margin: auto; margin-top: 1%; margin-bottom: 2%; padding: 5%; border-radius: 16px; width: 80%">
        <h1 class="text-center"><?php echo $row['title'] ?></h1>
        <h5 class="text-end text-muted" style="margin-right: 5%; "> - <?php echo $row['author'] ?></h5>
        <br>
        <div class="text-center">
            <img src="<?php echo $row['img'] ?>" alt="<?php echo $row['title'] ?>" class="rounded" style="height: auto; width: 90%;">
        </div>
        <h6 class="text-muted" style="margin-left: 5%; margin-top: 5%;"> - <?php echo $date ?></h6>
        <div class="container" style="margin-top: 1%; width: 90%">
            <p><?php echo $row['content'] ?></p>
        </div>
    </div>

</body>

</html>