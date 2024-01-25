<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Quotation;
use Exception;

class AyudaController extends Controller
{
    //
    public function mostrarayudas(){
    	$controller = new AdminController();
    	$arra_data=$controller->VerificarSesid();
		if(count($arra_data)==0){
			return view('areacurso.notienespermiso');
		}else{
			$notificaciones=$controller->get_notificaciones($arra_data[0]->IdUsuario);
			
			return view('areacurso.ayuda',[
				"data"=>$arra_data,
				"titulo_pagina"=>'Ayuda Docttus', 
				"notificaciones"=>$notificaciones,			
				"menu"=>"ayudas"
			]);
		}    	
    }

    public function verayuda($url_data){
    	$controller = new AdminController();
    	$arra_data=$controller->VerificarSesid();
		if(count($arra_data)==0){
			return view('areacurso.notienespermiso');
		}else{
			$notificaciones=$controller->get_notificaciones($arra_data[0]->IdUsuario);
			
			return view('areacurso.ayudas.'.$url_data,[
				"data"=>$arra_data,
				"titulo_pagina"=>'Ayuda Docttus', 
				"notificaciones"=>$notificaciones,			
				"menu"=>"ayudas"
			]);
		}    	
    }

    
}
