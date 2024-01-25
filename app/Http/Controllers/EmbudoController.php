<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Quotation;
use Exception;
use Vimeo\Vimeo;
use Vimeo\Exceptions\VimeoUploadException;



class EmbudoController extends Controller
{

	public function EmbudoLanding(){
        return view('marketing.embudo.landing',[            
            "id_pagina"=>"evento",
            "slug_evento"=>""
        ]);
    }

    public function EmbudoGracias(){
        return view('marketing.embudo.gracias',[ 
            "id_pagina"=>"evento",
            "slug_evento"=>""
        ]);
    }

    public function EmbudoLecciones(){
        return view('marketing.embudo.lecciones',[ 
            "id_pagina"=>"evento",
            "slug_evento"=>""
        ]);
    }


    public function EmbudoWebinar(){

    }

    public function EmbudoVideo($url_leccion){
        $id_video="";
        $titulo_video="";
        $codigo_video="";
        if($url_leccion=="lc-1"){
            $id_video="1";
            $titulo_video="Los secretos claves para triunfar en el marketing de afiliados";
            $codigo_video="KF2XdHTlcJ8";
        }
        if($url_leccion=="lc-2"){
            $id_video="2";
            $titulo_video="Las 3 formas de Emprender en el Marketing de Afiliados";
            $codigo_video="cNpx0A1RL2o";
        }
        if($url_leccion=="lc-3"){
            $id_video="3";
            $titulo_video="Caso de estudio para descubrir productos ganadores con el marketing de afiliados";
            $codigo_video="GS8MxWPca2g";
        }
        if($url_leccion=="lc-4"){
            $id_video="4";
            $titulo_video="El combustible necesario para generar ingresos online.";
            $codigo_video="BgEWkmUX1q8";
        }
        return view('marketing.embudo.videos',[ 
            "id_pagina"=>"video",
            "id_video"=>"{$id_video}",
            "codigo_video"=>"{$codigo_video}",
            "titulo_video"=>"{$titulo_video}",
            "slug_leccion"=>"{$url_leccion}"            
        ]);
    }



    public function RegistroLead(Request $request){
    	$input = $request->all();	   	
    	$nombre_prospecto="".$input["nombre"];
    	$email_prospecto="".$input["email"];

        $groupsApi = (new \MailerLiteApi\MailerLite('fe7552f2b3b4020f4610a5b492ee890d'))->groups();

        $subscriber = [
            'email' => $email_prospecto,
            'fields' => [
                'name' => $nombre_prospecto
            ]
        ];
        $response = $groupsApi->addSubscriber("109540754", $subscriber); 
        return response()->json(["status"=>'ok',"mensaje"=>"El mensaje ha sido enviado correctamente, estaremos en contacto contigo lo más pronto posible"]);

    }
}

