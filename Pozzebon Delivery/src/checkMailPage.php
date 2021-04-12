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

        <?php 
            include "func.php";

            if(isset($_GET["checkCode"]))
                if($_GET["checkCode"] == $_SESSION["checkCode"]){
                    echo "OK";
                    newUserInsert($_SESSION["tempUser"], $_SESSION["tempPwd"] , $_SESSION["tempNome"], $_SESSION["tempCognome"], false);
                }
                else echo "<script> alert(\"Codice Errato!\") </script>";
        ?>

    </body>
    <br>
	<?php
		footer();
	?>
</html>