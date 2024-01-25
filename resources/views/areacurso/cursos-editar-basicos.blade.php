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
      <h4>Información Básica</h4>
      <small><i><strong>Curso:</strong> {{$curso->NombreCurso}}</i></small>
      <hr>
      



        <div class="row" style="margin-bottom: 25px;">            
          <div class="col-md-12">
              <div class="card-docttus" style="padding-top:20px; padding-bottom:20px;">
                  <div class="row">                        
                      <div class="col-9">

                          <h3 style="font-size: 23px; margin:0px; padding:0px;">                              
                              Enlace para promocionar
                          </h3>
                          <a target="_blank" href="{{url('')}}/c/{{$curso->SlugCurso}}/{{$data[0]->NombreUsuario}}"><span>{{url('')}}/c/{{$curso->SlugCurso}}/{{$data[0]->NombreUsuario}}</span></a>
                          

                      </div>

                    
                  </div>
              </div>
          </div>
        </div>








    </div>
  </div>

             
  <div class="row">
    <div class="col-md-4">
      <h6 style="font-weight: bold;" class="my-4">Agrega información <span>descriptiva</span></h6>
      <p>Diligencia esta sesión con la información clara sobre tu curso. Ten en cuenta que estos datos serán visibles al público en la presentación del curso.</p>
    </div>

    <div class="col-md-8">
        <div class="card-docttus card-docttus-left" style=" height: auto !important; position: relative;">          
          
          @if(session('rol_solicitud')=="root") 
          <div class="form-group  input-group-sm">
            <label>Sección Curso *</label> <i class="fa fa-info-circle btn-titulo" title=""></i>
            <select class="form-control" id="SeccionCurso">
                <option value="1">Curso Externo</option>
                <option value="2">Curso para Afiliados Premium</option>
                <option value="3">Curso para Afiliados Free</option>
                <option value="4">Curso para Tutores</option>
            </select>
          </div>
          @endif


            
            <div class="form-group  input-group-sm">
                <label>Tipo Producto *</label> <i class="fa fa-info-circle btn-titulo" title="1) Curso: Contenido audiovisual. 2) Playbook: Contenido en texto y audio."></i>
                <select class="form-control" id="IdTipoCurso">
                    <option value="1">Curso</option>
                    <option value="2">Playbook</option>
                </select>
            </div>

            <div class="form-group  input-group-sm">                        
              <label>Lanzamiento *</label> <i class="fa fa-info-circle btn-titulo" title="Selecciona el tipo de lanzamiento. 1) Externo - Lanzamiento evergreen. 2) Lanzamiento semilla, los contenidos podrán salir en las fechas que se seleccione."></i>
              <select class="form-control" id="IdTipoLanzamiento">
                  <option value="1">Externo</option>
                  <option value="2">Semilla</option>
              </select>                
            </div>


            <div class="form-group  input-group-sm">                        
                <label>Título *</label> <i class="fa fa-info-circle btn-titulo" title="Diligencia la denominación o el título del curso que se encuentra creando."></i>
                <input id="NombreCurso" type="text" name="nombre" class="form-control valida-caracteres"  value="{{$curso->NombreCurso}}" required maxlength="70">
                <div class="text-right">
                    <small> <strong id="cant_caracteres_NombreCurso">0</strong> Carácteres Restantes</small>  
                </div>              
            </div>

            <div class="form-group">    
              <?php 
                $SlugCurso=$curso->SlugCurso;                  
              ?>                    
             <label>URL Curso </label> <i class="fa fa-info-circle btn-titulo" title="Este campo se genera automáticamente, en la medida que el Tutor registra el nombre del curso. Se encuentra controlado para evitar datos repetidos en el sistema."></i>
             
             <input type="text" class="form-control" id="SlugCurso" value="{{$SlugCurso}}" readonly> 

             
            </div>


            

            


            <div class="form-group  input-group-sm">
              <label>Descripción Corta *</label> <i class="fa fa-info-circle btn-titulo" title="Describe de manera general sobre tu curso, mencionando el método de enseñanza, que conocimientos adquirirán tus estudiantes, qué ventajas tendrán una vez terminen el curso, etc."></i>
              <textarea class="form-control valida-caracteres" id="DescripcionCortaCurso" maxlength="250" required>{{$curso->DescripcionCortaCurso}}</textarea>
              <div class="text-right">
                <small> <strong id="cant_caracteres_DescripcionCortaCurso">0</strong> Carácteres Restantes</small>  
              </div>
            </div>

            <div class="form-group input-group-sm">
                <label>Descripción Completa *</label>  <i class="fa fa-info-circle btn-titulo" title="Describe de una forma más detallada el contenido del curso. Menciona sobre los módulos, lecciones y las actividades que tendrán que desarrollar los estudiantes, entre otros."></i>
                <textarea class="form-control html-paginas valida-caracteres-tinymce" id="DescripcionCurso" name="DescripcionCurso">{{$curso->DescripcionCurso}}</textarea>
                <div class="text-right">
                  <small> <strong id="cant_caracteres_DescripcionCurso">4000</strong> Carácteres Restantes</small>  
                </div>
            </div>


       
           
            <div class="form-group input-group-sm">
              <label>Audiencia</label>  <i class="fa fa-info-circle btn-titulo" title="Registra el conjunto de personas al cual está dirigido el contenido del curso. Ejemplo: Emprendedores."></i>
              <textarea class="form-control valida-caracteres" id="AudienciaCurso" maxlength="250">{{$curso->AudienciaCurso}}</textarea>
              
              <div class="text-right">
                <small> <strong id="cant_caracteres_AudienciaCurso">0</strong> Carácteres Restantes</small>  
              </div>

            </div>

       
            <div class="form-group input-group-sm">
                <label>Prerrequisitos</label>  <i class="fa fa-info-circle btn-titulo" title="Registra que conocimientos previos o que tecnología debe tener el estudiante para adquirir el curso. En caso contrario, diligenciar: No aplica."></i>
                <textarea class="form-control valida-caracteres" maxlength="250" id="PrerrequisitoCurso">{{$curso->PrerrequisitoCurso}}</textarea>
                
                <div class="text-right">
                  <small> <strong id="cant_caracteres_PrerrequisitoCurso">0</strong> Carácteres Restantes</small>  
                </div>
            </div>

            <div class="form-group input-group-sm">
              <label>Nivel</label>   <i class="fa fa-info-circle btn-titulo" title="Selecciona el dato de la lista desplegable, de acuerdo al grado de dificultad del curso."></i>
              <select class="form-control" id="IdNivelCurso">
                @foreach($niveles as $nivel)
                <option value="{{$nivel->IdNivel}}">{{$nivel->NombreNivel}}</option>
                @endforeach 
              </select>
            </div>

          

        </div>
        <br />
        <p style="color: #adadad;">* Campos obligatorios</p>
        <p style="color: #adadad;">* NOTA: Los campos que no completes no se mostrarán en la página de inicio del curso.</p>
    </div>
  </div>


  <hr />


  <div class="row">
    <div class="col-md-4">
      <h6 style="font-weight: bold;" class="my-4">Categorías</h6>
      <p>Selecciona la categoría a la cual pertenece tu curso. Este dato será visible al público en la presentación del curso.</p>
    </div>

    <div class="col-md-8">
        <div class="card-docttus card-docttus-left" style=" height: auto !important; position: relative;">
          
            
            <div class="form-group  input-group-sm">                        
              <label>Categoría</label>  <i class="fa fa-info-circle btn-titulo" title="Selecciona el dato de la lista desplegable, de acuerdo al tipo de categoría a la cual pertenece el curso."></i>
              <select class="form-control" id="IdSubcategoria">
                  @foreach($categorias as $categoria)

                     <optgroup label="{{$categoria->NombreCategoria}}">
                       
                       
                     @foreach($subcategorias as $subcat)
                       @if($subcat->IdCategoria==$categoria->IdCategoriaCursos)
                         @if($subcat->IdSubcategoria==$curso->IdSubcategoria)
                           <option selected value="{{$subcat->IdSubcategoria}}">{{$subcat->NombreSubcategoria}}</option>
                         @else
                           <option value="{{$subcat->IdSubcategoria}}">{{$subcat->NombreSubcategoria}}</option>
                         @endif

                       @endif
                     @endforeach


                     </optgroup>

                   @endforeach
              </select>
           </div>

          

        </div>        
    </div>
  </div>

  <hr />

  <div class="row">
    <div class="col-md-4">
      <h6 style="font-weight: bold;" class="my-4">Afiliados</h6>
      <p>Proporciona material promocional y configura la afiliación automática si aplica o no.</p>
    </div>

    <div class="col-md-8">
        <div class="card-docttus card-docttus-left" style=" height: auto !important; position: relative;">
          
            
            <div class="form-group input-group-sm">
                <label>Aplica Afiliación</label>
                <select class="form-control" id="AprobacionAutomatica">
                    <option value="1">SI</option>
                    <option value="0">NO</option>
                </select>
            </div>

            
                       

            <div class="form-group input-group-sm">
                <label>URL Material Promocional</label>  <i class="fa fa-info-circle btn-titulo" title="Copia el link del sitio y/o repositorio donde se encuentra tu material promocional."></i>
                <input class="form-control" id="URLMaterialPromocional" value="{{$curso->URLMaterialPromocional}}">
            </div>

            


        </div>        
    </div>
  </div>

  @if(session('rol_solicitud')=="root")
  <hr>
  <div class="row">
    <div class="col-md-4">
      <h6 style="font-weight: bold;" class="my-4">Hotmart | Ventas</h6>
      <p>Asignación de pixel para Docttus, Enlace de Afiliación y Checkout de Hotmart para Docttus</p>
    </div>

    <div class="col-md-8">
        <div class="card-docttus card-docttus-left" style=" height: auto !important; position: relative;">         
            
            <div class="form-group input-group-sm">
              <label>Código Producto Hotmart</label>
              <input class="form-control" id="CodigoHotmart" value="{{$curso->CodigoHotmart}}">
            </div>
            
            
            <div class="form-group input-group-sm">
                <label>URL Solicitud Afiliados</label>
                <input class="form-control" id="URLHotmartSolicitudAfiliados" value="{{$curso->URLHotmartSolicitudAfiliados}}">
            </div>


            @php
              $arra_datos_ventas=explode("||",$SolicitudAfiliado);
            @endphp
            
            <div class="form-group input-group-sm">
                <label>URL Checkout Hotmart - Docttus</label>
                <input class="form-control" id="URLHotmartCheckoutDocttus" value="{{$arra_datos_ventas[1]}}">
            </div>

            <div class="form-group input-group-sm">
              <label>Id Pixel Facebook - Docttus</label>
              <input class="form-control" id="PixelFacebook"  value="{{$arra_datos_ventas[0]}}">
            </div>

            <div class="form-group input-group-sm">
              <label>Token Pixel Facebook - Docttus</label>
              <input class="form-control" id="TokenFacebook"  value="{{$arra_datos_ventas[2]}}">
            </div>

            


        </div>        
    </div>
  </div>
  @endif





