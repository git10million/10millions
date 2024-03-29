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
          
              <h1 style="font-size: 48px; color: #fff; margin-top: 100px;">Registro Tutores</h1>
              
        
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
          <div class="map" style="background-image: url({{url('')}}/assets-marketing/img/registro-afiliados.jpg); background-position: right; background-size:cover;">
            
          </div>
        </div>
        <div class="col-lg-6 p-0">
          <div class="contact-warp">
            

              <div class="row">
                <div class="offset-md-2 col-md-8">
                  <form class="form" id="formulario_login">

                     <h4 style="text-align: center;">Sé parte de la nueva generación de tutores digitales y Gana hasta un 90%.</h4>

                     <!--
                      <button class="btn-docttus-web-fb" style="margin-top: 14px; width: 100%;"><i class="fa fa-facebook" aria-hidden="true"></i> Continúa con Facebook</button>
                      <br />
                     <button class="btn-docttus-web-google" style="margin-top: 14px; width: 100%;"><i class="fa fa-google" aria-hidden="true"></i> Continúa con Google</button>
                     

                     <center>
                       <p style="margin-top: 15px; margin-bottom: 15px;">o continúa con</p>
                     </center>
                     -->

                     <br />
                     <br />

                      <div class="form-group">                                             
                         <input type="text" class="form-control" id="txtusuario" placeholder="Usuario" required style="border:1px solid #ccc;" />
                      </div>

                      <div class="form-group">                                             
                         <input type="email" class="form-control" id="txtemail" placeholder="Email" required style="border:1px solid #ccc;" />                         
                      </div>

                      <div class="form-group">                                             
                         <input type="password" class="form-control" id="txtpassword" placeholder="Password" required style="border:1px solid #ccc;"  />
                      </div>
                      <center>
                      

                        <input type="submit" name="" class="btn-docttus-web" value="REGÍSTRATE" id="btn_ingresar" style="width: 100%;">  

                        <p>
                          ¿Tienes una cuenta? <a href="{{url('')}}/login-tutores">Inicia Sesión</a>
                        </p>

                        <small>Al registrarte aceptas nuestros <a href="{{url('')}}/politicas-de-privacidad">Términos y Políticas de Privacidad</a></small>
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

      var myVar;
      var contador_login=5;

      function verificar_login(){
        var txtusuario=$("#txtusuario").val();        
        var txtemail=$("#txtemail").val();
        var txtpassword=$("#txtpassword").val();        
        var txtrolestudiante="";
        var txtrolafiliado="";
                
        $IdUsuarioPadre="";//acá va el uso de cockies

        var request = $.ajax({
          url: "{{url('')}}/registrar_usuario",
          type: "POST",
          data:{               
              usuario:txtusuario,              
              email:txtemail,
              password:txtpassword,                            
              rol_registro:"2",

              IdUsuarioPadre:"",                  
              _token: "{{ csrf_token() }}"
          }
        });

        request.done(function(obj) { 
           if(obj.status=="ok"){
              mensaje_generico("Bienvenido "+txtusuario+" !","Has ingresado correctamente","1","<span id='contador_boton'>5 </span> Continuar...",continuar_login);
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
         window.open("{{url('')}}/backoffice","_parent");
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
