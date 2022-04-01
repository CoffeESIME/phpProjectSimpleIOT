<?php
session_start();
 if(isset($_POST["desdefecha"], $_POST["hastafecha"]))  
 {  
    $conexion = mysqli_connect("localhost:3306", "root", "", "grdxf"
);
    //  $conexion = mysqli_connect("localhost:3307", "root", "12Telemetic12", "grdxf");
     $salida = ''; 
     
     if ($_SESSION['GRD']==1)
    { 
     $seleccion =  "SELECT timestamp, sum(CASE WHEN address = 1 THEN value END) 'Temperatura °C', sum(CASE WHEN address = 2 THEN value END) 'Frecuencia Hz', sum(CASE WHEN address = 3 THEN value END) 'Tension V', sum(CASE WHEN address = 4 THEN value END) 'Factor de Potencia Total', sum(CASE WHEN address = 5 THEN value END) 'Voltaje Fase 2', sum(CASE WHEN address = 6 THEN value END) 'Voltaje promedio de fase', sum(CASE WHEN address = 7 THEN value END) 'Voltaje Promedio de Linea' FROM historical WHERE grd_id=".$_SESSION['GRD']."  AND register_type =  11 AND (timestamp>= '".$_POST["desdefecha"]. "' AND timestamp<= '".$_POST["hastafecha"]." ' ) GROUP BY timestamp";
     $resultado= mysqli_query($conexion, $seleccion);  
     $fila1 = $resultado->fetch_assoc();
     if($fila1!=null){
         $t=sizeof($fila1);
         $T=1;
         $y=array_keys($fila1);
         $salida .= '<table border="0px"  class="tablaA" ><caption><h3>Tabla de Datos</h3> </caption><tr  bgcolor="#cebba6">';
         $salida.= '<th>Fecha y hora de registro</th>';
     while($t>$T){
         $salida.= '<th>'. $y[$T]. '</th>';
         $T=$T+1;
     }
     }
     $T=0;
     $salida.='</tr>';
     if(mysqli_num_rows($resultado) > 0)  
     {  
         $A=0;
         while($fila = mysqli_fetch_array($resultado))  
         {  
             $bg_color = ($A % 2==0) ? "#dbb5ab" : "#f8d8d8";
             $salida.='<tr bgcolor="'.$bg_color.'">';
             while($t>$T){
                if ($T == 1){
                      $nuevo=$fila[$y[$T]]*(0.0625)-75;
                  }
                elseif ($T == 2){
                      $nuevo=$fila[$y[$T]]/100;
                  }
                elseif ($T == 3){
                      $nuevo=$fila[$y[$T]]/1000;
                  }
                elseif ($T == 5){
                      $nuevo=$fila[$y[$T]]/100;
                  }
                elseif ($T == 6){
                      $nuevo=$fila[$y[$T]]/100;
                  }
                elseif ($T == 7){
                      $nuevo=$fila[$y[$T]]/100;
                  }
                 else{
                     $nuevo=$fila[$y[$T]];
                 }
                 $salida.= '<td>' . $nuevo. '</td>';
                 $T=$T+1;
             }
             $T=0;
             $salida.= '</tr>';
             $A=$A+1;
         }

     }  
     else  
     {  
         $salida .= '<tr>  
         <td>No se encontraron resultados</td> 
         </tr>  ';  
     }  
     $salida .= '</table>';  
     echo $salida;
 }  
    if ($_SESSION['GRD']==2)
    { 
     $seleccion =  "SELECT timestamp, sum(CASE WHEN address = 1 THEN value END) 'Temperatura °C', sum(CASE WHEN address = 2 THEN value END) 'Frecuencia Hz', sum(CASE WHEN address = 3 THEN value END) 'Tension V', sum(CASE WHEN address = 4 THEN value END) 'Factor de Potencia Total', sum(CASE WHEN address = 5 THEN value END) 'Voltaje Fase 2', sum(CASE WHEN address = 6 THEN value END) 'Voltaje promedio de fase' FROM historical WHERE grd_id=".$_SESSION['GRD']."  AND register_type =  11 AND (timestamp>= '".$_POST["desdefecha"]. "' AND timestamp<= '".$_POST["hastafecha"]." ' ) GROUP BY timestamp";
     $resultado= mysqli_query($conexion, $seleccion);  
     $fila1 = $resultado->fetch_assoc();
     if($fila1!=null){
         $t=sizeof($fila1);
         $T=1;
         $y=array_keys($fila1);
         $salida .= '<table border="0px"  class="tablaA" ><caption><h3>Tabla de Datos</h3> </caption><tr  bgcolor="#cebba6">';
         $salida.= '<th>Fecha y hora de registro</th>';
     while($t>$T){
         $salida.= '<th>'. $y[$T]. '</th>';
         $T=$T+1;
     }
     }
     $T=0;
     $salida.='</tr>';
     if(mysqli_num_rows($resultado) > 0)  
     {  
         $A=0;
         while($fila = mysqli_fetch_array($resultado))  
         {  
             $bg_color = ($A % 2==0) ? "#dbb5ab" : "#f8d8d8";
             $salida.='<tr bgcolor="'.$bg_color.'">';
             while($t>$T){
                if ($T == 1){
                      $nuevo=$fila[$y[$T]]*(0.0625)-75;
                  }
                elseif ($T == 2){
                      $nuevo=$fila[$y[$T]]/100;
                  }
                elseif ($T == 3){
                      $nuevo=$fila[$y[$T]]/1000;
                  }
                elseif ($T == 5){
                      $nuevo=$fila[$y[$T]]/100;
                  }
                elseif ($T == 6){
                      $nuevo=$fila[$y[$T]]/100;
                  }
                elseif ($T == 7){
                      $nuevo=$fila[$y[$T]]/100;
                  }
                 else{
                     $nuevo=$fila[$y[$T]];
                 }
                 $salida.= '<td>' . $nuevo. '</td>';
                 $T=$T+1;
             }
             $T=0;
             $salida.= '</tr>';
             $A=$A+1;
         }

     }  
     else  
     {  
         $salida .= '<tr>  
         <td>No se encontraron resultados</td> 
         </tr>  ';  
     }  
     $salida .= '</table>';  
     echo $salida;
 }  
 }
 ?>
