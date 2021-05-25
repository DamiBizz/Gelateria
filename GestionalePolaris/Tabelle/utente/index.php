<?php
    require 'C:/xampp/htdocs/Elaborato/GestionalePolaris/config.php';
    require 'C:/xampp/htdocs/Elaborato/GestionalePolaris/verifica_session.php';
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <title>Account</title>

</head>
<body>
    
    <a href="<?php echo $GLOBALS['domain_home']?>"><button>Torna indietro</button></a>

    <!-- pulsante per l'inserimento di un nuovo Allergene -->
    <h3>Inserisci un nuovo Account</h3>
    <form action="inserimento_Account.php" method="POST">
        nome<input maxlength="30" type="text" name="nome" required/>
        password<input maxlength="30" type="password" name="pwd" required/>
        conferma password<input maxlength="30" type="password" name="pwd_verifica" required/>
        Amministratore?
            <input type="checkbox" value="true" name="ruolo">
            <label for="ruolo">Si</label>
        <input type="submit" value="Conferma" />
    </form>

    <!-- stampa la tabella con la possiblità di modificare ed eliminare un singolo campo -->
    <h3>Tabella</h3>
    <table border="1">

        <tr>
            <th>nome</th>
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
                echo "<td>".$row["ruolo"]."</td>";
                echo "<td>" . '<form onsubmit="return confirm('."'Sei sicuro/a di cancellare la riga?'".');" action="../delete_row.php" method="POST">
                                    <input type="hidden" value="'.$row['ID'].'" name="ID"/>
                                    <input type="hidden" value="utente" name="tabella"/>
                                    <button type="submit">
                                        <img width="24px" height="24px" src="../../../Images/delete.png"></img>
                                    </button>
                                </form>' . "</td>";
                echo "<td>" . '<form action="modifica_Account_form.php" method="POST">
                                    <input type="hidden" value="'.$row['ID'].'" name="ID"/>
                                    <input type="hidden" value="'.$row['nome'].'" name="nome"/>
                                    <input type="hidden" value="'.$row['ruolo'].'" name="ruolo"/>
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