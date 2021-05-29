<?php
    require 'C:/xampp/htdocs/Elaborato/GestionalePolaris/config.php';
    require 'C:/xampp/htdocs/Elaborato/GestionalePolaris/verifica_session.php';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Selezione</title>
</head>

    <a href="<?php echo $GLOBALS['domain_home']?>"><button>Torna indietro</button></a>

    <?php 
        include "$GLOBALS[connessione_db]";
        echo "<table border='1'> 
                <thead>
                    <th></th>
                    <th></th>
                    <th>Nome</th>
                    <th>Ingrediente (sigla)</th>
                    <th>allergene</th>
                </thead>    

                <tbody>";

        $flag = false;           
        if(!empty($_POST['selezione_tutto1258251351344']) && $_POST['selezione_tutto1258251351344']=='true'){
            $flag = true;
        }

        if(!$flag){
            echo "errore";
            exit;
        }
        
        //se non ci sono stati roblemi
        $sql5 = "SELECT DISTINCT nome
                    FROM prodotto 
                ";
        $result5 = $conn->query($sql5);
        while($row5 = $result5->fetch_assoc()) {
            //prodotto
            $sql = "SELECT DISTINCT nome, estensione_img, disponibile
                        FROM prodotto 
                        WHERE prodotto.nome = '$row5[nome]'
                    ";

            $result = $conn->query($sql);

            while($row = $result->fetch_assoc()) { 
            echo "<tr>";
            if($row['disponibile'] == 1) echo "<td>".'<img width="20px" height="20px" src="../../Images/Verde.png"></img>'."</td>";
            if($row['disponibile'] == 0) echo "<td>".'<img width="20px" height="20px" src="../../Images/Rosso.png"></img>'."</td>";
            $supp = $GLOBALS['domain_cartella_img_gelati'].$row["nome"].".".$row["estensione_img"];
            echo "<td>".'<img width="50px" height="50px" src="'.$supp.'"></img>'."</td>";
            echo "<td>".$row['nome']."</td>";
            }

            //ingredienti
            $sql = "SELECT DISTINCT ingrediente.nome, ingrediente.sigla
                        FROM ingrediente, prodotto_ingrediente, prodotto
                        WHERE prodotto_ingrediente.IDProdotto = Prodotto.ID AND prodotto_ingrediente.IDIngrediente = Ingrediente.ID
                        AND prodotto.nome = '$row5[nome]'
                    ";

            $result = $conn->query($sql);

            echo "<td>";
            while ($row = $result->fetch_assoc()) {
            if($row['sigla']!="") $supporto = $row['nome'] . " (".$row['sigla'].")";
            else $supporto = $row['nome'];

            echo "<form action='ingrediente.php' method='POST'>
                <input type='hidden' name='nome_ingrediente' value = '$row[nome]' />
                <input type='submit' name='nome_sigla_ingrediente' title='allergene associato' value='$supporto'/>
            </form>";
            } 
            echo "</td>";


            //Allergene
            $sql = "SELECT DISTINCT allergene.nome
                        FROM allergene, ingrediente, prodotto_ingrediente, prodotto
                        WHERE prodotto_ingrediente.IDProdotto = Prodotto.ID AND prodotto_ingrediente.IDIngrediente = Ingrediente.ID
                        AND ingrediente.IDAllergene = allergene.ID
                        AND prodotto.nome = '$row5[nome]'
                    ";


            $result = $conn->query($sql);

            echo "<td>";
            while ($row = $result->fetch_assoc()) {
            echo "<form action='allergene.php' method='POST'>
            <input type='submit' name='allergene_nome' title='allergene associato' value='$row[nome]'/>
            </form>";
            } 
            echo "</td>";
            echo "<tr>";    
            }
               
        
                    
    ?>
    
        
</body>
</html>
