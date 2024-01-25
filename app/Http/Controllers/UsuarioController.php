<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Quotation;
use Exception;

class UsuarioController extends Controller
{
    //
    public function editarusuario($codigousuario=null){
		
		$controller = new AdminController();
    	$arra_data=$controller->VerificarSesid();

		if($codigousuario!=null && session('rol_solicitud')!="root"){
			return view('areacurso.notienespermiso');
		}


		if(count($arra_data)==0){
			return view('areacurso.notienespermiso');
		}else{
			if($codigousuario!=null && session('rol_solicitud')!="root"){			
				$notificaciones=$controller->get_notificaciones($arra_data[0]->IdUsuario);	
				return view('areacurso.usuario',[
					"data"=>$arra_data,
					"datos_usuario"=>$arra_data,
					"titulo_pagina"=>'Editar Usuario', 
					"notificaciones"=>$notificaciones,				
					"codigousuario"=>"",
					"menu"=>"cursos"
				]);
			}else{
				$arra_data=$controller->VerificarSesid($codigousuario);
				$notificaciones=$controller->get_notificaciones($arra_data[0]->IdUsuario);	
				return view('areacurso.usuario',[
					"data"=>$arra_data,
					"datos_usuario"=>$arra_data,
					"titulo_pagina"=>'Editar Usuario', 
					"notificaciones"=>$notificaciones,				
					"codigousuario"=>$codigousuario,
					"menu"=>"cursos"
				]);
			}
		}    	
    }

    public function cursosusuario(){
    	$controller = new AdminController();
    	$arra_data=$controller->VerificarSesid();
		if(count($arra_data)==0){
			return view('areacurso.notienespermiso');
		}else{
			$notificaciones=$controller->get_notificaciones($arra_data[0]->IdUsuario);	
			$controller_curso = new CursoController();
			$cursos_disponibles=$controller_curso->get_cursos_persona($arra_data[0]->SesidUsuario,'');
			return view('areacurso.usuario-cursos',[
				"data"=>$arra_data,
				"titulo_pagina"=>'Cursos Adquiridos', 
				"notificaciones"=>$notificaciones,				
				"cursos_disponibles"=>$cursos_disponibles,
				"menu"=>"cursos"
			]);
		}    		
    }

    public function habilidadesusuario(){
    	$controller = new AdminController();
    	$arra_data=$controller->VerificarSesid();
    	$controller_curso = new CursoController();
		if(count($arra_data)==0){
			return view('areacurso.notienespermiso');
		}else{
			$notificaciones=$controller->get_notificaciones($arra_data[0]->IdUsuario);	
			$habilidades=$controller_curso->get_habilidades('',$arra_data[0]->IdUsuarioPersona,'');
			return view('areacurso.usuario-habilidades',[
				"data"=>$arra_data,
				"titulo_pagina"=>'Habilidades Adquiridas', 
				"notificaciones"=>$notificaciones,			
				"habilidades"=>$habilidades,	
				"menu"=>"cursos"
			]);
		}    		
    }

    public function certificadosusuario(){
    	$controller = new AdminController();
    	$arra_data=$controller->VerificarSesid();
   	

		if(count($arra_data)==0){
			return view('areacurso.notienespermiso');
		}else{
			$notificaciones=$controller->get_notificaciones($arra_data[0]->IdUsuario);	

			


			return view('areacurso.usuario-certificados',[
				"data"=>$arra_data,
				"titulo_pagina"=>'Habilidades Adquiridas', 
				"notificaciones"=>$notificaciones,						
				"menu"=>"cursos"
			]);
		}    		
    }

    

