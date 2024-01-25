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

  .btn-group-toggle a{
    text-decoration: none;
    color: #fff;
  }

  .class-embed{
    display:none;
  }
  
  

  .btn-titulo{
    font-size: 21px;
    color:#9a9a9a;
  }
  

</style>

<form id="form-editar-curso"> 
  <button type="submit" style="display: none;" id="btn_enviar_form_generico"></button>

<div class="container" style="padding-top: 35px;">

  @component('areacurso.componentes.menu-admin-cursos')
    @slot('CodigoCurso')
      {{$curso->CodigoCurso}}
    @endslot   

    @slot('url_form')
      {{$url_form}}
    @endslot     
    
    @slot('SlugCurso')
      {{$curso->SlugCurso}}
    @endslot   

    @slot('NombreUsuario')      
      {{$data[0]->NombreUsuario}}
    @endslot   

  @endcomponent

  
  <div class="row my-xl-5 my-3">
    <div class="col-md-12">
      <h4>Imagenes y video de Portada</h4>
      <small><i><strong>Curso:</strong> {{$curso->NombreCurso}}</i></small>
      <hr>
    </div>
  </div>

             
  <div class="row">
    <div class="col-md-4">
      <h6 style="font-weight: bold;" class="my-4">Imágen Principal</h6>
      <p>Incluye una imagen representativa de tu curso que tenga un tamaño: 730px X 390px, un peso menor a 300Kb y una extensión jpg o png. </p>
      <ul>
        <li><small>Tamaño: 730px X 390px</small></li>
        <li><small>Extensiones Aceptadas: .jpg o .png</small></li>
        <li><small>Peso Imágen: Menor a 300Kb</small></li>
      </ul>
    </div>

    <div class="col-md-8">
        <div class="card-docttus card-docttus-left" style=" height: auto !important; position: relative;">          
            <div class="form-group  input-group-sm">                        
                <label>Imagen Curso</label>
                <?php
                $imagen_curso="seleccionar_imagen.jpg";
                if($curso->ImagenCurso!="" && $curso->ImagenCurso!="curso-base.jpg" ){
                    $imagen_curso=$curso->ImagenCurso;
                }
                ?>
                <div class="componente-archivos" style="background-image: url('{{url('')}}/assets/images/cursos/{{$imagen_curso}}');"id="prev_ImagenCurso">
                    <div class="overlay"  onclick="getFotoCurso('ImagenCurso');" >
                    </div>

                    <button class="btn btn-danger btn-xs" style="position: absolute; width:200px; left:50%; margin-left:-100px; top:39%;" type="button" onclick="limpiar_componente_file('ImagenCurso')" >Eliminar</button>
                    <button class="btn btn-info btn-xs" style="position: absolute; width:200px; left:50%; margin-left:-100px; top:48%;"  type="button"   onclick="getFotoCurso('ImagenCurso');" >Agregar o Reemplazar</button>

                </div>
                <input id="ImagenCurso" type="file" name="nombre" class="form-control" style="display: none;" onchange="seleccionar_imagen('ImagenCurso')">
                            
            </div>
        </div>
        <br />
        
       

    </div>
  </div>


  <hr />


  

  

  <div class="row">
    <div class="col-md-4">
      <h6 style="font-weight: bold;" class="my-4">Video Portada</h6>
      <p>Sube un video que permita dar a conocer tanto la plataforma Docttus.com  como el contenido de tu curso.</p>
      <ul>
        <li><small>Tamaño Recomendado: 1920px X 1080px</small></li>
        <li><small>Extensiones Aceptadas: .mp4</small></li>
        <li><small>Peso Video: Menor a 800Mb</small></li>
      </ul>
    </div>

    <div class="col-md-8">
        <div class="card-docttus card-docttus-left" style=" height: auto !important; position: relative;">          
            
            <div class="form-group input-group-sm">
              <label>Video Promocional</label>

              <select class="form-control" id="TipoVideo" onchange="cambio_tipo_video(this.value)">
                <option value="1">Subir Video</option>
                <option value="2">URL de Youtube</option>
                <option value="3">URL de Vimeo</option>
              </select>

              <input id="VideoCurso" type="text" name="nombre" class="form-control class-embed"  value="{{$curso->VideoCurso}}" style="margin-top: 5px;">                
              <small class="class-embed">URL del Video en <span id="nombre_tipo_video" >Youtube</span></small><br/>
              <small class="class-embed" style="color: red;" id="validacion_video"></small>

              <div id="cnv_subir_video">
                <input class="form-control" type="file" id="SubirVideoFile"  style="margin-top: 5px; display:none;" onchange="seleccionar_video('SubirVideoFile','VideoCurso')"> 
                <center>
                <button class="btn btn-info" onclick="getVideoCurso('SubirVideoFile')" type="button">
                  <i class="fa fa-upload" aria-hidden="true"></i> Seleccionar Video (.mp4)</button>
                </center>
                                  
              </div>
              
              

              <div class="col-contenido embed-responsive embed-responsive-16by9" id="cnv_VideoCurso" style="background-color: #ccc; margin-top:15px;">
              </div>


            </div>

        </div>        
    </div>
  </div>





