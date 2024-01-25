<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;
use App\Quotation;
use Exception;


class LoginController extends Controller
{

	//FUNCION PARA LOGIN DOCTTUS
	//Desarrollador: ANGEL FERNANDO LIZCANO
    public function login(Request $request){	

		$validated = $request->validate([
			'usuario' => 'required|min:5',
			'password' => 'required|min:5',
			'captcha' => 'required',
		]);


		
    	$input = $request->all();	
		$usuario="".$input["usuario"];
		$password="".$input["password"];		
		$idrol="".$input["rol"];
		$rct="".$input["rct"];
		

		$captcha="".trim($input['captcha']);
		$url_google="https://www.google.com/recaptcha/api/siteverify?secret=6LfJwFoaAAAAAGvs71yktlALZjDMjCH0bw5488dz&response=".$captcha."&remoteip=".$_SERVER['REMOTE_ADDR'];
		$response=file_get_contents($url_google);
		$responseKeys = json_decode($response,true);
		if(intval($responseKeys["success"]) !== 1) {
			/*$mensaje = 'El captcha no coincide ';
			return response()->json(["status"=>'error',"mensaje"=>"{$mensaje}"]);
			exit;*/
		}

		$consulta_rol="";

		

		if($idrol=="4"){
			$consulta_rol=" and usu.IdRol=4";
		}

		$admin_ctrl = new AdminController();

		$sql_sentencia="SELECT usu.NombreUsuario, usu.IdRol, usu.IdRolAfiliado,  usu.IdEstadoSolicitudAfiliado, usu.IdEstadoSolicitudTutor,  p.*
						FROM tbl_usuario usu
						INNER JOIN tbl_persona p ON usu.IdPersona=p.IdPersona AND usu.IdEstado=1 and p.IdEstado=1 {$consulta_rol}
						WHERE usu.PasswordUsuario = {$admin_ctrl->generate_pass($password)} and (usu.NombreUsuario='{$usuario}' or p.EmailPersona='{$usuario}')";
		$result=DB::select($sql_sentencia);
		$nombre_usuario="";
		$UsuarioLogin="";
		foreach($result as $datos){
			$nombre_usuario=$datos->NombrePersona;
			$UsuarioLogin=$datos->NombreUsuario;
		}

		session(['sesid' => '']);//limpiar sesid
		session(['rol_login' => '']);//limpiar rol login
		session(['rol_solicitud' => '']);//Aceptado
		session(['rct' => '']);//Aceptado

		

		if(count($result)>0){			
			/*ASIGNAR SESID*/
			$sesid=$this->get_sesid();
			$sql_update="UPDATE tbl_usuario SET SesidUsuario='{$sesid}' WHERE NombreUsuario='{$UsuarioLogin}'";
			$result=DB::update($sql_update);
			session(['sesid' => $sesid]);//asignar a sesion el sesid
			session(['rol_login' => $idrol]);//limpiar sesid
			session(['rct' => $rct]);//Aceptado

			if($idrol=="1"){
				session(['rol_solicitud' => 'estudiante']);//Aceptado
			}

			if($idrol=="2"){
				session(['rol_solicitud' => 'tutor']);//Aceptado
			}

			if($idrol=="3"){
				session(['rol_solicitud' => 'afiliado']);//Aceptado
			}

			if($idrol=="4"){
				session(['rol_solicitud' => 'root']);//Aceptado
			}
			/*ASIGNAR SESID*/		
			

			return response()->json(["status"=>'ok',"mensaje"=>"Proceso generado correctamente.","nombre"=>$nombre_usuario,"sesid"=>$sesid]);
		}else{			
			return response()->json(["status"=>'error',"mensaje"=>"El usuario no existe."]);
		}
	}

	public function registro(){
    	return view('marketing.registrousuario',["id_pagina"=>"login","IdUsuario"=>""]);
    }

