<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title></title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<link href="https://fonts.googleapis.com/css?family=Oswald|Roboto{{$id_pagina}}" rel="stylesheet">
    <link rel="icon" type="image/png" href="{{url('')}}/assets-marketing/images/favicon.png">

	



	<style type="text/css">
		*,html,body{
			font-family: 'Oswald', sans-serif;
			
		}

		body{
			
		}

		.contenido{
			width: 100%;
			padding: 70px 10px;
			background-color: #0B5586;
		}

		h1{
			color:#fff;
			font-weight: 100;
		}

		.fb_iframe_widget_fluid_desktop, .fb_iframe_widget_fluid_desktop span, .fb_iframe_widget_fluid_desktop iframe {
            max-width: 100% !important;
            width: 100% !important;
 }

		.subtitulo{
			color: #fff;
			font-family: 'Roboto', sans-serif;
			font-size: 30px;
			margin-top: 55px;
		}

		.containvideo{
			box-shadow: 0px 0px 16px 3px #ccc;
			margin-top: 55px;
		}

		.btn-wk{
			width: 100%;
			font-size: 25px;
			margin-top: 25px;
			white-space: normal;
		}

		.contenido-videos{
			width: 100%; 
			padding: 70px 10px;
			background-color: #fff;
		}

		.subtitulo-videos{
			font-size: 30px;
		}

		.subtitulo-videos > span{
			font-weight: bold;
			text-decoration: underline;
		}

		#reloj{
			font-size: 45px;
			color: #000;
			background-color: #ffbf3f;
			display: inline-block;
			width: 350px;
			border-radius: 9px;
			padding: 15px;

		}

		@media only screen and (max-width: 991px) {

			.contenido {
    
    			padding: 25px 10px;

    		}

			.subtitulo{
				font-size: 30px;

			}
		}
	
	</style>
</head>
<body>
	<section class="contenido">
		<div class="container">
			<div class="row">			
                
				<div class="col-3">
                    @if($id_video>=1)
					<a href="{{url('')}}/leccion/lc-1/">
						<img src="{{url('')}}/assets-marketing/img/video1.jpg" style="width: 100%;">
					</a>
                    @endif
				</div>
                
				<div class="col-3">
                    @if($id_video>=2)
					<a href="{{url('')}}/leccion/lc-2/">
						<img src="{{url('')}}/assets-marketing/img/video2.jpg" style="width: 100%;">
					</a>
                    @else
                        <img src="{{url('')}}/assets-marketing/img/video2.jpg" style="width: 100%;   -webkit-filter: grayscale(100%); filter: grayscale(100%);">
                    @endif


				</div>
				<div class="col-3">
                    @if($id_video>=3)
					<a href="{{url('')}}/leccion/lc-3/">
						<img src="{{url('')}}/assets-marketing/img/video3.jpg" style="width: 100%;">
					</a>
                    @else
                        <img src="{{url('')}}/assets-marketing/img/video3.jpg" style="width: 100%;   -webkit-filter: grayscale(100%); filter: grayscale(100%);">
                    @endif
				</div>
				<div class="col-3">
                    @if($id_video>=4)
                    <a href="{{url('')}}/leccion/lc-4/">
						<img src="{{url('')}}/assets-marketing/img/video4.jpg" style="width: 100%;">
					</a>			
                    @else
                        <img src="{{url('')}}/assets-marketing/img/video4.jpg" style="width: 100%;   -webkit-filter: grayscale(100%); filter: grayscale(100%);">
                    @endif
				</div>				
			
			</div>
			<div class="row">
				<div class="col-md-12" style="border-bottom: 1px solid #fff; padding-bottom: 25px; margin-top: 25px;">
					<center>
						<h1>Leccion No. {{$id_video}}</h1>
						<h3 style="color: #fff;">{{$titulo_video}}</h3>
					</center>					
				</div>

			</div>
			<div class="row">
				
				<div class="col-md-8 offset-md-2">					

					<div class="embed-responsive embed-responsive-16by9 containvideo">
					  <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/{{$codigo_video}}?rel=0" allowfullscreen></iframe>
					</div>	
					<hr>


					<br />
					<br />

					<center>
						<h2 style="color:#fff;">Descargar Reporte</h2>	
						<a class="btn btn-warning btn-lg btn-wk" href="{{url('')}}/leccion-{{$id_video}}.pdf" target="_blank" style="white-space: normal;">
							 Descargar PDF
						</a>
					</center>

				</div>
			
				
			</div>
		</div>
	</section>

	<section class="contenido-videos">
		<div class="container">
			<div class="row">
				<div  class="col-md-12">
					<center>
						<span class="subtitulo-videos">Deja tu comentario abajo.</span>
					</center>
				</div>
				
			</div>


			<div class="row" style="margin-top: 20px;">
				<div class="col-md-12" style="padding: 15px; text-align: center;">
				

				<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = 'https://connect.facebook.net/es_LA/sdk.js#xfbml=1&version=v3.2&appId=1428940870769958&autoLogAppEvents=1';
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

<div class="fb-comments" data-href="{{url('')}}/leccion/{{$slug_leccion}}" data-width="100%" data-numposts="40"></div>



				</div>
			</div>
			
		</div>
	</section>


	

	<section class="contenido-videos" style="padding: 15px 0px;">
		<div class="container">
			<div class="row">
				<div class="col-md-12" style="color: #767676; font-size: 20px; text-align: center;">
					<p> &copy; Docttus.com 2021 - <a href="{{url('')}}/politica/politicas-de-privacidad" target="_blank">Aviso Legal</a></p>
				</div>
			</div>
		</div>
	</section>







	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>


	<script>
// Set the date we're counting down to
var countDownDate = new Date("Nov 30, 2018 15:37:25").getTime();

// Update the count down every 1 second
var x = setInterval(function() {

  // Get todays date and time
  var now = new Date().getTime();

  // Find the distance between now and the count down date
  var distance = countDownDate - now;

  // Time calculations for days, hours, minutes and seconds
  var days = Math.floor(distance / (1000 * 60 * 60 * 24));
  var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
  var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
  var seconds = Math.floor((distance % (1000 * 60)) / 1000);

  // Display the result in the element with id="demo"
  document.getElementById("reloj").innerHTML = days + "d " + hours + "h "
  + minutes + "m " + seconds + "s ";

  // If the count down is finished, write some text 
  if (distance < 0) {
    clearInterval(x);
    document.getElementById("reloj").innerHTML = "EXPIRED";
  }
}, 1000);
</script>

</body>
</html>