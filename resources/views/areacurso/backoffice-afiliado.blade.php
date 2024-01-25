@extends('areacurso.plantillas.plantilla-area-interna')

@section('cabecera')
    <style>
        .boton-explora{
            width: 125px;
            height: 125px;
            padding-top: 20px;
            margin-right: 10px;
            margin-bottom: 10px;
        }
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

        .foto-patrocinador{
            width: 80px;
            height: 80px;
            background-color: #0B5586;
            border-radius: 45px;
            display: inline-block;
            background-position: center;
            background-size: cover;
            background-repeat: no-repeat;
        }

        .fondo-banner{
            background-image: url("assets/images/fondo-afiliados.jpg");
            padding-top:70px; padding-bottom:70px;
            background-size: cover;
            background-position: center;
            color:#fff;
        }

        .fondo-banner h1{
            color:#fff;
            font-size: 45px;
        }

        .titulo-card{
            color: #fff;
            background-color: #8A6D35;
            padding:5px;
            text-align: center;

            border-radius: 9px;
            font-size: 21px;

        }

        .listado-eventos{
            height: 350px;
            padding:5px;
            overflow-y: scroll;
        }

        .card-item-evento{
            cursor: pointer;
            margin-bottom: 10px;
            background-size: cover;
            background-position: center;
            color:#fff;

        }
        .card-item-evento span{
            color: #fff;
        }   

        .card-item-evento:hover{
            transform: scale(0.98);
            
        }


               

    </style>
@endsection


@section('contenido')   

@php
    $mensaje_solicitud='';
    $boton_solicitud='';
    $color_solicitud='';
@endphp




<!-- <div class="row">
    <div class="col-md-12">
        <h2 class="titulo-backoffice" style="font-size: 28px; font-weight:400;">Panel de Afiliado</h2>
    </div>
</div>-->


