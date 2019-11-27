








<?php
$selectCategorias = "select nombreCategoria,count(categorias.idCategoria) as numero from categorias,papel,papelcategoria where categorias.idCategoria = papelcategoria.idCategoria and papel.idPapel = papelcategoria.idPapel group by categorias.idCategoria order by numero desc limit 1";
$resultado = mysqli_query($conexion,$selectCategorias);
$row=mysqli_fetch_object($resultado);
echo "<p class='text-left'>La categoria mas popular es: ".$row->nombreCategoria."</p>";

?>
