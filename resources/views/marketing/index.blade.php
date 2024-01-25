<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;
use App\Quotation;
$id_pagina="index";

$curso_controller = new CursoController();
$arra_categoria=$curso_controller->get_categorias(1);
$arra_subcategorias=$curso_controller->get_subcategorias(1);

$arra_cursos = $curso_controller->get_cursos_persona("","","","","","","1","8");

?>

@extends('marketing.plantilla.plantilla')

@section('cabecera')
<style type="text/css">

	body{
		overflow-x: hidden;
	}

	.container-avatar-2{
		background-color: #FDCF79;
	}

	.container-avatar{
		width: 350px;
		height: 350px;
		
		border-radius: 250px;
		position: relative;
	}

	.photo-avatar{
		width: 400px;
		height: 400px;
		background-position: center;
		background-repeat: no-repeat;
		background-size: cover;
		position: absolute;
		left: -5px;
		top: -45px;
		border-radius: 250px;
	}

	.btn-social{
		color: #fff;
		font-size: 25px;
		margin-right: 15px;
	}

	.section-header{
		width: 100%;
		/*background-image: url(/assets-marketing/images/fondo-slide.jpg); */
		background-position: bottom center; 
		background-size:cover; 
		height: auto; 
		padding-bottom: 46px;
    	padding-top: 34px;
	}

	.section-header h2 {
		color: #fff;
		font-weight: 100;
		font-size: 18px;
		margin: 0px;
		padding: 0px;
		margin-bottom: 35px;
		letter-spacing: 5px;
	}

	.section-header h1 {
	    color: #fff;
	    font-weight: 100;
	    font-size: 50px;
	}

	.section-header h1 strong {
	    font-weight: 900;
	}

	.section-header h3 {
	    color: #fff;
	    margin-top: 25px;
	    font-weight: 100;
	    font-size: 25px;
		line-height: 38px;
	}

	.btn-docttus-web{
		margin-top: 25px;
	}

	.cohete{
		position: absolute;
	    width: 128px;
	    bottom: -280px;
	    transform: rotateZ(13deg);
	    right: 125px;
	}

	.contenedor-slide{
		margin-top: 214px; margin-bottom: 85px;
	}

	.card-tutor{
		width: 100%;
		height: 280px;
		background-color: #fff;
		border-radius: 3px;
		text-align: center;
		padding-top: 15px;
		margin-bottom: 15px;
	}

	.contain-foto-tutor{
		width: 200px; 
		height: 200px;		
		display: inline-block;
		background-image: url("{{url('')}}/assets-marketing/images/circle-tutor.png");
		background-size: cover;
		background-position: center;
		text-align: center;
	}

	.foto-tutor{
		width: 180px;
		height: 180px;
		background-color: #3b465a;
		display: inline-block;
		border-radius: 160px;		
    	margin-top: 10px;
	}

	.nombre-tutor{
		font-size: 15px;
		margin-top: 15px;
	}
	.titulo-tutor{
		font-size: 13px;
		color: #8A6D35;
	}


	.seccion-accion{
		padding-top:40px;
	}



	@media only screen and (max-width: 1366px) {
		.contenedor-slide{
			margin-top: 154px; 
			margin-bottom: 65px;
		}

		.section-header h1 {		 
		 
		    font-size: 40px;
		}
	}

	@media only screen and (max-width: 991px) {

		.seccion-accion{
			padding-top: 45px !important;
		}

		.section-header{
			text-align: center;
		}

		#animation_container{
			display: none;
		}
		.cohete{
			display: none;
		}
		.section-header{			
			background-image: url(/assets-marketing/images/fondo-slide.jpg);
		}

		.contain-items-home{
			text-align: center;
			margin-bottom: 25px;
		}

		.contain-items-home h3,.contain-items-home span {
			text-align: left;
		}

		.contain-items-home .col-imagen{
			width: 97px;
		}

		.contain-items-home table{
			width: 281px;
		}

		.contenedor-slide{
			margin-top: 100px; 
			margin-bottom: 65px;
		}

		.seccion-blanca{
			padding-top: 40px;
			padding-bottom: 40px;
			text-align: center;
		}
		h2.subtitulo-principal{
			letter-spacing: 0px;
			font-size: 18px;
		}
		.seccion-gris{
			padding-top: 0px !important;
		}

		.seccion-gris .subtitulo-principal{
			margin-top: 35px;
			text-align: center;
			margin-bottom: 45px;
		}

		.seccion-gris .titulo-principal{
			font-size: 42px;
			text-align: center;
		}

		.seccion-gris h4{
			text-align: center;
		}
		.contenedor-boton-slide{
			text-align: center;
			width: 100%;
		}
	}
</style>
@stop

