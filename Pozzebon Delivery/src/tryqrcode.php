<html> 
	<head> 
		<title> Pozzebon Delivery </title>
	</head>
	<body >
        <?php

            $idSession = "1";
            include "./func.php";
            ciao();
            $resultArray =  qrCode($idSession);
            echo $resultArray[1];
        ?>
	</body>
</html>