<?php
session_start();
//$servidor = "localhost:3306";
//$usuario = "root";
//$contraseña = "";
$servidor = "localhost:3306";
$usuario = "root";
$contraseña = "";
$BasedeDatos= "grdxf";

$conn = new mysqli($servidor, $usuario, $contraseña, $BasedeDatos);
if ($conn->connect_error) {
  die("Fallo Conexion: " . $conn->connect_error);
}
if ($_SESSION['GRD']==1)
    { 
    $comandosql = "SELECT an1,an2,an3,an4,an5,an6,date FROM reports where grd_id=".$_SESSION['GRD'].";";
    $resultado = $conn->query($comandosql);

    if ($resultado->num_rows > 0) {
        $fila = $resultado->fetch_assoc();
        $t=sizeof($fila)-1;
        $T=1;
        $TT=0;
        $y=array("Temperatura °C", "Frecuencia Hz", "Tension V", "Factor de Potencia Total","Voltaje Fase 2 V","Voltaje Promedio de fase V");

        echo ' <table   class="tablaA"><caption>Ultimos Datos Registrados ' . $fila['date'] . ' </caption><tr bgcolor="#cebba6"><th>Nombre Medida</th><th>Dato medicion</th></tr>';
        while($t>$T-1) {
            $bg_color = ($T % 2==0) ? "#dbb5ab" : "#f8d8d8";
                    if ($T == 1){
                          $nuevo=$fila['an'.$T]*(0.0625)-75;
                      }
                    elseif ($T == 2){
                          $nuevo=$fila['an'.$T]/100;
                      }
                    elseif ($T == 3){
                          $nuevo=$fila['an'.$T]/1000;
                      }
                    elseif ($T == 5){
                          $nuevo=$fila['an'.$T]/100;
                      }
                    elseif ($T == 6){
                          $nuevo=$fila['an'.$T]/100;
                      }
                    elseif ($T == 7){
                          $nuevo=$fila['an'.$T]/100;
                      }
            echo '<tr bgcolor="'.$bg_color.'"><td>' . $y[$TT] . '</td><td>' . $nuevo . '</td></tr>'; 
            $T=$T+1;
            $TT=$TT+1;
        }
        echo '</table>';
    }
    else {
        echo "0 resultados";
    }
    $conn->close();
    }
if ($_SESSION['GRD']==2)
    { 
    $comandosql = "SELECT an1,an2,an3,an4,an5,an6,an7,date FROM reports where grd_id=".$_SESSION['GRD'].";";
    $resultado = $conn->query($comandosql);
    if ($resultado->num_rows > 0) {
        $fila = $resultado->fetch_assoc();
        $t=sizeof($fila)-1;
        $T=1;
        $TT=0;
        $y=array("Temperatura °C", "Frecuencia Hz", "Tension V", "Factor de Potencia Total","Voltaje Fase 2 V","Voltaje Promedio de fase V","Voltaje Promedio de Linea V");

        echo ' <table   class="tablaA"><caption>Ultimos Datos Registrados ' . $fila['date'] . ' </caption><tr bgcolor="#cebba6"><th>Nombre Medida</th><th>Dato medicion</th></tr>';
        while($t>$T-1) {
            $bg_color = ($T % 2==0) ? "#dbb5ab" : "#f8d8d8";
                    if ($T == 1){
                          $nuevo=$fila['an'.$T]*(0.0625)-75;
                      }
                    elseif ($T == 2){
                          $nuevo=$fila['an'.$T]/100;
                      }
                    elseif ($T == 3){
                          $nuevo=$fila['an'.$T]/1000;
                      }
                    elseif ($T == 5){
                          $nuevo=$fila['an'.$T]/100;
                      }
                    elseif ($T == 6){
                          $nuevo=$fila['an'.$T]/100;
                      }
                    elseif ($T == 7){
                          $nuevo=$fila['an'.$T]/100;
                      }
                     else{
                         $nuevo=$fila['an'.$T];
                     }
            echo '<tr bgcolor="'.$bg_color.'"><td>' . $y[$TT] . '</td><td>' . $nuevo . '</td></tr>'; 
            $T=$T+1;
            $TT=$TT+1;
        }
        echo '</table>';
    }
    else {
        echo "0 resultados";
    }
    $conn->close();
    }
    ?>
    
    


<!--
         $A=0;
         while($fila = mysqli_fetch_array($resultado))  
         {  
             $bg_color = ($A % 2==0) ? "#dbb5ab" : "#f8d8d8";
             $salida.='<tr bgcolor="'.$bg_color.'">';
            while($t>$T){
                 $salida.= '<td>' . $fila[$y[$T]]. '</td>';
                 $T=$T+1;
             }
             $T=0;
             $salida.= '</tr>';
//             while($t>$T){
//                 $bg_color = ($T == 2) ? "#dbb5ab" : (($T == 3) ? "#cebba6": (($T == 4) ? "#f6e8c6": ( ($T == 5) ? "#f6dbc6":"#f8d8d8" )));
//                 $salida.= '<td bgcolor="'.$bg_color.'">' . $fila[$y[$T]]. '</td>';
//                 $T=$T+1;
//             }
//             $T=0;
//             $salida.= '</tr>';
         $A=$A+1;
         }-->
