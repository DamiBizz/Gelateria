<!DOCTYPE html>
<html>
<head>
    <title>Selezione</title>
</head>

    <a href="../home.php"><button>Torna indietro</button></a>

    <?php 
        include "../../connessione_db.php";
        echo "<table border='1'> 
                <thead>
                    <th></th>
                    <th></th>
                    <th>Nome</th>
                    <th>Ingrediente (sigla)</th>
                    <th>allergene</th>
                </thead>    

                <tbody>";

                    
        //----------------------------------ATTRIBUTI--------------------------------------------------------
        //nome Prodotto
        $n_prodotto = 1;
        $stringa_nome_prodotto = "";
        if(!empty($_POST['Prodotto'])){
            $n_prodotto = count($_POST['Prodotto']);
            $prodotto = $_POST['Prodotto'];    
        }
        
        //nome ingrediente
        $stringa_nome_ingrediente = "";
        if(!empty($_POST['Ingrediente'])){
            $n_ingrediente = count($_POST['Ingrediente']);
            $ingrediente = $_POST['Ingrediente'];
            for($i = 0; $i<$n_ingrediente; $i++){
                if(empty($stringa_nome_ingrediente)) $stringa_nome_ingrediente .= " AND '$ingrediente[$i]' = ingrediente.nome";
                else $stringa_nome_ingrediente .= " OR '$ingrediente[$i]' = ingrediente.nome";
            }    
        }

        //nome allergene
        $stringa_nome_allergene = "";
        if(!empty($_POST['Allergene'])){
            $n_allergene = count($_POST['Allergene']);
            $allergene = $_POST['Allergene'];
            for($i = 0; $i<$n_allergene; $i++){
                if(empty($stringa_nome_allergene)) $stringa_nome_allergene .= " AND '$allergene[$i]' = allergene.nome";
                else $stringa_nome_allergene .= " OR '$allergene[$i]' = allergene.nome";
            }    
        }

        $disp = "";
        if(!empty($_POST['disponibile'])){
            if($_POST['disponibile'] == "true") $disp= " AND disponibile = 1";
            else if($_POST['disponibile'] == "false") $disp= " AND disponibile = 0";
        }
        
        
        //se il nome è selezionato
        if (!empty($_POST['Prodotto'])){
            for($i = 0; $i<$n_prodotto; $i++){

                $nome = $prodotto[$i];
                        
                //prodotto
                $sql = "SELECT DISTINCT nome, estensione_img, disponibile
                            FROM prodotto
                            WHERE nome = '$nome'".$disp;
    
                $result = $conn->query($sql);
    
                while($row = $result->fetch_assoc()) { 
                    echo "<tr>";
                    if($row['disponibile'] == 1) echo "<td>".'<img width="20px" height="20px" src="../../Images/Verde.png"></img>'."</td>";
                    if($row['disponibile'] == 0) echo "<td>".'<img width="20px" height="20px" src="../../Images/Rosso.png"></img>'."</td>";
                    echo "<td>".'<img width="40px" height="40px" src="../../Immagini_Gelati/'.$row["nome"].'.'.$row["estensione_img"].'"></img>'."</td>";
                    echo "<td>".$row['nome']."</td>";
                }
            
                //ingredienti
                $sql = "SELECT DISTINCT ingrediente.nome, ingrediente.sigla
                            FROM ingrediente, prodotto_ingrediente, prodotto
                            WHERE prodotto_ingrediente.IDProdotto = Prodotto.ID AND prodotto_ingrediente.IDIngrediente = Ingrediente.ID
                            AND Prodotto.nome = '$nome'".$disp.$stringa_nome_ingrediente;
                
    
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
                            AND Prodotto.nome = '$nome'".$disp.$stringa_nome_allergene;
                
    
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
        }


        //se il nome non è selezionato
        if (empty($_POST['Prodotto'])){

                $Array_prodotto = NULL;
                $counter = 0;

                if($disp == "" && $stringa_nome_ingrediente == "" && $stringa_nome_allergene == ""){
                    ?><script> alert("Seleziona qualcosa!!!"); </script><?php
                    die();
                }
                else if($disp == "" && $stringa_nome_ingrediente == "" && $stringa_nome_allergene != ""){
                    $sql = "SELECT DISTINCT prodotto.nome
                            FROM prodotto, ingrediente, allergene, prodotto_ingrediente
                            WHERE prodotto_ingrediente.IDProdotto = Prodotto.ID AND prodotto_ingrediente.IDIngrediente = Ingrediente.ID
                            AND ingrediente.IDAllergene = allergene.ID".$stringa_nome_allergene;
                }
                else if($disp == "" && $stringa_nome_ingrediente != "" && $stringa_nome_allergene == ""){
                    $sql = "SELECT DISTINCT prodotto.nome
                            FROM prodotto, ingrediente, allergene, prodotto_ingrediente
                            WHERE prodotto_ingrediente.IDProdotto = Prodotto.ID AND prodotto_ingrediente.IDIngrediente = Ingrediente.ID
                            ".$stringa_nome_ingrediente;
                }
                else if($disp == "" && $stringa_nome_ingrediente != "" && $stringa_nome_allergene != ""){
                    $sql = "SELECT DISTINCT prodotto.nome
                            FROM prodotto, ingrediente, allergene, prodotto_ingrediente
                            WHERE prodotto_ingrediente.IDProdotto = Prodotto.ID AND prodotto_ingrediente.IDIngrediente = Ingrediente.ID
                            AND ingrediente.IDAllergene = allergene.ID".$stringa_nome_ingrediente.$stringa_nome_allergene;
                }
                else if($disp != "" && $stringa_nome_ingrediente == "" && $stringa_nome_allergene == ""){
                    $sql = "SELECT DISTINCT prodotto.nome
                            FROM prodotto, ingrediente, allergene, prodotto_ingrediente
                            WHERE 1=1".$disp;
                }
                else if($disp != "" && $stringa_nome_ingrediente == "" && $stringa_nome_allergene != ""){
                    $sql = "SELECT DISTINCT prodotto.nome
                            FROM prodotto, ingrediente, allergene, prodotto_ingrediente
                            WHERE prodotto_ingrediente.IDProdotto = Prodotto.ID AND prodotto_ingrediente.IDIngrediente = Ingrediente.ID
                            AND ingrediente.IDAllergene = allergene.ID".$disp.$stringa_nome_allergene;
                }
                else if($disp != "" && $stringa_nome_ingrediente != "" && $stringa_nome_allergene == ""){
                    $sql = "SELECT DISTINCT prodotto.nome
                            FROM prodotto, ingrediente, allergene, prodotto_ingrediente
                            WHERE prodotto_ingrediente.IDProdotto = Prodotto.ID AND prodotto_ingrediente.IDIngrediente = Ingrediente.ID
                            ".$disp.$stringa_nome_ingrediente;
                }
                else if($disp != "" && $stringa_nome_ingrediente != "" && $stringa_nome_allergene != ""){
                    $sql = "SELECT DISTINCT prodotto.nome
                            FROM prodotto, ingrediente, allergene, prodotto_ingrediente
                            WHERE prodotto_ingrediente.IDProdotto = Prodotto.ID AND prodotto_ingrediente.IDIngrediente = Ingrediente.ID
                            AND ingrediente.IDAllergene = allergene.ID".$disp.$stringa_nome_ingrediente.$stringa_nome_allergene;
                }

                $result = $conn->query($sql);

                echo $sql;

                while($row = $result->fetch_assoc()) { 
                    $Array_prodotto[$counter] = $row['nome'];
                    $counter++;

                }

                for($i=0; $i<$counter; $i++){

                    $nome = $Array_prodotto[$i];
                    
                    //prodotto
                    $sql = "SELECT DISTINCT nome, estensione_img, disponibile
                            FROM prodotto
                            WHERE prodotto.nome = '$nome'";

                    $result = $conn->query($sql);

                    while($row = $result->fetch_assoc()) { 
                        echo "<tr>";
                            if($row['disponibile'] == 1) echo "<td>".'<img width="20px" height="20px" src="../../Images/Verde.png"></img>'."</td>";
                            if($row['disponibile'] == 0) echo "<td>".'<img width="20px" height="20px" src="../../Images/Rosso.png"></img>'."</td>";
                            echo "<td>".'<img width="40px" height="40px" src="../../Immagini_Gelati/'.$row["nome"].'.'.$row["estensione_img"].'"></img>'."</td>";
                            echo "<td>".$row['nome']."</td>";
                    }

                    //ingredienti
                    $sql = "SELECT DISTINCT ingrediente.nome, ingrediente.sigla
                    FROM ingrediente, prodotto_ingrediente, prodotto
                    WHERE prodotto_ingrediente.IDProdotto = Prodotto.ID AND prodotto_ingrediente.IDIngrediente = Ingrediente.ID
                    AND Prodotto.nome = '$nome'".$disp.$stringa_nome_ingrediente;
        

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
                                AND Prodotto.nome = '$nome'".$disp.$stringa_nome_allergene;
                    

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


        }

        echo "</tbody>";
                    
    ?>
    
        
</body>
</html>
