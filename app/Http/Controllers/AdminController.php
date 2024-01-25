<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Quotation;
use Exception;
use Vimeo\Vimeo;
use Vimeo\Exceptions\VimeoUploadException;


class AdminController extends Controller
{

	public function backoffice(){
		$arra_data=$this->VerificarSesid();
		$controller_curso = new CursoController();
		$controller_billetera=new BilleteraController();
		$controller_usuario=new UsuarioController();

		if(count($arra_data)==0){
			return view('areacurso.notienespermiso');
		}else{
			$notificaciones=$this->get_notificaciones($arra_data[0]->IdUsuario);
			$historial_lecciones=$this->get_historial_lecciones($arra_data[0]->IdUsuarioPersona,"3");
			//GET HABILIDADES ACTUALES
			$habilidades=$controller_curso->get_habilidades('',$arra_data[0]->IdUsuarioPersona,'');
			//GET VENTAS
			$info_ventas=$this->get_ventas($arra_data[0]->IdUsuarioPersona);

			//GET DATOS BILLETERA
			$info_billetera=$controller_billetera->get_billetera($arra_data[0]->IdUsuarioPersona);

			

			$curso_destacado=$controller_curso->get_cursos_persona(null,null,null,null,null,"random",1,12,null,'1',null,null);

			$rol_solicitud=session('rol_solicitud');
			$id_rol=session('rol_login');
			

			$plantilla_backoffice="";
			$arra_usuarios=array();
			$cant_usuarios_inscritos=0;
			$cant_usuarios_tutores=0;
			$cant_usuarios_afiliados=0;
			$cant_cursos=0;
			$cant_estudiantes_tutor=0;

			$arra_usuarios=$this->get_usuarios('');

			for($i=0;$i<count($arra_usuarios);$i++){
				$cant_usuarios_inscritos++;
				if($arra_usuarios[$i]->IdEstadoSolicitudAfiliado==1){
					$cant_usuarios_afiliados++;
				}

				if($arra_usuarios[$i]->IdEstadoSolicitudTutor==1){
					$cant_usuarios_tutores++;
				}

			}

			
			$control_formulario=new FormularioController();
			$arra_formulario=array();

			if($rol_solicitud=="root"){
				$plantilla_backoffice="-root";			
				$cant_cursos=$this->get_cant_cursos();
			}

			$cursos_disponibles="";
			if($rol_solicitud=="estudiante"){
				$plantilla_backoffice="-estudiante";
				$cursos_disponibles=$controller_curso->get_cursos_persona($arra_data[0]->SesidUsuario,'');
				$cant_cursos=count($cursos_disponibles);
			}

			$arra_supercategoria=array();
			$arra_categoria=array();
			$arra_subcategorias=array();

			if($rol_solicitud=="tutor"){
				$plantilla_backoffice="-tutor";
				$cant_cursos=count($controller_curso->get_cursos_persona($arra_data[0]->SesidUsuario,''));
				
				$cant_estudiantes_tutor=$this->get_cantidad_estudiantes($arra_data[0]->IdUsuarioPersona);
				$arra_formulario=$control_formulario->get_formulario(2,null);

				$arra_supercategoria=$controller_curso->get_supercategorias();
				$arra_categoria=$controller_curso->get_categorias();
				$arra_subcategorias=$controller_curso->get_subcategorias();

				

			}

			if($rol_solicitud=="afiliado"){
				$plantilla_backoffice="-afiliado";
				$cant_cursos=count($controller_curso->get_cursos_persona($arra_data[0]->SesidUsuario,''));

				$arra_formulario=$control_formulario->get_formulario(1,null);

			}

			$datos_patrocinador="";
			if($rol_solicitud=="afiliado" || $rol_solicitud=="tutor"){
				$datos_patrocinador=$controller_usuario->get_usuario_patrocinador($arra_data[0]->IdUsuarioPadre);
			}

			$arra_ayuda=$this->get_ayuda($id_rol,null);

			$porcentaje_reviews_1=0;
			$porcentaje_reviews_2=0;
			$porcentaje_reviews_3=0;
			$porcentaje_reviews_4=0;
			$porcentaje_reviews_5=0;

			$promedio_reviews_curso=5;
			

			//LISTA DE DESEOS
			$arra_deseos=array();
			$arra_deseos=$this->get_deseos(null,1);
			


			return view('areacurso.backoffice'.$plantilla_backoffice,[
							"data"=>$arra_data,
							"titulo_pagina"=>'Backoffice', 
							"notificaciones"=>$notificaciones,
							"historial_lecciones"=>$historial_lecciones,
							"habilidades"=>$habilidades,
							"info_ventas"=>$info_ventas,
							"info_billetera"=>$info_billetera,
							"cant_usuarios_inscritos"=>$cant_usuarios_inscritos,
							"cant_usuarios_tutores"=>$cant_usuarios_tutores,
							"cant_usuarios_afiliados"=>$cant_usuarios_afiliados,
							"cant_estudiantes_tutor"=>$cant_estudiantes_tutor,
							"cant_cursos"=>$cant_cursos,
							"curso_destacado"=>$curso_destacado,
							"ayudas"=>$arra_ayuda,
							"porcentaje_reviews_1"=>$porcentaje_reviews_1,
							"porcentaje_reviews_2"=>$porcentaje_reviews_2,
							"porcentaje_reviews_3"=>$porcentaje_reviews_3,
							"porcentaje_reviews_4"=>$porcentaje_reviews_4,
							"porcentaje_reviews_5"=>$porcentaje_reviews_5,
							"promedio_reviews_curso"=>$promedio_reviews_curso,
							"cant_lista_deseos"=>count($arra_deseos),
							"arra_formulario"=>$arra_formulario,
							"supercategorias"=>$arra_supercategoria,
							"categorias"=>$arra_categoria,
							"subcategorias"=>$arra_subcategorias,	
							"datos_patrocinador"=>$datos_patrocinador,
							"cursos_disponibles"=>$cursos_disponibles,
							"menu"=>"inicio"
						]);
		}    	
	}

	
	
	public function cambiar_rol(Request $request){	
    	$input = $request->all();	
		$idrol="".$input["rol"];

		
		if($idrol=="1"){
			session(['rol_solicitud' => 'estudiante']);//Aceptado
		}

		if($idrol=="2"){
			session(['rol_solicitud' => 'tutor']);//Aceptado
		}

		if($idrol=="3"){
			session(['rol_solicitud' => 'afiliado']);//Aceptado
		}

		if($idrol!="4"){
			session(['rol_login' => $idrol]);//limpiar sesid
		}
		return response()->json(["status"=>'ok']);
	}

    public function get_usuarios($tipo_resultado){
    	$sql="SELECT up.* , p.*, u.*
    		  FROM tbl_usuario_persona up
    		  INNER JOIN tbl_usuario u ON u.IdUsuario = up.IdUsuario
    		  INNER JOIN tbl_persona p ON p.IdPersona = up.IdPersona";
    	$result=DB::select($sql);
		return $result;
    }

    public function get_cant_cursos(){
    	$sql="SELECT * FROM tbl_curso";
    	$result=DB::select($sql);
		return count($result);
	}
	



    public function ganardinero($tipo=""){
		$arra_data=$this->VerificarSesid();

		$controller_curso = new CursoController();
		$controller_billetera=new BilleteraController();

		if(count($arra_data)==0){
			return view('areacurso.notienespermiso');
		}else{
			$notificaciones=$this->get_notificaciones($arra_data[0]->IdUsuario);
			$historial_lecciones=$this->get_historial_lecciones($arra_data[0]->IdUsuarioPersona,"3");
			//GET HABILIDADES ACTUALES
			$habilidades=$controller_curso->get_habilidades('',$arra_data[0]->IdUsuarioPersona,'');
			//GET VENTAS
			$info_ventas=$this->get_ventas($arra_data[0]->IdUsuarioPersona);

			//GET DATOS BILLETERA
			$info_billetera=$controller_billetera->get_billetera($arra_data[0]->IdUsuarioPersona);

			return view('areacurso.ganadinero',[
							"data"=>$arra_data,
							"titulo_pagina"=>'Backoffice', 
							"notificaciones"=>$notificaciones,
							"historial_lecciones"=>$historial_lecciones,
							"habilidades"=>$habilidades,
							"info_ventas"=>$info_ventas,
							"info_billetera"=>$info_billetera,
							"menu"=>"inicio",
							"tipo"=>$tipo
						]);
		}    	
    }

	


	public function soporte(){
		$arra_data=$this->VerificarSesid();

		$controller_curso = new CursoController();
		$controller_billetera=new BilleteraController();

		if(count($arra_data)==0){
			return view('areacurso.notienespermiso');
		}else{
			$notificaciones=$this->get_notificaciones($arra_data[0]->IdUsuario);
			$historial_lecciones=$this->get_historial_lecciones($arra_data[0]->IdUsuarioPersona,"3");
			//GET HABILIDADES ACTUALES
			$habilidades=$controller_curso->get_habilidades('',$arra_data[0]->IdUsuarioPersona,'');
			//GET VENTAS
			$info_ventas=$this->get_ventas($arra_data[0]->IdUsuarioPersona);
			//GET DATOS BILLETERA
			$info_billetera=$controller_billetera->get_billetera($arra_data[0]->IdUsuarioPersona);

			return view('areacurso.soporte',[
							"data"=>$arra_data,
							"titulo_pagina"=>'Soporte', 
							"notificaciones"=>$notificaciones,
							"historial_lecciones"=>$historial_lecciones,
							"habilidades"=>$habilidades,
							"info_ventas"=>$info_ventas,
							"info_billetera"=>$info_billetera,
							"menu"=>"inicio"
						]);
		}
	}

	

	public function generar_soporte(Request $request){	
		$arra_data=$this->VerificarSesid();
		if(count($arra_data)==0){			
			return response()->json(["status"=>'error',"mensaje"=>"La sesión ha caducado"]);			
		}
		
		


    	$input = $request->all();	
		$AsuntoSoporte="".$input["AsuntoSoporte"];
		$DescripcionSoporte=addslashes($input["DescripcionSoporte"]);
		$IdTipoSoporte="".$input["IdTipoSoporte"];

		$Archivo1Soporte=$request->file("Archivo1Soporte");
		$Archivo2Soporte=$request->file("Archivo2Soporte");
		$Archivo3Soporte=$request->file("Archivo3Soporte");

		$destinationPath = "assets/soporte/";
		$controltamanio = 10*1024*1024;
		$fileName = date("YmdHms");		

		$NombreArchivo1="";
		$NombreArchivo2="";
		$NombreArchivo3="";

		$CampoArchivos="";

		if($Archivo1Soporte){	
			$propiedadesImagen= array(
				"size"=>$controltamanio,
				"filename"=>$fileName,
				"path"=>$destinationPath,
				"prefijo"=>"soporte_1_"
			);
			$ArraArchivo = $this->UploadImage($Archivo1Soporte,$propiedadesImagen);
			if($ArraArchivo["status"]!="ok"){
				return response()->json(["status"=>'error',"mensaje"=>$ArraArchivo["mensaje"]]);
			}
			$NombreArchivo1="".$ArraArchivo["nombre"];
			$CampoArchivos.=",Archivo1Soporte='{$NombreArchivo1}'";
		}


		if($Archivo2Soporte){
			$propiedadesImagen= array(
				"size"=>$controltamanio,
				"filename"=>$fileName,
				"path"=>$destinationPath,
				"prefijo"=>"soporte_2_"
			);
			$ArraArchivo = $this->UploadImage($Archivo2Soporte,$propiedadesImagen);
			if($ArraArchivo["status"]!="ok"){
				return response()->json(["status"=>'error',"mensaje"=>$ArraArchivo["mensaje"]]);
			}
			$NombreArchivo2="".$ArraArchivo["nombre"];
			$CampoArchivos.=",Archivo2Soporte='{$NombreArchivo2}'";
		}


		if($Archivo3Soporte){
			$propiedadesImagen= array(
				"size"=>$controltamanio,
				"filename"=>$fileName,
				"path"=>$destinationPath,
				"prefijo"=>"soporte_3_"
			);
			$ArraArchivo = $this->UploadImage($Archivo3Soporte,$propiedadesImagen);
			if($ArraArchivo["status"]!="ok"){
				return response()->json(["status"=>'error',"mensaje"=>$ArraArchivo["mensaje"]]);
			}
			$NombreArchivo3="".$ArraArchivo["nombre"];
			$CampoArchivos.=",Archivo3Soporte='{$NombreArchivo3}'";
		}


		$sql="INSERT INTO tbl_soporte SET IdEstado=1, IdTipoSoporte={$IdTipoSoporte}, AsuntoSoporte='{$AsuntoSoporte}', DescripcionSoporte='{$DescripcionSoporte}' {$CampoArchivos}";
		$result=DB::insert($sql);		


		//ENVIAR MENSAJE DE RESPUESTA
		$objDemo = new \stdClass();        
        $objDemo->email_para = "info@docttus.com";
		$objDemo->AsuntoSoporte = "{$AsuntoSoporte}";
		$objDemo->DescripcionSoporte = "{$DescripcionSoporte}";

		$objDemo->NombrePersona = "".$arra_data[0]->NombrePersona." ".$arra_data[0]->ApellidosPersona;
		$objDemo->EmailPersona = "".$arra_data[0]->EmailPersona;
		$PerfilPersona="";
		if($IdTipoSoporte=="1"){
			$PerfilPersona="Estudiante";
		}
		if($IdTipoSoporte=="2"){
			$PerfilPersona="Tutor";
		}
		if($IdTipoSoporte=="3"){
			$PerfilPersona="Afiliado";
		}
		$objDemo->PerfilPersona = "{$PerfilPersona}";


		

		$objDemo->NombreArchivo1 = "{$NombreArchivo1}";
		$objDemo->NombreArchivo2 = "{$NombreArchivo2}";
		$objDemo->NombreArchivo3 = "{$NombreArchivo3}";


		$controller_email=new EmailController();
		$controller_email->enviar_mensaje_soporte($objDemo);
		//ENVIAR MENSAJE DE RESPUESTA




		return response()->json(["status"=>'ok',"mensaje"=>"El mensaje ha sido enviado correctamente, estaremos en contacto contigo lo más pronto posible"]);

	}




