<?php

    include("./mpdf60/mpdf.php");
    
    date_default_timezone_set('America/Mexico_City');
    setlocale(LC_TIME, 'es_MX.UTF-8');
    $fecha_actual=strftime("%d-%m-%Y");
    $hora_actual=strftime("%H:%M:%S");

    function selectTabla(){
        $con = new mysqli("localhost", "root", "","Postales");
        $selectDatos = "select * from usuario";
        $queryDatos = mysqli_query($con,$selectDatos);
        $tabla = "";
        $tabla1 =  "<div><table>
                    <tr class='PdfF'>
                    <th class='PdfF'>Nombre</th>
                    <th class='PdfF'>Apellido</th>
                    <th class='PdfF'>email</th>
                    <th class='PdfF'>Genero</th>
                    </tr></div>
  ";
  while($fila = mysqli_fetch_assoc($queryDatos)){
    $tabla1 .= "<tr>
                <td class='Pdf'>".$fila['nombreUsuario']."</td>
                <td class='Pdf'> ".$fila['apellidoUsuario']." </td>
                <td class='Pdf'> ".$fila['email']." </td>
                <td class='Pdf'> ".$fila['genero']."</td>
                </tr>";
  }
  $tabla1.="</table>";
        return $tabla1;
    }
    $html = '<header>
                <div><img src="./../imgs/logo.png"></div>
            </header>
        ';
    $html .= "<h3> Enviado: &nbsp; Dia &nbsp; $fecha_actual &nbsp;&nbsp;&nbsp;  Hora  $hora_actual </h3>";
    $html .= "<h1> Datos de envio </h1>";
    $html .= selectTabla();
    $html .= "<h1> Imagen enviada </h1>";
    $html .=  '<div class = "imgF"><img src="./../imgs/logo.png"></div>';
    $css = file_get_contents('./../css/misEstilos.css');
    $pie = "";
    $pie .= "<footer>
    <footer class='page-footer'>
      <div class='footer-bajo'>
        <div class='container'>© 2019 Copyright POSTKARTE</div>
      </div>
    </footer>
  </footer>";
    $pdf=new mPDF("c","Letter","12","",15,15, 5,15,15,5);
    $pdf->WriteHTML($css,1);
    $pdf->WriteHTML($html);
    $pdf->SetHTMLFooter($pie);
    $pdf->OutPut();
    exit;
?>
