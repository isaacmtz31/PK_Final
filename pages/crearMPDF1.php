<?php

    include("./mpdf60/mpdf.php");
    date_default_timezone_set('America/Mexico_City');
    setlocale(LC_TIME, 'es_MX.UTF-8');
    $fecha_actual=strftime("%d-%m-%Y");
    $hora_actual=strftime("%H:%M:%S");

    function selectTabla1(){
      $conexion = new mysqli("localhost", "root", "","Postales");
        $selectEdad = "select edad,count(edad) as numero from usuario group by edad";
        $queryEdad = mysqli_query($conexion,$selectEdad);
        $tabla1 = "";
        $tabla1 = "<h4>Edad de los Usuarios</h4>";
        $tabla1 .=  "<div><table>
                    <tr>
                    <th>Edad</th>
                    <th>Numero</th>
                    </tr></div>
  ";
    while($fila = mysqli_fetch_assoc($queryEdad)){
        $tabla1 .= "<tr>
                    <td>".$fila['edad']."</td>
                    <td>".$fila['numero']."</td>
                    </tr>";
    $tabla1.="</table>";
        return $tabla1;
    }
  }

  function selectTabla2(){
    $conexion = new mysqli("localhost", "root", "","Postales");
      $selectMasculino = "select count(idUsuario) as conteo from usuario where genero like '%Masculino%'";
      $resultadoMasculino = mysqli_query($conexion,$selectMasculino);
      $row=mysqli_fetch_object($resultadoMasculino);
      $selectFemenino = "select count(idUsuario) as conteo from usuario where genero like '%Femenino%'";
      $resultadoFemenino = mysqli_query($conexion,$selectFemenino);
      $rew = mysqli_fetch_object($resultadoFemenino);
      $tabla2 = "";
      $tabla2 .= "<h4>Genero de los Usuarios</h4>";
      $tabla2 .=  "<div><table>
                  <tr>
                  <th>Genero</th>
                  <th>Numero</th>
                  </tr></div>
";
      $tabla2 .= "<tr>
                  <td>Masculino</td>
                  <td>".$row->conteo."</td>
                  </tr>
                  <tr>
                  <td>Femenino</td>
                  <td>".$rew->conteo."</td>
                  </tr>";


    $tabla2.="</table>";
        return $tabla2;
    }
    function selectTabla3(){
      $conexion = new mysqli("localhost", "root", "","Postales");
      $selectCategorias = "select nombreCategoria,count(categorias.idCategoria) as numero from categorias,papel,papelcategoria where categorias.idCategoria = papelcategoria.idCategoria and papel.idPapel = papelcategoria.idPapel group by categorias.idCategoria;";
        $resultado = mysqli_query($conexion,$selectCategorias);
      ;

        $tabla3 = "";
        $tabla3 .= "<h4>Numero de Papeles en cada Categoria</h4>";
        $tabla3 .=  "<div><table>
                    <tr>
                    <th>Categoria</th>
                    <th>Numero</th>
                    </tr></div>
  ";
    while($row=mysqli_fetch_object($resultado)){
        $tabla3 .= "<tr>
                    <td>".$row->nombreCategoria."</td>
                    <td>".$row->numero."</td>
                    </tr>";
    }
    $tabla3.="</table>";
        return $tabla3;
    }

    function selectTabla4(){
      $conexion = new mysqli("localhost", "root", "","Postales");
        $selectPapel = "select nombrePapel,count(papel.idPapel) as numero from karte,papel where karte.idPapel = papel.idPapel group by (papel.idPapel)";
        $resultado = mysqli_query($conexion,$selectPapel);

        $tabla4 = "";
        $tabla4 .= "<h4>Numero de Karte's por cada Papel</h4>";
        $tabla4 .=  "<div><table>
                    <tr>
                    <th>Papel</th>
                    <th>Numero de karte's por Papel</th>
                    </tr></div>
  ";
        while ($row=mysqli_fetch_object($resultado)) {
          $tabla4 .= "<tr>
          <td>".$row->nombrePapel."</td>
          <td>".$row->numero."</td>
          </tr>";
        }
    $tabla4.="</table>";
        return $tabla4;
    }
    function selectTabla5(){
      $conexion = new mysqli("localhost", "root", "","Postales");
        $selectVistos = "select count(estatus) as numero from karte where estatus like 'P'";
        $resultadoVistos = mysqli_query($conexion,$selectVistos);
        $row=mysqli_fetch_object($resultadoVistos);
        $selectNoVistos = "select count(estatus) as numero from karte where estatus like 'V'";
        $resultadoNoVistos = mysqli_query($conexion,$selectNoVistos);
        $rew = mysqli_fetch_object($resultadoNoVistos);
        $Vistos = "Vistos";
        $NoVistos="No vistos";
        $tabla5 = "";
        $tabla5 = "<h4>Estatus de las Karte's</h4>";
        $tabla5 .=  "<div><table>
                    <tr>
                    <th>Estatus</th>
                    <th>Numero de karte's</th>
                    </tr></div>
  ";
        $tabla5 .= "<tr>
                    <td>".$Vistos."</td>
                    <td>".$rew->numero."</td>
                    </tr>
                    <tr>
                    <td>".$NoVistos."</td>
                    <td>".$row->numero."</td>
                    </tr>";
    $tabla5.="</table>";
        return $tabla5;
  }
    $header = "";
        $header .= "<p align='center'><strong>JAOR</strong></p>";

    $html = '<header>
                <div><img src="./../imgs/postKarteb.png" width = "100px" height = "100px"></div>
            </header>
        ';
    $html .= " Enviado:<br> Dia: &nbsp; $fecha_actual &nbsp;&nbsp;&nbsp;  Hora  $hora_actual ";
    $html .= selectTabla1();
    $html .= selectTabla2();
    $html .= selectTabla3();
    $html .= selectTabla4();
    $html .= selectTabla5();
    $html = mb_convert_encoding($html, 'UTF-8', 'UTF-8');
    $css = file_get_contents('./../css/misEstilos.css');
    $pie = "";
    $pie .= "<footer>
    <footer class='page-footer'>
      <div class='footer-bajo'>
        <div class='container'>© 2019 Copyright POSTKARTE</div>
      </div>
    </footer>
  </footer>";
    $pdf = new mPDF('c');
    $pdf->WriteHTML($css,1);
    $pdf->WriteHTML($html);
    $pdf->SetHTMLFooter($pie);
    $pdf->OutPut();
    exit;
?>
