@extends('areacurso.plantillas.plantilla-area-interna')
@section('contenido')   

</style>
<div class="row row-docttus">
    <div class="col-md-12">       
       <h1 style="font-weight: 600; font-size: 20px;">Listado de usuarios {{$tipo_usuario}}</h1>
        
      <br>
      <div class="card-docttus card-docttus-left" style=" height: auto !important;">
        <div class="row row-docttus">
            <div class="col-md-2">
              <label>Fecha Inicio</label>
              <input type="date" name="" class="form-control" id="fecha_inicio">
            </div>
            <div class="col-md-2">
              <label>Fecha Fin</label>
              <input type="date" name="" class="form-control" id="fecha_fin">
            </div>

            @if(session('rol_solicitud')=="root")
            <div class="col-md-2">
              <label>Tipo Usuario</label>
              <select class="form-control" id="TipoUsuario">                 

                 <option value="">Tipo Usuario</option>                 
                 <option value="1,2">Tutores y Afiliados</option>                 
                 <option value="1" {{($tipo_usuario=="afiliados")?"selected":""}} >Afiliados</option>                 
                 <option value="2" {{($tipo_usuario=="tutores")?"selected":""}}>Tutores 10 Millions</option>
                 
              </select>
            </div>
           
            <div class="col-md-2">
              <label>Estado Solicitud</label>
              <select class="form-control" id="EstadoSolicitud">
                <option value="" >Estado Solicitud</option>
                 <option value="1" >Activa</option>
                 <option value="2" >Pendiente</option>
                 <option value="3" >Rechazada</option>
              </select>
            </div>

            <div class="col-md-2">
              <label>Estado Hotmart</label>
              <select class="form-control" id="EstadoSolicitudHotmart">
                <option value="" >Estado Solicitud</option>
                 <option value="1" >Activa</option>
                 <option value="2" >Pendiente</option>
                 <option value="3" >Rechazada</option>
              </select>
            </div>
            @endif

            <div class="col-md-2" style="padding-top: 33px;">
               <button class="btn botones-docttus" id="btn_buscar">Buscar</button>
            </div>
        </div>
        <div class="row row-docttus" style="margin-top: 15px;">
          <div class="col-md-12">
            <table class="table table-striped table-bordered">
              <thead class="thead-dark">
                 <tr>
                    <th>Usuario</th>
                    <th>Fecha</th>
                    <th>Nombre</th>
                    <th>Teléfono</th>
                    <th>Whatsapp</th>
                    <th>Email</th>

                    @if(session('rol_solicitud')=="root")
                    <th>Email Hotmart</th>
                    <th style="width: 50px;"><i class="fa fa-edit" aria-hidden="true"></i></th>
                    <th style="width: 50px;"><i class="fa fa-book" aria-hidden="true"></i></th>
                    <th style="width: 50px;"><i class="fa fa-money" aria-hidden="true"></i></th>
                    <th style="width: 50px;"><i class="fa fa-graduation-cap" aria-hidden="true"></i></th>
                    <th style="width: 50px; text-align:center;"><img src="{{url('')}}/assets/images/icon-hotmart-blanco.png" style="width:14px;"></th>
                    @endif


                  </tr>
              </thead>

              <tbody id="listado_usuarios">
                  
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
          <div class="col-md-12">
            <p><strong>Usuario: </strong><span id="nombre_usuario"> </span></p>
            <p><strong>Email: </strong><span id="email_usuario"> </span></p>
            <strong>Formulario: </strong>
            <div id="TextoSolicitud" style="width: 100%; height: 300px; overflow-y: auto;  padding: 5px; border: 1px solid #ccc; border-radius: 9px;"></div>
          </div>
          
          <div class="col-md-12" style="margin-top: 15px;">
            <strong>Respuesta:</strong>
            <textarea class="form-control" id="RespuestaSolicitud" rows="4" placeholder="Repuesta"></textarea>
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
<div class="modal fade" id="aprobar_solicitud_hotmart" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Solicitud Hotmart</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-12">
            <p><strong>Usuario: </strong><span id="nombre_usuario_hotmart"> </span></p>
            <p><strong>Email Hotmart: </strong><span id="email_hotmart_usuario_hotmart"> </span></p>                        
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">CERRAR</button>
        <button type="button" class="btn btn-success" onclick="enviar_respuesta_hotmart(1)">ACTIVAR</button>
        <button type="button" class="btn btn-danger" onclick="enviar_respuesta_hotmart(3)">RECHAZAR</button>
      </div>
    </div>
  </div>