	public function actualizaciones(){
		$arra_data=$this->VerificarSesid();

		$controller_curso = new CursoController();
		$controller_billetera=new BilleteraController();

		if(count($arra_data)==0){
			return view('areacurso.notienespermiso');
		}else{
			$notificaciones=$this->get_notificaciones($arra_data[0]->IdUsuario);
			$historial_lecciones=$this->get_historial_lecciones($arra_data[0]->IdUsuarioPersona,"3");
			//GET HABILIDADES ACTUALES
			$habilidades=$controller_curso->get_habilidades('',$arra_data[0]->IdUsuarioPersona,'');
			//GET VENTAS
			$info_ventas=$this->get_ventas($arra_data[0]->IdUsuarioPersona);
			//GET DATOS BILLETERA
			$info_billetera=$controller_billetera->get_billetera($arra_data[0]->IdUsuarioPersona);

			$actualizaciones=$this->get_actualizaciones();

			
			return view('areacurso.actualizaciones',[
							"data"=>$arra_data,
							"titulo_pagina"=>'Actualizaciones', 
							"notificaciones"=>$notificaciones,
							"historial_lecciones"=>$historial_lecciones,
							"habilidades"=>$habilidades,
							"info_ventas"=>$info_ventas,
							"info_billetera"=>$info_billetera,
							"actualizaciones"=>$actualizaciones,
							"menu"=>"inicio"
						]);
		}
	}

	function get_actualizaciones(){
		$sql="SELECT * FROM tbl_version WHERE IdEstado=1 order by FechaVersion DESC ";
		$result=DB::select($sql);
		return $result;
	}


	
    


    public function enviarmensajecontacto(Request $request){	
    	$input = $request->all();	
		$nombre="".$input["nombre"];
		$email="".$input["email"];
		$asunto="".$input["asunto"];
		$mensaje="".$input["mensaje"];

		$datos_mensaje=array();

		$this->enviarmensajes("info@docttus.com","info@docttus.com",$asunto,$datos_mensaje,"mensajecontacto");		

		return response()->json(["status"=>'ok',"mensaje"=>"El mensaje ha sido enviado correctamente, estaremos en contacto contigo lo más pronto posible"]);

    }

    public function enviarmensajes($emailde,$emailpara,$asunto,$datos,$plantilla){
    	//sistema de mensajes
    }

    
	


    public function VerificarSesid($codigo_usuario=null){
    	
		$filtro_sesid="";
		if($codigo_usuario==""){
			$sesid=session('sesid');
			$filtro_sesid=" usu.SesidUsuario ='$sesid'  and usu.IdEstado=1 and p.IdEstado=1 ";
		}

		if($codigo_usuario!="" && session('rol_solicitud')=="root"){			
			$filtro_sesid=" usu.NombreUsuario ='$codigo_usuario'";
		}
		
    	$sql="SELECT usu.NombreUsuario, usu.IdUsuario, usu.IdRol, 
					usu.SesidUsuario, up.IdUsuarioPersona, usu.IdEstadoSolicitudAfiliado, 
					usu.TokenHotmart, usu.EmailHotmart, usu.AprobacionHotmart,
					usu.IdEstadoSolicitudTutor, usu.URLHotmartCheckout, usu.IdUsuarioPadre, usu.EsCoproductor, p.*
						FROM tbl_usuario_persona up
						INNER JOIN tbl_usuario usu ON usu.IdUsuario=up.IdUsuario
						INNER JOIN tbl_persona p ON p.IdPersona=up.IdPersona 
						WHERE {$filtro_sesid}";
		$result=DB::select($sql);
		return $result;
    }

    public function get_notificaciones($id_usuario){
    	$sql="SELECT * from tbl_noticias where IdUsuario={$id_usuario} and IdEstado=1 ORDER BY FechaCreacion DESC";
		$result=DB::select($sql);
		return $result;	
	}

	public function set_notificaciones($TituloNoticia,$TipoNoticia,$DescripcionNoticia,$IconoNoticia="bell.png",$URLNoticia=null,$IdUsuario=null,$IdEstado=null,$email_usuario=null,$mensaje_usuario=null){
		$sql="INSERT INTO tbl_noticias 
				set TituloNoticia='{$TituloNoticia}', 
				TipoNoticia='{$TipoNoticia}', 
				DescripcionNoticia='{$DescripcionNoticia}', 
				IconoNoticia='{$IconoNoticia}', 
				URLNoticia='{$URLNoticia}', 
				IdUsuario={$IdUsuario}, 
				IdEstado={$IdEstado}";
		$result=DB::select($sql);

		//enviar mensaje de email

		return $result;			
	}
	

	public function get_ayuda($id_rol=null,$id_ayuda=null,$id_tipo=null){
		$filtro_ayuda="";
		if($id_rol){
			$filtro_ayuda=" AND IdRol={$id_rol}";
		}
		if($id_ayuda){
			$filtro_ayuda.=" AND IdAyuda={$id_ayuda}";
		}

		if($id_tipo){
			$filtro_ayuda.=" AND IdTipoAyuda={$id_tipo}";
		}

		
		$sql="SELECT * from tbl_ayuda  where 1 {$filtro_ayuda}";
		$result=DB::select($sql);
		return $result;	
	}
	
	public function get_ayuda_post(Request $request){	
    	$input = $request->all();	
		$id_ayuda="".$input["IdAyuda"];
		$arra_ayuda=$this->get_ayuda(null,$id_ayuda);
		return response()->json([	"status"=>'ok',
									"titulo_ayuda"=>$arra_ayuda[0]->NombreAyuda,
									"contenido_ayuda"=>$arra_ayuda[0]->DescripcionLarga
								]);
	}


    public function get_habilidades($idusuario){

    }

    public function get_historial_lecciones($idusuario,$limit){
    	$sql="SELECT tem.*
    	      from (SELECT t.*, c.ImagenCurso, c.NombreCurso, c.IdCurso
						FROM tbl_avance_tema_usuario atu
						INNER JOIN tbl_usuario_persona up ON up.IdUsuarioPersona=atu.IdUsuarioPersona
						INNER JOIN tbl_tema t ON t.IdTema=atu.IdTema and t.IdEstado=1
						INNER JOIN tbl_modulo m ON m.IdModulo = t.IdModulo and m.IdEstado=1
						INNER JOIN tbl_curso c ON c.IdCurso = m.IdCurso
						WHERE atu.IdUsuarioPersona={$idusuario} and atu.TipoAvance=2
						ORDER BY atu.FechaCreacion DESC
					) as tem
				GROUP BY tem.IdTema limit 12";
		$result=DB::select($sql);	
		return $result;
    }

    


    public function send_noticia($idusuario,$url_noticia,$titulo_noticia,$tipo_noticia,$descripcion){
    	$sql="INSERT INTO tbl_noticias SET TituloNoticia='{$titulo_noticia}',TipoNoticia='{$tipo_noticia}', URLNoticia='{$url_noticia}', DescripcionNoticia='{$descripcion}', IconoNoticia='bell.png'";
		$result=DB::insert($sql);		
    }

    //LISTADO DE VENTAS
    public function listadoventas($tipo_filtro=null){
    	$controller = new AdminController();
    	$arra_data=$controller->VerificarSesid();
		if(count($arra_data)==0){
			return view('areacurso.notienespermiso');
		}else{
			$notificaciones=$controller->get_notificaciones($arra_data[0]->IdUsuario);	

			$day = date('w');
			
			$week_start = date('Y-m-d', strtotime('-'.$day.' days'));
			$week_end = date('Y-m-d', strtotime('+'.(6-$day).' days'));
			
			return view('areacurso.listadoventas',[
				"data"=>$arra_data,
				"titulo_pagina"=>'Listado Ventas', 
				"notificaciones"=>$notificaciones,
				"week_start"=>$week_start,
				"week_end"=>$week_end,
				"tipo_filtro"=>$tipo_filtro,
				"menu"=>"billetera"
			]);
		}    	
	}

	//LISTADO DE VENTAS
    public function listadoventasadmin($tipo_filtro=null){
    	$controller = new AdminController();
    	$arra_data=$controller->VerificarSesid();
		if(count($arra_data)==0){
			return view('areacurso.notienespermiso');
		}else{
			$notificaciones=$controller->get_notificaciones($arra_data[0]->IdUsuario);	

			$day = date('w');
			
			$week_start = date('Y-m-d', strtotime('-'.$day.' days'));
			$week_end = date('Y-m-d', strtotime('+'.(6-$day).' days'));
			
			return view('areacurso.listado-ventas-admin',[
				"data"=>$arra_data,
				"titulo_pagina"=>'Listado Ventas', 
				"notificaciones"=>$notificaciones,
				"week_start"=>$week_start,
				"week_end"=>$week_end,
				"tipo_filtro"=>$tipo_filtro,
				"menu"=>"billetera"
			]);
		}    	
	}

	


	 //LISTADO DE VENTAS
	 public function solicitudes($tipo_filtro=null){
    	$controller = new AdminController();
    	$arra_data=$controller->VerificarSesid();
		if(count($arra_data)==0){
			return view('areacurso.notienespermiso');
		}else{
			$notificaciones=$controller->get_notificaciones($arra_data[0]->IdUsuario);	

			$day = date('w');
			
			$week_start = date('Y-m-d', strtotime('-'.$day.' days'));
			$week_end = date('Y-m-d', strtotime('+'.(6-$day).' days'));
			
			return view('areacurso.solicitudes',[
				"data"=>$arra_data,
				"titulo_pagina"=>'Listado Solicitudes', 
				"notificaciones"=>$notificaciones,
				"week_start"=>$week_start,
				"week_end"=>$week_end,
				"tipo_filtro"=>$tipo_filtro,
				"menu"=>"billetera"
			]);
		}    	
	}

