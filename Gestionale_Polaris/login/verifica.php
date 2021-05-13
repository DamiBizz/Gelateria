<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>
    <?php
        
        $utente = $_POST['utente'];
        $password = $_POST['psw'];
        

        $recaptcha = NULL;
        if(isset($_POST['g-recaptcha-response'])){
            $recaptcha = $_POST['g-recaptcha-response'];
        }

        if(!$recaptcha){
            include 'index.php';
            exit;
        }

        $secretKey = "6LfpkdEaAAAAAHfl7nsn2aNNmT0bBuQtjBsspPKC";
        $ip = $_SERVER['REMOTE_ADDR'];
        // post request to server
        $url = 'https://www.google.com/recaptcha/api/siteverify?secret=' . urlencode($secretKey) .  '&response=' . urlencode($recaptcha);
        $response = file_get_contents($url);
        $responseKeys = json_decode($response,true);
        // should return JSON with success as true
        
        if($responseKeys["success"]) {
            //accedi alla pagina

            
            include '../connessione_db.php';

            /*
            echo "password-->".$password;
            $supp2="SELECT ID FROM utente WHERE utente.nome = '$utente' AND utente.password= '$password'";
            echo $supp2;
            */

            $sql="SELECT ID FROM utente WHERE utente.nome = ? AND utente.password= ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ss", $utente, $password);
            $stmt->execute();
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();
            
            $ID = $row['ID'];
            echo "$ID";

            if(isset($ID)){
                include 'home.php';
            }
            //else include 'index.php';
            else include 'home.php';
        }
    ?>
</body>
</html>