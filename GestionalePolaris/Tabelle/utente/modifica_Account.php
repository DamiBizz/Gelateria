<?php
    require 'C:/xampp/htdocs/Elaborato/GestionalePolaris/config.php';
    require 'C:/xampp/htdocs/Elaborato/GestionalePolaris/verifica_session.php';

    if (!$_SESSION['ruolo']){
        header("Location: $GLOBALS[domain_login]");
        exit;
    }
?>

<?php

    //---------------------------------Attributi--------------------------------------
    include "$GLOBALS[connessione_db]";
    $ID = $_POST['ID'];
    $nome = $_POST['nome'];

    if(!isset($_POST['ruolo'])){
        $ruolo = 0;
    }
    else if (isset($_POST['ruolo']) && $_POST['ruolo']=="true"){
        $ruolo = 1;
    }
    else {
        include 'index.php';
    }

    if(!empty($_POST['pwd'])){
        if($_POST['pwd'] != $_POST['pwd_verifica']){
            ?><script>alert("Password sbagliata !!!");</script><?php
             include 'index.php';
             exit;
        }
    
        $pwd = $_POST['pwd'];
        $pwd = hash('sha256', $pwd);
        
    
         //---------------------------------Modifica dati Account--------------------------------------
         $stmt = $conn->prepare("UPDATE utente SET nome=?, pwd=?, ruolo=? WHERE ID=?");
         $stmt->bind_param("ssii", $nome, $pwd, $ruolo, $ID);
         
         //---------------------------------Controllo Dati modifica dati--------------------------------------
         if (!$stmt->execute()){
             ?><script>alert("Errore MODIFICA !!!");</script><?php
             include 'index.php';
             exit;
         }
        
         include 'index.php';
    }

    else {
        $stmt = $conn->prepare("UPDATE utente SET nome=?, ruolo=? WHERE ID=?");
        $stmt->bind_param("sii", $nome, $ruolo, $ID);
        
        //---------------------------------Controllo Dati modifica dati--------------------------------------
        if (!$stmt->execute()){
            ?><script>alert("Errore MODIFICA !!!");</script><?php
            include 'index.php';
            exit;
        }
       
        include 'index.php';
    }


    

?>