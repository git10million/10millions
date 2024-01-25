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

            .btn-evento{
                display: block;
                width: 100%;
                position: relative;
                top: auto;
                right: auto;
                margin-top: 15px;
            }

        }

    </style>
@endsection


@section('contenido')   



<!--
<div class="row">
    <div class="col-md-12">
        <h2 class="titulo-backoffice" style="font-size: 28px; font-weight:400;">Panel de Estudiante</h2>
    </div>
</div>-->


<div class="container">



<div class="row">


    <!-- PANEL IZQUIERDO -->    
    <div class="col-md-9"> 
        <!-- FILA 1 -->
        <div class="row">
            <div class="col-md-12">
                <div class="card-docttus">
                    <div class="row">
                        <div class="col-md-4">
                            <img src="{{url('')}}/assets/images/evento1.jpg" style="width:100%; border-radius:10px;">
                        </div>

                        <div class="col-md-8">
                            <h5 style="font-weight: 700;"><strong>CONFERENCIA DE IMPUESTOS PARA EMPRENDEDORES DIGITALES</strong></h5>
                            <small>Fecha: 03 de Marzo de 2024, 20:00 Hora Miami</small>
                            <hr />
                            <p>¿Que aprenderás en esta conferencia?</p>
                            
                            <ul>
                                <li>Aspecto generales sobre la tributación en USA</li>
                                <li>Obligados a declarar renta y llevar contabilidad como persona natural y jurídica en USA</li>
                                <li>Regimen Ordinario de Tributación en USA.</li>                                
                            </ul>
                            
                            <div class="text-right">
                                <a href="{{url('')}}/evento-ten-millions/conferencia-impuestos-para-emprendedores-digitales" class="btn btn-secondary botones-docttus">Ver Evento</a>
                            </div>                            
                            
                        </div>
                    </div>
                </div>


                <div class="menu-interos" style="margin-top: 15px; margin-bottom:15px;">
                    <div class="row text-center">
                        <div class="col-md-12">    
                            <a class="btn-tab-dt   text-center" href="{{url('')}}/cursos/disponibles">
                                <span><i class="fa  fa-graduation-cap" aria-hidden="true"></i></span>
                                <p>Mis Cursos</p>
                            </a>

                            <a class="btn-tab-dt   text-center" href="{{url('')}}/cursos/deseos">
                                <span><i class="fa  fa-heart" aria-hidden="true"></i></span>
                                <p>Deseos</p>
                            </a>

                            <a class="btn-tab-dt   text-center" href="#">
                                <span><i class="fa fa-calendar-check-o" aria-hidden="true"></i></span>
                                <p>Eventos</p>
                            </a>


                            <a class="btn-tab-dt   text-center" href="#">
                                <span><i class="fa  fa-check-circle" aria-hidden="true"></i></span>
                                <p>Certificados</p>
                            </a>

                            <a class="btn-tab-dt   text-center" href="{{url('')}}/soporte">
                                <span><i class="fa  fa fa-life-ring" aria-hidden="true"></i></span>
                                <p>Soporte</p>
                            </a>
                            
                        </div>
                    </div>
                </div>

                @foreach($cursos_disponibles as $curso)
                    @if($curso->SeccionCurso=="1")
                        <div class="card-docttus" style="margin-bottom: 15px;">
                            <div class="row">
                                <div class="col-md-3">
                                    <img src="{{url('')}}/assets/images/cursos/{{$curso->ImagenCurso}}" style="width:100%; border-radius:10px;">
                                </div>

                                <div class="col-md-6" style="padding-top: 15px;">
                                    <h5 style="font-weight: 700;"><strong>{{$curso->NombreCurso}}</strong></h5>
                                    <p>{{$curso->DescripcionCortaCurso}}</p>
                                </div>

                                <div class="col  text-center">
                                    
                                    
                                    @if(count($curso->reviews)==0)
                                        <i style="margin-top: 53px; color:#ffc107;" class="fa fa-star" aria-hidden="true"></i> <strong>0</strong>
                                    @else
                                    
                                        @foreach ($curso->reviews as $review)
                                            @if($data[0]->IdUsuarioPersona == $review->IdPersonaUsuario)    
                                                <i style="margin-top: 53px; color:#ffc107;" class="fa fa-star" aria-hidden="true"></i> <strong>{{$review->ValorCalificacion}}</strong>
                                            @else
                                                <i style="margin-top: 53px; color:#ffc107;" class="fa fa-star" aria-hidden="true"></i> <strong>0</strong>
                                            @endif
                                        @endforeach

                                    @endif
                                    
                                </div>

                                <div class="col text-center">
                                    <a style="margin-top: 43px;" href="{{url('')}}/curso/{{$curso->SlugCurso}}" class="btn btn-secondary botones-docttus">Ver</a>
                                </div>

                            </div>
                        </div>
                    @endif
                @endforeach


            </div>       
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
            <h5 style="font-size:15px;">Miembro Inactivo</h5>            
            <a href="{{url('')}}/usuario" class="btn btn-secondary botones-docttus">Editar Perfíl</a>            
        </div>


        <div  class="card-docttus" style="text-align: center; margin-top:15px;">
            <a href="{{url('')}}/registro-afiliados" target="_blank">
                <img src="{{url('')}}/assets-marketing/images/club-cta.jpg" style="width:100%; border-radius:3px;">
            </a>            
        </div>
       

    </div>

    <!-- fiN PANEL DERECHO -->

    
    


</div>

</div>
@stop   