<?php
    require 'C:/xampp/htdocs/Elaborato/GestionalePolaris/config.php';
?>


<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>
    <?php
        
        $utente = $_POST['utente'];
        $pwd = $_POST['pwd'];
        $pwd = hash('sha256', $pwd);

        $amministratore = 0;
        if(!empty($_POST['amministratore']))$amministratore = $_POST['amministratore']; //1
        

        $recaptcha = NULL;
        if(isset($_POST['g-recaptcha-response'])){
            $recaptcha = $_POST['g-recaptcha-response'];
        }

        if(!$recaptcha){
            ?><script>alert("Prego Identificati !!!");</script><?php
            header("Location: $GLOBALS[domain_login]");
            exit;
        }

        $secretKey = "6LfpkdEaAAAAAHfl7nsn2aNNmT0bBuQtjBsspPKC";
        $ip = $_SERVER['REMOTE_ADDR'];
        $url = 'https://www.google.com/recaptcha/api/siteverify?secret=' . urlencode($secretKey) .  '&response=' . urlencode($recaptcha);
        $response = file_get_contents($url);
        $responseKeys = json_decode($response,true);
        
        if($responseKeys["success"]) {
            
            include "$GLOBALS[connessione_db]";
            $sql = "SELECT pwd, ruolo FROM Utente WHERE nome=?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s", $utente);
            $stmt->execute();
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();
            
            if(is_null($row)){
                ?><script>alert("Utente non eistente !!!");</script><?php
                header("Location: $GLOBALS[domain_login]");
                exit;
            }
            else{
        
                if($pwd	== $row['pwd']){
                    session_start();
                    $_SESSION['autorizzato'] = 1;
                    $_SESSION['time'] = time();
                    $_SESSION['utente'] = $utente;
                    
                    if($row['ruolo'] == 1){
                        $_SESSION['ruolo'] = true;
                    }
                    else{ 
                        $_SESSION['ruolo'] = false;
                    }

                    header("Location: /index.php");
                    exit;  
                }

                else{
                    ?><script>alert("Password sbagliata !!!");</script><?php
                    header("Location: $GLOBALS[domain_login]");
                    exit;
                }
            }
        
            mysqli_close($conn);
        }

        else {
            ?><script>alert("Prego Identificati !!!");</script><?php
            header("Location: $GLOBALS[domain_login]");
        }
            
    ?>
</body>
</html>