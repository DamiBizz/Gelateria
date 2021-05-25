<?php
    require 'C:/xampp/htdocs/Elaborato/GestionalePolaris/config.php';
    require 'C:/xampp/htdocs/Elaborato/GestionalePolaris/verifica_session.php';
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
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

    <a href="index.php"><button>Torna indietro</button></a>

    <form action="modifica_Ingrediente.php" method="POST">
        <input type="hidden" name="ID" value="<?php echo $_POST['ID']?>"/><br />
        nome Ingrediente<input maxlength="40" type="text" name="nome" value="<?php echo $_POST['nome']?>" required/> <br />
        sigla<input input maxlength="10" type="text" name="sigla" value="<?php echo $_POST['sigla']?>"/> <br />
        <!-- relazione -->
        <?php echo "qui -->" .$_POST['IDAllergene']?>
        Armadio: <select name="IDAllergene"> <?php select('nome', 'allergene', $_POST['IDAllergene']); ?> </select>
        <input type="submit" value="Conferma" />
    </form>

</body>
</html>