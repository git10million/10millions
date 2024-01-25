@extends('marketing.plantilla.plantilla')
@section('contenido')   

<style type="text/css">
  .contact-warp p {
      padding-top: 10px;
      margin-bottom: 10px;
  }
</style>
<!-- Contact section -->

<!-- Hero section -->
  <section class="hero-section">
    <div class="hero-slider owl-carousel">      
      <div class="hs-item" style="padding-top:38px; padding-bottom: 80px; height: auto !important; background-position: top center; ">
        <div class="container">
          <div class="row">
            <div class="col-lg-12" style="text-align: center;">             
          
              <h1 style="font-size: 48px; color: #fff; margin-top: 100px;">Recuperar Password</h1>
              
        
            </div>            
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- Hero section end -->

  <section class="contact-section">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-6 p-0">
          <!-- Map -->
          <div class="map" style="background-image: url({{url('')}}/assets-marketing/img/login-image.jpg); background-position: center; background-size:cover;">
            
          </div>
        </div>
        <div class="col-lg-6 p-0">
          <div class="contact-warp">
            

              <div class="row">
                <div class="offset-md-2 col-md-8">
                  <form class="form" id="formulario_login">

                     <h4 style="text-align: center;">Escribe tu usuario o tu email para recuperar tu contraseña</h4>
                      <!--
                     <button class="btn-docttus-web-fb" style="margin-top: 14px; width: 100%;"><i class="fa fa-facebook" aria-hidden="true"></i> Continúa con Facebook</button>
                      <br />
                     <button class="btn-docttus-web-google" style="margin-top: 14px; width: 100%;"><i class="fa fa-google" aria-hidden="true"></i> Continúa con Google</button>
                      -->

                     <br />
                     <br />


                      <div class="form-group">                                             
                         <input type="text" class="form-control" id="txtusuario" placeholder="Usuario o Email" required style="border:1px solid #ccc;" />
                      </div>

                      

                       <center>

                        <p>
                            Se enviará un código de 6 caracteres a tu correo electrónico, y sólo tendrás 15 minutos para verificar tu cuenta.
                        </p>
                        

                        <input type="submit" name="" class="btn-docttus-web" value="Enviar Código" id="btn_ingresar" style="width: 100%;">  

                        
                      </center>

                      
                      
                  </form>    
                </div>
              </div>
              

          </div>


        </div>


        


      </div>


      


    </div>
  </section>




@stop

@section('scripts')

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

      

      function verificar_login(){

        var usuario=$("#txtusuario").val();
        
        var request = $.ajax({
          url: "{{url('')}}/solicitar_codigo",
          type: "POST",
          data:{               
                usuario_email:usuario,               
               _token: "{{ csrf_token() }}"
          }
        });

        request.done(function(obj) { 
           if(obj.status=="ok"){
              mensaje_generico("Código enviado!","Hemos enviado un código a tu correo electrónico","1"," Continuar...",function(){
                window.open("{{url('')}}/verificacion-codigo/"+obj.token_verificacion,"_parent");
              });
              
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

@stop
