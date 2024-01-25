@extends('areacurso.plantillas.plantilla-area-interna')
@section('contenido')   


<style type="text/css">
	.contact-warp p {
	    padding-top: 10px;
	    margin-bottom: 10px;
	}

    .seccionevento{
        padding-top: 105px;
        padding-bottom: 105px;
    }
    .seccionevento__h1{
        font-size:45px;
        color: #285d8f;
    }

    .seccionevento__carddate{
        display: inline-block;
        width: 120px;
        text-align: center;
        padding:25px 15px;
        border-radius: 9px;
        border:1px solid #ccc;
        background-color: #fafafa;
        margin-right: 10px;
        margin-bottom: 15px;
    }
    .seccionevento__contenedor{
        margin-top: 35px;
    }

    .seccionevento__timer{
        background-color: #285d8f;
        display: inline-block;
        padding:20px 10px;
        margin-top: 10px;
        border-radius: 9px;
        border:1px solid #ccc;
        color:#fff;
        text-align: center;
        width: 390px;
    }

    .cardregistro{
        width: 100%;
        background-color: #fff;
        padding: 25px;
        border-radius: 9px;
        border: 1px solid #f1f1f1;
        box-shadow: 0px 12px 9px 0px #f5f5f5cc;
    }

    .cardregistro__input{
        border: 1px solid #ccc !important;
    }

    .seccionevento__label{
        font-size: 15px;
    }


    .seccioncontenido{
        background-color: #fafafa;
        padding:55px 0px;
    }

    .seccioncontenido__listado li{
        font-size: 20px;
        text-align: justify;
    }

    @media only screen and (max-width: 991px) {
        .menu_principal_mobile{
            display: none !important;
        }
        .seccionevento{
           padding-top: 45px !important; 
        }

        .seccionevento__titulo{
            font-size: 35px;
            text-align: center;
        }

        .seccionevento__h1{
            font-size:25px;
            text-align: center;
        }

        .seccionevento__contenedor{
            text-align: center;
        }

        .seccionevento__carddate{            
            width: 100px;
            text-align: center;
            padding:20px 10px;
            border-radius: 9px;
            border:1px solid #ccc;
            background-color: #fafafa;
            margin-right: 10px;
            margin-bottom: 15px;
        }

        .cardregistro{
            margin-top:15px;
        }

        .seccionevento__enlace{
            font-size: 14px;
        }

        .seccionevento__timer{
            width: 100%;
        }

        .seccionevento__titulotimer{
            font-size: 30px;
        }

        .seccioncontenido__listado{
            padding:5px 25px;
        }

        .seccioncontenido__titulo{
            text-align: center;
            margin-top: 45px;
        }

        
    }
</style>


<div class="row">
    <div class="col-md-12">
        

        <section class="seccionevento">
            <div class="container">
                <div class="row">				
                    <div class="col-md-7">
                        <h1 class="seccionevento__titulo">CONFERENCIA</h1>
                        <h1 class="seccionevento__h1">IMPUESTOS PARA EMPRENDEDORES DIGITALES</h1>
                        
                        <div class="seccionevento__contenedor">
                            <div class="seccionevento__carddate">                        
                                <h2>07</h2>
                                <small class="seccionevento__label">Día</small>                        
                            </div>
    
                            <div class="seccionevento__carddate">                        
                                <h2>05</h2>
                                <small class="seccionevento__label">Mes</small>
                            </div>
    
                            <div class="seccionevento__carddate">                        
                                <h2>2021</h2>
                                <small class="seccionevento__label">Año</small>
                            </div>
                        </div>
    
                        <div class="seccionevento__timer">
                            <h2 style="color: #fff;">08:00 P.M. Miami</h2>
                            <small class="seccionevento__label">Hora</small>
                        </div>
    
    
    
                        
                    </div>
                    <div class="col-md-5">
                        <div class="row">
                            <div class="col-md-12 text-center">
                                <img src="{{url('')}}/assets/images/david.jpg" class="img-fluid" style="border-radius: 145px; width:140px;"  alt="">
                                <h4 style="margin-top: 10px;">Javier David</h4>
                                <span>Contador Público, Especialista en Derecho Tributario</span>
                            </div>
            
                            <div class="col-md-12">
            
                                <h2 class="seccioncontenido__titulo">¿Que aprenderás en esta conferencia?</h2>
                                <hr>
            
                                <ul class="seccioncontenido__listado">
                                    <li>Aspecto generales sobre la tributación en USA</li>
                                    <li>Obligados a declarar renta y llevar contabilidad como persona natural y jurídica en USA</li>
                                    <li>Regimen Ordinario de Tributación en USA</li>
                                    <li>Regimen Simple de Tributación en USA</li>
                                    <li>Tratamiento fiscal de los impuestos en el extranjero</li>                        
                                </ul>
                                
                            </div>
                            
                            
            
                        </div>
                    </div>
                </div>
            </div>
        </section>
    
        <section class="seccioncontenido">
            <div class="container">
                <div class="col-md-12">
                    <div class="cardregistro">
                        <h3>Grabación</h3>
                        <br />
                        <div class="embed-responsive embed-responsive-16by9">
                            <iframe class="embed-responsive-item" src="https://player.vimeo.com/video/897977322" allowfullscreen></iframe>
                        </div>
                    </div>
                </div>


                
            </div>
        </section>


        
    </div>    

</div>        


@stop

@section('scripts')

    
    <script type="text/javascript">


    </script>
@stop