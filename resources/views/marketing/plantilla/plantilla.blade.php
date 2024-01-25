<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;
use App\Quotation;

$curso_controller = new CursoController();
$arra_supercategoria=$curso_controller->get_supercategorias();
$arra_categoria=$curso_controller->get_categorias(1);
$arra_subcategorias=$curso_controller->get_subcategorias(1);


$active_menu_1="";
$active_menu_2="";
$active_menu_3="";

if($id_pagina=="index"){
	$active_menu_1="active";
}

if($id_pagina=="subcategoria" || $id_pagina=="cursos" ){
	$active_menu_2="active";
}

$controller = new AdminController();
$arra_data_usuario=$controller->VerificarSesid();


?>

<!DOCTYPE html>
<html lang="es">
<head>

	<!-- <script src="//code.tidio.co/ulra00gr9tvvrf2cjia2x7e2xhikormn.js" async></script> -->

	<!-- Google Tag Manager -->
	<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
	new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
	j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
	'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
	})(window,document,'script','dataLayer','GTM-WJDGF3R');</script>
	<!-- End Google Tag Manager -->


	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=G-3L5QNG5XGR"></script>
	<script>
	window.dataLayer = window.dataLayer || [];
	function gtag(){dataLayer.push(arguments);}
	gtag('js', new Date());

	gtag('config', 'G-3L5QNG5XGR');
	</script>
	<!-- Global site tag (gtag.js) - Google Analytics -->


	<title>10 Millions Club</title>
	<meta charset="UTF-8">
	<meta name="description" content="10 Millions Club">
	<meta name="keywords" content="music, html">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	
	<!-- Favicon -->
	<link rel="icon" type="image/png" href="{{url('')}}/assets-marketing/images/favicon.png">

	<!-- Google font -->
	<link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900&display=swap" rel="stylesheet">	
 
	<!-- Stylesheets -->
	<link rel="stylesheet" href="{{url('')}}/assets-marketing/css/bootstrap.min.css"/>
	<link rel="stylesheet" href="{{url('')}}/assets-marketing/css/font-awesome.min.css"/>
	<link rel="stylesheet" href="{{url('')}}/assets-marketing/css/owl.carousel.min.css"/>
	<link rel="stylesheet" href="{{url('')}}/assets-marketing/css/slicknav.min.css"/>


	
	<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css"/>
	

	<meta name="DC.title" lang="es" content="{{isset($tituloPagina) ? $tituloPagina :''}}" />
    <meta name="DC.description" lang="es" content="{{isset($descripcionPagina) ? $descripcionPagina :''}}" />
    <meta name="DC.date" scheme="W3CDTF" content="2022-06-03T10:20:00+02:00" />
    <meta name="DC.date.issued" scheme="W3CDTF" content="2022-06-03T10:20:00+02:00" />
    <meta name="DC.language" scheme="RFC1766" content="es" />
    <meta name="DC.creator" content="10MillionsClub.live" />
    <meta name="DC.publisher" content="10MillionsClub.live" />

	<meta property="og:site_name" content="{{url('')}}" />
    <meta property="og:title" content="{{isset($tituloPagina) ? $tituloPagina :''}}" />
    <meta property="og:description" content="{{isset($descripcionPagina) ? $descripcionPagina :''}}" />
    <meta property="og:updated_time" content="2022-06-03T10:20:00+02:00" />
    <meta property="og:image" content="{{isset($imagenPagina) ? $imagenPagina :''}}" />
    <meta property="og:url" content="{{url('')}}" />
    <meta property="og:type" content="article" />

    <meta name="twitter:card" content="summary" />
    <meta name="twitter:site" content="{{url('')}}" />
    <meta name="twitter:title" content="{{isset($tituloPagina) ? $tituloPagina :''}}" />
    <meta name="twitter:description" content="{{isset($descripcionPagina) ? $descripcionPagina :''}}" />
    <meta name="twitter:image" content="{{isset($imagenPagina) ? $imagenPagina :''}}" />
    <meta name="twitter:url" content="{{url('')}}" />





	<!-- Main Stylesheets -->
	<link rel="stylesheet" href="{{url('')}}/assets-marketing/css/style.css"/>

	<link href="https://vjs.zencdn.net/7.10.2/video-js.css" rel="stylesheet" />
	<script src="https://www.google.com/recaptcha/api.js" async defer></script>


	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->

	<!-- Facebook Pixel Code -->
	@if(isset($pixel_facebook_afiliado))
		@if($pixel_facebook_afiliado!="")
		<script>
		!function(f,b,e,v,n,t,s)
		{if(f.fbq)return;n=f.fbq=function(){n.callMethod?
		n.callMethod.apply(n,arguments):n.queue.push(arguments)};
		if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
		n.queue=[];t=b.createElement(e);t.async=!0;
		t.src=v;s=b.getElementsByTagName(e)[0];
		s.parentNode.insertBefore(t,s)}(window, document,'script',
		'https://connect.facebook.net/en_US/fbevents.js');
		fbq('init', '{{$pixel_facebook_afiliado}}');
		fbq('track', 'PageView');
		</script>
		<noscript><img height="1" width="1" style="display:none"
		src="https://www.facebook.com/tr?id={{$pixel_facebook_afiliado}}&ev=PageView&noscript=1"
		/></noscript>
		<!-- End Facebook Pixel Code -->
		@endif
	@endif


	@if(isset($pixel_facebook_docttus))
		@if($pixel_facebook_docttus!="")
			<script>
			!function(f,b,e,v,n,t,s)
			{if(f.fbq)return;n=f.fbq=function(){n.callMethod?
			n.callMethod.apply(n,arguments):n.queue.push(arguments)};
			if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
			n.queue=[];t=b.createElement(e);t.async=!0;
			t.src=v;s=b.getElementsByTagName(e)[0];
			s.parentNode.insertBefore(t,s)}(window, document,'script',
			'https://connect.facebook.net/en_US/fbevents.js');
			fbq('init', '{{$pixel_facebook_docttus}}');
			fbq('track', 'PageView');
			</script>
			<noscript><img height="1" width="1" style="display:none"
			src="https://www.facebook.com/tr?id={{$pixel_facebook_docttus}}&ev=PageView&noscript=1"
			/></noscript>
			<!-- End Facebook Pixel Code -->
		@endif
	@endif

	
	

	<style type="text/css">

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


	h1{
		color:#222;		
	}

	.concept-item{
		border-radius: 9px;
		padding:25px;
		cursor: pointer;
	}

	.concept-item:hover{
		background-color: #F95850;
		border-radius: 9px;
		padding:25px;
		color: #fff !important;
	}

	.input-buscar{
		width: 0px; 
		display:inline-block; 
		border:none; 
		border-radius:25px; 
		padding-left:10px;
		display: none;
		transition: width 1s;
	}


	#form_searh_modal{
		display: none;
	}
	

	.concept-item:hover h5{
	
		color: #fff !important;
	}

	.card-docttus{
          background-color: #fff;
          border-radius: 9px;
          padding: 25px;          
          box-shadow: 0px 0 7px 0px #ecebeb;
          position: relative;
      }

      .botones-docttus{
        background-color: #F95850;
        border-radius: 28px;
        border: none;
        font-size: 16px;        
        display: inline-block;
        width: auto;
        padding-left: 25px;
        padding-right: 25px;
        color: #fff;
      }

      .card-docttus-left{
         height: 512px;
      }

      .card-docttus-right-1{
        height: 247px;
      }
      .card-docttus-right-2{
        height: 247px;
        margin-top: 20px;
      }

      .card-docttus-cursos{
         height: 245px;
      }
      .estrella{
      	color:#e8ae00;
		margin-right: 0px;
      }

      .contain-info .icono{
      	width: 50px;
      }
      .contain-info .icono img{
      	width: 100%;
      }

      .datos-info p{
      	color: #fff;
      	font-weight: 300;
      	padding: 0px;
      	margin: 0px;
      }

      .contain-info{
      	border-bottom: 1px solid #95773c;
    	padding-bottom: 10px;
    	margin-bottom: 15px;
      }
      .footer-section{
      	background-image: url();
      }

      	.form-item-dtt{
			background-color: transparent !important;
			border-radius: 0px !important;
			border:none;
			border-bottom: 1px solid #95773c !important;
			color: #fff !important;
		}	


		.form-item-dtt::placeholder { /* Chrome, Firefox, Opera, Safari 10.1+ */
			color: #ffebc5;
			opacity: 1; /* Firefox */
		}

		.form-item-dtt:-ms-input-placeholder { /* Internet Explorer 10-11 */
			color: #ffebc5;
		}

		.form-item-dtt::-ms-input-placeholder { /* Microsoft Edge */
			color: #ffebc5;
		}

		.about-footer{
			color: #fff; 
			font-weight: 300; 
			margin-top: 20px;
		}
		.logo-footer{
			width: 100%;
			margin-bottom: 25px;
		}

		.modal-usuario{
			position: absolute; 
			z-index: 999; 
			width: 264px; 
			background-color: #fff;	
			height: auto;	
			margin-top: 27px;	
			right: 0px; 
			border:1px solid #ccc;
			box-shadow: 0px 5px 10px 0px #c5c5c5;
			display: none;
			

		}
		.modal-usuario .contenedor{
			padding: 10px;
			widows: 100%;
		}

		.btn-usuario-menu{
			padding-left:1px !important; 
			margin-left:0px !important; 
			text-align: left; 
			color:#000 !important;
		}
		.btn-usuario-menu:hover{
			background:none;
			background-color: #ccc !important;
		}

		.contenedor-compra-ficha{
			margin-top: -292px;
			width: 100%;	
		}

		@media only screen and (max-width: 991px) {

			.contenedor-compra-ficha{
				margin-top: 0px;
				width: 100%;	
			}

			.caracteristicas-curso{
				padding-left: 49px;
				padding-right: 49px;
			}

			#btn-circle-up	{
				display: none;
			}

			#rocket-dtt{
				display: none;	
			}

			.footer-section{
				background-image: none !important;
				background-color: #1c1c1c;
			}

			.footer-section{
				padding-top: 35px;
				padding-bottom: 25px !important;
			}
			.contain-info{
				padding-left: 10px;
			}

			.contain-info .icono{
				width: 38px;
			}

			.about-footer{
				text-align: center;
				margin-bottom: 45px;
			}

			.logo-footer{
				text-align: center;
			}

			.menu-widget{
				text-align: center;
			}

			.form-widget{
				text-align: center;
				margin-top: 35px;
				margin-bottom: 35px;
			}

			.social-links{
				margin-left: 50px; 
			}

		}
	</style>

	@yield('cabecera')