@section('contenido')   
	
	<!--<section class="section-header">
		<div class="container">
			<div class="row">
				<div class="col-md-8">
					<h2><i class="fa fa-circle icono-subtitulo" aria-hidden="true"></i>ORGANIZACIÓN DE EDUCACIÓN Y FORMACIÓN<i class="icono-subtitulo fa fa-circle" aria-hidden="true"></i></h2>
					<h1>Soluciones <strong>Innovadoras</strong> para el <strong>Éxito.</strong></h1>
					<h3>Ingresa tus datos ahora a nuestra comunidad <strong>Docttus</strong> y recibe 1 curso Gratis</h3>
									
					<div class="container-boton-slide">
						<button class="btn-docttus-web"  data-toggle="modal" data-target="#modal_registro">INGRESA AHORA GRATIS</button>
					</div>	
				</div>

				<div class="col-md-4" style="position: relative;">
					<img src="{{url('')}}/assets-marketing/images/cohete_docttus.png" class="cohete">	
				</div>
			</div>
		</div>
	</section>
	-->

	<section class="section-header">
		


		<div id="hero-banner" style="background-color:#1c1c1c; width:100%; height:800px; position: absolute; top: 0px; left: 0px;">
		</div>

		<!--<div id="animation_container" style="background-color:#1c1c1c; width:100%; height:836px; position: absolute; top: 0px; left: 0px;">
			<canvas id="canvas" width="100%" height="836" style="position: absolute; display: block; background-color:#1c1c1c;"></canvas>
			<div id="dom_overlay_container" style="pointer-events:none; overflow:hidden; width:100%; height:836px; position: absolute; left: 0px; top: 0px; display: block;">
			</div>
		</div>-->




		<div class="container contenedor-slide">
			<div class="row">
				<div class="col-md-8">
					<h2><i class="fa fa-circle icono-subtitulo" aria-hidden="true"></i>¡TRANSFORMA TU FUTURO CON NOSOTROS!<i class="icono-subtitulo fa fa-circle" aria-hidden="true"></i></h2>
					<h1>Se Parte de <strong>Nuestro Club</strong></h1>
					<h3>Únete a nuestra comunidad dinámica, donde el <strong>aprendizaje y apoyo mutuo</strong> transforman sueños en <strong>éxitos</strong>. Red de emprendedores, relaciones estratégicas y oportunidades profesionales.</h3>
									
					<div class="container-boton-slide">
						<button class="btn-docttus-web"  data-toggle="modal" data-target="#modal_registro">Únete al 10 Million Club!</button>
					</div>	
				</div>

				<div class="col-md-4 text-center" style="position: relative;">

					@if(isset($data_afiliado)!=null)
						<div class="container-avatar">
							<div class="photo-avatar" style="background-image: url({{url('')}}/assets//images/usuarios/{{$data_afiliado[0]->FotoPersona}})">
							</div>
						</div>

					
						<h4 style="margin-top: 15px; color:#fff;">{{$data_afiliado[0]->NombrePersona}} {{$data_afiliado[0]->ApellidosPersona}}</h4>

						@if($data_afiliado[0]->InstagramPersona!="")
						<a href="{{$data_afiliado[0]->InstagramPersona}}" class="btn-social">
							<i class="fa fa-instagram" aria-hidden="true"></i>
						</a>
						@endif
						@if($data_afiliado[0]->FacebookPersona!="")
						<a href="{{$data_afiliado[0]->FacebookPersona}}" class="btn-social">
							<i class="fa fa-facebook-square" aria-hidden="true"></i>
						</a>
						@endif

						@if($data_afiliado[0]->YoutubePersona!="")
						<a href="{{$data_afiliado[0]->YoutubePersona}}" class="btn-social">
							<i class="fa fa-youtube-square" aria-hidden="true"></i>
						</a>
						@endif
						

						@if($data_afiliado[0]->WhatsappPersona!="")
						<a href="https://api.whatsapp.com/send?phone={{$data_afiliado[0]->WhatsappPersona}}&text=Hola" class="btn-social">
							<i class="fa fa-whatsapp" aria-hidden="true"></i>
						</a>
						@endif

					@else
					<div class="container-avatar container-avatar-2">
						<div class="photo-avatar" style="background-image: url({{url('')}}/assets//images/usuarios/woman-portada.png)">
						</div>
					</div>
					@endif

				</div>
				
			</div>
		</div>



	</section>




	<section class="seccion-blanca mt-5">
		<div class="container">
			<div class="row">
				<div class="col-md-3 contain-items-home" style="border-right: 1px solid #ccc;">

					<table style="display: inline-block;">
						<tr>
							<td class="col-imagen">
								<img src="{{url('')}}/assets-marketing/images/icon-1.png">
							</td>
							<td style="padding-left: 15px;">
								<h3>+10</h3>
								<span style="padding: 0px; margin: 0px;">Productos Digitales y Financieros</span>
							</td>
						</tr>
					</table>

					
					
					

				</div>


				<div class="col-md-3 contain-items-home" style="border-right: 1px solid #ccc;">

					<table style="display: inline-block;">
						<tr>
							<td  class="col-imagen">
								<img src="{{url('')}}/assets-marketing/images/icon-2.png">
							</td>
							<td style="padding-left: 15px;">
								<h3>+60</h3>
								<span style="padding: 0px; margin: 0px;">Líderes Éxitosos</span>
							</td>
						</tr>
					</table>


					
				</div>


				<div class="col-md-3 contain-items-home" style="border-right: 1px solid #ccc; ">
					
					<table style="display: inline-block;">
						<tr>
							<td  class="col-imagen">
								<img src="{{url('')}}/assets-marketing/images/icon-3.png">
							</td>
							<td style="padding-left: 15px;">
								<h3>+150</h3>
								<span style="padding: 0px; margin: 0px;">Clientes Satisfechos</span>
							</td>
						</tr>
					</table>



				</div>


				<div class="col-md-3 contain-items-home" style="">


					<table style="display: inline-block;">
						<tr>
							<td  class="col-imagen">
								<img src="{{url('')}}/assets-marketing/images/icon-4.png">
							</td>
							<td style="padding-left: 15px;">
								<h3>Aprende</h3>
								<span style="padding: 0px; margin: 0px;">y Gana Dinero</span>
							</td>
						</tr>
					</table>
					
				</div>


			</div>
		</div>
	</section>

	
	
	


	<section class="seccion-gris" style="background-color:  #f3f3f3; width: 100%; padding-top: 80px; padding-bottom: 80px;">
		<div class="container">
			<div class="row">
				<div class="col-md-6">
					<img src="{{url('')}}/assets-marketing/images/elearning.png" style="width: 100%; margin-top: 100px;">
				</div>

				<div class="col-md-6">

					<h2 class="subtitulo-principal">Haz parte del Club</h2>
					<h3 class="titulo-principal" style="margin-top: -20px;"> <span>En</span> 10 Millions Club <span> damos a conocer productos financieros y digitales para la  </span>Nueva Economía.</h3>

					<h4 style="margin-top: 25px;  line-height: 35px;">Nos tomamos en serio nuestra misión de ofrecer a nuestros clientes soluciones completas y personalizadas en sus procesos financieros, emprendimientos y personales. Estos beneficios recibirás si te conviertes en afiliado/a</h4>
					<hr>

					<table style="margin-top: 45px;">
						<tr>
							<td style="line-height: 25px;"><span style="font-size: 42px;color: #FDCF79; margin-right: 12px;">•</span></td>
							<td style="line-height: 25px;font-weight: 500; font-size: 18px;">Ayuda en Casos de Crédito Personal</td>
						</tr>

						<tr>
							<td style="line-height: 25px;"><span style="font-size: 42px;color: #FDCF79; margin-right: 12px;">•</span></td>
							<td style="line-height: 25px;font-weight: 500; font-size: 18px;">Asistencia en Apertura de Compañias</td>
						</tr>

						<tr>
							<td style="line-height: 25px;"><span style="font-size: 42px;color: #FDCF79; margin-right: 12px;">•</span></td>
							<td style="line-height: 25px;font-weight: 500; font-size: 18px;">Desarrollo Personal y Metas.</td>
						</tr>

						<tr>
							<td style="line-height: 25px;"><span style="font-size: 42px;color: #FDCF79; margin-right: 12px;">•</span></td>
							<td style="line-height: 25px;font-weight: 500; font-size: 18px;">Clases de Marketing Digital.</td>
						</tr>

						<tr>
							<td style="line-height: 25px;"><span style="font-size: 42px;color: #FDCF79; margin-right: 12px;">•</span></td>
							<td style="line-height: 25px;font-weight: 500; font-size: 18px;">Entrenamientos en Ventas.</td>
						</tr>

						<tr>
							<td style="line-height: 25px;"><span style="font-size: 42px;color: #FDCF79; margin-right: 12px;">•</span></td>
							<td style="line-height: 25px;font-weight: 500; font-size: 18px;">Comisiona Semanal por Referir Ventas.</td>
						</tr>
					</table>


					<div class="contenedor-boton-slide">
						<button class="btn-docttus-web"  data-toggle="modal" data-target="#modal_registro">HAZ PARTE DEL CLUB AHORA!</button>	
					</div>
					


	

				</div>
			</div>
		</div>
		
	</section>


	<section class="seccion-gris" style=" width: 100%; padding-top: 80px; padding-bottom: 80px; background-color: #fff;" id="producto">
		<div class="container">
			<div class="row py-4">
				<div class="col-md-12">
					<h2 class="subtitulo-principal">Servicios de </h2>
					<h3 class="titulo-principal" style="margin-top: -20px;">Impuestos<span></span></h3>
				</div>
			</div>


			<div class="row">
				<div class="col-md-4">
					<div class="card-products-10m text-center py-2 px-2">
						<img src="{{url('')}}/assets-marketing/images/producto_1.jpg" style="width: 100%; border-radius:9px;">
						<h4 class="mt-3">Curso de Preparación de Impuestos <br /> (Presencial y Virtual)</h4>						
					</div>
				</div>

				<div class="col-md-4">
					<div class="card-products-10m text-center py-2 px-2">
						<img src="{{url('')}}/assets-marketing/images/producto_2.jpg" style="width: 100%; border-radius:9px;">
						<h4 class="mt-5">Software de Taxes</h4>
						
					</div>
				</div>

				<div class="col-md-4">
					<div class="card-products-10m text-center py-2 px-2">
						<img src="{{url('')}}/assets-marketing/images/producto_3.jpg" style="width: 100%; border-radius:9px;">
						<h4 class="mt-5">Preparación de Impuestos</h4>						
					</div>
				</div>
			</div>

		</div>
	</section>


	<section class="seccion-gris" style=" width: 100%; padding-top: 80px; padding-bottom: 80px; background-color: #f3f3f3;">
		<div class="container">
			<div class="row py-4">
				<div class="col-md-12">
					<h2 class="subtitulo-principal">Servicios al </h2>
					<h3 class="titulo-principal" style="margin-top: -20px;">Consumidor<span></span></h3>
				</div>
			</div>

			<div class="row">
				<div class="col-md-4 mb-4">
					<div class="card-products-10m text-center py-2 px-2">
						<img src="{{url('')}}/assets-marketing/images/producto_3.jpg" style="width: 100%; border-radius:9px;">
						<h4 class="mt-5">Paneles Solares</h4>
					</div>
				</div>

				<div class="col-md-4  mb-4">
					<div class="card-products-10m text-center py-2 px-2">
						<img src="{{url('')}}/assets-marketing/images/producto_4.jpg" style="width: 100%; border-radius:9px;">
						<h4 class="mt-5">Software Reparación de Crédito</h4>
						
					</div>
				</div>

				<div class="col-md-4  mb-4">
					<div class="card-products-10m text-center py-2 px-2">
						<img src="{{url('')}}/assets-marketing/images/producto_5.jpg" style="width: 100%; border-radius:9px;">
						<h4 class="mt-5">Cursos de Crédito Personal & Comercial</h4>
					</div>
				</div>


				<div class="col-md-4 mb-4">
					<div class="card-products-10m text-center py-2 px-2">
						<img src="{{url('')}}/assets-marketing/images/producto_6.jpg" style="width: 100%; border-radius:9px;">
						<h4 class="mt-5">Servicios de Abogados Legalshield</h4>
					</div>
				</div>

				<div class="col-md-4  mb-4">
					<div class="card-products-10m text-center py-2 px-2">
						<img src="{{url('')}}/assets-marketing/images/producto_7.jpg" style="width: 100%; border-radius:9px;">
						<h4 class="mt-4">Seguros de Vida <br /> Por Uno De	Nuestros Agentes Licenciado</h4>
						
					</div>
				</div>				
			</div>
		</div>
	</section>


	<section class="seccion-gris" style=" width: 100%; padding-top: 80px; padding-bottom: 80px; background-color: #fff;">
		<div class="container">
			<div class="row py-4">
				<div class="col-md-12">
					<h2 class="subtitulo-principal">Servicios para </h2>
					<h3 class="titulo-principal" style="margin-top: -20px;">Empresas<span></span></h3>
				</div>
			</div>

			<div class="row">
				<div class="col-md-4 mb-4">
					<div class="card-products-10m text-center py-2 px-2">
						<img src="{{url('')}}/assets-marketing/images/producto_9.jpg" style="width: 100%; border-radius:9px;">
						<h4 class="mt-5">Payroll</h4>
					</div>
				</div>

				<div class="col-md-4  mb-4">
					<div class="card-products-10m text-center py-2 px-2">
						<img src="{{url('')}}/assets-marketing/images/producto_10.jpg" style="width: 100%; border-radius:9px;">
						<h4 class="mt-5">Diseño de Website Básica</h4>
						
					</div>
				</div>

				<div class="col-md-4  mb-4">
					<div class="card-products-10m text-center py-2 px-2">
						<img src="{{url('')}}/assets-marketing/images/producto_11.jpg" style="width: 100%; border-radius:9px;">
						<h4 class="mt-5">Curso de Bookkeeping</h4>
					</div>
				</div>


				<div class="col-md-4 mb-4">
					<div class="card-products-10m text-center py-2 px-2">
						<img src="{{url('')}}/assets-marketing/images/producto_12.jpg" style="width: 100%; border-radius:9px;">
						<h4 class="mt-5">Apertura de Empresas</h4>
					</div>
				</div>
				
			</div>
		</div>
	</section>



	



	<section class="seccion-gris" style="background-color:#f3f3f3;padding-top:40px; padding-bottom: 40px; ">
		<div class="container">
			<div class="row">
				<div class="col-md-10">					
					<h2 class="subtitulo-principal">10 Millions Club</h2>
					<h3 class="titulo-principal" style="margin-top: -20px;">Líderes<span></span></h3>
				</div>

				<div class="col-md-2">
					
				</div>
			</div>

			<div class="row" style="margin-top: 35px;">
				<div class="col-md-3">
					<a href="{{url('')}}/leader/elizabethbeitia">
						<div class="card-tutor">
							<div class="contain-foto-tutor">
								<div class="foto-tutor" style="background-image:url('{{url('')}}/assets-marketing/images/tutor-1.jpg'); background-size: cover; background-position: center;">
									
								</div>
							</div>

							<h4 class="nombre-tutor">Elizabeth Beitia</h4>
							<h5 class="titulo-tutor">Diamond Member</h5>
						</div>
					</a>
				</div>


				<div class="col-md-3">
					<a href="{{url('')}}/leader/luciamartinez">
						<div class="card-tutor">
							<div class="contain-foto-tutor">
								<div class="foto-tutor" style="background-image:url('{{url('')}}/assets-marketing/images/tutor-2.png'); background-size: cover; background-position: center;">
									
								</div>
							</div>

							<h4 class="nombre-tutor">Lucía Martinez</h4>
							<h5 class="titulo-tutor">Diamond Member</h5>
						</div>
					</a>
				</div>

				<div class="col-md-3">
					<a href="{{url('')}}/leader/jacquelineflores">
						<div class="card-tutor">
							<div class="contain-foto-tutor">
								<div class="foto-tutor" style="background-image:url('{{url('')}}/assets-marketing/images/tutor-3.jpg'); background-size: cover; background-position: center;">
									
								</div>
							</div>

							<h4 class="nombre-tutor">Jacqueline Flores</h4>
							<h5 class="titulo-tutor">Emerald Member</h5>
						</div>
					</a>
				</div>




				<div class="col-md-3">
					<a href="{{url('')}}/leader/kellyrivera">
						<div class="card-tutor">
							<div class="contain-foto-tutor">
								<div class="foto-tutor" style="background-image:url('{{url('')}}/assets-marketing/images/tutor-4.jpg'); background-size: cover; background-position: center;">
									
								</div>
							</div>

							<h4 class="nombre-tutor">Kelly Rivera</h4>
							<h5 class="titulo-tutor">Emerald Member</h5>
						</div>
					</a>
				</div>

			</div>
		</div>
	</section>


	
	<!-- Modal -->
	<div class="modal fade" id="modal-curso" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"  style="z-index: 9999999999;">
	  <div class="modal-dialog modal-lg  modal-dialog-centered" role="document">
	    <div class="modal-content">	      
	      <div class="modal-body">

	      	<a href="#" class="btn-cerrar-popup"  data-dismiss="modal" ><i class="fa fa-times" aria-hidden="true"></i></a>

	        <div class="row">
	        	<div class="col-md-12">
	        		<div class="embed-responsive embed-responsive-16by9" id="video_curso_modal">
					  
					</div>
	        	</div>
	        </div>

	        <div class="row" style="margin-top: 25px;">
	        	<div class="col-md-7 contenido-ficha-curso-modal">
	        		<h3 id="mod_titulo_curso"></h3>
	        		<small>Por: </small><span id="nombre_tutor"></span><br />
	        		<small style="background-color: #17cfd23b;      padding: 2px 10px; border-radius: 11px; margin-top: 5px; display: inline-block; color: #0b5586;"><strong id="nombre_subcategoria"></strong></small>

	        		<p style="    font-size: 12px; text-align: justify; line-height: 16px; margin-top: 15px;" id="descripcion_curso"></p>
	        		<a href="#" class="btn btn-sm btn-success" id="btn_ver_mas_curso" style="color: #fff !important; background-color: #17cfd2; border-color: #17d2cf;    border-radius: 25px !important; height: 29px;">
	        			Más Información
	        		</a>
	        	</div>

	        	<div class="col-md-5  contenido-ficha-curso-modal">
	        		<a href="#" id="btn_checkout" class="btn btn-info btn-lg" style="width: 100%;"><i class="fa fa-shopping-cart" aria-hidden="true"></i> COMPRAR USD $<span id="valor_modal_curso"></span> </a>
 					<small id="contenedor_descuento_modal" style="background-color: #17cfd23b;      padding: 2px 10px; border-radius: 11px; margin-top: 5px; display: inline-block;"><span id="modal_descuento_curso"></span>% Dto. US <strong id="modal_precio_anterior" style="text-decoration: line-through;"> $2.000 </strong></small>

					<br/><br/>

					<i class="fa fa-users" aria-hidden="true"></i> <small> <span id="modal_cantidad_estudiantes"></span> Estudiantes</small><br/>
					<i class="fa fa-file" aria-hidden="true"></i> <small> <span id="modal_cantidad_lecciones"></span> Lecciones</small><br/>
					<i class="fa fa-clock-o" aria-hidden="true"></i> <small> <span id="modal_cantidad_horas"></span> Horas de Estudio</small><br/>
					<i class="fa fa-language" aria-hidden="true"></i> <small> Idioma Español</small><br/>
					<i class="fa fa-star" aria-hidden="true"></i> <small> <span id="modal_cantidad_resenas"></span> Reseñas (Ver)</small>


	        	</div>
	        </div>
	      </div>	     
	    </div>
	  </div>
	</div>




	<div class="modal fade" id="modal_registro" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
		  <div class="modal-content" style=" border-radius: 9px;">	      
			  
			  <!--<button type="button" class="close" data-dismiss="modal" aria-label="Close" style="position: absolute; right:10px; top:1px; z-index:999999999;">
				  <span aria-hidden="true" style=" font-size:34px;">&times;</span>
				</button>-->
				<a href="#" class="btn-cerrar-popup"  data-dismiss="modal" ><i class="fa fa-times" aria-hidden="true"></i></a>
			  
			<div class="modal-body" style="padding-top: 25px;">
					<div class="row">
  
						<div class="col-md-12">
							<h2 style=" font-size: 40px; text-align: center; font-weight: 300; margin-bottom: 20px;">Regístrate Ahora, y recibe un Curso Finanzas y Marketing Digital Totalmente <strong>Gratis</strong></h2>
						</div>
  
						<hr>  
					 
  
						<div class="col-md-12">
								<small style="text-align: center; width: 100%;     display: inline-block; font-style: italic;">
									  Ingresa ahora a 10MillionsClub para que empieces tu proceso de capacitación y líderazgo con nosotros, y recibirás grandes entrenamientos y seguimiento paso a paso para que empieces con el pie derecho tu proceso de ser líder en el campo financiero.
								  </small>
								  
							<div class="row">
								<div class="col-3">
								</div>
								<div class="col-6">
									<form id="frm_registro" style="margin-top: 15px;">
										
										 <input type="usuario" name="" class="form-control" placeholder="Usuario 10 Millions Club" id="txtusuario_modal" required style="border:1px solid #ccc;">
										 <input type="email" name="" class="form-control" placeholder="Email" id="txtemail_modal" required style="border:1px solid #ccc;">
										 <input type="password" name="" class="form-control" placeholder="Password" id="txtpassword_modal" required style="border:1px solid #ccc;">
										  <small style=" text-align: center; width: 100%;     display: inline-block; font-style: italic;">
											  Al registrarte aceptas nuestros <a href="{{url('')}}/politicas-de-privacidad" target="_blank">Términos y Políticas de Privacidad</a>
										  </small>
										<center>
		
											<br/>
											<div class="g-recaptcha" data-sitekey="6LfJwFoaAAAAAPiljxPQbH_MscIMe4rmLyC7y3zs"></div>
											<br/>
		
											<button type="submit" class="btn-docttus-web-sm" style="margin-top: 0px; margin-bottom: 25px; width:100%;">REGISTRARSE</button>
										</center>
		  
									</form>
								</div>
								<div class="col-3">
								</div>
							</div>
  
						</div>
  
  
					</div>
				  
			</div>	      
		  </div>
		</div>
	  </div>





