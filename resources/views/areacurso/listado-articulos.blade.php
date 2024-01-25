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
     width: 180px; height: 140px; background-size: contain; background-position: center; background-repeat: no-repeat;   
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
            <h1 class="m-0 text-dark">Artículos <a href="{{url('')}}/gestion-articulos"  class="btn btn-block btn-default" style="display: inline-block; width: auto;">+ Agregar Nuevo</a> </h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('')}}/backoffice">Inicio</a></li>
              <li class="breadcrumb-item active">Artículos</li>
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

          <div class="col-lg-12">
            <div class="card">
              <div class="card-body">                
                  
                  <table id="tabla_generica" style="width: 100%;" class="table table-stripped table-bordered">
                    <thead>
                      <tr>
                        <th>ID</th>
                        <th>Fecha</th>
                        <th>Título</th>
                        <th>Autor</th>
                        <th>Estado</th>
                        <th style="width: 135px;">Acción</th>
                      </tr>
                    </thead>

                    <tbody>

                      @foreach($data_articulo as $articulo)
                      <tr>
                        <td>{{$articulo->IdArticulo}}</td>
                        <td>{{$articulo->FechaArticulo}}</td>
                        <td>{{$articulo->TituloArticulo}}</td>
                        <td>{{$articulo->AutorArticulo}}</td>
                        <td>{{$articulo->IdEstadoArticulo}}</td>
                        <td  style="width: 135px;">
                          <a href="{{url('')}}/gestion-articulos/{{$articulo->IdArticulo}}" class="btn btn-info btn-xs" style="padding: 6px; width: 31px;">E</a>
                          @if($articulo->IdEstado==1)
                          <a href="#" onclick="eliminar_articulo({{$articulo->IdArticulo}},2)" class="btn btn-danger btn-xs" style="padding: 6px; width: 31px;">X</a>                          
                          @else
                            <a href="#" onclick="eliminar_articulo({{$articulo->IdArticulo}},1)" class="btn btn-success btn-xs" style="padding: 6px; width: 31px;"><i class="fa fa-check" aria-hidden="true"></i></a>                          
                          @endif
                        </td>
                        
                      </tr>
                      @endforeach
                    </tbody>
                  </table>



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



@stop

@section('scripts')
  <script type="text/javascript">
    
    var url_pag_principal="{{url('')}}";

    var arra_obj_articulos=new Object();
    
/*

    tinymce.init({
    
    setup: function (ed) {
        ed.on('init', function(args) {
           $("#cargar-componentes").modal("hide");
        });
    },


    selector: ".html-paginas",

    
  fontsize_formats: '8pt 10pt 12pt 14pt 18pt 24pt 36pt 42pt 52pt',

  relative_urls : false,

  remove_script_host : false,
  extended_valid_elements : "ins[class|style|data-ad-client|data-ad-slot],a[id|class|name|href|target|title|onclick|rel|data-toggle|data-parent],script[async|type|src],iframe[src|style|width|height|scrolling|marginwidth|marginheight|frameborder|allowfullscreen|class],img[class|src|border=0|alt|title|hspace|vspace|width|height|align|onmouseover|onmouseout|name|style|id|onclic]",
    plugins: [
        "advlist autolink lists link image charmap print preview anchor",
        "searchreplace visualblocks code fullscreen",
        "insertdatetime media table contextmenu paste",
        "textcolor colorpicker"
    ],
    toolbar: "insertfile undo redo | fontsizeselect | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | forecolor backcolor"
});

*/



$('#tabla_generica').dataTable( { 
      "ordering": true, 
      "info": false, 
      "lengthChange": true,
      "searching": true,
      "language": {
          "search": "Buscar Artículos:",
          "lengthMenu": "Mostrar _MENU_ Artículos por Página"
        }
    } );



var id_articulo_sel="";
var id_estado_sel="2";

function eliminar_articulo(id_articulo,id_estado){

  id_articulo_sel=""+id_articulo;
  var mensaje_delete="Inactivar";
  if(id_estado==1){
     mensaje_delete="Activar" ;
  }

  var r = confirm("Deseas "+mensaje_delete+" este Artículo?");
  if (r == true) {
    id_estado_sel=""+id_estado;
    ajx_eliminar_artiuclo();
  } else {
  
  }

}

function ajx_eliminar_artiuclo(){
      
      var formData = new FormData();        
      formData.append('IdArticulo', id_articulo_sel);
      formData.append('IdEstado', id_estado_sel);
      formData.append('_token', "{{ csrf_token() }}");        
    

      var request = $.ajax({
          url: "{{url('')}}/delete_articulos",
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