    public function set_usuario(Request $request){	
    	$input = $request->all();	
		$NombrePersona="".$input["NombrePersona"];
		$ApellidosPersona="".$input["ApellidosPersona"];		
		$EmailPersona="".$input["EmailPersona"];
		$IdentificacionPersona="".$input["IdentificacionPersona"];
		$TelefonoPersona="".$input["TelefonoPersona"];
		$WhatsappPersona="".$input["WhatsappPersona"];

		$codigousuario="".$input["codigousuario"];

		
		
		/*
        formData.append('FotoPersona', $('#FotoPersona')[0].files[0]);
		*/




        $controltamanioimagen = 2*1024*1024;
		//definir fecha/hora para componer en el nombre dinamica de la imagen cargada
		$fileName = date("YmdHms");
		//definir la ubicación en donde se guardara la imagen de logos
		$destinationPathlogo = "assets/images/usuarios";

	   	//INICIO LOGO
		$nombrefoto="";
		//$FotoPersona = Input::file('FotoPersona');
		$FotoPersona = $request->file('FotoPersona');

		if ($FotoPersona){
		
			//obtiene la extensión de la imagen cargada
			$extensionfoto = $FotoPersona->getClientOriginalExtension();

			$extensionfoto=strtolower($extensionfoto);
			
			//Validar la extensión jpg, png, gif, jpeg
			if ($extensionfoto != "jpg" && $extensionfoto != "png" && $extensionfoto != "gif" && $extensionfoto != "jpeg"){
				DB::rollback();
				return Response::json(array("status"=>'error',"mensaje"=>"La extensión del logo debe ser: jpg, png, gif, jpeg."));
			}

			//validar tamaño
			$sizelogo = $FotoPersona->getSize();
			if($controltamanioimagen<$sizelogo){				
				return Response::json(array("status"=>'error',"mensaje"=>"El tamaño del logo debe ser menor a 2Mb"));
			}
			
			//Arma el nombre de la imagen cargada
			$nombrefoto = "usuario_".$fileName.".".$extensionfoto;

			//Guarda la imagen en la ruta específica
			$FotoPersona->move($destinationPathlogo, $nombrefoto);
			

		}

		$campo_foto="";

		if($nombrefoto!=""){
			$campo_foto="FotoPersona='{$nombrefoto}', ";
		}


		

		$campoemail="";
		if(session('rol_solicitud')=="root"){			
			$campoemail="EmailPersona='{$EmailPersona}',";
		}


		$controller = new AdminController();
    	$arra_data=$controller->VerificarSesid();

		

		


    	if(count($arra_data)==0){    		
			return response()->json(["status"=>'error',"mensaje"=>"La sesión ha caducado"]);    		
    	}else{

			if(session('rol_solicitud')=="root" && $codigousuario!=""){
				$arra_data=$controller->VerificarSesid($codigousuario);
			}

    		$sql="UPDATE tbl_persona 
    		SET NombrePersona='{$NombrePersona}', 
    		ApellidosPersona='{$ApellidosPersona}',     		
    		IdentificacionPersona='{$IdentificacionPersona}',
    		TelefonoPersona='{$TelefonoPersona}',
			{$campoemail}
    		{$campo_foto}
    		WhatsappPersona='{$WhatsappPersona}'
    		WHERE IdPersona={$arra_data[0]->IdPersona}";	
    		$result=DB::update($sql);


			if(session('rol_solicitud')=="root"){
				$NombreUsuario="".$input["NombreUsuario"];			
	
				$sql="UPDATE tbl_usuario SET NombreUsuario='{$NombreUsuario}' where NombreUsuario='{$codigousuario}'";
				$result=DB::update($sql);
	
				return response()->json(["status"=>'ok',"mensaje"=>"Proceso generado correctamente.","codigo_usuario"=>$NombreUsuario]);		
	
			}
	

    		
    		return response()->json(["status"=>'ok',"mensaje"=>"Proceso generado correctamente."]);
    	}    	

    }

