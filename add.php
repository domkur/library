<?php
	session_start();

	if (!isset($_SESSION['loggedUser'])){
	    header('Location: index.php');
	    exit();
	}
?>

<!DOCTYPE html>
<html lang="pl">
<head>
	<title>Dodaj ksiażkę</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
<body>
	<div style="margin-left: 300px; margin-right: 300px; margin-top: 20px; margin-bottom: 40px;">
		<div class="container">
			<br>
	  		<h2>Dodaj księżkę</h2>
	  		<br>
	  		<form action="books.php" method="post" name="form">
				<input type="submit" name="Submit" value="Powrót do strony głównej">
			</form>
			<br>
	  		<form action="add.php" method="post" name="form">
	  			<div class="form-group">
	  				<label for="author">Autor</label>
	  				<select class="form-control" name="author_id">
						<?php
							include_once("connect.php");
	                		$sql = $dbConnection->query("SELECT * FROM authors ORDER BY id DESC");
	                		while($userData = $sql->fetch_array()){
	                			//echo poniżej  nie jasny zapis. Czy da się uprościć (<option value="id_autora">nazwa_autora</option>)
	                			echo '<option value="'.$userData['id'].'"selected>'.$userData['author'].'</option>';
	               			}
						?>	
	  				</select>
	  			</div>
	  			<div class="form-group">
	  				<label for="title">Tytuł książki</label>
	  				<input class="form-control" type="text" name="title">
	  			</div>
	  			<div class="form-group">
	  				<label for="pages">Ilość stron</label>
	  				<input class="form-control" type="text" name="pages">
	  			</div>
	  			<div class="form-group">
	  				<input class="btn btn-primary" type="submit" name="Submit" value="Dodaj">
	  			</div>
			</form>
  		</div>
	</div>
	<?php
		if(isset($_POST['Submit'])) {
			$authorId = $_POST['author_id'];
			$title = $_POST['title'];
			$pages = $_POST['pages'];
			include_once("connect.php");
	        $sql = $dbConnection->query("INSERT INTO books(id_author, title,pages) VALUES('$authorId','$title','$pages')");
			
			header("Location: books.php");
		}
	?>
</body>
</html>
