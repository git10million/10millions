<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Quotation;
use Exception;

class RecursosController extends Controller
{


	//FUNCIONES PARA EL BLOG
	public function index(){    	

    	$tendencias=$this->get_articulos_by('tendencias',3,'','');
    	$populares=$this->get_articulos_by('populares',8,'','');
    	$destacados1=$this->get_articulos_by('destacados1',3,'','');
    	$videosdestacados=$this->get_articulos_by('videosdestacados',12,'','');

    	$ultimasnoticias=$this->get_articulos_by('articuloscat',9,6,'');    	
    	$articulosmunicipios=$this->get_articulos_by('articuloscat',6,1,'');
    	$articulossantandereanos=$this->get_articulos_by('articuloscat',6,12,'');
    	$articulospatrimonio=$this->get_articulos_by('articuloscat',9,11,'');
    	$ultimospost=$this->get_articulos_by('tendencias',4,'','');

    	$configuracion=$this->get_configuracion();


    	$elegidos=$this->get_articulos_by('elegidos',6,'','');


    	$categorias=$this->get_categorias();	
    	

    	$hoy=date("l, d F, Y");
    	$hoy=$this->translate_fecha("{$hoy}");


    	
		return view('index',[				
				"titulo_pagina"=>'El Gran Santander - Periodismo Cultural Independiente',
				"menu"=>"index",
				"descripcion_pagina"=>'Periodismo Cultural Independiente',
				"robot"=>"index,follow",
				"imagenog"=>"",
				"imagen_destacada"=>"",
				"palabras_claves"=>"Noticias de Santander Colombia, Noticias de Santander, Noticias de Bucaramanga",
				"autor"=>"Luis German Gil Galeano",
				"copyright"=>"Diseñado y Desarrollado por Bithooli",
				"canonical"=>"",
				"fechahoy"=>$hoy,
				"clima"=>$this->get_clima(),

				"tendencias"=>$tendencias,
				"categorias"=>$categorias,
				"populares"=>$populares,
				"destacados1"=>$destacados1,
				"videosdestacados"=>$videosdestacados,
				"ultimasnoticias"=>$ultimasnoticias,
				"articulosmunicipios"=>$articulosmunicipios,
				"articulossantandereanos"=>$articulossantandereanos,
				"articulospatrimonio"=>$articulospatrimonio,
				"ultimospost"=>$ultimospost,
				"elegidos"=>$elegidos,
				"configuracion"=>$configuracion



			]);
	}

	public function infoarticulo($slug_articulo){

    	$tendencias=$this->get_articulos_by('tendencias',3,'','');
    	$ultimasnoticias=$this->get_articulos_by('articuloscat',9,6,'');
    	$ultimospost=$this->get_articulos_by('tendencias',4,'','');

    	$sql="UPDATE blog_articulo SET VistasArticulo=VistasArticulo+1 where SlugArticulo='{$slug_articulo}'";
		$result=DB::update($sql);

    	$dataficha=$this->get_articulos_by('ficha',1,'',$slug_articulo,'');

    	$categorias=$this->get_categorias();	

    	$configuracion=$this->get_configuracion();


    	
    	

    	$hoy=date("l, d F, Y");
    	$hoy=$this->translate_fecha($hoy);

    	if(count($dataficha)==0){
    		return "error 404";
    	}else{

    		$dataficha[0]->DescripcionArticulo=str_replace("@banner@", '<div class="banner banner3">'.$configuracion[0]->BannerArticulos.'</div>', $dataficha[0]->DescripcionArticulo);

    		$data_sig=$this->get_siguiente_anterior($dataficha[0]->FechaArticulo,$dataficha[0]->IdArticulo,"siguiente");
    		$data_ant=$this->get_siguiente_anterior($dataficha[0]->FechaArticulo,$dataficha[0]->IdArticulo,"anterior");

    		

			return view('paginaarticulo',[
				"titulo_pagina"=>''.$dataficha[0]->TituloArticulo,
				"menu"=>"blog",
				"descripcion_pagina"=>''.$dataficha[0]->SEODescripcionCortaArticulo,
				"robot"=>"".$dataficha[0]->SEORobotArticulo,
				"imagenog"=>"".($dataficha[0]->URLImagenOG)?$dataficha[0]->URLImagenOG:$dataficha[0]->URLImagenArticulo,
				"imagen_destacada"=>"".$dataficha[0]->URLImagenArticulo,				
				"palabras_claves"=>"".$dataficha[0]->SEOPalabraclaveArticulo,
				"autor"=>"Luis German Gil Galeano",				
				"copyright"=>"Diseñado y Desarrollado por Bithooli",
				"canonical"=>"".url('')."/".$dataficha[0]->SlugArticulo,
				"fechahoy"=>$hoy,
				"clima"=>$this->get_clima(),

				"tendencias"=>$tendencias,
				"categorias"=>$categorias,				
				"ultimasnoticias"=>$ultimasnoticias,				
				"ultimospost"=>$ultimospost,

				"data"=>$dataficha,
				"configuracion"=>$configuracion,
				"data_sig"=>$data_sig,
				"data_ant"=>$data_ant
				

			]);
		}
	}
	
	



	//LISTADO DE CATEGORIAS