	public function set_password(Request $request){	
    	$input = $request->all();	
		
		$PasswordUsuario="".$input["PasswordUsuario"];
		$PasswordUsuarioNuevo="".$input["PasswordUsuarioNuevo"];
		$RepetirPasswordUsuario="".$input["RepetirPasswordUsuario"];

		$codigousuario="".$input["codigousuario"];

		
		$controller = new AdminController();
    	$arra_data=$controller->VerificarSesid();
    	if(count($arra_data)==0){    		
			return response()->json(["status"=>'error',"mensaje"=>"La sesión ha caducado"]);    		
    	}else{

			if(session('rol_solicitud')=="root" && $codigousuario!=""){
				$arra_data=$controller->VerificarSesid($codigousuario);
			}


			$sql="SELECT * FROM tbl_usuario WHERE IdUsuario={$arra_data[0]->IdUsuario} AND PasswordUsuario={$controller->generate_pass($PasswordUsuario)}";
    		$result=DB::select($sql);

			if(count($result)==0){
				return response()->json(["status"=>'error',"mensaje"=>"El Password no es correcto"]);
			}
			

    		if($PasswordUsuarioNuevo == $RepetirPasswordUsuario){
    			$sql="UPDATE tbl_usuario SET 
			    		PasswordUsuario={$controller->generate_pass($PasswordUsuarioNuevo)}
			    		WHERE IdUsuario={$arra_data[0]->IdUsuario} AND PasswordUsuario={$controller->generate_pass($PasswordUsuario)}";	
			 	$result=DB::update($sql);	

    		}

			if(session('rol_solicitud')=="root" && $codigousuario!=""){
				return response()->json(["status"=>'ok',"mensaje"=>"Proceso generado correctamente.","codigo_usuario"=>$codigousuario]);		
			}

    		return response()->json(["status"=>'ok',"mensaje"=>"Tu contraseña  se ha cambiado correctamente."]);
    	}    	

	}

    public function set_financiero(Request $request){	
    	$input = $request->all();	
		$PaypalPersona="".$input["PaypalPersona"];
		$PayoneerPersona="".$input["PayoneerPersona"];		
		$NumeroBancoPersona="".$input["NumeroBancoPersona"];
		$NombreBancoPersona="".$input["NombreBancoPersona"];
		$TipoCuentaPersona="".$input["TipoCuentaPersona"];
		$codigousuario="".$input["codigousuario"];
		
		
		$controller = new AdminController();
    	$arra_data=$controller->VerificarSesid();
    	if(count($arra_data)==0){    		
			return response()->json(["status"=>'error',"mensaje"=>"La sesión ha caducado"]);    		
    	}else{

			if(session('rol_solicitud')=="root" && $codigousuario!=""){
				$arra_data=$controller->VerificarSesid($codigousuario);
			}

    		$sql="UPDATE tbl_persona 
    		SET PaypalPersona='{$PaypalPersona}', 
    		PayoneerPersona='{$PayoneerPersona}',     			    		
    		NumeroBancoPersona='{$NumeroBancoPersona}',
    		NombreBancoPersona='{$NombreBancoPersona}',
    		TipoCuentaPersona='{$TipoCuentaPersona}'
    		WHERE IdPersona={$arra_data[0]->IdPersona}";	
    		$result=DB::update($sql);

			if(session('rol_solicitud')=="root" && $codigousuario!=""){
				return response()->json(["status"=>'ok',"mensaje"=>"Proceso generado correctamente.","codigo_usuario"=>$codigousuario]);		
			}
    		
    		return response()->json(["status"=>'ok',"mensaje"=>"Proceso generado correctamente."]);
    	}
    }

