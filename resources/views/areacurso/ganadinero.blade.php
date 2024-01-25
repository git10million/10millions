@extends('areacurso.plantillas.plantilla-area-interna')
@section('contenido')   


    <div class="row">



        <div class="col-md-8">


          <section class="seccion-blanca" style="padding-top: 35px;">
            <div class="container">
              <div class="row">
                <div class="col-md-12" style="text-align: left;">
                  <h1 style="font-size: 41px; font-weight: 300;">¿Qué tenemos para tí?</h1>
                </div>
              </div>

              <div class="row" style="margin-top: 55px;">
                

                <div class="col-md-4" style="text-align: left;">
                  <h2 style="font-size: 35px; font-weight: 300;">Únete Gratis</h2>
                  <p style="font-weight: 300;">Registrarse solo toma unos minutos y es completamente GRATIS. Recibirá un código de seguimiento único para usar en su sitio web de inmediato.</p>
                </div>

                <div class="col-md-4" style="text-align: left;">
                  <h2 style="font-size: 35px; font-weight: 300;">Seguimiento confiable</h2>
                  <p style="font-weight: 300;">Nuestro seguimiento personalizado está codificado en nuestra plataforma. Utilizamos tecnología avanzada y personalizada para garantizar que siempre obtenga crédito por cada referencia.</p>
                </div>

                <div class="col-md-4" style="text-align: left;">
                  <h2 style="font-size: 35px; font-weight: 300;">Equipo dedicado</h2>
                  <p style="font-weight: 300;">Nuestros gerentes afiliados están comprometidos a ayudarlo a tener éxito. Siempre están disponibles con soporte, información y asesoramiento personalizado.</p>
                </div>

              

              </div>

            </div>
          </section>



          <section class="seccion-blanca"  style="padding-top: 45px;">
            <div class="container">
              <div class="row">
                <div class="col-md-12" style="text-align: left;">
                  @if($tipo=="tutor")
                    <h3  style="font-weight: bold;">PREGUNTAS FRECUENTES DEL PROGRAMA DE TUTORES</h3>
                  @elseif($tipo=="afiliado")
                    <h3  style="font-weight: bold;">PREGUNTAS FRECUENTES DEL PROGRAMA DE AFILIADOS</h3>
                  @else
                  <h3  style="font-weight: bold;">PREGUNTAS FRECUENTES DEL PROGRAMA DE AFILIADOS/TUTORES</h3>
                  @endif

                  <br>

                  <h5 style="font-weight: bold;">¿Cuánto puedo ganar?</h5>
                  <p>¡Ofrecemos tasa de comisión muy competitiva! Cuanto más promociones más ganarás</p>

                  <br>

                  <h5 style="font-weight: bold;">¿Qué aparecerá en mi sitio web?</h5>
                  <p>¡Eso depende de ti! ¡Puedes elegir de entre cualquiera de tus cursos y cualquiera de nuestros enlaces o banners!</p>

                  <br>

                  <h5 style="font-weight: bold;">¿Tengo acceso a promociones y descuentos especiales?</h5>
                  <p>¡Sí! Como afiliado, tendrás acceso a cupones exclusivos para los afiliados, descuentos y contenido único.</p>

                  <br>


                  <h5 style="font-weight: bold;">¿Cuánto tiempo necesito para empezar?</h5>
                  <p>Regístrate hoy y revisaremos tu solicitud en 1 o 2 días hábiles.</p>

                  <br>                           



                </div>
              </div>
            </div>
          </section>


        </div>

        <div class="col-md-4">
            
          @if($tipo=="afiliado" || $tipo=="" )
            <div class="row row-docttus" style="margin-top: 30px;">
              <div class="col-md-12">

                <div class="card-docttus card-docttus-right-1" style=" background-color: #0b5586; color: #fff; text-align: center; height: auto !important;">
                    @if($data[0]->IdEstadoSolicitudAfiliado=="1")
                    <h2>Eres Afiliado Docttus</h2>
                    <h5>Ahora puedes Ganar hasta un 50% en comisiones promoviendo nuestros cursos</h5>
                    <p>Mira nuestro catálogo de cursos para que empieces a ofertar</p>
                    <a href="{{url('')}}/cursos/mercado" class="btn btn-warning" disabled style="margin-top: 15px;">VER MERCADO</a>                    
                    @elseif($data[0]->IdEstadoSolicitudAfiliado=="2")

                      <h2>Estamos Procesando tu solicitud</h2>
                      <h5>En 24 a 48 horas daremos respuesta a tu solcitud</h5>
                      <button class="btn btn-warning" disabled style="margin-top: 15px;">SOLICITUD EN PROCESO</button>

                    @elseif($data[0]->IdEstadoSolicitudAfiliado=="3")

                      <h2>Tu Solicitud ha sido rechazada</h2>
                      <h5>Te hemos enviado un correo con las observaciones detectadas, puedes enviarnos un correo a info@docttus.com y apelar tu solicitud.</h5>
                      <button class="btn btn-danger" disabled style="margin-top: 15px;">SOLICITUD RECHAZADA</button>

                    @elseif($data[0]->IdEstadoSolicitudAfiliado=="" || $data[0]->IdEstadoSolicitudAfiliado=="0" )
                    <h2>Conviertete en un Afiliado</h2>
                    <h5>Solicita el ingreso al programa de afiliados de docttus y gana hasta un 50% vendiendo nuestros cursos.</h5>
                    <button class="btn btn-warning" style="margin-top: 15px;" id="btn_solicitud_afiliado">Aplicar Como Afiliado</button>
                    @endif
                    
                    
                </div>
              </div>
            </div>
            @endif

             
            @if($tipo=="tutor"  || $tipo=="" )
            <div class="row row-docttus" style="margin-top: 30px;">
              <div class="col-md-12">

                <div class="card-docttus card-docttus-right-1" style=" background-color: #0c7eab; color: #fff; text-align: center; height: auto !important;">   



                     @if($data[0]->IdEstadoSolicitudTutor=="1")
                    <h2>Eres Tutor Docttus</h2>
                    <h5>Ahora puedes Ganar desde un  25% a un 75% en comisiones creando tus cursos.</h5>
                    <p>Empieza ahora y crea tu primer curso</p>
                    <a href="{{url('')}}/cursos/crear" class="btn btn-warning" disabled style="margin-top: 15px;">CREAR CURSO</a>                    
                    @elseif($data[0]->IdEstadoSolicitudTutor=="2")

                      <h2>Estamos Procesando tu solicitud</h2>
                      <h5>En 24 a 48 horas daremos respuesta a tu solcitud</h5>
                      <button class="btn btn-warning" disabled style="margin-top: 15px;">SOLICITUD EN PROCESO</button>

                    @elseif($data[0]->IdEstadoSolicitudTutor=="3")

                      <h2>Tu Solicitud ha sido rechazada</h2>
                      <h5>Te hemos enviado un correo con las observaciones detectadas, puedes enviarnos un correo a info@docttus.com y apelar tu solicitud.</h5>
                      <button class="btn btn-danger" disabled style="margin-top: 15px;">SOLICITUD RECHAZADA</button>

                    @elseif($data[0]->IdEstadoSolicitudTutor=="" || $data[0]->IdEstadoSolicitudTutor=="0" )
                    <h2>Conviertete en Tutor</h2>
                    <h5>y Gana hasta un entre un 25% a un 75% promocionando con tu propio curso.</h5>                    
                    <button class="btn btn-warning" style="margin-top: 15px;" id="btn_solicitud_tutor">Aplicar Como Tutor</button>
                    @endif

                </div>
              </div>
            </div>
            @endif
        </div>



      </div>
        


        <!-- ventas emergentes -->

    
        

        


        <!-- Modal -->
        <div class="modal fade" id="modal-solicitud" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel2" aria-hidden="true">
          <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel2">Aplicar como afiliados</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">                                   
                  <p style="font-size: 14px;">Escribe como te desempeñas en el marketing digital o como promoverás nuestros cursos.  Que redes utilizas y que estrategias desempeñas para ofrecer infoproductos. Hay que tener presente que en Docttus odiamos el SPAM, si vemos que no cumples con nuestras políticas, no podrás ser parte de nuestra comunidad de afiliados</p>
                  
                  <form id="FormSolicitudAfiliado">
                    <textarea required style="background-color: #fafafa;" class="form-control" placeholder="Escribe Aquí Tu Solicitud..." id="SolicitudAfiliado" rows="5"></textarea>  
                  </form>
                  

                  
              </div>
              <div class="modal-footer">
                <button class="btn btn-warning botones-docttus" id="btn_enviar_solicitud_afiliado" >Enviar Solicitud</button>
                <button type="button" class="btn btn-danger" style="border-radius: 25px;" data-dismiss="modal">Cerrar</button>                

              </div>
            </div>
          </div>
        </div>




        <!-- Modal -->
        <div class="modal fade" id="modal-solicitud-tutor" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel2" aria-hidden="true">
          <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel2">Aplicar como tutor</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">                                   
                  <p style="font-size: 14px;">Escríbenos sobre que deseas hacer tu curso y como piensas promoverlo, si tienes algún material para poder tomar la mejor decisión puedes poner tus enlaces también, o enviarnos un adjunto a info@docttus.com </p>
                  
                  <form id="FormSolicitudTutor">
                    <textarea required style="background-color: #fafafa;" class="form-control" placeholder="Escribe Aquí Tu Solicitud..." id="SolicitudTutor" rows="5"></textarea>  
                  </form>
                  

                  
              </div>
              <div class="modal-footer">
                <button class="btn btn-warning botones-docttus" id="btn_enviar_solicitud_tutor" >Enviar Solicitud</button>
                <button type="button" class="btn btn-danger" style="border-radius: 25px;" data-dismiss="modal">Cerrar</button>                

              </div>
            </div>
          </div>
        </div>
        


