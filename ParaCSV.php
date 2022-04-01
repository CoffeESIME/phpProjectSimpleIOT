<?php header('Content-type: application/csv');
// Set the file name option to a filename of your choice.
header('Content-Disposition: attachment; filename=myCSV.csv');
// Set the encoding
header("Content-Transfer-Encoding: UTF-8");

$f = fopen('php://output', 'a'); // Configure fopen to write to the output buffer
     $conexion = mysqli_connect("localhost:3307", "root", "12Telemetic12", "grdxf");
     $seleccion =  "SELECT timestamp, sum(CASE WHEN address = 1 THEN value END) 'Corriente mA', sum(CASE WHEN address = 2 THEN value END) 'Frecuencia Hz', sum(CASE WHEN address = 3 THEN value END) 'Tension V', sum(CASE WHEN address = 4 THEN value END) 'Factor de Potencia Total', sum(CASE WHEN address = 5 THEN value END) 'Voltaje Fase 2', sum(CASE WHEN address = 6 THEN value END) 'Voltaje promedio de fase', sum(CASE WHEN address = 7 THEN value END) 'Voltaje Promedio de Linea' FROM historical WHERE grd_id=1 AND register_type =  11 AND (timestamp>= '2020-12-17' AND timestamp<= ' 2020-12-18' ) GROUP BY timestamp";
     $resultado= mysqli_query($conexion, $seleccion);  
     $fila = $resultado->fetch_assoc();
     if(mysqli_num_rows($resultado) > 0)  
     {  
         while($fila = mysqli_fetch_array($resultado))  
         {  
             fputcsv($f, $fila);
         }

     }  
// Write to the csv
// Close the file
fclose($f);
?>

