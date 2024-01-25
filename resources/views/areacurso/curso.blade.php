@extends('areacurso.plantillas.plantilla-area-interna')
@section('contenido')   

<style type="text/css">
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
 




<div class="row">
  <div class="col-md-9">
    
    <div class="row">
        <div class="col-md-6">
          
          <div class="card-docttus panel-superior-curso">
            <div class="row">
                <div class="col-md-12">
                  <h2 class="titulo-backoffice">Progreso</h2>
                </div>

                <div class="col-md-12">
                  <div id="donut-chart" style="height: 180px;"></div>
                </div>
              
            </div>

            <div class="row" style="margin-top:25px;">
              <div class="col-4">
                  <div class="row">
                    <div class="col-2">
                      <i class="fa fa-circle" style="color: #FFCE25;" aria-hidden="true"></i>
                    </div>

                    <div class="col">
                        <h3 style="font-size: 15px; margin:0px; padding:0px;">{{$porcentaje_completado}}%</h3>
                        <small style="display: block; margin-top:-5px;">Completado</small>
                    </div>
                  </div>
              </div>

              <div class="col-4">

                <!--<div class="row">
                  <div class="col-a">
                    <i class="fa fa-circle" style="color: #FFEDBA;" aria-hidden="true"></i>
                  </div>

                  <div class="col">
                      <h3 style="font-size: 15px; margin:0px; padding:0px;">75%</h3>
                      <small style="display: block; margin-top:-5px;">En Progreso</small>
                  </div>
                  
                </div>-->


              </div>

              <div class="col-4">

                <div class="row">
                  <div class="col-2">
                    <i class="fa fa-circle" style="color: #F1F2F8;" aria-hidden="true"></i>
                  </div>

                  <div class="col">
                      <h3 style="font-size: 15px; margin:0px; padding:0px;">{{$porcentaje_por_iniciar}}%</h3>
                      <small style="display: block; margin-top:-5px;">Por Iniciar</small>
                  </div>
                  
                </div>


              </div>
            </div>

          </div>            
        </div>

        

        <div class="col-md-6">
            <div class="card-docttus panel-superior-curso">

              <div class="col-md-12">
                <h2 class="titulo-backoffice">Evaluación Curso</h2>
              </div>

              <div class="col-md-12">
                  <a href="{{url('')}}/tema/{{$info_curso->SlugCurso}}/evaluacion" class="btn btn-secondary botones-docttus">Presentar Evaluación</a>            
              </div>

            </div>
        </div>

    </div>

    <div class="row" style="margin-top: 25px;">
       <div class="col-md-12">

          <div class="card-docttus">

            <h2 class="titulo-backoffice">Curso</h2>
            <h1 style="    font-weight: 400;">{{$info_curso->NombreCurso}}</h1>
             <div class="row fila-info info-curso">
               <div class="col-md-4">
                  <small><i class="fa fa-video-camera icono" aria-hidden="true"></i> {{$info_curso->cantidad_lecciones}} Lecciones</small>
               </div>
     
               <div class="col-md-4">
                  <small><i class="fa fa-list-ul icono" aria-hidden="true"></i> {{$info_curso->cantidad_modulos}} Módulos</small>
               </div>
     
               <div class="col-md-4">
                 <small><i class="fa fa-clock-o icono" aria-hidden="true"></i> {{$info_curso->cantidad_horas}} Horas</small>
               </div>
             </div>           
            <p>{!!$info_curso->DescripcionCurso!!}</p>
            
            @foreach ($habilidades_curso as $habilidad)
              <div class="item_habilidad">
                  <img src="{{url('')}}/assets/images/habilidades/{{$habilidad->IconoHabilidad}}"> <span>{{$habilidad->NombreHabilidad}}</span>
              </div>
            @endforeach

            <br />

            @if($continuar)
              <a href="{{url('')}}/leccion/{{$continuar->CodigoTema}}" class="btn botones-docttus" style="margin-top: 15px;">Continuar Curso</a>

            @endif


          </div>

       </div>
    </div>

    <div class="row" style="margin-top: 25px;">
      <div class="col-md-12">

        <div class="card-docttus">

            <h2 class="titulo-backoffice">Lecciones Del Curso</h2>

            <?php
              $contador_modulos=0;
            ?>

            @foreach($info_curso->modulos as $modulo)

										<?php
											$contador_modulos++;
											$abrir_acordion="";
											if($contador_modulos==1){
												$abrir_acordion="show";
                      }
                      
                      


										?>
										
										<div id="accordion_lecciones_{{$modulo->IdModulo}}" class="acordion_ficha">
										<!-- INICIO MODULO -->

										<button class="btn btn-link btn-modulo" data-toggle="collapse" data-target="#collapse_{{$modulo->IdModulo}}" aria-expanded="true" aria-controls="collapse_{{$modulo->IdModulo}}" style="color:#000; margin-top: 5px; width:100%; text-align:left; background-color:#E8E8E8; border-radius:0px; border:1px solid #ccc; padding:15px 10px;">
									         {{$modulo->NombreModulo}}  <i style="float: right; margin-top: 4px;" class="fa fa-plus-circle" aria-hidden="true"></i>
									  </button>									  
									    

									    <div id="collapse_{{$modulo->IdModulo}}" class="collapse {{$abrir_acordion}} contenedor-lecciones" aria-labelledby="headingOne" data-parent="#accordion_lecciones_{{$modulo->IdModulo}}">									      
									        
									       <ul class="list-group list-group-flush">											  
											
											
									       	<!-- ITEM LECCIÓN -->
									       	 @foreach($info_curso->lecciones as $leccion)
									       	    @if($modulo->IdModulo == $leccion->IdModulo)


                                <?php 
                                
                                  $icono_visualizacion='<i  style="font-size:15px;" class="fa fa-circle-o" aria-hidden="true"></i>';
                                  if(session('rol_solicitud')!="root"){
                                    foreach($info_lecciones_estado as $estadoleccion){
                                      if($estadoleccion->IdTema==$leccion->IdTema && $estadoleccion->EstadoTemaAvance==1){
                                          $icono_visualizacion='<i style="color:#19d2d1; font-size:15px;" class="fa fa-circle" aria-hidden="true"></i>';
                                      }
                                    }
                                  }

                                ?>

													
														<a class="clase_gratis" style="cursor: pointer; color:#6D707F;" href="{{url('')}}/leccion/{{$leccion->CodigoTema}}">
							                <li class="list-group-item" style="padding:15px 10px; border:1px solid #ccc;">
                                <div class="row">
                                  <div class="col-8">                                    
                                    {!!$icono_visualizacion!!}
                                    
                                    <span>{{$leccion->NombreTema}}</span>
                                  </div>
                                  <div class="col-4"  style="text-align: right;">
                                    <span>{{$leccion->DuracionTema}} Min</span>
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
      </div>
    </div>


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

    


  </div>

  <div class="col-md-3">


     <!-- FILA EDICIÓN -->
     <div class="card-docttus" style="text-align: center;">
            
      <div class="image">
          <img src="{{url('')}}/assets/images/usuarios/{{$info_tutor->FotoPersona}}" class="img-circle elevation-2" alt="User Image" style="width: 130px;">
      </div>

      <h3 style="font-size:18px; font-weight:bold; margin-top:25px;">{{$info_tutor->NombrePersona}}</h3>
      <h5 style="font-size:15px;">Tutor Docttus</h5>

      <p style="text-align: center; font-size: 13px;">{{$info_tutor->DescripcionPersona}}</p>
      
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
      
      
      <a href="{{url('')}}/usuario" class="btn btn-secondary botones-docttus">Ver Más Cursos</a>            
  </div>
  


  <div class="card-docttus" style="margin-top: 25px;">
    <div class="row">
        <div class="col-12" style="text-align: center;">
          <h3 style="font-size: 90px; text-align: center; ">{{round($promedio_reviews_curso,1)}}</h3>
          <span>Valoración del curso</span><br />

          <?php 
            for($i=1;$i<=5;$i++){
             
              if($promedio_reviews_curso>=$i){
                echo('<i class="fa fa-star estrella" aria-hidden="true" style="color: #F4C14E;"></i>');          
              }else{
                echo('<i class="fa fa-star-o estrella" aria-hidden="true" style="color: #F4C14E;"></i>');
              }
            }
          ?>

          <br /><br />
          <a href="#" id="btn_comentario" class="btn btn-secondary botones-docttus">Valorar</a>            

        </div>
    </div>
