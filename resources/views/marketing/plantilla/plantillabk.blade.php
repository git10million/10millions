<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;
use App\Quotation;

$curso_controller = new CursoController();
$arra_categoria=$curso_controller->get_categorias(1);
$arra_subcategorias=$curso_controller->get_subcategorias(1);


$active_menu_1="";
$active_menu_2="";
$active_menu_3="";

if($id_pagina=="index"){
	$active_menu_1="active";
}

if($id_pagina=="subcategoria" || $id_pagina=="cursos" ){
	$active_menu_2="active";
}

$controller = new AdminController();
$arra_data_usuario=$controller->VerificarSesid();


?>

<!DOCTYPE html>
<html lang="es">
<head>
	<title>Docttus | Aprende con los mejores.</title>
	<meta charset="UTF-8">
	<meta name="description" content="Docttus | Cursos Online de Marketing digital y Coach">
	<meta name="keywords" content="music, html">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	
	<!-- Favicon -->
	<link rel="icon" type="image/png" href="{{url('')}}/assets-marketing/images/favicon.png">

	<!-- Google font -->
	<link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900&display=swap" rel="stylesheet">	
 
	<!-- Stylesheets -->
	<link rel="stylesheet" href="{{url('')}}/assets-marketing/css/bootstrap.min.css"/>
	<link rel="stylesheet" href="{{url('')}}/assets-marketing/css/font-awesome.min.css"/>
	<link rel="stylesheet" href="{{url('')}}/assets-marketing/css/owl.carousel.min.css"/>
	<link rel="stylesheet" href="{{url('')}}/assets-marketing/css/slicknav.min.css"/>


	<!-- Main Stylesheets -->
	<link rel="stylesheet" href="{{url('')}}/assets-marketing/css/style.css"/>


	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->

	<style type="text/css">

	h1{
		color:#222;		
	}

	.concept-item{
		border-radius: 9px;
		padding:25px;
		cursor: pointer;
	}

	.concept-item:hover{
		background-color: #F95850;
		border-radius: 9px;
		padding:25px;
		color: #fff !important;
	}

	.concept-item:hover h5{
	
		color: #fff !important;
	}

	.card-docttus{
          background-color: #fff;
          border-radius: 9px;
          padding: 25px;          
          box-shadow: 0px 0 7px 0px #ecebeb;
          position: relative;
      }

      .botones-docttus{
        background-color: #F95850;
        border-radius: 28px;
        border: none;
        font-size: 16px;        
        display: inline-block;
        width: auto;
        padding-left: 25px;
        padding-right: 25px;
        color: #fff;
      }

      .card-docttus-left{
         height: 512px;
      }

      .card-docttus-right-1{
        height: 247px;
      }
      .card-docttus-right-2{
        height: 247px;
        margin-top: 20px;
      }

      .card-docttus-cursos{
         height: 245px;
      }
      .estrella{
      	color:#e8ae00;
		margin-right: 0px;
      }
	</style>

	@yield('cabecera')

