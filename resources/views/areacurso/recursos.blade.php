@extends('areacurso.plantillas.plantilla-area-interna')

@section('cabecera')
<style type="text/css">
   .container-recurso{
      width: 180px; 
      height: 180px; 
      background-color: #e3e3e3; 
      border-radius: 9px; 
      margin-left: 15px; 
      margin-bottom: 15px; 
      display: inline-block; 
      text-align: center;
      cursor: pointer;
   }
   .imagen-media{
     width: 170px; height: 140px; background-size: contain; background-position: center; background-repeat: no-repeat;   
   }
</style>
@stop

@section('contenido')


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Recursos <a href="#" data-toggle="modal" data-target="#nuevo-recurso" class="btn btn-block btn-default" style="display: inline-block; width: auto;">+ Agregar Nuevo</a> </h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('')}}/backoffice">Inicio</a></li>
              <li class="breadcrumb-item active">Recursos</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

      <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">          

          <div class="col-lg-9">
            <div class="card">
              <div class="card-body" style="height: 670px;   overflow-y: auto;">
                <p class="card-text">

                  @foreach($data_recurso as $recurso)

                  <div class="container-recurso" onclick="seleccionar_media({{$recurso->IdMedia}})">
                     
                     @if($recurso->IdTipoMedia=="1")

                      <div class="imagen-media" style="background-image: url({{url('')}}/assets-blog/images/{{$recurso->URLMedia}}); ">                      
                      </div>

                     @elseif($recurso->IdTipoMedia=="2")

                      <div class="imagen-media" style="background-image: url({{url('')}}/assets-blog/images/videos.png); ">                      
                      </div>
                     
                     @elseif($recurso->IdTipoMedia=="3")
                      <div class="imagen-media" style="background-image: url({{url('')}}/assets-blog/images/pdf.png); ">
                      </div>
                     @else
                      <div class="imagen-media" style="background-image: url({{url('')}}/assets-blog/images/audio.png); ">
                      </div>
                     @endif

                    <small style="height: 35px;     width: 100%; display: inline-flex; overflow: hidden; text-align:center;">{{$recurso->NombreMedia}}</small>

                  </div>

                  @endforeach
                
                </p>                
              </div>
            </div>
          </div>

          <div class="col-lg-3">
            <div class="card">
              <div class="card-body">
                <p class="card-text">
                  <label>Nombre Recurso o Texto Alternativo</label>
                  <input type="text" class="form-control" id="nombre_recurso_sel">                  

                  <label>URL Recurso</label>
                  <input type="text" class="form-control" id="url_recurso_sel">

                  <label>Código Embed</label>
                  <textarea class="form-control" id="codigo_embed_sel" rows="8"></textarea>

                  <button type="button" class="btn btn-danger" id="btn_eliminar" >Eliminar</button>                  
                  <a href="#" id="btn_visualizar" target="_blank"  class="btn btn-success" style="width: 41px; padding: 12px;" ><i class="fa fa-eye" aria-hidden="true"></i></a>

                </p>                
              </div>
            </div>
          </div>

          

          
          
          
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->



<!-- Modal -->
<div class="modal fade" id="nuevo-recurso" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Nuevo Recurso</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        
        <div class="row">
          <div class="col-md-12">
            
            <label>Nombre Recurso  o Palabra Clave</label>
            <input type="text" class="form-control" id="nombre_recurso_save">  
           

            <label>Seleccionar Archivo</label>
            <small>.jpg, .png, .mp4, .mp3</small>
            <input type="file" class="form-control" id="archivo_recurso_save">



          </div>

          
        </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary" onclick="guardar_articulo()">Guardar Cambios</button>
      </div>
    </div>
  </div>
</div>



@stop

