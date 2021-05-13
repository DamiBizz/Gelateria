<?php

    //---------------------------------Attributi--------------------------------------
    include '../../../connessione_db.php';
    $ID = $_POST['ID'];
    $nome = $_POST['nome'];
    $sigla = $_POST['sigla'];
    $IDAllergene = $_POST['IDAllergene'];

     //---------------------------------Modifica dati PRODOTTO--------------------------------------
     $stmt = $conn->prepare("UPDATE ingrediente SET nome=?, sigla=?, IDAllergene=? WHERE ID=?");
     $stmt->bind_param("ssii", $nome, $sigla, $IDAllergene, $ID);
     
     //---------------------------------Controllo modifica dati--------------------------------------
     if (!$stmt->execute()){
         ?><script>alert("Errore MODIFICA !!!");</script><?php
         include 'index.php';
         exit;
     }
    
     include 'index.php';

?>