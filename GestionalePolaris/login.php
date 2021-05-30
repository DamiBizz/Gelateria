<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link href="stile.css" rel="stylesheet" type="text/css">
    <script src='https://www.google.com/recaptcha/api.js' async defer></script>
</head>
<body>



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

  

 

</body>
</html>