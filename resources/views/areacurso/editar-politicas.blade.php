@extends('areacurso.plantillas.plantilla-area-interna')
@section('contenido')   
<style>
  .btn_usuario{
    cursor: pointer;
  }

  h2{
      font-size: 20px;
  }
</style>

<div class="row row-docttus">
    <div class="col-md-12">             
      <h1 style="font-weight: 600; font-size: 35px;">{{(count($politicas))?$politicas[0]->TituloPolitica:''}}</h1>
      <br>
      <div class="card-docttus card-docttus-left" style=" height: auto !important;">        
        <form id="formulario_politica">
        <div class="row row-docttus" style="margin-top: 15px;">

            
            
                <div class="col-md-6"  style="margin-top: 15px;">
                    <label>Título Política</label>
                    <input class="form-control" type="text" id="TituloPolitica" value="{{(count($politicas))?$politicas[0]->TituloPolitica:''}}" required />
                </div>


                <div class="col-md-6"  style="margin-top: 15px;">
                    <label>Slug Política</label>
                    

                    <div class="input-group mb-3">
                        <input class="form-control" type="text" id="SlugPolitica" value="{{(count($politicas))?$politicas[0]->SlugPolitica:''}}"  required />
                        <div class="input-group-append">
                            <a class="btn btn-info" href="{{url('')}}/politica/{{(count($politicas))?$politicas[0]->SlugPolitica:''}}" target="_blank">VER</a>
                        </div>
                    </div>


                </div>
                

                <div class="col-md-3" style="margin-top: 15px;">
                    <label>Fecha Política</label>
                    <input class="form-control" type="date" id="FechaPolitica" value="{{(count($politicas))?$politicas[0]->FechaPolitica:''}}" required />
                </div>

                <div class="col-md-3" style="margin-top: 15px;">
                    <label>Estado</label>
                    <select class="form-control" id="IdEstado">
                        <option value="1" @if(count($politicas)) @if($politicas[0]->IdEstado) selected  @endif @endif >Activo</option>
                        <option value="2"  @if(count($politicas)) @if(!$politicas[0]->IdEstado) selected  @endif @endif >Inactivo</option>
                    </select>
                </div>

                <div class="col-md-6" style="margin-top: 15px;">
                    <label>Política Padre</label>
                    
                    <select class="form-control" id="IdPoliticaPadre">
                        <option value="">- Sin Política Padre -</option>
                        @foreach($politicas_padre as $padre)
                            <option value="{{$padre->IdPolitica}}">{{$padre->TituloPolitica}}</option>
                        @endforeach
                    </select>
                </div>

                

                <div class="col-md-12" style="margin-top: 15px;">
                    <textarea  rows="7" class="form-control html-paginas" id="ContenidoPolitica">{{(count($politicas))?$politicas[0]->ContenidoPolitica:''}}</textarea>
                </div>

                <div class="col-md-12" style="margin-top: 15px;">
                    <input type="submit" class="btn btn-warning" value="Guardar Información">
                </div>
            

        </div>
        </form>
      </div>
      
       
    </div>
</div>





@stop

@section('scripts')

    
<script type="text/javascript">



$( document ).ready(function() {
    $("#IdPoliticaPadre").val("{{(count($politicas))?$politicas[0]->IdPoliticaPadre:''}}");
});

$("#formulario_politica").submit(function(e){
    e.preventDefault();

    var TituloPolitica=$("#TituloPolitica").val();
    var SlugPolitica=$("#SlugPolitica").val();
    var FechaPolitica=$("#FechaPolitica").val();
    var IdEstado=$("#IdEstado").val();
    var ContenidoPolitica=""+tinymce.get('ContenidoPolitica').getContent();
    var IdPoliticaPadre=$("#IdPoliticaPadre").val();

    var formData = new FormData();    
    formData.append('TituloPolitica', TituloPolitica);
    formData.append('SlugPolitica', SlugPolitica);
    formData.append('FechaPolitica', FechaPolitica);
    formData.append('IdEstado', IdEstado);
    formData.append('IdPolitica', "{{(count($politicas))?$politicas[0]->IdPolitica:''}}");    
    formData.append('IdPoliticaPadre', IdPoliticaPadre);    
    formData.append('ContenidoPolitica', ContenidoPolitica);

    formData.append('_token', "{{ csrf_token() }}");        
    

    var request = $.ajax({
        url: "{{url('')}}/set_politica",
        type: "POST",
              
        data: formData,
        processData: false,  // tell jQuery not to process the data
        contentType: false  // tell jQuery not to set contentType
    });

    request.done(function(obj) {                             
        if(obj.status=="ok"){                              
            mensaje_generico("Correcto",""+obj.mensaje,"1","Continuar...",function(){
                  location.reload();
                  window.open("{{url('')}}/editar-politicas/"+obj.IdPolitica,"_parent");
            });
        }
    });
        
    request.fail(function(jqXHR, textStatus) {
        alert( "Error de servidor  " + textStatus );
    });


});

tinymce.init({
    
    setup: function (ed) {
        ed.on('init', function(args) {
           $("#cargar-componentes").modal("hide");
        });
    },


    selector: ".html-paginas",

    
  fontsize_formats: '8pt 10pt 12pt 14pt 18pt 24pt 36pt 42pt 52pt',

  relative_urls : false,
  height : "480",

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


</script>
@stop