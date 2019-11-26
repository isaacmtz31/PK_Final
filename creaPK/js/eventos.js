//Para el paralax que se muestra como fondo del carrusel:
document.addEventListener('DOMContentLoaded', function() {
    var elems = document.querySelectorAll('.parallax');
    var instances = M.Parallax.init(elems);
  });
//Para el modal:
document.addEventListener('DOMContentLoaded', function() {
    var elems = document.querySelectorAll('.modal');
    var instances = M.Modal.init(elems);
  });

//Para que aparezca el tip en la paleta de edicion:
document.addEventListener('DOMContentLoaded', function() {
    var elems = document.querySelectorAll('.tooltipped');
    var instances = M.Tooltip.init(elems, {
    	margin: 5,
        enterDelay: 600
    });
  });


//La funcion emplea obtiene los datos traidos por el ajax para operar con esos elementos
function emplea () {
var postales=document.getElementsByClassName('ir');
const botones = document.querySelectorAll(".lol");
var div = document.getElementById('form_envio'); 
var img = document.getElementById("atras");
var divs = document.getElementById('paleta');
var tip = document.getElementById('tip');
var palet = document.getElementById('palet');
var estado = document.getElementById('estado');
var subir = document.getElementById('sube');
var canv = document.getElementById("miCanvas"); 
const llama = function (evento) {
    var ruta = this.src;//encontramos la ruta de la postal que se haga click
    img.src = ruta;//la asignamos a la imagen del espacio de trabajo 
}
const muestra1 = function (evento){
       this.style.border = '4px solid #fff';
}
const muestra2 = function (evento){
    this.style.border = '0px';
}
botones.forEach(boton => {//Identificamos a cada indice del arreglo del carrusel de esta manera
    boton.addEventListener("click", llama);
    boton.addEventListener("mouseover", muestra1);
    boton.addEventListener("mouseout", muestra2);
});
for (var i = 0; i < postales.length; i++) {//para todos los elementos en el carrusel, es indistinto el indice, hacer:
   postales[i].addEventListener('click', function () {
        document.getElementById("checa").checked = false;
        div.style.display = "flex";
        canv.style.display = "none";
        img.style.visibility = "visible";
        divs.style.display = "none";
        tip.style.display = "none";
        palet.style.display = "none";
        estado.style.display = "none";
        subir.style.display = "none";
   }); 
   var elems = document.querySelectorAll('.carousel');
   var instances = M.Carousel.init(elems, {
        indicators: true
   });
 }
}
////Contenedor de los escuchas a la hora de hacer consultas//////////
retrasa(); //la llamamos para que cuando cargue el archivo por primera vez o se refresque la pagina
document.getElementById('Amor').addEventListener('click', retrasa);
document.getElementById('Amistad').addEventListener('click', retrasa);
document.getElementById('Invierno').addEventListener('click', retrasa);
document.getElementById('Navidad').addEventListener('click', retrasa);
document.getElementById('Sanacion').addEventListener('click', retrasa);
document.getElementById('Cumpleanos').addEventListener('click', retrasa);
document.getElementById('Ciudades').addEventListener('click', retrasa);
document.getElementById('Paisajes').addEventListener('click', retrasa);
document.getElementById('Graduacion').addEventListener('click', retrasa);
document.getElementById('Lugares').addEventListener('click', retrasa);

//Funcion que manda a dormir la escuhca en lo que se hace la consulta ajax por medio segundo
function retrasa(){
    setTimeout(function(){emplea()},500);//despues de los 500msg se manda a llamar a la funcion de carga id's y clases
}
//Para que aparezca la paleta de edicion y el canvas al presionar "modificacion de postal":
document.getElementById('checa').addEventListener("change", function () {
	var div = document.getElementById('paleta');
    var tip = document.getElementById('tip');
    var palet = document.getElementById('palet');
    var canv = document.getElementById("miCanvas");
    var im = document.getElementById('atras');
    var estado = document.getElementById('estado');
    var subir = document.getElementById('sube');
	if (this.checked) {
		div.style.display = "flex";
        tip.style.display = "block";
        canv.style.display = "block";
        im.style.visibility = "hidden";
        palet.style.display = "block";
        estado.style.display = "flex";
        subir.style.display = "block";
	}else{
		div.style.display = "none";
        tip.style.display = "none";
        canv.style.display = "none";
        im.style.visibility = "visible";
        palet.style.display = "none";
        estado.style.display = "none";
        subir.style.display = "none";
	}
});
//Revisa las condiciones si hubo dedicatoria de postal antes de enviar 
document.getElementById('exPng').addEventListener("click", function (){
    var descarga = document.getElementById('descarga');//opcion de descarga
    var box = document.getElementById('checa');
    var content = $("#emails").val();//obtenemos el valor del primer input
    var email = document.getElementById('email');//Correo a ser enviado
    email.value = content; //asignamos el valor inicial al final
    if (box.checked) {
        descarga.style.display = "block";
    }else{
        descarga.style.display = "none";
    }
});

document.getElementById('envio').addEventListener("submit", function (){
    var envia = document.getElementById("elsub");
    var carga = document.getElementById("cargador");
    envia.disabled = true;
    envia.style.background = "#BDBEBF";
    carga.style.display = "block";
});