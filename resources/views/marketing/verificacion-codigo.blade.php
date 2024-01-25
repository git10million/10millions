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
          
              <h1 style="font-size: 48px; color: #fff; margin-top: 100px;">Verificar Código</h1>
              
        
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
                  <form class="form" id="formulario_verificar">
                    @if($status!="error")
                        <h4 style="text-align: center;">Escribe el código de 6 dígitos que enviamos a tu correo.  Recuerda que tienes 15 minutos para hacerlo efectivo.</h4>
                    @else
                        <h4 style="text-align: center;">El código ya fue usado o ha caducado.</h4>
                        <br />
                        <p style="text-align: center;">
                            <a href="{{url('')}}/recuperar-password">Solicitar otro código</a>
                        </p>
                    @endif
                      <!--
                     <button class="btn-docttus-web-fb" style="margin-top: 14px; width: 100%;"><i class="fa fa-facebook" aria-hidden="true"></i> Continúa con Facebook</button>
                      <br />
                     <button class="btn-docttus-web-google" style="margin-top: 14px; width: 100%;"><i class="fa fa-google" aria-hidden="true"></i> Continúa con Google</button>
                      -->

                     <br />
                     <br />
                     

                     @if($status!="error")
                        <div class="row">
                            <div class="col-12" style="padding: 1px;">
                                <input type="text" class="form-control" maxlength="6" id="txtodigoverificacion"  required style="border:1px solid #ccc; font-size:35px; text-align:center; height:60px; border-radius:5px;" />
                            </div>                                                
                        </div>

                        <center>                    
                            <input type="submit" name="" class="btn-docttus-web" value="Verificar Código" id="btn_ingresar" style="width: 100%;">
                        </center>
                    @endif
                      
                      
                  </form>    

                  @if($status!="error")
                  <form class="form" id="formulario_cambio" style="display: none;">
                    
                      <h4 style="text-align: center;">Escribe tu nueva contraseña</h4>                                        
                      <!--
                     <button class="btn-docttus-web-fb" style="margin-top: 14px; width: 100%;"><i class="fa fa-facebook" aria-hidden="true"></i> Continúa con Facebook</button>
                      <br />
                     <button class="btn-docttus-web-google" style="margin-top: 14px; width: 100%;"><i class="fa fa-google" aria-hidden="true"></i> Continúa con Google</button>
                      -->

                     <br />
                     <br />
                     
                        <div class="row">
                            <div class="col-12" style="padding: 1px;">
                                <input type="password" class="form-control" id="txtnuevopassword"  required  style="border:1px solid #ccc;" placeholder="Nueva Contraseña" />
                            </div>                                                
                            <div class="col-12" style="padding: 1px;">
                              <input type="password" class="form-control" id="txtrepetirnuevopassword"  required style="border:1px solid #ccc;"  placeholder="Repetir Nueva Contraseña"  />
                          </div>                                    
                        </div>

                        <center>                    
                            <input type="submit" name="" class="btn-docttus-web" value="Cambiar Password" id="btn_cambiar_password" style="width: 100%;">
                        </center>
                    
                      
                      
                  </form>    

                  @endif




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

@if($status!="error")

      
      var token_k="";
      $("#formulario_verificar").submit(function(e){
        e.preventDefault();
        verificar_login();         
      });

      $("#formulario_cambio").submit(function(e){
        e.preventDefault();
        cambio_password();         
      });

      

      function verificar_login(){

        var codigoverificacion=$("#txtodigoverificacion").val();
        
        var request = $.ajax({
          url: "{{url('')}}/verificacion_codigo_token",
          type: "POST",
          data:{               
                cd_dtt:codigoverificacion,               
                token_dtt:"{{$codigo_token}}",
               _token: "{{ csrf_token() }}"
          }
        });

        request.done(function(obj) { 
           if(obj.status=="ok"){

              $("#formulario_verificar").hide("fast");
              $("#formulario_cambio").show("fast");

              token_k=""+obj.codigo_token;

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


      function cambio_password(){
        var codigoverificacion=$("#txtodigoverificacion").val();
        var new_passw=$("#txtnuevopassword").val();
        var new_rep_passw=$("#txtrepetirnuevopassword").val();

        if(new_passw.trim()=="" || new_rep_passw.trim()==""){
            mensaje_generico("Error !","El Campo contraseña es obligatorio","2","Continuar...",continuar_error);
            return;
        }

        if(new_passw.trim() != new_rep_passw.trim()){
            mensaje_generico("Error !","El Campo contraseña es obligatorio","2","Continuar...",continuar_error);
            return;
        }

        var request = $.ajax({
          url: "{{url('')}}/cambiar_passw",
          type: "POST",
          data:{     
                password:new_passw,
                nuevo_password:new_rep_passw,
                codigoverificacion:codigoverificacion,               
                token_ver:"{{$codigo_token}}",
                token_k:""+token_k,
               _token: "{{ csrf_token() }}"
          }
        });

        request.done(function(obj) { 
           if(obj.status=="ok"){
              mensaje_generico("Cambio Exitoso!",obj.mensaje,"1"," Continuar...",function(){
                window.open("{{url('')}}/login/","_parent");
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


@endif

    </script>

@stop
