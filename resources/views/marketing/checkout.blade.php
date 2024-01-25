<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;
use App\Quotation;
$id_pagina="cursos";


$oper=@$_REQUEST["oper"];
//CERRAR SESIÓN
if($oper=="logout"){
	session(['sesid' => '']);//limpiar sesid
	session(['rol_login' => '']);//limpiar rol login
}

$controller = new AdminController();
$arra_data_usuario=$controller->VerificarSesid();

$controller_login = new LoginController();



$curso->DescripcionTutor = trim(preg_replace('/\s\s+/', ' ', $curso->DescripcionTutor));
$curso->DescripcionCurso = trim(preg_replace('/\s\s+/', ' ', $curso->DescripcionCurso));

if(strlen($curso->DescripcionCurso)>=350){
	//$curso->DescripcionCurso=substr($curso->DescripcionCurso,0,350)."...";
}

$valor_anterior=$curso->PrecioCurso;
$valor_curso_actual=$curso->PrecioCurso;
$descuento_curso=$curso->DescuentoCurso;
$porcentaje_curso=0;

$valor_descuento_curso=($valor_curso_actual*($descuento_curso/100));

$valor_curso_actual=$valor_curso_actual-$valor_descuento_curso;
$porcentaje_curso=$descuento_curso;

if(!$descuento_curso){
	$valor_anterior=0;
}

$valor_impuesto="".$curso->ValorImpuesto;
$nombre_impuesto="".$curso->NombreImpuesto;
$valor_prod_iva=0;
$descuento_producto="";
$valor_base=$valor_anterior-$valor_descuento_curso;

if($curso->ValorImpuesto){
	$valor_prod_iva=($valor_curso_actual*($curso->ValorImpuesto/100));
	$valor_anterior=$valor_anterior+($valor_anterior*($curso->ValorImpuesto/100));
}



$valor_curso_actual=round($valor_curso_actual, 2);

$valor_base=round($valor_base,2);
$valor_prod_iva=round($valor_prod_iva,2);
$valor_curso_actual=$valor_base+$valor_prod_iva;
$valor_curso_actual=round($valor_curso_actual, 2);



$arra_reviews=$curso->reviews;
$cant_reviews=count($arra_reviews);
$promedio_reviews_curso=5;
$suma_valor_reviews=0;

$cantidad_reviews_5=0;
$cantidad_reviews_4=0;
$cantidad_reviews_3=0;
$cantidad_reviews_2=0;
$cantidad_reviews_1=0;

if($cant_reviews>0){
	for($r=0;$r<$cant_reviews;$r++){				
		
		$suma_valor_reviews+=$arra_reviews[$r]->ValorCalificacion;

		if($arra_reviews[$r]->ValorCalificacion==5){
			$cantidad_reviews_5++;
		}

		if($arra_reviews[$r]->ValorCalificacion>=4 && $arra_reviews[$r]->ValorCalificacion<5){
			$cantidad_reviews_4++;
		}

		if($arra_reviews[$r]->ValorCalificacion>=3 && $arra_reviews[$r]->ValorCalificacion<4){
			$cantidad_reviews_3++;
		}

		if($arra_reviews[$r]->ValorCalificacion>=2 && $arra_reviews[$r]->ValorCalificacion<3){
			$cantidad_reviews_2++;
		}

		if($arra_reviews[$r]->ValorCalificacion>=0 && $arra_reviews[$r]->ValorCalificacion<2){
			$cantidad_reviews_1++;
		}

	}
	$promedio_reviews_curso=$suma_valor_reviews/$cant_reviews;	
}				

$porcentaje_reviews_5=0;
$porcentaje_reviews_4=0;
$porcentaje_reviews_3=0;
$porcentaje_reviews_2=0;
$porcentaje_reviews_1=0;

if($cant_reviews>0){
	$porcentaje_reviews_5=($cantidad_reviews_5*100)/$cant_reviews;
	$porcentaje_reviews_4=($cantidad_reviews_4*100)/$cant_reviews;
	$porcentaje_reviews_3=($cantidad_reviews_3*100)/$cant_reviews;
	$porcentaje_reviews_2=($cantidad_reviews_2*100)/$cant_reviews;
	$porcentaje_reviews_1=($cantidad_reviews_1*100)/$cant_reviews;

	$porcentaje_reviews_5=round($porcentaje_reviews_5,0);
	$porcentaje_reviews_4=round($porcentaje_reviews_4,0);
	$porcentaje_reviews_3=round($porcentaje_reviews_3,0);
	$porcentaje_reviews_2=round($porcentaje_reviews_2,0);
	$porcentaje_reviews_1=round($porcentaje_reviews_1,0);	
}





