<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="{{url('')}}/assets-marketing/css/bootstrap.min.css"/>
    <style>
        body{
            background-color: #0b5586;
        }
    </style>
</head>
<body>
    <a style="width: 25px; height:25px; background-color:#0b5586; position: absolute;" href="#"  data-toggle="modal" data-target="#exampleModal"></a>
    <div class="container">
        @yield('contenido')
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Login</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                
                <form id="formulario_login">

                    <div class="form-group">                                             
                        <input type="text" class="form-control" id="txtusuario" placeholder="Usuario o Email" required style="border:1px solid #ccc;" />
                     </div>

                     <div class="form-group">
                        <input type="password" class="form-control" id="txtpassword" placeholder="Password" required style="border:1px solid #ccc;"  />
                     </div>

                     <div class="form-group">
                        <input type="password" class="form-control" id="txtrct" placeholder="Código" required style="border:1px solid #ccc;"  />
                     </div>

                     <div class="form-group">
                         <select class="form-control" id="txtrol">
                             <option value="1">Estudiante</option>
                             <option value="2">Tutores</option>
                             <option value="3">Afiliados</option>
                             <option value="4">Administrador</option>
                         </select>
                     </div>


                    <center>
                    <div class="g-recaptcha" data-sitekey="6LfJwFoaAAAAAPiljxPQbH_MscIMe4rmLyC7y3zs"></div>
                    </center>
                    <br/>
                    <input type="submit" name="" class="btn-docttus-web" value="Inicia Sesión" id="btn_ingresar" style="width: 100%;">  

                </form>

            </div>            
        </div>
        </div>
    </div>
    
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <script src="{{url('')}}/assets-marketing/js/jquery-3.2.1.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>	
	<script src="{{url('')}}/assets-marketing/js/bootstrap.min.js"></script>

    <script>

$("#formulario_login").submit(function(e){
        e.preventDefault();
        verificar_login();         
      });

      var myVar;
      var contador_login=5;

      function verificar_login(){



        var usuario=$("#txtusuario").val();
        var password=$("#txtpassword").val();        
        var captcha=$("#g-recaptcha-response").val();
        var rct=$("#txtrct").val();
        var txtrol=$("#txtrol").val();

        if(captcha==""){
          mensaje_generico("Error !","Debes verificar el Re-Captcha","2","Continuar...",continuar_error);
          return;
        }


        var request = $.ajax({
          url: "login_cursos",
          type: "POST",
          data:{               
               usuario:usuario,
               password:password,
               captcha:captcha,
               rct:rct,
               rol:""+txtrol,
               _token: "{{ csrf_token() }}"
          }
        });

        request.done(function(obj) { 
           if(obj.status=="ok"){
              window.open("{{url('')}}/backoffice","_parent");
              return;
           }else{
              alert("Error ! "+obj.mensaje);
              return;
           }
        });
         

         //respuesta si falla
        request.fail(function(jqXHR, textStatus) {          
            alert("Error Servidor ");
          return;
        });
      }


    </script>
    
</body>
</html>