<?php

    //---------------------------------Attributi--------------------------------------
    include '../../../connessione_db.php';
    $nome = $_POST['nome'];
    $sigla = $_POST['sigla'];
    $IDAllergene = $_POST['IDAllergene'];
    
    //---------------------------------Inserimento DATO--------------------------------------
    $stmt = $conn->prepare("INSERT INTO ingrediente(nome, sigla, IDAllergene) VALUES (?,?,?)");
	$stmt->bind_param("ssi", $nome, $sigla, $IDAllergene);
    
    //---------------------------------Controllo inserimento dati--------------------------------------
    if (!$stmt->execute()){
        ?><script>alert("Errore inserimento dati !!!");</script><?php
        include 'index.php';
        exit;
    }
    include 'index.php';
    
?>