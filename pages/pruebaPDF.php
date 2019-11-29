<?php
  include("./mpdf60/mpdf.php");
  global $test;
  $test = $_GET["var"];
  echo $test;
  date_default_timezone_set('America/Mexico_City');
  setlocale(LC_TIME, 'es_MX.UTF-8');
  $fecha_actual=strftime("%d-%m-%Y");
  $hora_actual=strftime("%H:%M:%S");
  $imgKarte;

  function selectTabla(){
      $con = new mysqli("localhost", "root", "","Postales");
      $selectDatos = "select * from karte where nombreK = '$test'";
      $result = $con->query($selectDatos);

      $tabla = "";
      $tabla1 =  "<div><table>
                  <tr class='PdfF'>
                  <th class='PdfF'>Nombre de la postal</th>
                  <th class='PdfF'>Descripcion de la postal</th>
                  <th class='PdfF'>Estatus de la postal</th>
                  <th class='PdfF'>idPapel</th>
                  </tr></div>
";
while($fila = mysqli_fetch_assoc($result)){
  //$imgKarte .= $imgKarte .  "<div class='imgF'><img src=" . $fila['rutaK'] . "></div>";
  if($fila['estatus'] == 'V')
  {
    $tabla1 .= "<tr>
                <td class='Pdf'>".$fila['nombreK']."</td>
                <td class='Pdf'> ".$fila['descripcion']." </td>
                <td class='Pdf'> "."Vista"." </td>
                <td class='Pdf'> <img width='250px' src='".$fila['rutaK']."'></td>
                </tr>";
  }else {
    $tabla1 .= "<tr>
                <td class='Pdf'>".$fila['nombreK']."</td>
                <td class='Pdf'> ".$fila['descripcion']." </td>
                <td class='Pdf'> "."Pendiente"." </td>
                <td class='Pdf'> <img width='250px' src='".$fila['rutaK']."'></td>
                </tr>";
  }
}
$tabla1.="</table>";
      return $tabla1;
  }

  $html = '<header>
            <center><div><center><img width="100px" src="./../imgs/postKarteb.png"><span>PostKarte.com</span></center></div></center>
          </header>
      ';
  $html .= "<h3> Enviado: &nbsp; Dia &nbsp; $fecha_actual &nbsp;&nbsp;&nbsp;  Hora  $hora_actual </h3>";
  $html .= "<h1> Datos de envio de *$test*</h1>";
  $html .= selectTabla();
  $html .= "";
  $html .=  "";//"<div class = 'imgF'>" . $imgKarte ."</div>";
  $css = file_get_contents('./../css/misEstilos.css');
  $pie = "";
  $pie .= "
";

  $pdf=new mPDF("c","Letter-l","12","",15,15, 5,15,15,5);
  $pdf->WriteHTML($css,1);
  $pdf->WriteHTML($html);
  $pdf->SetHTMLFooter($pie);
  $pdf->OutPut();
  exit;
  echo $email;
 ?>
