<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CursoController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AyudaController;
use App\Http\Controllers\BilleteraController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\EmbudoController;
use App\Http\Controllers\EventoController;
use App\Http\Controllers\FormularioController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\RecursosController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

/*
Route::get('/', function () {
    return view('welcome');
});


Route::get('/hola', function () {
    return view('welcome');
});
*/



Route::get('/politicas-de-privacidad/', function(){
    return view('marketing.politicas-de-privacidad', ["id_pagina" => "politicas-de-privacidad"]);
});

Route::get('/politicas-de-cookies/', function(){
    return view('marketing.politicas-de-cookies', ["id_pagina" => "politicas-de-cookies"]);
});


Route::get('/afiliados/', function () {
    return view('marketing.afiliados', ["id_pagina" => "afiliados"]);
});

Route::get('/tutores/', function () {
    return view('marketing.tutores', ["id_pagina" => "tutores"]);
});

Route::get('/terminos-de-uso/', function () {
    return view('marketing.terminos-de-uso', ["id_pagina" => "terminos-de-uso"]);
});
Route::get('/acerca-de-nosotros/', function () {
    return view('marketing.acerca-de-nosotros', ["id_pagina" => "acerca-de-nosotros"]);
});

Route::get('/fichacurso/', function () {
    return view('marketing.fichacurso');
});
Route::get('/contactenos/', function () {
    return view('marketing.contactenos', ["id_pagina" => "contactenos"]);
});

Route::get('/login/', function () {
    return view('marketing.loginapp', ["id_pagina" => "login"]);
});

Route::get('/login-afiliados/', function () {
    return view('marketing.loginapp', ["id_pagina" => "login-afiliados"]);
});

Route::get('/login-tutores/', function () {
    return view('marketing.loginapp', ["id_pagina" => "login-tutores"]);
});
Route::get('/login-root-ten-millions/', function () {
    return view('marketing.loginapp', ["id_pagina" => "login-root"]);
});


// Route::get('/blog/{url_post?}', ['uses' => 'BlogController@vista_blog']);
// Route::get('/categoria/{url_categoria}', ['uses' => 'CursoController@fichacategoria']);
// Route::get('/subcategoria/{url_subcategoria}', ['uses' => 'CursoController@fichasubcategoria']);
// Route::get('/checkout/{url_curso}/{codigo_usuario?}/{id_seguimiento?}', ['uses' => 'CursoController@formcheckout']);
// Route::get('/curso-de-afiliados/', ['uses' => 'EmbudoController@EmbudoLanding']);
// Route::get('/gracias-curso-de-afiliados/', ['uses' => 'EmbudoController@EmbudoGracias']);
// Route::get('/lecciones/', ['uses' => 'EmbudoController@EmbudoLecciones']);
// Route::get('/leccion/{url_leccion}', ['uses' => 'EmbudoController@EmbudoVideo']);
// Route::post('/registrar_leads', ['uses' => 'EmbudoController@RegistroLead']);
// Route::get('/registro/', ['uses' => 'LoginController@registro']);
// Route::get('/registro-afiliados/{NombreUsuario?}', ['uses' => 'LoginController@registroafiliados']);
// Route::get('/registro-tutores/{NombreUsuario?}', ['uses' => 'LoginController@registrotutores']);
// Route::post('/respuesta-hotmart', ['uses' => 'AdminController@respuesta_hotmart']);
// Route::get('/cursos/{url_data}/{CodigoCurso?}/{ProcesoItem?}/{IdItem?}', ['uses' => 'CursoController@cursosdisponibles']);
// Route::get('/curso/{url_curso}', ['uses' => 'CursoController@fichacurso']);
// Route::get('/leccion/{id_leccion}', ['uses' => 'CursoController@fichaleccion']);

