<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<title>Crear Cuenta</title>
<meta name='viewport' content='width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no'/>
<meta name="description" content="">
<link href="./../fontawesome/css/all.min.css" rel="stylesheet">
<link href="./../materializeV1/css/materialize.min.css" rel="stylesheet">
<link href="./../js/validetta/dist/validetta.min.css" rel="stylesheet">
<link href="./../js/confirm/dist/jquery-confirm.min.css" rel="stylesheet">
<link href="./../css/misEstilos.css" rel="stylesheet">
<script type = "text/javascript"src = "https://code.jquery.com/jquery-2.1.1.min.js"></script>
<script src = "https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.3/js/materialize.min.js"></script>
<script src="./../jquery/jquery-3.4.1.min.js"></script>
<script  src="./../materializeV1/js/materialize.min.js"></script>
<script src="./../js/validetta/dist/validetta.min.js"></script>
<script src="./../js/validetta/localization/validettaLang-es-ES.js"></script>
<script src="./../js/confirm/dist/jquery-confirm.min.js"></script>
<script src="./../js/registro.js"></script>

<script language="javascript">

function limitarSelección(casilla,form)

{
a = casilla.form.genero[0].checked;
b = casilla.form.genero[1].checked;
c = casilla.form.genero[2].checked;

contador = (a ? 1 : 0) + (b ? 1 : 0) + (c ? 1 : 0);
    if (contador > 1)
    {
    alert("Solo puedes seleccionar 1 genero");
    casilla.checked = false;
    }
}
</script>
</head>
<body id = "crea">
    <header id ="Hrecu">
        <div id><a href="postal.html"><img src="./../imgs/postKarteb.png"></a></div>
    </header>-

    <main class="valign-wrapper">
        <div class="container">
            <form id="formRegistro" autocomplete="off">
            <div class="row">
                <h4 id="Titu">Registo Usuario</h4>
                <div class="col s12 m6 input-field">
                    <i class="fas fa-user prefix" id = "nom"></i>
                    <label for="nombreUsuario">Nombre</label>
                    <input type="text" id="nombreUsuario" name="nombreUsuario"  data-validetta="required">
                </div>
                <div class="col s12 m6 input-field">
                    <i class="fas fa-user prefix" id="ape"></i>
                    <label for="apellidoUsuario">Apellido</label>
                    <input type="text" id="apellidoUsuario" name="apellidoUsuario"  data-validetta="required">
                </div>
                <div class="row">
                    <div class="col s12 m6 input-field" id= "gene">
                        <div class="col s12 m6 input-field">
                            <i class="fas fa-users prefix" id="gen"></i>
                            <label for="genero">G&eacute;nero</label>
                        </div>
                    </div>
                    <div class="col s12 m6 input-field" id="check">
                        <div class="col s12 m6 l4 input-field">
                                <label><input type="checkbox" class ="filled-in" name="genero" id="generoH" value = "Masculino" onClick="limitarSelección(this,this.form)"/> <span>Hombre</span></labe>
                        </div>
                        <div class="col s12 m6 l4 input-field">
                            <label><input type="checkbox" class ="filled-in" name="genero" id="generoM" value = "Femenino" onClick="limitarSelección(this,this.form)"/> <span>Mujer</span></label>
                        </div>
                        <div class="col s12 m6 l4 input-field">
                            <label><input type="checkbox" class ="filled-in" name="genero" id="generoO" value = "Otro" onClick="limitarSelección(this,this.form)"/> <span>Otro</span></label>
                        </div>
                    </div>
                </div>
                <div class = "row">
				    <div class="col s12 m6 input-field">
                        <div class="col s12 m6">
                            <label><h6>Edad</h6></label>
                            <div class = "range-field">
                                <input type = "range" name = "edad" id = "test" min = "15" max = "80" value="20"/>
                            </div>
                        </div>
				    </div>
                    <div class="col s12 m6 input-field" id = "cont">
                        <i class="fas fa-key prefix" id="passw"></i>
                        <label for="contra">Contrase&ntilde;a</label>
                        <input type="password" id="contra" name="contra"  data-validetta="required,minlength[6],maxLength[16]">
                    </div>
                </div>
                <div class="col s12 m6 input-field ">
                    <i class="fas fa-envelope prefix" id="em"></i>
                    <label for="email">Correo</label>
                    <input type="text" id="email" name="email"  data-validetta="required,email">
                </div>
                <div class="col s12 m6 file-field input-field">
                    <div class="btn" id = "foto">
                        <span>Foto</span>
                        <input type="file" name="foto" accept="image/jpeg,image/x-png" data-validetta="required">
                    </div>
                    <div class="file-path-wrapper">
                        <input class="file-path validate" name ="fotoPerfil" type="text" placeholder="Selecciona una foto de perfil">
                    </div>
                </div>
                <div class="col s12 input-field">
                    <input type="submit" class="btn" id = "regi" style="width:100%;" value = "Registrar">
                </div>
            </div>
            </form>
            <div class="row right" id="Reg">
                <a href="./login.php" class= "text" id="lreg"> Regresar</a>
            </div>
        </div>
    </main>
    <footer>
      <footer class="page-footer" id = "foot">
        <div class="footer-bajo">
          <div class="container">© 2019 Copyright POSTKARTE</div>
        </div>
      </footer>
    </footer>

</body>
</html>
