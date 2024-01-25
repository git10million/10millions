@extends('areacurso.plantillas.plantilla-area-interna')

@section('cabecera')
    <style>
        .card-docttus-list{
            height: 100%;
        }
        .boton-redes{
            width: 35px;
            height: 35px;
            border-radius: 25px;
            font-size: 20px;
            margin-right: 3px;
            color:#fff;
        }    

        .card-ayuda{
            cursor: pointer;
            transition: transform .1s; 
        }
        .card-ayuda:hover{
            transform: scale(1.05);
        }

        .alto-card{
            min-height: 166px;
        }

        .btn-fb{
            background-color: #3b5998;            
        }    

        .btn-yt{
            background-color: #FF0000;            
        }  
        .btn-tw{
            background-color:#00acee;
        }  
        .btn-ig{
            background-color:#f2003c;
        }
        .btn-lk{
            background-color:#0072b1;
        }
        .btn-wb{
            background-color:#3d9970;
        }

        .item-habilidad{
            width: 100%;
            height: 130px;
            background-color:#E5E0E6;
            border:8px solid #D7D2D8;
            border-radius: 10px;
            margin-bottom: 15px;
        }

        .btn-prev{
            position: absolute;
            left: 0px;
            top: 50px;
            background-color: #ffffffa8;
            width: 31px;
            text-align: center;
            height: 31px;
            padding-top: 5px;
            margin-left: 4px;
            border-radius: 25px;
            color: #a2a2a2;
        }

        .btn-next{
            position: absolute;
            right: 0px;
            top: 50px;
            background-color: #ffffffa8;
            width: 31px;
            text-align: center;
            height: 31px;
            padding-top: 5px;
            margin-right: 4px;
            border-radius: 25px;
            color: #a2a2a2;
        }

        .titulo-backoffice{
            color:#929292;
            font-weight: 400;
            font-size: 20px;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;


        }

        #habilidades-carousel-m{
            display: none;
        }

        #cursos-sugeridos-m{
            display: none;
        }

        @media only screen and (max-width: 991px) {
            #habilidades-carousel{
                display: none;
            }
            #habilidades-carousel-m{
                display: block;
            }

            #cursos-sugeridos{
                display: none;
            }

            #cursos-sugeridos-m{
                display: block;
            }

        }

    </style>
@endsection


@section('contenido')   

@php
    $mensaje_solicitud='';
    $boton_solicitud='';
    $color_solicitud='';
@endphp

