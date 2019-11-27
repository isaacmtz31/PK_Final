<thead class="">
<tr>
  <th scope="col">#</th>
  <th scope="col">Nombre de Karte</th>
  <th scope="col">Remitente</th>
  <th scope="col">Destinatario</th>
  <th scope="col">Fecha de Envio</th>
    <th>Accion</th>
</tr>
</thead>
<tbody >
<?php
$conexion = mysqli_connect("localhost","root","","Postales");
$conexion->set_charset("utf8");
$query1 = "select * from relUsuarioKarte,karte,usuario where relUsuarioKarte.idKarte = karte.idKarte and usuario.idUsuario = relUsuarioKarte.idRemitente";
$resultado1 = mysqli_query($conexion,$query1);
while($row = mysqli_fetch_object($resultado1)){
  $query2 ="select nombreUsuario from relUsuarioKarte,karte,usuario where relUsuarioKarte.idKarte = karte.idKarte and usuario.idUsuario = relUsuarioKarte.idDestinatario limit 1";
  $resultado2 = mysqli_query($conexion,$query2);
  $row2 = mysqli_fetch_object($resultado2);
  echo "<tr>
        <th scope='row'>$row->idEnviados</th>
        <td>$row->nombreK</td>
        <td>$row->nombreUsuario</td>
        <td>$row2->nombreUsuario</td>
        <td>$row->fechaEnvio</td>
        <td><a href='#'><i style='color:#ffc107;' onclick='eliminarEnviados($row->idUsuario)' class='fas fa-user-times'></i></a></td>
        </tr>
";
}
$conexion->close();
 ?>
