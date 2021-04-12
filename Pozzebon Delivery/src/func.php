<?php

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;
    use my\Geocoding;
	if(!isset($_SESSION))
		session_start();
?>

<html>  
    <body link="#ffffff" vlink="#ffffff">
        <?php         


            function url(){
                return  "https://localhost/";
                //
            }
            function qrCode($id) {

                require_once "phpqrcode/qrlib.php";
                $path        = "../img/";
                $file        = $path.$id.".png";
                $url         = url()."src/sped.php?idSped=".$id;

                QRcode::png($url, $file, "L", 4, 4);

            return array($file, $url);
            }

            function footer(){

                if(isset($_SESSION["user"])){
                    $user = $_SESSION["user"]; 
                }else $user = "";
                
                    echo "<div class=\"footerContainer\">
                    <br>
                      <button class=\"homeBTN\" onclick=\"window.location.href=' ".url().
                      " '\"> <b> Home [".$user."] </b> </button><br> <br>
                      </div>";
            }

            
            function logout(){
                 if(isset($_SESSION["user"]) && isset($_SESSION["pwd"])){
                    unset($_SESSION["user"]);
                    unset($_SESSION["pwd"]);
                    session_destroy();
                    header("Location: login.php");
                }
               else { session_destroy(); header("Location: ../index.php");}
            }

            function login($user, $pwd, $nome, $cognome, $google){
                    $_SESSION["user"]    = $user;
                    $_SESSION["pwd"]     = $pwd;
                    $_SESSION["nome"]    = $nome;
                    $_SESSION["cognome"] = $cognome;
                    $_SESSION["google"]  = $google;
                    header("Location: areaPersonale.php");
            }

            function checkUserExist($user){
                include "connect.php";

                $checQuery = "SELECT idCliente 
                            FROM account, clienti
                            WHERE idCliente=user 
                            AND clienti.mail=\"$user\"";

                $checRes   = $conn->query($checQuery);

                if(mysqli_num_rows($checRes) <= 0 )
                    return true;
                else echo false;
            }

            function newUserInsert($email, $pwd,  $nome, $cognome, $google){
                include "connect.php";

                $inserNewClienteQuery = "INSERT INTO clienti (nome, cognome, mail)
                                            VALUES(\"$nome\",\"$cognome\",\"$email\")";
                  
                if (mysqli_query($conn, $inserNewClienteQuery)) {
                    echo "";
                }
                else {
                    echo "Errore Di Inserimento!".mysqli_error($conn);
                }

                  //getNewClientID
                $loginQuery = "SELECT idCliente
                FROM clienti
                WHERE mail = \"$email\"";


                $loginRes   = $conn->query($loginQuery);

                $row   = $loginRes->fetch_assoc();
                $_user  = $row["idCliente"];
                echo $_user;

                if(isset($_user)){ 
                    $inserNewClienteQuery = "INSERT INTO account (user, password)
                VALUES(\"$_user\", DES_ENCRYPT(\"$pwd\"))";

                    if (mysqli_query($conn, $inserNewClienteQuery)) {
                        login($email," ", $nome, $cognome, $google, 0);
                    }
                    else {
                        echo "Errore Di Inserimento!".mysqli_error($conn);
                    }
                }       
            }

            function newGoogleUserInsert($email, $pwd, $name, $google){
                include "connect.php";

                $inserNewClienteQuery = "INSERT INTO clienti (nome, cognome, mail)
                                            VALUES(\"$name\",NULL,\"$email\")";
                  
                if (mysqli_query($conn, $inserNewClienteQuery)) {
                    echo "New record created successfully";
                }
                else {
                    echo "Errore Di Inserimento!".mysqli_error($conn);
                }

                  //getNewClientID
                $loginQuery = "SELECT idCliente
                FROM clienti
                WHERE mail = \"$email\"";

                $loginRes   = $conn->query($loginQuery);

                $row = $loginRes->fetch_assoc();
                $id  = $row["idCliente"];

                if(isset($id)){
                    $inserNewClienteQuery = "INSERT INTO account (user, password)
                VALUES(\"$id\",NULL)";

                    if (mysqli_query($conn, $inserNewClienteQuery)) {
                        login($email," ", $name, " ", $google, 0);
                    }
                    else {
                        echo "Errore Di Inserimento!".mysqli_error($conn);
                    }
                }       
            }

            function checkMail($user){

                require 'PHPMailer/src/Exception.php';
                require 'PHPMailer/src/PHPMailer.php';
                require 'PHPMailer/src/SMTP.php';
                //Load Composer's autoloader
                //require 'vendor/autoload.php';

                //Instantiation and passing `true` enables exceptions
                $mail = new PHPMailer(true);

                try {
                    //Server settings
                    $mail->SMTPDebug  = 0;                      //Enable verbose debug output
                    $mail->isSMTP();                                            //Send using SMTP
                    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
                    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
                    $mail->Username   = 'provadeliverypozze@gmail.com ';                     //SMTP username
                    $mail->Password   = 'doogeex9pro';                               //SMTP password
                    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         //Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
                    $mail->Port       = 587;                                    //TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

                    //Recipients'
                    $mail->setFrom('pozze.simo@gmai.com', 'Pozzebon Delivery');
                    $mail->addAddress($user, '');     //Add a recipient

                    $checkCode =  random_int ( 100 , 100000);
                    $msg = "Pozzebon Delivery \n Questo e' il tuo codice di verifica: ".$checkCode;

                    //Content
                    $mail->isHTML(true);                                  //Set email format to HTML
                    $mail->Subject = 'Codice Di Verifica';
                    $mail->Body    = $msg;
                    $mail->send();

                    echo "Debug -> ".$checkCode;
                    return $checkCode;
                } catch (Exception $e) {
                    echo "Email non inviata! {$mail->ErrorInfo}";
                }
            }

            function countSped(){
                include "connect.php";
                
                $user = $_SESSION["user"];
                $trackedSpedQuery = "SELECT COUNT(idSpedizione) as \"nSped\"
                FROM spedizioni, clienti 
                 WHERE mittente=idCliente and clienti.mail=\"$user\"";

                $trackedSpedRes   = $conn->query($trackedSpedQuery);
                $row = $trackedSpedRes->fetch_assoc();
                $nSped = $row["nSped"];
                
                return $nSped;
            }
            
            function trackSped($mitt, $dest, $truckCode, $desc){
                    include "connect.php";

                    $getMittQuery = "SELECT idCliente
                    FROM clienti
                    WHERE mail = \"$mitt\"";
    
    
                    $loginRes   = $conn->query($getMittQuery);
    
                    $row   = $loginRes->fetch_assoc();
                    $codeMitt  = $row["idCliente"];

                    $getDestQuery = "SELECT idCliente
                    FROM clienti
                    WHERE mail = \"$dest\"";
    
    
                    $loginRes   = $conn->query($getDestQuery);
    
                    $row   = $loginRes->fetch_assoc();
                    $codeDest  = $row["idCliente"];

                    $insertNewSpedQuery = "INSERT INTO spedizioni (mittente, destinatario, truckTracking, descb)
                                                VALUES(\"$codeMitt\",\"$codeDest\",\"$truckCode\", \"$desc\")";
                      
                    if (mysqli_query($conn, $insertNewSpedQuery)) {
                        header("Refresh: 0; showSped.php");
                    }
                    else {
                        echo "Errore Di Inserimento!".mysqli_error($conn);
                    }
            }
        
            function getCoord($addr){
                require "Geocoding.php";
                
                $geo = new Geocoding("<token id>");

                $cord = $geo -> getCoordinates($addr);

                return [ 'LT' => $cord['latitude'], 'LO' =>  $cord['longitude']];
            }

            function addTappa($idSped, $dat, $ora, $addr, $lat, $lon){

               include "connect.php";
                $insertTappa = "INSERT INTO tappe (spedizione, dat, ora, addr, lat, lon)
                                VALUES($idSped,\"$dat\",\"$ora\", \"$addr\", \"$lat\", \"$lon\")";
                        
                    if (mysqli_query($conn, $insertTappa)) {
                        header("Refresh: 0; sped.php?idSped=$idSped");

                    }
                    else {
                        echo "Errore Di Inserimento!".mysqli_error($conn);
                    }

            }
        ?>
    </body>
</html>
