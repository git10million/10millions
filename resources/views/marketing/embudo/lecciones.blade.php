<?php

if (isset($_SERVER['HTTP_ORIGIN'])) {
    header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
    header('Access-Control-Allow-Credentials: true');
    header('Access-Control-Max-Age: 86400');    // cache for 1 day
}

// Access-Control headers are received during OPTIONS requests
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {

    if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS");         

    if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
        header("Access-Control-Allow-Headers:        {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");

    exit(0);
}


ini_set('log_errors','Off');
ini_set('display_errors','Off');
ini_set('error_reporting', E_ALL );





?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Lecciones - Marketing de Afiliados - Docttus</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<link href="https://fonts.googleapis.com/css?family=Oswald|Roboto" rel="stylesheet">
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
			background-color:#0B5586;
		}

		h1{
			color:#fff;
			font-weight: 100;
		}

		.subtitulo{
			color: #fff;
			font-family: 'Roboto', sans-serif;
			font-size: 65px;
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
				<div class="col-md-12" style="border-bottom: 1px solid #fff; padding-bottom: 25px;">
					<center>						
                        <h1>LECCIONES: Descubre <strong style=' color: #ffc107; font-size: 62px;'>El Marketing de Afiliados </strong> y cómo Ganar <strong style=' color: #ffc107; font-size: 62px;'>$1.000 USD </strong> la semana vendiendo productos de otros.</h1>
						<h2 style="color:#fff;">Oprime Ctrl + D para que lo agregues a favorito</h2>
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
						<span class="subtitulo-videos">Ingresa ahora a cada una de las lecciones de este Minicurso, da Click en la imagen y te llevará hacia el enlace con los videos.
					</center>
				</div>
				
			</div>
			

			<div class="row" style="margin-top: 20px;">
				<div class="col-md-6" style="padding: 15px; text-align: center;">
					<a target="_blank" href="{{url('')}}/leccion/lc-1/">
						<img src="{{url('')}}/assets-marketing/img/video1.jpg" style="width:90%; ">
						<h3>1.- Los secretos claves para triunfar en el marketing de afiliados</h3>
					</a>
				</div>

				<div class="col-md-6" style="padding: 15px; text-align: center;">
					<a target="_blank" href="{{url('')}}/leccion/lc-2/">
						<img src="{{url('')}}/assets-marketing/img/video2.jpg" style="width:90%; ">
						<h3>2.- Las 3 formas de Emprender en el Marketing de Afiliados</h3>
					</a>
				</div>
			</div>

			<div class="row" style="margin-top: 20px;">
				<div class="col-md-6" style="padding: 15px; text-align: center;">
					<a target="_blank" href="{{url('')}}/leccion/lc-3/">
						<img src="{{url('')}}/assets-marketing/img/video3.jpg" style="width:90%; ">
						<h3>3.- Caso de estudio para descubrir productos ganadores con el marketing de afiliados</h3>
					</a>
				</div>

				<div class="col-md-6" style="padding: 15px; text-align: center;">
					<a target="_blank" href="{{url('')}}/leccion/lc-4/">
						<img src="{{url('')}}/assets-marketing/img/video4.jpg" style="width:90%; ">
						<h3>4.- El combustible necesario para generar ingresos online.</h3>
					</a>
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


</body>
</html>