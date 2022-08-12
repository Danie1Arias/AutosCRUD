<?php
require_once "pdo.php";

session_start();

if ( ! isset($_SESSION['name']) ) {
    die('Not logged in');
  }

if ( isset($_POST['logout']) ) {

    header('Location: logout.php');
    return;
}

?>

<!DOCTYPE html>
<html>
    <head>
    <title>Daniel Arias Cámara Autos Page d4dc2c5f</title>
    <?php require_once "bootstrap.php"; ?>
</head>

<body>
<div class="container">
    <?php
        if ( isset($_SESSION['name']) ) {

            echo "<h1>Tracking autos for  ";
            echo htmlentities($_SESSION['name']);
            echo "</h1>\n";
        } 
        
        if ( isset($_SESSION['success']) ) {
            echo('<p style="color: green;">'.htmlentities($_SESSION['success'])."</p>\n");
            unset($_SESSION['success']);
          }
    ?>

    <h2>Automobiles</h2>
    <ul>
        <?php

            $stmt = $pdo->query("SELECT make, year, mileage FROM autos");
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

            foreach ( $rows as $row ) {

                echo ("<li>" . $row['year'] . " ");
                echo htmlentities ($row['make'] . " / ");
                echo ($row['mileage']. "</li>");

            } 

        ?>
    </ul>

    <a href="add.php">Add New</a> | <a href="logout.php">Logout</a>

</div>
</body>