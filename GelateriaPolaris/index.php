<?php

    function trova_allergeni($nome){
        include 'connessione_db.php';

        $sql = "SELECT DISTINCT allergene.nome
                            FROM allergene, ingrediente, prodotto_ingrediente, prodotto
                            WHERE prodotto_ingrediente.IDProdotto = Prodotto.ID AND prodotto_ingrediente.IDIngrediente = Ingrediente.ID
                            AND ingrediente.IDAllergene = allergene.ID
                            AND Prodotto.nome = '$nome'";
        $result = $conn->query($sql);

        $supporto = NULL;
        while ($row = $result->fetch_assoc()) {
            $supporto .= "$row[nome] & ";
        }

        if(!empty($supporto)){ //togli le ultime due parole
            $supporto = substr("$supporto", 0, -2);
        }
        else $supporto = "Non contiene allergeni specifici";

        return $supporto;
    }

    function trova_ingredienti($nome){

        include 'connessione_db.php';

        $sql = "SELECT DISTINCT ingrediente.nome, ingrediente.sigla
                FROM ingrediente, prodotto_ingrediente, prodotto
                WHERE prodotto_ingrediente.IDProdotto = Prodotto.ID AND prodotto_ingrediente.IDIngrediente = Ingrediente.ID
                AND Prodotto.nome = '$nome'";

        $result = $conn->query($sql);

        $supporto = NULL;
        while ($row = $result->fetch_assoc()) {
            $supporto .= "$row[nome] & ";
        }

        if(!empty($supporto)){ //togli le ultime due parole
            $supporto = substr("$supporto", 0, -2);
        }
        else $supporto = "Nessun ingrediente associao al momento";

        return $supporto;
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- CSS Dependencies -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://unpkg.com/shards-ui@latest/dist/css/shards.min.css">

    <style>
        .landing {
            position: relative;
            height: 100vh;
            min-height: 700px;
            background: url("./landing.jpg") no-repeat center center fixed;
            background-size: cover;
        }

        .landing::before {
            position: absolute;
            z-index: 0;
            content: '';
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            opacity: .5;
            background: #007bff;
        }

        .logo {
            height: 28px;
        }

        .section-title {
            position: relative;
        }

        .section-title:after {
            content: '';
            width: 30px;
            height: 2px;
            background: #007bff;
            position: absolute;
            left: 50%;
            margin-left: -15px;
            bottom: -20px;
        }

        .page-content {
            position: relative;
            background: #fafafa;
            padding-top: 5.3125rem;
        }

        /* The switch - the box around the slider */
        .switch {
            position: relative;
            display: inline-block;
            width: 60px;
            height: 34px;
        }
        
        /* Hide default HTML checkbox */
        .switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }
        
        /* The slider */
        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            -webkit-transition: .4s;
            transition: .4s;
        }
        
        .slider:before {
            position: absolute;
            content: "";
            height: 26px;
            width: 26px;
            left: 4px;
            bottom: 4px;
            background-color: white;
            -webkit-transition: .4s;
            transition: .4s;
        }
        
        input:checked + .slider {
            background-color: #2196F3;
        }
        
        input:focus + .slider {
            box-shadow: 0 0 1px #2196F3;
        }
        
        input:checked + .slider:before {
            -webkit-transform: translateX(26px);
            -ms-transform: translateX(26px);
            transform: translateX(26px);
        }
        
        /* Rounded sliders */
        .slider.round {
            border-radius: 34px;
        }
        
        .slider.round:before {
            border-radius: 50%;
        }
    </style>
</head>

