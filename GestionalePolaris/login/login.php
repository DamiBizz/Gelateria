<!DOCTYPE html>
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>

    <title>Login</title>
    <script src='https://www.google.com/recaptcha/api.js' async defer></script>

    <?php
        session_start();

        if (isset($_SESSION['utente'])){
            header("Location: /");
            exit;
        }
    ?>

</head>
<body>
    <br /> <br />
    <div class="container">
    <div class="row">
        <div class="col-sm">
            <form action="verifica.php" method="POST">
                <div class="g-recaptcha" data-sitekey="6LfpkdEaAAAAAFBBvOvNyYNBnZqua-1HE_ovFd9d"></div>
                <div>
                <label for="exampleInputEmail1" class="form-label">Utente</label>
                    <input type="text" name="utente" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                <div class="mb-3">
                    
                    <label for="exampleInputPassword1" class="form-label">Password</label>
                    <input type="password" name="pwd" class="form-control" id="exampleInputPassword1">

                </div>
                <button type="submit" class="btn btn-primary">Login</button>
            </form>
        </div>
  </div>
</body>
</html>