<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>10 Million$ Club | {{$titulo_pagina}}</title>  
  <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">  
  <link rel="stylesheet" href="{{url('')}}/assets-interno/dist/css/adminlte.min.css">  
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <link href="https://vjs.zencdn.net/7.10.2/video-js.css" rel="stylesheet" />
  <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css"/>
  <link rel="stylesheet" href="https://unpkg.com/tippy.js@6/animations/scale.css"/>
  <link rel="stylesheet" href="{{url('')}}/assets/css/main-interno.css"/>
  <link rel="icon" type="image/png" href="{{url('')}}/assets-marketing/images/favicon.png">

  <link rel="stylesheet" href="{{url('')}}/assets-interno/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css"/>
  <!-- jQuery -->
  <script src="{{url('')}}/assets-interno/plugins/jquery/jquery.min.js"></script>
  

  <style>

.btn-tab-dt{
    position:relative; display:inline-block; padding:10px; border-radius:5px; background-color:#fff; border:1px solid #ccc;
    margin-right: 10px;
    width: 100px;
    margin-bottom: 10px;
  }
  .btn-tab-dt span{
    background-color:#8A6D35; display:inline-block; border-radius:25px; width: 35px; height:35px; padding-top: 7px; 
  }
  .btn-tab-dt span > i{
    color: #fff;
  }
  .btn-tab-dt p{
    padding: 0px; margin:0; margin-top:5px; font-size:12px; color:#adadad;
  }

  .btn-tab-dt:hover{
    background-color:#8A6D35;
  }

  .btn-tab-dt:hover span{
    background-color:#fff;    
  }

  .btn-tab-dt:hover span > i{
    color: #8A6D35;
  }

  .btn-tab-dt:hover p{
    color: #fff;
  }



  .btn-tab-dt-activo{
    background-color:#0cbae8;
  }

  .btn-tab-dt-activo span{
    background-color:#fff;    
  }

  .btn-tab-dt-activo span > i{
    color: #0cbae8;
  }

  .btn-tab-dt-activo p{
    color: #fff;
  }


    .btn-evento{            
            position: absolute; 
            right:25px; 
            top:21px;
        }
        @media only screen and (max-width: 991px) {
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

  @yield('cabecera')

</head>
<body class="hold-transition sidebar-mini sidebar-collapse">

@if(isset($barra_guardar)==1)
<div class="barra-guardar">    
        

  


    @if($curso->IdEstado=="3" || session('rol_solicitud')=="root")
    <button type="button"class="btn btn-secondary botones-docttus"  id="btn_guardar_curso" @if($url_form=="contenido" && $ProcesoItem=="") disabled @endif >
      <i class="fa fa-floppy-o" aria-hidden="true"></i>
      <span> Guardar </span>
    </button>
    @else
        <button type="button"class="btn btn-secondary botones-docttus" disabled>
            <i class="fa fa-floppy-o" aria-hidden="true"></i>
            <span> Guardar </span>
        </button>
    @endif

    @if($curso->IdEstado=="3")
    <button type="button"class="btn btn-warning" style="margin-right: 15px; border-radius:25px;"  id="btn_publicar_curso">
      <i class="fa fa-rocket" aria-hidden="true"></i>
      <span> Enviar a Revisión </span>
    </button>
    @endif

    @if($curso->IdEstado=="7")
    <button type="button"class="btn btn-default" style="margin-right: 15px; border-radius:25px;"  id="btn_borrador_curso">
        <i class="fa fa-eraser" aria-hidden="true"></i>
      <span> Cambiar a Borrador </span>
    </button>
    @endif

    @if($curso->IdEstado=="1" && session('rol_solicitud')=="root")
      <button type="button"class="btn btn-default" style="margin-right: 15px; border-radius:25px;"  id="btn_borrador_curso">
        <i class="fa fa-eraser" aria-hidden="true"></i>
        <span> Cambiar a Borrador </span>
      </button>
      @endif

    @if($curso->IdEstado=="7" && session('rol_solicitud')=="root")
    <button type="button"class="btn btn-warning" style="margin-right: 15px; border-radius:25px;"  id="btn_publicarfinal_curso">
      <i class="fa fa-rocket" aria-hidden="true"></i>
      <span> Publicar Curso </span>
    </button>
    @endif
  
</div>

@if($curso->IdEstado=="3")
<!-- Modal -->
<div class="modal fade" id="enviar_curso_produccion" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Enviar Curso a Revisión</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h3 style="text-align: center;">
                    ¿Estás seguro de enviar este curso a REVISIÓN?
                </h3>
                <p>Debes estar seguro(a) de los siguientes puntos</p>
                <ul>
                    <li>El curso cuenta con los contenidos para su revisión.</li>
                    <li>El curso entrará en estado <strong>PENDIENTE</strong> durante 24 horas, antes de entrar a <strong>REVISIÓN.</strong></li>
                    <li>Si el curso se encuentra en estado <strong>PENDIENTE</strong>, podrá ser cambiado a borrador, si se necesita de algún cambio en su contenido.</li>
                    <li>Una vez pasado el tiempo de <strong>REVISIÓN</strong>, entrará a un estado de <strong>PUBLICACIÓN O ACTIVO</strong>, el cuál ya podrá ser comercializado.</li>
                </ul>
                
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" id="btn_enviar_revision">Enviar a Revisión</button>
            </div>
        </div>
    </div>
</div>
@endif

@if($curso->IdEstado=="7")
<!-- Modal -->
<div class="modal fade" id="enviar_curso_borrador" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Volver a Borrador</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h3 style="text-align: center;">
                    ¿Estás seguro de cambiar este curso a BORRADOR?
                </h3>
                <p>Si cambias a estado en Borrador, podrás editar el contenido de tu curso, pero el tiempo de REVISIÓN se reinicia.</p>
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" id="btn_enviar_borrador">Cambiar a Borrador</button>
            </div>
        </div>
    </div>
</div>
@endif


<!-- Modal -->
@if($curso->IdEstado=="7" && session('rol_solicitud')=="root")
<div class="modal fade" id="enviar_curso_publicacion" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Volver a Borrador</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h3 style="text-align: center;">
                    ¿Estás seguro de cambiar este curso a PUBLICADO?
                </h3>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" id="btn_enviar_publicacion">Publicar Curso</button>
            </div>
        </div>
    </div>
</div>
@endif


@if($curso->IdEstado=="1" && session('rol_solicitud')=="root")
<!-- Modal -->
<div class="modal fade" id="enviar_curso_borrador" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Volver a Borrador</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h3 style="text-align: center;">
                    ¿Estás seguro de cambiar este curso a BORRADOR?
                </h3>
                <p>Si cambias a estado en Borrador, podrás editar el contenido de tu curso, pero el tiempo de REVISIÓN se reinicia.</p>
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" id="btn_enviar_borrador">Cambiar a Borrador</button>
            </div>
        </div>
    </div>
</div>
@endif


@endif

<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-black navbar-dark" style="background-color: #1C1C1C;">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fa fa-bars"></i></a>
      </li>      
      
    </ul>

    <!-- SEARCH FORM -->
    <!--<form class="form-inline ml-3">
      <div class="input-group input-group-sm">
        <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-navbar" type="submit">
            <i class="fas fa-search"></i>
          </button>
        </div>
      </div>
    </form>-->

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <?php 
        $selected_rol_afi="";
        $selected_rol_tut="";
        $selected_rol_est="";
        if(session('rol_solicitud')=="estudiante"){
          $selected_rol_est="selected";
        }  

        if(session('rol_solicitud')=="tutor" || session('rol_login')=="2"){
          $selected_rol_tut="selected";
        }  


        if(session('rol_solicitud')=="afiliado"){
          $selected_rol_afi="selected";
        }  


      ?>
      @if(session('rol_solicitud')!="root")
      
        
        <!--<li class="nav-item">
        <select style="font-size: 13px; border-radius: 25px; padding: 2px 9px;  background-color: #c2c7d0;  margin-top: 7px;" onchange="cambiar_rol(this.value)">

        
        
            <option value="1" {{$selected_rol_est}} >Estudiante</option>
            <option value="2" {{$selected_rol_tut}} >Tutor</option>            
            <option value="3" {{$selected_rol_afi}} >Afiliado</option>
            
        </select>
        </li>-->
        
      @endif      

      <!-- Messages Dropdown Menu -->
       <!--<li class="nav-item dropdown">
        <a class="nav-link"  href="{{url('')}}/ayudas"  style="font-size: 19px;">
          <i class="nav-icon fa fa-question-circle"></i>
        </a>
      </li> -->



      <!-- Notifications Dropdown Menu -->

        @if(count($notificaciones)>0)
            <?php 
            $cant_notific=count($notificaciones);
            $notificacion_numero="{$cant_notific}";
            if($cant_notific>99){
              $notificacion_numero="99+";
            }

            ?>

      
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#"  style="font-size: 19px;">
          <i class="fa fa-bell"></i>
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
      </li>

      @endif


      <li class="nav-item dropdown">
        <a class="nav-link" style="font-size: 19px;">
          <div class="image">
            <img id="btn-usuario-registro" src="{{url('')}}/assets/images/usuarios/{{$data[0]->FotoPersona}}" class="img-circle elevation-2" alt="User Image" style="width: 29px;">
          </div>
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




      </li>

      

      

     

      
      
    </ul>
  </nav>
  <!-- /.navbar -->



  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4" style="background-color: #1C1C1C;">
    <span style="color: #fff; position: fixed; font-size: 12px;  font-weight: 100;  bottom: 8px; left: 8px;">V. {{env("APP_VERSION")}}</span>
    <!-- Brand Logo -->
    <center>      
    
      <a href="{{url('')}}">
        <img src="{{url('')}}/logo-white.svg" alt="10 Millions Club" style="width: 80%; margin-bottom: 15px; margin-top: 5px;">      
      </a>

    </center>

    <!-- Sidebar -->
    <div class="sidebar">
      
      <!-- Sidebar user panel (optional) -->
      <!--<div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{url('')}}/assets/images/usuarios/{{$data[0]->FotoPersona}}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="{{url('')}}/usuario" class="d-block">{{$data[0]->NombrePersona}} </a>
        </div>
      </div>-->

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          
          <li class="nav-item">
            <a href="{{url('')}}/backoffice" class="nav-link">
              <i class="nav-icon fa fa-home"></i>
              <p>
                Panel
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fa fa-link"></i>
              <p>
                Generador de Sitios
                <i class="right fa fa-angle-left"></i>
              </p>
            </a>


            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{url('')}}/minisites" class="nav-link">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p>Website Generator</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{url('')}}/fomo" class="nav-link">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p>Fomo Creator (Addons)</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{url('')}}/chat-bot-ia" class="nav-link">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p>Chat Bot IA  (Addons)</p>
                </a>
              </li>
            </ul>


          </li>


          
          @if(session('rol_solicitud')=="estudiante" )
            <li class="nav-item">
              <a href="{{url('')}}/cursos/mercado" class="nav-link">
                <i class="nav-icon fa fa-th"></i>
                <p>
                  Mercado de Cursos
                </p>
              </a>
            </li>

            <li class="nav-item">
              <a href="{{url('')}}/cursos/disponibles" class="nav-link">
                <i class="nav-icon fa fa-graduation-cap"></i>
                <p>
                  Cursos Comprados
                </p>
              </a>
            </li>
          @endif
       

        @if(session('rol_solicitud')=="afiliado" && $data[0]->IdEstadoSolicitudAfiliado==1)

        <li class="nav-item">
          <a href="{{url('')}}/billetera" class="nav-link">
            <i class="nav-icon fa fa-bank"></i>
            <p>
              Billetera
            </p>
          </a>
        </li>
       


          <li class="nav-item">
            <a href="{{url('')}}/enlaces-afiliados" class="nav-link">
              <i class="nav-icon fa fa-link"></i>
              <p>
                Enlaces
              </p>
            </a>
          </li>


          <li class="nav-item">
            <a href="{{url('')}}/cursos/disponibles" class="nav-link">
              <i class="nav-icon fa fa-th"></i>
              <p>
                Ver Cursos 
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{url('')}}/cursos/mercado" class="nav-link">
              <i class="nav-icon fa fa-th"></i>
              <p>
                Mercado
              </p>
            </a>
          </li>

          

          <li class="nav-item">
            <a href="{{url('')}}/listado-usuarios/afiliados" class="nav-link">
              <i class="nav-icon fa fa-users" aria-hidden="true"></i>
              <p>
                 Mis Afiliados
              </p>
            </a>
          </li>



          <li class="nav-item">
            <a href="{{url('')}}/cursos/premium" class="nav-link">
              <i class="nav-icon fa fa-graduation-cap" style="color: gold;"></i>
              <p>
                Cursos Premium
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{url('')}}/funnels-pro10x" class="nav-link">
              <i class="nav-icon fa fa-crosshairs"></i>
              <p>
                  Funnels Pro
              </p>
            </a>
          </li>

          

          @endif


          @if(session('rol_solicitud')=="afiliado")

          <li class="nav-item">
            <a href="{{url('')}}/cursos/free" class="nav-link">
              <i class="nav-icon fa fa-graduation-cap"></i>
              <p>
                Cursos Free
              </p>
            </a>
          </li>       

          
          @endif
          
           

          @if(session('rol_solicitud')=="tutor" && $data[0]->IdEstadoSolicitudTutor==1)

          <li class="nav-item">
            <a href="{{url('')}}/cursos/crear" class="nav-link">
              <i class="nav-icon fa fa-cube"></i>
              <p>
                Mis Cursos
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{url('')}}/cursos/disponibles" class="nav-link">
              <i class="nav-icon fa fa-graduation-cap"></i>
              <p>
                Entrenamientos
              </p>
            </a>
          </li>


          @endif
          
          

          <li class="nav-item">
            <a href="{{url('')}}/usuario" class="nav-link">
              <i class="nav-icon fa fa-user"></i>
              <p>
                Editar Cuenta
              </p>
            </a>
          </li>

          @if(session('rol_solicitud')=="root" && $data[0]->NombreUsuario=="adminroot")

          <li class="nav-item">
            <a href="{{url('')}}/contenido-pendiente" class="nav-link">
              <i class="nav-icon fa fa-tasks"></i>
              <p>
                Pendientes Vimeo
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{url('')}}/cursos/crear" class="nav-link">
              <i class="nav-icon fa fa-graduation-cap"></i>
              <p>
                Crear Curso 
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{url('')}}/listado-usuarios" class="nav-link">
              <i class="nav-icon fa fa-user-circle"></i>
              <p>
                Listado de Usuarios
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{url('')}}/listado-usuarios/tutores" class="nav-link">
              <i class="nav-icon fa fa-user-circle"></i>
              <p>
                Listado de Tutores
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{url('')}}/listado-usuarios/afiliados" class="nav-link">
              <i class="nav-icon fa fa-user-circle"></i>
              <p>
                Listado de Afiliados
              </p>
            </a>
          </li>

          

          <li class="nav-item">
            <a href="{{url('')}}/listado-cursos" class="nav-link">
              <i class="nav-icon fa fa-tasks"></i>
              <p>
                Listado de Cursos
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{url('')}}/listado-ventas" class="nav-link">
              <i class="nav-icon fa fa-tasks"></i>
              <p>
                Listado de Ventas
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{url('')}}/retiros" class="nav-link">
              <i class="nav-icon fa fa-tasks"></i>
              <p>
                Retiros
              </p>
            </a>
          </li>


          <li class="nav-item">
            <a href="{{url('')}}/listado-articulos" class="nav-link @if($menu=='articulos') active @endif">
              <i class="fa fa-files-o nav-icon"></i>
              <p>Artículos</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{url('')}}/listado-recursos" class="nav-link @if($menu=='recursos') active @endif">
              <i class="fa fa-files-o nav-icon"></i>
              <p>Recursos - Media</p>
            </a>
          </li>

          <!--
          <li class="nav-item">
            <a href="{{url('')}}/listado-usuarios" class="nav-link @if($menu=='usuarios') active @endif">
              <i class="fa fa-tasks nav-icon"></i>
              <p>Usuarios</p>
            </a>
          </li>
          -->



          <li class="nav-item">
            <a href="{{url('')}}/configuracion" class="nav-link nav-link @if($menu=='configuracion') active @endif">
              <i class="fa fa-files-o nav-icon"></i>
              <p>Configuración</p>
            </a>
          </li>


          <li class="nav-item">
            <a href="{{url('')}}/listado-politicas" class="nav-link nav-link @if($menu=='configuracion') active @endif">
              <i class="fa fa-files-o nav-icon"></i>
              <p>Políticas</p>
            </a>
          </li>


          <li class="nav-item">
            <a href="{{url('')}}/fomo-list" class="nav-link">
              <i class="nav-icon fa fa-tasks"></i>
              <p>
                Fomo Lunitax
              </p>
            </a>
          </li>


          @endif

          @if(session('rol_solicitud')=="root" && $data[0]->NombreUsuario!="adminroot")

          

          <li class="nav-item">
            <a href="{{url('')}}/listado-articulos" class="nav-link @if($menu=='articulos') active @endif">
              <i class="fa fa-files-o nav-icon"></i>
              <p>Artículos</p>
            </a>
          </li>
          
          <li class="nav-item">
            <a href="{{url('')}}/listado-recursos" class="nav-link @if($menu=='recursos') active @endif">
              <i class="fa fa-files-o nav-icon"></i>
              <p>Recursos - Media</p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{url('')}}/cursos/crear" class="nav-link">
              <i class="nav-icon fa fa-graduation-cap"></i>
              <p>
                Crear Curso 
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{url('')}}/fomo-list" class="nav-link">
              <i class="nav-icon fa fa-tasks"></i>
              <p>
                Fomo Lunitax
              </p>
            </a>
          </li>



          @endif


          <li class="nav-item">
            <a href="{{url('')}}/soporte" class="nav-link">
              <i class="nav-icon fa fa-life-ring"></i>
              <p>
                Soporte
              </p>
            </a>
          </li>


          <li class="nav-item">
            <a href="{{url('')}}/actualizaciones" class="nav-link">
              <i class="nav-icon fa fa-bolt"></i>
              <p>
                Actualizaciones
              </p>
            </a>
          </li>


          <li class="nav-item">
            <a href="{{url('')}}/logout" class="nav-link">
              <i class="nav-icon fa fa-times"></i>
              <p>
                Cerrar Sesión
              </p>
            </a>
          </li>

         



        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper content-principal">   

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid" style="margin-top: 35px;">        
        @yield('contenido')
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
    <div class="p-3">
      <h5>Title</h5>
      <p>Sidebar content</p>
    </div>
  </aside>
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
  <!--<footer class="main-footer">
  
    <strong>Copyright &copy; 2020<a href="https://bithooli.com"> Bithooli, SAS</a>.</strong> All rights reserved.
  </footer>-->