    public function registroafiliados($NombreUsuario=null){


		$IdUsuario="";
		if($NombreUsuario){
			$sql="SELECT * FROM tbl_usuario WHERE NombreUsuario='{$NombreUsuario}'";
			$result=DB::select($sql);

			if(count($result)==0){
				return view('areacurso.notienespermiso');
			}else{
				$IdUsuario="".$result[0]->IdUsuario;
			}
			
		}

    	return view('marketing.registrousuario',
			[
				"id_pagina"=>"login-afiliados",
				"NombreUsuario"=>$NombreUsuario,
				"IdUsuario"=>$IdUsuario
			]);
	}
	
	public function registrotutores($NombreUsuario=null){

		$IdUsuario="";
		if($NombreUsuario){
			$sql="SELECT * FROM tbl_usuario WHERE NombreUsuario='{$NombreUsuario}'";
			$result=DB::select($sql);

			if(count($result)==0){
				return view('areacurso.notienespermiso');
			}else{
				$IdUsuario="".$result[0]->IdUsuario;
			}
			
		}
		

    	return view('marketing.registrousuario',
			[
				"id_pagina"=>"login-tutores",
				"NombreUsuario"=>$NombreUsuario,
				"IdUsuario"=>$IdUsuario
			]);
    }

    

    public function registrar_usuario(Request $request){	
    	$input = $request->all();	
		$usuario="".$input["usuario"];		
		$email="".$input["email"];
		$password="".$input["password"];
		$IdUsuarioPadre="".$input["IdUsuarioPadre"];


		$validated = $request->validate([
			'usuario' => 'required|min:5',
			'password' => 'required|min:5',
			'captcha' => 'required',
			'email'=>'required|email',
		]);


		
		$captcha="".trim($input['captcha']);
		$url_google="https://www.google.com/recaptcha/api/siteverify?secret=6LfJwFoaAAAAAGvs71yktlALZjDMjCH0bw5488dz&response=".$captcha."&remoteip=".$_SERVER['REMOTE_ADDR'];
		$response=file_get_contents($url_google);
		$responseKeys = json_decode($response,true);
		if(intval($responseKeys["success"]) !== 1) {
			/*$mensaje = 'El captcha no coincide ';
			return response()->json(["status"=>'error',"mensaje"=>"{$mensaje}"]);
			exit;*/
		}		
		
		$rolestudiante="1";
		$rol_registro="".$input["rol_registro"];
		$IdUsuarioPadre="".$input["IdUsuarioPadre"];

		DB::beginTransaction();		

		try {			
			$sql_sentencia="SELECT usu.NombreUsuario, usu.IdRol, usu.IdRolAfiliado, p.*
						FROM tbl_usuario usu
						INNER JOIN tbl_persona p ON usu.IdPersona=p.IdPersona AND usu.IdEstado=1 and p.IdEstado=1
						WHERE (usu.NombreUsuario='{$usuario}' or p.EmailPersona='{$email}')";
			$result=DB::select($sql_sentencia);

		} catch (\Illuminate\Database\QueryException $e) {			
			report($e);
			DB::rollBack();
			return response()->json(["status"=>'error',"mensaje"=>"Hay un error en el sistema, por favor intenta más tarde."]);	

		}

		if(count($result)>0){
			DB::rollBack();
			return response()->json(["status"=>'error',"mensaje"=>"Ya Existe un usuario con el mismo Email o Usuario"]);			
		}


		//insertar persona

		try {			
			$sql="INSERT INTO tbl_persona SET
					NombrePersona='{$usuario}',
					ApellidosPersona='',
					IdEstado='1',
					TipoPersona='1',
					IdIdioma=1,
					EmailPersona='{$email}',
					FotoPersona='usuario.png'";
			$result=DB::insert($sql);		
			$id_persona_last = DB::getPDO()->lastInsertId();
		}catch (\Illuminate\Database\QueryException $e) {			
			report($e);
			DB::rollBack();
			return response()->json(["status"=>'error',"mensaje"=>"Hay un error en el sistema, por favor intenta más tarde."]);	
		}
		

		//insertar usuario
		//IdUsuarioPadre='{$IdUsuarioPadre}',
		$admin_ctrl = new AdminController();
		try {			

			$cadena_usuario_padre="";
			if($IdUsuarioPadre){
				$cadena_usuario_padre=" IdUsuarioPadre='{$IdUsuarioPadre}', ";
			}else{
				$cadena_usuario_padre=" IdUsuarioPadre='5', ";
			}

			$sql="	INSERT INTO tbl_usuario SET
					PasswordUsuario={$admin_ctrl->generate_pass($password)},
					NombreUsuario='{$usuario}',
					IdPersona='{$id_persona_last}',
					IdEstado='1',
					{$cadena_usuario_padre}
					IdRol='1'";
			$result=DB::insert($sql);
			$id_usuario_last = DB::getPDO()->lastInsertId();
		}catch (\Illuminate\Database\QueryException $e) {			
			report($e);
			DB::rollBack();
			return response()->json(["status"=>'error',"mensaje"=>"Hay un error en el sistema, por favor intenta más tarde."]);	
		}

		//RELACION PRINCIPAL USUARIO/PERSONA
		try {
			$sql="INSERT INTO tbl_usuario_persona SET IdUsuario='{$id_usuario_last}',IdPersona='{$id_persona_last}'";
			$result=DB::insert($sql);
			$id_usuario_persona = DB::getPDO()->lastInsertId();
		}catch (\Illuminate\Database\QueryException $e) {			
			report($e);
			DB::rollBack();
			return response()->json(["status"=>'error',"mensaje"=>"Hay un error en el sistema, por favor intenta más tarde."]);	
		}

		//BILLETERA

		try {			
			$sql="INSERT INTO tbl_billetera SET IdUsuarioPersona={$id_usuario_persona}, SaldoDisponible=0, SaldoCanje=0, SaldoCompra=0, IdRol=2;";
			$result=DB::insert($sql);
		}catch (\Illuminate\Database\QueryException $e) {			
			report($e);
			DB::rollBack();
			return response()->json(["status"=>'error',"mensaje"=>"Hay un error en el sistema, por favor intenta más tarde."]);	
		}

		try {			
			$sql="INSERT INTO tbl_billetera SET IdUsuarioPersona={$id_usuario_persona}, SaldoDisponible=0, SaldoCanje=0, SaldoCompra=0, IdRol=3;";
			$result=DB::insert($sql);
		}catch (\Illuminate\Database\QueryException $e) {			
			report($e);
			DB::rollBack();
			return response()->json(["status"=>'error',"mensaje"=>"Hay un error en el sistema, por favor intenta más tarde."]);	
		}

		//Curso Gratis

		try {			
			$sql="INSERT INTO tbl_usuario_curso SET 
					IdUsuarioPersona={$id_usuario_persona},
					IdCurso=11,
					FechaCreacion=now(),
					IdEstado=1,
					IdEstadoPedido=1,
					PrecioCurso=0,
					ComisionAfiliado=0,
					ComisionTutor=0,
					ComisionEmpresa=0,
					IdTutor=13,
					IdAfiliado=null,
					EnCanje=0,
					DiasGarantia=0";
			$result=DB::insert($sql);

			$sql="INSERT INTO tbl_usuario_curso SET 
					IdUsuarioPersona={$id_usuario_persona},
					IdCurso=49,
					FechaCreacion=now(),
					IdEstado=1,
					IdEstadoPedido=1,
					PrecioCurso=0,
					ComisionAfiliado=0,
					ComisionTutor=0,
					ComisionEmpresa=0,
					IdTutor=13,
					IdAfiliado=null,
					EnCanje=0,
					DiasGarantia=0";
			$result=DB::insert($sql);


			$sesid=$this->get_sesid();
			$sql_update="UPDATE tbl_usuario SET SesidUsuario='{$sesid}' WHERE NombreUsuario='{$usuario}'";
			$result=DB::update($sql_update);
			session(['sesid' => $sesid]);//asignar a sesion el sesid
		}catch (\Illuminate\Database\QueryException $e) {			
			report($e);
			DB::rollBack();
			return response()->json(["status"=>'error',"mensaje"=>"Hay un error en el sistema, por favor intenta más tarde."]);	
		}
		
		
		//ENVIAR MENSAJE DE BIENVENIDA
		$objDemo = new \stdClass();        
        $objDemo->nombre_persona = "{$usuario}";
        $objDemo->email_para = "{$email}";
		$controller_email=new EmailController();
		$controller_email->enviar_mensaje_bienvenida($objDemo);
		//ENVIAR MENSAJE DE BIENVENIDA



		//AGREGAR NOTIFICACION
		if($IdUsuarioPadre!=""){			

			$sql_sentencia="SELECT usu.NombreUsuario, usu.IdRol, usu.IdRolAfiliado, p.*
						FROM tbl_usuario usu
						INNER JOIN tbl_persona p ON usu.IdPersona=p.IdPersona AND usu.IdEstado=1 and p.IdEstado=1
						WHERE usu.IdUSuario='{$IdUsuarioPadre}'";
			$result_usu=DB::select($sql_sentencia);
			$email_usuario_notificacion="".$result_usu[0]->EmailPersona;

			$TituloNoticia="Tienes un nuevo afiliado ({$usuario})";

			$DescripcionNoticia="Puedes acceder a la información de tu nuevo afiliado.";

			$TipoNoticia="1";
			$IconoNoticia="bell.png";
			$URLNoticia=url('')."/listado-afiliados";
			$IdUsuario=$IdUsuarioPadre;
			$IdEstado="1";
			$email_usuario=$email_usuario_notificacion;
			$mensaje_usuario="".$DescripcionNoticia;
			$admin_ctrl->set_notificaciones($TituloNoticia,
					$TipoNoticia,
					$DescripcionNoticia,
					$IconoNoticia,
					$URLNoticia,
					$IdUsuario,
					$IdEstado,
					$email_usuario,
					$mensaje_usuario);

		}		
		//FINALIZAR NOTIFICACION



		if($rol_registro=="1"){
			session(['rol_solicitud' => 'estudiante']);//limpiar sesid
			session(['rol_login' => '1']);//limpiar sesid			
					
		}elseif($rol_registro=="2"){
			session(['rol_solicitud' => 'tutor']);//limpiar sesid
			session(['rol_login' => '2']);//limpiar sesid					
		}else{
			session(['rol_solicitud' => 'afiliado']);//limpiar sesid
			session(['rol_login' => '3']);//limpiar sesid			
		}

		DB::commit();

		
		
		return response()->json(["status"=>'ok',"mensaje"=>"Proceso generado correctamente.","nombre"=>$usuario,"sesid"=>$sesid]);

    }



