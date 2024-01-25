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
                            
                            <h1 style="text-align: center;">Gracias !!</h1>
                            <h3>Tu Compra:  <strong>{{$data_email->CodigoCurso}} - {{$data_email->NombreCurso}}</strong></h3>
                            <strong>Tutor:</strong> {{$data_email->NombreTutor}} <br />                            
                            <hr />
                            <h4>Tus Datos de Acceso</h4>
                            <strong>URL:</strong> <a href="https://docttus.com/login">https://docttus.com/login</a>  <br />                            
                            <strong>Usuario:</strong> {{$data_email->NombreUsuario}}  <br />
                            @if($data_email->PasswordUsuario)
                            <strong>Password:</strong> {{$data_email->PasswordUsuario}}  <br />
                            <p>Recomendación: Puedes cambiar tu contraseña dentro del área de  <strong>Editar Usuario.</strong></p>
                            @else
                            <strong>Password:</strong> **********  <br />
                            @endif

                        </div>                        
                        <div style="line-height: 35px">
                            <p>Si tienes alguna problema al ingresar puedes comunicarte con nosotros al WhatsApp +573202358382, al correo electrónico info@docttus.com, y con mucho gusto te resolveremos tus dudas o problemas.</p>
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