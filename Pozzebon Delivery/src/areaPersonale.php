<?php 
    session_start();
    if(!isset($_SESSION["user"]) && !isset($_SESSION["pwd"])){
        header("Location: ../index.php");
    }
    if($_SESSION["pwd"] == "codAut")
        header("Location: loginAutisti.php");
?>
<html>
    <head> 
		<link rel="stylesheet" type="text/css" href="style.css" />
		<link rel="icon" href="../img/truck.png"/>
        <title> Area Personale </title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
	</head>
    <body>
        <div class="supportCentering">
            <div class="descSpedizioneContainer">
            <br><br>
            <br><br>
            <?php
                include "func.php";
                if($_SESSION["google"])
                    echo "[G] ".$_SESSION["nome"]." ".$_SESSION["cognome"];
                else echo $_SESSION["nome"]." ".$_SESSION["cognome"];
                echo "<h2>".$_SESSION["user"]." </h2> 
                <h3> Spedizioni Tracciate - ".countSped()."</h3>";
            ?>
            
            <form action="track.php" method="get">
				<input class="showAllSpedBTN" type="submit" value="Traccia Spedizione">
			</form>
            <form action="showSped.php" method="get">
				<input class="showAllSpedBTN" type="submit" value="Le Tue Spedizioni">
			</form>
            <br> <br>
            <form action="editProfile.php" method="get">
				<!-- <input class="showAllSpedBTN" type="submit" value="Modifica Profilo"> -->
			</form>
            <form action="logout.php" method="post">
				<input class="loginBTN" type="submit" value="Logout">
			</form>

                <?php

                ?>
            </div>
            <br>

        </div>
    </body>
    <br>
	<?php 
		footer();
	?>
</html>