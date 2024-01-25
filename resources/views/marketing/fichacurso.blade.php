<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;
use App\Quotation;
$id_pagina="cursos";



$curso->DescripcionTutor = trim(preg_replace('/\s\s+/', ' ', $curso->DescripcionTutor));
$curso->DescripcionCurso = trim(preg_replace('/\s\s+/', ' ', $curso->DescripcionCurso));

if(strlen($curso->DescripcionCurso)>=350){
	//$curso->DescripcionCurso=substr($curso->DescripcionCurso,0,350)."...";
}



$valor_anterior=$curso->ValorPrecioProducto;
$valor_curso_actual=$curso->ValorPrecioProducto;
$descuento_curso=$curso->DescuentoCurso;
$porcentaje_curso=0;

if($descuento_curso){
	
	$valor_curso_actual=$valor_curso_actual-($valor_curso_actual*($descuento_curso/100));
	$porcentaje_curso=$descuento_curso;

}
/*
if($curso->ValorImpuesto){
	$valor_curso_actual=$valor_curso_actual+($valor_curso_actual*($curso->ValorImpuesto/100));

	$valor_anterior=$valor_anterior+($valor_anterior*($curso->ValorImpuesto/100));

}*/

$valor_curso_actual=number_format($valor_curso_actual, 2);

$arra_reviews=$curso->reviews;
$cant_reviews=count($arra_reviews);
$promedio_reviews_curso=0;
$suma_valor_reviews=0;

$cantidad_reviews_5=0;
$cantidad_reviews_4=0;
$cantidad_reviews_3=0;
$cantidad_reviews_2=0;
$cantidad_reviews_1=0;


if($cant_reviews>0){
	for($r=0;$r<$cant_reviews;$r++){				
		
		$suma_valor_reviews+=$arra_reviews[$r]->ValorCalificacion;

		if($arra_reviews[$r]->ValorCalificacion==5){
			$cantidad_reviews_5++;
		}

		if($arra_reviews[$r]->ValorCalificacion>=4 && $arra_reviews[$r]->ValorCalificacion<5){
			$cantidad_reviews_4++;
		}

		if($arra_reviews[$r]->ValorCalificacion>=3 && $arra_reviews[$r]->ValorCalificacion<4){
			$cantidad_reviews_3++;
		}

		if($arra_reviews[$r]->ValorCalificacion>=2 && $arra_reviews[$r]->ValorCalificacion<3){
			$cantidad_reviews_2++;
		}

		if($arra_reviews[$r]->ValorCalificacion>=0 && $arra_reviews[$r]->ValorCalificacion<2){
			$cantidad_reviews_1++;
		}

	}
	$promedio_reviews_curso=$suma_valor_reviews/$cant_reviews;	
}				

$porcentaje_reviews_5=0;
$porcentaje_reviews_4=0;
$porcentaje_reviews_3=0;
$porcentaje_reviews_2=0;
$porcentaje_reviews_1=0;

if($cant_reviews>0){
	$porcentaje_reviews_5=($cantidad_reviews_5*100)/$cant_reviews;
	$porcentaje_reviews_4=($cantidad_reviews_4*100)/$cant_reviews;
	$porcentaje_reviews_3=($cantidad_reviews_3*100)/$cant_reviews;
	$porcentaje_reviews_2=($cantidad_reviews_2*100)/$cant_reviews;
	$porcentaje_reviews_1=($cantidad_reviews_1*100)/$cant_reviews;

	$porcentaje_reviews_5=round($porcentaje_reviews_5,0);
	$porcentaje_reviews_4=round($porcentaje_reviews_4,0);
	$porcentaje_reviews_3=round($porcentaje_reviews_3,0);
	$porcentaje_reviews_2=round($porcentaje_reviews_2,0);
	$porcentaje_reviews_1=round($porcentaje_reviews_1,0);	
}




$controller = new AdminController();
$arra_data_usuario=$controller->VerificarSesid();

$arra_deseos=array();

if(count($arra_data_usuario)>0){	
	$arra_deseos=$controller->get_deseos($curso->IdCurso);	
}

$contador_modulos=0;

?>

@extends('marketing.plantilla.plantilla')
@section('contenido')   

<style type="text/css">
	.contact-warp p {
	    padding-top: 10px;
	    margin-bottom: 10px;
	}
	.foto-tutor{
		background-image: url("{{url('')}}/assets/images/usuarios/{{$curso->FotoPersona}}"); 
		background-size:cover; 
		background-position:center; 
		background-repeat:no-repeat; 
		border-radius:150px;
		width: 100px; height:100px;
		
	}

	.foto-tutor-small{
		background-image: url("{{url('')}}/assets/images/usuarios/{{$curso->FotoPersona}}"); 
		background-size:cover; 
		background-position:center; 
		background-repeat:no-repeat; 
		border-radius:150px;
		width: 48px; height:48px;
		display: inline-block;
		float: left;
	}


	.contenido_descripcion{
		font-size: 18px;		
		color:#737373 !important;
	}
	.contenido_descripcion p{
		font-size: 18px;		
		color:#737373 !important;
	}

	.contenido_descripcion li{
		font-size: 18px;		
		color:#737373 !important;
	}

	.barra-ficha-curso{
		width: 100%;
		background-color: #fff;
		border-radius: 4px;
		box-shadow: 0px 2px 3px #ccc;
		padding:5px;		
		margin-bottom: 25px;
	}

	.barra-inferior-comprar{
		width: 100%; 
		background-color:#fff; 
		bottom:0px; 
		position:fixed; 
		z-index:99999; 
		padding:5px;     
		box-shadow: 0px 0px 8px #888;
	}
</style>
<script src="https://unpkg.com/wavesurfer.js"></script>

<!-- Hero section -->
	<section class="hero-section">
		<div class="hero-slider owl-carousel">			
			<div class="hs-item" style="padding-top:38px; padding-bottom: 80px; height: auto !important; background-position: top center; ">
				<div class="container">
					<div class="row">
						<div class="col-lg-12" style="text-align: center;">	
						</div>						
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- Hero section end -->

