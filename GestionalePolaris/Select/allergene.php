<?php
    require 'C:/xampp/htdocs/Elaborato/GestionalePolaris/config.php';
    require 'C:/xampp/htdocs/Elaborato/GestionalePolaris/verifica_session.php';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Allergene</title>
</head>

<button onclick="goBack()">Go Back</button>

<script>
    function goBack() {
    window.history.back();
    }
</script>

    <table border="1"> 
        <thead>
            <th>allergene</th>
            <th>ingrediente</th>
        </thead>

        <?php  

            include "$GLOBALS[connessione_db]";

            $allergene_nome =  $_POST['allergene_nome'];

            $sql = "SELECT ingrediente.nome, ingrediente.sigla
                        FROM allergene, ingrediente
                        WHERE ingrediente.IDAllergene = allergene.ID
                        AND allergene.nome = '$allergene_nome'";


            $result = $conn->query($sql);

            echo "<tr>";
                echo "<td>".$allergene_nome. "</td>";

                echo "<td>";
                    while($row = $result->fetch_assoc()) {
                        if($row['sigla']!="") $supporto = $row['nome'] . " (".$row['sigla'].")";
                        else $supporto = $row['nome'];
                        echo $supporto. "<br>";
                        
                    }
                echo "</td>";
            echo "<tr>";
            
        ?>

    </table>    
</body>
</html>