@if($data[0]->IdEstadoSolicitudAfiliado!=1)

    @if($data[0]->IdEstadoSolicitudAfiliado==0 || $data[0]->IdEstadoSolicitudAfiliado=="")
        @php
            $mensaje_solicitud='<p style="font-size: 18px; margin:0px; padding:0px;">Debes enviar una solicitud para ser aprobado en el programa de Afiliados Docttus <br > <small>La solucitud puede demorar entre 24 a 48 Horas</small></p>';
            //$boton_solicitud='<a href="'.url('').'/ganar-dinero/afiliado" class="btn btn-secondary botones-docttus" style="text-decoration: none;">Solicitar Ingreso</a>';
            $boton_solicitud='';
            $color_solicitud='warning';
        @endphp

    @elseif($data[0]->IdEstadoSolicitudAfiliado==2)
        @php
            $mensaje_solicitud='<p style="font-size: 18px; margin:0px; padding:0px;">Aún estamos procesando tu solicitud para ser un afiliado Docttus <br > <small>Este proceso puede demorar entre 24 a 48 Horas, si sobre pasa este tiempo, envía un mensaje a soporte@docttus.com</small></p>';
            $boton_solicitud='';
            $color_solicitud='info';
        @endphp
    @endif
        
    
    
    <div class="row" style="margin-top: 25px; margin-bottom:25px;">            
        <div class="col-md-12">
            <div class="alert alert-{{$color_solicitud}}" role="alert">
                <div class="row">
                    <div class="col-md-10">                    
                        
                        {!!  $mensaje_solicitud !!}        
                        
                    </div>
                    <div class="col-md-2">
                        {!! $boton_solicitud !!}
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if($data[0]->IdEstadoSolicitudAfiliado==0 || $data[0]->IdEstadoSolicitudAfiliado=="")

    <div class="row">
        <div class="col-md-12">
            <h2 class="titulo-backoffice" style="font-size: 35px; font-weight:400; text-align:center; margin-bottom:45px;">Formulario de Aprobación</h2>
        </div>
    </div>

    <form action="/" id="formularioaprobacion">

      


        <div class="row">
            <!-- PANEL IZQUIERDO -->
            
            <div class="col-md-12"> 
                <!-- FILA 1 -->
                <div class="row">            
                    <div class="col-md-6 offset-md-3">
                        @foreach ($arra_formulario as $itemEvaluacion)
                            @php
                                $contador_pre=0;
                            @endphp
                            @foreach ($itemEvaluacion->preguntas as $itemPregunta)
                                @php
                                    $contador_pre++;
                                @endphp
                                <div class="card-docttus preguntas_form" style="margin-bottom: 15px;" id="preguntas_form_{{$itemPregunta->IdPregunta}}" id-pregunta="{{$itemPregunta->IdPregunta}}"  tipo-pregunta="{{$itemPregunta->IdTipoPregunta}}" aplica-otros="{{$itemPregunta->AplicaOtros}}">
                                    <div class="row">  
                                        <div class="col-md-12">
                                            <h3 style="font-size: 21px;font-weight: 700;">{{$contador_pre}}. {!!$itemPregunta->NombrePregunta!!}</h3>

                                            @if($itemPregunta->IdTipoPregunta=="1")
                                                <ul  class="list-group">
                                                    @foreach ($itemPregunta->respuestas as $itemRespuesta)
                                                        <li  class="list-group-item">
                                                        <input type="radio" value="{{$itemRespuesta->IdRespuesta}}" required name="preg_{{$itemPregunta->IdPregunta}}"> {{$itemRespuesta->NombreRespuesta}}
                                                        </li>
                                                    @endforeach                                        

                                                    @if($itemPregunta->AplicaOtros=="1")
                                                        <li  class="list-group-item">
                                                            <input type="radio" value="otro" name="preg_{{$itemPregunta->IdPregunta}}"> Otro
                                                        </li>
                                                    @endif

                                                </ul>
                                            @endif

                                            @if($itemPregunta->IdTipoPregunta=="2")
                                                <ul  class="list-group">
                                                    @foreach ($itemPregunta->respuestas as $itemRespuesta)
                                                        <li  class="list-group-item">
                                                        <input type="checkbox" value="{{$itemRespuesta->IdRespuesta}}"  name="preg_{{$itemPregunta->IdPregunta}}"> {{$itemRespuesta->NombreRespuesta}}
                                                        </li>
                                                    @endforeach                                        

                                                    @if($itemPregunta->AplicaOtros=="1")
                                                        <li  class="list-group-item">
                                                            <input type="checkbox" value="otro" name="preg_{{$itemPregunta->IdPregunta}}"> Otro
                                                        </li>
                                                    @endif

                                                </ul>
                                            @endif

                                            @if($itemPregunta->IdTipoPregunta=="3")
                                                Rta: <input type="text" class="form-control" required id="respuesta_{{$itemPregunta->IdPregunta}}">
                                            @endif

                                            @if($itemPregunta->AplicaOtros=="1")
                                                Cuál: <input type="text" class="form-control" placeholder="Si, seleccionaste Otros, escribe aquí" id="cual_{{$itemPregunta->IdPregunta}}">
                                            @endif

                                            

                                        </div>
                                    </div>
                                
                                </div>
                            @endforeach

                            <div class="card-docttus preguntas_form" style="margin-bottom: 15px;">
                                <input type="submit" class="btn btn-warning" value="Enviar Solicitud" id="btn_enviar_formulario" >
                            </div>

                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </form>

    @endif
                        
    <br />


