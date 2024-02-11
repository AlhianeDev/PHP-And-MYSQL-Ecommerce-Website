<?php

    require_once "./includes/db.php";

    $id = $_GET["id"];

    $sqlStatment = $pdo->prepare("UPDATE commande SET valider = ? WHERE id = ?");

    $sqlStatment->execute([$_GET["etat"], $id]);

    header("location: ligne_commande.php?id=". $id);
