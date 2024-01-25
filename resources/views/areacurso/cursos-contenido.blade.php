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

    .list-group-item{
        cursor:move;
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
            <h4>Contenido del Curso</h4>
            <small><i><strong>Curso:</strong> {{$curso->NombreCurso}}</i></small>
            <hr>
        </div>
    </div>

             
  <div class="row">
    <div class="col-md-4">
        <h6 style="font-weight: bold;" class="my-4">Contenido del curso</h6>
        <p>En esta sesión podrás crear cada uno de los módulos y lecciones que hacen parte del curso.</p>
    </div>

    <div class="col-md-8">

        <div style="width: 100%;" class="text-right">
            @if($curso->IdEstado=="3" || session('rol_solicitud')=="root")
            <a href="{{url('')}}/cursos/contenido/{{$curso->CodigoCurso}}/modulo" class="btn btn-default">
                + Módulo
            </a>
            @endif
        </div>        
        <br />
        @php
            $cant_modulos=0;
        @endphp
        <ul  class="list-group" id="listado_ul">
        @foreach($modulos as $modulo)     

            @php
                $cant_modulos++;
                $collapse_activo="";
            @endphp 
        
            <li class="list-group-item card-docttus card-docttus-left" id-tem="{{$modulo->IdModulo}}" id="{{$modulo->IdModulo}}" style=" height: auto !important; position: relative; margin-bottom:10px; border-radius:5px;">
                <table style="width: 100%;">
                    <tr>
                        <td style="width: 18px;">
                            <i class="fa fa-ellipsis-v" style=" font-size: 26px;  color: #0b558685;" aria-hidden="true"></i>
                        </td>

                        <td>
                            <span style="font-size: 15px; color: #7b7b7b; font-weight:bold;">{{$modulo->NombreModulo}}</span>
                        </td>

                        <td class="td_estado">
                            <small style="font-size: 10px; height:14px;">                              
                              @if($modulo->IdEstado==1) PUBLICADO @else {{$modulo->NombreEstado}} @endif
                            </small>
                        </td>
                        @if($curso->IdEstado=="3" || session('rol_solicitud')=="root")
                        <td style="width: 38px; text-align:left;">
                            <div class="btn-group dropleft">
                                <button type="button" class="btn btn-default dropdown-toggle btn-menu-leccion" data-toggle="dropdown" aria-haspopup="true" style="width: 25px; height:25px; border-radius: 15px;     padding-top: 1px; ">
                                    <i class="fa fa-ellipsis-v" aria-hidden="true" style="font-size: 15px; margin-top: 2px;"></i>
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="{{url('')}}/cursos/contenido/{{$curso->CodigoCurso}}/modulo/{{$modulo->IdModulo}}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>  Editar</a>
                                    <button class="dropdown-item" type="button" onclick="cambiar_estado_item({{$modulo->IdModulo}},1,@if($modulo->IdEstado==1) 3 @else 1 @endif)" ><i class="fa fa-check-square-o" aria-hidden="true"></i>  @if($modulo->IdEstado==1) Despublicar @else Publicar @endif</button>                              
                                    <button class="dropdown-item" type="button" onclick="eliminar_componente({{$modulo->IdModulo}},1,2)" ><i class="fa fa fa-trash-o" aria-hidden="true"></i>  Eliminar</button>
                                </div>
                            </div>
                        </td>
                        @endif

                        <td style="width: 12px;">
                            <a  data-toggle="collapse"  data-target="#lista_leccion_{{$modulo->IdModulo}}">
                                <i class="fa fa-angle-down" aria-hidden="true" style="font-size: 20px;"></i>
                            </a>
                        </td>
                    </tr>
                </table>

                @php
                    $cant_lecciones=0;
                @endphp

                @foreach($lecciones as $leccion)
                    @if($leccion->IdModulo==$modulo->IdModulo)
                        @php
                            $cant_lecciones++;
                        @endphp 
                    @endif
                @endforeach
                
                @if($cant_modulos==1)
                    @php
                        $collapse_activo="show";
                    @endphp 
                @endif
                <div class=" {{$collapse_activo}}"  data-parents="#listado_ul" id="lista_leccion_{{$modulo->IdModulo}}">
                @if($cant_lecciones>0)
                
                    <ul  class="list-group lista-lecciones" id="listado_ul_lecciones_{{$modulo->IdModulo}}" style="margin-top: 25px;">
                    @foreach($lecciones as $leccion)
                        @if($leccion->IdModulo==$modulo->IdModulo)
                            <li class=" list-group-item  card-docttus card-docttus-left" id="li_leccion_{{$leccion->IdTema}}" id-modulo="{{$modulo->IdModulo}}" id-tem="{{$leccion->IdTema}}" style="margin-bottom:5px; height:58px; border-radius:5px;">                        

                                <table style="width: 100%;">
                                    <tr>
                                        <td style="width: 18px;">
                                            <i class="fa fa-ellipsis-v" style=" font-size: 26px;  color: #0b558685;" aria-hidden="true"></i>
                                        </td>
                
                                        <td>
                                            <span style="font-size: 15px; color: #7b7b7b;">{{$leccion->NombreTema}}</span>
                                        </td>      
                                        
                                        <td class="td_estado">
                                            <small style="font-size: 10px; height:14px;">                                                
                                                @if($leccion->IdEstado==1) PUBLICADO @else {{$leccion->NombreEstado}} @endif
                                            </small>
                                        </td>
                                       
                                        @if($curso->IdEstado=="3" || session('rol_solicitud')=="root")
                                        <td style="width: 30px; text-align:left;">
                                            <!--<button type="button" class="btn btn-xs btn-default" style="border-radius: 15px; width: 25px; height: 25px;">
                                                <i class="fa fa-ellipsis-v" aria-hidden="true" style="font-size: 15px; margin-top: 2px;"></i>
                                            </button>-->
                                            <div class="btn-group dropleft">
                                                <button type="button" class="btn btn-default dropdown-toggle btn-menu-leccion" data-toggle="dropdown" aria-haspopup="true" style="width: 25px; height:25px; border-radius: 15px;     padding-top: 1px; ">
                                                    <i class="fa fa-ellipsis-v" aria-hidden="true" style="font-size: 15px; margin-top: 2px;"></i>
                                                </button>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item" href="{{url('')}}/cursos/contenido/{{$curso->CodigoCurso}}/leccion/{{$modulo->IdModulo}}-{{$leccion->CodigoTema}}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>  Editar</a>
                                                    <button class="dropdown-item" type="button" onclick="cambiar_estado_item({{$leccion->IdTema}},2,@if($leccion->IdEstado==1) 3 @else 1 @endif,{{$modulo->IdModulo}})" ><i class="fa fa-check-square-o" aria-hidden="true"></i>  @if($leccion->IdEstado==1) Despublicar @else Publicar @endif</button>
                                                    <button class="dropdown-item" type="button" onclick="eliminar_componente({{$leccion->IdTema}},2,2,{{$modulo->IdModulo}})" ><i class="fa fa fa-trash-o" aria-hidden="true"></i>  Eliminar</button>
                                                </div>
                                            </div>                                            
                                        </td>       
                                        @endif
                                        
                                    </tr>
                                </table>


                            </li>
                        @endif
                    
                    @endforeach
                    </ul>
                
                @else
                    <div class="text-center" style="padding: 20px; background-color: #f3f3f3;  border-radius: 5px; border: 2px dashed #ccc;  margin-top: 15px;">
                        <h3 style="font-size: 17px; margin: 0px; color: #b9b9b9;"><i class="fa fa-object-group" aria-hidden="true"></i> Este módulo no tiene lecciones</h3>
                    </div>
                    
                @endif
                    <hr>
                    @if($curso->IdEstado=="3" || session('rol_solicitud')=="root")
                    <a class="btn btn-default btn-xl" href="{{url('')}}/cursos/contenido/{{$curso->CodigoCurso}}/leccion/{{$modulo->IdModulo}}" >                      
                        + Lección
                    </a>
                    @endif

                </div>

            </li>

        @endforeach
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
                        <li>Las imágenes y videos asignados a este item serán eliminados en de nuestro servidor.</li>
                        <li>Los estudiantes que hayan adquirido el curso, ya no podrán ver este item.</li>
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
            @if($curso->IdEstado=="3" || session('rol_solicitud')=="root")
            $('#listado_ul').sortable({
                animation: 150,
                
                onEnd: function (/**Event*/evt) {
                    console.log(evt.newIndex);
                    send_orden("listado_ul",1);

                }
            });

            $('.lista-lecciones').sortable({
                animation: 150,
                
                onEnd: function (/**Event*/evt) {              
                    var nombre_ul=evt.from.id;   
                    
                    console.log(evt);
                    var id_item_leccion=evt.item.id;
                    var id_modulo=$("#"+id_item_leccion).attr("id-modulo");

                    console.log(id_modulo,id_item_leccion);

                    send_orden(""+nombre_ul,2,id_modulo);
                }
            });
        });
        @endif


        $("#form-editar-curso").submit(function(e){
            e.preventDefault();

            var PrecioCurso=""+$("#PrecioCurso").val();
            var DescuentoCurso=""+$("#DescuentoCurso").val();
            var PorcentajeAfiliados="";        

            var formData = new FormData();        
                
            
            formData.append('PrecioCurso', PrecioCurso);
            formData.append('DescuentoCurso', DescuentoCurso);
            formData.append('PorcentajeAfiliados', PorcentajeAfiliados);                
        
            guardar_informacion(formData,"editarprecioscurso");

        });

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
                        location.reload();
                    });
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

        
        function send_orden(id_componente,tipo_orden,IdModulo=""){
            var OrdenModulos=get_item_orden(id_componente);
            var formData = new FormData();
            formData.append('IdCurso', "{{$curso->IdCurso}}");  
            var funcion_docttus="";
            if(tipo_orden=="1"){
                funcion_docttus="editarordenmodulos";
                formData.append('OrdenModulos', ""+OrdenModulos);                    
            }else{
                funcion_docttus="editarordenlecciones";          
                formData.append('IdModulo', ""+IdModulo);                    
                formData.append('OrdenTemas', ""+OrdenModulos);                    
            }        
            guardar_informacion(formData,funcion_docttus,"SI");
        }
        

        function get_item_orden(id_componente){
            var arra_list=$("#"+id_componente+" > li");
            var cadena_orden="";
            for(var i=0;i<arra_list.length;i++){
                var id_item=$(arra_list[i]).attr("id-tem");
                console.log(id_item);
                cadena_orden+=id_item+",";
            }
            cadena_orden=cadena_orden.slice(0,-1);
            return cadena_orden;
        }



        function cambiar_estado_item(id_item,id_tipo,id_estado,id_modulo=''){
            var formData = new FormData();
            formData.append('id_item', ""+id_item);
            formData.append('id_tipo', ""+id_tipo);
            formData.append('id_estado', ""+id_estado);
            formData.append('id_modulo', ""+id_modulo);
            guardar_informacion(formData,"cambiarestadoitem");
        }


        var id_item_sel="";
        var id_tipo_sel="";
        var id_estado_sel="";
        var id_modulo_sel="";

        function eliminar_componente(id_item,id_tipo,id_estado,id_modulo=''){
            id_item_sel=""+id_item;
            id_tipo_sel=""+id_tipo;
            id_estado_sel=""+id_estado;
            id_modulo_sel=""+id_modulo;
            $("#modal_eliminar_item").modal("show");
        }

        $("#btn_eliminar_item").click(function(){
            cambiar_estado_item(id_item_sel,id_tipo_sel,id_estado_sel,id_modulo_sel);
        });



    </script>
@stop