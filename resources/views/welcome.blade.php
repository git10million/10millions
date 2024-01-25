<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>
    
    </head>
    <body>

        <table border="1">
            <thead>
                <tr>
                    <td>Nombres</td>
                    <td>Apellidos</td>
                    <td>Email</td>
                    <td>Nombre Anterior</td>
                </tr>
            </thead>
            <tbody>
                @foreach ($datos as $item)
                
                <tr>
                    @php

                    $arra_nombres=explode(" ",$item->Nombres);

                    $apellidos="";
                    $nombres="";

                    if(count($arra_nombres)==6){
                        $apellidos="*";
                        $nombres="*";
                    }

                    if(count($arra_nombres)==5){
                        $apellidos="*".$arra_nombres[0]." ".$arra_nombres[1]." ".$arra_nombres[2];
                        $nombres="".$arra_nombres[3]." ".$arra_nombres[4];
                    }

                    if(count($arra_nombres)==4){
                        $apellidos="".$arra_nombres[0]." ".$arra_nombres[1];
                        $nombres="".$arra_nombres[2]." ".$arra_nombres[3];
                    }

                    if(count($arra_nombres)==3){
                        $apellidos="".$arra_nombres[0]." ".$arra_nombres[1];
                        $nombres="".$arra_nombres[2];
                    }

                    @endphp
                    <td>{{$nombres}}</td>
                    <td>{{$apellidos}}</td>
                    <td>{{$item->Email}}</td>
                    <td>{{$item->Nombres}}</td>
                </tr>
                
                
                @endforeach
            </tbody>
        </table>
        
    </body>
</html>