</head>
<body>
	<!-- Header section -->
	<header class="header-docttus clearfix" id="cabecera_dt">

		
		
		<div class="container" style="margin-top: 20px;">
			<div class="row">
				<div class="col-md-5 col-6">	
					<a href="{{url('')}}">
						<img class="logo_docttus" src="{{url('')}}/logo-white.svg" style="height: 74px;">	
						
					</a>					
				</div>
				<div class="col-md-7 col-6" style="text-align: right;">
					<ul class="main-menu">
						<li><a href="{{url('')}}" class="{{$active_menu_1}}">Inicio</a></li>						
						<li><a href="{{url('')}}/#producto" >Productos</a></li>
						<li><a href="{{url('')}}/cursos-ten-millions" class="{{$active_menu_2}}">Cursos</a></li>
						@if(count($arra_data_usuario)==0)
						<li><a href="{{url('')}}/login">Login</a></li>
						<li><a href="{{url('')}}/registro" style="border: 1px solid #ffff; border-radius: 9px;">Registro</a></li>
						@endif
						<form action="{{url('')}}/cursos-ten-millions" method="get" id="form_searh_modal" >
							<input type="search" class="input-buscar" placeholder="Buscar" name="key">
						</form>

						
						<a href="#"  id="btn_buscar"  class="boton-buscar"><i class="fa fa-search" aria-hidden="true"></i></a>					
						
						@if(count($arra_data_usuario)!=0)
						<li>
							<a style="width:35px;" href="#" id="btn-usuario-registro">
								<div   style="width: 35px; height: 35px; 
	display: inline-block; margin-right: 5px; border-radius: 25px; position: absolute; top: -14px; left: 9px; background-position: center; background-size: cover; background-repeat: no-repeat; background-image: url({{url('')}}/assets/images/usuarios/{{$arra_data_usuario[0]->FotoPersona}});">
								</div>
							</a>


							<div class="modal-usuario">
								<div class="contenedor" style="border-bottom: 1px solid #ccc; text-align:left;">
									<div class="row">
										<div class="col-4">
											<div   style="width: 65px; height: 65px; display: inline-block; border-radius: 55px; background-position: center; background-size: cover; background-repeat: no-repeat; background-image: url({{url('')}}/assets/images/usuarios/{{$arra_data_usuario[0]->FotoPersona}});">
											</div>
										</div>
										<div class="col-8" style="padding-top: 10px;">
											<h3 style="font-size: 16px;">{{$arra_data_usuario[0]->NombrePersona}}</h3>
											<small>{{$arra_data_usuario[0]->EmailPersona}}</small>
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
						@endif
					</ul>

					<div class="menu_principal_mobile">
					    <button class="btn_menu_mobile"  data-toggle="modal" data-target="#modal_menu">
					    	<i class="fa fa-bars" aria-hidden="true"></i>
					    </button>

						</div>




					</div>
					
				</div>
				
			</div>


			<div class="contain-categoria">
				<div class="container">
					<div class="col-md-12 text-center">

						@foreach($arra_supercategoria as $supercategoria)
							<a href="#" class="enlace-categoria" id="cate_{{$supercategoria->IdSuperCategoria}}">
								<img src="{{url('')}}/assets-marketing/categorias/{{$supercategoria->IdSuperCategoria}}"   onerror="this.src='{{url('')}}/assets-marketing/categorias/next.png';"  > 
								<span> {{$supercategoria->NombreSuperCategoria}}</span>
							</a>	
						@endforeach						
						
					</div>
				</div>				
			</div>

			<div class="contain-subcatagorias">		
				<div class="container">
					<div class="row">
						<div class="col-md-12" style="text-align: center;" id="listado-subcategorias" >
							
								
							
						</div>
					</div>
				</div>			
			</div>


			<div class="remove-subcategoria">
				
			</div>


		</div>

		
	</header>
	<!-- Header section end -->

