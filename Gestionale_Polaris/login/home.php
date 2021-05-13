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
    <!--Link per accedere alle tabella, con la possiblità di aggiungere, modificare o eliminare ogni entry-->
    <a href="Tabelle/Prodotto/index.php"><button>PRODOTTO</button></a> <br>
    <a href="Tabelle/Ingrediente/index.php"><button>INGREDIENTE</button></a> <br>
    <a href="Tabelle/Allergene/index.php"><button>ALLERGENE</button></a> <br>

    


    <!---------------Funzione select, visualizza le varie opzioni------------------>
    <?php 
        function select($name, $tabella){
            include '../connessione_db.php';
            
            $sql = "SELECT DISTINCT $name,ID FROM $tabella ORDER BY $name";
            $result = $conn->query($sql);
            echo "<option></option>";
            while($row = $result->fetch_assoc())
            {
                $var = $row["ID"];
                if(!empty($row[$name])) echo "<option name='$row[$name]' value = '$var' > $row[$name] </option>";

            }
        }
    ?>



    <!-- Ricerca per vari campi fondamentali -->
    
    <!-- allergene -> tt -->
    <!-- nome Ingrediente -> tt -->
    <!-- sigla Ingrediente -> tt -->
    <!-- Prodotto -> tt -->
    <form action="ricerca_tt.php" method="POST">
        Allergene<select class="mul-select" multiple="true" name="IDIngrediente[]"> <?php select('nome', 'allergene'); ?> </select>
        Nome ingrediente<select class="mul-select" multiple="true" name="IDIngrediente[]"> <?php select('nome', 'ingrediente'); ?> </select>
        Sigla ingrediente<select class="mul-select" multiple="true" name="IDIngrediente[]"> <?php select('sigla', 'ingrediente'); ?> </select>
        Prodotto<select class="mul-select" multiple="true" name="IDProdotto[]"> <?php select('nome', 'prodotto'); ?> </select>
        <input type="submit" value="Conferma" />
    </form>

    <script>
        $(".mul-select").select2({
            placeholder: "Seleziona Ingredienti",
            tags: true,
            tokenSeparators: ['/',',',';'," "] 
        });
    </script>

</body>
</html>