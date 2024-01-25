@extends('areacurso.plantillas.plantilla-contenido')
@section('contenido')   
      

<style type="text/css">
  .col-izq{
    
  }
  .col-der{
    width: 326px;
    padding: 0px; margin: 0px; background-color: #242746; 
  }
  
  

  .contenido-texto{    
    width: 100%; 
    color: #fff; 
    padding: 15px; 
    font-size: 13px; 
    font-weight: 300; 
    color: #fff;      
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

  .respuesta_fila_contenedor{
    display: none;
  }

  .fila_respuesta{
    
    margin: 0px; padding: 0px; padding-left: 25px; margin-bottom: 15px; padding-bottom: 10px;
  }

.contenedor_respuesta{
  display: none;
}
  

  /* width */
::-webkit-scrollbar {
  width: 7px;
}

/* Track */
::-webkit-scrollbar-track {
  /*box-shadow: inset 0 0 5px grey; */
  border-radius: 10px;
}
 
/* Handle */
::-webkit-scrollbar-thumb {
    background-color: #2c456f;
  
  border-radius: 10px;
}

/* Handle on hover */
::-webkit-scrollbar-thumb:hover {
    background-color: #2c456f;
}

.modal-usuario{
  position: absolute; 
  z-index: 999; 
  width: 264px; 
  background-color: #fff;	
  height: auto;	
  margin-top: 8px;	
  right: 0px; 
  border:1px solid #ccc;
  box-shadow: 0px 5px 10px 0px #c5c5c5;
  display: none;
  

}
.modal-usuario .contenedor{
    padding: 10px;
    widows: 100%;
}

.modal-usuario a{
    color:#000;
    padding:3px;
    text-decoration: none;  
    display: block;
}

.modal-usuario .nav-icon{
  width: 23px;
  text-align: center;
}

.contenido{    
    padding-top: 69px;
    height: 100vh;
    overflow-y: hidden;
    background-color: #14162f;
    padding-right: 25px;
    padding-left: 25px;
}

.contenido__tarjetacomentario{    
    background-color: #24385b;
    padding: 11px !important;
    border-radius: 11px;
    margin: 0px; 
    margin-bottom: 15px; 
    padding-bottom: 10px;
    position: relative;
    
}

.contenido__tarjetacomentario_interno{
    background-color: #3a5a8e;
    padding: 11px !important;
    border-radius: 11px;
    margin: 0px; 
    margin-bottom: 15px; 
    padding-bottom: 10px;
    margin-top: -14px;
    padding-left: 18px !important;
    border-left: 17px solid #24385b;
    position: relative;
}

.contenido__etiquetatutor{
    display: block;
    background-color: #19d1d1;
    font-size: 10px;
    width: 84px;
    text-align: center;
    border-radius: 9px;
    color: #000;
    font-weight: 700;
}


.contenido__informacion_item{
    padding-top: 15px;
    display: none;
}

.contenido__iconcontainerleccion{    
    padding-left: 16px;
    text-align: center;
}


.contenido__iconoarchivo{
    width: 41px;
    padding-left: 16px;
    text-align: center;
    font-size: 26px;

}


.contenido__rightbar{    
    padding-top: 25px;    
    height: 92vh;
    padding-right: 8px;
    overflow-x: hidden;
    overflow-y: hidden;
    padding-right: 15px;
    padding-left: 15px;
    width: 492px;
    display: flex;
}

.contenido__rightbar:hover{
    overflow-y: scroll;
    padding-right: 8px;
}



.contenido__principal{
    padding-top: 25px;    
    height: 92vh;
    padding-right: 15px;
    overflow-x: hidden;
    overflow-y: hidden;
}
.contenido__principal:hover{
    overflow-y: scroll;
    padding-right: 8px;
}

.menutema{
    background-color: #0B5586;
    padding: 5px;
    position: fixed;
    width: 100%;
    z-index: 999999;
    top: 0px;
}

.menutema__logo{
    height: 40px;
}

.contenido__btn_eliminar{
    color: #fff;
    position: absolute;
    top: 5px;
    right: 5px;
    cursor: pointer;
    z-index: 999;
}

.contenido__titilo{
    color: #fff;
    font-weight: normal;
    text-transform: capitalize;
}

.contenido__descripcion{
    color: #fff;
    font-weight: 300;
}


.contenido__item{
    margin-bottom: 15px;
    color: #fff !important;
    font-weight: 300 !important;
}

.contenido__texto  p{
    color: #fff !important;
    font-weight: 300;
}

.contenido__texto  h4{
    color: #fff !important;
    font-weight: 300;
}

.contenido__nombrecurso{
    color: #fff;
}

.contenido__boton_footer{
    color: #fff;
}

.contenido__boton_menu{
    border: none;   
    background-color: transparent;    
    color: #18c8cb59;    
    padding: 5px  25px;
}

.contenido__boton_menu.activo,.contenido__boton_menu:hover{
    color: #19d1d1;
    border-bottom: 2px solid #19d1d1;
    background-color: #0B5586;
    outline: none;
}



.contenido__menu{
    border-bottom: 1px solid #18c8cb59;
}

.contenido__icono_leccion{
    margin-right: 15px;
}

.contenido__separador_leccion_1{
    border-right: 2px solid #fff;
    position: absolute;
    height: 13px;
    top: 0px;
    left: 21px;
}

.contenido__separador_leccion_2{
    border-right: 2px solid #fff;
    position: absolute;
    height: 100%;
    bottom: 0px;
    left: 21px;
}

.contenido__item_listado{
    position: relative;
    cursor: pointer;
    width: 100%;
    padding-top: 10px;
    padding-bottom: 10px;
    display: inline-block;
    border-bottom: 1px solid #4b506b;
    padding-left: 15px;
    color: #fff;
    text-decoration: none;
    font-size: 13px;
    background-color: #31354c;
}

.contenido__item_listado:hover{
    background-color: #4b506b;
    color: #fff;
    text-decoration: none;
}

#btn_contenido_4{
    display: none;
}


