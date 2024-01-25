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

  
    <div class="row my-xl-5 my-3">
        <div class="col-md-12">
            <h4>Evaluación del Curso</h4>
                <small><i><strong>Curso:</strong> {{$curso->NombreCurso}}</i></small>
            <hr>
        </div>
    </div>



    <div class="row">
        <div class="col-md-4">
            <h6 style="font-weight: bold;" class="my-4">Información Descriptiva</h6>
            <p>Diligencia la información principal que hace parte de la Evaluación,  determina la cantidad mínima de preguntas para lograr la aprobación y la duración total de la prueba.</p>
        </div>
  
        <div class="col-md-8">
            <div class="card-docttus card-docttus-left" style=" height: auto !important; position: relative;">          
                <div class="form-group  input-group-sm">                        
                    <label>Título Evaluación *</label> <i class="fa fa-info-circle btn-titulo" title="Diligencia el nombre que tendrá la evaluación."></i>
                    <input id="NombreEvaluacion" type="text" name="nombre" class="form-control valida-caracteres"  value="{{$evaluaciones[0]->NombreEvaluacion}}" required maxlength="70">
                    <div class="text-right">
                        <small> <strong id="cant_caracteres_NombreEvaluacion">0</strong> Carácteres Restantes</small>  
                    </div>              
                </div>
              
  
                <div class="form-group  input-group-sm">
                    <label>Descripción *</label> <i class="fa fa-info-circle btn-titulo" title="Incluye una descripción de la evaluación. Aquí podrás dejar las oritanciones, guías, observaciones que consideres que tus estudiantes requieren saber para el desarrollo de la evaluación."></i>
                    <textarea class="form-control valida-caracteres" id="DescripcionEvaluacion" maxlength="400" required>{{$evaluaciones[0]->DescripcionEvaluacion}}</textarea>
                    <div class="text-right">
                        <small> <strong id="cant_caracteres_DescripcionEvaluacion">0</strong> Carácteres Restantes</small>  
                    </div>
                </div>  

                <div class="form-group  input-group-sm">
                    <label>Cantidad Preguntas Mínimas para Aprobación *</label> <i class="fa fa-info-circle btn-titulo" title="Incluye el número mínimo de preguntas que cada estudiante debe contestar acertar para aprobar la evaluación."></i>
                    <input id="PorcentajeMinimo" type="number" name="nombre" class="form-control" min="1"  max="1000"  step="1" required value="{{$evaluaciones[0]->PorcentajeMinimo}}" >
                </div>

                <div class="form-group  input-group-sm">
                    <label>Duración del Examen en Minutos *</label> <i class="fa fa-info-circle btn-titulo" title="Registra el tiempo total en minutos, que durará la prueba."></i>
                    <input id="MinutosEvaluacion" type="number" name="nombre" class="form-control" min="1"  max="1000"  step="1" required value="{{$evaluaciones[0]->MinutosEvaluacion}}" >
                </div>
            </div>
            <br />
            <p style="color: #adadad;">* Campos obligatorios</p>          
        </div>
    </div>
  
  
    <hr />

             
    <div class="row">
        <div class="col-md-4">
            <h6 style="font-weight: bold;" class="my-4">Contenido de la evaluación</h6>
            <p>En esta sesión podrás crear cada una de las preguntas que hacen parte de la prueba, incluyendo sus respectivas opciones de respuesta. No olvides especificar o seleccionar, la respuesta correcta a cada interrogante.</p>
        </div>

        <div class="col-md-8">

            <div style="width: 100%;" class="text-right">
                @if($curso->IdEstado=="3" || session('rol_solicitud')=="root")
                <a href="#" class="btn btn-default" id="btn_add_pregunta">
                    + Pregunta
                </a>
                @endif
            </div>        
            <br />           
            <ul  class="list-group" id="listado_ul">
            
            </ul>


        </div>

    </div>

    


</div>
<br />
<br />
<br />
<br />
<br />
<br />
<br />

</form>

<div class="modal fade" id="modal_eliminar_item" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">¿Estás seguro de eliminar este item?</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="form-elimina-cuenta">
        <div class="modal-body">                 
          <ul>
            <li>La información de este Item se perderá permanetemente.</li>            
          </ul>          
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
          <button type="button" class="btn btn-danger" id="btn_eliminar_item">Eliminar Item</button>
        </div>
      </form>
    </div>
  </div>