@endif

@if($data[0]->IdEstadoSolicitudAfiliado==1 || $data[0]->IdEstadoSolicitudAfiliado==2)
<!-- <div class="row">
    <div class="col-md-12">
        <h2 class="titulo-backoffice" style="font-size: 28px; font-weight:400;">Panel de Afiliado</h2>
    </div>
</div>-->

<div class="row">
    <!-- PANEL IZQUIERDO -->

    
    
    <div class="col-md-9"> 

        <div class="row">            
            <div class="col-md-12">
                <div class="card-docttus" style="margin-bottom: 25px; height:auto !important; background-color:#9dbed4; ">
                    <h4 style="color:#0b5586; margin:0px; padding:0px; font-weight:600;">Conferencia: IMPUESTOS PARA EMPRENDEDORES DIGITALES</h4>
                    <small style="color:#0b5586; font-size: 15px;">07 de Mayo de 2021 - 08:00 P.M Hora Colombia</small>
    
                    <a class="btn btn-default btn-evento" href="{{url('')}}/evento-docttus/conferencia-impuestos-para-emprendedores-digitales" >
                        Ir al Evento
                    </a>
    
                </div>
            </div>
        </div>

        <!-- FILA 1 -->
        <div class="row">            
            <div class="col-md-4">
                <div class="card-docttus alto-card">
                    <div class="row">                        
                        <div class="col-12">
                            <h2 class="card-titulo" style="font-size: 22px;">Total Ventas</h2>
                        </div>
                        
                        <div class="col-6">
                            <h3>$ {{$info_billetera[0]->TotalGanancia}}</h3>
                            @if($data[0]->IdEstadoSolicitudAfiliado==1)
                            <a href="{{url('')}}/listado-ventas" class="cursos-nuevos" style="background-color:orange; color:#fff; padding:5px 10px; border-radius:15px; font-size:14px; margin-top:10px; display:inline-block;">
                                Ver Más
                            </a>
                            @else
                            <a href="#" class="cursos-nuevos" style="background-color:gray; color:#fff; padding:5px 10px; border-radius:15px; font-size:14px; margin-top:10px; display:inline-block;">
                                Ver Más
                            </a>
                            @endif
                            <!-- Consultar productos finalizados -->
                        </div>

                        <div class="col-6">
                            <img src="{{url('')}}/assets-marketing/images/icono-interno-3.png" class="pull-right" style="width:100px;">
                        </div>
                        

                        
                    </div>
                </div>                
            </div>


            <div class="col-md-4">
                <div class="card-docttus alto-card">
                    <div class="row">                        
                        <div class="col-12">
                            <h2 class="card-titulo" style="font-size: 22px;">Saldo Disponible</h2>
                        </div>
                        
                        <div class="col-6">
                            <h3>$ {{$info_billetera[0]->SaldoDisponible}}</h3>
                            @if($data[0]->IdEstadoSolicitudAfiliado==1)
                            <a href="{{url('')}}/billetera"  class="cursos-nuevos" style="background-color:#c083fa; color:#fff; padding:5px 10px; border-radius:15px; font-size:14px; margin-top:10px; display:inline-block;">
                                Retirar
                            </a>
                            @else
                            <a href="#" class="cursos-nuevos" style="background-color:gray; color:#fff; padding:5px 10px; border-radius:15px; font-size:14px; margin-top:10px; display:inline-block;">
                                Retirar
                            </a>
                            @endif
                            <!-- Consultar productos finalizados -->
                        </div>

                        <div class="col-6">
                            <img src="{{url('')}}/assets-marketing/images/icono-interno-4.png" class="pull-right" style="width:100px;">
                        </div>
                        

                        
                    </div>
                </div>                
            </div>


            <div class="col-md-4">
                <div class="card-docttus alto-card">
                    <div class="row">                        
                        <div class="col-12">
                            <h2 class="card-titulo" style="font-size: 22px;">Saldo En Canje</h2>
                        </div>
                        
                        <div class="col-6">
                            <h3>$ {{$info_billetera[0]->SaldoCanje}}</h3>
                            @if($data[0]->IdEstadoSolicitudAfiliado==1)
                            <a href="{{url('')}}/listado-ventas/canje"  class="cursos-nuevos" style="background-color:#00BCD4; color:#fff; padding:5px 10px; border-radius:15px; font-size:14px; margin-top:10px; display:inline-block;">
                                Ver Más
                            </a>
                            @else
                            <a href="#" class="cursos-nuevos" style="background-color:gray; color:#fff; padding:5px 10px; border-radius:15px; font-size:14px; margin-top:10px; display:inline-block;">
                                Ver Más
                            </a>
                            @endif
                            <!-- Consultar productos finalizados -->
                        </div>

                        <div class="col-6">
                            <img src="{{url('')}}/assets-marketing/images/icono-interno-5.png" class="pull-right" style="width:100px;">
                        </div>
                        

                        
                    </div>
                </div>                
            </div>



                       


           


        </div>


    @if($data[0]->IdEstadoSolicitudAfiliado==1)
        <div class="row" style="margin-top: 25px;">            
            <div class="col-md-12">
                <div class="card-docttus" style="padding-top:20px; padding-bottom:20px;">
                    <div class="row">                        
                        <div class="col-9">

                            <h3 style="font-size: 23px; margin:0px; padding:0px;">
                                <i class="fa fa-book" aria-hidden="true" style="color: #5e6671; margin-right:15px;"></i>
                                Promocionar Productos
                            </h3>
                            

                        </div>

                        <div class="col-3" style="text-align: right;">

                        <a href="{{url('')}}/cursos/mercado" class="cursos-nuevos" style="background-color:#FF5722; color:#fff; padding:5px 10px; border-radius:15px; font-size:14px; display:inline-block;">
                                Promocionar Cursos
                            </a>

                        </div>


                    </div>
                </div>
            </div>
        </div>
    @endif

        <!-- FIN FILA 1 -->

        <div class="row" style="margin-top: 25px; ">
            <div class="col-md-6">
                <h2 class="titulo-backoffice">Analíticas</h2>
            </div>

            <div class="col-md-6">
                <!--<h2 class="titulo-backoffice pull-right" style="font-size: 20px;  font-weight:bold;">Ver Todas</h2>-->
            </div>
        </div>

        <div class="row" style="margin-top: 25px; ">
            <div class="col-md-4">
                <div class="card-docttus alto-card">
                    <h4 style="margin:0px;">0</h4>
                    <small>Usuarios esta semana</small>

                    <div id="bar-chart" style="height: 200px;"></div>

                </div>
            </div>


            <div class="col-md-4">
                <div class="card-docttus alto-card">
                    <h4 style="margin:0px;">0</h4>
                    <small>Visitas esta semana</small>

                    <div id="line-chart-visitas" style="height: 200px;"></div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card-docttus alto-card">
                    <h4 style="margin:0px;">0</h4>
                    <small>Ventas esta semana</small>

                    <div id="line-chart-ventas" style="height: 200px;"></div>
                </div>
            </div>

        </div>





        <div class="row" style="margin-top: 25px; ">
            
            <div class="col-md-12">
                <div class="card-docttus alto-card">
                    <h4 style="margin:0px;">0</h4>
                    <small>Ventas en el año - 2021</small>
                    <div id="line-chart-ventas-years" style="height: 350px;"></div>
                </div>
            </div>

        </div>


   
   



         <!-- fila de ayuda -->

        <!--
            
            <div class="row" style="margin-top: 25px; ">
            <div class="col-12">
                <h2 class="titulo-backoffice">Seleccione un tema de ayuda</h2>
            </div>            
        </div>

        <div class="row" style="margin-top:25px;">
           
            @foreach($ayudas as $ayuda)

                @if($ayuda->IdTipoAyuda=="1")
            
                <div class="col-md-4" style="margin-bottom: 15px; height:253px;">
                    
                    <div class="card-docttus card-docttus-list card-ayuda" style="text-align:center; padding-bottom:25px;" onclick="abrir_ayuda({{$ayuda->IdAyuda}})">
                        <div style="text-align: center; display:inline-block; padding:15px 10px; background-color: #FFECED; width: 85px; height: 70px; border-radius:9px; margin-bottom:25px;">
                            <i style="font-size: 35px;" class="fa {{$ayuda->IconoAyuda}}" aria-hidden="true"></i>
                        </div>
                        <h5>{{$ayuda->NombreAyuda}}</h5>
                        <p>{{$ayuda->DescripcionCorta}}</p>
                    </div>
                    
                </div>
                
                @endif
            

            @endforeach
            
            

            
        </div>-->



        <div class="row" style="margin-top: 25px; ">
            <div class="col-12">
                <h2 class="titulo-backoffice">Preguntas Frecuentes</h2>
            </div>            
        </div>

        <div class="row" style="margin-top:25px;">
           
            @foreach($ayudas as $ayuda)

                @if($ayuda->IdTipoAyuda=="2")
            
                <div class="col-md-4" style="margin-bottom: 15px; height:123px;">
                    
                    <div class="card-docttus  card-ayuda" style="text-align:center; height:110px; " onclick="abrir_ayuda({{$ayuda->IdAyuda}})">                        
                        <h5>{{$ayuda->NombreAyuda}}</h5>                        
                    </div>
                    
                </div>
                
                @endif
            

            @endforeach
            
            

            
        </div>


    </div>
    






    <!-- FIN PANEL IZQUIERDO -->


    

    <!-- PANEL DERECHO -->

    <div class="col-md-3">
        <!-- FILA EDICIÓN -->
        <div class="card-docttus" style="text-align: center;">
            
            <div class="image">
                <img src="{{url('')}}/assets/images/usuarios/{{$data[0]->FotoPersona}}" class="img-circle elevation-2" alt="User Image" style="width: 130px;">
            </div>

            <h3 style="font-size:18px; font-weight:bold; margin-top:25px;">{{$data[0]->NombrePersona}}</h3>
            <h5 style="font-size:15px;">Tutor Docttus</h5>
            
            <div class="row" style="margin-bottom: 25px; margin-top:25px;">
                <div class="col">
                    @if($data[0]->FacebookPersona)
                        <a target="_blank" href="{{$data[0]->FacebookPersona}}" class="btn btn-default btn-xs boton-redes btn-fb"><i class="fa fa-facebook"></i></a>
                    @endif

                    @if($data[0]->YoutubePersona)
                        <a target="_blank" href="{{$data[0]->YoutubePersona}}" class="btn btn-default btn-xs boton-redes btn-yt"><i class="fa fa-youtube"></i></a>
                    @endif

                    @if($data[0]->TwitterPersona)
                        <a target="_blank" href="{{$data[0]->TwitterPersona}}" class="btn btn-default btn-xs boton-redes btn-tw"><i class="fa fa-twitter"></i></a>
                    @endif

                    @if($data[0]->InstagramPersona)
                        <a target="_blank" href="{{$data[0]->InstagramPersona}}" class="btn btn-default btn-xs boton-redes btn-ig"><i class="fa fa-instagram"></i></a>
                    @endif

                    @if($data[0]->LinkedinPersona)
                        <a target="_blank" href="{{$data[0]->LinkedinPersona}}" class="btn btn-default btn-xs boton-redes btn-lk"><i class="fa fa-linkedin"></i></a>
                    @endif

                    @if($data[0]->WebPersona)
                        <a target="_blank" href="{{$data[0]->WebPersona}}" class="btn btn-default btn-xs boton-redes btn-wb"><i class="fa fa-link"></i></a>
                    @endif
                    
                    
                    
                </div>
            </div>
            
            
            <a href="{{url('')}}/usuario" class="btn btn-secondary botones-docttus">Editar Perfíl</a>            
        </div>
        <!-- FIN FILA EDICIÓN -->
        
        
        

        

        <div class="card-docttus" style="margin-top: 25px;">
            <div class="row">
                <div class="col-12"  style="text-align: left;">
                    <h2 class="card-titulo" style="font-size: 15px;">Top Venta Paises</h2>                    
                </div>
            </div>

            <div class="row" style="margin-top: 15px;">
                <div class="col-12">

                    <ul class="list-group">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Colombia
                            <span class="badge badge-primary badge-pill">0</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Perú
                            <span class="badge badge-primary badge-pill">0</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Ecuador
                            <span class="badge badge-primary badge-pill">0</span>
                        </li>

                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            México
                            <span class="badge badge-primary badge-pill">0</span>
                        </li>

                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Argentina
                            <span class="badge badge-primary badge-pill">0</span>
                        </li>

                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Chile
                            <span class="badge badge-primary badge-pill">0</span>
                        </li>
                    </ul>

                </div>
            </div>

        </div>


        

    </div>

    <!-- fiN PANEL DERECHO -->

    
    
    


