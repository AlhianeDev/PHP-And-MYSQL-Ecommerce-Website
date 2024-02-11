<?php

    session_start();

    if (!isset($_SESSION["utilisateur"])) {

        header("location: ../connexion.php");

    }

    unset($_SESSION["panier"][$_SESSION["utilisateur"]->id][$_POST["id"]]);

    header("location: ".$_SERVER['HTTP_REFERER']); // <- => to the prev page.
