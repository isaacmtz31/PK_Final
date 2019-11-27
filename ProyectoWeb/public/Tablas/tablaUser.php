<thead class="">
<tr>
  <th scope="col">#</th>
  <th scope="col">Nombre</th>
  <th scope="col">Apellido</th>
  <th scope="col">Genero</th>
  <th scope="col">E-mail</th>
  <th scope="col">Edad</th>
  <th scope="col">Foto de Perfil</th>
  <th scope="col">Fecha de Registro</th>
  <th>Accion</th>
</tr>
</thead>
<tbody >
<?php
$conexion = mysqli_connect("localhost","root","","Postales");
$conexion->set_charset("utf8");
$query = "select * from usuario";

$resultado = mysqli_query($conexion,$query);
$conexion->set_charset("utf8");
while($row = mysqli_fetch_object($resultado)){
  echo "<tr>
        <th scope='row'>$row->idUsuario</th>
        <td>$row->nombreUsuario</td>
        <td>$row->apellidoUsuario</td>
        <td>$row->genero</td>
        <td>$row->email</td>
        <td>$row->edad</td>
        <td>$row->fotoPerfil</td>
        <td>$row->fechaRegistro</td>
        <td><a href='#'><i style='color:#ffc107;' onclick='editarUsuario($row->idUsuario)' class='fas fa-edit'></i></a> | <a href='#'><i style='color:#ffc107;' onclick='eliminarUsuario($row->idUsuario)' class='fas fa-user-times'></i></a></td>
        </tr>
";
}


$conexion->close();
 ?>
