<?php
    require 'C:/xampp/htdocs/Elaborato/GestionalePolaris/config.php';
    require 'C:/xampp/htdocs/Elaborato/GestionalePolaris/verifica_session.php';
?>

<?php

    //---------------------------------Attributi--------------------------------------
    include "$GLOBALS[connessione_db]";
    $nome = $_POST['nome'];

    if(!empty($_POST['pwd'])){
        if($_POST['pwd'] != $_POST['pwd_verifica']){
            ?><script>alert("Password sbagliata !!!");</script><?php
             include 'index.php';
             exit;
        }
    
        $pwd = $_POST['pwd'];
        $pwd = hash('sha256', $pwd);
        
    
         //---------------------------------Modifica dati Account--------------------------------------
         $stmt = $conn->prepare("UPDATE utente SET pwd=? WHERE nome=?");
         $stmt->bind_param("ss", $pwd, $nome);
         
         //---------------------------------Controllo Dati modifica dati--------------------------------------
         if (!$stmt->execute()){
             ?><script>alert("Errore MODIFICA !!!");</script><?php
             include 'index.php';
             exit;
         }
        
         include 'index.php';
    }

    else {
        ?><script>alert("Inserisci una password !!!");</script><?php
        include 'index.php';
        exit;
       
        include 'index.php';
    }


    

?>