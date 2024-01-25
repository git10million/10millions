@extends('areacurso.plantillas.plantilla-area-interna')

@section('cabecera')
<style type="text/css">
   .container-recurso{
      width: 100px; 
      height: 100px; 
      background-color: #e3e3e3; 
      border-radius: 9px; 
      margin-left: 15px; 
      margin-bottom: 15px; 
      display: inline-block; 
      text-align: center;
      cursor: pointer;
      position: relative;
   }
   .imagen-media{
     width: 100px; height: 60px; background-size: contain; background-position: center; background-repeat: no-repeat;   
   }
   .container-recurso small{
   	 position: absolute;
	 left: 0px;
	 font-size: 10px;
	 width: 100%;
   }

   #contenedor_videos{
   	display: none;
   }
   #contenedor_audios{
   	 display: none;
   }

   label{
   	  margin-top: 25px;
   }
</style>
@stop

@section('contenido')


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-7">
            <h1 class="m-0 text-dark">Gestión Artículos </h1>
          </div><!-- /.col -->
          <div class="col-sm-5">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('')}}/backoffice">Inicio</a></li>
              <li class="breadcrumb-item active">Artículos</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

      <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">          

          <div class="col-lg-12">
            <div class="card">
              <div class="card-body">                
                 
				 <div class="row">			 	
				 
					<div class="col-md-3" style="margin-top: 45px;">
						<img src="@if($data_articulo!=''){{$data_articulo[0]->URLImagenArticulo}}@endif" id="imagen_destacada" style="width: 100%;">
					</div>

					<div class="col-md-8" style="margin-top: 45px;">
						
						<h2>CONTENIDO ARTÍCULO</h2>

						<form class="form" id="form-articulo">
							<div class="row">
								<div class="col-md-12">
									<label style="font-size: 12px;">Titulo Artículo</label>
									<input required type="text" name="" value="@if($data_articulo!=''){{$data_articulo[0]->TituloArticulo}}@endif" class="form-control" placeholder="Titulo Artículo" id="TituloArticulo">
								</div>	

								<div class="col-md-12">
									<label style="font-size: 12px;">Slug Artículo <small>(URL En el Blog)</small></label>
									<input required type="text" name="" value="@if($data_articulo!=''){{$data_articulo[0]->SlugArticulo}}@endif" class="form-control" placeholder="Slug Artículo" id="SlugArticulo">
								</div>	



								<div class="col-md-12">
									<label style="font-size: 12px;">Imágen Destacada</label>

									<div class="input-group mb-3">
									  <input type="text" class="form-control" id="URLImagenArticulo" aria-label="Recipient's username" aria-describedby="basic-addon2" value="@if($data_articulo!=''){{$data_articulo[0]->URLImagenArticulo}}@endif">
									  <div class="input-group-append" id="btn_media_1">
									    <span class="input-group-text" id="basic-addon2"><i class="fa fa-search" aria-hidden="true"></i></span>
									  </div>
									</div>

								</div>
								


								<div class="col-md-6">
									<label style="font-size: 12px;">Autor</label>
									<select class="form-control" id="IdAutor">
										@foreach($autores as $autor)
											<option value="{{$autor->IdUsuario}}">{{$autor->NombresUsuario}} {{$autor->ApellidosUsuarios}}</option>
										@endforeach
									</select>						
								</div>

								
								<div class="col-md-3">
									<label style="font-size: 12px;">Estado Artículo</label>
									<select class="form-control" id="IdEstadoArticulo">
										<option value="1">BORRADOR</option>
										<option value="2">PUBLICAR</option>
									</select>						
								</div>

								<div class="col-md-3">
									<label style="font-size: 12px;">Tipo Artículo</label>
									<select class="form-control" id="IdTipoArticulo" onchange="seleccionar_tipo_articulo()">
										<option value="1">NORMAL</option>
										<option value="2">VIDEO - TEXTO</option>
										<option value="3">AUDIO - TEXTO</option>
									</select>						
								</div>



								<div class="col-md-3">
									<label style="font-size: 12px;">Es Destacado?</label>
									<select class="form-control" id="DestacadoArticulo" onchange="seleccionar_tipo_articulo()">
										<option value="0">NO</option>
										<option value="1">SI</option>										
									</select>						
								</div>

								<div class="col-md-3">
									<label style="font-size: 12px;">Es Elegido por los Editores?</label>
									<select class="form-control" id="EleccionArticulo" onchange="seleccionar_tipo_articulo()">
										<option value="0">NO</option>
										<option value="1">SI</option>										
									</select>						
								</div>


								<div class="col-md-12" id="contenedor_videos">
									
									<label style="font-size: 12px;">Seleccione Video</label>

									<div class="input-group mb-3">
									  <input type="text" class="form-control" id="URLVideoArticulo" aria-label="Recipient's username" aria-describedby="basic-addon2" value="@if($data_articulo!=''){{$data_articulo[0]->URLVideoArticulo}}@endif">
									  <div class="input-group-append" id="btn_media_3">
									    <span class="input-group-text" id="basic-addon2"><i class="fa fa-search" aria-hidden="true"></i></span>
									  </div>
									</div>

								</div>


								<div class="col-md-12" id="contenedor_audios">
									
									<label style="font-size: 12px;">Seleccione Audio</label>

									<div class="input-group mb-3">
									  <input type="text" class="form-control" id="URLAudioArticulo" aria-label="Recipient's username" aria-describedby="basic-addon2" value="@if($data_articulo!=''){{$data_articulo[0]->URLAudioArticulo}}@endif">
									  <div class="input-group-append" id="btn_media_4">
									    <span class="input-group-text" id="basic-addon2"><i class="fa fa-search" aria-hidden="true"></i></span>
									  </div>
									</div>

								</div>

								


								
							</div>
											

							<div class="row">				
								<div class="col-md-12">
									<label style="font-size: 12px;">Contenido</label>
									<small>Para Agregar Públicidad de Google Ads, debe agregar @banner@ en el texto.</small>
									<textarea  rows="7" class="form-control html-paginas" id="DescripcionArticulo">@if($data_articulo!=''){{$data_articulo[0]->DescripcionArticulo}}@endif</textarea>
								</div>
							</div>
							
							<hr>
							<h2>CATEGORÍAS <a href="#" id="btn_nueva_categoria" class="btn btn-block btn-outline-primary btn-sm" style="display: inline-block; width: auto;">+ Agregar Categoría</a> </h2>
							<div class="row">
								

								<div class="row">
									<div class="col-md-12" id="listado_categorias">
										@foreach($categorias as $cat)
											<span><input type="checkbox" name=""  class="CategoriasArticulo" idcat="{{$cat->IdCategoria}}" id="cat_arti_{{$cat->IdCategoria}}" > {{$cat->NombreCategoria}}</span> 
											<a href="#" style="cursor: pointer;"  class="edit-categoria"  onclick="editar_categoria({{$cat->IdCategoria}})"><i class="fa fa-edit" aria-hidden="true"></i></a> 
											
											<br />
										@endforeach
									</div>
								</div>
							</div>
							<hr>
							<h2>SEO</h2>
							<div class="row">				
								
								<div class="col-md-4"  style="margin-bottom: 10px;">
									<label style="font-size: 12px;">Robot</label>
									<select class="form-control" id="SEORobotArticulo">
										<option value="index,follow">INDEXAR</option>
										<option value="noindex,nofollow">NO INDEXAR</option>
									</select>						
								</div>


								<div class="col-md-12"  style="margin-bottom: 10px;">						
									
									<label style="font-size: 12px;">Palabras Claves SEO<small>(Separadas por coma)</small></label>
									<input required type="text" name="" value="@if($data_articulo!=''){{$data_articulo[0]->SEOPalabraclaveArticulo}}@endif" class="form-control" placeholder="" id="SEOPalabraclaveArticulo">						

								</div>

								<div class="col-md-12"  style="margin-bottom: 10px;">
									
									<label style="font-size: 12px;">MetaTitulo SEO </label>
									<input required type="text" name="" value="@if($data_articulo!=''){{$data_articulo[0]->SEOTituloArticulo}}@endif" class="form-control" placeholder="" id="SEOTituloArticulo">					
									<small> <strong id="cant_caracteres_1">70</strong> Carácteres Restantes</small>	

								</div>

								<div class="col-md-12" style="margin-bottom: 10px;">						
									
									<label style="font-size: 12px;">MetaDescripción SEO</label>
									<textarea required type="text" name="" class="form-control" id="SEODescripcionCortaArticulo">@if($data_articulo!=''){{$data_articulo[0]->SEODescripcionCortaArticulo}}@endif</textarea> 
									<small> <strong id="cant_caracteres_2">160</strong> Carácteres Restantes</small>	

								</div>

								<div class="col-md-12">
									
									<label style="font-size: 12px;">URL Slug SEO</label>
									<input required type="text" name="" value="@if($data_articulo!=''){{$data_articulo[0]->SEOURLArticulo}}@endif" class="form-control" placeholder="" id="SEOURLArticulo">

								</div>
							</div>

							<hr />
							<h2>OPENGRAPH</h2>
							<div class="row">				
								
								<div class="col-md-12">
									<label style="font-size: 12px;">Imágen OG</label>

									<div class="input-group mb-3">
									  <input type="text" class="form-control" id="URLImagenOG" aria-label="Recipient's username" aria-describedby="basic-addon2" value="@if($data_articulo!=''){{$data_articulo[0]->URLImagenOG}}@endif">
									  <div class="input-group-append" id="btn_media_2">
									    <span class="input-group-text" id="basic-addon2"><i class="fa fa-search" aria-hidden="true"></i></span>
									  </div>
									</div>

								</div>



							</div>
							

						</form>


					</div>



					<div class="col-md-1">
						<a href="#" id="btn_guardar_articulo">
							<img src="{{url('')}}/assets-blog/images/boton_guardar.png" style="width: 55px; height: 55px; position: fixed; top: 225px; right: 25px;">
						</a>

						<a href="#" id="add_recurso">
							<img src="{{url('')}}/assets-blog/images/boton_assets.png" style="width: 55px; height: 55px; position: fixed; top: 295px; right: 25px; z-index: 99999999999999;">
						</a>

						@if($data_articulo!='')
						<a href="{{url('')}}/blog/{{$data_articulo[0]->SlugArticulo}}" id="btn_view" target="_blank">
							<img src="{{url('')}}/assets-blog/images/boton_view.png" style="width: 55px; height: 55px; position: fixed; top: 365px; right: 25px; z-index: 99999999999999;">
						</a>
						@endif
					</div>


				</div>


              </div>
            </div>
          </div>          
          
          
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->




