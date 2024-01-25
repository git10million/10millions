@extends('areacurso.plantillas.plantilla-contenido')
@section('contenido')   

<script src="https://unpkg.com/wavesurfer.js"></script>



<style type="text/css">

:root{
    --color_fondo:#f7f6f9;
    --color_principal:#8A6D35;
    --color_secundario:#8A6D35;
    --color_menu:#616d85;
    --color_cpa:#242424;
    --color_texto_cpa:#fff;
    --color_fondo_secundario:#fff;
    --color_texto_principal:#08090a;    
    --color_texto_subtitulo:#64a4e5;

    --color_botoncontrol:#292929;
    --color_botoncontrol_hover:#292929;
    
    --color_boder:#dee0ea;
    --border_radius:0px;

    --color_fondo_tarjetas:#fff;
    --color_texto_tarjetas:#9ba2aa;

}



body,html,*{
    color: var(--color_texto_principal);      
}

.btn-modulo{
    background-color: #FDCF79;
}

.contenido-texto{    
    width: 100%;     
    padding: 15px; 
    font-size: 13px; 
    font-weight: 300; 
    color: var(--color_texto_principal);      
}

.contenido__texto_principal{
    height: 300px;
    overflow-y: hidden;
}

.contenido__textovermas{
    width: 100%;
    margin-top: -45px;
}

.btn_play_audio{
    background-color: #8A6D35;
    color: #fff;
}
.btn_play_audio i{
    color: #fff;
}

.contenido__textovermas > a{
    text-decoration: none;
    background: linear-gradient(180deg, rgba(0,0,0,0) 0%, rgb(129 129 129) 209%);
    text-align: center;
    width: 100%;
    padding-top: 15px;
    
    z-index: 999999;    
    display: inline-block;
}

.contenido__itempregunta{
    width: 100%; 
    background-color: #8A6D35; 
    border-radius: 9px; 
    margin-bottom:10px; 
    display:flex; 
    align-items: center;
    flex-direction: row;
    align-items: stretch;
    cursor: pointer;
}

.contenido__itempreguntaletra{
    padding: 10px 16px;
    background-color: #8A6D35;
    border-radius: 9px 0px 0px 9px;
    font-size: 25px;
    align-self:stretch;
    vertical-align: middle;
}
.contenido__itempreguntaletra span{
    color:#fff;
}

.contenido__itemrespuesta{
    padding: 15px 16px;  
}

.contenido__itempregunta:hover > .contenido__itempreguntaletra{
    background-color: #8A6D35;
}

.contenido__itempregunta:hover {
    background-color: #8A6D35;
}

.contenido__itempregunta.activo{
    background-color: #0b5586;
}

.contenido__audioprincipal{
    padding-top: 95px;
    padding-bottom: 95px;
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
    @if($tipo_contenido=="leccion" || $tipo_contenido=="modulo")
    height: 100vh;
    overflow-y: hidden;
    @endif
    background-color: #f7f6f9;
    
}

#formulario_comentario_0{
    padding-right:15px;
    padding-left:15px;
    margin-top: 15px;
    border-bottom: 1px solid var(--color_boder);
    padding-bottom: 10px;
}


wave{
    overflow: hidden !important;
}

.btn_play_audio{
    border: none !important;
    outline: none !important;
}

.contenido__tarjetacomentario{    
    background-color: var(--color_fondo_secundario);
    border-bottom:1px solid var(--color_boder);
    padding-right:15px;
    padding-left:15px;
    border-radius: var(--border_radius);
    margin: 0px; 
    margin-bottom: 15px; 
    padding-bottom: 10px;
    position: relative;
    
}

.col__botonerasuperior{
    max-width: 270px;
}

.contenido__tarjetacomentario_interno{
    background-color: #f7f6f9;
    padding: 11px !important;
    border-radius: 11px;
    margin: 0px; 
    margin-bottom: 15px; 
    padding-bottom: 10px;
    margin-top: -14px;
    padding-left: 18px !important;
    border-left: 17px solid #dfdedf;
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
    padding-bottom: 350px;
    overflow-x: hidden;
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
    background-color: var(--color_fondo_secundario);
    padding-top: 0px;    

    
    padding-right: 8px;
    @if($tipo_contenido=="leccion" || $tipo_contenido=="modulo")
    height: 100vh;
    overflow-x: hidden;
    overflow-y: hidden;
    @endif
    padding-right: 0px;
    padding-left: 0px;
    width: 392px;
    display: block;
    border-left: 1px solid var(--color_boder);
    overflow-y: scroll;
}

.contenido__barra{
    widows: 100%;
    display: block;
    background-color: var(--color_cpa);
    padding:15px;
}
.contenido__barra span{
    color: var(--color_texto_cpa);
}

.contenido__rightbar:hover{
    
}




.contenido__principal{
    padding-left: 0px;
    padding-right: 0px;
    padding-top: 0px;    
    

    @if($tipo_contenido=="leccion" || $tipo_contenido=="modulo")
    height: 100vh;   
    overflow-x: hidden;
    overflow-y: hidden;
    @endif
    
}

.contenido__principal:hover{
    
    
}

.menutema{
    background-color: #1C1C1C;
    padding: 5px;    
    width: 100%;
    z-index: 999999;
    top: 0px;
}

.menutema__logo{
    height: 40px;
}

.contenido__barracontrol{    
    background-color: #3c3c3c;
    padding:0px;    
}

.col-1.contenido__botonbarracontrol{    
    width: 40px;
    max-width: 40px;
}
.contenido__botonbarracontrol{
    background-color: var(--color_botoncontrol);
    text-align: center;
    padding-top:22px; 
    cursor: pointer;
    
}
.contenido__botonbarracontrol i{
    color: var(--color_texto_cpa); 
    font-weight: bold;
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


#btn_siguiente_pregunta.disabled{
    background-color: #b6b6b6;
}


.contenido__tituloleccion{
    font-weight: 300;
    text-transform: capitalize;
    padding: 5px 12px;
}
.contenido__tituloleccion h2{
    font-size: 26px;
    padding: 0px;
    margin: 0px;
    color: var(--color_texto_cpa);        
    font-weight: 300;
}
.contenido__tituloleccion small{
    color: var(--color_texto_cpa) !important;    
}

.contenido__btn_eliminar{
    
    position: absolute;
    top: 5px;
    right: 5px;
    cursor: pointer;
    z-index: 999;
}
.contenido__btn_eliminar i{
    color: #ccc !important;
}

.contenido__titilo{
    color: var(--color_texto_principal);      
    font-weight: normal;
    text-transform: capitalize;
}

.contenido__descripcion{
    color: var(--color_texto_principal);      
    font-weight: 300;
}


.contenido__item{
    margin-bottom: 15px;
    color: var(--color_texto_principal) !important;      
    font-weight: 300 !important;
}

.contenido__texto{
    margin-top: 15px;
}

.contenido__texto  p{
    color: var(--color_texto_principal) !important;      
    font-weight: 300;
}

.contenido__texto  h4{
    color: var(--color_texto_principal) !important;      
    font-weight: 300;
}

.contenido__nombrecurso{
    color: var(--color_texto_principal) !important;      
}

