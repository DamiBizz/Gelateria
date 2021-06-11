<?php
    require 'C:/xampp/htdocs/Elaborato/GestionalePolaris/config.php';

    session_start();

    if (isset($_SESSION['utente'])){
        header("Location: /index.php");
        exit;
    }
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- CSS Dependencies -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://unpkg.com/shards-ui@latest/dist/css/shards.min.css">

    <link href="login_style.css" rel="stylesheet" type="text/css">
    <script src='https://www.google.com/recaptcha/api.js' async defer></script>
    <link href="stile.css" rel="stylesheet" type="text/css">

</head>

<body>

    <div id="root">
        <div class="landing d-flex justify-content-center flex-column">

            <div class="container">
                <nav class="navbar navbar-expand-md navbar-dark">
                    <a class="navbar-brand" href="">
                        <img src="./logo-white.svg" class="logo mr-2" alt="" />
                        <div class="mt-auto mb-auto container">
                        <div class="row">
                            <div class="col">
                                <h1 class="display-4 text-white">Gelateria Polaris</h1>
                            </div>
                        </div>
                    </div>
                    </a>
                </nav>
            </div>


            

            <div class="cont">
                <div class="demo">
                    <div class="login">
                    <div class="login__check"></div>
                    <div class="login__form">

                        <form action="verifica.php" method="POST">
                            <div class="g-recaptcha" data-sitekey="6LfpkdEaAAAAAFBBvOvNyYNBnZqua-1HE_ovFd9d"></div>
                            <div class="login__row">
                                <svg class="login__icon name svg-icon" viewBox="0 0 20 20">
                                <path d="M0,20 a10,8 0 0,1 20,0z M10,0 a4,4 0 0,1 0,8 a4,4 0 0,1 0,-8" />
                                </svg>
                                <input type="text" name="utente" class="login__input name" placeholder="Username"/>
                            </div>
                            <div class="login__row">
                                <svg class="login__icon pass svg-icon" viewBox="0 0 20 20">
                                <path d="M0,20 20,20 20,8 0,8z M10,13 10,16z M4,8 a6,8 0 0,1 12,0" />
                                </svg>
                                <input type="password" name="pwd" class="login__input pass" placeholder="Password"/>
                            </div>
                            <button type="submit" class="login__submit">Accedi</button>
                        </form>
                    </div>
                    </div>
                </div>
            </div>
                    
        </div>
    </div>

    

    <!-- JavaScript Dependencies: jQuery, Popper.js, Bootstrap JS, Shards JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/shards-ui@latest/dist/js/shards.min.js"></script>
</body>

</html>