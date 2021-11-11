<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
	<title>Lekhak</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" type="image/png" href="https://c.cksource.com/a/1/logos/ckeditor5.png">
	<link rel="stylesheet" href="add.css">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>



</head>

<body>
	<div class="navbar">
		<div class="nav-logo">
			<img src="static/logo_rect.png" alt="LOGO">
		</div>
		<div class="nav-links">
			<ul>
				<li><a href="index.html">Home</a></li>
				<li><a href="blogs.html">Blogs</a></li>
				<li><a href="aboutus.html">About Us</a></li>
				<div class="accounts">
					<a href="login.html"><button type="button" class="btn btn-warning">Login</button></a>
					<a href="signup.html"><button type="button" class="btn btn-outline-warning">Signup</button></a>
				</div>
			</ul>
		</div>
	</div>
	<br>
	<!-- <div class="caro-container">
		<div id="demo" class="carousel slide" data-bs-ride="carousel" role="listbox"
			style="width:60%; height:600px !important;">

			
			<div class="carousel-indicators">
				<button type="button" data-bs-target="#demo" data-bs-slide-to="0" class="active"></button>
				<button type="button" data-bs-target="#demo" data-bs-slide-to="1"></button>
				<button type="button" data-bs-target="#demo" data-bs-slide-to="2"></button>
			</div>

			
			<div class="carousel-inner" role="listbox" style="width:100%; height:600px !important;">
				<div class="carousel-item active">
					<img src="static/lens.jfif" alt="Los Angeles" class="caro d-block" style="width:100%">
					<div class="carousel-caption">
						<h3>Los Angeles</h3>
						<p>We had such a great time in LA!</p>
					</div>
				</div>
				<div class="carousel-item">
					<img src="static/tree.jpg" alt="Chicago" class="caro d-block" style="width:100%">
					<div class="carousel-caption">
						<h3>Chicago</h3>
						<p>Thank you, Chicago!</p>
					</div>
				</div>
				<div class="carousel-item">
					<img src="static/mountain.jpg" alt="New York" class="caro d-block" style="width:100%">
					<div class="carousel-caption">
						<h3>New York</h3>
						<p>We love the Big Apple!</p>
					</div>
				</div>
			</div>

		
			<button class="carousel-control-prev" type="button" data-bs-target="#demo" data-bs-slide="prev">
				<span class="carousel-control-prev-icon"></span>
			</button>
			<button class="carousel-control-next" type="button" data-bs-target="#demo" data-bs-slide="next">
				<span class="carousel-control-next-icon"></span>
			</button>
		</div>
	</div> -->

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
		echo "<div class=\"card mb-3\" style=\"max-width: 540px;\">
		<div class=\"row g-0\">
			<div class=\"col-md-4\">
				<img src=\"" . $row['img'] . "\" class=\"img-fluid rounded-start\" alt=\"...\">
			</div>
			<div class=\"col-md-8\">
				<div class=\"card-body\">
					<h5 class=\"card-title\">" . $row['title'] . "</h5>
					<p class=\"card-text\">This is a wider card with supporting text below as a natural lead-in to
						additional content. This content is a little bit longer.</p>
					<p class=\"card-text\"><small class=\"text-muted\">" . $row['tag'] . "</small></p>
				</div>
			</div>
		</div>
	</div>";
	}
	?>



</body>

</html>