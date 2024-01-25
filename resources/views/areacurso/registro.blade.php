<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <title>Crea Tu Cuenta Gratis - Docttus</title>
    <link rel="icon" type="image/png" href="{{url('')}}/assets/images/logo-docttus-favicon.png">
    <style type="text/css">
      
      /*
        ESTILOS PARA LOS CURSOS
      */
      body,html{
         background-color:#F5F6FA;
      }
     
      .card-docttus{
        background-color: #fff;
        border-radius: 9px;
        padding: 25px;          
        box-shadow: 0px 0 7px 0px #ecebeb;
        position: relative;        
      }

      .container-login{
        margin-top: 10%;       
      }

      .login-principal{
         width: 200px;
         margin-bottom: 15px;
      }

      #form_login_olvido{
         display: none;
      }

      .login-title{
          margin-top: 15px;
          margin-bottom: 15px;
          text-align: center;
      }

      .btn-mensajes{
         background-color:#70b851;
         border-radius: 25px;
         padding: 5px 20px;
         border:none;
         margin-top: 15px;
      }

      .titulo-mensaje{
        
        font-size: 18px;
        margin-top: 17px;
      }
      .titulo-mensaje-exito{
        color: #a9d497;
      }

      .titulo-mensaje-error{
        color: red;        
      }


      .icono-mensaje-1,.icono-mensaje-2{
          width: 80px;
      }
      

    </style>

    
  </head>
  <body>
    <div class="container">
      <div class="row">
          <div class="offset-md-3 col-md-5">
              
              <div class="container-login">
                <center>
                  <img src="assets/images/logo_docttus.png" class="login-principal">  
                </center>  

                <div class="card-docttus">
                    <div id="form_login">
                      <div class="login-title">
                        <strong>Crea Ahora </strong>tu cuenta Docttus Gratis
                      </div>
                      <form action="/" class="form-horizontal" method="post" id="formulario_login">
                      <div class="form-group">
                          <div class="col-md-12">
                              <input type="text" class="form-control input-docttus" id="txtusuario" placeholder="Usuario*" required />
                          </div>
                      </div>



                      <div class="form-group">
                          <div class="col-md-12">
                              <input type="text" class="form-control input-docttus" id="txtnombre" placeholder="Nombre(s)*" required />
                          </div>
                      </div>


                      <div class="form-group">
                          <div class="col-md-12">
                              <input type="text" class="form-control input-docttus" id="txtapellidos" placeholder="Apellido(s)" />
                          </div>
                      </div>

                      <div class="form-group">
                          <div class="col-md-12">
                              <input type="email" class="form-control input-docttus" id="txtemail" placeholder="Email*" required />
                          </div>
                      </div>



                      <div class="form-group">
                          <div class="col-md-12">
                              <input type="password" id="txtpassword" class="form-control input-docttus" placeholder="Password*" required />
                          </div>
                      </div>                 

                      <div class="form-group">
                          <div class="col-md-12">
                              <input type="password" id="txtrepetirpassword" class="form-control input-docttus" placeholder="Repetir Password*" required />
                          </div>
                      </div>   

                      <div class="form-group">
                          <div class="col-md-12">                            
                              <small>¿Que quieres ser en Docttus?</small><br/>
                              <br/>
                              <input id="txtrolestudiante" type="checkbox" name=""> <span  style="margin-right: 25px;">Estudiante</span>  <input type="checkbox" name="" id="txtrolafiliado"> Afiliado                              
                          </div>
                      </div>  

                      <div class="form-group">
                        <div class="col-md-12">
                          <hr>
                          <input type="checkbox" name="" id="txtacepto"> Acepto los <a target="_blank" href="{{url('')}}/terminos-de-uso">Términos de Uso</a> y <a href="{{url('')}}/politicas-de-privacidad" target="_blank">Políticas</a> de Docttus.
                          </div>
                      </div>            

                      <div class="form-group">                        
                          <div class="col-md-12">
                            <center>
                              <button  id="btn_login" class="btn btn-info btn-block botones-docttus"  style="background-color:#3b455a;">Registrarse Ahora</button>
                              <hr>
                              <a  class="btn btn-info btn-block botones-docttus" style="background-color: #f19c19;  border-color: #f19c19;"  href="{{url('')}}" class="olvidaste">Ya Tengo Cuenta Docttus</a>
                            </center>                            
                          </div>
                      </div>                                                           
                     
                      </form>
                    </div>                    
                </div>  

                <div class="row" style="margin-top: 15px;">
                  <div class="col-md-12">
                      <center>
                        <a class="btn btn-outline-secondary btn-sm" target="_blank" href="{{url('')}}/soporte">Soporte</a> — <a  class="btn btn-outline-secondary btn-sm" href="{{url('')}}/terminos-de-uso"  target="_blank" >Términos de Uso</a> — <a  class="btn btn-outline-secondary btn-sm" href="politica-de-privacidad"  target="_blank" >Política de Privacidad</a>
                     </center>
                  </div>
                </div>


              </div>
              
          </div>
      </div>
    </div>
    

    <!-- Modal Mensaje Generico -->
    <div class="modal fade" id="mensaje_generico" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
        <div class="modal-content">
          <!--<div class="modal-header">            
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>-->
          <div class="modal-body">
            <div class="row">
              <div class="col-md-12">
                <center>  
                   <img src="assets/images/check_mensaje.png" class="icono-mensaje-1">
                   <img src="assets/images/error_mensaje.png" class="icono-mensaje-2">
                </center>
              </div>
              <div class="col-md-12">
                <center>  
                  <h2 class="titulo-mensaje">Bienvenido!</h2>
                  <p class="descripcion-mensaje">Has ingresado correctamente</p>
                </center>
              </div>
              <div class="col-md-12">
                <center>  
                  <button type="button" class="btn btn-success btn-mensajes btn-continuar" data-dismiss="modal">Continuar</button>   
                </center>
              </div>
            </div>              
          </div>

        </div>
      </div>
    </div>


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>    
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <script type="text/javascript">
      $("#btn_olvidaste_password").click(function(e){        
        e.preventDefault();
        $("#form_login_olvido").show();
        $("#form_login").hide();
      });

      $("#btn_regresar").click(function(e){        
        e.preventDefault();
        $("#form_login_olvido").hide();
        $("#form_login").show();
      });


      $("#formulario_login").submit(function(e){
        e.preventDefault();
        verificar_login();         
      });

      var myVar;
      var contador_login=5;

      function verificar_login(){
        var txtusuario=$("#txtusuario").val();
        var txtnombre=$("#txtnombre").val();
        var txtapellidos=$("#txtapellidos").val();
        var txtemail=$("#txtemail").val();
        var txtpassword=$("#txtpassword").val();
        var txtrepetirpassword=$("#txtrepetirpassword").val();
        var txtrolestudiante="";
        var txtrolafiliado="";


        if($("#txtrolestudiante").is(":checked")){
          txtrolestudiante="1";
        }

        if($("#txtrolafiliado").is(":checked")){
          txtrolafiliado="1";
        }

        if(txtrepetirpassword!=txtpassword){
            mensaje_generico("Error !","Los passwords no coinciden","2","Continuar...",function(){});
            return;
        }

        if(txtrolafiliado=="" && txtrolestudiante==""){
            mensaje_generico("Error !","Debes seleccionar Estudiante o Afiliado","2","Continuar...",function(){});
            return;
        }

        if(!$("#txtrolafiliado").is(":checked")){
            mensaje_generico("Error !","Debes Aceptar los términos y políticas de Docttus","2","Continuar...",function(){});
            return; 
        }

        $IdUsuarioPadre="";//acá va el uso de cockies

        var request = $.ajax({
          url: "registrar_usuario",
          type: "POST",
          data:{               
              usuario:txtusuario,
              nombre:txtnombre,
              apellidos:txtapellidos,
              email:txtemail,
              password:txtpassword,
              repetirpassword:txtrepetirpassword,
              rolestudiante:txtrolestudiante,
              rolafiliado:txtrolafiliado,
              IdUsuarioPadre:"",                  
              _token: "{{ csrf_token() }}"
          }
        });

        request.done(function(obj) { 
           if(obj.status=="ok"){
              mensaje_generico("Bienvenido "+obj.nombre+" !","Has ingresado correctamente","1","<span id='contador_boton'>5 </span> Continuar...",continuar_login);
              myVar = setInterval(myTimer, 1000);              
              return;
           }else{
              mensaje_generico("Error !",""+obj.mensaje,"2","Continuar...",continuar_error);
              return;
           }
        });
         

         //respuesta si falla
        request.fail(function(jqXHR, textStatus) {
          alert( "Error de servidor  " + textStatus );
        });
      }

      


      function mensaje_generico(titulo,descripcion,tipo,nombre_boton,funcion_boton){
          if(tipo=="1"){
            $(".icono-mensaje-1").show();
            $(".icono-mensaje-2").hide();
            $(".titulo-mensaje").removeClass("titulo-mensaje-error");
            $(".titulo-mensaje").addClass("titulo-mensaje-exito");            
          }else{
            $(".icono-mensaje-2").show();
            $(".icono-mensaje-1").hide();
            $(".titulo-mensaje").removeClass("titulo-mensaje-exito");
            $(".titulo-mensaje").addClass("titulo-mensaje-error");
            
          }

          $(".titulo-mensaje").html(""+titulo);
          $(".descripcion-mensaje").html(""+descripcion);
          $("#mensaje_generico").modal("show");
          $(".btn-continuar").html(""+nombre_boton);
          $(".btn-continuar").click(function(){
            funcion_boton();  
          });          
      }

      function continuar_login(){
         console.log("siguiente");
         window.open("backoffice","_parent");
      }

      function continuar_error(){

      }



      

      function myTimer() {
         contador_login--;
         $("#contador_boton").html(""+contador_login);
         if(contador_login==0){
            myStopFunction();
         }        
      }

      function myStopFunction() {
        clearInterval(myVar);
        window.open("backoffice","_parent");
      }




    </script>
  </body>
</html>