</div>




  <div class="card-docttus" style="margin-top: 25px;">
      <div class="row">
          <div class="col-12" style="text-align: center;">
              <h2 class="titulo-backoffice" style="font-size: 20px; font-weight:bold; text-align:center; color:#000; margin-bottom:25px; margin-top:30px;">Conviertase en Afiliado</h2>
              <p style="text-align: center;">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Eligendi, reprehenderit. Natus incidunt blanditiis quisquam nisi ducimus necessitatibus! Cum sed nam laborum explicabo ratione dolores vel corporis perferendis laboriosam? Ratione, saepe.</p>
              <a href="{{url('')}}/ganar-dinero/afiliado" class="btn btn-secondary botones-docttus" style="margin-top: 15px;">Iniciar Ahora</a>            
          </div>
      </div>
  </div>

  <div class="card-docttus" style="margin-top: 25px;">
      <div class="row">
          <div class="col-12" style="text-align: center;">
              <h2 class="titulo-backoffice" style="font-size: 20px; font-weight:bold; text-align:center; color:#000; margin-bottom:25px; margin-top:30px;">Conviertase en Tutor</h2>
              <p style="text-align: center;">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Eligendi, reprehenderit. Natus incidunt blanditiis quisquam nisi ducimus necessitatibus! Cum sed nam laborum explicabo ratione dolores vel corporis perferendis laboriosam? Ratione, saepe.</p>
              <a href="{{url('')}}/ganar-dinero/tutor" class="btn btn-secondary botones-docttus" style="margin-top: 15px;">Iniciar Ahora</a>            
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

    
    <script type="text/javascript">



      $(function(){

        var donutData = [
        
        {
          label: 'Completado',
          data : {{$porcentaje_completado}},
          color: '#FFCE25'
        },
        {
          label: 'Por iniciar',
          data : {{$porcentaje_por_iniciar}},
          color: '#F1F2F8'
        }
      ]

        $.plot('#donut-chart', donutData, {
          series: {
            pie: {
              show       : true,
              radius     : 1,
              innerRadius: 0.8,
              label      : {
                show     : false,
                radius   : 2 / 3,
                formatter: labelFormatter,
                threshold: 0.1
              }

            }
          },
          legend: {
            show: false
          }
        })        
    });


    function labelFormatter(label, series) {
    return '<div style="font-size:12px; text-align:center; padding:2px; color: #fff; font-weight: 300;">'
      
      + '<br>'
      + Math.round(series.percent) + '%</div>'
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
    //.attr("star")   

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



    </script>
@stop