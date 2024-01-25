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

        <img src="{{url('')}}/assets/images/chat-bot.png" style="width: 100%;">
        
    </div>    

</div>        


@stop

@section('scripts')

    
    <script type="text/javascript">
        
    </script>

<script type="text/javascript">
    function iframeLoaded() {
          var iFrameID = document.getElementById('admi');
          if(iFrameID) {
                // here you can make the height, I delete it first, then I make it again
                iFrameID.height = "";
                iFrameID.height = iFrameID.contentWindow.document.body.scrollHeight + "px";
          }   
      }

  
  </script>
@stop