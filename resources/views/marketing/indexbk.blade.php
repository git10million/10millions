<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;
use App\Quotation;
$id_pagina="index";

$curso_controller = new CursoController();
$arra_categoria=$curso_controller->get_categorias(1);
$arra_subcategorias=$curso_controller->get_subcategorias(1);

?>

@extends('marketing.plantilla.plantilla')

@section('cabecera')
<style type="text/css">
	.section-header{
		width: 100%;
		background-image: url(/assets-marketing/images/fondo-slide.jpg); 
		background-position: bottom center; 
		background-size:cover; 
		height: auto; 
		padding-bottom: 246px;
    	padding-top: 234px;
	}

	.section-header h2 {
		color: #fff;
		font-weight: 100;
		font-size: 18px;
		margin: 0px;
		padding: 0px;
		margin-bottom: 35px;
		letter-spacing: 5px;
	}

	.section-header h1 {
	    color: #fff;
	    font-weight: 100;
	    font-size: 50px;
	}

	.section-header h1 strong {
	    font-weight: 900;
	}

	.section-header h3 {
	    color: #fff;
	    margin-top: 25px;
	    font-weight: 100;
	    font-size: 25px;
	}

	.btn-docttus-web{
		margin-top: 25px;
	}

	.cohete{
		position: absolute;
	    width: 128px;
	    bottom: -280px;
	    transform: rotateZ(13deg);
	    right: 125px;
	}

	@media only screen and (max-width: 991px) {
		.cohete{
			display: none;
		}
	}
</style>
@stop

@section('contenido')   
	
	<section class="section-header">
		<div class="container">
			<div class="row">
				<div class="col-md-8">
					<h2><i class="fa fa-circle icono-subtitulo" aria-hidden="true"></i>ORGANIZACIÓN DE EDUCACIÓN Y FORMACIÓN<i class="icono-subtitulo fa fa-circle" aria-hidden="true"></i></h2>
					<h1>Soluciones <strong>Innovadoras</strong> para el <strong>Éxito.</strong></h1>
					<h3>Ingresa tus datos ahora a nuestra comunidad <strong>Docttus</strong> y recibe 1 curso Gratis</h3>
									
					<div class="container-boton-slide">
						<button class="btn-docttus-web"  data-toggle="modal" data-target="#modal_registro">INGRESA AHORA GRATIS</button>
					</div>	
				</div>

				<div class="col-md-4" style="position: relative;">
					<img src="{{url('')}}/assets-marketing/images/cohete_docttus.png" class="cohete">	
				</div>
			</div>
		</div>
	</section>


	<section class="seccion-blanca">
		<div class="container">
			<div class="row">
				<div class="col-md-3" style="border-right: 1px solid #ccc;">
					<div class="row">
						<div style="width: 54px; display: inline-block;  margin-left: 45px;">
							<img src="{{url('')}}/assets-marketing/images/icon-1.png">
						</div>
						<div class="col">
							<h3>1,500</h3>
							<p style="padding: 0px; margin: 0px;">Cursos Online</p>
						</div>	
					</div>
				</div>


				<div class="col-md-3" style="border-right: 1px solid #ccc;">
					<div class="row">
						<div style="width: 71px; display: inline-block; margin-left: 25px;">
							<img src="{{url('')}}/assets-marketing/images/icon-2.png">
						</div>
						<div class="col">
							<h3>120</h3>
							<p style="padding: 0px; margin: 0px;">Instructores Expertos</p>
						</div>	
					</div>
				</div>


				<div class="col-md-3" style="border-right: 1px solid #ccc; ">
					<div class="row">
						<div style="width: 45px; display: inline-block;  margin-left: 39px;">
							<img src="{{url('')}}/assets-marketing/images/icon-3.png" style="width: 40px;">
						</div>
						<div class="col">
							<h3>Ilimitado</h3>
							<p style="padding: 0px; margin: 0px;">Acceso a Cursos</p>
						</div>	
					</div>
				</div>


				<div class="col-md-3" style="">
					<div class="row">
						<div style="width: 51px; display: inline-block;  margin-left: 25px;">
							<img src="{{url('')}}/assets-marketing/images/icon-4.png" style="width: 51px;">
						</div>
						<div class="col">
							<h3>Aprende</h3>
							<p style="padding: 0px; margin: 0px;">Desde cualquier lado</p>
						</div>	
					</div>
				</div>


			</div>
		</div>
	</section>

	
	<section class="seccion-blanca">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<h2 class="subtitulo-principal">APRENDE UNA NUEVA HABILIDAD</h2>
					<h3 class="titulo-principal" style="margin-top: -20px;">Cursos <span>Destacados</span></h3>
				</div>
			</div>

			
			@include('marketing.component.cursos')


			
		</div>
	</section>

	<section class="seccion-gris" style="background-color: #285d8f; width: 100%; padding-top: 56px;  padding-bottom: 21px;">
		<div class="container">
			<div class="row">

			</div>
			<div class="row">
				<div class="col-md-4" style="text-align: center; color: #fff;">
					<div style="display: inline-block; height: 90px; width: 90px; background-color: #fff; border-radius: 50px; text-align: center; ">	
					    <i class="fa fa-building" style="    color: #285d8f; font-size: 40px; margin-top: 23px;"></i>	
					</div>
					<h3 style="font-size: 20px; color: #fff; margin-top: 15px;">Los mejores líderes de la industria</h3>
					<p style="margin-top:5px; color: #fff;font-size: 15px;font-weight: 400;line-height: 22px;">Nos enorgullecemos de proporcionar el mejor sistema de  aprendizaje para latinoamerica.</p>
				</div>

				<div class="col-md-4" style="text-align: center; color: #fff;">
					<div style="display: inline-block; height: 90px; width: 90px; background-color: #fff; border-radius: 50px; text-align: center; ">	
					    <i class="fa fa-book" style="    color: #285d8f; font-size: 40px; margin-top: 23px;"></i>	
					</div>
					<h3 style="font-size: 20px; color: #fff; margin-top: 15px;">Aprenda cualquier cosa en línea</h3>
					<p style="margin-top:5px; color: #fff;font-size: 15px;font-weight: 400;line-height: 22px;">¿Quieres vender tus cursos en línea y que el mundo sepa de ti? ¡Elíjanos!</p>
				</div>

				<div class="col-md-4">
					<img src="{{url('')}}/assets-marketing/images/images-book.png" style="width: 100%; margin-top: -98px;  margin-bottom: -130px;">
				</div>
			</div>
		</div>
	</section>


	<section class="seccion-gris" style="background-color: #F7F7F7; width: 100%; padding-top: 80px; padding-bottom: 80px;">
		<div class="container">
			<div class="row">
				<div class="col-md-6">
					<img src="{{url('')}}/assets-marketing/images/elearning.png" style="width: 100%; margin-top: 100px;">
				</div>

				<div class="col-md-6">

					<h2 class="subtitulo-principal">ALGO DE NOSOTROS</h2>
					<h3 class="titulo-principal" style="margin-top: -20px;"> <span>En</span> Docttus <span> damos a conocer cientos de cursos para la  </span>Nueva Economía.</h3>

					<h4 style="margin-top: 25px;  line-height: 35px;">Nos tomamos en serio nuestra misión de aumentar el acceso global a una educación de calidad. Conectamos a los alumnos con las mejores tutores de todo el mundo.</h4>
					<hr>

					<table style="margin-top: 45px;">
						<tr>
							<td style="line-height: 25px;"><span style="font-size: 42px;color: #28e4c5; margin-right: 12px;">•</span></td>
							<td style="line-height: 25px;font-weight: 500; font-size: 18px;">Cada tutor Docttus, compartirá nus mejores conocimientos contigo.</td>
						</tr>

						<tr>
							<td style="line-height: 25px;"><span style="font-size: 42px;color: #28e4c5; margin-right: 12px;">•</span></td>
							<td style="line-height: 25px;font-weight: 500; font-size: 18px;">No perderás ningún detalle, ya que las clases están en Videos de Máxima Calidad para que no te pierdas de nada</td>
						</tr>

						<tr>
							<td style="line-height: 25px;"><span style="font-size: 42px;color: #28e4c5; margin-right: 12px;">•</span></td>
							<td style="line-height: 25px;font-weight: 500; font-size: 18px;">Nuestra misión es llevar educación de calidad alrededor del mundo.</td>
						</tr>

						<tr>
							<td style="line-height: 25px;"><span style="font-size: 42px;color: #28e4c5; margin-right: 12px;">•</span></td>
							<td style="line-height: 25px;font-weight: 500; font-size: 18px;">Cuando quieras y donde quieras. Sin horarios, podrás disfrutar del contenido a cualquier hora del día y con acceso ilimitado.</td>
						</tr>
					</table>



					<button class="btn-docttus-web"  data-toggle="modal" data-target="#modal_registro">INGRESA AHORA GRATIS</button>


	

				</div>
			</div>
		</div>
		
	</section>

	
	