	public function infocategorias($slug_cat){

    	$tendencias=$this->get_articulos_by('tendencias',3,'','');
    	$ultimasnoticias=$this->get_articulos_by('articuloscat',9,6,'');
    	$ultimospost=$this->get_articulos_by('tendencias',4,'','');
    	$dataficha=$this->get_categoria_by_slug($slug_cat);
    	$listadoarticulos=$this->get_articulos_by('articuloscatlist','','',$slug_cat);

    	$categorias=$this->get_categorias();	

    	$configuracion=$this->get_configuracion();

    	   	

    	$hoy=date("l, d F, Y");
    	$hoy=$this->translate_fecha($hoy);

		return view('articuloscategorias',[				
				"titulo_pagina"=>'El Gran Santander - '.$dataficha[0]->NombreCategoria,
				"menu"=>"index",
				"descripcion_pagina"=>'Periodismo Cultural Independiente',
				"robot"=>"index,follow",
				"imagenog"=>"",
				"imagen_destacada"=>"",
				"palabras_claves"=>"Noticias de Santander Colombia, Noticias de Santander, Noticias de Bucaramanga",
				"autor"=>"Luis German Gil Galeano",
				"copyright"=>"Diseñado y Desarrollado por Bithooli",
				"canonical"=>"",
				"fechahoy"=>$hoy,
				"clima"=>$this->get_clima(),


				"tendencias"=>$tendencias,
				"categorias"=>$categorias,				
				"ultimasnoticias"=>$ultimasnoticias,				
				"ultimospost"=>$ultimospost,
				"listadoarticulos"=>$listadoarticulos,
				"data"=>$dataficha,
				"configuracion"=>$configuracion

			]);
	}


	//ACERCA DE NOSOTROS

	public function acerca_de_nosotros(){

    	$tendencias=$this->get_articulos_by('tendencias',3,'','');
    	$ultimasnoticias=$this->get_articulos_by('articuloscat',9,6,'');
    	$ultimospost=$this->get_articulos_by('tendencias',4,'','');    	    	
    	$categorias=$this->get_categorias();	
    	$configuracion=$this->get_configuracion();
    	$hoy=date("l, d F, Y");
    	$hoy=$this->translate_fecha($hoy);

		return view('acerca-de-nosotros',[				
				"titulo_pagina"=>'El Gran Santander - Acerca de Nosotros',
				"menu"=>"index",
				"descripcion_pagina"=>'Periodismo Cultural Independiente',
				"robot"=>"index,follow",
				"imagenog"=>"",
				"imagen_destacada"=>"",
				"palabras_claves"=>"Noticias de Santander Colombia, Noticias de Santander, Noticias de Bucaramanga",
				"autor"=>"Luis German Gil Galeano",
				"copyright"=>"Diseñado y Desarrollado por Bithooli",
				"canonical"=>"",
				"fechahoy"=>$hoy,
				"clima"=>$this->get_clima(),

				"tendencias"=>$tendencias,
				"categorias"=>$categorias,				
				"ultimasnoticias"=>$ultimasnoticias,				
				"ultimospost"=>$ultimospost,								
				"configuracion"=>$configuracion

			]);
	}


	//ACERCA DE NOSOTROS

	public function quieres_ser_periodista(){

    	$tendencias=$this->get_articulos_by('tendencias',3,'','');
    	$ultimasnoticias=$this->get_articulos_by('articuloscat',9,6,'');
    	$ultimospost=$this->get_articulos_by('tendencias',4,'','');    	    	
    	$categorias=$this->get_categorias();	
    	$configuracion=$this->get_configuracion();
    	
    	$hoy=date("l, d F, Y");
    	$hoy=$this->translate_fecha($hoy);

		return view('quieres-ser-periodista',[				
				"titulo_pagina"=>'El Gran Santander - ¿Quieres Ser Periodista?',
				"menu"=>"index",
				"descripcion_pagina"=>'Periodismo Cultural Independiente',
				"robot"=>"index,follow",
				"imagenog"=>"",
				"imagen_destacada"=>"",
				"palabras_claves"=>"Noticias de Santander Colombia, Noticias de Santander, Noticias de Bucaramanga",
				"autor"=>"Luis German Gil Galeano",
				"copyright"=>"Diseñado y Desarrollado por Bithooli",
				"canonical"=>"",
				"fechahoy"=>$hoy,
				"clima"=>$this->get_clima(),

				"tendencias"=>$tendencias,
				"categorias"=>$categorias,				
				"ultimasnoticias"=>$ultimasnoticias,				
				"ultimospost"=>$ultimospost,								
				"configuracion"=>$configuracion

			]);
	}

	//ACERCA DE NOSOTROS

	public function resultado_busqueda(){

    	$tendencias=$this->get_articulos_by('tendencias',3,'','');
    	$ultimasnoticias=$this->get_articulos_by('articuloscat',9,6,'');
    	$ultimospost=$this->get_articulos_by('tendencias',4,'','');    	    	
    	$categorias=$this->get_categorias();	
    	$configuracion=$this->get_configuracion();
    	
    	$hoy=date("l, d F, Y");
    	$hoy=$this->translate_fecha($hoy);

		return view('resultado-busqueda',[				
				"titulo_pagina"=>'El Gran Santander - Resultados Búsqueda',
				"menu"=>"index",
				"descripcion_pagina"=>'Periodismo Cultural Independiente',
				"robot"=>"index,follow",
				"imagenog"=>"",
				"imagen_destacada"=>"",
				"palabras_claves"=>"Noticias de Santander Colombia, Noticias de Santander, Noticias de Bucaramanga",
				"autor"=>"Luis German Gil Galeano",
				"copyright"=>"Diseñado y Desarrollado por Bithooli",
				"canonical"=>"",
				"fechahoy"=>$hoy,
				"clima"=>$this->get_clima(),

				"tendencias"=>$tendencias,
				"categorias"=>$categorias,				
				"ultimasnoticias"=>$ultimasnoticias,				
				"ultimospost"=>$ultimospost,								
				"configuracion"=>$configuracion

			]);
	}


	



