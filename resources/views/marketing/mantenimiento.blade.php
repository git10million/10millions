<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;
use App\Quotation;
$id_pagina="index";

$curso_controller = new CursoController();
$arra_categoria=$curso_controller->get_categorias(1);
$arra_subcategorias=$curso_controller->get_subcategorias(1);

$arra_cursos = $curso_controller->get_cursos_persona("","","","","","","1","8");

?>

@extends('marketing.plantilla.plantillamantenimiento')

@section('cabecera')

@stop

@section('contenido')   
    <div class="col-md-12 align-middle" style="text-align: center; padding-top:25%;">
        <img src="https://docttus.com/assets-marketing/images/nuevo_logo_docttus.png" style="width: 310px;">
        <h1 style="color: #fff;">Muy Pronto estaremos en línea</h1>
    </div>
@stop

@section('scripts')


@stop