	//RECUPERAR PASSWORD

	public function recuperar_password(){
        return view('marketing.solicitar-codigo',["id_pagina"=>"solicitar-codigo"]);
    }

    public function verificacion_codigo($token_verificacion){

		DB::beginTransaction();
        try{
			$sql="SELECT * from tbl_recuperar where TokenRecuperar='{$token_verificacion}' and IdEstado=2
				and TIMESTAMPDIFF(MINUTE,FechaRecuperar,NOW()) <=15";
			$result=DB::select($sql);
		}catch (\Illuminate\Database\QueryException $e) {			
			report($e);
			DB::rollBack();
			return response()->json(["status"=>'error',"mensaje"=>"Hay un error en el sistema, por favor intenta más tarde."]);	
		}

        if(count($result)==0){            
			DB::rollBack();
            return view('marketing.verificacion-codigo',["id_pagina"=>"verificar-codigo","status"=>"error"]);
        }
        
		$token=$this->get_sesid("12");
        
		try{
			$sql="UPDATE tbl_recuperar SET               
				TokenCambiar='{$token}'
				WHERE TokenRecuperar='{$token_verificacion}'";
			$result=DB::update($sql);	
		}catch (\Illuminate\Database\QueryException $e) {			
			report($e);
			DB::rollBack();
			return response()->json(["status"=>'error',"mensaje"=>"Hay un error en el sistema, por favor intenta más tarde."]);	
		}
		DB::commit();
        return view('marketing.verificacion-codigo',["id_pagina"=>"verificar-codigo","codigo_token"=>$token,"status"=>"ok"]);
    }

