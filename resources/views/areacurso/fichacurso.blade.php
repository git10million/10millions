<!DOCTYPE html>
<html lang="es">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Docttus - {{$datos[0]->NombreCurso}}</title>

  <!-- Bootstrap core CSS -->
  <link href="{{url('')}}/assets-curso/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link rel="icon" type="image/png" href="{{url('')}}/assets/images/logo-docttus-favicon.png">

  <!-- Custom fonts for this template -->
  <link href="{{url('')}}/assets-curso/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
  <link href='https://fonts.googleapis.com/css?family=Kaushan+Script' rel='stylesheet' type='text/css'>
  <link href='https://fonts.googleapis.com/css?family=Droid+Serif:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
  <link href='https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700' rel='stylesheet' type='text/css'>

  <!-- Custom styles for this template -->
  <link href="{{url('')}}/assets-curso/css/agency.css" rel="stylesheet">

  <style type="text/css">
    section.pricing {
  background: #007bff;
  background: linear-gradient(to right, #0062E6, #33AEFF);
}

.pricing .card {
  border: none;
  border-radius: 1rem;
  transition: all 0.2s;
  box-shadow: 0 0.5rem 1rem 0 rgba(0, 0, 0, 0.1);
}

.pricing hr {
  margin: 1.5rem 0;
}

.pricing .card-title {
  margin: 0.5rem 0;
  font-size: 0.9rem;
  letter-spacing: .1rem;
  font-weight: bold;
}

.pricing .card-price {
  font-size: 3rem;
  margin: 0;
}

.pricing .card-price .period {
  font-size: 0.8rem;
}

.pricing ul li {
  margin-bottom: 1rem;
}

.pricing .text-muted {
  opacity: 0.7;
}

.pricing .btn {
  font-size: 80%;
  border-radius: 5rem;
  letter-spacing: .1rem;
  font-weight: bold;
  padding: 1rem;
  opacity: 0.7;
  transition: all 0.2s;
}

.card-docttus{
          background-color: #fff;
          border-radius: 9px;
          padding: 25px;          
          box-shadow: 0px 0 7px 0px #ecebeb;
          position: relative;
      }

/* Hover Effects on Card */

@media (min-width: 992px) {
  .pricing .card:hover {
    margin-top: -.25rem;
    margin-bottom: .25rem;
    box-shadow: 0 0.5rem 1rem 0 rgba(0, 0, 0, 0.3);
  }
  .pricing .card:hover .btn {
    opacity: 1;
  }
}
  </style>

</head>

<body id="page-top">

  <!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav">
    <div class="container">
      <a class="navbar-brand js-scroll-trigger" href="#page-top"><img src="{{url('')}}/assets/images/logo_docttus.png" style="width: 170px;"></a>
      <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        Menu
        <i class="fas fa-bars"></i>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav text-uppercase ml-auto">
          <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="#acerca">Acerca</a>
          </li>
          <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="#tutor">Tutor</a>
          </li>
          <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="#que-aprenderas">Que Aprenderás?</a>
          </li>
          <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="#lecciones">Lecciones</a>
          </li>
          <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="#testimonios">Testimonios</a>
          </li>

          <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="#ingresa-ahora">Ingresa Ahora</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>




  <!-- Header -->
  <header class="masthead" style="background-image: url({{url('')}}/assets/images/cursos/{{$datos[0]->SlideCurso}});">
    <div class="container">

      <div class="row">
          <div class="col-md-6">
              

              <div class="intro-text">
                <div class="intro-lead-in">Bienvenido al curso</div>
                <h1 class="intro-heading text-uppercase">{{$datos[0]->NombreCurso}}</h1>

                  

                <a class="btn btn-primary btn-xl text-uppercase js-scroll-trigger" style="margin-top: 25px;" href="#ingresa-ahora">Adquirir Ahora</a>
              </div>


          </div>

          <div class="col-md-6">
            <!-- 16:9 aspect ratio -->
            <div class="intro-text">
                  <div class="embed-responsive embed-responsive-16by9">
                    <iframe class="embed-responsive-item" src="{{$datos[0]->VideoCurso}}" allowfullscreen allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"></iframe>
                  </div>
            </div>
          </div>
      </div>
      
    </div>
  </header>

  <!-- Services -->
  <section class="page-section" id="acerca">
    <div class="container">
      <div class="row">
        <div class="col-lg-12 text-center">
          <h2 class="section-heading text-uppercase">Porqué Este Curso?</h2>
          <h3 class="section-subheading text-muted">Las razones por las cuales debes adquirir este curso</h3>
        </div>
      </div>
      <div class="row text-center">
        @foreach($beneficios as $beneficio)
        <div class="col-md-4">
          <span class="fa-stack fa-4x">
            <i class="fas fa-circle fa-stack-2x text-primary"></i>
            <i class="fas {{$beneficio->IconoBeneficio}} fa-stack-1x fa-inverse"></i>
          </span>
          <h4 class="service-heading">{{$beneficio->TituloBeneficio}}</h4>
          <p class="text-muted">{{$beneficio->DescripcionBeneficio}}</p>
        </div>
        @endforeach       
      </div>
    </div>
  </section>

  <!-- Portfolio Grid -->
  <section class="bg-light page-section" id="tutor">
    <div class="container">
      <div class="row">
        <div class="col-lg-12 text-center">
          <h2 class="section-heading text-uppercase">{{$datos[0]->NombreTutor}}</h2>
          <h3 class="section-subheading text-muted">.</h3>
        </div>
      </div>
      
      <div class="row">
         <div class="col-md-8">
           {!!$datos[0]->DescripcionTutor!!}
         </div>

         <div class="col-md-4">
           <img src="{{url('')}}/assets/images/cursos/{{$datos[0]->FotoTutor}}" style="width: 100%;">
         </div>
      </div>

      @if($datos[0]->Descripcion2Tutor)
      <div class="row" style="margin-top: 45px;">
         {!!$datos[0]->Descripcion2Tutor!!}
      </div>
      @endif

    </div>
  </section>

  <!-- About -->
  <section class="page-section" id="que-aprenderas">
    <div class="container">
      <div class="row">
        <div class="col-lg-12 text-center">
          <h2 class="section-heading text-uppercase">Qué Aprenderás?</h2>
          <h3 class="section-subheading text-muted">Lorem ipsum dolor sit amet consectetur.</h3>

        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
            
            {!!$datos[0]->AprenderasCurso!!}

        </div>
      </div>
    </div>
  </section>

  <!-- Team -->
  <section class="bg-light page-section" id="lecciones">
    <div class="container">
      <div class="row">
        <div class="col-lg-12 text-center">
          <h2 class="section-heading text-uppercase">Lecciones</h2>
          <h3 class="section-subheading text-muted">Lorem ipsum dolor sit amet consectetur.</h3>
        </div>
      </div>

      <div class="row">
         <div class="col-md-12">
           



           <div class="row">
  <div class="col-md-12">
      <div id="accordion">
              <?php
                $contador_modulo=0;
              ?>
          
          @foreach($info_modulos as $modulo)

              <?php
                $contador_modulo++;
              ?>
        
              <button class="btn botones-docttus" style="width: 100%; margin-bottom: 25px; background-color: #3b465a;" data-toggle="collapse" data-target="#collapse_modulo-{{$modulo->IdModulo}}" aria-expanded="true" aria-controls="collapse_modulo-{{$modulo->IdModulo}}">
                <h2 style="color: #fff;">{{$modulo->NombreModulo}}</h2>
              </button>
            
              @if($contador_modulo==1)
              <div id="collapse_modulo-{{$modulo->IdModulo}}" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
              @else
              <div id="collapse_modulo-{{$modulo->IdModulo}}" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
              @endif

                 <div class="row row-docttus" style="margin-bottom: 25px;">
                  
                    @foreach($info_lecciones as $lecciones)
                      @if($lecciones->IdModulo==$modulo->IdModulo)
                   <!--  tarjeta Curso -->                    
                        <div class="col-md-4" style="position: relative; margin-top: 25px;">
                           <div class="card-docttus card-docttus-left" style=" height: auto !important;">
                              <div class="row">
                                <div class="col-12">
                                   <h5 style="font-weight: bold; height: 56px;">{{$lecciones->NombreTema}}</h5>
                                </div>                                
                              </div>
                              <div class="row">
                                <div class="col-md-12">
                                  
                                    <img src="{{url('')}}/assets/images/clases/{{$lecciones->ImagenTema}}" style="width: 100%; ">
                                  
                                </div>
                              </div>
                           </div>
                        </div>                        
                        <!--  tarjeta Curso --> 
                        @endif
                    @endforeach

                 </div>
              </div>     

          @endforeach  
        
      </div>
    </div>
</div>




         </div>
      </div>
      
      
    </div>
  </section>

  <!-- About -->
  @if($datos[0]->TestimoniosCurso)
  <section class="page-section" id="testimonios">
    <div class="container">
      <div class="row">
        <div class="col-lg-12 text-center">
          <h2 class="section-heading text-uppercase">TESTIMONIOS</h2>
          <h3 class="section-subheading text-muted">Lorem ipsum dolor sit amet consectetur.</h3>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
           {!!$datos[0]->TestimoniosCurso!!}
        </div>
      </div>
    </div>
  </section>
  @endif


  <!-- About -->
  <section class="bg-light page-section" id="ingresa-ahora">
    <div class="container">
      <div class="row">
        <div class="col-lg-12 text-center">
          <h2 class="section-heading text-uppercase">ADQUIRIR ESTE CURSO AHORA</h2>
          <h3 class="section-subheading text-muted">Lorem ipsum dolor sit amet consectetur.</h3>
        </div>
      </div>
      <div class="row">
        <div class="col-md-6" style="">
          


            <div class="card mb-5 mb-lg-0">
              <div class="card-body">
                <h5 class="card-title text-muted text-uppercase text-center">Adquiere este curso por</h5>
                <h6 class="card-price text-center" style="font-size: 65px;">${{$datos[0]->ValorPrecioProducto}}</h6>
                <hr>
                <ul class="fa-ul">
                  <li><span class="fa-li"><i class="fas fa-check"></i></span>Acceso de por vida</li>
                  <li><span class="fa-li"><i class="fas fa-check"></i></span>Soporte</li>
                  <li><span class="fa-li"><i class="fas fa-check"></i></span>Habilidades</li>
                  <li><span class="fa-li"><i class="fas fa-check"></i></span>30 días de Garantía</li>
                  <li><span class="fa-li"><i class="fas fa-check"></i></span>Certificado</li>                  
                  <li><span class="fa-li"><i class="fas fa-check"></i></span>Paga con diferentes métodos</li>                  
                </ul>
                
              </div>
            </div>
          



        </div>
        <div class="col-md-6">
            <div class="card" style="padding-top: 25px;">
                 <div class="row">
                    <div class="col-md-12" style="text-align: center;">                       
                       <h5 class="card-title text-muted text-uppercase text-center">REGISTRATE AHORA A DOCTTUS</h5>
                    </div>
                 </div>
                <div id="form_login">                 
                  <form action="/" class="form-horizontal" method="post" id="formulario_login">
                  <div class="form-group">
                      <div class="col-md-12">
                          <input type="text" class="form-control input-docttus" id="txtusuario" placeholder="Usuario*" required />
                      </div>
                  </div>

                  <div class="form-group">
                      <div class="col-md-12">
                          <input type="text" class="form-control input-docttus" id="txtnombre" placeholder="Nombre(s)*" required />
                      </div>
                  </div>


                  <div class="form-group">
                      <div class="col-md-12">
                          <input type="text" class="form-control input-docttus" id="txtapellidos" placeholder="Apellido(s)" />
                      </div>
                  </div>

                  <div class="form-group">
                      <div class="col-md-12">
                          <input type="email" class="form-control input-docttus" id="txtemail" placeholder="Email*" required />
                      </div>
                  </div>



                  <div class="form-group">
                      <div class="col-md-12">
                          <input type="password" id="txtpassword" class="form-control input-docttus" placeholder="Password*" required />
                      </div>
                  </div>                 

                  <div class="form-group">
                      <div class="col-md-12">
                          <input type="password" id="txtrepetirpassword" class="form-control input-docttus" placeholder="Repetir Password*" required />
                      </div>
                  </div>   

                 
                  <div class="form-group">
                    <div class="col-md-12">
                      <hr>
                      <input type="checkbox" name="" id="txtacepto"> Acepto los <a target="_blank" href="{{url('')}}/terminos-de-uso">Términos de Uso</a> y <a href="{{url('')}}/politicas-de-privacidad" target="_blank">Políticas</a> de Docttus.
                      </div>
                  </div>            

                  <div class="form-group">                        
                      <div class="col-md-12">
                        <center>
                          <button  id="btn_login" class="btn btn-info btn-block botones-docttus"  style="background-color:#3b455a;">
                             1. Paso: Registro
                          </button>

                            <hr>
                            
                            <a  class="btn btn-info btn-block botones-docttus" style="background-color: #f19c19;  border-color: #f19c19;"  href="{{url('')}}" class="olvidaste">1. Ya Tengo Cuenta Docttus</a>
                        </center>                            
                      </div>
                  </div>

                  <div class="form-group">
                     <div class="col-md-12">
                       <p style="font-size: 12px">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Incidunt expedita, omnis ipsum veritatis cum aliquam maxime obcaecati reiciendis saepe necessitatibus maiores inventore animi, facilis odit sapiente placeat labore nemo sint. 
                        @if($codigo_usuario)
                        <span  style="font-size: 12px; font-weight: bold;">Ref: {{$codigo_usuario}}</span>
                        @endif
                      </p>

                     </div>
                  </div>                                                           
                 
                  </form>
                </div>                    
            </div>  
        </div>
      </div>
    </div>
  </section>

 

  <!-- Contact -->
  

  <!-- Footer -->
  <footer class="footer">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-md-4">
          <span class="copyright">Copyright &copy; Docttus 2020</span>
        </div>
        <div class="col-md-4">
          <ul class="list-inline social-buttons">
            <li class="list-inline-item">
              <a href="#">
                <i class="fab fa-twitter"></i>
              </a>
            </li>
            <li class="list-inline-item">
              <a href="#">
                <i class="fab fa-facebook-f"></i>
              </a>
            </li>
            <li class="list-inline-item">
              <a href="#">
                <i class="fab fa-linkedin-in"></i>
              </a>
            </li>
          </ul>
        </div>
        <div class="col-md-4">
          <ul class="list-inline quicklinks">
            <li class="list-inline-item">
              <a href="#">Políticas de Privacidad</a>
            </li>
            <li class="list-inline-item">
              <a href="#">Términos de Uso</a>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </footer>

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
                   <img src="assets/images/check_mensaje.png" class="icono-mensaje-1">
                   <img src="assets/images/error_mensaje.png" class="icono-mensaje-2">
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

  <!-- Portfolio Modals -->

  <!-- Modal 1 -->
  

  <!-- Bootstrap core JavaScript -->
  <script src="{{url('')}}/assets-curso/vendor/jquery/jquery.min.js"></script>
  <script src="{{url('')}}/assets-curso/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Plugin JavaScript -->
  <script src="{{url('')}}/assets-curso/vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Contact form JavaScript -->
  <script src="{{url('')}}/assets-curso/js/jqBootstrapValidation.js"></script>
  <script src="{{url('')}}/assets-curso/js/contact_me.js"></script>

  <!-- Custom scripts for this template -->
  <script src="{{url('')}}/assets-curso/js/agency.min.js"></script>

   <script type="text/javascript">
      $("#btn_olvidaste_password").click(function(e){        
        e.preventDefault();
        $("#form_login_olvido").show();
        $("#form_login").hide();
      });

      $("#btn_regresar").click(function(e){        
        e.preventDefault();
        $("#form_login_olvido").hide();
        $("#form_login").show();
      });


      $("#formulario_login").submit(function(e){
        e.preventDefault();
        verificar_login();         
      });

      var myVar;
      var contador_login=5;

      function verificar_login(){
        var txtusuario=$("#txtusuario").val();
        var txtnombre=$("#txtnombre").val();
        var txtapellidos=$("#txtapellidos").val();
        var txtemail=$("#txtemail").val();
        var txtpassword=$("#txtpassword").val();
        var txtrepetirpassword=$("#txtrepetirpassword").val();
        var txtrolestudiante="";
        var txtrolafiliado="";


        if($("#txtrolestudiante").is(":checked")){
          txtrolestudiante="1";
        }

        if($("#txtrolafiliado").is(":checked")){
          txtrolafiliado="1";
        }

        if(txtrepetirpassword!=txtpassword){
            mensaje_generico("Error !","Los passwords no coinciden","2","Continuar...",function(){});
            return;
        }

        if(txtrolafiliado=="" && txtrolestudiante==""){
            mensaje_generico("Error !","Debes seleccionar Estudiante o Afiliado","2","Continuar...",function(){});
            return;
        }

        if(!$("#txtrolafiliado").is(":checked")){
            mensaje_generico("Error !","Debes Aceptar los términos y políticas de Docttus","2","Continuar...",function(){});
            return; 
        }

        $IdUsuarioPadre="";//acá va el uso de cockies

        var request = $.ajax({
          url: "registrar_usuario",
          type: "POST",
          data:{               
              usuario:txtusuario,
              nombre:txtnombre,
              apellidos:txtapellidos,
              email:txtemail,
              password:txtpassword,
              repetirpassword:txtrepetirpassword,
              rolestudiante:txtrolestudiante,
              rolafiliado:txtrolafiliado,
              IdUsuarioPadre:"",                  
              _token: "{{ csrf_token() }}"
          }
        });

        request.done(function(obj) { 
           if(obj.status=="ok"){
              mensaje_generico("Bienvenido "+obj.nombre+" !","Has ingresado correctamente","1","<span id='contador_boton'>5 </span> Continuar...",continuar_login);
              myVar = setInterval(myTimer, 1000);              
              return;
           }else{
              mensaje_generico("Error !",""+obj.mensaje,"2","Continuar...",continuar_error);
              return;
           }
        });
         

         //respuesta si falla
        request.fail(function(jqXHR, textStatus) {
          alert( "Error de servidor  " + textStatus );
        });
      }

      


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

      function continuar_login(){
         console.log("siguiente");
         window.open("backoffice","_parent");
      }

      function continuar_error(){

      }



      

      function myTimer() {
         contador_login--;
         $("#contador_boton").html(""+contador_login);
         if(contador_login==0){
            myStopFunction();
         }        
      }

      function myStopFunction() {
        clearInterval(myVar);
        window.open("backoffice","_parent");
      }




    </script>

</body>

</html>
