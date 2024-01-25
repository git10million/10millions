@extends('areacurso.plantillas.plantilla-area-interna')
@section('contenido')   

@php
	$name_process="";
	$article_process="";
	if($ProcesoItem=="modulo"){
		$name_process="módulo";
		$article_process="el ";
	}else{
		$name_process="lección";
		$article_process="la ";
	}
@endphp

<style type="text/css">

	#NombreAudio{
		display: none;
	}

	#cnv_audio{
		display: inline-block;
		border: 1px solid #ccc;
		margin: 15px;
		border-radius: 50px;
		padding: 5px;
	}

	.descripcion-curso{
		height: 550px;
		overflow-y: auto;
		margin-top: 45px;
	}

	.componente_media{
		display: none;
		padding: 10px;
		border-radius: 9px;
		border:1px solid #ccc;
		background-color: #f5f5f5;
	}

	.contenedor-principal{
	/*background-color: #fff;*/
	}
	
	.etiqueta-curso{
		position: absolute;
		top: 0px;
		font-size: 11px;
		color: #fff;    
		padding: 2px 18px;
		border-radius: 0px 0px 8px 8px;
		left: 14px;
	}

	.btn-group-toggle a{
		text-decoration: none;
		color: #fff;
	}

	.class-embed{
		display:none;
	}  
  


	.btn-titulo{
		font-size: 21px;
		color:#9a9a9a;
	}

	.btn-menu-leccion::before {
		display: none !important;
	}

	.btn-item-contenido{
		width: 100%;
		height: 95px;
		margin-bottom: 15px;
	}

	.btn-item-contenido:hover{
		background-color: #0cbae8;      
	}

	.btn-item-contenido i{
		font-size: 25px;
		color: #bfbfbf;
	}

	.btn-item-contenido div{
		font-size: 18px;
		color: #bfbfbf;
	}

	.btn-item-contenido:hover i{
		color:#fff;
	}

	.btn-item-contenido:hover div{
		color:#fff;
	}

	.btn-item-contenido-active{
		background-color: #0cbae8;      
	}

	.btn-item-contenido-active i{    
		color: #fff;
	}

	.btn-item-contenido-active div{    
		color: #fff;
	}  

	.list-group-item{
        cursor:move;
    }

</style>

