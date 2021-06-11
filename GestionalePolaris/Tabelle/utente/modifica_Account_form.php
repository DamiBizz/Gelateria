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
    <link rel="stylesheet" href="../modifica_inserimento_dati.css">
    <title>Modifica Account</title>
</head>
<body>

    <a class="torna_indietro" href="index.php">
        <img width="60px" height="31px" src="../../../Images/back.png"></img>
    </a>

    <form action="modifica_Account.php" method="POST">
        <input type="hidden" value="<?php echo $_POST['ID']?>" name="ID">
        <input maxlength="30" type="text" name="nome" value="<?php echo $_POST['nome']?>" required/><br />
        <br>Modifica Password:  <input type="password" inpupt maxlength="30"  name="pwd" pattern="^(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])(?=\S+$).{6,}$"/>
        <br><br>Conferma password:  <input type="password" inpupt maxlength="30"  name="pwd_verifica" pattern="^(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])(?=\S+$).{6,}$"/>
        <br><br>Amministratore?
        <input type="checkbox" value="true" name="ruolo" <?php if($_POST['ruolo']==1) echo "checked"; ?>>
            <label for="ruolo">Si</label>
        
            <br><br><input type="image" class="immagine" name="submit" src="../../../Images/conferma.png"  alt="Submit"/>
    </form>

</body>
</html>