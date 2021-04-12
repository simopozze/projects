<?php
include "func.php";
	if(!isset($_SESSION))
		session_start();
?>

<html> 
	<head> 
		<title> Pozzebon Delivery </title>
		<link rel="stylesheet" type="text/css" href="src/style.css" />
		<link rel="icon" href="img/truck.png">
		<meta name="viewport" content="width=device-width, initial-scale=1">
	</head>

	<script type="text/javascript">	
					if(window.confirm("Questo sito usa i cookie vuoi continuare?") && !Session["ookCok"]){
								Session["ookCok"] = true;
								window.location.href=".";
					}
					else{
						window.location.href="https://i.giphy.com/media/BEob5qwFkSJ7G/giphy.webp";
				}
				 
		</script>;
	<div class="headerContainer">
            <button class="homeBTN" onclick="window.location.href='../index.php'"> HOME </button>
	</div>
	<div class="indexCommandContainer">
			<br>
			<form action="src/loginAutisti.php" method="get">
				<input class="showLoginBTN" type="submit" value="Area Autisti">
			</form>
		
			<form action="src/hall.php" method="get">
				<input class="showLoginBTN" type="submit" value="Area Personale">
			</form>
			<br>
	</div>

	<?php 
		include "src/func.php";
		footer();
	?>
	</body>
</html>

