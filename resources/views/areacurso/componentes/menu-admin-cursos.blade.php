
<div class="menu-intero">
    <div class="row menu-interno-cursos">
        <div class="col-md-12">    
            <a class="btn-tab-dt @if($url_form=='editar-basicos') btn-tab-dt-activo @endif text-center" href="{{url('')}}/cursos/editar-basicos/{{ $CodigoCurso }}">
                <span><i class="fa fa-info" aria-hidden="true"></i></span>
                <p>Información</p>
            </a>
            @if(session('rol_solicitud')=="root")
            <a class="btn-tab-dt @if($url_form=='portada') btn-tab-dt-activo @endif text-center" href="{{url('')}}/cursos/portada/{{$CodigoCurso}}">
                <span><i class="fa fa-picture-o" aria-hidden="true"></i></span>
                <p>Portada</p>
            </a>
            @endif

            <a class="btn-tab-dt @if($url_form=='precio') btn-tab-dt-activo @endif text-center" href="{{url('')}}/cursos/precio/{{$CodigoCurso}}">
                <span><i class="fa fa-usd" aria-hidden="true"></i></span>
                <p>Precio</p>
            </a>

            <a class="btn-tab-dt @if($url_form=='contenido') btn-tab-dt-activo @endif text-center" href="{{url('')}}/cursos/contenido/{{$CodigoCurso}}">
                <span><i class="fa fa-list-alt" aria-hidden="true"></i></span>
                <p>Contenido</p>
            </a>

            <a class="btn-tab-dt @if($url_form=='evaluacion') btn-tab-dt-activo @endif text-center" href="{{url('')}}/cursos/evaluacion/{{$CodigoCurso}}">
                <span><i class="fa fa-check-square-o" aria-hidden="true"></i></span>
                <p>Evaluación</p>
            </a>

            <a class="btn-tab-dt @if($url_form=='estudiantes') btn-tab-dt-activo @endif text-center" href="{{url('')}}/cursos/estudiantes/{{$CodigoCurso}}">
                <span><i class="fa fa-users" aria-hidden="true"></i></span>
                <p>Estudiantes</p>
            </a>

            <a class="btn-tab-dt @if($url_form=='estadisticas') btn-tab-dt-activo @endif text-center" href="{{url('')}}/cursos/estadisticas/{{$CodigoCurso}}">
                <span><i class="fa fa-bar-chart" aria-hidden="true"></i></span>
                <p>Estadísticas</p>
            </a>

            <!--<a class="btn-tab-dt @if($url_form=='embudo') btn-tab-dt-activo @endif text-center" href="{{url('')}}/cursos/embudo/{{$CodigoCurso}}">
                <span><i class="fa fa-filter" aria-hidden="true"></i></span>
                <p>Embudo</p>
            </a>-->

            <a class="btn-tab-dt text-center" href="{{url('')}}/curso/{{$SlugCurso}}"  target="_blank">
                <span><i class="fa fa-eye" aria-hidden="true"></i></span>
                <p>Ver Curso</p>
            </a>

            

            <a class="btn-tab-dt text-center" href="{{url('')}}/c/{{$SlugCurso}}/{{$NombreUsuario}}" target="_blank">
                <span><i class="fa fa-cube" aria-hidden="true"></i></span>
                <p>Ficha Ext.</p>
            </a>


        </div>    
    </div>
</div>
