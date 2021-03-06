<?php
    require 'C:/xampp/htdocs/Elaborato/GestionalePolaris/config.php';
    require 'C:/xampp/htdocs/Elaborato/GestionalePolaris/verifica_session.php';
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="../modifica_inserimento_dati.css">
    <title>Modifica Ingrediente</title>
</head>

<body>
    <!---------------Funzione select, visualizza le varie opzioni------------------>
    <?php 
        function select($name, $tabella, $ID_selected){
            include "$GLOBALS[connessione_db]";
                
            $sql = "SELECT DISTINCT $name,ID FROM $tabella ORDER BY $name";
            $result = $conn->query($sql);
            echo "<option></option>";
            while($row = $result->fetch_assoc()){ 
                $var = $row["ID"];

                if($ID_selected == $row["ID"]) echo "<option selected name='$row[$name]' value = '$var' > $row[$name] </option>";
                else echo "<option name='$row[$name]' value = '$var' > $row[$name] </option>";
                
                }
            }
    ?>

    <a class="torna_indietro" href="index.php">
        <img width="60px" height="31px" src="../../../Images/back.png"></img>
    </a>

    <form action="modifica_Ingrediente.php" method="POST">
        <input type="hidden" name="ID" value="<?php echo $_POST['ID']?>"/><br />
        <input maxlength="40" type="text" name="nome" value="<?php echo $_POST['nome']?>" required/> <br />
        <br><br>sigla: <input input maxlength="10" type="text" name="sigla" value="<?php echo $_POST['sigla']?>"/> <br />
        <!-- relazione -->
        <br><br>Armadio: <select name="IDAllergene"> <?php select('nome', 'allergene', $_POST['IDAllergene']); ?> </select>
        <br><br><input type="image" class="immagine" name="submit" src="../../../Images/conferma.png"  alt="Submit"/>
    </form>

</body>
</html>