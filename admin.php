<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>E-commerce - Admin Dashboard</title>

    <link 
    
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" 
        
        rel="stylesheet" 
        
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" 
        
        crossorigin="anonymous"

    >

</head>

<body>
    
    <?php 

        require_once "./includes/db.php";
    
        include_once "./includes/header.php";
    
    ?>

    <div class="container py-5">

        <h3 class="mb-4">Admin Dashboard</h3>

        <?php

            if (!isset($_SESSION["utilisateur"])) {

                header("location: connexion.php");   

            }

            echo "<h4>Bonjour " . $_SESSION["utilisateur"]->username . "</h4>";
        
        ?>

    </div>

</body>

</html>
