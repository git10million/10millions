@extends('areacurso.plantillas.plantilla-area-interna')
@section('contenido')   

<style type="text/css">
    .descripcion-curso{
       height: 550px;
       overflow-y: auto;
       margin-top: 45px;
    }
    .contenedor-principal{
      /*background-color: #fff;*/
    }
    .etiqueta-curso{
      position: absolute;
      top: 0px;
      font-size: 11px;
      color: #fff;    
      padding: 2px 18px;
      border-radius: 0px 0px 8px 8px;
      left: 14px;
    }
  
    .btn-group-toggle a{
      text-decoration: none;
      color: #fff;
    }
  
    .class-embed{
      display:none;
    }
    
  
  
    .btn-titulo{
      font-size: 21px;
      color:#9a9a9a;
    }
    
  
  </style>
  
  <form id="form-editar-curso"> 
      <button type="submit" style="display: none;" id="btn_enviar_form_generico"></button>
  
  <div class="container" style="padding-top: 35px;">   
    
    <div class="row my-xl-5 my-3">
      <div class="col-md-12">
        <h4>Fomo Creator</h4>        
        <hr>  
      </div>
    </div>
  
               
    <div class="row">
      <div class="col-md-4">
        <h6 style="font-weight: bold;" class="my-4">Agrega información <span>descriptiva</span></h6>
        <p>Diligencia esta sesión con la información clara sobre el fomo que deseas desarrollar.</p>
      </div>
  
      <div class="col-md-8">
          <div class="card-docttus card-docttus-left" style=" height: auto !important; position: relative;">          
            
            
            <div class="form-group  input-group-sm">
              <label>Tipo Fomo *</label> <i class="fa fa-info-circle btn-titulo" title=""></i>
              <select class="form-control" id="SeccionCurso">
                    <option value="2">Flotante Con Formulario</option>                  
                    <option value="1">Flotante Sin Formulario</option>
                    <option value="1">Embebido Con Formulario</option>
                    <option value="1">Embebido Sin Formulario</option>
              </select>
            </div>            
                
              
  
            <div class="form-group  input-group-sm">
                  <label>Nombre *</label> <i class="fa fa-info-circle btn-titulo" title="Diligencia la denominación o el título del fomo que se encuentra creando."></i>
                  <input id="NombreCurso" type="text" name="nombre" class="form-control valida-caracteres"  value="" required maxlength="70">
                  <div class="text-right">
                      <small> <strong id="cant_caracteres_NombreCurso">0</strong> Carácteres Restantes</small>  
                  </div>              
            </div>


            <div class="form-group  input-group-sm">
                <label>URL Dominio *</label> <i class="fa fa-info-circle btn-titulo" title="URL destimo fomo fomo que se encuentra creando."></i>
                <input id="NombreCurso" type="text" name="nombre" class="form-control"  value="" required >
            </div>
  
            <div class="form-group">    
                            
               <label>Diseño Fomo </label> <i class="fa fa-info-circle btn-titulo" title="Escoge un diseño o crea el tuyo propio"></i>               
                <img src="{{url('')}}/assets/images/temp-fomo-1.png" style="width:100%;">
               
            </div>

  
            <div class="form-group  input-group-sm">
                <label>Mensaje Gracias *</label> <i class="fa fa-info-circle btn-titulo" title="Describe de manera general sobre tu curso, mencionando el método de enseñanza, que conocimientos adquirirán tus estudiantes, qué ventajas tendrán una vez terminen el curso, etc."></i>
                <textarea class="form-control valida-caracteres" id="DescripcionCortaCurso" maxlength="250" required></textarea>
                <div class="text-right">
                  <small> <strong id="cant_caracteres_DescripcionCortaCurso">0</strong> Carácteres Restantes</small>  
                </div>
            </div> 

            <hr />

            <div class="form-group  input-group-sm">
                <label>Código</label> <i class="fa fa-info-circle btn-titulo" title="Copia y pega el código en la cabecera del sitio web."></i>
                <br />
                <code>
                    &lt;script&gt;!function(){function e(){var e=((new Date).getTime(),document.createElement("script"));e.type="text/javascript",e.async=!0,e.src="https://fomo.10millionsclub.live/fomo_ba876c4_ddr1v34.js",window.top.document.getElementsByTagName("body")[0].appendChild(e)}var t=window;t.attachEvent?t.attachEvent("onload",e):t.addEventListener("load",e,!1)}();&lt;/script&gt;
                </code>
            </div> 
  
          </div>
          <br />
          <p style="color: #adadad;">* Campos obligatorios</p>          
      </div>
    </div>
  
  
    <hr />    
      
    
  
      
  
  
  
  
  </div>
  <br />
  <br />
  </form>

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