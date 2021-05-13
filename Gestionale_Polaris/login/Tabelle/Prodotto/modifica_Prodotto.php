<?php

    //---------------------------------Attributi--------------------------------------
    include '../../../connessione_db.php';
    $IDProdotto = $_POST['ID'];
    $nome = $_POST['nome'];
    $quantitaDisponibile = $_POST['quantitaDisponibile'];

    if (isset($_POST["IDIngrediente"]))
    {
        $IDIngrediente = $_POST["IDIngrediente"]; 
        //Numero elementi selezionati
        $n_IDIngrediente = count($IDIngrediente);
    }
    else $IDIngrediente = "N/A";


     //---------------------------------Modifica dati PRODOTTO--------------------------------------
     $stmt = $conn->prepare("UPDATE prodotto SET nome=?, quantitaDisponibile=? WHERE ID=?");
     $stmt->bind_param("sii", $nome, $quantitaDisponibile, $IDProdotto);
      //Controllo modifica dati
      if (!$stmt->execute()){
        ?><script>alert("Errore MODIFICA !!!");</script><?php
        include 'index.php';
        exit;
    }

    //---------------------------------Elimina i collegamenti precedenti con le tabelle--------------------------------------
    $sql2="DELETE FROM prodotto_ingrediente WHERE IDProdotto = ?";
    $stmt2 = $conn->prepare($sql2);
    $stmt2->bind_param("i", $IDProdotto);
    $exec = $stmt2->execute();



    if ($IDIngrediente == "N/A"){
        include 'index.php';
        exit; 
    }

    //---------------------------------Collega con i nuovi parametri le due tabelle--------------------------------------
    for ($i=0; $i<$n_IDIngrediente; $i++){
        $sql4="INSERT INTO prodotto_ingrediente(IDProdotto, IDIngrediente) VALUES (?,?)";
        $stmt4 = $conn->prepare($sql4);
        $stmt4->bind_param("ii", $IDProdotto, $IDIngrediente[$i]);
        
        //Controllo inserimento dati
        if (!$stmt4->execute()){
            ?><script>alert("Errore MODIFICA dati !!!");</script><?php
            include "index.php";
            exit;
        }
    }
    include 'index.php';

?>