$contador_modulos=0;





?>
@extends('marketing.plantilla.plantilla')
@section('contenido')   
	

<!-- Hero section -->
	<section class="hero-section">
		<div class="hero-slider owl-carousel">			
			<div class="hs-item" style="padding-top:38px; padding-bottom: 80px; height: auto !important; background-position: top center; ">
				<div class="container">
					<div class="row">
						<div class="col-lg-12" style="text-align: center;">							
					
							<h1 style="font-size: 48px; color: #fff; margin-top: 100px;">Adquirir Curso</h1>
				
						</div>						
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- Hero section end -->

	<!-- Intro section -->
	<section class="intro-section spad" style="padding-top: 55px; padding-bottom: 55px;">
		<div class="container">
			<div class="row">				
				<div class="col-md-8">
					@if($curso_comprado=="0")
					<div class="row bar_sup_checkout">
							<div class="col-6 actual" style="border-radius: 9px;">
								<span class="step-number">
									1
								</span>
								<span class="step-text">
									Datos Personales
								</span>
							</div>
							@if(count($arra_data_usuario)==0)
							<div class="col-6 desactive">
							@else
							<div class="col-6 activo">
							@endif
								<span class="step-number">
									2
								</span>
								<span class="step-text">
									Pago
								</span>
							</div>							
							
					</div>
					@endif


					<div class="form_registo_docttus">

					  
					  @if(count($arra_data_usuario)==0)
                      <button class="btn-docttus-web" data-toggle="modal" data-target="#modal_login_checkout"  style="margin-top: 14px;"><i class="fa fa-user-circle" aria-hidden="true"></i> TENGO CUENTA DOCTTUS</button>
					  @else
							
							<div class="row">
								<div class="col-md-12" style="margin-bottom: 10px; text-align: center; margin-bottom: 10px; text-align: center; padding: 25px; background-color: #f5f5f5; border-radius: 9px;">
									<div class="foto_usuario_checkout" style="width: 65px;height: 65px; background-position: center; background-size: cover; border-radius: 45px;background-image: url({{url('')}}/assets/images/usuarios/{{$arra_data_usuario[0]->FotoPersona}}); display: inline-block;">										
									</div>
									<h5>{{$arra_data_usuario[0]->NombrePersona}}</h5>
									<a href="?oper=logout">Cerrar Sesión</a>

									<hr />
									
									@if($curso_comprado=="0")
										@if($valor_curso_actual>0)
										<button class="btn-docttus-web" id="btn_pago">COMPRAR AHORA!</button>
										@else
										<button class="btn-docttus-web" id="btn_pago_free">INSCRIBIRSE AHORA!</button>
										@endif
									@else

									<a href="{{url('')}}/curso/{{$curso->SlugCurso}}"  class="btn-docttus-web"> IR AL CURSO</a>
									
									@endif

									
									

								</div>
								
							</div>

					  @endif

                      

                      <hr>
                      @if(count($arra_data_usuario)==0)
                      <form action="/" class="form-horizontal" method="post" id="formulario_registro">
						<input type="hidden" name="oper" value="register">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">

						
						<input type="hidden" name="IdUsuarioPadre" value="">

						<h3 style="margin-bottom: 25px; margin-top: 35px;">Debes registrarte en docttus para adquirir este curso.</h3>
                        
                    	<input type="text" class="form-control input-docttus" name="usuario" id="txtusuario" placeholder="Nombre de Usuario" required />
                        <input type="email" class="form-control input-docttus" name="email" id="txtemail" placeholder="Email" required />
                        <input type="password" id="txtpassword" name="password" class="form-control input-docttus" placeholder="Contraseña" required />


                        <small style=" width: 100%;     display: inline-block; font-style: italic;">
							Al registrarte aceptas nuestros <a style="" href="{{url('')}}/politicas-de-privacidad">Términos y Políticas de Privacidad</a>
						</small>
						<br/>
						<br/>
							<div class="g-recaptcha" data-sitekey="6LfJwFoaAAAAAPiljxPQbH_MscIMe4rmLyC7y3zs"></div>
						<br/>

						<br/>
                        <button class="btn-docttus-web" style="margin-top: 14px;"><i class="fa fa-save" aria-hidden="true"></i> CREAR CUENTA</button>                        

						
						<hr>
						
						
                                                  
                      </form> 
                      @endif
					  <div class="row">

						

						<div class="col-md-8">
							<small style="font-size: 10px;  color: #b5b5b5;">¿Necesitas ayuda para completar los datos de esta pantalla? Accede a nuestra Central de Ayuda Docttus está procesando esta solicitud al servicio de C.I.C Afiliados, al continuar estás de acuerdo con los Términos de Compra</small>
						</div>
						<div class="col-md-4">
							<small style="font-size: 10px;  color: #b5b5b5;">
								Docttus © 2020 - Todos los derechos reservados <br/>REF Afil.: @if($codigo_usuario){{$codigo_usuario}}@else Docttus @endif
							</small>
						</div>
					</div>
					  

						
					</div>
					
				</div>

				<div class="col-md-4">
					<div class="contenedor_ficha" style="    background-color: #fafafa; border: 1px solid #ccc; border-radius: 10px;">
						

							<img src="{{url('')}}/assets/images/cursos/{{$curso->ImagenCurso}}" style="width: 100%; border-radius: 10px;">

							<center>

								<h3 style="margin-top: 25px; margin-bottom: 25px;">{{$curso->NombreCurso}}</h3>

								<p>
									<strong>Autor: </strong>{{$curso->NombreTutor}}
								</p>

								<span style="margin-top: 15px;">Este es un producto digital. Una vez adquirido, ingresas con tu usuario y password, para que puedas disfrutar del curso.</span>

								

								<br />
								<br />


								<table class="table table-bordered table-striped" style="margin-bottom: 0px;">
									<tr>
										<td>Valor Producto</td>
										<td style="text-align:right;">$ {{number_format($valor_anterior,2)}}</td>
									</tr>

									@if($porcentaje_curso)
									<tr style="color:#dc3636;">
										<td>- Descuento {{$porcentaje_curso}}%</td>
										<td style="text-align:right;">- $ {{number_format($valor_descuento_curso,2)}}</td>
									</tr>
									@endif

									@if($valor_impuesto)
									<tr>
										<td>+ {{$nombre_impuesto}}</td>
										<td style="text-align:right;">$ {{number_format($valor_prod_iva,2)}}</td>
									</tr>
									@endif

									<tr>
										<td>TOTAL</td>
										<td style="text-align:right;">
											<h3 style="margin-top: 0px;">US $ {{$valor_curso_actual}}</h3>
										</td>
									</tr>
								</table>
								
								
								@if($curso_comprado=="0")
									@if($valor_curso_actual>0 && $curso->AplicaGratisCurso=="0")
									<button class="btn-docttus-web" id="btn_pago_1" style="width:100%;">COMPRAR AHORA!</button>
									@elseif(count($arra_data_usuario)>0)
									<button class="btn-docttus-web" id="btn_pago_free_1"  style="width:100%;">INSCRIBIRSE AHORA!</button>
									@endif
								@else
									<a href="{{url('')}}/curso/{{$curso->SlugCurso}}"  class="btn-docttus-web"> IR AL CURSO</a>									
								@endif

				
							</center>


					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- Intro section end -->

	

	<!-- Modal -->
	<div class="modal fade" id="modal_login_checkout" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	  <div class="modal-dialog modal-dialog-centered" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="titulo_login_checkout">Ingresa a Docttus</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
	         
	         <form class="form form-login" id="formulario_login" action="/" method="POST" style="text-align: center;">

				

	        	<input type="text" class="form-control input-docttus" id="txtusuario_login" placeholder="Usuario o Email" required />        		            
	            <input type="password" id="txtpassword_login" class="form-control input-docttus" placeholder="Password" required />

				<center>
				<br/>
				<div class="g-recaptcha" data-sitekey="6LfJwFoaAAAAAPiljxPQbH_MscIMe4rmLyC7y3zs"></div>
				<br/>
				</center>

				<button type="submit" class="btn-docttus-web" style="margin-top: 14px;">INGRESAR</button>
				
	         </form>

	      </div>
	     
	    </div>
	  </div>
	</div>
	