    public function verificacion_codigo_token(Request $request){	
    	$input = $request->all();	
		$token="".$input["token_dtt"];
        $codigo="".$input["cd_dtt"];
		DB::beginTransaction();

		try{

			$sql="SELECT * from tbl_recuperar 
					where TokenCambiar='{$token}' 
					and IdEstado=2 
					and CodigoRecuperar='{$codigo}'
					and TIMESTAMPDIFF(MINUTE,FechaRecuperar,NOW()) <=15";
			$result=DB::select($sql);

		}catch (\Illuminate\Database\QueryException $e) {			
			report($e);
			DB::rollBack();
			return response()->json(["status"=>'error',"mensaje"=>"Hay un error en el sistema, por favor intenta más tarde."]);	
		}

        if(count($result)==0){          
			DB::rollBack();  
            return response()->json(["status"=>'error',"mensaje"=>"No existe un registro con ese usuario o email."]);
        }

        $TokenPassword=$this->get_sesid("12");

		try{

			$sql="UPDATE tbl_recuperar SET               
              TokenPassword='{$TokenPassword}'
              WHERE TokenCambiar='{$token}' and CodigoRecuperar='{$codigo}' ";
        	$result=DB::update($sql);

		}catch (\Illuminate\Database\QueryException $e) {			
			report($e);
			DB::rollBack();
			return response()->json(["status"=>'error',"mensaje"=>"Hay un error en el sistema, por favor intenta más tarde."]);	
		}

        DB::commit();
        return response()->json(["status"=>'ok',"codigo_token"=>$TokenPassword]);
    }
	
