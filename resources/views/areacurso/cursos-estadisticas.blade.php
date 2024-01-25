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

  .btn-menu-leccion::before {
    display: none !important;
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

  
    <div class="row" style="margin-top:45px;">
        <div class="col-md-12">
            <h4>Estadísticas</h4>
                <small><i><strong>Curso:</strong> {{$curso->NombreCurso}}</i></small>
            <hr>
        </div>
    </div>

    <div class="row">       
  
        <div class="col-md-12">
            <div class="card-docttus card-docttus-left" style=" height: auto !important; position: relative;">
                <small>..Cargando..</small>
            </div>            
        </div>
    </div>
  
  
    <hr />

             
    

    


</div>
<br />
<br />
<br />
<br />
<br />
<br />
<br />

</form>







@stop

@section('scripts')

  <script src="{{url('')}}/assets/tinymce/js/tinymce/tinymce.min.js"></script>
  <script src="{{url('')}}/assets/tinymce/js/tinymce/jquery.tinymce.min.js"></script>
  <script src="{{url('')}}/assets/js/sortable.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/jquery-sortablejs@latest/jquery-sortable.js"></script>

  <script type="text/javascript">   

       

    function guardar_informacion(campos,funcionlv,especial=""){

        campos.append('CodigoCurso', "{{$curso->CodigoCurso}}");
        campos.append('_token', "{{ csrf_token() }}");        
        campos.append('token_curso', "{{ $token_curso }}");

        
        var request = $.ajax({
            url: "{{url('')}}/"+funcionlv,
            type: "POST",
            data: campos,
            processData: false,  // tell jQuery not to process the data
            contentType: false,  // tell jQuery not to set contentType
            cache:false
        });

        request.done(function(obj) { 
            if(obj.status=="ok"){            
                
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