<form id="form-editar-curso"> 
	<button type="submit" style="display: none;" id="btn_enviar_form_generico"></button>

	<div class="container" style="padding-top: 35px;">

		@component('areacurso.componentes.menu-admin-cursos')

			@slot('CodigoCurso')
				{{$curso->CodigoCurso}}
			@endslot

			@slot('url_form')
				{{$url_form}}
			@endslot     

			@slot('SlugCurso')
				{{$curso->SlugCurso}}
			@endslot   

			@slot('NombreUsuario')      
			{{$data[0]->NombreUsuario}}
			@endslot   
		@endcomponent
	
		<div class="row my-xl-5 my-3">

			

			<div class="col-md-9">				
				<h4>
					@if(!$IdItem)
						@if($ProcesoItem=="modulo") 
							Nuevo Módulo
						@else
							Nueva Lección
						@endif
					@else
						@if($ProcesoItem=="modulo") 
							Módulo - @if($info_contenido){{$info_contenido["NombreItem"]}}@endif
						@else
							Lección - @if($info_contenido){{$info_contenido["NombreItem"]}}@endif
						@endif
					@endif
				</h4>
				<small><i><strong>Curso:</strong> {{$curso->NombreCurso}}</i></small><br />
				<a style="margin-top: 15px;" class="btn btn-default" href="{{url('')}}/cursos/contenido/{{$curso->CodigoCurso}}"><i class="fa fa-hand-o-left" aria-hidden="true"></i> Atrás</a>
				
				
			</div>

			<div class="col-3">
				
				<div class="custom-control custom-switch text-right" style="padding-top:15px;">
					<input type="checkbox" class="custom-control-input" id="IdEstado" @if($info_contenido) @if($info_contenido["IdEstado"]=="1") checked  @endif @endif >
					<label class="custom-control-label" for="IdEstado" style="font-weight: 300;">Publicar</label>
				</div>
				
			</div>

			<div class="col-md-12">
				<hr>
			</div>
		</div>

				
		<div class="row">
			<div class="col-md-4">
				<h6 style="font-weight: bold;" class="my-4">Agrega información <span>descriptiva</span></h6>
				<p>Diligencia la información principal que hace parte del Módulo, incluye una descripción, determina que contenido se entregará gratuitamente, así como la duración y la fecha de lanzamiento.</p>
			</div>

			<div class="col-md-8">
				<div class="card-docttus card-docttus-left" style=" height: auto !important; position: relative;">          
					
					<div class="form-group  input-group-sm">
						<label>Título {{$name_process}} *</label> <i class="fa fa-info-circle btn-titulo" title="Incluye el nombre del módulo."></i>
						<input id="NombreItem" type="text" name="nombre" class="form-control valida-caracteres"  value="@if($info_contenido){{$info_contenido["NombreItem"]}}@endif" required maxlength="70">
						<div class="text-right">
							<small> <strong id="cant_caracteres_NombreItem">0</strong> Carácteres Restantes</small>  
						</div>
					</div>
									
					<div class="form-group  input-group-sm">
						<label>Descripción {{$name_process}} *</label> <i class="fa fa-info-circle btn-titulo" title="Incorpora una descripción del módulo. Aquí podrás señalar de manera general el contenido del módulo e incluir orientaciones u observaciones, que consideres que tus estudiantes deben saber para el desarrollo del módulo."></i>
						<textarea class="form-control valida-caracteres" id="DescripcionCortaItem" rows="5" maxlength="250" required>@if($info_contenido){{$info_contenido["DescripcionItem"]}}@endif</textarea>
						<div class="text-right">
							<small> <strong id="cant_caracteres_DescripcionCortaItem">0</strong> Carácteres Restantes</small>
						</div>
					</div>

					<div class="form-group  input-group-sm">
						<div class="form-check">
							<input @if($info_contenido) @if($info_contenido["GratisItem"]=="1") checked  @endif @endif  class="form-check-input" type="checkbox" value="" id="GratisItem">
							<label class="form-check-label" for="defaultCheck1">
							  	<strong> Contenido gratuito</strong> <i class="fa fa-info-circle btn-titulo" title="Chequea el campo para definir que este módulo será entregado al público de manera gratuita."></i>
							</label>
						</div>
					</div>

					<hr>
					<div class="form-group  input-group-sm">
						<label>Duración *</label> <i class="fa fa-info-circle btn-titulo" title="Diligencia el tiempo (Horas, minutos y segundos) que tendrá duración el módulo."></i>
						<div class="row">
							@php
								$horas = 0;
								$minutos = 0;
								$segundos = 0;
							@endphp
							@if($info_contenido)
								@php
									$duracionItem=$info_contenido["DuracionItem"];
									$horas = floor($duracionItem/ 3600);
									$minutos = floor(($duracionItem - ($horas * 3600)) / 60);
									$segundos = $duracionItem - ($horas * 3600) - ($minutos * 60);
								@endphp
							@endif
							
							<div class="col-md-2 col-4">
								<input type="number" min="0" id="HorasItem" class="form-control  text-center" value="{{$horas}}">
								<div class="text-center">
									<small>Horas</small>
								</div>
							</div>

							<div class="col-md-2 col-4">
								<input type="number" min="0" id="MinutosItem" class="form-control  text-center" value="{{$minutos}}">
								<div class="text-center">
									<small>Minutos</small>
								</div>
							</div>
							
							<div class="col-md-2 col-4">
								<input type="number" min="0" id="SegundosItem" class="form-control text-center" value="{{$segundos}}">
								<div class="text-center">
									<small>Segundos</small>
								</div>
							</div>

						</div>
					</div>
					
					


					@if($curso->IdTipoLanzamiento==2)
					<hr>
					<div class="row">

						<div class="col-md-6">

							<!-- time Picker -->
							<div class="bootstrap-timepicker">
								<div class="form-group">
								  <label>Fecha Lanzamiento:</label>  <i class="fa fa-info-circle btn-titulo" title="Escoge del calendario, la fecha en la cual se planea realizar el lanzamiento del módulo."></i>

			  
									<div class="input-group date" id="timepicker" data-target-input="nearest">
										<input type="text" class="form-control datetimepicker-input" data-target="#timepicker" id="FechaLanzamiento" value="@if($info_contenido){{$info_contenido["FechaLanzamiento"]}}@endif" />
										<div class="input-group-append" data-target="#timepicker" data-toggle="datetimepicker">
											<div class="input-group-text"><i class="fa fa-clock-o"></i></div>
										</div>
									</div>
								  <!-- /.input group -->
								</div>
								<!-- /.form group -->
							</div>

						</div>
					</div>
					@else
					<input type="hidden" id="FechaLanzamiento">
					@endif

					
					



				</div>
				<br />
				<p style="color: #adadad;">* Campos obligatorios</p>
				<p style="color: #adadad;">* NOTA: Los campos que no completes no se mostrarán en la página de inicio del curso.</p>
			</div>
		</div>


		<hr />

		@if($IdItem)
			<div class="row">
				<div class="col-md-4">
					<h6 style="font-weight: bold;" class="my-4">Contenido  {{$name_process}}</h6>
					<p>En esta sección, incluye el video, texto, imágen o audio que orientará el {{$name_process}}, dando clic en el botón</p>
				</div>

				<div class="col-md-8">        
					<div style="width: 100%;" class="text-right">
						<button type="button" class="btn btn-default" id="btn_nuevo_contenido">
							+ Contenido
						</button>
					</div>        
					<br />
					<ul  class="list-group" id="listado_ul">
						<!-- COMPONENTE LISTA ITEM MEDIA -->
						
						<!-- FIN COMPONENTE LISTA ITEM MEDIA -->

					</ul>               
				</div>
			</div>	

			<hr />

			<div class="row">
				<div class="col-md-4">
					<h6 style="font-weight: bold;" class="my-4">Archivos o Enlaces</h6>
					<p>En este segmento, incluye los archivos (Video, audio, pdf, enlaces, gráficos, tablas, etc.) adicionales que apoyan la formación del estudiante en este módulo. Para adicionar cada material, debes dar clic en el botón</p>
				</div>

				<div class="col-md-8">        
					<div style="width: 100%;" class="text-right">
						<button type="button" class="btn btn-default" id="btn_nuevo_archivo">
							+ Nuevo Archivo
						</button>
					</div>        
					<br />
					<ul  class="list-group" id="listado_archivos">
						<!-- COMPONENTE LISTA ITEM MEDIA -->
						
						<!-- FIN COMPONENTE LISTA ITEM MEDIA -->

					</ul>               
				</div>
			</div>	

		@else

		<div class="row">
			<div class="col-md-12">
				<div class="text-center alert alert-warning" role="alert" style="padding: 20px;  border-radius: 5px;  margin-top: 15px;">
					<h3 style="font-size: 17px; margin: 0px;" ><i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
						Debes guardar {{$article_process}} {{$name_process}} para habilitar la sección de contenidos</h3>
				</div>
			</div>
		</div>
		@endif





		<hr />
	</div>
	<br />
	<br />
</form>

<!-- Modal -->
<div class="modal fade" id="cambios_de_estado" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel2" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
		<div class="modal-header">
			<h5 class="modal-title" id="exampleModalLabel2">Enviar a Revisión</h5>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			<span aria-hidden="true">&times;</span>
			</button>
		</div>
		<div class="modal-body" style="text-align: center;">
			@if($curso->IdEstado==3)
			<h3>El curso entrará en proceso de revisión por parte del equipo de Docttus.</span></h3>
			<p>Este proceso podrá tomar entre 12 a 24 horas.</p>
			<h5>¿Deseas continuar con el proceso?</h5>
			@endif			
		</div>
		<div class="modal-footer" style="text-align: center; width: 100%; display: inline-block;">
			<center>
			<button type="button" class="btn btn-secondary botones-docttus" data-dismiss="modal" id="btn_estado_revision">Aceptar</button>                
			<button type="button" class="btn btn-danger" data-dismiss="modal" style="border-radius: 25px;">Cancelar</button>                  
			</center>			
		</div>
		</div>
	</div>
</div>