@stop

@section('scripts')

@if($TipoProcesador=="1")
<script type="text/javascript" src="https://checkout.epayco.co/checkout.js">   </script>
@endif

<script type="text/javascript">


	@if($TipoProcesador=="1")
 	  var handler = ePayco.checkout.configure({key: 'e58c3535441e0beaa9c9bf7bbdbb7994',test: true });	
	  $("#btn_pago,#btn_pago_1").click(function(){
		/*$("#btn_pago,#btn_pago_1").prop("disabled","true");
		$("#btn_pago,#btn_pago_1").html(" --- Espere un Momento --- ");
		var data={name: "{{$curso->NombreCurso}}",description: "{{$curso->NombreCurso}}",invoice: "{{$CodigoTransaccion}}", currency: "usd",
          amount: "{{$valor_curso_actual}}",tax_base: "{{$valor_base}}",tax: "{{$valor_prod_iva}}",country: "co",lang: "es",external: "false",
		  confirmation: "{{url('')}}/confirmacion.php", response: "{{url('')}}/respuesta",
		};handler.open(data);*/
		//mensaje_toast("warning","Estamos en desarrollo, una vez estemos listos te avisaremos.","En Desarrollo");
		window.open("https://go.hotmart.com/Q50018802F?ap=4bd6","_parent");
	  });
	@endif

	$("#btn_pago,#btn_pago_1").click(function(){
		//$("#frm_payu_latam").submit();
		//mensaje_toast("warning","Estamos en desarrollo, una vez estemos listos te avisaremos.","En Desarrollo");
		window.open("https://go.hotmart.com/Q50018802F?ap=4bd6","_parent");
	});
	

	  
	  $("#formulario_login").submit(function(e){
        e.preventDefault();verificar_login();
      });

      var myVar;
      var contador_login=5;

      function verificar_login(){

        var usuario=$("#txtusuario_login").val();
        var password=$("#txtpassword_login").val();				

		var captcha=$("#formulario_login  .g-recaptcha-response").val();
        var rol="1";
        var request = $.ajax({
          url: "{{url('')}}/login_cursos",
          type: "POST",
          data:{               
               usuario:usuario,
               password:password,
			   captcha:captcha,
			   rct:"",
               rol:rol,
               _token: "{{ csrf_token() }}"
          }
        });

        request.done(function(obj) { 
           if(obj.status=="ok"){
              mensaje_generico("Bienvenido "+obj.nombre+" !","Has ingresado correctamente","1","<span id='contador_boton'>5 </span> Continuar...",continuar_login);
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
         location.reload();
         //window.open("{{url('')}}/checkout/{{$url_curso}}","_parent");
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
        location.reload();
      }

      //REGISTER

      $("#formulario_registro").submit(function(e){
      	 	e.preventDefault();

      	 	var usuario=$("#txtusuario").val();      	 	
      	 	var email=$("#txtemail").val();
      	 	var password = $("#txtpassword").val();
			var captcha=$("#formulario_registro  .g-recaptcha-response").val();
      	 	
      	 	var request = $.ajax({
	          url: "{{url('')}}/registrar_usuario",
	          type: "POST",
	          data:{               
	               usuario:usuario,	              
	               email:email,
	               password:password,
	               repetirpassword:password,	               
	               rol_registro:"1",
				   IdUsuarioPadre:"",                  
					captcha:""+captcha,
				   _token: "{{ csrf_token() }}"
	          }
	        });

	         request.done(function(obj) { 
		       if(obj.status=="ok"){
		          mensaje_generico("Bienvenido "+obj.nombre+" !","Te has registrado correctamente","1","<span id='contador_boton'>5 </span> Continuar...",continuar_login);
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



      });

	  $("#btn_pago_free,#btn_pago_free_1").click(function(){
		var request = $.ajax({
	          url: "{{url('')}}/asign_c_f",
	          type: "POST",
	          data:{               	               
	               _x_proc:"{{$CodigoTransaccion}}",	               
				   url_curso:"{{$url_curso}}",
				   codigo_usuario:"@if(count($arra_data_usuario)>0){{$arra_data_usuario[0]->NombreUsuario}}@endif",
	               _token: "{{ csrf_token() }}"
	          }
	        });

	        request.done(function(obj) { 
		       if(obj.status=="ok"){
					mensaje_generico("Inscripción Exitosa!","Te has registrado correctamente","1","<span id='contador_boton'>5 </span> Continuar...",continuar_free);
		          	myVar = setInterval(myTimer, 1000);		          
		          	return;
		       }else{
		          mensaje_generico("Error !",""+obj.mensaje,"2","Continuar...",continuar_error);
		          return;
		       }
			});
	  });

	  function continuar_free(){
         console.log("siguiente");
         //location.reload();
         window.open("{{url('')}}/curso/{{$curso->SlugCurso}}","_parent");
      }


</script>



@stop