.contenido__boton_footer{
    color: var(--color_texto_principal) !important;      
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



.contenido__menu{
    background-color: var(--color_fondo_secundario);
    padding: 7px;
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
    border-bottom: 1px solid var(--color_boder);
    padding-left: 15px;
    color: var(--color_texto_principal) !important;      
    text-decoration: none;
    font-size: 17px;
    background-color: #fff;
}

.contenido__item_listado:hover{
    background-color: #f7e1b8;
    color: var(--color_texto_principal) !important;      
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
    border-bottom: 2px solid #FDCF79;
    background-color: #8A6D35 !important;
    outline: none;
}
.contenido__comentarios{
    width: 100%;
    
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

.contenido__izquierdaprincipal{
    @if($tipo_contenido=="leccion" || $tipo_contenido=="modulo")
    height: 88vh;    
    overflow-y: scroll;
    @endif
}

.tarjeta__contenido{
    width: 100%; 
    background-color:var(--color_fondo_tarjetas); 
    border:1px solid var(--color_boder);
    margin-bottom: 40px;
}

.tarjeta__cabecera{
    padding:10px; 
    border-bottom:1px solid var(--color_boder);
}

.tarjeta__cabecera .col-1{
    width: 59px;
    max-width: 59px;
}

.tarjeta__icono{
    background-color: var(--color_cpa);
    padding: 10px;
    display: inline-block;
    width: 45px;
    height: 45px;
    border-radius: 34px;
    text-align: center;
    
}

.tarjeta__titulo{
    
    font-size: 24px;
    color: var(--color_texto_tarjetas);
    font-weight: 300;
    padding-top: 5px;

}

.tarjeta__icono i{
    color: var(--color_texto_cpa);
}

.tarjeta__cuerpo{
    padding:30px;
}

#btn_marcar_como_vista{
    color: #fff !important;
    background-color: #8A6D35;
    box-shadow: 0px 3px 1px 1px #4a3a1a;
}

#btn_marcar_como_vista i{
    color: #fff !important;
}


#btn_marcar_como_vista span{
    color: #fff !important;
}


.contenido__tarjetaevaluacion{
    width: 100%;
    padding: 55px 25px;
    background-color: #fff;
    margin-top: 75px;
    border: 1px solid #ccc;
    border-radius: 9px;
    box-shadow: 0px 7px 8px #ccc;
}

.contenido__tarjetaevaluacionfooter{
    width: 100%;
    padding: 25px 25px;
    background-color: #fff;
    margin-top: 15px;
    border: 1px solid #ccc;
    border-radius: 9px;
    box-shadow: 0px 7px 8px #ccc;
    margin-bottom: 150px;
}

.contenido__ulitemexamen{
    font-size: 21px;

}

.contenido__ulitemexamen li{
    margin-bottom: 15px;
}
#grafica_progreso{
    margin-top: -26px;
}

@media only screen and (max-width: 1024px) {
    .contenido__rightbar{
        width: 350px;
    }
}

@media only screen and (max-width: 991px) {
    #grafica_progreso{
        margin-top: 15px;
    }
    #btn_marcar_como_vista span{
        display: none;
    }

    
    #btn_marcar_como_vista{
        position: fixed !important;
        bottom: 15px;
        right: 15px;
        z-index: 999;
        padding: 5px;
        width: 50px;
        border-radius: 42px;
        font-size: 25px;
        
    }
    #btn_marcar_como_vista i{
        color: #fff !important;
    }

    .contenido__izquierdaprincipal{
        overflow-y: hidden;
        overflow-x: hidden;
    }

    .contenido__rightbar, .contenido__principal,.contenido{
        height: auto !important;
        overflow-y: auto;
    }
    

    .contenido__botoncalificacion span{
        display: none;
    }

    .contenido__filaprincipal{
        display: block;
        width: 100%;        
    }

    .contenido__principal,.contenido__rightbar{
        width: 100%;        
        display: block;
    }

    .contenido__izquierdaprincipal{
        height: auto !important;
        padding-top: 
    }

    .contenido__contenidoprimario{
        padding-top: 66px;
    }

    .contenido__filaprincipal{
        display: block;
        width: 100%;
        padding: 0px;
        margin-right: 0px;
        margin-left: 0px;
    }

    .contenido__informacion_item{
        height: auto;
        padding-bottom: 15px;
    }

    .contenido{
        padding: 0px;
    }

    .contenido__nombrecurso{
        display: none;
    }

    .contenido__botonvolver >span{
        display: none;
    }

    .contenido__botonvolver{
        padding: 7px 12px;
    }

/*    */

    .contenido__tituloleccion{
        align-items: center;
        
        display: flex;
    }


    .contenido__tituloleccion h2{
        font-size: 15px;
        display: inline-block;
    }

    .contenido__barracontrol {
        height: 60px;
        width: 100%;
        z-index: 99999;
        top: 0px;
        box-shadow: 0px 3px 3px #b4b4b4;
    }
    .contenido__botonbarracontrol{
        height: 60px;
        padding-top: 16px;
    }
    .col__botonerasuperior{
        max-width: 120px;
    }
    
    
    
    .contenido__boton_menu{
        width: 100%;
        font-size: 22px;
        border-bottom: 1px solid #e6e6e6;
    }

    .contenido__rightbar{
        display: none;
    }

    .contenido__comentarios{
        widows: 100%;
    }

    

    #btn_contenido_4{
        display: block;
    }

    .contenido__menu{
        padding: 0px;
        margin: 0px;
        width: 100%;
    }

    .contenido__menu .container{
        padding:0px;
    }

    /*

    .col-der{
        width: 100%;
    }
    .col-izq{
        width: 100% !important;
        display: contents;
        height: auto;
    }

    body,html{
        background-color: #f7f6f9;
        overflow-y: auto; 
        overflow-x: auto; 
    }

    .col-contenido{
        height: auto;
    }

    .botones-docttus{
        font-size: 12px;
    }*/
}




</style>

@php
    $tutor_curso=$curso->tutor;

    
    
    

@endphp


