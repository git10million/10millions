@extends('emails.layout')

@section('contenido')
    
    <tr>
        <td align="center">
            <table border="0" align="center" width="590" cellpadding="0" cellspacing="0" class="container590">

                <tr>
                    <td align="center" style="color: #343434; font-size: 24px; font-family: Quicksand, Calibri, sans-serif; font-weight:700; line-height: 35px;"
                        class="main-header">
                        <!-- section text ======-->

                        <div style="line-height: 35px">

                            Hola, tu solicitud ha sido {{$data_email->EstadoSolicitud}}

                        </div>

                        <div>
                            <p style="font-size: 16px; line-height: 20px; font-weight: 300; margin-top: 33px; margin-bottom: 15px;">                                                                
                                {{$data_email->RespuestaSolicitud}}                            
                            </p>
                        </div>
                    </td>
                </tr>

                <tr>
                    <td height="10" style="font-size: 10px; line-height: 10px;">&nbsp;</td>
                </tr>
               

            </table>

        </td>
    </tr>

    <tr>
        <td height="40" style="font-size: 40px; line-height: 40px;">&nbsp;</td>
    </tr>
    
@stop