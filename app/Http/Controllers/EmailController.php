<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;
use App\Quotation;
use Illuminate\Support\Facades\Mail;
use App\Mail\RecuperarPassword;
use App\Mail\Bienvenida;
use App\Mail\RespuestaSolicitud;
use App\Mail\Soporte;
use App\Mail\MensajeCompra;




class EmailController extends Controller
{


    public function enviar_mensaje_recuperacion($objDemo){
        Mail::to($objDemo->email_para)->send(new RecuperarPassword($objDemo));
    }

    public function enviar_mensaje_bienvenida($objDemo){
        Mail::to($objDemo->email_para)->send(new Bienvenida($objDemo));
    }

    public function enviar_mensaje_respuesta($objDemo){
        Mail::to($objDemo->email_para)->send(new RespuestaSolicitud($objDemo));
    }

    public function enviar_mensaje_soporte($objDemo){
        Mail::to($objDemo->email_para)->send(new Soporte($objDemo));
    }

    public function enviar_mensaje_compra($objDemo){
        Mail::to($objDemo->email_para)->send(new MensajeCompra($objDemo));
    }

	
}
