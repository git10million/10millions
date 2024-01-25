@extends('areacurso.plantillas.plantilla-area-interna')
@section('contenido')   

<div class="row row-docttus">
      <div class="col-md-12">
         <h1 style="font-weight: 600; font-size: 20px;">Hola {{$data[0]->NombrePersona}}, Está es tu billetera 10 Million$ Club</h1>
         <p>Acá podrás ver los saldos pendientes y disponibles para que disfrutes por hacer un buen trabajo</p>
         
        <hr>
      </div>
</div>

<div class="row row-docttus">
      <div class="col-md-8">      

        <div class="row row-docttus" style="">                        

          <div class="col-md-12" style="position: relative; margin-top: 25px;">
              <div class="card-docttus card-docttus-left" style=" height: 200px !important; text-align: center;">
                  <br/><br/>
                  <h4>Total Ganancias</h4>
                  <h1>${{$info_billetera[0]->TotalGanancia}}</h1>                  
              </div>
            </div>            

            <div class="col-md-6" style="position: relative; margin-top: 25px;">
              <div class="card-docttus card-docttus-left" style=" height: 200px !important; text-align: center;">
                  <br/><br/>
                  <h4>Saldo Disponible</h4>
                  <h1>${{$info_billetera[0]->SaldoDisponible}}</h1>                  
              </div>
            </div>            

            <div class="col-md-6" style="position: relative; margin-top: 25px;">
              <div class="card-docttus card-docttus-left" style=" height: 200px !important; text-align: center;">
                  <br/>

                  <h4>Saldo en Canje</h4>
                  <h1>${{$info_billetera[0]->SaldoCanje}}</h1>
                  @if($data[0]->IdEstadoSolicitudAfiliado=="1" || $data[0]->IdEstadoSolicitudTutor=="1")
                  <a href="{{url('')}}/listado-usuario-canje" type="button" class="btn btn-secondary botones-docttus">Ver Ventas Canje</a>                
                  @endif
              </div>
            </div>            
        </div>



        <div class="row row-docttus" style="">                        

            <div class="col-md-6" style="position: relative; margin-top: 25px;">
              <div class="card-docttus card-docttus-left" style=" height: 250px !important; text-align: center;">
                <h2 style="margin:0px; padding: 0px; margin-bottom: 5px;">Retirar Dinero</h2>
                <small>Retiro Mínimo: $20 USD</small>
                <br/>                               
                <br/>               
                <input type="number" name="" class="form-control" style="text-align: center; width: 120px;display: inline-block;" value="0" id="valor_retiro">                
                <center>
                  @if($data[0]->IdEstadoSolicitudAfiliado=="1" || $data[0]->IdEstadoSolicitudTutor=="1")
                  <a href="#" type="button" class="btn btn-secondary botones-docttus" id="btn_retirar" style="margin-top: 25px;">Retirar Dinero</a>
                  @endif                  
                </center>                
              </div>
            </div>

            <div class="col-md-6" style="position: relative; margin-top: 25px;">
              <div class="card-docttus card-docttus-left" style=" height: 250px !important; text-align: left;">
                <center>
                  <h2>Datos Financieros</h2>  
                </center>
                <br/>               
                <strong>Cuenta Paypal: </strong>{{($data[0]->PaypalPersona)?$data[0]->PaypalPersona:''}}
                <br/>               
                <strong>Cuenta Bancaria: </strong>{{($data[0]->NombreBancoPersona)?$data[0]->NombreBancoPersona:''}}
                <br/>               
                <strong>Cuenta Payoneer: </strong>{{($data[0]->PayoneerPersona)?$data[0]->PayoneerPersona:''}}
                <br/>               
                <br/>               
                <center>
                  @if($data[0]->IdEstadoSolicitudAfiliado=="1" || $data[0]->IdEstadoSolicitudTutor=="1")
                  <a href="{{url('')}}/usuario" type="button" class="btn btn-secondary botones-docttus">Editar Datos</a>                  
                  @endif
                </center>          
              </div>
            </div> 


        </div>

      </div>

      <div class="col-md-4" style="margin-top: 25px;">
        
        <div class="card-docttus card-docttus-left" style=" height: auto !important; text-align: center;">
          <h2>Retiros</h2>
          <br/>
          <table class="table table-striped table-bordered">
              <thead class="thead-dark">
                 <tr>
                    <th>ID</th>
                    <th>Fecha</th>
                    <th>Valor</th>
                    <th>Estado</th>                    
                  </tr>
              </thead>

              <tbody id="listado_retiros">
                @foreach($info_retiros as $retiros)
                <tr style="font-size: 12px;">
                  <td>{{$retiros->IdRetiros}}</td>
                  <td>{{$retiros->FechaCreacion}}</td>
                  <td>{{$retiros->ValorRetiro}}</td>
                  @if($retiros->IdEstadoRetiro==1)
                  <td>Pendiente</td>                    
                  @elseif($retiros->IdEstadoRetiro==2)
                  <td>Pagado</td>
                  @elseif($retiros->IdEstadoRetiro==3)
                  <td>Rechazado</td>
                  @endif

                </tr>
                @endforeach
              </tbody>             
            </table>            
        </div>
      </div>
</div>

        


@stop

@section('scripts')

    
<script type="text/javascript">
  var valor_dispo="{{$info_billetera[0]->SaldoDisponible}}";

  $("#btn_retirar").click(function(e){
      e.preventDefault();
      var valor_retiro_n=parseFloat(valor_dispo);
      var valor_retiro=parseFloat($("#valor_retiro").val());

      if(valor_retiro>valor_retiro_n){
          mensaje_generico("Error !","El valor de retiro es mayor al saldo disponible","2","Continuar...",function(){});          
          return;
      }

      if(valor_retiro<20){
          mensaje_generico("Error !","El valor del retiro debe ser mayor a 20","2","Continuar...",function(){});          
          return; 
      }


       var request = $.ajax({
          url: "{{url('')}}/set_retiro",
          type: "POST",
          data:{               
               valorretiro:""+valor_retiro,               
               _token: "{{ csrf_token() }}"
          }
        });

        request.done(function(obj) { 
           if(obj.status=="ok"){            
             mensaje_generico("Muy Bien !","El retiro se estará procesando en 24 a 48 Horas","1","Continuar...",function(){
                location.reload();
             });
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


  });
</script>
@stop