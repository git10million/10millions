@extends('areacurso.plantillas.plantilla-area-interna')
@section('contenido')   
<style>
  .btn_usuario{
    cursor: pointer;
  }
</style>

<div class="row row-docttus">
    <div class="col-md-12">       
       <h1 style="font-weight: 600; font-size: 20px;">Listado de Retiros</h1>
        
      <br>
      <div class="card-docttus card-docttus-left" style=" height: auto !important;">
        <div class="row row-docttus">
            <div class="col-md-2">
              <label>Fecha Inicio</label>
              <input type="date" name="" class="form-control" id="fecha_inicio" value="{{$week_start}}">
            </div>
         
            <div class="col-md-2">
              <label>Fecha Fin</label>
              <input type="date" name="" class="form-control" id="fecha_fin" value="{{$week_end}}">
            </div>

            <div class="col-md-2">
              <label>Estado</label>
              <select class="form-control" id="EstadoRetiro">                
                <option value="1">EN PROCESO</option>
                <option value="2">FINALIZADO</option>
                <option value="3">RECHAZADO</option>
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
                    <th>Fecha</th>
                    <th>Usuario</th>
                    <th>Precio</th>
                    <th>Acción</th>
                  </tr>
              </thead>

              <tbody id="listado_usuarios">
                  
              </tbody>             
            </table>            
          </div>
          <div class="col-md-12">
             <h2 style="text-align: right;"><strong>TOTAL:</strong> $<span id="total_listado">0</span></h2>
          </div>
        </div>

      </div>
      
       
    </div>
</div>




<!-- Modal -->
<div class="modal fade" id="modal_info_persona" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="nombre_modal"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <table class="table table-bordered">
            
            <tr>
              <td>Nombre Completo</td>
              <td id="NombreCompleto_m"></td>
            </tr>

            <tr>
              <td>Email</td>
              <td id="EmailPersona_m"></td>
            </tr>

            <tr>
              <td>Teléfono</td>
              <td id="TelefonoPersona_m"></td>
            </tr>

            <tr>
              <td>WhatsApp</td>
              <td id="WhatsappPersona_m"></td>
            </tr>

            


          </table>

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
    var EstadoRetiro=$("#EstadoRetiro").val();

    var request = $.ajax({
        url: "{{url('')}}/get_retiros",
        type: "POST",
        data:{                                        
             
             fechainicio:""+fecha_inicio,
             fechafin:""+fecha_fin,
             estado:""+EstadoRetiro,
             _token: "{{ csrf_token() }}"
        }
      });  

      request.done(function(obj) { 
         if(obj.status=="ok"){
            var obj_data=obj.datos;
            var cadena_tabla="";
            var total_ganancias=0;
            for(var i=0;i<obj_data.length;i++){
                var estado_retiro="NO";
                
                if(obj_data[i].IdEstadoRetiro=="1"){
                  estado_retiro="EN PROCESO";
                }

                if(obj_data[i].IdEstadoRetiro=="2"){
                  estado_retiro="APROBADO";
                }

                if(obj_data[i].IdEstadoRetiro=="3"){
                  estado_retiro="RECHAZADO";
                }

                var rol_persona="";

                if(obj_data[i].IdRol=="1"){

                }

                                

                /*
                <tr>                    
                    <th>Id.</th>
                    <th>Estado</th>
                    <th>Fecha</th>
                    <th>Usuario</th>
                    <th>Precio</th>
                    <th>Acción</th>
                  </tr>


                */

                cadena_tabla+='<tr style="font-size:12px;">';
                cadena_tabla+='   <td>'+obj_data[i].IdRetiros+'</td>';
                cadena_tabla+='   <td>'+estado_retiro+'</td>';                
                cadena_tabla+='   <td>'+obj_data[i].FechaCreacion+'</td>';
                cadena_tabla+=`   <td><a class="btn_usuario" onclick="abrir_info_persona('`+obj_data[i].NombreUsuario+`')" >@`+obj_data[i].NombreUsuario+`</a></td>`;                                
                cadena_tabla+='   <td style="text-align:right;">$'+obj_data[i].ValorRetiro+'</td>';
                cadena_tabla+='   <td></td>';
                
                
                cadena_tabla+='</tr>';
                total_ganancias+=parseFloat(obj_data[i].ValorRetiro);
            }
            $("#total_listado").html(""+total_ganancias);
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




  function abrir_info_persona(codigo_usuario){
    
    var request = $.ajax({
        url: "{{url('')}}/get_info_usuario_by_codigo",
        type: "POST",
        data:{
             codigo_usuario:""+codigo_usuario,             
             _token: "{{ csrf_token() }}"
        }
      });  

      request.done(function(obj) { 
         if(obj.status=="ok"){
            var obj_data=obj.datos;            
            for(var i=0;i<obj_data.length;i++){
              $("#nombre_modal").html("@"+codigo_usuario);
              $("#NombreCompleto_m").html(""+obj_data[i].NombrePersona+" "+obj_data[i].ApellidosPersona);
              $("#EmailPersona_m").html(""+obj_data[i].EmailPersona);
              $("#TelefonoPersona_m").html(""+obj_data[i].TelefonoPersona);
              $("#WhatsappPersona_m").html(""+obj_data[i].WhatsappPersona);
              
            }
            $("#modal_info_persona").modal("show");
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