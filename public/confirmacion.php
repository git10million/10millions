<?php 

    include("conexion_ext.php");
    // Create connection

    
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
    }
       
    /*En esta página se reciben las variables enviadas desde ePayco hacia el servidor.
               Antes de realizar cualquier movimiento en base de datos se deben comprobar algunos valores
               Es muy importante comprobar la firma enviada desde ePayco
               Ingresar  el valor de p_cust_id_cliente lo encuentras en la configuración de tu cuenta ePayco
               Ingresar  el valor de p_key lo encuentras en la configuración de tu cuenta ePayco

                http://docttus_dev.test/confirmacion.php?x_id_invoice=71521211233011&x_ref_payco=38034524&x_transaction_id=38034524&x_amount=23.75&x_currency_code=USD&x_signature=f3f8c4ea778ed10e0b18ea693402a359e037ecd57e60fbf2583785bf7ff11bce&x_cod_response=1

               */

   

   $p_cust_id_cliente='72305';
   $p_key='eb6b964eee7f7ce4957276a16cc0635f5d16e228';

   $x_ref_payco=$_REQUEST['x_ref_payco'];
   $x_transaction_id=$_REQUEST['x_transaction_id'];
   $x_amount=$_REQUEST['x_amount'];
   $x_currency_code=$_REQUEST['x_currency_code'];
   $x_signature=$_REQUEST['x_signature'];
   $x_id_invoice=$_REQUEST['x_id_invoice'];

   $signature=hash('sha256',
           $p_cust_id_cliente.'^'
           .$p_key.'^'
           .$x_ref_payco.'^'
           .$x_transaction_id.'^'
           .$x_amount.'^'
           .$x_currency_code
       );

   $x_response=@$_REQUEST['x_response'];
   $x_motivo=@$_REQUEST['x_response_reason_text'];   
   $x_autorizacion=@$_REQUEST['x_approval_code'];

   //Validamos la firma
   if($x_signature==$signature){
   /*Si la firma esta bien podemos verificar los estado de la transacción*/
   $x_cod_response=$_REQUEST['x_cod_response'];
   $id_estado="3";
   switch ((int)$x_cod_response) {
        case 1:
            # code transacción aceptada			
            $id_estado="1";
            echo("Cod Transaccion: $x_cod_response");
            break;
        case 2:
            # code transacción rechazada            
            $id_estado="6";
            echo("Cod Transaccion: $x_cod_response");
            break;
        case 3:
            # code transacción pendiente
            $id_estado="7";
            echo("Cod Transaccion: $x_cod_response");
            break;
        case 4:
            # code transacción fallida
            $id_estado="8";
            echo("Cod Transaccion: $x_cod_response");
            break;                 
       
   }


    



   $sql="UPDATE tbl_usuario_curso SET IdEstado={$id_estado}, 
            IdEstadoTransaccion={$x_cod_response}, 
            ReferenciaPago='{$x_ref_payco}',						
            TransaccionPago='{$x_transaction_id}',            
            FechaCompra=now()
            WHERE CodigoTransaccion='{$x_id_invoice}'";
    $result = $conn->query($sql);

    
    

   }else{
    echo "Firma no valida";
   }


   $conn->close();

?>