    public function solicitar_codigo(Request $request){	
    	$input = $request->all();	
		$usuario_email="".$input["usuario_email"];
		DB::beginTransaction();

		try{		
			$sql="SELECT u.NombreUsuario, p.EmailPersona, u.IdUsuario, CONCAT_WS(' ',p.NombrePersona,p.ApellidosPersona) as NombrePersona
			from tbl_usuario_persona up
			INNER JOIN tbl_usuario u ON u.IdUsuario=up.IdUsuario  and u.IdEstado=1
			INNER JOIN tbl_persona p ON p.IdPersona=up.IdPersona
			where (u.NombreUsuario='{$usuario_email}'  or p.EmailPersona='{$usuario_email}')
			LIMIT 1";
        	$result=DB::select($sql);
		}catch (\Illuminate\Database\QueryException $e) {			
			report($e);
			DB::rollBack();
			return response()->json(["status"=>'error',"mensaje"=>"Hay un error en el sistema, por favor intenta más tarde."]);	
		}
        
        if(count($result)==0){
			DB::rollBack();
            return response()->json(["status"=>'error',"mensaje"=>"No existe un registro con ese usuario o email."]);       
        }

        $datos_persona=$result[0];

        $codigo=strtoupper($this->get_sesid("6"));
        $token=$this->get_sesid("12");
        
        

        $objDemo = new \stdClass();        
        $objDemo->nombre_persona = "{$datos_persona->NombrePersona}";
        $objDemo->codigo_recuperacion="{$codigo}";
        $objDemo->token_recuperacion="{$token}";
        $objDemo->email_para = "{$datos_persona->EmailPersona}";

		try{
	
			$sql="INSERT INTO tbl_recuperar SET IdUsuario={$datos_persona->IdUsuario}, 
				CodigoRecuperar='{$codigo}',
				TokenRecuperar='{$token}',
				IdEstado='2',
				FechaRecuperar=now()";
			$result=DB::insert($sql);		

		}catch (\Illuminate\Database\QueryException $e) {			
			report($e);
			DB::rollBack();
			return response()->json(["status"=>'error',"mensaje"=>"Hay un error en el sistema, por favor intenta más tarde."]);	
		}

		DB::commit();
		$controller_email=new EmailController();
		$controller_email->enviar_mensaje_recuperacion($objDemo);    	
        return response()->json(["status"=>'ok',"mensaje"=>"Hemos enviado un código de 6 carácteres a tu correo, tienes 15 minutos para hacerlo efectivo.","token_verificacion"=>$token]);       
	}   


