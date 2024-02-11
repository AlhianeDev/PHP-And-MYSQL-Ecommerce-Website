<?php

    session_start();

    if (!isset($_SESSION["utilisateur"])) {

        header("location: ../connexion.php");

    }

    if (!empty($_POST["id"])) {

        if (!isset($_SESSION["panier"][$_SESSION["utilisateur"]->id])) {

            $_SESSION["panier"][$_SESSION["utilisateur"]->id] = [];

        } else {

            if ($_POST["quantity"] > 0) {

                $_SESSION["panier"][$_SESSION["utilisateur"]->id][$_POST["id"]] = 
            
                $_POST["quantity"];

            } else {

                unset($_SESSION["panier"][$_SESSION["utilisateur"]->id][$_POST["id"]]);

            }

        }

    }

    header("location: ".$_SERVER['HTTP_REFERER']); // <- => to the prev page.
