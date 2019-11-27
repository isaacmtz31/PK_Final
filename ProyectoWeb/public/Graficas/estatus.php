<?php
$selectPendiente = "select count(estatus) as numero from karte where estatus like 'P'";
$resultadoPendiente = mysqli_query($conexion,$selectPendiente);
$selectEstatus = "select count(estatus) as numero from karte";
$resultadoEstatus = mysqli_query($conexion,$selectEstatus);
$row=mysqli_fetch_object($resultadoPendiente);
$rew = mysqli_fetch_object($resultadoEstatus);
echo "<p class='text-left'>Existen ".$row->numero." karte's sin ser leidas de un total de ".$rew->numero."</p>";
?>
