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
</style>
 

<div class="row row-docttus">
    <div class="col-md-8">       
       <h1 style="font-weight: 600; font-size: 20px;">Tus Cursos {{$nombre_seccion}}</h1>
       <br />       
       <p>En este espacio encontrarás los cursos que has adquirido y poder disfrutar de su contenido.</p>
    </div>
</div>
        
<hr />

<div class="row row-docttus" style="margin-bottom: 25px;">
   <!--  tarjeta Curso --> 

  @foreach($cursos_disponibles as $curso)
    @if($curso->SeccionCurso=="{$seccion}")
      <div class="col-md-4" style="position: relative;">
        <div class="card-docttus card-docttus-left card-curso" style=" height: auto !important;  margin-bottom: 15px;">
            <div class="row">
              <div class="col-10">
                <h5 style="font-weight: bold; height: 49px; overflow: hidden;  text-overflow: ellipsis;">{{$curso->NombreCurso}}</h5>
              </div>
              <div class="col-2">
                
                              
                
                  <a title="Ingresar al curso" class="btn botones-docttus" href="{{url('')}}/curso/{{$curso->SlugCurso}}" style=" position: absolute; margin-top: 7px; right: 13px; padding: 1px; height: 25px; width: 24px;"><i class="fa fa-caret-right" aria-hidden="true"></i>
                  </a>

                  
                
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">

                

                  <a href="{{url('')}}/curso/{{$curso->SlugCurso}}" target="_parent">
                    <img src="{{url('')}}/assets/images/cursos/{{$curso->ImagenCurso}}" style="width: 100%; ">
                  </a>                 
                

                <div class="row fila-info">
                  
                  <div class="col-4">
                    <small><i class="fa fa-video-camera icono" aria-hidden="true"></i> {{$curso->cantidad_lecciones}} Lecciones</small>
                  </div>

                  <div class="col-4">
                    <small><i class="fa fa-list-ul icono" aria-hidden="true"></i> {{$curso->cantidad_modulos}} Módulos</small>
                  </div>

                  <div class="col-4">
                    <small><i class="fa fa-clock-o icono" aria-hidden="true"></i> {{$curso->cantidad_horas}} Horas</small>
                  </div>
                  
                </div>            
              </div>
            </div>
        </div>
      </div>
    @endif
  @endforeach
  <!--  tarjeta Curso --> 
</div>




   <!-- Modal -->
        <div class="modal fade" id="enlace-afiliado" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel2" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel2">Enlace Curso | <span id="nombre_curso"></span></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">                  
                  <label>ID Seguimiento</label>
                  <input type="text" name="" class="form-control" value="" id="seguimiento_enlace">
                  <br />
                  <button class="btn btn-warning botones-docttus" id="btn_generar_enlace">Generar Enlace</button>
                  <br>
                  <br>
                  <div style="width: 100%; padding:5px; background-color: #dcdcdc; border-radius: 9px;">
                      <span>{{url('')}}/c/<span id="codigo_curso_enlace"></span>/{{$data[0]->NombreUsuario}}/<span id="id_seguimiento"></span></span> 
                  </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary botones-docttus" data-dismiss="modal">Cerrar</button>                
              </div>
            </div>
          </div>
        </div>


@stop

@section('scripts')

    
    <script type="text/javascript">


      $("#btn_generar_enlace").click(function(){
          var seguimiento_enlace=""+$("#seguimiento_enlace").val();
          $("#id_seguimiento").html(""+seguimiento_enlace);

      });


      function abrir_pop_enlace(codigo_curso,nombre_curso){
          $("#nombre_curso").html(""+nombre_curso);
          $("#codigo_curso_enlace").html(""+codigo_curso);
          $("#enlace-afiliado").modal("show");
      }

      function descargar_factura(orden_id){
        var codigo_transaccion=""+orden_id;
        var formData = new FormData();
        formData.append('codigo_transaccion', codigo_transaccion);			  
	      formData.append('_token', "{{ csrf_token() }}");

	      	var request = $.ajax({
		      url: "{{url('')}}/impresion_fact.php",
		      type: "POST",
		      data: formData,
          	  processData: false,  // tell jQuery not to process the data
          	  contentType: false  // tell jQuery not to set contentType         
		    });

		    request.done(function(obj) { 		       
				if(obj.status=="ok"){
					window.open("{{url('')}}/"+obj.file,"_blank");
					return;
				}
		    });
		     //respuesta si falla
		    request.fail(function(jqXHR, textStatus) {
		      console.log( "Error de servidor  " + textStatus );
		    });

      }




    </script>
@stop