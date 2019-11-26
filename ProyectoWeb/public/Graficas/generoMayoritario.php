<?php
$selectMasculino = "select count(idUsuario) as conteo from usuario where genero like '%Masculino%'";
$resultadoMasculino = mysqli_query($conexion,$selectMasculino);
$row=mysqli_fetch_object($resultadoMasculino);
$selectFemenino = "select count(idUsuario) as conteo from usuario where genero like '%Femenino%'";
$resultadoFemenino = mysqli_query($conexion,$selectFemenino);
$rew = mysqli_fetch_object($resultadoFemenino);
if($row->conteo > $rew->conteo)
  echo "<p class='text-left'>Existen mas usuarios Masculinos que Femeninos</p>";
else if($row->conteo > $rew->conteo)
  echo "<p class='text-left'>Existen mas usarios Femeninos que Masculinos</p>";
else
  "<p class='text-left'>El numero de usuarios Masculinos y Femeninos es igual</p>";
?>
