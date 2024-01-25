@extends('areacurso.plantillas.plantilla-area-interna')
@section('contenido')   

@if(session('rol_login')=="4")
    
       <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3>{{$cant_cursos}}</h3>

                <p>Cursos</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="{{url('')}}/listado-cursos" class="small-box-footer">Ver Cursos <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3>{{$cant_usuarios_inscritos}}</h3>

                <p>Usuario Inscritos</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="{{url('')}}/listado-usuarios" class="small-box-footer">Ver Usuarios <i class="fa fa-arrow-circle-right" aria-hidden="true"></i></a>
            </div>
          </div>
          <!-- ./col -->
          
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3>{{$cant_usuarios_afiliados}}</h3>

                <p>Afiliados</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              <a href="{{url('')}}/listado-usuarios/afiliados" class="small-box-footer">Ver Afiliados <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
        </div>


      <div class="row">

        

         <div class="col-md-12">
           

             <!-- solid sales graph -->
            <div class="card">
              <div class="card-header border-0">
                <h3 class="card-title">
                  <i class="fa fa-th mr-1"></i>
                  Ventas
                </h3>



                <div class="card-tools">
                  <button type="button" class="btn bg-info btn-sm" data-card-widget="collapse">
                    <i class="fa fa-minus"></i>
                  </button>
                  
                </div>
              </div>
              <div class="card-body" style="widows: 100%;">

                <form id="form_fecha_ventas">
                  
                  <div class="row">
                    <div class="col-md-2">
                        
                        <div class="form-group  input-group-sm">                        
                           <label>Fecha Inicio</label>
                           <input id="fecha_inicio" type="date"  class="form-control" value="{{date("Y-m-d", strtotime('monday this week'))}}">
                        </div>

                    </div>

                    <div class="col-md-2">
                        
                        <div class="form-group  input-group-sm">                        
                           <label>Fecha Fin</label>
                           <input id="fecha_fin" type="date"  class="form-control" value="{{date("Y-m-d", strtotime('sunday this week'))}}">
                        </div>

                    </div>

                    <div class="col-md-2">
                      <div class="form-group  input-group-sm">                        
                        <button type="submit" class="btn btn-info" style="margin-top: 25px;" id="btn_filtrar">FILTRAR</button>
                      </div>
                    </div>
                  </div>
                  


                </form>

                <canvas  id="line-chart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>

              </div>
              <div class="card-footer" style="text-align: right;">
                <h2>Ventas $0</h2>
              </div>
              <!-- /.card-body -->
              
              <!-- /.card-footer -->
            </div>
            <!-- /.card -->


         </div>


         <div class="col-md-12">

          <h2>Marketing</h2>
          
          <h4>Landing:</h4>
          <a href="{{url('')}}/curso-de-afiliados" target="_blank">{{url('')}}/curso-de-afiliados</a>

          <h4>Gracias:</h4>
          <a href="{{url('')}}/gracias-curso-de-afiliados"  target="_blank">{{url('')}}/gracias-curso-de-afiliados</a>

          <h4>Lecciones:</h4>
          <a href="{{url('')}}/lecciones"  target="_blank">{{url('')}}/lecciones</a>

          <h4>Lección 1:</h4>
          <a href="{{url('')}}/leccion/lc-1"  target="_blank">{{url('')}}/leccion/lc-1</a>

          <h4>Lección 2:</h4>
          <a href="{{url('')}}/leccion/lc-2"  target="_blank">{{url('')}}/leccion/lc-2</a>

          <h4>Lección 3:</h4>
          <a href="{{url('')}}/leccion/lc-3"  target="_blank">{{url('')}}/leccion/lc-3</a>

          <h4>Lección 4:</h4>
          <a href="{{url('')}}/leccion/lc-4"  target="_blank">{{url('')}}/leccion/lc-4</a>
                      
          

        </div>

      </div>
    
@endif

@stop

@section('scripts')    

  <script src="{{url('')}}/assets-interno/plugins/jquery-ui/jquery-ui.min.js"></script>  
  <script src="{{url('')}}/assets-interno/plugins/chart.js/Chart.min.js"></script>

  <script type="text/javascript">

var salesGraphChartCanvas = $('#line-chart').get(0).getContext('2d');
    $(function () {

    
  // Sales graph chart
  
  //$('#revenue-chart').get(0).getContext('2d');

  filtrar_ventas();

});


$("#btn_probar_angel").click(function(e){
  e.preventDefault();

  var request = $.ajax({
        url: "{{url('')}}/surbir_vimeo_media",
        type: "POST",
        data:{  
              IdItem:"421",
              IdTipo:"1",
             _token: "{{ csrf_token() }}"
        }
      });

      request.done(function(obj) { 
        console.log(obj);
         if(obj.status=="ok"){

            
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


$("#form_fecha_ventas").submit(function(e){
   e.preventDefault();
   filtrar_ventas();
});
    
function filtrar_ventas(){
    var fecha_inicio=$("#fecha_inicio").val();
    var fecha_fin=$("#fecha_fin").val();
    

    

    
    var request = $.ajax({
        url: "{{url('')}}/get_ventas_principal",
        type: "POST",
        data:{                                                     
             fechainicio:fecha_inicio,
             fechafin:fecha_fin,             
             idusuario:"",
             tipo_reporte:"reporte-venta",
             id_estado_pedido:"3",
             _token: "{{ csrf_token() }}"
        }
      });

      request.done(function(obj) { 
         if(obj.status=="ok"){
            obj_data=obj.datos;
            var cadena_tabla="";
            var total_ganancias=0;


            var arra_labels=new Array();
            var arra_precios=new Array();
            for(var i=0;i<obj_data.length;i++){
              
              arra_labels.push(obj_data[i].FechaCreacion);
              arra_precios.push(obj_data[i].PrecioCurso);

              total_ganancias+=parseFloat(obj_data[i].PrecioCurso);
                
            }          

            /*
            
            var arra_labels=['2011 Q1', '2011 Q2', '2011 Q3', '2011 Q4', '2012 Q1', '2012 Q2', '2012 Q3', '2012 Q4', '2013 Q1', '2013 Q2'];
            var arra_precios=[2666, 2778, 4912, 3767, 6810, 5670, 4820, 15073, 10687, 8432];
          
            */
            
            armar_grafica(arra_labels, arra_precios);  
            
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


function armar_grafica(arra_labels, arra_precios){
   var salesGraphChartData = {
    labels  :   arra_labels,
    datasets: [
      {
        label               : 'Ventas ',
        fill                : false,
        borderWidth         : 2,
        lineTension         : 0,
        spanGaps : true,
        borderColor         : 'red',
        pointRadius         : 3,
        pointHoverRadius    : 7,
        pointColor          : '#0B5586',
        pointBackgroundColor: '#0B5586',
        data                : arra_precios
      }
    ]
  }

  var salesGraphChartOptions = {
    maintainAspectRatio : false,
    responsive : true,
    legend: {
      display: false,
    },
    scales: {
      xAxes: [{
        ticks : {
          fontColor: '#0B5586',
        },
        gridLines : {
          display : false,
          color: '#0B5586',
          drawBorder: false,
        }
      }],
      yAxes: [{
        ticks : {
          stepSize: 5000,
          fontColor: '#0B5586',
        },
        gridLines : {
          display : true,
          color: '#0B5586',
          drawBorder: false,
        }
      }]
    }
  }

  // This will get the first returned node in the jQuery collection.
  var salesGraphChart = new Chart(salesGraphChartCanvas, { 
      type: 'line', 
      data: salesGraphChartData, 
      options: salesGraphChartOptions
    }
  );

}


  </script>
@stop