<div class="container-fluid contenido">
    <div class="row contenido__filaprincipal">
        <div class="contenido__principal col">


            <div class="menutema">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-6">
                            <img src="{{url('')}}/logo-white.png" class="menutema__logo" alt="">
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

            <div class="contenido__barracontrol">
                <div class="row" style="padding: 0px; margin:0px;">
                    @if($tipo_contenido=="leccion" || $tipo_contenido=="modulo")
                    <div class="col-1 contenido__botonbarracontrol"  id="btn_anterior_contenido">
                        <i class="fa fa-angle-left" aria-hidden="true"></i>                        
                    </div>
                    @endif 
                    

                    <div class="col contenido__tituloleccion">
                        <h2>
                            @if($tipo_contenido=="leccion")
                                {{$info_leccion->NombreTema}}
                            @elseif($tipo_contenido=="modulo")
                                {{$info_leccion->NombreModulo}}
                            @else
                                Exámen
                            @endif
                        </h2>
                        <small class="contenido__nombrecurso">{{$curso->NombreCurso}}</small>
                    </div>

                    <div class="col text-right col__botonerasuperior">
                        <a class="contenido__botonvolver" href="{{url('')}}/curso/{{$curso->SlugCurso}}">
                            <i class="fa fa-book" aria-hidden="true"></i> <span>Volver al Curso</span>
                        </a>

                        <a href="#" class="contenido__botonvolver" id="btn_comentario"  data-toggle="tooltip" data-placement="bottom" title="Calificar Curso" >                                    
                            <i class="fa fa-star-o" aria-hidden="true"></i>
                        </a>
                    </div>

                    @if($tipo_contenido=="leccion" || $tipo_contenido=="modulo")
                    <div class="col-1 contenido__botonbarracontrol" id="btn_siguiente_contenido" > 
                        <i class="fa fa-angle-right" aria-hidden="true"></i>                        
                    </div>
                    @endif
                    
                </div>
            </div>

            @if($tipo_contenido=="evaluacion")
            <div class="container">
                <div class="row">
                    <div class="col-md-12">

                        

                        <div class="contenido__tarjetaevaluacion">
                            <div class="row" id="tarjeta_inicial_evaluacion">
                                <div class="col-md-4">
                                    <img src="{{url('')}}/assets/images/evaluacion.png" style="width: 100%;">
                                </div>
                                <div class="col-md-8">
                                    <h2 style="color:#0b5586;">Haz finalizado tu capacitación, ahora, evalua tus conocimientos. </h2>
                                    <h3 style="font-size: 19px;">{{$curso->NombreCurso}}</h3>
                                    <hr>
                                    <ul class="contenido__ulitemexamen">
                                        <li>No hay limite de intentos para presentar el exámen.</li>
                                        <li>La prueba tiene un total de {{count($info_leccion->preguntas)}} preguntas.</li>
                                        <li>Cuentas con {{$info_leccion->MinutosEvaluacion}} minutos para desarrollar el exámen.</li>
                                        <li>Se requiere de {{$info_leccion->PorcentajeMinimo}} respuestas correctas para la aprobación de la prueba.</li>
                                       

                                    </ul>

                                    <button type="button" class="contenido__botonvolver" id="btn_ingresar_examen" style="border:none;">
                                        <i class="fa fa-check" aria-hidden="true"></i> Ingresar al Examen 
                                    </button>
                                </div>
                            </div>

                            

                            <div class="row" id="tarjeta_preguntas"  style="display: none;">
                                <div class="col-md-12">
                                    <div class="row" style="margin-bottom: 15px;">
                                        <div class="col-8">
                                            {{$curso->NombreCurso}}
                                        </div>
        
                                        <div class="col-4 text-right">
                                            Pregunta <span id="numero_inicial_preguntas">1</span> de <span id="numero_final_preguntas">{{count($info_leccion->preguntas)}}</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="progress">
                                        <div class="progress-bar" role="progressbar" id="progreso_examen" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                                
                                @php
                                    $contador_preguntas=0;
                                    $id_pregunta_ini=0;
                                    
                                @endphp

                                @foreach ($info_leccion->preguntas as $item_pregunta)
                                        @php
                                            $contador_preguntas++;
                                            $contador_respuestas=0;
                                            
                                            $pregunta_visible="display:none;";
                                            if($contador_preguntas==1){
                                                $pregunta_visible="display:block;";
                                                $id_pregunta_ini=$item_pregunta->IdPregunta;
                                            }

                                        @endphp
                                    <div class="col-md-12"  style="margin-top: 45px;  {{$pregunta_visible}} " id="examenpregunta_{{$item_pregunta->IdPregunta}}">

                                        <h2 style="color:#0b5586; font-size:22px;">{{$item_pregunta->NombrePregunta}}</h2>
                                        
                                        @foreach ($item_pregunta->respuestas as $item_respuesta)
                                        @php
                                            $valor_respuesta="abcdefghijklmnñopqrstuvwxyz";
                                            $contador_respuestas++;
                                        @endphp
                                        <div id-pregunta="{{$item_pregunta->IdPregunta}}" id-respuesta="{{$item_respuesta->IdRespuesta}}" class="contenido__itempregunta contenido__itempregunta_{{$item_pregunta->IdPregunta}}" id="item_respuesta_{{$item_pregunta->IdPregunta}}_{{$item_respuesta->IdRespuesta}}">
                                            <div class="contenido__itempreguntaletra">
                                                <span>{{$valor_respuesta[$contador_respuestas-1]}}</span>
                                            </div>
                                            <div class="contenido__itemrespuesta">
                                                <span style="color: #fff;">{{$item_respuesta->NombreRespuesta}}</span>
                                            </div>       
                                        </div>
                                        @endforeach
                                    </div>                                    
                                @endforeach                                
                                
                                <div class="col-md-12"  style="margin-top: 45px; display:none; " id="examenpregunta_{{count($info_leccion->preguntas)}}">

                                    <h1 style="color:#0b5586; font-size:22px;">Resumen</h1>

                                    <div id="listado_preguntas_examen">
                                        <!-- TODO: Que permita editar cierta pregunta -->

                                    </div>

                                </div>

                                <hr >

                                <div class="col-md-12"  style="margin-top: 45px; display:none; " id="examenpregunta_finalizar">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div id="resultado_fallido" style="display:none;">
                                                <h1 style="color:#0b5586; font-size:22px;">¡No te rindas!</h1>
                                                <p style="margin-bottom: 0px;">Necesitas una <strong>calificación mínima de {{$info_leccion->PorcentajeMinimo}}</strong> para aprobar.</p>
                                                <p>Vuelve a intentarlo en 05 horas, 54 minutos, 41 segundos</p>
                                                <a class="contenido__botonvolver" href="{{url('')}}/curso/{{$curso->SlugCurso}}">
                                                    <i class="fa fa-book" aria-hidden="true"></i> Regresar
                                                </a>
                                            </div>

                                            <div id="resultado_exitoso" style="display:none;">
                                                <h1 style="color:#0b5586; font-size:22px;">¡Felicitaciones!</h1>                                                
                                                <p>Haz pasado el examen de {{$curso->NombreCurso}}</p>
                                                <a class="contenido__botonvolver" href="{{url('')}}/curso/{{$curso->SlugCurso}}">
                                                    <i class="fa fa-book" aria-hidden="true"></i> Regresar
                                                </a>

                                                <a class="contenido__botonvolver" href="{{url('')}}/curso/{{$curso->SlugCurso}}">
                                                    <i class="fa fa-book" aria-hidden="true"></i> Descargar Certificado
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div style="width: 285px; border:1px solid #ccc; padding:10px; border-radius:9px;">
                                                <div class="row">
                                                    <div class="col text-center">
                                                        <h3  style="font-size: 47px;  color:#0b5586;"><span style="font-weight: bold;  color:#0b5586;" id="aciertos_pregunta">9</span>/{{count($info_leccion->preguntas)}}</h3>
                                                        <span>Aciertos</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                
                            </div>


                            
                        </div>      
                        
                        <div class="contenido__tarjetaevaluacionfooter">
                            <div class="row">
                                <div class="col text-center">
                                    <span style="font-size: 27px; color: #0b5586;" id="timer_countdown">30:00</span>
                                </div>

                                <div class="col-2" style="max-width:160px;">
                                    <button type="button" class="contenido__botonvolver disabled" id="btn_siguiente_pregunta" style="border:none; margin:0px;" disabled>
                                        <i class="fa fa-chevron-right" aria-hidden="true"></i>  Siguiente 
                                    </button>

                                    <button type="button" class="contenido__botonvolver" id="btn_finalizar_pregunta" style="border:none; margin:0px; display:none;">
                                        <i class="fa fa-check" aria-hidden="true"></i>  Finalizar 
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif



            <div class="contenido__izquierdaprincipal">

                <div class="contenido__contenidoprimario" style="background-color: #e9e9e9;">
                    
                    
                    
                    @php 
                        $cant_media=0;
                    @endphp

                    @foreach($info_media as $media)
                        @if($cant_media==0)

                            @if($media->TipoMedia==1 || $media->TipoMedia==2  || $media->TipoMedia==3  || $media->TipoMedia==4 )
                                @if($curso->IdTipoLanzamiento==2 && $info_leccion->FechaLanzamiento!="")

                                <section  style="background-color: #343a40; padding:15px 0px; width:100%;">
                                    <div class="container text-center">
                                        <div class="col-md-12">                                            
                                            <h3 style="color: #fff;">Este contenido se habilitará  {{\Carbon\Carbon::parse($info_leccion->FechaLanzamiento)->diffForHumans()}}</h3>
                                            <small style="color: #fff;"><strong style="color: #fff;">Fecha: </strong> {{$info_leccion->FechaLanzamiento}}</small>
                                        </div>                                    
                                    </div>
                                </section>
                                @endif
                                

                                @if($media->TipoMedia==1)
                                    <div class="col-contenido embed-responsive embed-responsive-16by9">
                                        {!!$media->VideoEmbed!!}
                                    </div>


                                    @if($media->ContenidoMedia)
                                        <div class="container" style="padding-top: 15px; padding-bottom:15px;" >
                                            <div class="row m-1">
                                                <div class="contenido__texto">
                                                    {!!$media->ContenidoMedia!!}
                                                </div>
                                            </div>
                                        </div>
                                    @endif



                                @endif

                                @if($media->TipoMedia==2)
                                    <div class="container" style="padding-top: 15px; padding-bottom:15px;" >

                                        <div class="row">
                                            <div class="col-12">
                                                <img src="{{url('')}}/{{$media->URLMedia}}" style="width: 100%;" >
                                            </div>
                                        </div>

                                        @if($media->ContenidoMedia)
                                            <div class="row m-1">
                                                <div class="contenido__texto">
                                                    {!!$media->ContenidoMedia!!}
                                                </div>
                                            </div>
                                        @endif

                                    </div>                                    
                                    
                                @endif


                                
                                @if($media->TipoMedia==3)
                                    <div class="container" style="padding-top: 15px; padding-bottom:15px;" > 

                                        @if($media->ContenidoMedia)
                                            <div class="row m-1">
                                                <div class="contenido__texto contenido__texto_principal">
                                                    {!!$media->ContenidoMedia!!}
                                                </div>
                                                <div class="contenido__textovermas text-center">
                                                    <a href="#" id="btn_ver_mas_contenido">Ver Más</a>
                                                </div>
                                            </div>
                                        @endif

                                    </div>                                                                        
                                @endif

                                @if($media->TipoMedia==4)

                                    
                                    <div class="container contenido__audioprincipal">
                                        <div class="row">
                                            <div class="col-2" style="max-width: 102px;">
                                                <button id="btn_play_audio_{{$media->IdMedia}}" class="btn_play_audio" type="button" style="width: 85px; height:85px; border-radius:225px; margin-top:25px; border:none; font-size:25px;">
                                                    <i class="fa fa-play" aria-hidden="true"></i>
                                                </button>
                                            </div>
                                            <div class="col" style="overflow-x: hidden; overflow-y:hidden; position: relative;">
                                                <div id="waveform_audio_{{$media->IdMedia}}" style="width: 100%; border-radius: 14px;">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="contenido__texto">
                                            {!!$media->ContenidoMedia!!}
                                        </div>
                                    </div>


                                @endif


                            @endif

                        @endif

                        @php 
                            $cant_media++;
                        @endphp
                    @endforeach

                    

                </div>           

                @if($tipo_contenido=="leccion" || $tipo_contenido=="modulo")
                <div class="contenido__menu">
                    <div class="container">
                        
                        <div class="row">
                            <div class="col-md-10">
                                
                                <button class="contenido__boton_menu activo" id-button="1" type="button" id="btn_contenido_1">Contenido</button>
                                <button class="contenido__boton_menu" id-button="3"  type="button" id="btn_contenido_3">Comentarios ({{count($info_comentarios)}})</button>
                                <button class="contenido__boton_menu" id-button="2"  type="button" id="btn_contenido_2">Recursos</button>                                
                                @if($tipo_contenido=='leccion' ||$tipo_contenido=='modulo')
                                <button class="contenido__boton_menu" id-button="4"  type="button" id="btn_contenido_4">Temario</button>
                                @endif
                                <button class="contenido__boton_menu" id-button="5"  type="button" id="btn_contenido_5">Mi Progreso</button>
                            </div>
        
                            <div class="col-md-6 text-right">
                                                                
                            </div>
                        </div>                        
                            
                    </div>                
                </div>
                

                <div class="contenido__recursos contenido__informacion_item" id="contenido_5">
                    <div class="container">
                        <div class="row">
                            
                            <div class="col-12">
                                <div class="tarjeta__contenido">
                                    <div class="tarjeta__cabecera">
                                        <div class="row">
                                            <div class="col-1">
                                                <div class="tarjeta__icono">
                                                    <i class="fa fa-bar-chart" aria-hidden="true"></i>
                                                </div>                                        
                                            </div>
                                            <div class="col tarjeta__titulo" style="text-transform: capitalize;">
                                                Progreso - {{$curso->NombreCurso}}
                                            </div>
                                        </div>                                
                                    </div>
                                    <div class="tarjeta__cuerpo">
                                        <div class="row">
                                            <div class="offset-md-2 col-md-2 text-center">
                                                <div style="display:inline-block; width:85px; height:85px; 
                                                            background-image: url({{url('')}}/assets/images/usuarios/{{$tutor_curso[0]->FotoPersona}});
                                                            background-position:center;
                                                            background-size:cover;
                                                            border-radius:50px;">
                                                </div>
                                                <div>
                                                    {{$tutor_curso[0]->NombrePersona}} {{$tutor_curso[0]->ApellidosPersona}}
                                                </div>
                                                <small>Tutor Docttus</small>
                                            </div>
                                            <div class="col-md-3">
                                                @if($paso_examen==1)
                                                <a class="contenido__botonvolver" href="#" style="width:100%;" id="btn_descargar_certificado">
                                                    <i class="fa fa-book" aria-hidden="true"></i> Descargar Certificado
                                                </a>
                                                @else
                                                <a class="contenido__botonvolver"  href="#" style="width:100%; background-color: #b6b6b6;"  id="btn_descargar_certificado_1">
                                                    <i class="fa fa-book" aria-hidden="true"></i> Descargar Certificado
                                                </a>                                                
                                                @endif
                                                @if($paso_examen==0)
                                                <a class="contenido__botonvolver" href="{{url('')}}/tema/{{$curso->SlugCurso}}/evaluacion" style="width:100%; margin-top:25px;" id="btn_ver_examen">
                                                    <i class="fa fa-check-circle-o" aria-hidden="true"></i> Exámen 
                                                </a>
                                                @else
                                                <a class="contenido__botonvolver" style="width:100%; margin-top:25px; background-color: #b6b6b6;" id="btn_ver_examen">
                                                    <i class="fa fa-check-circle-o" aria-hidden="true"></i> Exámen 
                                                </a>
                                                @endif
                                            </div>
                                            <div class="col-md-3 text-center">
                                                <canvas id="grafica_progreso" width="200" height="180"></canvas>
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>

                <!-- TAB 1 - INFORMACION TEMA -->
                <div class="contenido__contenido contenido__informacion_item"   id="contenido_1" style="display: block;">
                    <div class="container">

                        @php
                        $descripcion_general="";
                        if($tipo_contenido=="leccion"){
                            $descripcion_general="".$info_leccion->DescripcionTema;
                        }elseif($tipo_contenido=="modulo"){
                            $descripcion_general="".$info_leccion->DescripcionModulo;
                        }else{
                            $descripcion_general="";
                        }
                        @endphp

                        @if($descripcion_general)
                        <div class="tarjeta__contenido">
                            <div class="tarjeta__cabecera">
                                <div class="row">
                                    <div class="col-1">
                                        <div class="tarjeta__icono">
                                            <i class="fa fa-file-text-o" aria-hidden="true"></i>
                                        </div>                                        
                                    </div>
                                    <div class="col tarjeta__titulo" style="text-transform: capitalize;">
                                        @if($tipo_contenido=="leccion")
                                            {{$info_leccion->NombreTema}}
                                        @elseif($tipo_contenido=="modulo")
                                            {{$info_leccion->NombreModulo}}
                                        @endif
                                    </div>
                                </div>                                
                            </div>
                            <div class="tarjeta__cuerpo">
                                <p class="contenido__descripcion">{{$descripcion_general}}</p>
                            </div>
                        </div>
                        @endif

                        @php 
                            $cant_media=0;
                        @endphp

                        @foreach($info_media as $media)
                            @if($cant_media>=1)

                                @if($media->TipoMedia==1 || $media->TipoMedia==2  || $media->TipoMedia==3  || $media->TipoMedia==4 )
                                    <div class="tarjeta__contenido">
                                        <div class="tarjeta__cabecera">
                                            <div class="row">
                                                <div class="col-1">
                                                    <div class="tarjeta__icono">
                                                        @if($media->TipoMedia==1)
                                                        <i class="fa fa-video-camera" aria-hidden="true"></i>
                                                        @endif

                                                        @if($media->TipoMedia==2)
                                                        <i class="fa fa-picture-o" aria-hidden="true"></i>
                                                        @endif

                                                        @if($media->TipoMedia==3)
                                                        <i class="fa fa-file-text-o" aria-hidden="true"></i>
                                                        @endif

                                                        @if($media->TipoMedia==4)
                                                        <i class="fa fa-volume-up" aria-hidden="true"></i>
                                                        @endif

                                                        
                                                    </div>
                                                </div>
                                                <div class="col tarjeta__titulo">
                                                    {{$media->NombreMedia}}
                                                </div>
                                            </div>                                
                                        </div>
                                        <div class="tarjeta__cuerpo">
                                            @if($media->TipoMedia==1)
                                            
                                                <div class="col-contenido embed-responsive embed-responsive-16by9">
                                                    {!!$media->VideoEmbed!!}
                                                </div>
                                                <div class="contenido__texto">
                                                    {!!$media->ContenidoMedia!!}
                                                </div>
                                                <!-- 16:9 aspect ratio -->
                                            @endif

                                            @if($media->TipoMedia==2)
                                                <img class="img-fluid" src="{{url('')}}/{{$media->URLMedia}}" >
                                                <div class="contenido__texto">
                                                    {!!$media->ContenidoMedia!!}
                                                </div>
                                            @endif

                                            @if($media->TipoMedia==3)
                                                <div class="contenido__texto">
                                                    {!!$media->ContenidoMedia!!}
                                                </div>
                                            @endif

                                            @if($media->TipoMedia==4)
                                                <div class="row">
                                                    <div class="col-2" style="max-width: 102px;">
                                                        <button id="btn_play_audio_{{$media->IdMedia}}" class="btn_play_audio" type="button" style="width: 85px; height:85px; border-radius:225px; margin-top:25px; border:none; font-size:25px;">
                                                            <i class="fa fa-play" aria-hidden="true"></i>
                                                        </button>
                                                    </div>
                                                    <div class="col" style="overflow-x: hidden; overflow-y:hidden; position: relative;">
                                                        <div id="waveform_audio_{{$media->IdMedia}}" style="width: 100%;">                                                        
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="contenido__texto">
                                                    {!!$media->ContenidoMedia!!}
                                                </div>
                                                
                                            @endif



                                        </div>
                                    </div>                            
                                @endif
                            @endif
                            
                            @php
                            $cant_media++;
                            @endphp

                        @endforeach
                        

                        <div class="contenido__footer">
                            <div class="row">
                                <div class="col-12 text-center">
                                    @if(session('rol_solicitud')!="root")
                                        @if($tipo_contenido=="leccion" ||$tipo_contenido=="modulo" )
                                            @if($info_leccion->EstadoTemaAvance==1)
                                                <button class="btn btn-default contenido__boton_footer activo" id="btn_marcar_como_vista" type="button"><i class="fa fa-check-circle-o" aria-hidden="true"></i> <span> Finalizada</span></button>
                                            @else
                                                <button class="btn btn-default contenido__boton_footer"  id="btn_marcar_como_vista" type="button"><i class="fa fa-check-circle" aria-hidden="true"></i> <span>Finalizar Esta Lección</span></button>
                                            @endif
                                        @endif
                                    @endif

                                </div>           
                                
                            </div>                            
                            
                        </div>


                    </div>
                </div>
                <!-- TAB 1 - FIN  INFORMACION TEMA -->

                <!-- TAB 2 - INFORMACION RECURSOS -->
                <div class="contenido__recursos contenido__informacion_item" id="contenido_2">

                    <div class="container">

                        <div class="row">
                            <div class="col">
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
                                    @foreach($info_media as $media)
                                        @if($media->TipoMedia==5 || $media->TipoMedia==6 )                                   
                                        <div class="tarjeta__contenido">
                                            <div class="tarjeta__cabecera">
                                                <div class="row">
                                                    <div class="col-1">
                                                        <div class="tarjeta__icono" style="margin-top: 9px;">
                                                            
                                                            @if($media->TipoMedia==5)
                                                                <i class="fa fa-download" aria-hidden="true"></i> 
                                                            @else
                                                                <i class="fa fa-link" aria-hidden="true"></i> 
                                                            @endif

                                                        </div>                                        
                                                    </div>
                                                    <div class="col tarjeta__titulo" style="padding-top: 12px;">
                                                        @php
                                                            $nombreMedia=$media->NombreMedia;
                                                            if(strlen($nombreMedia)>=40){
                                                                $nombreMedia=substr($media->NombreMedia,0,40)."...";
                                                            }
                                                        @endphp
                                                        {{$nombreMedia}}
                                                        <a href="@if($media->TipoMedia==5){{url('')}}/{{$media->URLMedia}} @else {{$media->URLMedia}} @endif " target="_blank" @if($media->TipoMedia==5)download @endif >
                                                            <p style="font-size: 18px;">{{$media->NombreArchivoMedia}}</p>
                                                        </a>
                                                    </div>

                                                    
                                                        <a class="contenido__botonvolver"  href="@if($media->TipoMedia==5){{url('')}}/{{$media->URLMedia}} @else {{$media->ContenidoMedia}} @endif " target="_blank" @if($media->TipoMedia==5)download @endif  style="  width: 144px;  display: inline-block;  margin-right: 22px;  height: 48px;   margin-top: 8px;"  href="@if($media->TipoMedia==5){{url('')}}/documentos/{{$media->URLMedia}} @else {{$media->ContenidoMedia}} @endif " target="_blank" @if($media->TipoMedia==5)download @endif >
                                                            @if($media->TipoMedia==5)
                                                                <i class="fa fa-download" aria-hidden="true"></i>  Descargar
                                                            @else
                                                            <i class="fa fa-link" aria-hidden="true"></i>  Ir Enlace
                                                            @endif
                                                        </a>
                                                    
                                                </div>                                
                                            </div>                                    
                                        </div>
                                        @endif
                                    @endforeach

                                @endif
                            </div>
                        </div>

                        
                     
                    </div>
    
                </div>
                <!-- TAB 2 - FIN INFORMACION RECURSOS -->

                

                <!-- TAB 3 - TEMARIO -->

                <div class="contenido__temario contenido__informacion_item" id="contenido_3">

                    

                    <div class="container">

                        <div class="tab-pane fade show active" id="modulos" role="tabpanel" aria-labelledby="modulos-tab">
                            <div style=" height: auto !important; ">

                                <div class="contenido__comentarios">
                                    <div style="width: 100%; padding: 0px;">
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
                        <!-- FIN MODULOS -->
                    </div>

                </div>
                @endif
            </div>

            <!-- TAB 3 - FIN TAB TEMARIO -->

            
            
            
                    
                
            

            

        </div>
        @if($tipo_contenido=='leccion' ||$tipo_contenido=='modulo')
        <div class="contenido__rightbar">
            <div class="contenido__barra text-center">
                <span>Temario</span>  
            </div>

            <?php 
                                    $contador_modulos=0;
                                ?>
                
                                @foreach($info_modulos as $modulo)
                
                                <?php                                    
                                    $abrir_acordion="show";                                    
                                ?>
                            
                                <div id="accordion_lecciones_{{$modulo->IdModulo}}" class="acordion_ficha" style=" color:#fff; padding: 0px; margin-bottom: 5px;"> 
                                <!-- INICIO MODULO -->


                                <?php 
                                                    
                                    $color_sel="";
                                    if($tipo_contenido=="modulo"){
                                        if($info_leccion->IdModulo == $modulo->IdModulo){
                                            $color_sel="background-color: #d0e8ff;";
                                        }
                                    }
                                    

                                    $color_active="#ccc";

                                    $icono_visualizacion='<i  style="font-size:15px; color:#ccc;" class="fa fa-circle"  aria-hidden="true"></i>';
                                    if(session('rol_solicitud')!="root"){
                                        foreach($info_lecciones_estado as $estadomodulo){
                                            if($estadomodulo->IdModulo == $modulo->IdModulo && $estadomodulo->EstadoTemaAvance==1){
                                                $color_active="#19d2d1";
                                                $icono_visualizacion='<i style="color:#19d2d1; font-size:15px;" class="fa fa-circle" aria-hidden="true"></i>';
                                            }
                                        }
                                    }

                                ?>


                
                                    <a href="{{url('')}}/tema/{{$curso->SlugCurso}}/modulo/{{$modulo->IdModulo}}" class="btn btn-modulo" style="margin-top: 0px; width: 100%; text-align: left; border-radius: 0px;">
                                        <div class="row">
                                            <div class="contenido__iconcontainerleccion">
                                                
                                                <!--<div class="contenido__separador_leccion_1" style="border-right:2px solid {{$color_active}};"></div>-->
                                                <span style="    padding-left: 2px;" class="contenido__icono_leccion" id="clase_modulo_{{$modulo->IdModulo}}">{!!$icono_visualizacion!!}</span>
                                                <!--<div class="contenido__separador_leccion_2"  style="border-right:2px solid {{$color_active}};"></div>-->

                                            </div>
                                            <div class="col" style="padding-left: 18px;">
                                                <strong style="    font-size: 18px;">{{$modulo->NombreModulo}} </strong><br/>
                                                <span style="font-size: 12px;     margin-top: -6px;  padding: 0px;  display: block;">{{$modulo->cantidad_lecciones}} Lecciones</span>                   
                                            </div>
                                        </div>
                                        
                                    </a>
                                
                
                                    <div id="1collapse_{{$modulo->IdModulo}}" class=" {{$abrir_acordion}} contenedor-lecciones" aria-labelledby="headingOne" data-parent="#accordion_lecciones_{{$modulo->IdModulo}}">                                    
                                        <!-- ITEM LECCIÓN -->
                                        @foreach($info_lecciones as $leccion)
                                            @if($modulo->IdModulo == $leccion->IdModulo)
                    
                    
                                                <?php 
                                                    
                                                    $color_sel="";
                                                    if($tipo_contenido=="leccion"){
                                                        if($info_leccion->IdTema ==$leccion->IdTema){
                                                            $color_sel="background-color: #f7e1b8;";
                                                        }
                                                    }
                                                    

                                                    $color_active="#ccc";

                                                    $icono_visualizacion='<i  style="font-size:15px; color:#ccc;" class="fa fa-circle"  aria-hidden="true"></i>';
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
        @endif
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

