<?php
    require 'C:/xampp/htdocs/Elaborato/GestionalePolaris/config.php';
    require 'C:/xampp/htdocs/Elaborato/GestionalePolaris/verifica_session.php';

?>


<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="../tabelle.css">
    <link rel="stylesheet" href="../modifica_inserimento_dati.css">
    
    <title>Modifica Password</title>

</head>
<body>
    
    <a class="torna_indietro" href="<?php echo $GLOBALS['domain_home']?>">
        <img width="60px" height="31px" src="../../../Images/back.png"></img>
    </a>
    
    <form action="modifica_singolo_Account.php" method="POST">
        <h3 class="titolo_sopra_tabella">Modifica la tua Password <?php echo $_SESSION['utente']?></h3>  
        <input type="hidden" name = "nome" value = "<?php echo $_SESSION['utente']?>">
        <br><br>Nuova Password:  <input type="password" inpupt maxlength="30"  name="pwd" pattern="^(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])(?=\S+$).{6,}$" required/>
        <br><br>Conferma Password:  <input type="password" inpupt maxlength="30"  name="pwd_verifica" pattern="^(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])(?=\S+$).{6,}$" required/>
        <br><br><input type="image" class="immagine" name="submit" src="../../../Images/conferma.png"  alt="Submit"/>
    </form>

</body>
</html>