</div>



<aside id="panel_ayuda">
    <a href="#" id="btn_cerrar_ayuda"><i style="position: fixed; right:10px; top:5px; font-size:20px; color:#c5c5c5;" class="fa fa-times" aria-hidden="true"></i></a>
    <h3 style="color: #c5c5c5; text-align:center;" id="titulo_ayuda"></h3>
    <div style="color:#c5c5c5; font-size:13px;" id="contenido_ayuda"></div>
</aside>

    <!-- modal generico para tutoriales !-->
    <div class="modal fade" id="modal_tutorial_general" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Tutorial: <span id="titulo_tutorial"></span></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>      
            
            <div class="modal-body" id="cuerpo_tutorial">          
              <div class="embed-responsive embed-responsive-16by9">
                <iframe class="embed-responsive-item" id="ifrmTutoral" src="" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
              </div>
            </div>
        </div>
      </div>
    </div>
    <!-- modal generico para tutoriales !-->



    <!-- Modal -->
    <div class="modal fade" id="todas-las-notificaciones" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Notificaciones Actuales</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">                 
              <div class="row">
                <div class="col-md-12" style="height: 300px; overflow-y: auto;">

                  <ul class="list-unstyled">
          
          
                    @foreach($notificaciones as $notificacion)
                      @if($notificacion->TipoNoticia=="1")
                      <a href="{{$notificacion->URLNoticia}}" target="_parent"  class="enlace-notificacion">
                      @endif
                        <li class="media" style="border-bottom: 1px solid #ccc; padding:17px 15px;">
                <img src="{{url('')}}/assets/images/{{$notificacion->IconoNoticia}}" class="mr-3" alt="...">
                <div class="media-body">
                  <h5 class="mt-0 mb-1">{{$notificacion->TituloNoticia}}</h5>
                   {{$notificacion->DescripcionNoticia}}<br/>
                   <small style="background-color:#dedede; padding:5px; border-radius:9px;">{{$notificacion->FechaCreacion}}</small>
                </div>
              </li>

            @if($notificacion->TipoNoticia==1)
                      </a>
                      @endif

                    @endforeach


                  </ul>
                  
                    
                </div>
              </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary botones-docttus" data-dismiss="modal">Cerrar</button>                
          </div>
        </div>
      </div>
    </div>

  <!-- Modal Mensaje Generico -->
    <div class="modal fade" id="mensaje_generico" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" style="z-index: 9999999;">
      <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
        <div class="modal-content">
          <!--<div class="modal-header">            
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>-->
          <div class="modal-body">
            <div class="row">
              <div class="col-md-12">
                <center>  
                   <img src="{{url('')}}/assets/images/check_mensaje.png" class="icono-mensaje-1">
                   <img src="{{url('')}}/assets/images/error_mensaje.png" class="icono-mensaje-2">
                </center>
              </div>
              <div class="col-md-12">
                <center>  
                  <h2 class="titulo-mensaje">Bienvenido!</h2>
                  <p class="descripcion-mensaje">Has ingresado correctamente</p>
                </center>
              </div>
              <div class="col-md-12">
                <center>  
                  <button type="button" class="btn btn-success btn-mensajes btn-continuar" data-dismiss="modal">Continuar</button>   
                </center>
              </div>
            </div>              
          </div>

        </div>
      </div>
    </div>