@section('scripts')
  <script type="text/javascript">


    $(document).ready(function(){
        $('input[type="file"]').change(function(e){
            var fileName = e.target.files[0].name;
            if($("#nombre_recurso_save").val()==""){
              $("#nombre_recurso_save").val(""+fileName);  
            }            
        });
    });

    
    var url_pag_principal="{{url('')}}";

    var arra_obj_media=new Object();
    arra_obj_media=[
        @foreach($data_recurso as $recurso)

          {
            "IdMedia":"{{$recurso->IdMedia}}",
            "NombreMedia":"{{$recurso->NombreMedia}}",
            "FechaMedia":"{{$recurso->FechaMedia}}",
            "IdUsuario":"{{$recurso->IdUsuario}}",
            "IdTipoMedia":"{{$recurso->IdTipoMedia}}",
            "URLMedia":"{{$recurso->URLMedia}}",
          },

        @endforeach
    ];


    var IdMediaSel="";
    function seleccionar_media(id_media){
      var index_media=get_index_media(id_media);

      var tipo_media=arra_obj_media[index_media].IdTipoMedia;

      IdMediaSel=arra_obj_media[index_media].IdMedia;

      var codigo_embed="";

      var path_tipo_media="";


      if(tipo_media=="1"){
         path_tipo_media="images";        
         codigo_embed='<img alt="'+arra_obj_media[index_media].NombreMedia+'" style="width:100%;" src="'+url_pag_principal+'/assets-blog/'+path_tipo_media+'/'+arra_obj_media[index_media].URLMedia+'">';
      }

      if(tipo_media=="2"){
         path_tipo_media="videos";
      }

      if(tipo_media=="3"){
         path_tipo_media="pdf";
         codigo_embed='<a class="btn btn-success" target="_blank" href="'+url_pag_principal+'/assets-blog/'+path_tipo_media+'/'+arra_obj_media[index_media].URLMedia+'">DESCARGAR PDF</a>';


      }

      if(tipo_media=="4"){
         path_tipo_media="audios";
         codigo_embed='<audio controls><source src="'+url_pag_principal+'/assets-blog/'+path_tipo_media+'/'+arra_obj_media[index_media].URLMedia+'" type="audio/mpeg">Your browser does not support the audio element.</audio>';
      }


      $("#codigo_embed_sel").val(codigo_embed);
      $("#nombre_recurso_sel").val(""+arra_obj_media[index_media].NombreMedia);
      $("#url_recurso_sel").val("{{url('')}}/assets-blog/"+path_tipo_media+"/"+arra_obj_media[index_media].URLMedia);

      $("#btn_visualizar").attr("href","{{url('')}}/assets-blog/"+path_tipo_media+"/"+arra_obj_media[index_media].URLMedia);

    }

    function get_index_media(id_media){
      var index_media=-1;
       for(var i=0;i<arra_obj_media.length; i++){
          if(arra_obj_media[i].IdMedia==id_media){
            index_media=i;
          }
       }
       return index_media;
    }


    function guardar_articulo(){
      var nombre_recurso_save=$("#nombre_recurso_save").val();
      var formData = new FormData();    
    
      formData.append('IdMedia', IdMediaSel);
      formData.append('nombre_recurso', nombre_recurso_save);
      formData.append('archivo_recurso', $('#archivo_recurso_save')[0].files[0]);
      formData.append('_token', "{{ csrf_token() }}");        
    

      var request = $.ajax({
              url: "{{url('')}}/set_media",
              type: "POST",
              
              data: formData,
              processData: false,  // tell jQuery not to process the data
              contentType: false  // tell jQuery not to set contentType


            });

            request.done(function(obj) {                  
           
              if(obj.status=="ok"){                              
                alert("El proceso fue generado correctamente");
                location.reload();
                return;
              }else{                  
                alert("Error!, "+obj.mensaje);
                return;
              }

            });
             

             //respuesta si falla
            request.fail(function(jqXHR, textStatus) {
              alert( "Error de servidor  " + textStatus );
            });


    }


    $("#btn_eliminar").click(function(e){
        e.preventDefault();
        if(IdMediaSel!=""){
          eliminar_recurso();
        }else{
          alert("Debes seleccionar un recurso");
        }
        
    });

    function eliminar_recurso(){      

      var r = confirm("Deseas eliminar este recurso?");
      if (r == true) {
        ajax_eliminar();
      } 
    }

    function ajax_eliminar(){
      var formData = new FormData();    
    
      formData.append('IdMedia', IdMediaSel);   
      formData.append('_token', "{{ csrf_token() }}");              

      var request = $.ajax({
              url: "{{url('')}}/eliminar_recurso",
              type: "POST",
              
              data: formData,
              processData: false,  // tell jQuery not to process the data
              contentType: false  // tell jQuery not to set contentType


            });

            request.done(function(obj) {                  
           
              if(obj.status=="ok"){                              
                alert("El proceso fue generado correctamente");
                location.reload();
                return;
              }else{                  
                alert("Error!, "+obj.mensaje);
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
