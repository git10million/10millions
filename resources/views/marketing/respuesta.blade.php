@extends('marketing.plantilla.plantilla')
@section('contenido')   

<style>
    #mensaje_respuesta_transaccion{
        margin-bottom: 35px;
    }
    #mensaje_respuesta_transaccion>span{
        font-size: 21px;
        
    }
</style>

	<section class="hero-section">
		<div class="hero-slider owl-carousel">			
			<div class="hs-item" style="padding-top:38px; padding-bottom: 50px; height: auto !important; background-position: top center; ">
				<div class="container">
					<div class="row">
						<div class="col-lg-12" style="text-align: center;">							
					
							<h1 style="font-size: 48px; color: #fff; margin-top: 100px;">Compra Docttus</h1>
				
						</div>						
					</div>
				</div>
			</div>
		</div>
	</section>


	<!-- Intro section -->
	<section class="intro-section spad">
		<div class="container">
			<div class="row">				
				<div class="col-lg-12">
                    
                    <center>
                        <h3 id="mensaje_respuesta_transaccion"></h3>
                    </center>

                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <td>Referencia</td>
                                    <td id="referencia"></td>
                                </tr>
                                <tr>
                                    <td class="bold">Fecha</td>
                                    <td id="fecha" class=""></td>
                                </tr>
                                <tr>
                                    <td>Respuesta</td>
                                    <td id="respuesta"></td>
                                </tr>
                                <tr>
                                    <td>Motivo</td>
                                    <td id="motivo"></td>
                                </tr>
                                <tr>
                                    <td class="bold">Banco</td>
                                    <td class="" id="banco">
                                </tr>
                                <tr>
                                    <td class="bold">Recibo</td>
                                    <td id="recibo"></td>
                                </tr>
                                <tr>
                                    <td class="bold">Total</td>
                                    <td class="" id="total">
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>


                </div>

                @if($curso_compra)
                <div class="col-lg-12">
                    <div class="row" style="background-color:#fafafa; border-radius: 9px; padding:15px;     box-shadow: 1px 1px 6px 2px #ccc;">
                        <div class="col-md-4">

                            <img style="width: 100%; border-radius:9px;" src="{{url('')}}/assets/images/cursos/{{$curso_compra[0]->ImagenCurso}}" >

                        </div>

                        <div class="col-md-8">
                            <h3>{{$curso_compra[0]->NombreCurso}}</h3>
                            <p>{{$curso_compra[0]->DescripcionCortaCurso}}</p>
                            <br />
                            <a href="{{url('')}}/curso/{{$curso_compra[0]->SlugCurso}}"  class="btn-docttus-web"> IR AL CURSO</a>
                        </div>
                    </div>
                </div>
                @endif

                <div class="col-lg-12" style="margin-top: 45px;">
                    <img src="https://multimedia.epayco.co/epayco-landing/btns/pagos_procesados_por_epayco_370px_.png">
                </div>

			</div>
		</div>
	</section>
	<!-- Intro section end -->


@stop

@section('scripts')
<script>
function getQueryParam(param) {
                    location.search.substr(1)
                        .split("&")
                        .some(function(item) { // returns first occurence and stops
                            return item.split("=")[0] == param && (param = item.split("=")[1])
                        })
                    return param
                }
                $(document).ready(function() {
                    //llave publica del comercio

                    //Referencia de payco que viene por url
                    var ref_payco = getQueryParam('ref_payco');
                    //Url Rest Metodo get, se pasa la llave y la ref_payco como paremetro
                    var urlapp = "https://api.secure.payco.co/validation/v1/reference/" + ref_payco;

                    $.get(urlapp, function(response) {


                        if (response.success) {

                            if (response.data.x_cod_response == 1) {
                                //Codigo personalizado
                                //alert("Transaccion Aprobada");

                                $("#mensaje_respuesta_transaccion").html("Transacción Exitosa<br/> <span>Ya puedes disfrutar de tu curso</span><br>");

                                console.log('transacción aceptada');
                            }
                            //Transaccion Rechazada
                            if (response.data.x_cod_response == 2) {
                                console.log('transacción rechazada');
                                $("#mensaje_respuesta_transaccion").html("Transacción Rechazada<br/> <span>Tuvimos un problema con tu proceso de compra, intenta más tarde</span> <br><span> Cualquier inquietud puedes escribirnos a ventas@docttus.com</span>");
                            }
                            //Transaccion Pendiente
                            if (response.data.x_cod_response == 3) {
                                console.log('transacción pendiente');
                                $("#mensaje_respuesta_transaccion").html("Transacción Pendiente<br/> <span>La transacción está pendiente de comprobación</span> <br><span> Cualquier inquietud puedes escribirnos a ventas@docttus.com</span>");
                            }
                            //Transaccion Fallida
                            if (response.data.x_cod_response == 4) {
                                console.log('transacción fallida');
                                $("#mensaje_respuesta_transaccion").html("Transacción Fallida<br/> <span>Tuvimos un problema con tu proceso de compra, intenta más tarde</span> <br><span> Cualquier inquietud puedes escribirnos a ventas@docttus.com</span>");
                            }

                            $('#fecha').html(response.data.x_transaction_date);
                            $('#respuesta').html(response.data.x_response);
                            $('#referencia').text(response.data.x_id_invoice);
                            $('#motivo').text(response.data.x_response_reason_text);
                            $('#recibo').text(response.data.x_transaction_id);
                            $('#banco').text(response.data.x_bank_name);
                            $('#autorizacion').text(response.data.x_approval_code);
                            $('#total').text(response.data.x_amount + ' ' + response.data.x_currency_code);


                        } else {
                            alert("Error consultando la información");
                        }
                    });

                });
</script>
@stop