<!-- Modal -->
<div class="modal fade" id="modal_menu" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">

  	 <div class="modal-content" style="border:none;     height: 98vh;">

	  	<div class="modal-body"  style="width: 100%; padding: 35px; background: #062b44;">
	     <div>

			<a href="#" style="display: none;" id="btn_atras_categoria">
				<i style="font-size: 25px; color: #fff; float: left; position: absolute; top: 15px; left: 15px;" class="fa fa-chevron-left" aria-hidden="true"></i>
			</a>

			
			<img style="width: 122px; position: absolute; top: 10px; left: 50%; margin-left: -61px; " src="{{url('')}}/logo-white.svg">	


			<a href="#" data-dismiss="modal" aria-label="Close" >
				<i style="font-size: 25px; color: #fff; float: right; position: absolute; top: 15px; right: 15px;" class="fa fa-times" aria-hidden="true"></i>
			</a>

			<ul class="menu_mobile" id="menu_mobile_principal">
				<li><a href="{{url('')}}" class="active">Inicio</a></li>
				<li><a href="{{url('')}}/acerca-de-nosotros">Acerca</a></li>
				<li><a href="{{url('')}}/productos-ten-millions">Productos</a></li>
				<li><a href="{{url('')}}/blog">Blog</a></li>
				<li><a href="{{url('')}}/contactenos">Contactenos</a></li>
				<li><a href="{{url('')}}/login">Login</a></li>
				<li><a href="#" id="btn_categoria_mobile">Categorías</a></li>
				<li><a href="#"  data-dismiss="modal" aria-label="Close" class="boton"  data-toggle="modal" data-target="#modal_search" ><i class="fa fa-search" aria-hidden="true"></i></a></li>
			</ul>

			<div style="width: 100%;  padding-top: 45px; display: none;"  id="menu_mobile_categorias">
				
				<div class="accordion" id="accordion_mobile">						
						<ul class="list-group list-group-flush">
						@foreach($arra_categoria as $categoria)
						  	<li class="list-group-item" style="font-size: 13px; background-color: transparent; padding-left: 0px; padding-right: 0px;">
						  		<button type="button" data-toggle="collapse" data-target="#collapse_m_{{$categoria->IdCategoriaCursos}}" aria-expanded="true" aria-controls="collapse_m_{{$categoria->IdCategoriaCursos}}" style="width: 100%;text-align: left;background: transparent; border: none; color:#fff;">
						  			<img style="width: 20px; margin-right: 0px; margin-top: -5px;" src="{{url('')}}/assets-marketing/categorias/{{$categoria->ImagenCategoria}}"   onerror="this.src='{{url('')}}/assets-marketing/categorias/next.png';" > {{$categoria->NombreCategoria}}
						  		</button>
								
								

								<div id="collapse_m_{{$categoria->IdCategoriaCursos}}" class="collapse" aria-labelledby="headingOne" data-parent="#accordion_mobile">
							      
							        <ul class="list-group list-group-flush" style="margin-top: 5px;  background-color: transparent;">
							        	@foreach($arra_subcategorias as $subcat)
							        		@if($subcat->IdCategoria==$categoria->IdCategoriaCursos)
											
											<?php
											$color_bg_subcategoria="#1c1c1c;";
											if($id_pagina=="subcategoria"){

												if($id_subcategoria == $subcat->IdSubcategoria){
													$color_bg_subcategoria="#1c1c1c;";
												}

											}

											?>
											

											<li class="list-group-item" style=" font-size: 12px; background-color: {{$color_bg_subcategoria}};  padding-left: 20px;">
												<a style="text-decoration: none; color: #fff;" href="{{url('')}}/categoria/{{$subcat->SlugSubcategoria}}">
												<img style="width: 16px; margin-right: 3px; margin-top: -2px;" src="{{url('')}}/assets-marketing/categorias/{{$subcat->IconoSucategoria}}"   onerror="this.src='{{url('')}}/assets-marketing/categorias/next.png';" > {{$subcat->NombreSubcategoria}}		
												</a>
							        		</li>	
							        		@endif
										@endforeach
							        </ul>
							    </div>

						  	</li>
						@endforeach						
						</ul>

					</div>	

			</div>



	     </div>
	    </div>
	 </div>
  </div>
