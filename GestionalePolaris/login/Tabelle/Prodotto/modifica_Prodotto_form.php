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
    <form action="modifica_Prodotto.php" method="POST" enctype="multipart/form-data">
        <img width="40px" height="40px" src=<?php echo "'../../../../Cliente/immagini/$_POST[nome].$_POST[estensione_img]'"?>> </img>
        <input type="hidden" name="ID" value="<?php echo $_POST['ID']?>"/><br />
        nome Prodotto<input maxlength="60" type="text" name="nome" value="<?php echo $_POST['nome']?>" required/><br />

        Disponibile atttualemente? 
            <input type="checkbox" value="true" name="disponibile" <?php if($_POST['disponibile']==1) echo "checked"; ?>>
            <label for="disponibile">Si</label>

        
        new image<input type="file" name="modifica_immagine"/>

        <!-- inserire la relazione con la tabella ingrediente -->

        <input type="hidden" name="img_vecchia" value= "<?php echo $_POST['nome'].'.'.$_POST['estensione_img']?>" />
        <input type="hidden" name="estensione_img_vecchia" value= "<?php echo $_POST['estensione_img']?>" />
        
        Ingredienti: <select class="mul-select" multiple="true" name="IDIngrediente[]"> <?php select('nome', 'ingrediente', $_POST['nomeIngrediente']); ?> </select>

        Text: <input maxlength="500" type="text" name="text" value="<?php echo $_POST['text']?>"/> <br>
        <input type="submit" value="Conferma" />
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