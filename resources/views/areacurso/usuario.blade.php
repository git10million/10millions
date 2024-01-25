@extends('areacurso.plantillas.plantilla-area-interna')
@section('contenido')   

<style type="text/css">
  .descripcion-curso{
     height: 550px;
     overflow-y: auto;
     margin-top: 45px;
  }
  .contenedor-principal{
    /*background-color: #fff;*/
  }

  .foto-usuario-docttus{
     width: 150px;
     height: 150px;
     display: inline-block;
     background-color: #ccc;
     border-radius: 90px;
     background-position: center;
     background-size: cover;
     background-repeat: no-repeat;
  }

  .form-control{    
    width: 100%;
  }

  .tab-activo{
    border-bottom: 4px solid #F95850;
  }
  .tab-gen{
    text-align: center;  padding-bottom: 10px;
  }
  .tab-gen h6{
    font-weight: bold; margin:0px; padding:0px;
  }

  .tab-gen a h6{
     color: #000;
  }

  .tab-gen a:hover{
    text-decoration: none !important;
  }
  .tab-gen:hover{
    border-bottom: 4px solid #F95850;   
  }
</style>
 


<div class="row row-docttus">
    <div class="col-md-3">       
        <div class="card-docttus card-docttus-left" style=" height: auto !important; text-align: center;">
            <div class="foto-usuario-docttus" style="background-image: url({{url('')}}/assets/images/usuarios/{{$datos_usuario[0]->FotoPersona}});"></div>
            <h5 style="font-weight: bold;">{{$datos_usuario[0]->NombrePersona}} {{($datos_usuario[0]->ApellidosPersona)?$datos_usuario[0]->ApellidosPersona:""}}</h5>
            <h6>Usuario: {{'@'.$datos_usuario[0]->NombreUsuario}}</h6>
            
            <h6>Miembro 10 Million$ Club</h6>
            

            <div style="width: 100%; margin-top: 10px;">
              <!--<a href="{{url('')}}/usuario/{{$codigousuario}}" type="button" class="btn btn-secondary botones-docttus" id="btn_editar_usuario" style="margin-top: 25px;">Editar Perfíl</a>-->

              <h6 style="font-weight: bold; margin-top: 25px;">Información de Contacto</h6> 
              <h6>email: {{$datos_usuario[0]->EmailPersona}}</h6>
            </div>
            


        </div>
    </div>

    <div class="col-md-9">       
        <div class="card-docttus card-docttus-left" style=" height: auto !important; padding-top: 15px; padding-bottom: 0px;">
           <div class="row">

            <div class="col-md-3 tab-gen tab-activo">
               <a href="{{url('')}}/usuario">
                <h6>Información</h6> 
              </a>
            </div>
            @if(session('rol_solicitud')=="estudiante")
            <div class="col-md-3 tab-gen">              
              <a href="{{url('')}}/usuario-cursos">
                <h6>Cursos</h6> 
              </a>
            </div>

            <div class="col-md-3 tab-gen">                            
              <a href="{{url('')}}/usuario-habilidades">
                <h6>Habilidades</h6> 
              </a>
            </div>

            <div class="col-md-3 tab-gen">
              <a href="{{url('')}}/usuario-certificados">
                <h6>Certificados</h6> 
              </a>
            </div>
            @endif
             
           </div>
        </div>


        <div class="card-docttus card-docttus-left" style=" height: auto !important; text-align: left; margin-top: 25px;">            
          <h4 style="font-weight: bold;">Información de Contacto</h4>
          <form id="form-usuario">
            <div class="row" style="margin-top: 35px;">
                <div class="col-md-6">
                  @if(session('rol_solicitud')=="root")
                  <div class="form-group input-group-sm">                        
                    <label>Nombre Usuario</label>
                    <input id="NombreUsuario" type="text" name="nombre" class="form-control input-xs" value="{{($datos_usuario[0]->NombreUsuario)?$datos_usuario[0]->NombreUsuario:''}}">
                  </div>
                  @endif




                  <div class="form-group input-group-sm">                        
                    <label>Nombre(s)</label>
                    <input id="NombrePersona" type="text" name="nombre" class="form-control input-xs" value="{{($datos_usuario[0]->NombrePersona)?$datos_usuario[0]->NombrePersona:''}}">
                  </div>
                  

                  <div class="form-group input-group-sm">                        
                     <label>Apellidos(s)</label>
                     <input id="ApellidosPersona"  type="text" name="apellido" class="form-control"  value="{{($datos_usuario[0]->ApellidosPersona)?$datos_usuario[0]->ApellidosPersona:''}}">
                  </div>

                  <div class="form-group input-group-sm">                        
                     <label>Email</label>
                     <input @if(session('rol_solicitud')!="root") disabled @endif id="EmailPersona" type="email" name="nombre" class="form-control"  value="{{($datos_usuario[0]->EmailPersona)?$datos_usuario[0]->EmailPersona:''}}">
                  </div>

                  <div class="form-group input-group-sm">                        
                    <label>Foto</label>
                    <input id="FotoPersona" type="file" name="foto" class="form-control"  value="">
                  </div>


                </div>

                <div class="col-md-6">
                    
                    


                  <div class="form-group input-group-sm">                        
                     <label>Id / Identificación</label>
                     <input id="IdentificacionPersona" type="text" name="identificacion" class="form-control"  value="{{($datos_usuario[0]->IdentificacionPersona)?$datos_usuario[0]->IdentificacionPersona:''}}">
                  </div>

                  <div class="form-group input-group-sm">
                     <label>Teléfono / Celular</label>
                     <input id="TelefonoPersona" type="text" name="celular" class="form-control"  value="{{($datos_usuario[0]->TelefonoPersona)?$datos_usuario[0]->TelefonoPersona:''}}">
                  </div>

                  <div class="form-group input-group-sm">                        
                     <label>WhatsApp</label>
                     <input id="WhatsappPersona" type="text" name="whatsapp" class="form-control"  value="{{($datos_usuario[0]->WhatsappPersona)?$datos_usuario[0]->WhatsappPersona:''}}">
                  </div>

                </div>

                




              
            </div>

            <div class="row">
               <div class="col-md-4">
                  <input type="submit" name="" class="btn btn-secondary botones-docttus" style="margin-top: 25px;" value="Guardar">
               </div>
            </div>
          </form>

        </div>


        <!-- CAMBIO CONTRASEÑA -->
        <div class="card-docttus card-docttus-left" style=" height: auto !important; text-align: left; margin-top: 25px;">            
            <h4 style="font-weight: bold;">Cambio de Contraseña</h4>
            <form id="form-password">
              <div class="row" style="margin-top: 35px;">
  
                  <div class="col-md-4">

                    <div class="form-group input-group-sm">                        
                      <label>Contraseña Actual</label>
                      <input id="PasswordUsuario" type="password" name="telefono" class="form-control"  value="" required>
                   </div>
  
                    <div class="form-group input-group-sm">                        
                       <label>Nueva Contraseña</label>
                       <input id="PasswordUsuarioNuevo" type="password" name="telefono" class="form-control"  value="" required>
                    </div>
  
                    <div class="form-group input-group-sm">                        
                       <label>Repetir Contraseña</label>
                       <input id="RepetirPasswordUsuario" type="password" name="telefono" class="form-control"  value="" required>
                    </div>
                  </div>
  
                
              </div>
  
              <div class="row">
                 <div class="col-md-4">
                    <input type="submit" name="" class="btn btn-secondary botones-docttus" style="margin-top: 25px;" value="Cambiar Contraseña">
                 </div>
              </div>
            </form>



        </div>
        <!-- CAMBIO CONTRASEÑA -->

        @if(session('rol_solicitud')=="afiliado1" || session('rol_solicitud')=="tutor1")
        <!-- INFORMACIÓN BANCARIA -->
        <div class="card-docttus card-docttus-left" style=" height: auto !important; text-align: left; margin-top: 25px;">

          <h4 style="font-weight: bold;">Información Bancaria</h4>

          <form id="form-bancario">
            <div class="row" style="margin-top: 35px;">
              
              
                <div class="col-md-4">
                  <div class="form-group input-group-sm">                        
                    <label>Cuenta Paypal</label>
                    <input type="email" name="nombre" class="form-control" id="PaypalPersona" value="{{($datos_usuario[0]->PaypalPersona)?$datos_usuario[0]->PaypalPersona:''}}">
                  </div>


                  <div class="form-group input-group-sm">                        
                    <label>Cuenta Payoneer</label>
                    <input type="email" name="nombre" class="form-control" id="PayoneerPersona" value="{{($datos_usuario[0]->PayoneerPersona)?$datos_usuario[0]->PayoneerPersona:''}}">
                  </div>
                  
                </div>

                <div class="col-md-4">

                  <div class="form-group input-group-sm">                        
                    <label>No. Cuenta Bancaria</label>
                    <input type="text" name="nombre" class="form-control" id="NumeroBancoPersona" value="{{($datos_usuario[0]->NumeroBancoPersona)?$datos_usuario[0]->NumeroBancoPersona:''}}">
                  </div>

                  <div class="form-group input-group-sm">                        
                    <label>Nombre Banco</label>
                    <input type="text" name="nombre" class="form-control" id="NombreBancoPersona" value="{{($datos_usuario[0]->NombreBancoPersona)?$datos_usuario[0]->NombreBancoPersona:''}}">
                  </div>

                  <div class="form-group input-group-sm">                        
                    <label>Tipo Cuenta</label>
                    <select class="form-control" id="TipoCuentaPersona">
                      <option value="">-Seleccionar Tipo Cuenta-</option>
                      <option value="Ahorros">Cuenta de Ahorros</option>
                      <option value="Corriente">Cuenta Corriente</option>
                    </select>
                  </div>

                  
                </div>

                
              
            </div>

            <div class="row">
               <div class="col-md-4">
                  <input type="submit" name="" class="btn btn-secondary botones-docttus" style="margin-top: 25px;" value="Guardar">
               </div>
            </div>
          </form>
        </div>
        <!-- FIN INFORMACIÓN BANCARIA -->
        @endif

        <!-- INFORMACIÓN REDES SOCIALES -->
        <div class="card-docttus card-docttus-left" style=" height: auto !important; text-align: left; margin-top: 25px;">
          <h4 style="font-weight: bold;">Información de Redes Sociales</h4>
          <form id="form-redes-sociales">              
            <div class="row" style="margin-top: 35px;">
              
              
                <div class="col-md-4">
                  <div class="form-group input-group-sm">                        
                    <label>Facebook (URL)</label>
                    <input type="text" name="nombre" class="form-control" id="FacebookPersona" value="{{($datos_usuario[0]->FacebookPersona)?$datos_usuario[0]->FacebookPersona:''}}">
                  </div>


                  <div class="form-group input-group-sm">                        
                    <label>Twitter (URL)</label>
                    <input type="text" name="nombre" class="form-control" id="TwitterPersona" value="{{($datos_usuario[0]->TwitterPersona)?$datos_usuario[0]->TwitterPersona:''}}">
                  </div>

                  <div class="form-group input-group-sm">                        
                    <label>Instagram (URL)</label>
                    <input type="text" name="nombre" class="form-control" id="InstagramPersona" value="{{($datos_usuario[0]->InstagramPersona)?$datos_usuario[0]->InstagramPersona:''}}">
                  </div>
                </div>

                <div class="col-md-4">

                  <div class="form-group input-group-sm">                        
                    <label>Youtube (URL)</label>
                    <input type="text" name="nombre" class="form-control" id="YoutubePersona" value="{{($datos_usuario[0]->YoutubePersona)?$datos_usuario[0]->YoutubePersona:''}}">
                  </div>

                  <div class="form-group input-group-sm">                        
                    <label>Linkedin (URL)</label>
                    <input type="text" name="nombre" class="form-control" id="LinkedinPersona" value="{{($datos_usuario[0]->LinkedinPersona)?$datos_usuario[0]->LinkedinPersona:''}}">
                  </div>

                  <div class="form-group input-group-sm">                        
                    <label>Sitio Web (URL)</label>
                    <input type="text" name="nombre" class="form-control" id="WebPersona" value="{{($datos_usuario[0]->WebPersona)?$datos_usuario[0]->WebPersona:''}}">
                  </div>

                  
                </div>

                
              
            </div>

            <div class="row">
               <div class="col-md-4">
                  <input type="submit" name="" class="btn btn-secondary botones-docttus" style="margin-top: 25px;" value="Guardar">
               </div>
            </div>
          </form>
        </div>


        <!--INFORMACIÓN DEL PERFIL TUTOR -->
        @if(session('rol_solicitud')=="tutor" || session('rol_solicitud')=="root" )
        <div class="card-docttus card-docttus-left" style=" height: auto !important; text-align: left; margin-top: 25px;">            

          <h4 style="font-weight: bold;">Información</h4>
          <form id="form-tutor">              
            <div class="row" style="margin-top: 35px;">
              
              
                <div class="col-md-8">
                  <div class="form-group input-group-sm">                        
                    <label>Descripción del perfil.</label>
                    <textarea rows="5"  maxlength="600"  name="nombre" class="form-control  valida-caracteres" id="DescripcionPersona">{{($datos_usuario[0]->DescripcionPersona)?$datos_usuario[0]->DescripcionPersona:''}}</textarea>
                    <div class="text-right">
                      <small> <strong id="cant_caracteres_DescripcionPersona">0</strong> Carácteres Restantes</small>  
                    </div>              
                  </div>

                </div>                

                <div class="col-md-8">
                  <div class="form-group input-group-sm">                        
                    <label>Título Tutor</label>
                    <input class="form-control" type="text" id="TituloPersona"  value="{{($datos_usuario[0]->TituloPersona)?$datos_usuario[0]->TituloPersona:''}}" >
                  </div>

                </div>                
                
              
            </div>

            <div class="row">
               <div class="col-md-4">
                  <input type="submit" name="" class="btn btn-secondary botones-docttus" style="margin-top: 25px;" value="Guardar">
               </div>
            </div>
          </form>


        </div>
        @endif
        <!--INFORMACIÓN DEL PERFIL TUTOR -->


        <!--INFORMACIÓN DEL PERFIL TUTOR -->
        @if(session('rol_solicitud')=="tutor" || session('rol_solicitud')=="root"  || session('rol_solicitud')=="afiliado" )

          @if($data[0]->IdEstadoSolicitudTutor==1 || $data[0]->IdEstadoSolicitudAfiliado==1 )

        <div class="card-docttus card-docttus-left" style=" height: auto !important; text-align: left; margin-top: 25px;">            

          <h4 style="font-weight: bold;">Datos Hotmart</h4>
          <form id="form-hotmart">              
            <div class="row" style="margin-top: 35px;">
              
              
                <div class="col-md-8">
                  <div class="form-group input-group-sm">                        
                    <label>Token Hotmart</label>
                    <input class="form-control" type="text" id="TokenHotmart"  value="{{($datos_usuario[0]->TokenHotmart)?$datos_usuario[0]->TokenHotmart:''}}" >
                    <small>* Escribe tu token de hotmart. <a href="#" src_tutorial="https://www.youtube.com/embed/P70SQM1Cdtc" titulo_tutorial="Configurar Token Hotmart"  class="btn_tutorial_gen">Ver Tutorial</a></small>
                  </div>

                </div>                

                <div class="col-md-8">
                  <div class="form-group input-group-sm">                        
                    <label>Email Hotmart</label>
                    <input class="form-control" type="email" id="EmailHotmart"  value="{{($datos_usuario[0]->EmailHotmart)?$datos_usuario[0]->EmailHotmart:''}}" >
                    <small>* Escribe el email con el cuál estás registrado en hotmart.</small>
                    
                  </div>

                </div>                
                
              
            </div>

            <div class="row">
               <div class="col-md-4">
                  <input type="submit" name="" class="btn btn-secondary botones-docttus" style="margin-top: 25px;" value="Guardar">
               </div>
            </div>
          </form>


        </div>
        @endif
        @endif
        <!--INFORMACIÓN DEL PERFIL TUTOR -->





        <div class="card-docttus card-docttus-left" style=" height: auto !important; text-align: left; margin-top: 25px;">

          
          

            <button class="btn btn-danger"  data-toggle="modal" data-target="#modal_eliminar_cuenta">ELIMINAR CUENTA</button>

          <!-- Modal -->
            <div class="modal fade" id="modal_eliminar_cuenta" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">¿Estás seguro de eliminar tu cuenta?</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <form id="form-elimina-cuenta">
                    <div class="modal-body">                 
                      <ul>
                        <li>Todas tus afiliaciones serán canceladas;</li>
                        <li>Todos los productos que has creado serán bloqueados;</li>                  
                        <li>Tu saldo quedará en ceros.</li>
                        <li>Tu cuenta será cerrada.</li>                  
                      </ul>
                      <input class="form-control input-lg" type="password" placeholder="Password" id="password_eliminar" required>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                      <button type="submit" class="btn btn-primary">Eliminar Cuenta</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>


        </div>
    </div>

