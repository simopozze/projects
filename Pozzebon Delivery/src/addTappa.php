<?php 
  if(!isset($_SESSION))
    session_start();
?>
<html>
    <head> 
		<title> Aggiungi Tappa </title>
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
			<form action="addTappa.php" method="post">
				<br>
				<input class="loginBox" type="text" name="addr" placeholder="Indirizzo" required> <br> <br>
                <input class="loginBox" type="date" name="date" required> 
                <input class="loginBox" type="text" name="hour" placeholder="hh:mm" maxlength="5" required>
				<input class="loginBTN" type="submit" value="Aggiungi">
            </form>
            <br>
		</div>
        <br>
        </div>
        <?php
            include "func.php";

            if(isset($_POST['addr']) && isset($_POST['date']) && isset($_POST['hour'])){
                $crd    = getCoord($_POST["addr"]);
                $addr   = $_POST["addr"];

                $id     = $_SESSION["idSped"];
                $lt     = $crd["LT"];
                $lo     = $crd["LO"];
                $dt     = $_POST['date'];
                $h      = $_POST['hour'];
                
                addTappa($id, $dt, $h, $addr, $lt, $lo);
            } 
        ?>
    </body>
    <br>
	<?php 
		footer();
	?>
</html>