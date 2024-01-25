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
</style>
 

<div class="row row-docttus">
    <div class="col-md-6">       
       <h1 style="font-weight: 600; font-size: 20px;">Crear Curso Docttus</h1>
       <br />       
       <p>En este espacio podrás publicar tus cursos y ganar dinero comercializándolos.</p>
       
    </div>

    <div class="col-md-6">       
      <button  class="btn botones-docttus" id="btn_nuevo" style="margin-top:45px; float:right;">
         + Crear Nuevo Curso
      </button>
    </div>
    
</div>
        
<hr />

<div class="row row-docttus" style="margin-bottom: 25px;">
   <!--  tarjeta Curso --> 

   


  @foreach($cursos_disponibles as $curso)
  @php 
    $solicitud_afiliado=$curso->SolicitudAfiliado;
    $arra_solicitud=explode("||",$solicitud_afiliado);
    $PixelFacebook=$arra_solicitud[0];
    $URLHotmartCheckout=$arra_solicitud[1];
    $TokenFacebook=$arra_solicitud[2];
  @endphp

  

  

  <div class="col-md-4" style="position: relative;  margin-bottom:25px;">      
     <div class="card-docttus card-docttus-left card-curso" style=" height: auto !important; position: relative; margin-bottom: 25px;">
        @if($curso->IdEstado==3)
        <span class="etiqueta-curso" style="background-color: #9c9c9c;">BORRADOR</span>
        @elseif($curso->IdEstado==2)
        <span class="etiqueta-curso" style="background-color: #dc3545;">INACTIVO</span>
        @elseif($curso->IdEstado==4)
        <span class="etiqueta-curso" style="background-color: #de8c12;">EN REVISIÓN</span>
        @else
        <span class="etiqueta-curso" style="background-color: #12c4de;">ACTIVO</span>
        @endif

        @if($curso->IdEstado!=2)
        <button title="Ver enlace de afiliado" class="btn botones-docttus" onclick="abrir_pop_enlace('{{$curso->CodigoCurso}}','{{$curso->NombreCurso}}','{{$PixelFacebook}}','{{$TokenFacebook}}','{{$URLHotmartCheckout}}')" style=" position: absolute; margin-top: -21px; right: 62px; padding: 1px; height: 25px; width: 24px;">$
              </button>

        <a title="Editar" href="{{url('')}}/cursos/editar-basicos/{{$curso->CodigoCurso}}" class="btn"  style=" position: absolute; margin-top: -21px; right: 32px; padding: 1px; height: 25px; width: 24px; background-color: #355a98 !important; color: #fff; border-radius: 25px; font-weight: 300; font-size: 14px;">
          <i class="fa fa-pencil" aria-hidden="true"></i>
        </a>


        <a href="#" onclick="abrir_eliminar('{{$curso->CodigoCurso}}','{{$curso->NombreCurso}}')" title="Eliminar Curso" class="btn"  style=" position: absolute; margin-top: -21px; right: 3px; padding: 1px; height: 25px; width: 24px; background-color: #dc3545 !important; color: #fff; border-radius: 25px; font-weight: 300; font-size: 14px;">
          <i class="fa fa-trash" aria-hidden="true"></i>
        </a>
        @endif
        
        <div class="row">
          <div class="col-10">
             <h5 style="font-weight: bold; font-size: 16px; height: 40px;">{{$curso->NombreCurso}}</h5>
          </div>
          <div class="col-2">
            
              <?php 

                $valor_anterior=$curso->ValorPrecioProducto;
                $valor_curso_actual=$curso->ValorPrecioProducto;
                $descuento_curso=$curso->DescuentoCurso;
                $porcentaje_curso=0;

                if($curso->TipoDescuento=="1"){               
                  $valor_curso_actual=$valor_curso_actual-($valor_curso_actual*($descuento_curso/100));
                  $porcentaje_curso=$descuento_curso;

                }else if($curso->TipoDescuento=="2"){
                  $valor_curso_actual=$valor_curso_actual-$descuento_curso;
                  $descuento_curso=($descuento_curso*100)/$valor_curso_actual;
                  $descuento_curso=intval($descuento_curso);

                }
              ?>
            
              


            
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">

            

              <a href="{{url('')}}/cursos/editar-basicos/{{$curso->CodigoCurso}}">
                <img src="{{url('')}}/assets/images/cursos/{{$curso->ImagenCurso}}" style="width: 100%; cursor: pointer;" >
              </a>
                
                               
            

            <div class="row fila-info">              
              
              <div class="col-6" style="text-align: left;">
                  Descuento: {{$curso->DescuentoCurso}}% <br/>
                  
                  <a class="btn btn-warning btn-sm" target="_blank" style="border-radius: 25px;" href="{{url('')}}/c/{{$curso->SlugCurso}}">Ver Oferta</a>


              </div>
              <div class="col-6" style="text-align: right;">                
                <small>Antes: <span>${{$valor_anterior}} USD</span></small><br />
                <small>Precio Actual:</small>
                <h5>${{$valor_curso_actual}} USD</h5>
              </div>
              
            </div>            
          </div>
        </div>
     </div>
  </div>
  @endforeach
  <!--  tarjeta Curso --> 
</div>





