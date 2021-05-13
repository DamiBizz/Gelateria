<!DOCTYPE html>
<html>
<head>
    <!-- bootstrap Lib -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <!-- per la selezione multipla -->
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/css/select2.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/select2.min.js"></script>
    <title>Prodotto</title>
</head>
<body>
    <!---------------Funzione select, visualizza le varie opzioni------------------>
    <?php 
        function select($name, $tabella){
            include '../../../connessione_db.php';
            
            $sql = "SELECT DISTINCT $name,ID FROM $tabella ORDER BY $name";
            $result = $conn->query($sql);
            echo "<option></option>";
            while($row = $result->fetch_assoc())
            {
                $var = $row["ID"];
                echo "<option name='$row[$name]' value = '$var' > $row[$name] </option>";
            }
        }
    ?>
    
    <a href="../../home.php"><button>Torna indietro</button></a>

    <!-- pulsante per l'inserimento di un nuovo PRODOTTO -->
    <h3>Inserisci un nuovo Prodotto</h3>
    <form action="inserimento_Prodotto.php" method="POST" enctype="multipart/form-data">
        nome Prodotto<input maxlength="60" type="text" name="nome" required/>
        qunatità disponibile<input type="number" min="0" max="999" name="qunatitaDisponibile"/><br>
        immagine<input type="file" name="immagine" />
        <!-- inserire la relazione con la tabella ingrediente -->
        Ingredienti: <select class="mul-select" multiple="true" name="IDIngrediente[]"> <?php select('nome', 'ingrediente'); ?> </select>
        <input type="submit" value="Conferma" />
    </form>

    <script>
        $(".mul-select").select2({
            placeholder: "Seleziona Ingredienti",
            tags: true,
            tokenSeparators: ['/',',',';'," "] 
        });
    </script>

    <!-- -------------------------------------------------------------------- -->

    <!-- stampa la tabella con la possiblità di modificare ed eliminare un singolo campo -->
    <h3>Tabella dati inseriti</h3>
    <table border="1">

        <tr>
            <th>nome</a></th>
            <th>Qunatità disp.</th>
            <th>Ingredienti</th>
            <th></th>
            <th></th>
        </tr>

        <?php
            include '../../../connessione_db.php';

            $sql = "SELECT * FROM prodotto";

            $result = $conn->query($sql);

            while ($row=$result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>".$row["nome"]."</td>";
                echo "<td>".$row["quantitaDisponibile"]."</td>";


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



                echo "<td>" . '<form onsubmit="return confirm('."'Sei sicuro/a di cancellare la riga?'".');" action="../delete_row.php" method="POST">
                                    <input type="hidden" value="'.$row['ID'].'" name="ID"/>
                                    <input type="hidden" value="prodotto" name="tabella"/>
                                    <button type="submit">
                                        <img width="24px" height="24px" src="../images/delete.png"></img>
                                    </button>
                                </form>' . "</td>";
                echo "<td>" . '<form action="modifica_Prodotto_form.php" method="POST">
                                    <input type="hidden" value="'.$row['ID'].'" name="ID"/>
                                    <input type="hidden" value="'.$row['nome'].'" name="nome"/>
                                    <input type="hidden" value="'.$row['quantitaDisponibile'].'" name="quantitaDisponibile"/>
                                    <input type="hidden" value="'.$supp.'" name="nomeIngrediente"/>
                                    <button type="submit">
                                        <img width="24px" height="24px" src="../images/edit.png"></img>
                                    </button>
                                </form>' . "</td>";
                echo "</tr>";
            }

            $result->free();
            $conn->close();
        ?>

    </table>

</body>
</html>