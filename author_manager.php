<?php
	session_start();

	if (!isset($_SESSION['loggedUser'])){
	    header('Location: index.php');
	    exit();
	}
?>

<!DOCTYPE HTML>
<html lang="pl">
<head>
	<title>Autorzy</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
</head>
<body>
	<div style="margin-left: 300px; margin-right: 300px; margin-top: 40px; margin-bottom: 40px;">
		<div class="container">
			<form action="books.php" method="post" name="form">
				<input type="submit" name="Submit" value="Powrót do strony głównej">
			</form>
			<br><br>
			<table id="author-table" class="table table-bordered table-hover">
				<thead>
					<tr>
        				<td>Autor</td>
    				</tr>
				</thead>
				<tbody>
					<?php
						include_once("connect.php");
				        $sql = $dbConnection->query("SELECT * FROM authors ORDER BY id DESC");
				        while($userData = $sql->fetch_array()){
				            echo "<tr>";
							echo "<td>".$userData['author']."</td>";
							echo "</tr>";
				        }
					?>	
				</tbody>
			</table>
			<script>
	            $(document).ready(function() {
	            	$('#author-table').DataTable();
	            } );
       		</script>
       		<br><br>
			<form action="author_manager.php" method="post" name="form">
				<table width="25%">
					<tr> 
						<td>Autor</td>
						<td><input type="text" name="author" size="50"></td>
					</tr>
				</table>
				<br>
				<div>
					<input type="submit" name="Submit" value="Dodaj autora">
				</div>
			</form>
			<?php
				if(isset($_POST['Submit'])) {
					$author = $_POST['author'];
					include_once("connect.php");
					$sql = $dbConnection->query("INSERT INTO authors(author) VALUES('$author')");

					header("Location: author_manager.php");
				}
			?>
		</div>
	</div>
</body>
</html>
