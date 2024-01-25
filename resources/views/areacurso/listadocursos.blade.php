@extends('areacurso.plantillas.plantilla-area-interna')
@section('contenido')   

</style>
<div class="row row-docttus">
    <div class="col-md-12">       
       <h1 style="font-weight: 600; font-size: 20px;">Listado de cursos</h1>
        
      <br>
      <div class="card-docttus card-docttus-left" style=" height: auto !important;">
        <div class="row row-docttus">

            <div class="col-md-2">
              <label>Código / Nombre</label>
              <input type="text" name="" class="form-control" id="PalabraClave">
            </div>

            <div class="col-md-2">
              <label>Fecha Inicio</label>
              <input type="date" name="" class="form-control" id="fecha_inicio">
            </div>
            <div class="col-md-2">
              <label>Fecha Fin</label>
              <input type="date" name="" class="form-control" id="fecha_fin">
            </div>

            <div class="col-md-2">
              <label>Categoría/Subcategoría</label>
              <select class="form-control" id="IdSubcategoria">
                  <option value="">Todas las categorías</option>
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

            <div class="col-md-2">
              <label>Estado Curso</label>
              <select class="form-control" id="EstadoCurso">
                <option value="" >Todos los estados</option>
                <option value="1" >Activa</option>
                <option value="2" >Inactivo</option>
                <option value="3" >Borrador</option>
                <option value="4" >En Revisión</option>
              </select>
            </div>
            <div class="col-md-2" style="padding-top: 33px;">
               <button class="btn botones-docttus" id="btn_buscar">Buscar</button>
            </div>
        </div>
        <div class="row row-docttus" style="margin-top: 15px;">
          <div class="col-md-12">
            <table class="table table-striped table-bordered">
              <thead class="thead-dark">
                 <tr>
                    <th>Código</th>
                    <th>Fecha</th>
                    <th>Nombre Curso</th>
                    <th>Tutor</th>
                    <th>Categoría</th>
                    <th>Precio</th>                    
                    
                    <th style="width: 50px;"><i class="fa fa-fire" aria-hidden="true"></i></th>
                    <th style="width: 50px;"><i class="fa fa-file-video-o" aria-hidden="true"></i></th>
                    <th style="width: 50px;"><i class="fa fa-edit" aria-hidden="true"></i></th>
                    <th style="width: 50px;"><i class="fa fa-bullhorn" aria-hidden="true"></i></th>
                    <th style="width: 50px;"><i class="fa fa-money" aria-hidden="true"></i></th>
                    <th style="width: 50px;"><i class="fa fa-star" aria-hidden="true"></i></th>
                    
                  </tr>
              </thead>

              <tbody id="listado_cursos">
                  
              </tbody>             
            </table>            
          </div>         
        </div>

      </div>
      
       
    </div>
</div>




<!-- Modal -->
<div class="modal fade" id="aprobar_solicitud" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Solicitud para <span id="titulo_modal"></span></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-6">
            <p><strong>Curso: </strong><span id="nombre_curso"> </span></p>            
            <p><strong>Tutor: </strong><span id="nombre_tutor"> </span></p>            
            <p><strong>Estado Curso: </strong><span id="estado_curso"> </span></p>            

          </div>

          <div class="col-md-6">
            <strong>Respuesta:</strong>
            <textarea class="form-control" id="RespuestaSolicitud" rows="5" placeholder="Repuesta"></textarea>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">CERRAR</button>
        <button type="button" class="btn btn-success" onclick="enviar_respuesta(1)">ACTIVAR</button>
        <button type="button" class="btn btn-danger" onclick="enviar_respuesta(3)">RECHAZAR</button>
      </div>
    </div>
  </div>
</div>





