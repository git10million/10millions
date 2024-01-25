@extends('areacurso.plantillas.plantilla-lecciones')
@section('contenido')   
      
<style type="text/css">
  .col-izq{
    
  }
  .col-der{
    width: 326px;
    padding: 0px; margin: 0px; height: 100vh;  overflow-y: hidden; background-color: #242746; 
  }
  .col-contenido{
     height: 93vh;
  }
  .col-contenido iframe{
    width: 100%;
    height: 93vh;
  }

  .contenido-texto{
    height: 93vh; 
    width: 100%; 
    color: #fff; 
    padding: 15px; 
    font-size: 13px; 
    font-weight: 300; 
    color: #fff;  
    overflow-y: auto;
  }

  .estrella_curso{
    font-size: 40px;
    color: #242746;
    margin-right: 5px;
    text-decoration: none;
  }

  .estrella_curso:hover{
    text-decoration: none; 
    color: #242746;
  }

  .respuesta_fila_contenedor{
    display: none;
  }

  .fila_respuesta{
    
    margin: 0px; padding: 0px; padding-left: 25px; margin-bottom: 15px; padding-bottom: 10px;
  }

.contenedor_respuesta{
  display: none;
}
  

  /* width */
::-webkit-scrollbar {
  width: 7px;
}

/* Track */
::-webkit-scrollbar-track {
  box-shadow: inset 0 0 5px grey; 
  border-radius: 10px;
}
 
/* Handle */
::-webkit-scrollbar-thumb {
  background: #ccc; 
  border-radius: 10px;
}

/* Handle on hover */
::-webkit-scrollbar-thumb:hover {
  background: #ccc; 
}

@media only screen and (max-width: 991px) {
    .col-der{
       width: 100%;
    }
    .col-izq{
      width: 100% !important;
      display: contents;
      height: auto;
    }

   body,html{
        background-color: #0f1124;
        overflow-y: auto; /* Hide vertical scrollbar */
  overflow-x: auto; /* Hide horizontal scrollbar */
      }

      .col-contenido{
        height: auto;
      }

      .botones-docttus{
         font-size: 12px;
      }
}

