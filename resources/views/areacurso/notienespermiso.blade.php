<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="icon" type="image/png" href="{{url('')}}/assets/images/logo-docttus-favicon.png">
    <style type="text/css">
      
      /*
        ESTILOS PARA LOS CURSOS
      */
      body,html{
         background-color:#0B5586;
      }
     
      .card-docttus{
        background-color: #fff;
        border-radius: 9px;
        padding: 25px;          
        box-shadow: 0px 0 7px 0px #ecebeb;
        position: relative;        
      }

      .container-login{
        margin-top: 40%;
        
      }

      .login-principal{
         width: 200px;
         margin-bottom: 15px;
      }

      #form_login_olvido{
         display: none;
      }

      .login-title{
          margin-top: 15px;
          margin-bottom: 15px;
          text-align: center;
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

    <title>Ingresar a Docttus</title>
  </head>
  <body>
    <div class="container">
      <div class="row">
          <div class="offset-md-3 col-md-5">
              
              <div class="container-login">
                <center>
                  <img src="{{url('')}}/assets-marketing/images/nuevo_logo_docttus.png" class="login-principal">  
                </center>  

                <div class="card-docttus">
                    <div id="form_login">
                      <div class="login-title">
                        <strong>No Tienes permiso o tu sesión a caducado </strong>
                      </div>                      
                    
                      <div class="form-group">                        
                          <div class="col-md-12">
                            <center>
                              <a href="{{url('')}}" id="btn_login" class="btn btn-info btn-block botones-docttus"  style="background-color:#3b455a;">Atrás</a>
                              <hr>
                            
                            </center>                            
                          </div>
                      </div>                     
                    </div>
                    
                </div>  
              </div>
              
          </div>
      </div>
    </div>
    



    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>    
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>

  </body>
</html>