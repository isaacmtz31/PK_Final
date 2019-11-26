<?php
$selectMayor = "select edad,count(edad) as numero from usuario group by edad order by numero desc limit 1";
$selectTotal ="select count(idUsuario) as numero from usuario";
$resultadoMayor = mysqli_query($conexion,$selectMayor);
$resultadoTotal = mysqli_query($conexion,$selectTotal);
$row = mysqli_fetch_object($resultadoMayor);
$rew = mysqli_fetch_object($resultadoTotal);
echo "<p class='text-left'>".$row->numero." Usuarios tienen ".$row->edad." años de edad, de un total de ".$rew->numero."</p>";
?>
