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
   <div class="col-md-4">
     <div class="card-docttus card-docttus-left" style=" height: auto !important; position: relative;">
        <h3 style="display: inline-block;">Archivos</h3>
        <span>- {{$lecciones->NombreTema}}</span>
        <hr>
        <form id="form-editar-archivos">

          <div class="form-group ">
            <label>Seleccionar Archivo</label>
            <input type="file" class="form-control" id="URLMedia" value="" required>
          </div>

          <div class="form-group  input-group-sm">
            <label>Nombre Archivo</label>
            <input type="text" class="form-control" id="NombreMedia" readonly value="" required>
          </div>

                 
          
        @if(session('rol_solicitud')!="root")
          <div style="width: 100%; margin-top: 45px;">
            
            @if($curso->IdEstado==3 || $curso->IdEstado==1)
                    <input type="submit" name="" class="btn btn-secondary botones-docttus" style="" value="Guardar">
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

   <div class="col-md-8">
        <div class="card-docttus card-docttus-left" style=" height: auto !important; position: relative;">
          
           <h3>Listado de Archivos</h3>

          <ul class="list-group">

            @foreach($archivos as $archivo)

              @if($archivo->TipoMedia==2)
                <li class="list-group-item d-flex justify-content-between align-items-center" style="position: relative;">
                  

                  <div class="row" style="width: 100%; padding: 0px; margin: 0px;">
                    <div class="col-8" style="padding-left: 0px;">
                      {{$archivo->NombreMedia}}
                    </div>

                    <div class="col-4" style="text-align: right; padding-right: 0px;">

                      @if(session('rol_solicitud')!="root")
                      <button  type="button" onclick="abrir_eliminar('{{$archivo->IdMedia}}')"  class="btn btn-danger" style="font-size:12px;width: 25px; height: 25px;  padding: 1px; border-radius: 25px;"><i class="fa fa-trash" aria-hidden="true"></i>
                      </button>
                      @endif

                      
                      <a title="Ver Archivo" target="_blank" href="{{url('')}}/documentos/{{$curso->CodigoCurso}}/{{$archivo->URLMedia}}" class="btn btn-warning" style="font-size:12px; height: 25px; padding: 1px 5px; border-radius: 25px;  bottom: 2px;     width: 25px; color: #212529;  padding-top: 2px;">
                        <i class="fa fa-eye" aria-hidden="true"></i>
                      </a>    


                    </div>
                  </div>

                  
                </li>   
              @endif
            @endforeach           
           
          </ul>         

          


        </div>
     </div>

   
  <!--  tarjeta Curso --> 
  
</div>




<!-- Modal Eliminar -->
<div class="modal fade" id="eliminar-archivo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel2" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel2">Eliminar Archivo</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" style="text-align: center;">                  
          <h2>¿Está seguro de eliminar este archivo?</h2>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal" style="border-radius: 25px;">Cerrar</button>                
        <button type="button" class="btn btn-secondary botones-docttus" id="btn_archivo_eliminar" >Aceptar</button>                
      </div>
    </div>
  </div>
</div>





@stop

@section('scripts')

  <script src="{{url('')}}/assets/tinymce/js/tinymce/tinymce.min.js"></script>
  <script src="{{url('')}}/assets/tinymce/js/tinymce/jquery.tinymce.min.js"></script>

  <script type="text/javascript">


    $(document).ready(function(){
        $('#URLMedia').change(function(e){
            var fileName = e.target.files[0].name;
            if($("#NombreMedia").val()==""){
              $("#NombreMedia").val(""+fileName);  
            }            
        });
    });


    var ArraArchivos=[{
     
    }];


    var IdMediaSeleccionado="";
    $("#form-editar-archivos").submit(function(e){
      e.preventDefault();

      var formData = new FormData();

      var NombreMedia=""+$("#NombreMedia").val();      
      

      
      var IdMedia=""+IdMediaSeleccionado;
      
      
      formData.append('NombreMedia', NombreMedia);      
      formData.append('URLMedia', $('#URLMedia')[0].files[0]);
      formData.append('CodigoLeccion', "{{$lecciones->CodigoTema}}");
      

      guardar_informacion(formData,"editararchivos");

    });

    


     function guardar_informacion(campos,funcionlv){        
        campos.append('CodigoCurso', "{{$curso->CodigoCurso}}");
        campos.append('_token', "{{ csrf_token() }}");        
        campos.append('token_curso', "{{ $token_curso }}");

        
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

    function seleccionar_modulo(IdMedia){
      IdMediaSeleccionado=""+IdMedia;
      for(var i=0;i<ArraModulos.length;i++){
        if(ArraModulos[i].IdModulo==IdModulo){
          $("#NombreModulo").val(""+ArraModulos[i].NombreModulo);
          $("#DescripcionModulo").val(""+ArraModulos[i].DescripcionModulo);
          $("#IdEstado").val(""+ArraModulos[i].IdEstado);          
          break;
        }
      }
    }


    $("#btn_cancelar").click(function(e){
      e.preventDefault();
      $("#NombreModulo").val("");
      $("#URLMedia").val("");
      $("#IdEstado").val("1");          
      IdMediaSeleccionado="";
    });




     var codigo_archivo_eliminar="";
    function abrir_eliminar(codigoarchivo){
      codigo_archivo_eliminar=codigoarchivo;
      $("#eliminar-archivo").modal("show");      
    }


    $("#btn_archivo_eliminar").click(function(e){
      eliminar_archivo();
    });


    function eliminar_archivo(){
        var IdMedia=codigo_archivo_eliminar;        
        var request = $.ajax({
            url: "{{url('')}}/eliminararchivo",
            type: "POST",
            data:{                                
                 IdMedia:""+IdMedia,
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