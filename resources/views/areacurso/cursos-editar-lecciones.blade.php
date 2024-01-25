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
  .etiqueta-curso{
    position: absolute;
    top: 0px;
    font-size: 11px;
    color: #fff;    
    padding: 2px 18px;
    border-radius: 0px 0px 8px 8px;
    left: 14px;
  }

  .selected-item{
      background-color:#ffe391;
  }

  .btn-group-toggle a{
    text-decoration: none;
    color: #fff;
  }

  .class-embed{
    display:none;
  }
 
</style>
 

<div class="row row-docttus">
  <h4 class="titulo-curso-f">{{$curso->NombreCurso}}</h4>

    
    <div class="col-md-12">
        
        <div class="btn-group btn-group-toggle" data-toggle="buttons">
          <label class="btn btn-secondary">
            <a href="{{url('')}}/cursos/editar-basicos/{{$curso->CodigoCurso}}">
              <input type="radio" name="options" id="option1" checked> Básico
            </a>
          </label>
          <label class="btn btn-info active ">
            <a href="{{url('')}}/cursos/editar-modulos/{{$curso->CodigoCurso}}">
              <input type="radio" name="options" id="option2"> Módulos 
            </a>
          </label>          
          
        </div>

    </div>
</div>


<hr />

<div class="row row-docttus" style="margin-bottom: 25px;">
   <!--  tarjeta Curso --> 
   <div class="col-md-6">
     <div class="card-docttus card-docttus-left" style=" height: auto !important; position: relative;">
        <h3 style="display: inline-block;">Lecciones</h3>
        <span>- {{$modulos->NombreModulo}}</span>        
        <hr>
        <form id="form-editar-modulo">


          <div class="form-group input-group-sm">
            <label>Título</label>
            <input type="text" class="form-control" id="NombreTema" value="" required>
          </div>

          <div class="form-group  input-group-sm">
            <label>Descripción Corta</label>
            <textarea class="form-control" id="DescripcionTema" rows="3"></textarea>
          </div>

          <div class="form-group  input-group-sm">
            <label>Descripción Lección</label>
            <textarea class="form-control html-paginas" id="DescripcionlargaTema" rows="5"></textarea>
          </div>

          <div class="form-group  input-group-sm">
            <label>Tipo Lección</label>
            <select class="form-control" id="IdTipoTema" style="width: 125px;" onchange="change_tipo(this.value)">
              @foreach($tipo_tema as $tipo)
              <option value="{{$tipo->IdTipoTema}}">{{$tipo->NombreTipoTema}}</option>              
              @endforeach
            </select>
          </div>

          <div id="ContenedorEmbed" style="width: 100%; border-radius: 9px; padding: 5px; border:2px dotted #ccc; margin-bottom: 25px; background-color: #fafafa;">
            <div class="form-group  input-group-sm">
              <label>Duración (Min)</label>
              <input type="number" class="form-control" id="DuracionTema" value="" style="width: 125px;">
            </div>            

            <select class="form-control" id="TipoVideo" onchange="cambio_tipo_video(this.value)">
              <option value="1">Subir Video</option>
              <option value="2">URL de Youtube</option>
              <option value="3">URL de Vimeo</option>
            </select>

              <input id="URLMediaEmbed" type="text" name="nombre" class="form-control class-embed"  value="" style="margin-top: 5px;">
              <small class="class-embed">URL del Video en <span id="nombre_tipo_video" >Youtube</span></small>

              <div id="cnv_subir_video">
                <input class="form-control" type="file" id="SubirVideoFile"  style="margin-top: 5px;"> 
                <ul>
                  <li><small>Tamaño Recomendado: 1920px X 1080px</small></li>
                  <li><small>Extensiones Aceptadas: .mp4</small></li>
                  <li><small>Peso Video: Menor a 2gb</small></li>
                </ul>               

              </div>

              <div class="col-contenido embed-responsive embed-responsive-16by9" id="cnv_lecciones">              
                </div>
          

            
          </div>
          

          <div class="form-group  input-group-sm">
            <label>¿Deseas regalar esta lección?</label>
            <select class="form-control" id="GratisTema" style="width: 125px;">              
              <option value="0">NO</option>
              <option value="1">SI</option>
            </select>
          </div>

          <div class="form-group  input-group-sm">
            <label>Estado Lección</label>
            <select class="form-control" id="IdEstado" style="width: 125px;">
              <option value="1">ACTIVO</option>
              <option value="2">INACTIVO</option>
            </select>
          </div>


          <div class="form-group  input-group-sm">
            <label>Habilidades</label>
            <div style="width:100%; height:250px; background-color:#fafafa; padding-right:15px; overflow-y: auto; ">

              <ul class="list-group" id="habilidades_seleccionadas">
                @foreach ($habilidades as $habilidad)
                  <li class="list-group-item"><input type="checkbox" id-habilidad="{{$habilidad->IdHabiliadad}}" class="chk_habilidad" id="chk_habilidades_{{$habilidad->IdHabiliadad}}"> {{$habilidad->NombreHabilidad}}</li>    
                @endforeach
                
                
              </ul>


            </div>


          </div>



          @if(session('rol_solicitud')!="root")

          
          <div style="width: 100%; margin-top: 35px;">
            
            

            @if($curso->IdEstado==3 || $curso->IdEstado==1)
                    <input type="submit" name="" class="btn btn-secondary botones-docttus" style="" value="Guardar" id="btn_guardar_lecciones">
            @else
            <button type="button" disabled name="" class="btn btn-secondary " style="background-color:gray !important; border-radius:25px;">
                Guardar
            </button>
            @endif



            <button type="button" class="btn btn-danger" style="float: right; border-radius: 25px;" id="btn_cancelar">Cancelar</button>
          </div>
          @endif
          
          


        </form>

          
           

        

     </div>
   </div>

   <div class="col-md-6">
        <div class="card-docttus card-docttus-left" style=" height: auto !important; position: relative;">
          
           <h3>Listado de Lecciones</h3>
           @php 
           $cont_lecciones=0;
          @endphp
          <ul class="list-group" id="listado_lecciones_ul">
            @foreach($lecciones as $leccion)
            @php 
           $cont_lecciones++;
          @endphp
            <li class="list-group-item d-flex justify-content-between align-items-center lista_item" id="item_{{$leccion->IdTema}}" style="position: relative;" id-tema="{{$leccion->IdTema}}">

              <div class="row" style="width: 100%; padding: 0px; margin: 0px;">
                <div class="col-8" style="padding-left: 0px;">
                  <i class="fa  fa-ellipsis-v" aria-hidden="true" style="color: #ccc; cursor:pointer; margin-right:5px; margin-left:5px;" title="Organizar"></i>  {{$cont_lecciones}} - {{$leccion->NombreTema}}
                  <br /><small>
                    @if($leccion->media_leccion)
                    {{$leccion->media_leccion[0]->URLMedia}} - {{$leccion->OrdenTema}}
                    @endif
                  </small>
                </div>

                <div class="col-4" style="text-align: right; padding-right: 0px;">
                  <button  type="button" onclick="seleccionar_leccion('{{$leccion->IdTema}}')"  class="btn btn-info" style="font-size:12px;width: 25px; height: 25px;  padding: 1px; border-radius: 25px;"><i class="fa fa-pencil" aria-hidden="true"></i>
                  </button>

                  <a title="Agregar Archivos a esta lección" href="{{url('')}}/cursos/editar-archivos/{{$curso->CodigoCurso}}-{{$leccion->CodigoTema}}" class="btn btn-warning" style="font-size:12px; height: 25px; padding: 1px 5px; border-radius: 25px;  bottom: 2px;     width: 25px; color: #212529;  padding-top: 2px;">
                    <i class="fa fa-file" aria-hidden="true"></i>
                  </a>    
                </div>
              </div>
            </li>   
            @endforeach           

            @if(count($lecciones)>0)
            

            @if($curso->IdEstado==3 || $curso->IdEstado==1)
              <button type="button" name="" class="btn btn-secondary botones-docttus" onclick="guardar_orden()" style="margin-top: 25px; display:inline-block; width:190px;">Guardar Orden</button> 
            @else
            <button type="button" disabled name="" class="btn btn-secondary " style="margin-top: 25px;  background-color:gray !important; border-radius:25px; margin-top: 25px; display:inline-block; width:190px;">
                Guardar Orden
            </button>
            @endif

            @endif
            
            
          </ul>     


          <div id="contenedor_html">
            
          </div>    

          


        </div>
     </div>

   
  <!--  tarjeta Curso --> 
  