	public function cambiar_passw(Request $request){	
    	$input = $request->all();	
		$password="".$input["password"];
        $nuevo_password="".$input["nuevo_password"];

        $codigoverificacion="".$input["codigoverificacion"];
        $token_ver="".$input["token_ver"];
        $token_k="".$input["token_k"];

		DB::beginTransaction();


		if(trim($password)==""){
			DB::rollBack();
			return response()->json(["status"=>'error',"mensaje"=>"El campo password es obligatorio"]);
		}

		if(trim($nuevo_password)==""){
			DB::rollBack();
			return response()->json(["status"=>'error',"mensaje"=>"El campo repetir password es obligatorio"]);
		}

		if(trim($codigoverificacion)=="" || trim($token_ver)=="" || trim($token_k)==""){
			DB::rollBack();
			return response()->json(["status"=>'error',"mensaje"=>"Debes solicitar el código de recuperación"]);
		}

		

		try{
			$sql="SELECT * from tbl_recuperar 
					where TokenCambiar='{$token_ver}' 
					and IdEstado=2 
					and CodigoRecuperar='{$codigoverificacion}'
					and TokenPassword='{$token_k}'
					and TIMESTAMPDIFF(MINUTE,FechaRecuperar,NOW()) <=15
			";
			$result=DB::select($sql);

		}catch (\Illuminate\Database\QueryException $e) {			
			report($e);
			DB::rollBack();
			return response()->json(["status"=>'error',"mensaje"=>"Hay un error en el sistema, por favor intenta más tarde."]);	
		}


        if(count($result)==0){            
			DB::rollBack();
            return response()->json(["status"=>'error',"mensaje"=>"El código ya fue usado o no existe."]);
        }


		$id_usuario=$result[0]->IdUsuario;


		try{
			$sql="UPDATE tbl_recuperar SET               
				IdEstado=1,
				FechaCambio=now()
				WHERE TokenPassword='{$token_k}' and CodigoRecuperar='{$codigoverificacion}' ";
			$result=DB::update($sql);
		}catch (\Illuminate\Database\QueryException $e) {			
			report($e);
			DB::rollBack();
			return response()->json(["status"=>'error',"mensaje"=>"Hay un error en el sistema, por favor intenta más tarde."]);	
		}



		$admin_ctrl = new AdminController();
		try{

			$sql="UPDATE tbl_usuario SET PasswordUsuario={$admin_ctrl->generate_pass($nuevo_password)} where IdUsuario={$id_usuario}";
			$result=DB::update($sql);
	
		}catch (\Illuminate\Database\QueryException $e) {			
			report($e);
			DB::rollBack();
			return response()->json(["status"=>'error',"mensaje"=>"Hay un error en el sistema, por favor intenta más tarde."]);	
		}

		
		DB::commit();
		return response()->json(["status"=>'ok',"mensaje"=>"Tus accesos han cambiado correctamente"]);       

    }



	public function get_sesid($cant_char="120"){
		$sesid="";
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	    $charactersLength = strlen($characters);
	    $randomString = '';
	    for ($i = 0; $i < $cant_char; $i++) {
	        $randomString .= $characters[rand(0, $charactersLength - 1)];
	    }
	    return $randomString;		
	}
}
