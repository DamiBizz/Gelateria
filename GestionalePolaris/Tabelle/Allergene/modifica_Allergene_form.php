<?php
    require 'C:/xampp/htdocs/Elaborato/GestionalePolaris/config.php';
    require 'C:/xampp/htdocs/Elaborato/GestionalePolaris/verifica_session.php';
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <title>Modifica Allergene</title>
</head>
<body>
    <a href="index.php"><button>Torna indietro</button></a>

    <form action="modifica_Allergene.php" method="POST">
        <input type="hidden" name="ID" value="<?php echo $_POST['ID']?>"/><br />
        nome Allergene<input maxlength="30" type="text" name="nome" value="<?php echo $_POST['nome']?>" required/><br />
        <input type="submit" value="Conferma" />
    </form>

</body>
</html>