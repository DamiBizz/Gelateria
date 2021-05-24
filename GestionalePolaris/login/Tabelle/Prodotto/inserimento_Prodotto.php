<?php
    $_connessione_db = '../../../connessione_db.php';
    //$folderName = "../../../../Cliente/immagini/";
    $folderName = "../../../../Cliente/immagini/";

    //---------------------------------Attributi--------------------------------------
    
    $nome = $_POST['nome'];
    $text = $_POST['text'];

    $disponibile = 0; //false
    if(!empty($_POST['disponibile'])){
        $disponibile = 1; //true
    }

    if (isset($_POST["IDIngrediente"])) {
        $IDIngrediente = $_POST["IDIngrediente"];
        //Numero elementi selezionati
        $n_IDIngrediente = count($IDIngrediente);
    } else $IDIngrediente = "N/A";


    //---------------IMMAGINE-------------------------
    $immagine = $_FILES["immagine"]["name"];
    $type = $_FILES["immagine"]["type"];
    $estensione = explode("/", $type);
    $filePath = $folderName . "$nome.$estensione[1]";

    //accetto solo tipo png e jpeg
    if($type!="image/png" && $type!="image/jpeg"){
        echo "type-->".$type;
        ?><script> alert("Errore formato non valido!!!"); </script><?php
        include "index.php";
        die();
    }

    //grandezza
    if($_FILES["immagine"]["size"]>=500000){ //500k
        ?><script> alert("Errore dimensione non valida!!!"); </script><?php
        include "index.php";
        die();
    }

    //uplode
    if (!move_uploaded_file($_FILES["immagine"]["tmp_name"], $filePath)) {
        ?><script> alert("Errore inserimento immagine !!!"); </script><?php
        include "index.php";
        die();
    }

    $estensione_img ="$estensione[1]";

    include "$_connessione_db";

    //---------------------------------Inserimento del Prodotto--------------------------------------
    //echo "INSERT INTO prodotto(nome, quantitaDisponibile) VALUES ('$nome', '$qunatitaDisponibile')";
    $stmt = $conn->prepare("INSERT INTO prodotto(nome, estensione_img, disponibile, text) VALUES (?,?,?,?)");
    $stmt->bind_param("ssis", $nome, $estensione_img, $disponibile, $text);
    if (!$stmt->execute()) {
        ?><script> alert("Errore inserimento dati !!!"); </script><?php
                include "index.php";
                die();
            }

            if ($IDIngrediente == "N/A") {
                include 'index.php';
                exit;
            }

            //---------------------------------Trova l'ID dei parametri appena inseriti--------------------------------------
            $sql3 = "SELECT ID FROM prodotto WHERE nome=?";
            $stmt3 = $conn->prepare($sql3);
            $stmt3->bind_param("s", $nome);
            $stmt3->execute();
            $result3 = $stmt3->get_result();
            $row3 = $result3->fetch_assoc();
            $IDProdotto = $row3['ID'];

            //---------------------------------Collega le due tabelle--------------------------------------
            for ($i = 0; $i < $n_IDIngrediente; $i++) {
                $sql4 = "INSERT INTO prodotto_ingrediente(IDProdotto, IDIngrediente) VALUES (?,?)";
                $stmt4 = $conn->prepare($sql4);
                $stmt4->bind_param("ii", $IDProdotto, $IDIngrediente[$i]);

                //---------------------------------Controllo inserimento dati--------------------------------------
                if (!$stmt4->execute()) {
                ?><script>
            alert("Errore inserimento dati !!!");
        </script><?php
                    include "index.php";
                    exit;
                }
            }
            include 'index.php';

?>