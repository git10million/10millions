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



  /*

        'database'  => 'aediegfi_lizeth',
      'username'  => 'aediegfi_admin',
      'password'  => 'Pixel@03',
	

mysql> desc embudo_prospectos;
+---------------------+--------------+------+-----+---------+----------------+
| Field               | Type         | Null | Key | Default | Extra          |
+---------------------+--------------+------+-----+---------+----------------+
| idembudo_prospectos | int(11)      | NO   | PRI | NULL    | auto_increment |
| nombre              | varchar(255) | YES  |     | NULL    |                |
| email               | varchar(255) | YES  |     | NULL    |                |
| IdUsuario           | int(11)      | YES  |     | NULL    |                |
| fechaRegistro       | datetime     | YES  |     | NULL    |                |
+---------------------+--------------+------+-----+---------+----------------+



  */

	


?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Gracias</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<link href="https://fonts.googleapis.com/css?family=Oswald|Roboto" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">




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
						<h1><strong>Gracias!!!</strong></h1>
					</center>					
				</div>

			</div>
			<div class="row">
				
				<div class="col-md-12">
					<center>
						<h2 class="subtitulo">El acceso a las lecciones ya <strong> va de camino </strong></h2>
						<p style="color: #fff; font-family: 'Roboto', sans-serif; font-size: 28px; margin-top: 35px;">
							<strong>Importante:</strong> Los videos han sido enviados a tu bandeja de entrada ve ahora y revisa para verlos.<br />
							Recuerda si no aparecen en tu bandeja de entrada revisa en Spam y pon que si es seguro. Si no están en tu bandeja de entrada espera 10 minutos o comunicate con info@docttus.com
						</p>
						<br />
						<a class="btn btn-info btn-lg" href="https://t.me/docttus" target="_blank" style="white-space: normal; font-size: 35px; background-color: rgb(66, 103, 178) !important;">
							<i class="fa fa-telegram" aria-hidden="true"></i> ENTRA AL CANAL DE TELEGRAM
						</a>
						<br />

						
						<div class="row">
				
							<div class="col-md-8 offset-md-2">
								<div class="embed-responsive embed-responsive-16by9 containvideo">
								  <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/dbxgeKxJ3oE?rel=0" allowfullscreen></iframe>
								</div>	
							</div>


						</div>
						



						<p style="color: #fff; font-family: 'Roboto', sans-serif; font-size: 28px; margin-top: 35px;">Hemos creado un <strong>Canal de Telegram</strong> en el que añadiremos <strong>contenido extra</strong> para ayudarte a poner en práctica con <strong>ejemplos reales</strong> lo que te cuento en los vídeos de manera resumida.</p>

						<p style="color: #fff; font-family: 'Roboto', sans-serif; font-size: 28px; margin-top: 35px;">Entra ahora y ponte en marcha. <strong> De nada sirve acumular vídeos</strong> o enlaces si luego <strong>no lo llevas a la práctica.</strong> ¡Déjame ayudarte!</p>

						<br />
						<a class="btn btn-info btn-lg" href="https://t.me/docttus" target="_blank"  style="white-space: normal; font-size: 35px; background-color: rgb(66, 103, 178) !important;">
							<i class="fa fa-telegram" aria-hidden="true"></i> ENTRA AL CANAL DE TELEGRAM
						</a>
						<br />
					</center>
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