.contenido__footer{
    padding-bottom: 25px;
}

.contenido__boton_footer{
    border: none;   
    background-color: transparent;    
    border-bottom: 2px solid transparent;
    color: #18c8cb59;    
    padding: 5px  25px;
}

.contenido__boton_footer.activo,.contenido__boton_footer:hover{
    color: #19d1d1;
    border-bottom: 2px solid #19d1d1;
    background-color: #0B5586;
    outline: none;
}
.contenido__comentarios{
    width: 100%;
}





@media only screen and (max-width: 1024px) {
    .contenido__rightbar{
        width: 350px;
    }
}

@media only screen and (max-width: 991px) {

    .contenido__rightbar, .contenido__principal,.contenido{
        height: auto !important;
        overflow-y: auto;
    }

    .contenido__botoncalificacion span{
        display: none;
    }

    .contenido__principal,.contenido__rightbar{
        width: 100%;
    }

    .contenido__botoncalificacion i{
        font-size: 30px;
    }

    .contenido__boton_menu{
        width: 100%;
    }

    .contenido__comentarios{
        display: none;
        widows: 100%;
    }

    #btn_contenido_4{
        display: block;
    }
    

    .col-der{
       width: 100%;
    }
    .col-izq{
      width: 100% !important;
      display: contents;
      height: auto;
    }

   body,html{
        background-color: #0f1124;
        overflow-y: auto; /* Hide vertical scrollbar */
  overflow-x: auto; /* Hide horizontal scrollbar */
      }

      .col-contenido{
        height: auto;
      }

      .botones-docttus{
         font-size: 12px;
      }
}

.vjs-big-play-button {
            left: 50% !important;
            top: 50% !important;
            transform: translate(-50%, -50%);
            width: 80px!important;
            height: 50px!important;
            -webkit-border-radius: 0.8em!important;
            -moz-border-radius: 0.8em!important;
            border-radius: 1.9em!important;
        }


</style>

