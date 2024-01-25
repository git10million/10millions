<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;
use App\Quotation;

$curso_controller = new CursoController();

$arra_supercategoria=$curso_controller->get_supercategorias();
$arra_categoria=$curso_controller->get_categorias();
$arra_subcategorias=$curso_controller->get_subcategorias();

$url_get_pag=@$_REQUEST["pag"];

$url_get_sub=@$_REQUEST["subcat"];
$url_get_tut=@$_REQUEST["tutor"];

$url_get_key=@$_REQUEST["key"];
$url_get_sesid=@$_REQUEST["sesid_k"];
$url_get_order=@$_REQUEST["order"];
$url_get_destacados=@$_REQUEST["dest"];

$url_limit="";
$url_tutor="";


if(!isset($usuario_afiliado)){
	$usuario_afiliado="";
}

if($id_pagina=="index"){

}

$url_forms="cursos-docttus";

if($id_pagina=="categoria"){
	$url_get_sub=$url_categoria;
	$url_forms="categoria/{$url_get_sub}";
}

if($id_pagina=="subcategoria"){
	$url_get_sub=$url_categoria;
	$url_forms="subcategoria/{$url_get_sub}";
}



if($id_pagina=="tutores"){
	$url_get_sub="";
	$url_forms="tutor/{$url_get_sub}";
	$url_tutor="".$tutor[0]->IdUsuario;
}


/*$sesid_usuario=null,
$slug_curso=null,
$pag=null,$subcat=null,
$key=null,$order=null,
$destacado=null,
$limit=null,
$idtutor=null,
$estadocurso='1',
$CodigoCurso=null,
$IdCurso=null,
$IdUsuarioCompra=null*/
//TODO - Revisar funciones de Categorias, Subcategorias
$arra_cursos = $curso_controller->get_cursos_persona("","",$url_get_pag,$url_get_sub,$url_get_key,$url_get_order,$url_get_destacados,$url_limit,$url_tutor);

$arra_cursos_recientes = $curso_controller->get_cursos_persona("","","",$url_get_sub,"","1","","3");

