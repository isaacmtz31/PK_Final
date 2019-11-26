<?php
    include("./../BD/configBD.php");
    $sqlInfCategorias = "select * from explorarCategorias";
    $resInfUser = mysqli_query($conexion, $sqlInfCategorias);
    $categorias="";
    while ($row = mysqli_fetch_array($resInfUser, MYSQLI_BOTH))
    {
      $categorias .= "<li id='busqueda'>" . "<a href=# data-value='" . $row["Categorias"]. "'>" . "<img src=" . $row["imagen"] . " alt='dumy'><h3>" . $row["Categorias"] . "</h3></a></li>";
    }
    $papeles="";
    $sqlInfPapeles = "select * from explorarPapeles";
    $resInfUser = mysqli_query($conexion, $sqlInfPapeles);
    while ($row = mysqli_fetch_array($resInfUser, MYSQLI_BOTH))
    {
      $papeles .= "<li>" . "<a href='./enviarPostal.php?IM=" .$row["Papeles"]. "' data-value='" . $row["Papeles"]. "'><img src=" . $row["img"] . " alt='dumy'><h3>" . $row["Papeles"] . "</h3></a></li>";      
    }
 ?>
