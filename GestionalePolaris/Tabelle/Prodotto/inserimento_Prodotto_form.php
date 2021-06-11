<?php
    require 'C:/xampp/htdocs/Elaborato/GestionalePolaris/config.php';
    require 'C:/xampp/htdocs/Elaborato/GestionalePolaris/verifica_session.php';
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="../modifica_inserimento_dati.css">
    <title>Prodotto</title>

    <!-- per la selezione multipla -->
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/css/select2.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/select2.min.js"></script>
</head>
<body>

    <!---------------Funzione select, visualizza le varie opzioni------------------>
    <?php 
        function select($name, $tabella){
            include "$GLOBALS[connessione_db]";
            
            $sql = "SELECT DISTINCT $name,ID FROM $tabella ORDER BY $name";
            $result = $conn->query($sql);
            while($row = $result->fetch_assoc())
            {
                $var = $row["ID"];
                echo "<option class='option' name='$row[$name]' value = '$var' > $row[$name] </option>";
            }
        }
    ?>

    <a class="torna_indietro" href="index.php">
        <img width="60px" height="31px" src="../../../Images/back.png"></img>
    </a>

    <!-- pulsante per l'inserimento di un nuovo PRODOTTO -->
    
    <form action="inserimento_Prodotto.php" method="POST" enctype="multipart/form-data">
        <h3 class="titolo_sopra_tabella">INSERISCI UN NUOVO PRODOTTO</h3>    
    
        <br><br>nome Gelato: <input maxlength="60" type="text" name="nome" required/>

        <br><br>Disponibile atttualemente? 
            <input type="checkbox" value="true" name="disponibile">
            <label for="disponibile">Si</label>

        <br><br>Immagine: <input type="file" name="immagine" required/>
        <!-- inserire la relazione con la tabella ingrediente -->
        <br><br>Ingredienti: <select class="mul-select" multiple="true" name="IDIngrediente[]"> <?php select('nome', 'ingrediente'); ?> </select>
        <br><br>Text: <input class="input_text" maxlength="500" type="text" name="text"/>
        
        <br><br><input type="image" class="immagine" name="submit" src="../../../Images/conferma.png"  alt="Submit"/>
    </form>

    <script>
        $(".mul-select").select2({
            placeholder: "Seleziona",
            tags: true,
            tokenSeparators: ['/',',',';'," "] 
        });
    </script>
</body>
</html>