<div class="container-fluid">
    <div class="row">
        <!-- PANEL IZQUIERDO -->

        
        
        <div class="col-md-12"> 
            <!-- FILA 1 -->
            
                <div class="row">
                    <div class="col-md-12">
                        <div class="card-docttus fondo-banner">
                            <div class="row">                        
                                <div class="col-md-7">                    

                                </div>
                                <div class="col-md-5">
                                    <h1>Futuro Miembro de 10 Million$ Club</h1>                                    
                                    <p>Empieza a comercializar los productos de nuestra parrilla.</p>
                                    <h3>Tienes hasta el 22 de Marzo de 2024 para Registrarte, con nuestra promoción de $69 USD</h3>
                                    <a class="btn btn-lg" style="background-color:#8A6D35; color:#fff;" target="_blank" href="{{$datos_patrocinador[0]->URLHotmartCheckout}}" style="color: #fff;">
                                        Ser Parte de 10 Million$ Club
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row" style="margin-top:25px;">
                    <div class="col-md-6">
                        @if($data[0]->IdEstadoSolicitudAfiliado==1)
                        <div class="card-docttus">
                            <h2 class="titulo-card" >Explora</h2>

                            <div class="row" style="margin-top:15px;">
                                <div class="col-md-12 text-center">

                                    <a href="{{url('')}}/cursos/disponibles" class="btn btn-default boton-explora">
                                        <i class="fa fa-th" style="font-size: 35px;"></i><br />
                                        Ver <br /> Cursos
                                    </a>

                                    <a href="{{url('')}}/cursos/mercado" class="btn btn-default boton-explora">
                                        <i class="fa fa-th" style="font-size: 35px;"></i><br />
                                        Mercado <br /> Cursos 10 Million$
                                    </a>
                                    
                                    <a href="{{url('')}}/cursos/premium" class="btn btn-default boton-explora">
                                        <i class="fa fa-graduation-cap" style="font-size: 35px;"></i><br />
                                        Cursos Premium
                                    </a>

                                    

                                    <a href="{{url('')}}/funnels-pro10x" class="btn btn-default boton-explora">
                                        <i class="fa fa fa-crosshairs" style="font-size: 35px;"></i><br />
                                        Funnels <br /> Pro
                                    </a>


                                </div>                                
                            </div>

                        </div>
                        <br />
                        @endif


                        <div class="card-docttus">
                            <h2 class="titulo-card" >Tu Patrocinador</h2>

                            <div class="row" style="margin-top:15px;">
                                <div class="col-md-2 offset-md-2 text-center" style="margin-top: 10px;">
                                    <div class="foto-patrocinador" style="background-image: url({{url('')}}/assets/images/usuarios/{{$datos_patrocinador[0]->FotoPersona}})">
                                    </div>
                                </div>

                                <div class="col-md-8" style="padding-top: 10px;">                                    
                                    <h4>{{$datos_patrocinador[0]->NombrePersona}} {{$datos_patrocinador[0]->ApellidosPersona}}</h4>
                                    <span><strong>Email:</strong> {{$datos_patrocinador[0]->EmailPersona}}</span><br/>
                                    <span><strong>WhatsApp:</strong> {{$datos_patrocinador[0]->WhatsappPersona}}</span>
                                </div>
                            </div>

                        </div>
                        <br />

                        <div class="card-docttus">
                            <h2 class="titulo-card" >Eventos | Noticias</h2>

                            <div class="listado-eventos">
                                
                                <a href="{{url('')}}/curso/afiliado-viral-fu461qr5">
                                    <div class="card-docttus card-item-evento" style="background-image: url('assets/images/fondo-curso-1.jpg')">
                                        <h4><span style="text-decoration: underline;">Curso:</span>  AFILIADO 10 MILLION$ - PREMIUM</h4>
                                        <span>22 de Marzo de 2024 - 08:00 P.M Hora Colombia</span>
                                    </div>
                                </a>

                                <a href="{{url('')}}/crashing-pro10x">
                                    <div class="card-docttus card-item-evento" style="background-image: url('assets/images/fondo-curso-2.jpg')">
                                        <h4><span style="text-decoration: underline;">Curso:</span>  HERRAMIENTA 10 MILLION$S - MÁS AFILIADOS PRO</h4>
                                        <span>22 de Marzo de 2024 - 08:00 P.M Hora Colombia</span>
                                    </div>
                                </a>

                                <a href="{{url('')}}/evento-ten-millions/conferencia-impuestos-para-emprendedores-digitales">
                                    <div class="card-docttus card-item-evento" style="background-image: url('assets/images/fondo-afiliados.jpg')">
                                        <h4><span style="text-decoration: underline;">Evento:</span>  CONFERENCIA IMPUESTOS PARA EMPRENDEDORES DIGITALES</h4>
                                        <span>22 de Marzo de 2024 - 08:00 P.M Hora Miami</span>
                                    </div>
                                </a>


                            </div>


                                


                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="card-docttus">
                            <h2 class="titulo-card" >Aprende a Promocionar 10 Million$ Club</h2>
                            <div class="embed-responsive embed-responsive-16by9">                                
                                @if($data[0]->IdEstadoSolicitudAfiliado==1)
                                <iframe  class="embed-responsive-item"  src="https://player.vimeo.com/video/897977322?color=ffffff&title=0&byline=0&portrait=0" width="640" height="360" frameborder="0" allow="autoplay; fullscreen; picture-in-picture" allowfullscreen></iframe>
                                @else
                                <iframe  class="embed-responsive-item"  src="https://player.vimeo.com/video/897977322?color=ffffff&title=0&byline=0&portrait=0" width="640" height="360" frameborder="0" allow="autoplay; fullscreen; picture-in-picture" allowfullscreen></iframe>
                                @endif
                            </div>

                        </div>
                    </div>

                </div>
            

        </div>
        






        <!-- FIN PANEL IZQUIERDO -->


        

        <!-- PANEL DERECHO -->

        

        <!-- fiN PANEL DERECHO -->

        
        
        


    </div>
</div>

@stop   

@section('scripts')
<script  type="text/javascript">


</script>
@stop