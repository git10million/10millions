@extends('areacurso.plantillas.plantilla-area-interna')

@section('cabecera')
    <style>
        .card-docttus-list{
            height: 100%;
        }
        .boton-redes{
            width: 35px;
            height: 35px;
            border-radius: 25px;
            font-size: 20px;
            margin-right: 3px;
            color:#fff;
        }    

        .fondo-banner{
            background-image: url("assets/images/fondo-afiliados.jpg");
            padding-top:70px; padding-bottom:70px;
            background-size: cover;
            background-position: center;
            color:#fff;
        }

        .fondo-banner h1{
            color:#fff;
            font-size: 45px;
        }

        .titulo-card{
            color: #fff;
            background-color: #0B5586;
            padding:5px;
            text-align: center;

            border-radius: 9px;
            font-size: 21px;

        }

        .listado-eventos{
            height: 350px;
            padding:5px;
            overflow-y: scroll;
        }

        .card-item-evento{
            cursor: pointer;
            margin-bottom: 10px;
            background-size: cover;
            background-position: center;
            color:#fff;

        }
        .card-item-evento span{
            color: #fff;
        }   

        .card-item-evento:hover{
            transform: scale(0.98);
            
        }

        .enlace-docttus{
            background-color:#fafafa;
            padding:10px; 
            border:1px solid #ccc;
            border-radius: 5px;
        }


               

    </style>
@endsection


@section('contenido')   

@php
    $mensaje_solicitud='';
    $boton_solicitud='';
    $color_solicitud='';
@endphp



@if($data[0]->IdEstadoSolicitudAfiliado==1 || $data[0]->IdEstadoSolicitudAfiliado==2)
<!-- <div class="row">
    <div class="col-md-12">
        <h2 class="titulo-backoffice" style="font-size: 28px; font-weight:400;">Panel de Afiliado</h2>
    </div>
</div>-->


