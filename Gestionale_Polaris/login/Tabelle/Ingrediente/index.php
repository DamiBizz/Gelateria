<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">    
    <title>Ingrediente</title>
</head>
<body>

    <!---------------Funzione select, visualizza le varie opzioni------------------>
    <?php 
        function select($name, $tabella){
            include '../../../connessione_db.php';
                
            $sql = "SELECT DISTINCT $name,ID FROM $tabella ORDER BY $name";
            $result = $conn->query($sql);
            echo "<option></option>";
            while($row = $result->fetch_assoc()){ 
                $var = $row["ID"];
                    echo "<option name='$row[$name]' value = '$var' > $row[$name] </option>";
                }
            }
    ?>
    
    <a href="../../home.php"><button>Torna indietro</button></a>

    <!-- pulsante per l'inserimento di un nuovo Ingrediente -->
    <h3>Inserisci un nuovo Ingrediente</h3>
    <form action="inserimento_Ingrediente.php" method="POST">
        nome Ingrediente<input maxlength="40" type="text" name="nome" required/>
        sigla<input input maxlength="10" type="text" name="sigla"/>
        
        <!-- relazione -->
        Allergene: <select name="IDAllergene"> <?php select('nome', 'allergene'); ?> </select>
        <input type="submit" value="Conferma" />
    </form>

    <!-- stampa la tabella con la possiblità di modificare ed eliminare un singolo campo -->
    <h3>Tabella</h3>
    <table border="1">

        <tr>
            <th>nome</th>
            <th>sigla</th>
            <th>IDAllergene</th>
            <th></th>
            <th></th>
        </tr>

        <?php
            include '../../../connessione_db.php';

            $sql = "SELECT * FROM ingrediente";
            $result = $conn->query($sql);

            while ($row=$result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>".$row["nome"]."</td>";
                echo "<td>".$row["sigla"]."</td>";
                
                //---------------------------------Scrivere il nome dell'allergene non il numero--------------------------------------
                $supp = $row["IDAllergene"];
                $sql3="SELECT DISTINCT nome FROM allergene WHERE ID=$supp";
                $stmt3 = $conn->prepare($sql3);
                $stmt3->execute();
                $result3 = $stmt3->get_result();
                $row3 = $result3->fetch_assoc();
                if(!empty($row3['nome'])) echo "<td>".$row3['nome']."</td>";
                else echo "<td>"."</td>";
                
                

                echo "<td>" . '<form onsubmit="return confirm('."'Sei sicuro/a di cancellare la riga?'".');" action="../delete_row.php" method="POST">
                                    <input type="hidden" value="'.$row['ID'].'" name="ID"/>
                                    <input type="hidden" value="ingrediente" name="tabella"/>
                                    <button type="submit">
                                        <img width="24px" height="24px" src="../images/delete.png"></img>
                                    </button>
                                </form>' . "</td>";
                echo "<td>" . '<form action="modifica_Ingrediente_form.php" method="POST">
                                    <input type="hidden" value="'.$row['ID'].'" name="ID"/>
                                    <input type="hidden" value="'.$row['nome'].'" name="nome"/>
                                    <input type="hidden" value="'.$row['sigla'].'" name="sigla"/>
                                    <input type="hidden" value="'.$row['IDAllergene'].'" name="IDAllergene"/>
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