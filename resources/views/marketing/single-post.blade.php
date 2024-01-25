@extends('marketing.plantilla.plantilla')
@section('contenido')   

<style type="text/css">
	.contact-warp p {
	    padding-top: 10px;
	    margin-bottom: 10px;
	}
	h1{
		font-size: 48px;
	}


</style>

<!-- Hero section -->
<section class="hero-section">
	<div class="hero-slider owl-carousel">			
		<div class="hs-item" style="padding-top:38px; padding-bottom: 80px; height: auto !important; background-position: top center; ">
			<div class="container">
				<div class="row">
					<div class="col-lg-12" style="text-align: center;">							
				
						<h1 style="color: #fff; margin-top: 100px;">{{$article[0]->TituloArticulo}}</h1>
			
					</div>						
				</div>
			</div>
		</div>
	</div>
</section>
	<!-- Hero section end -->

	<section class="blog-section spad" style="padding-top: 18px;">
		<div class="container">
			<!-- Blog post -->
			<div class="row">
				<div class="col-md-9">

					
					<div class="blog-item">						
						<div class="blog-meta" style="color:#5a5a5a;">Publicado por <a href="">10 Million$ Club</a> {{\Carbon\Carbon::parse($article[0]->FechaArticulo)->diffForHumans()}} </div>
						<img src="{{$article[0]->URLImagenArticulo}}" alt="{{$article[0]->TituloArticulo}}" style="width:100%;">						
						
						
						<div style="text-align: justify;">{!!$article[0]->DescripcionArticulo!!}</div>
					</div>						

					<div class="row">
						<div class="col-6">
							@if($navegacion[0]->prev_value)
							<a class="btn btn-info" href="{{$navegacion[0]->prev_value}}"><i class="fa fa-angle-left" aria-hidden="true"></i> ANTERIOR</a>							
							@endif
						</div>
						<div class="col-6" style="text-align: right;">
							@if($navegacion[0]->next_value)
							<a class="btn btn-info" href="{{$navegacion[0]->next_value}}">SIGUIENTE <i class="fa fa-angle-right" aria-hidden="true"></i></a>							
							@endif
						</div>					
					</div>



				</div>
				<div class="col-md-3">
					<img src="{{url('')}}/assets-blog/images/banner.jpg">
				</div>
			</div>
			
			
			
		</div>
	</section>
	<!-- Blog section end -->


@stop

@section('scripts')

@stop
