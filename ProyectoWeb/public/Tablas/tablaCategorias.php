<thead class="">
<tr>
  <th scope="col">#</th>
  <th scope="col">Nombre</th>
  <th scope="col">Imagen</th>
  <th>Accion</th>
</tr>
</thead>
<tbody >
<?php
$conexion = mysqli_connect("localhost","root","","Postales");
$conexion->set_charset("utf8");
$query = "select * from categorias";

$resultado = mysqli_query($conexion,$query);

while($row = mysqli_fetch_object($resultado)){
  echo "<tr>
        <th scope='row'>$row->idCategoria</th>
        <td>$row->nombreCategoria</td>
        <td>$row->imagen</td>
        <td><a href='#'><i style='color:#ffc107;' onclick='editarCategoria($row->idCategoria)' class='fas fa-edit'></i></a> | <a href='#'><i style='color:#ffc107;' onclick='eliminarCategoria($row->idCategoria)' class='fas fa-user-times'></i></a></td>
        </tr>
";
}

$conexion->close();

 ?>
