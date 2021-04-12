<?php 
    include "func.php";
    include "connect.php";
  if(!isset($_SESSION))
    session_start();

    if (!isset($_SESSION["user"]) || !isset($_SESSION["pwd"])) {
        header("Location: ../index.php");
    }
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
        <div class="searchContainerLogin">
            <br>
            <?php

                echo "<form method=\"get\" action=\"track.php\">
               <br><br>
                 <select name=\"mail\" required>";
                    $result = $conn->query("select idCliente, mail from clienti");
                    echo '<option value="" disable selected hidden> DESTINATARIO </option>';
                    while ($row = $result->fetch_assoc()) {
                                $id = $row['idCliente'];
                                $mail = $row['mail']; 
                                echo '<option value="'.$mail.'">'.$mail.'</option>';
                    }

                echo "</select>
                <br><br>    <input class=\"loginBox\" type=\"text\" name=\"truckCode\" placeholder=\"Codice Autista\" required>
                <br><br>    <textarea id=\"textArea\" name=\"textDesc\" rows=\"4\" cols=\"50\">
                </textarea>
                <br> <br> <input class=\"loginBTN\" type=\"submit\" value=\"TRACCIA\">
                </form>";

                $mittente = $_SESSION["user"];
                if(isset($_GET["mail"]) && isset($_GET["truckCode"]) && isset($_GET["textDesc"])){
                    $destinatario = $_GET["mail"];
                    $truckCode    = $_GET["truckCode"];
                    $desc         = $_GET["textDesc"];

                    if($mittente == $destinatario)
                        echo "<script> alert(\"ERRORE! Mittente e Destinatario Coincidono!\") </script>";
                    else trackSped($mittente, $destinatario, $truckCode, $desc);
                    
                }
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