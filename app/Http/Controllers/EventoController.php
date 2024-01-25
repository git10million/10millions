<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Quotation;
use Exception;


class EventoController extends Controller
{
    public function evento($slug_evento){        

        return view('marketing.evento',[            
            "id_pagina"=>"evento",
            "slug_evento"=>$slug_evento
        ]);
    }

    public function gracias($slug_evento){        

        return view('marketing.evento-gracias',[            
            "id_pagina"=>"evento",
            "slug_evento"=>$slug_evento
        ]);

    }


    public function eventodocttus($slug_evento){
        $controller = new AdminController();
        $arra_data=$controller->VerificarSesid();

		$controller_curso = new CursoController();
		$controller_billetera=new BilleteraController();

		if(count($arra_data)==0){
			return view('areacurso.notienespermiso');
		}else{
			$notificaciones=$controller->get_notificaciones($arra_data[0]->IdUsuario);
			$historial_lecciones=$controller->get_historial_lecciones($arra_data[0]->IdUsuarioPersona,"3");
			//GET HABILIDADES ACTUALES
			$habilidades=$controller_curso->get_habilidades('',$arra_data[0]->IdUsuarioPersona,'');
			//GET VENTAS
			$info_ventas=$controller->get_ventas($arra_data[0]->IdUsuarioPersona);
			//GET DATOS BILLETERA
			$info_billetera=$controller_billetera->get_billetera($arra_data[0]->IdUsuarioPersona);

			return view('areacurso.evento-docttus',[
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

    public function crashingpro(){
        $controller = new AdminController();
        $arra_data=$controller->VerificarSesid();

		$controller_curso = new CursoController();
		$controller_billetera=new BilleteraController();

		if(count($arra_data)==0){
			return view('areacurso.notienespermiso');
		}else{
			$notificaciones=$controller->get_notificaciones($arra_data[0]->IdUsuario);
			$historial_lecciones=$controller->get_historial_lecciones($arra_data[0]->IdUsuarioPersona,"3");
			//GET HABILIDADES ACTUALES
			$habilidades=$controller_curso->get_habilidades('',$arra_data[0]->IdUsuarioPersona,'');
			//GET VENTAS
			$info_ventas=$controller->get_ventas($arra_data[0]->IdUsuarioPersona);
			//GET DATOS BILLETERA
			$info_billetera=$controller_billetera->get_billetera($arra_data[0]->IdUsuarioPersona);

			return view('areacurso.crashing-pro',[
							"data"=>$arra_data,
							"titulo_pagina"=>'Crashing Pro 10X', 
							"notificaciones"=>$notificaciones,
							"historial_lecciones"=>$historial_lecciones,
							"habilidades"=>$habilidades,
							"info_ventas"=>$info_ventas,
							"info_billetera"=>$info_billetera,
							"menu"=>"inicio"
						]);
		}
    }

	public function minisite(){
        $controller = new AdminController();
        $arra_data=$controller->VerificarSesid();

		$controller_curso = new CursoController();
		$controller_billetera=new BilleteraController();

		if(count($arra_data)==0){
			return view('areacurso.notienespermiso');
		}else{
			$notificaciones=$controller->get_notificaciones($arra_data[0]->IdUsuario);
			$historial_lecciones=$controller->get_historial_lecciones($arra_data[0]->IdUsuarioPersona,"3");
			//GET HABILIDADES ACTUALES
			$habilidades=$controller_curso->get_habilidades('',$arra_data[0]->IdUsuarioPersona,'');
			//GET VENTAS
			$info_ventas=$controller->get_ventas($arra_data[0]->IdUsuarioPersona);
			//GET DATOS BILLETERA
			$info_billetera=$controller_billetera->get_billetera($arra_data[0]->IdUsuarioPersona);

			return view('areacurso.minisite',[
							"data"=>$arra_data,
							"titulo_pagina"=>'minisite', 
							"notificaciones"=>$notificaciones,
							"historial_lecciones"=>$historial_lecciones,
							"habilidades"=>$habilidades,
							"info_ventas"=>$info_ventas,
							"info_billetera"=>$info_billetera,
							"menu"=>"inicio"
						]);
		}
    }


	public function fomolist(){
		$controller = new AdminController();
        $arra_data=$controller->VerificarSesid();

		$controller_curso = new CursoController();
		$controller_billetera=new BilleteraController();

		if(count($arra_data)==0){
			return view('areacurso.notienespermiso');
		}else{
			$notificaciones=$controller->get_notificaciones($arra_data[0]->IdUsuario);
			$historial_lecciones=$controller->get_historial_lecciones($arra_data[0]->IdUsuarioPersona,"3");
			//GET HABILIDADES ACTUALES
			$habilidades=$controller_curso->get_habilidades('',$arra_data[0]->IdUsuarioPersona,'');
			//GET VENTAS
			$info_ventas=$controller->get_ventas($arra_data[0]->IdUsuarioPersona);
			//GET DATOS BILLETERA
			$info_billetera=$controller_billetera->get_billetera($arra_data[0]->IdUsuarioPersona);

			return view('areacurso.fomolist',[
							"data"=>$arra_data,
							"titulo_pagina"=>'minisite', 
							"notificaciones"=>$notificaciones,
							"historial_lecciones"=>$historial_lecciones,
							"habilidades"=>$habilidades,
							"info_ventas"=>$info_ventas,
							"info_billetera"=>$info_billetera,
							"menu"=>"inicio"
						]);
		}
	}
	public function fomo(){
        $controller = new AdminController();
        $arra_data=$controller->VerificarSesid();

		$controller_curso = new CursoController();
		$controller_billetera=new BilleteraController();

		if(count($arra_data)==0){
			return view('areacurso.notienespermiso');
		}else{
			$notificaciones=$controller->get_notificaciones($arra_data[0]->IdUsuario);
			$historial_lecciones=$controller->get_historial_lecciones($arra_data[0]->IdUsuarioPersona,"3");
			//GET HABILIDADES ACTUALES
			$habilidades=$controller_curso->get_habilidades('',$arra_data[0]->IdUsuarioPersona,'');
			//GET VENTAS
			$info_ventas=$controller->get_ventas($arra_data[0]->IdUsuarioPersona);
			//GET DATOS BILLETERA
			$info_billetera=$controller_billetera->get_billetera($arra_data[0]->IdUsuarioPersona);

			return view('areacurso.fomo',[
							"data"=>$arra_data,
							"titulo_pagina"=>'minisite', 
							"notificaciones"=>$notificaciones,
							"historial_lecciones"=>$historial_lecciones,
							"habilidades"=>$habilidades,
							"info_ventas"=>$info_ventas,
							"info_billetera"=>$info_billetera,
							"menu"=>"inicio"
						]);
		}
    }

	public function chatbot(){
        $controller = new AdminController();
        $arra_data=$controller->VerificarSesid();

		$controller_curso = new CursoController();
		$controller_billetera=new BilleteraController();

		if(count($arra_data)==0){
			return view('areacurso.notienespermiso');
		}else{
			$notificaciones=$controller->get_notificaciones($arra_data[0]->IdUsuario);
			$historial_lecciones=$controller->get_historial_lecciones($arra_data[0]->IdUsuarioPersona,"3");
			//GET HABILIDADES ACTUALES
			$habilidades=$controller_curso->get_habilidades('',$arra_data[0]->IdUsuarioPersona,'');
			//GET VENTAS
			$info_ventas=$controller->get_ventas($arra_data[0]->IdUsuarioPersona);
			//GET DATOS BILLETERA
			$info_billetera=$controller_billetera->get_billetera($arra_data[0]->IdUsuarioPersona);

			return view('areacurso.chatbot',[
							"data"=>$arra_data,
							"titulo_pagina"=>'minisite', 
							"notificaciones"=>$notificaciones,
							"historial_lecciones"=>$historial_lecciones,
							"habilidades"=>$habilidades,
							"info_ventas"=>$info_ventas,
							"info_billetera"=>$info_billetera,
							"menu"=>"inicio"
						]);
		}
    }

	

    


    public function registrar_prospecto(Request $request){
    	$input = $request->all();	   	
    	$nombre_prospecto="".$input["nombre_prospecto"];
    	$email_prospecto="".$input["email_prospecto"];
        $IdEvento="".$input["IdEvento"];


        $sql="INSERT INTO tbl_prospecto SET EmailProspecto='{$email_prospecto}',
        NombreProspecto='{$nombre_prospecto}',
        IdEstado=1,
        FechaRegistro=now(),
        IdEvento={$IdEvento},
        IdUsuario=null";
        $result=DB::insert($sql);		

        return response()->json(["status"=>'ok',"mensaje"=>"El mensaje ha sido enviado correctamente, estaremos en contacto contigo lo más pronto posible"]);
        
        
    }

   

}
