<thead class="">
<tr>
  <th scope="col">#</th>
  <th scope="col">Nombre</th>
  <th scope="col">Descripcion</th>
  <th scope="col">Ruta</th>
  <th scope="col">Categoria</th>
  <th scope="col">Estatus</th>
</tr>
</thead>
<tbody >
<?php
$conexion = mysqli_connect("localhost","root","","Postales");
$conexion->set_charset("utf8");
$query = "select idKarte,nombreK,descripcion,rutaK,nombrePapel,estatus from karte,papel where karte.idPapel = papel.idPapel";

$resultado = mysqli_query($conexion,$query);

while($row = mysqli_fetch_object($resultado)){
  echo "<tr>
        <th scope='row'>$row->idKarte</th>
        <td>$row->nombreK</td>
        <td>$row->descripcion</td>
        <td>$row->rutaK</td>
        <td>$row->nombrePapel</td>
        <td>$row->estatus</td>
        </tr>
";
}

 ?>
 </tbody>