	//LISTADO DE VENTAS
    public function listadoretiros(){
    	$controller = new AdminController();
    	$arra_data=$controller->VerificarSesid();
		if(count($arra_data)==0){
			return view('areacurso.notienespermiso');
		}else{
			$notificaciones=$controller->get_notificaciones($arra_data[0]->IdUsuario);	

			$day = date('w');
			
			$week_start = date('Y-m-d', strtotime('-'.$day.' days'));
			$week_end = date('Y-m-d', strtotime('+'.(6-$day).' days'));
			
			return view('areacurso.retiros',[
				"data"=>$arra_data,
				"titulo_pagina"=>'Listado Retiros', 
				"notificaciones"=>$notificaciones,
				"week_start"=>$week_start,
				"week_end"=>$week_end,
				"menu"=>"billetera"
			]);
		}    	
	}
	
	

    //listado de usuarios
    public function listadousuarios($tipo_usuario=null){
    	$controller = new AdminController();
    	$arra_data=$controller->VerificarSesid();
		$rol_solicitud=session('rol_solicitud');
		if(count($arra_data)==0){
			return view('areacurso.notienespermiso');
		}else{

			if($rol_solicitud=="estudiante"){
				return view('areacurso.notienespermiso');
			}

			if($rol_solicitud=="tutor"){
				return view('areacurso.notienespermiso');
			}

			if($rol_solicitud=="afiliado" && $tipo_usuario!="afiliados"){
				return view('areacurso.notienespermiso');
			}

			
			$sql="SELECT c.*, u.NombreUsuario
				  FROM tbl_curso c 
				  INNER JOIN tbl_usuario u ON u.IdUsuario=c.IdUsuarioTutor
				  where c.IdEstado=1";
			$result=DB::select($sql);

			$notificaciones=$controller->get_notificaciones($arra_data[0]->IdUsuario);			
			return view('areacurso.listadousuarios',[
				"data"=>$arra_data,
				"titulo_pagina"=>'Listado Usuarios', 
				"notificaciones"=>$notificaciones,	
				"tipo_usuario"=>$tipo_usuario,
				"cursos"=>$result,
				"menu"=>"billetera"
			]);
		}
    }


    public function listadocursos(){
    	$controller = new AdminController();
    	$arra_data=$controller->VerificarSesid();
		if(count($arra_data)==0){
			return view('areacurso.notienespermiso');
		}else{
			$notificaciones=$controller->get_notificaciones($arra_data[0]->IdUsuario);		

			$cursos=new CursoController();
			$arra_supercategoria=$cursos->get_supercategorias();
			$arra_categoria=$cursos->get_categorias();
			$arra_subcategorias=$cursos->get_subcategorias();

			return view('areacurso.listadocursos',[
				"data"=>$arra_data,
				"titulo_pagina"=>'Listado Cursos', 
				"notificaciones"=>$notificaciones,					
				"supercategorias"=>$arra_supercategoria,
				"categorias"=>$arra_categoria,
				"subcategorias"=>$arra_subcategorias,
				"menu"=>"billetera"
			]);
		}	
    }

    public function get_listado_cursos(Request $request){

    	$input = $request->all();	   	
    	$fechainicio="".$input["fechainicio"];
		$fechafin="".$input["fechafin"];
		$IdSubcategoria="".$input["IdSubcategoria"];
		$EstadoCurso="".$input["EstadoCurso"];
		$PalabraClave="".$input["PalabraClave"];

		$filtro_fecha="";

		if($fechainicio=="" && $fechafin==""){
			$filtro_fecha="";
		}

		if($fechainicio!="" && $fechafin==""){
			$filtro_fecha=" AND  c.FechaCreacion between '{$fechainicio} 00:00:00' and '{$fechainicio} 23:59:59' ";
		}

		if($fechainicio!="" && $fechafin!=""){
			$filtro_fecha=" AND  c.FechaCreacion between '{$fechainicio} 00:00:00' and '{$fechafin} 23:59:59' ";
		}

		$cadena_filtro="";
		if($EstadoCurso!=""){
			$cadena_filtro=" and c.IdEstado={$EstadoCurso} ";
		}

		if($IdSubcategoria!=""){
			$cadena_filtro.=" AND c.IdSubcategoria={$IdSubcategoria} ";
		}

		if($PalabraClave!=""){
			$cadena_filtro.=" AND (c.TituloCurso like '%{$PalabraClave}%' 
								   or c.DescripcionCortaCurso like '%{$PalabraClave}%'
								   or c.DescripcionCurso like '%{$PalabraClave}%'
								) ";
		}


