@extends('areacurso.plantillas.plantilla-area-interna')
@section('contenido')   

<div class="container">
    <div class="row">
        <div class="col-md-7">
            <section class="seccion-blanca" style="padding-top: 15px; margin-bottom:45px;">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12" style="text-align: left;">
                        <h1 style="font-size: 41px; font-weight: 300;">Actualizaciones Log</h1>
                        </div>
                    </div>

                    <div class="row" style="margin-top: 15px;">
                    
                        <div class="col-md-12">
                            <div class="card-docttus " style="margin-bottom: 15px;">
                                            
                                

                                <div id="accordion">


                                    @foreach ($actualizaciones as $item)
                                        <div class="card">
                                            <div class="card-header" id="heading{{$item->IdVersion}}">
                                                <h5 class="mb-0">
                                                    <button class="btn btn-link" data-toggle="collapse" data-target="#collapse{{$item->IdVersion}}" aria-expanded="true" aria-controls="collapse{{$item->IdVersion}}">
                                                        V. {{$item->NombreVersion}} ({{$item->FechaVersion}})
                                                    </button>
                                                </h5>
                                            </div>                                
                                            <div id="collapse{{$item->IdVersion}}" class="collapse" aria-labelledby="heading{{$item->IdVersion}}" data-parent="#accordion">
                                                <div class="card-body">
                                                
                                                    {!!$item->DescripcionVersion!!}                                                    

                                                </div>
                                            </div>                                        
                                        </div>


                                        
                                        <!--
                                        <h4>Mejoras</h4>
                                        <ul>
                                            <li></li>
                                        </ul>


                                        
                                        <h4>Mejoras</h4>
                                        <ul>
                                            <li>Configuración de afiliados en hotmart (Afiliados)</li>
                                            <li>Solicitud de venta de docttus (Afiliados)</li>
                                            <li>Habilitación de nuevos cursos (Afiliados)</li>
                                        </ul>

                                        <h4>Correcciones</h4>
                                        <ul>
                                            <li>Validación de Formularios de Contenido creación de cursos (tutores)</li>
                                        </ul>



                                        
                                        


                                        
                                        -->

                                    @endforeach
                                    
                                    
                                </div>




                            </div>
                        </div>
                    </div>
                </div>
            </section>
            
        </div>

        <div class="col-md-5">

            <img src="{{url('')}}/assets/images/update-log.png" style="width:100%;" >

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