</style>
<div class="row" style="margin-top: 10px; padding: 0px; margin: 0px;">
  <div class="col col-izq" style="padding: 0px; margin: 0px; ">
    @if($info_leccion->IdTipoTema==1)

      @foreach($info_media as $media)
        @if($media->TipoMedia==1)
        
            <div class="col-contenido embed-responsive embed-responsive-16by9">
              <iframe  class="embed-responsive-item"  style="" src="{{$media->VideoEmbed}}" frameborder="0"  allow="autoplay; fullscreen" allowfullscreen></iframe>  
            </div>

            <!-- 16:9 aspect ratio -->
            
            
            
         @endif
       @endforeach

     @endif
     
     @if($info_leccion->IdTipoTema==2)
      <div class="contenido-texto">
          <h3>{{$info_leccion->NombreTema}}</h3>
          {{$info_leccion->DescripcionlargaTema}}
      </div>
     @endif


     <div class="" style=" height: auto !important; padding:15px; width: 100%;">
      @if(session('rol_solicitud')!="root")
          @if($info_leccion->EstadoTemaAvance==1)
            <button class="btn botones-docttus btn-vista" id="btn_marcar_como_vista"><i class="fa fa-check-circle" aria-hidden="true"></i>  Finalizada</button>
          @else
            <button class="btn botones-docttus" id="btn_marcar_como_vista"><i class="fa fa-check-circle-o" aria-hidden="true"></i>
     Marca Como Vista</button>
          @endif
      @endif

        @if(count($info_siguiente)>0)
        <a class="btn botones-docttus" href="{{url('')}}/leccion/{{$info_siguiente[0]->CodigoTema}}" style="float: right;">Siguiente Lección</a>
        @endif
     </div>
  </div>

  <div class="col-der">

      <div style="width: 100%; height: 56px; z-index: 9999; padding: 5px;">          
           <div class="row" style="margin: 0px; padding: 0px;">

              <div class="col" style="position: relative;">
                  <a href="{{url('')}}/curso/{{$curso->SlugCurso}}" id="btn_atras" style="color: #fff; font-size: 34px; position: relative;" data-toggle="tooltip" data-placement="bottom" title="Atrás" >

                    <i class="fa fa-angle-left" aria-hidden="true"></i>

                  </a>
                  
              </div>

              <div class="col" style="position: relative;">
                  <a href="#" id="btn_archivos" style="color: #fff; font-size: 38px; position: relative;" data-toggle="tooltip" data-placement="bottom" title="Descargar archivos de esta lección" >

                    <?php
                      $cant_documents=0;
                      for($ik=0;$ik<count($info_media);$ik++){
                         if($info_media[$ik]->TipoMedia==2){
                            $cant_documents++;                            
                         }
                      }
                    ?>

                    @if($cant_documents>0)
                    <span style="position: absolute; color: #fff; background-color: #c11616; width: 20px; height: 20px; top: -2px; font-size: 11px;    right: -11px; text-align: center; border-radius: 25px;  padding-top: 2px;">{{$cant_documents}}</span>
                    @endif


                    <i class="fa fa-folder-open-o" aria-hidden="true"></i>  
                  </a>
                  
              </div>
              <div class="col">
                <a href="#" id="btn_comentario" style="color: #fff; font-size: 38px;" data-toggle="tooltip" data-placement="bottom" title="Calificar Curso" >
                    <i class="fa fa-star-o" aria-hidden="true"></i>
                </a>
              </div>

              <div>
                <a style="width: 40px; height: 40px; display: inline-block;" href="#" id="btn_usuario" >
                  <img src="{{url('')}}/assets/images/usuarios/{{$data[0]->FotoPersona}}" style="width: 100%;" style="border-radius: 45px;">
                </a>

                <div class="dropdown-menu dropdown-menu-sm" id="context-menu">
                  <a class="dropdown-item" href="#">Action</a>
                  <a class="dropdown-item" href="#">Another action</a>
                  <a class="dropdown-item" href="#">Something else here</a>
                </div>

              </div>



           </div>
          

      </div>

      <div style="width: 100%; height: 116px; background-color: #31354c; padding:16px;">
        <h6 style="color: #fff;font-weight: 300; font-size: 13px;">Curso:</h6>
        <h4 style="color: #fff; font-size:23px; font-weight: 300;">{{$curso->NombreCurso}}</h4>        
      </div>

      <ul class="nav nav-tabs" id="tab-ficha-curso" role="tablist" style="    background-color: #dadada; height: 34px;" >

        <li class="nav-item" style="width: 33%; text-align: center;     background-color: #dadada;">
          <a class="nav-link active" style="color: #000; padding:6px; font-size: 13px;" id="mdoulos-tab" data-toggle="tab" href="#modulos" role="tab" aria-controls="mdoulos" aria-selected="true">Módulos</a>
        </li>
        @if($info_leccion->IdTipoTema!=2)                              
        <li class="nav-item" style="width: 33%; text-align: center;     background-color: #dadada;">
          <a class="nav-link" style="color: #000; padding:6px;  font-size: 13px;" id="infotema-tab" data-toggle="tab" href="#infotema" role="tab" aria-controls="infotema" aria-selected="true">Descripción</a>
        </li>
        @endif
        <li class="nav-item" style="width: 33%; text-align: center;     background-color: #dadada;">
          <a class="nav-link" id="comentarios-tab"  style="color: #000;  padding:6px;  font-size: 13px;" data-toggle="tab" href="#comentarios" role="tab" aria-controls="comentarios" aria-selected="false">Comentarios</a>
        </li>       
      </ul>


      <div class="tab-content" id="myTabContent" style=" border-top: none; overflow-y: auto;">
        <!-- INICIO MODULOS -->
        <div class="tab-pane fade show" id="comentarios" role="tabpanel" aria-labelledby="comentarios-tab">


            <div style="width: 100%; padding: 15px; color: #fff;">
            <h4 style="font-size: 15px;">Comentarios ({{count($info_comentarios)}})</h4>  

               <form id="formulario_comentario_0">
                  <textarea class="form-control" required placeholder="Deja tu comentario o duda" id="comentario_nuevo" style="font-size: 13px;"></textarea>
                  <div style="width: 100%; text-align: right;">
                     <button class="btn" style="color: #19d1d1;" type="submit">Enviar</b>                 
                  </div>   
               </form>
              

              <br />

               <div style="width: 100%;">
                  @foreach($info_comentarios as $comentario)
                    @if($comentario->IdComentarioPadre=="")
                        
                        <div class="row" style="margin: 0px; padding: 0px; margin-bottom: 15px; padding-bottom: 10px;">
                          
                        
                          <div style="width: 40px; height: 40px; border-radius: 25px; background-size: cover; background-position: center; background-repeat: no-repeat; background-image: url({{url('')}}/assets/images/usuarios/{{$comentario->FotoPersona}});">                          
                          </div>
                          <div class="col">
                            <h5 style="font-size:14px; color: #fff; padding: 0px; margin: 0px;">{{$comentario->NombreUsuario}}</h5>
                            <small style="font-size: 10px; margin-top: -1px; display: block;">{{$comentario->fecha_hace}}</small>
                          </div>

                          <div style="width: 100%; color: #fff; margin-top: 20px; ">
                            <p style="font-size: 14px; font-weight: 300;">{{$comentario->MensajeComentario}}</p>
                            <a href="#" style="color: #fff; font-size: 13px;"  onclick="abrir_form_respuesta({{$comentario->IdComentario}})">
                              <i class="fa fa-commenting-o" aria-hidden="true"></i> Responder
                            </a>

                            <div style="width: 100%;" class="contenedor_respuesta" id="contenedor_respuesta_{{$comentario->IdComentario}}">
                                <form id="formulario_comentario_{{$comentario->IdComentario}}" class="form_comentario">
                                  <textarea class="form-control" placeholder="Deja tu comentario o duda" id="comentario_nuevo_{{$comentario->IdComentario}}" required style="font-size: 13px;"></textarea>
                                  <div style="width: 100%; text-align: right;">
                                     

                                     <input type="hidden" id="id_comentario_{{$comentario->IdComentario}}" value="{{$comentario->IdComentario}}">
                                     <input type="hidden" id="id_comentario_respuesta_{{$comentario->IdComentario}}" value="">


                                     <button type="submit" style="color: #19d1d1;" id_comentario="{{$comentario->IdComentario}}" class="btn_enviar btn" id="btn_enviar_{{$comentario->IdComentario}}">Enviar</button>
                                  </div>
                                </form>

                            </div>

                          </div>


                          
                          <br /><br />
                          @if($comentario->cant_respuesta>0)
                          <a href="#"  onclick="abrir_respuesta({{$comentario->IdComentario}})">
                          <h5 style="font-size: 14px; color: #19d1d1; margin-top: 15px;">Mostrar {{$comentario->cant_respuesta}} Respuestas <span style="padding-top: 3px;display: inline-block; height: 20px; font-size: 22px;"><i style="font-size: 16px;" class="fa fa-angle-down" aria-hidden="true"></i> </span></h5>
                          </a>
                          @endif

                        </div>                       


                         <div class="respuesta_fila_contenedor" id="respuesta_fila_{{$comentario->IdComentario}}">
                           
                         
                         @foreach($info_comentarios_hijo as $comentarioRespuesta)
                          @if($comentarioRespuesta->IdComentarioPadre==$comentario->IdComentario)
                            

                              <div class="row fila_respuesta">
                          
                                
                                  <div style="width: 40px; height: 40px;  border-radius: 25px; background-size: cover; background-position: center; background-repeat: no-repeat; background-image: url({{url('')}}/assets/images/usuarios/{{$comentarioRespuesta->FotoPersona}});">                          
                                  </div>
                                  <div class="col">
                                    <h5 style="font-size:14px; color: #fff; padding: 0px; margin: 0px;">{{$comentarioRespuesta->NombreUsuario}}</h5>
                                    <small style="font-size: 10px; margin-top: -1px; display: block;">{{$comentarioRespuesta->fecha_hace}}</small>
                                  </div>

                                  <div style="width: 100%; color: #fff; margin-top: 20px; ">
                                    <p style="font-size: 14px; font-weight: 300;">{{$comentarioRespuesta->MensajeComentario}}</p>

                                    <a href="#" style="color: #fff; font-size: 13px;"  onclick="abrir_form_respuesta('{{$comentarioRespuesta->IdComentario}}')">
                                      <i class="fa fa-commenting-o" aria-hidden="true"></i> Responder
                                    </a>

                                    <div style="width: 100%;" class="contenedor_respuesta" id="contenedor_respuesta_{{$comentarioRespuesta->IdComentario}}">
                                        <form id="formulario_comentario_{{$comentarioRespuesta->IdComentario}}" class="form_comentario">
                                  <textarea class="form-control" placeholder="Deja tu comentario o duda" id="comentario_nuevo_{{$comentarioRespuesta->IdComentario}}" required style="font-size: 13px;"></textarea>
                                  <div style="width: 100%; text-align: right;">
                                     

                                     <input type="hidden" id="id_comentario_{{$comentarioRespuesta->IdComentario}}" value="{{$comentario->IdComentario}}">
                                     <input type="hidden" id="id_comentario_respuesta_{{$comentarioRespuesta->IdComentario}}" value="{{$comentarioRespuesta->IdComentario}}">


                                     <button type="submit" style="color: #19d1d1;" id_comentario="{{$comentarioRespuesta->IdComentario}}" class="btn_enviar btn" id="btn_enviar_{{$comentarioRespuesta->IdComentario}}">Enviar</button>
                                  </div>
                                </form>

                                    </div>

                                  </div>
                                  
                            </div>           


                          @endif
                        @endforeach

                        </div>
                        <hr style="border-top: 1px solid rgba(255, 255, 255, 0.24);">


                    @endif

                  @endforeach             
                </div>

              </div>


        </div>
        <div class="tab-pane fade show active" id="modulos" role="tabpanel" aria-labelledby="modulos-tab">
          <div style=" height: auto !important; ">
    
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
            
            <div id="accordion_lecciones_{{$modulo->IdModulo}}" class="acordion_ficha" style="background-color: #31354c; color:#fff; padding: 0px; margin-bottom: 5px;"> 
            <!-- INICIO MODULO -->

              <button class="btn btn-info" data-toggle="collapse" data-target="#collapse_{{$modulo->IdModulo}}" aria-expanded="true" aria-controls="collapse_{{$modulo->IdModulo}}" style="margin-top: 0px; width: 100%; text-align: left; border-radius: 0px;">
                   <strong>{{$modulo->NombreModulo}} </strong><br/>
                   <span style="font-size: 12px;   margin-top: -6px;  padding: 0px;  display: block;">{{$modulo->cantidad_lecciones}} Lecciones</span>                   
              </button>                   
              

              <div id="collapse_{{$modulo->IdModulo}}" class="collapse {{$abrir_acordion}} contenedor-lecciones" aria-labelledby="headingOne" data-parent="#accordion_lecciones_{{$modulo->IdModulo}}">                       
                  
                 
              
              
                  <!-- ITEM LECCIÓN -->
                   @foreach($info_lecciones as $leccion)
                      @if($modulo->IdModulo == $leccion->IdModulo)


                            <?php 
                              $color_sel="transparent;";


                              


                              if($info_leccion->IdTema ==$leccion->IdTema){
                                  $color_sel="#4b506b;";
                              }

                              $icono_visualizacion='<i  style="font-size:15px;" class="fa fa-circle-o" aria-hidden="true"></i>';
                              if(session('rol_solicitud')!="root"){
                                foreach($info_lecciones_estado as $estadoleccion){
                                  if($estadoleccion->IdTema==$leccion->IdTema && $estadoleccion->EstadoTemaAvance==1){
                                      $icono_visualizacion='<i style="color:#19d2d1; font-size:15px;" class="fa fa-circle" aria-hidden="true"></i>';
                                  }
                                }
                              }

                            ?>
                            
                          
                            <a  href="{{url('')}}/leccion/{{$leccion->CodigoTema}}" style="cursor: pointer; width: 100%; padding-top: 10px; padding-bottom: 10px; display: inline-block; border-bottom: 1px solid #e2e2e2; padding-left: 15px; color: #fff; text-decoration: none; font-size: 13px; background-color: {{$color_sel}}; ">
                                                            
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
        <!-- FIN MODULOS -->

        <!-- INFO TEMA -->
        <div class="tab-pane fade show" id="infotema" role="tabpanel" aria-labelledby="infotema-tab">
          @if($info_leccion->IdTipoTema!=2)                              
               <div class="descripcion-curso" style="padding:12px; font-size: 13px; color: #fff;">
                   {!!utf8_encode($info_leccion->DescripcionlargaTema)!!}
               </div>
            @endif
        </div>



      </div>



      
      
  </div>
 
