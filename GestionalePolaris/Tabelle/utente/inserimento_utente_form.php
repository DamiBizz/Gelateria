<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="../modifica_inserimento_dati.css">
    <title>Account</title>
</head>
<body>

    <a class="torna_indietro" href="index.php">
        <img width="60px" height="31px" src="../../../Images/back.png"></img>
    </a>

    <form action="inserimento_Account.php" method="POST">
        <h3 class="titolo_sopra_tabella">INSERISCI UN NUOVO ACCOUNT</h3>    
        <br>Nome: <input maxlength="30" type="text" name="nome" required/>
        <br><br>Crea Password:  <input type="password" inpupt maxlength="30"  name="pwd" pattern="^(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])(?=\S+$).{6,}$" required/>
        <br><br>Conferma Password:  <input type="password" inpupt maxlength="30"  name="pwd_verifica" pattern="^(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])(?=\S+$).{6,}$" required/>
        <br><br>Amministratore?
            <input type="checkbox" value="true" name="ruolo">
            <label for="ruolo">Si</label>
            <br><br><input type="image" class="immagine" name="submit" src="../../../Images/conferma.png"  alt="Submit"/>

    </form>
</body>
</html>