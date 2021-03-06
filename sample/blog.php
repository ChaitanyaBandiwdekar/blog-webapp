<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$database = "lekhak";

// Create a connection
$conn = mysqli_connect($servername, $username, $password, $database);

if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['submit'])) {
    $uname = $_SESSION["uname"];
    $comment = $_POST["comment"];
    $blog_id = $_GET['id'];

    $sql = "INSERT INTO `comments` (`blog_id`, `uname`, `comment`, `time`) VALUES ('$blog_id', '$uname', '$comment', current_timestamp());";
    mysqli_query($conn, $sql);
}

if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['like'])) {
    $uname = $_SESSION["uname"];
    $blog_id = $_GET['id'];

    $sql = "INSERT INTO `likes` (`blog_id`, `uname`) VALUES ('$blog_id', '$uname');";
    mysqli_query($conn, $sql);
}

if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['unlike'])) {

    $sql = "DELETE FROM `likes` WHERE blog_id=? AND uname=?;";
    $stmt = mysqli_prepare($conn, $sql);
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "ss", $param_blog_id, $param_uname);

        // Set these parameters
        $param_blog_id = $_GET['id'];
        $param_uname = $_SESSION["uname"];
    }
    if (mysqli_stmt_execute($stmt)) {
        $success = true;
    }
    mysqli_stmt_close($stmt);
}
?>


<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <title>Lekhak</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/jpg" href="icon.jpg">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="add.css">
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
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item mx-2">
                        <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                    </li>
                    <li class="nav-item mx-2">
                        <a class="nav-link" href="aboutus.php">About Us</a>
                    </li>
                    <?php

                    if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
                        echo "<li class=\"nav-item mx-2\">
									<a href=\"login.php\"><button class=\"btn btn-warning\" type=\"submit\">Login</button></a>
								</li>
								<li class=\"nav-item mx-2\">
									<a href=\"signup.php\"><button class=\"btn btn-outline-warning\" type=\"submit\">Signup</button></a>
								</li>
								";
                    } else {
                        echo "<li class=\"nav-item mx-2\">
						<a class=\"nav-link\" href=\"add.php\">Add a blog</a>
					</li>

					<li class=\"nav-item mx-2\">
						<a class=\"nav-link\" href=\"profile.php\">Profile</a>
					</li>
					<li class=\"nav-item mx-2\">
						<a href=\"logout.php\"><button class=\"btn btn-warning\" type=\"submit\">Logout</button></a>
					</li>
					";
                    }
                    ?>


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


    <?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "lekhak";

    // Create a connection
    $conn = mysqli_connect($servername, $username, $password, $database);
    $sql = "SELECT * FROM `comments` WHERE blog_id=$id ORDER BY `time` DESC";
    $result = mysqli_query($conn, $sql);
    ?>

    <div class="container border shadow p-4 mb-5 bg-body rounded" style="margin: auto; margin-top: 1%; margin-bottom: 2%; border-radius: 16px; width: 80%">
        <div class="row bootstrap snippets bootdeys">
            <div class="col-md-12 col-sm-12">
                <div class="comment-wrapper">
                    <div class="panel panel-info">
                        <div class="panel-heading">

                            <?php
                            if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
                            } else {

                                $sql = "SELECT * FROM `likes` WHERE blog_id=? AND uname=?;";
                                $stmt = mysqli_prepare($conn, $sql);
                                if ($stmt) {
                                    mysqli_stmt_bind_param($stmt, "ss", $param_blog_id, $param_username);

                                    // Set the value of param username
                                    $param_username = $_SESSION['uname'];
                                    $param_blog_id = $_GET['id'];

                                    // Try to execute this statement
                                    if (mysqli_stmt_execute($stmt)) {
                                        mysqli_stmt_store_result($stmt);
                                        if (mysqli_stmt_num_rows($stmt) == 1) {
                            ?>
                                            <form method="post" action="blog.php?id=<?php echo $_GET['id']; ?>">
                                                <button name="unlike" type="submit" class="btn btn-light">
                                                    <i class="fas fa-heart" style="color: red;"></i>
                                                    Like
                                                    <span class="text-muted">
                                                        <?php
                                                        $blog_id = $_GET['id'];
                                                        $sql2 = "SELECT COUNT(blog_id) FROM `likes` WHERE blog_id=$blog_id;";
                                                        mysqli_query($conn, $sql2);
                                                        $result2 = mysqli_query($conn, $sql2);
                                                        $row2 = mysqli_fetch_assoc($result2);

                                                        echo '(' . $row2['COUNT(blog_id)'] . ')';
                                                        ?>
                                                    </span>
                                                </button>
                                            </form>
                                        <?php } else { ?>
                                            <form method="post" action="blog.php?id=<?php echo $_GET['id']; ?>">
                                                <button name="like" type="submit" class="btn btn-light">
                                                    <i class="far fa-heart" style="color: red;"></i>
                                                    Like
                                                    <span class="text-muted">
                                                        <?php
                                                        $blog_id = $_GET['id'];
                                                        $sql2 = "SELECT COUNT(blog_id) FROM `likes` WHERE blog_id=$blog_id;";
                                                        mysqli_query($conn, $sql2);
                                                        $result2 = mysqli_query($conn, $sql2);
                                                        $row2 = mysqli_fetch_assoc($result2);

                                                        echo '(' . $row2['COUNT(blog_id)'] . ')';
                                                        ?>
                                                    </span>
                                                </button>
                                            </form>
                            <?php }
                                    }
                                }
                            } ?>

                        </div>

                        <br>
                        <div class="panel-heading">
                            <h5> Comment Section </h5>
                        </div>
                        <div class="panel-body">
                            <?php

                            if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
                                echo "<br> <p> Please login to comment </p>";
                            } else {
                                echo "<form action=\"blog.php?id=" . $id . "\" method=\"post\">
                                <textarea name=\"comment\" class=\"form-control\" placeholder=\"Write a comment...\" rows=\"3\"></textarea>
                                <br>
                                <button type=\"submit\" class=\"btn btn-dark\" name=\"submit\">Post</button>
                            </form>";
                            }
                            ?>

                            <div class="clearfix"></div>
                            <hr>
                            <ul class="media-list">
                                <?php
                                while ($row = mysqli_fetch_assoc($result)) {
                                    $timestamp = strtotime($row['time']);
                                    $date = date('M d, Y', $timestamp);
                                    echo "
                                    <li class=\"media\" style = \"list-style-type: none;\">
                                        <div class=\"media-body\">
                                            <strong class=\"text-success\">@" . $row['uname'] . "</strong>
                                            <span class=\"text-muted\">
                                                <small class=\"text-muted\">" . $date . "</small>
                                            </span>
                                            <p>" . $row['comment'] . "</p>
                                        </div>
                                    </li>";
                                }
                                ?>
                            </ul>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>


</body>

</html>