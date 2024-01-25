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
        <h3 style="display: inline-block;">Módulos</h3>
        <span>- {{$curso->NombreCurso}}</span>
        <hr>
        <form id="form-editar-modulo">


          <div class="form-group  input-group-sm">
            <label>Título</label>
            <input type="text" class="form-control" id="NombreModulo" value="" required>
          </div>

          <div class="form-group  input-group-sm">
            <label>Descripción Módulo</label>
            <textarea class="form-control" id="DescripcionModulo" rows="5"></textarea>
          </div>

          <div class="form-group  input-group-sm">
            <label>Estado Módulo</label>
            <select class="form-control" id="IdEstado" style="width: 125px;">
              <option value="1">ACTIVO</option>
              <option value="2">INACTIVO</option>
            </select>
          </div>

          
          @if(session('rol_solicitud')!="root")
          <div style="width: 100%; margin-top: 45px;">
            @if($curso->IdEstado==3 || $curso->IdEstado==1)
              <input type="submit" name="" class="btn btn-secondary botones-docttus" style="" value="Guardar">
            @else
            <button type="button" disabled name="" class="btn btn-secondary " style=" background-color:gray !important; border-radius:25px;">
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
          
           <h3>Listado de Módulos</h3>

          <ul class="list-group" id="listado_modulos_ul">

          @php 
           $cont_lecciones=0;
          @endphp

            @foreach($modulos as $modulo)

            @php 
            $cont_lecciones++;
           @endphp

            <li class="list-group-item d-flex justify-content-between align-items-center lista_item" id="item_{{$modulo->IdModulo}}" style="position: relative;" id-modulo="{{$modulo->IdModulo}}">
              

              <div class="row" style="width: 100%; padding: 0px; margin: 0px;">
                <div class="col-8" style="padding-left: 0px;">
                  <i class="fa  fa-ellipsis-v" aria-hidden="true" style="color: #ccc; cursor:pointer; margin-right:5px; margin-left:5px;" title="Organizar"></i>  {{$cont_lecciones}} - {{$modulo->NombreModulo}}    
                </div>

                <div class="col-4" style="text-align: right; padding-right: 0px;">
                  <button  type="button" onclick="seleccionar_modulo('{{$modulo->IdModulo}}')"  class="btn btn-info" style="font-size:12px;width: 25px; height: 25px;  padding: 1px; border-radius: 25px;">
                    <i class="fa fa-pencil" aria-hidden="true"></i>
                  </button>

                  <a href="{{url('')}}/cursos/editar-lecciones/{{$curso->CodigoCurso}}-{{$modulo->IdModulo}}" class="btn btn-warning" style="font-size:12px; height: 25px; padding: 1px 5px; border-radius: 25px;  bottom: 2px;">
                    + Lecciones
                  </a>    
                </div>
              </div>

              
            </li>              
            @endforeach
          </ul>         
          
          @if(count($modulos)>0)
            

            @if($curso->IdEstado==3 || $curso->IdEstado==1)
              <button type="button" name="" class="btn btn-secondary botones-docttus" onclick="guardar_orden()" style="margin-top: 25px; display:inline-block; width:190px;">Guardar Orden</button> 
            @else
            <button type="button" disabled name="" class="btn btn-secondary " style="margin-top: 25px;  background-color:gray !important; border-radius:25px;">
                Guardar Orden
            </button>
            @endif

          @endif


        </div>
     </div>

   
  <!--  tarjeta Curso --> 
  
</div>



@stop

@section('scripts')

  <script src="{{url('')}}/assets/tinymce/js/tinymce/tinymce.min.js"></script>
  <script src="{{url('')}}/assets/tinymce/js/tinymce/jquery.tinymce.min.js"></script>

  <script src="{{url('')}}/assets/js/sortable.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/jquery-sortablejs@latest/jquery-sortable.js"></script>

  <script type="text/javascript">

  $(function(){
      $('#listado_modulos_ul').sortable();
    });

    var ArraModulos=[
      @foreach($modulos as $modulo)
        {
        "IdModulo":"{{$modulo->IdModulo}}",
        "NombreModulo":`{{$modulo->NombreModulo}}`,
        "DescripcionModulo":`{{$modulo->DescripcionModulo}}`,
        "IdEstado":"{{$modulo->IdEstado}}",
        },
      @endforeach      
  ];


    var IdModuloSeleccionado="";
    $("#form-editar-modulo").submit(function(e){
      e.preventDefault();

      var formData = new FormData();

      var NombreModulo=""+$("#NombreModulo").val();
      var DescripcionModulo=""+$("#DescripcionModulo").val();
      var IdEstado=""+$("#IdEstado").val();

      
      var IdModulo=""+IdModuloSeleccionado;
      
      formData.append('IdModulo', IdModulo);  
      formData.append('NombreModulo', NombreModulo);
      formData.append('DescripcionModulo', DescripcionModulo);
      formData.append('IdEstado', IdEstado);                

      guardar_informacion(formData,"editarmodulos");

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

    function seleccionar_modulo(IdModulo){

      $(".lista_item").removeClass("selected-item");
      $("#item_"+IdModulo).addClass("selected-item");

      IdModuloSeleccionado=""+IdModulo;
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
      $("#DescripcionModulo").val("");
      $("#IdEstado").val("1");          
      IdModuloSeleccionado="";
    });


    function get_modulos_curso(){
        var formData = new FormData();
        formData.append('CodigoCurso', "{{$curso->CodigoCurso}}");
        formData.append('_token', "{{ csrf_token() }}");        

        var request = $.ajax({
            url: "{{url('')}}/get_modulos_by_curso",
            type: "POST",
            data: campos,
            processData: false,  // tell jQuery not to process the data
            contentType: false  // tell jQuery not to set contentType
          });

          request.done(function(obj) { 
             if(obj.status=="ok"){
                
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


    function get_modulo_orden(){
       var arra_list=$("#listado_modulos_ul > li");
       var cadena_orden="";
       for(var i=0;i<arra_list.length;i++){
          var id_modulo=$(arra_list[i]).attr("id-modulo");
          console.log(id_modulo);
          cadena_orden+=id_modulo+",";
       }
       cadena_orden=cadena_orden.slice(0,-1);
       return cadena_orden;
    }


    function guardar_orden(){
      var OrdenModulos=get_modulo_orden();
      var formData = new FormData();
      formData.append('IdCurso', "{{$curso->IdCurso}}");  
      formData.append('OrdenModulos', ""+OrdenModulos);       

      guardar_informacion(formData,"editarordenmodulos");


    }

  </script>
@stop