<!-- ./wrapper -->

    <!-- Modal -->
    <div class="modal fade" id="barra_progreso_generica" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">          
          <div class="modal-body">  
            <div style="width:100%;" class="text-center">
                <h2 id="titulo_mensaje_progreso_generico">Guardando</h2>
                <p id="titulo_mensaje_progreso_generico">Espere un momento</p>
                <hr>
                <div style="width: 100%; padding:10px; background-color:#fff; border-radius:10px;">
                  <h5  style="font-family: times;margin-top: 0px; color:#0B5586; text-transform: capitalize; margin:0px; font-style: italic; " id="mensaje_motivacion"></h5>
                  <i style="font-size: 14px;font-family: times;margin-top: 0px; display: inline-block;  color:#fff;   background-color: #0B5586;   padding: 2px 20px;
           border-radius: 15px;  margin-top: 15px; " id="mensaje_autor"></i>
                </div>
                <br />
            </div>

            <div class="progress"  id="barra_progreso">              
              <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">0%</div>
            </div>
            <br />
            <center>
              <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
            </center>

          </div>
        </div>
      </div>
    </div>




<!-- REQUIRED SCRIPTS -->


<!-- Bootstrap 4 -->
<script src="{{url('')}}/assets-interno/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="{{url('')}}/assets-interno/dist/js/adminlte.min.js"></script>



