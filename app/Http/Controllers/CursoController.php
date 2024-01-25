<?php
namespace App\Http\Controllers;



use Illuminate\Http\Request;
use DB;
use App\Quotation;
use Illuminate\Support\Facades\Log;
use Exception;


class CursoController extends Controller
{
	
	public function cursosdisponibles($url_data,$CodigoCurso=null,$ProcesoItem=null,$IdItem=null){
		
		$controller = new AdminController();
    	$arra_data=$controller->VerificarSesid();

		$arra_supercategoria=$this->get_supercategorias();
    	$arra_categoria=$this->get_categorias();
		$arra_subcategorias=$this->get_subcategorias();
		$arra_niveles=$this->get_niveles();

		if(count($arra_data)==0){
			return view('areacurso.notienespermiso');
		}else{
			$notificaciones=$controller->get_notificaciones($arra_data[0]->IdUsuario);
			$cursosdisponibles=array();
			$titulo_pagina="";
			$menu="";
			$seccion="";
			$nombre_seccion="";
			if($url_data=="disponibles"){
				$cursos_disponibles=$this->get_cursos_persona($arra_data[0]->SesidUsuario,'');
				$titulo_pagina="Cursos Disponibles";
				$menu="cursos";
				$seccion="1";
				$nombre_seccion="";
			}elseif($url_data=="premium"){
				$url_data="disponibles";
				$cursos_disponibles=$this->get_cursos_persona($arra_data[0]->SesidUsuario,'');
				$titulo_pagina="Cursos Premium";
				$menu="cursos";
				$seccion="2";
				$nombre_seccion="Premium";
			}elseif($url_data=="free"){
				$url_data="disponibles";
				$cursos_disponibles=$this->get_cursos_persona($arra_data[0]->SesidUsuario,'');
				$titulo_pagina="Cursos Free";
				$menu="cursos";
				$seccion="3";
				$nombre_seccion="Free";
			}elseif($url_data=="mercado"){
				$titulo_pagina="Mercado de Cursos";
				//$cursos_disponibles=$this->get_cursos_persona("",'');
				$cursos_disponibles="";
				$menu="mercado";
			}elseif($url_data=="deseos"){
				$titulo_pagina="Mi Lista de Deseos";
				$cursos_disponibles="";
				$menu="deseos";
			}elseif($url_data=="crear"){
				$titulo_pagina="Crear de Curso";
				//$cursos_disponibles=$this->get_cursos_persona("",'');
				$cursos_disponibles=$this->get_cursos_persona('','','','','','','','',$arra_data[0]->IdUsuarioPersona,'1,3,4,7');

				
				for($i=0;$i<count($cursos_disponibles);$i++){
					$cursos_disponibles[$i]->SolicitudAfiliado=$this->get_solicitud_afiliado($cursos_disponibles[$i]->IdCurso,$arra_data[0]->IdUsuarioPersona);
				}


				$menu="crear";

				return view('areacurso.cursos-'.$url_data,[
					"data"=>$arra_data,
					"titulo_pagina"=>$titulo_pagina, 
					"notificaciones"=>$notificaciones,
					"cursos_disponibles"=>$cursos_disponibles,
					"supercategoria"=>$arra_supercategoria,
					"categorias"=>$arra_categoria,
					"subcategorias"=>$arra_subcategorias,
					"niveles"=>$arra_niveles,
					"menu"=>"{$menu}"
				]);

			}


			//##################################################
			//EDITAR BÁSICOS
			//####################################################

			if($url_data=="editar-basicos" || $url_data=="portada" || $url_data=="precio"  || $url_data=="contenido"   || $url_data=="evaluacion"  || $url_data=="estudiantes"   || $url_data=="estadisticas" ){
				$IdPadre="";
				$CodigoItem="";
				$titulo_pagina="Editar Curso";
				//$cursos_disponibles=$this->get_cursos_persona("",'');
				$SolicitudAfiliado="";
				if(session('rol_solicitud')=="root"){

					

					$sql="SELECT IdUsuarioTutor from tbl_curso where CodigoCurso='{$CodigoCurso}'";
					$result_bd=DB::select($sql);
					$curso=$this->get_cursos_persona('','','','','','','','',$result_bd[0]->IdUsuarioTutor,'1,2,3,4,7',$CodigoCurso);

					$SolicitudAfiliado=$this->get_solicitud_afiliado($curso[0]->IdCurso,$arra_data[0]->IdUsuarioPersona);

				}else{
					$curso=$this->get_cursos_persona('','','','','','','','',$arra_data[0]->IdUsuarioPersona,'1,2,3,4,7',$CodigoCurso);
				}			

				$key="".$arra_data[0]->SesidUsuario."@".$CodigoCurso;				
				$token_curso="".md5($key);

				if(count($curso)==0){
					return view('areacurso.notienespermiso');
				}

				$menu="crear";

				$comisiones=$controller->get_comisiones();
				$configuracion=$controller->get_config_empresa();

				$info_modulos="";
				$info_lecciones="";
				$info_contenido="";
				$url_formulario=$url_data;

				$result_evaluacion="";
				if($url_data=="evaluacion"){
					$sql="SELECT * FROM tbl_evaluacion where IdCurso={$curso[0]->IdCurso}";
					$result_evaluacion=DB::select($sql);

					if(count($result_evaluacion)==0){
						$sql="INSERT INTO tbl_evaluacion SET IdCurso={$curso[0]->IdCurso}, IdEstado=1, FechaCreacion=now(), IdTipoEvaluacion=3";
						$result=DB::insert($sql);
						
						$sql="SELECT * FROM tbl_evaluacion where IdCurso={$curso[0]->IdCurso}";
						$result_evaluacion=DB::select($sql);
					}

					for($i=0;$i<count($result_evaluacion);$i++){
						
						$sql="SELECT * FROM tbl_pregunta where IdEvaluacion={$result_evaluacion[$i]->IdEvaluacion} and IdEstado=1";
						$result_pregunta=DB::select($sql);

						for($j=0;$j<count($result_pregunta);$j++){
							
							$sql="SELECT * FROM tbl_respuesta where IdPregunta={$result_pregunta[$j]->IdPregunta}";
							$result_respuesta=DB::select($sql);
							$result_pregunta[$j]->respuestas=$result_respuesta;

						}

						$result_evaluacion[$i]->preguntas=$result_pregunta;

					}

					
				}


				if($url_data=="contenido"){
					
					$info_modulos=$this->get_modulos_curso($curso[0]->IdCurso,null,1);
					$info_lecciones=$this->get_lecciones_curso($curso[0]->IdCurso,'','',null,1);

					if($ProcesoItem){
						if($ProcesoItem=="modulo" || $ProcesoItem=="leccion"){
							
							$info_modulos=null;
							$info_lecciones=null;

							$url_formulario=$url_formulario."-item";

							if($ProcesoItem=="modulo"){
								if($IdItem){
									$temp_data_modulo=$this->get_modulos_curso($curso[0]->IdCurso,$IdItem,1);
									
									if(count($temp_data_modulo)){
										$info_contenido=[
											"NombreItem"=>$temp_data_modulo[0]->NombreModulo,
											"DescripcionItem"=>$temp_data_modulo[0]->DescripcionModulo,
											"GratisItem"=>$temp_data_modulo[0]->GratisModulo,
											"DuracionItem"=>$temp_data_modulo[0]->DuracionModulo,
											"IdEstado"=>$temp_data_modulo[0]->IdEstado,
											"FechaLanzamiento"=>$temp_data_modulo[0]->FechaLanzamiento,
										];
									}
								}								
							}

							if($ProcesoItem=="leccion"){
								$IdPadre="";
								if($IdItem){
									$arra_item=explode("-",$IdItem);
									$IdPadre="".$arra_item[0];
									if(count($arra_item)==2){									
										$IdItem=$arra_item[1];
										$CodigoItem=$arra_item[1];
										//get_lecciones_curso($id_curso,$id_leccion,$idusuario,$id_modulo=null,$tipo_edit=null)
										$temp_data_leccion=$this->get_lecciones_curso($curso[0]->IdCurso,$IdItem,'',$arra_item[0],1);
										//$temp_data_modulo=$this->get_modulos_curso($curso[0]->IdCurso,$IdItem,1);
										if(count($temp_data_leccion)){
											$IdItem=$temp_data_leccion[0]->IdTema;
											$info_contenido=[
												"NombreItem"=>$temp_data_leccion[0]->NombreTema,
												"DescripcionItem"=>$temp_data_leccion[0]->DescripcionTema,
												"GratisItem"=>$temp_data_leccion[0]->GratisTema,
												"DuracionItem"=>$temp_data_leccion[0]->DuracionTema,
												"IdEstado"=>$temp_data_leccion[0]->IdEstado,
												"FechaLanzamiento"=>$temp_data_leccion[0]->FechaLanzamiento,
											];
										}
									}else{
										$IdItem="";
									}
								}
							}

						}else{
							return view('areacurso.notienespermiso');
						}
					}else{

						$info_modulos=$this->get_modulos_curso($curso[0]->IdCurso,null,1);
						$info_lecciones=$this->get_lecciones_curso($curso[0]->IdCurso,'','',null,1);

					}

				}				

				return view('areacurso.cursos-'.$url_formulario,[
					"barra_guardar"=>"1",
					"data"=>$arra_data,
					"titulo_pagina"=>$titulo_pagina, 
					"notificaciones"=>$notificaciones,
					"curso"=>$curso[0],
					"supercategoria"=>$arra_supercategoria,
					"categorias"=>$arra_categoria,
					"subcategorias"=>$arra_subcategorias,
					"token_curso"=>$token_curso,
					"niveles"=>$arra_niveles,
					"url_form"=>$url_data,
					"comisiones"=>$comisiones,
					"configuracion"=>$configuracion,
					"modulos"=>$info_modulos,					
					"lecciones"=>$info_lecciones,	
					"ProcesoItem"=>$ProcesoItem,
					"IdItem"=>$IdItem,
					"IdPadre"=>$IdPadre,
					"CodigoItem"=>$CodigoItem,
					"info_contenido"=>$info_contenido,
					"evaluaciones"=>$result_evaluacion,
					"menu"=>"{$menu}",
					"SolicitudAfiliado"=>$SolicitudAfiliado
				]);

			}

			//##################################################
			//EDITAR MODULOS
			//####################################################

			if($url_data=="editar-modulos"){
				$titulo_pagina="Editar Módulos";
				//$cursos_disponibles=$this->get_cursos_persona("",'');

				if(session('rol_solicitud')=="root"){

					$sql="SELECT IdUsuarioTutor from tbl_curso where CodigoCurso='{$CodigoCurso}'";
					$result_bd=DB::select($sql);

					$curso=$this->get_cursos_persona('','','','','','','','',$result_bd[0]->IdUsuarioTutor,'1,2,3,4',$CodigoCurso);
				}else{
					$curso=$this->get_cursos_persona('','','','','','','','',$arra_data[0]->IdUsuarioPersona,'1,2,3,4',$CodigoCurso);	
				}

				$key="".$arra_data[0]->SesidUsuario."@".$CodigoCurso;				
				$token_curso="".md5($key);



				if(count($curso)==0){
					return view('areacurso.notienespermiso');
				}

				$info_modulos=$this->get_modulos_curso($curso[0]->IdCurso);

				$menu="crear";

				return view('areacurso.cursos-'.$url_data,[
					"data"=>$arra_data,
					"titulo_pagina"=>$titulo_pagina, 
					"notificaciones"=>$notificaciones,
					"curso"=>$curso[0],
					"supercategoria"=>$arra_supercategoria,
					"categorias"=>$arra_categoria,
					"subcategorias"=>$arra_subcategorias,
					"token_curso"=>$token_curso,
					"modulos"=>$info_modulos,
					"niveles"=>$arra_niveles,
					"menu"=>"{$menu}"
				]);

			}

			//##################################################
			//EDITAR LECCIONES
			//####################################################



			if($url_data=="editar-lecciones"){
				$titulo_pagina="Editar Lecciones";
				
				$arra_codigos=explode("-", $CodigoCurso);
				$CodigoCurso=$arra_codigos[0];
				
				$IdModulo=$arra_codigos[1];

				if(session('rol_solicitud')=="root"){

					$sql="SELECT IdUsuarioTutor from tbl_curso where CodigoCurso='{$CodigoCurso}'";
					$result_bd=DB::select($sql);

					$curso=$this->get_cursos_persona('','','','','','','','',$result_bd[0]->IdUsuarioTutor,'1,2,3,4',$CodigoCurso);
				}else{
					$curso=$this->get_cursos_persona('','','','','','','','',$arra_data[0]->IdUsuarioPersona,'1,2,3,4',$CodigoCurso);
				}

				$key="".$arra_data[0]->SesidUsuario."@".$CodigoCurso;				
				$token_curso="".md5($key);



				if(count($curso)==0){
					return view('areacurso.notienespermiso');
				}

				$info_modulos=$this->get_modulos_curso($curso[0]->IdCurso,$IdModulo);
				$info_tipo_tema=$this->get_tipo_tema();

				$info_lecciones=$info_lecciones=$this->get_lecciones_curso('','','',$IdModulo,"1");

				$DescripcionlargaTema="";
				for($i=0;$i<count($info_lecciones);$i++){
					$DescripcionlargaTema="".$info_lecciones[$i]->DescripcionlargaTema;
					$DescripcionlargaTema = preg_replace('/\s+/', ' ', trim($DescripcionlargaTema));
					$info_lecciones[$i]->DescripcionlargaTema=$DescripcionlargaTema;

					$info_media=$this->get_media($info_lecciones[$i]->IdTema);
					$info_lecciones[$i]->media_leccion=$info_media;

					$info_habilidades=$this->get_habilidades($info_lecciones[$i]->IdTema,'','');

					$info_lecciones[$i]->habilidades=$info_habilidades;

				}

				$habilidades=$this->get_todas_habilidades();

				

				$menu="crear";	


				return view('areacurso.cursos-'.$url_data,[
					"data"=>$arra_data,
					"titulo_pagina"=>$titulo_pagina, 
					"notificaciones"=>$notificaciones,
					"curso"=>$curso[0],
					"supercategoria"=>$arra_supercategoria,
					"categorias"=>$arra_categoria,
					"niveles"=>$arra_niveles,
					"subcategorias"=>$arra_subcategorias,
					"token_curso"=>$token_curso,
					"modulos"=>$info_modulos[0],
					"tipo_tema"=>$info_tipo_tema,
					"lecciones"=>$info_lecciones,
					"habilidades"=>$habilidades,
					"menu"=>"{$menu}"
				]);

			}

			//##################################################
			//EDITAR ARCHIVOS
			//####################################################


			if($url_data=="editar-archivos"){
				$titulo_pagina="Editar Archivos";
				
				$arra_codigos=explode("-", $CodigoCurso);
				$CodigoCurso=$arra_codigos[0];
				$id_leccion=$arra_codigos[1];

				if(session('rol_solicitud')=="root"){

					$sql="SELECT IdUsuarioTutor from tbl_curso where CodigoCurso='{$CodigoCurso}'";
					$result_bd=DB::select($sql);

					$curso=$this->get_cursos_persona('','','','','','','','',$result_bd[0]->IdUsuarioTutor,'1,2,3,4',$CodigoCurso);
				}else{
					$curso=$this->get_cursos_persona('','','','','','','','',$arra_data[0]->IdUsuarioPersona,'1,2,3,4',$CodigoCurso);
				}

				$key="".$arra_data[0]->SesidUsuario."@".$CodigoCurso;				
				$token_curso="".md5($key);



				if(count($curso)==0){
					return view('areacurso.notienespermiso');
				}

				
				$info_tipo_tema=$this->get_tipo_tema();


				$info_lecciones=$info_lecciones=$this->get_lecciones_curso('',$id_leccion,'','');
				$leccion=$info_lecciones[0];

				$info_media=$this->get_media($leccion->IdTema);
				

				$menu="crear";

				return view('areacurso.cursos-'.$url_data,[
					"data"=>$arra_data,
					"titulo_pagina"=>$titulo_pagina, 
					"notificaciones"=>$notificaciones,
					"curso"=>$curso[0],
					"supercategoria"=>$arra_supercategoria,
					"categorias"=>$arra_categoria,
					"niveles"=>$arra_niveles,
					"subcategorias"=>$arra_subcategorias,
					"token_curso"=>$token_curso,					
					"tipo_tema"=>$info_tipo_tema,
					"lecciones"=>$leccion,
					"archivos"=>$info_media,
					"menu"=>"{$menu}"
				]);

			}

			


			

			
			return view('areacurso.cursos-'.$url_data,[
				"data"=>$arra_data,
				"titulo_pagina"=>$titulo_pagina, 
				"notificaciones"=>$notificaciones,
				"cursos_disponibles"=>$cursos_disponibles,
				"supercategoria"=>$arra_supercategoria,
				"categorias"=>$arra_categoria,
				"subcategorias"=>$arra_subcategorias,
				"niveles"=>$arra_niveles,
				"seccion"=>$seccion,
				"nombre_seccion"=>$nombre_seccion,
				"menu"=>"{$menu}"
			]);
		}    	
    }

    public function fichacurso($url_curso){
    	$controller = new AdminController();
    	$arra_data=$controller->VerificarSesid();
		if(count($arra_data)==0){
			return view('areacurso.notienespermiso');
		}else{

			
			

			//NOTIFICACIONES
			$notificaciones=$controller->get_notificaciones($arra_data[0]->IdUsuario);
			
			//FICHA CURSO
			if(session('rol_solicitud')=="root" || session('rol_solicitud')=="tutor"){		
				
				if(session('rol_solicitud')=="root"){
					$this->asignacion_usuarios_default(null,null,$url_curso);
				}else{
					
					$this->asignacion_usuarios_default(null,$arra_data[0]->IdUsuarioPersona,$url_curso);
				}
				
				
				$info_curso=$this->get_cursos_persona($arra_data[0]->SesidUsuario,$url_curso,null,null,null,null,null,null,null,'1,3,4,7');
			}else{
				$info_curso=$this->get_cursos_persona($arra_data[0]->SesidUsuario,$url_curso);
			}
			
			
			if(count($info_curso)==0){
				return view('areacurso.notienespermiso');	
			}

			$info_curso=$info_curso[0];
			//INFO TUTOR


			if($arra_data[0]->IdEstadoSolicitudAfiliado==1){
				$this->asignar_cursos_afiliados($info_curso->IdCurso,$arra_data[0]->IdUsuarioPersona);
			}

			$info_tutor=$this->get_info_tutor('',$info_curso->IdCurso);
			$info_tutor=$info_tutor[0];

			//INFO MODULOS
			$info_modulos=$this->get_modulos_curso($info_curso->IdCurso);
			

			//INFO LECCIONES

			//ULTIMA LECCIÓN

			$info_lecciones=$this->get_lecciones_curso($info_curso->IdCurso,'',$arra_data[0]->IdUsuario);

			$historial_lecciones=$this->get_continuar_curso($info_curso->IdCurso,$arra_data[0]->IdUsuarioPersona);
			if(count($historial_lecciones)>0){
				$historial_lecciones=$info_lecciones[0];
			}else{
				$historial_lecciones="";
			}

			$habilidades_curso=$this->get_habilidades_by_curso($info_curso->IdCurso);
			$habilidades_alcanzadas=$this->get_habilidades("",$arra_data[0]->IdUsuarioPersona,"",$info_curso->IdCurso);


			$arra_reviews=$info_curso->reviews;
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


			$curso_destacado=$this->get_cursos_persona(null,null,null,null,null,"random",1,12,null,'1',null,null);

			$info_lecciones_estado=$this->get_avances_lecciones($arra_data[0]->IdUsuarioPersona,$info_curso->IdCurso);
			



			$total_lecciones=count($info_curso->lecciones);
			$total_lecciones_vistas=count($info_lecciones_estado);

			$porcentaje_completado=0;
			$porcentaje_por_iniciar=100;
			if($total_lecciones>0){
				$porcentaje_completado=($total_lecciones_vistas*100)/$total_lecciones;
				$porcentaje_por_iniciar=100-$porcentaje_completado;
			}
			

			$porcentaje_avance=$this->get_avances_curso($arra_data[0]->IdUsuarioPersona,$info_curso->IdCurso);

			$paso_examen=0;

			$sql="	SELECT eu.* 
					FROM tbl_evaluacion_usuario eu
					INNER JOIN  tbl_evaluacion e ON e.IdEvaluacion=eu.IdEvaluacion and e.IdEstado=1
					WHERE 	eu.IdUsuario={$arra_data[0]->IdUsuario} AND 
							e.IdCurso={$info_curso->IdCurso} AND 
							eu.IdEstado=1";
			$result_evaluacion=DB::select($sql);

			$codigo_certificado="";
			if(count($result_evaluacion)>0){
				$paso_examen=1;
				$codigo_certificado="{$result_evaluacion[0]->CodigoEvaluacion}";
			}

			$arra_reviews=$info_curso->reviews;
			$cant_reviews=count($arra_reviews);

			return view('areacurso.detalle-curso',[
				"data"=>$arra_data,
				"titulo_pagina"=>'Curso '.$info_curso->NombreCurso, 
				"notificaciones"=>$notificaciones,
				"info_curso"=>$info_curso,
				"info_tutor"=>$info_tutor,
				"info_modulos"=>$info_modulos,
				"info_lecciones"=>$info_lecciones,
				"continuar"=>$historial_lecciones,
				"habilidades_curso"=>$habilidades_curso,
				"habilidades_alcanzadas"=>$habilidades_alcanzadas,
				"promedio_reviews_curso"=>$promedio_reviews_curso,
				"curso_destacado"=>$curso_destacado,
				"info_lecciones_estado"=>$info_lecciones_estado,
				"porcentaje_avance"=>number_format($porcentaje_avance,1),
				"paso_examen"=>number_format($paso_examen,1),
				"arra_reviews"=>$arra_reviews,
				"cant_reviews"=>$cant_reviews,
				"codigo_certificado"=>$codigo_certificado,
				"menu"=>"cursos",
				

			]);
		}
	}
	


