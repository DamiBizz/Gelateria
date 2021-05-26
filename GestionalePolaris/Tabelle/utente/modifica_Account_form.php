<?php
    require 'C:/xampp/htdocs/Elaborato/GestionalePolaris/config.php';
    require 'C:/xampp/htdocs/Elaborato/GestionalePolaris/verifica_session.php';

    if (!$_SESSION['ruolo']){
        header("Location: $GLOBALS[domain_login]");
        exit;
    }
?>

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
        password<input type="password" inpupt maxlength="30"  name="pwd" pattern="^(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])(?=\S+$).{6,}$" required/>
        conferma password<input type="password" inpupt maxlength="30"  name="pwd_verifica" pattern="^(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])(?=\S+$).{6,}$" required/>
        Amministratore?
        <input type="checkbox" value="true" name="ruolo" <?php if($_POST['ruolo']==1) echo "checked"; ?>>
            <label for="ruolo">Si</label>
        <input type="submit" value="Conferma" />
    </form>

</body>
</html>