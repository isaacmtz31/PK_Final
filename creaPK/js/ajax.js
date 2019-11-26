$(document).ready(function (){
	$("#Amor").click(function (){
		obtener_registros("Amor");
	});
	$("#Amistad").click(function (){
		obtener_registros("Amistad");
	});
	$("#Invierno").click(function (){
		obtener_registros("Invierno");
	});
	$("#Navidad").click(function (){
		obtener_registros("Navidad");
	});
	$("#Sanacion").click(function (){
		obtener_registros("Sanacion");
	});
	$("#Cumpleanos").click(function (){
		obtener_registros("Cumpleanos");
	});
	$("#Ciudades").click(function (){
		obtener_registros("Ciudades");
	});
	$("#Paisajes").click(function (){
		obtener_registros("Paisajes");
	});
	$("#Graduacion").click(function (){
		obtener_registros("Graduacion");
	});
	$("#Lugares").click(function (){
		obtener_registros("Lugares");
	});
	$("#envio").submit(function (e){
		e.preventDefault();
		var frm = $(this).serialize();
		var checa = document.getElementById("checa");
		var correo_des = $("#envio").val();
		if (checa.checked) {
			var rut = $('#laimagen').attr('src');//la ruta es la imagen en base 64 cuando usamos el canvas
		    frm = frm+'&'+'imagen='+rut;//concatenamos en el metodo POST la imagen para ser leida en el php
		    envia_correo(frm);
		}else{
			var base64 = getBase64Image(document.getElementById("laimagen"));//enviamos la imagen transformada a base 64 porque no se uso canvas
			frm = frm+'&'+'imagen='+base64;//concatenamos en el metodo POST la imagen para ser leida en el php
		    envia_correo(frm);
		}
	});
	 obtener_registros();//Al cargar la pagina filtramos lo que traiga por defecto la consulta de consulta.php
});
function obtener_registros(categorias){
	$.ajax({
		url: "./php/consulta.php",  //documento donde nos comunicaremos para las consultas
		type: 'POST', //Variable post, sera el tipo de comunicacion entre el js y php
		dataType: "html", //Tipo de datos que el echo imprimira en nuestro php o html, en este caso es html
		data: { categorias: categorias},//Importante para recibir los datos, debe ser el mismo que lo que recibe el argumento de la funcion.
	})

	.done(function(res){
		$('#contenido').html(res);
	})
}
function envia_correo(frm){
	$.ajax({
		url: "./php/envia_correo.php",  //documento donde nos comunicaremos para las consultas
		type: 'POST', //Variable post, sera el tipo de comunicacion entre el js y php
		dataType: "html", //Tipo de datos que el echo imprimira en nuestro php o html, en este caso es html
		data: frm//Importante este manda los datos en POST a php
	})

	.done(function(res){
		$('#con').html(res);
	})
}
function getBase64Image(img) { //Funcion para convertir imagen en base 64 para el envio al correo electronico
  var canvas = document.createElement("canvas");
  canvas.width = 550;
  canvas.height = 550;
  var ctx = canvas.getContext("2d");
  ctx.drawImage(img, 0, 0, 550, 550);
  var dataURL = canvas.toDataURL();
  return dataURL;
}