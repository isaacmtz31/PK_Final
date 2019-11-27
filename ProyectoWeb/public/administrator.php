<?php
session_start();
$varCorreo = $_SESSION['Correo'];
$varAdministrador = $_SESSION['Administrador'];
if(($varCorreo == null || $varCorreo == '') and ( $varAdministrador == null || $varAdministrador == '')){
  echo 'Usted no tiene Autorizacion';
  header("Location:http://localhost:8080/ProyectoWeb/index.php");
}
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

  <!-- CRUD CARDS -->
  <script src="../js/CRUD/userCRUD.js" charset="utf-8"></script>
  <script src="../js/CRUD/adminCRUD.js" charset="utf-8"></script>
  <script src="../js/CRUD/categoriasCRUD.js" charset="utf-8"></script>
  <script src="../js/CRUD/papelCRUD.js" charset="utf-8"></script>
  <script src="../js/CRUD/karteCRUD.js" charset="utf-8"></script>
  <script src="../js/CRUD/enviadosCRUD.js" charset="utf-8"></script>
 	<script type="text/javascript">

 		$(document).ready(function() {
 			//Asegurate que el id que le diste a la tabla sea igual al texto despues del simbolo #
 			$('#userList').DataTable();
      $('#adminList').DataTable();
      $('#categoriasList').DataTable();
      $('#userList').DataTable();
      $('#papelList').DataTable();
      $('#karteList').DataTable();
      $('#enviadosList').DataTable();
 		});
 	</script>
</head>
<body>

  <div class="container">
		<div class="mx-auto col-xs-12 col-lg-12 main-section" id="myTab" role="tablist">
			<ul class="nav nav-tabs justify-content-center">
        <a class="btn bg-warning text-light " href="http://localhost:8080/ProyectoWeb/public/administradorReportes.php" id="Reportes" >Reportes</a>

  			<li class="nav-item">
    			<a class="nav-link active text-secondary " id="user-tab" data-toggle="tab" href="#user" role="tab" aria-controls="user" aria-selected="false">Usuarios</a>
        </li>
        <li class="nav-item">
    			<a class="nav-link text-secondary" id="admin-tab" data-toggle="tab" href="#admin" role="tab" aria-controls="admin" aria-selected="true">Administracion</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-secondary" id="categorias-tab" data-toggle="tab" href="#categorias" role="tab" aria-controls="categorias" aria-selected="true">Categorias</a>
        </li>
        <li class="nav-item">
    			<a class="nav-link text-secondary" id="papel-tab" data-toggle="tab" href="#papel" role="tab" aria-controls="papel" aria-selected="true">Papel Tapiz</a>
        </li>
        <li class="nav-item">
    			<a class="nav-link text-secondary" id="karte-tab" data-toggle="tab" href="#karte" role="tab" aria-controls="karte" aria-selected="true">Karte's</a>
        </li>
        <li class="nav-item">
    			<a class="nav-link text-secondary" id="enviados-tab" data-toggle="tab" href="#enviados" role="tab" aria-controls="enviados" aria-selected="true">Enviados</a>
        </li>
        <li class="nav-item">
    			<a class="nav-link text-secondary" id="form-tab" data-toggle="tab" href="#form" role="tab" aria-controls="form" aria-selected="true">Formulario</a>
        </li>
        <a class="btn btn-warning " id="CerrarSesion" >Cerrar Sesion</a>
      </ul>
  		<div class="tab-content" id="myTabContent">
  			<div class="tab-pane fade show active" id="user" role="tabpanel" aria-labelledby="user-tab">
          <div class="card">
            <div class="card-header">
              <h4>Usuarios</h4>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table id="userList" class="table table-bordered table-hover table-striped table-dark">
                  <!-- tabla de Usuarios -->
                  <?php
                    include('Tablas/tablaUser.php');
                  ?>
                </tbody>
  							</table>
              </div>

            </div>
        </div>

      </div>

      <div class="tab-pane fade" id="admin" role="tabpanel" aria-labelledby="admin-tab">
        <div class="card">
          <div class="card-header">
            <h4>Administradores</h4>
          </div>
          <div class="card-body">
            <?php
              include("Formularios/formularioAdministrador.php")
             ?>
          </div>
          <div class="card-footer">

            <div class="table-responsive">
              <table id="adminList" class="table table-bordered table-hover table-striped table-dark">
                <!-- tabla de Adminostradores -->
                <?php
                  include('Tablas/tablaAdmin.php');
                ?>
              </tbody>
              </table>
            </div>

          </div>
      </div>

    </div>

      <div class="tab-pane fade" id="categorias" role="tabpanel" aria-labelledby="categorias-tab">
        <div class="card">
          <div class="card-header">
            <h4>Categorias</h4>
          </div>
          <div class="card-body">
            <?php
            include("Formularios/formularioCategorias.php");
            ?>
          </div>
          <div class="card-footer">
            <div class="table-responsive">
              <table id="categoriasList" class="table table-bordered table-hover table-striped table-dark">
                <?php
                  include('Tablas/tablaCategorias.php');
                 ?>
               </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
      <div class="tab-pane fade" id="papel" role="tabpanel" aria-labelledby="papel-tab">
        <div class="card">
          <div class="card-header">
            <h4>Papel</h4>
          </div>
          <div class="card-body">
            <?php
            include("Formularios/formularioPapel.php");
             ?>
          </div>
          <div class="card-footer">
            <div class="table-responsive">
              <table id="papelList" class="table table-bordered table-hover table-striped table-dark">
                <?php
                  include('Tablas/tablaPapel.php');
                 ?>
              </table>
            </div>
          </div>
        </div>
      </div>
      <div class="tab-pane fade" id="karte" role="tabpanel" aria-labelledby="karte-tab">
        <div class="card">
          <div class="card-header">
            <h4>Karte's</h4>
          </div>

          <div class="card-body">
            <div class="table-responsive">
              <table id="karteList" class="table table-bordered table-hover table-striped table-dark">
                <?php
                  include('Tablas/tablaKarte.php');
                 ?>
              </table>
            </div>
          </div>

        </div>
      </div>
      <div class="tab-pane fade" id="enviados" role="tabpanel" aria-labelledby="enviados-tab">
        <div class="card">
          <div class="card-header">
            <h4>Enviados</h4>
          </div>
          <div class="card-body">
            <table id="enviadosList" class="table table-bordered table-hover table-striped table-dark">
              <?php
                include('Tablas/tablaEnviados.php');
               ?>
            </table>
          </div>

        </div>
      </div>
      <div class="tab-pane fade" id="form" role="tabpanel" aria-labelledby="form-tab">
        <?php
        include('Formularios/formularioUsuario.php') ?>
      </div>
  </div>
  </div>
  </div>

      <!-- <table class="table table-dark">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">First</th>
      <th scope="col">Last</th>
      <th scope="col">Handle</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row">1</th>
      <td>Mark</td>
      <td>Otto</td>
      <td>@mdo</td>
    </tr>
    <tr>
      <th scope="row">2</th>
      <td>Jacob</td>
      <td>Thornton</td>
      <td>@fat</td>
    </tr>
    <tr>
      <th scope="row">3</th>
      <td>Larry</td>
      <td>the Bird</td>
      <td>@twitter</td>
    </tr>
  </tbody>
</table> -->
</body>
</html>