    public function set_redes_sociales(Request $request){	    	

    	$input = $request->all();	
		$FacebookPersona="".$input["FacebookPersona"];
		$TwitterPersona="".$input["TwitterPersona"];		
		$InstagramPersona="".$input["InstagramPersona"];
		$YoutubePersona="".$input["YoutubePersona"];
		$LinkedinPersona="".$input["LinkedinPersona"];
		$WebPersona="".$input["WebPersona"];
		$codigousuario="".$input["codigousuario"];
		
		
		$controller = new AdminController();
    	$arra_data=$controller->VerificarSesid();
    	if(count($arra_data)==0){    		
			return response()->json(["status"=>'error',"mensaje"=>"La sesión ha caducado"]);    		
    	}else{

			if(session('rol_solicitud')=="root" && $codigousuario!=""){
				$arra_data=$controller->VerificarSesid($codigousuario);
			}

    		$sql="UPDATE tbl_persona 
    		SET FacebookPersona='{$FacebookPersona}', 
    		TwitterPersona='{$TwitterPersona}',     			    		
    		InstagramPersona='{$InstagramPersona}',
    		YoutubePersona='{$YoutubePersona}',
    		LinkedinPersona='{$LinkedinPersona}',
    		WebPersona='{$WebPersona}'
    		WHERE IdPersona={$arra_data[0]->IdPersona}";	
    		$result=DB::update($sql);

			if(session('rol_solicitud')=="root" && $codigousuario!=""){
				return response()->json(["status"=>'ok',"mensaje"=>"Proceso generado correctamente.","codigo_usuario"=>$codigousuario]);		
			}
    		
    		return response()->json(["status"=>'ok',"mensaje"=>"Proceso generado correctamente."]);
    	}
    }

	

	public function set_hotmart_usuario(Request $request){

    	$input = $request->all();			
		$EmailHotmart="".addslashes($input["EmailHotmart"]);	
		$TokenHotmart="".$input["TokenHotmart"];	
			
		
		$controller = new AdminController();
    	$arra_data=$controller->VerificarSesid();
    	if(count($arra_data)==0){    		
			return response()->json(["status"=>'error',"mensaje"=>"La sesión ha caducado"]);    		
    	}else{

			if(session('rol_solicitud')=="root" && $codigousuario!=""){
				$arra_data=$controller->VerificarSesid($codigousuario);
			}

    		$sql="UPDATE tbl_usuario 
    		SET EmailHotmart='{$EmailHotmart}',
			TokenHotmart='{$TokenHotmart}'
    		WHERE IdUsuario={$arra_data[0]->IdUsuario}";	
    		$result=DB::update($sql);

			if(session('rol_solicitud')=="root" && $codigousuario!=""){
				return response()->json(["status"=>'ok',"mensaje"=>"Proceso generado correctamente.","codigo_usuario"=>$codigousuario]);		
			}
    		
    		return response()->json(["status"=>'ok',"mensaje"=>"Proceso generado correctamente."]);
    	}
    }

	public function solicitar_aprobacion_hotmart(Request $request){

			$input = $request->all();
			$controller = new AdminController();
			$arra_data=$controller->VerificarSesid();
			if(count($arra_data)==0){    		
				return response()->json(["status"=>'error',"mensaje"=>"La sesión ha caducado"]);    		
			}else{
	
				if(session('rol_solicitud')=="root" && $codigousuario!=""){
					$arra_data=$controller->VerificarSesid($codigousuario);
				}
	
				$sql="UPDATE tbl_usuario SET AprobacionHotmart='2', FechaSolicitudHotmart=now()  WHERE IdUsuario={$arra_data[0]->IdUsuario}";	
				$result=DB::update($sql);
	
				if(session('rol_solicitud')=="root" && $codigousuario!=""){
					return response()->json(["status"=>'ok',"mensaje"=>"Proceso generado correctamente.","codigo_usuario"=>$codigousuario]);		
				}
				
				return response()->json(["status"=>'ok',"mensaje"=>"Proceso generado correctamente."]);
			}
	}

	public function estado_solicitud_hotmart(Request $request){

		$input = $request->all();
		$controller = new AdminController();
		$arra_data=$controller->VerificarSesid();
		
		$IdUsuario="".$input["IdUsuario"];	
		$EmailUsuario="".$input["EmailUsuario"];	
		$IdEstado="".$input["IdEstado"];	

		if(count($arra_data)==0){    		
			return response()->json(["status"=>'error',"mensaje"=>"La sesión ha caducado"]);    		
		}else{

			if(session('rol_solicitud')=="root"){

				$sql="UPDATE tbl_usuario SET AprobacionHotmart='{$IdEstado}', FechaAprobacionHotmart=now()  WHERE IdUsuario={$IdUsuario}";
				$result=DB::update($sql);
				return response()->json(["status"=>'ok',"mensaje"=>"Proceso generado correctamente."]);
			}
		}
	}

	