	function get_articulos_by($tipo,$limit,$categoria,$slugarticulo){


		$condicion_by="";		

		if($tipo=="tendencias"){
			$condicion_by="ORDER BY art.FechaArticulo DESC limit {$limit}";
		}

		if($tipo=="populares"){
			$condicion_by="ORDER BY art.FechaArticulo DESC limit {$limit}";	
		}

		if($tipo=="destacados1"){
			$condicion_by="and art.DestacadoArticulo=1 ORDER BY art.FechaArticulo DESC limit {$limit}";	
		}

		if($tipo=="videosdestacados"){
			$condicion_by="and art.DestacadoArticulo=1 and art.IdTipoArticulo=2 ORDER BY art.FechaArticulo DESC limit {$limit}";		
		}

		if($tipo=="elegidos"){
			$condicion_by="and art.EleccionArticulo=1 ORDER BY art.FechaArticulo DESC limit {$limit}";			
		}

		if($tipo=="articuloscat"){
			$sql="SELECT GROUP_CONCAT(IdArticulo)as IdArticulos FROM blog_categoriaarticulo where IdCategoria={$categoria}";
			$result=DB::select($sql);
			$IdArticulos="";
			if(count($result)>0){
				$IdArticulos="".$result[0]->IdArticulos;
			}
			if($IdArticulos==""){
				return '';
			}
			$condicion_by="and art.IdArticulo in ($IdArticulos) ORDER BY art.FechaArticulo DESC limit {$limit}";		

		}

		if($tipo=="articuloscatlist"){			
			$condicion_by="and art.IdArticulo in (
								SELECT ca.IdArticulo 
								from blog_categoriaarticulo ca
								INNER JOIN blog_categoria c ON c.IdCategoria=ca.IdCategoria
								WHERE c.SlugCategoria='{$slugarticulo}')  ORDER BY art.FechaArticulo DESC ";					
		}



		if($tipo=="ficha"){
			$condicion_by=" AND art.SlugArticulo='{$slugarticulo}'";
		}





		$sql="SELECT art.*, CONCAT_WS(' ',u.NombresUsuario,u.ApellidosUsuarios) as NombreAutor, u.FotoUsuario, u.BioUsuario
			  from blog_articulo art			  
			  INNER JOIN blog_usuario u ON u.IdUsuario = art.IdAutor
			  where art.IdEstado=1 and art.IdEstadoArticulo=2 
			  {$condicion_by}
			  ";
		$result=DB::select($sql);

		for($i=0;$i<count($result);$i++){
			$result[$i]->fechaactual=$this->get_fecha_formato($result[$i]->FechaArticulo,"d F, Y");
			$result[$i]->categorias=$this->get_categorias_articulos($result[$i]->IdArticulo);			
		}

