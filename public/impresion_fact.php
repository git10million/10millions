<?php

if (isset($_SERVER['HTTP_ORIGIN'])) {
    header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
    header('Access-Control-Allow-Credentials: true');
    header('Access-Control-Max-Age: 86400');    // cache for 1 day
}

// Access-Control headers are received during OPTIONS requests
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {

    if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS");         

    if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
        header("Access-Control-Allow-Headers:        {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");

    exit(0);
}


    ini_set('log_errors','Off');
    ini_set('display_errors','Off');
    ini_set('error_reporting', E_ALL );

    

    include("conexion_ext.php");

    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
    }


    header("Content-Type: application/json");
		
	$codigo_transaccion="".@$_REQUEST["codigo_transaccion"];

    //


    

    $sql="SELECT uc.*, c.NombreCurso, CONCAT_WS(' ',p.NombrePersona,p.ApellidosPersona) as NombrePersona,
            p.IdentificacionPersona,
            p.EmailPersona,       
            DATE_FORMAT(uc.FechaCompra, '%Y/%m/%d')as FechaCompraFormato
        FROM tbl_usuario_curso uc
        INNER JOIN tbl_usuario_persona up ON up.IdUsuarioPersona=uc.IdUsuarioPersona
        INNER JOIN tbl_usuario u ON u.IdUsuario=up.IdUsuario
        INNER JOIN tbl_persona p ON p.IdPersona=up.IdPersona
        INNER JOIN tbl_curso c ON c.IdCurso=uc.IdCurso
        WHERE uc.IdEstado=1 and uc.CodigoTransaccion='{$codigo_transaccion}'
        LIMIT 1";

    $result = $conn->query($sql);

    if(!$result->num_rows){
        $arraResult = array("status"=>'error',"mensaje"=>"Error al generar el pdf 1");
        print_r(json_encode($arraResult));
        exit;
    }

    $IdUsuarioCurso="";

    while($row = $result->fetch_array()){
        $codigo_factura="".$row["CodigoFactura"];
        $IdUsuarioCurso="".$row["IdUsuarioCurso"];
        
        $fecha_factura="".$row["FechaCompraFormato"];
        $fecha_emision="".$row["FechaCompraFormato"];
        $denominacion_compra="".utf8_encode($row["NombreCurso"]);
        $datos_clientes=utf8_encode($row["NombrePersona"])."<br/>CC. ".$row["IdentificacionPersona"]."<br/>EMAIL. ".$row["EmailPersona"];

        $id_item="1";
        $cant_item="1";

        $PrecioCurso=$row["PrecioCurso"];
        $ValorImpuesto=$row["ValorImpuesto"];
        $total_curso=$PrecioCurso+$ValorImpuesto;

        $precio_producto="USD<br/>$".$PrecioCurso;
        $precio_iva="USD $".$ValorImpuesto;

        $precio_total="USD<br/>$".$total_curso;
        
    }


    

 

   
   

	

	$content='
	<page backcolor="#FEFEFE" backimg="FacturaDocttus.jpg"  backimgx="5" backimgy="1mm"  backbottom="0" style="font-size: 10pt">
	    <bookmark title="Recibo" level="0" ></bookmark>
		
		<div style="font-size:15px; position:absolute; top:110px; right:35px; text-align:right;">'.$codigo_factura.'</div>
        <div style="font-size:15px; position:absolute; top:138px; right:35px; text-align:right;">'.$fecha_factura.'</div>
        <div style="font-size:15px; position:absolute; top:165px; right:35px; text-align:right;">'.$fecha_emision.'</div>
        <div style="font-size:15px; position:absolute; top:195px; right:35px; text-align:right;">'.$codigo_transaccion.'</div>

        <div style="font-size:15px; position:absolute; top:223px; right:35px; height:60px; text-align:right; width:230px;">'.$denominacion_compra.'</div>
		
        <div style="font-size:15px; position:absolute; top:343px; left:75px; height:60px; text-align:left; width:430px;">'.$datos_clientes.'</div>

        <div style="font-size:15px; position:absolute; top:468px; left:21px; height:30px; text-align:center; width:20px;">'.$id_item.'</div>
        <div style="font-size:15px; position:absolute; top:468px; left:45px; height:30px; text-align:left; width:320px; ">'.$denominacion_compra.'</div>
        <div style="font-size:15px; position:absolute; top:468px; left:420px; height:30px; text-align:center; width:20px; ">'.$cant_item.'</div>

        <div style="font-size:15px; position:absolute; top:468px; left:488px; height:30px; text-align:right; width:145px; ">'.$precio_producto.'</div>
        <div style="font-size:15px; position:absolute; top:468px; left:642px; height:30px; text-align:right; width:130px; ">'.$precio_producto.'</div>

        <div style="font-size:15px; position:absolute; top:553px; left:642px; height:30px; text-align:right; width:130px; ">'.$precio_producto.'</div>

        <div style="font-size:15px; position:absolute; top:615px; left:642px; height:30px; text-align:right; width:130px; ">'.$precio_iva.'</div>
        <div style="font-size:15px; position:absolute; top:635px; left:642px; height:30px; text-align:right; width:130px; ">'.$precio_total.'</div>

		<nobreak>
		</nobreak>
	</page>';





    $fecha=date('YmdHis');

   $nombre_flyer='assets/facturas/orden_'.$codigo_transaccion.'.pdf';


    if(!file_exists($nombre_flyer)){    
        require_once('html2pdf/html2pdf.class.php');
    
        try
        {
            $html2pdf = new HTML2PDF('P', 'letter', 'es');
            $html2pdf->pdf->SetDisplayMode('fullpage');
            $html2pdf->writeHTML($content, isset($_GET['vuehtml']));		 
            $html2pdf->Output($nombre_flyer,'F');		
            //header("Location:".'assets/facturas/factura_'.$factura.'.pdf');

            


        }
        catch(HTML2PDF_exception $e) {
            $arraResult = array("status"=>'error',"mensaje"=>"Error al generar el pdf");
            print_r(json_encode($arraResult));
            exit;
        }        
    }

    $arraResult = array("status"=>'ok',"mensaje"=>"Impresión Generada Correctamente","file"=>$nombre_flyer);
    print_r(json_encode($arraResult));


	//unlink($nombre_recibo);

?>