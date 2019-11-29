<?php
    $db = new mysqli('localhost','root','','Postales');
    $user_email = $_SESSION["email"];
    $contenido = "";;
    $contenidoDos = "";
    // Check for errors
    if(mysqli_connect_errno()){
    echo mysqli_connect_error();
    }
    $result = $db->query("call obtenerPostalesRecibidas('$user_email')");
    if($result){
     // Cycle through results
    while ($row = $result->fetch_object()){
        $user_arr = $row;
        if($row != null || $row != "" || $user_arr->Nombre == null || $user_arr->Nombre != "")
        {
          $contenido .=
        "<div class='col s12 m4 l4'>
          <div class='card Medium'>
            <div class='card-image waves-effect waves-block waves-light'>
                <img class='activator' src='$user_arr->Imagen'>
            </div>
            <div class='card-content'>
              <span id='ver' class='card-title activator grey-text text-darken-4'>" . $user_arr->Nombre . "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i data-value='$user_arr->Nombre' class='fas fa-eye'></i></span>
              <p id='pdfD'><a data-value='$user_arr->Nombre' href='#'>Descargar como PDF</a></p>
            </div>
            <div class='card-reveal'>
              <span class='card-title grey-text text-darken-4'>".$user_arr->Nombre."<i class='fas fa-times'></i></span>
              <p>".$user_arr->Descripcion."</p>
            </div>
           </div>
          </div>";
        }
        else{
          $contenido = "<h5><i>Sin postales para mostrar<i></h5>";
        }
    }
    // Free result set
    $result->close();
    $db->next_result();
    }

    // 2nd Query
    $result = $db->query("call obtenerPostalesEnviadas('$user_email')");
    if($result){
     // Cycle through results
    while ($row = $result->fetch_object()){
      $user_arr = $row;
      if($row != null || $row != "" || $user_arr->Nombre == null || $user_arr->Nombre != "")
      {
        $contenidoDos .=
      "<div class='col s12 m4 l4'>
        <div class='card Medium'>
          <div class='card-image waves-effect waves-block waves-light'>
              <img class='activator' src='$user_arr->Imagen'>
          </div>
          <div class='card-content'>
            <span class='card-title activator grey-text text-darken-4'>" . $user_arr->Nombre . "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i id='env' data-value='$user_arr->Nombre' class='fas fa-eye'></i></span>
            <p><a id='pdfD' href='#' data-value='$user_arr->Nombre'>Descargar como pdf</a></p>
          </div>
          <div class='card-reveal'>
            <span class='card-title grey-text text-darken-4'>".$user_arr->Nombre."<i class='fas fa-times'></i></span>
            <p>".$user_arr->Descripcion."</p>
          </div>
         </div>
        </div>";
      }
      else{
        $contenidoDos = "<h5><i>Sin postales para mostrar<i></h5>";
      }
    }
     // Free result set
     $result->close();
     $db->next_result();
    }
    else echo($db->error);

    // Close connection
    $db->close();
 ?>
