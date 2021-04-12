<?php 
	session_start();
	if (!isset($_SESSION["user"]) || !isset($_SESSION["pwd"])) {
		header("Location: ../index.php");
	}
?>
<html> 
	<head> 
	<?php echo "<title>Spedizioni</title>" ?>	
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
			</div>
			<br>
		</div>
		<br>
		<div class="spedTableContainer">
		<?php 
			include "connect.php";
			include "func.php";
			$codeTruck = $_SESSION["user"];

            $query = "SELECT idSpedizione
            FROM spedizioni
            WHERE spedizioni.truckTracking =\"$codeTruck\"";
            $result = $conn->query($query);

            echo "<table id=\"ciao\">";
            
            while ($row = $result->fetch_assoc()) {
                $idSped   = $row["idSpedizione"];
				$_SESSION["idSped"] = $idSped;
                $resultArray =  qrCode($idSped);

                echo "<tr>
                            <td style=\"background-color: rgb(221, 119, 119)\">".$idSped."</td>
                            <td> <a href=\"".$resultArray[1]."\"> <img src=\"".$resultArray[0]."\" > </a></td>
                        </tr> <br>";

            }
            echo "</table> <br> <br>";
			
			footer();
		?>
		<br>
		</div>
	</body>
</html>