</div>




<!-- Modal -->
<div class="modal fade" id="modal-archivos" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Descargar Archivos</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        
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
          
          <div class="list-group">
            @foreach($info_media as $media)
              @if($media->TipoMedia==2)
                <a href="{{url('')}}/documentos/{{$media->URLMedia}}" target="_blank" download class="list-group-item list-group-item-action">  
                    <i class="fa fa-download" aria-hidden="true"></i> {{$media->NombreMedia}}
                </a>
              @endif
            @endforeach      
            
          </div>
          @endif

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>        
      </div>
    </div>
  </div>
</div>


<!-- Modal -->
<div class="modal fade" id="modal-valoracion" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Valorar Curso</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
         <center>
           <h4>Hasta el momento ¿Cómo calificarías este curso?</h4>
           <div style="display: inline-block; padding:10px; background-color: #fff;" id="contenedor_estrellas">
               <a href="#" class="estrella_curso" id="btn_estrella_curso_1" star="1">
                 <i class="fa fa-star-o" aria-hidden="true"></i>
               </a>

               <a href="#" class="estrella_curso" id="btn_estrella_curso_2" star="2">
                 <i class="fa fa-star-o" aria-hidden="true"></i>
               </a>

               <a href="#" class="estrella_curso" id="btn_estrella_curso_3" star="3">
                 <i class="fa fa-star-o" aria-hidden="true"></i>
               </a>

               <a href="#" class="estrella_curso" id="btn_estrella_curso_4" star="4">
                 <i class="fa fa-star-o" aria-hidden="true"></i>
               </a>

               <a href="#" class="estrella_curso" id="btn_estrella_curso_5" star="5">
                 <i class="fa fa-star-o" aria-hidden="true"></i>
               </a>
           </div>
           <h4>Cuéntanos ¿Qué te pareció este curso?</h4>
           <textarea class="form-control" rows="4" id="ComentarioCalificacion" placeholder="Escribe un comentario..."></textarea>

           <button class="btn botones-docttus" id="btn_enviar_comentario" style="margin-top: 25px;">Enviar</button>

         </center>

      </div>      
    </div>
  </div>
