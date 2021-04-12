<?php 
    session_start();
    if(!isset($_SESSION["user"]) && !isset($_SESSION["pwd"])){
        header("Location: ../index.php");
    }
    if($_SESSION["pwd"] == "codAut"){
        echo "<script> alert(\"Non sei autorizzato a cancellare spedizioni - AUTISTA.\") </script>";
        header("Refresh: 0; ./deleteSped.php");
    }
?>
<html>
    <head> 
		<link rel="stylesheet" type="text/css" href="style.css" />
		<link rel="icon" href="../img/truck.png"/>
        <?php echo "<title> Id Spedizione -> ".$_SESSION["idSped"]."</title>" ?>
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
			<?php if($_SESSION["google"]){
                echo "
                <form action=\"auxDelete.php\" method=\"post\">
				<br>
                
				<input class=\"loginBox\" type=\"text\" name=\"pwd\" placeholder=\"ELIMINAZIONE GAUTH\" disabled>
                <br> <br>
				<input class=\"loginBTN\" type=\"submit\" name=\"googleDel\" value=\"ELIMINA\">
                </form>";    
            }
            else{
                echo "
                <form action=\"auxDelete.php\" method=\"post\">
				<br>
				<input class=\"loginBox\" type=\"password\" name=\"pwd\" placeholder=\"Conferma Password\" required>
                <br> <br>
				<input class=\"loginBTN\" type=\"submit\" value=\"Conferma Password per Eliminare\">
                </form>
                ";    
            }
            ?>
		</div>
        <br>
        </div>
    </body>
    <br>
	<?php 
        include "func.php";
		footer();
	?>
</html>