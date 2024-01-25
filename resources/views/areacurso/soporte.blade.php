@extends('areacurso.plantillas.plantilla-area-interna')
@section('contenido')   

<div class="container">
<div class="row">
    <div class="col-md-6">
        <section class="seccion-blanca" style="padding-top: 15px; margin-bottom:45px;">
            <div class="container">
                <div class="row">
                    <div class="col-md-12" style="text-align: left;">
                    <h1 style="font-size: 41px; font-weight: 300;">Soporte</h1>
                    </div>
                </div>

                <div class="row" style="margin-top: 15px;">
                
                    <div class="col-md-12">
                        <div class="card-docttus preguntas_form" style="margin-bottom: 15px;">

                            <form action="/" id="formulario_soporte">

                                <label>Asunto:</label>
                                <input class="form-control" type="text" id="AsuntoSoporte" required />

                                <br />
                                <label>Perfíl</label>
                                <select class="form-control" id="IdTipoSoporte">
                                    <option value="1">Cliente</option>
                                    <option value="3">Miembro Club</option>
                                </select>
                                <br />
                                <label>¿En qué podemos ayudarte?</label>

                                <textarea class="form-control" rows="8" id="DescripcionSoporte" required></textarea>
                                <br />

                                <br />
                                <label>Adjuntar Archivos</label>
                                <br />
                                <small>Archivo 1</small>
                                <input type="file" id="Archivo1Soporte" class="form-control" />
                                <small>Archivo 2</small>
                                <input type="file" id="Archivo2Soporte" class="form-control" />
                                <small>Archivo 3</small>
                                <input type="file" id="Archivo3Soporte" class="form-control" />

                                <br />
                                <input type="submit" class="btn btn-warning" value="Enviar Mensaje Soporte" id="btn_enviar_formulario" >
                                <br />
                            </form>
                        </div>
                    </div>


                    

                </div>
            </div>
        </section>
        
    </div>

    <div class="col-md-6">

        <div class="row" style="padding-top: 87px;">
            <div class="col-md-6" style="text-align: left;">
                <h2 style="font-size: 35px; font-weight: 300;">WhatsApp</h2>
                <p style="font-weight: 300;">Puedes escribirnos a nuestro WhatsApp de Soporte, tienes algún problema o duda con la plataforma Docttus.</p>
                <a class="btn btn-success" target="_blank" href="https://api.whatsapp.com/send?phone=573156181902&text=Hola,%20Soporte%20Docttus"><i class="fa fa-whatsapp" aria-hidden="true"></i>
                    + 57 315 6181902</a>
            </div>
        
            <div class="col-md-6" style="text-align: left;">
                <h2 style="font-size: 35px; font-weight: 300;">Correo</h2>
                <p style="font-weight: 300;">Puedes escribir tu inquietud a nuestro correo <a href="mailto:info@10millionsclub.life">info@10millionsclub.life</a></p>
            </div>
        </div>

    </div>

</div>        

</div>


@stop

@section('scripts')

    
    <script type="text/javascript">


    $("#formulario_soporte").submit(function(e){
        e.preventDefault();
        guardar_informacion();
    });
       

    function alerta(mensaje,tipomensaje){
        
            $("#mensaje_principal").modal("show");
            $("#titulo_mensaje").html(""+mensaje);
        
    }

    


    function guardar_informacion(){

        var formData = new FormData();
        formData.append('AsuntoSoporte', $("#AsuntoSoporte").val());
        formData.append('DescripcionSoporte', $("#DescripcionSoporte").val());
        formData.append('IdTipoSoporte', $("#IdTipoSoporte").val());
        formData.append('Archivo1Soporte', $("#Archivo1Soporte")[0].files[0]);
        formData.append('Archivo2Soporte', $("#Archivo2Soporte")[0].files[0]);
        formData.append('Archivo3Soporte', $("#Archivo3Soporte")[0].files[0]);

        
        
        
        formData.append('_token', "{{ csrf_token() }}");                

        
        var request = $.ajax({
            url: "{{url('')}}/generar_soporte",
            type: "POST",
            data: formData,
            processData: false,  // tell jQuery not to process the data
            contentType: false  // tell jQuery not to set contentType
          });

          request.done(function(obj) { 
             if(obj.status=="ok"){            
                $("#responder_comentarios").modal("hide");
                mensaje_generico("Correcto",""+obj.mensaje,"1","Continuar...",function(){
                  location.reload();
                });

                return;
             }else{
                $("#responder_comentarios").modal("hide");
                mensaje_generico("Error !",""+obj.mensaje,"2","Continuar...",function(){});
                return;
             }
          });
           //respuesta si falla
          request.fail(function(jqXHR, textStatus) {
            alert( "Error de servidor  " + textStatus );
          });


      }


    </script>
@stop