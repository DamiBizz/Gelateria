<?php
    require 'C:/xampp/htdocs/Elaborato/GestionalePolaris/config.php';
    require 'C:/xampp/htdocs/Elaborato/GestionalePolaris/verifica_session.php';
?>

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
            include "$GLOBALS[connessione_db]";
            
            $sql = "SELECT DISTINCT $name,ID FROM $tabella ORDER BY $name";
            $result = $conn->query($sql);
            while($row = $result->fetch_assoc())
            {
                $var = $row["ID"];
                echo "<option name='$row[$name]' value = '$var' > $row[$name] </option>";
            }
        }
    ?>
    
    <a href="<?php echo $GLOBALS['domain_home']?>"><button>Torna indietro</button></a>

    <!-- pulsante per l'inserimento di un nuovo PRODOTTO -->
    <h3>Inserisci un nuovo Prodotto</h3>
    <form action="inserimento_Prodotto.php" method="POST" enctype="multipart/form-data">
        nome Prodotto<input maxlength="60" type="text" name="nome" required/> <br>

        Disponibile atttualemente? 
            <input type="checkbox" value="true" name="disponibile">
            <label for="disponibile">Si</label>

        <br>
        immagine<input type="file" name="immagine" required/> <br>
        <!-- inserire la relazione con la tabella ingrediente -->
        Ingredienti: <select class="mul-select" multiple="true" name="IDIngrediente[]"> <?php select('nome', 'ingrediente'); ?> </select>
        Text: <input maxlength="500" type="text" name="text"/> <br>
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
            <th>Disponibile?</th>
            <th>Immagine</th>
            <th>Ingrediente</th>
            <th>Text</th>
            <th></th>
            <th></th>
        </tr>

        <?php
            include "$GLOBALS[connessione_db]";

            $sql = "SELECT * FROM prodotto ORDER BY prodotto.nome";

            $result = $conn->query($sql);

            while ($row=$result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>".$row["nome"]."</td>";
                echo "<td>".$row["disponibile"]."</td>";
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
                                    <button type="submit">
                                        <img width="24px" height="24px" src="../../../Images/delete.png"></img>
                                    </button>
                                </form>' . "</td>";
                echo "<td>" . '<form action="modifica_Prodotto_form.php" method="POST">
                                    <input type="hidden" value="'.$row['ID'].'" name="ID"/>
                                    <input type="hidden" value="'.$row['nome'].'" name="nome"/>
                                    <input type="hidden" value="'.$row['estensione_img'].'" name="estensione_img"/>
                                    <input type="hidden" value="'.$row['disponibile'].'" name="disponibile"/>
                                    <input type="hidden" value="'.$row['text'].'" name="text"/>
                                    <input type="hidden" value="'.$supp.'" name="nomeIngrediente"/>
                                    <button type="submit">
                                        <img width="24px" height="24px" src="../../../Images/edit.png"></img>
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