@stop

@section('scripts')
<script type="text/javascript">
      $("#btn_olvidaste_password").click(function(e){        
        e.preventDefault();
        $("#form_login_olvido").show();
        $("#form_login").hide();
      });

      $("#btn_regresar").click(function(e){        
        e.preventDefault();
        $("#form_login_olvido").hide();
        $("#form_login").show();
      });


      $("#frm_registro").submit(function(e){
        e.preventDefault();
        verificar_login();         
      });

      var myVar;
      var contador_login=5;

      function verificar_login(){
        var txtusuario=$("#txtusuario_modal").val();        
        var txtemail=$("#txtemail_modal").val();
        var txtpassword=$("#txtpassword_modal").val();        
        var txtrolestudiante="";
        var txtrolafiliado="";


        
        txtrolestudiante="1";
        

                
        $IdUsuarioPadre="";//acá va el uso de cockies

        var request = $.ajax({
          url: "{{url('')}}/registrar_usuario",
          type: "POST",
          data:{               
              usuario:txtusuario,              
              email:txtemail,
              password:txtpassword,              
              rolestudiante:"1",
              rolafiliado:"1",
              IdUsuarioPadre:"",                  
              _token: "{{ csrf_token() }}"
          }
        });

        request.done(function(obj) { 
           if(obj.status=="ok"){
              mensaje_generico("Bienvenido "+txtusuario+" !","Has ingresado correctamente","1","<span id='contador_boton'>5 </span> Continuar...",continuar_login);
              myVar = setInterval(myTimer, 1000);              
              return;
           }else{
              mensaje_generico("Error !",""+obj.mensaje,"2","Continuar...",continuar_error);
              return;
           }
        });
         

         //respuesta si falla
        request.fail(function(jqXHR, textStatus) {
          alert( "Error de servidor  " + textStatus );
        });
      }

      


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

      function continuar_login(){
         console.log("siguiente");
         window.open("{{url('')}}/backoffice","_parent");
      }

      function continuar_error(){

      }



      

      function myTimer() {
         contador_login--;
         $("#contador_boton").html(""+contador_login);
         if(contador_login==0){
            myStopFunction();
         }        
      }

      function myStopFunction() {
        clearInterval(myVar);
        window.open("backoffice","_parent");
      }




    </script>

@stop



