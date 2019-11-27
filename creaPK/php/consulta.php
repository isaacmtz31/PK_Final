<?php
include 'conex.php';

/////////   VALORES INICIALES ///////
$img="";
$query = "SELECT * FROM categorias WHERE nombreCategoria='Paisajes'";

//////// LEYENDO LA CONSULTA DE AJAX.JS(modificando la consulta) /////////////
if (isset($_POST['categorias'])) {// tendra que ser el nombre de la tabla a la que nos comunicaremos y es igual que la del ajax.js
	//$q = utf8_encode($_POST['categorias']);
	$q=$conexion->real_escape_string($_POST['categorias']);
	$query = "SELECT * FROM categorias WHERE
		nombreCategoria='".$q."'";
}
$img.=
	'<div class="carousel">';//Esto se hace para poder usar materialize
$re = mysqli_query($conexion, $query);

while($f = mysqli_fetch_array($re)){

	$img.=
		'<a href="#form_envio" class="carousel-item ir"><div class="franja"><p>USAR</p></div><img src="'.$f['imagen'].'" class="lol"></a>';

}
$img.=
	'</div>';
echo $img;
?>