	function get_cursos_by_filter(Request $request){

		$input = $request->all();	   	
		$titulo_curso="".$input["titulo_curso"];
		$subcategoria_curso="".$input["subcategoria_curso"];
		$activacion_automatica="".$input["activacion_automatica"];
		$estado_solicitud="".$input["estado_solicitud"];
		$deseos="".$input["deseos"];
		
		

		$controller = new AdminController();
		$arra_data=$controller->VerificarSesid();
		
		$IdUsuarioPersona=$arra_data[0]->IdUsuarioPersona;

		$tabla_deseos="";
		if($deseos){
			$tabla_deseos="INNER JOIN tbl_deseos d ON d.IdCurso=c.IdCurso and d.IdUsuario={$IdUsuarioPersona} and d.IdEstado=1";
		}


		$filtro="";
		if($titulo_curso!=""){
			$filtro.=" AND c.NombreCurso like '%{$titulo_curso}%'";
		}

		if($subcategoria_curso!=""){
			$filtro.=" AND c.IdSubcategoria = '{$subcategoria_curso}'";
		}

		if($activacion_automatica!=""){
			$filtro.=" AND c.AprobacionAutomatica = '{$activacion_automatica}'";
		}

		$having="";
		if($estado_solicitud!=""){
			$having.=" HAVING  EstadoSolicitudAfiliacion={$estado_solicitud}";
		}

		$sql="SELECT c.*, (
							select EstadoSolicitudAfiliacion 
							from tbl_solicitud_afiliacion 
							WHERE IdCurso = c.IdCurso AND  IdUsuarioPersona='{$IdUsuarioPersona}' LIMIT 1 ) AS EstadoSolicitudAfiliacion,

						(select dd.IdEstado from tbl_deseos dd where dd.IdCurso=c.IdCurso and dd.IdUsuario={$IdUsuarioPersona} limit 1) as estado_deseo
			  from tbl_curso c 
			  {$tabla_deseos}
			  WHERE c.IdEstado=1 and c.SeccionCurso=1 
			  {$filtro}
			  {$having}
		";
		$result=DB::select($sql);
		
		for($i=0;$i<count($result);$i++){
			$result[$i]->SolicitudAfiliado=$this->get_solicitud_afiliado($result[$i]->IdCurso,$IdUsuarioPersona);
		}

