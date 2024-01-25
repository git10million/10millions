@extends('areacurso.plantillas.plantilla-area-interna')

@section('cabecera')
<style type="text/css">
   .container-recurso{
      width: 180px; 
      height: 180px; 
      background-color: #e3e3e3; 
      border-radius: 9px; 
      margin-left: 15px; 
      margin-bottom: 15px; 
      display: inline-block; 
      text-align: center;
      cursor: pointer;
   }
   .imagen-media{
     width: 180px; height: 140px; background-size: contain; background-position: center; background-repeat: no-repeat;   
   }
</style>
@stop

@section('contenido')


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-5">
            <h1 class="m-0 text-dark">Configuración</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('')}}/backoffice">Inicio</a></li>
              <li class="breadcrumb-item active">Configuración</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

      <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">          

          <div class="col-lg-5">
            <div class="card">
              <div class="card-body">
                <p class="card-text">
                    <h2>Banner Monetización - Adsense</h2>
                    <hr>
                    
                    <label>Banner Superior</label>                    
                    <textarea class="form-control" id="BannerSuperior" rows="5">{{$data_configuracion->BannerSuperior}}</textarea>

                    <label>Banner SideBar</label>                    
                    <textarea class="form-control" id="BannerSideBar" rows="5">{{$data_configuracion->BannerSideBar}}</textarea>

                    <label>Banner Contenido</label>                    
                    <textarea class="form-control" id="BannerArticulos" rows="5">{{$data_configuracion->BannerArticulos}}</textarea>

                    <label>Banner Listado</label>                    
                    <textarea class="form-control" id="BannerListado" rows="5">{{$data_configuracion->BannerListado}}</textarea>
                    
                    <!--<hr>
                    <h5 style=" background-color: #007bff; color: #fff; padding: 10px;">Versión Mobile</h5>

                    <label>Banner Superior Mobile</label>                    
                    <textarea class="form-control" id="BannerSuperiorMobile" rows="5">{{$data_configuracion->BannerSuperiorMobile}}</textarea>

                    <label>Banner Sidebar Mobile</label>                    
                    <textarea class="form-control" id="BannerSideBarMobile" rows="5">{{$data_configuracion->BannerSideBarMobile}}</textarea>

                    <label>Banner Contenido Mobile</label>                    
                    <textarea class="form-control" id="BannerArticulosMobile" rows="5">{{$data_configuracion->BannerArticulosMobile}}</textarea>-->



                </p>                
              </div>
            </div>
          </div>



          <div class="col-lg-6">
            <div class="card">
              <div class="card-body">
                <p class="card-text">
                    <h2>Métricas</h2>
                    <hr>   

                    <label>Google Analytics</label>                    
                    <textarea class="form-control" id="GoogleAnalytics" rows="5">{{$data_configuracion->GoogleAnalytics}}</textarea>

                    <label>Pixel Facebook</label>                    
                    <textarea class="form-control" id="PixelFacebook" rows="5">{{$data_configuracion->PixelFacebook}}</textarea>

                </p>                
              </div>
            </div>
          </div>


          <div class="col-md-1">
            <a href="#" id="btn_guardar_configuracion">
              <img src="{{url('')}}/assets-blog/images/boton_guardar.png" style="width: 55px; height: 55px; position: fixed; top: 225px; right: 25px;">
            </a>

            
          </div>



          

          

          
          
          
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->







@stop

@section('scripts')
  <script type="text/javascript">
    
   
    $("#btn_guardar_configuracion").click(function(e){
      e.preventDefault();
      guardar_configuracion();      
    });

    function guardar_configuracion(){
     
      var formData = new FormData();    
      
      var BannerSuperior=""+$("#BannerSuperior").val();
      var BannerSideBar=""+$("#BannerSideBar").val();
      var BannerArticulos=""+$("#BannerArticulos").val();
      var BannerListado=""+$("#BannerListado").val();
      /*var BannerSuperiorMobile=""+$("#BannerSuperiorMobile").val();
      var BannerSideBarMobile=""+$("#BannerSideBarMobile").val();
      var BannerArticulosMobile=""+$("#BannerArticulosMobile").val();*/
      var GoogleAnalytics=""+$("#GoogleAnalytics").val();
      var PixelFacebook=""+$("#PixelFacebook").val();


      formData.append('BannerSuperior', BannerSuperior);
      formData.append('BannerSideBar', BannerSideBar);
      formData.append('BannerArticulos', BannerArticulos);
      formData.append('BannerListado', BannerListado);
      
      formData.append('BannerSuperiorMobile', "");
      formData.append('BannerSideBarMobile', "");
      formData.append('BannerArticulosMobile', "");
      formData.append('GoogleAnalytics', GoogleAnalytics);
      formData.append('PixelFacebook', PixelFacebook);

      formData.append('_token', "{{ csrf_token() }}");        
    

      var request = $.ajax({
              url: "{{url('')}}/set_configuracion",
              type: "POST",
              
              data: formData,
              processData: false,  // tell jQuery not to process the data
              contentType: false  // tell jQuery not to set contentType


            });

            request.done(function(obj) {                  
           
              if(obj.status=="ok"){                              
                alert("El proceso fue generado correctamente");
                location.reload();
                return;
              }else{                  
                alert("Error!, "+obj.mensaje);
                return;
              }

            });
             

             //respuesta si falla
            request.fail(function(jqXHR, textStatus) {
              alert( "Error de servidor  " + textStatus );
            });


    }


  </script>
@stop