<!-- Blog section -->
	<section class="blog-section" style="padding: 15px 0px;">
		<div class="container">
			<div class="row">
				<div class="col-md-12 bread-crumb">
					<span>{{$curso->NombreCategoria}}  </span>&gt;<a href="{{url('')}}/categoria/{{$curso->SlugSubcategoria}}" style="color: #000;"> <span>{{$curso->NombreSubcategoria}}</span> &gt; </a> {{$curso->NombreCurso}} </span>
				</div>
			</div>			
			
		</div>
	</section>
	<!-- Blog section end -->

	<section class="cabecera-curso" style="background-image: url({{url('')}}/assets/images/cursos/header-bg.jpg); background-size:cover; background-position: center;">
		<div class="contenedor-cabecera" style="padding-top: 55px; padding-bottom: 55px; background-color: #96783c8f;">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<h1 class="titulo-curso" style="font-size: 40px;color: #fff;">{{$curso->NombreCurso}}</h1>
						<h2 class="subtitulo-curso" style="font-size: 22px; font-weight: 400; color: #fff; margin-top: 15px; line-height: 30px;">{{$curso->DescripcionCortaCurso}}</h2>

						<div class="contenedor-estrellas-curso" style="color: #fff;">
							@if($cant_reviews)
							<?php
								for($e=1;$e<=5;$e++){
									if($promedio_reviews_curso>=$e){
										echo('<i class="fa fa-star estrella" aria-hidden="true"  style="color: #F4C14E;"></i>');
									}else{
										echo('<i class="fa fa-star-o estrella" aria-hidden="true"  style="color: #F4C14E;"></i>');
									}
								}

							?>
							@endif


							
							<p style="    color: #fff;  font-size: 16px;  font-weight: 400;  margin-bottom: 0px;  margin-top: 0px; display: inline-block;">
								@if($cant_reviews)
								<span>{{round($promedio_reviews_curso,1)}} </span>
								<span>({{$cant_reviews}} Valoraciones) </span>								
								@endif
							</p>
							
							<p style="    color: #fff;  font-size: 16px;  font-weight: 400;  margin-bottom: 0px;  margin-top: 0px;">
								Creado por: {{$curso->NombreTutor}}
							</p>

							<p style="    color: #fff;  font-size: 18px;  font-weight: 400;  margin-bottom: 0px;  margin-top: 0px;">
								<i class="fa fa-comment" aria-hidden="true"></i> Español
							</p>
						</div>
						

					</div>

					<!-- Listado de deseos -->
					<div class="col-md-12" style="position: relative;">
						
						@if(count($arra_data_usuario)>0)							
								
							<a href="#" id="btn_deseos" class="btn-funcion-ficha" style="color: #fff; font-size: 18px;">
								@if(count($arra_deseos)>0)
									@if($arra_deseos[0]->IdEstado=="1")
										<i class="fa fa-heart" aria-hidden="true" style="color:red;"></i> 
									@else
										<i class="fa fa-heart" aria-hidden="true" style="color:white;"></i> 
									@endif
								@else
									<i class="fa fa-heart" aria-hidden="true" style="color:white;"></i> 
								@endif
								Lista de Deseos
							</a>
								
							
						@endif

					</div>
				</div>
			</div>
		</div>
		
	</section>


	<section class="barra-inferior-comprar">
		<div class="container">
			<div class="row">
				<div class="col-md-12">

					<div class="barra-ficha-curso-flotante">
						<div class="row">
							
							<div class="col-md-7 d-none d-md-block" style="border-right: 1px solid #e9e9e9;">
								
								
								<ul class="nav nav-tabs" id="tab-ficha-curso" role="tablist" style="    background-color: #dadada;" >
									<li class="nav-item" style="width: 25%; text-align: center;     background-color: #dadada;">
									  <a class="nav-link active home-tab" style="color: #000;" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true"><i class="fa fa-book" aria-hidden="true"></i>	Resumen</a>
									</li>
									<li class="nav-item" style="width: 25%; text-align: center;     background-color: #dadada;">
									  <a class="nav-link profile-tab" id="profile-tab"  style="color: #000;" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false"><i class="fa fa-list" aria-hidden="true"></i>	Lecciones</a>
									</li>
									<li class="nav-item"  style="width: 25%; text-align: center;     background-color: #dadada;">
									  <a class="nav-link contact-tab"  style="color: #000;" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false"><i class="fa fa-comments" aria-hidden="true"></i> Reseñas</a>
									</li>								
		  
									<li class="nav-item"  style="width: 25%; text-align: center;     background-color: #dadada;">
									  <a class="nav-link tutor-tab"  style="color: #000;" id="tutor-tab" data-toggle="tab" href="#tutor" role="tab" aria-controls="contact" aria-selected="false"><i class="fa fa-user" aria-hidden="true"></i> Tutor</a>
									</li>
								  </ul>

								

							</div>							
							

							<div class="col-md-3 col-xs-12  text-lg-right text-center">
								
								@if($porcentaje_curso)
								<h4 style=" margin-top: 0px;     color: #9e9e9e; text-decoration: line-through;  font-weight: 400;    font-size: 16px;   margin-bottom: 0px;"> US $ {{$valor_anterior}} </h4>
								@endif
								<h3 style="margin-top: 0px;">US $ {{$valor_curso_actual}}</h3>

							</div>

							<div class="col-md-2 col-sm-6 col-xs-12 text-right">
								@if($valor_anterior!=0 && $curso->AplicaGratisCurso=="0")
								<a  href="{{$url_hotmart}}" class="btn-docttus-web" style=" width:100%; display: inline-block; text-align:center;"><i class="fa fa-shopping-cart" aria-hidden="true"></i> COMPRAR </a>
								@else
								<a  href="{{url('')}}/checkout/{{$curso->SlugCurso}}/{{$codigo_usuario}}" class="btn-docttus-web" style=" width:100%; display: inline-block; text-align:center;"><i class="fa fa-shopping-cart" aria-hidden="true"></i> COMPRAR </a>
								@endif


							</div>

						</div>
					</div>

				</div>
			</div>
		</div>
	</section>

	<section class="seccion-blanca-ficha-curso" style=" width: 100%; padding-top: 30px; padding-bottom: 80px; background-color: #fafafa;">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					
					<div class="barra-ficha-curso">
						<div class="row">
							
							<div class="col-md-2 col-sm-6 d-none d-md-block" style="border-right: 1px solid #e9e9e9;">
								
								<div class="foto-tutor-small"></div>
								<h4 style="font-size: 15px; color: #a0a0a0;	margin-left: 12px;	display: inline-block;  font-weight:400;">Creado por</h4><br/>
								<h4 style="font-size: 18px; margin-left: 12px;	display: inline-block;  overflow: hidden; white-space: nowrap;	text-overflow: ellipsis; max-width: 103px;">{{$curso->NombreTutor}}</h4>
								

							</div>

							<div class="col-md-2 d-none d-lg-block"  style="border-right: 1px solid #e9e9e9;">
								<h4 style="font-size: 15px; color: #a0a0a0;	margin-left: 5px;	display: inline-block; font-weight:400;">Categoría</h4><br/>
								<h4 style="font-size: 18px; margin-left: 5px;	display: inline-block;  overflow: hidden; white-space: nowrap;	text-overflow: ellipsis; max-width: 103px;">{{$curso->NombreSubcategoria}}</h4>
							</div>
							
							<div class="col  d-none d-lg-block">
								<h4 style="font-size: 15px; color: #a0a0a0;	margin-left: 5px; display: inline-block; font-weight:400;">Comentarios</h4><br/>
								<span style="margin-left: 5px; display: inline-block;">
								@if($cant_reviews)
								<?php
									for($e=1;$e<=5;$e++){
										if($promedio_reviews_curso>=$e){
											echo('<i class="fa fa-star estrella" aria-hidden="true"  style="color: #F4C14E;"></i>');
										}else{
											echo('<i class="fa fa-star-o estrella" aria-hidden="true"  style="color: #F4C14E;"></i>');
										}
									}

								?>
								@endif
								</span>


								
								<p style="    font-size: 16px;  font-weight: 400;  margin-bottom: 0px;  margin-top: 0px; display: inline-block;">
									@if($cant_reviews)
									<span>{{round($promedio_reviews_curso,1)}} </span>
									<span>({{$cant_reviews}} Reviews) </span>								
									@endif
								</p>
							</div>

							<div class="col-md-3 col-xs-12  text-lg-right text-center">
								
								@if($porcentaje_curso)
								<h4 style=" margin-top: 0px;     color: #9e9e9e; text-decoration: line-through;  font-weight: 400;    font-size: 16px;   margin-bottom: 0px;"> US $ {{$valor_anterior}} </h4>
								@endif
								<h3 style="margin-top: 0px;">US $ {{$valor_curso_actual}}</h3>

							</div>

							<div class="col-md-2 col-sm-6 col-xs-12 text-right">
								@if($valor_anterior!=0 && $curso->AplicaGratisCurso=="0")
								<a  href="{{$url_hotmart}}" class="btn-docttus-web" style=" width:100%; display: inline-block; text-align:center;"><i class="fa fa-shopping-cart" aria-hidden="true"></i> COMPRAR </a>
								@else
								<a  href="{{url('')}}/checkout/{{$curso->SlugCurso}}/{{$codigo_usuario}}" class="btn-docttus-web" style=" width:100%; display: inline-block; text-align:center;"><i class="fa fa-shopping-cart" aria-hidden="true"></i> COMPRAR </a>
								@endif
							</div>

						</div>
					</div>


					@if($curso->VideoCursoEmbed)
					<div class="embed-responsive embed-responsive-16by9">
					  	{!!$curso->VideoCursoEmbed!!}
					</div>
					@endif

					





					
					<div class="ficha-contenido-curso" style="width: 100%; margin-top: 25px;">
						
						<ul class="nav nav-tabs" id="tab-ficha-curso" role="tablist" style="    background-color: #dadada;" >
						  <li class="nav-item" style="width: 25%; text-align: center;     background-color: #dadada;">
						    <a class="nav-link active home-tab" style="color: #000;" id="home-tab_2" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true"><i class="fa fa-book" aria-hidden="true"></i>	Resumen</a>
						  </li>
						  <li class="nav-item" style="width: 25%; text-align: center;     background-color: #dadada;">
						    <a class="nav-link profile-tab" id="profile-tab_2"  style="color: #000;" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false"><i class="fa fa-list" aria-hidden="true"></i>	Lecciones</a>
						  </li>
						  <li class="nav-item"  style="width: 25%; text-align: center;     background-color: #dadada;">
						    <a class="nav-link contact-tab"  style="color: #000;" id="contact-tab_2" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false"><i class="fa fa-comments" aria-hidden="true"></i> Reseñas</a>
						  </li>

						  <li class="nav-item"  style="width: 25%; text-align: center;     background-color: #dadada;">
						    <a class="nav-link tutor-tab"  style="color: #000;" id="tutor-tab_2" data-toggle="tab" href="#tutor" role="tab" aria-controls="contact" aria-selected="false"><i class="fa fa-user" aria-hidden="true"></i> Tutor</a>
						  </li>
						</ul>
						<div class="tab-content" id="myTabContent" style=" border:1px solid #ccc; border-top: none;">

							<div class="tab-pane fade" id="tutor" role="tabpanel" aria-labelledby="tutor-tab">								

								<div class="row">
								
									<div class="col-md-8 offset-md-2" style="margin-top: 25px; margin-bottom:25px;">
										
										<div class="row">
											<div class="col-2 text-center">
												<div class="foto-tutor" >
												</div>
											</div>

											<div class="col">
												<h5>{{$curso->NombreTutor}}</h5>
												<br />
												<p style="font-weight: 300;">{!!$curso->tutor[0]->DescripcionPersona!!}</p>

												@if($curso->tutor[0]->FacebookPersona)
												<a href="{{$curso->tutor[0]->FacebookPersona}}" target="_blank" class="red-social-tutor" style="font-size:35px; color: #616161; margin-right: 10px;"><i class="fa fa-facebook-square" aria-hidden="true"></i></a>
												@endif

												@if($curso->tutor[0]->TwitterPersona)
												<a href="{{$curso->tutor[0]->TwitterPersona}}" target="_blank" class="red-social-tutor" style="font-size:35px; color: #616161; margin-right: 10px;"><i class="fa fa-twitter-square" aria-hidden="true"></i></a>
												@endif

												@if($curso->tutor[0]->InstagramPersona)
												<a href="{{$curso->tutor[0]->InstagramPersona}}" target="_blank" class="red-social-tutor" style="font-size:35px; color: #616161; margin-right: 10px;"><i class="fa fa-instagram" aria-hidden="true"></i></a>
												@endif

												@if($curso->tutor[0]->LinkedinPersona)
												<a href="{{$curso->tutor[0]->InstagramPersona}}" target="_blank" class="red-social-tutor" style="font-size:35px; color: #616161; margin-right: 10px;"><i class="fa fa-linkedin-square" aria-hidden="true"></i></a>
												@endif

												@if($curso->tutor[0]->YoutubePersona)
												<a href="{{$curso->tutor[0]->YoutubePersona}}" target="_blank" class="red-social-tutor" style="font-size:35px; color: #616161; margin-right: 10px;">
													<i class="fa fa-youtube-square" aria-hidden="true"></i>
												</a>
												@endif

												<hr />


												<a href="{{url('')}}/tutor/{{$curso->NombreUsuario}}" class="btn-docttus-web" style="margin-top: 15px; margin-top: 15px; padding: 2px; font-size: 15px; padding: 3px 19px; border-radius: 16px; display:inline-block; color:#fff;">Conoce Más</a>
											</div>
										</div>
										

										
										
									</div>
								</div>
													
							</div>


						  <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
						  	
						  		<div class="row" style="padding-top:25px; padding-bottom: 25px; ">
						  			<div class="col-md-9 contenido-descripcion-curso" style="padding-right:43px;">
						  			
										<img src="{{url('')}}/assets/images/cursos/{{$curso->ImagenCurso}}" style="width: 100%; margin-bottom:15px;">

										<h4 style="margin-top: 15px; font-size: 25px; font-weight: 400;  margin-bottom: 15px;">Descripción del Curso</h4>
									
										<div class="contenido_descripcion" style="font-size: 18px;">
											{!!$curso->DescripcionCurso!!}
										</div>
						  				

						  				@if($curso->AudienciaCurso)
						  				<h4 style="margin-top: 35px; font-size: 25px; font-weight: 400;  margin-bottom: 15px;">Audiencia</h4>
						  				<div class="contenido_descripcion" style="font-size: 18px;">
											{!!$curso->AudienciaCurso!!}
										</div>
										@endif

						  				@if($curso->PrerrequisitoCurso)
						  				<h4 style="margin-top: 35px; font-size: 25px; font-weight: 400;  margin-bottom: 15px;">Prerrequisitos</h4>
										<div class="contenido_descripcion" style="font-size: 18px;">
											{!!$curso->PrerrequisitoCurso!!}
										</div>
										@endif


						  				
						  			</div>
						  			<div class="col-md-3 caracteristicas-curso">
						  				<h4 style="margin-top: 35px; font-size: 20px; font-weight: 400;  margin-bottom: 15px;">Características</h4>
						  				<ul class="list-group list-group-flush">
										  <li class="list-group-item">
										  	<div class="row">
										  		<div class="col-7">
										  			<i class="fa fa-file-o" aria-hidden="true"></i> Lecciones	
										  		</div>
										  		<div class="col-5">
										  			{{$curso->cantidad_lecciones}}
										  		</div>
										  	</div>
										  	
										  </li>
										  <li class="list-group-item">
										  	

											<div class="row">
										  		<div class="col-7">
										  			<i class="fa fa-clock-o" aria-hidden="true"></i> Duración
										  		</div>
										  		<div class="col-5">
										  			{{$curso->cantidad_horas}} horas
										  		</div>
										  	</div>

										  </li>
										  <li class="list-group-item">

											<div class="row">
										  		<div class="col-7">
										  			<i class="fa fa-level-up" aria-hidden="true"></i> Nivel
										  		</div>
										  		<div class="col-5">
										  			{{$curso->NombreNivel}}
										  			
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
										  			{{$curso->cantidad_estudiantes}}
										  		</div>
										  	</div>
										  </li>										
										</ul>

						  			</div>
						  		</div>

						  </div>
						  <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">

							<div class="row" style="padding-top:25px; padding-bottom: 25px; padding-right: 45px; ">
						  		<div class="col-md-12 contenido-lecciones-curso">
									<h4 style="margin-top: 15px; font-size: 20px; font-weight: 400;  margin-bottom: 15px;">
						  				Lecciones del Curso
						  			</h4>
									
										
										@foreach($curso->modulos as $modulo)

										<?php
											$contador_modulos++;
											$abrir_acordion="";
											if($contador_modulos==1){
												$abrir_acordion="show";
											}
										?>
										
										<div id="accordion_lecciones_{{$modulo->IdModulo}}" class="acordion_ficha">
										<!-- INICIO MODULO -->
										@if($modulo->GratisModulo)
										<button id="modulo_{{$modulo->IdModulo}}" class="btn btn-link btn-modulo btn_clase_gratis" id-item="{{$modulo->IdModulo}}" id-tipo="1" style="margin-top: 5px;">
										@else
										<button class="btn btn-link btn-modulo" style="margin-top: 5px;">
										@endif
											@if($modulo->GratisModulo)
											<i class="fa fa-play-circle icono-leccion" aria-hidden="true" style="color: #16c6df;"></i>
											@else
											<i class="fa fa-lock" aria-hidden="true"></i> 
											@endif
									         {{$modulo->NombreModulo}} 
									    </button>									  

										<!--
										
											<button class="btn btn-link btn-modulo" data-toggle="collapse" data-target="#collapse_1{{$modulo->IdModulo}}" aria-expanded="true" aria-controls="collapse_{{$modulo->IdModulo}}" style="margin-top: 5px;">
									         {{$modulo->NombreModulo}}  <i style="float: right; margin-top: 4px;" class="fa fa-plus-circle" aria-hidden="true"></i>
									    </button>									  

										-->
									    

									    <div id="collapse_{{$modulo->IdModulo}}" class="{{$abrir_acordion}} contenedor-lecciones" aria-labelledby="headingOne" data-parent="#accordion_lecciones_{{$modulo->IdModulo}}">									      
									        
									       <ul class="list-group list-group-flush">											  
											
											
									       	<!-- ITEM LECCIÓN -->
									       	 @foreach($curso->lecciones as $leccion)
									       	    @if($modulo->IdModulo == $leccion->IdModulo)

													@if($leccion->GratisTema)
													<a href="#" id="leccion_{{$leccion->IdTema}}" class="btn_clase_gratis"  id-item="{{$leccion->IdTema}}" id-tipo="2"   >	
													@endif
													
													  <li class="list-group-item">
													  	<div class="row">
													  		<div class="col-8">
													  			@if($leccion->GratisTema)
													  			<i class="fa fa-play-circle icono-leccion" aria-hidden="true" style="color: #16c6df;"></i>
													  			@else
													  			<i class="fa fa-lock" aria-hidden="true"></i> 
													  			@endif
													  			<span>{{$leccion->NombreTema}}</span>
													  		</div>
													  		<div class="col-4"  style="text-align: right;">
													  			<span>{{$leccion->DuracionTema}} Min</span>
													  		</div>
													  	</div>
													  </li>
													</a>
													@if($leccion->GratisTema)
														</a>
													@endif


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
						  <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
						  	
							<div class="row" style="padding-top:25px; padding-bottom: 25px; padding-right: 45px; ">
						  		<div class="col-md-8 offset-md-2 contenido-lecciones-curso">
									
									

									<div class="row">
										<div class="col-md-12" style="padding-top: 15px; padding-bottom: 25px; text-align: center; margin-left: 31px;">

											<h3 style="font-size: 90px; text-align: center; width:100%;">{{round($promedio_reviews_curso,1)}}</h3>
											<span>Valoración del curso</span><br />

											

											@php

												for($e=1;$e<=5;$e++){
													if($promedio_reviews_curso>=$e){
														echo('<i class="fa fa-star estrella" aria-hidden="true"  style="color: #F4C14E;"></i>');
													}else{
														echo('<i class="fa fa-star-o estrella" aria-hidden="true"  style="color: #F4C14E;"></i>');
													}
												}

											@endphp


										</div>
										<div class="col-md-12">
											<div class="row" style="margin-bottom: 8px;">
												<div class="col-6 col-md-8">
													<div class="progress" style="height: 20px;">
													  <div class="progress-bar" role="progressbar" style="width: {{$porcentaje_reviews_5}}%;" aria-valuenow="{{$porcentaje_reviews_5}}" aria-valuemin="0" aria-valuemax="100"></div>
													</div>
												</div>
												<div class="col-6 col-md-4">
													<i class="fa fa-star estrella" aria-hidden="true" style="color: #F4C14E;"></i> 
													<i class="fa fa-star estrella" aria-hidden="true" style="color: #F4C14E;"></i>
													<i class="fa fa-star estrella" aria-hidden="true" style="color: #F4C14E;"></i>
													<i class="fa fa-star estrella" aria-hidden="true" style="color: #F4C14E;"></i>
													<i class="fa fa-star estrella" aria-hidden="true" style="color: #F4C14E;"></i> {{$porcentaje_reviews_5}}%
												</div>
											</div>


											<div class="row" style="margin-bottom: 8px;">
												<div class="col-6 col-md-8">
													<div class="progress" style="height: 20px;">
													  <div class="progress-bar" role="progressbar" style="width: {{$porcentaje_reviews_4}}%;" aria-valuenow="{{$porcentaje_reviews_4}}" aria-valuemin="0" aria-valuemax="100"></div>
													</div>
												</div>
												<div class="col-6 col-md-4">
													<i class="fa fa-star estrella" aria-hidden="true" style="color: #F4C14E;"></i> 
													<i class="fa fa-star estrella" aria-hidden="true" style="color: #F4C14E;"></i>
													<i class="fa fa-star estrella" aria-hidden="true" style="color: #F4C14E;"></i>
													<i class="fa fa-star estrella" aria-hidden="true" style="color: #F4C14E;"></i>
													<i class="fa fa-star-o" aria-hidden="true" style="color: #F4C14E;"></i> {{$porcentaje_reviews_4}}%													

												</div>
											</div>


											<div class="row" style="margin-bottom: 8px;">
												<div class="col-6 col-md-8">
													<div class="progress" style="height: 20px;">
													  <div class="progress-bar" role="progressbar" style="width: {{$porcentaje_reviews_3}}%;" aria-valuenow="{{$porcentaje_reviews_3}}" aria-valuemin="0" aria-valuemax="100"></div>
													</div>
												</div>
												<div class="col-6 col-md-4">
													<i class="fa fa-star estrella" aria-hidden="true" style="color: #F4C14E;"></i> 
													<i class="fa fa-star estrella" aria-hidden="true" style="color: #F4C14E;"></i>
													<i class="fa fa-star estrella" aria-hidden="true" style="color: #F4C14E;"></i>
													<i class="fa fa-star-o estrella" aria-hidden="true" style="color: #F4C14E;"></i>
													<i class="fa fa-star-o estrella" aria-hidden="true" style="color: #F4C14E;"></i> {{$porcentaje_reviews_3}}%
												</div>
											</div>


											<div class="row" style="margin-bottom: 8px;">
												<div class="col-6 col-md-8">
													<div class="progress" style="height: 20px;">
													  <div class="progress-bar" role="progressbar" style="width: {{$porcentaje_reviews_2}}%;" aria-valuenow="{{$porcentaje_reviews_2}}" aria-valuemin="0" aria-valuemax="100"></div>
													</div>
												</div>
												<div class="col-6 col-md-4">
													<i class="fa fa-star estrella" aria-hidden="true" style="color: #F4C14E;"></i> 
													<i class="fa fa-star estrella" aria-hidden="true" style="color: #F4C14E;"></i>
													<i class="fa fa-star-o estrella" aria-hidden="true" style="color: #F4C14E;"></i>
													<i class="fa fa-star-o estrella" aria-hidden="true" style="color: #F4C14E;"></i>
													<i class="fa fa-star-o estrella" aria-hidden="true" style="color: #F4C14E;"></i> {{$porcentaje_reviews_2}}%
												</div>
											</div>


											<div class="row" style="margin-bottom: 8px;">
												<div class="col-6 col-md-8">
													<div class="progress" style="height: 20px;">
													  <div class="progress-bar" role="progressbar" style="width: {{$porcentaje_reviews_1}}%;" aria-valuenow="{{$porcentaje_reviews_1}}" aria-valuemin="0" aria-valuemax="100"></div>
													</div>
												</div>
												<div class="col-6 col-md-4">
													<i class="fa fa-star estrella" aria-hidden="true" style="color: #F4C14E;"></i> 
													<i class="fa fa-star-o estrella" aria-hidden="true" style="color: #F4C14E;"></i>
													<i class="fa fa-star-o estrella" aria-hidden="true" style="color: #F4C14E;"></i>
													<i class="fa fa-star-o estrella" aria-hidden="true" style="color: #F4C14E;"></i>
													<i class="fa fa-star-o estrella" aria-hidden="true" style="color: #F4C14E;"></i> {{$porcentaje_reviews_1}}%
												</div>
											</div>


										</div>
									</div>




						  			<div class="listado-valoraciones" style="width: 100%; ">

						  				

						  				<ul class="list-group list-group-flush">

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
															<small>Hace 1 Días</small>
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

													

										  	 		<p style="font-weight: 300;line-height: 22px; margin-top: 15px;">{{$review->ObservacionCalificacion}}</p>
										  	 	</div>
										  	 </div>
										  </li>
										  @endif
										  <!-- fin ficha reseña -->
										@endforeach

										</ul>
										<!--
										<center>
											<button class="btn-docttus-web" style="margin-top: 15px;">
												VER MÁS RESEÑAS
											</button>
										</center>-->


						  			</div>

						  		</div>
						  	</div>

						  </div>

						</div>
					</div>


					

					<!--- fin ficha izquierda -->


					<div class="row" style="margin-top: 35px;">
						<div class="col-md-4" style="padding-top: 15px; padding-bottom: 25px; text-align: center; padding-left: 25px;">

							<h3 style="font-size: 90px; text-align: center; ">{{round($promedio_reviews_curso,1)}}</h3>
							<span>Valoración del curso</span><br />
							<!--
							<i class="fa fa-star estrella" aria-hidden="true" style="color: #F4C14E;"></i>
							<i class="fa fa-star estrella" aria-hidden="true" style="color: #F4C14E;"></i>
							<i class="fa fa-star estrella" aria-hidden="true" style="color: #F4C14E;"></i>
							<i class="fa fa-star estrella" aria-hidden="true" style="color: #F4C14E;"></i>
							<i class="fa fa-star estrella" aria-hidden="true" style="color: #F4C14E;"></i>
							-->

							@php

								for($e=1;$e<=5;$e++){
									if($promedio_reviews_curso>=$e){
										echo('<i class="fa fa-star estrella" aria-hidden="true"  style="color: #F4C14E;"></i>');
									}else{
										echo('<i class="fa fa-star-o estrella" aria-hidden="true"  style="color: #F4C14E;"></i>');
									}
								}

							@endphp


						</div>
						<div class="col-md-8">
							<div class="row" style="margin-bottom: 8px;">
								<div class="col-6 col-md-8 ">
									<div class="progress" style="height: 20px;">
									  <div class="progress-bar" role="progressbar" style="width: {{$porcentaje_reviews_5}}%;" aria-valuenow="{{$porcentaje_reviews_5}}" aria-valuemin="0" aria-valuemax="100"></div>
									</div>
								</div>
								<div class="col-6 col-md-4">
									<i class="fa fa-star estrella" aria-hidden="true" style="color: #F4C14E;"></i> 
									<i class="fa fa-star estrella" aria-hidden="true" style="color: #F4C14E;"></i>
									<i class="fa fa-star estrella" aria-hidden="true" style="color: #F4C14E;"></i>
									<i class="fa fa-star estrella" aria-hidden="true" style="color: #F4C14E;"></i>
									<i class="fa fa-star estrella" aria-hidden="true" style="color: #F4C14E;"></i> {{$porcentaje_reviews_5}}%
								</div>
							</div>


							<div class="row" style="margin-bottom: 8px;">
								<div class="col-6 col-md-8 ">
									<div class="progress" style="height: 20px;">
									  <div class="progress-bar" role="progressbar" style="width: {{$porcentaje_reviews_4}}%;" aria-valuenow="{{$porcentaje_reviews_4}}" aria-valuemin="0" aria-valuemax="100"></div>
									</div>
								</div>
								<div class="col-6 col-md-4">
									<i class="fa fa-star estrella" aria-hidden="true" style="color: #F4C14E;"></i> 
									<i class="fa fa-star estrella" aria-hidden="true" style="color: #F4C14E;"></i>
									<i class="fa fa-star estrella" aria-hidden="true" style="color: #F4C14E;"></i>
									<i class="fa fa-star estrella" aria-hidden="true" style="color: #F4C14E;"></i>
									<i class="fa fa-star-o" aria-hidden="true" style="color: #F4C14E;"></i> {{$porcentaje_reviews_4}}%													

								</div>
							</div>


							<div class="row" style="margin-bottom: 8px;">
								<div class="col-6 col-md-8 ">
									<div class="progress" style="height: 20px;">
									  <div class="progress-bar" role="progressbar" style="width: {{$porcentaje_reviews_3}}%;" aria-valuenow="{{$porcentaje_reviews_3}}" aria-valuemin="0" aria-valuemax="100"></div>
									</div>
								</div>
								<div class="col-6 col-md-4">
									<i class="fa fa-star estrella" aria-hidden="true" style="color: #F4C14E;"></i> 
									<i class="fa fa-star estrella" aria-hidden="true" style="color: #F4C14E;"></i>
									<i class="fa fa-star estrella" aria-hidden="true" style="color: #F4C14E;"></i>
									<i class="fa fa-star-o estrella" aria-hidden="true" style="color: #F4C14E;"></i>
									<i class="fa fa-star-o estrella" aria-hidden="true" style="color: #F4C14E;"></i> {{$porcentaje_reviews_3}}%
								</div>
							</div>


							<div class="row" style="margin-bottom: 8px;">
								<div class="col-6 col-md-8 ">
									<div class="progress" style="height: 20px;">
									  <div class="progress-bar" role="progressbar" style="width: {{$porcentaje_reviews_2}}%;" aria-valuenow="{{$porcentaje_reviews_2}}" aria-valuemin="{{$porcentaje_reviews_2}}" aria-valuemax="100"></div>
									</div>
								</div>
								<div class="col-6 col-md-4">
									<i class="fa fa-star estrella" aria-hidden="true" style="color: #F4C14E;"></i> 
									<i class="fa fa-star estrella" aria-hidden="true" style="color: #F4C14E;"></i>
									<i class="fa fa-star-o estrella" aria-hidden="true" style="color: #F4C14E;"></i>
									<i class="fa fa-star-o estrella" aria-hidden="true" style="color: #F4C14E;"></i>
									<i class="fa fa-star-o estrella" aria-hidden="true" style="color: #F4C14E;"></i> {{$porcentaje_reviews_2}}%
								</div>
							</div>


							<div class="row" style="margin-bottom: 8px;">
								<div class="col-6 col-md-8 ">
									<div class="progress" style="height: 20px;">
									  <div class="progress-bar" role="progressbar" style="width: {{$porcentaje_reviews_1}}%;" aria-valuenow="{{$porcentaje_reviews_1}}" aria-valuemin="0" aria-valuemax="100"></div>
									</div>
								</div>
								<div class="col-6 col-md-4">
									<i class="fa fa-star estrella" aria-hidden="true" style="color: #F4C14E;"></i> 
									<i class="fa fa-star-o estrella" aria-hidden="true" style="color: #F4C14E;"></i>
									<i class="fa fa-star-o estrella" aria-hidden="true" style="color: #F4C14E;"></i>
									<i class="fa fa-star-o estrella" aria-hidden="true" style="color: #F4C14E;"></i>
									<i class="fa fa-star-o estrella" aria-hidden="true" style="color: #F4C14E;"></i> {{$porcentaje_reviews_1}}%
								</div>
							</div>


						</div>
					</div>

				</div>

				
			</div>
		</div>
	</section>








	<!-- Modal -->
	<div class="modal fade" id="modal-curso-leccion" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"  style="z-index: 9999999999;">
	  <div class="modal-dialog modal-lg  modal-dialog-centered" role="document">
	    <div class="modal-content">	      
	      <div class="modal-body">

	      	<a href="#" class="btn-cerrar-popup"  data-dismiss="modal" ><i class="fa fa-times" aria-hidden="true"></i></a>

	        <div class="row">
	        	<div class="col-md-12">
	        		<div id="contenido_gratis">
					  
					</div>
	        	</div>
	        </div>

	        <div class="row" style="margin-top: 25px; margin-bottom: 20px;">
	        	<div class="col-md-12 contenido-ficha-curso-modal">
	        		<h3 id="titulo_leccion_gratis"></h3>	        		
	        	</div>	        	
	        </div>
	      </div>	     
	    </div>
	  </div>
	</div>




