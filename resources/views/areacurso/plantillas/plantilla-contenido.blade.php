<!doctype html>
<html lang="es">
  <head>

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

	

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    
    <link rel="icon" type="image/png" href="{{url('')}}/assets-marketing/images/favicon.png">

    <link href="https://vjs.zencdn.net/7.10.2/video-js.css" rel="stylesheet" />

    <title>Docttus | {{$titulo_pagina}}</title>
    <style type="text/css">
      body,html,*{
        font-family: 'Poppins', sans-serif;

            
        text-rendering: optimizeLegibility;
        -webkit-font-smoothing: antialiased;
        
      }
      body,html{
        background-color: #f7f6f9;        
      }

      .list-group-item{
        padding:7px;
        font-size: 14px;
      }

		.chartjs-render-monitor{
			width: 410px !important;
			height: 410px !important;
		}

     .titulo-curso-f{
    margin-top: 0px;
    position: fixed;
    left: 166px;
    border-radius: 0px 0px 8px 8px;
    top: 68px;
    background-color: #17a2b8;
    color: #fff;
    font-size: 14px;
    padding: 3px 10px;
    z-index: 999999;
  }

      .titulos-cursos{
         width: 100%;
         padding: 10px;
         background: -webkit-linear-gradient(47deg, rgb(27, 214, 204) 0%, rgb(10, 182, 236) 100%);
        background: -o-linear-gradient(47deg, rgb(27, 214, 204) 0%, rgb(10, 182, 236) 100%);
        background: linear-gradient(137deg, rgb(27, 214, 204) 0%, rgb(10, 182, 236) 100%);
         text-align: center;
         border-radius: 50px;
         color:#fff;
      }
      .barra_superior{
        background-color: #0B5586;
        height: 68px;
        width: 100%;   
        position: fixed;     
        z-index: 999;
      }
      #btn_cerrar_menu{
        display: none;
      }
      .barra_izquierda{
         background-color: #0B5586;
         height: 100vh;
         width: 130px;
         position: fixed;
         top: 0px;
         left: 0px;
         border-right: 2px solid #0B5586;
         z-index: 9999;
         overflow-y: auto;
         display: block;

      }
      .btn-rounded{
        width: 48px;
        height: 48px;
        background-color: #F5F6FA;
        display: inline-block;
        border-radius: 51px;
      }
      .btn-search{
        margin-left: 135px;       
        margin-top: 10px;   
        display: none;     
      }
      .btn-search img{
        width: 23px;
        height: 23px;
        margin-top: 12px;
        margin-left: 12px;
      }
      .panel-derecha{
        float: right;
        width: 150px;        
      }

      .btn-notificacion{
        margin-right: 23px;       
        margin-top: 10px;  
        display: inline-block;      
      }
      .btn-notificacion img{
        width: 23px;
        height: 23px;
        margin-top: 12px;
        margin-left: 12px;
      }

      .btn-usuario{
        margin-right: 15px;       
        margin-top: 10px;   
        position: absolute;
      }
      .btn-usuario img{
        width: 48px;
        height: 48px;
      }

      .contenedor-principal{
        width: 100%;
        padding-left: 0px;
        padding-top: 0px;
        padding-right: 0px;
        padding-bottom: 0px;
      }

      h1{
        font-size: 33px;
        font-weight: 900;
        color: #3b465a;
      }
      .row-docttus{
        margin:0px;
        padding: 0px;
      }
      .card-docttus{
          background-color: #fff;
          border-radius: 9px;
          padding: 25px;          
          box-shadow: 0px 0 7px 0px #ecebeb;
          position: relative;
      }

      .card-docttus-left{
         height: 512px;
      }

      .card-docttus-right-1{
        height: 247px;
      }
      .card-docttus-right-2{
        height: 247px;
        margin-top: 20px;
      }

      .card-docttus-cursos{
         height: 245px;
      }

      .card-docttus .subtitulos{
         font-size: 25px;
         font-weight: bold;
         color: #3b465a;
         margin-bottom: 25px;
      }


      /*BOTONES BARRA IZQUIERDA*/
      .btn-inicio{
        margin-top: 20px;
      }
      .btn-cursos{
        margin-top: 15px;
      }
      .btn-ayudas{
        margin-top: 15px; 
      }
      .btn-inicio img{
        width: 18px; 
        margin-top: 12px;       
      }

      .btn-inicio h4{
        color: #fff !important;
      }

      .btn-cursos img{
        width: 28px;
        margin-top: 14px;  
      }

      .btn-ayudas img{
        width: 25px;
        margin-top: 11px;
      }

      .container-boton{
        width: 100%;
        height: 100px;        
        margin-top: 11px;
      }
      .container-boton h4{
         color:#fff;
         padding: 0px;
         font-size: 15px;
         font-weight: 300;
         margin-top: 6px;

      }

      .card-docttus-cursos h4{
         display: inline-block;
         width: 67%;
         font-size: 20px;
         font-weight: bold;
      }

      .botones-docttus{
        background: -webkit-linear-gradient(47deg, rgb(27, 214, 204) 0%, rgb(10, 182, 236) 100%);
        background: -o-linear-gradient(47deg, rgb(27, 214, 204) 0%, rgb(10, 182, 236) 100%);
        background: linear-gradient(137deg, rgb(27, 214, 204) 0%, rgb(10, 182, 236) 100%);



        border-radius: 28px;
        border: none;
        font-size: 16px;        
        display: inline-block;
        width: auto;
        padding-left: 25px;
        padding-right: 25px;
        color: #fff;
      }

      .btn-cursos-iniciar{
        position: absolute;
        top: 16px;
        right: 13px;
      }

      .btn-ver-mas{
        position: absolute;
        right: 21px;
        top: 28px;
        font-weight: 600;
        color: #636363;
        font-size: 14px;
      }
      .btn-ver-mas:hover{
         color: #636363; 
      }

      .enlace-notificacion{
      	color: #222;
		text-decoration: none;
      }
      .enlace-notificacion:hover{
      	text-decoration: none;	
      }

      .card-curso{
		  transition: transform .2s; /* Animation */
      }

      .card-curso:hover{
      	transform: scale(1.02);
      	box-shadow: 0px 0 14px 12px #d4d4d4;
      }

      .btn-vista{
      	background-color: green !important;
      }

      @media only screen and (max-width: 991px) {
        .btn-search{
           display: inline-block;
           left: 5px;
           position: absolute;
           margin-left: 5px;
        }
        .card-docttus{
           margin-bottom: 25px;
        }
        .barra_izquierda{
           display: none;
           width: 100%;
        }

        .contenedor-principal{
          /*padding: 10px;
          padding-top: 87px;*/
        }
        h1{
          font-size: 26px;
        }
      }

      .numero-notificacion{
      	    position: absolute;
		    top: 3px;
		    padding: 4px;
		    right: -2px;
		    background-color: #ce2020;
		    color: #fff;
		    font-size: 11px;
		    width: 24px;
		    text-align: center;
		    border-radius: 25px;
      }

      .btn-notificacion{
      	position: relative;
      }

		
      .card-docttus small{
        font-size: 11px;
        color: #8b8692;
      }

      .card-docttus .icono{
		 font-size: 13px;
		 margin-right: 6px;
      }

      .card-docttus .fila-info{
      	 text-align: center;
      	 margin-top: 21px;
      }

       .info-curso{
       	width: 400px;
       	margin-top: 25px;
       	margin-bottom: 45px;
       }

       .foto-usuario{
       	width: 100px;
       	height: 100px;
       	display: inline-block;
       	background-color: #d8d8d8;
       	border-radius: 150px;
       	background-size: cover;
       	background-repeat: no-repeat;
       	background-position: center;

       }

       .btn-redes{
       	width: 38px;
	    height: 38px;
	    font-size: 20px;
	    padding-top: 3px;
	    padding-left: 10px;
	    
      background: -webkit-linear-gradient(47deg, rgb(27, 214, 204) 0%, rgb(10, 182, 236) 100%);
        background: -o-linear-gradient(47deg, rgb(27, 214, 204) 0%, rgb(10, 182, 236) 100%);
        background: linear-gradient(137deg, rgb(27, 214, 204) 0%, rgb(10, 182, 236) 100%);
	    
      border-color: transparent !important;
       }

       .descripcion-curso{
		 
		    padding:35px;		    

		}

		.habiliadd{
			margin-right: 22px;
		    box-shadow: 0px 0px 6px 2px #dadada;
		    border-radius: 25px;
		}


		.btn-mensajes{
         background-color:#70b851;
         border-radius: 25px;
         padding: 5px 20px;
         border:none;
         margin-top: 15px;
      }

      .titulo-mensaje{
        
        font-size: 18px;
        margin-top: 17px;
      }
      .titulo-mensaje-exito{
        color: #a9d497;
      }

      .titulo-mensaje-error{
        color: red;        
      }


      .icono-mensaje-1,.icono-mensaje-2{
          width: 80px;
      }

      
    </style>
  </head>
  <body>
    

    <div class="contenedor-principal">
       @yield('contenido')
    </div>

    <!-- Modal Mensaje Generico -->
    <div class="modal fade" id="mensaje_generico" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
        <div class="modal-content">
          <!--<div class="modal-header">            
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>-->
          <div class="modal-body">
            <div class="row">
              <div class="col-md-12">
                <center>  
                   <img src="{{url('')}}/assets/images/check_mensaje.png" class="icono-mensaje-1">
                   <img src="{{url('')}}/assets/images/error_mensaje.png" class="icono-mensaje-2">
                </center>
              </div>
              <div class="col-md-12">
                <center>  
                  <h2 class="titulo-mensaje">Bienvenido!</h2>
                  <p class="descripcion-mensaje">Has ingresado correctamente</p>
                </center>
              </div>
              <div class="col-md-12">
                <center>  
                  <button type="button" class="btn btn-success btn-mensajes btn-continuar" data-dismiss="modal">Continuar</button>   
                </center>
              </div>
            </div>              
          </div>

        </div>
      </div>
    </div>



      <!-- Modal -->
    <div class="modal fade" id="modal-buscar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="z-index: 9999999;">
       <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content" style="background: transparent; border:none;">
        <center>
             <div style="display: inline-block; margin-top: 30%;">
                <h1 style="color: #fff;">¿QUE DESEAS BUSCAR EN DOCTTUS?</h1>
                <input type="" name="" placeholder="Buscar Cursos, Lecciones, Documentos, Conceptos, etc" class="form-control input-lg" style="display: inline-block; width: 447px; ">  
                <button type="button" class="btn btn-secondary botones-docttus" onclick="delete_modal_search()">Buscar</button>
             </div>
             
        </center>
        </div>
      </div>
    </div>


    
    

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="{{url('')}}/assets-interno/plugins/jquery/jquery.min.js"></script>
    <script src="{{url('')}}/assets/js/jquery-ui-1.12.1/jquery-ui.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="{{url('')}}/assets/js/funcionalidades.js"></script>   
    <script src="https://vjs.zencdn.net/7.10.2/video.min.js"></script>


    
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>

    <script type="text/javascript">
       function delete_modal_search(){
          $("#modal-buscar").modal("hide");
          console.log("esto");
       }



       $("#btn_menu").click(function(e){
        e.preventDefault();
        $(".barra_izquierda").show("fast");
        $("#btn_cerrar_menu").show();
       });

       $("#btn_cerrar_menu").click(function(e){
          $(".barra_izquierda").hide("fast");
          $("#btn_cerrar_menu").hide();
       });


      function mensaje_generico(titulo,descripcion,tipo,nombre_boton,funcion_boton){
          if(tipo=="1"){
            $(".icono-mensaje-1").show();
            $(".icono-mensaje-2").hide();
            $(".titulo-mensaje").removeClass("titulo-mensaje-error");
            $(".titulo-mensaje").addClass("titulo-mensaje-exito");            
          }else{
            $(".icono-mensaje-2").show();
            $(".icono-mensaje-1").hide();
            $(".titulo-mensaje").removeClass("titulo-mensaje-exito");
            $(".titulo-mensaje").addClass("titulo-mensaje-error");
            
          }

          $(".titulo-mensaje").html(""+titulo);
          $(".descripcion-mensaje").html(""+descripcion);
          $("#mensaje_generico").modal("show");
          $(".btn-continuar").html(""+nombre_boton);
          $(".btn-continuar").click(function(){
            funcion_boton();  
          });          
      }
    </script>

    <script>
/*var isNS = (navigator.appName == "Netscape") ? 1 : 0;
if(navigator.appName == "Netscape") document.captureEvents(Event.MOUSEDOWN||Event.MOUSEUP);
function mischandler(){
return false;
}
function mousehandler(e){
var myevent = (isNS) ? e : event;
var eventbutton = (isNS) ? myevent.which : myevent.button;
if((eventbutton==2)||(eventbutton==3)) return false;
}
document.oncontextmenu = mischandler;
document.onmousedown = mousehandler;
document.onmouseup = mousehandler;*/
</script>
	
	@yield('scripts')

  </body>
</html>