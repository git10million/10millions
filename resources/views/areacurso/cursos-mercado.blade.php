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
       <h1 style="font-weight: 600; font-size: 20px;">Mercado</h1>
       <br />       
       @if(session('rol_solicitud')=="afiliado")
       <p>En este espacio encontrarás los cursos que podrás adquirir o comercializar y ganar hasta un 70%</p>
       @endif
    </div>
</div>
        
<hr />

<div class="row row-docttus" style="margin-bottom: 25px;">
   <!--  tarjeta Curso --> 

  <div class="col-md-12">
    <div class="row" style="margin-bottom:25px;">
      
      <div class="col-md-3">
        <small>Palabra Clave</small>
         <input placeholder="Filtrar por Nombre" class="form-control"  id="txttitulocurso">
      </div>

      <div class="col-md-3">
        <small>Categoría</small>
        <select class="form-control" id="txtsubcategoria">
            <option value="">Todos</option>
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
      </div>

      @if(session('rol_solicitud')=="afiliado")
      
      <div class="col-md-2">
        <small>Activación Automática</small>
        <select class="form-control" id="txtactivacion">
          <option value="">Todos</option>
          <option value="1">SI</option>
          <option value="0">NO</option>
        </select>
      </div>


      
      <div class="col-md-2">
        <small>Mi Estado Solicitud</small>
        <select class="form-control" id="txtestadosolicitud">
          
          <option value="">Todos</option>
          <option value="1">Aprobados</option>
          <option value="2">Pendientes</option>
          <option value="3">Rechazados</option>
        </select>
      </div>

      @endif

      

      <div class="col-md-2">
          <button class="btn btn-success" style="margin-top: 23px;" onclick="filtro_mercado();">Filtrar</button>
      </div>


    </div>
  </div>

  <div class="col-md-12">
    <div class="row" style="margin-bottom:25px;" id="listado_cursos">
       
    </div>
        <!--  tarjeta Curso --> 
</div>


@if(session('rol_solicitud')=="afiliado")
<div class="modal fade" id="enlace-afiliado" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel2" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel2">Venta Curso | <span id="nombre_curso"></span></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                
                <div>
                    <a href="#" id="btn_solicitar_afiliacion" target="_blank" class="btn btn-success">Solicitar Afiliación Hotmart</a>
                </div>
                
                <small>Debes estar logeado en hotmart para habilitar el enlace de manera correcta</small>

                <hr />

                <label>Pixel de Facebook</label>
                <input type="text" name="" class="form-control" value="" id="pixel_facebook">
                <br />
                <label>Token de Facebook</label>
                <input type="text" name="" class="form-control" value="" id="token_facebook">
                <br />
                <label>URL Checkout Hotmart - Afiliado</label>
                <input type="text" name="" class="form-control" value="" id="url_checkout_hotmart">
                <hr />

                <label>Enlace ficha de ventas - Afiliado</label>
                <div style="width: 100%; padding:5px; background-color: #dcdcdc; border-radius: 9px;">
                    <span>{{url('')}}/c/<span id="codigo_curso_enlace"></span>/{{$data[0]->NombreUsuario}}</span></span> 
                </div>
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" style="border-radius: 25px;" id="btn_guardar_venta_curso">Guardar</button>
                <button type="button" class="btn btn-secondary botones-docttus" data-dismiss="modal">Cerrar</button>                
            </div>
      </div>
  </div>
</div>

@endif



@stop

