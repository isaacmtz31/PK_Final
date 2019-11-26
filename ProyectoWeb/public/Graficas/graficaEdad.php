<?php
$selectEdad = "select edad,count(edad) as numero from usuario group by edad";
$resultado = mysqli_query($conexion,$selectEdad);
while($row=mysqli_fetch_object($resultado)){
  echo "['".$row->edad." Años',". $row->numero."],";
}
?>