<div class="container1">
    <div class="row">
        <!-- PANEL IZQUIERDO -->

        
        
        <div class="col-md-12"> 
            <!-- FILA 1 -->
            
                <div class="row">
                    <div class="col-md-12">
                        <div class="card-docttus fondo-banner">
                            <div class="row">                        
                                <div class="col-md-7">                    

                                </div>
                                <div class="col-md-5">
                                    <h1>Enlaces de Afiliados</h1>                                    
                                    <p>Empieza a comercializar los productos de nuestra parrilla.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row" style="margin-top:25px;">
                    <div class="col-md-6">
                        <div class="card-docttus">
                            
                            <h2 class="titulo-card" >Configuración para vender 10Million$Club</h2>

                            <br />


                            
                            <h4>Configura tu cuenta 10MillionsClub</h4>                            
                                <ol>
                                    
                                    <li>Por favor asegurate de tener la sesión iniciada en hotmart.</li>
                                    <li>Da click aquí <a class="btn btn-info btn-xs" href="https://app-vlc.hotmart.com/affiliate-recruiting/view/9006D58758940" target="_blank">Solicitar Enlace Hotmart</a> y luego en Click en el botón <strong>Afiliarse Ahora</strong></li>                                    
                                    
                                    <li>
                                        @if($data[0]->AprobacionHotmart=="")
                                        Para solicitar la aprobación por parte del equipo de 10 Million$ Club, da click en el siguiente botón 
                                        <a class="btn btn-info btn-xs" href="#" id="btn_solicitar_aprobacion">
                                            Solicitar Aprobación
                                        </a> 
                                         En 12 a 24 horas estaremos activando tu enlace de Checkout Hotmart para que puedas ofrecer 10 Million$ Club
                                        @elseif($data[0]->AprobacionHotmart=="1")
                                        <a class="btn btn-success btn-xs" >
                                            Solicitud Aprobada
                                        </a>                                         
                                        @elseif($data[0]->AprobacionHotmart=="2")
                                        <a class="btn btn-warning btn-xs" disabled>
                                            Solicitud Pendiente de Aprobación
                                        </a> 
                                        en 12 a 24 horas estaremos activando tu enlace de Checkout Hotmart para que puedas ofrecer 10 Million$ Club
                                        @endif
                                        
                                    </li>                                    
                                    
                                    
                                    <li>Una vez aprobado debes copiar y pegar tu enlace de checkout de Hotmart para ofrecer el producto 10 Million$ Club y da click en guardar. 
                                            @if($data[0]->AprobacionHotmart=="1")
                                            <a class="btn btn-xs btn-info" href="https://app-vlc.hotmart.com/hotlinks/1644834?productName=Docttus%20&tab=alternatives-pages" target="_blank">Ver Enlace</a>
                                            @elseif($data[0]->AprobacionHotmart=="2")
                                            <a class="btn btn-warning btn-xs" disabled>
                                                Solicitud Pendiente de Aprobación
                                            </a>
                                            @endif
                                        <br>
                                        @if($data[0]->AprobacionHotmart=="1")
                                        <div class="input-group mb-3" style="margin-top: 15px;">
                                            <input class="form-control" type="url" id="URLCheckoutDocttus" placeholder="URL Checkout Hotmart" value="{{($data[0]->URLHotmartCheckout)?$data[0]->URLHotmartCheckout:''}}" />
                                            <div class="input-group-append">
                                                <button class="btn btn-info" type="button" id="btn_guardar_checkout">Guardar</button>
                                            </div>
                                        </div>
                                        @endif

                                    </li>                                 
                                   
                                    <li>
                                        
                                        Copia y pega el siguiente enlace dentro de la configuración de <strong><a class="btn btn-xs btn-info" href="https://app-vlc.hotmart.com/tools/webhook" target="_blank">Webhook en Hotmart</a></strong>, en 10 Million$ Club y en cada uno de los productos que quieras ofrecer de nuestra parrilla. (<a href="#" src_tutorial="https://www.youtube.com/embed/P70SQM1Cdtc" titulo_tutorial="Configurar Enlace Respuesta Hotmart"  class="btn_tutorial_gen">Ver Tutorial</a>)

                                        <div class="enlace-docttus">
                                            <i class="fa fa-link" aria-hidden="true"></i> <a href="#" target="_blank">{{url('')}}/respuesta-hotmart</a>
                                        </div>

                                        <small>* Nota: Este enlace indica a nuestra plataforma cuando una venta ha sido generada y debes configurarlo todos los productos de nuestra parrilla 10 Million$ Club.</small>
                                        
                                    </li>                                    
                                    
                                </ol>                              
                                
                            </p>
                        </div>

                        @if($data[0]->AprobacionHotmart=="1")
                        <div class="card-docttus" style="margin-top:15px;">
                            
                            <h2 class="titulo-card" >Tus Enlaces Docttus</h2>

                            
                            

                            <h4>Enlace para Afiliados</h4>
                            <p>Invita a otros emprendedores digitales y gana un 80% de Comisión vendiedo Docttus</p>

                            <div class="enlace-docttus">
                                <i class="fa fa-link" aria-hidden="true"></i> <a href="{{url('')}}/registro-afiliados/{{$data[0]->NombreUsuario}}"  target="_blank">{{url('')}}/registro-afiliados/{{$data[0]->NombreUsuario}}</a>
                            </div>

                            <!--<hr>
                            <h4>Enlace para Tutores (Co-Productores)</h4>
                            <p>Invita a personas con grandes conocimientos y gana un 5% por cada venta que se haga de manera orgánica o por afiliados.</p>

                            <div class="enlace-docttus">
                                <i class="fa fa-link" aria-hidden="true"></i> <a href="{{url('')}}/registro-afiliados/{{$data[0]->NombreUsuario}}" target="_blank">{{url('')}}/registro-tutores/{{$data[0]->NombreUsuario}}</a>
                            </div>

                        -->
                        </div>
                        @endif
                    </div>

                    <div class="col-md-6">
                        <div class="card-docttus">
                            
                            <div class="embed-responsive embed-responsive-16by9">                                
                                @if($data[0]->IdEstadoSolicitudAfiliado==1)
                                <iframe  class="embed-responsive-item"  src="https://player.vimeo.com/video/897977322?color=ffffff&title=0&byline=0&portrait=0" width="640" height="360" frameborder="0" allow="autoplay; fullscreen; picture-in-picture" allowfullscreen></iframe>
                                @else
                                <iframe  class="embed-responsive-item"  src="https://player.vimeo.com/video/897977322?color=ffffff&title=0&byline=0&portrait=0" width="640" height="360" frameborder="0" allow="autoplay; fullscreen; picture-in-picture" allowfullscreen></iframe>
                                @endif
                            </div>
                        </div>

                        
                    </div>

                </div>
            

        </div>
        






        <!-- FIN PANEL IZQUIERDO -->


        

        <!-- PANEL DERECHO -->

        

        <!-- fiN PANEL DERECHO -->

        
        
        


    </div>
</div>
@endif
@stop   

@section('scripts')
<script  type="text/javascript">

    $("#btn_solicitar_aprobacion").click(function(e){
        e.preventDefault();
        var request = $.ajax({
          url: "{{url('')}}/solicitar_aprobacion_hotmart",
          type: "POST",
          data:{
               _token: "{{ csrf_token() }}"
          }
        });

        request.done(function(obj) { 
           if(obj.status=="ok"){       

            mensaje_generico("Muy Bien!",""+obj.mensaje,"1","Continuar...",function(){
                location.reload();
            });

           }else{
              mensaje_generico("Error !",""+obj.mensaje,"2","Continuar...",function(){});
              return;
           }
        });
         //respuesta si falla
        request.fail(function(jqXHR, textStatus) {
          alert( "Error de servidor  " + textStatus );
        });
    });

    $("#btn_guardar_checkout").click(function(e){
        e.preventDefault();
        guardar_checkout_hotmart();
    });

    function guardar_checkout_hotmart(){
        var URLCheckoutDocttus=$("#URLCheckoutDocttus").val();
        var request = $.ajax({
          url: "{{url('')}}/guardar_checkout",
          type: "POST",
          data:{               
                URLCheckoutDocttus:""+URLCheckoutDocttus,
               _token: "{{ csrf_token() }}"
          }
        });

        request.done(function(obj) { 
           if(obj.status=="ok"){       

            mensaje_generico("Muy Bien!",""+obj.mensaje,"1","Continuar...",function(){
                location.reload();
            });  

           }else{
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