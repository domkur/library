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
    <title>Kisążki</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
</head>
<body>
    <div class="container" style="margin-top: 80px; margin-bottom: 80px;">
        <nav class="navbar navbar-expand-sm bg-dark navbar-dark fixed-top">
            <a class="navbar-brand" style="color: white;">Biblioteka</a>
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="add.php">Dodaj książkę</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="author_manager.php">Dodaj autora</a>
                </li>
                <li class="nav-item">
                    <?php
                        echo '<a class="nav-link" href="logout.php">Wyloguj się</a>';
                    ?>
                </li>
            </ul>
        </nav>
        <table id="book-table" class="table table-bordered table-hover">
            <thead>
                <tr>
                    <td>Autor</td>
                    <td>Tytuł</td>
                    <td>Ilość stron</td>
                    <td>Aktualizuj</td>
                    <td>Usuń</td>
                </tr>    
            </thead>
            <tbody>
                <?php
                    include_once("connect.php");
                    $sql = $dbConnection->query("SELECT authors.author, books.* FROM books, authors WHERE books.id_author = authors.id");
                    while($userData = $sql->fetch_array()){
                        echo "<tr>";
                        echo "<td>".$userData['author']."</td>";
                        echo "<td>".$userData['title']."</td>";
                        echo "<td>".$userData['pages']."</td>";
                        //nie rozumiem zapisu poniżej - co oznacza ? w zapisie edit.php?id=$user_data[id]  
                        echo "<td><a href='edit.php?id=$userData[id]'>Edytuj</a></td>";
                        echo "<td><a href='delete.php?id=$userData[id]'>Usuń</a></td>";
                        echo "</tr>";
                    }
                ?>
            </tbody>
        </table>
        <script>
            $(document).ready(function() {
                $('#book-table').DataTable();
            } );
        </script>
    </div>
</body>
</html>
