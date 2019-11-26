<?php
    include("./../BD/configBD.php");
    include("./../BD/getPosts.php");
    $test = $_POST['test'];

    $sqlInfCategorias = "call obtenerCategoriasTitulo('$test')";
    $resInfUser = mysqli_query($conexion, $sqlInfCategorias);
    $categorias="";
    $prueba="";

    while ($row = mysqli_fetch_array($resInfUser, MYSQLI_BOTH))
    {
      $categorias .= "<li id='busqueda'>" . "<a href='./enviarPostal.php?IM=". $row["Nombre"]. "' data-value='" . $row["Nombre"]. "'>" . "<img src=" . $row["Imagen"] . " alt='dumy'><h3>" . $row["Nombre"] . "</h3></a></li>";

    }

    $prueba =
    "<div class=''>
      <section class='grid-wrap'>
        <ul class='grid swipe-right' id='grid'>
          <li class='title-box'>
            <h2>Papeles de <a href='#'>".$test."</a></h2>
          </li>" . $categorias .
        "</ul>
      </section>
    </div>";
    echo json_encode($prueba);
?>
