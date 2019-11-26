var idAdmin = 0;
function eliminarAdministrador(idAdministrador){
  var data = "idAdmin="+ idAdministrador;
  $.ajax({
    url: '../ajax/eliminarAdministrador.php',
    type: 'POST',
    data: data,
    success : function(response){
      if (response == 1) {
        alert("El administrador fue eliminado");
        $('#adminList').load('Tablas/tablaAdministrador.php');
      }
      else{
        alert(response);

      }
    }
  });
}

function editarAdministrador(idAdministrador){
  var data = "idAdmin="+ idAdministrador;
  $.ajax({
    url: '../ajax/selectAdministrador.php',
    type: 'POST',
    data: data,
    success: function(response){
      if(response.charAt(0)== '{'){
        var jason = JSON.parse(response);
        $('#emailAdministrador').val(jason['data'][0].email);
        idAdmin=jason['data'][0].idAdmin;
        $("#contra1Administrador").val(jason['data'][0].contra);
        $("#contra2Administrador").val(jason['data'][0].contra);
       }
       else{
         alert(response);
       }
    }
  });
}
function validarAdministrador(){
  var email,contra1,contra2;
  email = $("#emailAdministrador").val();
  contra1 = $("#contra1Administrador").val();
  contra2 = $("#contra2Administrador").val();
  expresion= /\w+@\w+\.+[a-z]/;
  if(email === "" && contra1 === ""){
    $('#alertAdministrador').html('Todos los campos deben llenarse');
  }else if(email === ""){
    $('#alertAdministrador').html('Falta el email');
    $('#emailAdministrador').focus();
  }else if(contra1 === ""){
    $('#alertAdministrador').html('Falta la contraseña');
    $('#contra1Administrador').focus();
  }else if(contra2 === ""){
    $('#alertAdministrador').html('Falta la confirmacion de contraseña');
    $('#contra2Administrador').focus();
  }else if(contra1 != contra2){
    $('#alertAdministrador').html('Las contraseñas no coinciden');
    $('#contra2Administrador').focus();
  }else if(email.length > 35){
    $('#alertAdministrador').html('El email es muy largo');
    $('#emailAdministrador').focus();
  }else if(contra1.length > 30){
    $('#alertAdministrador').html('La contraseña es muy larga');
    $('#contra1Administrador').focus();
  }else if(!expresion.test(email)){
    $('#alertAdministrador').html('Ingresa un email valido');
    $('#emailAdministrador').focus();
  }else{
    $('#alerthAdministrador').removeClass("bg-danger");
    $('#alerthAdministrador').addClass("bg-success");
    $('#alertAdministrador').html('Los datos son correctos!');
    registrarAdministrador();
  }
}

function registrarAdministrador(){
  var email,contra1,contra2;
  email = $("#emailAdministrador").val();
  contra1 = $("#contra1Administrador").val();
  contra2 = $("#contra2Administrador").val();
  var form_data = new FormData();
  form_data.append('email',email);
  form_data.append('contra',contra1);
  form_data.append('idAdmin',idAdmin);
  $.ajax({
    url:"../ajax/registroAdministrador.php",
    method:"POST",
    data: form_data,
    contentType: false,
    cache: false,
    processData: false,
    success:function(data){
      if(data == 1){
        $("#adminList").load("Tablas/tablaAdmin.php");
        limpiarAdmin();
        idAdmin=0;
      }else if(data == 2){
        $("#adminList").load("Tablas/tablaAdmin.php");
        limpiarAdmin();
        idAdmin = 0;
      }else{
        alert(data);
      }
    }
  });
}
function limpiarAdmin(){
  email = $("#emailAdministrador").val('');
  contra1 = $("#contra1Administrador").val('');
  contra2 = $("#contra2Administrador").val('');

}
