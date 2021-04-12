<html>
    <head> 
		<title> Logout </title>
		<link rel="stylesheet" type="text/css" href="style.css" />
		<link rel="icon" href="../img/truck.png"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
	</head>
    <body>
        <div class="aboutContainer">
        <br>
        <br>
        <br>
            <?php
                session_start();
                include "func.php";
                logout();
            ?>
        </div>
    </body>
    <br>
	<?php 
		footer();
	?>
</html>