<body>
    <div id="root">
        <div class="landing d-flex justify-content-center flex-column">
            <div class="container">
                <nav class="navbar navbar-expand-md navbar-dark">
                    <a class="navbar-brand" href="#">
                        <img src="./logo-white.svg" class="logo mr-2" alt="" />
                        Polaris
                    </a>
                    <button type="button" class="navbar-toggler">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse">
                        <ul class="navbar-nav">
                            <li class="nav-item"><a class="nav-link active" href="#">Home</a></li>
                            <li class="nav-item"><a class="nav-link" href="">Gelati</a></li>
                            <li class="nav-item"><a class="nav-link" href="#">Dove siamo</a></li>
                            <li class="nav-item"><a class="nav-link" href="#">Contattaci</a></li>
                        </ul>
                    </div>
                </nav>
            </div>
            <div class="mt-auto mb-auto container">
                <div class="row">
                    <div class="col">
                        <h1 class="display-4 text-white">Gelateria Polaris</h1>
                        <p class="text-white">dal 1989</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    

    


    <div class="section py-4">
        <h3 id="gelati" class="section-title text-center my-5">I nostri Gelati</h3>

        <!-- Trigger -->
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
        Sei allergico/a qualcosa?
        </button>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">A cosa sei allergico/a?</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="index.php#gelati" method="POST">
                    <!-- Rounded switch -->
                    Latte
                    <label class="switch">
                        <input type="checkbox" value="true" name="Latte" <?php if(!empty($_POST['Latte']) &&  $_POST['Latte']=="true") echo "checked" ?>>
                        <span class="slider round"></span>
                    </label>
                    <br>

                    Glutine
                    <label class="switch">
                        <input type="checkbox" value="true" name="Glutine" <?php if(!empty($_POST['Glutine']) &&  $_POST['Glutine']=="true") echo "checked" ?>>
                        <span class="slider round"></span>
                    </label>
                    <br>

                    Uova
                    <label class="switch">
                        <input type="checkbox" value="true" name="Uova" <?php if(!empty($_POST['Uova']) &&  $_POST['Uova']=="true") echo "checked" ?>>
                        <span class="slider round"></span>
                    </label>
                    <br>

                    Frutta a guscio
                    <label class="switch">
                        <input type="checkbox" value="true" name="Frutta_guscio" <?php if(!empty($_POST['Frutta_guscio']) &&  $_POST['Frutta_guscio']=="true") echo "checked" ?>>
                        <span class="slider round"></span>
                    </label>
                    <br>

                    Arachidi
                    <label class="switch">
                        <input type="checkbox" value="true" name="Arachidi" <?php if(!empty($_POST['Arachidi']) &&  $_POST['Arachidi']=="true") echo "checked" ?>>
                        <span class="slider round"></span>
                    </label>
                    <br>

                    Soia
                    <label class="switch">
                        <input type="checkbox" value="true" name="Soia" <?php if(!empty($_POST['Soia']) &&  $_POST['Soia']=="true") echo "checked" ?>>
                        <span class="slider round"></span>
                    </label>
                    <br>
                    <br>
                    <br>

                    <input type="submit" value="Ricerca" class="btn btn-secondary"/> 
                </form>
            </div>
                
            </div>
        </div>
        </div>



        

        <!-- Gelati -->
        <div class="container">
            <div class="col-md-12 ml-auto mr-auto">
                <div class="row">

                <?php
                    //select i gusti disponibili
                    $latte = "";
                    if(!empty($_POST['Latte']) &&  $_POST['Latte']=="true") $latte = " OR allergene.nome = 'Latte'";
                    $glutine = "";
                    if(!empty($_POST['Glutine']) &&  $_POST['Glutine']=="true") $glutine = " OR allergene.nome = 'Glutine'";
                    $uova = "";
                    if(!empty($_POST['Uova']) &&  $_POST['Uova']=="true") $uova = " OR allergene.nome = 'Uova'";
                    $frutta_guscio = "";
                    if(!empty($_POST['Frutta_guscio']) &&  $_POST['Frutta_guscio']=="true") $frutta_guscio = " OR allergene.nome = 'Frutta a guscio'";
                    $arachidi = "";
                    if(!empty($_POST['Arachidi']) &&  $_POST['Arachidi']=="true") $arachidi = " OR allergene.nome = 'Arachidi'"; 
                    $soia = "";
                    if(!empty($_POST['Soia']) &&  $_POST['Soia']=="true") $soia = " OR allergene.nome = 'Soia'";
                    $selezione_allergeni = $latte.$glutine.$uova.$frutta_guscio.$arachidi.$soia;
                    

                    $selezionato_qualcosa = true;
                    if(empty($selezione_allergeni)){
                        $selezionato_qualcosa = false;
                    }
                    else{
                        $selezione_allergeni[1] = " ";
                        $selezione_allergeni[2] = " ";
                        $selezione_allergeni = " AND".$selezione_allergeni;
                    }
                    
                    //if($selezione_allergeni == " AND") $selezione_allergeni="";
                    //echo "ALLERGENI-->".$selezione_allergeni."<br>";

                    include 'connessione_db.php';
                    $sql = "SELECT DISTINCT nome, text, estensione_img FROM prodotto WHERE disponibile = 1";
                    $result = $conn->query($sql);


                    $counter = 0;
                    while($row = $result->fetch_assoc()) { 

                        if(!$selezionato_qualcosa){
                            $array_nomi[$counter] = $row['nome'];
                            $array_text[$counter] = $row['text'];
                            $estensione_img[$counter] = $row['estensione_img'];
                            $counter++;
                        }

                        else if($selezionato_qualcosa){
                            //fallo sole se anche l'allergene non esiste o è divero da quello selezionato
                            $sql2 = "SELECT allergene.ID
                                        FROM allergene, ingrediente, prodotto_ingrediente, prodotto
                                        WHERE prodotto_ingrediente.IDProdotto = Prodotto.ID AND prodotto_ingrediente.IDIngrediente = Ingrediente.ID
                                        AND ingrediente.IDAllergene = allergene.ID
                                        AND Prodotto.nome = '$row[nome]'";
                            $result2 = $conn->query($sql2);
                            $row2 = $result2->fetch_assoc();
                            if(empty($row2)){
                                $array_nomi[$counter] = $row['nome'];
                                $array_text[$counter] = $row['text'];
                                $estensione_img[$counter] = $row['estensione_img'];
                                $counter++;
                            }

                            else{
                                $sql3 = "SELECT DISTINCT prodotto.nome
                                        FROM allergene, ingrediente, prodotto_ingrediente, prodotto
                                        WHERE prodotto_ingrediente.IDProdotto = Prodotto.ID AND prodotto_ingrediente.IDIngrediente = Ingrediente.ID
                                        AND ingrediente.IDAllergene = allergene.ID
                                        AND prodotto.nome = '$row[nome]'
                                        AND allergene.nome IN(SELECT DISTINCT allergene.nome
                                                                FROM allergene
                                                                    WHERE 1=1
                                                                    $selezione_allergeni
                                                                    )
                                        ";

                                //echo "$sql3 <br><br>";

                                $result3 = $conn->query($sql3);
                                $row3 = $result3->fetch_assoc();

                                if(empty($row3)){
                                    $array_nomi[$counter] = $row['nome'];
                                    $array_text[$counter] = $row['text'];
                                    $estensione_img[$counter] = $row['estensione_img'];
                                    $counter++;
                                }
                            }

                        }
                                                
                        
                    }
                        $count = 0;
                        for($i=0; $i<$counter; $i++){
                        
                        echo "
                        
                            <div class='col-lg-3 col-md-6 col-sm-6 mb-4'>
                                <div class='card'>
                                    <img class='card-img-top' src='https://gestionalepolaris.com/immagini_gelati/$array_nomi[$i].$estensione_img[$i]' alt='Card image cap'>
                                    <div class='card-body'>
                                        <h4 class='card-title'>$array_nomi[$i]</h4>
                                        <p class='card-text'>$array_text[$i]</p>
                                        <button type='button' class='btn btn-primary' data-toggle='modal' data-target='#exampleModal$count'>
                                        Info
                                        </button>
                                    </div>
                                </div>
                            </div>
                        
                        ";

                        //modal
                        echo '
                        
                            <div class="modal fade" id="exampleModal'.$count.'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">'.$array_nomi[$i].'</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    Ingredienti: '.trova_ingredienti($array_nomi[$i]).' <br>
                                    Allergeni: '.trova_allergeni($array_nomi[$i]).'
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Chiudi</button>
                                </div>
                                </div>
                            </div>
                            </div> 
                        
                        
                        ';

                        $count++;

                    }
                ?>

                </div>
            </div>
        </div>
    </div>

    

    <!-- Modal -->
    

    <!-- Optional JavaScript -->
    <!-- JavaScript Dependencies: jQuery, Popper.js, Bootstrap JS, Shards JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/shards-ui@latest/dist/js/shards.min.js"></script>
</body>

</html>