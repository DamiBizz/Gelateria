<?php
    require 'C:/xampp/htdocs/Elaborato/GestionalePolaris/config.php';
    require 'C:/xampp/htdocs/Elaborato/GestionalePolaris/verifica_session.php';
?>

<?php

    //---------------------------------Attributi--------------------------------------
    include "$GLOBALS[connessione_db]";
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