<!-- Modal -->
<div class="modal fade" id="NuevoContenido" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLongTitle">Nuevo Contendido</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form id="frm_media">
				<div class="modal-body">			
					
					

					<div class="row">
						<div class="col-md-12">
							<label for="">Nombre Recurso</label>
							<input type="text" class="form-control" id="NombreMedia" placeholder="Título recurso">
							<br />
							<textarea class="form-control html-paginas valida-caracteres-tinymce" id="ContenidoMedia" name="ContenidoMedia"></textarea>
						</div>
					</div>

					<hr />

					<div class="row">
						<div class="col-md-8 offset-md-2">
							<div class="row">
								<div class="col-md-3 col-6">
									<button class="btn btn-default btn-item-contenido btn-no-archivos" id="btn_tipo_media_1" type="button" onclick="click_seleccionar_tipo_media(1)">
										<i class="fa fa-file-video-o" aria-hidden="true"></i>
										<div>VIDEO</div>
									</button>
								</div>

								<div class="col-md-3 col-6">
									<button class="btn btn-default btn-item-contenido  btn-no-archivos"  id="btn_tipo_media_2" type="button" onclick="click_seleccionar_tipo_media(2)">
										<i class="fa fa-file-image-o" aria-hidden="true"></i>
										<div>IMAGEN</div>
									</button>

									<button class="btn btn-default btn-item-contenido  btn-archivos"  id="btn_tipo_media_5" type="button" onclick="click_seleccionar_tipo_media(5)">
										<i class="fa fa-file-archive-o" aria-hidden="true"></i>
										<div>ARCHIVO</div>
									</button>
								</div>

								<div class="col-md-3 col-6">
									<button class="btn btn-default btn-item-contenido  btn-no-archivos" id="btn_tipo_media_3" type="button"  onclick="click_seleccionar_tipo_media(3)">
										<i class="fa fa-file-word-o" aria-hidden="true"></i>
										<div>TEXTO</div>
									</button>

									<button class="btn btn-default btn-item-contenido btn-archivos" id="btn_tipo_media_6" type="button"  onclick="click_seleccionar_tipo_media(6)">
										<i class="fa fa-link" aria-hidden="true"></i>
										<div>ENLACE</div>
									</button>

								</div>

								<div class="col-md-3 col-6">
									<button class="btn btn-default btn-item-contenido  btn-no-archivos"  id="btn_tipo_media_4" type="button" onclick="click_seleccionar_tipo_media(4)">
										<i class="fa fa-file-audio-o" aria-hidden="true"></i>
										<div>AUDIO</div>
									</button>
								</div>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-md-12">							

							<div id="componente_media_1" class="componente_media">
								
								<label>Video Contenido</label>
								<select class="form-control" id="TipoVideo" onchange="cambio_tipo_video(this.value)">
									<option value="1">Subir Video</option>
									<option value="2">URL de Youtube</option>
									<option value="3">URL de Vimeo</option>
								</select>
					
								<input id="URLMedia" type="text" name="nombre" class="form-control class-embed"  value="" style="margin-top: 5px;">
								<small class="class-embed">URL del Video en <span id="nombre_tipo_video" >Youtube</span></small><br/>
								<small class="class-embed" style="color: red;" id="validacion_video"></small>
								
					
								<div id="cnv_subir_video" style="width:100%;">
									<input class="form-control" type="file" id="SubirVideoFile"  style="margin-top: 5px; display:none;" onchange="seleccionar_video('SubirVideoFile','VideoCurso')"> 
									<center>
										<button class="btn btn-info" onclick="getVideoCurso('SubirVideoFile')" type="button">
											<i class="fa fa-upload" aria-hidden="true"></i> SELECCIONAR VIDEO (.mp4)
										</button>
									</center>
								</div>
								
								<div class="col-contenido embed-responsive embed-responsive-16by9" id="cnv_VideoCurso" style="background-color: #ccc; margin-top:15px;">
								</div>
							
								
							</div>


							<div id="componente_media_2" class="componente_media">
								<div class="componente-archivos" id="prev_ImagenMedia" style="background-image: url('{{url('')}}/assets/images/cursos/seleccionar_imagen.jpg');">
									<div class="overlay"  onclick="getFotoCurso('ImagenMedia');" >
									</div>
									<button class="btn btn-danger btn-xs" style="position: absolute; width:200px; left:50%; margin-left:-100px; top:39%; z-index:9999999999;" type="button" onclick="limpiar_componente_file('ImagenMedia')" >Eliminar</button>
									<button class="btn btn-info btn-xs" style="position: absolute; width:200px; left:50%; margin-left:-100px; top:48%;  z-index:9999999999;"  type="button"   onclick="getFotoCurso('ImagenMedia');" >Agregar o Reemplazar</button>
								</div>
								<input id="ImagenMedia" type="file" name="nombre" class="form-control" style="display: none;" onchange="seleccionar_imagen('ImagenMedia')">
							</div>

							<div id="componente_media_3" class="componente_media">
								<!--<textarea class="form-control html-paginas valida-caracteres-tinymce" id="ContenidoMedia" name="ContenidoMedia"></textarea>-->
							</div>

							<div id="componente_media_4" class="componente_media">
								<center>

									<span id="NombreAudio">
										<i class="fa fa-file-audio-o" aria-hidden="true"></i> <span>Nombre archivo.mp3</span>
										<br >

										<div id="cnv_audio">

										</div>
									</span>

									<br />

									<input class="form-control" type="file" id="SubirAudioFile"  style="margin-top: 5px; display:none;" onchange="seleccionar_audio('SubirAudioFile','AudioMedia')"> 
									<button class="btn btn-info" onclick="getAudioCurso('SubirAudioFile')" type="button">
										<i class="fa fa-upload" aria-hidden="true"></i> SELECCIONAR AUDIO (.mp3)
									</button>
								</center>
							</div>



							<div id="componente_media_5" class="componente_media">
								<center>

									<span id="NombreArchivo">
										<i class="fa fa-file-archive-o" aria-hidden="true"></i> <span>Nombre archivo</span>
																				
										<span id="cnv_archivo">

										</span>
									</span>

									<br />

									<input class="form-control" type="file" id="SubirArchivoFile"  style="margin-top: 5px; display:none;" onchange="seleccionar_archivo('SubirArchivoFile')">
									<button class="btn btn-info" onclick="getArchivosCurso('SubirArchivoFile')" type="button" style="margin-top: 25px;">
										<i class="fa fa-upload" aria-hidden="true"></i> SELECCIONAR ARCHIVO 
									</button>
								</center>
							</div>


							<div id="componente_media_6" class="componente_media">
								<label for="">Enlace</label>
								<input type="text" class="form-control" id="URLEnlace">
							</div>

							
							

						</div>
					</div>

				</div>

				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
					<input type="submit" class="btn btn-primary" value="Guardar Contenido">
				</div>

			</form>
		</div>
	</div>
