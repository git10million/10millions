@extends('marketing.plantilla.plantilla')
@section('contenido')   

<style type="text/css">
	 #btn_categoria,.main-menu,.banner-footer-derecho{
        display: none !important;
    }


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

    @media only screen and (max-width: 991px) {
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

        
    }
</style>
<!-- Contact section -->

<!-- Hero section -->
	<section class="hero-section">
		<div class="hero-slider owl-carousel">			
			<div class="hs-item" style="padding-top:38px; padding-bottom: 80px; height: auto !important; background-position: top center; ">
				<div class="container">
					<div class="row">
						<div class="col-lg-12" style="text-align: center;">							
					
							
				
						</div>						
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- Hero section end -->

	<section class="seccionevento">
		<div class="container">
			<div class="row">				
                <div class="col-md-12 text-center">
                    <h1 class="seccionevento__titulo">MUCHAS GRACIAS</h1>
                    <br />
                    <h1 class="seccionevento__h1"><strong style="text-decoration: underline;">CONFERENCIA:</strong> IMPUESTOS PARA EMPRENDEDORES DIGITALES</h1>
                    
                    <!--<div class="seccionevento__contenedor">
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
                        <h2 style="color: #fff;" class="seccionevento__titulotimer">08:00 P.M. Colombia</h2>
                        <small class="seccionevento__label">Hora</small>
                    </div>

                    -->

                <br />

                    
                </div>
                <div class="col-md-12">
                    <div class="cardregistro">
                        <h3>Grabación</h3>
                        <br />
                        <div class="embed-responsive embed-responsive-16by9">
                            <iframe class="embed-responsive-item" src="https://player.vimeo.com/video/547519814" allowfullscreen></iframe>
                        </div>
                    </div>
                </div>
			</div>
		</div>
	</section>




@stop

@section('scripts')
    <script>
    
        
    </script>
@stop
