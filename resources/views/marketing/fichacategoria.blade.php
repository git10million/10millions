<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;
use App\Quotation;
if($id_subcategoria!==""){
	$id_pagina="subcategoria";
}else{
	$id_pagina="categoria";
}

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
					
							<h1 style="font-size: 48px; color: #fff; margin-top: 100px;">{{$titulo_pagina}}</h1>
				
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
