<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Quotation;
use Illuminate\Support\Facades\Log;
use Exception;


class FormularioController extends Controller
{
    public function get_formulario($tipoevaluacion,$idusuario){
        try {			
			//GET EVALUACIÓN
            $cad_filtro="";            
            if($tipoevaluacion){
                $cad_filtro="AND IdTipoEvaluacion={$tipoevaluacion}";
            }
            if($idusuario){
                $cad_filtro.="AND IdUsuario={$idusuario}";
            }
            $sql_sentencia="SELECT e.*
                            FROM tbl_evaluacion e
                            WHERE e.IdEstado=1 {$cad_filtro} AND e.IdCurso is null";
			$result_evaluacion=DB::select($sql_sentencia);

            for($i=0;$i<count($result_evaluacion);$i++){

                $result_evaluacion[$i]->preguntas=$this->get_preguntas($result_evaluacion[$i]->IdEvaluacion);

            }


            return $result_evaluacion;




		} catch (\Illuminate\Database\QueryException $e) {			
			report($e);			
			return response()->json(["status"=>'error',"mensaje"=>"Hay un error en el sistema, por favor intenta más tarde."]);	

		}

    }

    public function get_preguntas($id_evaluacion){
        try {

            $sql_sentencia="SELECT p.*
                            FROM tbl_pregunta p
                            WHERE p.IdEstado=1 AND IdEvaluacion={$id_evaluacion}";
            $result_preguntas=DB::select($sql_sentencia);

            for($i=0;$i<count($result_preguntas);$i++){

                $result_preguntas[$i]->respuestas=$this->get_respuestas($result_preguntas[$i]->IdPregunta);

            }

            return $result_preguntas;

        } catch (\Illuminate\Database\QueryException $e) {			
			report($e);			
			return 'error';	
		}
    }


    public function get_respuestas($id_pregunta){
        try {

            $sql_sentencia="SELECT r.*
                            FROM tbl_respuesta r
                            WHERE r.IdEstado=1 AND r.IdPregunta={$id_pregunta}";
            $result_respuestas=DB::select($sql_sentencia);

            return $result_respuestas;

        } catch (\Illuminate\Database\QueryException $e) {			
			report($e);			
			return 'error';	
		}
    }



    public function send_formulario(Request $request){	
    	$input = $request->all();	
		$formulario="".$input["formulario"];
        $perfil="".$input["perfil"];

        $arra_formulario=explode("@breaklinea@",$formulario);

        $controller = new AdminController();
        $arra_data=$controller->VerificarSesid();

        $IdUsuario=$arra_data[0]->IdUsuario;
        DB::beginTransaction();

       
        try {
            for($i=0;$i<count($arra_formulario);$i++){
                $arra_detail=explode("::",$arra_formulario[$i]);
                $IdPregunta=$arra_detail[0];
                $sql="SELECT * FROM tbl_pregunta WHERE IdPregunta={$IdPregunta} limit 1";
                $result_preguntas=DB::select($sql);

                if($result_preguntas[0]->IdTipoPregunta=="1"){
                    $IdRespuesta=$arra_detail[1];
                    $sql="INSERT INTO tbl_respuesta_usuario SET IdRol={$perfil} , IdUsuario={$IdUsuario}, IdPregunta={$IdPregunta}, IdRespuesta={$IdRespuesta}";
                    $result=DB::insert($sql);
                }

                if($result_preguntas[0]->IdTipoPregunta=="2"){
                    $respuestas=$arra_detail[1];

                    $arra_detail_respuestas=explode("|||",$respuestas);

                    for($j=0;$j<count($arra_detail_respuestas);$j++){
                        $IdRespuesta=$arra_detail_respuestas[$j];
                        


                        if(!preg_match('/otro/i', $IdRespuesta)){
                            $sql="INSERT INTO tbl_respuesta_usuario SET IdRol={$perfil} , IdUsuario={$IdUsuario}, IdPregunta={$IdPregunta}, IdRespuesta={$IdRespuesta}";
                            $result=DB::insert($sql);
                        }else{
                            $respuesta=addslashes($IdRespuesta);
                            $sql="INSERT INTO tbl_respuesta_usuario SET IdRol={$perfil} , IdUsuario={$IdUsuario}, IdPregunta={$IdPregunta}, ValorRespuesta='{$respuesta}'";
                            $result=DB::insert($sql);
                        }                

                    }

                    
                }

                if($result_preguntas[0]->IdTipoPregunta=="3"){
                    $respuesta=addslashes($arra_detail[1]);
                    $sql="INSERT INTO tbl_respuesta_usuario SET  IdRol={$perfil} , IdUsuario={$IdUsuario}, IdPregunta={$IdPregunta}, ValorRespuesta='{$respuesta}'";
                    $result=DB::insert($sql);
                }

                if($result_preguntas[0]->IdTipoPregunta=="4"){
                    $respuesta=addslashes($arra_detail[1]);
                    $sql="INSERT INTO tbl_respuesta_usuario SET  IdRol={$perfil} , IdUsuario={$IdUsuario}, IdPregunta={$IdPregunta}, ValorRespuesta='{$respuesta}'";
                    $result=DB::insert($sql);
                }

            }
        } catch (\Illuminate\Database\QueryException $e) {			
			report($e);			
            DB::rollBack();
			return response()->json(["status"=>'error',"mensaje"=>"Error en el servidor, pruebe más tarde"]);
		}

        /**
         * IdEstadoSolcitudAfiliado
         * IdEstadoSolicitudTutor
        */

        if($perfil=="3"){
            try{
                $sql="UPDATE tbl_usuario SET  IdEstadoSolicitudAfiliado=2 WHERE IdUsuario={$IdUsuario}";
                $result=DB::update($sql);
            } catch (\Illuminate\Database\QueryException $e) {			
                report($e);			
                DB::rollBack();
                return response()->json(["status"=>'error',"mensaje"=>"Error en el servidor, pruebe más tarde"]);
            }
        }        
        if($perfil=="2"){
            try{
                $sql="UPDATE tbl_usuario SET  IdEstadoSolicitudTutor=2 WHERE IdUsuario={$IdUsuario}";
                $result=DB::update($sql);
            } catch (\Illuminate\Database\QueryException $e) {			
                report($e);		
                DB::rollBack();	
                return response()->json(["status"=>'error',"mensaje"=>"Error en el servidor, pruebe más tarde"]);
            }
        }

        DB::commit();

        return response()->json(["status"=>'ok',"mensaje"=>"El formulario ha sido enviado con éxito. Este proceso puede demorar entre 24 a 48 Horas."]);

    }

    public function get_formulario_by_usuario(Request $request){

        $input = $request->all();	
		$IdUsuario="".$input["IdUsuario"];
        $perfil="".$input["perfil"];
        $result_evaluacion="";
        try{
            $sql="  SELECT ru.*, 
                    (SELECT NombrePregunta from tbl_pregunta where IdPregunta=ru.IdPregunta)as NombrePregunta,
                    (SELECT NombreRespuesta from tbl_respuesta where IdRespuesta=ru.IdRespuesta)as NombreRespuesta
                    FROM tbl_respuesta_usuario ru
                    WHERE ru.IdUsuario={$IdUsuario} AND IdRol={$perfil}";
            $result_evaluacion=DB::select($sql);
        } catch (\Illuminate\Database\QueryException $e) {			
            report($e);		         
            return response()->json(["status"=>'error',"mensaje"=>"Error en el servidor, pruebe más tarde"]);
        }

        return response()->json(["status"=>'ok',"datos"=>$result_evaluacion]);

    }

}