		$sql="SELECT c.*, u.NombreUsuario, s.NombreSubcategoria,(
			     SELECT t.CodigoTema 
			     from tbl_modulo m
			     INNER JOIN tbl_tema t ON t.IdModulo=m.IdModulo and t.IdEstado=1 AND t.OrdenTema=1
			     WHERE m.IdCurso=c.IdCurso and m.IdEstado=1
			     LIMIT 1
			  )as CodigoTema, e.NombreEstado
			  FROM tbl_curso c
			  INNER JOIN tbl_usuario_persona up ON up.IdUsuarioPersona = c.IdUsuarioTutor
			  INNER JOIN tbl_usuario u ON u.IdUsuario=up.IdUsuario
			  INNER JOIN tbl_persona p ON p.IdPersona=up.IdPersona
			  INNER JOIN tbl_subcategoria s ON s.IdSubcategoria=c.IdSubcategoria
			  INNER JOIN tbl_categoria_cursos ca ON ca.IdCategoriaCursos=s.IdCategoria
			  INNER JOIN tbl_estado e ON e.IdEstado=c.IdEstado
			  WHERE 1 {$filtro_fecha} {$cadena_filtro}";

		$result=DB::select($sql);
		return response()->json(["status"=>'ok',"datos"=>$result]);

    }

    public function get_ventas_usuario(Request $request){	
    	$input = $request->all();	
		$fechainicio="".$input["fechainicio"];
		$fechafin="".$input["fechafin"];
		$encanje="".$input["encanje"];

		$filtro_fecha="";

		if($fechainicio=="" && $fechafin==""){
			$filtro_fecha="";
		}

		if($fechainicio!="" && $fechafin==""){
			$filtro_fecha=" AND  uc.FechaCreacion between '{$fechainicio} 00:00:00' and '{$fechainicio} 23:59:59' ";
		}

		if($fechainicio!="" && $fechafin!=""){
			$filtro_fecha=" AND  uc.FechaCreacion between '{$fechainicio} 00:00:00' and '{$fechafin} 23:59:59' ";
		}


		if($encanje!=""){
			$filtro_fecha.=" AND  uc.EnCanje={$encanje}";
		}	
		
		

		$rol_solicitud=session('rol_solicitud');
		$arra_data=$this->VerificarSesid();

		if($rol_solicitud=="afiliado"){			
			$filtro_fecha.=" AND  uc.IdAfiliado={$arra_data[0]->IdUsuario}";
		}

		if($rol_solicitud=="tutor"){			
			$filtro_fecha.=" AND  uc.IdTutor={$arra_data[0]->IdUsuario}";
		}		
		

		//$id_usuario_persona=$arra_data[0]->IdUsuarioPersona;
		// u.IdUsuarioPadre={$id_usuario_persona}

		//ValorPrecioProducto

		
		$sql="SELECT uc.*, c.NombreCurso, u.NombreUsuario as UsuarioCliente, ua.NombreUsuario as UsuarioAfiliado, ut.NombreUsuario as UsuarioTutor,
		ep.NombreEstado as NombreEstadoPedido
		FROM tbl_usuario_curso uc
		INNER JOIN tbl_curso c ON c.IdCurso=uc.IdCurso
		INNER JOIN tbl_estado ep ON ep.IdEstado=uc.IdEstado AND ep.IdEstado=1
		
		/*CLIENTE*/
		LEFT JOIN tbl_usuario_persona up ON up.IdUsuarioPersona=uc.IdUsuarioPersona
		LEFT JOIN tbl_usuario u ON u.IdUsuario = up.IdUsuario
		LEFT JOIN tbl_persona p ON p.IdPersona = up.IdPersona
		
		/*AFILIADO*/
		LEFT JOIN tbl_usuario_persona upa ON upa.IdUsuarioPersona=uc.IdAfiliado
		LEFT JOIN tbl_usuario ua ON ua.IdUsuario = upa.IdUsuario
		LEFT JOIN tbl_persona pa ON pa.IdPersona = upa.IdPersona
		
		/*TUTOR*/
		LEFT JOIN tbl_usuario_persona upt ON upt.IdUsuarioPersona=uc.IdTutor
		LEFT JOIN tbl_usuario ut ON ut.IdUsuario = upt.IdUsuario
		LEFT JOIN tbl_persona pt ON pt.IdPersona = upt.IdPersona
		
		where 1 $filtro_fecha
		";

		$result=DB::select($sql);
		return response()->json(["status"=>'ok',"datos"=>$result]);


	}


	public function get_ventas_usuario_admin(Request $request){	
    	$input = $request->all();	
		$fechainicio="".$input["fechainicio"];
		$fechafin="".$input["fechafin"];
		$encanje="".$input["encanje"];

		$filtro_fecha="";

		if($fechainicio=="" && $fechafin==""){
			$filtro_fecha="";
		}

		if($fechainicio!="" && $fechafin==""){
			$filtro_fecha=" AND  uc.FechaCreacion between '{$fechainicio} 00:00:00' and '{$fechainicio} 23:59:59' ";
		}

		if($fechainicio!="" && $fechafin!=""){
			$filtro_fecha=" AND  uc.FechaCreacion between '{$fechainicio} 00:00:00' and '{$fechafin} 23:59:59' ";
		}


		if($encanje!=""){
			$filtro_fecha.=" AND  uc.EnCanje={$encanje}";
		}	
		
		//$id_usuario_persona=$arra_data[0]->IdUsuarioPersona;
		// u.IdUsuarioPadre={$id_usuario_persona}

		//ValorPrecioProducto

		
		$sql="SELECT uc.*, c.NombreCurso, u.NombreUsuario as UsuarioCliente, ua.NombreUsuario as UsuarioAfiliado, ut.NombreUsuario as UsuarioTutor,
		ep.NombreEstado as NombreEstadoPedido
		FROM tbl_usuario_curso uc
		INNER JOIN tbl_curso c ON c.IdCurso=uc.IdCurso and uc.IdCurso!=11
		INNER JOIN tbl_estado ep ON ep.IdEstado=uc.IdEstado
		
		/*CLIENTE*/
		LEFT JOIN tbl_usuario_persona up ON up.IdUsuarioPersona=uc.IdUsuarioPersona
		LEFT JOIN tbl_usuario u ON u.IdUsuario = up.IdUsuario
		LEFT JOIN tbl_persona p ON p.IdPersona = up.IdPersona
		
		/*AFILIADO*/
		LEFT JOIN tbl_usuario_persona upa ON upa.IdUsuarioPersona=uc.IdAfiliado
		LEFT JOIN tbl_usuario ua ON ua.IdUsuario = upa.IdUsuario
		LEFT JOIN tbl_persona pa ON pa.IdPersona = upa.IdPersona
		
		/*TUTOR*/
		LEFT JOIN tbl_usuario_persona upt ON upt.IdUsuarioPersona=uc.IdTutor
		LEFT JOIN tbl_usuario ut ON ut.IdUsuario = upt.IdUsuario
		LEFT JOIN tbl_persona pt ON pt.IdPersona = upt.IdPersona
		
		where 1 $filtro_fecha
		";

		$result=DB::select($sql);
		return response()->json(["status"=>'ok',"datos"=>$result,"sql"=>$sql]);


	}


	public function get_retiros(Request $request){	
		$input = $request->all();
			
		$fechainicio="".$input["fechainicio"];
		$fechafin="".$input["fechafin"];
		$estado="".$input["estado"];

		$filtro_fecha="";
		if($fechainicio=="" && $fechafin==""){
			$filtro_fecha="";
		}

		if($fechainicio!="" && $fechafin==""){
			$filtro_fecha.=" AND r.FechaCreacion='{$fechainicio}' ";
		}

		if($fechainicio!="" && $fechafin!=""){
			$filtro_fecha.=" AND  r.FechaCreacion between '{$fechainicio}' and '{$fechafin}' ";
		}


		if($estado!=""){
			$filtro_fecha.=" AND  r.IdEstadoRetiro={$estado}";
		}	



		$sql="SELECT r.*, u.NombreUsuario
		FROM tbl_retiros r
		INNER JOIN tbl_usuario_persona up ON up.IdUsuarioPersona=r.IdUsuarioPersona
		INNER JOIN tbl_usuario u ON u.IdUsuario=up.IdUsuario
		INNER JOIN tbl_persona p ON p.IdPersona=up.IdPersona
		INNER JOIN tbl_rol ro ON ro.IdRol=r.IdRol
		WHERE 1 {$filtro_fecha}
		";
		$result=DB::select($sql);
		return response()->json(["status"=>'ok',"datos"=>$result]);
	}

	
	public function get_info_usuario_by_codigo(Request $request){	
    	$input = $request->all();	
		$codigo_usuario="".$input["codigo_usuario"];

		$sql="SELECT p.*
		FROM tbl_usuario_persona up 
		INNER JOIN tbl_usuario u ON u.IdUsuario = up.IdUsuario
		INNER JOIN tbl_persona p ON p.IdPersona = up.IdPersona
		WHERE u.NombreUsuario='{$codigo_usuario}'
		";
		$result=DB::select($sql);
		return response()->json(["status"=>'ok',"datos"=>$result]);

	}


    public function get_ventas($id_usuario_persona){
		$sql="SELECT p.*, c.NombreCurso, ppr.ValorPrecioProducto, u.NombreUsuario
				from tbl_persona p
				INNER JOIN tbl_usuario_persona up ON up.IdPersona=p.IdPersona
				INNER JOIN tbl_usuario u ON u.IdUsuario = up.IdUsuario
				INNER JOIN tbl_usuario_curso uc ON uc.IdUsuarioPersona=up.IdUsuarioPersona
				INNER JOIN tbl_curso c ON c.IdCurso = uc.IdCurso
				INNER JOIN tbl_producto pr ON pr.IdCurso=c.IdCurso
				INNER JOIN tbl_precio_producto ppr ON ppr.IdProducto=pr.IdProducto
				where u.IdUsuarioPadre={$id_usuario_persona}";
		$result=DB::select($sql);
		return $result;
    }



     public function get_ventas_principal(Request $request){

    	$input = $request->all();	   	
    	$fechainicio="".$input["fechainicio"];
		$fechafin="".$input["fechafin"];
		$idusuario="".$input["idusuario"];
		$tipo_reporte="".$input["tipo_reporte"];
		$id_estado_pedido="".$input["id_estado_pedido"];

		$select_campo="";
		$group="";
		if($tipo_reporte=="reporte-venta"){
			$select_campo="SUM(uc.PrecioCurso) AS PrecioCurso, DATE(uc.FechaCreacion)as FechaCreacion";
			$group="GROUP BY DATE(uc.FechaCreacion)";
		}

		$consulta="";

		if($fechainicio!="" && $fechafin==""){
			$consulta=" AND uc.FechaCreacion='{$fechainicio}' ";
		}

		if($fechainicio!="" && $fechafin!=""){
			$consulta=" AND  uc.FechaCreacion between '{$fechainicio}' and '{$fechafin}' ";
		}

		if($idusuario!=""){
			$consulta.=" AND  u.IdUsuarioPersona={$idusuario} ";
		}

		if($id_estado_pedido!=""){
			$consulta.=" AND  uc.IdEstadoPedido={$id_estado_pedido} ";	
		}



		$sql="SELECT  {$select_campo}
				FROM tbl_usuario_curso uc 
				INNER JOIN tbl_curso c ON c.IdCurso = uc.IdCurso				
				INNER JOIN tbl_usuario_persona up ON up.IdUsuarioPersona = uc.IdUsuarioPersona
				INNER JOIN tbl_usuario u ON u.IdUsuario = up.IdUsuario
				INNER JOIN tbl_estado_pedido ep ON ep.IdEstadoPedido=uc.IdEstadoPedido
				WHERE 1 {$consulta}
				{$group}
				";
		$result=DB::select($sql);
		return response()->json(["status"=>'ok',"datos"=>$result,"sql"=>$sql]);
	}


	public function listado_solicitudes(Request $request){

    	$input = $request->all();	   	
    	$fechainicio="".$input["fechainicio"];
		$fechafin="".$input["fechafin"];		
		$EstadoSolicitud="".$input["EstadoSolicitud"];

		$select_campo="";
		$group="";
		$consulta="";

		if($fechainicio!="" && $fechafin==""){
			$consulta=" AND s.FechaCreacion='{$fechainicio}' ";
		}

		if($fechainicio!="" && $fechafin!=""){
			$consulta=" AND  s.FechaCreacion between '{$fechainicio}' and '{$fechafin}' ";
		}

		

		if($EstadoSolicitud!=""){
			$consulta.=" AND  s.EstadoSolicitudAfiliacion={$EstadoSolicitud} ";	
		}

		$arra_data=$this->VerificarSesid();

		$IdUsuario=$arra_data[0]->IdUsuario;

		$sql="SELECT s.*, c.NombreCurso, u.NombreUsuario
		FROM tbl_solicitud_afiliacion s
		INNER JOIN tbl_curso c ON c.IdCurso=s.IdCurso
		INNER JOIN tbl_usuario_persona up ON up.IdUsuario=s.IdUsuarioPersona
		INNER JOIN tbl_usuario u ON u.IdUsuario=up.IdUsuario
		WHERE c.IdUsuarioTutor={$IdUsuario}  {$consulta} ";
		$result=DB::select($sql);
		return response()->json(["status"=>'ok',"datos"=>$result]);
	}

	public function cambiar_solicitud(Request $request){

    	$input = $request->all();	   	
    	$IdUsuario="".$input["IdUsuario"];		
		$EstadoSolicitud="".$input["EstadoSolicitud"];

		$sql="UPDATE tbl_solicitud_afiliacion SET EstadoSolicitudAfiliacion='{$EstadoSolicitud}' where IdUsuarioPersona={$IdUsuario}";
		$result=DB::update($sql);
		return response()->json(["status"=>'ok',"mensaje"=>"Proceso generado correctamente"]);

	}


	public function listadoestudiantes(){
		$controller = new AdminController();
    	$arra_data=$controller->VerificarSesid();
		if(count($arra_data)==0){
			return view('areacurso.notienespermiso');
		}else{
			$notificaciones=$controller->get_notificaciones($arra_data[0]->IdUsuario);	

			$day = date('w');
			
			$week_start = date('Y-m-d', strtotime('-'.$day.' days'));
			$week_end = date('Y-m-d', strtotime('+'.(6-$day).' days'));
			
			return view('areacurso.listadoestudiantes',[
				"data"=>$arra_data,
				"titulo_pagina"=>'Listado Estudiantes', 
				"notificaciones"=>$notificaciones,
				"week_start"=>$week_start,
				"week_end"=>$week_end,				
				"menu"=>"billetera"
			]);
		}    	
		
	}


	public function listado_estudiantes(Request $request){

    	$input = $request->all();	   	
    	$fechainicio="".$input["fechainicio"];
		$fechafin="".$input["fechafin"];
		$tiporesultado="".$input["tiporesultado"];

		$filtro_fecha="";

		if($fechainicio=="" && $fechafin==""){
			$filtro_fecha="";
		}

		if($fechainicio!="" && $fechafin==""){
			$filtro_fecha=" AND uc.FechaCreacion='{$fechainicio}' ";
		}

		if($fechainicio!="" && $fechafin!=""){
			$filtro_fecha=" AND  uc.FechaCreacion between '{$fechainicio}' and '{$fechafin}' ";
		}
		$arra_data=$this->VerificarSesid();
		
		$sql="SELECT uc.*, p.NombrePersona, p.ApellidosPersona, u.NombreUsuario,c.NombreCurso, ep.NombreEstadoPedido
		FROM tbl_usuario_curso uc
		INNER JOIN tbl_usuario_persona up ON up.IdUsuarioPersona=uc.IdUsuarioPersona
		INNER JOIN tbl_usuario u ON u.IdUsuario = up.IdUsuario
		INNER JOIN tbl_persona p ON p.IdPersona=up.IdPersona
		INNER JOIN tbl_curso c ON c.IdCurso=uc.IdCurso		
		INNER JOIN tbl_estado_pedido ep ON ep.IdEstadoPedido=uc.IdEstadoPedido
		WHERE 1 {$filtro_fecha} and uc.IdTutor={$arra_data[0]->IdUsuarioPersona}
		";
		$result=DB::select($sql);
		
		return response()->json(["status"=>'ok',"datos"=>$result]);
			
		
	}

	public function get_cantidad_estudiantes($IdUsuarioPersona){

		$sql="SELECT uc.*, p.NombrePersona, p.ApellidosPersona, u.NombreUsuario,c.NombreCurso, ep.NombreEstadoPedido
		FROM tbl_usuario_curso uc
		INNER JOIN tbl_usuario_persona up ON up.IdUsuarioPersona=uc.IdUsuarioPersona
		INNER JOIN tbl_usuario u ON u.IdUsuario = up.IdUsuario
		INNER JOIN tbl_persona p ON p.IdPersona=up.IdPersona
		INNER JOIN tbl_curso c ON c.IdCurso=uc.IdCurso		
		INNER JOIN tbl_estado_pedido ep ON ep.IdEstadoPedido=uc.IdEstadoPedido
		WHERE uc.IdTutor={$IdUsuarioPersona}
		";
		$result=DB::select($sql);

		return count($result);

	}
	
	

    //

    public function listado_usuarios(Request $request){

    	$input = $request->all();	   	
    	$fechainicio="".$input["fechainicio"];
		$fechafin="".$input["fechafin"];
		$TipoUsuario="".$input["TipoUsuario"];
		$EstadoSolicitud="".$input["estadosolicitud"];
		
		
		$filtro_fecha="";

		if($fechainicio=="" && $fechafin==""){
			$filtro_fecha="";
		}

		if($fechainicio!="" && $fechafin==""){
			$filtro_fecha=" AND P.FechaCreacion='{$fechainicio}' ";
		}

		if($fechainicio!="" && $fechafin!=""){
			$filtro_fecha=" AND  P.FechaCreacion between '{$fechainicio}' and '{$fechafin}' ";
		}

		$consulta_afiliados="";
		if($TipoUsuario=="1"){
			if($EstadoSolicitud==""){
				$consulta_afiliados=" and u.IdEstadoSolicitudAfiliado is not null ";				
			}else{
				$consulta_afiliados=" and u.IdEstadoSolicitudAfiliado ={$EstadoSolicitud} ";				
			}			
		}

		$consulta_tutores="";
		if($TipoUsuario=="2"){
			if($EstadoSolicitud==""){
				$consulta_tutores=" and u.IdEstadoSolicitudTutor is not null ";			
			}else{
				$consulta_tutores=" and u.IdEstadoSolicitudTutor={$EstadoSolicitud} ";			
			}
		}elseif($TipoUsuario=="1,2"){
			if($EstadoSolicitud==""){
				$consulta_tutores=" and (u.IdEstadoSolicitudTutor is not null  or u.IdEstadoSolicitudAfiliado is not null) ";			
			}else{
				$consulta_tutores=" and (u.IdEstadoSolicitudTutor={$EstadoSolicitud} or u.IdEstadoSolicitudAfiliado={$EstadoSolicitud}) ";			
			}
		}

		if($TipoUsuario=="" && $EstadoSolicitud!=""){
			$consulta_tutores=" and (u.IdEstadoSolicitudTutor={$EstadoSolicitud} or u.IdEstadoSolicitudAfiliado={$EstadoSolicitud}) ";			
		}

		if(isset($input["estadosolicitudhotmart"])){
			$consulta_afiliados.=" and u.AprobacionHotmart = ".$input["estadosolicitudhotmart"];
		}


		$rol_solicitud=session('rol_solicitud');
		$consulta_padre="";
		if($rol_solicitud=="afiliado"){
			$arra_data=$this->VerificarSesid();
			$consulta_padre=" AND u.IdUsuarioPadre={$arra_data[0]->IdUsuario}";
		}

		

    	//$idtema="".$input["idtema"];
    	$sql="SELECT up.* , p.*, u.*
    		  FROM tbl_usuario_persona up
    		  INNER JOIN tbl_usuario u ON u.IdUsuario = up.IdUsuario {$consulta_padre}
    		  INNER JOIN tbl_persona p ON p.IdPersona = up.IdPersona
    		  WHERE 1 {$filtro_fecha}  {$consulta_afiliados} {$consulta_tutores}
    		  ";
    	$result=DB::select($sql);
		return response()->json(["status"=>'ok',"datos"=>$result,"sql"=>$sql]);
    }

    public function estado_solicitud(Request $request){

    	$input = $request->all();	   	
    	$IdUsuario="".$input["IdUsuario"];
		$tipo_respuesta="".$input["tipo_respuesta"];
		$id_estado="".$input["id_estado"];
		$respuesta="".addslashes($input["respuesta"]);
		$email="".$input["email"];

		$cadena_campos="";
		$EstadoSolicitud="";
		$RespuestaSolicitud="{$respuesta}";

		if($tipo_respuesta=="3"){
			$cadena_campos="RespuestaAfiliado='{$respuesta}', IdEstadoSolicitudAfiliado='{$id_estado}' ";
			$EstadoSolicitud="RECHAZADA";
		}else{
			$cadena_campos="RespuestaTutor='{$respuesta}', IdEstadoSolicitudTutor='{$id_estado}' ";
			$EstadoSolicitud="ACEPTADA";
		}

		$sql="UPDATE tbl_usuario SET {$cadena_campos} where IdUsuario={$IdUsuario}";
		$result=DB::update($sql);


		//ENVIAR MENSAJE DE RESPUESTA
		$objDemo = new \stdClass();        
        $objDemo->email_para = "{$email}";
		$objDemo->EstadoSolicitud = "{$EstadoSolicitud}";
		$objDemo->RespuestaSolicitud = "{$RespuestaSolicitud}";

		$controller_email=new EmailController();
		$controller_email->enviar_mensaje_respuesta($objDemo);
		//ENVIAR MENSAJE DE RESPUESTA




		return response()->json(["status"=>'ok',"mensaje"=>"Proceso generado correctamente"]);

	}


	public function cambiar_destacado(Request $request){

    	$input = $request->all();	   	
    	$IdCurso="".$input["IdCurso"];
		$IdDestacado="".$input["IdDestacado"];		
		//$email="".$input["email"];
		

		$sql="UPDATE tbl_curso SET  IdDestacado={$IdDestacado}  where IdCurso={$IdCurso}";
		$result=DB::update($sql);
		return response()->json(["status"=>'ok',"mensaje"=>"Proceso generado correctamente"]);

	}
	
	

    public function estado_solicitud_cursos(Request $request){

    	$input = $request->all();	   	
    	$IdCurso="".$input["IdCurso"];		
		$id_estado="".$input["id_estado"];
		$respuesta="".addslashes($input["respuesta"]);
		//$email="".$input["email"];			
		$cadena_campos="ObservacionSolicitudCurso='{$respuesta}', IdEstado='{$id_estado}' ";		

		$sql="UPDATE tbl_curso SET {$cadena_campos} where IdCurso={$IdCurso}";
		$result=DB::update($sql);
		return response()->json(["status"=>'ok',"mensaje"=>"Proceso generado correctamente"]);

    }

    public function fichatutor($tutor,$id_afiliado=null){

		$usuario_afiliado="";
		if($id_afiliado){
			$sql="SELECT * FROM tbl_usuario where IdUsuario={$id_afiliado}";
			$result_usuario_afiliado=DB::select($sql);	
			for($i=0;$i<count($result_usuario_afiliado);$i++){
				$usuario_afiliado="".$result_usuario_afiliado[$i]->NombreUsuario;
			}
		}
			
		$sql="SELECT up.* , p.*, u.*
    		  FROM tbl_usuario_persona up
    		  INNER JOIN tbl_usuario u ON u.IdUsuario = up.IdUsuario
			  INNER JOIN tbl_persona p ON p.IdPersona = up.IdPersona
			  WHERE u.NombreUsuario='{$tutor}'
			  ";
		$result=DB::select($sql);
		
		$nombre_tutor="";
		$descripcion_tutor="";
		$foto_tutor="";
		if(count($result)>0){
			$nombre_tutor="".$result[0]->NombrePersona." ".$result[0]->ApellidosPersona;
			$descripcion_tutor="".$result[0]->DescripcionPersona;
			$foto_tutor="".$result[0]->FotoPersona;
		}
		


    	return view('marketing.fichatutor',[
    		"descripcion_tutor"=>"{$descripcion_tutor}", 
    		"nombre_tutor"=>"{$nombre_tutor}", 
			"titulo_tutor"=>"titulo_tutor", 
			"titulo_pagina"=>"{$nombre_tutor}",
			"descripcion_pagina"=>"",
			"id_pagina"=>"tutores",
			"url_categoria"=>"",
			"id_subcategoria"=>"",
			"foto_tutor"=>"{$foto_tutor}",
			"tutor"=>$result,
			"usuario_afiliado"=>$usuario_afiliado

    	]);
    }

    


    public static function createSlug($str, $delimiter = '-'){

	    $slug = strtolower(trim(preg_replace('/[\s-]+/', $delimiter, preg_replace('/[^A-Za-z0-9-]+/', $delimiter, preg_replace('/[&]/', 'and', preg_replace('/[\']/', '', iconv('UTF-8', 'ASCII//TRANSLIT', $str))))), $delimiter));
	    return $slug;

	} 


	public function UploadImage($imagen,$propiedades){
    	$nombreImagen="";
    	$propiedades=(Object)$propiedades;
    	if ($imagen){
    		$extensionfoto = $imagen->getClientOriginalExtension();
			$extensionfoto=strtolower($extensionfoto);

			$size = $imagen->getSize();
			if($propiedades->size<$size){				
				return array("status"=>'error',"mensaje"=>"El tamaño del archivo debe ser menor a ".($propiedades->size*1024)."Kb");
			}

			$nombreArchivo = $propiedades->prefijo."_".$propiedades->filename.".".$extensionfoto;			
			$imagen->move($propiedades->path, $nombreArchivo);

			return array("status"=>'ok',"nombre"=>$nombreArchivo);


    	}
	}
	

	public function UploadVideo($imagen,$propiedades){

		//include(app_path() . '\vendor\vimeo\vimeo-api\Vimeo.php');


    	$nombreImagen="";
    	$propiedades=(Object)$propiedades;
    	if ($imagen){
    		$extensionfoto = $imagen->getClientOriginalExtension();
			$extensionfoto=strtolower($extensionfoto);

			$size = $imagen->getSize();
			if($propiedades->size<$size){
				return array("status"=>'error',"mensaje"=>"El tamaño del archivo debe ser menor a ".($propiedades->size*1024)."Kb");
			}

			$nombreArchivo = $propiedades->prefijo."_".$propiedades->filename.".".$extensionfoto;			
			$imagen->move($propiedades->path, $nombreArchivo);

			$full_video_path="".$propiedades->path."/".$nombreArchivo;

			//$client = new \Vimeo\Vimeo("8ee6acdaaabe7c02e65a65c5891738165373c580", "rcCnE1VZHH3YJIaXVrLM9KsnJaDoyMfnPvCl/rWHySia0NSOu8Xh68InhNUQKLc4q03qvYdErz1nh02li02OgNtMPKTDc24fZ0yw8jDMi0/sPxBJup+xYGV/gCevXx5H", "https://api.vimeo.com/oauth/access_token");

			//$response = $client->upload($propiedades->path."/".$nombreArchivo);
			
			/*$getID3 = new \getID3;
    		$file = $getID3->analyze($full_video_path);
    		$playtime_seconds = $file['playtime_seconds'];
			$duration = date('i', $playtime_seconds);*/
			
			


			return array("status"=>'ok',"nombre"=>$nombreArchivo,"duracion"=>"0");


    	}
    }



    public function enviar_solicitud(Request $request){	
    	$input = $request->all();	
		$TipoSolicitud="".$input["TipoSolicitud"];
		$TextoSolicitud="".$input["TextoSolicitud"];
		$campos_solicitud="";



		$arra_data=$this->VerificarSesid();
		if(count($arra_data)>0){			
			$id_usuario_persona=$arra_data[0]->IdUsuario;
			if($TipoSolicitud=="2"){
				$campos_solicitud="SolicitudTutor='{$TextoSolicitud}', IdEstadoSolicitudTutor='2'";
			}else{
				$campos_solicitud="SolicitudAfiliado='{$TextoSolicitud}', IdEstadoSolicitudAfiliado='2'";
			}

			$sql="UPDATE tbl_usuario SET {$campos_solicitud}  where IdUsuario={$id_usuario_persona}";
			$result=DB::update($sql);
			return response()->json(["status"=>'ok',"mensaje"=>"Gracias, hemos recibido tu solicitud, en 24 a 48 horas estaremos en contacto contigo"]);

		}else{
			return array("status"=>'ok',"mensaje"=>"La sesión a caducado");
		}

    }


    public function enviar_mensaje_generico(Request $request){	
    	$input = $request->all();	
		$NombreMensaje="".$input["NombreMensaje"];
		$EmailMensaje="".$input["EmailMensaje"];		
		$AsuntoMensaje="".addslashes($input["AsuntoMensaje"]);
		$ObservacionMensaje="".addslashes($input["ObservacionMensaje"]);
		$TipoMensaje="".$input["TipoMensaje"];
		$campos_solicitud="";
		
		$sql="INSERT INTO tbl_mensajes SET NombreMensaje='$NombreMensaje', 
			  EmailMensaje='$EmailMensaje',
			  AsuntoMensaje='$AsuntoMensaje',
			  ObservacionMensaje='$ObservacionMensaje',
			  TipoMensaje='$TipoMensaje',
			  FechaCreacion=now()";
		$result=DB::insert($sql);
		return response()->json(["status"=>'ok',"mensaje"=>"Gracias, hemos recibido tu mensaje, en 24 a 48 horas estaremos en contacto contigo"]);
	}
	

	


    public function registrar_trafico(Request $request){	
    	$input = $request->all();	
		$IdCurso="".$input["IdCurso"];

		if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
		    $ip = $_SERVER['HTTP_CLIENT_IP'];
		} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
		    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
		} else {
		    $ip = $_SERVER['REMOTE_ADDR'];
		}


		$IpTrafico="".$ip;
		$OrigenTrafico="".addslashes($input["OrigenTrafico"]);
		$IdAfiliado="".addslashes($input["IdAfiliado"]);		

		$cadena_afiliado="";
		if($IdAfiliado!=""){
			$cadena_afiliado=" IdAfiliado='$IdAfiliado', ";
		}
		
		$campos_solicitud="";		
		$sql="INSERT INTO tbl_traficocurso SET IdCurso='$IdCurso', 
			  IpTrafico='$IpTrafico',
			  OrigenTrafico='$OrigenTrafico',
			  {$cadena_afiliado}
			  FechaTrafico=now()";
		$result=DB::insert($sql);
		return response()->json(["status"=>'ok']);
	}
	
	public function registrar_deseo(Request $request){	
		$arra_data=$this->VerificarSesid();
		if(count($arra_data)==0){
			return array("status"=>'error',"mensaje"=>"Su sesión ha caducado");
		}

    	$input = $request->all();	
		$IdCurso="".$input["IdCurso"];
		$IdUsuario="".$arra_data[0]->IdUsuario;
		

		$arra_deseos=$this->get_deseos($IdCurso);
		$IdEstado="1";
		if(count($arra_deseos)==0){

			$IdEstado="1";

			$sql="INSERT INTO tbl_deseos SET IdCurso='{$IdCurso}', IdUsuario='{$IdUsuario}', FechaDeseo=now(), IdEstado={$IdEstado}";
			$result=DB::insert($sql);	
		}else{
			
			if($arra_deseos[0]->IdEstado=="1"){
				$IdEstado="0";
			}

			$sql="UPDATE tbl_deseos SET FechaDeseo=now(), IdEstado={$IdEstado} WHERE IdCurso='{$IdCurso}' and IdUsuario='{$IdUsuario}' ";
			$result=DB::update($sql);	
		}
		
		
		return response()->json(["status"=>'ok',"estado_deseo"=>$IdEstado]);
	}
	
	public function get_deseos($idcurso=null,$id_estado=null){
		$arra_data=$this->VerificarSesid();
		if(count($arra_data)==0){
			return array("status"=>'error',"mensaje"=>"Su sesión ha caducado");
		}

		$consulta="";
		if($idcurso){
			$consulta=" AND IdCurso={$idcurso}";
		}

		if($id_estado){
			$consulta.=" AND IdEstado={$id_estado}";
		}

		$sql="SELECT * from tbl_deseos where IdUsuario={$arra_data[0]->IdUsuario} $consulta";
		$result=DB::select($sql);
		return $result;

	}


	



    public function time_passed($get_timestamp)
	{
	        $timestamp = strtotime($get_timestamp);
	        $diff = time() - (int)$timestamp;
	 
	        if ($diff == 0) 
	             return 'justo ahora';
	 
	        if ($diff > 31556926)
	            return date("d M Y",$timestamp);
	 
	        $intervals = array
	        (
	            //1                   => array('año',    31556926),
	            $diff < 31556926    => array('mes',   2628000),
	            $diff < 31556926    => array('mes',   2628000),
	            $diff < 2629744     => array('semana',    604800),
	            $diff < 604800      => array('día',     86400),
	            $diff < 86400       => array('hora',    3600),
	            $diff < 3600        => array('minuto',  60),
	            $diff < 60          => array('segundo',  1)
	        );
	 
	        $value = floor($diff/$intervals[1][1]);
	        return 'hace '.$value.' '.$intervals[1][0].($value > 1 ? 's' : '');
	}




	public function video_info($url) {

		// Handle Youtube
		if (strpos($url, "youtube.com") || strpos($url, "youtu.be")) {
		   /* $url = parse_url($url);
			$vid = parse_str($url['query'], $output);
			$video_id = $output['v']; */
			
			preg_match("#(?<=v=)[a-zA-Z0-9-]+(?=&)|(?<=v\/)[^&\n]+(?=\?)|(?<=v=)[^&\n]+|(?<=youtu.be/)[^&\n]+#", $url, $matches);
			
			$data['video_type'] = 'youtube';
			$data['video_id'] = $matches[0];

			
		} // End Youtube

		// Handle Vimeo
		else if (strpos($url, "vimeo.com")) {
			$video_id=explode('vimeo.com/', $url);
			$video_id=$video_id[1];
			$data['video_type'] = 'vimeo';
			$data['video_id'] = $video_id;			
		} // End Vimeo

		// Set false if invalid URL
		else { $data = false; }

	return $data;

	}

	public function obtenerVideoURL($url, $tipo,$poster="")
	{
		if($tipo!="1"){
			if($url==""){
				return false;
			}
			$rowVideo = $this->video_info($url);
			if(sizeof($rowVideo) && $rowVideo!=false)
			{
				if($rowVideo['video_type']=='vimeo')
				{
					
					$video="https://player.vimeo.com/video/{$rowVideo['video_id']}";
				}
				elseif($rowVideo['video_type']=='youtube')
				{
					$video="https://www.youtube.com/embed/{$rowVideo['video_id']}";
				}

				return '<iframe  class="embed-responsive-item"  style="" src="'.$video.'" frameborder="0"  allow="autoplay; fullscreen" allowfullscreen></iframe>';
			}
			else
			{
				return false;
			}			
		}else{
			$url=url('')."/".$url;
			$poster_embed='';
			if($poster!=""){
				$poster_embed='poster="'.$poster.'"';
			}			
			$cadena_video='<video id="player_video" controlsList="nodownload" class="video-js vjs-playback-rate embed-responsive-item " controls="true" preload="true" rate="true" data-setup="{}" '.$poster_embed.' ><source src="'.$url.'" type="video/mp4" /><p class="vjs-no-js">To view this video please enable JavaScript, and consider upgrading to a web browser that <a href="https://videojs.com/html5-video-support/" target="_blank">supports HTML5 video</a ></p></video>';
			return $cadena_video;
		}
	}


	public function respuesta(){
		$arra_data=$this->VerificarSesid();
		$controller_curso = new CursoController();

		$ref_payco="".$_REQUEST["ref_payco"];

		$result_curso="";
		
		$data_epayco=file_get_contents("https://api.secure.payco.co/validation/v1/reference/".$ref_payco);
		$data = json_decode($data_epayco);		

		$datos_transaccion=$data->data;

				
		if($datos_transaccion){
			$p_cust_id_cliente='72305';
			$p_key='eb6b964eee7f7ce4957276a16cc0635f5d16e228';

			$x_ref_payco=$datos_transaccion->x_ref_payco;
			$x_transaction_id=$datos_transaccion->x_transaction_id;
			$x_amount=$datos_transaccion->x_amount;
			$x_currency_code=$datos_transaccion->x_currency_code;
			$x_signature=$datos_transaccion->x_signature;

			$signature=hash('sha256',
					$p_cust_id_cliente.'^'
					.$p_key.'^'
					.$x_ref_payco.'^'
					.$x_transaction_id.'^'
					.$x_amount.'^'
					.$x_currency_code
				);

			$x_response=$datos_transaccion->x_response;
			$x_motivo=$datos_transaccion->x_response_reason_text;
			$x_id_invoice=$datos_transaccion->x_id_invoice;
			$x_autorizacion=$datos_transaccion->x_approval_code;

			if($x_signature==$signature){

				$x_cod_response=$datos_transaccion->x_cod_response;

				$id_estado="";
				
				switch ((int)$x_cod_response) {
					case 1:
						# code transacción aceptada			
						$id_estado="1";

						break;
					case 2:
						# code transacción rechazada
						
						$id_estado="3";
						break;
					case 3:
						# code transacción pendiente
						$id_estado="3";
						break;
					case 4:
						# code transacción fallida
						$id_estado="3";
						break;              
					
				}


				
				$sql="	UPDATE tbl_usuario_curso SET IdEstado={$id_estado}, 
					  	IdEstadoTransaccion={$x_cod_response}, 
					    ReferenciaPago='{$x_ref_payco}',						
						TransaccionPago='{$x_transaction_id}',						
            			FechaCompra=now()
						WHERE CodigoTransaccion='{$x_id_invoice}'";									
				$result=DB::update($sql);

				
				
				$sql="select c.* 
				from tbl_usuario_curso uc
				inner join tbl_curso c ON c.IdCurso = uc.IdCurso
				where uc.CodigoTransaccion='{$x_id_invoice}'";
				$result_curso=DB::select($sql);
				
			}else{
				return "Firma no valida";
			}
		}

		//return $ref_payco;
		return view('marketing.respuesta',["id_pagina"=>"respuesta","curso_compra"=>$result_curso]);
	}


	public function eliminar_cuenta(Request $request){	
		$arra_data=$this->VerificarSesid();
		if(count($arra_data)==0){
			return array("status"=>'error',"mensaje"=>"Su sesión ha caducado");
		}

    	$input = $request->all();	
		$password_persona="".$input["password_persona"];

		if(!$password_persona){
			return array("status"=>'error',"mensaje"=>"El password es obligatorio");
		}

		$sql="SELECT * FROM tbl_usuario where PasswordUsuario=".$this->generate_pass($password_persona)."  AND IdUsuario={$arra_data[0]->IdUsuario}";
		$result_usuario=DB::select($sql);

		if(count($result_usuario)>0){
			$sql="UPDATE tbl_usuario SET IdEstado=2 where PasswordUsuario=".$this->generate_pass($password_persona)."  AND IdUsuario={$arra_data[0]->IdUsuario}";
			$result_usuario=DB::select($sql);
		}
		$this->logout();
		return array("status"=>'ok',"mensaje"=>"Usuario desactivado");
	}

		//selecciona la tabla de comisiones.
	public function get_comisiones($id_comision=""){
		$cadena_comision="";
		if($id_comision){
			$cadena_comision=" AND  IdComision={$id_comision}";
		}
		$sql="SELECT * from tbl_comision WHERE 1 {$cadena_comision}";
		$result=DB::select($sql);
		return $result;
	}

	
	public function asign_c_f(Request $request){	
    	$input = $request->all();	
		$_x_proc="".$input["_x_proc"];

		$arra_data=$this->VerificarSesid();
		$controller_curso = new CursoController();
		
		$sql="SELECT c.* 
			from tbl_usuario_curso uc
			inner join tbl_curso c ON c.IdCurso = uc.IdCurso
			where uc.CodigoTransaccion='{$_x_proc}' and c.PrecioCurso=0 and uc.PrecioCurso=0 and uc.IdUsuarioPersona={$arra_data[0]->IdUsuarioPersona} ";

		$result=DB::select($sql);
		if(count($result)==0){
			return array("status"=>'error',"mensaje"=>"Error en la asignación");
		}else{
			$sql="	UPDATE tbl_usuario_curso SET IdEstado=1 WHERE CodigoTransaccion='{$_x_proc}'";									
			$result=DB::update($sql);
			return array("status"=>'ok',"mensaje"=>"Inscripción correcta.");
		}

		
	}

	

	public function generate_pass($pass){
		return " CONCAT('*', UPPER(SHA1(UNHEX(SHA1('{$pass}'))))) ";
	}

	public function estado_noticia(Request $request){	
		$input = $request->all();	
		$IdNoticia="".$input["IdNoticia"];
		$arra_data=$this->VerificarSesid();

		if(count($arra_data)==0){
			return array("status"=>'error',"mensaje"=>"Su sesión ha caducado");
		}

		$sql="UPDATE tbl_noticias set IdEstado=3 where IdNoticias={$IdNoticia}";
		$result=DB::update($sql);
		return array("status"=>'ok');
		
	}

	public function logout(){
		session(['sesid' => '']);//limpiar sesid
		session(['rol_login' => '']);//limpiar rol login    
		session(['rct' => '']);//limpiar rol login    
		if(session('rol_solicitud')=="afiliado"){
			
			session(['rol_solicitud' => '']);//Aceptado    
			return redirect('login-afiliados/');

		}elseif(session('rol_solicitud')=="estudiante"){

			session(['rol_solicitud' => '']);//Aceptado
			return redirect('login/');

		}elseif(session('rol_solicitud')=="tutor"){

			session(['rol_solicitud' => '']);//Aceptado
			return redirect('login-tutores/');

		}elseif(session('rol_solicitud')=="root"){
			
			session(['rol_solicitud' => '']);//Aceptado
			return redirect('login-root-docttus/');

		}else{
			session(['rol_solicitud' => '']);//Aceptado
			return redirect('login/');
		}
		session(['rol_solicitud' => '']);//limpiar rol login
	}


	public function listado_politicas($id_politica=null){
		
		$arra_data=$this->VerificarSesid();
		$controller_curso = new CursoController();
		$controller_billetera=new BilleteraController();

		if(count($arra_data)==0){
			return view('areacurso.notienespermiso');
		}else{
			
			$notificaciones=$this->get_notificaciones($arra_data[0]->IdUsuario);	

			$filtro="";
			$formulario="listado-politicas";
			if($id_politica){
				$filtro=" AND IdPolitica='{$id_politica}' ";
				$formulario="editar-politicas";
			}
			$sql="SELECT * FROM tbl_politica WHERE 1 $filtro";
			$result=DB::select($sql);

			
			
			return view('areacurso.'.$formulario,[
				"data"=>$arra_data,
				"titulo_pagina"=>'Listado Políticas', 
				"notificaciones"=>$notificaciones,				
				"politicas"=>$result,
				"menu"=>"politicas"
			]);
		}

	}

	public function editar_politicas($id_politica=null){
		
		$arra_data=$this->VerificarSesid();
		$controller_curso = new CursoController();
		$controller_billetera=new BilleteraController();

		if(count($arra_data)==0){
			return view('areacurso.notienespermiso');
		}else{
			
			$notificaciones=$this->get_notificaciones($arra_data[0]->IdUsuario);	

			$result=array();
			if($id_politica){
				$filtro=" AND IdPolitica='{$id_politica}' ";
				$sql="SELECT * FROM tbl_politica WHERE 1 $filtro";
				$result=DB::select($sql);
			}

			$sql="SELECT * FROM tbl_politica where IdEstado=1";
			$result_politicas=DB::select($sql);
			
			return view('areacurso.editar-politicas',[
				"data"=>$arra_data,
				"titulo_pagina"=>'Listado Políticas', 
				"notificaciones"=>$notificaciones,				
				"politicas"=>$result,
				"politicas_padre"=>$result_politicas,
				"menu"=>"politicas"
			]);
		}

	}

	public function ver_politicas($SlugPolitica=null){					
		
		$sql="SELECT * FROM tbl_politica WHERE IdEstado=1";
		$result=DB::select($sql);		

		$result_politica="";
		$TituloPolitica="";
		for($i=0;$i<count($result);$i++){
			if($result[$i]->SlugPolitica=="".$SlugPolitica){
				$result_politica=$result[$i];
				$TituloPolitica="".$result_politica->TituloPolitica;
			}
		}

		$vista="";
		if($SlugPolitica==""){
			$vista="politica";
		}else{
			$vista="politicas";
		}
		
		return view('marketing.'.$vista,[    		
			"titulo_pagina"=>"{$TituloPolitica}",
			"descripcion_pagina"=>"",
			"id_pagina"=>"politicas",
			"url_categoria"=>"",
			"id_subcategoria"=>"",			
			"politica"=>$result_politica,
			"politicas"=>$result,
			"SlugPolitica"=>$SlugPolitica
    	]);
		

	}

	


	public function set_politica(Request $request){	
		$arra_data=$this->VerificarSesid();
		if(count($arra_data)==0){
			return array("status"=>'error',"mensaje"=>"Su sesión ha caducado");
		}

    	$input = $request->all();	
		$TituloPolitica="".$input["TituloPolitica"];
		$SlugPolitica="".$input["SlugPolitica"];
		$FechaPolitica="".$input["FechaPolitica"];
		$ContenidoPolitica="".addslashes($input["ContenidoPolitica"]);
		$IdEstado="".$input["IdEstado"];
		$IdPolitica="".$input["IdPolitica"];
		$IdPoliticaPadre="".$input["IdPoliticaPadre"];

		$campo_politica_padre="";

		if($IdPoliticaPadre){
			$campo_politica_padre=" IdPoliticaPadre={$IdPoliticaPadre}, ";
		}
		

		if($IdPolitica){
			$sql="UPDATE tbl_politica SET TituloPolitica='{$TituloPolitica}', 
			 SlugPolitica='{$SlugPolitica}', 
			 FechaPolitica='{$FechaPolitica}', 
			 ContenidoPolitica='{$ContenidoPolitica}',
			 {$campo_politica_padre}
			 IdEstado={$IdEstado}
		   	WHERE IdPolitica='{$IdPolitica}'";		
			$result=DB::update($sql);
		}else{
			$sql="INSERT INTO tbl_politica SET TituloPolitica='{$TituloPolitica}', 
			 SlugPolitica='{$SlugPolitica}', 
			 FechaPolitica='{$FechaPolitica}', 
			 ContenidoPolitica='{$ContenidoPolitica}',
			 {$campo_politica_padre}
			 IdEstado={$IdEstado}
		   	";		
			$result=DB::insert($sql);
			$IdPolitica = DB::getPDO()->lastInsertId();
		}
		
		
		return array("status"=>'ok',"mensaje"=>"Proceso generado correctamente","IdPolitica"=>$IdPolitica);
		
	}

	public function get_config_empresa(){		
		$sql="SELECT * FROM tbl_config_empresa;";
		$result=DB::select($sql);
		return $result[0];
	}

	public function get_segundos($hora, $minuto,$segundos ){
		$segundos_total=($hora*3600)+($minuto*60)+($segundos);
		return $segundos_total;
	}


	public function surbir_vimeo_media(Request $request){	
		$client_id="2a6e119d42d45b4de30a0062e139c774da785065";
		$cliente_secret="YSCWIsARSnt3QJi7KgDao8DGNo2UvbdIwuUwos+IzBKEBYDYuI6uyQ6kNHM4jPIqQgGcC4D9b4M48t9SmZsY04CPyt0AxTOR8T/vicdW41Qhd0RBinIbnlzofNUrl+dV";
		$access_token="300cf9946bf83f609ae9500636dd2159";

		
		$client = new Vimeo("{$client_id}", "{$cliente_secret}", "{$access_token}");
		

		$arra_data=$this->VerificarSesid();
		if(count($arra_data)==0){
			return array("status"=>'error',"mensaje"=>"Su sesión ha caducado");
		}

    	$input = $request->all();	
		$IdItem="".$input["IdItem"];
		$Tipo="".$input["IdTipo"];
		$url_envio="";
		$url_vimeo="";
		$TituloVideo="";
		$descripcion="";

		if($Tipo=="2"){
			$sql="SELECT * FROM tbl_media WHERE IdMedia={$IdItem} and TipoMedia=1 And TipoVideo=1";
			$result=DB::select($sql);	
			for($i=0;$i<count($result);$i++){
				$url_envio="".$result[$i]->URLMedia;
				$TituloVideo="".$result[$i]->NombreMedia;
			}
		}else{

			$sql="SELECT * FROM tbl_curso WHERE IdCurso={$IdItem} and TipoVideo=1";
			$result=DB::select($sql);	
			for($i=0;$i<count($result);$i++){				
				$url_envio="".$result[$i]->VideoCurso;
				$TituloVideo="Portada ".$result[$i]->NombreCurso;
			}
		}

		if($url_envio){
			
			try {
				$file_name = "$url_envio";
				$uri = $client->upload($file_name, array(
					"name" => "{$TituloVideo}",
					"description" => "{$TituloVideo}",
					'privacy' => array(
						'view' => 'disable',
						'embed' => 'whitelist'
					)
				));

				
				if($Tipo=="2"){

					$sql="UPDATE tbl_media SET URLVimeo='{$uri}', EstadoVimeo=2 WHERE IdMedia={$IdItem} and TipoVideo=1";
					$result=DB::update($sql);	
				
				}else{
					$sql="UPDATE tbl_curso SET URLVimeo='{$uri}', EstadoVimeo=2 WHERE IdCurso={$IdItem} and TipoVideo=1";
					$result=DB::update($sql);					
				}

				return array("status"=>'ok',"mensaje"=>"Proceso generado correctamente, el video está en proceso de transcodig");
			
			} catch (VimeoUploadException $e) {
				return array("status"=>'error',"mensaje"=>"Error al usar la api de vimeo");		
			}
			
		}else{
			return array("status"=>'error',"mensaje"=>"El video ya se encuentra en vimeo.");	
		}		

		
	}


	public function ContenidoPendiente(){
		$controller = new AdminController();
    	$arra_data=$controller->VerificarSesid();
		if(count($arra_data)==0){
			return view('areacurso.notienespermiso');
		}else{
			$notificaciones=$controller->get_notificaciones($arra_data[0]->IdUsuario);	

			$day = date('w');
			
			$week_start = date('Y-m-d', strtotime('-'.$day.' days'));
			$week_end = date('Y-m-d', strtotime('+'.(6-$day).' days'));
			
			return view('areacurso.contenido-pendiente',[
				"data"=>$arra_data,
				"titulo_pagina"=>'Listado Pendientes', 
				"notificaciones"=>$notificaciones,
				"week_start"=>$week_start,
				"week_end"=>$week_end,				
				"menu"=>"billetera"
			]);
		}    	
		
	}


	public function pendientes_por_subir(Request $request){		

		$sql="SELECT c.IdCurso, c.NombreCurso, COALESCE(c.EstadoVimeo,'') AS EstadoVimeo, c.CodigoCurso, 
		      COALESCE(c.TipoVideo,'') AS TipoVideo, c.VideoCurso, COALESCE(c.URLVimeo,'') AS URLVimeo, 
			  COALESCE(c.VideoTemporal,'') as VideoTemporal,
			  u.NombreUsuario,
			  CONCAT_WS(' ',p.NombrePersona, p.ApellidosPersona)as NombreTutor,
			  c.SlugCurso
			  FROM tbl_curso c
			  INNER JOIN tbl_usuario_persona up ON up.IdUsuarioPersona=c.IdUsuarioTutor
    		  INNER JOIN tbl_usuario u ON u.IdUsuario = up.IdUsuario
    		  INNER JOIN tbl_persona p ON p.IdPersona = up.IdPersona
			  where c.IdEstado in (1,4,7)";
		$result=DB::select($sql);

		for($i=0;$i<count($result);$i++){

			$sql="SELECT IdModulo, NombreModulo FROM tbl_modulo WHERE IdCurso={$result[$i]->IdCurso} and IdEstado=1";
			$result_modulos=DB::select($sql);
			
			for($j=0;$j<count($result_modulos);$j++){

				$sql="SELECT IdMedia, NombreMedia, COALESCE(EstadoVimeo,'') AS EstadoVimeo, URLMedia,COALESCE(URLVimeo,'') AS URLVimeo,  COALESCE(VideoTemporal,'') as VideoTemporal FROM tbl_media WHERE IdModulo={$result_modulos[$j]->IdModulo} and IdEstado=1 and TipoMedia=1";
				$result_media_modulo=DB::select($sql);
				$result_modulos[$j]->ContenidoMedia=$result_media_modulo;

				$sql="SELECT IdTema, NombreTema,CodigoTema FROM tbl_tema WHERE IdModulo={$result_modulos[$j]->IdModulo} and IdEstado=1";
				$result_tema=DB::select($sql);

				for($k=0;$k<count($result_tema);$k++){
					$sql="SELECT IdMedia, NombreMedia,COALESCE(EstadoVimeo,'') AS EstadoVimeo,URLMedia,COALESCE(URLVimeo,'') AS URLVimeo, COALESCE(VideoTemporal,'') AS VideoTemporal FROM tbl_media WHERE IdTema={$result_tema[$k]->IdTema} and IdEstado=1 and TipoMedia=1";
					$result_media_tema=DB::select($sql);
					$result_tema[$k]->ContenidoMedia=$result_media_tema;
				}

				$result_modulos[$j]->Temas=$result_tema;

			}
			$result[$i]->Modulos=$result_modulos;

		}

		return array("status"=>'ok',"datos"=>$result);


	}


	function verificacion_vimeo(Request $request){
		$client_id="2a6e119d42d45b4de30a0062e139c774da785065";
		$cliente_secret="YSCWIsARSnt3QJi7KgDao8DGNo2UvbdIwuUwos+IzBKEBYDYuI6uyQ6kNHM4jPIqQgGcC4D9b4M48t9SmZsY04CPyt0AxTOR8T/vicdW41Qhd0RBinIbnlzofNUrl+dV";
		$access_token="300cf9946bf83f609ae9500636dd2159";
		$client = new Vimeo("{$client_id}", "{$cliente_secret}", "{$access_token}");
		
		

		$input = $request->all();	
		$IdItem="".$input["IdItem"];
		$Tipo="".$input["IdTipo"];

		$uri="";
		$url_video_base="";

		if($Tipo=="2"){
			$sql="SELECT * FROM tbl_media WHERE IdMedia={$IdItem} and EstadoVimeo=2";
			$result=DB::select($sql);	
			for($i=0;$i<count($result);$i++){
				$uri="".$result[$i]->URLVimeo;
				$url_video_base="".$result[$i]->URLMedia;
			}
		}else{

			$sql="SELECT * FROM tbl_curso WHERE IdCurso={$IdItem} and EstadoVimeo=2";
			$result=DB::select($sql);	
			for($i=0;$i<count($result);$i++){				
				$uri="".$result[$i]->URLVimeo;
				$url_video_base="".$result[$i]->VideoCurso;
			}
		}

		if($uri!=""){
			
			$response = $client->request($uri . '?fields=transcode.status');
			$estado_vimeo=$response['body']['transcode']['status'];
			//$estado_vimeo="complete";
			try {
				if ($estado_vimeo === 'complete') {
					
					try {
						$response = $client->request($uri . '?fields=link');
						$url_vimeo=$response['body']['link'];
						
						//$url_vimeo="https://vimeo.com/565585933";

						if($Tipo=="1"){
							$sql="UPDATE tbl_curso SET EstadoVimeo=1, TipoVideo=3, VideoCurso='{$url_vimeo}', VideoTemporal='{$url_video_base}'  WHERE IdCurso={$IdItem} and EstadoVimeo=2";
							$result=DB::select($sql);
						}else{
							$sql="UPDATE tbl_media SET EstadoVimeo=1, TipoVideo=3, URLMedia='{$url_vimeo}', VideoTemporal='{$url_video_base}' WHERE IdMedia={$IdItem} and EstadoVimeo=2";
							$result=DB::select($sql);						
						}
						return array("status"=>'ok',"mensaje"=>"El video ha sido configurado en vimeo y en docttus.");

					}catch (VimeoRequestException $e) {
						return array("status"=>'error',"mensaje"=>"".$e->getMessage());	
					}

				} elseif ($estado_vimeo === 'in_progress') {
					return array("status"=>'error',"mensaje"=>"El video aún se encuentra en proceso de transcoding.");

				} else {				
					return array("status"=>'error',"mensaje"=>"Se encontraron problemas en el proceso de transcoding.");
				}		

			}catch (VimeoRequestException $e) {
				return array("status"=>'error',"mensaje"=>"".$e->getMessage());	
			}	

		}

	}

	public function eliminar_video_temporal(Request $request){
		$input = $request->all();	
		$IdItem="".$input["IdItem"];
		$Tipo="".$input["IdTipo"];

		if($Tipo=="2"){
			$sql="SELECT * FROM tbl_media WHERE IdMedia={$IdItem} and VideoTemporal is not null";
			$result=DB::select($sql);	
			for($i=0;$i<count($result);$i++){				
				$url_video_base="".$result[$i]->VideoTemporal;
			}
			if($url_video_base!=""){
				\File::delete($url_video_base);
				$sql="UPDATE tbl_media SET VideoTemporal='' WHERE IdMedia={$IdItem}";
				$result=DB::select($sql);	
			}

			return array("status"=>'ok',"mensaje"=>"El archivo del video ha sido eliminado.");

		}else{

			$sql="SELECT * FROM tbl_curso WHERE IdCurso={$IdItem}  and VideoTemporal is not null";
			$result=DB::select($sql);	
			for($i=0;$i<count($result);$i++){								
				$url_video_base="".$result[$i]->VideoTemporal;
			}
			
			if($url_video_base!=""){
				\File::delete($url_video_base);
				$sql="UPDATE tbl_curso SET VideoTemporal='' WHERE IdCurso={$IdItem}";
				$result=DB::select($sql);
			}

			return array("status"=>'ok',"mensaje"=>"El archivo del video ha sido eliminado.");
		}
		
		

	}


	public function respuesta_hotmart(Request $request){
		$input = $request->all();	

		$hottok="".(isset($input["hottok"]))?$input["hottok"]:"";
		$transaction="".(isset($input["transaction"]))?$input["transaction"]:"";
		$transaction_ext="".(isset($input["transaction_ext"]))?$input["transaction_ext"]:"";
		$status="".(isset($input["status"]))?$input["status"]:"";
		$prod="".(isset($input["prod"]))?$input["prod"]:"";
		$email="".(isset($input["email"]))?$input["email"]:"";
		$name="".(isset($input["name"]))?$input["name"]:"";
		$first_name="".(isset($input["first_name"]))?$input["first_name"]:"";
		$last_name="".(isset($input["last_name"]))?$input["last_name"]:"";
		$phone_checkout_number="".(isset($input["phone_checkout_number"]))?$input["phone_checkout_number"]:"";
		$phone_checkout_local_code="".(isset($input["phone_checkout_local_code"]))?$input["phone_checkout_local_code"]:"";
		$price="".(isset($input["price"]))?$input["price"]:"";		
		$doc="".(isset($input["doc"]))?$input["doc"]:"";
		$producer_document="".(isset($input["producer_document"]))?$input["producer_document"]:"";
		
		if($status=="approved"){
			$IdCurso="";
			$IdTutor="";
			$NombreCurso="";
			$NombreTutorCurso="";

			$sql="SELECT c.*, CONCAT_WS(' ', p.NombrePersona,p.ApellidosPersona) as NombreTutorCurso
				  FROM tbl_curso  c
				  INNER JOIN tbl_usuario_persona up ON up.IdUsuarioPersona=c.IdUsuarioTutor
				  INNER JOIN tbl_persona p ON p.IdPersona=up.IdPersona				  
				  WHERE c.CodigoHotmart='{$prod}'
				  ";
			$result_curso=DB::select($sql);

			if(count($result_curso)>0){
				$IdCurso="".$result_curso[0]->IdCurso;
				$IdTutor="".$result_curso[0]->IdUsuarioTutor;
				$NombreCurso="".$result_curso[0]->NombreCurso;
				$NombreTutorCurso="".$result_curso[0]->NombreTutorCurso;
			}else{
				echo("error:curso no existe");
				return;
			}
			
			$sql="SELECT up.* , u.TokenHotmart
					FROM tbl_usuario_persona up
					INNER JOIN tbl_usuario u ON u.IdUsuario=up.IdUsuario
					INNER JOIN tbl_persona p ON p.IdPersona=up.IdPersona
					WHERE u.TokenHotmart='{$hottok}' ";
			$result=DB::select($sql);
			$IdUsuarioPersona="";
			if(count($result)>0){

				if($result[0]->TokenHotmart==""){
					return "error";
				}else{

					$usuario_nombre="";
					$password_usuario="";
					$IdUsuario="";

					$sql="SELECT up.*, u.NombreUsuario, u.IdUsuario
					FROM tbl_usuario_persona up
					INNER JOIN tbl_usuario u ON u.IdUsuario=up.IdUsuario
					INNER JOIN tbl_persona p ON p.IdPersona=up.IdPersona
					WHERE p.EmailPersona='{$email}'";
					$result=DB::select($sql);
					if(count($result)>0){
						$IdUsuarioPersona="".$result[0]->IdUsuarioPersona;
						$usuario_nombre="".$result[0]->NombreUsuario;
						$IdUsuario="".$result[0]->IdUsuario;
					}else{

						$controller_curso = new CursoController();
						

						//insertar persona
						$sql="INSERT INTO tbl_persona SET NombrePersona='{$first_name}',
						ApellidosPersona='{$last_name}',
						EmailPersona='{$email}',
						IdEstado=1,
						IdIdioma=1,
						WhatsappPersona='{$phone_checkout_local_code}{$phone_checkout_number}',
						FotoPersona='usuario.png'";
						$result=DB::insert($sql);
						$IdPersona = DB::getPDO()->lastInsertId();

						//insertar usuario
						$usuario_nombre="".preg_replace('/\s+/', '', $name);
						$id_nombre=rand(1, 99);
						$usuario_nombre=substr($usuario_nombre,0,16);
						$usuario_nombre=$usuario_nombre.$id_nombre;
						$usuario_nombre=strtolower($usuario_nombre);

						
						$password_usuario="".$controller_curso->get_codigo_enlace_afiliados(10);

						$sql="INSERT INTO tbl_usuario SET IdEstado=1, IdRol=1, IdPersona={$IdPersona}, NombreUsuario='{$usuario_nombre}', PasswordUsuario=".$this->generate_pass($password_usuario);
						$result=DB::insert($sql);
						$IdUsuario = DB::getPDO()->lastInsertId();

						//insertar usuario_persona				
						$sql="INSERT INTO tbl_usuario_persona SET 
							IdUsuario={$IdUsuario}, IdPersona={$IdPersona}";
						$result=DB::insert($sql);
						$IdUsuarioPersona = DB::getPDO()->lastInsertId();

						$sql="INSERT INTO tbl_usuario_curso SET 
								IdUsuarioPersona={$IdUsuarioPersona},
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


					}

					//asignar curso
					$sql="INSERT INTO tbl_usuario_curso SET IdUsuarioPersona={$IdUsuarioPersona},
						IdCurso={$IdCurso},
						IdEstado=1,
						PrecioCurso='{$price}',
						IdTutor={$IdTutor},
						FechaCompra=now(),
						EsAfiliado=null,
						TransactionHotmart='{$transaction}',
						TransactionExtHotmart='{$transaction_ext}',
						HottokHotmart='{$hottok}',
						StatusHotmart='{$status}',
						ProdHotmart='{$prod}',
						EmailHotmart='{$email}',
						NameHotmart='{$name}',
						FirstNameHotmart='{$first_name}',
						LastNameHotmart='{$last_name}',
						PhoneCheckoutNumberHotmart='{$phone_checkout_number}',
						PhoneCheckoutLocalCodeHotmart='{$phone_checkout_local_code}',
						DocHotmart='{$doc}',
						ProducerDocumentHotmart='{$producer_document}'";
					$result=DB::insert($sql);
					//enviar mensaje
					

					if($prod=="1644834"){
						$sql="UPDATE tbl_usuario SET IdEstadoSolicitudAfiliado=1 where IdUsuario={$IdUsuario}";
						$result=DB::update($sql);
						//User Affiliate enabled.
					}
					

					$objDemo = new \stdClass();        
					
					$objDemo->NombreCurso = "".$NombreCurso;
					$objDemo->CodigoCurso = "".$prod;
					$objDemo->NombreTutor="".$NombreTutorCurso;					
					$objDemo->NombreUsuario="".$usuario_nombre;
					$objDemo->PasswordUsuario="".$password_usuario;					
					$objDemo->email_para = "{$email}";

					$controller_email=new EmailController();
					$controller_email->enviar_mensaje_compra($objDemo); 

				}

			}else{
				echo("el token no está registrado");
			}
		}

	}

	

	
}