@stop

@section('scripts')

    
    <script type="text/javascript">

    

    /*var randomScalingFactor = function() {
      return Math.round(Math.random() * 100);
    };

    var config = {
      type: 'doughnut',
      data: {
        datasets: [{
          data: [
            25,
            25,
            25            
          ],
          backgroundColor: [
              'rgba(255, 99, 132, 1)',
              'rgba(54, 162, 235, 1)',
              'rgba(255, 206, 86, 1)',
          ],
          label: 'Dataset 1'
        }],
        labels: [
          'Completo',
          'En Progreso',
          'Por Iniciar',
        ]
      },
      options: {
         

        responsive: true,
        legend: {
          position: 'bottom',
          "labels": {
                "fontSize": 20,
                "padding":45
          }
        },
        
        title: {
          display: false,
          text: 'Chart.js Doughnut Chart'
        },
        animation: {
          animateScale: true,
          animateRotate: true
        }
      }
    };

    var ctx = document.getElementById('chart-area').getContext('2d');
    window.myDoughnut = new Chart(ctx, config);*/

    

    function alerta(mensaje,tipomensaje){
        
            $("#mensaje_principal").modal("show");
            $("#titulo_mensaje").html(""+mensaje);
        
    }


    $("#btn_solicitud_afiliado").click(function(e){
      e.preventDefault();
      abrir_modal_solicitud();
    });
    function abrir_modal_solicitud(){
      $("#SolicitudAfiliado").val(""); 
      $("#modal-solicitud").modal("show");
    }





    $("#btn_solicitud_tutor").click(function(e){
      e.preventDefault();
      abrir_modal_solicitud_tutor();
    });
    function abrir_modal_solicitud_tutor(){
      $("#SolicitudTutor").val(""); 
      $("#modal-solicitud-tutor").modal("show");
    }


    $("#btn_enviar_solicitud_afiliado").click(function(e){
      e.preventDefault();
      $("#FormSolicitudAfiliado").submit();
    });

    $("#FormSolicitudAfiliado").submit(function(e){
       e.preventDefault();
       enviar_solicitud(1);
    });


    $("#btn_enviar_solicitud_tutor").click(function(e){
      e.preventDefault();
      $("#FormSolicitudTutor").submit();
    });

    
    $("#FormSolicitudTutor").submit(function(e){
       e.preventDefault();
       enviar_solicitud(2);
    });

    function enviar_solicitud(tipo){
      var SolicitudTexto="";
      if(tipo=="1"){
        SolicitudTexto=""+$("#SolicitudAfiliado").val();
      }else{
        SolicitudTexto=""+$("#SolicitudTutor").val();
      }

      var formData = new FormData();
      formData.append('TextoSolicitud', SolicitudTexto);      
      formData.append('TipoSolicitud', tipo);      
      
      guardar_informacion(formData,"enviar_solicitud");
    }


    function guardar_informacion(campos,funcionlv){
        
        campos.append('_token', "{{ csrf_token() }}");                

        
        var request = $.ajax({
            url: "{{url('')}}/"+funcionlv,
            type: "POST",
            data: campos,
            processData: false,  // tell jQuery not to process the data
            contentType: false  // tell jQuery not to set contentType
          });

          request.done(function(obj) { 
             if(obj.status=="ok"){            
                $("#responder_comentarios").modal("hide");
                mensaje_generico("Correcto",""+obj.mensaje,"1","Continuar...",function(){
                  location.reload();
                });

                return;
             }else{
                $("#responder_comentarios").modal("hide");
                mensaje_generico("Error !",""+obj.mensaje,"2","Continuar...",function(){});
                return;
             }
          });
           //respuesta si falla
          request.fail(function(jqXHR, textStatus) {
            alert( "Error de servidor  " + textStatus );
          });


      }


    </script>
@stop