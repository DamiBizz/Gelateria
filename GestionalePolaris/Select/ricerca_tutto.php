<?php
    require 'C:/xampp/htdocs/Elaborato/GestionalePolaris/config.php';
    require 'C:/xampp/htdocs/Elaborato/GestionalePolaris/verifica_session.php';
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="../Tabelle/tabelle.css">
    <title>Selezione</title>
</head>

    <a class="torna_indietro" href="<?php echo $GLOBALS['domain_home']?>">
        <img width="60px" height="31px" src="../../../Images/back.png"></img>
    </a>

    <table id="tabelle">
                <tr>
                    <th></th>
                    <th></th>
                    <th>Nome</th>
                    <th>Ingrediente (sigla)</th>
                    <th>Allergene</th>
                </tr>
        <?php 
            include "$GLOBALS[connessione_db]";
            
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
                        
        ?>
    </table>
    
        
</body>
</html>
