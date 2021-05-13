<?php

    //---------------------------------Attributi--------------------------------------
    include '../../../connessione_db.php';
    $nome = $_POST['nome'];

    
    //---------------------------------Inserimento dell'Allergene--------------------------------------
    $stmt = $conn->prepare("INSERT INTO allergene(nome) VALUES (?)");
	$stmt->bind_param("s", $nome);

    
    //---------------------------------Controllo inserimento dati--------------------------------------
    if (!$stmt->execute()){
        ?><script>alert("Errore inserimento dati !!!");</script><?php
        include 'index.php';
        exit;
    }
    include 'index.php';
    
?>