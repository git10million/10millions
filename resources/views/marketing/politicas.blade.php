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
					
							<h1 style="font-size: 48px; color: #fff; margin-top: 100px;">{{$politica->TituloPolitica}}</h1>
				
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
				<div class="col-lg-3">

					<div class="list-group">
						

						@foreach ($politicas as $item)
							@if($item->IdPoliticaPadre=="")
								@if($item->SlugPolitica==$SlugPolitica)
									@php
									$estado_activo="active";
									@endphp
								@else
									@php
									$estado_activo="";
									@endphp
								@endif

								<a href="{{url('')}}/politica/{{$item->SlugPolitica}}" class="list-group-item list-group-item-action {{$estado_activo}}">{{$item->TituloPolitica}}</a>

								@foreach ($politicas as $item2)
									@if($item2->IdPoliticaPadre == $item->IdPolitica)

									@if($item2->SlugPolitica==$SlugPolitica)
										@php
										$estado_activo="#007bff; color:#fff;";
										@endphp
									@else
										@php
										$estado_activo="#dedede;";
										@endphp
									@endif

										<a href="{{url('')}}/politica/{{$item2->SlugPolitica}}" class="list-group-item list-group-item-action"  style="background-color: {{$estado_activo}} padding-left:30px; font-size:13px;">- {{$item2->TituloPolitica}}</a>
									@endif
								@endforeach

							@endif
						@endforeach					
						
						
					  </div>

                    
				</div>

                <div class="col-lg-9">
					<p><i>Esta {{$politica->TituloPolitica}} se actualizó por última vez el {{\Carbon\Carbon::parse($politica->FechaPolitica)->format('F d, Y')}}</i></p>
					<br />
                    {!!$politica->ContenidoPolitica!!}
				</div>
			</div>
		</div>
	</section>
	<!-- Intro section end -->


@stop

@section('scripts')
<script>

$(document).on('click', 'a[href^="#"]', function (event) {
    event.preventDefault();

    $('html, body').animate({
        scrollTop: $($.attr(this, 'href')).offset().top-85
    }, 500);
});

</script>
@stop


