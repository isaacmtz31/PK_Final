<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta http-equiv=”Expires” content=”0″>
    <meta http-equiv="Last-Modified" content="0">
    <meta http-equiv="Cache-Control" content="no-cache, mustrevalidate">
    <meta http-equiv="Pragma" content="no-cache">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<title>Envia Postales</title>
	<link href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap" rel="stylesheet">
	<link href="fontawesome/css/all.css" rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="materialize/css/materialize.min.css"  media="screen,projection"/>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
	<header>
		<div><a href="postal.html" href="postal.html"><img src="imagenes/logo.png"></a></div>
		<div id="menu">
			<a href="#"><i class="fas fa-user"></i>PERFIL</a>
		</div>
	</header>
	<div id="cabecera">
		<div class="crea center-align">
			<a href="#">Crea tu propia postal</a>
		</div>
    	</div>
	<div class="parallax-container">
		<div class="parallax">
			<img src="imagenes/fondo_madera2.jpg">
		</div>
        <div id="contenido">
        	<!---A van las postales con PHP y Ajax--->
        </div>  
	</div>
	<div id="pie">
		<div class="enlace"><a href="#cabecera" id="Amor"><i class="far fa-heart"></i>Amor</a></div>
		<div class="enlace"><a href="#cabecera" id="Amistad"><i class="fas fa-icons"></i>Amistad</a></div>
		<div class="enlace"><a href="#cabecera" id="Invierno"><i class="fas fa-mitten"></i>Invierno</a></div>
		<div class="enlace"><a href="#cabecera" id="Navidad"><i class="fas fa-snowman"></i>Navidad</a></div>
		<div class="enlace"><a href="#cabecera" id="Sanacion"><i class="fas fa-heartbeat"></i>Sanación</a></div>
		<div class="enlace"><a href="#cabecera" id="Cumpleanos"><i class="fas fa-birthday-cake"></i></i>Cumpleaños</a></div>
		<div class="enlace"><a href="#cabecera" id="Ciudades"><i class="far fa-building"></i>Ciudades</a></div>
		<div class="enlace"><a href="#cabecera" id="Paisajes"><i class="fas fa-mountain"></i>Paisajes</a></div>
		<div class="enlace"><a href="#cabecera" id="Graduacion"><i class="fas fa-graduation-cap"></i>Graduación</a></div>
		<div class="enlace"><a href="#cabecera" id="Lugares"><i class="fas fa-archway"></i>Lugares</a></div>
	</div>
	<div id="form_envio">
			<form name="formulario" id="formulario">
				<div class="join">
					<label for="email">Email Destinatario:</label>
					<input id="emails" type="email" class="validate">
				</div>
				<div class="join">
					<label for="correo" class="ing">¿Desea agregar alguna <br>dedicatoria a la postal?</label>
					<br>
					<label>
                      <input type="checkbox" class="filled-in checkbox-blue-grey" id="checa" />
                      <span>Si</span>
                    </label>
				</div>
				<div class="join">
					<input type="button" data-target="modal1" class="modal-trigger" value="Enviar" id="exPng">
				</div>
			</form>
		<div id="postal">
			<div>
				<div id="palet" class="btn-floating btn-large pulse">Paleta</div>
			 <div id="paleta">
			 	    <div>
					<a href="#miCanvas" class="bt tooltipped" data-position="top" data-tooltip="Courier New" id="italic"><img src="paleta/cour.png"></a>
					<a href="#miCanvas" class="bt tooltipped" data-position="top" data-tooltip="Arial" id="Arial"><img src="paleta/a.png"></a>
					<a href="#miCanvas" class="bt tooltipped" data-position="top" data-tooltip="Verdana" id="verd"><img src="paleta/sans.png"></a>
					<a href="#miCanvas" class="bt tooltipped" data-position="top" data-tooltip="Lobster" id="lobs"><img src="paleta/lob.png"></a>
					</div>
					<div class="colores">
					<a href="#miCanvas" class="bt tooltipped" data-position="top" data-tooltip="Tamaño 25" id="25">25</a>
					<a href="#miCanvas" class="bt tooltipped" data-position="top" data-tooltip="Tamaño 30" id="30">30</a>
					<a href="#miCanvas" class="bt tooltipped" data-position="top" data-tooltip="Tamaño 35" id="35">35</a>
					<a href="#miCanvas" class="bt tooltipped" data-position="top" data-tooltip="Tamaño 40" id="40">40</a>
					</div>
					<div class="colores">
					<a href="#miCanvas" class="bt tooltipped" data-position="top" data-tooltip="Blanco" id="blanco"><img src="paleta/blanco.png"></a>
					<a href="#miCanvas" class="bt tooltipped" data-position="top" data-tooltip="Negro" id="negro"><img src="paleta/negro.png"></a>
					<a href="#miCanvas" class="bt tooltipped" data-position="top" data-tooltip="Rojo" id="rojo"><img src="paleta/rojo.png"></a>
					<a href="#miCanvas" class="bt tooltipped" data-position="top" data-tooltip="Verde" id="verde"><img src="paleta/verde.png"></a>
					<a href="#miCanvas" class="bt tooltipped" data-position="top" data-tooltip="Azul" id="azul"><img src="paleta/azul.png"></a>
					<a href="#miCanvas" class="bt tooltipped" data-position="top" data-tooltip="Anaranjado" id="naranja"><img src="paleta/naranja.png"></a>
					<a href="#miCanvas" class="bt tooltipped" data-position="top" data-tooltip="Rosa" id="rosa"><img src="paleta/rosa.png"></a>
					<a href="#miCanvas" class="bt tooltipped" data-position="top" data-tooltip="Morado" id="morado"><img src="paleta/morado.png"></a>
					</div>
					<a href="#miCanvas" class="bt tooltipped" data-position="top" data-tooltip="Resetear" id="reset"><img src="paleta/resetea.png"></a>
					<a href="#miCanvas" class="bt tooltipped" data-position="top" data-tooltip="Tapiz">
					 <label>
                      <input type="checkbox" class="filled-in checkbox-blue-grey" id="tapize" checked="checked"/>
                      <span></span>
                     </label>
                    </a>
			 </div>
			</div>
			<div>
				<div id="tip" class="btn-floating btn-large pulse">¡Escribe donde desees!</div>
				<div id="estado">
					<div class="actuales" id="new_size">18</div>
					<div class="actuales" id="new_font">Lobster</div>
					<img src="" id="new_color" class="actuales">
				</div>
				<a href="#miCanvas" class="bt tooltipped" data-position="top" data-tooltip="Subir Imagen" id="sube">
				<img src="paleta/sube.png">	
				 <input type="file" id="camb">
				</a>
				<canvas id='miCanvas'></canvas>
				<img class="responsive-img" src="" id="atras"> <!---Importante para cargar la imagen en el canvas --->
			</div>
		</div>
	</div>
	<div id="modal1" class="modal">
    <div class="modal-content">
      <div id="descarga">
      	<p class="titulo">Descarga la postal</p>
		<div>
			<p>Elige el formato:</p>
		 <a id="download" class="waves-effect waves-light btn">
          <input type="button" value="PNG" id="guardaPng">
         </a>
        <a id="downloaded" class="waves-effect waves-light btn">
         <input type="button" value="JPG" id="guardaJpg">
        </a>
        </div>
      </div>
      <div id="postali">
      	<p class="titulo">Tu Postal luce asi:</p>
      	<img src="" id="laimagen"/>
      </div>
      <div id="datos_envio">
      	<p class="titulo"> Datos del Envio</p>
      	<form  method="post" id="envio">
      	<label for="email">Email Destinatario:</label>
      	<input id="email" type="email" class="validate" required="" aria-required="true" name="correo">
      	<label id="baja">¿Seguro que deseas enviar la postal?</label>
			<input type="submit" value="Enviar" id="elsub">
			<a href="#!" class="modal-close" id="cancela">cancelar</a>
			<div id="con"></div>
			  <div class="preloader-wrapper active" id="cargador">
    			<div class="spinner-layer spinner-blue-only">
    			  <div class="circle-clipper left">
    			    <div class="circle"></div>
    			  </div><div class="gap-patch">
    			    <div class="circle"></div>
    			  </div><div class="circle-clipper right">
    			    <div class="circle"></div>
    			  </div>
    			</div>
  			  </div>
      	</form>
      </div>
    </div>
  </div>
	<footer>
		<p>© 2019-2020 ESCOM / IPN. Reservados todos los derechos, PostKarte Web</p>
		<img src="" height="200" alt="Image preview..." id="ooo"><!--Aqui se muestra la imagen al subir una a la hora de editar esta displaynone --->
	</footer>
	<script src="js/jquery-3.4.1.min.js"></script>
	<script type="text/javascript" src="materialize/js/materialize.min.js"></script>
	<script src="js/ajax.js"></script>
	<script src="js/eventos.js"></script>
	<script src="js/canvas1.js"></script>
	    
</body>
</html>