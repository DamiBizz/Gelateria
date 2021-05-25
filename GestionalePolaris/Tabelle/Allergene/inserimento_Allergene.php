<?php
    require 'C:/xampp/htdocs/Elaborato/GestionalePolaris/config.php';
    require 'C:/xampp/htdocs/Elaborato/GestionalePolaris/verifica_session.php';
?>

<?php

    //---------------------------------Attributi--------------------------------------
    $nome = $_POST['nome'];

    
    include "$GLOBALS[connessione_db]";
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