<!-- Modal -->
<div class="modal fade" id="ficha_curso_hotmart" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle1" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle1">Ficha Hotmart</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-md-12">
                <table class="table table-striped table-bordered">
                    
                    <thead>
                        <tr>
                            <th>Campo</th>
                            <th>Valor</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr>
                            <td>Curso:</td>
                            <td><span id="nombre_curso_hotmart"> </span></td>
                        </tr>

                        <tr>
                            <td>Tutor:</td>
                            <td><span id="nombre_tutor_hotmart"> </span></td>
                        </tr>

                        <tr>
                            <td>Email Tutor:</td>
                            <td><span id="email_tutor_hotmart"> </span></td>
                        </tr>

                        <tr>
                            <td>Co-Productor Nombre:</td>
                            <td><span id="nombre_co_tutor_hotmart"> </span></td>
                        </tr>

                        <tr>
                            <td>Co-Productor Email: </td>
                            <td><span id="email_co_tutor_hotmart"> </span></td>
                        </tr>

                        <tr>
                            <td>Descripción:</td>
                            <td><span id="descripcion_curso_hotmart"> </span></td>
                        </tr>

                        <tr>
                            <td>Categoría:</td>
                            <td><span id="categoria_curso_hotmart"> </span></td>
                        </tr>

                        <tr>
                            <td>Subcategoría: </td>
                            <td><span id="subcategoria_curso_hotmart"> </span></td>
                        </tr>

                        <tr>
                            <td>Precio:</td>
                            <td><span id="precio_curso_hotmart"> </span></td>
                        </tr>

                        <tr>
                            <td>Imágen:</td>
                            <td><span id="imagen_curso_hotmart"> </span></td>
                        </tr>

                    </tbody>
                    


                </table>              
              
              
            </div>  
            
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">CERRAR</button>          
        </div>
      </div>
    </div>
  </div>


@stop

