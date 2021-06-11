<?php
    require 'C:/xampp/htdocs/Elaborato/GestionalePolaris/config.php';
    require 'C:/xampp/htdocs/Elaborato/GestionalePolaris/verifica_session.php';
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="../modifica_inserimento_dati.css">
    <title>Ingrediente</title>
</head>
<body>
    <!---------------Funzione select, visualizza le varie opzioni------------------>
    <?php 
        function select($name, $tabella){
            include "$GLOBALS[connessione_db]";
                
            $sql = "SELECT DISTINCT $name,ID FROM $tabella ORDER BY $name";
            $result = $conn->query($sql);
            echo "<option></option>";
            while($row = $result->fetch_assoc()){ 
                $var = $row["ID"];
                    echo "<option name='$row[$name]' value = '$var' > $row[$name] </option>";
                }
            }
    ?>

    <a class="torna_indietro" href="index.php">
        <img width="60px" height="31px" src="../../../Images/back.png"></img>
    </a>

    <form action="inserimento_Ingrediente.php" method="POST">
        <h3 class="titolo_sopra_tabella">INSERISCI UN NUOVO INGREDIENTE</h3>
        <br><br>Nome Ingrediente: <input maxlength="40" type="text" name="nome" required/>
        <br><br>Sigla: <input input maxlength="10" type="text" name="sigla"/>
        
        <!-- relazione -->
        <br><br>Allergene: <select name="IDAllergene"> <?php select('nome', 'allergene'); ?> </select>
        <br><br><input type="image" class="immagine" name="submit" src="../../../Images/conferma.png"  alt="Submit"/>
    </form>
</body>
</html>