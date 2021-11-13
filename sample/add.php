<!DOCTYPE html>
<html lang="en">

<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Blog-user form</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" type="image/png" href="https://c.cksource.com/a/1/logos/ckeditor5.png">
	<link rel="stylesheet" href="add.css">

	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
</head>

<body data-editor="ClassicEditor" data-collaboration="false" data-revision-history="false">
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


	<?php
	if (isset($_POST['submit'])) {
		// Get editor content
		$author = "DK-2021";
		$editorContent = $_POST['content'];
		$title = $_POST['title'];
		$tag = $_POST['tag'];

		$uploaddir = 'static/';
		$uploadfile = $uploaddir . basename($_FILES['img']['name']);

		if (move_uploaded_file($_FILES['img']['tmp_name'], $uploadfile)) {
			echo "<div class=\"alert alert-success alert-dismissible fade show\" role=\"alert\">
					<strong>Blog uploaded successfully!</strong> 
					<button type=\"button\" class=\"btn-close\" data-bs-dismiss=\"alert\" aria-label=\"Close\"></button>
				</div>";
		} else {
			echo "<div class=\"alert alert-danger alert-dismissible fade show\" role=\"alert\">
					<strong>File upload failed! Please try again</strong> 
					<button type=\"button\" class=\"btn-close\" data-bs-dismiss=\"alert\" aria-label=\"Close\"></button>
				</div>";
		}

		$con = mysqli_connect('localhost', 'root', '', 'lekhak');
		$sql = "INSERT INTO `blog` (`id`, `title`, `img`, `tag`, `content`, `author`, `time`) VALUES (NULL, '$title', '$uploadfile', '$tag', '$editorContent', '$author', current_timestamp());";
		mysqli_query($con, $sql);
	}
	?>

	<br>
	<h2 class="text-center">Add Blog</h2>
	<div class="container border" style="margin: auto; margin-top: 1%; margin-bottom: 2%; padding: 1.75%; border-radius: 2%; width: 75%">
		<form method="POST" action="add.php" enctype="multipart/form-data">
			<div class="form-group">
				<label for="title">Title</label>
				<input type="text" class="form-control" id="title" name="title" placeholder="Enter the Title">
			</div>
			<br>

			<label for="img">Cover Image</label>
			<div class="input-group mb-3">
				<div class="custom-file">
					<input type="file" name="img" class="custom-file-input" id="img">
				</div>
			</div>

			<label for="tag">Category</label>
			<div class="input-group">
				<select class="custom-select" id="category" name="tag" aria-label="Example select with button addon">
					<option value="General" selected>General</option>
					<option value="Cybersecurity">Cybersecurity</option>
					<option value="Gaming">Gaming</option>
					<option value="Finance">Finance</option>
					<option value="Science">Science</option>
					<option value="Arts">Arts</option>
					<option value="Literature">Literature</option>
				</select>

			</div>
			<br>
			<main>
				<div class="centered">
					<div class="row row-editor">
						<div class="editor-container">
							<textarea class="editor" name="content">

							</textarea>
						</div>
					</div>
				</div>
			</main>
			<br>
			<button type="submit" class="btn btn-dark" name="submit">Submit</button>
		</form>

	</div>
	<script src="../build/ckeditor.js"></script>
	<script>
		ClassicEditor
			.create(document.querySelector('.editor'), {

				toolbar: {
					items: [
						'heading',
						'|',
						'bold',
						'italic',
						'link',
						'bulletedList',
						'numberedList',
						'|',
						'outdent',
						'indent',
						'|',
						'imageUpload',
						'blockQuote',
						'insertTable',
						'imageInsert',
						'mediaEmbed',
						'code',
						'findAndReplace',
						'fontBackgroundColor',
						'fontColor',
						'fontFamily',
						'fontSize',
						'horizontalLine',
						'undo',
						'redo'
					]
				},
				language: 'en',
				image: {
					toolbar: [
						'imageTextAlternative',
						'imageStyle:inline',
						'imageStyle:block',
						'imageStyle:side'
					]
				},
				table: {
					contentToolbar: [
						'tableColumn',
						'tableRow',
						'mergeTableCells'
					]
				},
				licenseKey: '',



			})
			.then(editor => {
				window.editor = editor;




			})
			.catch(error => {
				console.error('Oops, something went wrong!');
				console.error('Please, report the following error on https://github.com/ckeditor/ckeditor5/issues with the build id and the error stack trace:');
				console.warn('Build id: qpx7saihohqc-cn1h08q0rcbn');
				console.error(error);
			});
	</script>

</body>

</html>