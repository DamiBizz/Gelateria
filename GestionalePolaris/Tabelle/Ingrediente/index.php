<?php
    require 'C:/xampp/htdocs/Elaborato/GestionalePolaris/config.php';
    require 'C:/xampp/htdocs/Elaborato/GestionalePolaris/verifica_session.php';
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">    
    <link rel="stylesheet" href="../tabelle.css">
    
    <title>Ingrediente</title>
</head>
<body>

    
    
    <a class="torna_indietro" href="<?php echo $GLOBALS['domain_home']?>">
        <img width="60px" height="31px" src="../../../Images/back.png"></img>
    </a>

    <div class="text-center">
        <a href="inserimento_Ingrediente_form.php" value="Inseriesci un nuovo prodotto">
            <img width="60px" height="60px" src="../../../Images/add_file.jpg"></img>
        </a>
    </div>
    

    <!-- stampa la tabella con la possiblità di modificare ed eliminare un singolo campo -->
    <h3 class="titolo_sopra_tabella">INGREDIENTI</h3>
    <table id="tabelle">

        <tr>
            <th>nome</th>
            <th>sigla</th>
            <th>Allergene</th>
            <th></th>
            <th></th>
        </tr>

        <?php
            include "$GLOBALS[connessione_db]";

            $sql = "SELECT * FROM ingrediente order by nome";
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
                                    <input type="image" name="submit" src="../../../Images/delete.png" border="0" width="45px" height="45px" alt="Submit"/>

                                </form>' . "</td>";
                echo "<td>" . '<form action="modifica_Ingrediente_form.php" method="POST">
                                    <input type="hidden" value="'.$row['ID'].'" name="ID"/>
                                    <input type="hidden" value="'.$row['nome'].'" name="nome"/>
                                    <input type="hidden" value="'.$row['sigla'].'" name="sigla"/>
                                    <input type="hidden" value="'.$row['IDAllergene'].'" name="IDAllergene"/>
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