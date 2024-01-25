@extends('marketing.plantilla.plantilla')
@section('contenido')   

<style type="text/css">
	.contact-warp p {
	    padding-top: 10px;
	    margin-bottom: 10px;
	}
</style>
<!-- Contact section -->

<!-- Hero section -->
	<section class="hero-section">
		<div class="hero-slider owl-carousel">			
			<div class="hs-item" style="padding-top:38px; padding-bottom: 80px; height: auto !important; background-position: top center; ">
				<div class="container">
					<div class="row">
						<div class="col-lg-12" style="text-align: center;">							
					
							<h1 style="font-size: 48px; color: #fff; margin-top: 100px;">Acerca de Nosotros</h1>
				
						</div>						
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- Hero section end -->

	<section class="contact-section">
		<div class="container-fluid">
			<div class="row">
				<div class="col-lg-6 p-0">
					<!-- Map -->
					<div class="map" style="background-image: url({{url('')}}/assets-marketing/images/about-us-image.jpg); background-position: center; background-size:cover;">
						
					</div>
				</div>
				<div class="col-lg-6 p-0">
					<div class="contact-warp">
						
						<p>Somos una empresa formada como un club con 5 años de experiencia especializada en brindar soluciones financieras 
							através de una red de agentes miembros de el club comprometidos. Nuestro enfoque se centra en empoderar a los vendedores 
							representantes, proporcionándoles comisiones atractivas, incentivos, entrenamiento, herramientas de mercadeo y reconocimientos.
							Hemos desarrollado un plan de beneficios financiero a largo plazopara garantizar su éxito y satisfacción.</p>

						<h2>Misión</h2>

						<p>La misión de nuestra empresa esbrindar a nuestros clientes soluciones integrales y personalizadas en sus procesos financieros, 
							de emprendimiento y personales, conectándolos con profesionales expertos que les guiarán y acompañarán en cada etapa, asegurando 
							su éxito ybienestar en su idioma.</p>

						



						<div class="row">
							
							<div class="col-lg-4 col-sm-6">
								<div class="premium-item">
									<img src="{{url('')}}/assets-marketing/images/tutor-0.jpg" alt="">
									<h4>Johanna Morales</h4>
									<p>CEO</p>
								</div>
							</div>

							<div class="col-lg-4 col-sm-6">
								<div class="premium-item">
									<img src="{{url('')}}/assets-marketing/images/tutor-2.png" alt="">
									<h4>Elizabeth Beitia</h4>
									<p>TI</p>
								</div>
							</div>

							<div class="col-lg-4 col-sm-6">
								<div class="premium-item">
									<img src="{{url('')}}/assets-marketing/images/tutor-3.jpg" alt="">
									<h4>Jacqueline Flores</h4>
									<p>Administración</p>
								</div>
							</div>							

							
						</div>						

					</div>


				</div>


				


			</div>


			


		</div>
	</section>




@stop

@section('scripts')

@stop
