<?php

    session_start();

    if (!isset($_SESSION["utilisateur"])) {

        header("location: connexion.php");   

    }

    require_once "./includes/db.php";

    $sqlStatment = $pdo->prepare("DELETE FROM categories WHERE id = ?");

    $result = $sqlStatment->execute([$_GET["id"]]);

    if ($result) {

        header("location: categories.php");

    }
