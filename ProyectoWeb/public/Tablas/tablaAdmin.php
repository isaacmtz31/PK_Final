<thead class="">
<tr>
  <th scope="col">#</th>
  <th scope="col">Nombre</th>
  <th>Accion</th>
</tr>
</thead>
<tbody >
<?php
$conexion = mysqli_connect("localhost","root","","Postales");
$conexion->set_charset("utf8");
$query = "select * from admini";

$resultado = mysqli_query($conexion,$query);

while($row = mysqli_fetch_object($resultado)){
  echo "<tr>
        <th scope='row'>$row->idAdmin</th>
        <td>$row->email</td>
        <td><a href='#'><i style='color:#ffc107;' onclick='editarAdministrador($row->idAdmin)' class='fas fa-edit'></i></a> | <a href='#'><i style='color:#ffc107;' onclick='eliminarAdministrador($row->idAdmin)' class='fas fa-user-times'></i></a></td>
        </tr>
";
}


$conexion->close();
?>