<script src="{{url('')}}/assets/js/jquery-gauge/src/jquery.gauge.js"></script>
<script type="text/javascript">

  $(function () {
    $('[data-toggle="tooltip"]').tooltip();
    tamano_panel();
    
    @if(count($valoracion)>0)
      calificacion_estrella="{{$valoracion[0]->ValorCalificacion}}";
    @endif

    scroll_base();

    set_estrella(calificacion_estrella);
    @if($tipo_contenido=='leccion' ||$tipo_contenido=='modulo')
        cargar_comentarios();
    @endif

    abrir_gouge("{{$porcentaje_avance}}");
  });

  $(window).scroll(function (event) {
      scroll_base();
  });


  function scroll_base(){
    var scroll = $(window).scrollTop();
    var width_x= window.innerWidth;
      // Do something
      //console.log(scroll);
      if(width_x>900){
       
      }else{

        if(scroll>=13){
          $(".contenido__barracontrol").css("top","0px");
          $(".contenido__barracontrol").css("position","fixed");
        }else{
          $(".contenido__barracontrol").css("top","53px");
          $(".contenido__barracontrol").css("position","fixed");
        }

      }
      
  }

  /* 
    TODO: CAMBIAR EL REPRODUCTOR, MÁS AMIGABLE.  
  */
    @foreach($info_media as $media)
        @if($media->TipoMedia==4 )
            var wavesurfer_{{$media->IdMedia}} = WaveSurfer.create({
                container: '#waveform_audio_{{$media->IdMedia}}',
                scrollParent: false,
                waveColor:"#0b5586",
                cursorColor:"#4a8cb8",
                progressColor:"#2bd3d5",
                backgroundColor:"#fff",
                barWidth: 3,
                barRadius: 3,
                cursorWidth: 1,
                mediaControls:true,                                
            });
            wavesurfer_{{$media->IdMedia}}.load(`{{URL('')}}/{{$media->URLMedia}}`);
            var bandera_play_{{$media->IdMedia}}=false;
            $("#btn_play_audio_{{$media->IdMedia}}").click(function(e){
                e.preventDefault();        
                if(!bandera_play_{{$media->IdMedia}}){
                    wavesurfer_{{$media->IdMedia}}.play();        
                    bandera_play_{{$media->IdMedia}}=true;
                    $("#btn_play_audio_{{$media->IdMedia}}").html(`<i class="fa fa-pause" aria-hidden="true"></i>`);

                }else{
                    wavesurfer_{{$media->IdMedia}}.pause();        
                    bandera_play_{{$media->IdMedia}}=false;
                    $("#btn_play_audio_{{$media->IdMedia}}").html(`<i class="fa fa-play" aria-hidden="true"></i>`);
                }
                
            });
        @endif
    @endforeach
  

    $("#btn_anterior_contenido").click(function(e){
        e.preventDefault();
        window.open("{{$info_siguiente['anterior']}}","_parent");
    });

    $("#btn_siguiente_contenido").click(function(e){
        e.preventDefault();
        window.open("{{$info_siguiente['siguiente']}}","_parent");
    });
  

    $(".contenido__boton_menu").click(function(e){
        e.preventDefault();
        var id_boton=$("#"+e.target.id).attr("id-button");      
        $(".contenido__boton_menu").removeClass("activo");
        $("#btn_contenido_"+id_boton).addClass("activo");

        $(".contenido__informacion_item").hide(); 
        $("#contenido_"+id_boton).show();
        
        if(id_boton=="4" && $("#btn_contenido_4").is(":visible")){
            $(".contenido__rightbar").show();
        }
        if(id_boton!="4" && $("#btn_contenido_4").is(":visible")){
            $(".contenido__rightbar").hide();
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
        @if($tipo_contenido=="leccion" || $tipo_contenido=="modulo")      
            @if($info_leccion->EstadoTemaAvance==1)
                var id_estado_actual=1;
            @else
                var id_estado_actual=0;
            @endif
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
             idtema:"@if($tipo_contenido=='leccion'){{$info_leccion->IdTema}}@elseif($tipo_contenido=='modulo'){{$info_leccion->IdModulo}}@endif",
             idusuario:"{{$data[0]->IdUsuarioPersona}}",
             tipoavance:"1",
             idestado:idestado,
             tipo_contenido:"{{$tipo_contenido}}",
             idcurso:"{{$curso->IdCurso}}",
             _token: "{{ csrf_token() }}"
        }
      });

      request.done(function(obj) { 
         if(obj.status=="ok"){
            if(idestado=="1"){              
                id_estado_actual=1;
                $("#btn_marcar_como_vista").addClass("activo");
                $("#btn_marcar_como_vista").html('<i class="fa fa-check-circle" aria-hidden="true"></i> <span>Finalizada</span>');

                
                @if($tipo_contenido=='leccion')

                    $("#clase_{{$info_leccion->IdTema}}").html('<i class="fa fa-circle"  style="color:#19d2d1;" aria-hidden="true"></i>');

                @elseif($tipo_contenido=='modulo')

                    $("#clase_{{$info_leccion->IdModulo}}").html('<i class="fa fa-circle"  style="color:#19d2d1;" aria-hidden="true"></i>');

                @endif

            }else{
              $("#btn_marcar_como_vista").removeClass("activo");
              $("#btn_marcar_como_vista").html('<i class="fa fa-check-circle-o" aria-hidden="true"></i> <span>Marca Como Vista</span>');
              @if($tipo_contenido=='leccion')

                $("#clase_{{$info_leccion->IdTema}}").html('<i class="fa fa-circle-o" aria-hidden="true"></i>');

              @elseif($tipo_contenido=='modulo')
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
               IdCurso:"{{$curso->IdCurso}}",               
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
               idtema:"@if($tipo_contenido=='leccion'){{$info_leccion->IdTema}}@elseif($tipo_contenido=='modulo'){{$info_leccion->IdModulo}}@endif",
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
				idtema:"@if($tipo_contenido=='leccion'){{$info_leccion->IdTema}}@elseif($tipo_contenido=='modulo'){{$info_leccion->IdModulo}}@endif",
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
                                        <h5 style="font-size:14px;  padding: 0px; margin: 0px;">`+comentario.NombreUsuario+`</h5>
                                        <small style="font-size: 10px; margin-top: -1px; display: block;">`+comentario.fecha_hace+`</small>
                                        ${cadena_tutor}
                                    </div>

                                    <div style="width: 100%;  margin-top: 20px; ">
                                        <p style="font-size: 14px; font-weight: 300;">`+comentario.MensajeComentario+`</p>
                                        <a  class="responder_comentario"  href="#" style="font-size: 13px;"  onclick="abrir_form_respuesta(`+comentario.IdComentario+`)">
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
                                                    <h5 style="font-size:14px;  padding: 0px; margin: 0px;">`+comentarioRespuesta.NombreUsuario+`</h5>
                                                    <small style="font-size: 10px; margin-top: -1px; display: block;">`+comentarioRespuesta.fecha_hace+`</small>
                                                    ${cadena_tutor}
                                                    </div>

                                                    <div style="width: 100%;  margin-top: 20px; ">
                                                    <p style="font-size: 14px; font-weight: 300;">`+comentarioRespuesta.MensajeComentario+`</p>

                                                    <a href="#" style=" font-size: 13px;"  onclick="abrir_form_respuesta('`+comentarioRespuesta.IdComentario+`')">
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
                            idtema:"@if($tipo_contenido=='leccion'){{$info_leccion->IdTema}}@elseif($tipo_contenido=='modulo'){{$info_leccion->IdModulo}}@endif",
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

    var ver_contenido_principal=false;
    $(".contenido__textovermas > a").click(function(e){
        e.preventDefault();
        if(!ver_contenido_principal){
            $(".contenido__texto_principal").css("height","auto");
            $(".contenido__textovermas").css("margin-top","60px");
            $(".contenido__textovermas > a").html("Ver Menos");
            ver_contenido_principal=true;
        }else{
            $(".contenido__texto_principal").css("height","300px");
            $(".contenido__textovermas").css("margin-top","-45px");
            $(".contenido__textovermas > a").html("Ver Más");
            ver_contenido_principal=false;
        }
            
    });


    @if($tipo_contenido=="evaluacion")

    var preguntas_responder = @json($info_leccion->preguntas, JSON_PRETTY_PRINT);
    var id_pregunta="{{$id_pregunta_ini}}";
    var index_pregunta=0;
    var cantidad_minima="{{$info_leccion->PorcentajeMinimo}}";
    var tiempo_maximo="{{$info_leccion->MinutosEvaluacion}}";
    
    var timer_evaluacion = "";
    var sec=0;

    $("#btn_ingresar_examen").click(function(e){
        e.preventDefault();

        sec=parseFloat(tiempo_maximo)*60;
        
        
        var request = $.ajax({
            url: "{{url('')}}/setiniciarexamen",
            type: "POST",
            data:{               
                CodigoRegistroExamen:"{{$CodigoRegistroExamen}}",
                _token: "{{ csrf_token() }}"
            }
        });

        request.done(function(obj) { 
            if(obj.status=="ok"){          
                $("#tarjeta_inicial_evaluacion").hide();
                $("#tarjeta_preguntas").show();

                timer_evaluacion = setInterval(evento_timer, 1000);

            }else{
                
            }
        });
        //respuesta si falla
        request.fail(function(jqXHR, textStatus) {
            alert( "Error de servidor  " + textStatus );
        });


    });

    function evento_timer(){
        var min     = Math.floor(sec / 60),
        remSec  = sec % 60;    
        if (remSec < 10) {            
            remSec = '0' + remSec;
        }

        if (min < 10) {            
            min = '0' + min;
        }

        var minutos_timer=min + ":" + remSec;
        $("#timer_countdown").html(minutos_timer);
        
        if(sec > 0){
            sec = sec - 1;            
        }else{
            clearInterval(timer_evaluacion);
            //countDiv.innerHTML = 'countdown done';
            //TODO: Cambio de estados del evento
        }
    }

    var arra_respuestas=new Array();
    $(".contenido__itempregunta").click(function(e){
        var id_pregunta=e.currentTarget.getAttribute("id-pregunta");
        var id_respuesta=e.currentTarget.getAttribute("id-respuesta");
        var ind_sel=exist_pregunta_respuesta(id_pregunta);
        if(ind_sel==-1){
            arra_respuestas.push({
                pregunta:id_pregunta,
                respuesta:id_respuesta
            });
        }else{
            arra_respuestas[ind_sel]={
                pregunta:id_pregunta,
                respuesta:id_respuesta
            };
        }
        

        $(`.contenido__itempregunta_${id_pregunta}`).removeClass("activo");
        $(`#item_respuesta_${id_pregunta}_${id_respuesta}`).addClass("activo");

        $("#btn_siguiente_pregunta").removeClass("disabled");
        $("#btn_siguiente_pregunta").prop("disabled",false);

        if(index_pregunta<preguntas_responder.length-1){

        }

    });

    function exist_pregunta_respuesta(id_pregunta){        
        var ind_resp=-1;
        for(var i=0;i<arra_respuestas.length;i++){
            if(""+arra_respuestas[i].pregunta.trim()==""+id_pregunta.trim()){
                ind_resp=i;
            }
        }
        return ind_resp;
    }



    $("#btn_siguiente_pregunta").click(function(e){

        index_pregunta++;
        if(index_pregunta<=preguntas_responder.length-1){

            $(`#examenpregunta_${id_pregunta}`).hide();
            
            id_pregunta=preguntas_responder[index_pregunta].IdPregunta;
            $(`#examenpregunta_${id_pregunta}`).show();
            console.log(id_pregunta);
            
            $("#numero_inicial_preguntas").html(index_pregunta+1);

            $("#btn_siguiente_pregunta").addClass("disabled");
            $("#btn_siguiente_pregunta").prop("disabled",true);    

        }else{
            $("#btn_finalizar_pregunta").show();
            $("#btn_siguiente_pregunta").hide();
            $(`#examenpregunta_${id_pregunta}`).hide();
            $(`#examenpregunta_${preguntas_responder.length}`).show();
            armar_listado_preguntas();
        }
        barra_avance_evaluacion();
    });



    function barra_avance_evaluacion(){
        var cant_total_pregs=preguntas_responder.length;
        var porcentaje_preguntas=(index_pregunta*100)/cant_total_pregs;
        $("#progreso_examen").attr("style","width:"+porcentaje_preguntas+"%");
        $("#progreso_examen").attr("aria-valuenow",porcentaje_preguntas);        
    }

    function armar_listado_preguntas(){
        var cadena_listado_preguntas="";  
        var valor_respuesta="abcdefghijklmnñopqrstuvwxyz";      

        for(var i=0;i<preguntas_responder.length;i++){
            var ind_preg=exist_pregunta_respuesta(""+preguntas_responder[i].IdPregunta);
            console.log(preguntas_responder[i].IdPregunta,ind_preg);
            var id_respuesta=arra_respuestas[ind_preg].respuesta;

            var respuestas=preguntas_responder[i].respuestas;

            //console.log( respuestas);
            

            cadena_listado_preguntas+=`
                <h2 style="color:#0b5586; font-size:22px;">${i+1}. ${preguntas_responder[i].NombrePregunta}</h2>                
            `;
            
            for(var j=0;j<respuestas.length;j++){
                if(respuestas[j].IdRespuesta==id_respuesta){
                    

                    cadena_listado_preguntas+=`
                    <div class="contenido__itempregunta"  style="background-color:#0b5586; cursor:inherit;">
                        <div class="contenido__itempreguntaletra" style="background-color: #023c62;">
                            <span>${valor_respuesta[j]}</span>
                        </div>
                        <div class="contenido__itemrespuesta">
                            <span style="color: #fff;">${respuestas[j].NombreRespuesta}</span>
                        </div>       
                    </div>

                    `;
                }
            }
        }        

        $("#listado_preguntas_examen").html(cadena_listado_preguntas);
    }


    $("#btn_finalizar_pregunta").click(function(e){
        e.preventDefault();
        var CadenaRegistroExamen=""+get_cadena_registro_examen();

        var request = $.ajax({
            url: "{{url('')}}/setfinalizarexamen",
            type: "POST",
            data:{               
                CodigoRegistroExamen:"{{$CodigoRegistroExamen}}",
                CadenaRegistroExamen:""+CadenaRegistroExamen,
                IdEvaluacion:"{{$info_leccion->IdEvaluacion}}",
                _token: "{{ csrf_token() }}"
            }
        });

        request.done(function(obj) { 
            if(obj.status=="ok"){                 
                //verificacion
                var verificacion=obj.verificacion;
                var cantidad_aprobadas=0;
                for(i=0;i<verificacion.length;i++){
                    if(verificacion[i].EsVerdadero=="1"){
                        cantidad_aprobadas++;
                    }
                }

                
                if(parseFloat(cantidad_aprobadas)>=parseFloat(cantidad_minima)){
                    $("#resultado_exitoso").show();
                }else{
                    $("#resultado_fallido").show();
                }
                $("#examenpregunta_finalizar").show();
                $("#aciertos_pregunta").html(cantidad_aprobadas);
                
                clearInterval(timer_evaluacion);

            }
        });
        //respuesta si falla
        request.fail(function(jqXHR, textStatus) {
            alert( "Error de servidor  " + textStatus );
        });

    });


    function get_cadena_registro_examen(){
        var cadena_registro_examen="";
        for(var i=0;i<arra_respuestas.length;i++){
            cadena_registro_examen+=`${arra_respuestas[i].pregunta}:${arra_respuestas[i].respuesta};`;
        }
        cadena_registro_examen=cadena_registro_examen.slice(0,-1);
        return cadena_registro_examen;
    }



    @endif

    
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