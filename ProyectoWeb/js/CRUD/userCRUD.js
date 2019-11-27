var idUser=0;
function editarUsuario(idUsuario){
  var data = "idUsuario="+ idUsuario;
  $.ajax({
    url: '../ajax/selectUsuario.php',
    type: 'POST',
    data: data,
    success: function(response){
      if(response.charAt(0)== '{'){
        var jason = JSON.parse(response);
        $('#Nombre').val(jason['data'][0].nombreUsuario);
        $('#Apellido').val(jason['data'][0].apellidoUsuario);
        $('#email').val(jason['data'][0].email);
        $('#edad').val(jason['data'][0].edad);
        $('#imagenUsuario').val(jason['data'][0].imagenUsuario);
        idUser=jason['data'][0].idUsuario;
        if(jason['data'][0].genero=='Masculino')
          $("#Masculino").attr('checked', true);
         else
          $("#Femenino").attr('checked', true);

          $("#contra1").val(jason['data'][0].contra);
          $("#contra2").val(jason['data'][0].contra);
         $('#form-tab').tab('show');
       }
       else{
         alert(response);
       }
    }
  });
}
function eliminarUsuario(idUsuario){
  var data = "idUsuario="+ idUsuario;
  $.ajax({
    url: '../ajax/eliminarUsuario.php',
    type: 'POST',
    data: data,
    success : function(response){
      if (response == 1) {
        alert("El usuario fue eliminado");
        $('#userList').load('Tablas/tablaUser.php');
      }
      else{
        alert(response);

      }
    }

  });
}
function registrarUsuario(){
  var nombre, apellido, contra, email,genero,email,edad,fotoPerfil;
  nombre = document.getElementById("Nombre").value;
  apellido = document.getElementById("Apellido").value;
  contra = document.getElementById("contra1").value;
  email = document.getElementById("email").value;
  edad = document.getElementById("edad").value;
  fotoPerfil=document.getElementById('imagenUsuario').files[0];

  var radios = document.getElementsByName('gender');

  for (var i = 0, length = radios.length; i < length; i++){
   if (radios[i].checked){
    genero=radios[i].value;
    break;
   }
  }
  var form_data = new FormData();
  if(document.getElementById("imagenUsuario").files.length == 0){
       form_data.append("file", 0);
       // alert('vacio');
     }else{
       form_data.append("file", document.getElementById('imagenUsuario').files[0]);
     }
  form_data.append('nombre',nombre);
  form_data.append('apellido',apellido);
  form_data.append('contra',contra);
  form_data.append('email',email);
  form_data.append('edad',edad);
  form_data.append('genero',genero);
  form_data.append('idUsuario',idUser);
  $.ajax({
      url:"../ajax/registroUsuario.php",
      method:"POST",
      data: form_data,
      contentType: false,
      cache: false,
      processData: false,
      success:function(data){
        if(data == 1) {
          $('#userList').load('Tablas/tablaUser.php');
          $('#form').load('Formularios/formularioUsuario.php');
          $('#user-tab').tab('show');
          idUser=0;
         }
         else if(data == 2) {
          alert('Se actualizo el usuario!');
          $('#userList').load('Tablas/tablaUser.php');
          $('#enviadosList').load('Tablas/tablaEnviados.php');
          $('#form').load('Formularios/formularioUsuario.php');
          $('#user-tab').tab('show');
          idUser = 0;
         }
         else {
           alert(data);
         }
      }
     });

}


function validarUsuario(){
  var nombre, apellido, contra, contra2, email, expresion,genero,email,edad;
  nombre = document.getElementById("Nombre").value;
  apellido = document.getElementById("Apellido").value;
  contra = document.getElementById("contra1").value;
  contra2 = document.getElementById("contra2").value;
  email = document.getElementById("email").value;
  edad = document.getElementById("edad").value;

  expresion= /\w+@\w+\.+[a-z]/;

  var radios = document.getElementsByName('gender');

  for (var i = 0, length = radios.length; i < length; i++){
   if (radios[i].checked){
    genero=radios[i].value;
    break;
   }
  }

  if(genero!='Masculino' && genero!='Femenino'){
    $('#alert').html('Buen intento crack');
  }else if(nombre === "" && apellido === "" && email === "" && contra === ""){
    $('#alert').html('Todos los campos deben llenarse');
  }else if(nombre === ""){
    $('#alert').html('Falta el nombre');
    $('#Nombre').focus();
  }else if(apellido === ""){
    $('#alert').html('Falta el apellido');
    $('#Apellido').focus();
  }else if(email === ""){
    $('#alert').html('Falta el email');
    $('#email').focus();
  }else if(edad === ""){
    $('#alert').html('Falta tu edad');
    $('#edad').focus();
  }
  else if(contra === ""){
    $('#alert').html('Falta la contraseña');
    $('#contra1').focus();
  }else if(contra2 === ""){
    $('#alert').html('Falta la confirmacion de contraseña');
    $('#contra2').focus();
  }else if(contra != contra2){
    $('#alert').html('Las contraseñas no coinciden');
    $('#contra2').focus();
  }else if(nombre.length > 15){
    $('#alert').html('El nombre es muy largo');
    $('#Nombre').focus();
  }else if(apellido.length > 20){
    $('#alert').html('El apellido es muy largo');
    $('#Apellido').focus();
  }else if(email.length > 35){
    $('#alert').html('El email es muy largo');
    $('#email').focus();
  }else if(contra.length > 30){
    $('#alert').html('La contraseña es muy larga');
    $('#contra').focus();
  }else if(!expresion.test(email)){
    $('#alert').html('Ingresa un email valido');
    $('#email').focus();
  }else{
    $('#alerth').removeClass("bg-danger");
    $('#alerth').addClass("bg-success");
    $('#alert').html('Los datos son correctos!');
    registrarUsuario();
  }

}
