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

  @component('areacurso.componentes.menu-admin-cursos')
    @slot('CodigoCurso')
      {{$curso->CodigoCurso}}
    @endslot   

    @slot('url_form')
      {{$url_form}}
    @endslot     

    @slot('SlugCurso')
      {{$curso->SlugCurso}}
    @endslot   

    @slot('NombreUsuario')      
      {{$data[0]->NombreUsuario}}
    @endslot   
    
  @endcomponent

  
  <div class="row my-xl-5 my-3">
    <div class="col-md-12">
      <h4>Precio del Curso</h4>
      <small><i><strong>Curso:</strong> {{$curso->NombreCurso}}</i></small>
      <hr>
    </div>
  </div>

             
  <div class="row">
    <div class="col-md-4">
      <h6 style="font-weight: bold;" class="my-4">Agrega el precio de tu curso</h6>
      <p>En el campo Precio USD, tendrás que diligenciar el valor de tu curso en dólares.</p>
      <p>En la sección Valor infoproducto, se podrá visualizar el valor total del curso.</p>
    </div>

    <div class="col-md-8">
        <div class="card-docttus card-docttus-left" style=" height: auto !important; position: relative;">          
            <div class="form-group  input-group-sm">   
              

              
              @if(session('rol_solicitud')=="root")
              <div class="form-group  input-group-sm">                        
                <input id="AplicaGratisCurso" type="checkbox" @if($curso->AplicaGratisCurso=="1") checked @endif  >                
                <label>Producto Gratuito </label>                
              </div>
              @endif


              
              <label>Precio en USD *</label>
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="basic-addon1">$</span>
                </div>                
                <select class="form-control"  id="PrecioCurso">
                  <option value="7.00">$7.00 USD</option>
                  <option value="14.00">$14.00 USD</option>
                  <option value="27.00">$27.00 USD</option>
                  <option value="49.95">$49.95 USD</option>
                  <option value="77.95">$77.00 USD</option>
                  <option value="99.00">$99.00 USD</option>
                </select>
              </div>

            </div>

            <!--<div class="form-group  input-group-sm">                        
                <label>Descuento en % *</label> <i class="fa fa-info-circle btn-titulo" title="Lorem ipsum dolor sit amet consectetur adipisicing elit. Obcaecati inventore, commodi quis asperiores mollitia quam numquam similique temporibus et totam est vero quidem tenetur doloremque delectus dolores, iure harum maxime."></i>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text" id="basic-addon1">%</span>
                    </div>
                    <input id="DescuentoCurso" required type="number" class="form-control" maxlength="5" min="0" value="{{$curso->DescuentoCurso}}" pattern="^\d*(\.\d{0,2})?$" >
                </div>
            </div>-->

            

            <!--
              <hr />
              <div class="form-group  input-group-sm">
              
              <table class="table table-bordered table-striped" style="margin-bottom: 0px;">
                <tr>
                  <td>Valor Infoproducto</td>
                  <td style="text-align:right;">$ <span id="valor_info_producto">0</span></td>
                </tr>
                <tr style="color:#dc3636;">
                  <td>- Descuento <span id="porcentaje_descuento_producto">0</span>%</td>
                  <td style="text-align:right;">- $ <span id="valor_descuento_producto">0</span></td>
                </tr>

                <tr style="background-color: #0b5586; color:#fff;">
                  <td><h4 style="font-weight: bold;">Subtotal  <i class="fa fa-info-circle btn-titulo" style="color: #fff;" title="Lorem ipsum dolor sit amet consectetur adipisicing elit. Obcaecati inventore, commodi quis asperiores mollitia quam numquam similique temporibus et totam est vero quidem tenetur doloremque delectus dolores, iure harum maxime."></i></h4> </td>
                  <td style="text-align:right;"><h4 style="font-weight: bold;">$ <span id="valor_subtotal_producto">0</span></h4></td>
                </tr>

                
                <tr  style="background-color: #0b5586; color:#fff !important;">
                  <td><h1 style=" color:#fff !important;">TOTAL</h1></td>
                  <td style="text-align:right;">
                    <h1 style="margin-top: 0px;  color:#fff !important;">$ <span id="valor_total_producto">0</span></h1>
                  </td>
                </tr>
              </table>

            </div>-->

            <div class="form-group  input-group-sm text-center">
              
            </div>

        </div>
        <br />
        <p style="color: #adadad;">* Campos obligatorios</p>
        <p style="color: #adadad;">* NOTA: Los campos que no completes no se mostrarán en la página de inicio del curso. Los precios están en Dólares Americanos (USD)</p>
    </div>
  </div>

  <hr />

  <div class="row">
    <div class="col-md-4">
      <h6 style="font-weight: bold;" class="my-4">Calculadora</h6>
      <p>De acuerdo a la información registrada en la anterior sesión, se podrá visualizar: </p>
      <ul>
        <li>Tus ganancias, si el curso lo vendes como Tutor.</li>
        <li>Tus ganancias, si el curso lo vende un Afiliado ó Docttus.</li>        
      </ul>

      <table class="table table-bordered table-striped">
        <thead>
          <tr>
            <th>Item</th>
            <th>%</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>Tutor</td>
            <td>15%</td>
          </tr>

          <tr>
            <td>Co-Productor</td>
            <td>5%</td>
          </tr>

          <tr>
            <td>Afiliado</td>
            <td>70%</td>
          </tr>

          <tr>
            <td>Docttus</td>
            <td>10%</td>
          </tr>
        </tbody>
      </table>
      <small>* Nota: Tener en cuenta que las comisiones se calculan sobre el <strong>Valor Comisión Producto</strong></small>
    </div>

    <div class="col-md-8">
        <div class="card-docttus card-docttus-left" style=" height: auto !important; position: relative;">          
            <div class="form-group  input-group-sm">                        
              <label>Visualiza tus ganancias</label>
              
              <div class="row">
                  <div class="col-md-12 text-center">
                    <hr>

                    <table class="table table-bordered table-striped text-left">
                        <tr>
                          <td>Valor Producto</td>
                          <td class="text-right">$<span id="subtotal_docttus">0</span></td>
                        </tr>
                        
                        <tr>
                          <td>Fees Hotmart (<span id="porcentaje_fees">0</span>%)</td>
                          <td class="text-right">$<span id="fees_docttus">0</span></td>
                        </tr>

                        <tr>
                          <td style="font-weight: bold; font-size:20px;">Valor Comisión Producto</td>
                          <td  style="font-weight: bold;  font-size:20px;" class="text-right">$<span id="total_docttus">0</span></td>
                        </tr>
                    </table>

                    <label>Cantidad Ventas:</label>
                    <input id="cantidad_producto" class="form-control input-lg" type="number" step="1" style="text-align: center; font-size:35px; height:50px;" min="1" value="1" onchange="calcular_comisiones()">
                  </div>                  
              </div>

              @if($data[0]->EsCoproductor==0 || $data[0]->EsCoproductor=="" )
              <div class="row" style="margin-top: 25px; background-color:#ffc107; padding-bottom:9px; padding-top:9px; border-radius:9px;">
                <div class="col-md-12 text-center">
                    <h2>Sin Co-Productor</h2>
                </div>
              </div>

              <div class="row" style="margin-top: 25px; background-color:#e4e4e4; padding-bottom:9px; padding-top:9px; border-radius:9px;">

                  <div class="col-md-12 text-center" >
                    <h5>1. Tus ganancias si lo vendes con el enlace de tutor (90%)</h5>
                    <div style="width:100%; padding:15px; border-radius:9px; background-color: #0b5586; color:#fff; " class="text-center" >
                        <span style="font-size: 45px;">$<span id="comision_tutor_tutor">0</span> USD</span>
                    </div>

                  </div>

              </div>

              <div class="row" style="margin-top: 25px;  background-color:#e4e4e4; padding-bottom:9px;  padding-top:9px; border-radius:9px;">

                <div class="col-md-12 text-center" >
                  <h5>2. Tus ganancias sí el producto lo vende un Afiliado ó Docttus (20%)</h5>
                  <div style="width:100%; padding:15px; border-radius:9px; background-color: #0b5586; color:#fff; " class="text-center" >
                      <span style="font-size: 45px;">$<span id="comision_afiliado_tutor">0</span>  USD</span>
                  </div>

                </div>

              </div>        
              
              @else

              <div class="row" style="margin-top: 25px; background-color:#ffc107; padding-bottom:9px; padding-top:9px; border-radius:9px;">
                <div class="col-md-12 text-center">
                    <h2>Con Co-Productor</h2>
                </div>
              </div>

              <div class="row" style="margin-top: 25px; background-color:#e4e4e4; padding-bottom:9px; padding-top:9px; border-radius:9px;">

                  <div class="col-md-12 text-center" >
                    <h5>1. Tus ganancias si lo vendes con el enlace de tutor (85%)</h5>
                    <div style="width:100%; padding:15px; border-radius:9px; background-color: #0b5586; color:#fff; " class="text-center" >
                        <span style="font-size: 45px;">$<span id="comision_tutor_tutor_2">0</span> USD</span>
                    </div>

                  </div>

              </div>

              <div class="row" style="margin-top: 25px;  background-color:#e4e4e4; padding-bottom:9px;  padding-top:9px; border-radius:9px;">

                <div class="col-md-12 text-center" >
                  <h5>2. Tus ganancias sí el producto lo vende un Afiliado ó Docttus (15%)</h5>
                  <div style="width:100%; padding:15px; border-radius:9px; background-color: #0b5586; color:#fff; " class="text-center" >
                      <span style="font-size: 45px;">$<span id="comision_afiliado_tutor_2">0</span>  USD</span>
                  </div>

                </div>

              </div>        
              @endif




            </div>
        </div>        
    </div>
  </div>


