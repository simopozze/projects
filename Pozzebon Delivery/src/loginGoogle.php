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
        <?php 

            if(isset($_SESSION["user"]) && isset($_SESSION["pwd"])){
              header("Location: ../index.php");
            }

            else{

              require ("vendor/autoload.php");
              include "func.php";
              include "connect.php";

              $client = new Google_Client();

              $client->setClientId("<clientId>");
              $client->setClientSecret("<client secret>");
              $client->setRedirectUri("https://localhost/src/loginGoogle.php");
              $client->addScope("email");
              $client->addScope("profile");

              if(isset($_GET['code'])) {
                    $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
                    $client->setAccessToken($token['access_token']);                  

                    $google_oauth = new Google_Service_Oauth2($client);
                    $google_account_info = $google_oauth->userinfo->get();
                    $email  =  $google_account_info->email;
                    $name   =  $google_account_info->name;

                    $_SESSION["trackedSped"] = 0;

                    $loginQuery = "SELECT clienti.mail as \"mail\"
                                    FROM account, clienti
                                    WHERE clienti.idCliente=account.user
                                    AND clienti.mail = \"$email\"";

                    $loginRes   = $conn->query($loginQuery);

                if(mysqli_num_rows($loginRes) > 0 ){
                  $trackedSpedQuery = "SELECT COUNT(idSpedizione) as \"nSped\"
                  FROM spedizioni, clienti 
                    WHERE mittente=idCliente and clienti.mail=\"$email\"";

                  $trackedSpedRes   = $conn->query($trackedSpedQuery);
                  $row = $trackedSpedRes->fetch_assoc();
                  $nSped = $row["nSped"];

                  login($email," ", $name, " ", true, $nSped);
   
                }
                else {
                  $_SESSION["trackedSped"] = 0;
                  newGoogleUserInsert($email, $name,"", true);

                } 
              }
            else {
              $authUrl = $client->createAuthUrl();
              header("Location:".$authUrl."");
            }  
          }
        ?>
    </body>
</html>

        