@section('scripts')

    
    <script type="text/javascript">

      $(function(){
        filtro_mercado();
      });


      $("#btn_generar_enlace").click(function(){
          var seguimiento_enlace=""+$("#seguimiento_enlace").val();
          $("#id_seguimiento").html(""+seguimiento_enlace);

      });

      var codigo_curso_sel="";
      function abrir_pop_enlace(codigo_curso,nombre_curso,pixel_facebook,token_facebook,URL_hotmart_checkout,URLHotmartSolicitudAfiliados){

          $("#url_checkout_hotmart").val(""+URL_hotmart_checkout);
          $("#pixel_facebook").val(""+pixel_facebook);
          $("#token_facebook").val(""+token_facebook);
          

          codigo_curso_sel=codigo_curso;
          $("#nombre_curso").html(""+nombre_curso);
          $("#codigo_curso_enlace").html(""+codigo_curso);
          $("#codigo_curso_enlace_checkout").html(""+codigo_curso);
          $("#btn_solicitar_afiliacion").attr("href",""+URLHotmartSolicitudAfiliados);
          $("#enlace-afiliado").modal("show");
      }


      function verificacion_afiliacion(){
        var request = $.ajax({
              url: "{{url('')}}/verificar_solicitud_producto",
              type: "POST",
              data:{                                
                  codigo_curso:codigo_prod_selecc,                  
                  _token: "{{ csrf_token() }}"
              }
            });

            request.done(function(obj) { 
              if(obj.status=="ok"){       
                $("#enlace-afiliado").modal("show");
                $("#coleccion_enlaces_curso").hide();
                $("#coleccion_enlaces_curso_pendiente").hide();
                $("#TextoSolicitudAfiliacion").hide();
                $(".sin-solicitud").hide();
                $("#btn_enviar_solicitud").hide();
                if(obj.EstadoSolicitudAfiliacion=="1"){
                  $("#coleccion_enlaces_curso").show();                  
                  $("#enlace_afiliado_producto").html('<a href="'+obj.enlace+'" target="_blank">'+obj.enlace+'</a>');
                  $("#enlace_checkout_producto").html('<a href="'+obj.enlace_checkout+'" target="_blank">'+obj.enlace_checkout+'</a>');                  
                  $("#URLMaterialPromocional").html('<a href="'+obj.URLMaterialPromocional+'" target="_blank">'+obj.URLMaterialPromocional+'</a>');                  
                  
                }else if(obj.EstadoSolicitudAfiliacion=="2"){
                  $("#coleccion_enlaces_curso_pendiente").show();
                  $("#coleccion_enlaces_curso_pendiente").html("Tu solicitud se encuentra pendiente!!.");
                  $("#coleccion_enlaces_curso_pendiente").removeClass("alert-danger");
                  $("#coleccion_enlaces_curso_pendiente").addClass("alert-warning");
                  
                }else if(obj.EstadoSolicitudAfiliacion=="3"){
                  $("#coleccion_enlaces_curso_pendiente").show();
                  $("#coleccion_enlaces_curso_pendiente").html("Tu solicitud se encuentra rechazada!!.");                  
                  $("#coleccion_enlaces_curso_pendiente").removeClass("alert-warning");
                  $("#coleccion_enlaces_curso_pendiente").addClass("alert-danger");
                  
                }else{
                  $("#TextoSolicitudAfiliacion").show();
                  $(".sin-solicitud").show();
                }
                
              }
            });


            request.fail(function(jqXHR, textStatus) {
              alert( "Error de servidor  " + textStatus );
            }); 
      }


      function filtro_mercado(){

        var titulo_curso=$("#txttitulocurso").val();
        var subcategoria_curso=$("#txtsubcategoria").val();
        @if(session('rol_solicitud')=="afiliado")
        var activacion_automatica=$("#txtactivacion").val();
        var estado_solicitud_filtro=$("#txtestadosolicitud").val();
        @else
        var activacion_automatica="";
        var estado_solicitud_filtro="";
        @endif


        
        var cadena_act='';

        var request = $.ajax({
            url: "{{url('')}}/get_cursos_by_filter",
            type: "POST",
            data:{                                
                  titulo_curso:""+titulo_curso,
                  subcategoria_curso:""+subcategoria_curso,
                  activacion_automatica:""+activacion_automatica,
                  estado_solicitud:""+estado_solicitud_filtro,
                  deseos:"",
                 _token: "{{ csrf_token() }}"
            }
          });

          request.done(function(obj) { 
             if(obj.status=="ok"){          


                var arra_data=obj.data;

                for(var i=0;i<arra_data.length;i++){

                    var estado_solicitud="";
                    

                    var boton_deseo="";

                    @if(session('rol_solicitud')=="estudiante")
                    if(arra_data[i].estado_deseo=="1"){
                        boton_deseo=`
                          <button title="Agregar a deseados" class="btn btn-default" onclick="enviar_deseados('`+arra_data[i].IdCurso+`')" style=" position: absolute; margin-top: 7px; right: 13px; padding: 1px; height: 25px; width: 24px; border-radius:25px;">
                              <i class="fa fa-heart" aria-hidden="true" style="color:red;"></i>
                          </button>
                        `;
                    }else{
                        boton_deseo=`

                          <button title="Agregar a deseados" class="btn btn-default" onclick="enviar_deseados('`+arra_data[i].IdCurso+`')" style=" position: absolute; margin-top: 7px; right: 13px; padding: 1px; height: 25px; width: 24px; border-radius:25px;">
                              <i class="fa fa-heart-o" aria-hidden="true" ></i>
                          </button>

                          
                        `;
                    }
                    @endif

                    @if(session('rol_solicitud')=="afiliado")
                    var SolicitudAfiliado=arra_data[i].SolicitudAfiliado;
                    var arra_solicitud=SolicitudAfiliado.split("||");
                    var PixelFacebook=""+arra_solicitud[0];
                    var URLHotmartCheckout=""+arra_solicitud[1];
                    var TokenFacebook=""+arra_solicitud[2];
                    
                    @endif

                    cadena_act+=`<div class="col-md-3" style="position: relative; margin-bottom:25px;">
                                  <div class="card-docttus card-docttus-left card-curso" style=" height: auto !important;">
                                      <div class="row">
                                        <div class="col-10">
                                          <h5 style="font-weight: bold;  height: 72px;">`+arra_data[i].NombreCurso+`</h5>
                                        </div>
                                        <div class="col-2">
                                          
                                          ${boton_deseo}

                                          @if(session('rol_solicitud')=="afiliado")
                                            <button title="Configurar Enlaces Hotmart" class="btn botones-docttus" onclick="abrir_pop_enlace('`+arra_data[i].CodigoCurso+`','`+arra_data[i].NombreCurso+`','${PixelFacebook}','${TokenFacebook}','${URLHotmartCheckout}','${arra_data[i].URLHotmartSolicitudAfiliados}')" style=" position: absolute; margin-top: 7px; right: 13px; padding: 1px; height: 25px; width: 24px;">$</button>
                                          @endif
                                          
                                        </div>
                                      </div>
                                      <div class="row">
                                        <div class="col-md-12">

                                          

                                          @if(session('rol_solicitud')=="afiliado")                                                
                                              <img src="{{url('')}}/assets/images/cursos/`+arra_data[i].ImagenCurso+`" style="width: 100%; cursor: pointer;"  onclick="abrir_pop_enlace('`+arra_data[i].CodigoCurso+`','`+arra_data[i].NombreCurso+`','${PixelFacebook}','${TokenFacebook}','${URLHotmartCheckout}')">
                                          @else
                                          <a href="{{url('')}}/c/`+arra_data[i].SlugCurso+`">
                                            <img src="{{url('')}}/assets/images/cursos/`+arra_data[i].ImagenCurso+`" style="width: 100%; cursor: pointer;">
                                          </a>
                                          @endif    
                                                            
                                          

                                          <div class="row fila-info">              
                                            
                                            <div class="col-6" style="text-align: left;">
                                              
                                                <a class="btn btn-warning btn-sm" target="_blank" style="border-radius: 25px;" href="{{url('')}}/c/`+arra_data[i].SlugCurso+`">Ver Oferta</a>

                                            </div>
                                            <div class="col-6" style="text-align: right;">                                
                                              <small>Precio:</small>
                                              <h5>$ `+arra_data[i].PrecioCurso+` USD</h5>
                                            </div>
                                            
                                          </div>            
                                        </div>
                                      </div>
                                  </div>
                                </div>`;

                }

                $("#listado_cursos").html(cadena_act);




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

      $("#btn_enviar_solicitud").click(function(){
        btn_enviar_solicitud();
      });
      function btn_enviar_solicitud(){

          var TextoSolicitudAfiliacion=$("#TextoSolicitudAfiliacion").val();

          var request = $.ajax({
              url: "{{url('')}}/enviar_solicitud_producto",
              type: "POST",
              data:{                                
                  codigo_curso:codigo_prod_selecc,
                  TextoSolicitudAfiliacion:TextoSolicitudAfiliacion,
                  _token: "{{ csrf_token() }}"
              }
            });

            request.done(function(obj) { 
              if(obj.status=="ok"){       
                mensaje_generico("Solicitud Enviada!",""+obj.mensaje,"1","Continuar...",function(){
                  $("#TextoSolicitudAfiliacion").val("");
                  $("#enlace-afiliado").modal("hide");
                  filtro_mercado();
                });
              }
            });


            request.fail(function(jqXHR, textStatus) {
              alert( "Error de servidor  " + textStatus );
            }); 

      }

      function enviar_deseados(id_curso_sel){			
        var IdCurso=""+id_curso_sel;
        var formData = new FormData();
        formData.append('IdCurso', IdCurso);			  
	      formData.append('_token', "{{ csrf_token() }}");

	      	var request = $.ajax({
		      url: "{{url('')}}/registrar_deseo",
		      type: "POST",
		      data: formData,
          	  processData: false,  // tell jQuery not to process the data
          	  contentType: false  // tell jQuery not to set contentType         
		    });

		    request.done(function(obj) { 		       
				if(obj.status=="ok"){
					var desc_toast="";
					if(obj.estado_deseo=="1"){						
						 desc_toast="Este curso se ha agregado a tu lista de deseos.";
					}else{						
						desc_toast="Este curso se ha eliminado a tu lista de deseos.";
					}

          filtro_mercado();
					
					mensaje_toast("success",desc_toast, "Lista de Deseos");
					return;
				}
		    });
		     //respuesta si falla
		    request.fail(function(jqXHR, textStatus) {
		      console.log( "Error de servidor  " + textStatus );
		    });
		
    }


    $("#btn_guardar_venta_curso").click(function(e){
        e.preventDefault();
        guardar_info_ventas();
    });


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