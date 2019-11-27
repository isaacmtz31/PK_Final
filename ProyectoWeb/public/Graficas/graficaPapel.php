<?php
$selectPapel = "select nombrePapel,count(papel.idPapel) as numero from karte,papel where karte.idPapel = papel.idPapel group by (papel.idPapel)";
$resultado = mysqli_query($conexion,$selectPapel);
while($row=mysqli_fetch_object($resultado)){
  echo "['".$row->nombrePapel."',". $row->numero."],";
}
?>