</div>
<br />
<br />
</form>








@stop

@section('scripts')

  <script src="{{url('')}}/assets/tinymce/js/tinymce/tinymce.min.js"></script>
  <script src="{{url('')}}/assets/tinymce/js/tinymce/jquery.tinymce.min.js"></script>
  @php 
    if(!$curso->AprobacionAutomatica){
      $curso->AprobacionAutomatica="0";
    }
  @endphp
  
    <script type="text/javascript">

      var cant_clicl=0;

      $(function(){ 

                
        $("#TipoVideo").val("{{$curso->TipoVideo}}");
        cambio_tipo_video($("#TipoVideo").val(),1);  

              
        if($("#TipoVideo").val()=="1"){
          var embed_video=`{!!$curso->VideoCursoEmbed!!}`;
          embed_video=embed_video.replace("player_video","player_video_"+cant_clicl);
          //var player = videojs("player_video_"+cant_clicl);
          $("#cnv_VideoCurso").html(""+embed_video);          
        }
        if($("#TipoVideo").val()=="2" || $("#TipoVideo").val()=="3" ){
          var embed_video=`{!!$curso->VideoCursoEmbed!!}`;
          $("#cnv_VideoCurso").html(""+embed_video);
        }
        
      });

      $("#VideoCurso").focusout(function() {        
        if(!validacion_tipo_video($("#TipoVideo").val(), $("#VideoCurso").val())){
            $("#validacion_video").html("La URL del video no tiene el formato indicado");        
        }else{
          var matches=get_id_video_url($("#TipoVideo").val(), $("#VideoCurso").val());
          $("#validacion_video").html("");
          $("#cnv_VideoCurso").html(matches);
        }
      });


      function limpiar_componente_file(componente){
        $("#"+componente).val(''); 
        $("#"+componente).val(null);
        $("#"+componente).val('').clone(true);
        $("#prev_"+componente).css("background-image","url({{url('')}}/assets/images/cursos/seleccionar_imagen.jpg)");
        
      }

       
      
      getVideoCurso=function($idcomponente){
        $('#'+$idcomponente).attr('accept', '.mp4');
        $('#'+$idcomponente).show();
        $('#'+$idcomponente).focus();
        $('#'+$idcomponente).click();
        $('#'+$idcomponente).hide();
      }
     
      getFotoCurso = function($idcomponente) {

        $('#'+$idcomponente).attr('accept', '.jpg, .png');
        $('#'+$idcomponente).show();
        $('#'+$idcomponente).focus();
        $('#'+$idcomponente).click();
        $('#'+$idcomponente).hide();
      }


      // INFORMACIÓN BÁSICA

      function seleccionar_imagen(id_imag){
        
        if ($('#'+id_imag)[0].files[0]){
            var pathGaleria = "";
            pathGaleria = URL.createObjectURL($('#'+id_imag)[0].files[0]);
            $("#prev_"+id_imag).css("background-image","url('"+pathGaleria+"')");         
            
        }else{
           // $("#prev_"+id_imag).css("background-image","url('"+pathGaleria+"')");         
        }
      }


      function seleccionar_video(id_video,campo_id){
        
        if ($('#'+id_video)[0].files[0]){
            console.log("Entró "+campo_id);
            var pathGaleria = "";
            pathGaleria = URL.createObjectURL($('#'+id_video)[0].files[0]);
            cant_clicl++;
            var embed=`<video id="player_video_${cant_clicl}" controlsList="nodownload" class="video-js vjs-playback-rate embed-responsive-item " controls="true" preload="true" rate="true" data-setup="{}"><source src="${pathGaleria}" type="video/mp4" /><p class="vjs-no-js">To view this video please enable JavaScript, and consider upgrading to a web browser that <a href="https://videojs.com/html5-video-support/" target="_blank">supports HTML5 video</a ></p></video>`;
            $("#cnv_"+campo_id).html(embed);
            
            var player = videojs("player_video_"+cant_clicl);
            
        }else{
           // $("#prev_"+id_imag).css("background-image","url('"+pathGaleria+"')");         
        }
      }
      


      $("#form-editar-curso").submit(function(e){
        e.preventDefault();
        var formData = new FormData();
        formData.append('ImagenCurso',"");
        var aplicar_archivo="";
        if($("#ImagenCurso")[0].files[0]){
          formData.append('ImagenCurso', $("#ImagenCurso")[0].files[0]);
          aplicar_archivo="SI";
        }

        
        formData.append('SubirVideoFile',"");
        if($("#SubirVideoFile")[0].files[0]){
            $("#VideoCurso").val("");
            formData.append('SubirVideoFile',$("#SubirVideoFile")[0].files[0]);
            aplicar_archivo="SI";
        }
        formData.append('VideoCurso',$("#VideoCurso").val());        
        formData.append('TipoVideo',$("#TipoVideo").val());  
        guardar_informacion(formData,"editarimagenescurso",aplicar_archivo);

      });

      function guardar_informacion(campos,funcionlv,aplicar_archivo){

        campos.append('CodigoCurso', "{{$curso->CodigoCurso}}");
        campos.append('_token', "{{ csrf_token() }}");        
        campos.append('token_curso', "{{ $token_curso }}");

        if(aplicar_archivo=="SI"){
          abrir_barra_progreso();
        }
        
        
        var request = $.ajax({
            url: "{{url('')}}/"+funcionlv,
            type: "POST",
            data: campos,
            processData: false,  // tell jQuery not to process the data
            contentType: false,  // tell jQuery not to set contentType
            cache:false,
            xhr : function (){
                    var jqXHR = null;
                    if ( window.ActiveXObject ){
                        jqXHR = new window.ActiveXObject( "Microsoft.XMLHTTP" );
                    }else{
                        jqXHR = new window.XMLHttpRequest();
                    }
                    //Upload progress
                    jqXHR.upload.addEventListener("progress", function (evt){
                        if( evt.lengthComputable ){
                            var percentComplete = Math.round( (evt.loaded * 100) / evt.total );                            
                            if(aplicar_archivo=="SI"){
                              progress_bar_componente(percentComplete);
                            }
                            console.log( 'Uploaded percent', percentComplete );
                        }
                    }, false );

                    //Download progress
                    jqXHR.addEventListener( "progress", function(evt){
                        if(evt.lengthComputable){
                            var percentComplete = Math.round( (evt.loaded * 100) / evt.total );
                            //Do something with download progress
                            console.log( 'Downloaded percent', percentComplete );
                            if(aplicar_archivo=="SI"){
                              progress_bar_componente(percentComplete);
                            }
                        }
                    }, false );
                    return jqXHR;
                }
          });

          request.done(function(obj) { 
             if(obj.status=="ok"){    
              cerrar_barra_progreso();        
                $("#responder_comentarios").modal("hide");
                mensaje_generico("Correcto",""+obj.mensaje,"1","Continuar...",function(){
                  location.reload();
                });

                return;
             }else{
                cerrar_barra_progreso();
                $("#responder_comentarios").modal("hide");
                mensaje_generico("Error !",""+obj.mensaje,"2","Continuar...",function(){});
                return;
             }
          });
           //respuesta si falla
          request.fail(function(jqXHR, textStatus) {
            cerrar_barra_progreso();
            alert( "Error de servidor  " + textStatus );
          });


      }



    


      //ENVÍO DE PRECIOS
      $("#btn_estado_revision").click(function(e){
        e.preventDefault();

        var formData = new FormData();
        guardar_informacion(formData,"cambiarestadorev");

      });


      $("#btn_vista_previa").click(function(){
        //window.open("{{url('')}}/c/$SlugCurso","_blank");
      });

      

      function cambio_tipo_video(tipo_video,inicial=0){
        $("#cnv_subir_video").hide();
        $(".class-embed").show();
        if(!inicial){
          $("#VideoCurso").val("");
        }
        $("#cnv_VideoCurso").html("");

        if(tipo_video=="1"){
          $("#cnv_subir_video").show();
          $(".class-embed").hide();
          cant_clicl++;          

        }else if(tipo_video=="2"){
          $("#nombre_tipo_video").html("Youtube");
        }else{
          $("#nombre_tipo_video").html("Vimeo");
        }

        

      }

      
      
      

    </script>
@stop