<!-- Modal -->
<div class="modal fade" id="sel-recurso" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="z-index: 9999999999999;">
  <div class="modal-dialog modal-lg" role="document" style="z-index: 9999999999;">
    <div class="modal-content"  style="z-index: 9999999999;">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Seleccionar Recurso</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        
        <div class="row">
          <div class="col-md-8" style="height: 280px; overflow-y: auto;" id="contenedor_media">
                

				 


          </div>

          <div class="col-md-4">
              <small>Nombre Recurso o Texto Alternativo</small>
              <input type="text" class="form-control" id="nombre_recurso_sel">                  

              <small>URL Recurso</small>
              <input type="text" class="form-control" id="url_recurso_sel">

              <small>Código Embed</small>
              <textarea class="form-control" id="codigo_embed_sel" rows="5"></textarea>
              <a href="#" id="btn_visualizar" target="_blank"  class="btn btn-success" style="width: 41px; padding: 12px; position: absolute;top: -26px;right: -14px;" ><i class="fa fa-eye" aria-hidden="true"></i></a>
          </div>
          
        </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary" id="btn_seleccionar_media">Seleccionar</button>
      </div>
    </div>
  </div>
</div>







<!-- Modal -->
<div class="modal fade" id="nueva-categoria" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="z-index: 9999999999999;">
  <div class="modal-dialog" role="document" style="z-index: 9999999999;">
    <div class="modal-content"  style="z-index: 9999999999;">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Nueva Categoría</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        
        <div class="row">
          <div class="col-md-12">
               
            <form id="form_categoria">
            	
            
				<small>Nombre Categoría</small>
	            <input type="text" class="form-control" id="NombreCategoria" required>

	            <small>Slug Categoría</small>
	            <input type="text" class="form-control" id="SlugCategoria" required>

            </form>

          </div>          
          
        </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary" id="btn_guardar_categoria">Guardar</button>
      </div>
    </div>
  </div>