@stop

@section('scripts')

<script src="https://code.createjs.com/1.0.0/createjs.min.js"></script>
<script src="cohetes.js?1596119932642"></script>


<script>
var canvas, stage, exportRoot, anim_container, dom_overlay_container, fnStartAnimation;
$(function(){
	init();
});
function init() {
	canvas = document.getElementById("canvas");
	anim_container = document.getElementById("animation_container");
	dom_overlay_container = document.getElementById("dom_overlay_container");
	var comp=AdobeAn.getComposition("609A70AC72B00246A57CDB701459576B");
	var lib=comp.getLibrary();
	var loader = new createjs.LoadQueue(false);
	loader.addEventListener("fileload", function(evt){handleFileLoad(evt,comp)});
	loader.addEventListener("complete", function(evt){handleComplete(evt,comp)});
	var lib=comp.getLibrary();
	loader.loadManifest(lib.properties.manifest);
}
function handleFileLoad(evt, comp) {
	var images=comp.getImages();	
	if (evt && (evt.item.type == "image")) { images[evt.item.id] = evt.result; }	
}
function handleComplete(evt,comp) {
	//This function is always called, irrespective of the content. You can use the variable "stage" after it is created in token create_stage.
	var lib=comp.getLibrary();
	var ss=comp.getSpriteSheet();
	var queue = evt.target;
	var ssMetadata = lib.ssMetadata;
	for(i=0; i<ssMetadata.length; i++) {
		ss[ssMetadata[i].name] = new createjs.SpriteSheet( {"images": [queue.getResult(ssMetadata[i].name)], "frames": ssMetadata[i].frames} )
	}
	exportRoot = new lib.cohetes();
	stage = new lib.Stage(canvas);	
	//Registers the "tick" event listener.
	fnStartAnimation = function() {
		stage.addChild(exportRoot);
		createjs.Ticker.framerate = lib.properties.fps;
		createjs.Ticker.addEventListener("tick", stage);
	}	    
	//Code to support hidpi screens and responsive scaling.
	AdobeAn.makeResponsive(true,'width',true,1,[canvas,anim_container,dom_overlay_container]);	
	AdobeAn.compositionLoaded(lib.properties.id);
	fnStartAnimation();
}
</script>




