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
                            <li class="nav-item"><a class="nav-link active" href="/">Home</a></li>
                            <li class="nav-item"><a class="nav-link" href="#">Gelati</a></li>
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

    <!-- Optional JavaScript -->
    <!-- JavaScript Dependencies: jQuery, Popper.js, Bootstrap JS, Shards JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/shards-ui@latest/dist/js/shards.min.js"></script>
</body>

</html>