?>        
<div class="row" style="margin-top: 45px; margin-bottom: 45px;">

			@if($id_pagina!="tutores")
				<div class="col-md-3">					

					<!-- INICIO BUSCAR -->
					<form action="{{url('')}}/{{$url_forms}}" method="get" id="form_searh">

						
						<div class="input-group mb-3 contenedor-busqueda-filtro">
						  <input type="text" class="form-control" value="{{$url_get_key}}" placeholder="" aria-describedby="basic-addon2" name="key">
						  <div class="input-group-append">
						    <span class="input-group-text" id="btnsearchfiltro">
						    	<i class="fa fa-search" aria-hidden="true"></i>
						    </span>
						  </div>
						</div>
						
					
					<!-- FIN BUSCAR -->
					
					

					<div class="listado-categorias">
						<h4>Categorías</h4>
						
						
						@foreach ($arra_supercategoria as $itemSuper)
						<br />
						<h5 style="background-color:#907238; border-radius:15px; padding:5px 7px; color:#fff; ">{{$itemSuper->NombreSuperCategoria}}</h5>
						
							<div class="accordion" id="accordionExample">						
								<ul class="list-group list-group-flush">
									@foreach($arra_categoria as $categoria)

										@if($categoria->IdSupercategoria == $itemSuper->IdSuperCategoria )

										
										<li class="list-group-item" style="font-size: 13px; background-color: transparent;">
											<button type="button" data-toggle="collapse" data-target="#collapse_{{$categoria->IdCategoriaCursos}}" aria-expanded="true" aria-controls="collapse_{{$categoria->IdCategoriaCursos}}" style="width: 100%;text-align: left;background: transparent; border: none;">
												<img style="width: 20px; filter: invert(100%); margin-right: 7px; margin-top: -5px;" src="{{url('')}}/assets-marketing/categorias/{{$categoria->ImagenCategoria}}"  onerror="this.src='{{url('')}}/assets-marketing/categorias/next.png';"  > {{$categoria->NombreCategoria}}
											</button>
											
											<div id="collapse_{{$categoria->IdCategoriaCursos}}" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
												
												<ul class="list-group list-group-flush" style="margin-top: 5px;  background-color: transparent;">
													@foreach($arra_subcategorias as $subcat)
													@if($subcat->IdCategoria==$categoria->IdCategoriaCursos)
													<li class="list-group-item" style=" font-size: 12px; background-color: #0b558621;  padding-left: 20px;">
														<a style="text-decoration: none; color: #000;" href="{{url('')}}/subcategoria/{{$subcat->SlugSubcategoria}}">
															<img style="width: 16px; filter: invert(100%); margin-right: 3px; margin-top: -2px;" src="{{url('')}}/assets-marketing/categorias/{{$subcat->IconoSucategoria}}"  onerror="this.src='{{url('')}}/assets-marketing/categorias/next.png';" > {{$subcat->NombreSubcategoria}}		
														</a>
													</li>	
													@endif
													@endforeach
												</ul>
											</div>
											
										</li>
										@endif
									@endforeach						
									</ul>
								</div>							
						@endforeach


					</div>


					
					


				</div>

				@endif

				@if($id_pagina!="tutores")
				<div class="col-md-9">
				@else
				<div class="col-md-12">
				@endif
					@if($id_pagina!="tutores")
					<div class="row">
						<div class="col-md-8">
							Mostrando 1-{{count($arra_cursos)}} de {{count($arra_cursos)}} resultados
						</div>
						<div class="col-md-4">							
								<select class="form-control select-formularios" id="fi_ordern" name="order">
									<option value="">Orden</option>
									<option value="1">Fecha Creación Asc</option>
									<option value="2">Calificación Asc</option>
									<option value="3">Calificación Desc</option>
									<option value="4">Precio Bajo</option>
									<option value="5">Precio Alto</option>
								</select>
							
						</div>
					</div>
					@endif

					</form>

					<div class="row" style=" margin-top: 45px;" id="listado_cursos">

						@foreach($arra_cursos as $curso)

						@if($curso->SeccionCurso!="1")
							@php 
								continue;
							@endphp
						@endif

						<?php
							$valor_anterior=$curso->PrecioCurso;
							$valor_curso_actual=$curso->PrecioCurso;
							$descuento_curso=$curso->DescuentoCurso;
							$porcentaje_curso=0;

							
							$valor_curso_actual=$valor_curso_actual-($valor_curso_actual*($descuento_curso/100));
							$porcentaje_curso=$descuento_curso;

							if(!$descuento_curso){
								$valor_anterior=0;
							}

							if($curso->ValorImpuesto){
								$valor_curso_actual=$valor_curso_actual+($valor_curso_actual*($curso->ValorImpuesto/100));
								$valor_anterior=$valor_anterior+($valor_anterior*($curso->ValorImpuesto/100));
							}

							$valor_curso_actual=number_format($valor_curso_actual, 2);

						?>

						<!-- fin tarjeta curso -->
						@if($id_pagina!="tutores")
						<div class="col-md-4 contenedor-tarjeta-curso">
						@else
						<div class="col-md-3 contenedor-tarjeta-curso">
						@endif
							<div class="tarjeta-curso">

								<a href="#" class="trigger_modal" code_curso="{{$curso->IdCurso}}" >
									<div class="imagen-curso" style="background-image: url({{url('')}}/assets/images/cursos/{{$curso->ImagenCurso}});">

										<img src="{{url('')}}/assets-marketing/images/player_icono.png" class="icono-player">
										<div class="container-precio">
											<span><small>US</small> $ {{$valor_curso_actual}} </span>
										</div>
									</div>
								</a>

								<div class="info-curso" style="width: 100%; text-align: left; padding-left: 10px; padding-right: 10px;">									
									<table>
										<tr>
											<td><span style="font-size: 32px;color: #28e4c5; margin-right: 12px;">•</span></td>
											<td style="font-weight: 300; font-size: 14px;">{{$curso->NombreSubcategoria}}</td>
										</tr>
									</table>

									<h3>
										<a href="{{url('')}}/c/{{$curso->SlugCurso}}">{{$curso->NombreCurso}}</a>
									</h3>

									<div class="row" style="margin-top: 25px; font-size: 12px; ">
										<div class="col-6">
											<i class="fa fa-file" aria-hidden="true"></i>  {{$curso->cantidad_lecciones}} Lecciones
										</div>

										<div class="col-6">
											<i class="fa fa-users" aria-hidden="true"></i>  {{$curso->cantidad_estudiantes}}
										</div>
									</div>

									<hr style="margin-top: 35px;">

									<?php

										$arra_reviews=$curso->reviews;
										$cant_reviews=count($arra_reviews);
										$promedio_reviews_curso=5;
										$suma_valor_reviews=0;
										
										if($cant_reviews>0){
											for($r=0;$r<$cant_reviews;$r++){
												$suma_valor_reviews+=$arra_reviews[$r]->ValorCalificacion;											
											}
											$promedio_reviews_curso=$suma_valor_reviews/$cant_reviews;	
										}
										

									?>
									
									<div class="row" style="margin-top: 25px;">
										<div class="col-6">
											<?php
											for($e=1;$e<=5;$e++){

												if($promedio_reviews_curso>=$e){

													echo('<i class="fa fa-star estrella" aria-hidden="true"></i>');
													
													
												}else{
													echo('<i class="fa fa-star-o estrella" aria-hidden="true"></i>');
												}
											
											}



											?>
											
										</div>										
										<div class="col-6" style="text-align: right; margin-top: -10px;">
											<a class="btn-docttus-curso" href="{{url('')}}/c/{{$curso->SlugCurso}}{{($usuario_afiliado)? "/".$usuario_afiliado : ""}}"><i class="fa fa-arrow-right" aria-hidden="true"></i></a>
										</div>
									</div>

								</div>
							</div>
						</div>
						<!-- fin tarjeta curso -->		
						@endforeach	


					</div>
					
				</div>
			</div>





	<!-- Modal -->
	<div class="modal fade" id="modal-curso" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"  style="z-index: 9999999999;">
	  <div class="modal-dialog modal-lg  modal-dialog-centered" role="document">
	    <div class="modal-content">	      
	      <div class="modal-body">

	      	<a href="#" class="btn-cerrar-popup"  data-dismiss="modal" ><i class="fa fa-times" aria-hidden="true"></i></a>

	        <div class="row">
	        	<div class="col-md-12">
	        		<div class="embed-responsive embed-responsive-16by9" id="video_curso_modal">					  	
					</div>
	        	</div>
	        </div>

	        <div class="row" style="margin-top: 25px;">
	        	<div class="col-md-7 contenido-ficha-curso-modal">
	        		<h3 id="mod_titulo_curso"></h3>
	        		<small>Por: </small><span id="nombre_tutor"></span><br />
	        		<small style="background-color: #17cfd23b;      padding: 2px 10px; border-radius: 11px; margin-top: 5px; display: inline-block; color: #0b5586;"><strong id="nombre_subcategoria"></strong></small>

	        		<p style="    font-size: 12px; text-align: justify; line-height: 16px; margin-top: 15px;" id="descripcion_curso"></p>
	        		<a href="#" class="btn btn-sm btn-success" id="btn_ver_mas_curso" style="color: #fff !important; background-color: #17cfd2; border-color: #17d2cf;    border-radius: 25px !important; height: 29px;">
	        			Más Información
	        		</a>
	        	</div>

	        	<div class="col-md-5  contenido-ficha-curso-modal">
	        		<a href="#" id="btn_checkout" class="btn btn-info btn-lg" style="width: 100%;"><i class="fa fa-shopping-cart" aria-hidden="true"></i> COMPRAR USD $<span id="valor_modal_curso"></span> </a>
 					<small id="contenedor_descuento_modal" style="background-color: #17cfd23b;      padding: 2px 10px; border-radius: 11px; margin-top: 5px; display: inline-block;"><span id="modal_descuento_curso"></span>% Dto. US <strong id="modal_precio_anterior" style="text-decoration: line-through;"> $2.000 </strong></small>

					<br/><br/>

					<i class="fa fa-users" aria-hidden="true"></i> <small> <span id="modal_cantidad_estudiantes"></span> Estudiantes</small><br/>
					<i class="fa fa-file" aria-hidden="true"></i> <small> <span id="modal_cantidad_lecciones"></span> Lecciones</small><br/>
					<i class="fa fa-clock-o" aria-hidden="true"></i> <small> <span id="modal_cantidad_horas"></span> Horas de Estudio</small><br/>
					<i class="fa fa-language" aria-hidden="true"></i> <small> Idioma Español</small><br/>
					<i class="fa fa-star" aria-hidden="true"></i> <small> <span id="modal_cantidad_resenas"></span> Reseñas (Ver)</small>


	        	</div>
	        </div>
	      </div>	     
	    </div>
	  </div>
	</div>

