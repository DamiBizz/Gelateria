<?php

    $folderName = "../../../../Cliente/immagini/";

    include "../../../connessione_db.php";
    $ID = $_POST["ID"];
    $nome = $_POST["nome"];
    $estensione_img = $_POST["estensione_img"];

    $stmt = $conn->prepare("DELETE FROM prodotto WHERE ID = ?");
    $bind = $stmt->bind_param('i', $ID);

    $exec = $stmt->execute();

    if ( false === $exec ) {
        error_log('mysqli execute() failed: ');
        error_log( print_r( htmlspecialchars($stmt->error), true ) );
    }

    
    unlink ($folderName.$nome.'.'.$estensione_img);
    
    $path = $tabella . "index.php";
    header('Location: ' . $path);
?>