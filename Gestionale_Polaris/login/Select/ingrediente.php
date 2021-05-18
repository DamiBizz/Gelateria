<!DOCTYPE html>
<html>
<head>
    <title>Ingrediente</title>
</head>

    <button onclick="goBack()">Go Back</button>

    <script>
        function goBack() {
        window.history.back();
        }
    </script>

    <table border="1"> 
        <thead>
            <th>ingrediente</th>
            <th>allergene</th>
        </thead>

        <?php  

            include "../../connessione_db.php";

            $nome_ingrediente =  $_POST['nome_ingrediente'];
            $nome_sigla_ingrediente = $_POST['nome_sigla_ingrediente'];

            $sql = "SELECT allergene.nome
                        FROM allergene, ingrediente
                        WHERE ingrediente.IDAllergene = allergene.ID
                        AND ingrediente.nome = '$nome_ingrediente'";


            $result = $conn->query($sql);

            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>".$nome_sigla_ingrediente. "</td>";
                echo "<td>".$row['nome'] . "</td>";
                echo "<tr>";
            }
            
        ?>

    </table>    
</body>
</html>

