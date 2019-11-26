<?php
$selectCategorias = "select nombreCategoria,count(categorias.idCategoria) as numero from categorias,papel,papelcategoria where categorias.idCategoria = papelcategoria.idCategoria and papel.idPapel = papelcategoria.idPapel group by categorias.idCategoria;";
$resultado = mysqli_query($conexion,$selectCategorias);
while($row=mysqli_fetch_object($resultado)){
  echo "['".$row->nombreCategoria."',". $row->numero."],";
}
?>
