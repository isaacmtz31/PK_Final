<?php
$selectVistos = "select count(estatus) as numero from karte where estatus like 'P'";
$resultadoVistos = mysqli_query($conexion,$selectVistos);
$row=mysqli_fetch_object($resultadoVistos);
$selectNoVistos = "select count(estatus) as numero from karte where estatus like 'V'";
$resultadoNoVistos = mysqli_query($conexion,$selectNoVistos);
$rew = mysqli_fetch_object($resultadoNoVistos);
$Vistos = "Vistos";
$NoVistos="No vistos";
echo ",['".$Vistos."',".$rew->numero."],['".$NoVistos."',".$row->numero."]";
?>
