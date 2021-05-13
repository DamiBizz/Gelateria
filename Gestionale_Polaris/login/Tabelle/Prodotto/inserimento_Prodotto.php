<?php

    //---------------------------------Attributi--------------------------------------
    include '../../../connessione_db.php';
    $nome = $_POST['nome'];
    if (empty($_POST["qunatitaDisponibile"])) $qunatitaDisponibile = 0;
    else $qunatitaDisponibile = $_POST['qunatitaDisponibile'];

    if (isset($_POST["IDIngrediente"])) {
        $IDIngrediente = $_POST["IDIngrediente"];
        //Numero elementi selezionati
        $n_IDIngrediente = count($IDIngrediente);
    } else $IDIngrediente = "N/A";









    $immagine = $_FILES["immagine"]["name"];
    $folderName = "immagini/";
    // Generate a unique name for the image 
    // to prevent overwriting the existing image
    $filePath = $folderName . rand(10000, 990000) . '_' . time() . '.' . "png";

    //tipo
    if($_FILES["immagine"]["type"]!="image/png"){
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





    //---------------------------------Inserimento del Prodotto--------------------------------------
    //echo "INSERT INTO prodotto(nome, quantitaDisponibile) VALUES ('$nome', '$qunatitaDisponibile')";
    $stmt = $conn->prepare("INSERT INTO prodotto(nome, quantitaDisponibile, immagine) VALUES (?,?,?)");
    $stmt->bind_param("sis", $nome, $qunatitaDisponibile, $filePath);
    if (!$stmt->execute()) {
        ?><script> alert("Errore inserimento dati !!!"); </script><?php
                include "index.php";
                die();
            }

            if ($IDIngrediente == "N/A") {
                ?><script>
                    alert("Attenzione, non hai collegato il Prodotto ad alcun ingrediente");
                </script><?php
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