<?php

include_once("connect.php");

$id = $_GET['id'];

$sql = $dbConnection->query("DELETE FROM books WHERE id=$id");

header("Location: books.php");

?>