</div>
<br />
<br />
</form>




@stop

@section('scripts')

  <script src="{{url('')}}/assets/tinymce/js/tinymce/tinymce.min.js"></script>
  <script src="{{url('')}}/assets/tinymce/js/tinymce/jquery.tinymce.min.js"></script> 


@php 
    if(!$curso->AprobacionAutomatica){
      $curso->AprobacionAutomatica="0";
    }
  @endphp
  
    <script type="text/javascript">
        var fees_empresa=10;

        @if($curso->PrecioCurso>0)

            $("#PrecioCurso").val({{$curso->PrecioCurso}});

        @endif
      
      var comisiones=[
      @foreach($comisiones as $comision)
        {
          "IdComision":"{{$comision->IdComision}}",
          "NombreComision":"{{$comision->NombreComision}}",
          "PorcentAfiliado":"{{$comision->PorcentAfiliado}}",
          "PorcentTutor":"{{$comision->PorcentTutor}}",
          "PorcentEmpresa":"{{$comision->PorcentEmpresa}}"
        },
      @endforeach
      ];

    var porcentaje_iva=19;

    $("#PrecioCurso").change(function(e){
      calcular_tabla();
    });

    $("#PrecioCurso").keyup(function(e){
      calcular_tabla();
    });
    

    $(document).on('keydown', 'input[pattern]', function(e){
    var input = $(this);
    var oldVal = input.val();
    var regex = new RegExp(input.attr('pattern'), 'g');

    setTimeout(function(){
        var newVal = input.val();
        if(!regex.test(newVal)){
          input.val(oldVal); 
        }
      }, 0);
    });


      $(function(){ 

        

        $("#AprobacionAutomatica").val("{{$curso->AprobacionAutomatica}}");
        $("#IdNivelCurso").val("{{$curso->IdNivelCurso}}");        
        calcular_tabla();

        $("#porcentaje_fees").html(fees_empresa);
        
      });


        
      var cant_total_char_tinymce=2000;

      tinymce.init({          
          height:"224",

          setup: function (ed) {
              ed.on('init', function(args) {
                 //$("#cargar-componentes").modal("hide");
                 var texto_componente=ed.getContent({format : 'text'});                  
                 texto_componente=texto_componente.trim();
                  var cant_actual=cant_total_char_tinymce-texto_componente.length;
                  $("#cant_caracteres_DescripcionCurso").html(cant_actual);
              });

              ed.on('keyup', function(e) {                 

                  var texto_componente=ed.getContent({format : 'text'});
                  texto_componente=texto_componente.trim();
                  var cant_actual=cant_total_char_tinymce-texto_componente.length;
                  $("#cant_caracteres_DescripcionCurso").html(cant_actual);
                  

              });

          },


        selector: ".html-paginas",

          
        fontsize_formats: '8pt 10pt 12pt 14pt 18pt 24pt 36pt 42pt 52pt',

        relative_urls : false,

        remove_script_host : true,
        extended_valid_elements : "ins[class|style|data-ad-client|data-ad-slot],a[id|class|name|href|target|title|onclick|rel|data-toggle|data-parent],script[async|type|src],iframe[src|style|width|height|scrolling|marginwidth|marginheight|frameborder|allowfullscreen|class],img[class|src|border=0|alt|title|hspace|vspace|width|height|align|onmouseover|onmouseout|name|style|id|onclic]",
          toolbar: " fontsizeselect | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | forecolor backcolor"
      });


     
      getFotoCurso = function($idcomponente) {
        $('#'+$idcomponente).attr('accept', '.jpg, .png');
        $('#'+$idcomponente).show();
        $('#'+$idcomponente).focus();
        $('#'+$idcomponente).click();
        $('#'+$idcomponente).hide();
      }


      // INFORMACIÓN BÁSICA

      $("#NombreCurso").focusout(function(){
        var slugBasicos=$("#NombreCurso").val();
        slugBasicos=slug(slugBasicos);
        
          $("#SlugCurso").val(""+slugBasicos+"-{{$curso->CodigoCurso}}");
        
      });

      $("#SlugCurso").focusout(function(){
        var slugBasicos=$("#SlugCurso").val();
        slugBasicos=slug(slugBasicos);
        
        //$("#SlugCurso").val(""+slugBasicos+"-{{$curso->CodigoCurso}}");
        
      });


      function slug(str) {
        str = str.replace(/^\s+|\s+$/g, ''); // trim
        str = str.toLowerCase();
      
        // remove accents, swap ñ for n, etc
        var from = "àáãäâèéëêìíïîòóöôùúüûñç·/_,:;";
        var to   = "aaaaaeeeeiiiioooouuuunc------";

        for (var i=0, l=from.length ; i<l ; i++) {
            str = str.replace(new RegExp(from.charAt(i), 'g'), to.charAt(i));
        }

        str = str.replace(/[^a-z0-9 -]/g, '') // remove invalid chars
            .replace(/\s+/g, '-') // collapse whitespace and replace by -
            .replace(/-+/g, '-'); // collapse dashes

        return str;
    }


      $("#form-editar-curso").submit(function(e){
        e.preventDefault();

        var PrecioCurso=""+$("#PrecioCurso").val();
        var DescuentoCurso=""+$("#DescuentoCurso").val();
        var PorcentajeAfiliados="";        

        var formData = new FormData(); 
             
        
        formData.append('PrecioCurso', PrecioCurso);
        formData.append('DescuentoCurso', 0);
        formData.append('PorcentajeAfiliados', PorcentajeAfiliados);
        
        @if(session('rol_solicitud')=="root")
        var AplicaGratisCurso ="";
        if($("#AplicaGratisCurso").is(":checked")){
          AplicaGratisCurso ="1";
        }else{
          AplicaGratisCurso ="0";
        }
        formData.append('AplicaGratisCurso',AplicaGratisCurso);
        @endif

       
        guardar_informacion(formData,"editarprecioscurso");

      });

      function guardar_informacion(campos,funcionlv){

        campos.append('CodigoCurso', "{{$curso->CodigoCurso}}");
        campos.append('_token', "{{ csrf_token() }}");        
        campos.append('token_curso', "{{ $token_curso }}");

        
        var request = $.ajax({
            url: "{{url('')}}/"+funcionlv,
            type: "POST",
            data: campos,
            processData: false,  // tell jQuery not to process the data
            contentType: false,  // tell jQuery not to set contentType
            cache:false
          });

          request.done(function(obj) { 
             if(obj.status=="ok"){            
                $("#responder_comentarios").modal("hide");
                mensaje_generico("Correcto",""+obj.mensaje,"1","Continuar...",function(){
                  location.reload();
                });

                return;
             }else{
                $("#responder_comentarios").modal("hide");
                mensaje_generico("Error !",""+obj.mensaje,"2","Continuar...",function(){});
                return;
             }
          });
           //respuesta si falla
          request.fail(function(jqXHR, textStatus) {
            alert( "Error de servidor  " + textStatus );
          });


      }



    


      //ENVÍO DE PRECIOS
      $("#btn_estado_revision").click(function(e){
        e.preventDefault();

        var formData = new FormData();
        guardar_informacion(formData,"cambiarestadorev");

      });


      $("#btn_vista_previa").click(function(){
        
      });


      var valor_subtotal_producto=0;
      function calcular_tabla(){
        var valor_info_producto=0;
        var porcentaje_descuento_producto=0;
        var valor_descuento_producto=0;
        var valor_iva_producto=0;
        var valor_total_producto=0;

        var PrecioCurso = $("#PrecioCurso").val();
        var DescuentoCurso = 0;
        valor_info_producto = parseFloat(PrecioCurso);
        
        //valor_descuento_producto=(valor_info_producto*(DescuentoCurso/100));
        valor_subtotal_producto=PrecioCurso-valor_descuento_producto;

        valor_iva_producto=0;

        //valor_total_producto=valor_subtotal_producto+valor_iva_producto;
        valor_total_producto=valor_subtotal_producto;


        $("#valor_info_producto").html(addCommas(valor_info_producto.toFixed(2)));
        $("#porcentaje_descuento_producto").html(DescuentoCurso)
        $("#valor_descuento_producto").html(addCommas(valor_descuento_producto.toFixed(2)));
        //$("#valor_iva_producto").html(addCommas(valor_iva_producto.toFixed(2)));
        $("#valor_subtotal_producto,#subtotal_docttus").html(addCommas(valor_subtotal_producto.toFixed(2)));

        
        
        $("#valor_total_producto").html(valor_total_producto.toFixed(2));

        calcular_comisiones();

      }

      $("#cantidad_producto").keyup(function(){
        calcular_comisiones();
      })

      function calcular_comisiones(){
        


        var obj_tutor_tutor=get_porcentaje_tutor(3);
        var obj_afiliado_tutor=get_porcentaje_tutor(2);
        var obj_docttus_tutor=get_porcentaje_tutor(1);
        
        var cantidad_producto=$("#cantidad_producto").val();

        var valor_final_subtotal=valor_subtotal_producto;
        var valor_fees=valor_subtotal_producto*(fees_empresa/100);        
        $("#fees_docttus").html(addCommas(valor_fees.toFixed(2)));

        var total_docttus=0;
        total_docttus=valor_subtotal_producto-valor_fees;
        $("#total_docttus").html(addCommas(total_docttus.toFixed(2)));
        

        
        var comision_tutor_tutor=(total_docttus*(porcentaje_tutor/100))*cantidad_producto;
        var comision_afiliado_tutor=(total_docttus*(porcentaje_afiliado/100))*cantidad_producto;
        var comision_afiliado_coproductor=(total_docttus*(porcentaje_co_productor/100))*cantidad_producto;
        var comision_plena_tutor=comision_tutor_tutor+comision_afiliado_tutor+comision_afiliado_coproductor;        
        $("#comision_tutor_tutor").html(addCommas(comision_plena_tutor.toFixed(2)));

        var comision_venta_afiliado_docttus=comision_tutor_tutor+comision_afiliado_coproductor;
        $("#comision_afiliado_tutor").html(addCommas(comision_venta_afiliado_docttus.toFixed(2)));


        
        var comision_plena_tutor_2=comision_tutor_tutor+comision_afiliado_tutor;
        $("#comision_tutor_tutor_2").html(addCommas(comision_plena_tutor_2.toFixed(2)));
        
        var comision_venta_afiliado_docttus_2=comision_tutor_tutor;
        $("#comision_afiliado_tutor_2").html(addCommas(comision_venta_afiliado_docttus_2.toFixed(2)));
        
      }

      var porcentaje_afiliado=70;
      var porcentaje_docttus=10;
      var porcentaje_tutor=15;
      var porcentaje_co_productor=5;

      function get_porcentaje_tutor(IdComision){
        for(var i=0;i<comisiones.length;i++){
          if(comisiones[i].IdComision==IdComision){
            return comisiones[i];
          }
        }
      }


      

    </script>
@stop