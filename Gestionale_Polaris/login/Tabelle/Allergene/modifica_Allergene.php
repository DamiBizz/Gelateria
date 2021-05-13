<?php

    //---------------------------------Attributi--------------------------------------
    include '../../../connessione_db.php';
    $ID = $_POST['ID'];
    $nome = $_POST['nome'];

     //---------------------------------Modifica dati ALLERGENE--------------------------------------
     $stmt = $conn->prepare("UPDATE allergene SET nome=? WHERE ID=?");
     $stmt->bind_param("si", $nome, $ID);
     
     //---------------------------------Controllo Dati modifica dati--------------------------------------
     if (!$stmt->execute()){
         ?><script>alert("Errore MODIFICA !!!");</script><?php
         include 'index.php';
         exit;
     }
    
     include 'index.php';

?>