<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>Login POSTALES</title>
    <meta name='viewport' content='width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no'/>
    <meta name="description" content="">
    <meta name="keywords" content="">
    <link href="./../fontawesome/css/all.min.css" rel="stylesheet">
    <link href="./../materializeV1/css/materialize.min.css" rel="stylesheet">
    <link href="./../js/validetta/dist/validetta.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./../css/sweetalert.css">
    <link href="./../js/confirm/dist/jquery-confirm.min.css" rel="stylesheet">
    <link href="./../css/misEstilos.css" rel="stylesheet">

    <script src="./../jquery/jquery-3.4.1.js"></script>
    <script src="./../materializeV1/js/materialize.min.js"></script>
    <script src="./../js/validetta/dist/validetta.min.js"></script>
    <script src="./../js/validetta/localization/validettaLang-es-ES.js"></script>
    <script src="./../js/confirm/dist/jquery-confirm.min.js"></script>
    <script src="./../js/sweetalert.min.js"></script>
    <script src="./../js/logIn.js"></script>
  </head>
  <body id = "login">
        <header>
                <div id ="head"><a href="postal.html"></a></div>
                <div id="menu">
                    <a href="#">ACERCA DE</a>
                </div>
            </header>
            <main class="valign-wrapper">
            <div class="container">
    <div class="login-box">
        <img src="./../imgs/postKarteb.png" class="avatar" alt="Avatar Image">
        <h1>Ingresar</h1>
        <form id="formLogin">
          <div class="input-field">
            <i class="fas fa-user prefix" id = "correo"></i>
            <label for="email">Correo</label>
            <input type="text" id="email" name="email" data-validetta="required">
        </div>
        <div class="input-field">
          <i class="fas fa-key prefix" id="pass"></i>
          <label for="contra">Contrase&ntilde;a:</label>
          <input type="password" id="contra" name="contra" data-validetta="required,minlength[6],maxLength[16]">
      </div>
        <input type="submit" class="btn" value="Ingresar">
        <a href="./recuperarpsw.php" class="crear" id="Olvidar">&iquest;Olvid&oacute; su contrase&ntilde;a&#63;</a><br>
        <a href="./crearCuenta.php" class="crear">Crear Cuenta</a>
        </form>
    </div>
    </div>
    </main>
    <footer>
      <footer class="page-footer">
        <div class="footer-bajo">
          <div class="container">© 2019 Copyright POSTKARTE</div>
        </div>
      </footer>
    </footer>
  </body>
</html>
