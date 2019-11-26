
<?php
$selectPapel = "select nombrePapel,count(papel.idPapel) as numero from karte,papel where karte.idPapel = papel.idPapel group by (papel.idPapel) order by numero desc limit 1";
$resultado = mysqli_query($conexion,$selectPapel);
$row=mysqli_fetch_object($resultado);
  echo "<p class='text-left'>El papel mas popular es: ".$row->nombrePapel."</p>";

?>
