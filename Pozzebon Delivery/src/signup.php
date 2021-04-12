<?php 
  if(!isset($_SESSION))
    session_start();
?>
<html>
    <head> 
		<title> Login </title>
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
			<form action="signup.php" method="get">
				<br>
				<input class="loginBox" type="text" name="nome" placeholder="Nome" required> 
				<input class="loginBox" type="text" name="cognome" placeholder="Cognome" required> 
                <br> <br>
                <input class="loginBox" type="email" name="user" placeholder="Email" required>
                <input class="loginBox" type="password" name="pwd" placeholder="Password" required>
                <br> <br>
				<input class="loginBTN" type="submit" value="Sign Up">
            </form>
		</div>
        <br>
        </div>

        <?php 
            include "func.php";

            if(isset($_GET["user"]) && isset($_GET["pwd"]) && isset($_GET["nome"]) && isset($_GET["cognome"])){
                $user    = $_GET["user"];
                $pwd     = $_GET["pwd"];
                $nome    = $_GET["nome"];
                $cognome = $_GET["cognome"];

                $_SESSION["tempUser"]    = $user;
                $_SESSION["tempPwd"]     = $pwd;
                $_SESSION["tempNome"]    = $nome;
                $_SESSION["tempCognome"] = $cognome;
                

                if(!checkUserExist($user))
                    echo "<script> alert(\"QUESTO UTENTE ESISTE GIA'!\") </script>";
                else {
                    $_SESSION["checkCode"] = checkMail($user);
                    echo "<form action=\"checkMailPage.php\" method=\"get\">
                    <br>
                    <input class=\"loginBox\" type=\"text\" name=\"checkCode\" placeholder=\"Codice Di Verifica\" required>        
                    <input class=\"loginBTN\" type=\"submit\" value=\"Sign Up\">
                    </form>";
            }   }

        ?>

    </body>
    <br>
	<?php
		footer();
	?>
</html>