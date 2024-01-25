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


    

    $sql="SELECT eu.*, CONCAT_WS(' ',p1.NombrePersona, p1.ApellidosPersona) AS NombreEstudiante,
    CONCAT_WS(' ',p2.NombrePersona, p2.ApellidosPersona) AS NombreTutor,
    c.NombreCurso,
    date_format(eu.FechaModificacion,'%Y-%m-%d') as FechaEvaluacion
        FROM tbl_evaluacion_usuario eu
        INNER JOIN tbl_usuario u1 ON u1.IdUsuario = eu.IdUsuario
        INNER JOIN tbl_usuario_persona up1 ON up1.IdUsuario=u1.IdUsuario
        INNER JOIN tbl_persona p1 ON p1.IdPersona = up1.IdPersona
        INNER JOIN tbl_evaluacion e ON e.IdEvaluacion=eu.IdEvaluacion
        INNER JOIN tbl_curso c ON c.IdCurso = e.IdCurso
        INNER JOIN tbl_usuario_persona up2 ON up2.IdUsuarioPersona=c.IdUsuarioTutor
        INNER JOIN tbl_persona p2 ON p2.IdPersona =  up2.IdPersona
        WHERE eu.IdEstado=1 and eu.CodigoEvaluacion='{$codigo_transaccion}' limit 1";

    $result = $conn->query($sql);

    if(!$result->num_rows){
        $arraResult = array("status"=>'error',"mensaje"=>"Error al generar el pdf 1");
        print_r(json_encode($arraResult));
        exit;
    }

    $IdUsuarioCurso="";

    $NombreCurso="";
    $FechaCurso="";
    $NombreTutor="";
    while($row = $result->fetch_array()){
        $NombreCurso="".mb_strtoupper(utf8_encode($row["NombreCurso"]), 'UTF-8');
        $NombreTutor="".mb_strtoupper(utf8_encode($row["NombreTutor"]), 'UTF-8');
        $NombreTutorFirma="".ucwords(utf8_encode($row["NombreTutor"]), 'UTF-8');

        $FechaCurso="".utf8_encode($row["FechaEvaluacion"]);
    }


    

 

   
   

	

	$content='
	<page backcolor="#FEFEFE" backimg="certificado.jpg"  backimgx="0" backimgy="0mm"  backbottom="0" style="font-size: 10pt">
	    <bookmark title="Recibo" level="0" ></bookmark>

            <div style="position:absolute; top:350px; text-align:center; width:90%; color:#AAAAAA; left:35px;">
                <h2 style="font-size:35px;">Julio 22 - 2021</h2>
                <h2 style="font-size:20px; letter-spacing: 12px; margin-top:35px;">
                    ESTE CERTIFICADO GARANTIZA QUE:
                </h2>

                <h1 style="font-size:60px; letter-spacing: 12px; margin-top:15px; color:#CC8223;">
                    Luis German Gíl
                </h1>


                <p style="font-size:18px;">
                    HA COMPLETADO CON ÉXITO EL CURSO<br/>
                    <strong>'.$NombreCurso.'</strong> A FECHA '.$FechaCurso.', HABIENDO SIDO IMPARTIDO POR '.$NombreTutor.' EN DOCTTUS.COM.<br/>
                    EL CERTIFICADO INDICA QUE SE HA COMPLETADO LA TOTALIDAD DEL CURSO, SEGÚN LO VALIDADO POR EL ESTUDIANTE. LA DURACIÓN DEL CURSO EN EL MOMENTO DE FINALIZACIÓN MÁS RECIENTE
                </p>

                <p style="font-size:18px; color:#CC8223;">
                    Número del Certificado: <strong>'.$codigo_transaccion.'</strong><br/>
                    URL del Certificado: <strong>docttus.com/cert/'.$codigo_transaccion.'</strong><br/>
                </p>

            </div>

            <div style="position:absolute; width:150px; bottom:35px; height:175px;  right:285px; ">
                <img src="assets/images/firma-german.png" style="height:60px;">
                <p style="text-align:left; color:#CC8223; margin-top:15px; font-size:20px;">
                Otorgado Por: <br />
                Luis German Gíl <br />
                CEO Docttus
                </p>
            </div>
            
            <div style="position:absolute; width:195px; bottom:35px; height:175px;  right:25px; ">
                <img src="assets/images/firma-german.png" style="height:60px;">
                <p style="text-align:left; color:#CC8223; margin-top:15px; font-size:20px;">
                Otorgado Por: <br />
                '.$NombreTutorFirma.'<br />
                Tutor Docttus
                </p>

            </div>

            

		<nobreak>
		</nobreak>
	</page>';





    $fecha=date('YmdHis');

/* Esto es para eliminar*/
   $nombre_flyer='assets/certificado/certificado_'.$codigo_transaccion.'.pdf';
   if(file_exists($nombre_flyer)){
        //unlink($nombre_flyer);//eliminar   
   }
   /* Esto es para eliminar*/

    if(!file_exists($nombre_flyer)){    
        require_once('html2pdf/html2pdf.class.php');
    
        try
        {
            $html2pdf = new HTML2PDF('P', 'A4', 'es');
            $html2pdf->pdf->SetDisplayMode('fullpage');
            $html2pdf->writeHTML($content, isset($_GET['vuehtml']));		 
            $html2pdf->Output($nombre_flyer,'F');		
            //header("Location:".$nombre_flyer);

            


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
