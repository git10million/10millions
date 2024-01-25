@extends('areacurso.plantillas.plantilla-area-interna')
@section('contenido')   

@if(session('rol_login')=="1")
    <div class="row">
       <div class="col-md-8">
       
            <div class="row row-docttus">
              <div class="col-md-12">
                 <h1 style="font-weight: 600; font-size: 20px;">Progreso Estudio</h1>
              </div>
            </div>
            
            <div class="row row-docttus" style="margin-top: 30px;">
              <div class="col-md-6">

                 <div class="card-docttus card-docttus-right-1">
                    <h3 class="subtitulos">Habilidades</h3>
                    @if(count($habilidades)>1)
                    <a href="#" class="btn-ver-mas"   data-toggle="modal" data-target="#habilidades-actuales">Más</a>
                    @endif
                    <?php
                      $contador_hab=0;
                    ?>
                    @foreach($habilidades as $habilidad)
                       <?php
                       $contador_hab++;
                        ?>
                       @if($contador_hab<=16)
                       <img src="{{url('')}}/assets/images/habilidades/{{$habilidad->IconoHabilidad}}" class="habiliadd">
                       @endif
                    @endforeach


                    @if(count($habilidades)==0)
                    <center>
                      <p style="margin-top: 69px;">AÚN NO TIENES HABILIDADES </p>
                    </center>
                    @endif

                 </div>


                 <!--<div class="card-docttus card-docttus-left">
                     <h3 class="subtitulos">Estadísticas</h3>
                     
                     <center>
                      <canvas id="chart-area" width="100" height="100"></canvas>                   
                     </center>
                     

                     
                     
                 </div>

               -->
              </div>
              <div class="col-md-6">            

                 <div class="card-docttus card-docttus-right-1">
                    <h3 class="subtitulos">Logros Alcanzados</h3>
                    <!--<a href="#" class="btn-ver-mas"   data-toggle="modal" data-target="#logros-actuales">Ver Más</a>-->
                    <center>
                      <p style="margin-top: 69px;">AÚN NO TIENES LOGROS</p>
                    </center>
                    
                 </div>
              </div>
            </div>


            @if(count($historial_lecciones))
        <div class="row row-docttus" style="margin-top: 30px;">
            <div class="col-md-12">
               <h1 style="font-weight: 600; font-size: 20px;">Seguir Viendo</h1>
            </div>
            <?php
                $cant_leccion=0;
            ?>
              @foreach($historial_lecciones as $lecciones)   

              <?php
                $cant_leccion++;
                ?>

              <!--  tarjeta Curso -->                    
                  <div class="col-md-6" style="position: relative; margin-top: 25px;">
                     <div class="card-docttus card-docttus-left" style=" height: auto !important;">
                        <div class="row">
                          <div class="col-12">
                             <h5 style="font-weight: bold; height: 56px; font-size: 18px;">{{$lecciones->NombreTema}}</h5>
                          </div>                          
                        </div>
                        <div class="row">
                          <div class="col-md-12">
                            

                            <a href="{{url('')}}/leccion/{{$lecciones->CodigoTema}}">
                                <div style="position: relative; height: 200px;width: 100%; ">

                                  <div style="background-color: #ccc; position: absolute; background-color:#0b5586bf; height: 200px;width: 100%;  ">
                                    <h5 style="width: 100%; text-align: center; color: #fff; margin-top: 95px;">Lección No. {{$cant_leccion}}</h5>
                                  </div>

                                  <div style="width:100%; height: 200px; background-image: url({{url('')}}/assets/images/cursos/{{$lecciones->ImagenCurso}}); background-size: cover; background-position: center; background-repeat: no-repeat; ">
                                    
                                  </div>
                                  
                                </div>
                                
                              </a>




                          </div>
                        </div>
                     </div>
                  </div>                        
                  <!--  tarjeta Curso -->                        
              @endforeach
        </div>
        @endif


        </div>


        <div class="col-md-4">            
            
            <div class="row row-docttus" style="margin-top: 30px;">
              <div class="col-md-12">

                <div class="card-docttus card-docttus-right-1" style=" background-color: #0b5586; color: #fff; text-align: center; height: auto !important;">
                   <h3 style="color: #fff;">Noticias Docttus</h3>
                    
                </div>
              </div>
            </div>
            
        </div>



      </div>
        


        <!-- ventas emergentes -->

      <!-- Modal -->
        <div class="modal fade" id="habilidades-actuales" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel2" aria-hidden="true">
          <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel2">Habilidades Adquiridas</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">                                   
                @foreach($habilidades as $habilidad)                   
                   <img src="{{url('')}}/assets/images/habilidades/{{$habilidad->IconoHabilidad}}" class="habiliadd">                   
                @endforeach
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary botones-docttus" data-dismiss="modal">Cerrar</button>                
              </div>
            </div>
          </div>
        </div>


        <!-- Modal -->
        <div class="modal fade" id="estadisticas-actuales" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Estadísticas</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">                 
                 [graph]=chart.2345
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary botones-docttus" data-dismiss="modal">Cerrar</button>                
              </div>
            </div>
          </div>
        </div>

         <!-- Modal -->
        <div class="modal fade" id="logros-actuales" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Logros Adquiridos</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">                 
                  <div class="row">
                    <div class="col-md-12" style="height: 350px; overflow-y: auto;">
                       <img src="assets/images/progreso.png" style="width: 100%;">
                        <img src="assets/images/progreso.png" style="width: 100%;">
                        <img src="assets/images/progreso.png" style="width: 100%;">
                        <img src="assets/images/progreso.png" style="width: 100%;">
                        <img src="assets/images/progreso.png" style="width: 100%;">
                        <img src="assets/images/progreso.png" style="width: 100%;">
                        <img src="assets/images/progreso.png" style="width: 100%;">
                        <img src="assets/images/progreso.png" style="width: 100%;">
                    </div>
                  </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary botones-docttus" data-dismiss="modal">Cerrar</button>                
              </div>
            </div>
          </div>
        </div>




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

        
@else


 <div class="row row-docttus">
      <div class="col-md-8">
         

         <a href="{{url('')}}/billetera" type="button" class="btn btn-secondary botones-docttus">Configurar Billetera</a>                
         <a href="{{url('')}}/usuario" type="button" class="btn btn-secondary botones-docttus">Configurar Datos</a>
         <a href="{{url('')}}/cursos/mercado" type="button" class="btn btn-secondary botones-docttus">Productos Para Vender</a>                
        
        <hr>

        <div class="row row-docttus" style="margin-top: 45px;">
            <div class="col-md-12">
              <h5>Tu Desempeño en Docttus</h5>
            </div>
            <div class="col-md-4" style="position: relative; margin-top: 25px;">
              <div class="card-docttus card-docttus-left" style=" height: 200px !important; text-align: center;">
                  <h4>Ventas</h4>
                  <h1>{{count($info_ventas)}}</h1>
                  <a href="{{url('')}}/listado-usuarios" type="button" class="btn btn-secondary botones-docttus">Ver Ventas</a>                
              </div>
            </div>            

            <div class="col-md-4" style="position: relative; margin-top: 25px;">
              <div class="card-docttus card-docttus-left" style=" height: 200px !important; text-align: center;">
                  <h4>Saldo Disponible</h4>
                  <h1>${{$info_billetera[0]->SaldoDisponible}}</h1>
                  <a href="{{url('')}}/billetera" type="button" class="btn btn-secondary botones-docttus">Retirar Dinero</a>                
              </div>
            </div>            

            <div class="col-md-4" style="position: relative; margin-top: 25px;">
              <div class="card-docttus card-docttus-left" style=" height: 200px !important; text-align: center;">
                  <h4>Saldo en Canje</h4>
                  <h1>${{$info_billetera[0]->SaldoCanje}}</h1>
                  <a href="{{url('')}}/listado-usuario-canje" type="button" class="btn btn-secondary botones-docttus">Ver Ventas Canje</a>                
              </div>
            </div>            
        </div>

        <div class="row row-docttus" style="margin-top: 45px;">
            <div class="col-md-12">
              <h5>Docttus Te Enseña Cumplir Tus Metas</h5>
            </div>

            <div class="col-md-6" style="position: relative; margin-top: 25px;">
              <div class="card-docttus card-docttus-left" style=" height: auto !important; text-align: center;">
                <h6>1. Que es Marketing de Afiliados?</h6>
                <div class="embed-responsive embed-responsive-16by9">
                    <iframe style="border-radius: 11px;" class="embed-responsive-item" src="https://www.youtube.com/embed/32QgYtadn6E"  allow="autoplay; fullscreen" allowfullscreen></iframe>
                </div>
              </div>              
            </div>

            <div class="col-md-6" style="position: relative; margin-top: 25px;">
              <div class="card-docttus card-docttus-left" style=" height: auto !important; text-align: center;">
                <h6>2. Escoger a un nicho de mercado</h6>
                <div class="embed-responsive embed-responsive-16by9">
                    <iframe style="border-radius: 11px;" class="embed-responsive-item" src="https://www.youtube.com/embed/32QgYtadn6E"  allow="autoplay; fullscreen" allowfullscreen></iframe>
                </div>
              </div>
            </div>


        </div>

      </div>

     <div class="col-md-4">
            <div class="row row-docttus">
              <div class="col-md-12">
                 <h1>Afiliados Docttus</h1>
              </div>
            </div>
            
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
        </div>

      

  </div>
@endif

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