</div>



@stop

@section('scripts')
  <script type="text/javascript">


	//carga inicial


	$(".edit-categoria").click(function(e){
		e.preventDefault();
	});

	var arra_categoria=new Object();

	arra_categoria=[
		@foreach($categorias as $cat)
			{
				"IdCategoria":"{{$cat->IdCategoria}}",
				"NombreCategoria":"{{$cat->NombreCategoria}}",
				"SlugCategoria":"{{$cat->SlugCategoria}}",
			},
		@endforeach
	];


	$( document ).ready(function() {

		
		@if($data_articulo!='')
			<?php

			$arra_articulo_cat=$data_articulo[0]->categoriaarticulo;

			for($j=0;$j<count($arra_articulo_cat);$j++){
				?>
					$("#cat_arti_{{$arra_articulo_cat[$j]->IdCategoria}}").prop("checked",true);
				<?php
			}

			?>
	   		$("#IdAutor").val("@if($data_articulo!=''){{$data_articulo[0]->IdAutor}}@endif");
	   		$("#IdEstadoArticulo").val("@if($data_articulo!=''){{$data_articulo[0]->IdEstadoArticulo}}@endif");
	   		$("#DestacadoArticulo").val("@if($data_articulo!=''){{$data_articulo[0]->DestacadoArticulo}}@endif");
	   		$("#EleccionArticulo").val("@if($data_articulo!=''){{$data_articulo[0]->EleccionArticulo}}@endif");
	   		
	   		
	   		$("#IdTipoArticulo").val("@if($data_articulo!=''){{$data_articulo[0]->IdTipoArticulo}}@endif");
	   		seleccionar_tipo_articulo();
	   		$("#SEORobotArticulo").val("@if($data_articulo!=''){{$data_articulo[0]->SEORobotArticulo}}@endif");
	   		$("#SEORobotArticulo").val("@if($data_articulo!=''){{$data_articulo[0]->SEORobotArticulo}}@endif");
   		@endif
	});


    
    var url_pag_principal="{{url('')}}";

    var arra_obj_articulos=new Object();
    


    tinymce.init({
    
    setup: function (ed) {
        ed.on('init', function(args) {
           $("#cargar-componentes").modal("hide");
        });
    },


    selector: ".html-paginas",

    
  fontsize_formats: '8pt 10pt 12pt 14pt 18pt 24pt 36pt 42pt 52pt',

  relative_urls : false,

  remove_script_host : false,
  extended_valid_elements : "ins[class|style|data-ad-client|data-ad-slot],a[id|class|name|href|target|title|onclick|rel|data-toggle|data-parent],script[async|type|src],iframe[src|style|width|height|scrolling|marginwidth|marginheight|frameborder|allowfullscreen|class],img[class|src|border=0|alt|title|hspace|vspace|width|height|align|onmouseover|onmouseout|name|style|id|onclic]",
    plugins: [
        "advlist autolink lists link image charmap print preview anchor",
        "searchreplace visualblocks code fullscreen",
        "insertdatetime media table contextmenu paste",
        "textcolor colorpicker"
    ],
    toolbar: "insertfile undo redo | fontsizeselect | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | forecolor backcolor"
});