    public function set_descripcion_persona(Request $request){

    	$input = $request->all();	
		$DescripcionPersona="".addslashes($input["DescripcionPersona"]);
		$TituloPersona="".addslashes($input["TituloPersona"]);	
		$codigousuario="".$input["codigousuario"];	
			
		
		$controller = new AdminController();
    	$arra_data=$controller->VerificarSesid();
    	if(count($arra_data)==0){    		
			return response()->json(["status"=>'error',"mensaje"=>"La sesión ha caducado"]);    		
    	}else{

			if(session('rol_solicitud')=="root" && $codigousuario!=""){
				$arra_data=$controller->VerificarSesid($codigousuario);
			}

    		$sql="UPDATE tbl_persona 
    		SET DescripcionPersona='{$DescripcionPersona}',
			TituloPersona='{$TituloPersona}'
    		WHERE IdPersona={$arra_data[0]->IdPersona}";	
    		$result=DB::update($sql);

			if(session('rol_solicitud')=="root" && $codigousuario!=""){
				return response()->json(["status"=>'ok',"mensaje"=>"Proceso generado correctamente.","codigo_usuario"=>$codigousuario]);		
			}
    		
    		return response()->json(["status"=>'ok',"mensaje"=>"Proceso generado correctamente."]);
    	}
    }

	public function enlaces_afiliados(){
		
		$controller = new AdminController();
    	$arra_data=$controller->VerificarSesid();
   	

		if(count($arra_data)==0){
			return view('areacurso.notienespermiso');
		}else{
			$notificaciones=$controller->get_notificaciones($arra_data[0]->IdUsuario);	

			


			return view('areacurso.enlaces-afiliados',[
				"data"=>$arra_data,
				"titulo_pagina"=>'Enlaces de Afiliado', 
				"notificaciones"=>$notificaciones,						
				"menu"=>"cursos"
			]);
		}    		
		
	}

	public function guardar_checkout(Request $request){

    	$input = $request->all();	
		$URLCheckoutDocttus="".addslashes($input["URLCheckoutDocttus"]);		
			
		
		$controller = new AdminController();
    	$arra_data=$controller->VerificarSesid();
    	if(count($arra_data)==0){    		
			return response()->json(["status"=>'error',"mensaje"=>"La sesión ha caducado"]);    		
    	}else{

			if(session('rol_solicitud')=="root" && $codigousuario!=""){
				$arra_data=$controller->VerificarSesid($codigousuario);
			}

    		$sql="UPDATE tbl_usuario 
    		SET URLHotmartCheckout='{$URLCheckoutDocttus}'			
    		WHERE IdUsuario={$arra_data[0]->IdUsuario}";	
    		$result=DB::update($sql);

			if(session('rol_solicitud')=="root" && $codigousuario!=""){
				return response()->json(["status"=>'ok',"mensaje"=>"Proceso generado correctamente.","codigo_usuario"=>$codigousuario]);		
			}
    		
    		return response()->json(["status"=>'ok',"mensaje"=>"Proceso generado correctamente."]);
    	}
    }

	public function get_usuario_patrocinador($IdUsuario){

		if($IdUsuario==""){
			$IdUsuario=5;
		}

		$sql="SELECT p.*, u.NombreUsuario, COALESCE(u.URLHotmartCheckout,'') AS URLHotmartCheckout
		      FROM tbl_usuario u 
			  INNER JOIN tbl_persona p ON p.IdPersona=u.IdPersona
			  WHERE u.IdUsuario={$IdUsuario}";
		$result=DB::select($sql);

		if($result[0]->URLHotmartCheckout==""){
			$ql="SELECT URLHotmartCheckout FROM tbl_usuario where IdUsuario=5";
			$result2=DB::select($sql);
			$result[0]->URLHotmartCheckout="".$result2[0]->URLHotmartCheckout;
		}

		return $result;

	}


}