</div>
<br />
<br />
</form>




<!-- Modal -->
  <div class="modal fade" id="cambios_de_estado" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel2" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel2">Enviar a Revisión</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body" style="text-align: center;">
          @if($curso->IdEstado==3)
           <h3>El curso entrará en proceso de revisión por parte del equipo de Docttus.</span></h3>
           <p>Este proceso podrá tomar entre 12 a 24 horas.</p>
           <h5>¿Deseas continuar con el proceso?</h5>
          @endif
          
        </div>
        <div class="modal-footer" style="text-align: center; width: 100%; display: inline-block;">
          <center>
            <button type="button" class="btn btn-secondary botones-docttus" data-dismiss="modal" id="btn_estado_revision">Aceptar</button>                
            <button type="button" class="btn btn-danger" data-dismiss="modal" style="border-radius: 25px;">Cancelar</button>                  
          </center>
          
        </div>
      </div>
    </div>
  </div>





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

    $(function(){ 
        $("#AprobacionAutomatica").val("{{$curso->AprobacionAutomatica}}");
        $("#IdNivelCurso").val("{{$curso->IdNivelCurso}}");        
        $("#IdTipoLanzamiento").val("{{$curso->IdTipoLanzamiento}}");        
        $("#IdTipoCurso").val("{{$curso->IdTipoCurso}}");

        @if(session('rol_solicitud')=="root") 
        $("#SeccionCurso").val("{{$curso->SeccionCurso}}");
        @endif

        
    });

      

        
      var cant_total_char_tinymce=4000;

      tinymce.init({          
          height:"224",

          setup: function (ed) {
              ed.on('init', function(args) {
                 //$("#cargar-componentes").modal("hide");
                 var texto_componente=ed.getContent({format : 'text'});                  
                 texto_componente=texto_componente.trim();
                  var cant_actual=cant_total_char_tinymce-texto_componente.length;
                  $("#cant_caracteres_DescripcionCurso").html(cant_actual);
              });

              ed.on('keyup', function(e) {                 

                  var texto_componente=ed.getContent({format : 'text'});
                  texto_componente=texto_componente.trim();
                  var cant_actual=cant_total_char_tinymce-texto_componente.length;
                  $("#cant_caracteres_DescripcionCurso").html(cant_actual);
                  

              });

          },


        selector: ".html-paginas",

          
        fontsize_formats: '8pt 10pt 12pt 14pt 18pt 24pt 36pt 42pt 52pt',

        relative_urls : false,

        remove_script_host : true,
        extended_valid_elements : "ins[class|style|data-ad-client|data-ad-slot],a[id|class|name|href|target|title|onclick|rel|data-toggle|data-parent],script[async|type|src],iframe[src|style|width|height|scrolling|marginwidth|marginheight|frameborder|allowfullscreen|class],img[class|src|border=0|alt|title|hspace|vspace|width|height|align|onmouseover|onmouseout|name|style|id|onclic]",
          toolbar: " fontsizeselect | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | forecolor backcolor"
      });


     
    getFotoCurso = function($idcomponente) {
        $('#'+$idcomponente).attr('accept', '.jpg, .png');
        $('#'+$idcomponente).show();
        $('#'+$idcomponente).focus();
        $('#'+$idcomponente).click();
        $('#'+$idcomponente).hide();
    }


      // INFORMACIÓN BÁSICA

      $("#NombreCurso").focusout(function(){
        var slugBasicos=$("#NombreCurso").val();
        slugBasicos=slug(slugBasicos);
        
          $("#SlugCurso").val(""+slugBasicos+"-{{$curso->CodigoCurso}}");
        
      });

      $("#SlugCurso").focusout(function(){
        var slugBasicos=$("#SlugCurso").val();
        slugBasicos=slug(slugBasicos);
        
        //$("#SlugCurso").val(""+slugBasicos+"-{{$curso->CodigoCurso}}");
        
      });


      function slug(str) {
        str = str.replace(/^\s+|\s+$/g, ''); // trim
        str = str.toLowerCase();
      
        // remove accents, swap ñ for n, etc
        var from = "àáãäâèéëêìíïîòóöôùúüûñç·/_,:;";
        var to   = "aaaaaeeeeiiiioooouuuunc------";

        for (var i=0, l=from.length ; i<l ; i++) {
            str = str.replace(new RegExp(from.charAt(i), 'g'), to.charAt(i));
        }

        str = str.replace(/[^a-z0-9 -]/g, '') // remove invalid chars
            .replace(/\s+/g, '-') // collapse whitespace and replace by -
            .replace(/-+/g, '-'); // collapse dashes

        return str;
    }


    $("#form-editar-curso").submit(function(e){
        e.preventDefault();

        var NombreCurso=""+$("#NombreCurso").val();
        var SlugCurso=""+$("#SlugCurso").val();
        var IdSubcategoria=""+$("#IdSubcategoria").val();
        var DescripcionCortaCurso=""+$("#DescripcionCortaCurso").val();        
        var DescripcionCurso=""+tinymce.get('DescripcionCurso').getContent();
        var AudienciaCurso=""+$("#AudienciaCurso").val();        
        var PrerrequisitoCurso=""+$("#PrerrequisitoCurso").val();
        var URLMaterialPromocional=""+$("#URLMaterialPromocional").val();
        var AprobacionAutomatica=""+$("#AprobacionAutomatica").val();
        
        
        var IdNivelCurso=""+$("#IdNivelCurso").val();

        var IdTipoLanzamiento=""+$("#IdTipoLanzamiento").val();
        var IdTipoCurso=""+$("#IdTipoCurso").val();
        

        var DescripcionCursoTexto=""+tinymce.get('DescripcionCurso').getContent({format : 'text'});
        DescripcionCursoTexto=DescripcionCursoTexto.trim();
        
        if(DescripcionCursoTexto.length>cant_total_char_tinymce || DescripcionCursoTexto.length==0){
            mensaje_toast("error","La descripción del curso no debe sobrepasar los "+cant_total_char_tinymce+" carácteres y no debe estar vacío", "Descripción del curso",'toast-bottom-right');
            return;
        }


        var formData = new FormData();
        formData.append('NombreCurso', NombreCurso);
        formData.append('SlugCurso', SlugCurso);
        formData.append('IdSubcategoria', IdSubcategoria);
        formData.append('DescripcionCortaCurso', DescripcionCortaCurso);
        formData.append('DescripcionCurso', DescripcionCurso);
        formData.append('AudienciaCurso', AudienciaCurso);
        formData.append('PrerrequisitoCurso', PrerrequisitoCurso);      
        formData.append('URLMaterialPromocional', URLMaterialPromocional);
        formData.append('AprobacionAutomatica', AprobacionAutomatica);            
        
        @if(session('rol_solicitud')=="root") 
        var URLHotmartSolicitudAfiliados=""+$("#URLHotmartSolicitudAfiliados").val();
        var URLHotmartCheckoutDocttus=""+$("#URLHotmartCheckoutDocttus").val();
        var PixelFacebook=""+$("#PixelFacebook").val();
        var CodigoHotmart=""+$("#CodigoHotmart").val();
        var TokenFacebook=""+$("#TokenFacebook").val();
        var SeccionCurso=""+$("#SeccionCurso").val();

        formData.append('URLHotmartSolicitudAfiliados', URLHotmartSolicitudAfiliados);
        formData.append('URLHotmartCheckoutDocttus', URLHotmartCheckoutDocttus);        
        formData.append('PixelFacebook', PixelFacebook);        
        formData.append('CodigoHotmart', CodigoHotmart);        
        formData.append('TokenFacebook', TokenFacebook);
        formData.append('SeccionCurso', SeccionCurso);

        @endif
        
        formData.append('IdNivelCurso', IdNivelCurso);
        formData.append('IdTipoLanzamiento', IdTipoLanzamiento);
        formData.append('IdTipoCurso', IdTipoCurso);
        
        formData.append('DescripcionCursoTexto', DescripcionCursoTexto);

        guardar_informacion(formData,"editarinformacionbasica");

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
            contentType: false,  // tell jQuery not to set contentType
            cache:false
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



    


      //ENVÍO DE PRECIOS
    $("#btn_estado_revision").click(function(e){
        e.preventDefault();

        var formData = new FormData();
        guardar_informacion(formData,"cambiarestadorev");
    });

    $("#btn_vista_previa").click(function(){
        window.open("{{url('')}}/c/{{$SlugCurso}}","_blank");
    });


      



    </script>
@stop