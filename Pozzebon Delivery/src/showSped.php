<?php 
	session_start();
	if (!isset($_SESSION["user"]) && !isset($_SESSION["pwd"])) {
		header("Location: login.php");
	}
?>
<html> 
	<head> 
	<?php include "func.php"; echo "<title>Le Tue Spedizioni - ".countSped()."</title>" ?>	
		<link rel="stylesheet" type="text/css" href="style.css" />
		<link rel="icon" href="../img/truck.png"/>
		<meta name="viewport" content="width=device-width, initial-scale=1">
	</head>
	<body >
		<div class="supportCenteringSearch">
			<br>
			<div class="searchContainer">
				<form action="../src/sped.php" method="get">
					<br>
					<input class="searchBox" type="text" name="idSped" placeholder="Id Spedizione" required>
					<br> <br>
					<input class="searchBTN" type="submit" value="Cerca">
				</form>
				<form action="track.php" method="get">
					<input class="searchBTN" type="submit" value="Traccia">
				</form>
				<a href="areaPersonale.php"> <i> Area Personale </i> </a> <br> <br>
			</div>
			<br>
		</div>
		<br>
		<div class="spedTableContainer">
		<?php 
			include "connect.php";
			$user = $_SESSION["user"];

			if(countSped() == 0)
				echo "<p align=\"center\" > NON CI SONO SPEDIZIONI PER TE </p>";
			else{
				$query = "SELECT idSpedizione, mittente, destinatario, truckTracking, descb
				FROM spedizioni,clienti 
				WHERE spedizioni.mittente=clienti.idCliente
				AND clienti.mail = \"$user\"";

				$result = $conn->query($query);

				echo "<table id=\"ciao\">";
				
				while ($row = $result->fetch_assoc()) {
					$idSped    = $row["idSpedizione"];
					$trackCode = $row["truckTracking"];
					$desc      = $row["descb"];
					$resultArray =  qrCode($idSped);

					echo "<tr>
								<td style=\"background-color: rgb(221, 119, 119)\">".$idSped."<br> [Autista - ".$trackCode."] <br> [Descrizione - ".$desc."] </td>
								<td> <a href=\"".$resultArray[1]."\"> <img src=\"".$resultArray[0]."\" > </a></td>
							</tr> <br>";

				}
				echo "</table> <br> <br>";
			}
			
			footer();
		?>
	</body>
</html>