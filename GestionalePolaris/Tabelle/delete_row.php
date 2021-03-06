<?php
    require 'C:/xampp/htdocs/Elaborato/GestionalePolaris/config.php';
    require 'C:/xampp/htdocs/Elaborato/GestionalePolaris/verifica_session.php';
?>

<?php

    include "$GLOBALS[connessione_db]";
    $tabella = $_POST["tabella"];
    $ID = $_POST["ID"];

    $stmt = $conn->prepare("DELETE FROM $tabella WHERE ID = ?");
    $bind = $stmt->bind_param('i', $ID);

    $exec = $stmt->execute();

    if ( false === $exec ) {
        error_log('mysqli execute() failed: ');
        error_log( print_r( htmlspecialchars($stmt->error), true ) );
    }
    
    $path = $tabella . "/";
    header('Location: ' . $path);
?>