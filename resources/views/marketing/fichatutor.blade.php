<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;
use App\Quotation;
$id_pagina="tutores";

?>
@extends('marketing.plantilla.plantilla')
@section('contenido')   

<style type="text/css">
	.contact-warp p {
	    padding-top: 10px;
	    margin-bottom: 10px;
	}
</style>

<!-- Hero section -->
	<section class="hero-section">
		<div class="hero-slider owl-carousel">			
			<div class="hs-item" style="padding-top:38px; padding-bottom: 80px; height: auto !important; background-position: top center; ">
				<div class="container">
					<div class="row">
						<div class="col-lg-12" style="text-align: center;">							
							
							<div style="margin-top:15px; margin-bottom:25px;  margin-top: 100px; width:100px; height:100px; display:inline-block; 
										background-image:url({{url('')}}/assets/images/usuarios/{{$foto_tutor}}); 
										background-position:center; background-size:cover; background-repeat:no-repeat;
										border-radius:50px;
										">
							</div>

							<h1 style="font-size: 48px; color: #fff; ">{{$titulo_pagina}}</h1>
							<p style="color: #fff; font-weight:300; margin-bottom:15px;">{{$descripcion_tutor}}</p>

							@if(count($tutor)>0)
								@if($tutor[0]->FacebookPersona)
								<a href="{{$tutor[0]->FacebookPersona}}" target="_blank" class="red-social-tutor" style="font-size:35px; color: #fff; margin-right: 10px;"><i class="fa fa-facebook-square" aria-hidden="true"></i></a>
								@endif

								@if($tutor[0]->TwitterPersona)
								<a href="{{$tutor[0]->TwitterPersona}}" target="_blank" class="red-social-tutor" style="font-size:35px; color: #fff; margin-right: 10px;"><i class="fa fa-twitter-square" aria-hidden="true"></i></a>
								@endif

								@if($tutor[0]->InstagramPersona)
								<a href="{{$tutor[0]->InstagramPersona}}" target="_blank" class="red-social-tutor" style="font-size:35px; color: #fff; margin-right: 10px;"><i class="fa fa-instagram" aria-hidden="true"></i></a>
								@endif

								@if($tutor[0]->LinkedinPersona)
								<a href="{{$tutor[0]->InstagramPersona}}" target="_blank" class="red-social-tutor" style="font-size:35px; color: #fff; margin-right: 10px;"><i class="fa fa-linkedin-square" aria-hidden="true"></i></a>
								@endif

								@if($tutor[0]->YoutubePersona)
								<a href="{{$tutor[0]->YoutubePersona}}" target="_blank" class="red-social-tutor" style="font-size:35px; color: #fff; margin-right: 10px;">
									<i class="fa fa-youtube-square" aria-hidden="true"></i>
								</a>
								@endif

							@endif
				
						</div>						
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- Hero section end -->

<!-- Blog section -->
	<section class="blog-section">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<center>
						<p>{{$descripcion_pagina}}</p>	
					</center>	
				</div>
			</div>

			@include('marketing.component.cursos')
			
		</div>
		

		
	</section>
	<!-- Blog section end -->


@stop

@section('scripts')

@stop