@section('scripts')
	<script type="text/javascript">
	var subcategoria_sel="";
	var categoria_sel="";
	var arra_cursos_fil=new Object();

	var arra_cursos=new Object();

	$("#fi_ordern").val("{{$url_get_order}}");

	$("#btnsearchfiltro").click(function(e){
		$("#form_searh").submit();
	});

	$("#fi_ordern").change(function(e){
		$("#form_searh").submit();
	});

	
	
	


	arra_cursos=[

		@foreach($arra_cursos as $curso)
			{

				<?php
				$curso->DescripcionTutor = trim(preg_replace('/\s\s+/', ' ', $curso->DescripcionTutor));
				$curso->DescripcionCurso = trim(preg_replace('/\s\s+/', ' ', $curso->DescripcionCurso));

				if(strlen($curso->DescripcionCurso)>=350){
					$curso->DescripcionCurso=substr($curso->DescripcionCurso,0,350)."...";
				}

				$valor_anterior=$curso->PrecioCurso;
				$valor_curso_actual=$curso->PrecioCurso;
				$descuento_curso=$curso->DescuentoCurso;
				$porcentaje_curso=0;

				
				$valor_curso_actual=$valor_curso_actual-($valor_curso_actual*($descuento_curso/100));
				$porcentaje_curso=$descuento_curso;

				if(!$descuento_curso){
					$valor_anterior=0;
				}


				if($curso->ValorImpuesto){
					$valor_curso_actual=$valor_curso_actual+($valor_curso_actual*($curso->ValorImpuesto/100));
					$valor_anterior=$valor_anterior+($valor_anterior*($curso->ValorImpuesto/100));
				}

				$valor_curso_actual=number_format($valor_curso_actual, 2);

				

				$arra_reviews=$curso->reviews;
				$cant_reviews=count($arra_reviews);
				
				?>

				"IdCurso":`{{$curso->IdCurso}}`,
				"NombreCurso":`{{$curso->NombreCurso}}`,
				"DescripcionCurso":`{!!strip_tags($curso->DescripcionCurso)!!}`,
				"SlugCurso":`{{$curso->SlugCurso}}`,
				"IdEstado":`{{$curso->IdEstado}}`,
				"IdTipoCurso":`{{$curso->IdTipoCurso}}`,
				"FechaCreacion":`{{$curso->FechaCreacion}}`,
				"FechaModificacion":`{{$curso->FechaModificacion}}`,
				"TituloCurso":`{{$curso->TituloCurso}}`,
				"ImagenCurso":`{{$curso->ImagenCurso}}`,
				"CodigoCurso":`{{$curso->CodigoCurso}}`,
				"NombreTutor":`{{$curso->NombreTutor}}`,
				"cantidad_estudiantes":`{{$curso->cantidad_estudiantes}}`,
				"DescripcionTutor":`{!!strip_tags($curso->DescripcionTutor)!!}`,
				"FotoTutor":`{{$curso->FotoTutor}}`,
				"VideoCurso":`{!!$curso->VideoCursoEmbed!!}`,
				"TipoVideo":`{!!$curso->TipoVideo!!}`,
				"AprenderasCurso":`{{$curso->AprenderasCurso}}`,
				"TestimoniosCurso":`{{$curso->TestimoniosCurso}}`,
				"IdSubcategoria":`{{$curso->IdSubcategoria}}`,
				"IdDestacado":`{{$curso->IdDestacado}}`,
				"NombreSubcategoria":`{{$curso->NombreSubcategoria}}`,
				"cantidad_modulos":`{{$curso->cantidad_modulos}}`,
				"cantidad_lecciones":`{{$curso->cantidad_lecciones}}`,
				"cantidad_horas":`{{$curso->cantidad_horas}}`,
				"ValorPrecioProducto":`{{$valor_curso_actual}}`,
				"DescuentoCurso":`{{$descuento_curso}}`,
				"ValorPrecioAnterior":`{{$valor_anterior}}`,
				"cant_reviews":`{{$cant_reviews}}`,
				"PrecioCurso":`{{$curso->PrecioCurso}}`,
			},
		@endforeach

	];

	function filtro_curso(){
		
		
	}

	$(".trigger_modal").click(function(e){		
		e.preventDefault();
		var elemento_curso_sel=e.currentTarget;
		var codigo_elemento_sel=$(elemento_curso_sel).attr("code_curso");		
		abrir_modal_curso(codigo_elemento_sel);
	});

	var cant_clicl=0;
	function abrir_modal_curso(id_curso){

		var index_curso=get_index_curso(id_curso);
		if(index_curso>-1){

			cant_clicl++;
			$("#mod_titulo_curso").html(""+arra_cursos[index_curso].NombreCurso);	
			$("#nombre_tutor").html(""+arra_cursos[index_curso].NombreTutor);	
			$("#nombre_subcategoria").html(""+arra_cursos[index_curso].NombreSubcategoria);
			$("#descripcion_curso").html(""+arra_cursos[index_curso].DescripcionCurso);
			$("#btn_ver_mas_curso").attr("href","{{url('')}}/c/"+arra_cursos[index_curso].SlugCurso+'{{($usuario_afiliado)? "/".$usuario_afiliado : ""}}');
			
			var embed_video=arra_cursos[index_curso].VideoCurso;
			embed_video=embed_video.replace("player_video","player_video_"+arra_cursos[index_curso].IdCurso+"_"+cant_clicl);

			$("#video_curso_modal").html(""+embed_video);

			if(arra_cursos[index_curso].TipoVideo=="1"){
				var player = videojs("player_video_"+arra_cursos[index_curso].IdCurso+"_"+cant_clicl);
			}
			
			
			$("#valor_modal_curso").html(""+arra_cursos[index_curso].ValorPrecioProducto);			
			$("#modal_descuento_curso").html(""+arra_cursos[index_curso].DescuentoCurso);
			$("#modal_precio_anterior").html(""+arra_cursos[index_curso].ValorPrecioAnterior);			
			$("#modal_cantidad_estudiantes").html(""+arra_cursos[index_curso].cantidad_estudiantes);
			$("#modal_cantidad_lecciones").html(""+arra_cursos[index_curso].cantidad_lecciones);
			$("#modal_cantidad_horas").html(""+arra_cursos[index_curso].cantidad_horas);
			$("#modal_cantidad_resenas").html(""+arra_cursos[index_curso].cant_reviews);

			

			$("#btn_checkout").attr("href","{{url('')}}/c/"+arra_cursos[index_curso].SlugCurso+'{{($usuario_afiliado)? "/".$usuario_afiliado : ""}}');

			if(parseInt(arra_cursos[index_curso].DescuentoCurso)!=0){
				$("#contenedor_descuento_modal").show();
			}else{
				$("#contenedor_descuento_modal").hide();
			}

		}
		$("#modal-curso").modal("show");
	}

	function get_index_curso(id_curso){
		for(var i=0;i<arra_cursos.length;i++){
			if(arra_cursos[i].IdCurso==id_curso){
				return i;
			}
		}
		return -1;
	}

	//CERRAR MODAL -  EVENTO
	$('#modal-curso').on('hidden.bs.modal', function (e) {	  
	  $("#video_curso_modal").html("");	  
	});



	</script>
@stop