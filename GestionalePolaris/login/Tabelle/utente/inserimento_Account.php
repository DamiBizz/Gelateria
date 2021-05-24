<?php

    //---------------------------------Attributi--------------------------------------
    $connessione_db = '../../../connessione_db.php';
    $nome = $_POST['nome'];

    if($_POST['pwd'] != $_POST['pwd_verifica']){
        ?><script>alert("Password sbagliata !!!");</script><?php
         include 'index.php';
         exit;
    }

    $pwd = $_POST['pwd'];
    $pwd = hash('sha256', $pwd);

    if(!isset($_POST['ruolo'])){
        $ruolo = 0;
    }
    else if (isset($_POST['ruolo']) && $_POST['ruolo']=="true"){
        $ruolo = 1;
    }
    else {
        include 'index.php';
    }

    
    include "$connessione_db";
    //---------------------------------Inserimento dell'Allergene--------------------------------------
    $stmt = $conn->prepare("INSERT INTO utente(nome, pwd, ruolo) VALUES (?,?,?)");
	$stmt->bind_param("ssi", $nome, $pwd, $ruolo);

    
    //---------------------------------Controllo inserimento dati--------------------------------------
    if (!$stmt->execute()){
        ?><script>alert("Errore inserimento dati !!!");</script><?php
        include 'index.php';
        exit;
    }
    include 'index.php';
    
?>