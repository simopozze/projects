<?php 
    session_start();
    if(!isset($_SESSION["user"]) && !isset($_SESSION["pwd"])){
        header("Location: ../index.php");
    }
    if($_SESSION["pwd"] == "codAut"){
        echo "<script> alert(\"Non sei autorizzato a cancellare spedizioni - AUTISTA.\") </script>";
        header("Refresh: 0; ../index.php");
    }
?>
<html>
    <head> 
		<link rel="stylesheet" type="text/css" href="style.css" />
		<link rel="icon" href="../img/truck.png"/>
        <?php echo "<title> Cancellazione - ".$_SESSION["idSped"]."</title>" ?>
        <meta name="viewport" content="width=device-width, initial-scale=1">
	</head>
    <body>
    <br>
        <br>
        <br>
        <div class="supportCenteringLogin">
        <br>
        <?php
                include "connect.php";
                
                if($_SESSION["google"]){
                    $idSped = $_SESSION["idSped"];
                    $sql = "DELETE FROM tappe WHERE spedizione=$idSped";
                    $sql_1 = "DELETE FROM spedizioni WHERE idSpedizione=$idSped";

                    if (($conn->query($sql) === TRUE) && ($conn->query($sql_1) === TRUE) ) {
                        echo "<script> alert(\"Cancellazione Effettuata!\") </script>";
                        header("Refresh: 0; showSped.php");
                    } else {
                        echo "<script> alert(\"Errore\") </script>";
                        header("Refresh: 0; deleteSped.php");
                    }    
                }

                else{
                    if(isset($_POST["pwd"])){
                        $pwd = $_POST["pwd"];
                    
                        if($pwd == $_SESSION["pwd"] ){
                            $idSped = $_SESSION["idSped"];
                            $sql = "DELETE FROM tappe WHERE spedizione=$idSped";
                            $sql_1 = "DELETE FROM spedizioni WHERE idSpedizione=$idSped";
                        }

                        if (($conn->query($sql) === TRUE) && ($conn->query($sql_1) === TRUE) ) {
                            echo "<script> alert(\"Cancellazione Effettuata!\") </script>";
                            header("Refresh: 0; showSped.php");
                        } else {
                            echo "<script> alert(\"Password Errata\") </script>";
                            header("Refresh: 0; deleteSped.php");
                        }     
                    }
                else {
                    echo "<script> alert(\"Non sei autorizzato a cancellare questa spedizioe - PASSWORD ERRATA.\") </script>";
                    header("Refresh: 0; deleteSped.php");
                }
            } 
        ?>
        <br>
        </div>
    </body>
    <br>
	<?php 
        include "func.php";
		footer();
	?>
</html>