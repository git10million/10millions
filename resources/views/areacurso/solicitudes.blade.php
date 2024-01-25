@extends('areacurso.plantillas.plantilla-area-interna')
@section('contenido')   
<style>
  .btn_usuario{
    cursor: pointer;
  }
</style>

<div class="row row-docttus">
    <div class="col-md-12">       
      <h1 style="font-weight: 600; font-size: 20px;">Listado de Solicitudes</h1>
        
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

            <div class="col-md-2">
              <label>Estado Solicitud</label>
              <select class="form-control" id="EstadoSolicitud" >
                <option value="">Todos</option>
                <option value="1">Aprobados</option>                
                <option value="2">Pendientes</option>
                <option value="3">Rechazados</option>
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
                    <th>Id.</th>
                    <th>Estado</th>
                    <th>Usuario</th>
                    <th>Curso</th>
                    <th>Fecha</th>
                    <th>Acción</th>
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
<div class="modal fade" id="modal_cambio_solicitud" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="nombre_modal">Cambiar Estado</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <center>

            <h3>¿Deseas cambiar el estado de esta solicitud a <span id="nombre_solicitud"></span> ?</h3>
            <h5>Usuario: <span id="nombre_usuario_solicitud"></span></h5>
            <br />
            <br />
            <button class="btn btn-success" style="margin-right:15px;" id="btn_cambiar_estado" type="button">CAMBIAR ESTADO</button>
            <button class="btn btn-danger"  data-dismiss="modal">CERRAR</button>

        </center>

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
        url: "{{url('')}}/listado_solicitudes",
        type: "POST",
        data:{                                        
             
             fechainicio:""+fecha_inicio,
             fechafin:""+fecha_fin,
             EstadoSolicitud:""+EstadoSolicitud,
             _token: "{{ csrf_token() }}"
        }
      });  

      request.done(function(obj) { 
         if(obj.status=="ok"){
            var obj_data=obj.datos;
            var cadena_tabla="";
            var total_ganancias=0;
            for(var i=0;i<obj_data.length;i++){
                var en_canje="NO";
                if(obj_data[i].EnCanje=="1"){
                  en_canje="SI";
                }

                /*
                <tr>                    
                    <th>Id.</th>
                    <th>Estado</th>
                    <th>Usuario</th>
                    <th>Curso</th>
                    <th>Fecha</th>
                    <th>Acción</th>
                </tr>
                */

                var estado_solicitud="";
                var boton_1="";
                var boton_2="";
                var botones="";
                boton_1=`<button class="btn btn-danger btn-xs" onclick="abrir_cambio_notificacion('Rechazado','`+obj_data[i].IdUsuarioPersona+`','`+obj_data[i].NombreUsuario+`','3')">Rechazar</button>`;
                boton_2=`<button class="btn btn-success btn-xs"  onclick="abrir_cambio_notificacion('Aprobado','`+obj_data[i].IdUsuarioPersona+`','`+obj_data[i].NombreUsuario+`','1')">Aprobar</button>`;

                if(obj_data[i].EstadoSolicitudAfiliacion=="1"){
                    estado_solicitud="Aprobado";
                    botones=boton_1+" ";
                }

                if(obj_data[i].EstadoSolicitudAfiliacion=="2"){
                    estado_solicitud="Pendiente";
                    botones=boton_1+" "+boton_2;                    
                }

                if(obj_data[i].EstadoSolicitudAfiliacion=="3"){
                    estado_solicitud="Rechazado";
                    botones=" "+boton_2;
                }


                cadena_tabla+='<tr style="font-size:12px;">';
                cadena_tabla+='   <td>'+obj_data[i].IdSolicitudAfiliacion+'</td>';
                cadena_tabla+='   <td>'+estado_solicitud+'</td>';
                cadena_tabla+='   <td>'+obj_data[i].NombreUsuario+'</td>';
                cadena_tabla+='   <td>'+obj_data[i].NombreCurso+'</td>';
                cadena_tabla+='   <td>'+obj_data[i].FechaCreacion+'</td>';
                cadena_tabla+='   <td>'+botones+'</td>';
                
                
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

  var IdUsuarioSel="";
  var EstadoSolicitudSel="";
  function abrir_cambio_notificacion(nombre_estado,IdUsuario,NombreUsuario,EstadoSolicitud){
      $("#nombre_solicitud").html(""+nombre_estado);
      $("#modal_cambio_solicitud").modal("show");
      $("#nombre_usuario_solicitud").html(""+NombreUsuario);
      IdUsuarioSel=IdUsuario;
      EstadoSolicitudSel=EstadoSolicitud;
  }


  $("#btn_cambiar_estado").click(function(e){
    e.preventDefault();
    cambiar_estado();
  });

  function cambiar_estado(){
    var request = $.ajax({
        url: "{{url('')}}/cambiar_solicitud",
        type: "POST",
        data:{                                        
             
            IdUsuario:""+IdUsuarioSel,            
            EstadoSolicitud:""+EstadoSolicitudSel,
            _token: "{{ csrf_token() }}"
        }
      });  

      request.done(function(obj) { 
         if(obj.status=="ok"){
            mensaje_generico("Solicitud","Estado de solicitud cambiado corectamente.","1","Continuar...",function(){
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
  

</script>
@stop