$('#tabla_generica').dataTable( { 
      "ordering": true, 
      "info": false, 
      "lengthChange": true,
      "searching": true,
      "language": {
          "search": "Buscar Artículos:",
          "lengthMenu": "Mostrar _MENU_ Artículos por Página"
        }
    } );





$("#add_recurso").click(function(e){
	$("#btn_seleccionar_media").hide();
	$(".container-recurso").show();
	$("#sel-recurso").modal("show");
	cargar_media();

});

var tipo_modal_media="";

var arra_obj_media=new Object();

var IdCategoria="";

function editar_categoria(idcategoria){

	var ind_cat=get_index_categoria(idcategoria);

	$("#nueva-categoria").modal("show");
  	$("#NombreCategoria").val(""+arra_categoria[ind_cat].NombreCategoria);
   	$("#SlugCategoria").val(""+arra_categoria[ind_cat].SlugCategoria);	
	IdCategoria=""+idcategoria;
}

function get_index_categoria(idcategoria){
	var index_cat=-1;
	for(var i=0;i<arra_categoria.length;i++){
		if(arra_categoria[i].IdCategoria==idcategoria){
			index_cat=i;
			break;
		}
	}

	return index_cat;
}

var IdMediaSel="";
    function seleccionar_media(id_media){
      var index_media=get_index_media(id_media);

      var tipo_media=arra_obj_media[index_media].IdTipoMedia;

      IdMediaSel=arra_obj_media[index_media].IdMedia;

      var codigo_embed="";

      var path_tipo_media="";


      if(tipo_media=="1"){
         path_tipo_media="images";        
         codigo_embed='<img alt="'+arra_obj_media[index_media].NombreMedia+'" style="width:100%;" src="'+url_pag_principal+'/assets-blog/'+path_tipo_media+'/'+arra_obj_media[index_media].URLMedia+'">';
      }

      if(tipo_media=="2"){
         path_tipo_media="videos";
      }

      if(tipo_media=="3"){
         path_tipo_media="pdf";
         codigo_embed='<a class="btn btn-success" target="_blank" href="'+url_pag_principal+'/assets-blog/'+path_tipo_media+'/'+arra_obj_media[index_media].URLMedia+'">DESCARGAR PDF</a>';


      }

      if(tipo_media=="4"){
         path_tipo_media="audios";
         codigo_embed='<audio controls><source src="'+url_pag_principal+'/assets-blog/'+path_tipo_media+'/'+arra_obj_media[index_media].URLMedia+'" type="audio/mpeg">Your browser does not support the audio element.</audio>';
      }


      $("#codigo_embed_sel").val(codigo_embed);
      $("#nombre_recurso_sel").val(""+arra_obj_media[index_media].NombreMedia);
      $("#url_recurso_sel").val("{{url('')}}/assets-blog/"+path_tipo_media+"/"+arra_obj_media[index_media].URLMedia);

      $("#btn_visualizar").attr("href","{{url('')}}/assets-blog/"+path_tipo_media+"/"+arra_obj_media[index_media].URLMedia);

    }

    function get_index_media(id_media){
      var index_media=-1;
       for(var i=0;i<arra_obj_media.length; i++){
          if(arra_obj_media[i].IdMedia==id_media){
            index_media=i;
          }
       }
       return index_media;
    }





    function seleccionar_imagen_popup(){
    	if(tipo_modal_media=="1"){
    		$("#URLImagenArticulo").val(""+$("#url_recurso_sel").val());
    		$("#imagen_destacada").attr("src",""+$("#url_recurso_sel").val());    		
    	}

    	if(tipo_modal_media=="2"){
    		$("#URLImagenOG").val(""+$("#url_recurso_sel").val());    		
    	}

    	if(tipo_modal_media=="3"){
    		$("#URLVideoArticulo").val(""+$("#url_recurso_sel").val());    		
    	}

    	if(tipo_modal_media=="4"){
    		$("#URLAudioArticulo").val(""+$("#url_recurso_sel").val());    		
    	}



    	$('#sel-recurso').modal("hide");    	
    }



    $("#btn_seleccionar_media").click(function(e){
    	seleccionar_imagen_popup();
    });



    $("#btn_media_1").click(function(){
    	tipo_modal_media="1";
		$('#sel-recurso').modal("show");
		$(".container-recurso").hide();
		$(".content_media_1").show();
		cargar_media();
    });

    $('#sel-recurso').on('hidden.bs.modal', function (e) {
  		$("#codigo_embed_sel").val("");
      	$("#nombre_recurso_sel").val("");
      	$("#url_recurso_sel").val("");
      	$("#btn_visualizar").attr("href","");
      	$("#btn_seleccionar_media").show();
	});


    //seleccionar opengraphç

    $("#btn_media_2").click(function(e){
    	tipo_modal_media="2";
		$('#sel-recurso').modal("show");
		$(".container-recurso").hide();
		$(".content_media_1").show();
		cargar_media();
    });

    //seleccionar videos
    $("#btn_media_3").click(function(e){
    	tipo_modal_media="3";
		$('#sel-recurso').modal("show");
		$(".container-recurso").hide();
		$(".content_media_2").show();
		cargar_media();
    });

    //seleccionar audio
    $("#btn_media_4").click(function(e){
    	tipo_modal_media="4";
		$('#sel-recurso').modal("show");
		$(".container-recurso").hide();
		$(".content_media_4").show();
		cargar_media();
    });



    $("#btn_guardar_categoria").click(function(e){
    	e.preventDefault();
    	$("#form_categoria").submit();
    });




    $("#btn_nueva_categoria").click(function(e){
    	e.preventDefault();
		abrir_nueva_categoria();    	
    });

    function abrir_nueva_categoria(){
    	limpiar_categoria();
    	$("#nueva-categoria").modal("show");
    }

    function limpiar_categoria(){
    	$("#NombreCategoria").val("");
    	$("#SlugCategoria").val("");
    	IdCategoria="";
    }



    $("#form_categoria").submit(function(e){
    	e.preventDefault();
		guardar_categoria();    	
    });

    $("#NombreCategoria").focusout(function(){
    	var slugBasicos=$("#NombreCategoria").val();
    	slugBasicos=slug(slugBasicos);
		if($("#SlugCategoria").val()==""){
			$("#SlugCategoria").val(""+slugBasicos);
		}		
    });




     function guardar_categoria(){
      var NombreCategoria=$("#NombreCategoria").val();
      var SlugCategoria=$("#SlugCategoria").val();
      var formData = new FormData();        

      
      
      formData.append('NombreCategoria', NombreCategoria);
      formData.append('SlugCategoria', SlugCategoria);
      formData.append('IdCategoria', IdCategoria);
      
      formData.append('_token', "{{ csrf_token() }}");        
    

      var request = $.ajax({
              url: "{{url('')}}/set_categoria",
              type: "POST",
              
              data: formData,
              processData: false,  // tell jQuery not to process the data
              contentType: false  // tell jQuery not to set contentType


            });

            request.done(function(obj) {                  
           
              if(obj.status=="ok"){                              
                alert("El proceso fue generado correctamente");  


                arra_categoria=obj.datos;
                $("#listado_categorias").html("");
                for(var i=0; i<arra_categoria.length;i++){
                	$("#listado_categorias").append('<span><input type="checkbox" name=""  class="CategoriasArticulo" idcat="'+arra_categoria[i].IdCategoria+'" id="cat_arti_'+arra_categoria[i].IdCategoria+'" > '+arra_categoria[i].NombreCategoria+'</span> <a href="#" class="edit-categoria" style="cursor: pointer;" onclick="editar_categoria('+arra_categoria[i].IdCategoria+')"><i class="fa fa-edit" aria-hidden="true"></i></a>  <br />'); 
                }

                $(".edit-categoria").click(function(e){
					e.preventDefault();
				});

                limpiar_categoria();
                $("#nueva-categoria").modal("hide");         
                return;
              }else{                  
                alert("Error!, "+obj.mensaje);
                return;
              }
            });
             //respuesta si falla
            request.fail(function(jqXHR, textStatus) {
              alert( "Error de servidor  " + textStatus );
            });


    }



    

    $("#SEOTituloArticulo").keyup(function(e){
    	var texto_arti=$("#SEOTituloArticulo").val();
    	var cant_total_char=70;

    	var cant_actual=cant_total_char-texto_arti.length;

    	$("#cant_caracteres_1").html(""+cant_actual);
    	
    });

    $("#SEODescripcionCortaArticulo").keyup(function(e){
    	var texto_arti=$("#SEODescripcionCortaArticulo").val();
    	var cant_total_char=160;

    	var cant_actual=cant_total_char-texto_arti.length;

    	$("#cant_caracteres_2").html(""+cant_actual);
    	
    });





    function seleccionar_tipo_articulo(){
    	var IdTipoArticulo = $("#IdTipoArticulo").val();
    	if(IdTipoArticulo=="1"){
    		$("#contenedor_videos").hide();
   			$("#contenedor_audios").hide();
    	}
    	if(IdTipoArticulo=="2"){
    		$("#contenedor_videos").show();
   			$("#contenedor_audios").hide();	
    	}

    	if(IdTipoArticulo=="3"){
    		$("#contenedor_videos").hide();
   			$("#contenedor_audios").show();	
    	}


    }


    // GUARDAR ARTÍCULO


    function get_categorias(){
    	var cadena_categorias="";
    	var arra_cat=$(".CategoriasArticulo");
    	for(var i=0;i<arra_cat.length;i++){
    		var id_cat=$(arra_cat[i]).attr("id");
    		if($("#"+id_cat).is(":checked")){
    			cadena_categorias+=""+$("#"+id_cat).attr("idcat")+",";
    		}
    	}
    	return cadena_categorias;
    }

    $("#TituloArticulo").focusout(function(){
    	var slugBasicos=$("#TituloArticulo").val();
		slugBasicos=slug(slugBasicos);
		if($("#SlugArticulo").val()==""){
			$("#SlugArticulo").val(""+slugBasicos);
		}		

		if($("#SEOURLArticulo").val()==""){
			$("#SEOURLArticulo").val(""+slugBasicos);
		}		

		if($("#SEOTituloArticulo").val()==""){
			$("#SEOTituloArticulo").val(""+$("#TituloArticulo").val());
		}

		if($("#SEOPalabraclaveArticulo").val()==""){
			$("#SEOPalabraclaveArticulo").val(""+$("#TituloArticulo").val());
		}

    });


    $("#btn_guardar_articulo").click(function(e){
    	e.preventDefault();
    	guardar_articulo();
    });

    function guardar_articulo(){		
		var TituloArticulo=$("#TituloArticulo").val();
		var SlugArticulo=$("#SlugArticulo").val();
		
	    var URLImagenArticulo=$("#URLImagenArticulo").val();	    	    
	    var IdAutor=$("#IdAutor").val();
	    var IdEstadoArticulo=$("#IdEstadoArticulo").val();
	    var IdTipoArticulo=$("#IdTipoArticulo").val();

	    var EleccionArticulo=$("#EleccionArticulo").val();
	    var DestacadoArticulo=$("#DestacadoArticulo").val();

	    var URLVideoArticulo=$("#URLVideoArticulo").val();
	    var URLAudioArticulo=$("#URLAudioArticulo").val();
	    var DescripcionArticulo=""+tinymce.get('DescripcionArticulo').getContent();
	    var SEORobotArticulo=$("#SEORobotArticulo").val();
	    var SEOPalabraclaveArticulo=$("#SEOPalabraclaveArticulo").val();	    
	    var SEOTituloArticulo=$("#SEOTituloArticulo").val();
	    var SEODescripcionCortaArticulo=$("#SEODescripcionCortaArticulo").val();
	    var SEOURLArticulo=$("#SEOURLArticulo").val();
	    var URLImagenOG=$("#URLImagenOG").val();
	    var IdCategoriasArticulo=get_categorias();

	    var formData = new FormData();        


	    var IdArticulo="@if($data_articulo!=''){{$data_articulo[0]->IdArticulo}}@endif";
      
      	formData.append('IdArticulo', IdArticulo);
      	formData.append('TituloArticulo', TituloArticulo);
      	formData.append('SlugArticulo', SlugArticulo);
      	formData.append('URLImagenArticulo', URLImagenArticulo);
      	
      	formData.append('IdAutor', IdAutor);
      	formData.append('IdEstadoArticulo', IdEstadoArticulo);
      	formData.append('IdTipoArticulo', IdTipoArticulo);

      	formData.append('DestacadoArticulo', DestacadoArticulo);
      	formData.append('EleccionArticulo', EleccionArticulo);

      	formData.append('URLVideoArticulo', URLVideoArticulo);
      	formData.append('URLAudioArticulo', URLAudioArticulo);
      	formData.append('DescripcionArticulo', DescripcionArticulo);
      	formData.append('SEORobotArticulo', SEORobotArticulo);
      	formData.append('SEOPalabraclaveArticulo', SEOPalabraclaveArticulo);      	
      	formData.append('SEODescripcionCortaArticulo', SEODescripcionCortaArticulo);
      	formData.append('SEOURLArticulo', SEOURLArticulo);

      	formData.append('SEOTituloArticulo', SEOTituloArticulo);
      	
      	formData.append('URLImagenOG', URLImagenOG);     	
      	formData.append('IdCategoriasArticulo', IdCategoriasArticulo);     	
      	
      
      	formData.append('_token', "{{ csrf_token() }}");        



      	var request = $.ajax({
              url: "{{url('')}}/set_articulos",
              type: "POST",
              
              data: formData,
              processData: false,  // tell jQuery not to process the data
              contentType: false  // tell jQuery not to set contentType


            });

            request.done(function(obj) {                  
           
              if(obj.status=="ok"){                              
                alert("El proceso fue generado correctamente");
              	window.open("{{url('')}}/gestion-articulos/"+obj.IdArticulo,"_parent");
                return;
              }else{                  
                alert("Error!, "+obj.mensaje);
                return;
              }
            });
             //respuesta si falla
            request.fail(function(jqXHR, textStatus) {
              alert( "Error de servidor  " + textStatus );
            });



    }


    var slug = function(str) {
	  str = str.replace(/^\s+|\s+$/g, ''); // trim
	  str = str.toLowerCase();

	  // remove accents, swap ñ for n, etc
	  var from = "ãàáäâẽèéëêìíïîõòóöôùúüûñç·/_,:;";
	  var to   = "aaaaaeeeeeiiiiooooouuuunc------";
	  for (var i=0, l=from.length ; i<l ; i++) {
	    str = str.replace(new RegExp(from.charAt(i), 'g'), to.charAt(i));
	  }

	  str = str.replace(/[^a-z0-9 -]/g, '') // remove invalid chars
	    .replace(/\s+/g, '-') // collapse whitespace and replace by -
	    .replace(/-+/g, '-'); // collapse dashes

	  return str;
	  
	};



	function cargar_media(){
		var formData = new FormData();
		formData.append('_token', "{{ csrf_token() }}");        



      	var request = $.ajax({
              url: "{{url('')}}/get_media_ajax",
              type: "POST",
              
              data: formData,
              processData: false,  // tell jQuery not to process the data
              contentType: false  // tell jQuery not to set contentType


            });

            request.done(function(obj) {                  
           
              if(obj.status=="ok"){                              
                
                 var arra_datos_media=obj.data;
                 arra_obj_media=obj.data;
                 var cadena_media="";
                 for(var i =0;i<arra_datos_media.length;i++){
                 	var recurso=arra_datos_media[i];
                 	cadena_media+='<div class="container-recurso content_media_'+recurso.IdTipoMedia+'" onclick="seleccionar_media('+recurso.IdMedia+')">';

                 	if(recurso.IdTipoMedia=="1"){
                 		cadena_media+='<div class="imagen-media" style="background-image: url({{url('')}}/assets-blog/images/'+recurso.URLMedia+'"></div>';	
                 	}else if(recurso.IdTipoMedia=="2"){
                 		cadena_media+='<div class="imagen-media" style="background-image: url({{url('')}}/assets-blog/images/videos.png"></div>';	
                 	}else if(recurso.IdTipoMedia=="3"){
                 		cadena_media+='<div class="imagen-media" style="background-image: url({{url('')}}/assets-blog/images/pdf.png"></div>';	
                 	}else{
                 		cadena_media+='<div class="imagen-media" style="background-image: url({{url('')}}/assets-blog/images/audio.png"></div>';	
                 	}
                 	
                 	cadena_media+='<small>'+recurso.NombreMedia+'</small>';
                 	cadena_media+='</div>';                 	

                 }

                 $("#contenedor_media").html(cadena_media);

              }else{                  
                alert("Error!, "+obj.mensaje);
                return;
              }
            });
             //respuesta si falla
            request.fail(function(jqXHR, textStatus) {
              alert( "Error de servidor  " + textStatus );
            });

		//
	}

/*



                                       
                     

                    

                  </div>


*/

  </script>
@stop













