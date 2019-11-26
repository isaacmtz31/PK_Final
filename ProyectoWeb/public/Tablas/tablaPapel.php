<thead class="">
<tr>
  <th scope="col">#</th>
  <th scope="col">Nombre</th>
  <th scope="col">Imagen</th>
  <th scope="col">Categoria</th>
  <th>Accion</th>
</tr>
</thead>
<tbody >
<?php
$conexion = mysqli_connect("localhost","root","","Postales");
$conexion->set_charset("utf8");
$query = "select papel.idPapel as papelId,nombreCategoria,img,nombrePapel,categorias.idCategoria as categoriaId from papel,categorias,papelcategoria where papel.idPapel = papelcategoria.idPapel and categorias.idCategoria = papelcategoria.idCategoria";

$resultado = mysqli_query($conexion,$query);

while($row = mysqli_fetch_object($resultado)){
  echo "<tr>
        <th scope='row'>$row->papelId</th>
        <td>$row->nombrePapel</td>
        <td>$row->img</td>
        <td>$row->nombreCategoria</td>
        <td><a href='#'><i style='color:#ffc107;' onclick='editarPapel($row->papelId,$row->categoriaId)' class='fas fa-edit'></i></a> | <a href='#'><i style='color:#ffc107;' onclick='eliminarPapel($row->papelId,$row->categoriaId)' class='fas fa-user-times'></i></a></td>
        </tr>
";
}

$conexion->close();

?>
</tbody>
