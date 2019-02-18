<?php
	session_start();
	
	if ((isset($_SESSION['loggedUser'])) && ($_SESSION['loggedUser']==true)){
		header('Location: books.php');
		exit();
	}
?>

<!DOCTYPE HTML>
<html lang="pl">
<head>
	<title>Logowanie</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
</head>
<body>
	<div class="container">
  		<h2>Zaloguj się na swoje konto</h2>
  		<form action="login.php" method="post">
    		<div class="form-group">
      			<label>Login:</label>
      			<input type="text" class="form-control" placeholder="Wpisz login" name="login">
    		</div>
    		<div class="form-group">
      			<label>Hasło:</label>
            <!-- zmiana name="haslo" na name"pass" -->
      			<input type="password" class="form-control" placeholder="Wpisz hasło" name="pass">
    		</div>
    		<button type="submit" class="btn btn-primary">Zaloguj</button>
  		</form>
      <br>
      <?php
      	if(isset($_SESSION['error']))	echo $_SESSION['error'];
      ?> 
  </div>
</body>
</html>