</div>


<div class="modal fade" id="mensaje_espera" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
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
              <p id="mensaje_envio" style="margin-top:15px; display:none; text-align:center;">Se está guardando la lección, esto puede tardar varios minutos, dependiendo tu conexión de internet.  No cierres esta ventana hasta no terminar el proceso.</p>
              <div class="progress" id="barra_progreso" style="display:none; margin-top:15px;">
                <div class="progress-bar " role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">0%</div>
              </div>    
            </center>
          </div>
          
          
        </div>              
      </div>

    </div>
  </div>
</div>


@stop

@section('scripts')

  <script src="{{url('')}}/assets/tinymce/js/tinymce/tinymce.min.js"></script>
  <script src="{{url('')}}/assets/tinymce/js/tinymce/jquery.tinymce.min.js"></script>

  <script src="{{url('')}}/assets/js/sortable.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/jquery-sortablejs@latest/jquery-sortable.js"></script>


  <script type="text/javascript">

    $(function(){
      $('#listado_lecciones_ul').sortable();
    });

     tinymce.init({
          height:"224",

          setup: function (ed) {
              ed.on('init', function(args) {
                 //$("#cargar-componentes").modal("hide");
              });
          },


        selector: ".html-paginas",

          
        fontsize_formats: '8pt 10pt 12pt 14pt 18pt 24pt 36pt 42pt 52pt',

        relative_urls : false,

        remove_script_host : false,
       
       
       
      });



    var ArraLecciones=[
      @foreach($lecciones as $leccion)
      {
        "IdTema":"{{$leccion->IdTema}}",
        "NombreTema":`{{$leccion->NombreTema}}`,
        "DescripcionTema":`{{$leccion->DescripcionTema}}`,
        "IdEstado":"{{$leccion->IdEstado}}",
        "IdModulo":"{{$leccion->IdModulo}}",
        "IdTemaPadre":"{{$leccion->IdTemaPadre}}",
        "IdTipoTema":"{{$leccion->IdTipoTema}}",
        "ImagenTema":"{{$leccion->ImagenTema}}",
        "ArchivoTema":"{{$leccion->ArchivoTema}}",
        "DuracionTema":"{{$leccion->DuracionTema}}",
        "FechaCreacion":"{{$leccion->FechaCreacion}}",
        "FechaModificacion":"{{$leccion->FechaModificacion}}",
        "IdIdioma":"{{$leccion->IdIdioma}}",
        "CodigoTema":"{{$leccion->CodigoTema}}",
        "OrdenTema":"{{$leccion->OrdenTema}}",
        "DescripcionlargaTema":`{{utf8_encode($leccion->DescripcionlargaTema)}}`,
        "GratisTema":"{{$leccion->GratisTema}}",
        "URLMediaTema":"{{$leccion->URLMediaTema}}",
        "clases_gratis":"{{$leccion->clases_gratis}}",
        "IdCurso":"{{$leccion->IdCurso}}",

        "media_leccion":[
          @foreach($leccion->media_leccion as $media)
          {
            "IdMedia":"{{$media->IdMedia}}",
            "TipoMedia":"{{$media->TipoMedia}}",
            "NombreMedia":`{{$media->NombreMedia}}`,
            "URLMedia":"{!!$media->URLMedia!!}",
            "IdEstado":"{{$media->IdEstado}}",
            "FechaCreacion":"{{$media->FechaCreacion}}",
            "FechaModificacion":"{{$media->FechaModificacion}}",
            "TipoVideo":"{{$media->TipoVideo}}",
            "IdTema":"{{$media->IdTema}}",
            "VideoEmbed":`{!!$media->VideoEmbed!!}`
          },                    
          @endforeach
          ],

          "habilidades_leccion":[
          @foreach($leccion->habilidades as $hab)
          {
            "IdHabiliadad":"{{$hab->IdHabiliadad}}",
            "NombreHabilidad":"{{$hab->NombreHabilidad}}"
          },                    
          @endforeach
          ]


      },
      @endforeach

    ];
    

     

    var arra_habilidades=$("#habilidades_seleccionadas > li > input");
       
    


    var IdTemaSeleccionado="";
    var IdMediaSeleccion="";
    $("#form-editar-modulo").submit(function(e){
      e.preventDefault();

      var formData = new FormData();

      var NombreTema=""+$("#NombreTema").val();
      var DescripcionTema=""+$("#DescripcionTema").val();
      var DescripcionlargaTema=""+tinymce.get('DescripcionlargaTema').getContent();      
      var IdTipoTema=""+$("#IdTipoTema").val();
      var DuracionTema=""+$("#DuracionTema").val();
      var GratisTema=""+$("#GratisTema").val();
      var IdEstado=""+$("#IdEstado").val();
      var URLMediaEmbed=""+$("#URLMediaEmbed").val();
      var TipoVideo=""+$("#TipoVideo").val();
      
      var IdTema=""+IdTemaSeleccionado;
      var habilidades_tema=get_habilidades_seleccionadas();


      
      formData.append('IdModulo', "{{$modulos->IdModulo}}");  
      formData.append('IdTema', IdTema);  
      formData.append('NombreTema', NombreTema);
      formData.append('DescripcionTema', DescripcionTema);
      formData.append('DuracionTema', DuracionTema);
      formData.append('GratisTema', GratisTema);
      formData.append('DescripcionlargaTema', DescripcionlargaTema);
      formData.append('URLMediaEmbed', URLMediaEmbed);

      formData.append('HabilidadesTema', habilidades_tema);
      
      formData.append('SubirVideoFile', $("#SubirVideoFile")[0].files[0]);
      formData.append('TipoVideo', TipoVideo);
      
      

      formData.append('IdEstado', IdEstado); 
      formData.append('IdTipoTema', IdTipoTema); 



            

      formData.append('IdMedia', ""+IdMediaSeleccion);

               

      guardar_informacion(formData,"editarlecciones");

    });

    
    function change_tipo(IdTipoTema_s){      
      if(IdTipoTema_s=="1" || IdTipoTema_s=="3"){

          $("#DuracionTema").attr("required",true);

          $("#ContenedorEmbed").show("fast");

          if(IdTipoTema_s=="1"){
            $("#URLMediaEmbedLabel").html("URL Vimeo o Youtube");
          }else{
            $("#URLMediaEmbedLabel").html("URL MP3");
          }

      }else if(IdTipoTema_s=="2"){
        $("#DuracionTema").attr("required",false);
        $("#ContenedorEmbed").hide("fast");
      }
    }

     function guardar_informacion(campos,funcionlv){

        campos.append('CodigoCurso', "{{$curso->CodigoCurso}}");
        campos.append('_token', "{{ csrf_token() }}");        
        campos.append('token_curso', "{{ $token_curso }}");

        $('#mensaje_espera').modal({
            backdrop: 'static',
            keyboard: false  // to prevent closing with Esc button (if you want this too)
        });

        
        var request = $.ajax({
            url: "{{url('')}}/"+funcionlv,
            type: "POST",
            data: campos,
            processData: false,  // tell jQuery not to process the data
            contentType: false,  // tell jQuery not to set contentType
            cache:false,
            xhr        : function ()
                {
                    var jqXHR = null;
                    if ( window.ActiveXObject )
                    {
                        jqXHR = new window.ActiveXObject( "Microsoft.XMLHTTP" );
                    }
                    else
                    {
                        jqXHR = new window.XMLHttpRequest();
                    }

                    //Upload progress
                    jqXHR.upload.addEventListener( "progress", function ( evt )
                    {
                        if ( evt.lengthComputable )
                        {
                            var percentComplete = Math.round( (evt.loaded * 100) / evt.total );
                            //Do something with upload progress

                            if(funcionlv=="editarlecciones"){

                                $("#btn_guardar_lecciones").prop("disabled",true);
                                $("#btn_cancelar").prop("disabled",true);                                
                                $("#mensaje_envio").show("fast");
                                $("#barra_progreso").show("fast");

                                //$("#mensaje_espera").modal("show");

                                

                                progress_bar_video(percentComplete);

                            }

                            console.log( 'Uploaded percent', percentComplete );
                            
                        }
                    }, false );

                    //Download progress
                    jqXHR.addEventListener( "progress", function ( evt )
                    {
                        if ( evt.lengthComputable )
                        {
                            var percentComplete = Math.round( (evt.loaded * 100) / evt.total );
                            //Do something with download progress
                            console.log( 'Downloaded percent', percentComplete );
                            if(funcionlv=="editarlecciones"){
                              $("#barra_progreso").show();
                              $("#mensaje_envio").show("fast");
                                $("#barra_progreso").show("fast");
                            
                                
                              
                              progress_bar_video(percentComplete);
                            }

                        }
                    }, false );

                    return jqXHR;
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

                $("#btn_guardar_lecciones").prop("disabled",false);
                $("#btn_cancelar").prop("disabled",false);                                
                $("#mensaje_envio").hide("fast");
                $("#barra_progreso").hide("fast");

                $("#mensaje_espera").modal("hide");
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
    
      var cant_clicl=0;
    function seleccionar_leccion(IdTema){
      IdTemaSeleccionado=""+IdTema;

      $(".lista_item").removeClass("selected-item");
      $("#item_"+IdTema).addClass("selected-item");

      limpiar_habilidades();
      for(var i=0;i<ArraLecciones.length;i++){
        if(ArraLecciones[i].IdTema==IdTema){



          $("#NombreTema").val(""+ArraLecciones[i].NombreTema);
          $("#DescripcionTema").val(""+ArraLecciones[i].DescripcionTema);          
          tinymce.get('DescripcionlargaTema').setContent("");   
          var DescripcionlargaTema=""+ArraLecciones[i].DescripcionlargaTema;
          if(DescripcionlargaTema!=""){
            tinymce.get('DescripcionlargaTema').setContent(htmlDecode(DescripcionlargaTema));   
          }
          

          $("#IdTipoTema").val(""+ArraLecciones[i].IdTipoTema);

          change_tipo(""+ArraLecciones[i].IdTipoTema);
          cant_clicl++;

          if(ArraLecciones[i].IdTipoTema!="2"){

            $("#DuracionTema").val(""+ArraLecciones[i].DuracionTema);
            var arra_Media=ArraLecciones[i].media_leccion;
            if(arra_Media.length>0){
              IdMediaSeleccion=arra_Media[0].IdMedia;
              $("#URLMediaEmbed").val(""+arra_Media[0].URLMedia);
              $("#TipoVideo").val(""+arra_Media[0].TipoVideo);


              

              var embed_video=arra_Media[0].VideoEmbed;
              embed_video=embed_video.replace("player_video","player_video_"+cant_clicl);

              $("#cnv_lecciones").html(""+embed_video);
              
              if(arra_Media[0].TipoVideo=="1"){
                var player = videojs("player_video_"+cant_clicl);
              }
              
              //$("#cnv_lecciones").html(arra_Media[0].VideoEmbed);              
              cambio_tipo_video($("#TipoVideo").val());





            }else{
              IdMediaSeleccion="";
              $("#URLMediaEmbed").val("");
            }
          }


          

          var arra_habilidad=ArraLecciones[i].habilidades_leccion;
          if(arra_habilidad.length>0){
             for(var j=0; j<arra_habilidad.length;j++){
                get_habilidades_byid(arra_habilidad[j].IdHabiliadad);                
             }
          }


          $("#GratisTema").val(""+ArraLecciones[i].GratisTema);
          $("#IdEstado").val(""+ArraLecciones[i].IdEstado);


          break;
        }
      }
    }

    function get_habilidades_byid(id_habil){
      var id_habilidad_sel="";
      var habilidad_selecc="";
      for(var i=0;i<arra_habilidades.length;i++){        
        id_habilidad_sel=$(arra_habilidades[i]).attr("id-habilidad");
        if(id_habilidad_sel==""+id_habil){
          habilidad_selecc=i;
          $(arra_habilidades[i]).prop("checked",true);
        }
      }
      return habilidad_selecc;
    }


    $("#btn_cancelar").click(function(e){
      e.preventDefault();
      $("#NombreTema").val("");
      $("#DescripcionTema").val("");
      tinymce.get('DescripcionlargaTema').setContent("");   
      $("#IdEstado").val("1");          

      $("#IdTipoTema").val("1");
      change_tipo("1");
      $("#DuracionTema").val("");

      $("#URLMediaEmbed").val("");

      $("#GratisTema").val("");
      $("#IdEstado").val("");

      IdMediaSeleccion="";
      IdTemaSeleccionado="";
    });



    function htmlDecode(input){
      var e = document.createElement('div');
      e.innerHTML = input;
      return e.childNodes[0].nodeValue;
    }


    function get_tema_orden(){
       var arra_list=$("#listado_lecciones_ul > li");
       var cadena_orden="";
       for(var i=0;i<arra_list.length;i++){
          var id_tema=$(arra_list[i]).attr("id-tema");
          console.log(id_tema);
          cadena_orden+=id_tema+",";
       }
       cadena_orden=cadena_orden.slice(0,-1);
       return cadena_orden;
    }


    function guardar_orden(){
      var OrdenTemas=get_tema_orden();
      var formData = new FormData();
      formData.append('IdModulo', "{{$modulos->IdModulo}}");  
      formData.append('OrdenTemas', ""+OrdenTemas);        

      guardar_informacion(formData,"editarordenlecciones");


    }


    function get_habilidades_seleccionadas(){
       arra_habilidades=$("#habilidades_seleccionadas > li > input");
       var habilidades_sel_tema="";
       for(var i=0;i<arra_habilidades.length;i++){
          if($(arra_habilidades[i]).is(":checked")){
            var id_habilidad_sel=$(arra_habilidades[i]).attr("id-habilidad");            
            habilidades_sel_tema+=""+id_habilidad_sel+",";
          }

       }
       habilidades_sel_tema=habilidades_sel_tema.slice(0,-1);
       return habilidades_sel_tema;
    }

    function limpiar_habilidades(){
      for(var i=0;i<arra_habilidades.length;i++){
        $(arra_habilidades[i]).prop("checked",false); 
      }      
    }


     function cambio_tipo_video(tipo_video){
        $("#cnv_subir_video").hide();
        $(".class-embed").show();
        if(tipo_video=="1"){
          $("#cnv_subir_video").show();
          $(".class-embed").hide();
        }else if(tipo_video=="2"){
          $("#nombre_tipo_video").html("Youtube");
        }else{
          $("#nombre_tipo_video").html("Vimeo");
        }


      }
      
      function progress_bar_video(porcent_envio){
        $("#barra_progreso .progress-bar").css("width",porcent_envio+"%");
        $("#barra_progreso .progress-bar").attr("aria-valuenow",""+porcent_envio);
        $("#barra_progreso .progress-bar").html(porcent_envio+"%");
        $("#barra_progreso .progress-bar").removeClass("bg-success");

        if(porcent_envio>=100){
          $("#barra_progreso .progress-bar").addClass("bg-success");
          
        }

        //<div class="progress-bar" role="progressbar" style="width: 25%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">25%</div>
      }



  </script>
@stop