@section('scripts')

    
<script type="text/javascript">

  $(function() {
     filtrar_listado_cursos();
  });

  $("#btn_buscar").click(function(){
     filtrar_listado_cursos();
  });

  var obj_data=new Object();
  function filtrar_listado_cursos(){
    var fecha_inicio=$("#fecha_inicio").val();
    var fecha_fin=$("#fecha_fin").val();
    var TipoUsuario=$("#TipoUsuario").val();
    var EstadoCurso=$("#EstadoCurso").val();  
    var IdSubcategoria =$("#IdSubcategoria").val();  
    var PalabraClave=$("#PalabraClave").val();

    
    var request = $.ajax({
        url: "{{url('')}}/listado_cursos",
        type: "POST",
        data:{                                        
             EstadoCurso:EstadoCurso,
             fechainicio:fecha_inicio,
             fechafin:fecha_fin,             
             IdSubcategoria:IdSubcategoria,
             PalabraClave:PalabraClave,
             _token: "{{ csrf_token() }}"
        }
      });

      request.done(function(obj) { 
         if(obj.status=="ok"){
            obj_data=obj.datos;
            var cadena_tabla="";
            var total_ganancias=0;



            for(var i=0;i<obj_data.length;i++){
                var enlace_aprobacion="";
                var enlace_destacado="";
                var enlace_visualizar_curso="";
                var enlace_ver_contenido="";
                var enlace_ficha_comercial="";

                var color_curso="";


                cadena_tabla+='<tr style="font-size:12px;">';
                cadena_tabla+='   <td>'+obj_data[i].CodigoCurso+'</td>';
                cadena_tabla+='   <td>'+obj_data[i].FechaCreacion+'</td>';
                cadena_tabla+='   <td>'+obj_data[i].NombreCurso+'</td>';
                cadena_tabla+='   <td>@'+obj_data[i].NombreUsuario+'</td>';
                cadena_tabla+='   <td>'+obj_data[i].NombreSubcategoria+'</td>';
                cadena_tabla+='   <td>'+obj_data[i].PrecioCurso+'</td>';                
                var enlace_curso="{{url('')}}/cursos/editar-basicos/"+obj_data[i].CodigoCurso;
                var enlace_ver_curso="{{url('')}}/curso/"+obj_data[i].SlugCurso;
                var enlace_curso_ficha_comercial="{{url('')}}/c/"+obj_data[i].SlugCurso;




                enlace_ver_contenido+='<a target="_blank" href="'+enlace_ver_curso+'"><i class="fa fa-file-video-o" aria-hidden="true"></i></a>';
                enlace_visualizar_curso+='<a target="_blank" href="'+enlace_curso+'"><i class="fa fa-edit" aria-hidden="true"></i></a>';
                enlace_ficha_comercial+='<a target="_blank" href="'+enlace_curso_ficha_comercial+'"><i class="fa fa-bullhorn" aria-hidden="true"></i></a>';


                if(obj_data[i].IdEstado=="1"){                   
                    color_curso="background-color:green;";
                }

                if(obj_data[i].IdEstado=="2"){                    
                    color_curso="background-color:red;";
                }

                if(obj_data[i].IdEstado=="3"){                
                    color_curso="background-color:#ccc;";
                }

                if(obj_data[i].IdEstado=="4"){                    
                    color_curso="background-color:orange;";
                }

                

                enlace_aprobacion='<a onclick="abrir_popup_respuesta('+obj_data[i].IdCurso+')"  href="#" style="color:#fff;"><i class="fa fa-money" aria-hidden="true"></i></a>';

                if(obj_data[i].IdDestacado=="1"){
                  enlace_destacado='<a onclick="curso_destacado(0,'+obj_data[i].IdCurso+')"  href="#" style="color:#FF9800;"><i class="fa fa-star" aria-hidden="true"></i></a>';
                }else{
                  enlace_destacado='<a onclick="curso_destacado(1,'+obj_data[i].IdCurso+')"  href="#" style="color:#222;"><i class="fa fa-star-o" aria-hidden="true"></i></a>';
                }
                  

                
                cadena_tabla+='   <td style="text-align:center; font-size: 19px; padding-top: 7px; padding-bottom: 2px;"><a title="Abri Ficha Hotmart" href="#" class="btn_abrir_hotmart" id-curso="'+obj_data[i].IdCurso+'" ><i class="fa fa-fire" aria-hidden="true"></i></a></td>';
                cadena_tabla+='   <td style="text-align:center; font-size: 19px; padding-top: 7px; padding-bottom: 2px;">'+enlace_ver_contenido+'</td>';
                cadena_tabla+='   <td style="text-align:center; font-size: 19px; padding-top: 7px; padding-bottom: 2px;">'+enlace_visualizar_curso+'</td>';
                cadena_tabla+='   <td style="text-align:center; font-size: 19px; padding-top: 7px; padding-bottom: 2px;">'+enlace_ficha_comercial+'</td>';
                cadena_tabla+='   <td style="text-align:center;  font-size: 19px; padding-top: 7px; padding-bottom: 2px;'+color_curso+'">'+enlace_aprobacion+'</td>';
                cadena_tabla+='   <td style="text-align:center;  font-size: 19px; padding-top: 7px; padding-bottom: 2px;">'+enlace_destacado+'</td>';
                cadena_tabla+='</tr>';
                
            }            
            $("#listado_cursos").html(""+cadena_tabla);

            $(".btn_abrir_hotmart").click(function(e){
                e.preventDefault();
                console.log($(this).attr("id-curso"));
                get_info_curso_hotmart($(this).attr("id-curso"));
            });


         }else{
            mensaje_generico("Error !",""+obj.mensaje,"2","Continuar...",function(){});
            return;
         }
      });
       

       //respuesta si falla
        request.fail(function(jqXHR, textStatus) {
            alert( "Error de servidor  " + textStatus );
        });
    
  }


  var id_curso="";
  
  function abrir_popup_respuesta(idcurso){
      id_curso=idcurso;      
      var data_curso=buscar_solicitud(id_curso);
      $("#titulo_modal").html(""+data_curso.NombreCurso);
      $("#nombre_curso").html(""+data_curso.NombreCurso);
      $("#nombre_tutor").html(""+data_curso.NombreUsuario);
      $("#estado_curso").html(""+data_curso.NombreEstado);
      
      var texto_solicitud="";
      var texto_respuesta="";      
      $("#aprobar_solicitud").modal("show");

  }


  function buscar_solicitud(idcurso){
    var obj_dat=new Object();
    for(var i=0;i<obj_data.length;i++){
      if(obj_data[i].IdCurso==idcurso){
        obj_dat=obj_data[i];
        break;
      }
    } 
    return obj_dat;
  }



  function enviar_respuesta(id_estado){
    
    var respuesta=$("#RespuestaSolicitud").val();

    var request = $.ajax({
        url: "{{url('')}}/estado_solicitud_cursos",
        type: "POST",
        data:{                                        
             IdCurso:id_curso,             
             id_estado:id_estado,
             respuesta:respuesta,
             _token: "{{ csrf_token() }}"
        }
      });    
      request.done(function(obj) { 
         if(obj.status=="ok"){
            $("#aprobar_solicitud").modal("hide");
              mensaje_generico("Correcto","Proceso generado correctamente","1","Continuar...",function(){
                  filtrar_listado_cursos();
              });
         }else{
            mensaje_generico("Error !",""+obj.mensaje,"2","Continuar...",function(){});
            return;
         }
      });
       

       //respuesta si falla
      request.fail(function(jqXHR, textStatus) {
        alert( "Error de servidor  " + textStatus );
      });
    
  }

  function curso_destacado(id_destacado,idcurso){
    var request = $.ajax({
    url: "{{url('')}}/cambiar_destacado",
        type: "POST",
        data:{                                        
             IdCurso:idcurso,             
             IdDestacado:id_destacado,             
             _token: "{{ csrf_token() }}"
        }
      });    
      request.done(function(obj) { 
         if(obj.status=="ok"){
            filtrar_listado_cursos();              
         }else{
            mensaje_generico("Error !",""+obj.mensaje,"2","Continuar...",function(){});
            return;
         }
      });
       

       //respuesta si falla
      request.fail(function(jqXHR, textStatus) {
        alert( "Error de servidor  " + textStatus );
      });
  }

  function get_info_curso_hotmart(id_curso){
        var request = $.ajax({
        url: "{{url('')}}/get_cursos_hotmart",
            type: "POST",
            data:{                                        
                IdCurso:id_curso,
                _token: "{{ csrf_token() }}"
            }
        });    
        request.done(function(obj) { 
            if(obj.status=="ok"){
                console.log(obj);
                var datos_cursos=obj.data;
                $("#ficha_curso_hotmart").modal("show");
                $("#nombre_curso_hotmart").html(datos_cursos.NombreCurso);
                $("#nombre_tutor_hotmart").html(datos_cursos.tutor[0].NombrePersona+" "+datos_cursos.tutor[0].ApellidosPersona);
                $("#email_tutor_hotmart").html(datos_cursos.tutor[0].EmailPersona);
                $("#nombre_co_tutor_hotmart").html(datos_cursos.tutor[0].coproductor[0].NombrePersona+" "+datos_cursos.tutor[0].coproductor[0].ApellidosPersona);
                $("#email_co_tutor_hotmart").html(datos_cursos.tutor[0].coproductor[0].EmailPersona);
                $("#descripcion_curso_hotmart").html(datos_cursos.DescripcionCurso);
                $("#categoria_curso_hotmart").html(datos_cursos.NombreCategoria);
                $("#subcategoria_curso_hotmart").html(datos_cursos.NombreSubcategoria);
                $("#precio_curso_hotmart").html(datos_cursos.PrecioCurso);
                $("#imagen_curso_hotmart").html(`<a download href="{{url('')}}/assets/images/cursos/${datos_cursos.ImagenCurso}"><img src="{{url('')}}/assets/images/cursos/${datos_cursos.ImagenCurso}" ></a>`);
                
            }else{
                mensaje_generico("Error !",""+obj.mensaje,"2","Continuar...",function(){});
                return;
            }
        });
       //respuesta si falla
        request.fail(function(jqXHR, textStatus) {
            alert( "Error de servidor  " + textStatus );
        });
  }

  /*
  
  <div class="modal fade" id="ficha_curso_hotmart" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle1" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle1">Ficha Hotmart</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-md-12">
              <p><strong>Curso: </strong><span id="nombre_curso_hotmart"> </span></p>            
              <p><strong>Tutor: </strong><span id="nombre_tutor_hotmart"> </span></p>
              <p><strong>Email: </strong><span id="email_tutor_hotmart"> </span></p>
              <p><strong>Co-Productor Nombre: </strong><span id="nombre_co_tutor_hotmart"> </span></p>
              <p><strong>Co-Productor Email: </strong><span id="email_co_tutor_hotmart"> </span></p>
              <p><strong>Descripción: </strong><span id="descripcion_curso_hotmart"> </span></p>
              <p><strong>Categoría: </strong><span id="categoria_curso_hotmart"> </span></p>
              <p><strong>Subcategoría: </strong><span id="subcategoria_curso_hotmart"> </span></p>
              <p><strong>Precio: </strong><span id="precio_curso_hotmart"> </span></p>
              <p><strong>Imágen: </strong><span id="imagen_curso_hotmart"> </span></p>


  */
  

</script>
@stop