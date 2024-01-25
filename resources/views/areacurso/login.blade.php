<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
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
        margin-top: 40%;
        
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

    <title>Ingresar a Docttus</title>
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
                        <strong>Ingresa </strong> a tu cuenta Docttus
                      </div>
                      <form action="/" class="form-horizontal" method="post" id="formulario_login">
                      <div class="form-group">
                          <div class="col-md-12">
                              <input type="text" class="form-control input-docttus" id="txtusuario" placeholder="Usuario" required />
                          </div>
                      </div>
                      <div class="form-group">
                          <div class="col-md-12">
                              <input type="password" id="txtpassword" class="form-control input-docttus" placeholder="Password" required />
                          </div>
                      </div>                 

                      <div class="form-group">
                          <div class="col-md-12">
                              <select class="form-control" id="txtrolusuario">                                
                                <option value="1">Estudiante</option>
                                <option value="2">Afiliado</option>
                                <!--<option value="3">Tutor</option>-->
                              </select>
                          </div>
                      </div>                 

                      <div class="form-group">                        
                          <div class="col-md-12">
                            <center>
                              <button  id="btn_login" class="btn btn-info btn-block botones-docttus"  style="background-color:#3b455a;">Ingresar</button>
                              <hr>
                              <a href="#" class="olvidaste" id="btn_olvidaste_password">Olvidaste tu Contraseña</a>
                            </center>                            
                          </div>
                      </div>

                      <hr>

                      <div class="form-group">                        
                          <div class="col-md-12">
                            <a href="{{url('')}}/registro" class="btn btn-info btn-block botones-docttus" style="background-color: #f19c19; border-color: #f19c19;">No Tengo Cuenta</a>
                          </div>
                      </div>
                     
                    
                     
                      </form>
                    </div>
                    <div id="form_login_olvido" >

                          
                          <div class="login-title"><strong>Recuperar </strong> Contraseña </div>
                          <form action="/" class="form-horizontal" method="post">
                          <div class="form-group">
                              <div class="col-md-12">
                                  <input type="text" class="form-control input-docttus" id="txtuusuario_recuperar" placeholder="Usuario o Email"/>
                              </div>
                          </div>
                                                    <div class="form-group">                        
                              <div class="col-md-12">
                                <center>
                                  <button  id="btn_recuperar" class="btn btn-info btn-block botones-docttus" style="background-color:#3b455a;">Recuperar Contraseña</button>
                                  <hr>
                                  <a href="#" id="btn_regresar" class="olvidaste">Regresar</a>
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



        var usuario=$("#txtusuario").val();
        var password=$("#txtpassword").val();
        var rol=""+$("#txtrolusuario").val();
        var request = $.ajax({
          url: "login_cursos",
          type: "POST",
          data:{               
               usuario:usuario,
               password:password,
               rol:rol,
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