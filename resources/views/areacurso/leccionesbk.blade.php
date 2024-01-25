@extends('areacurso.plantillas.plantilla-lecciones')
@section('contenido')   





<div class="row row-docttus">
    <div class="col-md-8">
       <h4>Lección No. {{$info_leccion->OrdenTema}} {{$info_leccion->NombreTema}}</h4>       
       <p>{!!$info_leccion->DescripcionTema!!}</p>
    </div>

    <div class="col-md-4" style="text-align: right;">
        @foreach($info_habilidades as $habilidad)
          <img src="{{url('')}}/assets/images/habilidades/{{$habilidad->IconoHabilidad}}" class="habiliadd">
        @endforeach

    </div>
</div>
        
<div class="row row-docttus" style="margin-top: 10px;">
  <div class="col-md-8">
    @if($info_leccion->IdTipoTema==1)

      @foreach($info_media as $media)
        @if($media->TipoMedia==1)
        <div class="card-docttus card-docttus-left" style=" height: auto !important; margin-bottom: 25px;">
            <div class="embed-responsive embed-responsive-16by9">
                <iframe style="border-radius: 11px;" class="embed-responsive-item" src="{{$media->URLMedia}}"  allow="autoplay; fullscreen" allowfullscreen></iframe>
            </div>
         </div>
         @endif
       @endforeach

     @endif
     
     @if($info_leccion->IdTipoTema==2)
      <div class="card-docttus card-docttus-left" style=" height: auto !important;">
          {{$info_leccion->DescripcionlargaTema}}
      </div>
     @endif


     <div class="card-docttus card-docttus-left" style=" height: auto !important; margin-top: 20px;">
      @if($info_leccion->EstadoTemaAvance==1)
        <button class="btn botones-docttus btn-vista" style="margin-top: 15px;" id="btn_marcar_como_vista"><i class="fa fa-check-circle" aria-hidden="true"></i>  Finalizada</button>
      @else
        <button class="btn botones-docttus" style="margin-top: 15px;" id="btn_marcar_como_vista"><i class="fa fa-check-circle-o" aria-hidden="true"></i>
 Marca Como Vista</button>
      @endif

        @if(count($info_siguiente)>0)
        <a class="btn botones-docttus" href="{{url('')}}/leccion/{{$info_siguiente[0]->CodigoTema}}" style="margin-top: 15px; float: right;">Siguiente Lección</a>
        @endif
     </div>

     
    @if(count($info_evaluaciones))
     <div class="card-docttus card-docttus-left" style="height: auto !important; margin-top: 20px;">

       <h5>Completa el siguiente cuestionario</h5>
       <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Praesentium veniam nobis numquam obcaecati optio sequi dolor nulla culpa exercitationem inventore accusantium cum beatae explicabo voluptas soluta blanditiis magni, aspernatur dolorum?</p>

       <input type="radio" name="respuesta" checked style="width: 33px; height: 24px; float: left;"> Fanpage</br></br>
       <input type="radio" name="respuesta" style="width: 33px; height: 24px; float: left;"> Facebook Ads</br></br>
       <input type="radio" name="respuesta" style="width: 33px; height: 24px; float: left;"> Google Ads</br></br>
       <input type="radio" name="respuesta" style="width: 33px; height: 24px; float: left;"> Marketing de Afiliados</br></br>
       <input type="radio" name="respuesta" style="width: 33px; height: 24px; float: left;"> Todas las Anteriores</br></br>
       
        <button class="btn botones-docttus" style="margin-top: 15px;">Siguiente Pregunta</button>

     </div>
     @endif

  
      <ul class="nav nav-tabs" id="tab-ficha-curso" role="tablist" style="    background-color: #dadada; margin-top: 25px;" >
        <li class="nav-item" style="width: 33%; text-align: center;     background-color: #dadada;">
          <a class="nav-link active" style="color: #000;" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Descripción</a>
        </li>
        <li class="nav-item" style="width: 33%; text-align: center;     background-color: #dadada;">
          <a class="nav-link" id="profile-tab"  style="color: #000;" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Comentarios</a>
        </li>
        <li class="nav-item"  style="width: 34%; text-align: center;     background-color: #dadada;">
          <a class="nav-link"  style="color: #000;" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Archivos</a>
        </li>
      </ul>
      <div class="tab-content" id="myTabContent" style=" border:1px solid #ccc; border-top: none;">
        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">

             @if($info_leccion->IdTipoTema!=2)                              
               <div class="descripcion-curso">
                   {!!utf8_encode($info_leccion->DescripcionlargaTema)!!}
               </div>
            @endif

        </div>

        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">


            
            <div class="descripcion-curso">
            <h4>Comentarios ({{count($info_comentarios)}})</h4>  

               
              <textarea class="form-control" placeholder="Deja tu comentario o duda"></textarea>

              <br />

               <div class="list-group">
                  @foreach($info_comentarios as $comentario)
                    @if($comentario->IdComentarioPadre=="")
                    
                      <div class="list-group-item list-group-item-action btn_comentario">
                        <div class="d-flex w-100 justify-content-between">
                          <h5 class="mb-1 nombre_comentario_{{$comentario->IdComentario}}">{{$comentario->NombrePersona}}</h5>
                          <small>{{$comentario->FechaModificacion}}</small>
                        </div>
                        <p class="mb-1 mensaje_comentario_{{$comentario->IdComentario}}">{{$comentario->MensajeComentario}}</p>
                        <a href="#">
                          <small>Responder</small>
                        </a>                        
                      </div>
                        @foreach($info_comentarios as $comentarioRespuesta)
                          @if($comentarioRespuesta->IdComentarioPadre==$comentario->IdComentario)
                              <div class="list-group-item list-group-item-action btn_comentario" style="padding-left: 85px;  background-color: #fafafa;">
                                <div class="d-flex w-100 justify-content-between">
                                  <h5 class="mb-1 nombre_comentario_{{$comentarioRespuesta->IdComentario}}">{{$comentarioRespuesta->NombrePersona}}</h5>
                                  <small class="text-muted">{{$comentarioRespuesta->FechaModificacion}}</small>
                                </div>
                                <p class="mb-1 mensaje_comentario_{{$comentarioRespuesta->IdComentario}}">{{$comentarioRespuesta->MensajeComentario}}</p>
                                <a href="#">
                                  <small class="text-muted">Responder</small>
                                </a>                                
                              </div>
                          @endif
                        @endforeach

                    @endif

                  @endforeach             
                </div>

              </div>
           
           


        </div>

        <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">



            <div class="descripcion-curso">
                <?php
                    $exist_documents=0;
                    for($ik=0;$ik<count($info_media);$ik++){
                       if($info_media[$ik]->TipoMedia==2){
                          $exist_documents=1;
                          break;
                       }
                    }
                ?>
                
                @if($exist_documents==1)
                
                <div class="list-group" style="margin-top: 25px;">
                  @foreach($info_media as $media)
                    @if($media->TipoMedia==2)
                      <a href="{{url('')}}/documentos/{{$media->URLMedia}}" target="_blank" download class="list-group-item list-group-item-action">Marketing Digital.pdf</a>
                    @endif
                  @endforeach      
                  
                </div>
                @endif
            </div>



        </div>


      </div>




      



  </div>

  <div class="col-md-4">
      <div class="card-docttus card-docttus-left" style=" height: auto !important;">
    
                    <?php 
                      $contador_modulos=0;
                    ?>
    
                    @foreach($info_modulos as $modulo)

                    <?php
                      $contador_modulos++;
                      $abrir_acordion="";
                      if($modulo->IdModulo==$info_leccion->IdModulo){
                        $abrir_acordion="show";
                      }
                    ?>
                    
                    <div id="accordion_lecciones_{{$modulo->IdModulo}}" class="acordion_ficha" style="background-color: #f3f3f3; padding: 0px; margin-bottom: 5px;"> 
                    <!-- INICIO MODULO -->

                      <button class="btn btn-info" data-toggle="collapse" data-target="#collapse_{{$modulo->IdModulo}}" aria-expanded="true" aria-controls="collapse_{{$modulo->IdModulo}}" style="margin-top: 0px; width: 100%; text-align: left;">
                           <strong>{{$modulo->NombreModulo}} </strong>
                      </button>                   
                      

                      <div id="collapse_{{$modulo->IdModulo}}" class="collapse {{$abrir_acordion}} contenedor-lecciones" aria-labelledby="headingOne" data-parent="#accordion_lecciones_{{$modulo->IdModulo}}">                       
                          
                         
                      
                      
                          <!-- ITEM LECCIÓN -->
                           @foreach($info_lecciones as $leccion)
                              @if($modulo->IdModulo == $leccion->IdModulo)
                                    <?php 
                                      $color_sel="transparent;";


                                      


                                      if($info_leccion->IdTema ==$leccion->IdTema){
                                          $color_sel="#ccc;";
                                      }

                                      $icono_visualizacion='<i class="fa fa-circle-o" aria-hidden="true"></i>';

                                      foreach($info_lecciones_estado as $estadoleccion){
                                        if($estadoleccion->IdTema==$leccion->IdTema && $estadoleccion->EstadoTemaAvance==1){
                                            $icono_visualizacion='<i style="color:#19d2d1;" class="fa fa-circle" aria-hidden="true"></i>';
                                        }
                                      }

                                    ?>
                                    
                                  
                                    <a  href="{{url('')}}/leccion/{{$leccion->CodigoTema}}" style="cursor: pointer; width: 100%; padding-top: 10px; padding-bottom: 10px; display: inline-block; border-bottom: 1px solid #e2e2e2; padding-left: 15px; background-color: {{$color_sel}}; color: #000; text-decoration: none;">
                                                                    
                                          <span><span id="clase_{{$leccion->IdTema}}">{!!$icono_visualizacion!!}</span> {{$leccion->NombreTema}}</span>
                                        

                                  
                                    </a>
                                  


                                  @endif
                               <!-- FIN ITEM LECCIÓN -->
                               @endforeach


                      

                      </div>                   

                      <!-- fin MODULO -->
                      </div>

                      @endforeach

    

      </div>
      
  </div>
 
