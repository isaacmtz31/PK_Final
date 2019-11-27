<?php
  session_start();
  if(isset($_SESSION["email"]))
  {
      include("./usuario_BD.php");
      include("./misPostales_BD.php");
  }
  else
      header("location:./logIn.php");
 ?>

 <!DOCTYPE html>
 <html lang="es">
     <head>
         <meta charset="UTF-8">
         <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
         <title>PostKarte</title>

         <link rel="stylesheet" href="./../css/normalize.css">
         <link rel="stylesheet" href="./../css/materialize.min.css">
         <link rel="stylesheet" href="./../css/jquery.mCustomScrollbar.css">
         <link rel="stylesheet" href="./../css/sweetalert.css">
         <link rel="stylesheet" href="./../css/style.css">
         <link rel="stylesheet" href="./../css/profile.css">
         <link rel="stylesheet" href="./../fontawesome/css/all.min.css" >
         <link href="./../js/validetta/src/validetta.css" rel="stylesheet">
         <link href="./../js/confirm/dist/jquery-confirm.min.css" rel="stylesheet">
         <!--Galeria-->
         <link rel="stylesheet" type="text/css" href="./../css/galeria/normalize.css" />
         <link rel="stylesheet" type="text/css" href="./../css/galeria/demo.css" />
         <link rel="stylesheet" type="text/css" href="./../css/galeria/component.css" />


         <script src="http://code.jquery.com/jquery-latest.min.js"></script>
         <script src="./../jquery/jquery.mCustomScrollbar.concat.min.js"></script>
         <script src="./../materializeV1/js/materialize.min.js"></script>

         <script src="./../js/sweetalert.min.js"></script>
         <script src="../js/validetta/src/validetta.js"></script>
         <script src="./../js/confirm/dist/jquery-confirm.min.js"></script>
         <script src="./../js/misPostales.js"></script>

     </head>
     <body>
         <!-- Nav Lateral -->
         <section class="NavLateral full-width">
             <div class="NavLateral-FontMenu full-width ShowHideMenu"></div>
             <div class="NavLateral-content full-width">
                 <header class="NavLateral-title full-width center-align">

                     <center> PostKarte <i class="zmdi zmdi-close NavLateral-title-btn ShowHideMenu"></i></center>
                 </header>
                 <figure class="full-width NavLateral-logo">
                     <img src="<?php echo $infUser[6]; ?>" alt="profile-picture" class="responsive-img center-box">
                     <div class="row">
                       <div class="col s12 l12 m12">
                         <p id="userName"><?php echo $infUser[1]." ".$infUser[2];?></p>
                       </div>
                     </div>
                 </figure>
                 <div class="row">
                   <div class="col s12 l4 m6 center-align" >
                     <a class="waves-effect waves btn-small hash">#Photo</a>
                   </div>
                   <div class="col s12 l4 m6 center-align">
                     <a class="waves-effect waves btn-small hash">#Sunny</a>
                   </div>
                   <div class="col s12 l4 m6 offset-m3 center-align">
                     <a class="waves-effect btn-small hash">#Dark</a>
                   </div>
                 </div>
                 <div class="NavLateral-Nav">
                     <ul class="full-width">
                         <li>
                             <a href="pruebaNav.html" class="waves-effect waves-light"><i class="fas fa-home"></i> Inicio</a>
                         </li>
                         <div class="NavLateral-Nav">
                             <ul class="full-width">
                                 <li class="NavLateralDivider"></li>
                                 <li><a href="./Explorar.php" class="waves-effect waves-light"><i class="fas fa-edit"></i>Explorar</a></li>
                                 <li class="NavLateralDivider"></li>
                                 <li>
                                     <a href="#" class="NavLateral-DropDown  waves-effect waves-light"><i class="fas fa-user"></i> Perfil </a>
                                     <ul class="full-width">
                                         <li><a href="./profile.php" class="waves-effect waves-light"><i class="fas fa-edit"></i>Modificar datos personales</a></li>
                                         <li class="NavLateralDivider"></li>
                                         <li><a href="./cambiarPSW.php" class="waves-effect waves-light"><i class="fas fa-lock"></i>Cambiar contraseña</a></li>
                                     </ul>
                                 </li>
                                 <li class="NavLateralDivider"></li>
                                 <li>
                                     <a href="#" class="NavLateral-DropDown  waves-effect waves-light"> <i class="fas fa-envelope"></i> PostKartes</a>
                                     <ul class="full-width">
                                         <li><a href="button.jsp" class="waves-effect waves-light"><i class="fas fa-envelope-open"></i>Mis PostKartes</a></li>
                                         <li class="NavLateralDivider"></li>
                                         <li><a href="./enviarPostal.php" class="waves-effect waves-light"><i class="fas fa-paper-plane"></i>Enviar una postal</a></li>
                                         <li class="NavLateralDivider"></li>
                                         <li><a href="./../creaPK/postal.php" class="waves-effect waves-light"><i class="fas fa-palette"></i>Diseña tu propia postal</a></li>
                                     </ul>
                                 </li>

                             </ul>
                         </div>
                 </div>
                 </div>
         </section>

         <!-- Page content -->
         <section class="ContentPage full-width">
             <!-- Nav Info -->
             <div class="ContentPage-Nav full-width">
                 <ul class="full-width">
                     <li class="btn-MobileMenu ShowHideMenu"><a href="#" class="tooltipped waves-effect waves-light" data-position="bottom" data-delay="50" data-tooltip="Menu"><i class="fas fa-bars"></i></a></li>
                     <li style="padding:0 15px;"></li>
                     <li><a href="./logOut.php?nombreSesion=email" class="tooltipped waves-effect waves-light btn-ExitSystem" data-position="bottom" data-delay="50" data-tooltip="Logout"><i class="fas fa-power-off"></i></a></li>
                     <li><a href="#" class="tooltipped waves-effect waves-light btn-Search" data-position="bottom" data-delay="50" data-tooltip="Search"><i class="fas fa-search"></i></a></li>
                 </ul>
             </div>

             <div class="row">
               <div id="titlePage" class="col s12 l12 m12">
                 <p id="titlePageT">Mis postales en PostKarte</p>
               </div>
             </div>

             <div class="row">
               <div class="col l12 m12 s12">
                 <div class="row">
                   <div class="col s12 m12 l12">
                     <div class="enviadas">
                       <h1>Postales Recibidas</h1>
                     </div>
                      <?php echo $contenido; ?>
                   </div>
                   <div class="col s12 m12 l 12">
                     <div class="enviadas">
                       <h1>Postales Enviadas</h1>
                     </div>
                       <?php echo $contenidoDos; ?>
                   </div>
                 </div>
               </div>
             </div>


           <!-- Footer -->
           <footer id="foot" class="page-footer white-text">
           <div class="container">
             <div class="row">
               <div class="col l6 s12">
                 <h5 class="">PostKarte S.A de C.V</h5>
                 <p class="">Instituto Politecnico Nacional</p>
                 <p class="">Escuela Superior de Computo</p>
               </div>
               <div class="col l4 offset-l2 s12">
                 <h5 class="">Links</h5>
                 <ul>
                   <li><a class=" white-text" href="#!">Facebook</a></li>
                   <li><a class=" white-text" href="#!">Twitter</a></li>
                   <li><a class=" white-text" href="#!">Instagram</a></li>
                 </ul>
               </div>
             </div>
           </div>
           <div class="footer-copyright">
             <div class="container  white-text">
             © 2019 Copyright
             </div>
           </div>
         </footer>
 </section>

 <script src="./../js/sweetalert.min.js"></script>
 <!--<script src="http://code.jquery.com/jquery-latest.min.js"></script>-->
 <script>window.jQuery || document.write('<script src="./../jquery/jquery-3.4.1.min.js"><\/script>')</script>
 <script src="./../materializeV1/js/materialize.min.js"></script>
 <script src="./../jquery/jquery.mCustomScrollbar.concat.min.js"></script>
 <script src="./../js/main.js"></script>
 <script> $(document).ready(function () {
         $('.slider').slider();
     });
</script>

 </body>
 </html>
