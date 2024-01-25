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

<div class="row">


    <!-- PANEL IZQUIERDO -->

    
    <div class="col-md-9"> 
        <!-- FILA 1 -->
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

        <div class="row">            
            <div class="col-md-4">
                <div class="card-docttus alto-card">
                    <div class="row">                        
                        <div class="col-12">
                            <h2 class="card-titulo" style="font-size: 22px;">Cursos Comprados</h2>
                        </div>
                        
                        <div class="col-6">
                            <h3>{{$cant_cursos}}</h3>
                            
                            <a href="{{url('')}}/cursos/disponibles" class="cursos-nuevos" style="background-color:orange; color:#fff; padding:5px 10px; border-radius:15px; font-size:14px; margin-top:10px; display:inline-block;">Ver Cursos</a>
                            <!-- Consultar productos finalizados -->
                        </div>

                        <div class="col-6">
                            <img src="{{url('')}}/assets-marketing/images/icono-interno-1.png" class="pull-right" style="width:100px">
                        </div>
                        

                        
                    </div>
                </div>                
            </div>

            

            <div class="col-md-4">
                <div class="card-docttus alto-card">
                    <div class="row">                        
                        <div class="col-12">
                            <h2 class="card-titulo" style="font-size: 22px;">Lista de Deseos</h2>
                        </div>

                        
                        <div class="col-6">
                            <h3>{{$cant_lista_deseos}}</h3>
                            
                            <a href="{{url('')}}/cursos/deseos"><span class="cursos-nuevos" style="background-color:#8966c1; color:#fff; padding:5px 10px; border-radius:15px; font-size:14px;  margin-top:10px; display:inline-block;">Ver lista de deseos</span></a>
                        </div>

                        <div class="col-6">
                            <img src="{{url('')}}/assets-marketing/images/icono-interno-2.png" class="pull-right"  style="width:100px">
                        </div>
                        
                    </div>
                </div>                
            </div>


            <div class="col-md-4">
                <div class="card-docttus alto-card">
                    <div class="row">                        
                        <div class="col-12">
                            <h2 class="card-titulo" style="font-size: 22px;">Soporte</h2>
                            <p>Bienvenido a Docttus, estamos a tu disposición si tienes alguna duda</p>
                        </div>

                        
                        <div class="col-6">
                            <a href="{{url('')}}/soporte" class="cursos-nuevos" style="background-color:#8966c1; color:#fff; padding:5px 10px; border-radius:15px; font-size:14px;  margin-top:10px; display:inline-block;">Ir A Soporte</a>
                        </div>

                        
                        
                    </div>
                </div>                
            </div>



        </div>
        <!-- FIN FILA 1 -->


        <!-- FILA 2 -->
        @if(count($habilidades)>0)
        <div class="row" style="margin-top: 25px; ">
            <div class="col-md-6">
                <h2 class="titulo-backoffice">Habilidades Alcanzadas</h2>
            </div>

            <div class="col-md-6">
                <!--<h2 class="titulo-backoffice pull-right" style="font-size: 20px;  font-weight:bold;">Ver Todas</h2>-->
            </div>
        </div>

       

        <div class="row" style="margin-top: 25px;">
            
            <div class="col-md-12">
                
                <div class="carousel slide" data-ride="carousel" id="habilidades-carousel">
                    <div class="carousel-inner">


                        <?php 
                            
                            
                            $cantidad_col=6;
                            $cant_habilidades=count($habilidades);
                            $cant_filas=ceil($cant_habilidades/$cantidad_col);
                            $inicio=0;
                            $fin=$cantidad_col;

                            if($cant_habilidades<$cantidad_col){
                                $fin=$cant_habilidades;
                            }

                            for($i=0;$i<$cant_filas;$i++){
                                $active="";
                                if($i==0){
                                    $active="active";
                                }

                        ?>
                                
                          
                                <div class="carousel-item {{$active}}">
                                    <div class="row">                                
                                        
                                        <?php 
                                            $cant_cols=0;                                            
                                            for($j=$inicio;$j<$fin;$j++){      
                                                $cant_cols++;       
                                                if($cant_cols<=$cantidad_col){                               
                                        ?>

                                                    <div class="col-sm-2">
                                                        <div class="item-habilidad" title="{{$habilidades[$j]->NombreHabilidad}}" style="background-size:80px; background-repeat:no-repeat; background-position:center; background-image:url({{url('')}}/assets/images/habilidades/{{$habilidades[$j]->IconoHabilidad}})"></div>
                                                    </div>

                                        <?php
                                                }else{
                                                    break;
                                                } 
                                            }

                                            $inicio=$j;
                                            $fin=$cant_habilidades;
                                        ?>
                                        
                                    </div>
                                </div>

                        <?php 

                        }

                        ?>

                    </div>

                    <!--Controls-->
                    @if(count($habilidades)>$cantidad_col)
                    <div class="controls-top" style="position: absolute; top:0px; width:100%;">
                        <a class="btn-floating btn-prev" href="#habilidades-carousel" data-slide="prev">
                            <i class="fa fa-chevron-left"></i>
                        </a>
                        <a class="btn-floating  btn-next" href="#habilidades-carousel" data-slide="next">
                            <i class="fa fa-chevron-right"></i>
                        </a>
                    </div>
                    @endif
                    <!--/.Controls-->


                </div>



                <div class="carousel slide" data-ride="carousel" id="habilidades-carousel-m">
                    <div class="carousel-inner">


                        <?php 
                            
                            
                            $cantidad_col=1;
                            $cant_habilidades=count($habilidades);
                            $cant_filas=ceil($cant_habilidades/$cantidad_col);
                            $inicio=0;
                            $fin=$cantidad_col;

                            if($cant_habilidades<$cantidad_col){
                                $fin=$cant_habilidades;
                            }

                            for($i=0;$i<$cant_filas;$i++){
                                $active="";
                                if($i==0){
                                    $active="active";
                                }

                        ?>
                                
                          
                                <div class="carousel-item {{$active}}">
                                    <div class="row">                                
                                        
                                        <?php 
                                            $cant_cols=0;                                            
                                            for($j=$inicio;$j<$fin;$j++){      
                                                $cant_cols++;       
                                                if($cant_cols<=$cantidad_col){                               
                                        ?>

                                                    <div class="col-sm-2">
                                                        <div class="item-habilidad" title="{{$habilidades[$j]->NombreHabilidad}}" style="background-size:80px; background-repeat:no-repeat; background-position:center; background-image:url({{url('')}}/assets/images/habilidades/{{$habilidades[$j]->IconoHabilidad}})"></div>
                                                    </div>

                                        <?php
                                                }else{
                                                    break;
                                                } 
                                            }

                                            $inicio=$j;
                                            $fin=$cant_habilidades;
                                        ?>
                                        
                                    </div>
                                </div>

                        <?php 

                        }

                        ?>

                    </div>

                    <!--Controls-->
                    @if(count($habilidades)>$cantidad_col)
                    <div class="controls-top" style="position: absolute; top:0px; width:100%;">
                        <a class="btn-floating btn-prev" href="#habilidades-carousel-m" data-slide="prev">
                            <i class="fa fa-chevron-left"></i>
                        </a>
                        <a class="btn-floating  btn-next" href="#habilidades-carousel-m" data-slide="next">
                            <i class="fa fa-chevron-right"></i>
                        </a>
                    </div>
                    @endif
                    <!--/.Controls-->


                </div>





            </div>



        </div>

        @endif

         <!-- FIN FILA 2 -->




         <!-- FILA 3 -->

        <div class="row" style="margin-top: 25px; ">
            <div class="col-6">
                <h2 class="titulo-backoffice">Seguir Viendo</h2>
            </div>

            
        </div>

       

        <div class="row" style="margin-top: 25px;">
            
            <div class="col-md-12">
                
                <div class="carousel slide" data-ride="carousel" id="seguir-viendo-carousel">
                    <div class="carousel-inner">
                        
                        <?php 
                            
                            
                            $cantidad_col=4;
                            $cant_habilidades=count($historial_lecciones);
                            $cant_filas=ceil($cant_habilidades/$cantidad_col);
                            $inicio=0;
                            $fin=$cantidad_col;

                            if($cant_habilidades<$cantidad_col){
                                $fin=$cant_habilidades;
                            }

                            for($i=0;$i<$cant_filas;$i++){
                                $active="";
                                if($i==0){
                                    $active="active";
                                }

                        ?>
                        
                        <div class="carousel-item {{$active}}">
                            <div class="row"> 





                                  
                                <?php 
                                    $cant_cols=0;                                            
                                    for($j=$inicio;$j<$fin;$j++){      
                                        $cant_cols++;       
                                        if($cant_cols<=$cantidad_col){                               
                                ?>




                                            <div class="col-md-3">                                    
                                                <a href="{{url('')}}/leccion/{{$historial_lecciones[$j]->CodigoTema}}" style="color: #000;">
                                                <div class="card-docttus card-docttus-list" style="text-align:center; padding-bottom:25px;">
                                                    <div style="with:100%; height:150px;  background-image:url({{url('')}}/assets/images/cursos/{{$historial_lecciones[$j]->ImagenCurso}}); background-size:cover; background-position:center; border-radius:9px;">
                                                    </div>
                                                    <h5 style="margin-top: 15px; font-size:16px;">{{$historial_lecciones[$j]->NombreTema}}</h5>
                                                    <small style="font-size: 15px;">{{$historial_lecciones[$j]->NombreCurso}}</small>
                                                    
                                                        <!--<a href="#" style="background-color:orange; padding:2px 6px; color:#fff; border-radius:9px; font-size:13px; position: absolute; bottom:15px; display: inherit;  left: 50%;  margin-left: -46px; ">Seguir Viendo</a>-->
                                                                                        
                                                </div>
                                                </a>
                                            </div>





                                <?php
                                        }else{
                                            break;
                                        } 
                                    }

                                    $inicio=$j;
                                    $fin=$cant_habilidades;
                                ?>





                                
                            </div>
                        </div>

                        <?php 

                            }

                        ?>


                        
                    </div>

                    <!--Controls-->
                    @if(count($historial_lecciones)>$cantidad_col)
                    <div class="controls-top" style="position: absolute; top:0px; width:100%;">
                        <a class="btn-floating btn-prev" href="#seguir-viendo-carousel" data-slide="prev">
                            <i class="fa fa-chevron-left"></i>
                        </a>
                        <a class="btn-floating  btn-next" href="#seguir-viendo-carousel" data-slide="next">
                            <i class="fa fa-chevron-right"></i>
                        </a>
                    </div>
                    @endif
                    <!--/.Controls-->


                </div>

            </div>



        </div>

         <!-- FIN FILA 3 -->


         <!-- FILA 4 -->

        <div class="row" style="margin-top: 25px; ">
            <div class="col-6">
                <h2 class="titulo-backoffice">Cursos Sugeridos</h2>
            </div>

            <div class="col-6">
            <a href="{{url('')}}/cursos/mercado"><h2 class="titulo-backoffice pull-right" style="">Ver Todos</h2></a>
            </div>

            
        </div>

       

        <div class="row" style="margin-top: 25px;">
            
            <div class="col-md-12">
                
                <div class="carousel slide" data-ride="carousel" id="cursos-sugeridos">
                    <div class="carousel-inner">


                        <?php 
                            
                            
                            $cantidad_col=4;
                            $cant_habilidades=count($curso_destacado);
                            $cant_filas=ceil($cant_habilidades/$cantidad_col);
                            $inicio=0;
                            $fin=$cantidad_col;

                            if($cant_habilidades<$cantidad_col){
                                $fin=$cant_habilidades;
                            }

                            for($i=0;$i<$cant_filas;$i++){
                                $active="";
                                if($i==0){
                                    $active="active";
                                }

                        ?>
                                
                          
                                <div class="carousel-item {{$active}}">
                                    <div class="row">                                
                                        
                                        <?php 
                                            $cant_cols=0;                                            
                                            for($j=$inicio;$j<$fin;$j++){      
                                                $cant_cols++;       
                                                if($cant_cols<=$cantidad_col){                               
                                        ?>

                                                    <div class="col-sm-3">
                                                        
                                                        <a href="{{url('')}}/c/{{$curso_destacado[$j]->SlugCurso}}" target="_blank" style="color: #000;">
                                                            <div class="card-docttus card-docttus-list">
                                                                <div style="width: 100%; position: relative;">
                                                                    <img src="{{url('')}}/assets/images/cursos/{{$curso_destacado[$j]->ImagenCurso}}" style="width:100%; border-radius:9px; margin-bottom:15px;">
                                                                    <span style="padding:5px; background-color:rgba(0, 0, 0, 0.6); position: absolute; right:0px; bottom:15px; color:#fff; ">{{$curso_destacado[$j]->cantidad_horas}} Horas</span>
                                                                </div>                
                                                
                                                                <div class="row" style="margin-top: 15px;">
                                                                    <div class="col-12">
                                                                        <h4 style="font-size: 16px;">{{$curso_destacado[$j]->NombreCurso}}</h4>
                                                                    </div>
                                                                </div>
                                                
                                                                <div class="row" >
                                                                    <div class="col-10">
                                                                        <small style="font-size:15px;">{{$curso_destacado[$j]->NombreSubcategoria}}</small>
                                                                    </div>                
                                                                </div>
                                                
                                                                <div class="row" style="margin-top: 25px;" >
                                                                    <div class="col-7">
                                                                        <small style="font-size:15px;">Por: <strong>{{$curso_destacado[$j]->TutorCurso}}</strong></small>
                                                                    </div>          
                                                
                                                                    <div class="col-5">
                                                                        <h3 class="pull-right" style="font-size:23px;">$ {{$curso_destacado[$j]->ValorPrecioProducto}}</h3>
                                                                    </div>
                                                
                                                
                                                
                                                                </div>
                                                
                                                            </div>
                                                        </a>



                                                    </div>

                                        <?php
                                                }else{
                                                    break;
                                                } 
                                            }

                                            $inicio=$j;
                                            $fin=$cant_habilidades;
                                        ?>
                                        
                                    </div>
                                </div>

                        <?php 

                        }

                        ?>


                    </div>

                    <!--Controls-->
                    @if(count($curso_destacado)>$cantidad_col)
                    <div class="controls-top" style="position: absolute; top:0px; width:100%;">
                        <a class="btn-floating btn-prev" href="#cursos-sugeridos" data-slide="prev">
                            <i class="fa fa-chevron-left"></i>
                        </a>
                        <a class="btn-floating  btn-next" href="#cursos-sugeridos" data-slide="next">
                            <i class="fa fa-chevron-right"></i>
                        </a>
                    </div>
                    @endif
                    <!--/.Controls-->


                </div>


                <div class="carousel slide" data-ride="carousel" id="cursos-sugeridos-m">
                    <div class="carousel-inner">


                        <?php 
                            
                            
                            $cantidad_col=1;
                            $cant_habilidades=count($curso_destacado);
                            $cant_filas=ceil($cant_habilidades/$cantidad_col);
                            $inicio=0;
                            $fin=$cantidad_col;

                            if($cant_habilidades<$cantidad_col){
                                $fin=$cant_habilidades;
                            }

                            for($i=0;$i<$cant_filas;$i++){
                                $active="";
                                if($i==0){
                                    $active="active";
                                }

                        ?>
                                
                          
                                <div class="carousel-item {{$active}}">
                                    <div class="row">                                
                                        
                                        <?php 
                                            $cant_cols=0;                                            
                                            for($j=$inicio;$j<$fin;$j++){      
                                                $cant_cols++;       
                                                if($cant_cols<=$cantidad_col){                               
                                        ?>

                                                    <div class="col-sm-3">
                                                        
                                                        <a href="{{url('')}}/c/{{$curso_destacado[$j]->SlugCurso}}" target="_blank" style="color: #000;">
                                                            <div class="card-docttus">
                                                                <div style="width: 100%; position: relative;">
                                                                    <img src="{{url('')}}/assets/images/cursos/{{$curso_destacado[$j]->ImagenCurso}}" style="width:100%; border-radius:9px; margin-bottom:15px;">
                                                                    <span style="padding:5px; background-color:rgba(0, 0, 0, 0.6); position: absolute; right:0px; bottom:15px; color:#fff; ">{{$curso_destacado[$j]->cantidad_horas}} Horas</span>
                                                                </div>                
                                                
                                                                <div class="row" style="margin-top: 15px;">
                                                                    <div class="col-10">
                                                                        <h4>{{$curso_destacado[$j]->NombreCurso}}</h4>
                                                                    </div>
                                                                </div>
                                                
                                                                <div class="row" >
                                                                    <div class="col-10">
                                                                        <small style="font-size:15px;">{{$curso_destacado[$j]->NombreSubcategoria}}</small>
                                                                    </div>                
                                                                </div>
                                                
                                                                <div class="row" style="margin-top: 25px;" >
                                                                    <div class="col-8">
                                                                        <small style="font-size:15px;">Por: <strong>{{$curso_destacado[$j]->TutorCurso}}</strong></small>
                                                                    </div>          
                                                
                                                                    <div class="col-4">
                                                                        <h3 class="pull-right">$ {{$curso_destacado[$j]->ValorPrecioProducto}}</h3>
                                                                    </div>
                                                
                                                
                                                
                                                                </div>
                                                
                                                            </div>
                                                        </a>



                                                    </div>

                                        <?php
                                                }else{
                                                    break;
                                                } 
                                            }

                                            $inicio=$j;
                                            $fin=$cant_habilidades;
                                        ?>
                                        
                                    </div>
                                </div>

                        <?php 

                        }

                        ?>


                    </div>

                    <!--Controls-->
                    <div class="controls-top" style="position: absolute; top:0px; width:100%;">
                        <a class="btn-floating btn-prev" href="#cursos-sugeridos-m" data-slide="prev" style="top:80px;">
                            <i class="fa fa-chevron-left"></i>
                        </a>
                        <a class="btn-floating  btn-next" href="#cursos-sugeridos-m" data-slide="next"  style="top:80px;">
                            <i class="fa fa-chevron-right"></i>
                        </a>
                    </div>
                    <!--/.Controls-->


                </div>


            </div>



        </div>

         <!-- FIN FILA 4 -->



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
            
            

            
        </div>

    -->



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
            <h5 style="font-size:15px;">Estudiante Docttus</h5>
            
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
        
        @if(count($curso_destacado)>0)
            <div class="row" style="margin-top: 35px; margin-bottom:20px;">
                <div class="col-md-12">
                    <h2 class="titulo-backoffice">Curso Destacado</h2>
                </div>
            </div>
            <a href="{{url('')}}/c/{{$curso_destacado[0]->SlugCurso}}" target="_blank" style="color: #000;">
            <div class="card-docttus">
                <div style="width: 100%; position: relative;">
                    <img src="{{url('')}}/assets/images/cursos/{{$curso_destacado[0]->ImagenCurso}}" style="width:100%; border-radius:9px; margin-bottom:15px;">
                    <span style="padding:5px; background-color:rgba(0, 0, 0, 0.6); position: absolute; right:0px; bottom:15px; color:#fff; ">{{$curso_destacado[0]->cantidad_horas}} Horas</span>
                </div>                

                <div class="row" style="margin-top: 15px;">
                    <div class="col-10">
                        <h4>{{$curso_destacado[0]->NombreCurso}}</h4>
                    </div>
                </div>

                <div class="row" >
                    <div class="col-10">
                        <small style="font-size:15px;">{{$curso_destacado[0]->NombreSubcategoria}}</small>
                    </div>                
                </div>

                <div class="row" style="margin-top: 25px;" >
                    <div class="col-8">
                        <small style="font-size:15px;">Por: <strong>{{$curso_destacado[0]->TutorCurso}}</strong></small>
                    </div>          

                    <div class="col-4">
                        <h3 class="pull-right">$ {{$curso_destacado[0]->ValorPrecioProducto}}</h3>
                    </div>



                </div>

            </div>
            </a>
        @endif
        <!-- FILA conviertase  -->

        <div class="card-docttus" style="margin-top: 25px;">
            <div class="row">
                <div class="col-12" style="text-align: center;">
                    <h2 class="titulo-backoffice" style="font-size: 20px; font-weight:bold; text-align:center; color:#000; margin-bottom:25px; margin-top:30px;">Conviertase en Afiliado</h2>
                    <p style="text-align: center;">Únete a nuestro programa de afiliados hoy y gana 50% de comisión <br />
                        ¡Construye tu propio imperio con marketing de afiliados!<br />
                        ¡Comienza a ganar una comisión jugosa de cada compra realizada por cada cliente que refiera a Docttus! puedes ganar dinero incluso cuando sales de fiesta, viajas o duermes si un cliente nuevo compra con tu link de referido.</p>
                    <a href="#"  onclick="cambiar_rol(3)" class="btn btn-secondary botones-docttus" style="margin-top: 15px;">Iniciar Ahora</a>            
                </div>
            </div>
        </div>

        <div class="card-docttus" style="margin-top: 25px;">
            <div class="row">
                <div class="col-12" style="text-align: center;">
                    <h2 class="titulo-backoffice" style="font-size: 20px; font-weight:bold; text-align:center; color:#000; margin-bottom:25px; margin-top:30px;">Conviertase en Tutor</h2>
                    <p style="text-align: center;">¡Gana dinero haciendo lo que amas!<br />
                        Crea y vende.<br />
                        ¡Construye tu propio imperio Educativo!<br />
                        ¡Haz que tu talento Creativo trabaje para ti! Haz lo que amas, pon tu conocimiento a la venta en Docttus y convierte tus habilidades y conexiones en un valor monetario.</p>
                    <a href="#" onclick="cambiar_rol(2)" class="btn btn-secondary botones-docttus" style="margin-top: 15px;">Iniciar Ahora</a>            
                </div>
            </div>
        </div>


        

    </div>

    <!-- fiN PANEL DERECHO -->

    
    


</div>
@stop   