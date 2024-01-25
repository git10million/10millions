@extends('areacurso.plantillas.plantilla-area-interna')
@section('contenido')   

</style>
<div class="row row-docttus">
    <div class="col-md-12">
       <h4>¿Cómo podemos ayudarte?</h4>
       <h1>Soporte Docttus</h1>
        
        <br>        

        <ul class="nav nav-tabs" id="myTab" role="tablist">
          <li class="nav-item">
            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#estudiantes" role="tab" aria-controls="estudiantes" aria-selected="true">
              Estudiantes
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#instructores" role="tab" aria-controls="instructores" aria-selected="false">Instructores</a>
          </li>          

          <li class="nav-item">
            <a class="nav-link" id="afiliados-tab" data-toggle="tab" href="#afiliados" role="tab" aria-controls="afiliados" aria-selected="false">Afiliados</a>
          </li>          
        </ul>
        <div class="tab-content" id="myTabContent">
          <div class="tab-pane fade show active" id="estudiantes" role="tabpanel" aria-labelledby="home-tab">
            <div>
              <div class="row row-docttus" style="margin-top: 30px;">


                  <div class="col-md-3">
                    <a href="{{url('')}}/ayuda/preguntas-frecuentes-sobre-docttus">
                     <div class="card-docttus card-docttus-left" style=" height: auto !important; margin-bottom: 25px;  height: 125px !important;">
                         <p style="text-align: center; text-decoration: none; color: #222;">Preguntas Más Frecuentes Sobre Docttus</p>
                     </div>
                    </a>
                 </div>


                 <div class="col-md-3">
                    <a href="{{url('')}}/ayuda/preguntas-frecuentes-sobre-docttus">
                     <div class="card-docttus card-docttus-left" style=" height: auto !important; margin-bottom: 25px;  height: 125px !important;">
                         <p style="text-align: center; text-decoration: none; color: #222;">Como Visualizar Cursos</p>
                     </div>
                    </a>
                 </div>

                 <div class="col-md-3">
                    <a href="{{url('')}}/ayuda/preguntas-frecuentes-sobre-docttus">
                     <div class="card-docttus card-docttus-left" style=" height: auto !important; margin-bottom: 25px;  height: 125px !important;">
                         <p style="text-align: center; text-decoration: none; color: #222;">Cómo Solicitar un Reembolso</p>
                     </div>
                    </a>
                 </div>

                 <div class="col-md-3">
                    <a href="{{url('')}}/ayuda/preguntas-frecuentes-sobre-docttus">
                     <div class="card-docttus card-docttus-left" style=" height: auto !important; margin-bottom: 25px;  height: 125px !important;">
                         <p style="text-align: center; text-decoration: none; color: #222;">Cuantos Cursos puedo tener</p>
                     </div>
                    </a>
                 </div>


              </div>
            </div>
          </div>
          <div class="tab-pane fade" id="instructores" role="tabpanel" aria-labelledby="profile-tab">
             <div class="row row-docttus" style="margin-top: 30px;">


                  <div class="col-md-3">
                    <a href="{{url('')}}/ayuda/preguntas-frecuentes-sobre-docttus">
                     <div class="card-docttus card-docttus-left" style=" height: auto !important; margin-bottom: 25px; height: 125px !important;">
                         <p style="text-align: center; text-decoration: none; color: #222;">Cuanto dinero puedo ganar como instructor</p>
                     </div>
                    </a>
                 </div>


                 <div class="col-md-3">
                    <a href="{{url('')}}/ayuda/preguntas-frecuentes-sobre-docttus">
                     <div class="card-docttus card-docttus-left" style=" height: auto !important; margin-bottom: 25px;  height: 125px !important;">
                         <p style="text-align: center; text-decoration: none; color: #222;">Cómo debo subir los cursos</p>
                     </div>
                    </a>
                 </div>


                 <div class="col-md-3">
                    <a href="{{url('')}}/ayuda/preguntas-frecuentes-sobre-docttus">
                     <div class="card-docttus card-docttus-left" style=" height: auto !important; margin-bottom: 25px;  height: 125px !important;">
                         <p style="text-align: center; text-decoration: none; color: #222;">Cómo puedo convertirme en tutor Docttus</p>
                     </div>
                    </a>
                 </div>

                


              </div>
          </div>


          <div class="tab-pane fade" id="afiliados" role="tabpanel" aria-labelledby="profile-tab">
             <div class="row row-docttus" style="margin-top: 30px;">


                  <div class="col-md-3">
                    <a href="{{url('')}}/ayuda/preguntas-frecuentes-sobre-docttus">
                     <div class="card-docttus card-docttus-left" style=" height: auto !important; margin-bottom: 25px; height: 125px !important;">
                         <p style="text-align: center; text-decoration: none; color: #222;">Cuanto dinero puedo ganar cómo afiliado</p>
                     </div>
                    </a>
                 </div>


                 <div class="col-md-3">
                    <a href="{{url('')}}/ayuda/preguntas-frecuentes-sobre-docttus">
                     <div class="card-docttus card-docttus-left" style=" height: auto !important; margin-bottom: 25px;  height: 125px !important;">
                         <p style="text-align: center; text-decoration: none; color: #222;">Tengo embudos para vender los cursos?</p>
                     </div>
                    </a>
                 </div>


                 <div class="col-md-3">
                    <a href="{{url('')}}/ayuda/preguntas-frecuentes-sobre-docttus">
                     <div class="card-docttus card-docttus-left" style=" height: auto !important; margin-bottom: 25px;  height: 125px !important;">
                         <p style="text-align: center; text-decoration: none; color: #222;">En cuanto tiempo puedo retirar mis ganancias</p>
                     </div>
                    </a>
                 </div>

              </div>
          </div>
          
        </div>



       
    </div>
</div>

@stop

@section('scripts')

    
<script type="text/javascript">
   

</script>
@stop