<!-- Modal -->
<div class="modal fade" id="enlace-afiliado" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel2" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel2">Venta Curso | <span id="nombre_curso"></span></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">                  
            <label>Pixel de Facebook</label>
            <input type="text" name="" class="form-control" value="" id="pixel_facebook">
            <br />
            <label>Token de Facebook</label>
            <input type="text" name="" class="form-control" value="" id="token_facebook">
            <br />
            <label>URL Checkout Hotmart - Tutor</label>
            <input type="text" name="" class="form-control" value="" id="url_checkout_hotmart">
            <br />

            <div style="width: 100%; padding:5px; background-color: #dcdcdc; border-radius: 9px;">
                <span>{{url('')}}/c/<span id="codigo_curso_enlace"></span>/{{$data[0]->NombreUsuario}}/<span id="id_seguimiento"></span></span> 
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-success" style="border-radius: 25px;" id="btn_guardar_venta_curso">Guardar</button>
            <button type="button" class="btn btn-secondary botones-docttus" data-dismiss="modal">Cerrar</button>
            
        </div>
        </div>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="enlace-creacion" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel2" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="tituk">Crear Nuevo Curso</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">                  
          <form id="form_creacion">
            <label>Nombre Curso</label>
            <input type="text" name="" class="form-control" value="" id="txttitulocurso" required placeholder="* Titulo del curso">

            <br />
            <label>Categoría</label>
            <select class="form-control" required id="txtsubcategoria">
                @foreach($categorias as $categoria)

                  <optgroup label="{{$categoria->NombreCategoria}}">
                    
                    
                  @foreach($subcategorias as $subcat)
                    @if($subcat->IdCategoria==$categoria->IdCategoriaCursos)
                      <option value="{{$subcat->IdSubcategoria}}">{{$subcat->NombreSubcategoria}}</option>
                    @endif
                  @endforeach


                  </optgroup>

                @endforeach
            </select>

          </form>
          

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary botones-docttus" id="btn_crear_curso">Crear Curso</button>                
        <button type="button" class="btn btn-danger" data-dismiss="modal" style="border-radius: 25px;">Cerrar</button>                
        
      </div>
    </div>
  </div>
</div>



<!-- Modal Eliminar -->
<div class="modal fade" id="eliminar-curso" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel2" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel2"><span id="nombre_curso_eliminar"></span></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" style="text-align: center;">                  
          <h2>¿Está seguro de inactivar este curso?</h2>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal" style="border-radius: 25px;">Cerrar</button>                
        <button type="button" class="btn btn-secondary botones-docttus" id="btn_curso_eliminar" >Aceptar</button>                
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


      $("#btn_guardar_venta_curso").click(function(e){
        e.preventDefault();

        guardar_info_ventas();


      });

      var codigo_curso_sel="";
      function abrir_pop_enlace(codigo_curso,nombre_curso,pixel_facebook,token_facebook,URL_hotmart_checkout){

          $("#url_checkout_hotmart").val(""+URL_hotmart_checkout);
          $("#pixel_facebook").val(""+pixel_facebook);
          $("#token_facebook").val(""+token_facebook);
          

          codigo_curso_sel=codigo_curso;
          $("#nombre_curso").html(""+nombre_curso);
          $("#codigo_curso_enlace").html(""+codigo_curso);
          $("#enlace-afiliado").modal("show");
      }


      $("#btn_nuevo").click(function(){
        nuevo_curso();        
      });

      function nuevo_curso(){
        $("#enlace-creacion").modal("show");
      }


      $("#btn_crear_curso").click(function(e){
        e.preventDefault();
        $("#form_creacion").submit();  
      });
      $("#form_creacion").submit(function(e){
        e.preventDefault();
        crear_curso();
      });


      function crear_curso(){

        var titulo_curso=$("#txttitulocurso").val();
        var subcategoria_curso=$("#txtsubcategoria").val();

        var request = $.ajax({
            url: "{{url('')}}/setcurso",
            type: "POST",
            data:{                                
                 titulo_curso:""+titulo_curso,
                 subcategoria_curso:""+subcategoria_curso,
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

    var codigo_curso_eliminar="";
    function abrir_eliminar(codigocurso,titulo){
      codigo_curso_eliminar=codigocurso;
      $("#eliminar-curso").modal("show");
      $("#nombre_curso_eliminar").html(""+titulo);
    }


    $("#btn_curso_eliminar").click(function(e){
      eliminar_curso();
    });


    function eliminar_curso(){
        var CodigoCurso=codigo_curso_eliminar;        
        var request = $.ajax({
            url: "{{url('')}}/eliminarcurso",
            type: "POST",
            data:{                                
                 CodigoCurso:""+CodigoCurso,
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

    function guardar_info_ventas(){
        var url_checkout_hotmart=$("#url_checkout_hotmart").val();
        var pixel_facebook=$("#pixel_facebook").val();
        var token_facebook=$("#token_facebook").val();

        var request = $.ajax({
            url: "{{url('')}}/set_afiliacion",
            type: "POST",
            data:{                                
                  url_checkout_hotmart:""+url_checkout_hotmart,
                  pixel_facebook:""+pixel_facebook,
                  token_facebook:""+token_facebook,
                  CodigoCurso:codigo_curso_sel,
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