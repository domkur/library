<?php

	session_start();
	
	if ((!isset($_POST['login'])) || (!isset($_POST['pass']))){
		header('Location: index.php');
		exit();
	}

	require_once "connect.php";
	
	if ($dbConnection->connect_errno!=0){
		echo "Error: ".$dbConnection->connect_errno;
	}
	else{
		$login = $_POST['login'];
		$password = sha1($_POST['pass']);

		$sql = "SELECT * FROM users WHERE login='$login' AND pass='$password'";
	
		if ($connectionResult = $dbConnection->query($sql)){
			$howManyUsers = $connectionResult->num_rows;
			// num_rows - właściwość obiektu mysqli zwracająca ilość rekordów?
			if($howManyUsers>0)
			{
				$_SESSION['loggedUser'] = true;
				
				unset($_SESSION['error']);
				$connectionResult->free_result();
				header('Location: books.php');
			}
			else{
				$_SESSION['error'] = '<span style="color:red">Nieprawidłowy login lub hasło!</span>';
				header('Location: index.php');
			}
		}
		$dbConnection->close();
	}
?>