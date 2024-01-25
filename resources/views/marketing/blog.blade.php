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
				
						<h1 style="font-size: 48px; color: #fff; margin-top: 100px;">Blog</h1>
			
					</div>						
				</div>
			</div>
		</div>
	</div>
</section>
	<!-- Hero section end -->

<!-- Blog section -->
	<section class="blog-section spad"  style="padding-top: 18px;">
		<div class="container">
			<!-- Blog post -->
			<div class="row">
				<div class="col-md-9">

					@foreach ($articulos as $article)
						<div class="blog-item">
							<a href="{{url('')}}/blog/{{$article->SlugArticulo}}">
								<img src="{{$article->URLImagenArticulo}}" alt="">
							</a>
							<div class="blog-date">{{\Carbon\Carbon::parse($article->FechaArticulo)->diffForHumans()}}</div>
							<a href="{{url('')}}/blog/{{$article->SlugArticulo}}">
								<h3>{{$article->TituloArticulo}}</h3>
							</a>
							<div class="blog-meta">por <a href="">10 Million$ Club</a></div>
							<p>{{html_entity_decode(substr(strip_tags($article->DescripcionArticulo),0,450))}}...</p>
						</div>	
					@endforeach
					

					{{ $articulos->links() }}

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
