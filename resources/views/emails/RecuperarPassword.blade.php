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

                                Código de Recuperación Contraseña

                            </div>

                            <div>
                                <p style="font-size: 16px; line-height: 20px; font-weight: 300; margin-top: 33px; margin-bottom: 15px;">Para verificar que tu cuenta sea segura, utiliza el siguiente código para habilitar la nueva contraseña; Este código caducará en 15 minutos:</p>
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td height="10" style="font-size: 10px; line-height: 10px;">&nbsp;</td>
                    </tr>

                    <tr>
                        <td align="center" style="background-color:#f2f2f2;">
                            <h1 style="font-size:35px; color:#8cc1c1; text-align:center; padding:10px; ">{{$data_email->codigo_recuperacion}}</h1>
                        </td>
                    </tr>


                    <tr>
                        <td height="10" style="text-align: center; font-size: 19px; padding-top: 25px;">
                            <strong>URL Verificación</strong><br />
                            <a href="https://docttus.com/verificacion-codigo/{{$data_email->token_recuperacion}}">https://docttus.com/verificacion-codigo/{{$data_email->token_recuperacion}}</a>                            
                        </td>
                    </tr>

                </table>

            </td>
        </tr>

        <tr>
            <td height="40" style="font-size: 40px; line-height: 40px;">&nbsp;</td>
        </tr>
    
@stop