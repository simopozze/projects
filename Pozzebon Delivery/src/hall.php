<?php
	if(!isset($_SESSION))
        session_start();

    if (!isset($_SESSION["user"]) && !isset($_SESSION["pwd"])) 
        header("Location: login.php");
    else header("Location: areaPersonale.php");

?>