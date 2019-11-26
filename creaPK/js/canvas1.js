var imgWidth, imgHeight, mouseX, mouseY, startingX; //variables de control en el canvas
var tam = 18, fonte = "lobster", colore = "#1d1d1d"; //valores de edicion
var recentWords = [];//Arreglo para guardar cada palabra
var undoList = [];//Arreglo para guardar estados de la postal
var color_actual = document.getElementById("new_color");
var font_actual = document.getElementById("new_font");
var size_actual = document.getElementById("new_size");
$(document).ready(function (){
	var tip = document.getElementById('tip');
	var palet = document.getElementById('palet');
	var canvas = document.getElementById("miCanvas");
	//cargamos los valores de edicion iniciales:
	color_actual.src = "paleta/negro.png"; 
	if(canvas.getContext) 
	{
		setTimeout(function(){emple(img, img2, ctx, canvas)},500);//llamamos la funcion cuando cargue la pagina por si el usuario desea una de las primeras postales
		//Esta escucha se debe a que al hacer click aqui se cargue el carrusel de postales antes de que inicie este documento
		$("#Amor").click(function (){ 
			setTimeout(function(){emple(img, img2, ctx, canvas)},500);
		});
		$("#Amistad").click(function (){ 
			setTimeout(function(){emple(img, img2, ctx, canvas)},500);
		});
		$("#Invierno").click(function (){ 
			setTimeout(function(){emple(img, img2, ctx, canvas)},500);
		});
		$("#Navidad").click(function (){ 
			setTimeout(function(){emple(img, img2, ctx, canvas)},500);
		});
		$("#Sanacion").click(function (){ 
			setTimeout(function(){emple(img, img2, ctx, canvas)},500);
		});
		$("#Cumpleanos").click(function (){ 
			setTimeout(function(){emple(img, img2, ctx, canvas)},500);
		});
		$("#Ciudades").click(function (){ 
			setTimeout(function(){emple(img, img2, ctx, canvas)},500);
		});
		$("#Paisajes").click(function (){ 
			setTimeout(function(){emple(img, img2, ctx, canvas)},500);
		});
		$("#Graduacion").click(function (){ 
			setTimeout(function(){emple(img, img2, ctx, canvas)},500);
		});
		$("#Lugares").click(function (){ 
			setTimeout(function(){emple(img, img2, ctx, canvas)},500);
		});
		$("#guardaPng").click(function (){
			guardaPNG(canvas);
		});
		$("#guardaJpg").click(function (){
			guardaJPG(canvas);
		});
		$("#exPng").click(function (){
			generaPNG(canvas);
		});
		$("#camb").change(function (){
			previewFile(img, ctx, canvas);
			saveState(canvas);
		});
		$("#reset").click(function (){
			reset(canvas, ctx);
			tam = 18;
			size_actual.innerHTML = "18";
			fonte = "lobster";
			font_actual.innerHTML = "Lobster";
			colore = "#1d1d1d";
			color_actual.src = "paleta/negro.png";
		});
		$("#tapize").change(function (){
			if (this.checked) {
				setTapiz(img, img2, ctx);
				saveState(canvas)
			}else{
				quitaTapiz(img, ctx);
				saveState(canvas)
			}
		});
		$("#25").click(function (){
			tam = 25;
			size_actual.innerHTML = "25";
		});
		$("#30").click(function (){
			tam = 30;
			size_actual.innerHTML = "30";
		});
		$("#35").click(function (){
			tam = 35;
			size_actual.innerHTML = "35";
		});
		$("#40").click(function (){
			tam = 40;
			size_actual.innerHTML = "40";
		});
		$("#italic").click(function (){
			fonte = "courier New";
			font_actual.innerHTML = "Courier New";
		});
		$("#Arial").click(function (){
			fonte = "arial";
			font_actual.innerHTML = "Arial";
		});
		$("#verd").click(function (){
			fonte = "verdana";
			font_actual.innerHTML = "Verdana";
		});
		$("#lobs").click(function (){
			fonte = "lobster";
			font_actual.innerHTML = "Lobster";
		});
		$("#blanco").click(function (){
			colore = "#F3F3F3";
			color_actual.src = "paleta/blanco.png"; 
		});
		$("#negro").click(function (){
			colore = "#1d1d1d";
			color_actual.src = "paleta/negro.png"; 
		});
		$("#rojo").click(function (){
			colore = "#B22914";
			color_actual.src = "paleta/rojo.png"; 
		});
		$("#verde").click(function (){
			colore = "#03B261";
			color_actual.src = "paleta/verde.png"; 
		});
		$("#azul").click(function (){
			colore = "#5089C0";
			color_actual.src = "paleta/azul.png"; 
		});
		$("#naranja").click(function (){
			colore = "#F28705";
			color_actual.src = "paleta/naranja.png"; 
		});
		$("#rosa").click(function (){
			colore = "#D962A3";
			color_actual.src = "paleta/rosa.png"; 
		});
		$("#morado").click(function (){
			colore = "#81009E";
			color_actual.src = "paleta/morado.png"; 
		});
		var ctx = canvas.getContext("2d");
		var img = new Image();
		var img2 = new Image();
//		img.crossOrigin = "Anonymous";
		img.src = "js/papel.png" //Por default cargamos el mismo papel tapiz hasta que el usuario de click en alguna postal del carrusel, esto se modificara.
		img2.src = "js/papel.png";//Papel tapiz
		img.onload = function(){
			imgWidth = this.width;
			imgHeight = this.height;
			canvas.width = 550;
			canvas.height = 550;
			ctx.drawImage(this, 0, 0, 550, 435);//escalamos al tamaño que queremos segun la imagen del canvas
		};
		img2.onload = function(){
			ctx.drawImage(this, -5, 428, 565, 130);//escalamos al tamaño que queremos segun la imagen del canvas
			//Por default guardamos un estado del canvas al inicio para que el usuario no borre la postal completa:
			saveState(canvas);
		};
		$("#miCanvas").click(function (e) {
			//Desaparecemos el tooltip cuando el usuario de click en canvas:
			tip.style.display = "none";
			palet.style.display = "none";
			//Obteniendo la posicion donde escribiremos
			mouseX = e.pageX - canvas.offsetLeft;
			mouseY = e.pageY - canvas.offsetTop;
			startingX = mouseX;
			//Activar cursor para iniciar escritura(activa el teclado en dispositivos moviles):
			$(this).attr('contenteditable', 'true');
			//Reseteando el arreglo de las letras-recientes:
			recentWords = [];
			//return false;
		});
		//Agregando el evento "keydown" al documento
		$(document).keydown(function (e) {
			//Poniendo font a canvas:
			ctx.font = "normal normal normal " + tam + "px " + fonte;
		    ctx.fillStyle = colore;
			if (e.keyCode === 8) {//si borrar es presionado:
				if (recentWords.length > 0) {//Condicion para que no borrar mas contenido del que hay en recentWords
				undo(canvas, ctx);
				//Borra la ultima letra escrita:
				var recentWord = recentWords[recentWords.length-1];
				//mover el cursor hacia atras:
				mouseX -= ctx.measureText(recentWord).width;
				recentWords.pop();
			   }
			} else if (e.keyCode === 13) {//Codigo asqui del ENTER
				mouseX = startingX;
				mouseY += 20; //Separacion de renglones
			}else if (e.keyCode === 20 || e.keyCode === 37 || e.keyCode === 39 || e.keyCode === 38 || e.keyCode === 40 || e.keyCode === 16 
				|| e.keyCode === 9 || e.keyCode === 17 || e.keyCode === 18 || e.keyCode === 19 || e.keyCode === 35 || e.keyCode === 144){
				//Esta condicion esta vacia, valida y pasa por alto imprimir caracteres "de control"
				// estos son: BlockMayus=20, flechas control=37-40, tab=16, ctrl=9, shift=17, alt=18 y altgr=19.
				// imp pnt=35, blocknum = 144
			}else {
			//Escribiendo texto en el canvas:
			ctx.fillText(e.key, mouseX, mouseY);
			//Mover el cursor hacia adelante cada vez que se write:
			mouseX += ctx.measureText(e.key).width;
			//Guardamos el estado cada vez que ingresa una letra:
			saveState (canvas);
			//insertamos en el arreglo las letras recientes:
			recentWords.push(e.key);
		    }
		});
	}
});
//Funcion que utiliza retrasa:
function emple(img, img2, ctx, canvas) {//la funcion no puede llamarse como en el archivo eventos.js porque crearia conflicto
	const botones = document.querySelectorAll(".ir");
			const llama = function (evento) {
   		    carga_img(img, img2, ctx, canvas);
			setTapiz(img, img2, ctx);//ponemos el tapiza esto para volver a cargar el estado y guardarlo desde 0
			saveState(canvas);
		   }
	        botones.forEach(boton => {//Identificamos a cada indice del arreglo del carrusel de esta manera
    		  boton.addEventListener("click", llama);
		  });
}
//Funcion para quitar tapiz:
function quitaTapiz(img, ctx){
	undoList = [];
	ctx.drawImage(img, 0, 0, 550, 550);
}
//funcion para poner tapiz nuevamente:
function setTapiz(img, img2, ctx){
	undoList = [];
	ctx.drawImage(img, 0, 0, 550, 435);
	ctx.drawImage(img2, -5, 428, 565, 130);
}
//Funcion para resetear lo editado, volver al estado inicial del apostal:
function reset(canvas, ctx) {
	var longi = undoList.length-1;
	for(var i = 0; i < longi; i++){
		undoList.pop();//borramos todos los estados, dejando el primero de todos
	}
	var imgData = undoList[undoList.length-1];
	var image = new Image();
	//Desplegando el primer estado guardado desde el inicio:
	image.src = imgData;
	image.onload = function (){
		ctx.clearRect(0, 0, canvas.width, canvas.height);
		ctx.drawImage(image, 0, 0, canvas.width, canvas.height, 0, 0, canvas.width, canvas.height);
	};
}
//Funcion para guardar el estado actual del canvas despues de que se presiona una nueva letra:
function saveState(canvas) {
	undoList.push(canvas.toDataURL());
}
//Funcion a ser llamada cuando borrar un espacio es presionado:
function undo(canvas, ctx) {
	undoList.pop();
	var imgData = undoList[undoList.length-1];
	var image = new Image();
	//Desplegando el viejo estado guardado en undoList
	image.src = imgData;
	image.onload = function (){
		ctx.clearRect(0, 0, canvas.width, canvas.height);
		ctx.drawImage(image, 0, 0, canvas.width, canvas.height, 0, 0, canvas.width, canvas.height);
	};
}
//Guardar, guarda la imagen del canvas al tamaño que se especifico en el canvas.width x canvas.height
function guardaPNG(canvas){
	var filename = prompt("Guardar como...","Nombre del archivo");
	if (filename != null) {//Comprobamos que sea diferente de nulo
    if (canvas.msToBlob){ //para internet explorer
        var blob = canvas.msToBlob();
        window.navigator.msSaveBlob(blob, filename + ".png" );// la extensión de preferencia pon jpg o png
    } else {
        link = document.getElementById("download");
        //Otros navegadores: Google chrome, Firefox etc...
        link.href = canvas.toDataURL("image/png");// Extensión .png ("image/png") --- Extension .jpg ("image/jpeg")
        link.download = filename;
    }
    }
}
function guardaJPG(canvas){
	var filename = prompt("Guardar como...","Nombre del archivo");
	if (filename != null) {//Comprobamos que sea diferente de nulo
    if (canvas.msToBlob){ //para internet explorer
        var blob = canvas.msToBlob();
        window.navigator.msSaveBlob(blob, filename + ".jpeg" );// la extensión de preferencia pon jpg o png
    } else {
        link = document.getElementById("downloaded");
        //Otros navegadores: Google chrome, Firefox etc...
        link.href = canvas.toDataURL("image/jpeg");// Extensión .png ("image/png") --- Extension .jpg ("image/jpeg")
        link.download = filename;
    }
    }
}
function generaPNG(canvas){
	var box = document.getElementById('checa');//checamos si el usuario uso canvas
	if (box.checked){
	var img = document.getElementById("laimagen");
	img.src = canvas.toDataURL("image/png");
    }else{//Cargamos la postal que no esta editada:
    	var hey = $('#atras').attr('src');//obtenemos la url de la imagen ya cargada en el espacio de trabajo peviamente del carrusel
    	var img = document.getElementById("laimagen");
    	img.src = hey;                       
    }
}
//Para subir una imagen desde el cliente:
function previewFile(img, ctx, canvas) {
  var tapiz = document.getElementById("tapize").checked = false;
  var preview = document.getElementById('ooo');
  var file    = document.querySelector('input[type=file]').files[0];
  var reader  = new FileReader();

  reader.onloadend = function () {
    preview.src = reader.result;
    var hey = $('#ooo').attr('src');
    undoList = [];//Limpiamos el buffer de estados para que vuelva a empezar
    img.src = hey;
    img.onload = function(){
		ctx.drawImage(this, 0, 0, 550, 550);
		saveState(canvas);//Guardamos el estado para no obtener una palabra nulla
	};
  }
  if (file) {
    reader.readAsDataURL(file);
  } else {
    preview.src = "";
  }
}
//Funcion para volver al canvas una imagen seleccionada del carrusel de postales:
function carga_img(img, img2, ctx, canvas) {
	var tapiz = document.getElementById("tapize").checked = true;
	var hey = $('#atras').attr('src');
	undoList = [];
	img.src = hey;
	img.onload = function(){
		ctx.drawImage(this, 0, 0, 550, 435);
	};
	img2.src = "js/papel.png";
	img2.onload = function(){
		ctx.drawImage(this, -5, 428, 565, 130);
		saveState(canvas);
	};
}