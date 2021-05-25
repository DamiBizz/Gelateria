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
    <title>Loggato</title>

</head>
<body>
    <a href="logout.php"><button>LOGOUT</button></a> <br><br><br>
    <!--Link per accedere alle tabella, con la possiblità di aggiungere, modificare o eliminare ogni entry-->
    <a href="Tabelle/Prodotto/index.php"><button>PRODOTTO</button></a> <br>
    <a href="Tabelle/Ingrediente/index.php"><button>INGREDIENTE</button></a> <br>
    <a href="Tabelle/Allergene/index.php"><button>ALLERGENE</button></a> <br>

    <!---------------Funzione select, visualizza le varie opzioni------------------>
    <?php 
        function select($name, $tabella){
            include "$GLOBALS[connessione_db]";
            
            $sql = "SELECT DISTINCT $name FROM $tabella ORDER BY $name";
            $result = $conn->query($sql);
            while($row = $result->fetch_assoc())
            {
                $var = $row["nome"];
                if(!empty($row[$name])) echo "<option name='$row[$name]' value = '$var' > $row[$name] </option>";

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
                if(!empty($row[$name])) echo "<option name='$row[$name]' value = '$var' > $output </option>";

            }
        }
    ?>

    <br><br><br>
    <!-- Ricerca per vari campi fondamentali -->
    <form action="Select/ricerca.php" method="POST">
            <input type="radio" value="true" name="disponibile">
            <label for="disponibile">Dispobibile</label> <br>
            <input type="radio" value="false" name="disponibile">
            <label for="disponibile">Non disponibile</label> <br>
        <select class="mul-select" multiple="true" name="Prodotto[]"> <?php select('nome', 'prodotto'); ?> </select>Prodotto <br>
        <select class="mul-select" multiple="true" name="Ingrediente[]"> <?php select_ingrediente('nome', 'ingrediente'); ?></select>Ingrediente <br>
        <select class="mul-select" multiple="true" name="Allergene[]"> <?php select('nome', 'allergene'); ?> </select>Allergene <br>
        <input type="submit" value="Ricerca" /> 
    </form>

    <?php
        //se è un'amministratore
        if($_SESSION['ruolo'] == true){ ?>
            <br><br><br><a href="Tabelle/utente/"><button>Gestisci gli account</button></a>
    <?php
        }
    ?>

    <script>
        $(".mul-select").select2({
            placeholder: "Ricerca x",
            tags: true,
            tokenSeparators: ['/',',',';'," "] 
        });
    </script>

</body>
</html>