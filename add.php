<?php
require_once "pdo.php";

session_start();

if ( ! isset($_SESSION['name']) ) {
    die('ACCESS DENIED');
}

if ( isset($_POST['logout']) ) {
    header('Location: logout.php');
    return;
}

if ( isset($_POST['make']) && isset($_POST['model']) && isset($_POST['year']) && isset($_POST['mileage']) ) {

    if ( strlen($_POST['make']) < 1 || strlen($_POST['model']) < 1 || strlen($_POST['year']) < 1 || strlen($_POST['mileage']) < 1 ) {

        $_SESSION['error'] = "All fields are required";
        header("Location: add.php");
        return;

    } elseif ( !is_numeric($_POST['mileage']) ){

        $_SESSION['error'] = "Mileage must be an integer";
        header("Location: add.php");
        return;

    } elseif (!is_numeric($_POST['year'])){

        $_SESSION['error'] = "Year must be an integer";
        header("Location: add.php");
        return;

    } else {

        $sql = "INSERT INTO autos (make, model, year, mileage) VALUES (:make, :model, :year, :mileage)";

        $stmt = $pdo->prepare('INSERT INTO autos
                (make, model, year, mileage) VALUES ( :mk, :md, :yr, :mi)');
        $stmt->execute(array(
            ':mk' => $_POST['make'],
            ':md' => $_POST['model'],
            ':yr' => $_POST['year'],
            ':mi' => $_POST['mileage'])
            );

        $_SESSION["success"] = "Record added";
        header("Location: index.php");
        return;
                    
    }

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

    $guess = isset($_SESSION['name']) ? $_SESSION['name'] : '';
    $message = isset($_SESSION['error']) ? $_SESSION['error'] : false;

    if ( isset($_SESSION['name'])) {

        echo "<h1>Tracking autos for  ";
        echo htmlentities($_SESSION['name']);
        echo "</h1>\n";
    }

    if ( isset($_SESSION['error']) ) {
        echo '<p style="color:red">'.$_SESSION['error']."</p>\n";
        unset($_SESSION['error']);
    }
            
    ?>

    <form method="post">
    <p>Make:
    <input type="text" name="make" size="60"></p>
    <p>Model:
    <input type="text" name="model" size="60"></p>
    <p>Year:
    <input type="text" name="year"></p>
    <p>Mileage:
    <input type="text" name="mileage"></p>
    <input type="submit" value="Add"/>
    <input type="submit" name = "logout" value="Logout"/>
        
    </form>

</div>
</body>