</div>




<div class="modal fade" id="modal_guardar_pregunta" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Nueva Pregunta</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="form-agregar-pregunta">
                <div class="modal-body"> 
                                      
      
                    <div class="form-group  input-group-sm">
                        <label>Pregunta *</label> <i class="fa fa-info-circle btn-titulo" title="Lorem ipsum dolor sit amet consectetur adipisicing elit. Obcaecati inventore, commodi quis asperiores mollitia quam numquam similique temporibus et totam est vero quidem tenetur doloremque delectus dolores, iure harum maxime."></i>
                        <textarea class="form-control valida-caracteres" rows="5" id="NombrePregunta" maxlength="500" required></textarea>
                        <div class="text-right">
                            <small> <strong id="cant_caracteres_NombrePregunta">0</strong> Carácteres Restantes</small>  
                        </div>
                    </div>  


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-success" id="btn_guardar_pregunta">Guardar Pregunta</button>
                </div>
            </form>
        </div>
    </div>
</div>




<div class="modal fade" id="modal_guardar_respuesta" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Respuesta</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="form-agregar-respuesta">
                <div class="modal-body"> 
                                      
      
                    <div class="form-group  input-group-sm">
                        <label>Respuesta *</label> <i class="fa fa-info-circle btn-titulo" title="Lorem ipsum dolor sit amet consectetur adipisicing elit. Obcaecati inventore, commodi quis asperiores mollitia quam numquam similique temporibus et totam est vero quidem tenetur doloremque delectus dolores, iure harum maxime."></i>
                        <textarea class="form-control valida-caracteres" rows="5" id="NombreRespuesta" maxlength="500" required></textarea>
                        <div class="text-right">
                            <small> <strong id="cant_caracteres_NombreRespuesta">0</strong> Carácteres Restantes</small>  
                        </div>
                    </div>  


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-success" id="btn_guardar_respuesta">Guardar Respuesta</button>
                </div>
            </form>
        </div>
    </div>
</div>







@stop

