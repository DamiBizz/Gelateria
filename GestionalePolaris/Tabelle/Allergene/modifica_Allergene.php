<?php
    require 'C:/xampp/htdocs/Elaborato/GestionalePolaris/config.php';
    require 'C:/xampp/htdocs/Elaborato/GestionalePolaris/verifica_session.php';
?>

<?php

    //---------------------------------Attributi--------------------------------------
    include "$GLOBALS[connessione_db]";
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