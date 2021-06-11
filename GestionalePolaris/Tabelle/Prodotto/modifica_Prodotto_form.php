<?php
    require 'C:/xampp/htdocs/Elaborato/GestionalePolaris/config.php';
    require 'C:/xampp/htdocs/Elaborato/GestionalePolaris/verifica_session.php';
?>

<!DOCTYPE html>
<html>
<head>
    <!-- per la selezione multipla -->
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/css/select2.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/select2.min.js"></script>
    
    <link rel="stylesheet" href="../modifica_inserimento_dati.css">
    <title>Modifica Gelato</title>
</head>
<body>


    <?php 
        function select($name, $tabella, $ID_selected){
            //ID_selected è una stringa, falla diventare un'array...
            $array_ID_selected = explode('/', $ID_selected);
            include "$GLOBALS[connessione_db]";
                
            $sql = "SELECT DISTINCT $name,ID FROM $tabella ORDER BY $name";
            $result = $conn->query($sql);
            while($row = $result->fetch_assoc()){ 
                $id = $row["ID"];
                $nome = $row["nome"];
                $flag = false;
                for($i=0; $i<count($array_ID_selected); $i++){
                    if(($array_ID_selected[$i] == $nome) && !$flag){
                        echo "<option selected class='option' name='$nome' value = '$id' > $nome </option>";
                        $flag = true;
                    } 
                }
                if (!$flag) echo "<option class='option' name='$nome' value = '$id' > $nome </option>";
            }
        }
    ?>
    
    <a class="torna_indietro" href="index.php">
        <img width="60px" height="31px" src="../../../Images/back.png"></img>
    </a>
    

    <!-- pulsante per l'inserimento di un nuovo PRODOTTO -->
    <div class="form">
        <form action="modifica_Prodotto.php" method="POST" enctype="multipart/form-data">
            <img width="100px" height="100px" src=<?php echo "$GLOBALS[domain_cartella_img_gelati]$_POST[nome].$_POST[estensione_img]"?>> </img>
            <input type="hidden" name="ID" value="<?php echo $_POST['ID']?>"/>
            <br><br>Nome:<br><input maxlength="60" type="text" name="nome" value="<?php echo $_POST['nome']?>" required/>

            <br><br>Disponibile atttualemente? 
                <input type="checkbox" value="true" name="disponibile" <?php if($_POST['disponibile']==1) echo "checked"; ?>>
                <label for="disponibile">Si</label>

            
                <br><br>Modifica l'immagine:  <input type="file" name="modifica_immagine"/>

            <!-- inserire la relazione con la tabella ingrediente -->

            <input type="hidden" name="img_vecchia" value= "<?php echo $_POST['nome'].'.'.$_POST['estensione_img']?>" />
            <input type="hidden" name="estensione_img_vecchia" value= "<?php echo $_POST['estensione_img']?>" />
            <br><br>Ingredienti:<select class="mul-select" multiple="true" name="IDIngrediente[]"> <?php select('nome', 'ingrediente', $_POST['nomeIngrediente']); ?> </select>

            <br><br>Text:<br><input class="input_text" maxlength="500" type="text" name="text" value="<?php echo $_POST['text']?>"/> <br>
            <br><br><input type="image" class="immagine" name="submit" src="../../../Images/conferma.png"  alt="Submit"/>
        </form>
    </div>


    <script>
        $(".mul-select").select2({
            placeholder: "Seleziona",
            tags: true,
            tokenSeparators: ['/',',',';'," "] 
        });
    </script>

</body>
</html>