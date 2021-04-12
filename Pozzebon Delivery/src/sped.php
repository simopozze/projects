<?php
    session_start();
    if(!isset($_SESSION["user"]) && !isset($_SESSION["pwd"])){
        header("Location: ../index.php");
    }
?>
<html>
    <head> 
    <?php echo "<title> Spedizione - ".$_GET["idSped"]."</title>" ?>
		<link rel="stylesheet" type="text/css" href="style.css" />
		<link rel="icon" href="../img/truck.png"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
	</head>
    <body>
        <div class="supportCentering">
            <br>
            <div class="descSpedizioneContainer">

                <?php
                    $idSPED             = $_GET["idSped"];
                    $_SESSION["idSped"] = $idSPED;

                    include "connect.php";

                    $checkQuery = "SELECT *
                                    FROM spedizioni
                                    WHERE idSpedizione = $idSPED";
                    $checkRes  =  $conn->query($checkQuery);

                    if( !mysqli_num_rows($checkRes) > 0){
                        echo "<script> alert(\"NON ESISTE QUESTA SPEDIZIONE!\") </script>";
                        echo ":)";
                        header("Refresh: 0; showSped.php");
                    }
                    else{
                            
                            $querySped = "SELECT S.idSpedizione, C.nome as NomeMittente, C.cognome as CognomeMittente, C.mail as MailMittente, D.nome as NomeDestinatario, D.cognome as CognomeDestinatario, D.mail as MailDestinatario, S.truckTracking as truckTracking
                    
                            FROM spedizioni 
                                AS S INNER JOIN clienti 
                                AS C INNER JOIN clienti 
                                AS D ON C.idCliente = S.mittente 
                                AND D.idCliente = S.destinatario 
                                AND S.idSpedizione = $idSPED";

                            $queryTappe = "SELECT * 
                                        FROM tappe
                                        WHERE spedizione=$idSPED";
                
                            $resultSped = $conn->query($querySped);
                            $resTappe = $conn->query($queryTappe);

                            echo "<a href=\"deleteSped.php\"> ELIMINA SPEDIZIONE </a> <br> <br>";                            
                            
                            while ($row = $resultSped->fetch_assoc()) {
                                $nomeM              = $row["NomeMittente"];
                                $cognomeM           = $row["CognomeMittente"];
                                $mailM	            = $row["MailMittente"];
                                $nomeD              = $row["NomeDestinatario"];
                                $cognomeD           = $row["CognomeDestinatario"];
                                $mailD	            = $row["MailDestinatario"];
                                $truckTracking      = $row["truckTracking"];

                                echo "<button class=\"buttonLabel\"> <b> CODICE AUTISTA </b> <br>
                                <label>".$truckTracking."</label>
                                </button> <br> <br>";
                                
                                echo "<button class=\"buttonLabel\"> <b> MITTENTE </b> <br>
                                    <label>".$nomeM."</label> 
                                    <label>".$cognomeM."</label> <br> 
                                    <label>".$mailM."</label>
                                </button> <br> <br>";

                                echo "<button class=\"buttonLabel\"> <b> DESTINATARIO </b> <br> 
                                    <label>".$nomeD."</label> 
                                    <label>".$cognomeD."</label> <br>
                                    <label>".$mailD."</label> 
                                </button> <br> <br>";

                        }

                        $nTappa = 1;
                        echo "
                        <form action=\"addTappa.php\">
                            <input class=\"loginBTN\"type=\"submit\" value=\"AGGIUNGI TAPPA\" />
                        </form>

                        <button class=\"buttonLabel\"> 
                            <b> TAPPE </b> <br>";
                        
                        while ($row = $resTappe->fetch_assoc()) {
                            $spedizione    = $row["spedizione"];
                            $data           = $row["dat"];
                            $ora	        = $row["ora"];
                            $addr           = $row["addr"];
                            $latitudine     = $row["lat"];
                            $longitudine    = $row["lon"];

                            echo "<label> <u>".$nTappa."</u> </label> <br>";
                            echo "<label>".$data."</label>  ";
                            echo "<label>".$ora."</label> <br>";
                            echo "<label> <b> INDIRIZZO: </b></label> &nbsp";
                            echo "<label>".$addr."</label> &nbsp";
                            echo "<label> <b> LAT: </b> </label> &nbsp";
                            echo "<label>".$latitudine."</label> &nbsp";
                            echo "<label> <b> LONG: </b></label>";
                            echo "<label>".$longitudine."</label> <br> <br>";
                            
                            $nTappa++;
                    }
                    echo "</button> <br>";
                    
                }
                ?>
            </div>
            <br>

            
        </div>
        <br>
    </body>
	<?php 
		include "func.php";
        echo "<br>";
		footer();
	?>
</html>