		return $result;
	}

	public function get_categoria_by_slug($slug){
		$sql="SELECT * FROM blog_categoria WHERE SlugCategoria='{$slug}'";
		$result=DB::select($sql);
		return $result;
	}

	public function get_fecha_formato($fecha,$formato){
		$fecha_actual="";
		$d=strtotime("$fecha");
		$fecha_actual=date($formato, $d);
		return $this->translate_fecha($fecha_actual);

	}

	public function translate_fecha($fecha_actual){		
		
		$fecha_actual=str_replace("Monday", "Lun", $fecha_actual);
		$fecha_actual=str_replace("Tuesday", "Mar", $fecha_actual);
		$fecha_actual=str_replace("Wednesday", "Mier", $fecha_actual);
		$fecha_actual=str_replace("Thursday", "Jue", $fecha_actual);
		$fecha_actual=str_replace("Friday", "Vier", $fecha_actual);
		$fecha_actual=str_replace("Saturday", "Sáb", $fecha_actual);
		$fecha_actual=str_replace("Sunday", "Dom", $fecha_actual);

		$fecha_actual=str_replace("June", "Jun", $fecha_actual);

				


		return $fecha_actual;
	}


	public function get_clima(){

		$ip = '190.13.48.181';		
		if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
		    $ip = $_SERVER['HTTP_CLIENT_IP'];
		} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
		    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
		} else {
		    $ip = $_SERVER['REMOTE_ADDR'];
		}

		
		$latlong = explode(",", file_get_contents('https://ipapi.co/' . $ip . '/latlong/'));

		$clima ="";

		if($latlong[0]!="Undefined" || $latlong[1]!="Undefined" ){			
		 $clima = file_get_contents('http://api.openweathermap.org/data/2.5/weather?lat=' . $latlong[0] . '&lon=' . $latlong[1] . '&appid=6a4bf81d0150fc9c4a36a89a5a453713');
		}
		

		$temperatura="26";
    	$ciudad="Santander";
    	if($clima){
    		$clima = json_decode($clima);
	    	$temperatura=($clima->main->feels_like)-273.15;
	    	$ciudad="".$clima->name;
    	}

		return "{$temperatura}ºC, {$ciudad} ";

	}




	public function get_configuracion(){
		$sql="SELECT * FROM blog_configuracion";
		$result=DB::select($sql);
		return $result;	
	}

	public function set_configuracion(Request $request){		
		$input = $request->all();	   

    	$BannerSuperior="".addslashes($input["BannerSuperior"]);
    	$BannerSideBar="".addslashes($input["BannerSideBar"]);
    	$BannerArticulos="".addslashes($input["BannerArticulos"]);
    	$BannerListado="".addslashes($input["BannerListado"]);

    	

    	$BannerSuperiorMobile="".addslashes($input["BannerSuperiorMobile"]);
    	$BannerSideBarMobile="".addslashes($input["BannerSideBarMobile"]);
    	$BannerArticulosMobile="".addslashes($input["BannerArticulosMobile"]);
    	$GoogleAnalytics="".addslashes($input["GoogleAnalytics"]);
    	$PixelFacebook="".addslashes($input["PixelFacebook"]);

    	$sql="UPDATE blog_configuracion set BannerSuperior='$BannerSuperior', BannerSideBar='$BannerSideBar', BannerArticulos='$BannerArticulos', BannerSuperiorMobile='$BannerSuperiorMobile', BannerSideBarMobile='$BannerSideBarMobile', BannerArticulosMobile='$BannerArticulosMobile', GoogleAnalytics='$GoogleAnalytics', PixelFacebook='$PixelFacebook', BannerListado='$BannerListado' where IdConfiguracion=1";
			$result=DB::update($sql);	
    	return response()->json(["status"=>'ok',"mensaje"=>"Proceso generado correctamente."]);


	}

	public function get_siguiente_anterior($fecha,$idarticulo,$tipo){
		$order_by="";
		$condicion="";
		if($tipo=="anterior"){
			$order_by="DESC";
			$condicion="<=";
		}else{
			$order_by="ASC";
			$condicion=">=";
		}
		
		$sql="SELECT * 
			  FROM blog_articulo 
			  where FechaArticulo {$condicion} '$fecha' and IdArticulo!={$idarticulo}
			  ORDER BY FechaArticulo {$order_by}
			  LIMIT 1";	
		$result=DB::select($sql);
		for($i=0;$i<count($result);$i++){
			$result[$i]->fechaactual=$this->get_fecha_formato($result[$i]->FechaArticulo,"d F, Y");
		}
		return $result;		
	}

	

	//FIN FUNCIONES PARA EL BLOG

	

	

	//FUNCIONES PARA EL ADMINISTRADOR



	public function login(){
    	$arra_data=$this->get_media();		
		return view('login',[				
				"titulo_pagina"=>'Backoffice',
				"menu"=>"backoffice"
			]);
	}	    	
    

	public function backoffice(){
    	$arra_data=$this->get_media();		
		return view('backoffice',[				
				"titulo_pagina"=>'Backoffice',
				"menu"=>"backoffice"
			]);
	}	    	


    //LLAMAR VISTA DE RECURSOS
    public function recursos(){
		$arra_data_media=$this->get_media();		
		$controller = new AdminController();
		
		$arra_data=$controller->VerificarSesid();

		$controller_curso = new CursoController();
		$controller_billetera=new BilleteraController();

		if(count($arra_data)==0){
			return view('areacurso.notienespermiso');
		}else{
			$notificaciones=$controller->get_notificaciones($arra_data[0]->IdUsuario);
			return view('areacurso.recursos',[
				"data_recurso"=>$arra_data_media,
				"titulo_pagina"=>'Recursos', 								
				"notificaciones"=>$notificaciones,				
				"menu"=>"blog",
				"data"=>$arra_data,
				
			]);
		}
	}	    	

	//LLAMAR VISTA DE RECURSOS
    public function configuracion(){
		$controller = new AdminController();
		
		$arra_data=$controller->VerificarSesid();

		$arra_data_config=$this->get_configuracion();		
		

		if(count($arra_data)==0){
			return view('areacurso.notienespermiso');
		}else{
			$notificaciones=$controller->get_notificaciones($arra_data[0]->IdUsuario);	
			return view('areacurso.configuracion',[
					"data"=>$arra_data,
					"data_configuracion"=>$arra_data_config[0],
					"titulo_pagina"=>'Configuración', 			
					"notificaciones"=>$notificaciones,				
					"menu"=>"configuracion"
				]);
		}
	}	    	

	//LLAMAR VISTA DE ARTÍCULOS
    public function listado_articulos(){
		


		$controller = new AdminController();
		$arra_data=$controller->VerificarSesid();

		
		if(count($arra_data)==0){
			return view('areacurso.notienespermiso');
		}else{
			$notificaciones=$controller->get_notificaciones($arra_data[0]->IdUsuario);
	    	$arra_data_articulos=$this->get_articulos();
			return view('areacurso.listado-articulos',[
					"data_articulo"=>$arra_data_articulos,
					"data"=>$arra_data,
					"titulo_pagina"=>'Artículos', 				
					"notificaciones"=>$notificaciones,				
					"menu"=>"blog"
				]);
		}

		/*
		$arra_data_media=$this->get_media();		
		$controller = new AdminController();
		
		$arra_data=$controller->VerificarSesid();

		$controller_curso = new CursoController();
		$controller_billetera=new BilleteraController();

		if(count($arra_data)==0){
			return view('areacurso.notienespermiso');
		}else{
			$notificaciones=$controller->get_notificaciones($arra_data[0]->IdUsuario);
			return view('areacurso.recursos',[
				"data_recurso"=>$arra_data_media,
				"titulo_pagina"=>'Recursos', 				
				"titulo_pagina"=>'Listado Recursos', 
				"notificaciones"=>$notificaciones,				
				"menu"=>"billetera",
				"data"=>$arra_data,
				
			]);
		}
		*/
	}	    	

	//LLAMAR VISTA DE ARTÍCULOS
    public function gestion_articulos($id_articulo=null){

		$controller = new AdminController();
		$arra_data=$controller->VerificarSesid();
		
		if(count($arra_data)==0){
			return view('areacurso.notienespermiso');
		}else{

			$arra_articulos_edit="";
			if($id_articulo){
				$arra_articulos_edit=$this->get_articulos($id_articulo,null);
			}

			$notificaciones=$controller->get_notificaciones($arra_data[0]->IdUsuario);

	    	
	    	$arra_datos_media=$this->get_media();	
	    	$arra_datos_categoria=$this->get_categorias();	
	    	$arra_autores=$this->get_autores();
			return view('areacurso.gestion-articulos',[
					"data"=>$arra_data,
					"data_articulo"=>$arra_articulos_edit,
					"titulo_pagina"=>'Artículos', 				
					"menu"=>"articulos",
					"recursos"=>$arra_datos_media,
					"categorias"=>$arra_datos_categoria,
					"autores"=>$arra_autores,
					"notificaciones"=>$notificaciones

				]);
		}
	}	  







	public function get_media($id_usuario=null){
		$consulta="";
		if($id_usuario){
			$consulta=" AND IdUsuario={$id_usuario}";
		}
		$sql="SELECT * FROM blog_media WHERE IdEstado=1 {$consulta}  order by FechaMedia DESC";
		$result=DB::select($sql);
		return $result;
	}


	public function set_recursos(Request $request){		
		$input = $request->all();	   	
    	$IdMedia="".$input["IdMedia"];
    	$NombreMedia="".$input["nombre_recurso"];

    	$controltamanioimagen = 2*1024*1024;
		//definir fecha/hora para componer en el nombre dinamica de la imagen cargada
		$fileName = date("YmdHms");
		//definir la ubicación en donde se guardara la imagen de logos
		$destinationPathlogo = "assets-blog";
		$folder_path="";

		$IdTipoMedia="";

	   	//INICIO LOGO
		$nombrefoto="";
		//$FotoPersona = Input::file('FotoPersona');
		$FotoPersona = $request->file('archivo_recurso');

		if ($FotoPersona){
		
			//obtiene la extensión de la imagen cargada
			$extensionfoto = $FotoPersona->getClientOriginalExtension();

			$extensionfoto=strtolower($extensionfoto);
			
			//Validar la extensión jpg, png, gif, jpeg
			if ($extensionfoto == "jpg" || $extensionfoto == "png" || $extensionfoto == "gif" || $extensionfoto == "jpeg"){
				$IdTipoMedia="1";
				$folder_path="images";
			}

			if ($extensionfoto == "mp4"){
				$IdTipoMedia="2";
				$folder_path="videos";
			}

			if ($extensionfoto == "pdf"){
				$IdTipoMedia="3";
				$folder_path="pdf";
			}

			if ($extensionfoto == "mp3"){
				$IdTipoMedia="4";
				$folder_path="audios";
			}

			//validar tamaño
			$sizelogo = $FotoPersona->getSize();
			/*if($controltamanioimagen<$sizelogo){				
				return Response::json(array("status"=>'error',"mensaje"=>"El tamaño del archivo debe ser menor a 2Mb"));
			}*/
			
			//Arma el nombre de la imagen cargada
			$Nombreslugmedia=$this->createSlug($NombreMedia);
			$nombrefoto = $Nombreslugmedia.".".$extensionfoto;

			//Guarda la imagen en la ruta específica
			$FotoPersona->move($destinationPathlogo."/".$folder_path."/", $nombrefoto);
			

		}


    	if($IdMedia==""){
    		$sql="INSERT INTO blog_media set NombreMedia='{$NombreMedia}', IdUsuario=1, IdTipoMedia='{$IdTipoMedia}', URLMedia='{$nombrefoto}', IdEstado=1 ";
			$result=DB::insert($sql);	
    	}else{
    		$sql="UPDATE blog_media set NombreMedia='{$NombreMedia}', IdUsuario=1 WHERE IdMedia={$IdMedia}";
			$result=DB::update($sql);	
    	}

    	return response()->json(["status"=>'ok',"mensaje"=>"Proceso generado correctamente."]);
	}


	public function eliminar_recurso(Request $request){		
		$input = $request->all();	   	
    	$IdMedia="".$input["IdMedia"];
    	$sql="UPDATE blog_media set IdEstado='0', IdUsuario=1 WHERE IdMedia={$IdMedia}";
			$result=DB::update($sql);	
    	return response()->json(["status"=>'ok',"mensaje"=>"Proceso generado correctamente."]);
	}

	public static function createSlug($str, $delimiter = '-'){

	    $slug = strtolower(trim(preg_replace('/[\s-]+/', $delimiter, preg_replace('/[^A-Za-z0-9-]+/', $delimiter, preg_replace('/[&]/', 'and', preg_replace('/[\']/', '', iconv('UTF-8', 'ASCII//TRANSLIT', $str))))), $delimiter));
	    return $slug;

	} 


	public function get_articulos($id_articulo=null,$id_usuario=null){

		$filtro="";

		if($id_usuario){
			$filtro=" AND ar.IdUsuario={$id_usuario}";
		}

		if($id_articulo){
			$filtro.=" AND ar.IdArticulo={$id_articulo}";	
		}

		$sql="SELECT ar.*,''as categoriaarticulo, CONCAT_WS(' ',u.NombresUsuario,u.ApellidosUsuarios) as AutorArticulo
			 FROM blog_articulo ar
			 INNER JOIN blog_usuario u ON u.IdUsuario = ar.IdAutor
			 WHERE 1 $filtro order by ar.FechaArticulo DESC";
		$result=DB::select($sql);


		for($i=0;$i<count($result);$i++){
			$result[$i]->categoriaarticulo=$this->get_categorias_articulos($result[$i]->IdArticulo);
		}

		return $result;
	}


	public function get_categorias(){
		$sql="SELECT cat.*, (select count(*) from blog_categoriaarticulo where IdCategoria=cat.IdCategoria) as CantArticulos
		FROM blog_categoria cat";
		$result=DB::select($sql);
		return $result;	
	}

	public function get_categorias_articulos($IdArticulo){
		$sql="SELECT ca.*, cat.NombreCategoria, cat.SlugCategoria
			 FROM blog_categoriaarticulo ca
			 INNER JOIN blog_categoria cat ON cat.IdCategoria = ca.IdCategoria
			 where ca.IdArticulo={$IdArticulo}";
		$result=DB::select($sql);
		return $result;	
	}

	public function get_autores(){
		$sql="SELECT * FROM blog_usuario";
		$result=DB::select($sql);
		return $result;	
	}


	public function set_categoria(Request $request){		
		$input = $request->all();	   	
    	$NombreCategoria="".$input["NombreCategoria"];
    	$SlugCategoria="".$input["SlugCategoria"];
    	$IdCategoria="".$input["IdCategoria"];

    	$NombreCategoria=strtoupper($NombreCategoria);


    	if($IdCategoria==""){
    		$sql="INSERT INTO blog_categoria SET NombreCategoria='{$NombreCategoria}', SlugCategoria='{$SlugCategoria}' ";
    		$result=DB::insert($sql);	
    		$IdCategoria = DB::getPdo()->lastInsertId();
    	}else{
    		$sql="UPDATE blog_categoria SET NombreCategoria='{$NombreCategoria}', SlugCategoria='{$SlugCategoria}' WHERE IdCategoria={$IdCategoria}";
    		$result=DB::update($sql);
    	}    	
    	$categorias=$this->get_categorias();

    	return response()->json(["status"=>'ok',
    			"mensaje"=>"Proceso generado correctamente.",
    			"NombreCategoria"=>$NombreCategoria,
    			"IdCategoria"=>$IdCategoria,
    			"datos"=>$categorias]);
	}



	public function set_articulos(Request $request){		
		$input = $request->all();
    	$IdArticulo="".$input["IdArticulo"];

    	$TituloArticulo="".$input["TituloArticulo"];
    	$SlugArticulo="".$input["SlugArticulo"];
      	$URLImagenArticulo="".$input["URLImagenArticulo"];
      	
      	
      	$IdAutor="".$input["IdAutor"];
      	$IdEstadoArticulo="".$input["IdEstadoArticulo"];
      	$IdTipoArticulo="".$input["IdTipoArticulo"];

      	$DestacadoArticulo="".$input["DestacadoArticulo"];
      	$EleccionArticulo="".$input["EleccionArticulo"];

      	$URLVideoArticulo="".$input["URLVideoArticulo"];
      	$URLAudioArticulo="".$input["URLAudioArticulo"];
      	$DescripcionArticulo="".$input["DescripcionArticulo"];
      	$SEORobotArticulo="".$input["SEORobotArticulo"];
      	$SEOPalabraclaveArticulo="".$input["SEOPalabraclaveArticulo"];
      	$SEODescripcionCortaArticulo="".$input["SEODescripcionCortaArticulo"];
      	$SEOURLArticulo="".$input["SEOURLArticulo"];
      	$SEOTituloArticulo="".$input["SEOTituloArticulo"];
      	
      	$URLImagenOG="".$input["URLImagenOG"];
      	$IdCategoriasArticulo="".$input["IdCategoriasArticulo"];

      	$arraCategorias=explode(",",$IdCategoriasArticulo);

      	if($IdArticulo==""){

			$sql="INSERT INTO blog_articulo SET TituloArticulo='{$TituloArticulo}', URLImagenArticulo='{$URLImagenArticulo}', FechaArticulo=now(), IdAutor='{$IdAutor}', IdEstadoArticulo='{$IdEstadoArticulo}', IdTipoArticulo={$IdTipoArticulo}, URLVideoArticulo='{$URLVideoArticulo}', URLAudioArticulo='{$URLAudioArticulo}', DescripcionArticulo='{$DescripcionArticulo}', SEORobotArticulo='{$SEORobotArticulo}', SEOPalabraclaveArticulo='{$SEOPalabraclaveArticulo}', SEODescripcionCortaArticulo='{$SEODescripcionCortaArticulo}',  SEOURLArticulo='{$SEOURLArticulo}', URLImagenOG='{$URLImagenOG}', IdEstado=1, SEOTituloArticulo='{$SEOTituloArticulo}', SlugArticulo='{$SlugArticulo}', EleccionArticulo='{$EleccionArticulo}', DestacadoArticulo='{$DestacadoArticulo}' ";

			$result=DB::insert($sql);	
    		$IdArticulo = DB::getPdo()->lastInsertId();


      	}else{
      		$sql="UPDATE blog_articulo SET TituloArticulo='{$TituloArticulo}', URLImagenArticulo='{$URLImagenArticulo}',  IdAutor='{$IdAutor}', IdEstadoArticulo='{$IdEstadoArticulo}', IdTipoArticulo={$IdTipoArticulo}, URLVideoArticulo='{$URLVideoArticulo}', URLAudioArticulo='{$URLAudioArticulo}', DescripcionArticulo='{$DescripcionArticulo}', SEORobotArticulo='{$SEORobotArticulo}', SEOPalabraclaveArticulo='{$SEOPalabraclaveArticulo}', SEODescripcionCortaArticulo='{$SEODescripcionCortaArticulo}',  SEOURLArticulo='{$SEOURLArticulo}', URLImagenOG='{$URLImagenOG}', SEOTituloArticulo='{$SEOTituloArticulo}', SlugArticulo='{$SlugArticulo}', EleccionArticulo='{$EleccionArticulo}', DestacadoArticulo='{$DestacadoArticulo}'  WHERE IdArticulo='{$IdArticulo}' ";

			$result=DB::update($sql);	



			$sql="DELETE FROM blog_categoriaarticulo WHERE IdArticulo='{$IdArticulo}'";
			$result=DB::delete($sql);	





      	}


      	for($i=0;$i<count($arraCategorias);$i++){
			if($arraCategorias[$i]!=""){
				$sql="INSERT INTO blog_categoriaarticulo SET IdCategoria='{$arraCategorias[$i]}', IdArticulo='{$IdArticulo}'";
				$result=DB::insert($sql);	
			}
		}


      	return response()->json(["status"=>'ok',"mensaje"=>"Proceso generado correctamente.","IdArticulo"=>$IdArticulo]);

	}



	public function delete_articulos(Request $request){		
		$input = $request->all();
    	$IdArticulo="".$input["IdArticulo"];
    	$IdEstado="".$input["IdEstado"];
    	$sql="UPDATE blog_articulo SET IdEstado='{$IdEstado}' where  IdArticulo='{$IdArticulo}'";
		$result=DB::insert($sql);	
		return response()->json(["status"=>'ok',"mensaje"=>"Proceso generado correctamente."]);
    }



    //FUNCION PARA LOGIN DOCTTUS
	//Desarrollador: ANGEL FERNANDO LIZCANO
    public function login_ajax(Request $request){	
    	$input = $request->all();	
		$usuario="".$input["EmailUsuario"];
		$password="".$input["PasswordUsuario"];		
		
		$sql_sentencia="SELECT *
						FROM blog_usuario
						WHERE EmailUsuario='{$usuario}' and PasswordUsuario=password('{$password}')";
		$result=DB::select($sql_sentencia);
		$nombre_usuario="";
		foreach($result as $datos){
			$nombre_usuario=$datos->NombresUsuario;
		}

		session(['sesid' => '']);//limpiar sesid
		session(['rol_login' => '']);//limpiar rol login

		if(count($result)>0){			
			/*ASIGNAR SESID*/

			$idrol=$result[0]->IdTipoUsuario;

			$sesid=$this->get_sesid();
			$sql_update="UPDATE blog_usuario SET SesidUsuario='{$sesid}' WHERE EmailUsuario='{$usuario}'";
			$result=DB::update($sql_update);
			session(['sesid' => $sesid]);//asignar a sesion el sesid
			session(['rol_login' => $idrol]);//limpiar sesid
			/*ASIGNAR SESID*/		
			

			return response()->json(["status"=>'ok',"mensaje"=>"Proceso generado correctamente.","nombre"=>$nombre_usuario,"sesid"=>$sesid]);
		}else{			
			return response()->json(["status"=>'error',"mensaje"=>"EL usuario no existe."]);
		}
	}



	public function get_sesid(){
		$sesid="";
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	    $charactersLength = strlen($characters);
	    $randomString = '';
	    for ($i = 0; $i < 120; $i++) {
	        $randomString .= $characters[rand(0, $charactersLength - 1)];
	    }
	    return $randomString;		
	}




	public function VerificarSesid(){
    	$sesid=session('sesid');
    	$sql="SELECT * from blog_usuario where SesidUsuario ='{$sesid}'";
		$result=DB::select($sql);
		return $result;
    }



    public function get_media_ajax(){
    	$sql_sentencia="SELECT * FROM blog_media WHERE IdEstado=1 order by FechaMedia DESC";
		$result=DB::select($sql_sentencia);
    	return response()->json(["status"=>'ok',"mensaje"=>"Proceso generado correctamente.","data"=>$result]);
    }

    public function set_megusta(Request $request){	
    	$input = $request->all();	
		$tipo="".$input["tipo"];
		$idarticulo="".$input["idarticulo"];
		$updat_like="";
		if($tipo=="like"){
			$update_like=" LikeArticulo=LikeArticulo+1 ";
		}else{
			$update_like=" NoLikeArticulo=NoLikeArticulo+1 ";
		}

    	$sql="UPDATE blog_articulo SET {$update_like} WHERE IdArticulo={$idarticulo}";
    	$result=DB::update($sql);	
    	return response()->json(["status"=>'ok',"mensaje"=>"Proceso generado correctamente."]);


    }


    //LLAMA VISTA DE LISTADO USUARIOS

    public function listado_usuarios(){
    	$arra_data=$this->VerificarSesid();
		if(count($arra_data)==0){
			return view('notienespermiso');
		}else{
	    	$arra_data=$this->get_usuarios('');		
			return view('listado-usuarios',[
					"data"=>$arra_data,
					"titulo_pagina"=>'Usuarios', 				
					"menu"=>"usuarios"
				]);
		}
	}	    	


	public function gestion_usuarios($idusuario=null){
    	$arra_data=$this->VerificarSesid();
    	$arra_tipo=$this->get_tipos_usuarios();
		if(count($arra_data)==0){
			return view('notienespermiso');
		}else{

			$arra_usuario_edit="";
			if($idusuario){
				$arra_usuario_edit=$this->get_usuarios($idusuario);
			}

	    	
			return view('gestion-usuarios',[
					"data"=>$arra_usuario_edit,
					"tipo_usuario"=>$arra_tipo,
					"titulo_pagina"=>'Gestión Usuarios', 				
					"menu"=>"usuarios"
				]);
		}
	}

    //GET USUARIOS

    public function get_usuarios($idusuario){		
    	$sql_consulta="";
    	if($idusuario!=""){
    		$sql_consulta=" AND u.IdUsuario={$idusuario}";
    	}
		$sql="SELECT u.*, tp.NombreTipoUsuario as TipoUsuario
		      FROM blog_usuario u
		      INNER JOIN blog_tipousuario tp ON tp.IdTipoUsuario=u.IdTipoUsuario
		      WHERE 1 {$sql_consulta}
		      ";
		$result=DB::select($sql);

		for($i=0;$i<count($result);$i++){
			if($result[$i]->IdEstado=="1"){
				$result[$i]->EstadoUsuario="ACTIVO";
			}else{
				$result[$i]->EstadoUsuario="INACTIVO";
			}
		}

		return $result;
	}

	//GET USUARIOS

    public function get_tipos_usuarios(){
		$sql="SELECT * FROM blog_tipousuario";
		$result=DB::select($sql);
		return $result;
	}




	public function set_usuario(Request $request){		
		$input = $request->all();	   

		$IdUsuario=$input["IdUsuario"];
    	$CodigoUsuario="".addslashes($input["CodigoUsuario"]);
    	$NombresUsuario="".addslashes($input["NombresUsuario"]);
    	$ApellidosUsuarios="".addslashes($input["ApellidosUsuarios"]);
    	$FotoUsuario="".addslashes($input["FotoUsuario"]);
    	$IdTipoUsuario="".addslashes($input["IdTipoUsuario"]);
    	$EmailUsuario="".addslashes($input["EmailUsuario"]);
    	$PasswordUsuario="".addslashes($input["PasswordUsuario"]);
    	$BioUsuario="".addslashes($input["BioUsuario"]);
    	$FacebookUsuario="".addslashes($input["FacebookUsuario"]);
    	$TwitterUsuario="".addslashes($input["TwitterUsuario"]);
    	$InstagramUsuario="".addslashes($input["InstagramUsuario"]);
    	$WhatsappUsuario="".addslashes($input["WhatsappUsuario"]);
    	$TelefonoUsuario="".addslashes($input["TelefonoUsuario"]);


    	if($IdUsuario==""){

    		$pass="";

    		if($PasswordUsuario!=""){
    			$pass=", PasswordUsuario=password('{$PasswordUsuario}')";
    		}

			$sql="INSERT INTO blog_usuario SET CodigoUsuario='$CodigoUsuario', NombresUsuario='$NombresUsuario',ApellidosUsuarios='$ApellidosUsuarios',
			FotoUsuario='$FotoUsuario',IdTipoUsuario='$IdTipoUsuario',
			EmailUsuario='$EmailUsuario', BioUsuario='$BioUsuario',
			FacebookUsuario='$FacebookUsuario', TwitterUsuario='$TwitterUsuario',
			InstagramUsuario='$InstagramUsuario',
			WhatsappUsuario='$WhatsappUsuario', TelefonoUsuario='$TelefonoUsuario' {$pass}";

			$result=DB::insert($sql);	
    		$IdUsuario = DB::getPdo()->lastInsertId();


      	}else{


      		$pass="";

    		if($PasswordUsuario!=""){
    			$pass=", PasswordUsuario=password('{$PasswordUsuario}')";
    		}

      		$sql="UPDATE blog_usuario SET CodigoUsuario='$CodigoUsuario', NombresUsuario='$NombresUsuario',
      		ApellidosUsuarios='$ApellidosUsuarios',
			FotoUsuario='$FotoUsuario',IdTipoUsuario='$IdTipoUsuario',
			EmailUsuario='$EmailUsuario', BioUsuario='$BioUsuario',
			FacebookUsuario='$FacebookUsuario', TwitterUsuario='$TwitterUsuario',
			InstagramUsuario='$InstagramUsuario',
			WhatsappUsuario='$WhatsappUsuario', TelefonoUsuario='$TelefonoUsuario' {$pass} WHERE IdUsuario={$IdUsuario}";

			$result=DB::update($sql);	

      	}

      	return response()->json(["status"=>'ok',"mensaje"=>"Proceso generado correctamente.","IdUsuario"=>$IdUsuario]);

	}

}
