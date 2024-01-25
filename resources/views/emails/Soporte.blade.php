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

                            <strong>Asunto:</strong> {{$data_email->AsuntoSoporte}} <br />

                            <strong>Nombre:</strong> {{$data_email->NombrePersona}} 
                            <strong>Email:</strong> {{$data_email->EmailPersona}} 
                            <strong>Perfíl:</strong> {{$data_email->PerfilPersona}} 

                        </div>

                        <div>
                            <h3>Descripción</h3>
                            <p style="font-size: 16px; line-height: 20px; font-weight: 300; margin-top: 33px; margin-bottom: 15px;">                                                                
                                {{$data_email->DescripcionSoporte}}                            
                            </p>

                            <h3>Adjuntos</h3>
                            @if($data_email->NombreArchivo1)
                            <p style="font-size: 16px; line-height: 20px; font-weight: 300; margin-top: 33px; margin-bottom: 15px;">
                                <a href="{{url('')}}/assets/soporte/{{$data_email->NombreArchivo1}}">Adjunto No. 1 </a>
                            </p>
                            @endif

                            @if($data_email->NombreArchivo2)
                            <p style="font-size: 16px; line-height: 20px; font-weight: 300; margin-top: 33px; margin-bottom: 15px;">
                                <a href="{{url('')}}/assets/soporte/{{$data_email->NombreArchivo2}}">Adjunto No. 2 </a>
                            </p>
                            @endif


                            @if($data_email->NombreArchivo3)
                            <p style="font-size: 16px; line-height: 20px; font-weight: 300; margin-top: 33px; margin-bottom: 15px;">
                                <a href="{{url('')}}/assets/soporte/{{$data_email->NombreArchivo3}}">Adjunto No. 3 </a>
                            </p>
                            @endif
		
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