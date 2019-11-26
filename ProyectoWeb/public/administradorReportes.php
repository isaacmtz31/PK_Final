<?php
$conexion = mysqli_connect("localhost","root","","Postales");
$conexion->set_charset("utf8");
?>
<html lang="en">
  <head>
    <title>User Information and Form</title>

   <!--JQUERY-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

 <!-- FRAMEWORK BOOTSTRAP para el estilo de la pagina-->
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
   <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
   <!-- <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.4.1.min.js"> -->
   </script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js">
   </script>

   <!-- Los iconos tipo Solid de Fontawesome-->
   <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/solid.css">
   <script src="https://use.fontawesome.com/releases/v5.0.7/js/all.js"></script>

   <!-- Nuestro css-->
   <link rel="stylesheet" type="text/css" href="../css/administrator.css">
   <!-- DATA TABLE -->
   <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
   <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.1/css/bootstrap.css">
   <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
   <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
   <script type="text/javascript">
     google.charts.load('current', {'packages':['corechart']});
     google.charts.setOnLoadCallback(drawChart);

     function drawChart() {
       drawVistos();
       drawGenero();
       drawEdad();
       drawCategorias();
       drawPapel();
     }
     function drawGenero(){
       var data = google.visualization.arrayToDataTable([
         ['Genero','Numero de Usuarios'],
         <?php
           include("Graficas/graficaGenero.php");
         ?>
       ]);
       var options = {

         is3D: true,
         backgroundColor : '#d1d3d6'
       };
       var chart = new google.visualization.PieChart(document.getElementById('graficaGenero'));
       chart.draw(data, options);
     }
     function drawEdad(){
       var data = google.visualization.arrayToDataTable([
         ['Edad','numero'],
         <?php
           include("Graficas/graficaEdad.php");
         ?>
         ["0 Años",0]
       ]);
       var options = {
         is3D: true,
         backgroundColor : '#d1d3d6'
       };
       var chart = new google.visualization.PieChart(document.getElementById('graficaEdad'));
       chart.draw(data, options);
     }
     function drawCategorias(){
       var data = google.visualization.arrayToDataTable([
         ['Categorias','numero'],
         <?php
           include("Graficas/graficaCategorias.php");
         ?>
         ["0 Categorias",0]
       ]);
       var options = {
         is3D: true,
         backgroundColor : '#d1d3d6'
       };
       var chart = new google.visualization.PieChart(document.getElementById('graficaCategorias'));
       chart.draw(data, options);
     }
     function drawPapel(){
       var data = google.visualization.arrayToDataTable([
         ['Papel','numero'],
         <?php
           include("Graficas/graficaPapel.php");
         ?>
         ["0 Papel",0]
       ]);
       var options = {

         is3D: true,
         backgroundColor : '#d1d3d6'
       };
       var chart = new google.visualization.PieChart(document.getElementById('graficaPapel'));
       chart.draw(data, options);
     }
     function drawVistos(){
       var data = google.visualization.arrayToDataTable([
         ['Estatus','numero']
         <?php
           include("Graficas/graficaVistos.php");
         ?>
       ]);
       var options = {

         is3D: true,
         backgroundColor : '#d1d3d6'
       };
       var chart = new google.visualization.PieChart(document.getElementById('graficaVisto'));
       chart.draw(data, options);
     }

   </script>
  </head>
  <body>
    <div class="container">
  		<div class="mx-auto col-xs-12 col-lg-8 main-section" id="myTab" role="tablist">
  			<ul class="nav nav-tabs justify-content-center">
          <a class="btn bg-warning text-light " href="http://localhost:8080/ProyectoWeb/public/administrator.php" id="Reportes" >Reportes</a>

    			<li class="nav-item">
      			<a class="nav-link active text-secondary " id="graficas-tab" data-toggle="tab" href="#graficas" role="tab" aria-controls="graficas" aria-selected="false">Graficas</a>
          </li>
          <li class="nav-item">
      			<a class="nav-link text-secondary" id="estatus-tab" data-toggle="tab" href="#estatus" role="tab" aria-controls="estatus" aria-selected="true">Detalle de Karte's</a>
          </li>

          <a class="btn btn-warning " id="CerrarSesion" >Cerrar Sesion</a>
        </ul>
    		<div class="tab-content" id="myTabContent">
    			<div class="tab-pane fade show active" id="graficas" role="tabpanel" aria-labelledby="graficas-tab">
            <div class="card">
              <div class="card-header">
                <h4>Graficas</h4>
              </div>
              <div class="card-body justify-content-center">
                  <h4>Edad de los Usuarios</h4>
                  <br>
                  <?php
                  include("Graficas/edadUsuarios.php");
                  ?>
                  <div class="mx auto col-lg-8 main-section" id="graficaEdad" style="width: 450px; height: 250px;">

                  </div>
                  <hr>
                  <h4>Genero de los Usuarios</h4>
                  <br>
                  <?php
                  include("Graficas/generoMayoritario.php");
                  ?>
                  <div class="mx auto col-lg-8 main-section" id="graficaGenero" style="width: 450px; height: 250px;">

                  </div>

                  <hr>
                  <h4>Categorias Usadas</h4>
                  <br>
                  <?php
                  include("Graficas/categoriasPopulares.php")
                  ?>
                  <div class="mx auto col-lg-8 main-section" id="graficaCategorias" style="width: 450px; height: 250px;">

                  </div>
                  <hr>
                  <h4>Papeles más Usados</h4>
                  <br>
                  <?php
                  include("Graficas/papelesPopulares.php");
                  ?>
                  <div class="mx auto col-lg-8 main-section" id="graficaPapel" style="width: 450px; height: 250px;">

                  </div>
                  <hr>
                  <h4>Estatus de Postales</h4>
                  <br>
                  <?php
                  include("Graficas/estatus.php");
                  ?>
                  <div class="mx auto col-lg-8 main-section" id="graficaVisto" style="width: 450px; height: 250px;display:block;">

                  </div>
              </div>
            </div>
          </div>
          <div class="tab-pane fade" id="estatus" role="tabpanel" aria-labelledby="estatus-tab">
            <div class="card">
              <div class="card-header">
                <h4>Estatus de Postales</h4>
              </div>

              <div class="card-body justify-content-center">
                <h4>Karte's</h4>
                <br>
                <div class="table-responsive">
                  <table id="karte2list" class="table table-bordered table-hover table-striped table-dark">
                    <?php
                    include("Tablas/tablaKarte2.php");?>
                  </table>
                </div>
            </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>
