<?php
    require 'C:/xampp/htdocs/Elaborato/GestionalePolaris/config.php';
    require 'C:/xampp/htdocs/Elaborato/GestionalePolaris/verifica_session.php';

    if (!$_SESSION['ruolo']){
        header("Location: $GLOBALS[domain_login]");
        exit;
    }
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="../tabelle.css">
    
    <title>Account</title>

</head>
<body>
    
    <a class="torna_indietro" href="<?php echo $GLOBALS['domain_home']?>">
        <img width="60px" height="31px" src="../../../Images/back.png"></img>
    </a>

    <div class="text-center">
        <a href="inserimento_utente_form.php" value="Inseriesci un nuovo prodotto">
            <img width="60px" height="60px" src="../../../Images/add_file.jpg"></img>
        </a>
    </div>

    <!-- stampa la tabella con la possiblità di modificare ed eliminare un singolo campo -->
    <h3 class="titolo_sopra_tabella">ACCOUNT</h3>
    <table id="tabelle">

        <tr>
            <th>Username</th>
            <th>ruolo</th>
            <th></th>
            <th></th>
        </tr>

        <?php
            include "$GLOBALS[connessione_db]";

            $sql = "SELECT * FROM utente";

            $result = $conn->query($sql);

            while ($row=$result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>".$row["nome"]."</td>";
                if($row['ruolo'] == 1) echo "<td>".'<img width="20px" height="20px" src="../../../Images/Verde.png"></img>'."</td>";
                if($row['ruolo'] == 0) echo "<td>".'<img width="20px" height="20px" src="../../../Images/Rosso.png"></img>'."</td>";
                echo "<td>" . '<form onsubmit="return confirm('."'Sei sicuro/a di cancellare la riga?'".');" action="../delete_row.php" method="POST">
                                    <input type="hidden" value="'.$row['ID'].'" name="ID"/>
                                    <input type="hidden" value="utente" name="tabella"/>
                                    <input type="image" name="submit" src="../../../Images/delete.png" border="0" width="45px" height="45px" alt="Submit"/>

                                </form>' . "</td>";
                echo "<td>" . '<form action="modifica_Account_form.php" method="POST">
                                    <input type="hidden" value="'.$row['ID'].'" name="ID"/>
                                    <input type="hidden" value="'.$row['nome'].'" name="nome"/>
                                    <input type="hidden" value="'.$row['ruolo'].'" name="ruolo"/>
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