<div class="menutema">
    <div class="container-fluid">
        <div class="row">
            <div class="col-6">
                <img src="{{url('')}}/assets-marketing/images/nuevo_logo_docttus.png" class="menutema__logo" alt="">
            </div>

            <div class="col-6 text-right">
                
                <div style="display: inline-block;">
                    @if(count($notificaciones)>0)
                        <?php 
                        $cant_notific=count($notificaciones);
                        $notificacion_numero="{$cant_notific}";
                        if($cant_notific>99){
                        $notificacion_numero="99+";
                        }

                 ?>

      
                    <div class="dropdown">
                        <a class="nav-link" data-toggle="dropdown" href="#"  style="font-size: 19px;">
                            <i class="fa fa-bell" style="color: #fff;"></i>
                            <span class="badge badge-danger navbar-badge" id="cant_notificacion" cantidad="{{$notificacion_numero}}" >{{$notificacion_numero}}</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        @php 
                            $contador=0;
                        @endphp

                        @foreach($notificaciones as $notificacion)   

                            @php 
                            $contador++;
                            @endphp

                            @if($contador<=3)                         
                                <a href="#" onclick="visualizar_noticia({{$notificacion->IdNoticias}})" noticia-url="{{$notificacion->URLNoticia}}" id="noticia_{{$notificacion->IdNoticias}}" class="dropdown-item">
                                    <!-- Message Start -->
                                    <div class="media">              
                                        <div class="media-body" style="width:100%;">
                                            <p class="dropdown-item-title" style="font-weight: 600; color: #0b5586;  display: inline-block;  width: 100%; font-size: 13px;">
                                                {{$notificacion->TituloNoticia}}
                                            </p>
                                            <p class="text-sm" style=" font-size: 13px;" >{{$notificacion->DescripcionNoticia}}</p>
                                            <p class="text-sm text-muted"><i class="fa fa-clock-o mr-1"></i> {{\Carbon\Carbon::parse($notificacion->FechaCreacion)->diffForHumans()}}</p>
                                        </div>
                                    </div>
                                    <!-- Message End -->
                                </a>
                                <div class="dropdown-divider"></div>     
                            @endif
                        
                        @endforeach                    
                    
                            <a href="#" class="dropdown-item dropdown-footer">Ver todas las notificaciones</a>

                        </div>
                    </div>

                @endif
                </div>


                <div  style="display: inline-block;">
                    <a style="width: 40px; height: 40px; display: inline-block;" href="#" id="btn-usuario-registro" >
                      <img src="{{url('')}}/assets/images/usuarios/{{$data[0]->FotoPersona}}" style="width: 100%;" style="border-radius: 45px;">
                    </a>
    
                    <div class="modal-usuario">
                      <div class="contenedor" style="border-bottom: 1px solid #ccc; text-align:left;">
                        <div class="row">
                          <div class="col-4">
                            <div   style="width: 65px; height: 65px; display: inline-block; border-radius: 55px; background-position: center; background-size: cover; background-repeat: no-repeat; background-image: url({{url('')}}/assets/images/usuarios/{{$data[0]->FotoPersona}});">
                            </div>
                          </div>
                          <div class="col-8" style="padding-top: 10px;">
                            <h3 style="font-size: 16px;">{{$data[0]->NombrePersona}}</h3>
                            <small>{{$data[0]->EmailPersona}}</small>
                          </div>
                        </div>
                      </div>
            
            
                      <div class="contenedor" style="border-bottom: 1px solid #ccc; text-align:left;">
                        <div class="row">
                          <div class="col-12">
                            <a class="btn-usuario-menu" href="{{url('')}}/backoffice">
                              <i class="nav-icon fa fa-home"></i>  Inicio
                            </a>
                          </div>										
            
                          @if(session('rol_solicitud')=="estudiante")
                            <div class="col-12">
                              <a class="btn-usuario-menu" href="{{url('')}}/cursos/disponibles">
                                <i class="nav-icon fa fa-graduation-cap"></i>  Mis Cursos
                              </a>
                            </div>				
                          @endif
    
                          
            
                          <div class="col-12">
                            <a class="btn-usuario-menu" href="{{url('')}}/usuario">
                              <i class="nav-icon fa fa-user"></i>  Editar Usuario
                            </a>
                          </div>				
            
                          <div class="col-12">
                            <a class="btn-usuario-menu" href="{{url('')}}/logout">
                              <i class="nav-icon fa fa-times"></i>  Cerrar Sesión
                            </a>
                          </div>				
            
                        </div>
                      </div>
            
            
                    </div>
                </div>

                



            </div>
          
        </div>
    </div>
</div>

