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

	<link rel="stylesheet" href="add.css">

</head>

<body>
	<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
		<div class="container-fluid">
			<div class="container">
				<a class="navbar-brand" href="#">
					<img src="static/logo_rect.png" alt="" width="100">
				</a>
			</div>
			<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarText">
				<ul class="navbar-nav ms-auto mb-2 mb-lg-0">
					<li class="nav-item">
						<a class="nav-link active" aria-current="page" href="#">Home</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="#">Blogs</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="#">AboutUs</a>
					</li>
					<li class="nav-item px-1">
						<button class="btn btn-warning" type="submit">Login</button>
					</li>
					<li class="nav-item px-1">
						<button class="btn btn-outline-warning" type="submit">Signup</button>
					</li>
				</ul>

			</div>
		</div>
	</nav>


	<br>
	<h2 class="text-center">Latest Blogs</h2>
	<div class="container border" style="margin: auto; margin-top: 1%; margin-bottom: 2%; padding: 1.75%; border-radius: 2%">
		<div class="row row-cols-1 row-cols-md-3 g-4">

			<?php
			$servername = "localhost";
			$username = "root";
			$password = "";
			$database = "lekhak";

			// Create a connection
			$conn = mysqli_connect($servername, $username, $password, $database);

			$sql = "SELECT * FROM `blog`";
			$result = mysqli_query($conn, $sql);
			$sno = 0;
			while ($row = mysqli_fetch_assoc($result)) {
				$sno = $sno + 1;
				echo "<div class=\"col\">
						<div class=\"card h-100\" style=\"border-radius: 3%\">
							<img src=\"" . $row['img'] . "\" class=\"card-img-top\" style=\"width: 100%; height: 15vw; object-fit: cover; border-radius: 3%\">
							<div class=\"card-body\">
								<h5 class=\"card-title\">" . $row['title'] . "</h5>
								<p class=\"card-text\">content is a little bit longer.</p>
								<span class=\"badge bg-secondary\">" . $row['tag'] . "</span>
								<p class=\"card-text\"><small class=\"text-muted\">By " . $row['author'] . "</small>
							</div>
						</div>
					</div>";
			}
			?>

		</div>
	</div>

</body>

</html>