</head>
<body>
	<!-- Header section -->
	<header class="header-docttus clearfix">
		
		<div class="container" style="margin-top: 20px;">
			<div class="row">
				<div class="col-md-5 col-6">	
					<a href="{{url('')}}">
						<img class="logo_docttus" src="{{url('')}}/assets-marketing/images/nuevo_logo_docttus.png">	
						<button type="button" id="btn_categoria" class="btn btn-info btn-categorias"><i class="fa fa-th" aria-hidden="true"></i> Categorías</button>
					</a>					
				</div>
				<div class="col-md-7 col-6" style="text-align: right;">
					<ul class="main-menu">
						<li><a href="{{url('')}}" class="{{$active_menu_1}}">Inicio</a></li>						
						<li><a href="{{url('')}}/cursos-docttus" class="{{$active_menu_2}}">Cursos</a></li>
						@if(count($arra_data_usuario)==0)
						<li><a href="{{url('')}}/login">Login</a></li>
						<li><a href="{{url('')}}/registro" style="border: 1px solid #ffff; border-radius: 9px;">Registro</a></li>
						@endif
						<a href="#"  data-toggle="modal" data-target="#modal_search" class="boton-buscar"><i class="fa fa-search" aria-hidden="true"></i></a>					
						@if(count($arra_data_usuario)!=0)
						<li><a style="width:35px;" href="{{url('')}}/backoffice"><div style="width: 35px; height: 35px; 
    display: inline-block; margin-right: 5px; border-radius: 25px; position: absolute; top: -14px; left: 9px; background-position: center; background-size: cover; background-repeat: no-repeat; background-image: url({{url('')}}/assets/images/usuarios/{{$arra_data_usuario[0]->FotoPersona}});"></div></a></li>
						@endif
					</ul>

					<div class="menu_principal_mobile">
					    <button class="btn_menu_mobile"  data-toggle="modal" data-target="#modal_menu">
					    	<i class="fa fa-bars" aria-hidden="true"></i>
					    </button>

						</div>




					</div>
					
				</div>
				
			</div>


			<div class="contain-categoria">
				<div class="container">
					<div class="col-md-12">

						@foreach($arra_categoria as $categoria)
							<a href="#" class="enlace-categoria" id="cate_{{$categoria->IdCategoriaCursos}}">
								<img src="{{url('')}}/assets-marketing/categorias/{{$categoria->ImagenCategoria}}"> 
								<span> {{$categoria->NombreCategoria}}</span>
							</a>	
						@endforeach						
						
					</div>
				</div>				
			</div>

			<div class="contain-subcatagorias">		
				<div class="container">
					<div class="row">
						<div class="col-md-12" style="text-align: center;" id="listado-subcategorias" >
							
								
							
						</div>
					</div>
				</div>			
			</div>


			<div class="remove-subcategoria">
				
			</div>


		</div>

		
	</header>
	<!-- Header section end -->

