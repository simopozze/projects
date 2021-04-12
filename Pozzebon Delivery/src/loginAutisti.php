<?php 
  if(!isset($_SESSION))
    session_start();
?>
<html>
    <head> 
		<title> Login Ciao </title>
		<link rel="stylesheet" type="text/css" href="style.css" />
		<link rel="icon" href="../img/truck.png"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
	</head>
    <body>
    <br>
        <br>
        <br>
        <div class="supportCenteringLogin">
        <br>
        <br>
        <br>
        <div class="searchContainerLogin">
            <br>
			<form action="loginAutisti.php" method="get">
				<input class="loginBox" type="text" name="user" placeholder="Codice Autista" required>
				<input class="loginBTN" type="submit" value="Login">
            </form>
            <form action="logout.php" method="post">
				<input class="loginBTN" type="submit" value="Logout">
			</form>
		</div>
        <br>
        </div>
        <?php 
            include "func.php";
            if(isset($_GET["user"])){
                $user = $_GET["user"];
                $pwd  = "codAut";

                $_SESSION["user"] = $user;
                $_SESSION["pwd"]  = $pwd;
                header("Location: showSpedAutisti.php");
            }
        ?>
    </body>
    <?php footer(); ?>
</html>