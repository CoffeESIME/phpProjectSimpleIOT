<?php
session_start();
if(isset($_POST["desdefecha"], $_POST["hastafecha"]))  
{ 
    require("configuracion.php");
    $get_data = $conn->prepare("SELECT timestamp, sum(CASE WHEN address = 1 THEN value END) 'CorrientemA', sum(CASE WHEN address = 2 THEN value END) 'FrecuenciaHz', sum(CASE WHEN address = 3 THEN value END) 'TensionV', sum(CASE WHEN address = 4 THEN value END) 'FactordePotenciaTotal', sum(CASE WHEN address = 5 THEN value END) 'VoltajeFase2', sum(CASE WHEN address = 6 THEN value END) 'VoltajePromediodeFase', sum(CASE WHEN address = 7 THEN value END) 'VoltajePromLin' FROM historical WHERE grd_id=".$_SESSION['GRD']." AND register_type = 11 AND (timestamp>= '".$_POST["desdefecha"]. "' AND timestamp<= '".$_POST["hastafecha"]." ' ) GROUP BY timestamp  
    ");
    $get_data->execute();
    if($get_data->rowCount()>0){
         $result_array[] = ['tiempo'=>"Tiempo", 'valor1'=>"Temperatura",'valor2'=>"Frecuencia",'valor3'=>"Tensión",'valor4'=>"Tension Promedio de Fase"];
        while($value = $get_data->fetch(PDO::FETCH_OBJ)){
            $tiempo = $value->timestamp;
            $valor1 = $value->CorrientemA;
            $valor2 = $value->FrecuenciaHz;
            $valor3 = $value->TensionV;
            $valor4 = $value->VoltajePromediodeFase;
            $result_array[] = ['tiempo'=>$tiempo, 'valor1'=>$valor1*(0.0625)-75,'valor2'=>$valor2/100,'valor3'=>$valor3/1000,'valor4'=>$valor4/100];
        }
        echo json_encode($result_array);
        die();
    }
    else{
        echo "NADA";
    }
}
?> 