@extends('marketing.plantilla.plantilla')
@section('contenido')   
	<!-- Hero section -->
	
	<style>
		p{
			margin:0px !important;
			padding: 0px!important;
			text-decoration: none;
			color: black;
			font-weight: inherit;
		}
	</style>

	<section class="hero-section">
		<div class="hero-slider owl-carousel">			
			<div class="hs-item" style="padding-top:38px; padding-bottom: 80px; height: auto !important; background-position: top center; ">
				<div class="container">
					<div class="row">
						<div class="col-lg-12" style="text-align: center;">							
					
							<h1 style="font-size: 48px; color: #fff; margin-top: 100px;">Nuestras Políticas</h1>
				
						</div>						
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- Hero section end -->
    
	<!-- Intro section -->
	<section class="intro-section spad">
		<div class="container">
			<div class="row">				
				<div class="col-lg-12">

					<div class="list-group">
						

						@foreach ($politicas as $item)
							@if($item->SlugPolitica==$SlugPolitica)
								<a href="{{url('')}}/politica/{{$item->SlugPolitica}}" class="list-group-item list-group-item-action active">{{$item->TituloPolitica}}</a>
							@else
								<a href="{{url('')}}/politica/{{$item->SlugPolitica}}" class="list-group-item list-group-item-action">{{$item->TituloPolitica}}</a>
							@endif
						@endforeach					
						
						
					</div>

                    
				</div>

                
			</div>
		</div>
	</section>
	<!-- Intro section end -->


@stop

@section('scripts')

@stop