</div>








@stop

@section('scripts')

    
    <script type="text/javascript">


      $("#TipoCuentaPersona").val("{{($datos_usuario[0]->TipoCuentaPersona)?$datos_usuario[0]->TipoCuentaPersona:''}}");

      $("#form-usuario").submit(function(e){
        e.preventDefault();
        var NombrePersona=$("#NombrePersona").val();
        var ApellidosPersona=$("#ApellidosPersona").val();
        var EmailPersona=$("#EmailPersona").val();
        var IdentificacionPersona=$("#IdentificacionPersona").val();
        var TelefonoPersona=$("#TelefonoPersona").val();
        var WhatsappPersona=$("#WhatsappPersona").val();        

        var formData = new FormData();

        formData.append('NombrePersona', ""+NombrePersona);
        formData.append('ApellidosPersona', ""+ApellidosPersona);
        formData.append('EmailPersona', ""+EmailPersona);
        formData.append('IdentificacionPersona', ""+IdentificacionPersona);
        formData.append('TelefonoPersona', ""+TelefonoPersona);
        formData.append('WhatsappPersona', ""+WhatsappPersona);
        formData.append('_token', "{{ csrf_token() }}");        
        formData.append('codigousuario', "{{$codigousuario}}");        
        @if(session('rol_solicitud')=="root")
        formData.append('NombreUsuario', $("#NombreUsuario").val());
        @endif

        
        
        formData.append('FotoPersona', $('#FotoPersona')[0].files[0]);


         var request = $.ajax({
              url: "{{url('')}}/set_usuario",
              type: "POST",
              
              data: formData,
              processData: false,  // tell jQuery not to process the data
              contentType: false  // tell jQuery not to set contentType


            });

            request.done(function(obj) {                  
           
              if(obj.status=="ok"){                              
                    mensaje_generico("Correcto",""+obj.mensaje,"1","Continuar...",function(){
                      @if(session('rol_solicitud')=="root" && $codigousuario!="")
                      window.open("{{url('')}}/usuario/"+obj.codigo_usuario,"_parent");
                      @else
                      location.reload();
                      @endif
                    });
                return;
              }else{                  
                mensaje_generico("Error !",""+obj.mensaje,"2","Continuar...",function(){});
                return;
              }

            });
             

             //respuesta si falla
            request.fail(function(jqXHR, textStatus) {
              alert( "Error de servidor  " + textStatus );
            });


      });

      //FORMULARIO CAMBIAR CONTRASEÑA


      $("#form-password").submit(function(e){
        e.preventDefault();
        var PasswordUsuario=$("#PasswordUsuario").val();
        var PasswordUsuarioNuevo=$("#PasswordUsuarioNuevo").val();        
        var RepetirPasswordUsuario=$("#RepetirPasswordUsuario").val();

        if(PasswordUsuarioNuevo!=RepetirPasswordUsuario){
            mensaje_generico("Error !","Los passwords no coinciden","2","Continuar...",function(){});
            return;
        }        

        var formData = new FormData();

        formData.append('PasswordUsuario', ""+PasswordUsuario);
        formData.append('PasswordUsuarioNuevo', ""+PasswordUsuarioNuevo);
        formData.append('RepetirPasswordUsuario', ""+RepetirPasswordUsuario);
        formData.append('codigousuario', "{{$codigousuario}}");        
        
        
        formData.append('_token', "{{ csrf_token() }}");        
        


         var request = $.ajax({
              url: "{{url('')}}/set_password",
              type: "POST",
              
              data: formData,
              processData: false,  // tell jQuery not to process the data
              contentType: false  // tell jQuery not to set contentType


            });

            request.done(function(obj) {                  
           
              if(obj.status=="ok"){                              
                    mensaje_generico("Correcto",""+obj.mensaje,"1","Continuar...",function(){
                      @if(session('rol_solicitud')=="root" && $codigousuario!="")
                      window.open("{{url('')}}/usuario/"+obj.codigo_usuario,"_parent");
                      @else
                      location.reload();
                      @endif
                    });
                return;
              }else{                  
                mensaje_generico("Error !",""+obj.mensaje,"2","Continuar...",function(){});
                return;
              }

            });
             

             //respuesta si falla
            request.fail(function(jqXHR, textStatus) {
              alert( "Error de servidor  " + textStatus );
            });


      });


      


      //FORMULARIO PAGOS

      $("#form-bancario").submit(function(e){
        e.preventDefault();
        var PaypalPersona=$("#PaypalPersona").val();
        var PayoneerPersona=$("#PayoneerPersona").val();
        var NumeroBancoPersona=$("#NumeroBancoPersona").val();
        var NombreBancoPersona=$("#NombreBancoPersona").val();
        var TipoCuentaPersona=$("#TipoCuentaPersona").val();
       
        var formData = new FormData();

        formData.append('PaypalPersona', ""+PaypalPersona);
        formData.append('PayoneerPersona', ""+PayoneerPersona);
        formData.append('NumeroBancoPersona', ""+NumeroBancoPersona);
        formData.append('NombreBancoPersona', ""+NombreBancoPersona);
        formData.append('TipoCuentaPersona', ""+TipoCuentaPersona);
        formData.append('_token', "{{ csrf_token() }}");        



         var request = $.ajax({
              url: "{{url('')}}/set_financiero",
              type: "POST",
              
              data: formData,
              processData: false,  // tell jQuery not to process the data
              contentType: false  // tell jQuery not to set contentType


            });

            request.done(function(obj) {                  
           
              if(obj.status=="ok"){                              
                    mensaje_generico("Correcto",""+obj.mensaje,"1","Continuar...",function(){
                      location.reload();
                    });
                return;
              }else{                  
                mensaje_generico("Error !",""+obj.mensaje,"2","Continuar...",function(){});
                return;
              }

            });
             

             //respuesta si falla
            request.fail(function(jqXHR, textStatus) {
              alert( "Error de servidor  " + textStatus );
            });


      });

            //FORMULARIO redes sociales

      $("#form-redes-sociales").submit(function(e){
        e.preventDefault();

        var FacebookPersona=$("#FacebookPersona").val();
        var TwitterPersona=$("#TwitterPersona").val();
        var InstagramPersona=$("#InstagramPersona").val();
        var YoutubePersona=$("#YoutubePersona").val();
        var LinkedinPersona=$("#LinkedinPersona").val();
        var WebPersona=$("#WebPersona").val();
       
        var formData = new FormData();

        formData.append('FacebookPersona', ""+FacebookPersona);
        formData.append('TwitterPersona', ""+TwitterPersona);
        formData.append('InstagramPersona', ""+InstagramPersona);
        formData.append('YoutubePersona', ""+YoutubePersona);
        formData.append('LinkedinPersona', ""+LinkedinPersona);
        formData.append('WebPersona', ""+WebPersona);        
        formData.append('_token', "{{ csrf_token() }}");
        formData.append('codigousuario', "{{$codigousuario}}");        



         var request = $.ajax({
              url: "{{url('')}}/set_redes_sociales",
              type: "POST",
              
              data: formData,
              processData: false,  // tell jQuery not to process the data
              contentType: false  // tell jQuery not to set contentType


            });

            request.done(function(obj) {                  
           
              if(obj.status=="ok"){                              
                    mensaje_generico("Correcto",""+obj.mensaje,"1","Continuar...",function(){
                      @if(session('rol_solicitud')=="root" && $codigousuario!="")
                      window.open("{{url('')}}/usuario/"+obj.codigo_usuario,"_parent");
                      @else
                      location.reload();
                      @endif
                    });
                return;
              }else{                  
                mensaje_generico("Error !",""+obj.mensaje,"2","Continuar...",function(){});
                return;
              }

            });
             

             //respuesta si falla
            request.fail(function(jqXHR, textStatus) {
              alert( "Error de servidor  " + textStatus );
            });


      });




      @if(session('rol_solicitud')=="tutor" || session('rol_solicitud')=="root" )
      $("#form-tutor").submit(function(e){
        e.preventDefault();

        var DescripcionPersona=$("#DescripcionPersona").val();
        var TituloPersona=$("#TituloPersona").val();
        
       
        var formData = new FormData();

        formData.append('DescripcionPersona', ""+DescripcionPersona);
        formData.append('TituloPersona', ""+TituloPersona);
        formData.append('codigousuario', "{{$codigousuario}}");        
        
        formData.append('_token', "{{ csrf_token() }}");        



         var request = $.ajax({
              url: "{{url('')}}/set_descripcion_persona",
              type: "POST",
              
              data: formData,
              processData: false,  // tell jQuery not to process the data
              contentType: false  // tell jQuery not to set contentType


            });

            request.done(function(obj) {                  
           
              if(obj.status=="ok"){                              
                    mensaje_generico("Correcto",""+obj.mensaje,"1","Continuar...",function(){
                      @if(session('rol_solicitud')=="root" && $codigousuario!="")
                      window.open("{{url('')}}/usuario/"+obj.codigo_usuario,"_parent");
                      @else
                      location.reload();
                      @endif
                    });
                return;
              }else{                  
                mensaje_generico("Error !",""+obj.mensaje,"2","Continuar...",function(){});
                return;
              }

            });
             

             //respuesta si falla
            request.fail(function(jqXHR, textStatus) {
              alert( "Error de servidor  " + textStatus );
            });


      });

      @endif

      @if(session('rol_solicitud')=="tutor" || session('rol_solicitud')=="root"  || session('rol_solicitud')=="afiliado" )

          @if($data[0]->IdEstadoSolicitudTutor==1 || $data[0]->IdEstadoSolicitudAfiliado==1 )

          

          $("#form-hotmart").submit(function(e){
            e.preventDefault();

            var TokenHotmart=$("#TokenHotmart").val();
            var EmailHotmart=$("#EmailHotmart").val();
            var formData = new FormData();

            formData.append('TokenHotmart', ""+TokenHotmart);
            formData.append('EmailHotmart', ""+EmailHotmart);
            formData.append('codigousuario', "{{$codigousuario}}");                
            formData.append('_token', "{{ csrf_token() }}");

              var request = $.ajax({
                    url: "{{url('')}}/set_hotmart_usuario",
                    type: "POST",
                    
                    data: formData,
                    processData: false,  // tell jQuery not to process the data
                    contentType: false  // tell jQuery not to set contentType


                  });

                  request.done(function(obj) {                  
                
                    if(obj.status=="ok"){                              
                          mensaje_generico("Correcto",""+obj.mensaje,"1","Continuar...",function(){
                            @if(session('rol_solicitud')=="root" && $codigousuario!="")
                            window.open("{{url('')}}/usuario/"+obj.codigo_usuario,"_parent");
                            @else
                            location.reload();
                            @endif
                          });
                      return;
                    }else{                  
                      mensaje_generico("Error !",""+obj.mensaje,"2","Continuar...",function(){});
                      return;
                    }

                  });
                  

                  //respuesta si falla
                  request.fail(function(jqXHR, textStatus) {
                    alert( "Error de servidor  " + textStatus );
                  });


            });


          @endif
      @endif


      





      $("#form-elimina-cuenta").submit(function(e){
        e.preventDefault();

        var password_eliminar=$("#password_eliminar").val();
        
       
        var formData = new FormData();

        formData.append('password_persona', ""+password_eliminar);        
        formData.append('_token', "{{ csrf_token() }}");    
        formData.append('codigousuario', "{{$codigousuario}}");            



         var request = $.ajax({
              url: "{{url('')}}/eliminar_cuenta",
              type: "POST",
              data: formData,
              processData: false,  // tell jQuery not to process the data
              contentType: false  // tell jQuery not to set contentType


            });

            request.done(function(obj) {                  
           
              if(obj.status=="ok"){                              
                    mensaje_generico("Correcto",""+obj.mensaje,"1","Continuar...",function(){
                      @if(session('rol_solicitud')=="root" && $codigousuario!="")
                      window.open("{{url('')}}/usuario/"+obj.codigo_usuario,"_parent");
                      @else
                      location.reload();
                      @endif
                    });
                return;
              }else{                  
                mensaje_generico("Error !",""+obj.mensaje,"2","Continuar...",function(){});
                return;
              }

            });
             

             //respuesta si falla
            request.fail(function(jqXHR, textStatus) {
              alert( "Error de servidor  " + textStatus );
            });


      });


      


      

    </script>
@stop