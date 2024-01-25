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

  .foto-usuario-docttus{
     width: 150px;
     height: 150px;
     display: inline-block;
     background-color: #ccc;
     border-radius: 90px;
     background-position: center;
     background-size: cover;
     background-repeat: no-repeat;
  }

  .form-control{
    border-radius: 25px;
    width: 100%;
  }

  .tab-activo{
    border-bottom: 4px solid #F95850;
  }
  .tab-gen{
    text-align: center;  padding-bottom: 10px;
  }
  .tab-gen h6{
    font-weight: bold; margin:0px; padding:0px;
  }

  .tab-gen a h6{
     color: #000;
  }

  .tab-gen a:hover{
    text-decoration: none !important;
  }
  .tab-gen:hover{
    border-bottom: 4px solid #F95850;   
  }
</style>
 


<div class="row row-docttus">
    <div class="col-md-3">       
        <div class="card-docttus card-docttus-left" style=" height: auto !important; text-align: center;">
            <div class="foto-usuario-docttus" style="background-image: url({{url('')}}/assets/images/usuarios/{{$data[0]->FotoPersona}});"></div>
            <h5 style="font-weight: bold;">{{$data[0]->NombrePersona}} {{($data[0]->ApellidosPersona)?$data[0]->ApellidosPersona:""}}</h5>
            <h6>Usuario: {{'@'.$data[0]->NombreUsuario}}</h6>
            @if(session('rol_login')=="1")
            <h6>Estudiante</h6>
            @else
            <h6 style="font-weight: 300;">Afiliado</h6>
            @endif

            <div style="width: 100%; margin-top: 10px;">
              <a href="{{url('')}}/usuario" type="button" class="btn btn-secondary botones-docttus" id="btn_editar_usuario" style="margin-top: 25px;">Editar Perfíl</a>

              <h6 style="font-weight: bold; margin-top: 25px;">Información de Contacto</h6> 
              <h6>email: {{$data[0]->EmailPersona}}</h6>
            </div>
            


        </div>
    </div>

    <div class="col-md-9">       
        <div class="card-docttus card-docttus-left" style=" height: auto !important; padding-top: 15px; padding-bottom: 0px;">
           <div class="row">

            <div class="col-md-3 tab-gen">
               <a href="{{url('')}}/usuario">
                <h6>Información</h6> 
              </a>
            </div>

            <div class="col-md-3 tab-gen tab-activo">              
              <a href="{{url('')}}/usuario-cursos">
                <h6>Cursos</h6> 
              </a>
            </div>

            <div class="col-md-3 tab-gen">                            
              <a href="{{url('')}}/usuario-habilidades">
                <h6>Habilidades</h6> 
              </a>
            </div>

            <div class="col-md-3 tab-gen">
              <a href="{{url('')}}/usuario-certificados">
                <h6>Certificados</h6> 
              </a>
            </div>
             
           </div>
        </div>

        <div class="card-docttus card-docttus-left" style=" height: auto !important; text-align: left; margin-top: 25px;">

          <h4 style="font-weight: bold;">Cursos Adquiridos</h4>          
            <div class="row" style="margin-top: 35px;">                            
               


               @foreach($cursos_disponibles as $curso)
                @if($curso->IdUsuarioPersona)
                <div class="col-md-12" style="position: relative; margin-bottom: 25px;">
                   <div class="card-docttus card-docttus-left card-curso" style=" height: auto !important;">
                      <div class="row">
                        <div class="col-8">
                           <h2 style="font-weight: bold">{{$curso->NombreCurso}}</h2>

                            <div class="row fila-info">
                              <div class="col-4">
                                 <small><i class="fa fa-video-camera icono" aria-hidden="true"></i> {{$curso->cantidad_lecciones}} Lecciones</small>
                              </div>

                              <div class="col-4">
                                 <small><i class="fa fa-list-ul icono" aria-hidden="true"></i> {{$curso->cantidad_modulos}} Módulos</small>
                              </div>

                              <div class="col-4">
                                <small><i class="fa fa-clock-o icono" aria-hidden="true"></i> {{$curso->cantidad_horas}} Horas</small>
                              </div>
                            </div>          

                            <div class="row">
                              <div class="col-md-12">
                                 <p style="margin-top: 15px;">{!!$curso->DescripcionCurso!!}</p>                                

                                  @foreach($curso->habilidades as $habilidad)                   
                                     <img src="{{url('')}}/assets/images/habilidades/{{$habilidad->IconoHabilidad}}" class="habiliadd">                   
                                  @endforeach


                              </div>
                            </div>  



                        </div>
                        <div class="col-4">                          
                          
                          <a href="{{url('')}}/fichacurso/{{$curso->SlugCurso}}" target="_blank">
                              <img src="{{url('')}}/assets/images/cursos/{{$curso->ImagenCurso}}" style="width: 100%; border-radius: 9px; ">
                          </a>   

                        </div>
                      </div>
                      
                   </div>
                </div>
                @endif
                @endforeach
                <!--  tarjeta Curso --> 




            </div>
        </div>
    </div>

</div>
        

@stop

@section('scripts')

    
    <script type="text/javascript">
     

    </script>
@stop