</div>
<!-- Menu Modal -->




	@yield('contenido')

	@if(isset($data_afiliado)!=null)
	<section class="seccion-gris" style="background-color:#fff;padding-top:40px; padding-bottom: 40px; ">
		
		<div class="container">
			<div class="row" style="background-color: #e9e9e9; border:1px solid #ccc; border-radius:25px; padding:15px;">
				<div class="col-md-3 text-center pt-3">
					<div class="contain-foto-tutor">
						<div class="foto-tutor" style="background-image:url('{{url('')}}/assets/images/usuarios/{{$data_afiliado[0]->FotoPersona}}'); background-size: cover; background-position: center;">
							
						</div>
					</div>
				</div>

				<div class="col-md-9 pt-4">
					<h3>Asesor Comercial: </h3>
					<hr />
					<h4>{{$data_afiliado[0]->NombrePersona}} {{$data_afiliado[0]->ApellidosPersona}}</h4>
					<br />
					<p>{{$data_afiliado[0]->DescripcionPersona}}</p>
					<br />
					@if($data_afiliado[0]->TelefonoPersona!="")
					<a href="tel:{{$data_afiliado[0]->TelefonoPersona}}" class="btn-docttus-web">Tel: {{$data_afiliado[0]->TelefonoPersona}}</a> 
					@endif

					@if($data_afiliado[0]->WhatsappPersona!="")
					<a href="https://api.whatsapp.com/send?phone={{$data_afiliado[0]->WhatsappPersona}}&text=Hola" class="btn-docttus-web" style="margin-left:20px;">Whatsapp: {{$data_afiliado[0]->WhatsappPersona}}</a>
					@endif					
					
					<a href="mailto:{{$data_afiliado[0]->EmailPersona}}" class="btn-docttus-web" style="margin-left:20px;">Email: {{$data_afiliado[0]->EmailPersona}}</a>

				</div>

			</div>
		</div>
	</section>
	@endif

	<!-- Footer section -->
	<footer class="footer-section" style="background-image: url('{{url('')}}/assets-marketing/images/fondo-footer.jpg'); padding-bottom: 285px; position: relative;">

		<img id="rocket-dtt" src="{{url('')}}/assets-marketing/images/cohete-footer.png" style="width: 98px; position:absolute; z-index: 99;  top: -40px; left: 50%; margin-left: -49px;">

		<a href="#" id="btn-circle-up">
			<img src="{{url('')}}/assets-marketing/images/circle-up.png" style="width: 70px; position:absolute; z-index: 99;  bottom:120px; left: 50%; margin-left: -35px;">
		</a>

		<div class="container">
			<div class="row">

				<div class="col-xl-4">
					<div class="logo-footer">
						<img src="{{url('')}}/logo-white.svg" style="height: 74px;" alt="">	
					</div>

					<p class="about-footer">La misión de nuestra empresa es brindar a nuestros clientes soluciones integrales y personalizadas en sus procesos financieros, de emprendimiento y personales, conectándolos con profesionales expertos que les guiarán y acompañarán en cada etapa, asegurando su éxito y bienestar en su idioma.</p>

					<!--<div class="row contain-info">
						<div class="icono">
							<img src="{{url('')}}/assets-marketing/images/circle-ubicacion.png">
						</div>
						<div class="col datos-info">
							<p>Dirección: <strong>Calle 105 No. 26A-53 Apto 803 - Torre Moravia Bucaramanga, Santander, Colombia</strong></p>							
						</div>
					</div>-->

					<div class="row contain-info mt-5">
						<div class="icono">
							<img src="{{url('')}}/assets-marketing/images/circle-phone.png">
						</div>
						<div class="col datos-info">
							<p>Teléfono:  <strong>+1 (551) 556-8543</strong></p>
							
						</div>
					</div>


					<div class="row contain-info">
						<div class="icono">
							<img src="{{url('')}}/assets-marketing/images/circle-email.png">
						</div>
						<div class="col datos-info">
							<p>Email: <strong>info@10millionsclub.live</strong></p>
							
						</div>
					</div>

					<div class="social-links">
						<a href="https://www.instagram.com/docttusoficial/"><i class="fa fa-instagram"></i></a>						
						<a href="https://www.facebook.com/DocttusOficial"><i class="fa fa-facebook"></i></a>
						<a href="https://twitter.com/DocttusOficial"><i class="fa fa-twitter"></i></a>
						<a href=""><i class="fa fa-youtube"></i></a>
					</div>
				</div>


				<div class="col-xl-4 offset-md-4">

					<div class="row">
						<div class="col-sm-12">
							<div class="footer-widget form-widget">
								<h2>Envíanos un mensaje</h2>

								<form class="form" style="margin-bottom:25px; " id="form_mensaje">
									
									
									<div class="row">
										<div class="col-md-6">
											<input type="text" id="NombreMensaje" name="" class="form-control form-item-dtt" placeholder="Tu Nombre" required>
										</div>

										<div class="col-md-6">
											<input type="email" id="EmailMensaje" name="" class="form-control form-item-dtt" placeholder="Tu Email" required>
										</div>
									</div>

									<div class="row">
										<div class="col-md-12">
											<textarea class="form-control form-item-dtt" id="ObservacionMensaje" placeholder="Mensaje" rows="4"></textarea>
										</div>
									</div>


									<div class="row">
										<div class="col-md-12" style="margin-top: 15px;">
											<center>
												<button class="btn-docttus-web">ENVIAR MENSAJE AHORA</button>	
											</center>											
										</div>
									</div>

								</form>

							</div>
						</div>
					</div>


					<div class="row" style="margin-top: 25px;">
						<div class="col-sm-6">
							<div class="footer-widget menu-widget">
								<h2>Menú</h2>
								<ul>
									<li><a href="{{url('')}}">Inicio</a></li>
									<li><a href="{{url('')}}/acerca-de-nosotros">Acerca de Nosotros</a></li>
									<li><a href="{{url('')}}/cursos-ten-millions">Cursos Disponibles</a></li>
									<li><a href="{{url('')}}/blog">Blog y Noticias</a></li>									
								</ul>
							</div>
						</div>

						<div class="col-sm-6">
							<div class="footer-widget menu-widget">
								<h2></h2>
								<ul>
									<li><a href="{{url('')}}/politica/politicas-de-privacidad">Políticas de Privacidad</a></li>
									<li><a href="{{url('')}}/politica/politicas-de-uso">Términos de Uso</a></li>									
									<li><a href="{{url('')}}/afiliados">Afiliados</a></li>									
									<li><a href="{{url('')}}/contactenos">Contactenos</a></li>
								</ul>
							</div>
						</div>
						
						
					</div>
				</div>
				
				


			</div>
		</div>
	</footer>
	<section class="barra-inferior" style="width: 100%; background-color: #95773c; padding:10px;">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<span style="color: #fff;">© 2024, 10Million$Club. Copyright</span>
					<span style="color: #fff; position: absolute; font-size: 12px; font-weight: 100;top: 8px;right: 8px;">V. {{env("APP_VERSION")}}</span>
				</div>
			</div>
		</div>
	</section>





	
	


	<!-- Modal Mensaje Generico -->
    <div class="modal fade" id="mensaje_generico" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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
                  <p class="descripcion-mensaje">Inicio sesesión.</p>
                </center>
              </div>
              <div class="col-md-12">
                <center>  
                  <button type="button" class="btn btn-success btn-mensajes btn-continuar" data-dismiss="modal">Continue</button>   
                </center>
              </div>
            </div>              
          </div>

        </div>
      </div>
    </div>
    <!-- fin MODAL Mensaje Generico -->




	<!-- Footer section end -->
	
	<!--====== Javascripts & Jquery ======-->
	<script src="{{url('')}}/assets-marketing/js/jquery-3.2.1.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	

	<script src="{{url('')}}/assets-marketing/js/bootstrap.min.js"></script>
	<script src="{{url('')}}/assets-marketing/js/jquery.slicknav.min.js"></script>
	<script src="{{url('')}}/assets-marketing/js/owl.carousel.min.js"></script>
	<script src="{{url('')}}/assets-marketing/js/mixitup.min.js"></script>
	<script src="{{url('')}}/assets-marketing/js/main.js"></script>

	
	<script src="https://vjs.zencdn.net/7.10.2/video.min.js"></script>
	
	<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js" crossorigin="anonymous"></script>

	@yield('scripts')

	<script type="text/javascript">

		$("#btn-circle-up").click(function(e){
			e.preventDefault();
		    $("html, body").animate({scrollTop: 0}, 1000);
		});

		var band_cat=0;
		$(".contain-subcatagorias").hide();
		$(".remove-subcategoria").hide();
		$(".contain-categoria").hide();
		/*var arra_subcategorias=[
		@foreach($arra_subcategorias as $categoria)
			{
				"IdSubcategoria":"{{$categoria->IdSubcategoria}}",
				"NombreSubcategoria":"{{$categoria->NombreSubcategoria}}",
				"IdCategoria":"{{$categoria->IdCategoria}}",
				"SlugSubcategoria":"{{$categoria->SlugSubcategoria}}",
				"IconoSucategoria":"{{$categoria->IconoSucategoria}}"

			},
		@endforeach
		];*/
		var arra_categorias=@json($arra_categoria);

		$(".header-docttus").attr("style","background-color:#1c1c1c;");			

		$("#btn_atras_categoria").click(function(){
			$("#menu_mobile_categorias").hide("fast");
			$("#menu_mobile_principal").show("fast");
			$("#btn_atras_categoria").hide("fast");
		});

		$("#btn_categoria_mobile").click(function(){
			$("#menu_mobile_categorias").show("fast");
			$("#menu_mobile_principal").hide("fast");
			$("#btn_atras_categoria").show("fast");
		});

		

		$(window).scroll(function()
		{
			var scroll_top=$("html").scrollTop();
			var width_html=$("html").width();
			band_cat=0;
			
			if(scroll_top>=198){
				$(".header-docttus").attr("style","background-color:#1c1c1c;");			
				$(".contain-categoria").attr("style","top: 81px;display:none;");	
				$(".contain-subcatagorias").attr("style","top: 134px;display:none;");
				$(".remove-subcategoria").attr("style","top: 251px;display:none;");

				
				if(width_html>991){
					$(".header-docttus > .container").attr("style","margin-top:0px;");
					$(".logo_docttus").attr("style","height: 52px; margin-top: 10px;");
				}else{
					$(".header-docttus").attr("style","background-color:#1c1c1c;");			
				}
				
				
			}else{
				$(".header-docttus").attr("style","background-color:#1c1c1c;");				
				$(".contain-categoria").attr("style","top: 112px;display:none;");	
				$(".contain-subcatagorias").attr("style","top: 166px;display:none;");
				$(".remove-subcategoria").attr("style","top: 282px;display:none;");
				if(width_html>991){
					$(".header-docttus > .container").attr("style","margin-top:10px;");
					$(".logo_docttus").attr("style","height: 74px; margin-top: 0px;");
				}else{
					$(".header-docttus").attr("style","background-color:#1c1c1c;");			
				}				
			}

		});
		
		

		$("#btn_categoria").click(function(e){
			e.preventDefault();
			if(band_cat==0){
				$(".contain-categoria").show();	
				band_cat=1;
			}else{
				$(".contain-categoria").hide();	
				$(".contain-subcatagorias").hide();
				$(".remove-subcategoria").hide();
				band_cat=0;
			}
			
		});

		$(".enlace-categoria").hover(function(e){
			$(".contain-subcatagorias").show();
			$(".remove-subcategoria").show();
			var objeto_t=e.currentTarget;
			var id_componente=""+objeto_t.id;
			var arra_componente=id_componente.split("_");
			var id_final=arra_componente[1];
			var cadena_subcategorias="";


			for(var i=0;i<arra_categorias.length;i++){
				if(""+id_final==""+arra_categorias[i].IdSupercategoria){					
					cadena_subcategorias+='<a href="{{url('')}}/categoria/'+arra_categorias[i].SlugCategoria+'" class="btn-subcategoria">';
					cadena_subcategorias+='    <center>';
					cadena_subcategorias+=`<img src="{{url('')}}/assets-marketing/categorias/${arra_categorias[i].ImagenCategoria}"     onerror="this.src='{{url('')}}/assets-marketing/categorias/next.png';"    style="width: 45px;"><br/>`;
					cadena_subcategorias+='       <span> '+arra_categorias[i].NombreCategoria+'</span>';
					cadena_subcategorias+='    </center>';
					cadena_subcategorias+='</a>';					

				}
			}
			$("#listado-subcategorias").html(cadena_subcategorias);
		});

		//QUITAR SUBCATEGORIAS DEL MENU
		$(".remove-subcategoria").hover(function(e){			
			$(".contain-subcatagorias").hide();
			$(".remove-subcategoria").hide();
		});

		$("#btnsearchfiltro_modal").click(function(e){
			$("#form_searh_modal").submit();
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



    $("#form_mensaje").submit(function(e){
    	e.preventDefault();
		mensaje_footer();    	
    });

    function mensaje_footer(){
		var NombreMensaje=""+$("#NombreMensaje").val();
		var EmailMensaje=""+$("#EmailMensaje").val();
		var AsuntoMensaje="Mensaje Footer";
		var ObservacionMensaje=""+$("#ObservacionMensaje").val();
		var TipoMensaje="1";


		var formData = new FormData();
      	formData.append('NombreMensaje', NombreMensaje);  
      	formData.append('EmailMensaje', EmailMensaje);  
      	formData.append('AsuntoMensaje', AsuntoMensaje);  
      	formData.append('ObservacionMensaje', ObservacionMensaje);  
      	formData.append('TipoMensaje', TipoMensaje);  
      	formData.append('_token', "{{ csrf_token() }}");
		
		enviar_mensaje_ajax(formData,limpiar_form_footer);


    }


    function enviar_mensaje_ajax(obj_envio,funcion_callback){
    	var request = $.ajax({
          url: "{{url('')}}/enviar_mensaje_generico",
          type: "POST",
          data: obj_envio,
          processData: false,  // tell jQuery not to process the data
          contentType: false  // tell jQuery not to set contentType         
        });

        request.done(function(obj) { 
           if(obj.status=="ok"){
              mensaje_generico("Mensaje Recibido",""+obj.mensaje,"1","Continuar...",function(){

              	funcion_callback();

              });              
              return;
           }else{
              mensaje_generico("Error !",""+obj.mensaje,"2","Continuar...",function(){
              	return;
              });
              return;
           }
        });
         

         //respuesta si falla
        request.fail(function(jqXHR, textStatus) {
          alert( "Error de servidor  " + textStatus );
        });
    }


    function limpiar_form_footer(){
    	$("#NombreMensaje").val("");
		$("#EmailMensaje").val("");
		$("#ObservacionMensaje").val("");
    }



    $("#form-llamado-accion").submit(function(e){
    	e.preventDefault();
    	var email_llamado_accion=$("#email_llamado_accion").val();
    	
    	var formData = new FormData();
    	

    	formData.append('NombreMensaje', "Anónimo");  
    	formData.append('EmailMensaje', email_llamado_accion);        	
      	formData.append('AsuntoMensaje', "Registro Llamado Acción");  
      	formData.append('ObservacionMensaje', "");  
      	formData.append('TipoMensaje', "2");  
      	formData.append('_token', "{{ csrf_token() }}");

    	enviar_mensaje_ajax(formData,limpiar_mensaje);
    });

    function limpiar_mensaje(){
    	$("#email_llamado_accion").val("");
    }


	

	$("#btn-usuario-registro").mouseenter(function(){
		$(".modal-usuario").show();
	}).click(function(e){
		e.preventDefault();
	});

	$(".modal-usuario").mouseleave(function(){
		$(".modal-usuario").hide();
	});


	$("#btn_buscar").click(function(e){
		e.preventDefault();
		if($('.input-buscar').is(':visible')){
			$(".input-buscar").hide().css("width","0px");
			$("#form_searh_modal").hide();
		}else{
			$("#form_searh_modal").show().css("display","inline");
			$(".input-buscar").show().css("width","125px").focus();
			
		}
		
	});


	
	function mensaje_toast(tipo,descripcion,titulo){
		toastr.options = {
				"closeButton": true,
				"debug": false,
				"newestOnTop": true,
				"progressBar": true,
				"positionClass": "toast-top-right",
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


	function fail_generico(jqXHR){
		var arra_mensaje=jqXHR.responseJSON.errors;          
          var mensaje_error="";
          if(arra_mensaje){
            mensaje_error="";
            var llaves_campos=Object.keys(arra_mensaje);

            for(var i=0;i<llaves_campos.length;i++){
                mensaje_error+=" * El campo "+llaves_campos[i]+": ";
                var ar_errores=arra_mensaje[""+llaves_campos[i]];
                for(var j=0;j<ar_errores.length;j++){
                  mensaje_error+=" "+ar_errores[j];
                }
                mensaje_error+="</br>";
            }
          }
          mensaje_generico("Error !",""+mensaje_error,"2","Continuar...",continuar_error);
	}



	</script>

	</body>
	<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-WJDGF3R"
	height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
	<!-- End Google Tag Manager (noscript) -->
</html>
