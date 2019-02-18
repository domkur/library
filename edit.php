<?php

	session_start();

	if (!isset($_SESSION['loggedUser'])){
	    header('Location: index.php');
	    exit();
	}

	include_once("connect.php");

	if(isset($_POST['update'])){	
		$id = $_POST['id'];
		$title=$_POST['title'];
		$pages=$_POST['pages'];

		$sql = $dbConnection->query("UPDATE books SET title='$title',pages='$pages' WHERE id=$id");
		
		header("Location: books.php");
	}

	$id = $_GET['id'];

	$sql = $dbConnection->query("SELECT * FROM books WHERE id=$id");

	while($userData = $sql->fetch_array()){
		$title = $userData['title'];
		$pages = $userData['pages'];
	}
?>
<!DOCTYPE html>
<html lang="pl">
<head>
	<meta charset="UTF-8">	
	<title>Edytuj dane o książkach</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
</head>
<body>
	<div style="margin-left: 300px; margin-right: 300px; margin-top: 20px; margin-bottom: 40px;">
		<div class="container">
			<br/>
			<form action="books.php" method="post" name="form">
				<input type="submit" name="Submit" value="Powrót do strony głównej">
			</form>
			<br>
			<h2>Edytuj dane o książkach</h2>
	  		<br>
			<form action="edit.php" method="post" name="update">
				<div class="form-group">
					<label for="title">Edytuj tytuł</label>
					<input class="form-control" type="text" name="title" value=<?php echo $title;?>>
				</div>
				<div class="form-group">
					<label for="pages">Edytuj ilość stron</label>
					<input class="form-control" type="text" name="pages" value=<?php echo $pages;?>>
				</div>
				<div class="form-group">
					<input type="hidden" name="id" value=<?php echo $_GET['id'];?>>
					<input class="btn btn-primary" type="submit" name="update" value="Wprowadź zmiany">
				</div>
			</form>	
		</div>		
	</div>
</body>
</html>
