<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <!-- per la selezione multipla -->
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/css/select2.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/select2.min.js"></script>
    <title>Modifica Prodotto</title>
</head>
<body>


    <?php 
        function select($name, $tabella, $ID_selected){
            //ID_selected è una stringa, falla diventare un'array...
            $array_ID_selected = explode('/', $ID_selected);
            include '../../../connessione_db.php';
                
            $sql = "SELECT DISTINCT $name,ID FROM $tabella ORDER BY $name";
            $result = $conn->query($sql);
            while($row = $result->fetch_assoc()){ 
                $id = $row["ID"];
                $nome = $row["nome"];
                $flag = false;
                for($i=0; $i<count($array_ID_selected); $i++){
                    if(($array_ID_selected[$i] == $nome) && !$flag){
                        echo "<option selected name='$nome' value = '$id' > $nome </option>";
                        $flag = true;
                    } 
                }
                if (!$flag) echo "<option name='$nome' value = '$id' > $nome </option>";
            }
        }
    ?>
    
    <a href="index.php"><button>Torna indietro</button></a>
    

    <!-- pulsante per l'inserimento di un nuovo PRODOTTO -->
    <h3>Inserisci un nuovo Prodotto</h3>
    <form action="modifica_Prodotto.php" method="POST">
        <input type="hidden" name="ID" value="<?php echo $_POST['ID']?>"/><br />
        nome Prodotto<input maxlength="60" type="text" name="nome" value="<?php echo $_POST['nome']?>" required/><br />
        qunatità disponibile<input type="number" min="0" max="999" name="quantitaDisponibile" value="<?php echo $_POST['quantitaDisponibile']?>" required/> <br />
        <!-- inserire la relazione con la tabella ingrediente -->
        
        Ingredienti: <select class="mul-select" multiple="true" name="IDIngrediente[]"> <?php select('nome', 'ingrediente', $_POST['nomeIngrediente']); ?> </select>
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