</div>
@endif
@stop   

@section('scripts')
<script  type="text/javascript">

$(function(){


    

    

    var bar_data = {
      data : [[1,0], [2,0], [3,0], [4,0], [5,0], [6,0], [7,0]],
      bars: { show: true }
    }
    $.plot('#bar-chart', [bar_data], {
      grid  : {
        borderWidth: 1,
        borderColor: '#f3f3f3',
        tickColor  : '#f3f3f3'
      },
      series: {
         bars: {
          show: true, barWidth: 0.5, align: 'center',
        },
      },
      colors: ['#3c8dbc'],
      xaxis : {
        ticks: [[1,'L'], [2,'M'], [3,'X'], [4,'J'], [5,'V'], [6,'S'], [7,'D']]
      }
    });






    //LINEAS VISITAS
    var data_visitas = {
      data : [[1,0], [2,0], [3,0], [4,0], [5,0], [6,0], [7,0]],
      color: '#4caf50'
    }
   
    $.plot('#line-chart-visitas', [data_visitas], {
      grid  : {
        hoverable  : true,
        borderColor: '#f3f3f3',
        borderWidth: 1,
        tickColor  : '#f3f3f3'
      },
      series: {
        shadowSize: 0,
        lines     : {
          show: true,
          lineWidth: 2
          
        },
        points    : {
          show: true
        }
      },
      line : {
        fill : false,        
        color: '#f56954'
      },
      yaxis : {
        show: true
      },
      xaxis : {
        show: true,
        ticks: [[1,'L'], [2,'M'], [3,'X'], [4,'J'], [5,'V'], [6,'S'], [7,'D']]
      }
    })
    //Initialize tooltip on hover
    $('<div class="tooltip-inner" id="line-chart-tooltip"></div>').css({
      position: 'absolute',
      display : 'none',
      opacity : 0.8
    }).appendTo('body')
    $('#line-chart-visitas').bind('plothover', function (event, pos, item) {

      if (item) {
        var x = item.datapoint[0].toFixed(0),
            y = item.datapoint[1].toFixed(0)

        var dia="";
        
        switch (x) {
            case "1":
                dia="Lunes";
                break;
        
            case "2":
                dia="Martes";
                break;

            case "3":
                dia="Miércoles";
                break;
            
            case "4":
                dia="Jueves";
                break;

            case "5":
                dia="Viernes";
                break;
            
            case "6":
                dia="Sábado";
                break;
            
            case "7":
                dia="Domingo";
                break;


            default:
            console.log("Prueba");
                
        }




        $('#line-chart-tooltip').html('' + dia + ':  ' + y + ' Visitas')
          .css({
            top : item.pageY + 5,
            left: item.pageX + 5
          })
          .fadeIn(200)
      } else {
        $('#line-chart-tooltip').hide()
      }

    });



    
    //LINEAS
    var data_ventas = {
      data : [[1,0], [2,0], [3,0], [4,0], [5,0], [6,0], [7,0]],
      color: '#FF5722'
    }
   
    $.plot('#line-chart-ventas', [data_ventas], {
      grid  : {
        hoverable  : true,
        borderColor: '#f3f3f3',
        borderWidth: 1,
        tickColor  : '#f3f3f3'
      },
      series: {
        shadowSize: 0,
        lines     : {
          show: true,
          lineWidth: 2
        },
        points    : {
          show: true
        }
      },
      lines : {
        fill : false,
        color: ['#ed2a26']
      },
      yaxis : {
        show: true
      },
      xaxis : {
        show: true,
        ticks: [[0,'L'], [0,'M'], [0,'X'], [0,'J'], [0,'V'], [0,'S'], [0,'D']]
      }
    })
    //Initialize tooltip on hover
    $('<div class="tooltip-inner" id="line-chart-tooltip-2"></div>').css({
      position: 'absolute',
      display : 'none',
      opacity : 0.8
    }).appendTo('body')
    $('#line-chart-ventas').bind('plothover', function (event, pos, item) {

      if (item) {
        var x = item.datapoint[0].toFixed(0),
            y = item.datapoint[1].toFixed(0)

        var dia="";
        
        switch (x) {
            case "1":
                dia="Lunes";
                break;
        
            case "2":
                dia="Martes";
                break;

            case "3":
                dia="Miércoles";
                break;
            
            case "4":
                dia="Jueves";
                break;

            case "5":
                dia="Viernes";
                break;
            
            case "6":
                dia="Sábado";
                break;
            
            case "7":
                dia="Domingo";
                break;


            default:
            console.log("Prueba");
                
        }




        $('#line-chart-tooltip-2').html('' + dia + ':  ' + y + ' Visitas')
          .css({
            top : item.pageY + 5,
            left: item.pageX + 5
          })
          .fadeIn(200)
      } else {
        $('#line-chart-tooltip-2').hide()
      }

    });





    //line-chart-ventas-years

     //LINEAS
     var data_ventas_y = {
      data : [[1,0], [2,0], [3,0], [4,0], [5,0], [6,0], [7,0], [8,0], [9,0], [10,0], [11,0], [12,0]],
      color: '#ec2a28'
    }
   
    $.plot('#line-chart-ventas-years', [data_ventas_y], {
      grid  : {
        hoverable  : true,
        borderColor: '#f3f3f3',
        borderWidth: 1,
        tickColor  : '#f3f3f3'
      },
      series: {
        shadowSize: 0,
        lines     : {
          show: true,
          lineWidth: 2
        },
        points    : {
          show: true
        }
      },
      lines : {
        fill : false,
        color: ['#ed2a26']
      },
      yaxis : {
        show: true
      },
      xaxis : {
        show: true,
        ticks: [[1,'Ene'], [2,'Feb'], [3,'Mar'], [4,'Abr'], [5,'May'], [6,'Jun'], [7,'Jul'], [8,'Ago'], [9,'Sep'], [10,'Oct'], [11,'Nov'], [12,'Dic']]
      }
    })
    //Initialize tooltip on hover
    $('<div class="tooltip-inner" id="line-chart-tooltip-3"></div>').css({
      position: 'absolute',
      display : 'none',
      opacity : 0.8
    }).appendTo('body')
    $('#line-chart-ventas-years').bind('plothover', function (event, pos, item) {

      if (item) {
        var x = item.datapoint[0].toFixed(0),
            y = item.datapoint[1].toFixed(0)

        var dia="";
        
        switch (x) {
            case "1":
                dia="Ene";
                break;
        
            case "2":
                dia="Feb";
                break;

            case "3":
                dia="Mar";
                break;
            
            case "4":
                dia="Abr";
                break;

            case "5":
                dia="May";
                break;
            
            case "6":
                dia="Jun";
                break;
            
            case "7":
                dia="Jul";
                break;

            case "8":
                dia="Ago";
                break;

            case "9":
                dia="Sep";
                break;

            case "10":
                dia="Oct";
                break;

            case "11":
                dia="Nov";
                break;

            case "12":
                dia="Dic";
                break;

            default:
            console.log("Prueba");
                
        }




        $('#line-chart-tooltip-3').html('' + dia + ':  $' + y + ' en Ventas')
          .css({
            top : item.pageY + 5,
            left: item.pageX + 5
          })
          .fadeIn(200)
      } else {
        $('#line-chart-tooltip-3').hide()
      }

    });





});


