<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<title>Recuperar contrase&ntilde;a</title>
<meta name='viewport' content='width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no'/>
<meta name="description" content="">
<meta name="keywords" content="">
<link href="./../fontawesome/css/all.min.css" rel="stylesheet">
<link href="./../materializeV1/css/materialize.min.css" rel="stylesheet">
<link href="./../js/validetta/dist/validetta.min.css" rel="stylesheet">
<link rel="stylesheet" href="./../css/sweetalert.css">
<link href="./../js/confirm/dist/jquery-confirm.min.css" rel="stylesheet">
<link href="./../css/misEstilos.css" rel="stylesheet">
<script src="./../jquery/jquery-3.4.1.min.js"></script>
<script src="./../materializeV1/js/materialize.min.js"></script>
<script src="./../js/validetta/dist/validetta.min.js"></script>
<script src="./../js/validetta/localization/validettaLang-es-ES.js"></script>
<script src="./../js/confirm/dist/jquery-confirm.min.js"></script>
<script src="./../js/sweetalert.min.js"></script>
<script src="./../js/recu.js"></script>
</head>
<body id = "Recu">
  <header>
    <div id><a href="postal.html"><img src="./../imgs/postKarteb.png"></a></div>
    <div id="menu"><a href="#">ACERCA DE</a></div>
  </header>
  <main class="valign-wrapper">
    <div class="recu-box">
        <h1>Recuperar contrase&ntilde;a</h1>
        <form id="formRecu" method = "POST" action = "./recu.php">
          <div class="input-field">
            <i class="fas fa-user prefix" id = "correoRecu"></i>
            <label for="email">Correo</label>
            <input type="text" id="email" name="email" data-validetta="required,email">
          </div>
          <input type="submit" class="btn" value="Recuperar">
          <a href="./login.php" class="crear">Regresar</a>
        </form>
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
