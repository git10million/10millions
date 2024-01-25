@extends('areacurso.plantillas.plantilla-area-interna')
@section('contenido')   
<style>
  .btn_usuario{
    cursor: pointer;
  }
</style>

<div class="row row-docttus">
    <div class="col-md-12">       
      <h1 style="font-weight: 600; font-size: 20px;">Listado de Contenido Pendiente por Subir a Vimeo</h1>
        
      <br>
      <div class="card-docttus card-docttus-left" style=" height: auto !important; background-color:#0b5586;">        
        <div class="row row-docttus" style="margin-top: 15px;">
          <div class="col-md-12">
                <div id="cursos_pendientes">

                    <div id="accordion">
                        
                    </div>
                </div>
          </div>         
        </div>

      </div>
      
       
    </div>
</div>



@stop

@section('scripts')

    
<script type="text/javascript">

  $(function() {
     filtrar_listado_usuarios();
  });

  $("#btn_buscar").click(function(){
     filtrar_listado_usuarios();
  });
  function filtrar_listado_usuarios(){
    var fecha_inicio=$("#fecha_inicio").val();
    var fecha_fin=$("#fecha_fin").val();
    var EstadoSolicitud=$("#EstadoSolicitud").val();

    var request = $.ajax({
        url: "{{url('')}}/pendientes_por_subir",
        type: "POST",
        data:{
             tiporesultado:"json",
             _token: "{{ csrf_token() }}"
        }
      });  

      request.done(function(obj) { 
         if(obj.status=="ok"){
            var obj_data=obj.datos;
            var cadena_tabla="";
            var total_ganancias=0;
            var cadena_cursos="";
            
            for(var i=0;i<obj_data.length;i++){

                var mostrar_curso=0;

                var cad_show="";

                if(i==0){
                    cad_show="show";
                }

                var cadena_modulos='';
                var obj_modulo=obj_data[i].Modulos;

                var slug_curso=""+obj_data[i].SlugCurso;
                

                for(var j=0;j<obj_modulo.length;j++){

                    var obj_medios_modulo=obj_modulo[j].ContenidoMedia;
                    var cadena_medios_modulo="";
                    if(obj_medios_modulo.length>0){
                        cadena_medios_modulo=`                            
                            <table class="table table-stripped table-bordered table-xs">
                                <thead>
                                    <tr style="background-color:#dbffdd;">
                                        <th  style="width:120px;">Id</th>
                                        <th>Nombre Video</th>
                                        <th style="width:100px;">Subir</th>
                                        <th style="width:100px;">Verificar</th>
                                        <th style="width:100px;">Eliminar</th>
                                    </tr>
                                </thead>

                                <tbody>
                        `;

                        for(var k=0;k<obj_medios_modulo.length;k++){


                            var cadena_boton_subir_media='';
                            var cadena_boton_verificar_media='';
                            var cadena_boton_eliminar_media="";
                            var aplica_cambio=0;

                            if(obj_medios_modulo[k].EstadoVimeo==""){
                                cadena_boton_subir_media=`<button class="btn btn-warning btn-xs" type="button"  onclick="subir_vimeo(${obj_medios_modulo[k].IdMedia},2,'modulo')" style="display:inline-block;"><i class="fa fa-vimeo-square" aria-hidden="true"></i> Subir</button>`;
                                mostrar_curso++;
                                aplica_cambio=1;
                            }

                            if(obj_medios_modulo[k].EstadoVimeo=="2"){
                                cadena_boton_verificar_media=`<button class="btn btn-success btn-xs" type="button"  onclick="verificacion_vimeo(${obj_medios_modulo[k].IdMedia},2,'modulo')" style="display:inline-block;">Verificar</button>`;
                                mostrar_curso++;
                                aplica_cambio=1;
                            }

                            if(obj_medios_modulo[k].VideoTemporal!=""){
                                cadena_boton_eliminar_media=`<button class="btn btn-danger btn-xs" type="button" style="display:inline-block;" onclick="eliminar_video(${obj_medios_modulo[k].IdMedia},2,'modulo')">Eliminar</button>`;
                                mostrar_curso++;
                                aplica_cambio=1;
                            }

                            

                            if(aplica_cambio==1){

                            
                                cadena_medios_modulo+=`
                                    <tr>
                                        <td>${obj_medios_modulo[k].IdMedia}</td>
                                        <td>${obj_medios_modulo[k].NombreMedia} <a class="btn btn-xs btn-info" target="_blank" href="${obj_medios_modulo[k].URLMedia}">Ver</a></td></td>
                                        <td id="cnv_subir_modulo_${obj_medios_modulo[k].IdMedia}">${cadena_boton_subir_media}</td>
                                        <td id="cnv_verificar_modulo_${obj_medios_modulo[k].IdMedia}">${cadena_boton_verificar_media}</td>
                                        <td id="cnv_eliminar_modulo_${obj_medios_modulo[k].IdMedia}">${cadena_boton_eliminar_media}</td>
                                    </tr>
                                `;
                            }
                        }

                        cadena_medios_modulo+=`
                                </tbody>
                            </table>`;

                    }

                    var obj_tema=obj_modulo[j].Temas;
                    var cadena_lecciones=``;
                    
                    

                    for(var k=0;k<obj_tema.length;k++){

                        var obj_medios_tema=obj_tema[k].ContenidoMedia;
                        

                        var cadena_medios_tema="";

                        if(obj_medios_tema.length>0){
                            

                            cadena_medios_tema=`          
                            <div style="padding-left:55px;">                  
                            <table class="table table-stripped table-bordered" style="margin-bottom:15px; margin-top:-5px;">
                                <thead>
                                    <tr style="background-color:#afe4ff;">
                                        <th  style="width:120px;">Id</th>
                                        <th>Nombre Video</th>
                                        <th style="width:100px;">Subir</th>
                                        <th  style="width:100px;">Verificar</th>
                                        <th  style="width:100px;">Eliminar</th>
                                    </tr>
                                </thead>

                                <tbody>
                            `;

                            for(var l=0;l<obj_medios_tema.length;l++){

                                

                                var cadena_boton_subir_media='';
                                var cadena_boton_verificar_media='';
                                var cadena_boton_eliminar_media="";
                                var aplica_cambio=0;

                                if(obj_medios_tema[l].EstadoVimeo==""){
                                    cadena_boton_subir_media=`<button class="btn btn-warning btn-xs" type="button" style="display:inline-block;" onclick="subir_vimeo(${obj_medios_tema[l].IdMedia},2,'tema')"><i class="fa fa-vimeo-square" aria-hidden="true"></i>  Subir</button>`;
                                    mostrar_curso++;
                                    aplica_cambio=1;
                                }
                                if(obj_medios_tema[l].EstadoVimeo=="2"){
                                    cadena_boton_verificar_media=`<button class="btn btn-success btn-xs" type="button" style="display:inline-block;" onclick="verificacion_vimeo(${obj_medios_tema[l].IdMedia},2,'tema')">Verificar</button>`;
                                    mostrar_curso++;
                                    aplica_cambio=1;
                                }
                                

                                if(obj_medios_tema[l].VideoTemporal!=""){
                                    cadena_boton_eliminar_media=`<button class="btn btn-danger btn-xs" type="button" style="display:inline-block;" onclick="eliminar_video(${obj_medios_tema[l].IdMedia},2,'tema')">Eliminar</button>`;
                                    mostrar_curso++;
                                    aplica_cambio=1;
                                }

                                if(aplica_cambio==1){
                                    cadena_medios_tema+=`
                                        <tr>
                                            <td>${obj_medios_tema[l].IdMedia}</td>
                                            <td>${obj_medios_tema[l].NombreMedia} <a class="btn btn-xs btn-info" target="_blank" href="${obj_medios_tema[l].URLMedia}">Ver</a></td>
                                            <td id="cnv_subir_tema_${obj_medios_tema[l].IdMedia}">${cadena_boton_subir_media}</td>
                                            <td id="cnv_verificar_tema_${obj_medios_tema[l].IdMedia}">${cadena_boton_verificar_media}</td>
                                            <td id="cnv_eliminar_tema_${obj_medios_tema[l].IdMedia}">${cadena_boton_eliminar_media}</td>
                                            
                                        </tr>
                                    `;
                                }
                            }

                            cadena_medios_tema+=`
                                    </tbody>
                                </table>
                                
                            </div>`;



                        }

                        if(obj_medios_tema.length>0){
                        cadena_lecciones+=`
                        
                            <a target="_blank" href="{{url('')}}/tema/${slug_curso}/leccion/${obj_tema[k].CodigoTema}" ><h5 style="font-size:17px; background-color:#f1f1f1; padding:6px; padding-left:25px;"> ${obj_tema[k].IdTema} - ${obj_tema[k].NombreTema} - Cant: (${obj_medios_tema.length}) </h5></a>
                            ${cadena_medios_tema}
                        
                         `;

                        }
                        


                    }





                    if(cadena_medios_modulo!="" || cadena_lecciones!=""){
                        cadena_modulos+=`

                            <a  target="_blank" href="{{url('')}}/tema/${slug_curso}/modulo/${obj_modulo[j].IdModulo}" ><h5 style="font-size:19px; background-color:#ccc; padding:6px;"> ${obj_modulo[j].IdModulo} - ${obj_modulo[j].NombreModulo} </h5> </a>
                            
                            ${cadena_medios_modulo}

                            <hr />

                            ${cadena_lecciones}
                            

                        `;
                    }
                }


                var cadena_boton_subir=``;
                var cadena_boton_verificar=``;
                var cadena_boton_eliminar=``;
                var cadena_ver_video="";

                if(obj_data[i].TipoVideo!="3"){
                    if(obj_data[i].EstadoVimeo=="" || obj_data[i].TipoVideo=="1"){
                        if(obj_data[i].URLVimeo==""){
                            cadena_boton_subir=`<button  onclick="subir_vimeo(${obj_data[i].IdCurso},1,'portada')" class="btn btn-warning btn-xs" type="button" style="display:inline-block;"><i class="fa fa-vimeo-square" aria-hidden="true"></i>  Subir Portada</button>`;
                            mostrar_curso++;
                        }
                    }
                }

                if(obj_data[i].EstadoVimeo=="2"){
                    cadena_boton_verificar=`<button onclick="verificacion_vimeo(${obj_data[i].IdCurso},1,'portada')" class="btn btn-success btn-xs" type="button" style="display:inline-block;">Verificar Portada</button>`;
                    mostrar_curso++;
                }

                if(obj_data[i].VideoTemporal!=""){
                    cadena_boton_eliminar=`<button onclick="eliminar_video(${obj_data[i].IdCurso},1,'portada')" class="btn btn-danger btn-xs" type="button" style="display:inline-block;">Eliminar Portada</button>`;
                    mostrar_curso++;
                }

                
                cadena_ver_video=`<a href="${obj_data[i].VideoCurso}" class="btn btn-info btn-xs" target="_blank">Ver</a>`;
                

                if(mostrar_curso>0){
                    cadena_cursos+=`

                        <div class="card">

                            <div class="card-header" id="headingOne">
                                <div class="row">
                                    <div class="col-9">
                                        <h5 style="margin:0px;"> ${obj_data[i].CodigoCurso} - ${obj_data[i].NombreCurso} </h5> 
                                        <small>${obj_data[i].NombreTutor}</small>
                                    </div>
                                    <div class="col-3 text-right">                                    
                                        <button class="btn btn-default" style="width: 30px; height:30px; text-align:left; border-radius:25px; padding-top: 2px;  padding-left: 10px;" data-toggle="collapse" data-target="#collapse_${i}" aria-expanded="true" aria-controls="collapseOne">                            
                                            <i class="fa fa-angle-down" aria-hidden="true"></i>
                                        </button>
                                    </div>
                                </div>                            
                            </div>
                            
                            <div id="collapse_${i}" class="collapse ${cad_show}" aria-labelledby="headingOne" data-parent="#accordion">
                                <div class="card-body">

                                    <span id="cnv_subir_portada_${obj_data[i].IdCurso}">${cadena_boton_subir}</span>
                                    <span id="cnv_verificar_portada_${obj_data[i].IdCurso}">${cadena_boton_verificar}</span>
                                    <span id="cnv_eliminar_portada_${obj_data[i].IdCurso}">${cadena_boton_eliminar}</span>
                                    ${cadena_ver_video}

                                    <hr />

                                    ${cadena_modulos}

                                </div>
                            </div>
                        </div>

                    `;
                }
            }   
            $("#accordion").html(cadena_cursos);
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

    function subir_vimeo(IdItem,IdTipo,modo){
        console.log(IdItem,IdTipo);
        var request = $.ajax({
            url: "{{url('')}}/surbir_vimeo_media",
            type: "POST",
            data:{
                IdItem:""+IdItem,
		        IdTipo:""+IdTipo,
                tiporesultado:"json",
                _token: "{{ csrf_token() }}"
            }
        });  

        $("#cnv_subir_"+modo+"_"+IdItem+" > button").html("..Subiendo..");
        $("#cnv_subir_"+modo+"_"+IdItem+" > button").attr("disabled","disabled");

        request.done(function(obj) { 
            if(obj.status=="ok"){
                //mensaje_generico("Carga Correcta!",""+obj.mensaje,"1","Continuar...",function(){});

                
                $("#cnv_verificar_"+modo+"_"+IdItem).html(`<button class="btn btn-success btn-xs" type="button"  onclick="verificacion_vimeo(${IdItem},${IdTipo},'${modo}')" style="display:inline-block;">Verificar</button>`);
                $("#cnv_subir_"+modo+"_"+IdItem).html("");
                

                return;
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

    function verificacion_vimeo(IdItem,IdTipo,modo){
        console.log(IdItem,IdTipo);
        var request = $.ajax({
            url: "{{url('')}}/verificacion_vimeo",
            type: "POST",
            data:{
                IdItem:""+IdItem,
		        IdTipo:""+IdTipo,
                tiporesultado:"json",
                _token: "{{ csrf_token() }}"
            }
        });  

        request.done(function(obj) { 
            if(obj.status=="ok"){
               // mensaje_generico("Muy Bien!",""+obj.mensaje,"1","Continuar...",function(){  });

                
                $("#cnv_eliminar_"+modo+"_"+IdItem).html(`<button class="btn btn-danger btn-xs" type="button" style="display:inline-block;" onclick="eliminar_video(${IdItem},${IdTipo},'${modo}')">Eliminar</button>`);
                $("#cnv_verificar_"+modo+"_"+IdItem).html(``);                    
                
                
                return;
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


    function eliminar_video(IdItem,IdTipo,modo){
        console.log(IdItem,IdTipo);
        var request = $.ajax({
            url: "{{url('')}}/eliminar_video_temporal",
            type: "POST",
            data:{
                IdItem:""+IdItem,
		        IdTipo:""+IdTipo,
                modo:""+modo,
                tiporesultado:"json",
                _token: "{{ csrf_token() }}"
            }
        });  

        request.done(function(obj) { 
            if(obj.status=="ok"){
                var obj_data=obj.datos;
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


</script>
@stop