		return response()->json(["status"=>'ok',"data"=>$result]);
	}
	

    public function fichaleccion($id_leccion){
    	$controller = new AdminController();
    	$arra_data=$controller->VerificarSesid();
		if(count($arra_data)==0){
			return view('areacurso.notienespermiso');
		}else{
			$notificaciones=$controller->get_notificaciones($arra_data[0]->IdUsuario);
			if(session('rol_solicitud')=="root"){
				$leccion_curso=$this->get_lecciones_curso("",$id_leccion,'');
			}else{
				$leccion_curso=$this->get_lecciones_curso("",$id_leccion,$arra_data[0]->IdUsuario);
			}

			if(count($leccion_curso)==0){
				return view('areacurso.notienespermiso');	
			}

			//MEDIA
			$info_media=$this->get_media($leccion_curso[0]->IdTema);

			//HABILIADES 
			$info_habilidades=$this->get_habilidades($leccion_curso[0]->IdTema,'','');

			//HISTORIAL DE ENTRADA
			$this->set_avance_historial($leccion_curso[0]->IdTema,$arra_data[0]->IdUsuarioPersona);
			

			//SIGUIENTE LECCION
			$info_siguiente=$this->get_siguiente_tema($leccion_curso[0]->IdModulo,$leccion_curso[0]->OrdenTema);


			//COMENTARIOS 
			$info_comentarios=$this->get_comentarios($leccion_curso[0]->IdTema);
			$info_comentarios_hijo=$info_comentarios;

			//EVALUACIONES
			$info_evaluaciones=$this->get_evaluaciones($leccion_curso[0]->IdTema);

			


			$info_modulos=$this->get_modulos_curso($leccion_curso[0]->IdCurso);
			$info_lecciones=$this->get_lecciones_curso($leccion_curso[0]->IdCurso,'','');


			$info_lecciones_estado=$this->get_avances_lecciones($arra_data[0]->IdUsuarioPersona);

			$info_curso=$this->get_cursos_persona('','','','','','','','','','1,2,3,4',"",$leccion_curso[0]->IdCurso);


			$calificacion=$this->get_valoracion_by_persona_curso($arra_data[0]->IdUsuarioPersona,$leccion_curso[0]->IdCurso);


			return view('areacurso.lecciones',[
				"data"=>$arra_data,
				"titulo_pagina"=>'Lección Disponibles', 
				"notificaciones"=>$notificaciones,				
				"info_leccion"=>$leccion_curso[0],
				"info_media"=>$info_media,				
				"info_siguiente"=>$info_siguiente,
				"info_comentarios"=>$info_comentarios,
				"info_comentarios_hijo"=>$info_comentarios_hijo,
				"info_evaluaciones"=>$info_evaluaciones,
				"info_modulos"=>$info_modulos,
				"info_lecciones"=>$info_lecciones,
				"info_lecciones_estado"=>$info_lecciones_estado,
				"curso"=>$info_curso[0],
				"valoracion"=>$calificacion,
				"menu"=>"cursos"
			]);
		}    	
    }



	


    public function get_valoracion_by_persona_curso($IdPersonaUsuario,$IdCurso){
    	$sql="SELECT * FROM tbl_calificacion_curso_persona WHERE IdEstado=1 and IdPersonaUsuario={$IdPersonaUsuario} and IdCurso='{$IdCurso}'";
		$result_comentario=DB::select($sql);
		return $result_comentario;
    }

    public function get_avances_lecciones($idusuario,$idcurso=null){

		$filtro="";
		$inner_curso="";
		if($idcurso){
			$filtro=" and atu.EstadoTemaAvance=1 ";
			$inner_curso="INNER JOIN tbl_tema t ON t.IdTema=atu.IdTema 
						  INNER JOIN tbl_modulo m ON m.IdModulo = t.IdModulo AND m.IdCurso=$idcurso
						  ";
		}

    	$sql="SELECT atu.* 
			  FROM tbl_avance_tema_usuario atu
			  {$inner_curso}
			  where atu.IdUsuarioPersona={$idusuario} and atu.TipoAvance=1 {$filtro} ";
    	$result=DB::select($sql);
    	return $result;
	}
	


    public function get_cursos_persona($sesid_usuario=null,$slug_curso=null,$pag=null,$subcat=null,$key=null,$order=null,$destacado=null,$limit=null,$idtutor=null,$estadocurso='1',$CodigoCurso=null,$IdCurso=null,$IdUsuarioCompra=null){

    	/*
		
		"IdCurso":"{{$curso->IdCurso}}",
		"NombreCurso":"{{$curso->NombreCurso}}",
		"DescripcionCurso":"{{$curso->DescripcionCurso}}",
		"SlugCurso":"{{$curso->SlugCurso}}",
		"IdEstado":"{{$curso->IdEstado}}",
		"IdTipoCurso":"{{$curso->IdTipoCurso}}",
		"FechaCreacion":"{{$curso->FechaCreacion}}",
		"FechaModificacion":"{{$curso->FechaModificacion}}",
		"TituloCurso":"{{$curso->TituloCurso}}",
		"ImagenCurso":"{{$curso->ImagenCurso}}",
		"CodigoCurso":"{{$curso->CodigoCurso}}",
		"Nombretutor":"{{$curso->Nombretutor}}",
		"DescripcionTutor":"{{$curso->DescripcionTutor}}",
		"FotoTutor":"{{$curso->FotoTutor}}",
		"VideoCurso":"{{$curso->VideoCurso}}",
		"AprenderasCurso":"{{$curso->AprenderasCurso}}",
		"TestimoniosCurso":"{{$curso->TestimoniosCurso}}",
		"IdSubcategoria":"{{$curso->IdSubcategoria}}",
		"IdDestacado":"{{$curso->IdDestacado}}",
		"NombreSubcategoria":"{{$curso->NombreSubcategoria}}",
		"cantidad_modulos":"{{$curso->cantidad_modulos}}",
		"cantidad_lecciones":"{{$curso->cantidad_lecciones}}",
		"cantidad_horas":"{{$curso->cantidad_horas}}",
		"ValorPrecioProducto":"{{$curso->ValorPrecioProducto}}",
		
    	*/

    	$filtro_curso="";
    	$orden_filtro="";
    	$limit_filtro="";

    	$filtro_tutor="";
    	if($idtutor!=""){
    		$filtro_tutor=" AND c.IdUsuarioTutor={$idtutor} ";
    	}

    	$filtro_curso_codigo="";
    	if($CodigoCurso){
    		$filtro_curso_codigo=" AND c.IdUsuarioTutor={$idtutor} and c.CodigoCurso='{$CodigoCurso}'";
    	}

    	if($IdCurso){
    		$filtro_curso_codigo=" AND c.IdCurso='{$IdCurso}'";
    	}
    	

    	$filtro_usuario_adicional="";
    	$select_usuario_adicional="";

		if($slug_curso){
			$filtro_curso.="and (c.SlugCurso='{$slug_curso}' or c.CodigoCurso='{$slug_curso}')";
		}  	

		if($sesid_usuario){

			$controller = new AdminController();
    		$arra_data=$controller->VerificarSesid();

			if($arra_data[0]->IdEstadoSolicitudAfiliado==1){
			
			/*	$filtro_usuario_adicional="				
				LEFT JOIN tbl_usuario_curso uc on uc.IdCurso=c.IdCurso and uc.IdEstado=1 
				LEFT JOIN tbl_usuario_persona up ON up.IdUsuarioPersona=uc.IdUsuarioPersona 
				LEFT JOIN tbl_usuario u ON u.IdUsuario=up.IdUsuario and u.SesidUsuario='{$sesid_usuario}' 	
			";
				$select_usuario_adicional="uc.IdUsuarioPersona, up.IdUsuario,uc.CodigoTransaccion,";
				$filtro_curso.=" and u.SesidUsuario='{$sesid_usuario}' ";*/

				
			}else{
				$filtro_usuario_adicional="				
				INNER JOIN tbl_usuario_curso uc on uc.IdCurso=c.IdCurso and uc.IdEstado=1 
				INNER JOIN tbl_usuario_persona up ON up.IdUsuarioPersona=uc.IdUsuarioPersona 
				INNER JOIN tbl_usuario u ON u.IdUsuario=up.IdUsuario and u.SesidUsuario='{$sesid_usuario}' 	
			";
				$select_usuario_adicional="uc.IdUsuarioPersona, up.IdUsuario,uc.CodigoTransaccion,";
				$filtro_curso.=" and u.SesidUsuario='{$sesid_usuario}' ";
			}

			

			
		}

		if($IdUsuarioCompra){
			
			$filtro_usuario_adicional="				
				INNER JOIN tbl_usuario_curso uc on uc.IdCurso=c.IdCurso and uc.IdEstado=1 
				INNER JOIN tbl_usuario_persona up ON up.IdUsuarioPersona=uc.IdUsuarioPersona 
				INNER JOIN tbl_usuario u ON u.IdUsuario=up.IdUsuario and u.IdUsuario='{$IdUsuarioCompra}' 	
			";


			$select_usuario_adicional="uc.IdUsuarioPersona, up.IdUsuario,";

			$filtro_curso.=" and u.IdUsuario='{$IdUsuarioCompra}' ";

		}

		if($subcat){
			$filtro_curso.=" and (sub.SlugSubcategoria='{$subcat}' OR sub.IdSubcategoria='{$subcat}')";
		}

		if($key){
			$filtro_curso.=" and ( c.NombreCurso like '%{$key}%' or sub.NombreSubcategoria like '%{$key}%' or cat.NombreCategoria like '%{$key}%' )";	
		}

		if($destacado){
			$filtro_curso.=" and c.IdDestacado={$destacado}";
		}

		if($order){

			/*
			<option value="1">Fecha Creación Asc</option>
			<option value="2">Calificación Asc</option>
			<option value="3">Calificación Desc</option>
			<option value="4">Precio Bajo</option>
			<option value="5">Precio Alto</option>
			*/

			if($order==1){
				$orden_filtro=" ORDER BY c.FechaCreacion ASC ";
			}

			if($order==2){
				$orden_filtro=" ORDER BY c.TotalCalificacion ASC ";
			}

			if($order==3){
				$orden_filtro=" ORDER BY c.TotalCalificacion DESC ";
			}

			if($order==4){
				$orden_filtro=" ORDER BY c.PrecioCurso DESC ";
			}

			if($order==5){
				$orden_filtro=" ORDER BY c.PrecioCurso ASC ";
			}

			if($order=="random"){
				$orden_filtro=" ORDER BY RAND() ";
			}
			
		}

		if($limit){
			$limit_filtro=" LIMIT {$limit} ";
		}


    	$sql="SELECT c.*, {$select_usuario_adicional} '' as habilidades, sub.NombreSubcategoria, sub.SlugSubcategoria,cat.NombreCategoria,
			  (select count(*) from tbl_modulo m where m.IdCurso=c.IdCurso and m.IdEstado=1 ) as cantidad_modulos,
			  ( select count(*) 
			    from tbl_tema t 
			    LEFT JOIN tbl_modulo m ON m.IdModulo = t.IdModulo
			    where m.IdCurso=c.IdCurso and m.IdEstado=1 ) as cantidad_lecciones,
			    ( 
					select format(sum(t.DuracionTema)/60,0)
			    	from tbl_tema t 
			    	LEFT JOIN tbl_modulo m ON m.IdModulo = t.IdModulo
			    	where m.IdCurso=c.IdCurso and m.IdEstado=1 ) as cantidad_horas, c.PrecioCurso as ValorPrecioProducto,
			    p2.FotoPersona, 
				concat_ws(' ',p2.NombrePersona,p2.ApellidosPersona) as TutorCurso,
				u2.NombreUsuario,
				tnc.NombreNivel,
				imp.ValorImpuesto, imp.NombreImpuesto
			FROM tbl_curso c 
			
			{$filtro_usuario_adicional}

			/*LEFT JOIN tbl_producto pr ON pr.IdCurso=c.IdCurso
			LEFT JOIN tbl_precio_producto ppr ON ppr.IdProducto=pr.IdProducto*/
			LEFT JOIN tbl_subcategoria sub ON sub.IdSubcategoria=c.IdSubcategoria and sub.IdEstado=1
			LEFT JOIN tbl_categoria_cursos cat ON cat.IdCategoriaCursos=sub.IdCategoria and cat.IdEstado=1
			LEFT JOIN tbl_usuario_persona up2 ON c.IdUsuarioTutor=up2.IdUsuarioPersona
			LEFT JOIN tbl_persona p2 ON up2.IdPersona=p2.IdPersona
			LEFT JOIN tbl_usuario u2 ON u2.IdUsuario=up2.IdUsuario
			LEFT JOIN tbl_nivelcurso tnc ON tnc.IdNivel=c.IdNivelCurso
			LEFT JOIN tbl_impuesto imp ON imp.IdImpuesto=c.IdImpuesto and imp.IdEstado=1
			WHERE c.IdEstado in ({$estadocurso}) $filtro_curso
			
			{$filtro_tutor}
			{$filtro_curso_codigo}
			{$orden_filtro}
			{$limit_filtro}
			";
		$result=DB::select($sql);

		$controller = new AdminController();
		for($i=0;$i<count($result);$i++){
			$result[$i]->habilidades=$this->get_habilidades_by_curso($result[$i]->IdCurso);
			$result[$i]->reviews=$this->get_calificaciones_by_curso($result[$i]->IdCurso);
			$result[$i]->cantidad_estudiantes=$this->get_cant_estudiantes_by_curso($result[$i]->IdCurso);
			$result[$i]->tutor=$this->get_info_tutor('',$result[$i]->IdCurso);
			$result[$i]->lecciones=$this->get_lecciones_curso($result[$i]->IdCurso,'','');
			$result[$i]->modulos=$this->get_modulos_curso($result[$i]->IdCurso);
			$poster="";
			if($result[$i]->ImagenCurso!=""){
				$poster=url('')."/assets/images/cursos/".$result[$i]->ImagenCurso;
			}
			$result[$i]->VideoCursoEmbed=$controller->obtenerVideoURL($result[$i]->VideoCurso,$result[$i]->TipoVideo,$poster);
			

		}

		return $result;	
    }


    public function get_info_tutor($id_usuario,$id_curso){

    	$filtro_tutor="";
    	$filtro_curso="";

    	if($id_usuario){
			$filtro_tutor=" and u.IdUsuario={$id_usuario} ";
    	}

    	if($id_curso){
    		$filtro_curso=" AND c.IdCurso= {$id_curso}";
    	}

    	/*$sql="SELECT p.* 
    		  FROM tbl_usuario_persona up
    		  INNER JOIN tbl_persona p ON p.IdPersona = up.IdPersona
    		  INNER JOIN tbl_tutores_curso tc ON tc.IdUsuarioPersona=up.IdUsuarioPersona {$filtro_curso}
    		  where p.IdEstado=1 {$filtro_tutor} limit 1";*/

    	$sql="SELECT p.*, u.IdUsuarioPadre
    	      FROM tbl_usuario_persona up
    	      inner join tbl_usuario u ON up.IdUsuario = u.IdUsuario
    	      INNER JOIN tbl_persona p ON p.IdPersona = u.IdPersona
    	      INNER JOIN tbl_curso c ON c.IdUsuarioTutor=u.IdUsuario
    	      WHERE p.IdEstado=1  {$filtro_tutor}  {$filtro_curso}  limit 1   	";

		$result=DB::select($sql);


		//get co-productor
		
		for($i=0;$i<count($result);$i++){

			$IdUsuarioPadre="5";

			if($result[$i]->IdUsuarioPadre){
				$IdUsuarioPadre=$result[$i]->IdUsuarioPadre;
			}

			$sql="SELECT p.*, u.NombreUsuario
    	      FROM tbl_usuario_persona up
    	      inner join tbl_usuario u ON up.IdUsuario = u.IdUsuario
    	      INNER JOIN tbl_persona p ON p.IdPersona = u.IdPersona
			  WHERE u.IdUsuario={$IdUsuarioPadre}
			  ";
			$result_co=DB::select($sql);
			$result[$i]->coproductor=$result_co;
		}

		return $result;		
    }


    public function get_modulos_curso($id_curso,$IdModulo=null,$tipo_edit=null){

    	$filtro="";
		$id_estado="1";
    	if($IdModulo){
    		$filtro=" AND m.IdModulo={$IdModulo} ";
    	}

		if($tipo_edit){
			$id_estado="1,3";
		}

    	$sql="SELECT m.*, (select count(*) from tbl_tema t where t.IdModulo=m.IdModulo ) as cantidad_lecciones, e.NombreEstado
    		  FROM tbl_modulo m
			  INNER JOIN tbl_estado e ON e.IdEstado=m.IdEstado
			  WHERE m.IdCurso={$id_curso} and m.IdEstado in({$id_estado}) {$filtro} 
			  ORDER BY m.OrdenModulo ASC";
		$result=DB::select($sql);
		return $result;
    }


    public function get_lecciones_curso($id_curso,$id_leccion,$idusuario,$id_modulo=null,$tipo_edit=null){
    	$cadena_curso="";
    	$cadena_leccion="";
    	$cadena_usuario="";
    	$select_usuario="";
    	$cadena_modulo="";

    	$relacion_usuario="";
    	if($id_curso){
    		$cadena_curso=" and m.IdCurso={$id_curso} ";
    	}
    	if($id_leccion){
    		$cadena_leccion=" and t.CodigoTema='{$id_leccion}' ";
    	}

    	if($id_modulo){
    		$cadena_modulo=" and m.IdModulo={$id_modulo} ";
    	}

    	if($idusuario){
    		$select_usuario=", (SELECT EstadoTemaAvance FROM tbl_avance_tema_usuario WHERE IdTema=t.IdTema AND IdUsuarioPersona=uc.IdUsuarioPersona AND TipoAvance=1) as EstadoTemaAvance";
    		$cadena_usuario=" AND up.IdUsuario=$idusuario ";

    		$relacion_usuario="INNER JOIN tbl_usuario_curso uc on uc.IdCurso=c.IdCurso and uc.IdEstado=1
			INNER JOIN tbl_usuario_persona up ON up.IdUsuarioPersona=uc.IdUsuarioPersona ";

    	}

		$id_estado="1";
		if($tipo_edit){
			$id_estado="1,3";
		}

    	$sql="SELECT t.*,'' as clases_gratis {$select_usuario},m.IdCurso, e.NombreEstado
			from tbl_tema t 
			INNER JOIN tbl_estado e ON e.IdEstado=t.IdEstado
		    INNER JOIN tbl_modulo m ON m.IdModulo = t.IdModulo
			INNER JOIN tbl_curso c ON c.IdCurso=m.IdCurso
			{$relacion_usuario}
			where  m.IdEstado in ({$id_estado})  and  t.IdEstado in ({$id_estado}) {$cadena_leccion} {$cadena_curso} {$cadena_usuario} {$cadena_modulo}
			ORDER BY t.OrdenTema ASC
			";
		$result=DB::select($sql);

		$controller=new AdminController();
		for($i=0;$i<count($result);$i++){			

			

			/*if($result[$i]->GratisTema){
				$arra_media=$this->get_media($result[$i]->IdTema);
				if($arra_media){
			
				}
			}*/
		}
		

		return $result;
    }


    public function get_media($id_tema,$tipo_contenido=null){

		if($tipo_contenido=="modulo"){
			$sql="SELECT * FROM tbl_media where IdModulo={$id_tema} and IdEstado=1 ORDER BY IdOrden ASC";
		}else{
			$sql="SELECT * FROM tbl_media where IdTema={$id_tema} and IdEstado=1 ORDER BY IdOrden ASC";
		}
    	
		
		$result=DB::select($sql);

		$controller=new AdminController();
		for($i=0;$i<count($result);$i++){										
			
			if($result[$i]->TipoMedia==1  &&  $result[$i]->URLMedia!=""){
				$result[$i]->VideoEmbed=$controller->obtenerVideoURL($result[$i]->URLMedia,$result[$i]->TipoVideo);
			}else{
				$result[$i]->VideoEmbed="";	
			}
			
		}

		return $result;
    }

    public function get_habilidades($id_tema,$idusuariopersona,$limit,$idcurso=null){

    	$cadena_tema="";
    	$cadena_usuario="";

		if($id_tema){
			$cadena_tema=" and ht.IdTema={$id_tema}";
			$sql="  SELECT h.*
				FROM tbl_habilidad_tema ht 
				INNER JOIN tbl_habilidad h ON h.IdHabiliadad=ht.IdHabilidad and h.IdEstado=1
				WHERE ht.IdEstado=1 {$cadena_tema}";
			$result=DB::select($sql);
			return $result;
		} else if($idusuariopersona){

			$cadena_limit="";

			if($limit!=""){
				$cadena_limit="LIMIT {$limit}";
			}

			$filtro_curso="";
			if($idcurso){
				$filtro_curso=" AND m.IdCurso={$idcurso} ";
			}

			$sql="SELECT h.*
				FROM tbl_habilidad_tema ht 				
				INNER JOIN tbl_habilidad h ON h.IdHabiliadad=ht.IdHabilidad
				INNER JOIN tbl_tema t ON t.IdTema = ht.IdTema and t.IdEstado=1
				INNER JOIN tbl_modulo m ON m.IdModulo = t.IdModulo
				INNER JOIN tbl_usuario_curso uc ON uc.IdCurso=m.IdCurso and uc.IdEstado=1
				INNER JOIN tbl_avance_tema_usuario au ON au.IdUsuarioPersona=uc.IdUsuarioPersona
				WHERE ht.IdEstado=1  AND uc.IdUsuarioPersona={$idusuariopersona}  and au.EstadoTemaAvance=1 and au.TipoAvance=1
				GROUP BY h.IdHabiliadad
				{$cadena_limit}
				";
			$result=DB::select($sql);
			return $result;
		}
    	
    }

		
    public function set_avance(Request $request){
    	$input = $request->all();	   	
    	$idtema="".$input["idtema"];
    	$idusuario="".$input["idusuario"];
    	$tipoavance="".$input["tipoavance"];
    	$idestado="".$input["idestado"];
		$idcurso="".$input["idcurso"];
		
		$tipo_contenido="".$input["tipo_contenido"];
		$campo_relacion=" IdTema='{$idtema}' ";
		if($tipo_contenido=="modulo"){
			$campo_relacion=" IdModulo='{$idtema}' ";
		}

		$sql="SELECT * FROM tbl_avance_tema_usuario WHERE {$campo_relacion} AND IdUsuarioPersona={$idusuario} AND TipoAvance={$tipoavance}";
		$result=DB::select($sql);

		$porcentaje_avance=$this->get_avances_curso($idusuario,$idcurso);

		if(count($result)==0){
			$sql="INSERT INTO tbl_avance_tema_usuario set {$campo_relacion}, IdUsuarioPersona={$idusuario}, EstadoTemaAvance={$idestado}, TipoAvance={$tipoavance}";
			$result=DB::insert($sql);
			return response()->json(["status"=>'ok',"mensaje"=>"Has finalizado la lección correctamente","porcentaje_avance"=>$porcentaje_avance]);
		}else{
			$mensaje_estado="";
			if($idestado=="0"){
				$mensaje_estado="La lección no ha sido terminada ";
			}else{
				$mensaje_estado="La lección  sido terminada correctamente ";
			}
			$sql="UPDATE tbl_avance_tema_usuario set EstadoTemaAvance={$idestado}  WHERE {$campo_relacion} AND IdUsuarioPersona={$idusuario} AND TipoAvance={$tipoavance}";
			$result=DB::update($sql);
			return response()->json(["status"=>'ok',"mensaje"=>"{$mensaje_estado}","porcentaje_avance"=>$porcentaje_avance]);
		}
    	
    }

    public function set_avance_historial($idtema, $idusuario,$tipo_contenido=null){
		if($tipo_contenido=="modulo"){
			$sql="INSERT INTO tbl_avance_tema_usuario set IdModulo={$idtema}, IdUsuarioPersona={$idusuario}, EstadoTemaAvance=1, TipoAvance=2";
		}else{
			$sql="INSERT INTO tbl_avance_tema_usuario set IdTema={$idtema}, IdUsuarioPersona={$idusuario}, EstadoTemaAvance=1, TipoAvance=2";
		}
    	
		$result=DB::insert($sql);		
    }

    public function get_siguiente_tema($idcurso,$IdItem,$tipo_contenido,$url_curso){

		$url_dt=url('')."/tema/".$url_curso."/";

		$sql="	SELECT m.nombreModulo as nombre_item, CONCAT('{$url_dt}','modulo/', m.IdModulo) as url_item, 'modulo' as tipo_item, m.IdModulo as IdItem
				FROM tbl_modulo m
				WHERE m.IdCurso={$idcurso} AND m.IdEstado=1 order by m.OrdenModulo ASC";		
		$result=DB::select($sql);

		$arra_listado=array();
		for($i=0;$i<count($result);$i++){

			array_push($arra_listado,$result[$i]);
			$sql="SELECT nombreTema as nombre_item, CONCAT('{$url_dt}','leccion/',codigoTema) as url_item, 'leccion' as tipo_item,  IdTema as IdItem
				  FROM tbl_tema 
				  where IdModulo={$result[$i]->IdItem} And IdEstado=1 order by OrdenTema ASC";
    		$result2=DB::select($sql);

			for($j=0;$j<count($result2);$j++){
				array_push($arra_listado,$result2[$j]);
			}
		}

		$index_sel=-1;
		for($i=0;$i<count($arra_listado);$i++){			
			if($IdItem==$arra_listado[$i]->IdItem && $arra_listado[$i]->tipo_item==$tipo_contenido){
				$index_sel=$i;
			}
		}

		
		$idx_anterior=$index_sel-1;
		$idx_siguiente=$index_sel+1;

		$url_anterior="";
		$url_siguiente="";

		if($idx_anterior>=0){
			$url_anterior="".$arra_listado[$idx_anterior]->url_item;
		}

		if($idx_siguiente<count($arra_listado)){
			$url_siguiente="".$arra_listado[$idx_siguiente]->url_item;
		}

		$arra_sig_ant=[			
				"anterior"=>$url_anterior,
				"siguiente"=>$url_siguiente
		];




		return $arra_sig_ant;
    }

    public function get_comentarios($idtema,$tipo_contenido=null){


		$consulta_tabla="";
		if($tipo_contenido=="modulo"){
			$consulta_tabla=" c.IdModulo={$idtema}";
		}else{
			$consulta_tabla=" c.IdTema={$idtema}";
		}

    	$sql="SELECT c.*, CONCAT_WS(' ',p.NombrePersona,p.ApellidosPersona)as NombrePersona, u.NombreUsuario,
    	      p.FotoPersona, '' as fecha_hace,
    	      (select count(*) from tbl_comentario c2 where c2.IdComentarioPadre=c.IdComentario and c2.IdEstado=1 )as cant_respuesta
    		  FROM tbl_comentario c
    		  INNER JOIN tbl_usuario_persona up ON up.IdUsuarioPersona=c.IdUsuarioPersona
    		  INNER JOIN tbl_usuario u ON u.IdUsuario=up.IdUsuario
    		  INNER JOIN tbl_persona p ON p.IdPersona=up.IdPersona
    		  WHERE c.IdEstado=1 AND {$consulta_tabla}
    		  ORDER BY c.FechaCreacion DESC";
    	$result=DB::select($sql);

    	$controller = new AdminController();
    	for($i=0;$i<count($result);$i++){
    		$result[$i]->fecha_hace=$controller->time_passed($result[$i]->FechaCreacion);
    	}

		return $result;	
	}
	
	public function get_comentarios_ajax(Request $request){
		$input = $request->all();	   	
    	$idtema="".$input["idtema"];
		$tipo_contenido="".$input["tipo_contenido"];
		
		$arra_comentarios=$this->get_comentarios($idtema,$tipo_contenido);
		return response()->json(["status"=>'ok',"comentarios"=>$arra_comentarios]);		
	}


    public function set_comentarios(Request $request){
    	$input = $request->all();	   	
    	$idtema="".$input["idtema"];
    	$idcomentario="".$input["idcomentario"];
    	$idrespuesta="".$input["idrespuesta"];
    	$mensaje="".$input["mensaje"];
    	$idusuariopersona="".$input["idusuario"];
		$tipo_contenido="".$input["tipo_contenido"];
		

    	$field_id_comentario_padre="";
    	if($idcomentario!=""){
    		$field_id_comentario_padre="IdComentarioPadre='{$idcomentario}',";
    	}

    	$field_id_respuesta="";
    	if($idrespuesta!=""){
    		$field_id_respuesta="IdRespuestaComentario='{$idrespuesta}',";
    	}

    	$controller = new AdminController();


		$campo_relacion=" IdTema='{$idtema}', ";
		if($tipo_contenido=="modulo"){
			$campo_relacion=" IdModulo='{$idtema}', ";
		}

		$sql="INSERT INTO tbl_comentario 
			  set {$campo_relacion}
			  {$field_id_comentario_padre}
			  {$field_id_respuesta}
			  IdUsuarioPersona='{$idusuariopersona}',
			  MensajeComentario='{$mensaje}',			  
			  IdEstado=1
			  ";
		$result=DB::insert($sql);

		

				
		//AGREGAR NOTIFICACION PARA EL TUTOR
		/*$nombre_usuario_tutor="";
		$nombre_curso="";
		$nombre_tema="";


		$sql_sentencia="SELECT usu.NombreUsuario, usu.IdRol, usu.IdRolAfiliado, p.*
					FROM tbl_usuario usu
					INNER JOIN tbl_persona p ON usu.IdPersona=p.IdPersona AND usu.IdEstado=1 and p.IdEstado=1
					WHERE usu.IdUSuario='{$IdUsuarioPadre}'";
		$result_usu=DB::select($sql_sentencia);
		$email_usuario_notificacion="".$result_usu[0]->EmailPersona;

		$TituloNoticia="Tienes un nuevo comentario";
		$DescripcionNoticia="El usuario {$nombre_usuario_tutor}, ha escrito en tu Curso:{$nombre_curso} -  en el tema: {$nombre_tema}";

		$TipoNoticia="1";
		$IconoNoticia="bell.png";
		$URLNoticia=url('')."/listado-afiliados";
		$IdUsuario=$IdUsuarioTutor;
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
				$mensaje_usuario);	*/				
	//FINALIZAR NOTIFICACION TUTOR


		//AGREGAR NOTIFICACION PARA LA PERSONA - 
		/*$nombre_usuario_tutor="";
		$nombre_curso="";
		$nombre_tema="";

		
		$sql_sentencia="SELECT usu.NombreUsuario, usu.IdRol, usu.IdRolAfiliado, p.*
					FROM tbl_usuario usu
					INNER JOIN tbl_persona p ON usu.IdPersona=p.IdPersona AND usu.IdEstado=1 and p.IdEstado=1
					WHERE usu.IdUSuario='{$IdUsuarioPadre}'";
		$result_usu=DB::select($sql_sentencia);
		$email_usuario_notificacion="".$result_usu[0]->EmailPersona;

		$TituloNoticia="Tienes un nuevo comentario";
		$DescripcionNoticia="El usuario {$nombre_usuario_tutor}, ha escrito en tu Curso:{$nombre_curso} -  en el tema: {$nombre_tema}";

		$TipoNoticia="1";
		$IconoNoticia="bell.png";
		$URLNoticia=url('')."/listado-afiliados";
		$IdUsuario=$IdUsuarioTutor;
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
				$mensaje_usuario);					*/
	//FINALIZAR NOTIFICACION TUTOR
			

		

		return response()->json(["status"=>'ok',"mensaje"=>"Comentario insertado correctamente."]);

    	
    }


	public function eliminar_comentario(Request $request){
    	$input = $request->all();	   	
    	$idtema="".$input["idtema"];
    	$idcomentario="".$input["idcomentario"];    	
    	$idusuariopersona="".$input["idusuario"];   	
    	$tipo_contenido="".$input["tipo_contenido"];

		$campo_relacion=" IdTema='{$idtema}' ";
		if($tipo_contenido=="modulo"){
			$campo_relacion=" IdModulo='{$idtema}' ";
		}
		



    	$controller = new AdminController();

		$sql="UPDATE tbl_comentario 
			  set IdEstado=2
			  where {$campo_relacion} and
			  IdUsuarioPersona='{$idusuariopersona}' and			  
			  IdComentario={$idcomentario}
			  ";
		$result=DB::update($sql);		

		return response()->json(["status"=>'ok',"mensaje"=>"Comentario eliminado correctamente."]);

    	
    }
	


    public function get_evaluaciones($IdCurso,$es_verdadero=""){
		//TODO: Estado de la evaluacion en 1 - Verificar estado 
    	$sql="SELECT * FROM tbl_evaluacion where IdCurso={$IdCurso} AND IdEstado=1";
    	$result=DB::select($sql);

		

		for($i=0;$i<count($result);$i++){

			

			$sql="SELECT p.* 
			  FROM tbl_pregunta p			  
			  where p.IdEstado=1 AND p.IdEvaluacion={$result[$i]->IdEvaluacion}
			  ORDER BY RAND ()  ";
			$result_pregunta=DB::select($sql);

			for($j=0;$j<count($result_pregunta);$j++){
				
				$sql="SELECT IdRespuesta, IdPregunta, NombreRespuesta, IdEstado
					 FROM tbl_respuesta where IdPregunta={$result_pregunta[$j]->IdPregunta} and IdEstado=1
					 ORDER BY RAND ()  ";
				$result_respuesta=DB::select($sql);
				$result_pregunta[$j]->respuestas=$result_respuesta;

			}

			$result[$i]->preguntas=$result_pregunta;

		}
		return $result;
    }

    public function fichacursoventa($url_curso,$codigo_usuario=null,$id_seguimiento=null){
		
		$info_curso="";

		$controller = new AdminController();
    	$arra_data=$controller->VerificarSesid();

		if(session('rol_solicitud')=="tutor"){
			
			//$info_curso=$this->get_cursos_persona("",$url_curso,null,null,null,null,null,null,null,'1,2,3,4',null,null);
			$info_curso=$this->get_cursos_persona('',$url_curso,'','','','','','',$arra_data[0]->IdUsuarioPersona,'1,2,3,4');

			if(count($info_curso)==0){
				$info_curso=$this->get_cursos_persona("",$url_curso);
			}

		}

    	if(session('rol_solicitud')=="root"){

    		//$info_curso=$this->get_cursos_persona("",$url_curso,null,null,null,null,null,null,$idtutor=null,'1,2,3,4',null,null);
    		$info_curso=$this->get_cursos_persona("",$url_curso,null,null,null,null,null,null,null,'1,2,3,4',null,null);

    	}else{
			if($info_curso==""){
				$info_curso=$this->get_cursos_persona("",$url_curso);				
			}
		}
		
		$curso_comprado="0";
		if(count($arra_data)!=0){
			$arra_curso_comprado=$this->get_cursos_persona($arra_data[0]->SesidUsuario,$url_curso);			
			if(count($arra_curso_comprado)>0){
				$curso_comprado="1";
			}			
		}	
	
    	
    	if(count($info_curso)==0){
    		return abort(404);
    	}else{
			
    		//INFO MODULOS
			$info_modulos=$this->get_modulos_curso($info_curso[0]->IdCurso);
			$info_lecciones=$this->get_lecciones_curso($info_curso[0]->IdCurso,'','');
			
			$pixel_facebook_afiliado="";
			$token_facebook_afiliado="";

			$pixel_facebook_docttus="";
			$token_facebook_docttus="";
			$url_hotmart="";
			if($codigo_usuario){
				
				$solicitud_afiliado=$this->get_solicitud_afiliado($info_curso[0]->IdCurso,null,$codigo_usuario);
				$arra_solicitud=explode("||",$solicitud_afiliado);				
				$pixel_facebook_afiliado="".$arra_solicitud[0];				
				$url_hotmart="".$arra_solicitud[1];
				$token_facebook_afiliado="".$arra_solicitud[2];
			}

			$solicitud_afiliado2=$this->get_solicitud_afiliado($info_curso[0]->IdCurso,5);
			$arra_solicitud_2=explode("||",$solicitud_afiliado2);
			$pixel_facebook_docttus="".$arra_solicitud_2[0];
			$url_hotmart_docttus="".$arra_solicitud_2[1];
			$token_facebook_docttus="".$arra_solicitud_2[2];

			if($url_hotmart==""){
				$url_hotmart=$url_hotmart_docttus;
			}
			Log::debug($solicitud_afiliado2);
			

			

    		$info_beneficios=$this->get_beneficios($info_curso[0]->IdCurso);
    		return view('marketing.fichacurso',[
    			"curso"=>$info_curso[0],
    			"beneficios"=>$info_beneficios,
    			"codigo_usuario"=>$codigo_usuario,
				"info_modulos"=>$info_modulos,
				"curso_comprado"=>$curso_comprado,
				"info_lecciones"=>$info_lecciones,
				"pixel_facebook_afiliado"=>$pixel_facebook_afiliado,
				"token_facebook_afiliado"=>$token_facebook_afiliado,
				"pixel_facebook_docttus"=>$pixel_facebook_docttus,
				"token_facebook_docttus"=>$token_facebook_docttus,
				"url_hotmart"=>$url_hotmart
				
    		]);
    	}    	
    }

    public function get_beneficios($IdCurso){
    	$sql="SELECT * FROM tbl_curso_beneficios where IdCurso={$IdCurso}";
    	$result=DB::select($sql);
		return $result;	
    }


    public function get_habilidades_by_curso($idcurso){
    	$sql="SELECT h.*
				FROM tbl_habilidad_tema ht 				
				INNER JOIN tbl_habilidad h ON h.IdHabiliadad=ht.IdHabilidad
				INNER JOIN tbl_tema t ON t.IdTema = ht.IdTema and t.IdEstado=1
				INNER JOIN tbl_modulo m ON m.IdModulo = t.IdModulo				
				WHERE ht.IdEstado={$idcurso}  and m.IdCurso=1 
				GROUP BY h.IdHabiliadad";
		$result=DB::select($sql);
		return $result;

	}
	
	public function get_todas_habilidades(){
		$sql="SELECT * FROM tbl_habilidad WHERE IdEstado=1";
		$result=DB::select($sql);
		return $result;
	}


    public function get_cursos_docttus(){    	
		$cursosactuales=$this->get_cursos_marketing();
 	   	return view('marketing.cursos-docttus',["cursos_disponibles"=>$cursosactuales]);
    }
    

	
    public function get_cursos_marketing(){

    	

    	$sql="SELECT c.*, '' as habilidades,
			  (select count(*) from tbl_modulo m where m.IdCurso=c.IdCurso and m.IdEstado=1 ) as cantidad_modulos,
			  ( select count(*) 
			    from tbl_tema t 
			    LEFT JOIN tbl_modulo m ON m.IdModulo = t.IdModulo
			    where m.IdCurso=c.IdCurso and m.IdEstado=1 ) as cantidad_lecciones,
			    ( select format(sum(t.DuracionTema)/60,2)
			    from tbl_tema t 
			    LEFT JOIN tbl_modulo m ON m.IdModulo = t.IdModulo
			    where m.IdCurso=c.IdCurso and m.IdEstado=1 ) as cantidad_horas,  c.PrecioCurso as ValorPrecioProducto
			FROM tbl_curso c 					
			WHERE c.IdEstado=1";
		$result=DB::select($sql);

		for($i=0;$i<count($result);$i++){
			$result[$i]->habilidades=$this->get_habilidades_by_curso($result[$i]->IdCurso);
		}

		return $result;	
    }


    public function get_categorias($destacados=null){
    	$filtro="";
    	if($destacados==1){
    		$filtro="and AplicaPrioridadCategoria=1";
    	}
    	$sql="SELECT * FROM tbl_categoria_cursos where 1 $filtro AND IdEstado=1";
    	$result=DB::select($sql);
    	return $result;	
    }

    public function get_subcategorias($destacados=null){
    	$filtro="";
    	if($destacados==1){
    		$filtro="and AplicaPrioridadCategoria=1";
    	}
    	$sql="SELECT * FROM tbl_subcategoria where 1 $filtro  AND IdEstado=1";
    	$result=DB::select($sql);
    	return $result;
    }


	public function get_supercategorias(){    	
    	$sql="SELECT * FROM tbl_supercategoria where  IdEstado=1";
    	$result=DB::select($sql);
    	return $result;
    }

	public function fichacategoria($url_categoria){
		$sql="SELECT * FROM tbl_categoria_cursos where SlugCategoria='{$url_categoria}' and  IdEstado=1 limit 1";
    	$result=DB::select($sql);

    	$titulo_pagina="";
    	$descripcion_pagina="";
    	$id_categoria="";
    	$id_subcategoria="";

    	for($i=0;$i<count($result);$i++){
    		$titulo_pagina="".$result[$i]->NombreCategoria;
    		$descripcion_pagina="";
    		$id_categoria="".$result[$i]->IdCategoriaCursos;
    		$id_subcategoria="";
    	}


    	return view('marketing.fichacategoria',[
    			"titulo_pagina"=>"{$titulo_pagina}",
    			"descripcion_pagina"=>"{$descripcion_pagina}",
    			"url_categoria"=>"{$url_categoria}",
    			"id_categoria"=>"{$id_categoria}",
    			"id_subcategoria"=>"{$id_subcategoria}"
    			
    		]);
	}

    public function fichasubcategoria($url_categoria){

    	$sql="SELECT * FROM tbl_subcategoria where SlugSubcategoria='{$url_categoria}' and  IdEstado=1 limit 1";
    	$result=DB::select($sql);

    	$titulo_pagina="";
    	$descripcion_pagina="";
    	$id_categoria="";
    	$id_subcategoria="";

    	for($i=0;$i<count($result);$i++){
    		$titulo_pagina="".$result[$i]->NombreSubcategoria;
    		$descripcion_pagina="";
    		$id_categoria="".$result[$i]->IdCategoria;
    		$id_subcategoria="".$result[$i]->IdSubcategoria;
    	}


    	return view('marketing.fichacategoria',[
    			"titulo_pagina"=>"{$titulo_pagina}",
    			"descripcion_pagina"=>"{$descripcion_pagina}",
    			"url_categoria"=>"{$url_categoria}",
    			"id_categoria"=>"{$id_categoria}",
    			"id_subcategoria"=>"{$id_subcategoria}"
    			
    		]);
    }


    
    public function get_calificaciones_by_curso($idcurso){
    	$sql="SELECT ccp.*, p.NombrePersona, p.ApellidosPersona
    	      FROM tbl_calificacion_curso_persona ccp     	      
    	      INNER JOIN tbl_usuario_persona up ON up.IdUsuarioPersona=ccp.IdPersonaUsuario
    		  INNER JOIN tbl_usuario u ON u.IdUsuario=up.IdUsuario
    		  INNER JOIN tbl_persona p ON p.IdPersona=up.IdPersona
    	      WHERE ccp.IdEstado=1 and ccp.IdCurso={$idcurso}";
		$result=DB::select($sql);
		return $result;

    }

    public function get_cant_estudiantes_by_curso($idcurso){

    	$sql="SELECT count(*)as Cantidad_Estudiantes FROM tbl_usuario_curso WHERE IdCurso={$idcurso} and IdEstado=1 ";
    	$result=DB::select($sql);
		return $result[0]->Cantidad_Estudiantes;

    }



    
    public function formcheckout($url_curso,$codigo_usuario=null,$id_seguimiento=null){
    	$info_curso=$this->get_cursos_persona("",$url_curso);
    	if(count($info_curso)==0){
    		return abort(404);
    	}else{

			$controller = new AdminController();
			$arra_data=$controller->VerificarSesid();
			$CodigoTransaccion="";
			if(count($arra_data)>0){	

				$IdAfiliado="";
				$PrecioCurso="";
				$ComisionAfiliado=0;
				$ComisionTutor=0;
				$ComisionEmpresa=0;
				$IdTutor="".$info_curso[0]->IdUsuarioTutor;
				$DiasGarantia="30";

				if($codigo_usuario){
					$sql="SELECT * FROM tbl_usuario where NombreUsuario='{$codigo_usuario}' and IdEstadoSolicitudAfiliado=1 and IdEstado=1 ";
					$result_bd=DB::select($sql);
					if(count($result_bd)>0){
						$IdAfiliado="".$result_bd[0]->IdUsuario;
					}
				}else{
					$sql="SELECT * FROM tbl_usuario_curso where IdUsuarioPersona='{$arra_data[0]->IdUsuarioPersona}' and  IdCurso='{$info_curso[0]->IdCurso}' and IdAfiliado is not null limit 1";
					$result_bd=DB::select($sql);
					if(count($result_bd)>0){
						$IdAfiliado="".$result_bd[0]->IdAfiliado;
					}
				}
				


				$valor_anterior=$info_curso[0]->ValorPrecioProducto;
				$valor_curso_actual=$info_curso[0]->ValorPrecioProducto;
				$descuento_curso=$info_curso[0]->DescuentoCurso;
				$porcentaje_curso=0;

				if($descuento_curso){
					
					$valor_curso_actual=$valor_curso_actual-($valor_curso_actual*($descuento_curso/100));
					$porcentaje_curso=$descuento_curso;

				}

				$valor_prod_iva=0;
				if($info_curso[0]->ValorImpuesto){
					$valor_prod_iva=($valor_curso_actual*($info_curso[0]->ValorImpuesto/100));
				}
				

				$PrecioCurso=round($valor_curso_actual,2);
				$id_comision="";
				if(!$IdAfiliado){
					$id_comision="1";
				}else{
					if($IdTutor==$IdAfiliado){
						$id_comision="3";
					}else{
						$id_comision="2";
					}
				}

				
				//Log::warning("ID_Comision {$id_comision} ");

				
				$comisiones=$controller->get_comisiones($id_comision);

				$PorcentajeAfiliados=$comisiones[0]->PorcentAfiliado;
				$PorcentajeTutor=$comisiones[0]->PorcentTutor;
				$PorcentajeEmpresa=$comisiones[0]->PorcentEmpresa;

				
				$IdImpuesto=$info_curso[0]->IdImpuesto;
				$ValorImpuesto=round($valor_prod_iva,2);

				$AutoRenta=0.8;			
				$ValorAutoRenta=$PrecioCurso*($AutoRenta/100);

				$CostosAdicionales=9.2;
				$ValorCostosAdicionales=$PrecioCurso*($CostosAdicionales/100);

				$precio_base_prod=$PrecioCurso-($ValorAutoRenta+$ValorCostosAdicionales);

				$ComisionAfiliado=$precio_base_prod*($PorcentajeAfiliados/100);				
				$ComisionTutor=$precio_base_prod*($PorcentajeTutor/100);
				$ComisionEmpresa=$precio_base_prod*($PorcentajeEmpresa/100);

				$ComisionAfiliado=round($ComisionAfiliado,2);
				$ComisionTutor=round($ComisionTutor,2);
				$ComisionEmpresa=round($ComisionEmpresa,2);



				$CodigoTransaccion= $this->iniciar_compra(  $info_curso[0]->IdCurso,
															$arra_data[0]->IdUsuarioPersona,
															$IdAfiliado,
															$PrecioCurso,
															$ComisionAfiliado,
															$ComisionTutor,
															$ComisionEmpresa,
															$IdTutor,
															$DiasGarantia,
															$IdImpuesto, 
															$ValorImpuesto, 
															$AutoRenta, 
															$ValorAutoRenta, 
															$CostosAdicionales, 
															$ValorCostosAdicionales,
															$precio_base_prod
														);
				//iniciar_compra($IdCurso,$IdUsuarioPersona,$IdAfiliado,$PrecioCurso,$ComisionAfiliado,$ComisionTutor,$ComisionEmpresa,$IdTutor,$DiasGarantia)
			}

    		//INFO MODULOS
			$info_modulos=$this->get_modulos_curso($info_curso[0]->IdCurso);
			$info_lecciones=$this->get_lecciones_curso($info_curso[0]->IdCurso,'','');

			$info_beneficios=$this->get_beneficios($info_curso[0]->IdCurso);
			

			$curso_comprado="0";
			if(count($arra_data)!=0){
				$arra_curso_comprado=$this->get_cursos_persona($arra_data[0]->SesidUsuario,$url_curso);			
				if(count($arra_curso_comprado)>0){
					$curso_comprado="1";
				}			
			}	

			$sql="SELECT * FROM tbl_config_empresa";
			$result_config=DB::select($sql);			
			for($i=0;$i<count($result_config);$i++){				
				$TipoProcesador="".$result_config[$i]->TipoProcesador;
			}

			/*
			
			API KEY      	WfYLLCsRA30535PBHWUf27GzVO
			API LOGIN    	4sO1U1QzO0xuZLR
			Llave pública  	PKi607T7h4iV3qrmjP7398jv2l
			Merchant ID 	922562
			Cuenta  		929778

			*/


			$curso=$info_curso[0];

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


			
			$ApiKey="WfYLLCsRA30535PBHWUf27GzVO";
			$merchantId="922562";
			$accountId="929778";
			
			$referenceCode=$CodigoTransaccion;
			$amount="{$valor_curso_actual}";			
			$currency="USD";			
			

			$signature="{$ApiKey}~{$merchantId}~{$referenceCode}~{$amount}~{$currency}";
			$signature=md5($signature);



    		return view('marketing.checkout',[
    			"curso"=>$info_curso[0],
    			"beneficios"=>$info_beneficios,
    			"codigo_usuario"=>$codigo_usuario,
    			"info_modulos"=>$info_modulos,
				"info_lecciones"=>$info_lecciones,
				"url_curso"=>$url_curso,
				"curso_comprado"=>$curso_comprado,
				"CodigoTransaccion"=>$CodigoTransaccion,
				"TipoProcesador"=>$TipoProcesador,
				"signature"=>$signature,
				"amount"=>$amount,				
				"merchantId"=>$merchantId,
				"accountId"=>$accountId,
				"currency"=>$currency,
				"referenceCode"=>$referenceCode

    		]);
    	}    	
    }



    //AREA DE CREACIÓN DE CURSOS

    public function setcurso(Request $request){
    	$input = $request->all();	   	
    	$titulo_curso="".$input["titulo_curso"];
    	$subcategoria_curso="".$input["subcategoria_curso"];

    	$controller = new AdminController();
    	$arra_data=$controller->VerificarSesid();
		if(count($arra_data)==0){			
			return response()->json(["status"=>'error',"mensaje"=>"Se ha perdido la sesión"]);
		}else{

			DB::beginTransaction();

			$IdUsuarioPersona=$arra_data[0]->IdUsuarioPersona;
			$CodigoCurso=$this->get_codigo_curso();
			$NombreTutor=$arra_data[0]->NombrePersona;
			$DescripcionTutor=$arra_data[0]->DescripcionPersona;
			$FotoTutor=$arra_data[0]->FotoPersona;
			$NombreSlug=$titulo_curso."-".$CodigoCurso;
			$SlugCurso=$controller->createSlug($NombreSlug);

			
			$sql="	SELECT imp.ValorImpuesto, imp.NombreImpuesto, imp.IdImpuesto
					FROM tbl_subcategoria sub
					INNER JOIN tbl_impuesto imp ON imp.IdImpuesto=sub.IdImpuesto and imp.IdEstado=1
					WHERE sub.IdSubcategoria={$subcategoria_curso} and sub.IdEstado=1
					LIMIT 1";
			$result_impuesto=DB::select($sql);

			$IdImpuesto="null";

			if(count($result_impuesto)>0){
				$IdImpuesto="".$result_impuesto[0]->IdImpuesto;
			}



			$sql="INSERT INTO tbl_curso SET NombreCurso='{$titulo_curso}', 
				   	CodigoCurso='{$CodigoCurso}', IdUsuarioTutor='{$IdUsuarioPersona}',
				   	NombreTutor='{$NombreTutor}', IdSubcategoria='{$subcategoria_curso}',
				   	DescripcionTutor='{$DescripcionTutor}',
				   	FotoTutor='{$FotoTutor}',
				   	SlideCurso='header-bg.jpg',
				   	ImagenCurso='curso-base.jpg',
					IdImpuesto={$IdImpuesto},
				   	PorcentajeAfiliados=50, PorcentajeTutor=20, IdTipoCurso=1, IdEstado=3, SlugCurso='{$SlugCurso}', AprobacionAutomatica=0, TipoVideo=1;";
			$result=DB::insert($sql);
			$IdCurso = DB::getPDO()->lastInsertId();
			
			//ASIGNACIÓN USUARIO POR DEFECTO
			$this->asignacion_usuarios_default($IdCurso,$IdUsuarioPersona);
						

			//DB::rollBack(); ;


			DB::commit();

			return response()->json(["status"=>'ok',"mensaje"=>"Se ha registrado el curso correctamente","CodigoCurso"=>$CodigoCurso]);
		}


    }


    //AREA DE EDICIÓN BÁSICA

    public function editarinformacionbasica(Request $request){
    	$input = $request->all();	   	
    	$CodigoCurso="".$input["CodigoCurso"];
    	$NombreCurso="".addslashes($input["NombreCurso"]);
    	$SlugCurso="".$input["SlugCurso"];
    	$IdSubcategoria="".$input["IdSubcategoria"];
    	$DescripcionCortaCurso="".addslashes($input["DescripcionCortaCurso"]);
    	$DescripcionCurso="".addslashes($input["DescripcionCurso"]);
    	$AudienciaCurso="".addslashes($input["AudienciaCurso"]);
		$PrerrequisitoCurso="".addslashes($input["PrerrequisitoCurso"]);
		$URLMaterialPromocional="".addslashes($input["URLMaterialPromocional"]);
		
		$AprobacionAutomatica="".addslashes($input["AprobacionAutomatica"]);

		$cadena_url_solicitud_afiliados="";
		if(session('rol_solicitud')=="root"){
			$URLHotmartSolicitudAfiliados="".addslashes($input["URLHotmartSolicitudAfiliados"]);
			
			$CodigoHotmart="".addslashes($input["CodigoHotmart"]);			
			$SeccionCurso="".addslashes($input["SeccionCurso"]);			

			$cadena_url_solicitud_afiliados=" URLHotmartSolicitudAfiliados='{$URLHotmartSolicitudAfiliados}', 
											  CodigoHotmart='{$CodigoHotmart}', 
											  SeccionCurso='{$SeccionCurso}', ";
						
		}
				
		
		$IdNivelCurso="".addslashes($input["IdNivelCurso"]);

		$IdTipoLanzamiento="".addslashes($input["IdTipoLanzamiento"]);
		$IdTipoCurso="".addslashes($input["IdTipoCurso"]);

		$token_curso_post="".$input["token_curso"];

    	$controller = new AdminController();
    	$arra_data=$controller->VerificarSesid();
		if(count($arra_data)==0){			
			return response()->json(["status"=>'error',"mensaje"=>"Se ha perdido la sesión"]);
		}else{

			$key="".$arra_data[0]->SesidUsuario."@".$CodigoCurso;				
			$token_curso="".md5($key);

			if($token_curso_post!=$token_curso){
				return response()->json(["status"=>'error',"mensaje"=>"Token Defectuoso"]);
			}

			DB::beginTransaction();

			try {

				$sql="	SELECT imp.ValorImpuesto, imp.NombreImpuesto, imp.IdImpuesto
						FROM tbl_subcategoria sub
						INNER JOIN tbl_impuesto imp ON imp.IdImpuesto=sub.IdImpuesto and imp.IdEstado=1
						WHERE sub.IdSubcategoria={$IdSubcategoria} and sub.IdEstado=1
						LIMIT 1";
				$result_impuesto=DB::select($sql);

				$IdImpuesto="null";

				if(count($result_impuesto)>0){
					$IdImpuesto="".$result_impuesto[0]->IdImpuesto;
				}

				

				$sql="UPDATE tbl_curso SET  NombreCurso='{$NombreCurso}', 
					SlugCurso='{$SlugCurso}', 
					IdSubcategoria='{$IdSubcategoria}',
					DescripcionCortaCurso='{$DescripcionCortaCurso}',
					DescripcionCurso='{$DescripcionCurso}',
					AudienciaCurso='{$AudienciaCurso}',
					PrerrequisitoCurso='{$PrerrequisitoCurso}',
					URLMaterialPromocional='{$URLMaterialPromocional}',
					AprobacionAutomatica='{$AprobacionAutomatica}',
					IdImpuesto={$IdImpuesto},
					IdTipoLanzamiento={$IdTipoLanzamiento},
					IdTipoCurso={$IdTipoCurso},
					{$cadena_url_solicitud_afiliados}
					IdNivelCurso='{$IdNivelCurso}'
					WHERE CodigoCurso='{$CodigoCurso}'";
				$result=DB::update($sql);

				if(session('rol_solicitud')=="root"){
					$URLHotmartCheckoutDocttus="".addslashes($input["URLHotmartCheckoutDocttus"]);
					$PixelFacebook="".addslashes($input["PixelFacebook"]);
					$TokenFacebook="".addslashes($input["TokenFacebook"]);
					$this->generar_solicitud(null,5,$URLHotmartCheckoutDocttus,$PixelFacebook,$TokenFacebook,$CodigoCurso);
				}



			
			}catch (\Illuminate\Database\QueryException $e) {			
				report($e);
				DB::rollBack();
				return response()->json(["status"=>'error',"mensaje"=>"Hay un error en el sistema, por favor intenta más tarde."]);	
			}
			DB::commit();
			return response()->json(["status"=>'ok',"mensaje"=>"Se ha registrado el curso correctamente"]);
		}


    }

    //AREA DE EDICIÓN PRECIOS

    public function editarprecioscurso(Request $request){
    	$input = $request->all();	   	
    	$CodigoCurso="".$input["CodigoCurso"];
    	$PrecioCurso="".addslashes($input["PrecioCurso"]);
    	$DescuentoCurso="".addslashes($input["DescuentoCurso"]);    	
    	
		$cadena_aplica_gratis="";
		if(session('rol_solicitud')=="root"){
			$AplicaGratisCurso="".addslashes($input["AplicaGratisCurso"]);		
			$cadena_aplica_gratis=", AplicaGratisCurso='{$AplicaGratisCurso}' ";
		}
    	
    	$token_curso_post="".$input["token_curso"];

    	$controller = new AdminController();
    	$arra_data=$controller->VerificarSesid();
		if(count($arra_data)==0){			
			return response()->json(["status"=>'error',"mensaje"=>"Se ha perdido la sesión"]);
		}else{

			$key="".$arra_data[0]->SesidUsuario."@".$CodigoCurso;				
			$token_curso="".md5($key);

			if($token_curso_post!=$token_curso){
				return response()->json(["status"=>'error',"mensaje"=>"Token Defectuoso"]);
			}

			DB::beginTransaction();
			

			$sql="UPDATE tbl_curso SET  PrecioCurso='{$PrecioCurso}', 
				  DescuentoCurso='{$DescuentoCurso}',
				  TipoDescuento=1 {$cadena_aplica_gratis}
				  WHERE CodigoCurso='{$CodigoCurso}'";
			$result=DB::update($sql);



			//DB::rollBack();

			DB::commit();

			return response()->json(["status"=>'ok',"mensaje"=>"Se ha registrado el curso correctamente"]);
		}
    }

	public function editarevaluacioncurso(Request $request){
    	$input = $request->all();	   	
    	$CodigoCurso="".$input["CodigoCurso"];
    	$NombreEvaluacion="".addslashes($input["NombreEvaluacion"]);
    	$DescripcionEvaluacion="".addslashes($input["DescripcionEvaluacion"]);
		$PorcentajeMinimo="".addslashes($input["PorcentajeMinimo"]);
		$MinutosEvaluacion="".addslashes($input["MinutosEvaluacion"]);

		if($PorcentajeMinimo==""){
			$PorcentajeMinimo="0";
		}

    	$token_curso_post="".$input["token_curso"];

    	$controller = new AdminController();
    	$arra_data=$controller->VerificarSesid();
		if(count($arra_data)==0){			
			return response()->json(["status"=>'error',"mensaje"=>"Se ha perdido la sesión"]);
		}else{

			$key="".$arra_data[0]->SesidUsuario."@".$CodigoCurso;				
			$token_curso="".md5($key);

			if($token_curso_post!=$token_curso){
				return response()->json(["status"=>'error',"mensaje"=>"Token Defectuoso"]);
			}

			DB::beginTransaction();

			$sql="UPDATE tbl_evaluacion SET  NombreEvaluacion='{$NombreEvaluacion}', 
				  DescripcionEvaluacion='{$DescripcionEvaluacion}',
				  PorcentajeMinimo='{$PorcentajeMinimo}',
				  MinutosEvaluacion='{$MinutosEvaluacion}',
				  IdEstado=1
				  WHERE IdCurso=(SELECT IdCurso FROM tbl_curso WHERE CodigoCurso='{$CodigoCurso}')";
			$result=DB::update($sql);



			//DB::rollBack();

			DB::commit();

			return response()->json(["status"=>'ok',"mensaje"=>"Datos de evaluación guardados correctamente"]);
		}

	}


	public function editarpreguntasevaluacioncurso(Request $request){
		//TODO: Llave compuesta con el id pregunta
		$input = $request->all();	   	
    	$CodigoCurso="".$input["CodigoCurso"];
    	$IdEvaluacion="".addslashes($input["IdEvaluacion"]);
    	$NombrePregunta="".addslashes($input["NombrePregunta"]);
		$IdPregunta="".addslashes($input["IdPregunta"]);
		
    	$token_curso_post="".$input["token_curso"];

    	$controller = new AdminController();
    	$arra_data=$controller->VerificarSesid();
		if(count($arra_data)==0){			
			return response()->json(["status"=>'error',"mensaje"=>"Se ha perdido la sesión"]);
		}else{

			$key="".$arra_data[0]->SesidUsuario."@".$CodigoCurso;				
			$token_curso="".md5($key);

			if($token_curso_post!=$token_curso){
				return response()->json(["status"=>'error',"mensaje"=>"Token Defectuoso"]);
			}

			DB::beginTransaction();

			if($IdPregunta){

				$sql="UPDATE tbl_pregunta SET  NombrePregunta='{$NombrePregunta}' WHERE IdEvaluacion={$IdEvaluacion} AND IdPregunta={$IdPregunta} ";
				$result=DB::update($sql);
			}else{
				$sql="INSERT INTO tbl_pregunta SET IdEstado=1, IdTipoPregunta=1, NombrePregunta='{$NombrePregunta}', IdEvaluacion={$IdEvaluacion}";
				$result=DB::insert($sql);
			}
			//DB::rollBack();

			DB::commit();

			return response()->json(["status"=>'ok',"mensaje"=>"Datos de pregunta registrados correctamente"]);
		}
	}

	public function getpreguntasevaluacioncurso(Request $request){
		
		$input = $request->all();	   	
    	$CodigoCurso="".$input["CodigoCurso"];
    	$IdEvaluacion="".addslashes($input["IdEvaluacion"]);
    	$token_curso_post="".$input["token_curso"];

    	$controller = new AdminController();
    	$arra_data=$controller->VerificarSesid();
		if(count($arra_data)==0){			
			return response()->json(["status"=>'error',"mensaje"=>"Se ha perdido la sesión"]);
		}else{


			if(session('rol_solicitud')=="root"){
				$sql="SELECT IdUsuarioTutor from tbl_curso where CodigoCurso='{$CodigoCurso}'";
				$result_bd=DB::select($sql);
				$curso=$this->get_cursos_persona('','','','','','','','',$result_bd[0]->IdUsuarioTutor,'1,2,3,4',$CodigoCurso);
			}else{
				$curso=$this->get_cursos_persona('','','','','','','','',$arra_data[0]->IdUsuarioPersona,'1,2,3,4',$CodigoCurso);
			}

			$key="".$arra_data[0]->SesidUsuario."@".$CodigoCurso;				
			$token_curso="".md5($key);

			if($token_curso_post!=$token_curso){
				return response()->json(["status"=>'error',"mensaje"=>"Token Defectuoso"]);
			}

			DB::beginTransaction();				
			
				
			$sql="SELECT * FROM tbl_pregunta where IdEvaluacion={$IdEvaluacion} and IdEstado=1";
			$result_pregunta=DB::select($sql);

			for($j=0;$j<count($result_pregunta);$j++){
				
				$sql="SELECT * FROM tbl_respuesta where IdPregunta={$result_pregunta[$j]->IdPregunta} and IdEstado=1";
				$result_respuesta=DB::select($sql);
				$result_pregunta[$j]->respuestas=$result_respuesta;

			}			
			
			//DB::rollBack();

			DB::commit();
			return response()->json(["status"=>'ok',"datos"=>$result_pregunta]);
		}

	}


	public function editarrespuestapreguntaevaluacioncurso(Request $request){
    	//TODO: Llave compuesta con el id pregunta
		$input = $request->all();	   	
    	$CodigoCurso="".$input["CodigoCurso"];
    	$IdEvaluacion="".addslashes($input["IdEvaluacion"]);
    	$NombreRespuesta="".addslashes($input["NombreRespuesta"]);
		$IdRespuesta="".addslashes($input["IdRespuesta"]);
		$IdPregunta="".addslashes($input["IdPregunta"]);
		
    	$token_curso_post="".$input["token_curso"];

    	$controller = new AdminController();
    	$arra_data=$controller->VerificarSesid();
		if(count($arra_data)==0){			
			return response()->json(["status"=>'error',"mensaje"=>"Se ha perdido la sesión"]);
		}else{

			$key="".$arra_data[0]->SesidUsuario."@".$CodigoCurso;				
			$token_curso="".md5($key);

			if($token_curso_post!=$token_curso){
				return response()->json(["status"=>'error',"mensaje"=>"Token Defectuoso"]);
			}

			DB::beginTransaction();

			if($IdRespuesta){

				$sql="UPDATE tbl_respuesta SET  NombreRespuesta='{$NombreRespuesta}' WHERE IdRespuesta={$IdRespuesta} AND IdPregunta={$IdPregunta}";				
				$result=DB::update($sql);

			}else{
				$sql="INSERT INTO tbl_respuesta SET  NombreRespuesta='{$NombreRespuesta}', IdEstado=1, IdPregunta={$IdPregunta}";
				$result=DB::insert($sql);
			}
			//DB::rollBack();

			DB::commit();

			return response()->json(["status"=>'ok',"mensaje"=>"Datos de respuesta registrados correctamente"]);
		}
	}

	
	public function cambiarestadoevaluacion(Request $request){

		//TODO: Llave compuesta con el id pregunta

    	$input = $request->all();	   	
    	$CodigoCurso="".$input["CodigoCurso"];    	
    	$token_curso_post="".$input["token_curso"];

		$id_item="".$input["id_item"];
		$id_tipo="".$input["id_tipo"];
		$id_estado="".$input["id_estado"];
		$id_pregunta="".$input["id_pregunta"];
		$es_verdadero="".$input["es_verdadero"];

    	$controller = new AdminController();
    	$arra_data=$controller->VerificarSesid();
		if(count($arra_data)==0){			
			return response()->json(["status"=>'error',"mensaje"=>"Se ha perdido la sesión"]);
		}else{

			$key="".$arra_data[0]->SesidUsuario."@".$CodigoCurso;
			$token_curso="".md5($key);

			if($token_curso_post!=$token_curso){
				return response()->json(["status"=>'error',"mensaje"=>"Token Defectuoso"]);
			}

			DB::beginTransaction();

			if($id_tipo=="1"){
				$sql="UPDATE tbl_pregunta SET IdEstado={$id_estado} where IdPregunta={$id_item}";
				$result=DB::update($sql);
			}elseif($id_tipo=="2"){
				$sql="UPDATE tbl_respuesta SET IdEstado={$id_estado} where IdPregunta={$id_pregunta} and IdRespuesta={$id_item}";
				$result=DB::update($sql);
			}elseif($id_tipo=="3"){

				$sql="UPDATE tbl_respuesta SET EsVerdadero=0 where IdPregunta={$id_pregunta}";
				$result=DB::update($sql);

				$sql="UPDATE tbl_respuesta SET EsVerdadero={$es_verdadero} where IdPregunta={$id_pregunta} and IdRespuesta={$id_item}";
				$result=DB::update($sql);				
			}
				

			//DB::rollBack();

			DB::commit();

			return response()->json(["status"=>'ok',"mensaje"=>"Se ha generado el cambio correctamente."]);
		}


    }



    public function cambiarestadorev(Request $request){
    	$input = $request->all();	   	
    	$CodigoCurso="".$input["CodigoCurso"];    	
    	$token_curso_post="".$input["token_curso"];

    	$controller = new AdminController();
    	$arra_data=$controller->VerificarSesid();
		if(count($arra_data)==0){			
			return response()->json(["status"=>'error',"mensaje"=>"Se ha perdido la sesión"]);
		}else{

			$key="".$arra_data[0]->SesidUsuario."@".$CodigoCurso;
			$token_curso="".md5($key);

			if($token_curso_post!=$token_curso){
				return response()->json(["status"=>'error',"mensaje"=>"Token Defectuoso"]);
			}

			DB::beginTransaction();

			$sql="UPDATE tbl_curso SET IdEstado=4 WHERE CodigoCurso='{$CodigoCurso}'";
			$result=DB::update($sql);

			//DB::rollBack();

			DB::commit();

			return response()->json(["status"=>'ok',"mensaje"=>"Se ha registrado el curso correctamente"]);
		}


    }


    public function eliminarcurso(Request $request){
    	$input = $request->all();	   	
    	$CodigoCurso="".$input["CodigoCurso"];    	
    	//$token_curso_post="".$input["token_curso"];

    	$controller = new AdminController();
    	$arra_data=$controller->VerificarSesid();
		if(count($arra_data)==0){			
			return response()->json(["status"=>'error',"mensaje"=>"Se ha perdido la sesión"]);
		}else{
		

			DB::beginTransaction();

			$sql="UPDATE tbl_curso SET  IdEstado=2	WHERE CodigoCurso='{$CodigoCurso}'";
			$result=DB::update($sql);

			//DB::rollBack();

			DB::commit();

			return response()->json(["status"=>'ok',"mensaje"=>"Se ha registrado el curso correctamente"]);
		}


    }

    


    


    public function editarimagenescurso(Request $request){
    	$input = $request->all();	   	
    	$CodigoCurso="".$input["CodigoCurso"];    	    	
    	$token_curso_post="".$input["token_curso"];

		$VideoCurso="".$input["VideoCurso"];
		$TipoVideo="".$input["TipoVideo"];


    	
		$fileName = date("YmdHms");		
		$destinationPathlogo = "assets/images/cursos/";
		$controltamanioimagen = 0.3*1024*1024;		

		$destinationPathVideo = "assets/videos/cursos/";
		$controltamaniovideo = 2*1024*1024*1024;
		

    	$controller = new AdminController();
    	$arra_data=$controller->VerificarSesid();
		if(count($arra_data)==0){			
			return response()->json(["status"=>'error',"mensaje"=>"Se ha perdido la sesión"]);
		}else{

			$key="".$arra_data[0]->SesidUsuario."@".$CodigoCurso;				
			$token_curso="".md5($key);
			if($token_curso_post!=$token_curso){
				return response()->json(["status"=>'error',"mensaje"=>"Token Defectuoso"]);
			}

			//SUBIR 
			$ImagenCurso=$request->file('ImagenCurso');
			$NombreImagenCurso="";
			$CampoImagenes="";
			if($ImagenCurso){	
				$propiedadesImagen= array(
					"size"=>$controltamanioimagen,
					"filename"=>$fileName,
					"path"=>$destinationPathlogo,
					"prefijo"=>"curso"
				);
				$ArraImagenCurso = $controller->UploadImage($ImagenCurso,$propiedadesImagen);
				if($ArraImagenCurso["status"]!="ok"){
					return response()->json(["status"=>'error',"mensaje"=>$ArraImagenCurso["mensaje"]]);
				}
				$NombreImagenCurso="".$ArraImagenCurso["nombre"];
				$CampoImagenes=",ImagenCurso='{$NombreImagenCurso}'";
			}
			//$SlideCurso=$file["SlideCurso"];

			//SUBIR SLIDE
			$SlideCurso=$request->file('SlideCurso');
			$NombreSlideCurso="";			
			if($SlideCurso){	
				$propiedadesImagen= array(
					"size"=>$controltamanioimagen,
					"filename"=>$fileName,
					"path"=>$destinationPathlogo,
					"prefijo"=>"slide"
				);
				$ArraSlideCurso = $controller->UploadImage($SlideCurso,$propiedadesImagen);
				if($ArraSlideCurso["status"]!="ok"){
					return response()->json(["status"=>'error',"mensaje"=>$ArraSlideCurso["mensaje"]]);
				}
				$NombreSlideCurso="".$ArraSlideCurso["nombre"];
				$CampoImagenes.=",SlideCurso='{$NombreSlideCurso}'";
			}
			//$SlideCurso=$file["SlideCurso"];

			//SUBIR VIDEO PORTADA
			$SubirVideoFile=$request->file('SubirVideoFile');
			$NombreVideoCurso="";			
			if($SubirVideoFile){	
				$propiedadesVideo= array(
					"size"=>$controltamaniovideo,
					"filename"=>$fileName,
					"path"=>$destinationPathVideo,
					"prefijo"=>"video"
				);
				$ArraVideoCurso = $controller->UploadVideo($SubirVideoFile,$propiedadesVideo);
				if($ArraVideoCurso["status"]!="ok"){
					return response()->json(["status"=>'error',"mensaje"=>$ArraSlideCurso["mensaje"]]);
				}
				$NombreVideoCurso="".$ArraVideoCurso["nombre"];
				
			}

			if($NombreVideoCurso!=""){
				$VideoCurso="assets/videos/cursos/".$NombreVideoCurso;

				$sql="SELECT * FROM tbl_curso WHERE CodigoCurso='{$CodigoCurso}'";
				$result_bd=DB::select($sql);
				if(count($result_bd)>0){
					\File::delete($result_bd[0]->VideoCurso);
				}
			}

			//$SlideCurso=$file["SlideCurso"];


			



			DB::beginTransaction();

			$estado_vimeo="";

			if($TipoVideo!="3"){
				$estado_vimeo="EstadoVimeo='',";
			}else{
				$estado_vimeo="EstadoVimeo='1',";
			}

			$sql="UPDATE tbl_curso SET {$estado_vimeo} TipoVideo='{$TipoVideo}',VideoCurso='{$VideoCurso}' {$CampoImagenes}
				  WHERE CodigoCurso='{$CodigoCurso}'";
			$result=DB::update($sql);



			//DB::rollBack();

			DB::commit();

			return response()->json(["status"=>'ok',"mensaje"=>"Se ha registrado el curso correctamente"]);
		}


    }


    

    //GENERAR CODIGO CURSO

    public function get_codigo_curso(){
		$sesid="";
		$characters = '0123456789abcdefghijklmnopqrstuvwxyz';
	    $charactersLength = strlen($characters);
	    $randomString = '';
	    for ($i = 0; $i < 8; $i++) {
	        $randomString .= $characters[rand(0, $charactersLength - 1)];
	    }
	    return $randomString;		
	}

	public function get_codigo_enlace_afiliados($cant_caracteres){
		$sesid="";
		$characters = '0123456789abcdefghijklmnopqrstuvwxyz';
	    $charactersLength = strlen($characters);
	    $randomString = '';
	    for ($i = 0; $i < $cant_caracteres; $i++) {
	        $randomString .= $characters[rand(0, $charactersLength - 1)];
	    }
	    return $randomString;		
	}


	//tipo idioma

	public function get_tipo_tema(){
		$sql="SELECT * FROM tbl_tipo_tema where IdEstado=1";
    	$result=DB::select($sql);
    	return $result;	
	}

	//GESTIÓN MODULOS

	public function editarmoduloslecciones(Request $request){
    	$input = $request->all();	   	
    	$CodigoCurso="".$input["CodigoCurso"];    	    	
    	$token_curso_post="".$input["token_curso"];
		$CodigoItem="";

    	$controller = new AdminController();
    	$arra_data=$controller->VerificarSesid();
		if(count($arra_data)==0){			
			return response()->json(["status"=>'error',"mensaje"=>"Se ha perdido la sesión"]);
		}else{

			$key="".$arra_data[0]->SesidUsuario."@".$CodigoCurso;				
			$token_curso="".md5($key);
			if($token_curso_post!=$token_curso){
				return response()->json(["status"=>'error',"mensaje"=>"Token Defectuoso"]);
			}

			/**/
			$IdTem="".$input["IdTem"];
			$NombreItem="".addslashes($input["NombreItem"]);
			$DescripcionCortaItem="".addslashes($input["DescripcionCortaItem"]);
			$GratisItem="".$input["GratisItem"];
			$HorasItem="".$input["HorasItem"];
			$MinutosItem="".$input["MinutosItem"];
			$SegundosItem="".$input["SegundosItem"];
			$ProcesoItem="".$input["ProcesoItem"];
			$IdEstado="".$input["IdEstado"];
			$IdModulo="".$input["IdPadre"];
			$FechaLanzamiento="".$input["FechaLanzamiento"];

			$cadena_fecha="";
			if($FechaLanzamiento){
				$cadena_fecha="FechaLanzamiento='{$FechaLanzamiento}',";
			}else{
				$cadena_fecha="FechaLanzamiento=null,";
			}

			$DuracionTema=$controller->get_segundos($HorasItem, $MinutosItem, $SegundosItem);
      		
      		DB::beginTransaction();

			if($ProcesoItem=='modulo'){

				$camposSet="NombreModulo='{$NombreItem}', 
					DescripcionModulo='{$DescripcionCortaItem}',
					IdIdioma=1, 
					DuracionModulo='{$DuracionTema}',
					GratisModulo='{$GratisItem}',
					IdEstado='{$IdEstado}',
					{$cadena_fecha}
					IdCurso=(SELECT IdCurso from tbl_curso WHERE CodigoCurso='{$CodigoCurso}')";

				if($IdTem==""){

					$sql="SELECT m.OrdenModulo 
						FROM tbl_modulo m
						WHERE m.IdCurso=(SELECT IdCurso from tbl_curso WHERE CodigoCurso='{$CodigoCurso}')
						AND m.IdEstado in (1,3)
						ORDER BY m.OrdenModulo DESC LIMIT 1
						";
					$result=DB::select($sql);

					$orden_item=0;

					for($i=0;$i<count($result);$i++){
						$orden_item=$result[$i]->OrdenModulo+1;
					}


					$sql="INSERT INTO tbl_modulo SET OrdenModulo={$orden_item},{$camposSet}";
					$result=DB::insert($sql);
					$IdTem = DB::getPDO()->lastInsertId();

				}else{

					$sql="UPDATE tbl_modulo SET {$camposSet} 
							WHERE IdModulo={$IdTem} and  
							IdCurso=(SELECT IdCurso from tbl_curso WHERE CodigoCurso='{$CodigoCurso}')";
					$result=DB::update($sql);

				}
			}


			//GESTION DE LECCIONES
			if($ProcesoItem=='leccion'){

				$camposSet="NombreTema='{$NombreItem}', 
					DescripcionTema='{$DescripcionCortaItem}',
					IdIdioma=1, 
					DuracionTema='{$DuracionTema}',
					GratisTema='{$GratisItem}',
					IdEstado='{$IdEstado}',
					{$cadena_fecha}
					IdModulo={$IdModulo}";

				if($IdTem==""){

					$sql="SELECT m.OrdenTema
						FROM tbl_tema m
						WHERE m.IdModulo={$IdModulo}
						AND m.IdEstado in (1,3)
						ORDER BY m.OrdenTema DESC LIMIT 1
						";
					$result=DB::select($sql);

					$orden_item=0;

					for($i=0;$i<count($result);$i++){
						$orden_item=$result[$i]->OrdenTema+1;
					}


					$CodigoItem=$this->get_codigo_curso();				


					$sql="INSERT INTO tbl_tema SET CodigoTema='{$CodigoItem}', OrdenTema={$orden_item},{$camposSet}";
					$result=DB::insert($sql);
					$IdTem = DB::getPDO()->lastInsertId();


				}else{

					$sql="UPDATE tbl_tema SET {$camposSet} 
							WHERE IdTema={$IdTem} and  
							IdModulo={$IdModulo}";
					$result=DB::update($sql);

				}
			}

      		DB::commit();
      		return response()->json(["status"=>'ok',"mensaje"=>"El proceso fue generado correctamente", "IdItem"=>$IdTem,"CodigoItem"=>$CodigoItem]);
		}
    }


    public function editarlecciones(Request $request){
    	$input = $request->all();	   	
    	$CodigoCurso="".$input["CodigoCurso"];    	    	
		$token_curso_post="".$input["token_curso"];
		
		$fileName = date("YmdHms");
		$destinationPathVideo = "assets/videos/cursos/";
		$controltamaniovideo = 2*1024*1024*1024;



    	$controller = new AdminController();
    	$arra_data=$controller->VerificarSesid();
		if(count($arra_data)==0){			
			return response()->json(["status"=>'error',"mensaje"=>"Se ha perdido la sesión"]);
		}else{

			$key="".$arra_data[0]->SesidUsuario."@".$CodigoCurso;				
			$token_curso="".md5($key);
			if($token_curso_post!=$token_curso){
				return response()->json(["status"=>'error',"mensaje"=>"Token Defectuoso"]);
			}

			$IdTema="".$input["IdTema"];    	    	
			$IdModulo="".$input["IdModulo"];    	    	      		
      		$NombreTema="".$input["NombreTema"];
      		$DescripcionTema="".$input["DescripcionTema"];
      		$DuracionTema="".$input["DuracionTema"];
      		$GratisTema="".$input["GratisTema"];
      		$DescripcionlargaTema="".$input["DescripcionlargaTema"];
			$IdTipoTema="".$input["IdTipoTema"];
			$HabilidadesTema="".$input["HabilidadesTema"]; 
			$TipoVideo="".$input["TipoVideo"];
      		$IdMedia="".$input["IdMedia"];
			$IdEstado="".$input["IdEstado"];

			//SUBIR VIDEO PORTADA
			$SubirVideoFile=$request->file('SubirVideoFile');
			$NombreVideoLeccion="";			
			if($SubirVideoFile){	
				$propiedadesVideo= array(
					"size"=>$controltamaniovideo,
					"filename"=>$fileName,
					"path"=>$destinationPathVideo,
					"prefijo"=>"lec"
				);
				$ArraVideoCurso = $controller->UploadVideo($SubirVideoFile,$propiedadesVideo);
				if($ArraVideoCurso["status"]!="ok"){
					return response()->json(["status"=>'error',"mensaje"=>$ArraSlideCurso["mensaje"]]);
				}
				$NombreVideoLeccion="".$ArraVideoCurso["nombre"];
				$DuracionTema="".$ArraVideoCurso["duracion"];
				
			}
			//$SlideCurso=$file["SlideCurso"];
			$URLMediaEmbed="".$input["URLMediaEmbed"];
			//$URLMediaEmbed="https://vimeo.com/462303957";
			if($TipoVideo=="1"){
				$URLMediaEmbed="";
			}
			if($NombreVideoLeccion!=""){
				$URLMediaEmbed="assets/videos/cursos/".$NombreVideoLeccion;	
			}

      		
      		DB::beginTransaction();
      		$camposSet="IdModulo='{$IdModulo}',
      					NombreTema='{$NombreTema}',
      					DescripcionTema='{$DescripcionTema}',
      					DuracionTema='{$DuracionTema}',
      					GratisTema='{$GratisTema}',
      					DescripcionlargaTema='{$DescripcionlargaTema}',
      					
      					IdTipoTema='{$IdTipoTema}',
      					IdEstado='{$IdEstado}'";
      		if($IdTema==""){

				$sql="SELECT MAX(OrdenTema) AS OrdenTema FROM tbl_tema WHERE IdModulo={$IdModulo} and IdEstado=1";
				$result_bd=DB::select($sql);
				$orden_tema=0;
				if(count($result_bd)>0){
					$orden_tema=$result_bd[0]->OrdenTema+1;
				}

      			$CodigoTema=$this->get_codigo_curso();

      			$sql="INSERT INTO tbl_tema SET {$camposSet}, CodigoTema='{$CodigoTema}',OrdenTema='{$orden_tema}'";
      			$result=DB::insert($sql);

      			$IdTema = DB::getPDO()->lastInsertId();
				
      		}else{
      			$sql="UPDATE tbl_tema SET {$camposSet} WHERE IdModulo={$IdModulo} and IdTema={$IdTema}";
      			$result=DB::update($sql);
      		}

      		if($URLMediaEmbed!="" && $IdTipoTema!="2"){

				

	      		if($IdMedia==""){
	      			$sql="INSERT INTO tbl_media SET TipoMedia=1, NombreMedia='TEMA', URLMedia='{$URLMediaEmbed}', IdEstado=1, IdTema={$IdTema}, TipoVideo={$TipoVideo}";
	      			$result=DB::insert($sql);
	      		}else{

					$sql="SELECT * FROM tbl_media WHERE  IdMedia={$IdMedia}";
					$result_bd=DB::select($sql);
					if(count($result_bd)>0){
						\File::delete($result_bd[0]->URLMedia);
						
					}


	      			$sql="UPDATE tbl_media SET  TipoMedia=1, NombreMedia='TEMA', URLMedia='{$URLMediaEmbed}', IdEstado=1 , TipoVideo={$TipoVideo}
	      				  WHERE  IdMedia={$IdMedia}";
	      			$result=DB::update($sql);
	      		}
			}

			$sql="DELETE FROM  tbl_habilidad_tema WHERE  IdTema={$IdTema}";
	      	$result=DB::update($sql);
			
			if($HabilidadesTema!=""){
				$habildades=explode(",",$HabilidadesTema);
				for($i=0;$i<count($habildades);$i++){

					$sql="INSERT INTO tbl_habilidad_tema SET IdTema ='{$IdTema}', IdHabilidad='{$habildades[$i]}', IdEstado=1, PuntoHabilidad=1";
	      			$result=DB::insert($sql);

				}
			}


      		//

      		DB::commit();
      		return response()->json(["status"=>'ok',"mensaje"=>"El proceso fue generado correctamente"]);



		}
	}

	//GESTION DE ARCHIVOS

	public function editararchivos(Request $request){
    	$input = $request->all();	   	
    	$CodigoCurso="".$input["CodigoCurso"];    	    	
    	$token_curso_post="".$input["token_curso"];

    	$NombreMedia="".$input["NombreMedia"];
    	$CodigoLeccion="".$input["CodigoLeccion"];

    	
      //formData.append('URLMedia', $('#URLMedia')[0].files[0]);
      
		$controller = new AdminController();
    	$arra_data=$controller->VerificarSesid();

    	$controltamanioimagen = 10*1024*1024;		
		$fileName = $controller->createSlug($NombreMedia)."".$fileName = date("YmdHms");
		$destinationPath = "documentos/".$CodigoCurso."/";
		

    	
		if(count($arra_data)==0){			
			return response()->json(["status"=>'error',"mensaje"=>"Se ha perdido la sesión"]);
		}else{

			$key="".$arra_data[0]->SesidUsuario."@".$CodigoCurso;				
			$token_curso="".md5($key);
			if($token_curso_post!=$token_curso){
				return response()->json(["status"=>'error',"mensaje"=>"Token Defectuoso"]);
			}

			//SUBIR 
			$URLMedia=$request->file('URLMedia');
			$URLMediaArchivo="";
			$CampoImagenes="";
			
			$propiedadesImagen= array(
				"size"=>$controltamanioimagen,
				"filename"=>$fileName,
				"path"=>$destinationPath,
				"prefijo"=>"".$CodigoLeccion,
			);
			$ArraImagenCurso = $controller->UploadImage($URLMedia,$propiedadesImagen);
			if($ArraImagenCurso["status"]!="ok"){
				return response()->json(["status"=>'error',"mensaje"=>$ArraImagenCurso["mensaje"]]);
			}
			$URLMediaArchivo="".$ArraImagenCurso["nombre"];			
			
			//$SlideCurso=$file["SlideCurso"];

			
			DB::beginTransaction();

			$sql="INSERT INTO tbl_media SET TipoMedia=2,NombreMedia='{$NombreMedia}',URLMedia='{$URLMediaArchivo}',
				  IdEstado=1,IdTema=(select IdTema from tbl_tema where CodigoTema='{$CodigoLeccion}')";
			$result=DB::insert($sql);



			//DB::rollBack();

			DB::commit();

			return response()->json(["status"=>'ok',"mensaje"=>"Se ha registrado el archivo correctamente"]);
		}

	}


	public function eliminararchivo(Request $request){
    	$input = $request->all();	   	
    	$IdMedia="".$input["IdMedia"];    	
    	//$token_curso_post="".$input["token_curso"];

    	$controller = new AdminController();
    	$arra_data=$controller->VerificarSesid();
		if(count($arra_data)==0){			
			return response()->json(["status"=>'error',"mensaje"=>"Se ha perdido la sesión"]);
		}else{
		

			DB::beginTransaction();


			$sql="SELECT * FROM tbl_media WHERE  IdTema={$IdTema}";
			$result_bd=DB::select($sql);
			if(count($result_bd)>0){
				\File::delete($result_bd[0]->URLMedia);
			}

			$sql="UPDATE tbl_media SET  IdEstado=2	WHERE IdMedia='{$IdMedia}'";
			$result=DB::update($sql);

			

			//DB::rollBack();

			DB::commit();

			return response()->json(["status"=>'ok',"mensaje"=>"El archivo se ha eliminado correctamente."]);
		}


    }


    public function get_continuar_curso($IdCurso,$IdPersonaUsuario){
    	$sql="	SELECT t.*
				FROM tbl_avance_tema_usuario atu				
				INNER JOIN tbl_tema t ON t.IdTema=atu.IdTema and t.IdEstado=1
				INNER JOIN tbl_modulo m ON m.IdModulo=t.IdModulo				
				WHERE  atu.TipoAvance=2 AND m.IdCurso={$IdCurso} and atu.IdUsuarioPersona={$IdPersonaUsuario}
				ORDER BY atu.FechaCreacion DESC";

		$result=DB::select($sql);
		return $result;
	}
	

	
	public function editarordenlecciones(Request $request){
    	$input = $request->all();	   	
    	$CodigoCurso="".$input["CodigoCurso"];    	    	
    	$token_curso_post="".$input["token_curso"];
    	$controller = new AdminController();
    	$arra_data=$controller->VerificarSesid();
		if(count($arra_data)==0){			
			return response()->json(["status"=>'error',"mensaje"=>"Se ha perdido la sesión"]);
		}else{

			$key="".$arra_data[0]->SesidUsuario."@".$CodigoCurso;				
			$token_curso="".md5($key);
			if($token_curso_post!=$token_curso){
				return response()->json(["status"=>'error',"mensaje"=>"Token Defectuoso"]);
			}

			$IdModulo="".$input["IdModulo"];    	    	
			$OrdenTemas="".$input["OrdenTemas"];    	    	      		
			DB::beginTransaction();
			
			$arra_orden_temas=explode(",",$OrdenTemas);

			for($i=0;$i<count($arra_orden_temas);$i++){
				$sql="UPDATE tbl_tema SET OrdenTema='{$i}' where IdTema={$arra_orden_temas[$i]} and IdModulo={$IdModulo}";
				$result=DB::update($sql);
			}
      		//
      		DB::commit();
      		return response()->json(["status"=>'ok',"mensaje"=>"El proceso fue generado correctamente"]);
		}		
	}

	public function editarordenmodulos(Request $request){
    	$input = $request->all();	   	
    	$CodigoCurso="".$input["CodigoCurso"];    	    	
    	$token_curso_post="".$input["token_curso"];
    	$controller = new AdminController();
    	$arra_data=$controller->VerificarSesid();
		if(count($arra_data)==0){			
			return response()->json(["status"=>'error',"mensaje"=>"Se ha perdido la sesión"]);
		}else{

			$key="".$arra_data[0]->SesidUsuario."@".$CodigoCurso;				
			$token_curso="".md5($key);
			if($token_curso_post!=$token_curso){
				return response()->json(["status"=>'error',"mensaje"=>"Token Defectuoso"]);
			}

			$IdCurso="".$input["IdCurso"];    	    	
			$OrdenModulos="".$input["OrdenModulos"];    	    	      		
			DB::beginTransaction();
			
			$arra_orden_modulos=explode(",",$OrdenModulos);

			for($i=0;$i<count($arra_orden_modulos);$i++){
				$sql="UPDATE tbl_modulo SET OrdenModulo='{$i}' where IdModulo={$arra_orden_modulos[$i]} and IdCurso={$IdCurso}";
				$result=DB::update($sql);
			}
      		//
      		DB::commit();
      		return response()->json(["status"=>'ok',"mensaje"=>"El proceso fue generado correctamente"]);
		}		
	}


	
	public function editarordenmedia(Request $request){
    	$input = $request->all();	   	
    	$CodigoCurso="".$input["CodigoCurso"];    	    	
    	$token_curso_post="".$input["token_curso"];
    	$controller = new AdminController();
    	$arra_data=$controller->VerificarSesid();
		if(count($arra_data)==0){			
			return response()->json(["status"=>'error',"mensaje"=>"Se ha perdido la sesión"]);
		}else{

			$key="".$arra_data[0]->SesidUsuario."@".$CodigoCurso;				
			$token_curso="".md5($key);
			if($token_curso_post!=$token_curso){
				return response()->json(["status"=>'error',"mensaje"=>"Token Defectuoso"]);
			}

			$IdItem="".$input["IdItem"];    	    	
			$OrdenMedia="".$input["OrdenMedia"];
			$TablaItem="".$input["TablaItem"];

			DB::beginTransaction();
			
			$arra_orden_temas=explode(",",$OrdenMedia);

			for($i=0;$i<count($arra_orden_temas);$i++){

				$sql="UPDATE tbl_media SET IdOrden='{$i}' where IdMedia={$arra_orden_temas[$i]} and {$TablaItem}={$IdItem}";				
				$result=DB::update($sql);
			}
      		//
      		DB::commit();
      		return response()->json(["status"=>'ok',"mensaje"=>"El proceso fue generado correctamente"]);
		}		
	}

	


    public function setcalificacion(Request $request){
    	$input = $request->all();	   	
    	$IdCurso="".$input["IdCurso"];    	
    	$ObservacionCalificacion="".addslashes($input["ObservacionCalificacion"]);
    	$ValorCalificacion="".$input["ValorCalificacion"];    	
    	
    	

    	$controller = new AdminController();
    	$arra_data=$controller->VerificarSesid();
		if(count($arra_data)==0){			
			return response()->json(["status"=>'error',"mensaje"=>"Se ha perdido la sesión"]);
		}else{
		

			DB::beginTransaction();

			$IdPersonaUsuario=$arra_data[0]->IdUsuarioPersona;

			$sql="SELECT * FROM tbl_calificacion_curso_persona WHERE IdEstado=1 and IdPersonaUsuario={$IdPersonaUsuario} and IdCurso='{$IdCurso}'";
			$result_comentario=DB::select($sql);

			if(count($result_comentario)==0){
				$sql="INSERT INTO tbl_calificacion_curso_persona SET IdEstado=1, ValorCalificacion={$ValorCalificacion}, 
					  ObservacionCalificacion='{$ObservacionCalificacion}', 
					  IdPersonaUsuario={$IdPersonaUsuario}, 
					  IdCurso='{$IdCurso}'";
				$result=DB::insert($sql);
			}else{
				$sql="UPDATE tbl_calificacion_curso_persona SET ValorCalificacion={$ValorCalificacion}, 
					  ObservacionCalificacion='{$ObservacionCalificacion}'
					  WHERE IdPersonaUsuario={$IdPersonaUsuario} AND IdEstado=1 AND 
					  IdCurso='{$IdCurso}'";
				$result=DB::update($sql);
			}

			

			//DB::rollBack();

			DB::commit();

			return response()->json(["status"=>'ok',"mensaje"=>"Gracias por tu valoración."]);
		}


	}
	

	public function enviar_solicitud_producto(Request $request){
    	$input = $request->all();	   	
		$codigo_curso="".$input["codigo_curso"];    	
		$TextoSolicitudAfiliacion="".$input["TextoSolicitudAfiliacion"];

		$sql="SELECT c.*, u.NombreUsuario, p.EmailPersona
				FROM tbl_curso c
				INNER JOIN tbl_usuario u ON u.IdUsuario=c.IdUsuarioTutor
				INNER JOIN tbl_usuario_persona up ON up.IdUsuario=u.IdUsuario
				INNER JOIN tbl_persona p ON p.IdPersona=up.IdPersona
			  WHERE c.CodigoCurso='{$codigo_curso}' and c.IdEstado=1";
		$result=DB::select($sql);

		if(count($result)==0){
			return response()->json(["status"=>'error',"mensaje"=>"El curso no existe"]);
		}

		$controller = new AdminController();
    	$arra_data=$controller->VerificarSesid();
		if(count($arra_data)==0){			
			return response()->json(["status"=>'error',"mensaje"=>"Se ha perdido la sesión"]);
		}else{

			$idusuariopersona=$arra_data[0]->IdUsuarioPersona;
			$nombreusuariopersona=$arra_data[0]->NombreUsuario;

			$id_curso=$result[0]->IdCurso;
			$AprobacionAutomatica=$result[0]->AprobacionAutomatica;
			$titulo_curso=$result[0]->NombreCurso;
			$IdUsuarioTutor=$result[0]->IdUsuarioTutor;
			$EmailTutor=$result[0]->EmailPersona;



			$sql="SELECT * FROM tbl_solicitud_afiliacion where IdCurso={$id_curso} and IdUsuarioPersona={$idusuariopersona}";
			$result_solicitud=DB::select($sql);

			

			if(count($result_solicitud)>0){
				return response()->json(["status"=>'error',"mensaje"=>"Ya existe una solicitud enviada para este producto."]);
			}	
			
			$EstadoSolicitudAfiliacion="2";
			/*
			1  aprobado
			2  pendiente
			3  rechazado
			*/
			$mensaje_solicitud="Tu solicitud ha sido enviada al tutor para su aprobación.";			
			if($AprobacionAutomatica=="1"){
				$EstadoSolicitudAfiliacion="1";
				$mensaje_solicitud="Ya puedes empezar a promocionar este producto";
			}


			$CodigoEnlace=$this->get_codigo_enlace_afiliados(16);
			$insert_solicitud="INSERT INTO tbl_solicitud_afiliacion set IdUsuarioPersona='{$idusuariopersona}', 
							   CodigoSolicitudAfiliacion='{$CodigoEnlace}', 
							   EstadoSolicitudAfiliacion='{$EstadoSolicitudAfiliacion}', 
							   IdCurso='{$id_curso}', 
							   TextoSolicitudAfiliacion='{$TextoSolicitudAfiliacion}' ";
			$result=DB::insert($insert_solicitud);


			//set_notificaciones($TituloNoticia,$TipoNoticia,$DescripcionNoticia,$IconoNoticia,$URLNoticia,$IdUsuario,$IdEstado,$email_usuario,$mensaje_usuario)

			$TituloNoticia="";
			$DescripcionNoticia="";
			if($EstadoSolicitudAfiliacion=="1"){
				$TituloNoticia="Tienes un afiliado ofreciendo tu curso {$titulo_curso} ";
				$DescripcionNoticia="El Usuario {$nombreusuariopersona}, ofrecerá el curso {$titulo_curso}.";
			}
			if($EstadoSolicitudAfiliacion=="2"){
				$TituloNoticia="Hay un afiliado que quiere ofrecer tu curso {$titulo_curso} ";
				$DescripcionNoticia="El usuario {$nombreusuariopersona} necesita de tu aprobación para poder ofrecer tu curso.";
			}

			$TipoNoticia="1";
			$IconoNoticia="bell.png";
			$URLNoticia=url('')."/solicitudes";
			$IdUsuario=$IdUsuarioTutor;
			$IdEstado="1";
			$email_usuario=$EmailTutor;
			$mensaje_usuario="".$DescripcionNoticia;
			$controller->set_notificaciones($TituloNoticia,$TipoNoticia,$DescripcionNoticia,$IconoNoticia,$URLNoticia,$IdUsuario,$IdEstado,$email_usuario,$mensaje_usuario);

			return response()->json(["status"=>'ok',"mensaje"=>"".$mensaje_solicitud]);



			/*
				IdUsuarioPersona
				CodigoSolicitudAfiliacion
				EstadoSolicitudAfiliacion
				IdCurso
				TextoSolicitudAfiliacion
			*/

		}
		
	}

	public function verificar_solicitud_producto(Request $request){
		$input = $request->all();	   	
		$codigo_curso="".$input["codigo_curso"];    			

		$sql="SELECT * 
		      FROM tbl_curso 
			  WHERE CodigoCurso='{$codigo_curso}' and IdEstado=1";
		$result=DB::select($sql);

		if(count($result)==0){
			return response()->json(["status"=>'error',"mensaje"=>"El curso no existe"]);
		}

		$controller = new AdminController();
    	$arra_data=$controller->VerificarSesid();
		if(count($arra_data)==0){			
			return response()->json(["status"=>'error',"mensaje"=>"Se ha perdido la sesión"]);
		}else{

			$idusuariopersona=$arra_data[0]->IdUsuarioPersona;

			$id_curso=$result[0]->IdCurso;
			$slug_curso=$result[0]->SlugCurso;
			
			$sql="SELECT * FROM tbl_solicitud_afiliacion where IdCurso={$id_curso} and IdUsuarioPersona={$idusuariopersona}";
			$result_solicitud=DB::select($sql);
			$enlace_afiliacion="";
			$enlace_checkout="";
			$EstadoSolicitudAfiliacion="";
			$URLMaterialPromocional="";
			if(count($result_solicitud)>0){
				$EstadoSolicitudAfiliacion=$result_solicitud[0]->EstadoSolicitudAfiliacion;				
				if($result_solicitud[0]->EstadoSolicitudAfiliacion=="1"){
					$URLMaterialPromocional="".$result[0]->URLMaterialPromocional;
					$enlace_afiliacion=url('')."/c/".$slug_curso."-".$codigo_curso."/".$result_solicitud[0]->CodigoSolicitudAfiliacion;	
					$enlace_checkout=url('')."/checkout/".$slug_curso."-".$codigo_curso."/".$result_solicitud[0]->CodigoSolicitudAfiliacion;					
				}else{
					$enlace_afiliacion="";
				}
			}

			return response()->json(["status"=>'ok',
									  "enlace"=>$enlace_afiliacion,
									  "enlace_checkout"=>$enlace_checkout,
									  "URLMaterialPromocional"=>$URLMaterialPromocional,
									  "EstadoSolicitudAfiliacion"=>$EstadoSolicitudAfiliacion
									]);

		}
	}

	public function iniciar_compra($IdCurso,$IdUsuarioPersona,$IdAfiliado,$PrecioCurso,$ComisionAfiliado,$ComisionTutor,$ComisionEmpresa,$IdTutor,$DiasGarantia,
								   $IdImpuesto, $ValorImpuesto, $AutoRenta, $ValorAutoRenta, $CostosAdicionales, $ValorCostosAdicionales,$Comision){

		$sql="SELECT * FROM tbl_usuario_curso where IdUsuarioPersona='{$IdUsuarioPersona}' and  IdCurso='{$IdCurso}' limit 1";		
		$result_bd=DB::select($sql);

		$cadena_transferencia=$IdCurso.date('dyHism').$IdUsuarioPersona;
		$codigoTransaccion=$this->get_codigo_enlace_afiliados(35);

		if(!$IdAfiliado){
			$IdAfiliado="null";
		}

		if(!$IdImpuesto){
			$IdImpuesto="null";
		}

		
		



		$campos_compra="IdUsuarioPersona={$IdUsuarioPersona}, 
						IdCurso='{$IdCurso}', 
						FechaCreacion=now(), 
						PrecioCurso='{$PrecioCurso}', 
						ComisionAfiliado='{$ComisionAfiliado}', 
						ComisionTutor='{$ComisionTutor}',
						ComisionEmpresa='{$ComisionEmpresa}',
						Comision='{$Comision}',

						IdImpuesto={$IdImpuesto},
						ValorImpuesto='{$ValorImpuesto}',
						AutoRenta='{$AutoRenta}',
						ValorAutoRenta='{$ValorAutoRenta}',
						CostosAdicionales='{$CostosAdicionales}',
						ValorCostosAdicionales='{$ValorCostosAdicionales}',


						IdTutor='{$IdTutor}',
						IdAfiliado={$IdAfiliado},
						EnCanje='1',
						DiasGarantia={$DiasGarantia}
						";
		if(count($result_bd)>0){
			$codigoTransaccion=$result_bd[0]->CodigoTransaccion;
			if($result_bd[0]->IdEstado=="3"){
				$sql="UPDATE tbl_usuario_curso SET FechaModificacion=now(), {$campos_compra} where IdUsuarioPersona='{$IdUsuarioPersona}' and  IdCurso='{$IdCurso}'  ";
				$result=DB::update($sql);
			}
		}else{

			$sql="SELECT * FROM tbl_config_empresa";
			$result_config=DB::select($sql);
			$PrefijoFacturacion="";
			$FacturaActual="";
			$TipoProcesador="";
			for($i=0;$i<count($result_config);$i++){
				$PrefijoFacturacion="".$result_config[$i]->PrefijoFacturacion;
				$FacturaActual=$result_config[$i]->FacturaActual+1;
				$TipoProcesador="".$result_config[$i]->TipoProcesador;
			}
			
			$codigo_factura="{$PrefijoFacturacion}-".sprintf('%08d', $FacturaActual);

			$sql="INSERT INTO tbl_usuario_curso SET IdEstado=3, TipoProcesador={$TipoProcesador},CodigoFactura='{$codigo_factura}', CodigoTransaccion='{$codigoTransaccion}', {$campos_compra}";			
			$result=DB::insert($sql);

			$sql="UPDATE tbl_config_empresa set FacturaActual=FacturaActual+1";			
    		$result=DB::update($sql);

		}		


		return $codigoTransaccion;
		
	}


	public function get_cursos_by_usuario(Request $request){
		$input = $request->all();	   	
		$IdUsuario="".$input["IdUsuario"];
		$cursos_disponibles=$this->get_cursos_persona(null,null,null,null,null,null,null,null,null,'1,2,3,4',null,null,$IdUsuario);


		return response()->json(["status"=>'ok',"cursos"=>$cursos_disponibles]);
	}

	public function asignar_curso(Request $request){
		$input = $request->all();	   	
		$IdUsuarioPersona="".$input["IdUsuarioPersona"];
		$IdCurso="".$input["IdCurso"];
		$IdTutor="".$input["IdTutor"];

		$sql="SELECT * FROM tbl_usuario_curso where IdUsuarioPersona={$IdUsuarioPersona} and IdCurso={$IdCurso}";
		$result=DB::select($sql);

		

		if(count($result)==0){					

			$sql="INSERT INTO tbl_usuario_curso set IdUsuarioPersona={$IdUsuarioPersona},
						 IdCurso={$IdCurso}, 
						 FechaCreacion=now(), 
						 IdEstado=1, 
						 CursoRegalo=1, 
						 IdTutor={$IdTutor}, 
						 EnCanje=0, DiasGarantia=0";
			$result=DB::insert($sql);
			return response()->json(["status"=>'ok',"mensaje"=>"Curso asignado correctamente"]);
		}else{

			if($result[0]->IdEstado=="1"){
				return response()->json(["status"=>'error',"mensaje"=>"Este curso ya había asignado"]);	
			}else{
				$sql="UPDATE tbl_usuario_curso set 						 
						 FechaCreacion=now(), 
						 IdEstado=1, 
						 CursoRegalo=1, 						 
						 EnCanje=0, DiasGarantia=0 WHERE IdCurso={$IdCurso} AND IdUsuarioPersona={$IdUsuarioPersona} ";
				$result=DB::update($sql);
				return response()->json(["status"=>'ok',"mensaje"=>"Curso asignado correctamente"]);
			}

			
		}

	}

	public function cambiarestadoitem(Request $request){
		$input = $request->all();	   			
		$id_item="".$input["id_item"];
		$id_tipo="".$input["id_tipo"];
		$id_estado="".$input["id_estado"];
		$id_modulo="".$input["id_modulo"];
		$CodigoCurso="".$input["CodigoCurso"];    	    	
    	$token_curso_post="".$input["token_curso"];

    	$controller = new AdminController();
    	$arra_data=$controller->VerificarSesid();

		if(count($arra_data)==0){			
			return response()->json(["status"=>'error',"mensaje"=>"Se ha perdido la sesión"]);
		}else{
			$key="".$arra_data[0]->SesidUsuario."@".$CodigoCurso;				
			$token_curso="".md5($key);
			if($token_curso_post!=$token_curso){
				return response()->json(["status"=>'error',"mensaje"=>"Token Defectuoso"]);
			}
			$tipo_item="";      		
      		DB::beginTransaction();
			if($id_tipo=="1"){
				$sql="UPDATE tbl_modulo SET IdEstado={$id_estado} WHERE IdModulo={$id_item} and  IdCurso=(SELECT IdCurso from tbl_curso WHERE CodigoCurso='{$CodigoCurso}')";
				$result=DB::update($sql);

				if($id_estado=="1"){
					$tipo_item="El módulo ha cambiado su estado a Publicado correctamente.";
				}else if($id_estado=="3"){
					$tipo_item="El módulo ha cambiado su estado a Borrador correctamente.";
				}else if($id_estado=="2"){
					$tipo_item="El módulo y sus lecciones se han eliminado correctamente.";

					$sql="	UPDATE tbl_tema SET IdEstado={$id_estado} WHERE IdModulo={$id_item}";	
					$result=DB::update($sql);

				}
				
			}else{
				
				$sql="	UPDATE tbl_tema SET IdEstado={$id_estado} WHERE IdModulo={$id_modulo} and IdTema={$id_item}";
				$result=DB::update($sql);
				
				if($id_estado=="1"){
					$tipo_item="La lección ha cambiado su estado a Publicado correctamente.";
				}else if($id_estado=="3"){
					$tipo_item="La lección ha cambiado su estado a Borrador correctamente.";
				}else if($id_estado=="2"){
					$tipo_item="La lección se ha eliminado correctamente.";
				}			
			}      		
      		
      		DB::commit();
      		return response()->json(["status"=>'ok',"mensaje"=>"{$tipo_item}"]);
		}


	}

	public function cambiarestadomedia(Request $request){
		$input = $request->all();	   			
		$id_item="".$input["id_item"];
		$id_tipo="".$input["id_tipo"];

		$CodigoCurso="".$input["CodigoCurso"];    	    	
    	$token_curso_post="".$input["token_curso"];
		$controller = new AdminController();
    	$arra_data=$controller->VerificarSesid();

		if(count($arra_data)==0){			
			return response()->json(["status"=>'error',"mensaje"=>"Se ha perdido la sesión"]);
		}else{
			$key="".$arra_data[0]->SesidUsuario."@".$CodigoCurso;				
			$token_curso="".md5($key);
			if($token_curso_post!=$token_curso){
				return response()->json(["status"=>'error',"mensaje"=>"Token Defectuoso"]);
			}
			$tipo_item="";      		
      		DB::beginTransaction();

			$sql="UPDATE tbl_media SET IdEstado=2 where IdMedia={$id_item} and TipoMedia={$id_tipo}";
			$result=DB::update($sql);

			$sql="SELECT * FROM tbl_media where  IdMedia={$id_item} and TipoMedia={$id_tipo}";
			$result_sel=DB::select($sql);

			for($i=0; $i<count($result_sel);$i++){
				if($result_sel[$i]->TipoMedia=="1" || $result_sel[$i]->TipoMedia=="2"  || $result_sel[$i]->TipoMedia=="4"   || $result_sel[$i]->TipoMedia=="5" ){
					if($result_sel[$i]->URLMedia){
						//\File::delete($result_sel[$i]->URLMedia);
					}
				}
			}
      		DB::commit();
      		return response()->json(["status"=>'ok',"mensaje"=>"{$tipo_item}"]);
		}


	}
	

	public function get_niveles(){
		$sql="SELECT * FROM tbl_nivelcurso";
		$result_bd=DB::select($sql);
		return $result_bd;
	}



	public function set_media_item(Request $request){
		$input = $request->all();
		$TipoMedia="".$input["TipoMedia"];
		$NombreMedia="".$input["NombreMedia"];
		$URLMedia="".$input["URLMedia"];
		$ContenidoMedia="".addslashes($input["ContenidoMedia"]);
				
		$IdTema="".$input["IdTema"];
		$IdModulo="".$input["IdModulo"];
		$TipoVideo="".$input["TipoVideo"];
		$IdMedia="".$input["IdMedia"];
		$CodigoCurso="".$input["CodigoCurso"];
		$token_curso_post="".$input["token_curso"];		
		

		$fileName = date("YmdHms");		
		$destinationPathlogo = "assets/images/cursos/";
		$controltamanioimagen = 0.3*1024*1024;		

		$destinationPathVideo = "assets/videos/cursos/";
		$controltamaniovideo = 2*1024*1024*1024;

		$destinationPathAudio = "assets/audios/cursos/";
		$controltamanioaudio = 100*1024*1024;

		$destinationPathArchivo = "assets/archivos/cursos/";
		$controltamanioarchivo = 20*1024*1024;

		$NombreArchivoMedia_fi="";

		$controller = new AdminController();
    	$arra_data=$controller->VerificarSesid();
		if(count($arra_data)==0){			
			return response()->json(["status"=>'error',"mensaje"=>"Se ha perdido la sesión"]);
		}else{

			$key="".$arra_data[0]->SesidUsuario."@".$CodigoCurso;				
			$token_curso="".md5($key);
			if($token_curso_post!=$token_curso){
				return response()->json(["status"=>'error',"mensaje"=>"Token Defectuoso"]);
			}
			
			
		
			if($TipoMedia=="1" && $TipoVideo=="1"){
				$ContenidoMedia="";
				if(trim($NombreMedia)==""){
					$NombreMedia="VIDEO";
				}
				
				//SUBIR VIDEO MEDIA
				$VideoMedia=$request->file('FileMedia');
				$NombreVideoMedia="";
				if($VideoMedia){

					$propiedadesVideo= array(
						"size"=>$controltamaniovideo,
						"filename"=>$fileName,
						"path"=>$destinationPathVideo,
						"prefijo"=>"vid_media"
					);
					$ArraVideoMedia = $controller->UploadVideo($VideoMedia,$propiedadesVideo);
					if($ArraVideoMedia["status"]!="ok"){
						return response()->json(["status"=>'error',"mensaje"=>$ArraVideoMedia["mensaje"]]);
					}
					$NombreVideoMedia=$destinationPathVideo."".$ArraVideoMedia["nombre"];
					$URLMedia=" URLMedia='{$NombreVideoMedia}', EstadoVimeo='', ";

				}
			}
			if($TipoMedia=="1" && $TipoVideo!="1"){
				//$ContenidoMedia="";

				if(trim($NombreMedia)==""){
					$NombreMedia=($TipoVideo=="2")?"VIDEO EN YOUTUBE":"VIDEO EN VIMEO";
				}

				if($TipoVideo=="3"){
					$URLMedia=" URLMedia='{$URLMedia}',EstadoVimeo='1',";
				}else{
					$URLMedia=" URLMedia='{$URLMedia}',EstadoVimeo='',";
				}
				
			}

			if($TipoMedia=="2"){
				//SUBIR 
				$TipoVideo="null";
				if(trim($NombreMedia)==""){
					$NombreMedia="IMAGEN";
				}

				//$ContenidoMedia="";
				$ImagenMedia=$request->file('FileMedia');
				$NombreImagenMedia="";
				$CampoImagenes="";
				if($ImagenMedia){	
					$propiedadesImagen= array(
						"size"=>$controltamanioimagen,
						"filename"=>$fileName,
						"path"=>$destinationPathlogo,
						"prefijo"=>"img_media"
					);
					$ArraImagenMedia = $controller->UploadImage($ImagenMedia,$propiedadesImagen);
					if($ArraImagenMedia["status"]!="ok"){
						return response()->json(["status"=>'error',"mensaje"=>$ArraImagenMedia["mensaje"]]);
					}
					$NombreImagenMedia=$destinationPathlogo."".$ArraImagenMedia["nombre"];
					$URLMedia=" URLMedia='{$NombreImagenMedia}',";
				}			

			}

			if($TipoMedia=="3"){
				$TipoVideo="null";
				if(trim($NombreMedia)==""){
					$NombreMedia="TEXTO";
				}

				$URLMedia=" URLMedia='',";
			}

			if($TipoMedia=="4"){
				//SUBIR 
				//$ContenidoMedia="";
				$TipoVideo="null";

				if(trim($NombreMedia)==""){
					$NombreMedia="AUDIO";
				}

				$AudioMedia=$request->file('FileMedia');
				

				if($AudioMedia){	
					$NombreArchivoMedia_fi=$AudioMedia->getClientOriginalName();

					$propiedades= array(
						"size"=>$controltamanioaudio,
						"filename"=>$fileName,
						"path"=>$destinationPathAudio,
						"prefijo"=>"audio_media"
					);
					$ArraImagenMedia = $controller->UploadImage($AudioMedia,$propiedades);
					if($ArraImagenMedia["status"]!="ok"){
						return response()->json(["status"=>'error',"mensaje"=>$ArraImagenMedia["mensaje"]]);
					}			
					$NombreAudioMedia=$destinationPathAudio."".$ArraImagenMedia["nombre"];		
					$URLMedia=" URLMedia='{$NombreAudioMedia}',";
				}

			}


			if($TipoMedia=="5"){
				//SUBIR 				
				$TipoVideo="null";
				

				if(trim($NombreMedia)==""){
					$NombreMedia="ARCHIVO";
				}

				$ArchivoMedia=$request->file('FileMedia');				
				if($ArchivoMedia){

					$NombreArchivoMedia_fi=$ArchivoMedia->getClientOriginalName();

					$propiedades= array(
						"size"=>$controltamanioarchivo,
						"filename"=>$fileName,
						"path"=>$destinationPathArchivo,
						"prefijo"=>"archivo_media"
					);
					$ArraImagenMedia = $controller->UploadImage($ArchivoMedia,$propiedades);
					if($ArraImagenMedia["status"]!="ok"){
						return response()->json(["status"=>'error',"mensaje"=>$ArraImagenMedia["mensaje"]]);
					}

					$NombreArchivoMedia=$destinationPathArchivo."".$ArraImagenMedia["nombre"];		
					$URLMedia=" URLMedia='{$NombreArchivoMedia}',";

				}

			}

			if($TipoMedia=="6"){
				$TipoVideo="null";

				if(trim($NombreMedia)==""){
					$NombreMedia="ENLACE";
				}

				$URLMedia=" URLMedia='{$URLMedia}',";
			}

			$campo_relacion="";

			if($IdTema){
				$campo_relacion="IdTema='{$IdTema}'";
			}else{
				$campo_relacion="IdModulo='{$IdModulo}'";
			}
			

			DB::beginTransaction();

			if($IdMedia==""){
				$sql="SELECT MAX(IdOrden) AS IdOrden FROM tbl_media WHERE {$campo_relacion} and IdEstado=1";
				$result_bd=DB::select($sql);
				$IdOrden=0;
				if(count($result_bd)>0){
					$IdOrden=$result_bd[0]->IdOrden+1;
				}

				$sql="INSERT INTO tbl_media set 
						TipoMedia={$TipoMedia},
						NombreMedia='{$NombreMedia}',
						{$URLMedia}
						IdEstado=1,
						TipoVideo={$TipoVideo},
						{$campo_relacion},
						ContenidoMedia='{$ContenidoMedia}',
						NombreArchivoMedia='{$NombreArchivoMedia_fi}',
						IdOrden={$IdOrden}
					";
				$result=DB::insert($sql);
				$IdMedia = DB::getPDO()->lastInsertId();				
			}else{

				$sql="SELECT * FROM tbl_media WHERE  IdMedia={$IdMedia} and TipoMedia in (1,2,4)";
				$result_bd=DB::select($sql);
				if(count($result_bd)>0){
					if($result_bd[0]->TipoMedia=="1" && $result_bd[0]->TipoVideo=="1"){
						if($URLMedia!=""){
							\File::delete($result_bd[0]->URLMedia);	
						}						
					}					

					if($result_bd[0]->TipoMedia=="2" || $result_bd[0]->TipoMedia=="4"  || $result_bd[0]->TipoMedia=="5" ){
						if($URLMedia!=""){
							\File::delete($result_bd[0]->URLMedia);	
						}				
					}

				}

				$sql="UPDATE tbl_media set 
						TipoMedia={$TipoMedia},
						NombreMedia='{$NombreMedia}',
						{$URLMedia}						
						TipoVideo={$TipoVideo},
						{$campo_relacion},
						ContenidoMedia='{$ContenidoMedia}' 
						WHERE IdMedia='{$IdMedia}'
					";
				$result=DB::update($sql);

			}

			DB::commit();
			return response()->json([	"status"=>'ok',
										"mensaje"=>"Proceso generado correctamente."
									]);

		}


	}


	public function get_media_item(Request $request){
		$input = $request->all();	
		
		$IdTema="".$input["IdTema"];
		$IdModulo="".$input["IdModulo"];		
		$CodigoCurso="".$input["CodigoCurso"];
		$token_curso_post="".$input["token_curso"];		
		
		$controller = new AdminController();
    	$arra_data=$controller->VerificarSesid();
		if(count($arra_data)==0){			
			return response()->json(["status"=>'error',"mensaje"=>"Se ha perdido la sesión"]);
		}else{

			$key="".$arra_data[0]->SesidUsuario."@".$CodigoCurso;
			$token_curso="".md5($key);
			if($token_curso_post!=$token_curso){
				return response()->json(["status"=>'error',"mensaje"=>"Token Defectuoso"]);
			}
			
			$filtro_media="";
			if($IdTema!=""){
				$filtro_media=" IdTema={$IdTema} ";
			}else{
				$filtro_media=" IdModulo={$IdModulo} ";
			}

			$sql="SELECT * FROM tbl_media WHERE IdEstado=1 and {$filtro_media}  ORDER BY IdOrden ASC";
			$result=DB::select($sql);
			
			for($i=0; $i<count($result);$i++){
				if($result[$i]->TipoMedia=="1" && $result[$i]->URLMedia){
					$result[$i]->VideoEmbedMedia=$controller->obtenerVideoURL($result[$i]->URLMedia,$result[$i]->TipoVideo);
				}
			}

			DB::commit();
			return response()->json([	"status"=>'ok',										
										"datos"=>$result,
									]);

		}


	}








	public function get_modulos_curso_general($id_curso,$id_modulo,$idusuario,$tipo_edit=null){
    	$cadena_curso="";
    	$cadena_leccion="";
    	$cadena_usuario="";
    	$select_usuario="";
    	$cadena_modulo="";

    	$relacion_usuario="";
    	if($id_curso){
    		$cadena_curso=" and m.IdCurso={$id_curso} ";
    	}
    	if($id_modulo){
    		$cadena_leccion=" and m.IdModulo='{$id_modulo}' ";
    	}

    	
    	if($idusuario){
    		$select_usuario=", (SELECT EstadoTemaAvance 
								FROM tbl_avance_tema_usuario 
								WHERE IdModulo=m.IdModulo AND 
								IdUsuarioPersona=uc.IdUsuarioPersona 
								AND TipoAvance=1) as EstadoTemaAvance";
    		
			$cadena_usuario=" AND up.IdUsuario=$idusuario ";

    		$relacion_usuario="INNER JOIN tbl_usuario_curso uc on uc.IdCurso=c.IdCurso and uc.IdEstado=1
			INNER JOIN tbl_usuario_persona up ON up.IdUsuarioPersona=uc.IdUsuarioPersona ";

    	}

		$id_estado="1";
		if($tipo_edit){
			$id_estado="1,3";
		}

    	$sql="SELECT m.*,'' as clases_gratis {$select_usuario},m.IdCurso, e.NombreEstado
			from tbl_modulo m 
			INNER JOIN tbl_curso c ON c.IdCurso=m.IdCurso
			INNER JOIN tbl_estado e ON e.IdEstado=m.IdEstado
			{$relacion_usuario}
			where  m.IdEstado in ({$id_estado})  {$cadena_leccion} {$cadena_curso} {$cadena_usuario}
			ORDER BY m.OrdenModulo ASC
			";
		$result=DB::select($sql);

		$controller=new AdminController();
		for($i=0;$i<count($result);$i++){

			
			/*if($result[$i]->GratisModulo){
				$arra_media=$this->get_media($result[$i]->IdTema,'modulo');
				if($arra_media){					

					for($j=0;$j<count($arra_media);$j++){
						if($arra_media[$j]->TipoVideo=="1"){
							$arra_media[$j]->embed_video=$controller->obtenerVideoURL($arra_media[$j]->URLMedia,$arra_media[$j]->TipoVideo);
						}
					}

					$result[$i]->clases_gratis=$arra_media;
					
				}
			}*/

		}
		

		return $result;
    }



	public function fichacontenido($url_curso,$tipo_contenido,$id_contenido=null){
    	$controller = new AdminController();
    	$arra_data=$controller->VerificarSesid();
		if(count($arra_data)==0){
			return view('areacurso.notienespermiso');
		}else{
			$notificaciones=$controller->get_notificaciones($arra_data[0]->IdUsuario);	
			
			

			$leccion_curso="";
			$CodigoRegistro="";

			if(session('rol_solicitud')=="root"){

				$info_curso=$this->get_cursos_persona($arra_data[0]->SesidUsuario,$url_curso,'','','','','','','','1,2,3,4,7');

				if($tipo_contenido=="leccion"){
					$leccion_curso=$this->get_lecciones_curso("",$id_contenido,'');
				}elseif($tipo_contenido=="modulo"){
					$leccion_curso=$this->get_modulos_curso_general("",$id_contenido,'');
				}else{
					$leccion_curso=$this->get_evaluaciones($info_curso[0]->IdCurso);
				}

			}else{

				if(session('rol_solicitud')=="tutor"){
					$info_curso=$this->get_cursos_persona($arra_data[0]->SesidUsuario,$url_curso,'','','','','','','','1,2,3,4,7');
				}else{
					$info_curso=$this->get_cursos_persona($arra_data[0]->SesidUsuario,$url_curso,'','','','','','','','1');
				}

				if(count($info_curso)==0){
					return view('areacurso.notienespermiso');
				}

				if($tipo_contenido=="leccion"){					
					$leccion_curso=$this->get_lecciones_curso("",$id_contenido,$arra_data[0]->IdUsuario);										
				}elseif($tipo_contenido=="modulo"){
					$leccion_curso=$this->get_modulos_curso_general("",$id_contenido,$arra_data[0]->IdUsuario);
				}else{					
					$leccion_curso=$this->get_evaluaciones($info_curso[0]->IdCurso);

					if(count($leccion_curso)>0){
						$date_f=date('YmdHisu');
						$CodigoRegistro=$this->get_codigo_enlace_afiliados(8).$date_f;

						$CodigoRegistro=md5($CodigoRegistro);
						$CodigoRegistro="UC-".substr($CodigoRegistro,0,10);

						$sql="INSERT INTO tbl_evaluacion_usuario set IdEvaluacion={$leccion_curso[0]->IdEvaluacion},
								IdUsuario={$arra_data[0]->IdUsuario}, FechaCreacion=now(), IdEstado=3, IdRol=1,
								CodigoEvaluacion='{$CodigoRegistro}'";
						$result=DB::insert($sql);
						

					}
					


				}
			}

			
			if(count($leccion_curso)==0 || count($info_curso)==0){
				return view('areacurso.notienespermiso');	
			}
			
			$IdContenido="";

			
			
			if($tipo_contenido=="leccion"){
				$IdContenido=$leccion_curso[0]->IdTema;
			}
			
			if($tipo_contenido=="modulo"){
				$IdContenido=$leccion_curso[0]->IdModulo;
			}

			//MEDIA
			$info_media=array();
			if($tipo_contenido=="leccion" || $tipo_contenido=="modulo" ){
				$info_media=$this->get_media($IdContenido,$tipo_contenido);
			}


			//HABILIADES 
			//$info_habilidades=$this->get_habilidades($leccion_curso[0]->IdTema,'','');
			$info_habilidades=null;

			//HISTORIAL DE ENTRADA
			if($tipo_contenido=="leccion" || $tipo_contenido=="modulo" ){
				$this->set_avance_historial($IdContenido,$arra_data[0]->IdUsuarioPersona,$tipo_contenido);
			}
			

			//COMENTARIOS 
			$info_comentarios=array();
			$info_comentarios_hijo=array();

			if($tipo_contenido=="leccion" || $tipo_contenido=="modulo" ){
				$info_comentarios=$this->get_comentarios($IdContenido,$tipo_contenido);
				$info_comentarios_hijo=$info_comentarios;
			}

			//EVALUACIONES
			//
			


			$info_modulos=$this->get_modulos_curso($info_curso[0]->IdCurso);
			$info_lecciones=$this->get_lecciones_curso($info_curso[0]->IdCurso,'','');


			$info_lecciones_estado=$this->get_avances_lecciones($arra_data[0]->IdUsuarioPersona);
			
			//$info_curso=$this->get_cursos_persona('','','','','','','','','','1,2,3,4',"",$info_curso[0]->IdCurso);
			//SIGUIENTE LECCION
			$info_siguiente=$this->get_siguiente_tema($info_curso[0]->IdCurso,$IdContenido,$tipo_contenido,$info_curso[0]->SlugCurso);


			$calificacion=$this->get_valoracion_by_persona_curso($arra_data[0]->IdUsuarioPersona,$info_curso[0]->IdCurso);


			

			$porcentaje_avance=$this->get_avances_curso($arra_data[0]->IdUsuarioPersona,$info_curso[0]->IdCurso);

			$paso_examen=0;

			$sql="	SELECT eu.* 
					FROM tbl_evaluacion_usuario eu
					INNER JOIN  tbl_evaluacion e ON e.IdEvaluacion=eu.IdEvaluacion and e.IdEstado=1
					WHERE 	eu.IdUsuario={$arra_data[0]->IdUsuario} AND 
							e.IdCurso={$info_curso[0]->IdCurso} AND 
							eu.IdEstado=1 limit 1";
			$result_evaluacion=DB::select($sql);

			$codigo_certificado="";

			if(count($result_evaluacion)>0){
				$paso_examen=1;
				$codigo_certificado="{$result_evaluacion[0]->CodigoEvaluacion}";
			}

			//TODO: consultar el examen que se haya pasado.
			return view('areacurso.visualizar-contenido',[
				"data"=>$arra_data,
				"paso_examen"=>$paso_examen,
				"titulo_pagina"=>'Lección Disponibles', 
				"notificaciones"=>$notificaciones,
				"info_leccion"=>$leccion_curso[0],
				"info_media"=>$info_media,
				"info_habilidades"=>$info_habilidades,
				"info_siguiente"=>$info_siguiente,
				"info_comentarios"=>$info_comentarios,
				"info_comentarios_hijo"=>$info_comentarios_hijo,
				"info_modulos"=>$info_modulos,
				"info_lecciones"=>$info_lecciones,
				"info_lecciones_estado"=>$info_lecciones_estado,
				"curso"=>$info_curso[0],
				"valoracion"=>$calificacion,
				"tipo_contenido"=>$tipo_contenido,
				"CodigoRegistroExamen"=>$CodigoRegistro,
				"porcentaje_avance"=>$porcentaje_avance,
				"codigo_certificado"=>$codigo_certificado,
				"menu"=>"cursos"
			]);
		}    	
    }


	public function setiniciarexamen(Request $request){
		//
		$input = $request->all();	
		
		$CodigoRegistroExamen="".$input["CodigoRegistroExamen"];		

		$controller = new AdminController();
    	$arra_data=$controller->VerificarSesid();
		if(count($arra_data)==0){			
			return response()->json(["status"=>'error',"mensaje"=>"Se ha perdido la sesión"]);
		}else{
			$sql="UPDATE tbl_evaluacion_usuario set FechaCreacion=now(), IdEstado=7 where CodigoEvaluacion='{$CodigoRegistroExamen}'";
			$result=DB::update($sql);			
		}				
		return response()->json(["status"=>'ok',"mensaje"=>"Iniciando el examen"]);
	}


	public function setfinalizarexamen(Request $request){
		//
		$input = $request->all();	
		
		$CodigoRegistroExamen="".$input["CodigoRegistroExamen"];
		$CadenaRegistroExamen="".$input["CadenaRegistroExamen"];
		$IdEvaluacion="".$input["IdEvaluacion"];

		$cantidad_minima=0;

		$controller = new AdminController();
    	$arra_data=$controller->VerificarSesid();
		if(count($arra_data)==0){			
			return response()->json(["status"=>'error',"mensaje"=>"Se ha perdido la sesión"]);
		}else{

			$IdUsuario=$arra_data[0]->IdUsuario;

			$arra_resultados=explode(";",$CadenaRegistroExamen);
			$arra_verificacion=array();


			$sql="SELECT * FROM tbl_evaluacion WHERE IdEvaluacion={$IdEvaluacion}";
			$result_evaluacion=DB::select($sql);

			$cantidad_minima=$result_evaluacion[0]->PorcentajeMinimo;
			$cant_verdaderas=0;

			for($i=0;$i<count($arra_resultados);$i++){
				$arra_detalle=explode(":",$arra_resultados[$i]);
				$id_pregunta="".$arra_detalle[0];
				$id_respuesta="".$arra_detalle[1];

				$sql="	INSERT INTO tbl_respuesta_usuario SET 
						IdUsuario={$IdUsuario},
					  	IdPregunta={$id_pregunta}, 
						IdRespuesta={$id_respuesta},
						IdRol=1";
				$result=DB::insert($sql);

				$sql="SELECT IdRespuesta, IdPregunta, EsVerdadero from tbl_respuesta WHERE IdEstado=1 and IdRespuesta={$id_respuesta} and IdPregunta={$id_pregunta}";
				$result_resp=DB::select($sql);
				array_push($arra_verificacion,$result_resp[0]);
				
				if($result_resp[0]->EsVerdadero=="1"){
					$cant_verdaderas++;
				}
				

			}

			$estado_evaluacion="";
			if($cant_verdaderas>=$cantidad_minima){
				$estado_evaluacion="1";
			}else{
				$estado_evaluacion="2";
			}

			$sql="UPDATE tbl_evaluacion_usuario set FechaCreacion=now(), IdEstado={$estado_evaluacion} where CodigoEvaluacion='{$CodigoRegistroExamen}'";
			$result=DB::update($sql);			
			return response()->json(["status"=>'ok',
									 "mensaje"=>"Finalizando el examen",
									 "verificacion"=>$arra_verificacion]);
		}				
		

	}	

	public function get_tema_gratis(Request $request){
		//
		$input = $request->all();	
		$controller = new AdminController();
		
		$IdCurso="".$input["IdCurso"];
		$id_item="".$input["id_item"];
		$tipo_item="".$input["tipo_item"];
		
		$result_media_gratis="";
		if($tipo_item=="1"){

			$sql="SELECT * FROM tbl_modulos where IdModulo = {$id_item} and GratisModulo=1 and IdCurso={$IdCurso} and IdEstado=1";
			$result=DB::select($sql);

			if(count($result)>0){
				$sql="SELECT * FROM tbl_media WHERE IdModulo={$result[0]->IdModulo} AND IdEstado=1  and TipoMedia in (1,2,3,4)  order by IdOrden ASC";
				$result_media_gratis=DB::select($sql);
				
				/*
				$result[$i]->clases_gratis=$controller->obtenerVideoURL($arra_media[0]->URLMedia,$arra_media[0]->TipoVideo);
				$result[$i]->TipoVideoGratis=$arra_media[0]->TipoVideo;
				*/

			}

		}else{
			$sql=" SELECT * 
				   FROM tbl_tema t 
				   INNER JOIN tbl_modulo m ON m.IdModulo=t.IdModulo AND m.IdCurso={$IdCurso}
				   where IdTema = {$id_item} and 
				   t.GratisTema=1 AND t.IdEstado=1";
			$result=DB::select($sql);

			if(count($result)>0){
				$sql="SELECT * FROM tbl_media WHERE IdTema={$id_item} AND IdEstado=1 and TipoMedia in (1,2,3,4) order by IdOrden ASC";
				$result_media_gratis=DB::select($sql);
			}
		}

		if(count($result_media_gratis)>0){
			for($i=0;$i<count($result_media_gratis);$i++){
				if($result_media_gratis[$i]->TipoMedia=="1"){
					$result_media_gratis[$i]->video_embed=$controller->obtenerVideoURL($result_media_gratis[$i]->URLMedia,$result_media_gratis[$i]->TipoVideo);						
				}
			}
		}

		return response()->json(["status"=>'ok',"datos"=>$result_media_gratis]);

	}

	public function get_avances_curso($idusuariopersona,$idcurso){		

		$info_modulos=$this->get_modulos_curso($idcurso);
		$info_lecciones=$this->get_lecciones_curso($idcurso,'','');
		//$cantidad_total_contenido=count($info_lecciones)+count($info_modulos);
		$cantidad_total_contenido=count($info_lecciones);

		$sql="	SELECT au.*
				FROM tbl_avance_tema_usuario au
				INNER JOIN tbl_tema t ON t.IdTema=au.IdTema AND t.IdEstado=1
				INNER JOIN tbl_modulo m ON m.IdModulo=t.IdModulo AND m.IdEstado=1 AND m.IdCurso={$idcurso}
				WHERE au.IdUsuarioPersona = {$idusuariopersona} AND au.TipoAvance=1 AND au.EstadoTemaAvance=1";
		$result_avance_temas=DB::select($sql);


		$sql="	SELECT au.*
				FROM tbl_avance_tema_usuario au
				INNER JOIN tbl_modulo m ON m.IdModulo=au.IdModulo AND m.IdEstado=1 AND m.IdEstado=1 AND m.IdCurso={$idcurso}				
				WHERE au.IdUsuarioPersona = {$idusuariopersona} AND au.TipoAvance=1  AND au.EstadoTemaAvance=1";
		$result_avance_modulo=DB::select($sql);
		//$cant_avances=count($result_avance_modulo)+count($result_avance_temas);		
		$cant_avances=count($result_avance_temas);		


		$porcentaje_avance=0;
		
		if($cantidad_total_contenido>0){
			$porcentaje_avance=($cant_avances*100)/$cantidad_total_contenido;
			$porcentaje_avance=ceil($porcentaje_avance);
		}
		


		return $porcentaje_avance;

	}

	

	public function get_estudiantes_by_curso(Request $request){
		$input = $request->all();
    	$CodigoCurso="".$input["CodigoCurso"];
		$token_curso_post="".$input["token_curso"];
    	$NombreCompletoFiltro="".addslashes($input["NombreCompletoFiltro"]);
    	$EmailFiltro="".addslashes($input["EmailFiltro"]);
		$FechaInicialFiltro="".addslashes($input["FechaInicialFiltro"]);
		$FechaFinalFiltro="".addslashes($input["FechaFinalFiltro"]);
		
		$filtro="";
		if($NombreCompletoFiltro!=""){
			$filtro.=" AND CONCAT_WS(' ',p.NombrePersona,p.ApellidosPersona) like '%{$NombreCompletoFiltro}%' ";
		}

		if($EmailFiltro!=""){
			$filtro.=" AND p.EmailPersona ='{$EmailFiltro}' ";
		}

		if($FechaInicialFiltro!="" && $FechaFinalFiltro==""){
			$filtro.=" AND  (uc.FechaCompra BETWEEN'{$FechaInicialFiltro} 00:00:00' and '{$FechaInicialFiltro} 23:59:59' ) ";
		}

		if($FechaInicialFiltro!="" && $FechaFinalFiltro!=""){
			$filtro.=" AND  (uc.FechaCompra BETWEEN'{$FechaInicialFiltro} 00:00:00' and '{$FechaFinalFiltro} 23:59:59' ) ";
		}
    	
    	

    	$controller = new AdminController();
    	$arra_data=$controller->VerificarSesid();
		if(count($arra_data)==0){			
			return response()->json(["status"=>'error',"mensaje"=>"Se ha perdido la sesión"]);
		}else{

			$key="".$arra_data[0]->SesidUsuario."@".$CodigoCurso;				
			$token_curso="".md5($key);

			if($token_curso_post!=$token_curso){
				return response()->json(["status"=>'error',"mensaje"=>"Token Defectuoso"]);
			}
			
			$sql="	SELECT uc.*, p.EmailPersona, CONCAT_WS(' ',p.NombrePersona,p.ApellidosPersona) as NombreEstudiante, CONCAT_WS(' - ', p.TelefonoPersona, p.WhatsappPersona ) as CelularPersona
					FROM tbl_usuario_curso uc
					INNER JOIN tbl_usuario_persona up ON up.IdUsuarioPersona=uc.IdUsuarioPersona
					INNER JOIN tbl_usuario u ON u.IdUsuario=up.IdUsuario
					INNER JOIN tbl_persona p ON p.IdPersona = up.IdPersona
					INNER JOIN tbl_curso c ON c.IdCurso=uc.IdCurso /*AND c.CodigoCurso='{$CodigoCurso}'*/
					WHERE uc.EsAfiliado is null and uc.IdEstado=1 
					{$filtro}
					
					";
			$result=DB::select($sql);

			return response()->json(["status"=>'ok',"datos"=>$result]);
		}
	}



	public function validacion_publicacion($IdCurso,$result_curso){
					
		
		

		$sql="SELECT * FROM tbl_modulo WHERE IdCurso='{$IdCurso}'";
		$result_modulo=DB::select($sql);
		
		$sql="SELECT * FROM tbl_tema 
				WHERE IdModulo in (select IdModulo from tbl_modulo where IdCurso={$IdCurso} )";
		$result_lecciones=DB::select($sql);

		$validacion_mensaje="";
		$contenido_modulo_borrador=false;
		$contenido_lecciones_borrador=false;
		if(count($result_modulo)==0){
			$validacion_mensaje.="No tiene contenido.|";
		}else{
			for($i=0;$i<count($result_modulo);$i++){
				if($result_modulo[$i]->IdEstado=="3"){
					$contenido_modulo_borrador=true;
				}
			}

			for($i=0;$i<count($result_lecciones);$i++){
				if($result_lecciones[$i]->IdEstado=="3"){
					$contenido_lecciones_borrador=true;
				}
			}
		}

		if($contenido_modulo_borrador){
			$validacion_mensaje.="Hay módulos en borrador.<br/>";
		}	

		if($contenido_lecciones_borrador){
			$validacion_mensaje.="Hay lecciones en borrador.<br/>";
		}

		if(trim($result_curso[0]->NombreCurso)==""){
			$validacion_mensaje.="No tiene el título asignado.<br/>";
		}

		if(trim($result_curso[0]->DescripcionCortaCurso)==""){
			$validacion_mensaje.="No tiene la descripción corta.<br/>";
		}

		if(trim($result_curso[0]->DescripcionCurso)==""){
			$validacion_mensaje.="No tiene la descripción completa.<br/>";
		}

		if(session('rol_solicitud')=="root"){

			if(trim($result_curso[0]->ImagenCurso)==""){
				$validacion_mensaje.="No tiene una imágen destacada.<br/>";
			}

			if(trim($result_curso[0]->VideoCurso)==""){
				$validacion_mensaje.="No tiene un video de presentación.<br/>";
			}
			
		}

		if(trim($result_curso[0]->PrecioCurso)==""){
			$validacion_mensaje.="No tiene un precio establecido.<br/>";
		}


		if($validacion_mensaje){
			return $validacion_mensaje;
		}else{
			return "ok";
		}
	}

	public function enviar_curso_publicacion(Request $request){
		$input = $request->all();
    	$CodigoCurso="".$input["CodigoCurso"];
		$token_curso_post="".$input["token_curso"];
		$estado="".$input["estado"];

		

		$controller = new AdminController();
    	$arra_data=$controller->VerificarSesid();
		if(count($arra_data)==0){			
			return response()->json(["status"=>'error',"mensaje"=>"Se ha perdido la sesión"]);
		}else{

			$key="".$arra_data[0]->SesidUsuario."@".$CodigoCurso;
			$token_curso="".md5($key);

			if($token_curso_post!=$token_curso){
				return response()->json(["status"=>'error',"mensaje"=>"Token Defectuoso"]);
			}

			$sql="SELECT * FROM tbl_curso WHERE CodigoCurso='{$CodigoCurso}'";
			$datos_cursos=DB::select($sql);			
			$IdCurso=$datos_cursos[0]->IdCurso;
			
			$result_validacion=$this->validacion_publicacion($IdCurso,$datos_cursos);

			if($result_validacion=="ok"){

				$id_estado="";
				if($estado=="pedntcurs"){
					$id_estado="7";
				}
				if($estado=="borrdcurs"){
					$id_estado="3";
				}

				if($estado=="publicdcurs"){
					$id_estado="1";
				}

				$sql="UPDATE tbl_curso SET IdEstado={$id_estado} where IdCurso={$IdCurso}";
				$result=DB::update($sql);
				return response()->json(["status"=>'ok',"mensaje"=>"El curso a cambiado de estado correctamente."]);

			}else{
				return response()->json(["status"=>'error',"mensaje"=>$result_validacion]);
			}
			
			
		}

	}

	public function asignacion_usuarios_default($IdCurso,$IdUsuarioTutor=null,$url_curso=null){

		if($url_curso){
			$sql="SELECT * FROM tbl_curso WHERE SlugCurso='{$url_curso}'";
			$result=DB::select($sql);
			if(count($result)>0){
				$IdCurso=$result[0]->IdCurso;
			}
		}

		if($IdUsuarioTutor){
			$sql="SELECT * FROM tbl_usuario_curso Where IdUsuarioPersona={$IdUsuarioTutor} AND   IdCurso={$IdCurso}";
			$result=DB::select($sql);

			if(count($result)==0){
				$sql="INSERT INTO tbl_usuario_curso SET IdUsuarioPersona={$IdUsuarioTutor}, IdCurso={$IdCurso}, IdEstado=1, EsAfiliado=1 ";
				$result=DB::insert($sql);
			}	
		}
		
		$sql="SELECT * FROM tbl_usuario_curso Where IdUsuarioPersona=5 AND IdCurso={$IdCurso}";
		$result=DB::select($sql);

		if(count($result)==0){
			$sql="INSERT INTO tbl_usuario_curso SET IdUsuarioPersona=5, IdCurso={$IdCurso}, IdEstado=1, EsAfiliado=1 ";
			$result=DB::insert($sql);
		}
	}

	public function set_afiliacion(Request $request){
		$input = $request->all();
    	$CodigoCurso="".$input["CodigoCurso"];
		$URLHotmartCheckout="".$input["url_checkout_hotmart"];
		$PixelFacebook="".$input["pixel_facebook"];
		$TokenFacebook="".$input["token_facebook"];
		
		
		$controller = new AdminController();
    	$arra_data=$controller->VerificarSesid();
		if(count($arra_data)==0){			
			return response()->json(["status"=>'error',"mensaje"=>"Se ha perdido la sesión"]);
		}else{
			
			$sql="SELECT * FROM tbl_curso WHERE CodigoCurso='{$CodigoCurso}'";
			$datos_cursos=DB::select($sql);			

			if($datos_cursos[0]->AprobacionAutomatica=="0" && session('rol_solicitud')=="afiliado" ){				
				return response()->json(["status"=>'error',"mensaje"=>"El curso no existe o no está habilitado para afiliados"]);
			}

			$IdCurso=$datos_cursos[0]->IdCurso;
			$IdUsuarioPersona=$arra_data[0]->IdUsuarioPersona;

			$this->generar_solicitud($IdCurso,$IdUsuarioPersona,$URLHotmartCheckout,$PixelFacebook,$TokenFacebook);

			return response()->json(["status"=>'ok',"mensaje"=>"Proceso generado correctamente."]);
			

		}

	}


	public function generar_solicitud($IdCurso,$IdUsuarioPersona,$URLHotmartCheckout,$PixelFacebook,$TokenFacebook,$CodigoCurso=null){

		if($CodigoCurso){
			$sql="SELECT * FROM tbl_curso WHERE CodigoCurso='{$CodigoCurso}'";
			$datos_cursos=DB::select($sql);		
			$IdCurso=$datos_cursos[0]->IdCurso;	
		}

		$sql="SELECT * FROM tbl_solicitud_afiliacion where IdCurso={$IdCurso} AND IdUsuarioPersona={$IdUsuarioPersona}";
		$datos_afiliados=DB::select($sql);			

		if(count($datos_afiliados)==0){
			$CodigoEnlace=$this->get_codigo_enlace_afiliados(16);				
			$sql="INSERT INTO tbl_solicitud_afiliacion SET IdCurso={$IdCurso}, CodigoSolicitudAfiliacion='{$CodigoEnlace}',
					URLHotmartCheckout='{$URLHotmartCheckout}',
					PixelFacebook='{$PixelFacebook}', TokenFacebook='{$TokenFacebook}', IdUsuarioPersona={$IdUsuarioPersona},EstadoSolicitudAfiliacion=1";
			$result=DB::insert($sql);
			return "ok";
		}else{
			$sql="UPDATE tbl_solicitud_afiliacion SET
					URLHotmartCheckout='{$URLHotmartCheckout}',
					PixelFacebook='{$PixelFacebook}', TokenFacebook='{$TokenFacebook}'  WHERE IdCurso={$IdCurso} AND IdUsuarioPersona={$IdUsuarioPersona}";
			$result=DB::update($sql);
			Log::debug($sql);
			return "ok";

		}
	}

	public function get_solicitud_afiliado($IdCurso,$IdUsuarioPersona,$CodigoUsuario=null){

		if($CodigoUsuario){
			$sql="SELECT up.IdUsuarioPersona
				  FROM tbl_usuario u
				  INNER JOIN tbl_usuario_persona up ON up.IdUsuario=u.IdUsuario
				  WHERE u.NombreUsuario='{$CodigoUsuario}'";
			$datos_afiliados=DB::select($sql);
			if(count($datos_afiliados)>0){
				$IdUsuarioPersona=$datos_afiliados[0]->IdUsuarioPersona;
			}
		}

		$sql="SELECT * FROM tbl_solicitud_afiliacion where IdCurso={$IdCurso} AND IdUsuarioPersona={$IdUsuarioPersona} limit 1";
		$datos_afiliados=DB::select($sql);
		$PixelFacebook="";
		$URLHotmartCheckout="";
		$TokenFacebook="";
		if(count($datos_afiliados)>0){
			$PixelFacebook="".$datos_afiliados[0]->PixelFacebook;
			$URLHotmartCheckout="".$datos_afiliados[0]->URLHotmartCheckout;
			$TokenFacebook="".$datos_afiliados[0]->TokenFacebook;
		}
		return "{$PixelFacebook}||{$URLHotmartCheckout}||{$TokenFacebook}";
	}

	public function get_cursos_hotmart(Request $request){
		$input = $request->all();
    	$IdCurso="".$input["IdCurso"];

		$controller = new AdminController();
    	$arra_data=$controller->VerificarSesid();
		if(count($arra_data)==0){
			return response()->json(["status"=>'error',"mensaje"=>"Se ha perdido la sesión"]);
		}else{
			$cursos_disponibles=$this->get_cursos_persona(null,null,null,null,null,null,null,null,null,"1,2,3,4,5,6,7",null,$IdCurso,null);
			$cursos_disponibles=$cursos_disponibles[0];

			


			return response()->json(["status"=>'ok',"data"=>$cursos_disponibles]);
		}
		
	}

	public function asignar_cursos_afiliados($idCurso,$idUsuarioPersona){
		
		
		$sql="SELECT * FROM tbl_curso where IdEstado=1  AND IdCurso={$idCurso}";
		$datosCursos=DB::select($sql);

		

		$sql="	SELECT up.* 
			  	FROM tbl_usuario_persona up
				INNER JOIN tbl_usuario u ON u.IdUsuario=up.IdUsuario
				INNER JOIN tbl_persona p ON p.IdPersona=up.IdPersona
				WHERE u.IdEstado=1 and u.IdEstadoSolicitudAfiliado=1
				    AND up.IdUsuarioPersona={$idUsuarioPersona} ";
		$datos_usuariop_persona=DB::select($sql);
		Log::debug($sql);

		if(count($datos_usuariop_persona)==1){
			
			$sql="SELECT * FROM tbl_usuario_curso where IdCurso={$idCurso} and IdUsuarioPersona={$idUsuarioPersona}";
			$datos_usuario_curso=DB::select($sql);

			if(count($datos_usuario_curso)==0){

				$id_tutor=$datosCursos[0]->IdUsuarioTutor;
				
				$sql="INSERT INTO tbl_usuario_curso SET 
					IdUsuarioPersona={$idUsuarioPersona},
					IdCurso={$idCurso},
					FechaCreacion=now(),
					IdEstado=1,
					IdEstadoPedido=1,
					PrecioCurso=0,
					ComisionAfiliado=0,
					ComisionTutor=0,
					ComisionEmpresa=0,
					IdTutor={$id_tutor},
					IdAfiliado={$id_tutor},
					EnCanje=0,
					DiasGarantia=0,
					EsAfiliado=1";
				$result=DB::insert($sql);

				Log::debug($sql);

			}


		}
		
		return ["status"=>'ok'];
	}

	public function abrir_certificado_public($codigo_certificado){
		$sql="SELECT * FROM tbl_evaluacion_usuario where
		 CodigoEvaluacion='{$codigo_certificado}' 
		 AND IdEstado=1
		 limit 1";
		$datos=DB::select($sql);
		if(count($datos)>0){
			
			$url_documento="assets/certificado/certificado_{$codigo_certificado}.pdf";				
			return response()->download($url_documento);				
			
		}else{
			return view('areacurso.notienespermiso');
		}	

	}

}