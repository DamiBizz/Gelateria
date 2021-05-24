<?php

$folderName = "../../../../Cliente/immagini/";
$text = $_POST['text'];

    //---------------------------------Attributi--------------------------------------
    include '../../../connessione_db.php';
    $IDProdotto = $_POST['ID'];
    $nome = $_POST['nome'];

    $disponibile = 0; //false
    if(!empty($_POST['disponibile'])){
        $disponibile = 1; //true
    }

    if (isset($_POST["IDIngrediente"]))
    {
        $IDIngrediente = $_POST["IDIngrediente"]; 
        //Numero elementi selezionati
        $n_IDIngrediente = count($IDIngrediente);
    }
    else $IDIngrediente = "N/A";

    //x IMG
    $img_vecchia = $_POST['img_vecchia'];
    
    $estensione_img_vecchia = $_POST['estensione_img_vecchia'];
    $estensione_img = $estensione_img_vecchia;


    //---------------IMMAGINE-------------------------
    
    if(!$_FILES["modifica_immagine"]["name"] == ""){
        $immagine = $_FILES["modifica_immagine"]["name"];
        $type = $_FILES["modifica_immagine"]["type"];
        $estensione = explode("/", $type);
        $filePath = $folderName . "$nome.$estensione[1]";
    
        //tipo png
        if($type!="image/png" && $type!="image/jpeg"){
            ?><script> alert("Errore formato non valido!!!"); </script><?php
            include "index.php";
            die();
        }
    
        //grandezza
        if($_FILES["modifica_immagine"]["size"]>=500000){ //500k
            ?><script> alert("Errore dimensione non valida!!!"); </script><?php
            include "index.php";
            die();
        }
    
        //ATTENZIONE!!! non devi uplodarlo ma devi modificare il file già esistente oppure cancelli prima il file vecchio
        unlink ($folderName.$img_vecchia);
        if (!move_uploaded_file($_FILES["modifica_immagine"]["tmp_name"], $filePath)) {
            ?><script> alert("Errore inserimento immagine !!!"); </script><?php
            include "index.php";
            die();
        }

        $estensione_img ="$estensione[1]";
        
    }

     //---------------------------------Modifica dati PRODOTTO--------------------------------------
     $stmt = $conn->prepare("UPDATE prodotto SET nome=?, estensione_img=?, disponibile=?, text=? WHERE ID=?");
     $stmt->bind_param("ssisi", $nome, $estensione_img, $disponibile, $text, $IDProdotto);
      //Controllo modifica dati
      if (!$stmt->execute()){
        ?><script>alert("Errore MODIFICA !!!");</script><?php
        include 'index.php';
        exit;
    }

    if($_FILES["modifica_immagine"]["name"] == ""){ //se non è stata ggiunta un altra img rinomina il file altrimenti lo perdi
        $oldname = $folderName.$img_vecchia;
        $newname = $folderName.$nome.'.'.$estensione_img_vecchia;

        if(!rename($oldname, $newname)){
            ?><script> alert("Errore modifica immagine !!!"); </script><?php
            include "index.php";
            die();
        }
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