</div>

<div class="modal fade" id="modal_eliminar_item" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
	  <div class="modal-content">
		<div class="modal-header">
		  <h5 class="modal-title" id="exampleModalLabel">¿Estás seguro de eliminar este item?</h5>
		  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		  </button>
		</div>
		<form id="form-elimina-cuenta">
		  <div class="modal-body">                 
			<ul>
			  <li>La información de este Item se perderá permanetemente.</li>
			  <li>Las imágenes y videos asignados a este item serán eliminados en de nuestro servidor.</li>
			  <li>Los estudiantes que hayan adquirido el curso, ya no podrán ver este item.</li>
			</ul>          
		  </div>
		  <div class="modal-footer">
			<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
			<button type="button" class="btn btn-danger" id="btn_eliminar_item">Eliminar Item</button>
		  </div>
		</form>
	  </div>
	</div>
  </div>





@stop

@section('scripts')
	
	<script src="{{url('')}}/assets/tinymce/js/tinymce/tinymce.min.js"></script>
	<script src="{{url('')}}/assets/tinymce/js/tinymce/jquery.tinymce.min.js"></script>
	<script src="{{url('')}}/assets/js/sortable.js"></script>
  	<script src="https://cdn.jsdelivr.net/npm/jquery-sortablejs@latest/jquery-sortable.js"></script>
	  
	<script src="{{url('')}}/assets-interno/plugins/moment/moment.min.js"></script>
	<script src="{{url('')}}/assets-interno/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>


	

	@php 
		if(!$curso->AprobacionAutomatica){
			$curso->AprobacionAutomatica="0";
		}
	@endphp
  
	<script type="text/javascript">
		var IdMedia="";
		var datos_media="";
		var IdModulo="";
		$(function(){ 			
			click_seleccionar_tipo_media("1");
			$("#AprobacionAutomatica").val("{{$curso->AprobacionAutomatica}}");
			$("#IdNivelCurso").val("{{$curso->IdNivelCurso}}");     

			@if($ProcesoItem=="leccion") 
				IdModulo="{{$IdPadre}}";
			@endif

			@if($IdItem!="")
				get_media_by();
			@endif


			$('#listado_ul').sortable({
				animation: 150,
				onEnd: function (evt) {
					console.log(evt.newIndex);
					send_orden("listado_ul");
				}
			});			

			$('#listado_archivos').sortable({
				animation: 150,
				onEnd: function (evt) {
					console.log(evt.newIndex);
					send_orden("listado_archivos");
				}
			});	


			//Timepicker
			$('#timepicker').datetimepicker({
				viewMode: 'years',
				locale: 'es',
				format: "Y-MM-DD hh:mm",
			})

		});

		

		
		$("#VideoCurso").focusout(function() {        
			if(!validacion_tipo_video($("#TipoVideo").val(), $("#VideoCurso").val())){
				$("#validacion_video").html("La URL del video no tiene el formato indicado");        
			}else{
				var matches=get_id_video_url($("#TipoVideo").val(), $("#VideoCurso").val());
				$("#validacion_video").html("");
				$("#cnv_VideoCurso").html(matches);
			}
		});

		$("#URLMedia").focusout(function() {
			foco_video();			
		});

		$("#TipoVideo").change(function() {
			foco_video();			
		});

		function foco_video(){
			if(!validacion_tipo_video($("#TipoVideo").val(), $("#URLMedia").val())){
				$("#validacion_video").html("La URL del video no tiene el formato indicado");        
			}else{
				var matches=get_id_video_url($("#TipoVideo").val(), $("#URLMedia").val());
				$("#validacion_video").html("");
				$("#cnv_VideoCurso").html(matches);
			}
		}

			
		var cant_total_char_tinymce=2000;

		tinymce.init({          
			height:"124",

			setup: function (ed) {
				ed.on('init', function(args) {
					
					var texto_componente=ed.getContent({format : 'text'});                  
					texto_componente=texto_componente.trim();
					var cant_actual=cant_total_char_tinymce-texto_componente.length;
					$("#cant_caracteres_DescripcionCurso").html(cant_actual);

				});

				ed.on('keyup', function(e) {

					var texto_componente=ed.getContent({format : 'text'});
					texto_componente=texto_componente.trim();
					var cant_actual=cant_total_char_tinymce-texto_componente.length;
					$("#cant_caracteres_DescripcionCurso").html(cant_actual);

				});

			},

			selector: ".html-paginas",		  
			fontsize_formats: '8pt 10pt 12pt 14pt 18pt 24pt 36pt 42pt 52pt',
			relative_urls : false,
			remove_script_host : true,
			extended_valid_elements : "ins[class|style|data-ad-client|data-ad-slot],a[id|class|name|href|target|title|onclick|rel|data-toggle|data-parent],script[async|type|src],iframe[src|style|width|height|scrolling|marginwidth|marginheight|frameborder|allowfullscreen|class],img[class|src|border=0|alt|title|hspace|vspace|width|height|align|onmouseover|onmouseout|name|style|id|onclic]",
			toolbar: " fontsizeselect | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | forecolor backcolor"
		});
		
		


		// INFORMACIÓN BÁSICA

		$("#NombreCurso").focusout(function(){
			var slugBasicos=$("#NombreCurso").val();
			slugBasicos=slug(slugBasicos);			
			$("#SlugCurso").val(""+slugBasicos+"-{{$curso->CodigoCurso}}");
		});


		$("#SlugCurso").focusout(function(){
			var slugBasicos=$("#SlugCurso").val();
			slugBasicos=slug(slugBasicos);			
			//$("#SlugCurso").val(""+slugBasicos+"-{{$curso->CodigoCurso}}");
		});


		function slug(str) {
			str = str.replace(/^\s+|\s+$/g, ''); // trim
			str = str.toLowerCase();
		
			// remove accents, swap ñ for n, etc
			var from = "àáãäâèéëêìíïîòóöôùúüûñç·/_,:;";
			var to   = "aaaaaeeeeiiiioooouuuunc------";

			for (var i=0, l=from.length ; i<l ; i++) {
				str = str.replace(new RegExp(from.charAt(i), 'g'), to.charAt(i));
			}

			str = str.replace(/[^a-z0-9 -]/g, '') // remove invalid chars
				.replace(/\s+/g, '-') // collapse whitespace and replace by -
				.replace(/-+/g, '-'); // collapse dashes

			return str;
		}


		$("#form-editar-curso").submit(function(e){
			e.preventDefault();

			
			var NombreItem=""+$("#NombreItem").val();
			var DescripcionCortaItem=""+$("#DescripcionCortaItem").val();
			var GratisItem="0";
			var HorasItem=""+$("#HorasItem").val();
			var MinutosItem=""+$("#MinutosItem").val();
			var SegundosItem=""+$("#SegundosItem").val();
			var IdEstado="3";

			var FechaLanzamiento=""+$("#FechaLanzamiento").val();
			if($("#GratisItem").is(":checked")){
				GratisItem="1";
			}

			if($("#IdEstado").is(":checked")){
				IdEstado="1";
			}

			
						
			var formData = new FormData();
			formData.append('IdTem', "{{$IdItem}}");
			formData.append('NombreItem', NombreItem);
			formData.append('DescripcionCortaItem', DescripcionCortaItem);
			formData.append('GratisItem', GratisItem);
			formData.append('HorasItem', HorasItem);
			formData.append('MinutosItem', MinutosItem);
			formData.append('SegundosItem', SegundosItem);
			formData.append('ProcesoItem', "{{$ProcesoItem}}");
			formData.append('IdEstado', IdEstado);
			formData.append('IdPadre', IdModulo);			
			formData.append('FechaLanzamiento', FechaLanzamiento);
			

			guardar_informacion(formData,"editarmoduloslecciones");

		});


		function guardar_informacion(campos,funcionlv,aplica_archivo=""){

			campos.append('CodigoCurso', "{{$curso->CodigoCurso}}");
			campos.append('_token', "{{ csrf_token() }}");        
			campos.append('token_curso', "{{ $token_curso }}");

			if(funcionlv=="set_media_item" && aplica_archivo=="SI"){
				abrir_barra_progreso();
			}


			$("#NuevoContenido").modal("hide");
			
			var request = $.ajax({
				url: "{{url('')}}/"+funcionlv,
				type: "POST",
				data: campos,
				processData: false,  // tell jQuery not to process the data
				contentType: false,  // tell jQuery not to set contentType
				cache:false,
				xhr : function (){
                    var jqXHR = null;
                    if ( window.ActiveXObject ){
                        jqXHR = new window.ActiveXObject( "Microsoft.XMLHTTP" );
                    }else{
                        jqXHR = new window.XMLHttpRequest();
                    }
                    //Upload progress
                    jqXHR.upload.addEventListener("progress", function (evt){
                        if( evt.lengthComputable ){
                            var percentComplete = Math.round( (evt.loaded * 100) / evt.total );                            
							if(aplica_archivo=="SI"){
								progress_bar_componente(percentComplete);
							}                            
                            console.log( 'Uploaded percent', percentComplete );
                        }
                    }, false );

                    //Download progress
                    jqXHR.addEventListener( "progress", function(evt){
                        if(evt.lengthComputable){
                            var percentComplete = Math.round( (evt.loaded * 100) / evt.total );
                            //Do something with download progress
                            console.log( 'Downloaded percent', percentComplete );
							if(aplica_archivo=="SI"){
                            	progress_bar_componente(percentComplete);
							}
                        }
                    }, false );
                    return jqXHR;
                }
			});

			request.done(function(obj) { 
				if(obj.status=="ok"){  

					$("#responder_comentarios").modal("hide");
					cerrar_barra_progreso();
					console.log("debe cerrar");
					if(funcionlv=="editarmoduloslecciones" || funcionlv=="set_media_item"){

						
						mensaje_generico("Correcto",""+obj.mensaje,"1","Continuar...",function(){
							
								if(funcionlv=="set_media_item"){									
									get_media_by();
									limpiar_form_media("1");

								}else{
									@if($ProcesoItem=="modulo") 
									window.open("{{url('')}}/cursos/contenido/{{$curso->CodigoCurso}}/{{$ProcesoItem}}/"+obj.IdItem,"_parent");
									@else
									if(obj.CodigoItem!="")
										window.open("{{url('')}}/cursos/contenido/{{$curso->CodigoCurso}}/{{$ProcesoItem}}/{{$IdPadre}}-"+obj.CodigoItem,"_parent");
									else
										window.open("{{url('')}}/cursos/contenido/{{$curso->CodigoCurso}}/{{$ProcesoItem}}/{{$IdPadre}}-{{$CodigoItem}}","_parent");
									@endif
								}
							
							}
						);
					}else if(funcionlv=="get_media_item"){

						datos_media=obj.datos;
						console.log(datos_media);
						generar_listado_media(datos_media);

					
					}else if(funcionlv=="cambiarestadomedia"){
						$("#modal_eliminar_item").modal("hide");
						mensaje_generico("Correcto","El contenido ha sido eliminado correctamente","1","Continuar...",function(){							
							get_media_by();
							limpiar_form_media("1");
						});
					}
					

					return;

				}else{
					$("#NuevoContenido").modal("show");
					cerrar_barra_progreso();
					$("#responder_comentarios").modal("hide");
					mensaje_generico("Error !",""+obj.mensaje,"2","Continuar...",function(){});
					return;

				}
			});
			//respuesta si falla
			request.fail(function(jqXHR, textStatus) {
				cerrar_barra_progreso();
				$("#NuevoContenido").modal("show");
				alert( "Error de servidor  " + textStatus );
			});

		}

		//ENVÍO DE PRECIOS
		$("#btn_estado_revision").click(function(e){
			e.preventDefault();
			var formData = new FormData();
			guardar_informacion(formData,"cambiarestadorev");
		});

		$("#btn_vista_previa").click(function(){
			
		});

		$("#btn_nuevo_contenido").click(function(e){
			$("#NombreMedia").val("");
			IdMedia="";
			limpiar_form_media("1");
			$("#NuevoContenido").modal("show");

			$(".btn-no-archivos").show();
			$(".btn-archivos").hide();

		});

		$("#btn_nuevo_archivo").click(function(e){
			$("#NombreMedia").val("");
			IdMedia="";
			limpiar_form_media("5");
			$("#NuevoContenido").modal("show");

			$(".btn-no-archivos").hide();
			$(".btn-archivos").show();
		});

		

		var tipo_media_sel="";

		function click_seleccionar_tipo_media(tipo_media){
			
			if(tipo_media=="1" || tipo_media=="2" || tipo_media=="3" || tipo_media=="4"){
				$(".btn-no-archivos").show();
				$(".btn-archivos").hide();
			}else{
				$(".btn-no-archivos").hide();
				$(".btn-archivos").show();
			}
			
			$(".btn-item-contenido").removeClass("btn-item-contenido-active");
			$("#btn_tipo_media_"+tipo_media).addClass("btn-item-contenido-active");
			tipo_media_sel=tipo_media;
			$("#TipoMedia").val(tipo_media_sel);


			$(".componente_media").hide();
			$("#componente_media_"+tipo_media).show();


		}

		getFotoCurso = function($idcomponente) {
			$('#'+$idcomponente).attr('accept', '.jpg, .png');
			$('#'+$idcomponente).show();
			$('#'+$idcomponente).focus();
			$('#'+$idcomponente).click();
			$('#'+$idcomponente).hide();
		}


		getVideoCurso=function($idcomponente){
			$('#'+$idcomponente).attr('accept', '.mp4');
			$('#'+$idcomponente).show();
			$('#'+$idcomponente).focus();
			$('#'+$idcomponente).click();
			$('#'+$idcomponente).hide();
		}

		getAudioCurso=function($idcomponente){
			$('#'+$idcomponente).attr('accept', '.mp3');
			$('#'+$idcomponente).show();
			$('#'+$idcomponente).focus();
			$('#'+$idcomponente).click();
			$('#'+$idcomponente).hide();
		}


		getArchivosCurso=function($idcomponente){
			$('#'+$idcomponente).attr('accept', '.zip,.rar,.png,.jpg,.mp3,.pdf,.doc,.docx,.ppt,.pptx,.xls,.xlsx');
			$('#'+$idcomponente).show();
			$('#'+$idcomponente).focus();
			$('#'+$idcomponente).click();
			$('#'+$idcomponente).hide();
		}

		// INFORMACIÓN BÁSICA

		function seleccionar_imagen(id_imag){        
			if ($('#'+id_imag)[0].files[0]){
				var pathGaleria = "";
				pathGaleria = URL.createObjectURL($('#'+id_imag)[0].files[0]);
				$("#prev_"+id_imag).css("background-image","url('"+pathGaleria+"')");         
				
			}else{
			// $("#prev_"+id_imag).css("background-image","url('"+pathGaleria+"')");         
			}
		}

		// SELECCIONAR MEDIA
		var cant_clicl=0;
		function seleccionar_video(id_video,campo_id){        
			if ($('#'+id_video)[0].files[0]){

				console.log($('#'+id_video)[0].files[0].size);

				
				console.log("Entró "+campo_id);
				var pathGaleria = "";
				pathGaleria = URL.createObjectURL($('#'+id_video)[0].files[0]);
				cant_clicl++;
				var embed=`<video id="player_video_${cant_clicl}" controlsList="nodownload" class="video-js vjs-playback-rate embed-responsive-item " controls="true" preload="true" rate="true" data-setup="{}"><source src="${pathGaleria}" type="video/mp4" /><p class="vjs-no-js">To view this video please enable JavaScript, and consider upgrading to a web browser that <a href="https://videojs.com/html5-video-support/" target="_blank">supports HTML5 video</a ></p></video>`;
				$("#cnv_"+campo_id).html(embed);
				
				var player = videojs("player_video_"+cant_clicl);
				
			}else{
			// $("#prev_"+id_imag).css("background-image","url('"+pathGaleria+"')");         
			}
		}


		function cambio_tipo_video(tipo_video,inicial=0){
			$("#cnv_subir_video").hide();
			$(".class-embed").show();
			if(!inicial){
				$("#VideoCurso").val("");
			}

			$("#cnv_VideoCurso").html("");
			if(tipo_video=="1"){
				$("#cnv_subir_video").show();
				$(".class-embed").hide();
				cant_clicl++;          
			}else if(tipo_video=="2"){
				$("#nombre_tipo_video").html("Youtube");
			}else{
				$("#nombre_tipo_video").html("Vimeo");
			}

		}




		var cant_clicl_2=0;
		function seleccionar_audio(id_audio,campo_id){
			
			if ($('#'+id_audio)[0].files[0]){				
				var pathGaleria = "";
				pathGaleria = URL.createObjectURL($('#'+id_audio)[0].files[0]);
				cant_clicl_2++;

				//var filename = $('input[type=file]').val().replace(/C:\\fakepath\\/i, '')
				var filename = $('#'+id_audio).val().split('\\').pop();
				$("#NombreAudio").show();
				$("#NombreAudio > span").html(filename);
				


				var embed=`<audio controls>								
								<source src="${pathGaleria}" type="audio/mpeg">
								Your browser does not support the audio element.
							</audio>`;
				$("#cnv_audio").html(embed);				
				//var player = videojs("player_video_"+cant_clicl);
				
			}else{
			// $("#prev_"+id_imag).css("background-image","url('"+pathGaleria+"')");         
			}

		}



		function seleccionar_archivo(id_archivo){
			
			if ($('#'+id_archivo)[0].files[0]){				
				var pathGaleria = "";
				pathGaleria = URL.createObjectURL($('#'+id_archivo)[0].files[0]);

				var filename = $('#'+id_archivo).val().split('\\').pop();
				$("#NombreArchivo").show();
				$("#NombreArchivo > span:first").html(filename);			
				console.log(filename);					
				
			}
		}


		$("#frm_media").submit(function(e){
			e.preventDefault();
			guardar_media();
		});
		
		function guardar_media(){
			var FileMedia="";
			var ContenidoMedia="";
			var URLMedia="";
			var TipoVideo="";
			var IdTema="";
			var IdModulo="";
			var NombreMedia=""+$("#NombreMedia").val();


			@if($ProcesoItem=="modulo")
			IdTema="";
			IdModulo="{{$IdItem}}";
			@else
			IdTema="{{$IdItem}}";
			IdModulo="";
			@endif

			var aplica_archivo="";

			if(tipo_media_sel=="1"){
				if($("#SubirVideoFile")[0].files[0]){
					FileMedia=$("#SubirVideoFile")[0].files[0];
					aplica_archivo="SI";
				}				
				if(TipoVideo==""){
					URLMedia=""+$("#URLMedia").val();
				}
			}

			if(tipo_media_sel=="2"){
				if($("#ImagenMedia")[0].files[0]){
					FileMedia=$("#ImagenMedia")[0].files[0];
					aplica_archivo="SI";
				}				
			}

			
			ContenidoMedia=""+tinymce.get('ContenidoMedia').getContent();
			

			if(tipo_media_sel=="4"){
				if($("#SubirAudioFile")[0].files[0]){
					FileMedia=$("#SubirAudioFile")[0].files[0];
					aplica_archivo="SI";
				}				
			}			

			if(tipo_media_sel=="5"){
				if($("#SubirArchivoFile")[0].files[0]){
					FileMedia=$("#SubirArchivoFile")[0].files[0];
					aplica_archivo="SI";
				}				
			}			

			if(tipo_media_sel=="6"){
				URLMedia=""+$("#URLEnlace").val();
			}
			
			var formData = new FormData();
			formData.append('IdMedia', ""+IdMedia);
			formData.append('FileMedia', FileMedia);
			formData.append('TipoMedia', tipo_media_sel);
			formData.append('TipoVideo', $("#TipoVideo").val());
			formData.append('IdTema', ""+IdTema);
			formData.append('IdModulo', ""+IdModulo);			
			formData.append('ContenidoMedia', ContenidoMedia);			
			formData.append('URLMedia', URLMedia);			
			formData.append('NombreMedia', NombreMedia);			
			
			guardar_informacion(formData,"set_media_item",aplica_archivo);

		}

		function get_media_by(){
			var IdTema="";
			var IdModulo="";
			@if($ProcesoItem=="modulo")
			IdTema="";
			IdModulo="{{$IdItem}}";
			@else
			IdTema="{{$IdItem}}";
			IdModulo="";
			@endif

			
			var formData = new FormData();
			formData.append('IdTema', ""+IdTema);
			formData.append('IdModulo', ""+IdModulo);			

			guardar_informacion(formData,"get_media_item");


		}

		function generar_listado_media(media){
			var cadena_listado='';
			var cadena_listado_archivos='';
			var icono_media="";
			var NombreMedia="";
			var TipoMedia="";
			var IdMedia="";
			for(var i=0;i<media.length;i++){

				NombreMedia=""+media[i].NombreMedia;
				TipoMedia=""+media[i].TipoMedia;
				IdMedia=""+media[i].IdMedia;

				switch(TipoMedia){
					case "1":
						icono_media=`<i class="fa fa-file-video-o" aria-hidden="true"></i>`;
					break;

					case "2":
						icono_media=`<i class="fa fa-file-image-o" aria-hidden="true"></i>`;
					break;

					case "3":
						icono_media=`<i class="fa fa-file-word-o" aria-hidden="true"></i>`;
					break;

					case "4":
						icono_media=`<i class="fa fa-file-audio-o" aria-hidden="true"></i>`;
					break;

					case "5":
						icono_media=`<i class="fa fa-file-archive-o" aria-hidden="true"></i>`;
					break;

					case "6":
						icono_media=`<i class="fa fa-link" aria-hidden="true"></i>`;
					break;
				}


				var cadena_detalle=`				
					<li class="list-group-item" id-tem="${IdMedia}" style=" height: 62px !important; position: relative; margin-bottom:10px; border-radius:5px;     padding-top: 17px;">
						<table style="width: 100%;">
							<tr>
								<td style="width: 18px;">
									<i class="fa fa-ellipsis-v" style=" font-size: 26px;  color: #0b558685;" aria-hidden="true"></i>
								</td>        
								<td>
									<span style="font-size: 15px; color: #7b7b7b;">
										
										${icono_media}

										${NombreMedia}</span>
								</td>   
								<td style="width: 24px; text-align:left;">
									<div class="btn-group dropleft">
										<button type="button" class="btn btn-default dropdown-toggle btn-menu-leccion" data-toggle="dropdown" aria-haspopup="true" style="width: 25px; height:25px; border-radius: 15px;     padding-top: 1px; ">
											<i class="fa fa-ellipsis-v" aria-hidden="true" style="font-size: 15px; margin-top: 2px;"></i>
										</button>
										<div class="dropdown-menu">
											<button id-media="${IdMedia}" class="dropdown-item btn-editar-media" type="button"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>  Editar</a>
											<button id-media="${IdMedia}" class="dropdown-item btn-eliminar-media" type="button"  onclick="eliminar_componente(${IdMedia},${TipoMedia})"  ><i class="fa fa fa-trash-o" aria-hidden="true"></i>  Eliminar</button>
										</div>
									</div>
								</td>
							</tr>
						</table>
					</li>

				`;

				
				if(TipoMedia==1 || TipoMedia==2 || TipoMedia==3 || TipoMedia==4){
					cadena_listado+=cadena_detalle;
				}else{
					cadena_listado_archivos+=cadena_detalle;
				}

			}


			
			

			if(cadena_listado==""){
				var cadena_en_blanco=`
				<div class="text-center" style="padding: 20px; background-color: #f3f3f3;  border-radius: 5px; border: 2px dashed #ccc;  margin-top: 5px;">
					<h3 style="font-size: 17px; margin: 0px; color: #b9b9b9;"><i class="fa fa-object-group" aria-hidden="true"></i> No hay contenido para este item</h3>
				</div>`;
				cadena_listado=""+cadena_en_blanco;
			}

			if(cadena_listado_archivos==""){
				var cadena_en_blanco=`
				<div class="text-center" style="padding: 20px; background-color: #f3f3f3;  border-radius: 5px; border: 2px dashed #ccc;  margin-top: 5px;">
					<h3 style="font-size: 17px; margin: 0px; color: #b9b9b9;"><i class="fa fa-object-group" aria-hidden="true"></i> No hay archivos para este item</h3>
				</div>`;
				cadena_listado_archivos=""+cadena_en_blanco;
			}
			
			$("#listado_ul").html(cadena_listado);
			$("#listado_archivos").html(cadena_listado_archivos);
			
			$(".btn-editar-media").click(function(e){				
				e.preventDefault();
				var id_media=$(e.target).attr("id-media");				
				editar_media(id_media);
			});
			
		}

		function limpiar_form_media(tip_media){			
			$("#TipoVideo").val("1");
			cambio_tipo_video("1");
			$("#NuevoContenido").modal("hide");
			tinymce.get('ContenidoMedia').setContent("");

			$("#SubirVideoFile").val(''); 
        	$("#SubirVideoFile").val(null);
        	$("#SubirVideoFile").val('').clone(true);


			$("#URLMedia").val("");
			$("#ImagenMedia").val(''); 
        	$("#ImagenMedia").val(null);
        	$("#ImagenMedia").val('').clone(true);
        	$("#prev_ImagenMedia").css("background-image","url({{url('')}}/assets/images/cursos/seleccionar_imagen.jpg)");

			
			$("#SubirAudioFile").val(''); 
        	$("#SubirAudioFile").val(null);
        	$("#SubirAudioFile").val('').clone(true);

			$("#NombreAudio").hide();
			$("#NombreAudio > span").html("");

			$("#SubirArchivoFile").val(''); 
        	$("#SubirArchivoFile").val(null);
        	$("#SubirArchivoFile").val('').clone(true);

			$("#NombreArchivo").hide();
			$("#NombreArchivo > span").html("");


			$("#NombreMedia").val("");


			click_seleccionar_tipo_media(""+tip_media);
			$("#cnv_VideoCurso").html("");
			IdMedia="";
		}

		function limpiar_componente_file(componente){
			$("#"+componente).val(''); 
			$("#"+componente).val(null);
			$("#"+componente).val('').clone(true);
			$("#prev_"+componente).css("background-image","url({{url('')}}/assets/images/cursos/seleccionar_imagen.jpg)");
			
		}


		function send_orden(id_componente){        
			var OrdenMedia=get_item_orden(id_componente);
			var formData = new FormData();
			formData.append('IdCurso', "{{$curso->IdCurso}}");  
			

			var TablaItem="";

			@if($ProcesoItem=="modulo")
				TablaItem="IdModulo";
			@else
				TablaItem="IdTema";
			@endif
						
			formData.append('IdItem', "{{$IdItem}}");
			formData.append('OrdenMedia', ""+OrdenMedia);
			formData.append('TablaItem', ""+TablaItem);
			
			     
			guardar_informacion(formData,"editarordenmedia");
		}

		function get_item_orden(id_componente){
			var arra_list=$("#"+id_componente+" > li");
			var cadena_orden="";
			for(var i=0;i<arra_list.length;i++){
				var id_item=$(arra_list[i]).attr("id-tem");
				console.log(id_item);
				cadena_orden+=id_item+",";
			}
			cadena_orden=cadena_orden.slice(0,-1);
			return cadena_orden;
		}

		function get_data_media(id_media){
			for(var i=0;i<datos_media.length;i++){
				if(datos_media[i].IdMedia==id_media){
					return datos_media[i];
				}
			}
			return null;
		}


		function editar_media(id_media){
			IdMedia=id_media;
			var data_media=get_data_media(id_media);
			click_seleccionar_tipo_media(data_media.TipoMedia);
			

			$("#NombreMedia").val(data_media.NombreMedia);
			tinymce.get('ContenidoMedia').setContent(data_media.ContenidoMedia);

			cant_clicl++;

			if(data_media.TipoMedia=="1"){
				$("#TipoVideo").val(data_media.TipoVideo);
				cambio_tipo_video(data_media.TipoVideo);
				if(data_media.TipoVideo=="1"){
					
					var embed_video=`${data_media.VideoEmbedMedia}`;
          			embed_video=embed_video.replace("player_video","player_video_"+cant_clicl);          			
          			$("#cnv_VideoCurso").html(""+embed_video);
					var player = videojs("player_video_"+cant_clicl);

				}else if(data_media.TipoVideo=="2" || data_media.TipoVideo=="3"){

					$("#URLMedia").val(""+data_media.URLMedia);
					var matches=get_id_video_url($("#TipoVideo").val(), $("#URLMedia").val());
					$("#validacion_video").html("");
					$("#cnv_VideoCurso").html(matches);

				}

			}else if(data_media.TipoMedia=="2"){
				
				console.log(data_media.URLMedia);
				$("#prev_ImagenMedia").css("background-image","URL(../../../../../"+data_media.URLMedia+")");

			}else if(data_media.TipoMedia=="3"){

				tinymce.get('ContenidoMedia').setContent(data_media.ContenidoMedia);

			}else if(data_media.TipoMedia=="4"){								
				var filename=data_media.URLMedia;				
				$("#NombreAudio").show();
				$("#NombreAudio > span").html(data_media.NombreArchivoMedia);
				var embed=`<audio controls>								
								<source src="../../../../../${data_media.URLMedia}" type="audio/mpeg">
								Your browser does not support the audio element.
							</audio>`;
				$("#cnv_audio").html(embed);				
			}else if(data_media.TipoMedia=="5"){
				var filename=data_media.URLMedia;
				$("#NombreArchivo").show();
				$("#NombreArchivo > span").html(data_media.ContenidoMedia);
				var embed=`<a href="${data_media.URLMedia}" class="btn btn-default btn-xs" download><i class="fa fa-download" aria-hidden="true"></i></a>`;
				$("#cnv_archivo").html(embed);
			}else if(data_media.TipoMedia=="6"){
				$("#URLEnlace").val(data_media.ContenidoMedia);
			}

			$("#NuevoContenido").modal("show");			
			console.log(data_media);
		}



	
		var id_item_sel="";		
		var id_tipo_sel="";
		function eliminar_componente(id_item,id_tipo){
			id_item_sel=""+id_item;			
			id_tipo_sel=""+id_tipo;
			$("#modal_eliminar_item").modal("show");

		}
		$("#btn_eliminar_item").click(function(){
			cambiar_estado_item(id_item_sel,id_tipo_sel);
		});

		function cambiar_estado_item(id_item,id_tipo){
			var formData = new FormData();
			formData.append('id_item', ""+id_item);
			formData.append('id_tipo', ""+id_tipo);        
			guardar_informacion(formData,"cambiarestadomedia");
		}




		


	</script>
@stop