/*
<?php
define('SDK_DIR', __DIR__ . '/..'); // Path to the SDK directory
$loader = include SDK_DIR . '/vendor/autoload.php';

use FacebookAds\Api;
use FacebookAds\Logger\CurlLogger;
use FacebookAds\Object\ServerSide\Content;
use FacebookAds\Object\ServerSide\CustomData;
use FacebookAds\Object\ServerSide\DeliveryCategory;
use FacebookAds\Object\ServerSide\Event;
use FacebookAds\Object\ServerSide\EventRequest;
use FacebookAds\Object\ServerSide\Gender;
use FacebookAds\Object\ServerSide\UserData;

// Configuration.
// Should fill in value before running this script
$access_token = null;
$pixel_id = null;

if (is_null($access_token) || is_null($pixel_id)) {
  throw new Exception(
    'You must set your access token and pixel id before executing'
  );
}

// Initialize
Api::init(null, null, $access_token);
$api = Api::instance();
$api->setLogger(new CurlLogger());

$events = array();

$user_data_0 = (new UserData())
  ->setEmails(array())
  ->setPhones(array());

$custom_data_0 = (new CustomData())
  ->setValue(142.52)
  ->setCurrency("USD");

$event_0 = (new Event())
  ->setEventName("PageView")
  ->setEventTime(1624918556)
  ->setUserData($user_data_0)
  ->setCustomData($custom_data_0)
  ->setActionSource("website");
array_push($events, $event_0);

$request = (new EventRequest($pixel_id))
  ->setEvents($events);

$request->execute();

*/