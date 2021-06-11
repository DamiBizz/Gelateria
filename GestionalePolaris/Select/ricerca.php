<?php
    require 'C:/xampp/htdocs/Elaborato/GestionalePolaris/config.php';
    require 'C:/xampp/htdocs/Elaborato/GestionalePolaris/verifica_session.php';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Selezione</title>
    <link rel="stylesheet" href="../Tabelle/tabelle.css">
</head>

    <a class="torna_indietro" href="<?php echo $GLOBALS['domain_home']?>">
        <img width="60px" height="31px" src="../../../Images/back.png"></img>
    </a>

    

    <?php 
        include "$GLOBALS[connessione_db]";

        echo '<table id="tabelle">
                <thead>
                    <th></th>
                    <th></th>
                    <th>Nome</th>
                    <th>Ingrediente (sigla)</th>
                    <th>allergene</th>
                </thead>    

                <tbody> ';

                    
        //----------------------------------ATTRIBUTI--------------------------------------------------------
        //nome Prodotto
        if(!empty($_POST['Prodotto'])){
            $prodotto = $_POST['Prodotto'];    
        }
        
        //nome ingrediente
        $stringa_nome_ingrediente = "";
        if(!empty($_POST['Ingrediente'])){
            $ingrediente = $_POST['Ingrediente'];
            $stringa_nome_ingrediente = " AND '$ingrediente' = ingrediente.nome";
        }

        //nome allergene
        $stringa_nome_allergene = "";
        if(!empty($_POST['Allergene'])){
            $allergene = $_POST['Allergene'];
            $stringa_nome_allergene = " AND '$allergene' = allergene.nome";
        }

        //disponibile o meno
        $disp = "";
        if(!empty($_POST['true']) && empty($_POST['false'])) $disp= " AND disponibile = 1";
        if(empty($_POST['true']) && !empty($_POST['false'])) $disp= " AND disponibile = 0";
        

        //-----------------------------------------CONDIZIONII-------------------------------------
        if(empty($prodotto) && empty($ingrediente) && empty($allergene) && empty($_POST['true']) && empty($_POST['false'])){ //errore
            echo "seleziona qualcosa";
        }

        //se il nome è selezionato
        else if (!empty($_POST['Prodotto'])){

                $nome = $prodotto;

                if(!empty($prodotto) && empty($ingrediente) && empty($allergene)){
                    $sql = "SELECT DISTINCT prodotto.nome, prodotto.estensione_img, prodotto.disponibile
                        FROM ingrediente, prodotto_ingrediente, prodotto, allergene
                        WHERE prodotto.nome = '$nome'".$disp;
                }
                if(!empty($prodotto) && !empty($ingrediente) && empty($allergene)){
                    $sql = "SELECT DISTINCT prodotto.nome, prodotto.estensione_img, prodotto.disponibile
                        FROM ingrediente, prodotto_ingrediente, prodotto, allergene
                        WHERE prodotto_ingrediente.IDProdotto = Prodotto.ID AND prodotto_ingrediente.IDIngrediente = Ingrediente.ID
                        AND prodotto.nome = '$nome'".$disp.$stringa_nome_ingrediente;
                }
                if(!empty($prodotto) && !empty($ingrediente) && !empty($allergene)){
                    $sql = "SELECT DISTINCT prodotto.nome, prodotto.estensione_img, prodotto.disponibile
                        FROM ingrediente, prodotto_ingrediente, prodotto, allergene
                        WHERE prodotto_ingrediente.IDProdotto = Prodotto.ID AND prodotto_ingrediente.IDIngrediente = Ingrediente.ID
                        AND allergene.ID IN (SELECT allergene.ID FROM allergene, ingrediente WHERE ingrediente.IDAllergene = allergene.ID $stringa_nome_allergene)
                        AND prodotto.nome = '$nome'".$disp.$stringa_nome_ingrediente;
                }
                if(!empty($prodotto) && empty($ingrediente) && !empty($allergene)){
                    $sql = "SELECT DISTINCT prodotto.nome, prodotto.estensione_img, prodotto.disponibile
                        FROM ingrediente, prodotto_ingrediente, prodotto, allergene
                        WHERE prodotto_ingrediente.IDProdotto = Prodotto.ID AND prodotto_ingrediente.IDIngrediente = Ingrediente.ID
                        AND ingrediente.IDAllergene = allergene.ID
                        AND prodotto.nome = '$nome'".$disp.$stringa_nome_ingrediente.$stringa_nome_allergene;
                }

                $flag = false;

                $result = $conn->query($sql);
    
                while($row = $result->fetch_assoc()) { 
                    echo "<tr>";
                    if($row['disponibile'] == 1) echo "<td>".'<img width="20px" height="20px" src="../../Images/Verde.png"></img>'."</td>";
                    if($row['disponibile'] == 0) echo "<td>".'<img width="20px" height="20px" src="../../Images/Rosso.png"></img>'."</td>";
                    $supp = $GLOBALS['domain_cartella_img_gelati'].$row["nome"].".".$row["estensione_img"];
                    echo "<td>".'<img width="50px" height="50px" src="'.$supp.'"></img>'."</td>";
                    echo "<td>".$row['nome']."</td>";
                    $flag=true;
                }

                if(!$flag){
                    echo "Nessun gelato trovato!!";
                    exit;
                }
            
                //ingredienti
                $sql = "SELECT DISTINCT ingrediente.nome, ingrediente.sigla
                            FROM ingrediente, prodotto_ingrediente, prodotto
                            WHERE prodotto_ingrediente.IDProdotto = Prodotto.ID AND prodotto_ingrediente.IDIngrediente = Ingrediente.ID
                            AND Prodotto.nome = '$nome'";
                
    
                $result = $conn->query($sql);
    
                echo "<td>";
                while ($row = $result->fetch_assoc()) {
                    if($row['sigla']!="") $supporto = $row['nome'] . " (".$row['sigla'].")";
                    else $supporto = $row['nome'];
    
                    echo $supporto."<br>";
                } 
                echo "</td>";
    
    
                //Allergene
                $sql = "SELECT DISTINCT allergene.nome
                            FROM allergene, ingrediente, prodotto_ingrediente, prodotto
                            WHERE prodotto_ingrediente.IDProdotto = Prodotto.ID AND prodotto_ingrediente.IDIngrediente = Ingrediente.ID
                            AND ingrediente.IDAllergene = allergene.ID
                            AND Prodotto.nome = '$nome'";
                
    
                $result = $conn->query($sql);
    
                echo "<td>";
                while ($row = $result->fetch_assoc()) {
                    echo $row['nome']."<br>";
                } 
                echo "</td>";
                echo "<tr>";
        }

        //se selezionato è solo disp
        else if (empty($_POST['Prodotto']) && empty($ingrediente) && empty($allergene) && !empty($disp)){
            
            $sql5 = "SELECT DISTINCT nome
                        FROM prodotto 
                        WHERE 1=1" .$disp;
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

                echo $supporto."<br>";

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
                    echo $row['nome']."<br>";
                }
                echo "</td>";
                echo "<tr>";    
            }
        }
        
        //gli altri casi
        else if (empty($_POST['Prodotto'])){

            if(empty($prodotto) && empty($ingrediente) && !empty($allergene)){ //OK
                $sql = "SELECT DISTINCT prodotto.nome
                    FROM ingrediente, prodotto_ingrediente, prodotto, allergene
                    WHERE prodotto_ingrediente.IDProdotto = Prodotto.ID AND prodotto_ingrediente.IDIngrediente = Ingrediente.ID
                    AND ingrediente.IDAllergene = allergene.ID"
                    .$disp.$stringa_nome_ingrediente.$stringa_nome_allergene;

                $Array_prodotto = NULL;
                $counter = 0;
                $result = $conn->query($sql);
                while($row = $result->fetch_assoc()) { 
                    $Array_prodotto[$counter] = $row['nome'];
                    $counter++;
                }
            }

            else if(empty($prodotto) && !empty($ingrediente) && empty($allergene)){ //OK
                $sql = "SELECT DISTINCT prodotto.nome
                    FROM ingrediente, prodotto_ingrediente, prodotto, allergene
                    WHERE prodotto_ingrediente.IDProdotto = Prodotto.ID AND prodotto_ingrediente.IDIngrediente = Ingrediente.ID"
                    .$disp.$stringa_nome_ingrediente.$stringa_nome_allergene;

                $Array_prodotto = NULL;
                $counter = 0;
                $result = $conn->query($sql);
                while($row = $result->fetch_assoc()) { 
                    $Array_prodotto[$counter] = $row['nome'];
                    $counter++;
                }
            }
            
            else if(empty($prodotto) && !empty($ingrediente) && !empty($allergene)){ //NO
                $sql = "SELECT DISTINCT prodotto.nome
                    FROM ingrediente, prodotto_ingrediente, prodotto, allergene
                    WHERE prodotto_ingrediente.IDProdotto = Prodotto.ID AND prodotto_ingrediente.IDIngrediente = Ingrediente.ID"
                    .$disp.$stringa_nome_ingrediente;
                
                    //trovo i nome degli ingredienti
                    $Array_prodotto_prima = NULL;
                    $counter_prima = 0;
                    $result = $conn->query($sql);
                    while($row = $result->fetch_assoc()) { 
                        $Array_prodotto_prima[$counter_prima] = $row['nome'];
                        $counter_prima++;
                    }

                    

                    for($i=0; $i<$counter_prima; $i++){

                        $nome = $Array_prodotto_prima[$i];
                        $flag = false;

                        $sql = "SELECT DISTINCT prodotto.nome
                            FROM ingrediente, prodotto_ingrediente, prodotto, allergene
                            WHERE prodotto_ingrediente.IDProdotto = Prodotto.ID AND prodotto_ingrediente.IDIngrediente = Ingrediente.ID
                            AND ingrediente.IDAllergene = allergene.ID
                            AND Prodotto.nome = '$nome'"
                            .$stringa_nome_allergene;
                        
                            $Array_prodotto = NULL;
                            $counter = 0;
                            $result = $conn->query($sql);
                            while($row = $result->fetch_assoc()) { 
                                $Array_prodotto[$counter] = $row['nome'];
                                $counter++;
                            }

                            /*for($i=0; $i<$counter; $i++){
                                echo "$i --> $Array_prodotto[$i]";
                            }*/
                    }
            }

            
                //--------------------------------------------------------------------------------------------------------------------------------

                for($i=0; $i<$counter; $i++){

                    $nome = $Array_prodotto[$i];
                    $flag = false;

                    //opzioni
                    if(empty($prodotto) && empty($ingrediente) && !empty($allergene)){
                        $sql = "SELECT DISTINCT prodotto.nome, prodotto.estensione_img, prodotto.disponibile
                            FROM ingrediente, prodotto_ingrediente, prodotto, allergene
                            WHERE ingrediente.IDAllergene = allergene.ID
                            AND Prodotto.nome = '$nome'"
                            .$disp.$stringa_nome_ingrediente.$stringa_nome_allergene;
                    }
                    else if(empty($prodotto) && !empty($ingrediente) && empty($allergene)){
                        $sql = "SELECT DISTINCT prodotto.nome, prodotto.estensione_img, prodotto.disponibile
                            FROM ingrediente, prodotto_ingrediente, prodotto, allergene
                            WHERE prodotto_ingrediente.IDProdotto = Prodotto.ID AND prodotto_ingrediente.IDIngrediente = Ingrediente.ID
                            AND Prodotto.nome = '$nome'"
                            .$disp.$stringa_nome_ingrediente.$stringa_nome_allergene;
                    }
                    else if(empty($prodotto) && !empty($ingrediente) && !empty($allergene)){
                        $sql = "SELECT DISTINCT prodotto.nome, prodotto.estensione_img, prodotto.disponibile
                            FROM ingrediente, prodotto_ingrediente, prodotto, allergene
                            WHERE prodotto_ingrediente.IDProdotto = Prodotto.ID AND prodotto_ingrediente.IDIngrediente = Ingrediente.ID
                            AND allergene.ID IN (SELECT allergene.ID FROM allergene, ingrediente WHERE ingrediente.IDAllergene = allergene.ID $stringa_nome_allergene)
                            AND prodotto.nome = '$nome'".$disp.$stringa_nome_ingrediente;
                    }
                    

                    $result = $conn->query($sql);
        
                    while($row = $result->fetch_assoc()) { 
                        echo "<tr>";
                        if($row['disponibile'] == 1) echo "<td>".'<img width="20px" height="20px" src="../../Images/Verde.png"></img>'."</td>";
                        if($row['disponibile'] == 0) echo "<td>".'<img width="20px" height="20px" src="../../Images/Rosso.png"></img>'."</td>";
                        $supp = $GLOBALS['domain_cartella_img_gelati'].$row["nome"].".".$row["estensione_img"];
                        echo "<td>".'<img width="50px" height="50px" src="'.$supp.'"></img>'."</td>";
                        echo "<td>".$row['nome']."</td>";
                        $flag=true;
                    }

                    if(!$flag){
                        echo "<br><br>Nessun gelato trovato!!";
                        exit;
                    }
                
                    //ingredienti
                    $sql = "SELECT DISTINCT ingrediente.nome, ingrediente.sigla
                                FROM ingrediente, prodotto_ingrediente, prodotto
                                WHERE prodotto_ingrediente.IDProdotto = Prodotto.ID AND prodotto_ingrediente.IDIngrediente = Ingrediente.ID
                                AND Prodotto.nome = '$nome'";
                    
        
                    $result = $conn->query($sql);
        
                    echo "<td>";
                    while ($row = $result->fetch_assoc()) {
                        if($row['sigla']!="") $supporto = $row['nome'] . " (".$row['sigla'].")";
                        else $supporto = $row['nome'];
        
                        echo $supporto."<br>";
                    } 
                    echo "</td>";
        
        
                    //Allergene
                    $sql = "SELECT DISTINCT allergene.nome
                                FROM allergene, ingrediente, prodotto_ingrediente, prodotto
                                WHERE prodotto_ingrediente.IDProdotto = Prodotto.ID AND prodotto_ingrediente.IDIngrediente = Ingrediente.ID
                                AND ingrediente.IDAllergene = allergene.ID
                                AND Prodotto.nome = '$nome'";
                    
        
                    $result = $conn->query($sql);
        
                    echo "<td>";
                    while ($row = $result->fetch_assoc()) {
                        echo $row['nome']."<br>";
                    } 
                    echo "</td>";
                    echo "<tr>";

                }


        }


       
        echo "</tbody>";
                    
    ?>
    
        
</body>
</html>
