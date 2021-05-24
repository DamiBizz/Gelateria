<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <title>Modifica Account</title>
</head>
<body>
    <a href="index.php"><button>Torna indietro</button></a>

    <form action="modifica_Account.php" method="POST">
        <input type="hidden" value="<?php echo $_POST['ID']?>" name="ID">
        nome<input maxlength="30" type="text" name="nome" value="<?php echo $_POST['nome']?>" required/><br />
        password <input maxlength="30" type="password" name="pwd"/>
        conferma la password <input maxlength="30" type="password" name="pwd_verifica"/>
        Amministratore?
        <input type="checkbox" value="true" name="ruolo" <?php if($_POST['ruolo']==1) echo "checked"; ?>>
            <label for="ruolo">Si</label>
        <input type="submit" value="Conferma" />
    </form>

</body>
</html>