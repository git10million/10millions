@extends('areacurso.plantillas.plantilla-area-interna')
@section('contenido')   

<style type="text/css">

    :root{
        --color_fondo:#f7f6f9;
        --color_principal:#0b5586;
        --color_secundario:#72b7f9;
        --color_menu:#616d85;
        --color_cpa:#2bd3d5;
        --color_texto_cpa:#fff;
        --color_fondo_secundario:#fff;
        --color_texto_principal:#08090a;    
        --color_texto_subtitulo:#64a4e5;

        --color_botoncontrol:#64a4e5;
        --color_botoncontrol_hover:#4a8cb8;
        
        --color_boder:#dee0ea;
        --border_radius:0px;

        --color_fondo_tarjetas:#fff;
        --color_texto_tarjetas:#9ba2aa;

    }

    .contenido__informacion_item{
        display: none;
    }


    .descripcion-curso{
        height: 550px;
        overflow-y: auto;
        margin-top: 45px;
    }
    .contenedor-principal{
        /*background-color: #fff;*/
    }

    .panel-superior-curso{
        height: 300px;
    }

    .estrella_curso{
        font-size: 40px;
        color: #242746;
        margin-right: 5px;
        text-decoration: none;
    }

    .estrella_curso:hover{
        text-decoration: none; 
        color: #242746;
    }

    .item_habilidad{
        display: inline-block;
        margin-right: 15px;
    }

    .item_habilidad img{
        width: 38px;
        margin-right: 5px;
    }

    .item_habilidad span{
        font-weight: bold;
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

    #grafica_progreso{
        margin-top: -26px;
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

    .contenido__boton_menu{
        border: none;   
        background-color: transparent;    
        color: var(--color_menu);    
        padding: 5px  25px;
    }

    .contenido__boton_menu.activo,.contenido__boton_menu:hover{
        background-color: #f0f0f0;
        color: var(--color_cpa);
        outline: none;
        border-bottom: 1px solid #a9a9a9;
    }

    .contenido__botonbarracontrol:hover,.contenido__botonvolver:hover{
        background-color: var(--color_botoncontrol_hover);
        text-decoration: none;
    }

    .contenido__botonvolver{
        border-radius: 9px;
        display: inline-block;
        color: var(--color_texto_cpa) !important;
        background-color: var(--color_botoncontrol);
        padding: 10px 20px;
        margin-top: 8px;
    }

    .contenido__botonvolver >span{
        color: var(--color_texto_cpa) !important;
    }
    .contenido__botonvolver i{
        color: var(--color_texto_cpa) !important;
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
 


<div class="container" style="padding-bottom: 250px;">
    <div class="row">        
        <div class="col-md-9">
            <div class="row" style="margin-top: 25px;">
                <div class="col-md-12">

                    <h1 style="font-weight: 400;">{{$info_curso->NombreCurso}}</h1>
                    <p>Un curso de <strong>{{$info_tutor->NombrePersona}}</strong>, {{$info_tutor->TituloPersona}}</p>                   

                    <div class="embed-responsive embed-responsive-16by9" id="vid_portada">
                        {!!$info_curso->VideoCursoEmbed!!}
                    </div>

                    <div class="card-docttus">                    
                        
                        <p>{!!$info_curso->DescripcionCurso!!}</p>

                        @foreach($habilidades_curso as $habilidad)
                        <div class="item_habilidad">
                            <img src="{{url('')}}/assets/images/habilidades/{{$habilidad->IconoHabilidad}}"> <span>{{$habilidad->NombreHabilidad}}</span>
                        </div>
                        @endforeach

                        <br />

                        <div class="row">
                            <div class="col-6">
                                @if($continuar)
                                    <a href="{{url('')}}/tema/{{$info_curso->SlugCurso}}/leccion/{{$continuar->CodigoTema}}" class="btn botones-docttus" style="margin-top: 15px;">Continuar Curso</a>                                
                                @endif
                            </div>                            
                        </div>                        

                    </div>
                </div>
            </div>
        
            
            

            <div class="row" style="margin-top: 25px;">
                <div class="col-md-12">

                    <div  class="card-docttus" style="margin-bottom: 15px;">
                        <button class="contenido__boton_menu" id-button="1" type="button" id="btn_contenido_1">Presentación</button>                                                        
                        <button class="contenido__boton_menu activo" id-button="2"  type="button" id="btn_contenido_2">Temario</button>
                        <button class="contenido__boton_menu" id-button="3"  type="button" id="btn_contenido_3">Reseñas</button>                                
                        <button class="contenido__boton_menu" id-button="4"  type="button" id="btn_contenido_4">Mi Progreso</button>
                    </div>



                    <div class="card-docttus">

                        <div class="contenido__recursos contenido__informacion_item" id="contenido_1">
                            <div class="row">
                                <div class="col-md-8" style="border-right:1px solid #ccc;">
                                    <h2 class="titulo-backoffice">Descripción del Curso</h2>
                                    <p>
                                        {!!$info_curso->DescripcionCurso!!}
                                    </p>
                                    <br>
                                    @if($info_curso->AudienciaCurso)
                                    <h2 class="titulo-backoffice">Audiencia</h2>
                                    <p>
                                        {!!$info_curso->AudienciaCurso!!}
                                    </p>
                                    @endif
                                    <br>
                                    @if($info_curso->PrerrequisitoCurso)
                                    <h2 class="titulo-backoffice">Prerrequisitos</h2>
                                    <p>
                                        {!!$info_curso->PrerrequisitoCurso!!}
                                    </p>
                                    @endif

                                </div>

                                <div class="col-md-4">
                                    <h2 class="titulo-backoffice">Características</h2>
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item">
                                            <div class="row">
                                                <div class="col-7">
                                                    <i class="fa fa-file-o" aria-hidden="true"></i> Lecciones	
                                                </div>
                                                <div class="col-5">
                                                    {{$info_curso->cantidad_lecciones}}
                                                </div>
                                            </div>
                                            
                                        </li>
                                        <li class="list-group-item">
                                            

                                          <div class="row">
                                                <div class="col-7">
                                                    <i class="fa fa-clock-o" aria-hidden="true"></i> Duración
                                                </div>
                                                <div class="col-5">
                                                    {{$info_curso->cantidad_horas}} horas
                                                </div>
                                            </div>

                                        </li>
                                        <li class="list-group-item">

                                          <div class="row">
                                                <div class="col-7">
                                                    <i class="fa fa-level-up" aria-hidden="true"></i> Nivel
                                                </div>
                                                <div class="col-5">
                                                    {{$info_curso->NombreNivel}}
                                                    
                                                </div>
                                            </div>

                                            
                                        </li>
                                        <li class="list-group-item">

                                          <div class="row">
                                                <div class="col-7">
                                                    <i class="fa fa-language" aria-hidden="true"></i> Idioma
                                                </div>
                                                <div class="col-5">
                                                    Español
                                                </div>
                                            </div>

                                            
                                        </li>
                                        <li class="list-group-item">

                                          <div class="row">
                                                <div class="col-7">
                                                    <i class="fa fa-users" aria-hidden="true"></i>Estudiantes
                                                </div>
                                                <div class="col-5">
                                                    {{$info_curso->cantidad_estudiantes}}
                                                </div>
                                            </div>
                                        </li>										
                                      </ul>
                                </div>
                            </div>
                            
                        </div>

                        <div class="contenido__recursos contenido__informacion_item" id="contenido_2" style="display: block;">

                            <h2 class="titulo-backoffice">Lecciones Del Curso</h2>
                            @php
                                $contador_modulos=0;
                            @endphp

                            @foreach($info_curso->modulos as $modulo)

                                @php
                                    $contador_modulos++;
                                    $abrir_acordion="show";
                                    if($contador_modulos==1){
                                        $abrir_acordion="show";
                                    }
                                @endphp
                                                
                                <div id="accordion_lecciones_{{$modulo->IdModulo}}" class="acordion_ficha">
                                    <!-- INICIO MODULO -->
                                    <a class="btn btn-link btn-modulo" href="{{url('')}}/tema/{{$info_curso->SlugCurso}}/modulo/{{$modulo->IdModulo}}" style="color:#000; margin-top: 5px; width:100%; text-align:left; background-color:#E8E8E8; border-radius:0px; border:1px solid #ccc; padding:15px 10px;">
                                            {{$modulo->NombreModulo}}  
                                    </a>
                                                

                                    <div id="collapse_{{$modulo->IdModulo}}" class="collapse {{$abrir_acordion}} contenedor-lecciones" aria-labelledby="headingOne" data-parent="#accordion_lecciones_{{$modulo->IdModulo}}">									      
                                        <ul class="list-group list-group-flush">
                                            <!-- ITEM LECCIÓN -->
                                            @foreach($info_curso->lecciones as $leccion)
                                                @if($modulo->IdModulo == $leccion->IdModulo)
                                                    @php
                                                    
                                                        $icono_visualizacion='<i  style="font-size:15px;" class="fa fa-circle-o" aria-hidden="true"></i>';
                                                        if(session('rol_solicitud')!="root"){
                                                            foreach($info_lecciones_estado as $estadoleccion){
                                                                if($estadoleccion->IdTema==$leccion->IdTema && $estadoleccion->EstadoTemaAvance==1){
                                                                    $icono_visualizacion='<i style="color:#19d2d1; font-size:15px;" class="fa fa-circle" aria-hidden="true"></i>';
                                                                }
                                                            }
                                                        }
                                                    @endphp													
                                                    <a class="clase_gratis" style="cursor: pointer; color:#6D707F;" href="{{url('')}}/tema/{{$info_curso->SlugCurso}}/leccion/{{$leccion->CodigoTema}}">
                                                        <li class="list-group-item" style="padding:15px 10px; border:1px solid #ccc;">
                                                            <div class="row">
                                                                <div class="col-8">                                    
                                                                    {!!$icono_visualizacion!!}                                                        
                                                                    <span>{{$leccion->NombreTema}}</span>
                                                                </div>
                                                                <div class="col-4"  style="text-align: right;">
                                                                    <!--<span>{{$leccion->DuracionTema}} Min</span>-->
                                                                </div>
                                                            </div>
                                                        </li>
                                                    </a>

                                                @endif
                                                <!-- FIN ITEM LECCIÓN -->
                                            @endforeach
                                        </ul>

                                    </div>									 
                                    <!-- fin MODULO -->
                                </div>

                            @endforeach
                        </div>

                        <div  class="contenido__recursos contenido__informacion_item" id="contenido_3">
                            <ul class="list-group list-group-flush">

                                @if(count($arra_reviews)==0)
                                    <h3>No hay Reseñas</h3>
                                @endif

                                @foreach($arra_reviews as $review)

                                  @if($review->ObservacionCalificacion)
                                    <!-- ficha reseña -->

                                    <?php

                                        $letters=strtoupper("".substr(trim($review->NombrePersona),0,1));
                                        $letters.=strtoupper("".substr(trim($review->ApellidosPersona),0,1));
                                    ?>

                                  <li class="list-group-item">
                                       <div class="row">
                                           <div class="col-md-4">
                                            <div class="row">
                                                <div class="col-3">
                                                    <span style="border-radius: 25px; text-align:center; display: inline-block; width: 40px; height: 40px; background-color: #ff6500; padding-top: 9px; color: #fff;">{{$letters}}</span>
                                                </div>
                                                <div class="col-9">
                                                    <small>{{\Carbon\Carbon::parse($review->FechaCreacion)->diffForHumans()}}</small>
                                                    <h5 style="font-size: 15px;">{{$review->NombrePersona}} {{$review->ApellidosPersona}}</h5>
                                                </div>


                                            </div>
                                           </div>
                                           <div class="col-md-8">

                                            <?php
                                                for($e=1;$e<=5;$e++){
                                                    if($review->ValorCalificacion>=$e){
                                                        echo('<i class="fa fa-star estrella" aria-hidden="true"  style="color: #F4C14E;"></i>');
                                                    }else{
                                                        echo('<i class="fa fa-star-o estrella" aria-hidden="true"  style="color: #F4C14E;"></i>');
                                                    }
                                                }

                                            ?>

                                            

                                               <p style="font-weight: 300;line-height: 22px; margin-top: 0px; text-align:left;">{{$review->ObservacionCalificacion}}</p>
                                           </div>
                                       </div>
                                  </li>
                                  @endif
                                  <!-- fin ficha reseña -->
                                @endforeach

                                </ul>
                        </div>

                        <div class="contenido__recursos contenido__informacion_item" id="contenido_4" style="padding-top: 35px;">
                            <div class="container">
                                <div class="row">
                                    
                                    <div class="col-12">
                                        <div class="tarjeta__contenido">                                            
                                            <div class="tarjeta__cuerpo">
                                                <div class="row">
                                                    <div class="col-md-4 text-center">
                                                        <div style="display:inline-block; width:85px; height:85px; 
                                                                    background-image: url({{url('')}}/assets/images/usuarios/{{$info_tutor->FotoPersona}});
                                                                    background-position:center;
                                                                    background-size:cover;
                                                                    border-radius:50px;">
                                                        </div>
                                                        <div>
                                                            {{$info_tutor->NombrePersona}} {{$info_tutor->ApellidosPersona}}
                                                        </div>
                                                        <small>Tutor</small>
                                                    </div>
                                                    <div class="col-md-4">
                                                        @if($paso_examen==1)
                                                        <a class="contenido__botonvolver" download href="#" style="width:100%;" id="btn_descargar_certificado">
                                                            <i class="fa fa-book" aria-hidden="true"></i> Descargar Certificado
                                                        </a>
                                                        @else
                                                        <a class="contenido__botonvolver"  href="#" style="width:100%; background-color: #b6b6b6;"  id="btn_descargar_certificado1">
                                                            <i class="fa fa-book" aria-hidden="true"></i> Descargar Certificado
                                                        </a>                                                
                                                        @endif
                                                        @if($paso_examen==0)
                                                        <a class="contenido__botonvolver" href="{{url('')}}/tema/{{$info_curso->SlugCurso}}/evaluacion" style="width:100%; margin-top:25px;" id="btn_ver_examen">
                                                            <i class="fa fa-check-circle-o" aria-hidden="true"></i> Exámen 
                                                        </a>
                                                        @else
                                                        <a class="contenido__botonvolver" style="width:100%; margin-top:25px; background-color: #b6b6b6;" id="btn_ver_examen">
                                                            <i class="fa fa-check-circle-o" aria-hidden="true"></i> Exámen 
                                                        </a>
                                                        @endif
                                                    </div>
                                                    <div class="col-md-4 text-center">
                                                        <canvas id="grafica_progreso" width="200" height="180"></canvas>
                                                    </div>
                                                </div>
                                                
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>



                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <!-- FILA EDICIÓN -->
            <div class="card-docttus" style="text-align: center;">            
                <div class="image">
                    <img src="{{url('')}}/assets/images/usuarios/{{$info_tutor->FotoPersona}}" class="img-circle elevation-2" alt="User Image" style="width: 130px;">
                </div>

                <h3 style="font-size:18px; font-weight:bold; margin-top:25px;">{{$info_tutor->NombrePersona}}</h3>
                <h5 style="font-size:15px;">Tutor</h5>            
        
                <div class="row" style="margin-bottom: 25px; margin-top:25px;">
                    <div class="col">
                        @if($info_tutor->FacebookPersona)
                            <a target="_blank" href="{{$info_tutor->FacebookPersona}}" class="btn btn-default btn-xs boton-redes btn-fb"><i class="fa fa-facebook"></i></a>
                        @endif

                        @if($info_tutor->YoutubePersona)
                            <a target="_blank" href="{{$info_tutor->YoutubePersona}}" class="btn btn-default btn-xs boton-redes btn-yt"><i class="fa fa-youtube"></i></a>
                        @endif

                        @if($info_tutor->TwitterPersona)
                            <a target="_blank" href="{{$info_tutor->TwitterPersona}}" class="btn btn-default btn-xs boton-redes btn-tw"><i class="fa fa-twitter"></i></a>
                        @endif

                        @if($info_tutor->InstagramPersona)
                            <a target="_blank" href="{{$info_tutor->InstagramPersona}}" class="btn btn-default btn-xs boton-redes btn-ig"><i class="fa fa-instagram"></i></a>
                        @endif

                        @if($info_tutor->LinkedinPersona)
                            <a target="_blank" href="{{$info_tutor->LinkedinPersona}}" class="btn btn-default btn-xs boton-redes btn-lk"><i class="fa fa-linkedin"></i></a>
                        @endif

                        @if($info_tutor->WebPersona)
                            <a target="_blank" href="{{$info_tutor->WebPersona}}" class="btn btn-default btn-xs boton-redes btn-wb"><i class="fa fa-link"></i></a>
                        @endif
                    </div>
                </div>

                <a href="{{url('')}}/tutor/{{$info_curso->NombreUsuario}}" target="_blank" class="btn btn-secondary botones-docttus">Ver Más Cursos del Tutor</a>            

                <br>

                <div class="row">
                    <div class="col-12" style="text-align: center;">
                        <div style="margin-top: 35px; border-radius:0px; border:1px solid #ccc; padding:15px 10px;">
                        
                            <h3 style="font-size: 90px; text-align: center; ">{{round($promedio_reviews_curso,1)}}</h3>
                            <span>Valoración del curso</span><br />

                            @php 
                                for($i=1;$i<=5;$i++){
                                
                                    if($promedio_reviews_curso>=$i){
                                        echo('<i class="fa fa-star estrella" aria-hidden="true" style="color: #F4C14E;"></i>');          
                                    }else{
                                        echo('<i class="fa fa-star-o estrella" aria-hidden="true" style="color: #F4C14E;"></i>');
                                    }
                                }
                            @endphp
                            <br /><br />

                            <h5>¿Que te parece este curso?</h5>

                            <p>Como somos una comunidad tu valoración es muy importante para seguir mejorando día a día.</p>

                            <a href="#" id="btn_comentario" class="btn btn-secondary botones-docttus">Valorar el curso</a>
                        </div>
                    </div>
                </div>
                
            </div>

            
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modal-valoracion" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Valorar Curso</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <center>
                    <h4>Hasta el momento ¿Cómo calificarías este curso?</h4>
                    <div style="display: inline-block; padding:10px; background-color: #fff;" id="contenedor_estrellas">

                        <a href="#" class="estrella_curso" id="btn_estrella_curso_1" star="1">
                            <i class="fa fa-star-o" aria-hidden="true"></i>
                        </a>

                        <a href="#" class="estrella_curso" id="btn_estrella_curso_2" star="2">
                            <i class="fa fa-star-o" aria-hidden="true"></i>
                        </a>

                        <a href="#" class="estrella_curso" id="btn_estrella_curso_3" star="3">
                            <i class="fa fa-star-o" aria-hidden="true"></i>
                        </a>

                        <a href="#" class="estrella_curso" id="btn_estrella_curso_4" star="4">
                            <i class="fa fa-star-o" aria-hidden="true"></i>
                        </a>

                        <a href="#" class="estrella_curso" id="btn_estrella_curso_5" star="5">
                            <i class="fa fa-star-o" aria-hidden="true"></i>
                        </a>
                    </div>
                    <h4>Cuéntanos ¿Qué te pareció este curso?</h4>
                    <textarea class="form-control" rows="4" id="ComentarioCalificacion" placeholder="Escribe un comentario..."></textarea>
                    <button class="btn botones-docttus" id="btn_enviar_comentario" style="margin-top: 25px;">Enviar</button>
                </center>
            </div>      
        </div>
    </div>
</div>

@stop

@section('scripts')

<script src="{{url('')}}/assets/js/jquery-gauge/src/jquery.gauge.js"></script>
<script type="text/javascript">

    $(function(){
        abrir_gouge("{{$porcentaje_avance}}");
    });

    function labelFormatter(label, series) {
        return '<div style="font-size:12px; text-align:center; padding:2px; color: #fff; font-weight: 300;">'   
        + '<br>' + Math.round(series.percent) + '%</div>'
    }

    $("#btn_comentario").click(function(e){
        e.preventDefault();
        $("#modal-valoracion").modal("show");
    });


    $("#btn_estrella_curso_1").mouseover(function(e){
        set_estrella(1);        
    });

    $("#btn_estrella_curso_2").mouseover(function(e){
        set_estrella(2);        
    });

    $("#btn_estrella_curso_3").mouseover(function(e){
        set_estrella(3);        
    });

    $("#btn_estrella_curso_4").mouseover(function(e){
        set_estrella(4);        
    });

    $("#btn_estrella_curso_5").mouseover(function(e){
        set_estrella(5);        
    });


    $("#contenedor_estrellas").mouseout(function(e){
        limpiar_estrellas();
    });

    var calificacion_estrella=0;
    $("#btn_estrella_curso_1").click(function(e){
        e.preventDefault();
        calificacion_estrella=1;
    });

    $("#btn_estrella_curso_2").click(function(e){
        e.preventDefault();
        calificacion_estrella=2;
    });

    $("#btn_estrella_curso_3").click(function(e){
        e.preventDefault();
        calificacion_estrella=3;
    });

    $("#btn_estrella_curso_4").click(function(e){
        e.preventDefault();
        calificacion_estrella=4;
    });

    $("#btn_estrella_curso_5").click(function(e){
        e.preventDefault();
        calificacion_estrella=5;
    });

    $("#btn_enviar_comentario").click(function(e){
        e.preventDefault();
        enviar_calificacion();
    });


    function set_estrella(id_estrella){       
        for(var i=1;i<=5;i++){
            if(i<=id_estrella){
                $("#btn_estrella_curso_"+i+" > i ").removeClass("fa-star-o");
                $("#btn_estrella_curso_"+i+" > i ").addClass("fa-star");
            }else{          
                $("#btn_estrella_curso_"+i+" > i ").removeClass("fa-star-o");
                $("#btn_estrella_curso_"+i+" > i ").addClass("fa-star-o");          

            }
        }

    }

    function limpiar_estrellas(){
        for(var i=1;i<=5;i++){     
            if(calificacion_estrella=="" || calificacion_estrella<i ){
                $("#btn_estrella_curso_"+i+" > i ").addClass("fa-star-o");
                $("#btn_estrella_curso_"+i+" > i ").removeClass("fa-star");  
            }
        }
    }



    function enviar_calificacion(){

        var ComentarioCalificacion=$("#ComentarioCalificacion").val();
        if(calificacion_estrella==""){
            mensaje_generico("Error !","Debes seleccionar una calificación","2","Continuar...",function(){});
            return;
        }

        var request = $.ajax({
            url: "{{url('')}}/setcalificacion",
            type: "POST",
            data:{               
                IdCurso:"{{$info_curso->IdCurso}}",               
                ObservacionCalificacion:""+ComentarioCalificacion,
                ValorCalificacion:""+calificacion_estrella,

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
                return;
            }
        });
         //respuesta si falla
        request.fail(function(jqXHR, textStatus) {
            alert( "Error de servidor  " + textStatus );
        });
    }


    $(".contenido__boton_menu").click(function(e){
        e.preventDefault();
        var id_boton=$("#"+e.target.id).attr("id-button");      
        $(".contenido__boton_menu").removeClass("activo");
        $("#btn_contenido_"+id_boton).addClass("activo");

        $(".contenido__informacion_item").hide(); 
        $("#contenido_"+id_boton).show();        
        

    });


    function abrir_gouge(porcentaje){
        // $fn.gauge(value, options);
        $("#grafica_progreso").gauge(porcentaje, {
            // Minimum value to display
            font:"80px verdana",
            min: 0,
            // Maximum value to display
            max: 100,
            // Unit to be displayed after the value
            unit: "%",

            // color for the value and bar
            color: "#72b7f9",
            colorAlpha: 1,

            // background color of the bar
            bgcolor: "#f7f6f9",

            // default or halfcircle
            type: "default",
            
        });
    }
    var porcentaje_avance="{{$porcentaje_avance}}";
    var paso_examen="{{$paso_examen}}";
    function generar_progreso(){
        abrir_gouge(parseFloat(porcentaje_avance));
        $("#btn_descargar_certificado");
        $("#btn_ver_examen");
    }

    @if($porcentaje_avance==100 && $paso_examen==1)
    $("#btn_descargar_certificado").click(function(e){
        e.preventDefault();        
        generar_certificado("{{$codigo_certificado}}");
    });
    
    function generar_certificado(codigo_transaccion){
        var request = $.ajax({
            url: "{{url('')}}/certificado.php",
            type: "POST",
            data:{               
                codigo_transaccion:`${codigo_transaccion}`,
                _token: "{{ csrf_token() }}"
            }
        });

        request.done(function(obj) { 
            if(obj.status=="ok"){                 
                window.open("{{url('')}}/assets/certificado/certificado_"+codigo_transaccion+".pdf","_blank");
            }
        });
        //respuesta si falla
        request.fail(function(jqXHR, textStatus) {
            alert( "Error de servidor  " + textStatus );
        });
   
    }

    @endif

</script>
@stop