</div>



<!-- Modal -->
<div class="modal fade" id="modal-usuario" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header" style="padding: 1px;  padding-left: 17px; padding-right: 12px;">
        <h5 class="modal-title" id="exampleModalLabel">Usuario</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
         <center>
            
            <div class="list-group">            
                <a href="{{url('')}}/usuario" target="_parent"  class="list-group-item list-group-item-action" style="text-align: left;">  
                    <i class="fa fa-arrow-right" aria-hidden="true"></i> Editar Usuario
                </a>                        

                <a href="{{url('')}}/cursos/disponibles" target="_parent"  class="list-group-item list-group-item-action" style="text-align: left;">  
                    <i class="fa fa-arrow-right" aria-hidden="true"></i> Mis Cursos
                </a>                        

                <a href="{{url('')}}/billetera" target="_parent" class="list-group-item list-group-item-action" style="text-align: left;">  
                    <i class="fa fa-arrow-right" aria-hidden="true"></i> Billetera
                </a>                        



                <a href="{{url('')}}/logout" target="_parent" class="list-group-item list-group-item-action" style="text-align: left;">  
                    <i class="fa fa-arrow-right" aria-hidden="true"></i> Cerrar Sesión
                </a>                        
          </div>

         </center>
      </div>      
    </div>
  </div>