Route::get('/blog/{url_post?}', [BlogController::class, 'vista_blog'])->name('blog');
Route::get('/categoria/{url_categoria}', [CursoController::class, 'fichacategoria'])->name('categoria');
Route::get('/subcategoria/{url_subcategoria}', [CursoController::class, 'fichasubcategoria'])->name('subcategoria');
Route::get('/checkout/{url_curso}/{codigo_usuario?}/{id_seguimiento?}', [CursoController::class, 'formcheckout'])->name('checkout');
Route::get('/cursos-ten-millions/{Afiliate?}', [CursoController::class, 'get_cursos_docttus'])->name("cursos-ten");
Route::get('/curso-de-afiliados/', [EmbudoController::class, 'EmbudoLanding'])->name('embudo_landing');
Route::get('/gracias-curso-de-afiliados/', [EmbudoController::class, 'EmbudoGracias'])->name('embudo_gracias');
Route::get('/lecciones/', [EmbudoController::class, 'EmbudoLecciones'])->name('embudo_lecciones');
Route::get('/leccion/{url_leccion}', [EmbudoController::class, 'EmbudoVideo'])->name('embudo_video');
Route::post('/registrar_leads', [EmbudoController::class, 'RegistroLead'])->name('registrar_leads');
Route::get('/registro/', [LoginController::class, 'registro'])->name('registro');
Route::get('/registro-afiliados/{NombreUsuario?}', [LoginController::class, 'registroafiliados'])->name('registro_afiliados');
Route::get('/registro-tutores/{NombreUsuario?}', [LoginController::class, 'registrotutores'])->name('registro_tutores');
Route::post('/respuesta-hotmart', [AdminController::class, 'respuesta_hotmart'])->name('respuesta_hotmart'); 
Route::get('/cursos/{url_data}/{CodigoCurso?}/{ProcesoItem?}/{IdItem?}', [CursoController::class, 'cursosdisponibles'])->name('cursos_disponibles');
Route::get('/curso/{url_curso}', [CursoController::class, 'fichacurso'])->name('ficha_curso');
Route::get('/leccion/{id_leccion}', [CursoController::class, 'fichaleccion'])->name('ficha_leccion');



