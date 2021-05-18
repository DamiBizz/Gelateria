<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>
    <?php
        
        $utente = $_POST['utente'];
        $pwd = $_POST['pwd'];
        $amministratore = 0;
        if(!empty($_POST['amministratore']))$amministratore = $_POST['amministratore']; //1
        

        $recaptcha = NULL;
        if(isset($_POST['g-recaptcha-response'])){
            $recaptcha = $_POST['g-recaptcha-response'];
        }

        if(!$recaptcha){
            echo "sei un robot";
        }

        $secretKey = "6LfpkdEaAAAAAHfl7nsn2aNNmT0bBuQtjBsspPKC";
        $ip = $_SERVER['REMOTE_ADDR'];
        $url = 'https://www.google.com/recaptcha/api/siteverify?secret=' . urlencode($secretKey) .  '&response=' . urlencode($recaptcha);
        $response = file_get_contents($url);
        $responseKeys = json_decode($response,true);
        
        if($responseKeys["success"]) {
            
            include '../connessione_db.php';


            /*
                $sql3 = "SELECT ID FROM prodotto WHERE nome=?";
                $stmt3 = $conn->prepare($sql3);
                $stmt3->bind_param("s", $nome);
                $stmt3->execute();
                $result3 = $stmt3->get_result();
                $row3 = $result3->fetch_assoc();
                $IDProdotto = $row3['ID'];
            */


            $sql = "SELECT pwd FROM Utente WHERE nome=?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s", $utente);
            $stmt->execute();
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();
            
            if(is_null($row)){
                echo "non esiste l'utente";
                exit;
            }
            else{
        
                if(password_verify($pwd	, $row['pwd'])){
                    session_start();
                    $_SESSION['autorizzato'] = 1;
                    $_SESSION['time'] = time();
                    $_SESSION['utente'] = $utente;
                    
                    if($row['ruolo'] == 1){
                        echo "Loggato come AMMINISTRATORE";
                    }
                    else{ 
                        echo "Loggato come No AMMINISTRATORE";
                    }
                }

                else{
                    echo "password sbagliata"; 
                }
            }
        
            mysqli_close($conn);
        }

        else {
            echo "Prego identificati";
        }
            
    ?>
</body>
</html>