<script type="text/javascript">

	var subcategoria_sel="";
	var categoria_sel="";
	var arra_cursos_fil=new Object();

	var arra_cursos=new Object();

	

	
	
	


	arra_cursos=[

		@foreach($arra_cursos as $curso)
			{

				<?php
				$curso->DescripcionTutor = trim(preg_replace('/\s\s+/', ' ', $curso->DescripcionTutor));
				$curso->DescripcionCurso = trim(preg_replace('/\s\s+/', ' ', $curso->DescripcionCurso));

				if(strlen($curso->DescripcionCurso)>=350){
					$curso->DescripcionCurso=substr($curso->DescripcionCurso,0,350)."...";
				}

				$valor_anterior=$curso->PrecioCurso;
				$valor_curso_actual=$curso->PrecioCurso;
				$descuento_curso=$curso->DescuentoCurso;
				$porcentaje_curso=0;

				
				$valor_curso_actual=$valor_curso_actual-($valor_curso_actual*($descuento_curso/100));
				$porcentaje_curso=$descuento_curso;

				if(!$descuento_curso){
					$valor_anterior=0;
				}

				if($curso->ValorImpuesto){
					$valor_curso_actual=$valor_curso_actual+($valor_curso_actual*($curso->ValorImpuesto/100));
					$valor_anterior=$valor_anterior+($valor_anterior*($curso->ValorImpuesto/100));
				}

				$valor_curso_actual=number_format($valor_curso_actual, 2);


				$arra_reviews=$curso->reviews;
				$cant_reviews=count($arra_reviews);
				
				?>

				"IdCurso":"{{$curso->IdCurso}}",
				"NombreCurso":`{{$curso->NombreCurso}}`,
				"DescripcionCurso":`{!!strip_tags($curso->DescripcionCurso)!!}`,
				"SlugCurso":"{{$curso->SlugCurso}}",
				"IdEstado":"{{$curso->IdEstado}}",
				"IdTipoCurso":"{{$curso->IdTipoCurso}}",
				"FechaCreacion":"{{$curso->FechaCreacion}}",
				"FechaModificacion":"{{$curso->FechaModificacion}}",
				"TituloCurso":"{{$curso->TituloCurso}}",
				"ImagenCurso":"{{$curso->ImagenCurso}}",
				"CodigoCurso":"{{$curso->CodigoCurso}}",
				"NombreTutor":"{{$curso->NombreTutor}}",
				"cantidad_estudiantes":"{{$curso->cantidad_estudiantes}}",
				"DescripcionTutor":`{!!strip_tags($curso->DescripcionTutor)!!}`,
				"FotoTutor":`{{$curso->FotoTutor}}`,
				"VideoCurso":`{!!$curso->VideoCursoEmbed!!}`,
				"TipoVideo":`{!!$curso->TipoVideo!!}`,
				"AprenderasCurso":"{{$curso->AprenderasCurso}}",
				"TestimoniosCurso":"{{$curso->TestimoniosCurso}}",
				"IdSubcategoria":"{{$curso->IdSubcategoria}}",
				"IdDestacado":"{{$curso->IdDestacado}}",
				"NombreSubcategoria":"{{$curso->NombreSubcategoria}}",
				"cantidad_modulos":"{{$curso->cantidad_modulos}}",
				"cantidad_lecciones":"{{$curso->cantidad_lecciones}}",
				"cantidad_horas":"{{$curso->cantidad_horas}}",
				"ValorPrecioProducto":"{{$valor_curso_actual}}",
				"DescuentoCurso":"{{$descuento_curso}}",
				"ValorPrecioAnterior":"{{$valor_anterior}}",
				"cant_reviews":"{{$cant_reviews}}",
				"PrecioCurso":"{{$curso->PrecioCurso}}",
				
			},
		@endforeach

	];

	function filtro_curso(){
		
		
	}

	$(".trigger_modal").click(function(e){		
		e.preventDefault();
		var elemento_curso_sel=e.currentTarget;
		var codigo_elemento_sel=$(elemento_curso_sel).attr("code_curso");		
		abrir_modal_curso(codigo_elemento_sel);
	});

	var cant_clicl=0;
	function abrir_modal_curso(id_curso){

		var index_curso=get_index_curso(id_curso);
		if(index_curso>-1){
			$("#mod_titulo_curso").html(""+arra_cursos[index_curso].NombreCurso);	
			$("#nombre_tutor").html(""+arra_cursos[index_curso].NombreTutor);	
			$("#nombre_subcategoria").html(""+arra_cursos[index_curso].NombreSubcategoria);
			$("#descripcion_curso").html(""+arra_cursos[index_curso].DescripcionCurso);
			$("#btn_ver_mas_curso").attr("href","{{url('')}}/c/"+arra_cursos[index_curso].SlugCurso);

			cant_clicl++;

			var embed_video=arra_cursos[index_curso].VideoCurso;
			embed_video=embed_video.replace("player_video","player_video_"+arra_cursos[index_curso].IdCurso+"_"+cant_clicl);

			$("#video_curso_modal").html(""+embed_video);
			
			if(arra_cursos[index_curso].TipoVideo=="1"){
				var player = videojs("player_video_"+arra_cursos[index_curso].IdCurso+"_"+cant_clicl);
			}
			

			$("#valor_modal_curso").html(""+arra_cursos[index_curso].ValorPrecioProducto);			
			$("#modal_descuento_curso").html(""+arra_cursos[index_curso].DescuentoCurso);
			$("#modal_precio_anterior").html(""+arra_cursos[index_curso].ValorPrecioAnterior);			
			$("#modal_cantidad_estudiantes").html(""+arra_cursos[index_curso].cantidad_estudiantes);
			$("#modal_cantidad_lecciones").html(""+arra_cursos[index_curso].cantidad_lecciones);
			$("#modal_cantidad_horas").html(""+arra_cursos[index_curso].cantidad_horas);
			$("#modal_cantidad_resenas").html(""+arra_cursos[index_curso].cant_reviews);

			

			$("#btn_checkout").attr("href","{{url('')}}/c/"+arra_cursos[index_curso].SlugCurso);

			if(parseInt(arra_cursos[index_curso].DescuentoCurso)!=0){
				$("#contenedor_descuento_modal").show();
			}else{
				$("#contenedor_descuento_modal").hide();
			}

		}
		$("#modal-curso").modal("show");
	}

	function get_index_curso(id_curso){
		for(var i=0;i<arra_cursos.length;i++){
			if(arra_cursos[i].IdCurso==id_curso){
				return i;
			}
		}
		return -1;
	}

	//CERRAR MODAL -  EVENTO
	$('#modal-curso').on('hidden.bs.modal', function (e) {	  
	  $("#video_curso_modal").html("");	  
	});



      $("#btn_olvidaste_password").click(function(e){        
        e.preventDefault();
        $("#form_login_olvido").show();
        $("#form_login").hide();
      });

      $("#btn_regresar").click(function(e){        
        e.preventDefault();
        $("#form_login_olvido").hide();
        $("#form_login").show();
      });


      $("#frm_registro").submit(function(e){
        e.preventDefault();
        verificar_login();         
      });

      var myVar;
      var contador_login=5;

      function verificar_login(){
        var txtusuario=$("#txtusuario_modal").val();        
        var txtemail=$("#txtemail_modal").val();
        var txtpassword=$("#txtpassword_modal").val();       
		var captcha=$("#g-recaptcha-response").val(); 

		if(captcha==""){
			mensaje_generico("Error !","Debes verificar el Re-Captcha","2","Continuar...",continuar_error);
			return;
		}

        var txtrolestudiante="";
        var txtrolafiliado="";        
        txtrolestudiante="1";                
        $IdUsuarioPadre="";//acá va el uso de cockies
        var request = $.ajax({
          url: "{{url('')}}/registrar_usuario",
          type: "POST",
          data:{               
			  usuario:txtusuario,              
              email:txtemail,
              password:txtpassword,              
              rol_registro:"1",
              IdUsuarioPadre:"",                  
			  captcha:""+captcha,
              _token: "{{ csrf_token() }}"
          }
        });

        request.done(function(obj) { 
           if(obj.status=="ok"){
              mensaje_generico("Bienvenido "+txtusuario+" !","Has ingresado correctamente","1","<span id='contador_boton'>5 </span> Continuar...",continuar_login);
              myVar = setInterval(myTimer, 1000);              
              return;
           }else{
              mensaje_generico("Error !",""+obj.mensaje,"2","Continuar...",continuar_error);
              return;
           }
        });
         

         //respuesta si falla
        request.fail(function(jqXHR, textStatus) {
          alert( "Error de servidor  " + textStatus );
        });
      }

      


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

      function continuar_login(){
         console.log("siguiente");
         window.open("{{url('')}}/backoffice","_parent");
      }

      function continuar_error(){

      }



      

      function myTimer() {
         contador_login--;
         $("#contador_boton").html(""+contador_login);
         if(contador_login==0){
            myStopFunction();
         }        
      }

      function myStopFunction() {
        clearInterval(myVar);
        window.open("backoffice","_parent");
      }



	  function enviar_email(){        
        var request = $.ajax({
          url: "{{url('')}}/enviar_mensaje_prueba",
          type: "POST",
          data:{               			     
              _token: "{{ csrf_token() }}"
          }
        });

        request.done(function(obj) { 
           
        });        

         //respuesta si falla
        request.fail(function(jqXHR, textStatus) {
          alert( "Error de servidor  " + textStatus );
        });
      }



    </script>

@stop