$("#formularioaprobacion").submit(function(e){
        e.preventDefault();        
        //console.log(arra_componentes);
        var cadena_formulario=get_cadena_formulario();

        $("#btn_enviar_formulario").prop("disabled",true);

        var request = $.ajax({
          url: "{{url('')}}/send_formulario",
          type: "POST",
          data:{               
               formulario:cadena_formulario,
               perfil:"3",
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
              $("#btn_enviar_formulario").prop("disabled",false);
              return;
           }
        });
         //respuesta si falla
        request.fail(function(jqXHR, textStatus) {
          alert( "Error de servidor  " + textStatus );
        });

        
    });



function get_cadena_formulario(){
        var arra_componentes=$(".preguntas_form");
        var cadena_respuesta="";
        for(var i=0;i<arra_componentes.length;i++){
            if($(arra_componentes[i]).attr("tipo-pregunta")){

               var id_pregunta=$(arra_componentes[i]).attr("id-pregunta");

               if($(arra_componentes[i]).attr("tipo-pregunta")=="1"){
                    if($('input:radio[name=preg_'+id_pregunta+']:checked').val()=="otro"){
                        cadena_respuesta+=""+id_pregunta+"::"+$('input:radio[name=preg_'+id_pregunta+']:checked').val()+"["+$("#cual_"+id_pregunta).val()+"]"+"@breaklinea@";
                    }else{
                        cadena_respuesta+=""+id_pregunta+"::"+$('input:radio[name=preg_'+id_pregunta+']:checked').val()+"@breaklinea@";
                    }
               }

               if($(arra_componentes[i]).attr("tipo-pregunta")=="2"){
                    var arra_checks=$('input:checkbox[name=preg_'+id_pregunta+']:checked');
                    var cadena_respu_check="";
                    var band_otro=0;
                    for(var j=0;j<arra_checks.length;j++){
                        cadena_respu_check+=""+$(arra_checks[j]).val()+"|||";
                        if($(arra_checks[j]).val()=="otro"){
                            band_otro=1;
                        }
                    }
                    cadena_respu_check=cadena_respu_check.slice(0,-3);

                    if(band_otro==1){
                        cadena_respu_check=cadena_respu_check+"["+$("#cual_"+id_pregunta).val()+"]";
                    }

                    cadena_respuesta+=""+id_pregunta+"::"+cadena_respu_check;
                    cadena_respuesta+="@breaklinea@";
               }


               if($(arra_componentes[i]).attr("tipo-pregunta")=="3"){
                    var respuesta=$("#respuesta_"+id_pregunta).val();
                    cadena_respuesta+=""+id_pregunta+"::"+respuesta+"@breaklinea@";
               }
            }            
        }

        cadena_respuesta=cadena_respuesta.slice(0,-12);

        return cadena_respuesta;

    }



</script>
@stop