</div>


  <!-- Modal COMENTARIOS -->



    <div class="modal fade" id="responder_comentarios" tabindex="-1" role="dialog" aria-labelledby="titulo_comentario_modal" aria-hidden="true">
      <div class="modal-dialog" role="document">
        
        <form id="form_comentario">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="titulo_comentario_modal">Responder Comentario</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">                 
              <div class="row">
                <div class="col-md-12">
                    <div class="alert alert-secondary" role="alert" id="contain_comentario">
                       <p><strong id="comentario_nombre_persona"></strong>: <br/><span id="comentario_descripcion"></span></p>
                       
                    </div>
                    <small>Respuesta Comentario: </small>
                   <textarea class="form-control" id="RespuestaComentario" rows="5" required></textarea>               
                </div>
              </div>
          </div>
          <div class="modal-footer">
            <center>
                <button type="submit" class="btn btn-secondary botones-docttus">Enviar Comentario</button>
            </center>
          </div>
        </div>
        </form>
        
      </div>
    </div>
        


@stop

@section('scripts')

    
<script type="text/javascript">
    
    @if($info_leccion->EstadoTemaAvance==1)
      var id_estado_actual=1;
    @else
      var id_estado_actual=0;
    @endif
    $("#btn_marcar_como_vista").click(function(e){       
        if(id_estado_actual==1){
          id_estado_actual=0;
        }else{
          id_estado_actual=1;
        }
        set_avance(id_estado_actual);
    });

    function set_avance(idestado){

      var request = $.ajax({
        url: "{{url('')}}/set_avance",
        type: "POST",
        data:{               
             idtema:"{{$info_leccion->IdTema}}",
             idusuario:"{{$data[0]->IdUsuarioPersona}}",
             tipoavance:"1",
             idestado:idestado,
             _token: "{{ csrf_token() }}"
        }
      });

      request.done(function(obj) { 
         if(obj.status=="ok"){
            if(idestado=="1"){              
              id_estado_actual=1;
              $("#btn_marcar_como_vista").addClass("btn-vista");
              $("#btn_marcar_como_vista").html('<i class="fa fa-check-circle" aria-hidden="true"></i> Finalizada');

              $("#clase_{{$info_leccion->IdTema}}").html('<i class="fa fa-circle"  style="color:#19d2d1;" aria-hidden="true"></i>');

            }else{
              $("#btn_marcar_como_vista").removeClass("btn-vista");
              $("#btn_marcar_como_vista").html('<i class="fa fa-check-circle-o" aria-hidden="true"></i> Marca Como Vista');

              $("#clase_{{$info_leccion->IdTema}}").html('<i class="fa fa-circle-o" aria-hidden="true"></i>');
              
              
              id_estado_actual=0;
            }
            mensaje_generico("Correcto",""+obj.mensaje,"1","Continuar...",function(){});
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
    }


    

    var id_comentario_sel="";
    var id_respuesta_sel="";
   function responder_comentarios(id_coment,id_respuesta){
      id_comentario_sel=""+id_coment;
      id_respuesta_sel=""+id_respuesta;
      
      var id_comentario_princ=""+id_coment;

      if(id_coment!=id_respuesta){
        id_comentario_princ=""+id_respuesta;
      }

      $("#contain_comentario").show();

      $("#titulo_comentario_modal").html("Responder Comentario");

      var nombre_comentario=$(".nombre_comentario_"+id_comentario_princ).html();
      var mensaje_comentario=$(".mensaje_comentario_"+id_comentario_princ).html();
      $("#comentario_nombre_persona").html(""+nombre_comentario);
      $("#comentario_descripcion").html(""+mensaje_comentario);      

      $("#RespuestaComentario").val("");
      $("#responder_comentarios").modal("show");

   }

   $("#form_comentario").submit(function(e){
      e.preventDefault();
      enviar_comentario();
   });

   $("#btn_nuevo_comentario").click(function(e){    
     e.preventDefault();
     $("#titulo_comentario_modal").html("Nuevo Comentario");
     $("#contain_comentario").hide();
     $("#responder_comentarios").modal("show");

     id_comentario_sel="null";
     id_respuesta_sel="null";

     $("#RespuestaComentario").val("");

   });


   function enviar_comentario(){
      var mensaje_nuevo=$("#RespuestaComentario").val();
      var request = $.ajax({
          url: "{{url('')}}/set_comentarios",
          type: "POST",
          data:{               
               idtema:"{{$info_leccion->IdTema}}",
               idcomentario:""+id_comentario_sel,
               idrespuesta:""+id_respuesta_sel,             
               mensaje:""+mensaje_nuevo,
               idusuario:"{{$data[0]->IdUsuarioPersona}}",
               _token: "{{ csrf_token() }}"
          }
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


