<!-- Modal -->
<div class="modal fade" id="modal_menu" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">

  	 <div class="modal-content" style="border:none;     height: 98vh;">

	  	<div class="modal-body"  style="width: 100%; padding: 35px; background: #062b44;">
	     <div>

			<a href="#" style="display: none;" id="btn_atras_categoria">
				<i style="font-size: 25px; color: #fff; float: left; position: absolute; top: 15px; left: 15px;" class="fa fa-chevron-left" aria-hidden="true"></i>
			</a>

			
			<img style="width: 122px; position: absolute; top: 10px; left: 50%; margin-left: -61px; " src="{{url('')}}/assets-marketing/images/nuevo_logo_docttus.png">	


			<a href="#" data-dismiss="modal" aria-label="Close" >
				<i style="font-size: 25px; color: #fff; float: right; position: absolute; top: 15px; right: 15px;" class="fa fa-times" aria-hidden="true"></i>
			</a>

			<ul class="menu_mobile" id="menu_mobile_principal">
				<li><a href="{{url('')}}" class="active">Inicio</a></li>
				<li><a href="{{url('')}}/acerca-de-nosotros">Acerca</a></li>
				<li><a href="{{url('')}}/cursos-docttus">Cursos</a></li>
				<li><a href="{{url('')}}/blog">Blog</a></li>
				<li><a href="{{url('')}}/contactenos">Contactenos</a></li>
				<li><a href="{{url('')}}/login">Login</a></li>
				<li><a href="#" id="btn_categoria_mobile">Categorías</a></li>
				<li><a href="#"  data-dismiss="modal" aria-label="Close" class="boton"  data-toggle="modal" data-target="#modal_search" ><i class="fa fa-search" aria-hidden="true"></i></a></li>
			</ul>

			<div style="width: 100%;  padding-top: 45px; display: none;"  id="menu_mobile_categorias">
				
				<div class="accordion" id="accordion_mobile">						
						<ul class="list-group list-group-flush">
						@foreach($arra_categoria as $categoria)
						  	<li class="list-group-item" style="font-size: 13px; background-color: transparent; padding-left: 0px; padding-right: 0px;">
						  		<button type="button" data-toggle="collapse" data-target="#collapse_m_{{$categoria->IdCategoriaCursos}}" aria-expanded="true" aria-controls="collapse_m_{{$categoria->IdCategoriaCursos}}" style="width: 100%;text-align: left;background: transparent; border: none; color:#fff;">
						  			<img style="width: 20px; margin-right: 0px; margin-top: -5px;" src="{{url('')}}/assets-marketing/categorias/{{$categoria->ImagenCategoria}}"> {{$categoria->NombreCategoria}}
						  		</button>
								
								

								<div id="collapse_m_{{$categoria->IdCategoriaCursos}}" class="collapse" aria-labelledby="headingOne" data-parent="#accordion_mobile">
							      
							        <ul class="list-group list-group-flush" style="margin-top: 5px;  background-color: transparent;">
							        	@foreach($arra_subcategorias as $subcat)
							        		@if($subcat->IdCategoria==$categoria->IdCategoriaCursos)
											
											<?php
											$color_bg_subcategoria="#0b558621;";
											if($id_pagina=="subcategoria"){

												if($id_subcategoria == $subcat->IdSubcategoria){
													$color_bg_subcategoria="#0b55867d;";
												}

											}

											?>
											

											<li class="list-group-item" style=" font-size: 12px; background-color: {{$color_bg_subcategoria}};  padding-left: 20px;">
												<a style="text-decoration: none; color: #fff;" href="{{url('')}}/categoria/{{$subcat->SlugSubcategoria}}">
												<img style="width: 16px; margin-right: 3px; margin-top: -2px;" src="{{url('')}}/assets-marketing/categorias/{{$subcat->IconoSucategoria}}"> {{$subcat->NombreSubcategoria}}		
												</a>
							        		</li>	
							        		@endif
										@endforeach
							        </ul>
							    </div>

						  	</li>
						@endforeach						
						</ul>

					</div>	

			</div>



	     </div>
	    </div>
	 </div>
  </div>
