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
			<form action="login.php" method="get">
				<br>
				<input class="loginBox" type="text" name="user" placeholder="Email" required> <br> <br>
				<input class="loginBox" type="password" name="pwd" placeholder="Password" required>
                <br> <br>
				<input class="loginBTN" type="submit" value="Login">
            </form>
            <form action="signup.php" method="get">
            <input class="loginBTN" type="submit" value="Sign Up">
            </form> 
            <form action="loginGoogle.php" method="get">
            <input class="loginBTN" type="submit" value="Google Login">
            </form>
            <br>
		</div>
        <br>
        </div>

        <?php 
            include "func.php";
            include "connect.php";

            if(isset($_GET["user"]) && isset($_GET["pwd"])){
                $user = $_GET["user"];
                $pwd  = $_GET["pwd"];
                
                $_SESSION["trackedSped"] = 0;

                $loginQuery = "SELECT nome, cognome, clienti.mail as \"mail\", DES_DECRYPT(password) as \"password\"
                                FROM account, clienti
                                WHERE clienti.idCliente=account.user
                                AND clienti.mail = \"$user\"
                                AND DES_DECRYPT(password) = \"$pwd\"";

                $loginRes   = $conn->query($loginQuery);


                if( !mysqli_num_rows($loginRes) > 0 ){
                    echo "<script> alert(\"DATI SBAGLIATI!\") </script>";
                }
                else{
                    $row        = $loginRes->fetch_assoc();
                    $userSite   = $row["mail"];
                    $pwdSite    = $row["password"];
                    $nome       = $row["nome"];
                    $cognome    = $row["cognome"];
                    
                    if($userSite != $user || $pwdSite != $pwd){
                        echo "<script> alert(\"DATI SBAGLIATI!\") </script>";
                    }
                    else{
                            login($user, $pwd, $nome, $cognome, false);
                    }
                }
            }
        ?>

    </body>
    <br>
	<?php 
		footer();
	?>
</html>