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
					
							<h1 style="font-size: 48px; color: #fff; margin-top: 100px;">Contáctenos</h1>
				
						</div>						
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- Hero section end -->

<!-- Contact section -->
	<section class="contact-section">
		<div class="container-fluid">
			<div class="row">
				<div class="col-lg-6 p-0">
					<!-- Map -->
					<div class="map"><iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d10784.188505644011!2d19.053119335158936!3d47.48899529453826!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2sbd!4v1543907528304" style="border:0" allowfullscreen></iframe></div>
				</div>
				<div class="col-lg-6 p-0">
					<div class="contact-warp">
						<h4>Encuéntranos en nuestas redes sociales</h4>
						<div class="social-links" style="margin-top: 25px; margin-left: 0px; margin-bottom: 45px; text-align: left;">
							<a href=""  style="color: #3b465a;"><i class="fa fa-instagram"></i></a>						
							<a href="" style="color: #3b465a;"><i class="fa fa-facebook"></i></a>
							<a href="" style="color: #3b465a;"><i class="fa fa-twitter"></i></a>
							<a href="" style="color: #3b465a;"><i class="fa fa-youtube"></i></a>
						</div>

						<h4 style="margin-bottom: 25px;">Datos de Contacto</h4>
						<ul>							
							<li><strong>Teléfono/Whatsapp:</strong> +1 (551) 556-8543</li>
							<li><strong>Email</strong> info@10millionsclub.live</li>
						</ul>

						
						<h4 style="margin-bottom: 25px;">Déjanos un Mensaje</h4>
						<form class="contact-from" id="formulario-contacto">
							<div class="row">
								<div class="col-md-6">
									<input type="text" placeholder="* Nombre" id="txtnombre" required>
								</div>
								<div class="col-md-6">
									<input type="text" placeholder="Tu Mejor Email" id="txtemail" required >
								</div>
								<div class="col-md-12">
									<input type="text" placeholder="* Asunto" required id="txtasunto">
									<textarea placeholder="* Mensaje" required id="txtmensaje"></textarea>
									<button class="btn-docttus-web" type="submit">Enviar Mensaje</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</section>

@stop

@section('scripts')
	<script type="text/javascript">
		
		$("#formulario-contacto").submit(function(e){
			e.preventDefault();
			var nombre=""+$("#txtnombre").val();
			var asunto=""+$("#txtasunto").val();
			var email=""+$("#txtemail").val();
			var mensaje=""+$("#txtmensaje").val();

			var formData = new FormData();
	      	formData.append('NombreMensaje', nombre);  
	      	formData.append('EmailMensaje', email);  
	      	formData.append('AsuntoMensaje', asunto);  
	      	formData.append('ObservacionMensaje', mensaje);  
	      	formData.append('TipoMensaje', "3");  
	      	formData.append('_token', "{{ csrf_token() }}");


		    var request = $.ajax({
		      url: "{{url('')}}/enviar_mensaje_generico",
		      type: "POST",
		      data: formData,
          	  processData: false,  // tell jQuery not to process the data
          	  contentType: false  // tell jQuery not to set contentType         
		    });

		    request.done(function(obj) { 
		       if(obj.status=="ok"){
		          mensaje_generico("Mensaje Enviado",""+obj.mensaje,"1","Aceptar",function(){
		          	$("#txtnombre").val("");
					$("#txtasunto").val("");
					$("#txtemail").val("");
					$("#txtmensaje").val("");
		          });		          
		          return;
		       }else{
		          mensaje_generico("Error !",""+obj.mensaje,"2","Continuar...",function(){});
		          return;
		       }
		    });
		     

		     //respuesta si falla
		    request.fail(function(jqXHR, textStatus) {
		      alert( "Error de servidor  " + textStatus );
		    });


		});
	</script>
@stop
