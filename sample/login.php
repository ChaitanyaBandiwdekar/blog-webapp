<?php

if (isset($_SESSION['uname'])) {
    header("location: profile.php");
    exit;
}
require_once "config.php";

$username = $password = "";
$err = "";


if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (empty(trim($_POST['uname'])) || empty(trim($_POST['password']))) {
        $err = "Please enter username / password";
    } else {
        $username = trim($_POST['uname']);
        $password = trim($_POST['password']);
    }


    if (empty($err)) {
        $sql = "SELECT id, uname, `password` FROM user WHERE uname = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "s", $param_username);
        $param_username = $username;


        // Try to execute this statement
        if (mysqli_stmt_execute($stmt)) {
            mysqli_stmt_store_result($stmt);
            if (mysqli_stmt_num_rows($stmt) == 1) {
                mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password);
                if (mysqli_stmt_fetch($stmt)) {
                    if (password_verify($password, $hashed_password)) {
                        // this means the password is correct. Allow user to login
                        session_start();
                        $_SESSION["uname"] = $username;
                        $_SESSION["id"] = $id;
                        $_SESSION["loggedin"] = true;

                        //Redirect user to welcome page
                        header("location: profile.php");
                    } else {
                        $err = "Invalid credentials! Please try again";
                    }
                }
            } else {
                $err = "Invalid credentials! Please try again";
            }
        }
    }
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/jpg" href="icon.jpg">
    <title>Login</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="add.css" />


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

    <div class="container border" style="background-color: white; margin: auto; margin-top: 5%; margin-bottom: 2%; padding: 2%; border-radius: 16px; width: 35%">

        <h2 class="text-center">Login</h2>

        <br>
        <?php echo "<small style=\"color: red;\">" . $err . "</small>" ?>
        <form method="POST" action="login.php">
            <div class="form-group">
                <label for="title">Username</label>
                <input type="text" class="form-control" id="uname" name="uname" placeholder="Enter username">
            </div>
            <br>
            <div class="form-group">
                <label for="title">Password</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Enter password">
            </div>

            <br>
            <p class="text-center">Don't have an account? <a href="signup.php">Signup here</a></p>
            <br>

            <div class="d-grid gap-2 col-3 mx-auto">
                <button type="submit" class="btn btn-outline-success text-center" name="login">Login</button>
            </div>
        </form>


    </div>



</body>

</html>