</div>
<!-- Menu Modal -->

	<!-- Modal -->
	<div class="modal fade" id="modal_search" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
	  <div class="modal-dialog modal-dialog-centered" role="document">
	    <div class="modal-content" style="background-color: transparent; border:none;">	      
	      <div class="modal-body" style="margin-top: -130px;">
	        
	        <form action="{{url('')}}/cursos-docttus" method="get" id="form_searh_modal" style="background-color: #083d60e8; padding: 22px;  border-radius: 5px;">

				<center>
					<h3 style="color:#fff; margin-bottom: 15px; text-shadow: 1px 1px 1px #000;">Busca un curso que quieras empezar a estudiar.</h3>
				</center>

				<div class="input-group mb-3 contenedor-busqueda-filtro">
				  <input type="text" class="form-control" value="" placeholder="" aria-describedby="basic-addon2" name="key">
				  <div class="input-group-append">
				    <span class="input-group-text" id="btnsearchfiltro_modal">
				    	<i class="fa fa-search" aria-hidden="true"></i>
				    </span>
				  </div>
				</div>
			</form>

	      </div>	      
	    </div>
	  </div>
	</div>


	@yield('contenido')

	<!-- Footer section -->
	<footer class="footer-section">
		<div class="container">
			<div class="row">
				<div class="col-xl-6 col-lg-7 order-lg-2">
					<div class="row">
						<div class="col-sm-6">
							<div class="footer-widget">
								<h2>Menú</h2>
								<ul>
									<li><a href="{{url('')}}">Inicio</a></li>
									<li><a href="{{url('')}}/acerca-de-nosotros">Acerca de Nosotros</a></li>
									<li><a href="{{url('')}}/cursos-docttus">Cursos Disponibles</a></li>
									<li><a href="{{url('')}}/blog">Blog y Noticias</a></li>									
								</ul>
							</div>
						</div>

						<div class="col-sm-6">
							<div class="footer-widget">
								<h2>Políticas y Términos</h2>
								<ul>
									<li><a href="{{url('')}}/politicas-de-privacidad">Políticas de Privacidad</a></li>
									<li><a href="{{url('')}}/terminos-de-uso">Términos de Uso</a></li>
									<li><a href="{{url('')}}/politicas-de-cookies">Políticas de Cookies</a></li>
									<li><a href="{{url('')}}/afiliados">Afiliados</a></li>
									<li><a href="{{url('')}}/contactenos">Contactenos</a></li>
								</ul>
							</div>
						</div>
						
						
					</div>
				</div>
				
				<div class="col-xl-6 col-lg-5 order-lg-1">

					<img src="{{url('')}}/assets-marketing/images/nuevo_logo_docttus.png" style="height: 90px;" alt="">
					<p style="color: #fff; font-weight: 300; margin-top: 20px;">Soluciones Innovadoras para el Éxito. Explore nuevas habilidades, profundice las pasiones existentes y piérdase en la creatividad. Lo que encuentre puede sorprenderlo e inspirarlo.</p>

					<div class="social-links">
						<a href=""><i class="fa fa-instagram"></i></a>						
						<a href=""><i class="fa fa-facebook"></i></a>
						<a href=""><i class="fa fa-twitter"></i></a>
						<a href=""><i class="fa fa-youtube"></i></a>
					</div>
				</div>


			</div>
		</div>
	</footer>
	<section class="barra-inferior" style="width: 100%; background-color: #285d8f; padding:10px;">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<span style="color: #fff;">© 2020 Docttus. Todos los derechos reservados.</span>
				</div>
			</div>
		</div>
	</section>





	
	<div class="modal fade" id="modal_registro" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
	    <div class="modal-content" style="background: #0B5586; border-radius: 20px;">	      
	      <div class="modal-body" style="padding-top: 25px;">
	      		<div class="row">

	      			<div class="col-md-12">
	      				<h2 style="color: #fff; font-size: 40px; text-align: center; font-weight: 300; margin-bottom: 20px;">Regístrate Ahora, y recibe un Curso Totalmente <strong>Gratis</strong></h2>
	      			</div>

	      			<hr>

					<div class="col-md-6">

						<div class="embed-responsive embed-responsive-4by3">
							<iframe class="embed-responsive-item"  src="https://www.youtube.com/embed/ARQHbSfa3EE" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
						</div>

					</div>

	      			<div class="col-md-6">
				      		<small style="color: #fff; text-align: center; width: 100%;     display: inline-block; font-style: italic;">
				          	  	Ingresa ahora a Docttus para que empieces tu proceso de capacitación con nosotros, escoge 1 de nuestros cursos gratuitos y empieza con el pie derecho tu proceso de educación online.
				          	  </small>

				          	  <button class="btn-docttus-web-fb" style="margin-top: 14px; width: 100%;"><i class="fa fa-facebook" aria-hidden="true"></i> Continúa con Facebook</button>
		                      <br />
		                     <button class="btn-docttus-web-google" style="margin-top: 14px; width: 100%;"><i class="fa fa-google" aria-hidden="true"></i> Continúa con Google</button>

		                      <center>
		                       <p style="margin-top: 15px; margin-bottom: 15px; color: #fff;">o continúa con</p>
		                     </center>




				          <form id="frm_registro" style="margin-top: 15px;">
				          	
				          	 <input type="usuario" name="" class="form-control" placeholder="Usuario Docttus" id="txtusuario_modal">
				          	 <input type="email" name="" class="form-control" placeholder="Email" id="txtemail_modal" >
				          	 <input type="password" name="" class="form-control" placeholder="Password" id="txtpassword_modal">
				          	  <small style="color: #fff; text-align: center; width: 100%;     display: inline-block; font-style: italic;">
				          	  	Al registrarte aceptas nuestros <a style="color:#fff;" href="{{url('')}}/politicas-de-privacidad">Términos y Políticas de Privacidad</a>
				          	  </small>
			                  <center>
			                  	<button type="submit" class="btn-docttus-web-sm" style="margin-top: 25px; margin-bottom: 25px;">REGISTRARSE</button>
			                  </center>

				          </form>
	      			</div>


	      		</div>
	      	  
	      </div>	      
	    </div>
	  </div>
	</div>


	<!-- Modal Mensaje Generico -->
    <div class="modal fade" id="mensaje_generico" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
        <div class="modal-content">
          <!--<div class="modal-header">            
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>-->
          <div class="modal-body">
            <div class="row">
              <div class="col-md-12">
                <center>  
                   <img src="{{url('')}}/assets/images/check_mensaje.png" class="icono-mensaje-1">
                   <img src="{{url('')}}/assets/images/error_mensaje.png" class="icono-mensaje-2">
                </center>
              </div>
              <div class="col-md-12">
                <center>  
                  <h2 class="titulo-mensaje">Bienvenido!</h2>
                  <p class="descripcion-mensaje">Has ingresado correctamente</p>
                </center>
              </div>
              <div class="col-md-12">
                <center>  
                  <button type="button" class="btn btn-success btn-mensajes btn-continuar" data-dismiss="modal">Continuar</button>   
                </center>
              </div>
            </div>              
          </div>

        </div>
      </div>
    </div>
    <!-- fin MODAL Mensaje Generico -->




	<!-- Footer section end -->
	
	<!--====== Javascripts & Jquery ======-->
	<script src="{{url('')}}/assets-marketing/js/jquery-3.2.1.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>

	<script src="{{url('')}}/assets-marketing/js/bootstrap.min.js"></script>
	<script src="{{url('')}}/assets-marketing/js/jquery.slicknav.min.js"></script>
	<script src="{{url('')}}/assets-marketing/js/owl.carousel.min.js"></script>
	<script src="{{url('')}}/assets-marketing/js/mixitup.min.js"></script>
	<script src="{{url('')}}/assets-marketing/js/main.js"></script>

	<script src="//code.tidio.co/ulra00gr9tvvrf2cjia2x7e2xhikormn.js" async></script>

	@yield('scripts')

	<script type="text/javascript">
		var band_cat=0;
		$(".contain-subcatagorias").hide();
		$(".remove-subcategoria").hide();
		$(".contain-categoria").hide();
		var arra_subcategorias=[
		@foreach($arra_subcategorias as $categoria)
			{
				"IdSubcategoria":"{{$categoria->IdSubcategoria}}",
				"NombreSubcategoria":"{{$categoria->NombreSubcategoria}}",
				"IdCategoria":"{{$categoria->IdCategoria}}",
				"SlugSubcategoria":"{{$categoria->SlugSubcategoria}}",
				"IconoSucategoria":"{{$categoria->IconoSucategoria}}"

			},
		@endforeach
		];

		$(".header-docttus").attr("style","background-color:#0B5586;");			

		$("#btn_atras_categoria").click(function(){
			$("#menu_mobile_categorias").hide("fast");
			$("#menu_mobile_principal").show("fast");
			$("#btn_atras_categoria").hide("fast");
		});

		$("#btn_categoria_mobile").click(function(){
			$("#menu_mobile_categorias").show("fast");
			$("#menu_mobile_principal").hide("fast");
			$("#btn_atras_categoria").show("fast");
		});

		

		$(window).scroll(function()
		{
			var scroll_top=$("html").scrollTop();
			var width_html=$("html").width();
			band_cat=0;
			
			if(scroll_top>=198){
				$(".header-docttus").attr("style","background-color:#0B5586;");			
				$(".contain-categoria").attr("style","top: 81px;display:none;");	
				$(".contain-subcatagorias").attr("style","top: 134px;display:none;");
				$(".remove-subcategoria").attr("style","top: 251px;display:none;");

				
				if(width_html>991){
					$(".header-docttus > .container").attr("style","margin-top:0px;");
					$(".logo_docttus").attr("style","height: 57px; margin-top: 10px;");
				}else{
					$(".header-docttus").attr("style","background-color:#0B5586;");			
				}
				
				
			}else{
				$(".header-docttus").attr("style","background-color:#0B5586;");				
				$(".contain-categoria").attr("style","top: 112px;display:none;");	
				$(".contain-subcatagorias").attr("style","top: 166px;display:none;");
				$(".remove-subcategoria").attr("style","top: 282px;display:none;");
				if(width_html>991){
					$(".header-docttus > .container").attr("style","margin-top:10px;");
					$(".logo_docttus").attr("style","height: 90px; margin-top: 0px;");
				}else{
					$(".header-docttus").attr("style","background-color:#0B5586;");			
				}				
			}

		});
		
		

		$("#btn_categoria").click(function(e){
			e.preventDefault();
			if(band_cat==0){
				$(".contain-categoria").show();	
				band_cat=1;
			}else{
				$(".contain-categoria").hide();	
				$(".contain-subcatagorias").hide();
				$(".remove-subcategoria").hide();
				band_cat=0;
			}
			
		});

		$(".enlace-categoria").hover(function(e){
			$(".contain-subcatagorias").show();
			$(".remove-subcategoria").show();
			var objeto_t=e.currentTarget;
			var id_componente=""+objeto_t.id;
			var arra_componente=id_componente.split("_");
			var id_final=arra_componente[1];
			var cadena_subcategorias="";


			for(var i=0;i<arra_subcategorias.length;i++){
				if(""+id_final==""+arra_subcategorias[i].IdCategoria){					
					cadena_subcategorias+='<a href="{{url('')}}/categoria/'+arra_subcategorias[i].SlugSubcategoria+'" class="btn-subcategoria">';
					cadena_subcategorias+='    <center>';
					cadena_subcategorias+='       <img src="{{url('')}}/assets-marketing/categorias/'+arra_subcategorias[i].IconoSucategoria+'" style="width: 45px;"><br/>';
					cadena_subcategorias+='       <span> '+arra_subcategorias[i].NombreSubcategoria+'</span>';
					cadena_subcategorias+='    </center>';
					cadena_subcategorias+='</a>';					

				}
			}
			$("#listado-subcategorias").html(cadena_subcategorias);
		});

		//QUITAR SUBCATEGORIAS DEL MENU
		$(".remove-subcategoria").hover(function(e){			
			$(".contain-subcatagorias").hide();
			$(".remove-subcategoria").hide();
		});

		$("#btnsearchfiltro_modal").click(function(e){
			$("#form_searh_modal").submit();
		});

	


		 function mensaje_generico(titulo,descripcion,tipo,nombre_boton,funcion_boton){
          if(tipo=="1"){
            $(".icono-mensaje-1").show();
            $(".icono-mensaje-2").hide();
            $(".titulo-mensaje").removeClass("titulo-mensaje-error");
            $(".titulo-mensaje").addClass("titulo-mensaje-exito");            
          }else{
            $(".icono-mensaje-2").show();
            $(".icono-mensaje-1").hide();
            $(".titulo-mensaje").removeClass("titulo-mensaje-exito");
            $(".titulo-mensaje").addClass("titulo-mensaje-error");
            
          }

          $(".titulo-mensaje").html(""+titulo);
          $(".descripcion-mensaje").html(""+descripcion);
          $("#mensaje_generico").modal("show");
          $(".btn-continuar").html(""+nombre_boton);
          $(".btn-continuar").click(function(){
            funcion_boton();  
          });          
      }	


	</script>

	</body>
</html>
