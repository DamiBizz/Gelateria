<?php

    //---------------------------------Attributi--------------------------------------
    include '../../../connessione_db.php';
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

    if(isset($_POST['pwd'])){
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