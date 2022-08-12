<?php

    require_once "pdo.php";
    session_start();

    if ( ! isset($_SESSION['successLogin']) ) {
        echo("<!DOCTYPE html>
        <html>
        <head>
        <title>Welcome to the Automobiles Database d4dc2c5f</title>");
        require_once 'bootstrap.php'; 
        echo("</head>
        <body>
        <div class='container'>
        <h1>Welcome to the Automobiles Databse</h1>
        <p>
        <a href='login.php'>Please log in</a>
        </p>
        <p>
        Attempt to 
        <a href='add.php'>add data</a> without logging in.
        </div>
        </body>");

    } else {
        echo("<!DOCTYPE html>
        <html>
        <head>
        <title>Welcome to the Automobiles Database d4dc2c5f</title>");
        require_once 'bootstrap.php'; 
        echo("</head>
        <body>
        <div class='container'>
        <h1>Welcome to the Automobiles Databse</h1>");

        if ( isset($_SESSION['success']) ) {
            echo '<p style="color:green">'.$_SESSION['success']."</p>\n";
            unset($_SESSION['success']);
        }

        if ( isset($_SESSION['error']) ) {
            echo '<p style="color:red">'.$_SESSION['error']."</p>\n";
            unset($_SESSION['error']);
        }

        $stmt = $pdo->query("SELECT autos_id, make, model, year, mileage FROM autos");

        if ($row = $stmt->fetch(PDO::FETCH_ASSOC)){

        echo('<table border="1">'."\n");
        echo("<tr><th>Make</th><th>Model</th><th>Year</th><th>Mileage</th><th>Action</th></tr>");
        echo "<tr><td>";
        echo(htmlentities($row['make']));
        echo("</td><td>");
        echo(htmlentities($row['model']));
        echo("</td><td>");
        echo(htmlentities($row['year']));
        echo("</td><td>");
        echo(htmlentities($row['mileage']));
        echo("</td><td>");
        echo('<a href="edit.php?autos_id='.$row['autos_id'].'">Edit</a> / ');
        echo('<a href="delete.php?autos_id='.$row['autos_id'].'">Delete</a>');
        echo("</td></tr>\n");
        
        while ( $row = $stmt->fetch(PDO::FETCH_ASSOC) ) {
            echo "<tr><td>";
            echo(htmlentities($row['make']));
            echo("</td><td>");
            echo(htmlentities($row['model']));
            echo("</td><td>");
            echo(htmlentities($row['year']));
            echo("</td><td>");
            echo(htmlentities($row['mileage']));
            echo("</td><td>");
            echo('<a href="edit.php?autos_id='.$row['autos_id'].'">Edit</a> / ');
            echo('<a href="delete.php?autos_id='.$row['autos_id'].'">Delete</a>');
            echo("</td></tr>\n");
        }

        echo("</table>");

        } else {
            echo("No rows found <br>");
        }
        echo("
        <br>
        <p>
        <a href='add.php'>Add New Entry</a>
        </p>
        <p>
        <a href='logout.php'>Log out</a> 
        </div>
        </body>");

        
    }

?>