// Route::post('/verificacion_codigo_token', ['uses' => 'LoginController@verificacion_codigo_token']);
// Route::post('/cambiar_passw', ['uses' => 'LoginController@cambiar_passw']);
// Route::get('/recuperar-password/', ['uses' => 'LoginController@recuperar_password']);
// Route::post('/solicitar_codigo', ['uses' => 'LoginController@solicitar_codigo']);
// Route::get('/verificacion-codigo/{token_verificacion}', ['uses' => 'LoginController@verificacion_codigo']);
 
 Route::post('/verificacion_codigo_token', [LoginController::class, 'verificacion_codigo_token'])->name('verificacion_codigo_token'); 
 Route::post('/cambiar_passw', [LoginController::class, 'cambiar_passw'])->name('cambiar_passw'); 
 Route::get('/recuperar-password/', [LoginController::class, 'recuperar_password'])->name('recuperar_password'); 
 Route::post('/solicitar_codigo', [LoginController::class, 'solicitar_codigo'])->name('solicitar_codigo'); 
 Route::get('/verificacion-codigo/{token_verificacion}', [LoginController::class, 'verificacion_codigo'])->name('verificacion_codigo');





 Route::middleware(['web'])->group(function () {

    Route::get('/backoffice', [AdminController::class, 'backoffice'])->name('backoffice');     
    Route::get('/logout/', [AdminController::class, 'logout'])->name('logout');      
    Route::get('/respuesta', [AdminController::class, 'respuesta'])->name('respuesta');     
    Route::get('/tema/{url_curso}/{tipo_contenido}/{id_contenido?}', [CursoController::class, 'fichacontenido'])->name('ficha_contenido');      
    Route::get('/ayudas/', [AyudaController::class, 'mostrarayudas'])->name('mostrar_ayudas');      
    Route::get('/ayuda/{url_ayuda}', [AyudaController::class, 'verayuda'])->name('ver_ayuda');      
    Route::get('/listado-ventas/{tipo_filtro?}', [AdminController::class, 'listadoventas'])->name('listado_ventas');      
    Route::get('/listado-ventas-admin/{tipo_filtro?}', [AdminController::class, 'listadoventasadmin'])->name('listado_ventas_admin');      
    Route::get('/retiros/', [AdminController::class, 'listadoretiros'])->name('listado_retiros');     
    Route::post('/get_retiros', [AdminController::class, 'get_retiros'])->name('get_retiros');

    Route::get('/billetera/', [BilleteraController::class, 'billetera_usuario'])->name('billetera');    
    Route::get('/usuario/{codigousuario?}', [UsuarioController::class, 'editarusuario'])->name('editar_usuario');    
    Route::get('/usuario-cursos/', [UsuarioController::class, 'cursosusuario'])->name('cursos_usuario');    
    Route::get('/usuario-habilidades/', [UsuarioController::class, 'habilidadesusuario'])->name('habilidades_usuario');    
    Route::get('/usuario-certificados/', [UsuarioController::class, 'certificadosusuario'])->name('certificados_usuario');    
    Route::get('/listado-usuarios/{tipo_usuario?}', [AdminController::class, 'listadousuarios'])->name('listado_usuarios');    
    Route::get('/listado-cursos', [AdminController::class, 'listadocursos'])->name('listado_cursos');    
    Route::get('/ganar-dinero/{tipo?}', [AdminController::class, 'ganardinero'])->name('ganar_dinero');    
    Route::get('/solicitudes', [AdminController::class, 'solicitudes'])->name('solicitudes');    
    Route::get('/soporte', [AdminController::class, 'soporte'])->name('soporte');

    Route::post('/generar_soporte', [AdminController::class, 'generar_soporte'])->name('generar_soporte');
    Route::get('/actualizaciones', [AdminController::class, 'actualizaciones'])->name('actualizaciones');
    Route::post('/listado_solicitudes', [AdminController::class, 'listado_solicitudes'])->name('listado_solicitudes');
    Route::post('/cambiar_solicitud', [AdminController::class, 'cambiar_solicitud'])->name('cambiar_solicitud');     
    Route::post('/asign_c_f', [AdminController::class, 'asign_c_f'])->name('asign_c_f');
    Route::get('/listado-politicas', [AdminController::class, 'listado_politicas'])->name('listado_politicas');
    Route::get('/editar-politicas/{id_politica?}', [AdminController::class, 'editar_politicas'])->name('editar_politicas');
    Route::get('/politica/{SlugPolitica?}', [AdminController::class, 'ver_politicas'])->name('ver_politicas');
    Route::post('/set_politica', [AdminController::class, 'set_politica'])->name('set_politica');
    Route::get('/listadoestudiantes', [AdminController::class, 'listadoestudiantes'])->name('listadoestudiantes');
    Route::post('/listado_estudiantes', [AdminController::class, 'listado_estudiantes'])->name('listado_estudiantes');
    Route::post('/send_formulario', [FormularioController::class, 'send_formulario'])->name('send_formulario');
    Route::post('/get_formulario_by_usuario', [FormularioController::class, 'get_formulario_by_usuario'])->name('get_formulario_by_usuario');
    Route::get('/c/{url_curso}/{codigo_usuario?}/{id_seguimiento?}', [CursoController::class, 'fichacursoventa'])->name('fichacursoventa');     
    Route::post('/get_tema_gratis', [CursoController::class, 'get_tema_gratis'])->name('get_tema_gratis');
    Route::get('/evento/{slug_evento}/', [EventoController::class, 'evento'])->name('evento');
    Route::get('/gracias/{slug_evento}/', [EventoController::class, 'gracias'])->name('gracias');     
    Route::get('/enlaces-afiliados', [UsuarioController::class, 'enlaces_afiliados'])->name('enlaces_afiliados');
    Route::post('/guardar_checkout', [UsuarioController::class, 'guardar_checkout'])->name('guardar_checkout');
     
     
    
    // Ruta para subir un video a Vimeo
    Route::post('/surbir_vimeo_media', [AdminController::class, 'surbir_vimeo_media'])->name('surbir_vimeo_media');    
    Route::post('/verificacion_vimeo', [AdminController::class, 'verificacion_vimeo'])->name('verificacion_vimeo');    
    Route::post('/eliminar_video_temporal', [AdminController::class, 'eliminar_video_temporal'])->name('eliminar_video_temporal');    
    Route::post('/pendientes_por_subir', [AdminController::class, 'pendientes_por_subir'])->name('pendientes_por_subir');    
    Route::get('/contenido-pendiente', [AdminController::class, 'ContenidoPendiente'])->name('contenido_pendiente');    
    Route::get('/evento-ten-millions/{slug_evento}/', [EventoController::class, 'eventodocttus'])->name('eventodocttus');    
    Route::get('/funnels-pro10x', [EventoController::class, 'crashingpro'])->name('crashingpro');
    Route::get('/minisites', [EventoController::class, 'minisite'])->name('minisite');
    Route::get('/fomo-list', [EventoController::class, 'fomolist'])->name('fomolist');
    Route::get('/fomo', [EventoController::class, 'fomo'])->name('fomo');
    Route::get('/chat-bot-ia', [EventoController::class, 'chatbot'])->name('chatbot');    
    Route::get('/cert/{codigo_certificado}/', [CursoController::class, 'abrir_certificado_public'])->name('abrir_certificado_public');    
    Route::get('/tutor/{usuario_tutor}/{id_afiliado?}', [AdminController::class, 'fichatutor'])->name('fichatutor');    
    Route::post('/login_cursos', [LoginController::class, 'login'])->name('login');
    Route::post('/registrar_usuario', [LoginController::class, 'registrar_usuario'])->name('registrar_usuario');    
    Route::post('/set_avance', [CursoController::class, 'set_avance'])->name('set_avance');
    Route::post('/set_comentarios', [CursoController::class, 'set_comentarios'])->name('set_comentarios');
    Route::post('/eliminar_comentario', [CursoController::class, 'eliminar_comentario'])->name('eliminar_comentario');
    Route::post('/get_comentarios_ajax', [CursoController::class, 'get_comentarios_ajax'])->name('get_comentarios_ajax');    
    Route::post('/set_retiro', [BilleteraController::class, 'set_retiro'])->name('set_retiro');    
    Route::post('/set_usuario', [UsuarioController::class, 'set_usuario'])->name('set_usuario');
    Route::post('/set_password', [UsuarioController::class, 'set_password'])->name('set_password');    
    Route::post('/set_financiero', [UsuarioController::class, 'set_financiero'])->name('set_financiero');    
    Route::post('/set_redes_sociales', [UsuarioController::class, 'set_redes_sociales'])->name('set_redes_sociales');    
    Route::post('/set_descripcion_persona', [UsuarioController::class, 'set_descripcion_persona'])->name('set_descripcion_persona');    
    Route::post('/set_hotmart_usuario', [UsuarioController::class, 'set_hotmart_usuario'])->name('set_hotmart_usuario');    
    Route::post('/solicitar_aprobacion_hotmart', [UsuarioController::class, 'solicitar_aprobacion_hotmart'])->name('solicitar_aprobacion_hotmart');

    Route::post('/estado_solicitud_hotmart', [UsuarioController::class, 'estado_solicitud_hotmart'])->name('estado_solicitud_hotmart');     
    Route::post('/listado_ventas', [AdminController::class, 'get_ventas_usuario'])->name('listado_ventas');
    Route::post('/listado_ventas_admin', [AdminController::class, 'get_ventas_usuario_admin'])->name('listado_ventas_admin');      
    Route::post('/listado_temas_administrador', [AdminController::class, 'listado_temas_administrador'])->name('listado_temas_administrador');
    Route::post('/eliminar_cuenta', [AdminController::class, 'eliminar_cuenta'])->name('eliminar_cuenta');
    Route::post('/listado_usuarios', [AdminController::class, 'listado_usuarios'])->name('listado_usuarios');
    Route::post('/listado_cursos', [AdminController::class, 'get_listado_cursos'])->name('listado_cursos');
    Route::post('/get_info_usuario_by_codigo', [AdminController::class, 'get_info_usuario_by_codigo'])->name('get_info_usuario_by_codigo');
    Route::post('/estado_solicitud', [AdminController::class, 'estado_solicitud'])->name('estado_solicitud');
    Route::post('/estado_solicitud_cursos', [AdminController::class, 'estado_solicitud_cursos'])->name('estado_solicitud_cursos');
    Route::post('/cambiar_destacado', [AdminController::class, 'cambiar_destacado'])->name('cambiar_destacado');
    Route::post('/get_ventas_principal', [AdminController::class, 'get_ventas_principal'])->name('get_ventas_principal');
    Route::post('/enviar_mensaje_generico', [AdminController::class, 'enviar_mensaje_generico'])->name('enviar_mensaje_generico');
    Route::post('/registrar_trafico', [AdminController::class, 'registrar_trafico'])->name('registrar_trafico');
    Route::post('/registrar_deseo', [AdminController::class, 'registrar_deseo'])->name('registrar_deseo');
     
    Route::post('/estado_noticia', [AdminController::class, 'estado_noticia'])->name('estado_noticia');     
    Route::post('/get_ayuda', [AdminController::class, 'get_ayuda_post'])->name('get_ayuda');     
    Route::post('/cambiar_rol', [AdminController::class, 'cambiar_rol'])->name('cambiar_rol');      
    Route::post('/enviar_solicitud', [AdminController::class, 'enviar_solicitud'])->name('enviar_solicitud');
    Route::post('/setcurso', [CursoController::class, 'setcurso'])->name('setcurso');
    Route::post('/editarinformacionbasica', [CursoController::class, 'editarinformacionbasica'])->name('editarinformacionbasica');
    Route::post('/get_estudiantes_by_curso', [CursoController::class, 'get_estudiantes_by_curso'])->name('get_estudiantes_by_curso');
    Route::post('/enviar_curso_publicacion', [CursoController::class, 'enviar_curso_publicacion'])->name('enviar_curso_publicacion');
    Route::post('/set_afiliacion', [CursoController::class, 'set_afiliacion'])->name('set_afiliacion');
    Route::post('/setiniciarexamen', [CursoController::class, 'setiniciarexamen'])->name('setiniciarexamen');
    Route::post('/setfinalizarexamen', [CursoController::class, 'setfinalizarexamen'])->name('setfinalizarexamen');
    Route::post('/editarprecioscurso', [CursoController::class, 'editarprecioscurso'])->name('editarprecioscurso');
    Route::post('/editarevaluacioncurso', [CursoController::class, 'editarevaluacioncurso'])->name('editarevaluacioncurso');
    Route::post('/editarpreguntasevaluacioncurso', [CursoController::class, 'editarpreguntasevaluacioncurso'])->name('editarpreguntasevaluacioncurso');
    Route::post('/getpreguntasevaluacioncurso', [CursoController::class, 'getpreguntasevaluacioncurso'])->name('getpreguntasevaluacioncurso');
    Route::post('/editarrespuestapreguntaevaluacioncurso', [CursoController::class, 'editarrespuestapreguntaevaluacioncurso'])->name('editarrespuestapreguntaevaluacioncurso');
    Route::post('/cambiarestadoevaluacion', [CursoController::class, 'cambiarestadoevaluacion'])->name('cambiarestadoevaluacion');
    Route::post('/editarimagenescurso', [CursoController::class, 'editarimagenescurso'])->name('editarimagenescurso');
    Route::post('/cambiarestadorev', [CursoController::class, 'cambiarestadorev'])->name('cambiarestadorev');
    Route::post('/eliminarcurso', [CursoController::class, 'eliminarcurso'])->name('eliminarcurso');
    
    Route::post('/editarmoduloslecciones', [CursoController::class, 'editarmoduloslecciones'])->name('editarmoduloslecciones');
    Route::post('/editarlecciones', [CursoController::class, 'editarlecciones'])->name('editarlecciones');
    Route::post('/set_media_item', [CursoController::class, 'set_media_item'])->name('set_media_item');
    Route::post('/get_media_item', [CursoController::class, 'get_media_item'])->name('get_media_item');
    Route::post('/editarordenmedia', [CursoController::class, 'editarordenmedia'])->name('editarordenmedia');
    Route::post('/cambiarestadomedia', [CursoController::class, 'cambiarestadomedia'])->name('cambiarestadomedia');
    Route::post('/editarordenlecciones', [CursoController::class, 'editarordenlecciones'])->name('editarordenlecciones');
    Route::post('/editarordenmodulos', [CursoController::class, 'editarordenmodulos'])->name('editarordenmodulos');
    Route::post('/cambiarestadoitem', [CursoController::class, 'cambiarestadoitem'])->name('cambiarestadoitem');
    Route::post('/get_cursos_by_filter', [CursoController::class, 'get_cursos_by_filter'])->name('get_cursos_by_filter');
    Route::post('/get_cursos_hotmart', [CursoController::class, 'get_cursos_hotmart'])->name('get_cursos_hotmart');
    Route::post('/enviar_solicitud_producto', [CursoController::class, 'enviar_solicitud_producto'])->name('enviar_solicitud_producto');
    Route::post('/verificar_solicitud_producto', [CursoController::class, 'verificar_solicitud_producto'])->name('verificar_solicitud_producto');
    Route::post('/editararchivos', [CursoController::class, 'editararchivos'])->name('editararchivos');
    Route::post('/eliminararchivo', [CursoController::class, 'eliminararchivo'])->name('eliminararchivo');
    Route::post('/setcalificacion', [CursoController::class, 'setcalificacion'])->name('setcalificacion');
    Route::post('/enviarmensajecontacto', [AdminController::class, 'enviarmensajecontacto'])->name('enviarmensajecontacto');
    Route::post('/get_cursos_by_usuario', [CursoController::class, 'get_cursos_by_usuario'])->name('get_cursos_by_usuario');
    Route::post('/asignar_curso', [CursoController::class, 'asignar_curso'])->name('asignar_curso');
    
    //BLOG  

    Route::get('/listado-recursos/', [RecursosController::class, 'recursos'])->name('listado-recursos');
    Route::get('/configuracion/', [RecursosController::class, 'configuracion'])->name('configuracion');
    Route::get('/listado-articulos/', [RecursosController::class, 'listado_articulos'])->name('listado-articulos');
    Route::get('/gestion-articulos/{id_articulo?}/', [RecursosController::class, 'gestion_articulos'])->name('gestion-articulos');
    Route::get('/listado-usuarios-blog/', [RecursosController::class, 'listado_usuarios'])->name('listado-usuarios-blog');
    Route::get('/gestion-usuario-blog/{idusuario?}/', [RecursosController::class, 'gestion_usuarios'])->name('gestion-usuario-blog');
    Route::post('/set_media/', [RecursosController::class, 'set_recursos'])->name('set_media');
    Route::post('/eliminar_recurso/', [RecursosController::class, 'eliminar_recurso'])->name('eliminar_recurso');
    Route::post('/get_media_ajax/', [RecursosController::class, 'get_media_ajax'])->name('get_media_ajax');
    Route::post('/set_configuracion/', [RecursosController::class, 'set_configuracion'])->name('set_configuracion'); 
    Route::post('/set_categoria/', [RecursosController::class, 'set_categoria'])->name('set_categoria'); 
    Route::post('/set_articulos/', [RecursosController::class, 'set_articulos'])->name('set_articulos');
    Route::post('/delete_articulos/', [RecursosController::class, 'delete_articulos'])->name('delete_articulos');
    Route::post('/set_megusta/', [RecursosController::class, 'set_megusta'])->name('set_megusta'); 
    Route::post('/set_usuario_blog/', [RecursosController::class, 'set_usuario'])->name('set_usuario_blog');
 });


//RUTA DINÁMICA PARA PARTNERS

Route::get('/leader/{Afiliado}', function ($Afiliado) {
    $sql = "SELECT p.*, u.*
    		  FROM tbl_usuario_persona up
    		  INNER JOIN tbl_usuario u ON u.IdUsuario = up.IdUsuario
    		  INNER JOIN tbl_persona p ON p.IdPersona = up.IdPersona
              WHERE u.NombreUsuario='{$Afiliado}'
              ";
    $result = DB::select($sql);
    return view('marketing.card', ["data" => $result[0], "NombreAfiliado" => $Afiliado]);
});

Route::get('/{Afiliado?}', function ($Afiliado = null) {

    $result = null;
    if ($Afiliado != "") {
        $sql = "SELECT p.*, u.*
    		  FROM tbl_usuario_persona up
    		  INNER JOIN tbl_usuario u ON u.IdUsuario = up.IdUsuario
    		  INNER JOIN tbl_persona p ON p.IdPersona = up.IdPersona
              WHERE u.NombreUsuario='{$Afiliado}'
              ";
        $result = DB::select($sql);
    }
    return view('marketing.index', ["data_afiliado" => $result, "NombreAfiliado" => $Afiliado]);
});




