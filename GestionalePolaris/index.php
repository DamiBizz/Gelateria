<?php
    require 'C:/xampp/htdocs/Elaborato/GestionalePolaris/config.php';
    require 'C:/xampp/htdocs/Elaborato/GestionalePolaris/verifica_session.php';
?>

<?php
    function select($name, $tabella){
        include "$GLOBALS[connessione_db]";
        
        $sql = "SELECT DISTINCT $name FROM $tabella ORDER BY $name";
        $result = $conn->query($sql);
        while($row = $result->fetch_assoc())
        {
            $var = $row["nome"];
            if(!empty($row[$name])) echo "<option class='option' name='$row[$name]' value = '$var' > $row[$name] </option>";

        }
    }

    function select_ingrediente($name, $tabella){
        include "$GLOBALS[connessione_db]";
        
        $sql = "SELECT DISTINCT $name, sigla FROM $tabella ORDER BY $name";
        $result = $conn->query($sql);
        while($row = $result->fetch_assoc())
        {
            $var = $row["nome"];
            $output = $row["nome"];
            if(!empty($row["sigla"]))$output = $row["nome"] . " (".$row["sigla"].")";
            if(!empty($row[$name])) echo "<option class='option' name='$row[$name]' value = '$var' > $output </option>";

        }
    }
    
?>

<!DOCTYPE html>
<html>
    <!-- per la selezione multipla -->
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/css/select2.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/select2.min.js"></script>
    <link rel="stylesheet" href="intestazione.css">
    <link rel="stylesheet" href="Tabelle/modifica_inserimento_dati.css">
<head>
</head>
<body>

    <ul class="ul_up">
    <li class="li_up"><a href="Tabelle/Prodotto/index.php">Gelati</a></li>
    <li class="li_up"><a href="Tabelle/Ingrediente/index.php">Ingredienti</a></li>
    <?php
        if($_SESSION['ruolo'] == true){ ?>
            <li class="li_up"><a href="Tabelle/utente/">Gestione Account</a></li>
            <?php
        }
    ?> 
    <li class="li_up"><a href="Select/ricerca_tutto.php">Ricerca TUTTO</a></li>
    <li class="li_up" style="float:right"><a class="active" href="logout.php">Logout</a></li>
    <li class="li_up" style="float:right"><a href="Tabelle/utente/modifica_singola_password.php">Modifica Password</a></li>
    </ul>


    <br><br><br>

    <form action="Select/ricerca.php" method="POST">
        <h3 class="titolo_sopra_tabella">Cosa vuoi ricercare?</h3>
        <br>Gelato: <input maxlength="60" type="text" name="Prodotto"/>
        <br><br>Ingrediente: <input maxlength="40" type="text" name="Ingrediente"/>
        <br><br>Allergene: <input maxlength="30" type="text" name="Allergene"/>

            <br><br><input type="checkbox" value="true" name="true">
            <label for="disponibile">Disponibili</label> <br>
            <br><input type="checkbox" value="false" name="false">
            <label for="disponibile">Non Disponibili</label> <br>
        <br><br><input type="image" class="immagine" name="submit" src="Images/conferma.png"  alt="Submit"/>
    </form>

    <script>
        $(".mul-select").select2({
            placeholder: "Ricerca per",
            tags: true,
            tokenSeparators: ['/',',',';'," "] 
        });
    </script>

</body>
</html>