<script src="{{url('')}}/assets-interno/plugins/flot/jquery.flot.js"></script>
<!-- FLOT RESIZE PLUGIN - allows the chart to redraw when the window is resized -->
<script src="{{url('')}}/assets-interno/plugins/flot-old/jquery.flot.resize.min.js"></script>
<!-- FLOT PIE PLUGIN - also used to draw donut charts -->
<script src="{{url('')}}/assets-interno/plugins/flot-old/jquery.flot.pie.min.js"></script>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.18.0/js/mdb.min.js"></script>

<!--<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>-->

<script src="{{url('')}}/assets/js/jquery-ui-1.12.1/jquery-ui.min.js"></script>
<script src="{{url('')}}/tinymce/js/tinymce/tinymce.min.js"></script>
<script src="{{url('')}}/tinymce/js/tinymce/jquery.tinymce.min.js"></script>
<script src="{{url('')}}/datatables/jquery.dataTables.min.js"></script>
<script src="https://vjs.zencdn.net/7.10.2/video.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js" crossorigin="anonymous"></script>
<script src="https://unpkg.com/@popperjs/core@2"></script>
<script src="https://unpkg.com/tippy.js@6"></script>


<script type="text/javascript">

$(function(){ 
    var arra_validaciones=$(".valida-caracteres");
    for(var i=0;i<arra_validaciones.length;i++){
        get_validacion(arra_validaciones[i].id);            
    }
    scroll_base();
    abrir_mensajes_motivacion();
  });

  $(".valida-caracteres").keyup(function(e){
        get_validacion(e.target.id);
  });

  $(window).scroll(function (event) {
      scroll_base();
  });

  function get_validacion(nombre_componente){          
    var texto_componente=$("#"+nombre_componente).val();
    var cant_total_char_componente=$("#"+nombre_componente).attr("maxlength");
    var cant_actual=cant_total_char_componente-texto_componente.length;
    $("#cant_caracteres_"+nombre_componente).html(cant_actual);
  }

  function scroll_base(){
    var scroll = $(window).scrollTop();
    var width_x= window.innerWidth;
      // Do something
      //console.log(scroll);
      if(width_x>900){
        if(scroll>=57){
          $(".barra-guardar").css("top","0px");
          $(".barra-guardar").css("position","fixed");
        }else{
          $(".barra-guardar").css("top","53px");
          $(".barra-guardar").css("position","absolute");
        }
      }else{

        if(scroll>=1){
          $(".barra-guardar").css("top","53px");
          $(".barra-guardar").css("position","fixed");
        }else{
          $(".barra-guardar").css("top","53px");
          $(".barra-guardar").css("position","absolute");
        }

      }
      
  }

  tippy('.btn-titulo', {
        theme: 'light',
        animation: 'scale',
        content(reference) {
          const title = reference.getAttribute('title');
          reference.removeAttribute('title');
          return title;
        },
  });

  
   function mensaje_generico(titulo,descripcion,tipo,nombre_boton,funcion_boton){
          if(tipo=="1"){
            $(".icono-mensaje-1").show();
            $(".icono-mensaje-2").hide();
            $(".titulo-mensaje").removeClass("titulo-mensaje-error");
            $(".titulo-mensaje").addClass("titulo-mensaje-exito");            
          }else{
            $(".icono-mensaje-2").show();
            $(".icono-mensaje-1").hide();
            $(".titulo-mensaje").removeClass("titulo-mensaje-exito");
            $(".titulo-mensaje").addClass("titulo-mensaje-error");
            
          }

          $(".titulo-mensaje").html(""+titulo);
          $(".descripcion-mensaje").html(""+descripcion);
          $("#mensaje_generico").modal("show");
          $(".btn-continuar").html(""+nombre_boton);
          $(".btn-continuar").click(function(){
            funcion_boton();  
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

    
    
    
    
    $("#btn_cerrar_ayuda").click(function(e){
      e.preventDefault();
      $("#panel_ayuda").hide();
    });


    function abrir_ayuda(id_ayuda){
      var request = $.ajax({
          url: "{{url('')}}/get_ayuda",
          type: "POST",
          data:{               
               IdAyuda:""+id_ayuda,               
               _token: "{{ csrf_token() }}"
          }
        });

        request.done(function(obj) { 
           if(obj.status=="ok"){       

              $("#panel_ayuda").show();
              $("#titulo_ayuda").html(""+obj.titulo_ayuda);
              $("#contenido_ayuda").html(""+obj.contenido_ayuda);

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



    function cambiar_rol(rol){
      
      
      
      var request = $.ajax({
          url: "{{url('')}}/cambiar_rol",
          type: "POST",
          data:{               
              rol:""+rol,               
               _token: "{{ csrf_token() }}"
          }
        });

        request.done(function(obj) { 
           if(obj.status=="ok"){       

              window.open("{{url('')}}/backoffice","_parent");

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


function mensaje_toast(tipo,descripcion,titulo,ubicacion='toast-top-right'){
		toastr.options = {
				"closeButton": true,
				"debug": false,
				"newestOnTop": true,
				"progressBar": true,
				"positionClass": ""+ubicacion,
				"preventDuplicates": true,
				"onclick": null,
				"showDuration": "300",
				"hideDuration": "1000",
				"timeOut": "5000",
				"extendedTimeOut": "1000",
				"showEasing": "swing",
				"hideEasing": "linear",
				"showMethod": "fadeIn",
				"hideMethod": "fadeOut"
			}
		toastr[tipo](descripcion,titulo);
			//
		
	}



  function visualizar_noticia(id_noticia){

      $("#noticia_"+id_noticia).hide("fast");

      var cant_notificaciones=$("#cant_notificacion").attr("cantidad");
      cant_notificaciones--;

      $("#cant_notificacion").html(cant_notificaciones);
      

      var request = $.ajax({
          url: "{{url('')}}/estado_noticia",
          type: "POST",
          data:{               
              IdNoticia:""+id_noticia,               
               _token: "{{ csrf_token() }}"
          }
        });

        request.done(function(obj) { 
           if(obj.status=="ok"){       

              var url_noticia=$("#noticia_"+id_noticia).attr("noticia-url");

              if(url_noticia){
                window.open(""+url_noticia,"_parent");
              }

              

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


    function validacion_tipo_video(tipo, url_video){
        var reg_exp='';

        if(tipo=="2"){
          reg_exp=/^((?:https?:)?\/\/)?((?:www|m)\.)?((?:youtube\.com|youtu.be))(\/(?:[\w\-]+\?v=|embed\/|v\/)?)([\w\-]+)(\S+)?$/;          
        }
        
        if(url_video.match(reg_exp)){
          return true;
        }else{
          return false;
        }
        
      }


      function get_id_video_url(tipo,url_video){
        var reg_exp='';
        if(tipo=="2"){
          reg_exp=/^.*((youtu.be\/)|(v\/)|(\/u\/\w\/)|(embed\/)|(watch\?))\??v?=?([^#&?]*).*/;          
          var match = url_video.match(reg_exp);
          var codigo_video=(match&&match[7].length==11)? match[7] : false;          
          var embed=`<iframe class="embed-responsive-item" src="https://www.youtube.com/embed/${codigo_video}?rel=0" allowfullscreen></iframe>`;
          return embed;
        }else if(tipo=="3"){
          var result = url_video.match(/(?:www\.|player\.)?vimeo.com\/(?:channels\/(?:\w+\/)?|groups\/(?:[^\/]*)\/videos\/|album\/(?:\d+)\/video\/|video\/|)(\d+)(?:[a-zA-Z0-9_\-]+)?/i);
          var embed=`<iframe class="embed-responsive-item" src="https://player.vimeo.com/video/${result[1]}?rel=0" allowfullscreen></iframe>`;
          return embed;        
        }
      }

      
      function abrir_barra_progreso(){
        $('#barra_progreso_generica').modal({backdrop: 'static', keyboard: false})  
        $("#barra_progreso_generica").modal("show");

        var mensaje_Select=get_mensaje_motivacion();
        $('#mensaje_motivacion').html(mensaje_Select.mensaje);
        $('#mensaje_autor').html(" - "+mensaje_Select.autor+" - ");
      }

      var myVarTimerProgress;

      

      function alertFunc() {
        $("#barra_progreso_generica").modal("hide");
        progress_bar_componente(0);
        clearInterval(myVarTimerProgress);
      }

      function cerrar_barra_progreso(){
        console.log("se cierra");
        //myVarTimerProgress = setInterval(alertFunc, 3000);  
        progress_bar_componente(0);
        $("#barra_progreso_generica").modal("hide");
      }

      var mensajes_motivacion=new Object();
      function abrir_mensajes_motivacion(){
        $.getJSON("{{url('')}}/assets/mensajes.json", function(data){
            mensajes_motivacion=data.mensajes;
        }).fail(function(){
            console.log("An error has occurred.");
        });
      }

      function get_mensaje_motivacion(){
          var min=0;
          var max=mensajes_motivacion.length;
          var indx_mensaje=Math.floor(Math.random() * (max - min)) + min;
          return mensajes_motivacion[indx_mensaje];

      }

      

      function progress_bar_componente(porcent_envio){
        //$("#barra_progreso .progress-bar").removeClass("bg-success");
        $("#barra_progreso .progress-bar").css("width",porcent_envio+"%");
        $("#barra_progreso .progress-bar").attr("aria-valuenow",""+porcent_envio);
        $("#barra_progreso .progress-bar").html(porcent_envio+"%");        
        if(parseFloat(porcent_envio)>=100){
          //$("#barra_progreso .progress-bar").addClass("bg-success");          
          console.log("sizzzzaass");
          
        }        
      }


      function addCommas(nStr) {
        nStr += '';
        var x = nStr.split('.');
        var x1 = x[0];
        var x2 = x.length > 1 ? '.' + x[1] : '';
        var rgx = /(\d+)(\d{3})/;
        while (rgx.test(x1)) {
            x1 = x1.replace(rgx, '$1' + ',' + '$2');
        }
        return x1 + x2;
      }

      @if(isset($barra_guardar)==1)
        @if($curso->IdEstado=="3" || session('rol_solicitud')=="root")
        $("#btn_guardar_curso").click(function(e){
            e.preventDefault();
            $("#btn_enviar_form_generico").trigger("click");
        });
        @endif
      @endif


    

    

        //HABILITAR TUTORIAL GENERICO
    $(".btn_tutorial_gen").click(function(e){
      e.preventDefault();
      var url_tutorial=$(this).attr("src_tutorial");
      var titulo_tutorial=$(this).attr("titulo_tutorial");

      $("#ifrmTutoral").attr("src",url_tutorial);
      $("#titulo_tutorial").html(titulo_tutorial);
      
      $("#modal_tutorial_general").modal("show");

    });

    $('#modal_tutorial_general').on('hidden.bs.modal', function () {
      $("#ifrmTutoral").attr("src","");
    });
    
    

</script>

@yield('scripts')

@if(isset($barra_guardar)==1)
<script>

    //PENDIENTE
    $("#btn_publicar_curso").click(function(e){
        $("#enviar_curso_produccion").modal("show");
    });

    $("#btn_enviar_revision").click(function(e){
        e.preventDefault();

        var formData = new FormData();         
        formData.append('estado', "pedntcurs");
        guardar_informacion_publicacion(formData,"enviar_curso_publicacion");

    });


    
    //BORRADOR
    @if($curso->IdEstado=="7")
    $("#btn_borrador_curso").click(function(e){
        $("#enviar_curso_borrador").modal("show");
    });

    $("#btn_enviar_borrador").click(function(e){
        e.preventDefault();
        var formData = new FormData();         
        formData.append('estado', "borrdcurs");
        guardar_informacion_publicacion(formData,"enviar_curso_publicacion");
    });
    @endif


    @if($curso->IdEstado=="1"  && session('rol_solicitud')=="root")
    $("#btn_borrador_curso").click(function(e){
        $("#enviar_curso_borrador").modal("show");
    });

    $("#btn_enviar_borrador").click(function(e){
        e.preventDefault();
        var formData = new FormData();         
        formData.append('estado', "borrdcurs");
        guardar_informacion_publicacion(formData,"enviar_curso_publicacion");
    });
    @endif

    //PUBLICACIÓN
    @if($curso->IdEstado=="7" && session('rol_solicitud')=="root")
    $("#btn_publicarfinal_curso").click(function(e){
        $("#enviar_curso_publicacion").modal("show");
    });

    $("#btn_enviar_publicacion").click(function(e){
        e.preventDefault();
        var formData = new FormData(); 
        formData.append('estado', "publicdcurs");        
        guardar_informacion_publicacion(formData,"enviar_curso_publicacion");
    });
    @endif


    function guardar_informacion_publicacion(campos,funcionlv){

        campos.append('CodigoCurso', "{{$curso->CodigoCurso}}");
        campos.append('_token', "{{ csrf_token() }}");        
        campos.append('token_curso', "{{ $token_curso }}");


        var request = $.ajax({
            url: "{{url('')}}/"+funcionlv,
            type: "POST",
            data: campos,
            processData: false,  // tell jQuery not to process the data
            contentType: false,  // tell jQuery not to set contentType
            cache:false
        });

        request.done(function(obj) { 
            if(obj.status=="ok"){                            
                mensaje_generico("Correcto",""+obj.mensaje,"1","Continuar...",function(){
                location.reload();
                });

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



    


    

    


</script>
@endif

</body>
</html>
