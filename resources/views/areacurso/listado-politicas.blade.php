@extends('areacurso.plantillas.plantilla-area-interna')
@section('contenido')   
<style>
  .btn_usuario{
    cursor: pointer;
  }

  h2{
      font-size: 20px;
  }
</style>

<div class="row row-docttus">
    <div class="col-md-12">       
      <h1 style="font-weight: 600; font-size: 20px;">Listado de Políticas</h1>
        
      <br>
      <div class="card-docttus card-docttus-left" style=" height: auto !important;">        
        <div class="row row-docttus" style="margin-top: 15px;">
          <div class="col-md-12">

            <a href="{{url('')}}/editar-politicas/" class="btn btn-success" style="float: right; margin-bottom:15px;">+ Nueva Política</a>

            <table class="table table-striped table-bordered" style="font-size: 13px;">
              <thead class="thead-dark">
                 <tr>
                    <th>Política</th>
                    <th style="width:140px;">Fecha</th>                    
                    <th style="width:60px;">Ver</th>
                    <th style="width:60px;">Editar</th>
                  </tr>
              </thead>

              <tbody id="listado_politicas">
                @foreach ($politicas as $item)
                    <tr>
                        <td>{{$item->TituloPolitica}}</td>
                        <td>{{$item->FechaPolitica}}</td>
                        <td style="text-align: center;">
                            <a class="btn btn-success btn-xs" target="_blank" href="{{url('')}}/politica/{{$item->SlugPolitica}}">
                                <i class="fa fa-eye"></i>
                            </a>
                        </td>
                        <td  style="text-align: center;">
                            <a class="btn btn-info btn-xs"  href="{{url('')}}/editar-politicas/{{$item->IdPolitica}}">
                                <i class="fa fa-edit"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
              </tbody>             

            </table>            
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