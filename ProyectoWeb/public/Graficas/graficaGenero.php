<?php
$selectMasculino = "select count(idUsuario) as conteo from usuario where genero like '%Masculino%'";
$resultadoMasculino = mysqli_query($conexion,$selectMasculino);
$row=mysqli_fetch_object($resultadoMasculino);
$selectFemenino = "select count(idUsuario) as conteo from usuario where genero like '%Femenino%'";
$resultadoFemenino = mysqli_query($conexion,$selectFemenino);
$rew = mysqli_fetch_object($resultadoFemenino);
$Masculino = "Masculino";
$Femenino="Fememnino";
echo "['".$Masculino."',".$row->conteo."],
['".$Femenino."',".$rew->conteo."]";
?>