@stop

@section('scripts')
	<script type="text/javascript">



		$(function(e){
			set_traffic();
			scroll_base();
		});

		$(window).scroll(function (event) {
			scroll_base();
		});

		function scroll_base(){
			var scroll = $(window).scrollTop();
			var width_x= window.innerWidth;
			// Do something
			
				if(scroll>=700){
					$(".barra-inferior-comprar").show();								
				}else{
					$(".barra-inferior-comprar").hide();								
				}
			
			
			
		}


		function set_traffic(){
			var IdCurso="{{$curso->IdCurso}}";
			var OrigenTrafico=""+location.origin;
			var IdAfiliado="";

			var formData = new FormData();
	      	formData.append('IdCurso', IdCurso);  
	      	formData.append('OrigenTrafico', OrigenTrafico);  	      	
	      	formData.append('IdAfiliado', IdAfiliado);
	      	formData.append('_token', "{{ csrf_token() }}");

	      	var request = $.ajax({
		      url: "{{url('')}}/registrar_trafico",
		      type: "POST",
		      data: formData,
          	  processData: false,  // tell jQuery not to process the data
          	  contentType: false  // tell jQuery not to set contentType         
		    });

		    request.done(function(obj) { 		       
		    });
		     //respuesta si falla
		    request.fail(function(jqXHR, textStatus) {
		      console.log( "Error de servidor  " + textStatus );
		    });


		}
		var cont_vid=0;
		function abrir_visualizacion_free(url_embed, titulo_leccion,tipo_video){
			console.log(tipo_video);
			cont_vid++;
			$("#titulo_leccion_gratis").html(titulo_leccion);
			url_embed=url_embed.replace("player_video","player_video_free_{{$curso->IdCurso}}_"+cont_vid);
			$("#iframe_video_gratis").html(url_embed);
			if(tipo_video=="1"){
				var player = videojs('player_video_free_{{$curso->IdCurso}}_'+cont_vid);
			}
			

			$("#modal-curso-leccion").modal("show");			
		}
		//CERRAR MODAL -  EVENTO
		$('#modal-curso-leccion').on('hidden.bs.modal', function (e) {	  
		  $("#iframe_video_gratis").html("");	  
		});


		@if(count($arra_data_usuario)!=0)

		var IdEstadoDeseo="1";
		$("#btn_deseos").click(function(e){
			e.preventDefault();
			var IdCurso="{{$curso->IdCurso}}";
			var IdUsuario="{{$arra_data_usuario[0]->IdUsuario}}";
			

			var formData = new FormData();
	      	formData.append('IdCurso', IdCurso);  	      	
			formData.append('IdUsuario', IdUsuario);
			
			
			  
	      	formData.append('_token', "{{ csrf_token() }}");

	      	var request = $.ajax({
		      url: "{{url('')}}/registrar_deseo",
		      type: "POST",
		      data: formData,
          	  processData: false,  // tell jQuery not to process the data
          	  contentType: false  // tell jQuery not to set contentType         
		    });

		    request.done(function(obj) { 		       
				if(obj.status=="ok"){
					var desc_toast="";
					if(obj.estado_deseo=="1"){
						$("#btn_deseos > i.fa").css("color","red");
						 desc_toast="Este curso se ha agregado a tu lista de deseos.";
					}else{
						$("#btn_deseos > i.fa").css("color","white");
						desc_toast="Este curso se ha eliminado a tu lista de deseos.";
					}
					
					mensaje_toast("success",desc_toast, "Lista de Deseos");
					return;
				}
		    });
		     //respuesta si falla
		    request.fail(function(jqXHR, textStatus) {
		      console.log( "Error de servidor  " + textStatus );
		    });
		});

		@endif

		

		var btn_clase_gratis=document.getElementsByClassName("btn_clase_gratis");
		for(let i=0;i<btn_clase_gratis.length;i++){
			btn_clase_gratis[i].addEventListener("click",function(e){
				e.preventDefault();		
				get_tema_gratis(this.getAttribute("id-item"),this.getAttribute("id-tipo"));
			});
		}

		function get_tema_gratis(id_item,tipo_item){
			var formData = new FormData();
	      	formData.append('IdCurso', "{{$curso->IdCurso}}");  	      	
			formData.append('id_item', id_item);
			formData.append('tipo_item', tipo_item);
			formData.append('_token', "{{ csrf_token() }}");

			var request = $.ajax({
				url: "{{url('')}}/get_tema_gratis",
				type: "POST",
				data: formData,
				processData: false,  // tell jQuery not to process the data
				contentType: false  // tell jQuery not to set contentType         
			});

			request.done(function(obj) { 		       
				if(obj.status=="ok"){					
					$("#modal-curso-leccion").modal("show");

					var cadena_gratis="";
					var obj_datos=obj.datos;
					for(var i=0;i<obj_datos.length;i++){
						cadena_gratis+=`<div class="row" style="margin-bottom:15px;">`;
						cadena_gratis+=`	<div class="col-md-12">`;
						cadena_gratis+=`		<div style="border:1px solid #ccc; padding:5px;">`;
						cadena_gratis+=`			<h3 style="font-size:20px;">${obj_datos[i].NombreMedia}</h3>`;

						if(obj_datos[i].TipoMedia=="1"){
							cadena_gratis+=`
							<div class="embed-responsive embed-responsive-16by9">
								${obj_datos[i].video_embed}						
							</div>		
							`;
						}
						if(obj_datos[i].TipoMedia=="2"){
							cadena_gratis+=`
								<img src="{{url('')}}/${obj_datos[i].URLMedia}" style="width:100%;">
							`;
						}


						if(obj_datos[i].TipoMedia=="4"){
							cadena_gratis+=`
								

							<div class="row" style="margin-top:15px;">
								<div class="col-md-12" >
									<audio controls style="width:100%;">
										<source src="{{url('')}}/${obj_datos[i].URLMedia}" type="audio/mpeg">
									Your browser does not support the audio element.
									</audio>
								</div>								
							</div>
							`;
						}


						cadena_gratis+=`			<div style="margin-top:10px;">${obj_datos[i].ContenidoMedia}</div>`;
						cadena_gratis+=`		</div>`;
						cadena_gratis+=`	</div>`;
						cadena_gratis+=`</div>`;
					}

					$("#contenido_gratis").html(cadena_gratis);


					
				}
			});
			//respuesta si falla
			request.fail(function(jqXHR, textStatus) {
				console.log( "Error de servidor  " + textStatus );
			});

		}


		$(".home-tab").click(function(e){
			$(".nav-link").removeClass("active");
			$(".home-tab").addClass("active");			
			$(".tab-pane").removeClass('show').removeClass('active');
			$('#home').addClass('show').addClass('active');
			
		});

		$(".profile-tab").click(function(e){
			$(".nav-link").removeClass("active");
			$(".profile-tab").addClass("active");			
			
			$(".tab-pane").removeClass('show').removeClass('active');
			$('#profile').addClass('show').addClass('active');
		});

		$(".contact-tab").click(function(e){
			$(".nav-link").removeClass("active");
			$(".contact-tab").addClass("active");			
			
			$(".tab-pane").removeClass('show').removeClass('active');
			$('#contact').addClass('show').addClass('active');

		});

		$(".tutor-tab").click(function(e){
			$(".nav-link").removeClass("active");
			$(".tutor-tab").addClass("active");			
			$(".tab-pane").removeClass('show').removeClass('active');
			$('#tutor').addClass('show').addClass('active');
			
		});


		/*
									
									*/

	</script>

@stop