</div>





<!-- Modal -->
<div class="modal fade" id="modal_cursos_usuario" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Cursos de <span id="titulo_persona"></span></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-12" style="height: 230px; overflow-y: auto;">
              <table class="table-striped table-bordered" style="font-size: 12px; width:100%;">
                  <thead>
                      <tr>
                          <th style="width: 80px; text-align:center;">Cód</th>
                          <th>Nombre</th>
                          <th>Acción</th>
                      </tr>
                  </thead>
                  <tbody id="listado_cursos">

                  </tbody>
              </table>
          </div>
          
          <div class="col-md-12" style="background-color: #fafafa; padding:15px; border-radius:9px; border:1px solid #ccc; margin-top:45px;">              
              <h4>Asignar curso para pruebas</h4>
              <select class="form-control" id="cmb_cursos">
                  <option value="">-Curso-</option>
                  @foreach ($cursos as $curs)
                      <option id-tutor="{{$curs->IdUsuarioTutor}}" value="{{$curs->IdCurso}}">{{$curs->CodigoCurso}} - {{$curs->NombreCurso}} ({{$curs->NombreUsuario}})</option>
                  @endforeach

              </select>              
              <br />
              <button class="btn btn-success" id="btn_asignar_curso" type="button">+ Asignar</button>
              
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
     filtrar_listado_usuarios();
  });

  $("#btn_buscar").click(function(){
     filtrar_listado_usuarios();
  });

  var obj_data=new Object();
  function filtrar_listado_usuarios(){
    var fecha_inicio=$("#fecha_inicio").val();
    var fecha_fin=$("#fecha_fin").val();
    @if(session('rol_solicitud')=="root")
    var TipoUsuario=$("#TipoUsuario").val();
    var estadosolicitud=$("#EstadoSolicitud").val();    
    var EstadoSolicitudHotmart=$("#EstadoSolicitudHotmart").val();    
    @elseif(session('rol_solicitud')=="afiliado")

    var TipoUsuario="1";
    var estadosolicitud="";    
    var EstadoSolicitudHotmart="";    

    @endif

    var request = $.ajax({
        url: "{{url('')}}/listado_usuarios",
        type: "POST",
        data:{                                        
             estadosolicitud:estadosolicitud,
             estadosolicitudhotmart:EstadoSolicitudHotmart,
             fechainicio:fecha_inicio,
             fechafin:fecha_fin,
             TipoUsuario:TipoUsuario,
             _token: "{{ csrf_token() }}"
        }
      });

      request.done(function(obj) { 
         if(obj.status=="ok"){
            obj_data=obj.datos;
            let cadena_tabla="";
            let total_ganancias=0;



            for(let i=0;i<obj_data.length;i++){
                let enlace_aprobacion_tutores="";
                let enlace_aprobacion_afiliados="";
                let enlace_aprobacion_hotmart="";

                let nombre_persona=obj_data[i].NombrePersona+' '+((obj_data[i].ApellidosPersona)?obj_data[i].ApellidosPersona:'');

                let boton_cursos=`<a title="Cursos" style="color:#fff;" href="#" onclick="cursos_usuario(${obj_data[i].IdUsuario},'${obj_data[i].NombreUsuario}','${nombre_persona}','${obj_data[i].IdUsuarioPersona}')"><i class="fa fa-book" aria-hidden="true"></i></a>`;
                let color_tutores="";
                let color_afiliados="";
                let color_hotmart="";
               
                switch (""+obj_data[i].IdEstadoSolicitudAfiliado) {
                   case "1": enlace_aprobacion_afiliados='<a style="color:#fff;" href="#" onclick="abrir_popup_respuesta('+obj_data[i].IdUsuario+',3)"><i class="fa fa-money" aria-hidden="true"></i></a>';
                             color_afiliados="background-color:green;";
                   break;
                   case "2": enlace_aprobacion_afiliados='<a style="color:#fff;" href="#"  onclick="abrir_popup_respuesta('+obj_data[i].IdUsuario+',3)"><i class="fa fa-money" aria-hidden="true"></i></a>';
                             color_afiliados="background-color:orange;";
                   break;
                   case "3": enlace_aprobacion_afiliados='<a style="color:#fff;" href="#"  onclick="abrir_popup_respuesta('+obj_data[i].IdUsuario+',3)"><i class="fa fa-money" aria-hidden="true"></i></a>';
                             color_afiliados="background-color:red;";
                   break;
                   default: enlace_aprobacion_afiliados='<a style="color:#fff;" href="#"  onclick="abrir_popup_respuesta('+obj_data[i].IdUsuario+',3)"><i class="fa fa-money" aria-hidden="true"></i></a>';
                             color_afiliados="background-color:orange;";
                    break;
                }


                switch (""+obj_data[i].IdEstadoSolicitudTutor) {
                   case "1": enlace_aprobacion_tutores='<a style="color:#fff;" href="#"  onclick="abrir_popup_respuesta('+obj_data[i].IdUsuario+',2)"><i class="fa fa-graduation-cap" aria-hidden="true"></i></a>';
                             color_tutores="background-color:green;";
                   break;
                   case "2": enlace_aprobacion_tutores='<a style="color:#fff;" href="#"  onclick="abrir_popup_respuesta('+obj_data[i].IdUsuario+',2)"><i class="fa fa-graduation-cap" aria-hidden="true"></i></a>';
                             color_tutores="background-color:orange;";
                   break;
                   case "3": enlace_aprobacion_tutores='<a style="color:#fff;" href="#"  onclick="abrir_popup_respuesta('+obj_data[i].IdUsuario+',2)"><i class="fa fa-graduation-cap" aria-hidden="true"></i></a>';
                             color_tutores="background-color:red;";
                   break;
                }

               


                switch (""+obj_data[i].AprobacionHotmart) {
                   case "1": enlace_aprobacion_hotmart=`<a style="color:#fff;" href="#"  onclick="abrir_popup_respuesta_hotmart(${obj_data[i].IdUsuario})">
                                                            <img src="{{url('')}}/assets/images/icon-hotmart-blanco.png" style="width:19px;">
                                                        </a>`;
                             color_hotmart="background-color:green;";
                   break;
                   case "2": enlace_aprobacion_hotmart=`<a style="color:#fff;" href="#"  onclick="abrir_popup_respuesta_hotmart(${obj_data[i].IdUsuario})">
                                                          <img src="{{url('')}}/assets/images/icon-hotmart-blanco.png" style="width:19px;">
                                                        </a>`;
                             color_hotmart="background-color:orange;";
                   break;
                   case "3": enlace_aprobacion_hotmart=`<a style="color:#fff;" href="#"  onclick="abrir_popup_respuesta_hotmart(${obj_data[i].IdUsuario})">
                                                          <img src="{{url('')}}/assets/images/icon-hotmart-blanco.png" style="width:19px;">
                                                        </a>`;
                             color_hotmart="background-color:red;";
                   break;
                }

               



                cadena_tabla+='<tr style="font-size:12px;">';
                cadena_tabla+='   <td>'+obj_data[i].NombreUsuario+'</td>';
                cadena_tabla+='   <td>'+obj_data[i].FechaCreacion+'</td>';
                cadena_tabla+='   <td>'+obj_data[i].NombrePersona+' '+((obj_data[i].ApellidosPersona)?obj_data[i].ApellidosPersona:'')+'</td>';
                cadena_tabla+='   <td>'+((obj_data[i].TelefonoPersona)?obj_data[i].TelefonoPersona:'')+'</td>';
                cadena_tabla+='   <td>'+((obj_data[i].WhatsappPersona)?obj_data[i].WhatsappPersona:'')+'</td>';
                cadena_tabla+='   <td>'+obj_data[i].EmailPersona+'</td>';

                @if(session('rol_solicitud')=="root")
                cadena_tabla+='   <td>'+((obj_data[i].EmailHotmart)?obj_data[i].EmailHotmart:'')+'</td>';
                cadena_tabla+='   <td style="text-align:center; font-size: 19px; padding-top: 7px; padding-bottom: 2px;"><a taget="_blank" href="{{url('')}}/usuario/'+obj_data[i].NombreUsuario+'" ><i class="fa fa-edit" aria-hidden="true"></i></a></td>';
                cadena_tabla+='   <td style="text-align:center; font-size: 19px; padding-top: 7px; padding-bottom: 2px;background-color:#2d2dc1;">'+boton_cursos+'</td>';
                cadena_tabla+='   <td style="text-align:center; font-size: 19px; padding-top: 7px; padding-bottom: 2px;'+color_afiliados+'">'+enlace_aprobacion_afiliados+'</td>';
                cadena_tabla+='   <td style="text-align:center;  font-size: 19px; padding-top: 7px; padding-bottom: 2px;'+color_tutores+'">'+enlace_aprobacion_tutores+'</td>';
                cadena_tabla+='   <td style="text-align:center;  font-size: 19px; padding-top: 7px; padding-bottom: 2px;'+color_hotmart+'">'+enlace_aprobacion_hotmart+'</td>';
                @endif

                cadena_tabla+='</tr>';
                
            }            
            $("#listado_usuarios").html(""+cadena_tabla);
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


  var id_usuario="";
  var email_persona_sel="";
  var tipo_respuesta="";
  function abrir_popup_respuesta(idusuario,tiporespuesta){
      id_usuario=idusuario;
      tipo_respuesta=""+tiporespuesta;
      if(tiporespuesta=="3"){
        $("#titulo_modal").html("Afiliados");
      }else{
        $("#titulo_modal").html("Tutores");
      }

      var data_usuario=buscar_solicitud(id_usuario);

      $("#nombre_usuario").html(""+data_usuario.NombreUsuario);
      $("#email_usuario").html(""+data_usuario.EmailPersona);

      email_persona_sel=""+data_usuario.EmailPersona;

      var texto_solicitud="";
      var texto_respuesta="";
      $("#RespuestaSolicitud").val(texto_respuesta);      
      $("#aprobar_solicitud").modal("show");
      get_formulario_by_usuario(idusuario,tiporespuesta);

  }

  function abrir_popup_respuesta_hotmart(idusuario){
      id_usuario=idusuario;      
      var data_usuario=buscar_solicitud(id_usuario);

      $("#nombre_usuario_hotmart").html(""+data_usuario.NombreUsuario);
      $("#email_usuario_hotmart").html(""+data_usuario.EmailPersona);
      $("#email_hotmart_usuario_hotmart").html(""+data_usuario.EmailHotmart);
      

      email_persona_sel=""+data_usuario.EmailPersona;

      var texto_solicitud="";
      var texto_respuesta="";      
      $("#aprobar_solicitud_hotmart").modal("show");

  }


  var obj_preguntas=new Array();
  var obj_data_preg=new Object();
  
  function get_formulario_by_usuario(IdUsuario,tiporespuesta){
    var texto_solicitud="";

    $("#TextoSolicitud").html(`<h1 style="text-align:center;">...CARGANDO...</h1>`);

    var request = $.ajax({
        url: "{{url('')}}/get_formulario_by_usuario",
        type: "POST",
        data:{                                                     
            IdUsuario:IdUsuario,
            perfil:""+tiporespuesta,
             _token: "{{ csrf_token() }}"
        }
      });

    request.done(function(obj) { 
         if(obj.status=="ok"){
          obj_data_preg=obj.datos;

            obj_preguntas=new Array();
            for(var i=0;i<obj_data_preg.length;i++){
              if(get_pregunta_exist(obj_data_preg[i].IdPregunta)==-1){
                obj_preguntas.push(obj_data_preg[i]);
              }
            } 

            for(var i=0;i<obj_preguntas.length;i++){
              texto_solicitud+=`<h6 style="background-color: #062b43; padding: 5px 18px; color: #fff;">${obj_preguntas[i].NombrePregunta}</h6>`;
              for(var j=0;j<obj_data_preg.length;j++){
                if(obj_data_preg[j].IdPregunta==obj_preguntas[i].IdPregunta){

                  var NombreRespuesta=obj_data_preg[j].NombreRespuesta;
                  if(obj_data_preg[j].ValorRespuesta){
                    NombreRespuesta=obj_data_preg[j].ValorRespuesta;
                  }
                  

                  texto_solicitud+=`<p style="padding: 5px 18px; ">${NombreRespuesta}</p>`;
                }
                
              }
              
            }


            $("#TextoSolicitud").html(""+texto_solicitud);

          }else{
            mensaje_generico("Error !",""+obj.mensaje,"2","Continuar...",function(){});
            return;
         }
    });

    request.fail(function(jqXHR, textStatus) {
        alert( "Error de servidor  " + textStatus );
    });


  }

  function get_pregunta_exist(id_pregunta){
    var posicion=-1;
    for(var i=0;i<obj_preguntas.length;i++){
      if(obj_preguntas[i].IdPregunta==id_pregunta){
        posicion=i;
        break;
      }
    }

    return posicion;

  }


  function buscar_solicitud(idusuario){
    var obj_dat=new Object();
    for(var i=0;i<obj_data.length;i++){
      if(""+obj_data[i].IdUsuario==""+idusuario){
        obj_dat=obj_data[i];
        break;
      }
    } 
    return obj_dat;
  }



  function enviar_respuesta(id_estado){

    var IdUsuario=id_usuario;
    var tipo_respuesta_s=tipo_respuesta;
    var respuesta=$("#RespuestaSolicitud").val();    

    var request = $.ajax({
        url: "{{url('')}}/estado_solicitud",
        type: "POST",
        data:{                                        
             IdUsuario:IdUsuario,
             tipo_respuesta:""+tipo_respuesta_s,
             id_estado:id_estado,
             respuesta:respuesta,
             email:email_persona_sel,          
             _token: "{{ csrf_token() }}"
        }
      });

      
      request.done(function(obj) { 
         if(obj.status=="ok"){
            $("#aprobar_solicitud").modal("hide");
            mensaje_generico("Correcto",""+obj.mensaje,"1","Continuar...",function(){
              filtrar_listado_usuarios();
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


  function enviar_respuesta_hotmart(id_estado){

    var IdUsuario=id_usuario;    

    var request = $.ajax({
        url: "{{url('')}}/estado_solicitud_hotmart",
        type: "POST",
        data:{                                        
            IdUsuario:IdUsuario,            
            IdEstado:id_estado,
            EmailUsuario:email_persona_sel,          
            _token: "{{ csrf_token() }}"
        }
      });

      
      request.done(function(obj) { 
        if(obj.status=="ok"){
            $("#aprobar_solicitud").modal("hide");
            mensaje_generico("Correcto",""+obj.mensaje,"1","Continuar...",function(){
              filtrar_listado_usuarios();
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


  var obj_cursos_persona=new Object();
  var id_usuario_persona_sel="";
  var id_usuario_sel="";
  var codigo_usuario_sel="";
  var nombre_usuario_sel="";

  function cursos_usuario(id_usuario,codigo_usuario,nombre_usuario,id_usuario_persona){
    id_usuario_persona_sel=""+id_usuario_persona;
    id_usuario_sel=""+id_usuario;
    codigo_usuario_sel=""+codigo_usuario;
    nombre_usuario_sel=""+nombre_usuario;

    $("#titulo_persona").html("("+codigo_usuario+") "+nombre_usuario);
    var request = $.ajax({
        url: "{{url('')}}/get_cursos_by_usuario",
        type: "POST",
        data:{                                        
             IdUsuario:id_usuario,             
             _token: "{{ csrf_token() }}"
        }
      });
      
      request.done(function(obj) { 
         if(obj.status=="ok"){            
          obj_cursos_persona=obj.cursos;
          var cadena_listado_cursos="";
          for(var i=0;i<obj_cursos_persona.length;i++){
            cadena_listado_cursos+=`<tr>
                                        <td style="text-align:center; padding:5px;">${obj_cursos_persona[i].CodigoCurso}</td>
                                        <td style=" padding:5px;">${obj_cursos_persona[i].NombreCurso}<br><small>${obj_cursos_persona[i].NombreTutor}</small></td>
                                        <td></td>
                                    </tr>`;
          }

          $("#listado_cursos").html(cadena_listado_cursos);

         }else{
            mensaje_generico("Error !",""+obj.mensaje,"2","Continuar...",function(){});
            return;
         }
      });
       //respuesta si falla
      request.fail(function(jqXHR, textStatus) {
        alert( "Error de servidor  " + textStatus );
      });

      $("#modal_cursos_usuario").modal("show");
  }

  $("#btn_asignar_curso").click(function(){
    var IdUsuarioPersona=id_usuario_persona_sel;
    var tipo_respuesta_s=tipo_respuesta;    
    var id_tutor=$("#cmb_cursos").find(':selected').attr('id-tutor');
    

    if($("#cmb_cursos").val()==""){
      mensaje_generico("Error !","Debe Seleccionar un curso para asignar","2","Continuar...",function(){});
      return;
    }

    var request = $.ajax({
        url: "{{url('')}}/asignar_curso",
        type: "POST",
        data:{                                        
            IdUsuarioPersona:IdUsuarioPersona,             
            IdCurso:$("#cmb_cursos").val(),    
            IdTutor:id_tutor,
            _token: "{{ csrf_token() }}"
        }
      });

      
      request.done(function(obj) { 
         if(obj.status=="ok"){
            $("#aprobar_solicitud").modal("hide");
            mensaje_generico("Correcto",""+obj.mensaje,"1","Continuar...",function(){
              $("#cmb_cursos").val("");
              filtrar_listado_usuarios();              
              cursos_usuario(id_usuario_persona_sel,codigo_usuario_sel,nombre_usuario_sel,id_usuario_persona_sel);
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
  });


</script>
@stop