</div>



@stop

@section('scripts')

    
<script type="text/javascript">

  $(function () {
    $('[data-toggle="tooltip"]').tooltip();
    tamano_panel();
    

    @if(count($valoracion)>0)
      calificacion_estrella={{$valoracion[0]->ValorCalificacion}};
    @endif

    set_estrella(calificacion_estrella);
  })
  
  

  function tamano_panel(){
    var alto_panel=210;
    var total_panel=$(".col-der").outerHeight();

    var alto_tab=total_panel-alto_panel;

    $("#myTabContent").css("height",alto_tab+"px");
  }

  $( window ).resize(function() {
    tamano_panel();
  });


    @if(session('rol_solicitud')!="root")
      @if($info_leccion->EstadoTemaAvance==1)
        var id_estado_actual=1;
      @else
        var id_estado_actual=0;
      @endif
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


    


   

  $("#btn_archivos").click(function(e){
    e.preventDefault();
     $("#modal-archivos").modal("show");
  });

  $("#btn_comentario").click(function(e){
    e.preventDefault();
    $("#modal-valoracion").modal("show");
  });

  $("#btn_estrella_curso_1").mouseover(function(e){
    set_estrella(1);        
  });

  $("#btn_estrella_curso_2").mouseover(function(e){
    set_estrella(2);        
  });

  $("#btn_estrella_curso_3").mouseover(function(e){
    set_estrella(3);        
  });

  $("#btn_estrella_curso_4").mouseover(function(e){
    set_estrella(4);        
  });

  $("#btn_estrella_curso_5").mouseover(function(e){
    set_estrella(5);        
  });


  $("#contenedor_estrellas").mouseout(function(e){
      limpiar_estrellas();
  });

  var calificacion_estrella=0;
  $("#btn_estrella_curso_1").click(function(e){
     e.preventDefault();
     calificacion_estrella=1;
  });

  $("#btn_estrella_curso_2").click(function(e){
     e.preventDefault();
     calificacion_estrella=2;
  });

  $("#btn_estrella_curso_3").click(function(e){
     e.preventDefault();
     calificacion_estrella=3;
  });

  $("#btn_estrella_curso_4").click(function(e){
     e.preventDefault();
     calificacion_estrella=4;
  });

  $("#btn_estrella_curso_5").click(function(e){
     e.preventDefault();
     calificacion_estrella=5;
  });




  function set_estrella(id_estrella){
    //.attr("star")   

    for(var i=1;i<=5;i++){
       if(i<=id_estrella){
          $("#btn_estrella_curso_"+i+" > i ").removeClass("fa-star-o");
          $("#btn_estrella_curso_"+i+" > i ").addClass("fa-star");
       }else{          
          $("#btn_estrella_curso_"+i+" > i ").removeClass("fa-star-o");
          $("#btn_estrella_curso_"+i+" > i ").addClass("fa-star-o");          

       }
    }

  }

  function limpiar_estrellas(){
    for(var i=1;i<=5;i++){     
        if(calificacion_estrella=="" || calificacion_estrella<i ){
          $("#btn_estrella_curso_"+i+" > i ").addClass("fa-star-o");
          $("#btn_estrella_curso_"+i+" > i ").removeClass("fa-star");  
        }
    }
  }

  $("#btn_enviar_comentario").click(function(e){
    e.preventDefault();
    enviar_calificacion();
  });

  function enviar_calificacion(){

      var ComentarioCalificacion=$("#ComentarioCalificacion").val();


      if(calificacion_estrella==""){
          mensaje_generico("Error !","Debes seleccionar una calificación","2","Continuar...",function(){});
          return;
      }

      var request = $.ajax({
          url: "{{url('')}}/setcalificacion",
          type: "POST",
          data:{               
               IdCurso:"{{$info_leccion->IdCurso}}",               
               ObservacionCalificacion:""+ComentarioCalificacion,
               ValorCalificacion:""+calificacion_estrella,

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

  
  function abrir_respuesta(id_comentario){
    if(!$("#respuesta_fila_"+id_comentario).is(':visible')){
      $("#respuesta_fila_"+id_comentario).show();
    }else{
      $("#respuesta_fila_"+id_comentario).hide();
    }    
  }


  function abrir_form_respuesta(id_comentario){
    if(!$("#contenedor_respuesta_"+id_comentario).is(':visible')){
      $("#contenedor_respuesta_"+id_comentario).show();
    }else{
      $("#contenedor_respuesta_"+id_comentario).hide();
    }    
  }

  
  $("#formulario_comentario_0").submit(function(e){
    e.preventDefault();
    var mensaje=$("#comentario_nuevo").val();
    var id_comentario_sel="";
    var id_respuesta_sel="";
    enviar_comentario(mensaje,id_comentario_sel,id_respuesta_sel);
  });

  function enviar_comentario(mensaje,id_comentario_sel,id_respuesta_sel){
      
      var request = $.ajax({
          url: "{{url('')}}/set_comentarios",
          type: "POST",
          data:{               
               idtema:"{{$info_leccion->IdTema}}",
               idcomentario:""+id_comentario_sel,
               idrespuesta:""+id_respuesta_sel,             
               mensaje:""+mensaje,
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


  $(".btn_enviar").click(function(e){
    var id_comentario=$("#"+e.target.id).attr("id_comentario");
    var mensaje=$("#comentario_nuevo_"+id_comentario).val();
    var id_comentario_sel=""+$("#id_comentario_"+id_comentario).val();
    var id_respuesta_sel=""+$("#id_comentario_respuesta_"+id_comentario).val();;

    console.log(id_comentario+" => "+id_comentario_sel+" => "+mensaje);

    enviar_comentario(mensaje,id_comentario_sel,id_respuesta_sel);
  });

  $(".form_comentario").submit(function(e){
     e.preventDefault();
  });


  $('#btn_usuario').click(function(e) {

      $("#modal-usuario").modal("show");

  });

  

</script>
@stop