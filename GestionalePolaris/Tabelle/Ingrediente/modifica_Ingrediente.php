<?php
    require 'C:/xampp/htdocs/Elaborato/GestionalePolaris/config.php';
    require 'C:/xampp/htdocs/Elaborato/GestionalePolaris/verifica_session.php';
?>

<?php

    //---------------------------------Attributi--------------------------------------
    include "$GLOBALS[connessione_db]";
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