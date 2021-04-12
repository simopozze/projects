<?php
    session_start();
    if(!isset($_SESSION["user"]) && !isset($_SESSION["pwd"])){
        header("Location: ../index.php");
    }

    echo "editProfile";
?>