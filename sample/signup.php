<?php

$success = false;

require_once "config.php";

$username = $email = $password = $confirm_password = "";
$username_err = $email_err = $password_err = $confirm_password_err = "";

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    // Check if username is empty
    if (empty(trim($_POST["uname"]))) {
        $username_err = "Username cannot be blank";
    } else {
        $sql = "SELECT id FROM user WHERE uname = ?";
        $stmt = mysqli_prepare($conn, $sql);
        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "s", $param_username);

            // Set the value of param username
            $param_username = trim($_POST['uname']);

            // Try to execute this statement
            if (mysqli_stmt_execute($stmt)) {
                mysqli_stmt_store_result($stmt);
                if (mysqli_stmt_num_rows($stmt) == 1) {
                    $username_err = "This username is already taken";
                } else {
                    $username = trim($_POST['uname']);
                }
            } else {
                echo "Something went wrong";
            }
        }
        mysqli_stmt_close($stmt);
    }



    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    // Validate e-mail
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $email_err = "Invalid email-id";
    }


    // Check for password
    if (empty(trim($_POST['password']))) {
        $password_err = "Password cannot be blank";
    } elseif (strlen(trim($_POST['password'])) < 6) {
        $password_err = "Password cannot be less than 6 characters";
    } else {
        $password = trim($_POST['password']);
    }

    // Check for confirm password field
    if (trim($_POST['password']) !=  trim($_POST['cpassword'])) {
        $confirm_password_err = "Passwords should match";
    }


    if (empty($username_err) && empty($email_err) && empty($password_err) && empty($confirm_password_err)) {
        $sql = "INSERT INTO user (uname, email, password) VALUES (?, ?, ?)";
        $stmt = mysqli_prepare($conn, $sql);
        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "sss", $param_username, $param_email, $param_password);

            // Set these parameters
            $param_username = $username;
            $param_email = $email;
            $param_password = password_hash($password, PASSWORD_DEFAULT);

            if (mysqli_stmt_execute($stmt)) {
                $success = true;
            }
        }
        mysqli_stmt_close($stmt);
    }
    mysqli_close($conn);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/jpg" href="icon.jpg">
    <title>Signup</title>

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

    <?php
    if ($success) {
        echo "<div class=\"alert alert-success alert-dismissible fade show\" role=\"alert\">
            <strong>Registration successfull!</strong> Please log in.
            <button type=\"button\" class=\"btn-close\" data-bs-dismiss=\"alert\" aria-label=\"Close\"></button>
        </div>";
    }
    ?>


    <div class="container border" style="background-color: white; margin: auto; margin-top: 5%; margin-bottom: 2%; padding: 1.75%; border-radius: 16px; width: 35%">
        <h2 class="text-center">Sign Up</h2>
        <br>
        <form method="POST" action="signup.php">
            <div class="form-group">
                <label for="title">Username</label>
                <input type="text" class="form-control" id="uname" name="uname" placeholder="Enter username">
                <?php echo "<small style=\"color: red;\">" . $username_err . "</small>" ?>
            </div>
            <br>
            <div class="form-group">
                <label for="title">Email</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Enter email">
                <?php echo "<small style=\"color: red;\">" . $email_err . "</small>" ?>
            </div>
            <br>
            <div class="form-group">
                <label for="title">Password</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Enter password">
                <?php echo "<small style=\"color: red;\">" . $password_err . "</small>" ?>
            </div>
            <br>
            <div class="form-group">
                <label for="title">Confirm Password</label>
                <input type="password" class="form-control" id="cpassword" name="cpassword" placeholder="Re-enter password">
                <?php echo "<small style=\"color: red;\">" . $confirm_password_err . "</small>" ?>
            </div>

            <br>
            <p class="text-center">Already have an account? <a href="login.php">Login here</a></p>
            <br>

            <div class="d-grid gap-2 col-3 mx-auto">
                <button type="submit" class="btn btn-outline-primary" name="signup">Sign Up</button>
            </div>
        </form>

    </div>


</body>

</html>