<div class="container-fluid contenido">
    <div class="row">
        <div class="contenido__principal col">

            <div class="row">
                <div class="col">
                    <small class="contenido__nombrecurso">{{$curso->NombreCurso}}</small>                    
                </div>
                <div class="col-4 text-right">
                    
                    <a href="#" class="contenido__botoncalificacion" id="btn_comentario" style="color: #fff; font-size: 16px;" data-toggle="tooltip" data-placement="bottom" title="Calificar Curso" >
                        <span>Calificar Curso </span>
                        <i class="fa fa-star-o" aria-hidden="true"></i>
                    </a>
                </div>
            </div>

            <h1 class="contenido__titilo">@if($tipo_contenido=="leccion"){{$info_leccion->NombreTema}}@else{{$info_leccion->NombreModulo}}@endif</h1>
            <p class="contenido__descripcion">@if($tipo_contenido=="leccion"){{$info_leccion->DescripcionTema}}@else{{$info_leccion->DescripcionModulo}}@endif</p>
            <div class="contenido__cover">
            </div>

            <div class="contenido__contenedor">
                <div class="contenido__menu">
                    <div class="row">
                        <div class="col-md-6">
                            <button class="contenido__boton_menu activo" id-button="1" type="button" id="btn_contenido_1">Contenido</button>
                            <button class="contenido__boton_menu" id-button="2"  type="button" id="btn_contenido_2">Recursos</button>
                        </div>

                        <div class="col-md-6 text-right">
                            <button class="contenido__boton_menu" id-button="3"  type="button" id="btn_contenido_3" style="margin-right: 0px;">Temario</button>
                            <button class="contenido__boton_menu" id-button="4"  type="button" id="btn_contenido_4" style="margin-right: 0px;">Comentarios</button>
                        </div>
                    </div>
                    
                    
                    
                </div>
                <div class="contenido__informacion">

                    <div class="contenido__contenido contenido__informacion_item"  id="contenido_1" style="display: block;">

                        @foreach($info_media as $media)

                            <div class="row contenido__item">
                                
                                <div class="col-md-12">                                    
                                    @if($media->TipoMedia==1)
                                    
                                        <div class="col-contenido embed-responsive embed-responsive-16by9">
                                            {!!$media->VideoEmbed!!}
                                        </div>
                                        <!-- 16:9 aspect ratio -->
                                        
                                    @endif

                                    @if($media->TipoMedia==2)
                                        <img class="img-fluid" src="{{url('')}}/{{$media->URLMedia}}" >
                                    @endif

                                    @if($media->TipoMedia==3)
                                        <div class="contenido__texto">
                                            {!!$media->ContenidoMedia!!}
                                        </div>
                                    @endif

                                </div>

                            </div>
                        @endforeach

                        <div class="contenido__footer">
                            <div class="row">
                                <div class="col-6">
                                    @if(session('rol_solicitud')!="root")
                                        @if($info_leccion->EstadoTemaAvance==1)
                                            <button class="btn btn-default contenido__boton_footer activo" id="btn_marcar_como_vista" type="button"><i class="fa fa-check-circle-o" aria-hidden="true"></i>  Finalizada</button>
                                        @else
                                            <button class="btn btn-default contenido__boton_footer"  id="btn_marcar_como_vista" type="button"><i class="fa fa-check-circle" aria-hidden="true"></i> Marca como vista</button>
                                        @endif
                                    @endif

                                </div>
            
                                <div class="col-6 text-right">
                                    @if(count($info_siguiente)>0)
                                        <a class="btn contenido__boton_footer" href="{{url('')}}/tema/{{$curso->SlugCurso}}/leccion/{{$info_siguiente[0]->CodigoTema}}" style="float: right;">Siguiente Lección</a>
                                    @endif
                                    <!--<button class="btn btn-default contenido__boton_footer" type="button">Siguiente</button>-->
                                </div>
                            </div>
                            
                            
                        </div>

                    </div>
                    <div class="contenido__recursos contenido__informacion_item" id="contenido_2">
                        
                        <?php
                        $exist_documents=0;
                        for($ik=0;$ik<count($info_media);$ik++){
                            if($info_media[$ik]->TipoMedia==5 || $info_media[$ik]->TipoMedia==6 ){
                                $exist_documents=1;
                                break;
                            }
                        }
                      ?>
                        
                        @if($exist_documents==1)
                        
                        <div class="list-group">
                          @foreach($info_media as $media)
                            @if($media->TipoMedia==5 || $media->TipoMedia==6 )
                              <a href="@if($media->TipoMedia==5){{url('')}}/documentos/{{$media->URLMedia}} @else {{$media->ContenidoMedia}} @endif " target="_blank" @if($media->TipoMedia==5)download @endif class="list-group-item list-group-item-action contenido__item_listado">  
                                    <div class="row">
                                        <div class="contenido__iconoarchivo">
                                            @if($media->TipoMedia==5)
                                                <i class="fa fa-download" aria-hidden="true"></i> 
                                            @else
                                                <i class="fa fa-link" aria-hidden="true"></i> 
                                            @endif
                                        </div>
                                        <div class="col">
                                            {{$media->NombreMedia}}<br />
                                            <small>{{$media->ContenidoMedia}}</small>
                                        </div>
                                    </div>
                                  
                                  
                              </a>
                            @endif
                          @endforeach      
                          
                        </div>
                        @endif
              


                    </div>
                    <div class="contenido__temario contenido__informacion_item" id="contenido_3">

                        <div class="tab-pane fade show active" id="modulos" role="tabpanel" aria-labelledby="modulos-tab">
                            <div style=" height: auto !important; ">
                      
                              <?php 
                                $contador_modulos=0;
                              ?>
                  
                              @foreach($info_modulos as $modulo)
                  
                              <?php
                                $contador_modulos++;
                                $abrir_acordion="show";
                                if($modulo->IdModulo==$info_leccion->IdModulo){
                                  $abrir_acordion="show";
                                }
                              ?>
                              
                              <div id="accordion_lecciones_{{$modulo->IdModulo}}" class="acordion_ficha" style=" color:#fff; padding: 0px; margin-bottom: 5px;"> 
                              <!-- INICIO MODULO -->
                  
                                <a href="{{url('')}}/tema/{{$curso->SlugCurso}}/modulo/{{$modulo->IdModulo}}" class="btn btn-info" style="margin-top: 0px; width: 100%; text-align: left; border-radius: 0px;">
                                     <strong>{{$modulo->NombreModulo}} </strong><br/>
                                     <span style="font-size: 12px;   margin-top: -6px;  padding: 0px;  display: block;">{{$modulo->cantidad_lecciones}} Lecciones</span>                   
                                </a>                   
                                
                  
                                <div id="1collapse_{{$modulo->IdModulo}}" class=" {{$abrir_acordion}} contenedor-lecciones" aria-labelledby="headingOne" data-parent="#accordion_lecciones_{{$modulo->IdModulo}}">                       
                                    
                                   
                                
                                
                                    <!-- ITEM LECCIÓN -->
                                     @foreach($info_lecciones as $leccion)
                                        @if($modulo->IdModulo == $leccion->IdModulo)
                  
                  
                                              <?php 
                                                
                                                $color_sel="";
                                                if($tipo_contenido=="leccion"){
                                                    if($info_leccion->IdTema ==$leccion->IdTema){
                                                        $color_sel="background-color: #4b506b;";
                                                    }
                                                }
                                                

                                                $color_active="#fff";

                                                $icono_visualizacion='<i  style="font-size:15px;" class="fa fa-circle" aria-hidden="true"></i>';
                                                if(session('rol_solicitud')!="root"){
                                                  foreach($info_lecciones_estado as $estadoleccion){
                                                    if($estadoleccion->IdTema==$leccion->IdTema && $estadoleccion->EstadoTemaAvance==1){
                                                        $color_active="#19d2d1";
                                                        $icono_visualizacion='<i style="color:#19d2d1; font-size:15px;" class="fa fa-circle" aria-hidden="true"></i>';
                                                    }
                                                  }
                                                }
                  
                                              ?>
                                              
                                            
                                                <a href="{{url('')}}/tema/{{$curso->SlugCurso}}/leccion/{{$leccion->CodigoTema}}" class="contenido__item_listado" style="{{$color_sel}} ">
                                                    <div class="row">
                                                        <div class="contenido__iconcontainerleccion">
                                                            <div class="contenido__separador_leccion_1" style="border-right:2px solid {{$color_active}};"></div>
                                                            <span class="contenido__icono_leccion" id="clase_{{$leccion->IdTema}}">{!!$icono_visualizacion!!}</span>
                                                            <div class="contenido__separador_leccion_2"  style="border-right:2px solid {{$color_active}};"></div>
                                                        </div>
                                                        <div class="col">
                                                            <span> {{$leccion->NombreTema}}</span>
                                                        </div>
                                                    </div>
                                                    
                                                    
                                                    
                                                </a>
                                            
                  
                  
                                            @endif
                                         <!-- FIN ITEM LECCIÓN -->
                                         @endforeach
                  
                  
                                
                  
                                </div>                   
                  
                                <!-- fin MODULO -->
                                </div>
                  
                                @endforeach
                  
                      
                  
                            </div>
                  
                  
                  
                  
                  
                          </div>
                          <!-- FIN MODULOS -->


                    </div>
                </div>
            </div>

            

        </div>

        <div class="contenido__rightbar">
            <div class="contenido__barra">

            </div>
            
            <div class="contenido__comentarios">
                <div style="width: 100%; padding: 0px; color: #fff;">
                    <h4 style="font-size: 15px;">Comentarios ({{count($info_comentarios)}})</h4>  

                    <form id="formulario_comentario_0">
                        <textarea class="form-control" rows="3" required placeholder="Deja tu comentario o duda" id="comentario_nuevo" style="font-size: 13px;"></textarea>
                        <div style="width: 100%; text-align: right;">
                            <button class="btn contenido__boton_footer" style="color: #19d1d1; margin-top:5px;" type="submit">Enviar</b>                 
                        </div>   
                    </form>                   
        
                    <div style="width: 100%; margin-top:15px;" id="listado_comentarios_leccion">
                        
                    </div>
        
                </div>
            </div>

        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modal-valoracion" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="    z-index: 99999999;">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
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

  $(function () {
    $('[data-toggle="tooltip"]').tooltip();
    tamano_panel();
    
    @if(count($valoracion)>0)
      calificacion_estrella="{{$valoracion[0]->ValorCalificacion}}";
    @endif

    set_estrella(calificacion_estrella);
    cargar_comentarios();
  });
  
  

    $(".contenido__boton_menu").click(function(e){
        e.preventDefault();
        var id_boton=$("#"+e.target.id).attr("id-button");      
        $(".contenido__boton_menu").removeClass("activo");
        $("#btn_contenido_"+id_boton).addClass("activo");

        $(".contenido__informacion_item").hide(); 
        $("#contenido_"+id_boton).show();
        
        if(id_boton=="4" && $("#btn_contenido_4").is(":visible")){
            $(".contenido__comentarios").show();
        }
        if(id_boton!="4" && $("#btn_contenido_4").is(":visible")){
            $(".contenido__comentarios").hide();
        }

    });



  function tamano_panel(){
    var alto_panel=210;
    var total_panel=$(".col-der").outerHeight();

    var alto_tab=total_panel-alto_panel;

    $("#myTabContent").css("height",alto_tab+"px");
  }

  $( window ).resize(function() {
    tamano_panel();
  });


    @if(session('rol_solicitud')!="root")
      @if($info_leccion->EstadoTemaAvance==1)
        var id_estado_actual=1;
      @else
        var id_estado_actual=0;
      @endif
    @endif
    $("#btn_marcar_como_vista").click(function(e){       
        if(id_estado_actual==1){
          id_estado_actual=0;
        }else{
          id_estado_actual=1;
        }
        set_avance(id_estado_actual);
    });

    

    function set_avance(idestado){

      var request = $.ajax({
        url: "{{url('')}}/set_avance",
        type: "POST",
        data:{               
             idtema:"@if($tipo_contenido=='leccion'){{$info_leccion->IdTema}}@else{{$info_leccion->IdModulo}}@endif",
             idusuario:"{{$data[0]->IdUsuarioPersona}}",
             tipoavance:"1",
             idestado:idestado,
             tipo_contenido:"{{$tipo_contenido}}",
             _token: "{{ csrf_token() }}"
        }
      });

      request.done(function(obj) { 
         if(obj.status=="ok"){
            if(idestado=="1"){              
                id_estado_actual=1;
                $("#btn_marcar_como_vista").addClass("activo");
                $("#btn_marcar_como_vista").html('<i class="fa fa-check-circle" aria-hidden="true"></i> Finalizada');

                
                @if($tipo_contenido=='leccion')

                    $("#clase_{{$info_leccion->IdTema}}").html('<i class="fa fa-circle"  style="color:#19d2d1;" aria-hidden="true"></i>');

                @else

                    $("#clase_{{$info_leccion->IdModulo}}").html('<i class="fa fa-circle"  style="color:#19d2d1;" aria-hidden="true"></i>');

                @endif

            }else{
              $("#btn_marcar_como_vista").removeClass("activo");
              $("#btn_marcar_como_vista").html('<i class="fa fa-check-circle-o" aria-hidden="true"></i> Marca Como Vista');
              @if($tipo_contenido=='leccion')

                $("#clase_{{$info_leccion->IdTema}}").html('<i class="fa fa-circle-o" aria-hidden="true"></i>');

              @else
                $("#clase_{{$info_leccion->IdModulo}}").html('<i class="fa fa-circle-o" aria-hidden="true"></i>');
              @endif
              
              
              
              id_estado_actual=0;
            }
            mensaje_generico("Correcto",""+obj.mensaje,"1","Continuar...",function(){});
            return;
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


    


   

  $("#btn_archivos").click(function(e){
    e.preventDefault();
     $("#modal-archivos").modal("show");
  });

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
               IdCurso:"{{$info_leccion->IdCurso}}",               
               ObservacionCalificacion:""+ComentarioCalificacion,
               ValorCalificacion:""+calificacion_estrella,

               _token: "{{ csrf_token() }}"
          }
        });

        request.done(function(obj) { 
           if(obj.status=="ok"){          
              $("#modal-valoracion").modal("hide");  
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

  
  function abrir_respuesta(id_comentario){
    if(!$("#respuesta_fila_"+id_comentario).is(':visible')){
      $("#respuesta_fila_"+id_comentario).show();
    }else{
      $("#respuesta_fila_"+id_comentario).hide();
    }    
  }


  function abrir_form_respuesta(id_comentario){
    if(!$("#contenedor_respuesta_"+id_comentario).is(':visible')){
      $("#contenedor_respuesta_"+id_comentario).show();
    }else{
      $("#contenedor_respuesta_"+id_comentario).hide();
    }    
  }




  function enviar_comentario(mensaje,id_comentario_sel,id_respuesta_sel){
      
      var request = $.ajax({
          url: "{{url('')}}/set_comentarios",
          type: "POST",
          data:{               
               idtema:"@if($tipo_contenido=='leccion'){{$info_leccion->IdTema}}@else{{$info_leccion->IdModulo}}@endif",
               idcomentario:""+id_comentario_sel,
               idrespuesta:""+id_respuesta_sel,             
               mensaje:""+mensaje,
               tipo_contenido:"{{$tipo_contenido}}",
               idusuario:"{{$data[0]->IdUsuarioPersona}}",
               _token: "{{ csrf_token() }}"
          }
        });

      request.done(function(obj) { 
         if(obj.status=="ok"){            
            $("#responder_comentarios").modal("hide");
            if(id_respuesta_sel==""){
                $("#comentario_nuevo").val("");
            }            
            cargar_comentarios();

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




  $('#btn_usuario').click(function(e) {

      $("#modal-usuario").modal("show");

  });


  


  function cargar_comentarios(){
		var request = $.ajax({
			url: "{{url('')}}/get_comentarios_ajax",
			type: "POST",
			data:{               
				idtema:"@if($tipo_contenido=='leccion'){{$info_leccion->IdTema}}@else{{$info_leccion->IdModulo}}@endif",               
				_token: "{{csrf_token()}}",
                tipo_contenido:"{{$tipo_contenido}}",
			}
		});

		request.done(function(obj) { 
			if(obj.status=="ok"){                        
        
                var cadena_comentarios="";

                var obj_comentarios=obj.comentarios;

                for(var i=0;i<obj_comentarios.length;i++){
                    var comentario=obj_comentarios[i];                    

                    
                    var cadena_eliminar="";
                    if("{{$data[0]->IdUsuarioPersona}}"==obj_comentarios[i].IdUsuarioPersona){                        
                        cadena_eliminar=`<a title="Eliminar Comentario"  data-toggle="tooltip"  data-placement="left"   class="btn contenido__btn_eliminar" href="#" id="btn_eliminar_comentario_${comentario.IdComentario}" id-comentario="${comentario.IdComentario}" ><i class="fa fa-trash" aria-hidden="true"></i></a>`;
                    }

                    var cadena_tutor="";
                    if("{{$curso->IdUsuarioTutor}}"==obj_comentarios[i].IdUsuarioPersona){    
                        cadena_tutor=`<span class="contenido__etiquetatutor">Tutor Docttus</span>`;
                    }
                    

                    if(!comentario.IdComentarioPadre){

                        cadena_comentarios+=`         
                                    
                                    <div class="row contenido__tarjetacomentario">
                                    
                                        ${cadena_eliminar}
                                    
                                    <div style="width: 40px; height: 40px; border-radius: 25px; background-size: cover; background-position: center; background-repeat: no-repeat; background-image: url({{url('')}}/assets/images/usuarios/`+comentario.FotoPersona+`);">                          
                                    </div>
                                    <div class="col">
                                        <h5 style="font-size:14px; color: #fff; padding: 0px; margin: 0px;">`+comentario.NombreUsuario+`</h5>
                                        <small style="font-size: 10px; margin-top: -1px; display: block;">`+comentario.fecha_hace+`</small>
                                        ${cadena_tutor}
                                    </div>

                                    <div style="width: 100%; color: #fff; margin-top: 20px; ">
                                        <p style="font-size: 14px; font-weight: 300;">`+comentario.MensajeComentario+`</p>
                                        <a  class="responder_comentario"  href="#" style="color: #fff; font-size: 13px;"  onclick="abrir_form_respuesta(`+comentario.IdComentario+`)">
                                        <i class="fa fa-commenting-o" aria-hidden="true"></i> Responder
                                        </a>

                                        <div style="width: 100%;" class="contenedor_respuesta" id="contenedor_respuesta_`+comentario.IdComentario+`">
                                            <form id="formulario_comentario_`+comentario.IdComentario+`" class="form_comentario">
                                            <textarea class="form-control" placeholder="Deja tu comentario o duda" id="comentario_nuevo_`+comentario.IdComentario+`" required style="font-size: 13px;"></textarea>
                                            <div style="width: 100%; text-align: right;">
                                                

                                                <input type="hidden" id="id_comentario_`+comentario.IdComentario+`" value="`+comentario.IdComentario+`">
                                                <input type="hidden" id="id_comentario_respuesta_`+comentario.IdComentario+`" value="">


                                                <button type="submit" style="color: #19d1d1; margin-top:5px;" id_comentario="`+comentario.IdComentario+`" class="btn_enviar btn contenido__boton_footer" id="btn_enviar_`+comentario.IdComentario+`">Enviar</button>
                                            </div>
                                            </form>

                                        </div>

                                    </div>


                                    
                                    <br /><br />
                                    `;


                                    if(comentario.cant_respuesta>0){

                                    cadena_comentarios+=`
                                        <a href="#" class="responder_comentario"  onclick="abrir_respuesta(`+comentario.IdComentario+`)">
                                        <h5 style="font-size: 14px; color: #19d1d1; margin-top: 15px;">Mostrar `+comentario.cant_respuesta+` Respuestas <span style="padding-top: 3px;display: inline-block; height: 20px; font-size: 22px;"><i style="font-size: 16px;" class="fa fa-angle-down" aria-hidden="true"></i> </span></h5>
                                        </a>
                                    `;

                                    }
                                    cadena_comentarios+=`                         

                                    </div>                       


                                    <div class="respuesta_fila_contenedor" id="respuesta_fila_`+comentario.IdComentario+`">

                                    `;



                                    for(var j=0;j<obj_comentarios.length;j++){
                                        var comentarioRespuesta=obj_comentarios[j];
                                        
                                    
                                    
                                        if(comentarioRespuesta.IdComentarioPadre==comentario.IdComentario){

                                            var cadena_eliminar="";
                                            console.log(comentarioRespuesta);
                                            if("{{$data[0]->IdUsuarioPersona}}"==comentarioRespuesta.IdUsuarioPersona){                                                
                                                cadena_eliminar=`<a title="Eliminar Comentario"  data-toggle="tooltip"  data-placement="left"   class="btn contenido__btn_eliminar" href="#"  id-comentario="${comentarioRespuesta.IdComentario}"  id="btn_eliminar_comentario_${comentario.comentarioRespuesta}"  ><i class="fa fa-trash" aria-hidden="true"></i></a>`;
                                            }

                                            var cadena_tutor="";
                                            if("{{$curso->IdUsuarioTutor}}"==comentarioRespuesta.IdUsuarioPersona){    
                                                cadena_tutor=`<span class="contenido__etiquetatutor">Tutor Docttus</span>`;
                                            }
                                        
                                            cadena_comentarios+=`

                                                <div class="row fila_respuesta contenido__tarjetacomentario_interno">
                                                    
                                                    ${cadena_eliminar}
                                                
                                                    <div style="width: 40px; height: 40px;  border-radius: 25px; background-size: cover; background-position: center; background-repeat: no-repeat; background-image: url({{url('')}}/assets/images/usuarios/`+comentarioRespuesta.FotoPersona+`);">
                                                    </div>
                                                    <div class="col">
                                                    <h5 style="font-size:14px; color: #fff; padding: 0px; margin: 0px;">`+comentarioRespuesta.NombreUsuario+`</h5>
                                                    <small style="font-size: 10px; margin-top: -1px; display: block;">`+comentarioRespuesta.fecha_hace+`</small>
                                                    ${cadena_tutor}
                                                    </div>

                                                    <div style="width: 100%; color: #fff; margin-top: 20px; ">
                                                    <p style="font-size: 14px; font-weight: 300;">`+comentarioRespuesta.MensajeComentario+`</p>

                                                    <a href="#" style="color: #fff; font-size: 13px;"  onclick="abrir_form_respuesta('`+comentarioRespuesta.IdComentario+`')">
                                                        <i class="fa fa-commenting-o" aria-hidden="true"></i> Responder
                                                    </a>

                                                    <div style="width: 100%;" class="contenedor_respuesta" id="contenedor_respuesta_`+comentarioRespuesta.IdComentario+`">
                                                        <form id="formulario_comentario_`+comentarioRespuesta.IdComentario+`" class="form_comentario">
                                                    <textarea class="form-control" placeholder="Deja tu comentario o duda" id="comentario_nuevo_`+comentarioRespuesta.IdComentario+`" required style="font-size: 13px;"></textarea>
                                                    <div style="width: 100%; text-align: right;">
                                                    

                                                    <input type="hidden" id="id_comentario_`+comentarioRespuesta.IdComentario+`" value="`+comentario.IdComentario+`">
                                                    <input type="hidden" id="id_comentario_respuesta_`+comentarioRespuesta.IdComentario+`" value="`+comentarioRespuesta.IdComentario+`">


                                                    <button type="submit" style="color: #19d1d1; margin-top:5px;" id_comentario="`+comentarioRespuesta.IdComentario+`" class="btn_enviar btn contenido__boton_footer" id="btn_enviar_`+comentarioRespuesta.IdComentario+`">Enviar</button>
                                                    </div>
                                                </form>

                                                    </div>

                                                    </div>
                                                    
                                            </div>           

                                            `;

                                            }
                                            
                                        }

                                        cadena_comentarios+=`
                                        </div>
                                        <!--<hr style="border-top: 1px solid rgba(255, 255, 255, 0.24);">-->
                                        `;

                    }

                }
                
                $("#listado_comentarios_leccion").html(cadena_comentarios);

                $(".responder_comentario").click(function(e){
                    e.preventDefault();
                });
        
                $(".btn_enviar").click(function(e){
                    var id_comentario=$("#"+e.target.id).attr("id_comentario");
                    var mensaje=$("#comentario_nuevo_"+id_comentario).val();
                    var id_comentario_sel=""+$("#id_comentario_"+id_comentario).val();
                    var id_respuesta_sel=""+$("#id_comentario_respuesta_"+id_comentario).val();;

                    console.log(id_comentario+" => "+id_comentario_sel+" => "+mensaje);

                    enviar_comentario(mensaje,id_comentario_sel,id_respuesta_sel);
                });

                $(".form_comentario").submit(function(e){
                    e.preventDefault();
                });

                $("#btn_enviar_comentario").click(function(e){
                    e.preventDefault();
                    enviar_calificacion();
                });
        
                $("#formulario_comentario_0").submit(function(e){
                    e.preventDefault();
                    var mensaje=$("#comentario_nuevo").val();
                    var id_comentario_sel="";
                    var id_respuesta_sel="";
                    enviar_comentario(mensaje,id_comentario_sel,id_respuesta_sel);
                });


                $(".contenido__btn_eliminar").click(function(e){
                    var id_comentario_delete=$("#"+e.target.id).attr("id-comentario");
                    var request = $.ajax({
                        url: "{{url('')}}/eliminar_comentario",
                        type: "POST",
                        data:{               
                            idtema:"@if($tipo_contenido=='leccion'){{$info_leccion->IdTema}}@else{{$info_leccion->IdModulo}}@endif",
                            idcomentario:""+id_comentario_delete,            
                            idusuario:"{{$data[0]->IdUsuarioPersona}}",
                            tipo_contenido:"{{$tipo_contenido}}",
                            _token: "{{ csrf_token() }}"
                        }
                    });

                    request.done(function(obj) { 
                        if(obj.status=="ok"){
                            cargar_comentarios();
                            return;
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




			}else{
							
			}
		});
		//respuesta si falla
		request.fail(function(jqXHR, textStatus) {
			alert( "Error de servidor  " + textStatus );
		});
	}


  $("#btn-usuario-registro").mouseenter(function(){
        $(".modal-usuario").show();
  }).click(function(e){
    e.preventDefault();
  });

  $(".modal-usuario").mouseleave(function(){
    $(".modal-usuario").hide();
  });


  $("#btn-usuario-registro").click(function(e){
    e.preventDefault();

    if(!$(".modal-usuario").is(":visible")){
      $(".modal-usuario").show();
    }else{
      $(".modal-usuario").hide();
    }

  });


    


</script>
@stop