<li class="list-group-item" style=" height: 62px !important; position: relative; margin-bottom:10px; border-radius:5px;     padding-top: 17px;">
    <table style="width: 100%;">
        <tr>
            <td style="width: 18px;">
                <i class="fa fa-ellipsis-v" style=" font-size: 26px;  color: #0b558685;" aria-hidden="true"></i>
            </td>        
            <td>
                <span style="font-size: 15px; color: #7b7b7b;">
                    @switch($TipoMedia)
                        @case("1")
                            <i class="fa fa-file-video-o" aria-hidden="true"></i>
                        @break

                        @case("2")
                            <i class="fa fa-file-image-o" aria-hidden="true"></i>
                        @break

                        @case("3")
                            <i class="fa fa-file-word-o" aria-hidden="true"></i>
                        @break

                        @case("4")
                            <i class="fa fa-file-audio-o" aria-hidden="true"></i>
                        @break
                    @endswitch

                     {{$NombreMedia}}</span>
            </td>   
            <td style="width: 24px; text-align:left;">
                <div class="btn-group dropleft">
                    <button type="button" class="btn btn-default dropdown-toggle btn-menu-leccion" data-toggle="dropdown" aria-haspopup="true" style="width: 25px; height:25px; border-radius: 15px;     padding-top: 1px; ">
                        <i class="fa fa-ellipsis-v" aria-hidden="true" style="font-size: 15px; margin-top: 2px;"></i>
                    </button>
                    <div class="dropdown-menu">
                        <!--<a class="dropdown-item" href="#"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>  Editar</a>-->
                        <button class="dropdown-item" type="button"><i class="fa fa fa-trash-o" aria-hidden="true"></i>  Eliminar</button>
                    </div>
                </div>
            </td>
        </tr>
    </table>
</li>