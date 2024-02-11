<?php

    session_start();

    session_unset(); // clear session

    session_destroy(); // much important

    header("location: connexion.php");
