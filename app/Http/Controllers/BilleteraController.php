<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Quotation;
use Exception;

class BilleteraController extends Controller
{
    //

    public function billetera_usuario(){
    	$controller = new AdminController();
    	$arra_data=$controller->VerificarSesid();
		if(count($arra_data)==0){
			return view('areacurso.notienespermiso');
		}else{

			//NOTIFICACIONES
			$notificaciones=$controller->get_notificaciones($arra_data[0]->IdUsuario);			
			
			//BILLETERA
			$info_billetera=$this->get_billetera($arra_data[0]->IdUsuarioPersona);

			//RETIROS
			$info_retiros=$this->get_retiros($arra_data[0]->IdUsuarioPersona);


			
			return view('areacurso.billetera',[
				"data"=>$arra_data,
				"titulo_pagina"=>'Billetera', 
				"notificaciones"=>$notificaciones,				
				"info_billetera"=>$info_billetera,
				"info_retiros"=>$info_retiros,
				"menu"=>"billetera"
			]);
		}
    }

    public function get_billetera($IdUsuarioPersona){
		$IdRol="".session('rol_login');
		$sql="SELECT * FROM tbl_billetera where IdUsuarioPersona={$IdUsuarioPersona} AND IdRol={$IdRol}";
		$result=DB::select($sql);
		return $result;	
    }

	public function get_retiros($IdUsuarioPersona){
		$IdRol="".session('rol_login');
		$sql="SELECT * FROM tbl_retiros where IdUsuarioPersona={$IdUsuarioPersona}  AND IdRol={$IdRol}";
		$result=DB::select($sql);
		return $result;			
	}

	public function set_retiro(Request $request){
		$controller = new AdminController();
		$input = $request->all();	   	
		$valorretiro="".$input["valorretiro"];
		
		$IdRol="".session('rol_login');

    	$arra_data=$controller->VerificarSesid();
		$id_usuario_persona=$arra_data[0]->IdUsuarioPersona;

		if($valorretiro<=20){
			return response()->json(["status"=>'error',"mensaje"=>"El valor del retiro no puede ser menor de $20 USD"]);
		}

		$sql="SELECT * FROM tbl_billetera WHERE IdUsuarioPersona={$id_usuario_persona} and SaldoDisponible >={$valorretiro}  AND IdRol={$IdRol}";
		$result=DB::select($sql);

		if(count($result)==0){
			return response()->json(["status"=>'error',"mensaje"=>"No tienes dinero suficiente para este retiro."]);				
		}

		
		$sql="UPDATE tbl_billetera SET SaldoDisponible=SaldoDisponible-{$valorretiro} WHERE IdUsuarioPersona={$id_usuario_persona}  AND IdRol={$IdRol}";
		$result=DB::update($sql);		

		$sql="INSERT INTO tbl_retiros SET IdUsuarioPersona={$id_usuario_persona}, ValorRetiro={$valorretiro}, IdEstadoRetiro=1, IdRol={$IdRol}";
		$result=DB::insert($sql);		

		$sql="INSERT INTO tbl_movimiento_billetera SET DescripcionMovimiento='Retiro Dinero', ValorMovimiento='{$valorretiro}',TipoMovimiento=2,IdUsuarioPersona={$id_usuario_persona}, IdRol={$IdRol}";
		$result=DB::insert($sql);		

		return response()->json(["status"=>'ok',"mensaje"=>"El retiro fue generado correctamente."]);

	}

	
}