@section('scripts')

  <script src="{{url('')}}/assets/tinymce/js/tinymce/tinymce.min.js"></script>
  <script src="{{url('')}}/assets/tinymce/js/tinymce/jquery.tinymce.min.js"></script>
  <script src="{{url('')}}/assets/js/sortable.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/jquery-sortablejs@latest/jquery-sortable.js"></script>

  @php 
    if(!$curso->AprobacionAutomatica){
      $curso->AprobacionAutomatica="0";
    }
  @endphp
  
    <script type="text/javascript">      

    
    $(function(){
        get_preguntas();
    });


    $("#form-editar-curso").submit(function(e){
        e.preventDefault();

        var NombreEvaluacion=""+$("#NombreEvaluacion").val();
        var DescripcionEvaluacion=""+$("#DescripcionEvaluacion").val();
        var PorcentajeMinimo=""+$("#PorcentajeMinimo").val();
        var MinutosEvaluacion=""+$("#MinutosEvaluacion").val();

        var formData = new FormData();        
            
        
        formData.append('NombreEvaluacion', NombreEvaluacion);
        formData.append('DescripcionEvaluacion', DescripcionEvaluacion);
        formData.append('PorcentajeMinimo', PorcentajeMinimo);
        formData.append('MinutosEvaluacion', MinutosEvaluacion);
    
        guardar_informacion(formData,"editarevaluacioncurso");

    });

    function get_preguntas(){
        var formData = new FormData();
        formData.append('IdEvaluacion', "{{$evaluaciones[0]->IdEvaluacion}}");
        guardar_informacion(formData,"getpreguntasevaluacioncurso","SI");
    }


    var data_preguntas=new Object();

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
                if(especial!="SI"){


                    $("#responder_comentarios").modal("hide");

                    mensaje_generico("Correcto",""+obj.mensaje,"1","Continuar...",function(){
                        if(funcionlv=="editarpreguntasevaluacioncurso" || funcionlv=='cambiarestadoevaluacion'){
                            
                            $("#modal_guardar_pregunta").modal("hide");
                            $("#modal_eliminar_item").modal("hide");
                            limpiar_pregunta();
                            get_preguntas();
                            
                        }else{
                            location.reload();
                        }
                        
                    });


                }else{

                    if(funcionlv=="getpreguntasevaluacioncurso"){
                        
                        data_preguntas=obj.datos;
                        var cadena_preguntas="";
                        for(var i=0;i<data_preguntas.length;i++){

                            var icono_advertencia='';
                            var obj_resp=data_preguntas[i].respuestas;
                            var band_advert=false;
                            var advertencias="";
                            var cant_resp=obj_resp.length;
                            if(cant_resp==0){
                                band_advert=true;                                
                                advertencias="<li>No tiene respuestas asignadas</li>";
                            }

                            if(cant_resp==1){
                                band_advert=true;                                
                                advertencias="<li>Le falta 1 respuesta</li>";
                            }

                            var aplica_verdadero_warning=true;                            
                            if(cant_resp>0){
                                for(var k=0;k<cant_resp;k++){
                                    if(obj_resp[k].EsVerdadero=="1"){
                                        aplica_verdadero_warning=false;
                                    }
                                }
                            }

                            if(aplica_verdadero_warning){
                                band_advert=true;
                                advertencias+="<li>Le falta asignar la respuesta verdadera</li>";
                            }

                            if(band_advert){
                                icono_advertencia=`                                    
                                    <i  class="fa fa-exclamation-triangle btn-advertencia" style="color:red;" aria-hidden="true"  title="<ul>${advertencias}</ul> "></i> 
                                `;
                            }

                            
                            
                            cadena_preguntas+=`
                            
                                    <li class="list-group-item card-docttus card-docttus-left" id-tem="${data_preguntas[i].IdPregunta}" id="pregunta_${data_preguntas[i].IdPregunta}" style=" height: auto !important; position: relative; margin-bottom:10px; border-radius:5px;">
                                        <table style="width: 100%;">
                                            <tr>
                                                
                                                <td>
                                                    <span style="font-size: 15px; color: #7b7b7b;">${data_preguntas[i].NombrePregunta}</span>
                                                    <br/>
                                                    <small>${cant_resp} Respuestas</small>
                                                </td>

                                                <td class="td_estado">
                                                    <small style="font-size: 10px; height:14px;">                                                              
                                                    </small>
                                                </td>


                                                <td style="width:20px;">
                                                    ${icono_advertencia}   
                                                </td>
                                                @if($curso->IdEstado=="3" || session('rol_solicitud')=="root")
                                                <td style="width: 38px; text-align:left;">
                                                    <div class="btn-group dropleft">
                                                        <button type="button" class="btn btn-default dropdown-toggle btn-menu-leccion" data-toggle="dropdown" aria-haspopup="true" style="width: 25px; height:25px; border-radius: 15px;     padding-top: 1px; ">
                                                        <i class="fa fa-ellipsis-v" aria-hidden="true" style="font-size: 15px; margin-top: 2px;"></i>
                                                        </button>
                                                        
                                                        <div class="dropdown-menu">
                                                            <button class="dropdown-item" type="button" onclick="editar_pregunta(${data_preguntas[i].IdPregunta})" ><i class="fa fa-pencil-square-o" aria-hidden="true"></i>  Editar</button>
                                                            <button class="dropdown-item" type="button" onclick="eliminar_componente(${data_preguntas[i].IdPregunta},1,2,'','')" ><i class="fa fa fa-trash-o" aria-hidden="true"></i>  Eliminar</button>
                                                        </div>
                                                    </div>
                                                </td>
                                                @endif

                                                <td style="width: 12px;">                                                    
                                                    <a  data-toggle="collapse"  data-target="#lista_respuestas_${data_preguntas[i].IdPregunta}">
                                                        <i class="fa fa-angle-down" aria-hidden="true" style="font-size: 20px;"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        </table>

                                    
                                        <div class="collapse"  data-parent="#listado_ul" id="lista_respuestas_${data_preguntas[i].IdPregunta}">
                                            
                                            ${get_respuesta_elemento(data_preguntas[i].IdPregunta,data_preguntas[i].respuestas)}
                                        
                                            <hr>
                                            @if($curso->IdEstado=="3" || session('rol_solicitud')=="root")
                                            <a class="btn btn-default btn-xl btn_respuesta" href="#" id-pregunta="${data_preguntas[i].IdPregunta}">
                                                + Respuesta
                                            </a>
                                            @endif

                                        </div>

                                    </li>

                            `;

                        }

                        $("#listado_ul").html(cadena_preguntas);

                        tippy('.btn-advertencia', {
                                allowHTML: true,
                                theme: 'light',
                                animation: 'scale',
                                content(reference) {
                                const title = reference.getAttribute('title');
                                reference.removeAttribute('title');
                                return title;
                                },
                        });                        


                        $(".btn_respuesta").click(function(e){
                            e.preventDefault();
                            
                            var id_preg=e.currentTarget.getAttribute("id-pregunta");
                            abrir_respuesta(id_preg);
                        });

                        $(".btn_editar_respuesta").click(function(e){
                            e.preventDefault();
                            
                            var id_preg=e.currentTarget.getAttribute("id-pregunta");
                            var id_respuesta=e.currentTarget.getAttribute("id-respuesta");

                            abrir_respuesta(id_preg,id_respuesta);

                        });

                    }

                }        

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


    function get_respuesta_elemento(id_pregunta,arra_respuestas){
        var cadena_respuesta=``;

        if(arra_respuestas){
            cadena_respuesta=`<ul  class="list-group lista-lecciones" id="listado_ul_respuestas_1" style="margin-top: 25px;">`;

            for(var i=0;i<arra_respuestas.length;i++){
                var aplica_verdadero="";

                if(arra_respuestas[i].EsVerdadero=="1"){
                    aplica_verdadero="checked";
                }

                cadena_respuesta+=`
                    <li class=" list-group-item  card-docttus card-docttus-left" id="li_respuestas_${arra_respuestas[i].IdRespuesta}" id-pregunta="${id_pregunta}" id-tem="${arra_respuestas[i].IdRespuesta}" style="margin-bottom:5px; height:58px; border-radius:5px;">

                        <table style="width: 100%;">
                            <tr>
                                <td style="width: 24px;">
                                    <input type="radio" ${aplica_verdadero} name="verdadera_pregunta_${id_pregunta}" onclick="cambiar_estado_item(${arra_respuestas[i].IdRespuesta},3,1,${id_pregunta},1)" >
                                </td>

                                <td>
                                    <span style="font-size: 15px; color: #7b7b7b;">${arra_respuestas[i].NombreRespuesta}</span>
                                </td>
                                @if($curso->IdEstado=="3" || session('rol_solicitud')=="root")
                                <td style="width: 30px; text-align:left;">                                            
                                    <div class="btn-group dropleft">
                                        <button type="button" class="btn btn-default dropdown-toggle btn-menu-leccion" data-toggle="dropdown" aria-haspopup="true" style="width: 25px; height:25px; border-radius: 15px;     padding-top: 1px; ">
                                            <i class="fa fa-ellipsis-v" aria-hidden="true" style="font-size: 15px; margin-top: 2px;"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item btn_editar_respuesta" href="#" id-respuesta="${arra_respuestas[i].IdRespuesta}" id-pregunta="${id_pregunta}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>  Editar</a>
                                            <button class="dropdown-item" type="button" onclick="eliminar_componente(${arra_respuestas[i].IdRespuesta},2,2,${id_pregunta},'')"><i class="fa fa fa-trash-o" aria-hidden="true"></i>  Eliminar</button>
                                        </div>
                                    </div>
                                    
                                </td>       
                                @endif
                                
                            </tr>
                        </table>


                    </li>`;
            }
        
            cadena_respuesta+=`</ul>`;
        }
        
        return cadena_respuesta;
    }

    /*
    
    
                                            
        
    
    

    */


    $("#btn_add_pregunta").click(function(e){
        e.preventDefault();
        $("#modal_guardar_pregunta").modal("show");
        limpiar_pregunta();
    });    

    var IdPregunta="";

    function editar_pregunta(id_pregunta){
        limpiar_pregunta();
        IdPregunta=""+id_pregunta;

        nombre_pregunta=get_pregunta_byid(IdPregunta);

        $("#NombrePregunta").val(nombre_pregunta);
        $("#modal_guardar_pregunta").modal("show");

        var arra_validaciones=$(".valida-caracteres");
        for(var i=0;i<arra_validaciones.length;i++){
            get_validacion(arra_validaciones[i].id);            
        }
    }

    function get_pregunta_byid(id_pregunta){
        for(let i=0;i<data_preguntas.length;i++){
            if(data_preguntas[i].IdPregunta==id_pregunta){
                return data_preguntas[i].NombrePregunta;
            }
        }
        return '';
    }

    function limpiar_pregunta(){
        $("#NombrePregunta").val("");
        IdPregunta="";        
    }

    $("#form-agregar-pregunta").submit(function(e){
        e.preventDefault();

        var NombrePregunta=$("#NombrePregunta").val();

        var formData = new FormData();

        formData.append('NombrePregunta', NombrePregunta);
        formData.append('IdEvaluacion', "{{$evaluaciones[0]->IdEvaluacion}}");
        formData.append('IdPregunta', IdPregunta);
       
        guardar_informacion(formData,"editarpreguntasevaluacioncurso");


    });

      
    



    function cambiar_estado_item(id_item,id_tipo,id_estado,id_pregunta,es_verdadero){
        var formData = new FormData();
        formData.append('id_item', ""+id_item);
        formData.append('id_tipo', ""+id_tipo);
        formData.append('id_estado', ""+id_estado);
        formData.append('id_pregunta', ""+id_pregunta);
        formData.append('es_verdadero', ""+es_verdadero);
        
        guardar_informacion(formData,"cambiarestadoevaluacion");
    }


    var id_item_sel="";
    var id_tipo_sel="";
    var id_estado_sel="";
    var es_verdadero_sel="";
    var id_pregunta_sel_del="";
    
    function eliminar_componente(id_item,id_tipo,id_estado,id_pregunta,es_verdadero=''){
        id_item_sel=""+id_item;
        id_tipo_sel=""+id_tipo;
        id_estado_sel=""+id_estado;
        id_pregunta_sel_del=""+id_pregunta;
        es_verdadero_sel=""+es_verdadero;
        $("#modal_eliminar_item").modal("show");

    }
    $("#btn_eliminar_item").click(function(){
        cambiar_estado_item(id_item_sel,id_tipo_sel,id_estado_sel,id_pregunta_sel_del,es_verdadero_sel);
    });


    var id_pregunta_sel="";    
    var id_respuesta_sel="";
    function abrir_respuesta(id_pregunta,id_respuesta=""){        
        limpiar_respuest();
        id_respuesta_sel=id_respuesta;
        id_pregunta_sel=id_pregunta; 

        if(id_respuesta){
            var obj_respuesta=get_respuesta(id_respuesta,id_pregunta);
            console.log(obj_respuesta);
            $("#NombreRespuesta").val(""+obj_respuesta.NombreRespuesta);
        }

        $("#modal_guardar_respuesta").modal("show");
    }

    function limpiar_respuest(){
        $("#NombreRespuesta").val("");
        id_respuesta_sel="";
        id_pregunta_sel="";
    }

    function get_respuesta(id_respuesta,id_pregunta){
        var respuesta_obj=new Object();
        for(var i=0;i<data_preguntas.length;i++){
            if(id_pregunta==data_preguntas[i].IdPregunta){
                var data_respuestas=data_preguntas[i].respuestas;
                for(var j=0;j<data_respuestas.length;j++){
                    if(data_respuestas[j].IdRespuesta==id_respuesta){
                        respuesta_obj=data_respuestas[j];
                        break;
                    }
                }
            }
        }
        return respuesta_obj;
    }


    $("#form-agregar-respuesta").submit(function(e){
        e.preventDefault();
        var NombreRespuesta=$("#NombreRespuesta").val();
        var formData = new FormData();
        formData.append('NombreRespuesta', NombreRespuesta);
        formData.append('IdEvaluacion', "{{$evaluaciones[0]->IdEvaluacion}}");
        formData.append('IdPregunta', id_pregunta_sel);
        formData.append('IdRespuesta', id_respuesta_sel);

        guardar_informacion(formData,"editarrespuestapreguntaevaluacioncurso");
        
    });


    



    </script>
@stop