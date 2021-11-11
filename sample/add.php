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
	<div class="navbar">
		<div class="nav-logo">
			<img src="static/logo_rect.png" alt="LOGO">
		</div>
		<div class="nav-links">
			<ul>
				<li><a href="index.html">Home</a></li>
				<li><a href="blogs.html">Blogs</a></li>
				<li><a href="aboutus.html">About Us</a></li>
			</ul>
		</div>
	</div>
	<div class="form_container">
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
					<option selected>Choose your category</option>
					<option value="1">One</option>
					<option value="2">Two</option>
					<option value="3">Three</option>
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
			echo "File is valid, and was successfully uploaded.\n";
		} else {
			echo "Upload failed";
		}

		$con = mysqli_connect('localhost', 'root', '', 'lekhak');
		$sql = "INSERT INTO `blog` (`id`, `title`, `img`, `tag`, `content`, `author`, `time`) VALUES (NULL, '$title', '$uploadfile', '$tag', '$editorContent', '$author', current_timestamp());";
		mysqli_query($con, $sql);
	}
	?>
</body>

</html>