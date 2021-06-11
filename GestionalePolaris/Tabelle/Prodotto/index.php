<?php
    require 'C:/xampp/htdocs/Elaborato/GestionalePolaris/config.php';
    require 'C:/xampp/htdocs/Elaborato/GestionalePolaris/verifica_session.php';
?>

<!DOCTYPE html>
<html>
<head>
    <!-- bootstrap Lib -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="../tabelle.css">

    <title>Prodotto</title>
</head>
<body>

    <a class="torna_indietro" href="<?php echo $GLOBALS['domain_home']?>">
        <img width="60px" height="31px" src="../../../Images/back.png"></img>
    </a>

    <div class="text-center">
        <a href="inserimento_Prodotto_form.php" value="Inseriesci un nuovo prodotto">
            <img width="60px" height="60px" src="../../../Images/add_file.jpg"></img>
        </a>
    </div>
    

    <!-- -------------------------------------------------------------------- -->

    <!-- stampa la tabella con la possiblità di modificare ed eliminare un singolo campo -->
    <h3 class="titolo_sopra_tabella">GELATI</h3>
    <table id="tabelle">

        <tr>
            <th></th>
            <th>Nome</th>
            <th></th>
            <th>Ingredienti</th>
            <th>Descrizione</th>
            <th></th>
            <th></th>
        </tr>

        <?php
            include "$GLOBALS[connessione_db]";

            $sql = "SELECT * FROM prodotto ORDER BY prodotto.nome";

            $result = $conn->query($sql);

            while ($row=$result->fetch_assoc()) {
                echo "<tr>";
                if($row['disponibile'] == 1) echo "<td>".'<img width="25px" height="25px" src="../../../Images/Verde.png"></img>'."</td>";
                if($row['disponibile'] == 0) echo "<td>".'<img width="25px" height="25px" src="../../../Images/Rosso.png"></img>'."</td>";
                echo "<td>".$row["nome"]."</td>";
                $supp = $GLOBALS['domain_cartella_img_gelati'].$row["nome"].".".$row["estensione_img"];
                echo "<td>".'<img width="50px" height="50px" src="'.$supp.'"></img>'."</td>";

                //---------------------------------Scrivere il nome dell'allergene non il numero--------------------------------------
                $IDProdotto = $row['ID'];
                $sql3 = "SELECT DISTINCT ingrediente.nome FROM prodotto_ingrediente, prodotto, ingrediente 
                            WHERE prodotto_ingrediente.IDProdotto = prodotto.ID
                            AND prodotto_ingrediente.IDIngrediente = ingrediente.ID
                            AND $IDProdotto = prodotto_ingrediente.IDProdotto";
                $stmt3 = $conn->prepare($sql3);
                $stmt3->execute();
                $result3 = $stmt3->get_result();
                $supp = "";
                echo "<td>";    
                while ($row3 = $result3->fetch_assoc()) {
                    $supp .= $row3['nome']. "/";
                    echo $row3['nome']. "<br>";
                }
                echo "</td>";

                echo "<td>".$row["text"]."</td>";

                echo "<td>" . '<form onsubmit="return confirm('."'Sei sicuro/a di cancellare la riga?'".');" action="delete_row.php" method="POST">
                                    <input type="hidden" value="'.$row['ID'].'" name="ID"/>
                                    <input type="hidden" value="'.$row['nome'].'" name="nome"/>
                                    <input type="hidden" value="'.$row['estensione_img'].'" name="estensione_img"/>
                                    <input type="hidden" value="prodotto" name="tabella"/>

                                    <input type="image" name="submit" src="../../../Images/delete.png" border="0" width="45px" height="45px" alt="Submit"/>

                                </form>' . "</td>";

                echo "<td>" . '<form action="modifica_Prodotto_form.php" method="POST">
                                    <input type="hidden" value="'.$row['ID'].'" name="ID"/>
                                    <input type="hidden" value="'.$row['nome'].'" name="nome"/>
                                    <input type="hidden" value="'.$row['estensione_img'].'" name="estensione_img"/>
                                    <input type="hidden" value="'.$row['disponibile'].'" name="disponibile"/>
                                    <input type="hidden" value="'.$row['text'].'" name="text"/>
                                    <input type="hidden" value="'.$supp.'" name="nomeIngrediente"/>
                                    <input type="image" name="submit" src="../../../Images/edit.png" border="0" width="40px" height="40px" alt="Submit"/>
                                </form>' . "</td>";
                echo "</tr>";
            }

            $result->free();
            $conn->close();
        ?>

    </table>

</body>
</html>