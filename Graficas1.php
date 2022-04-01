 <?php
    session_start();
    if (!isset($_SESSION['nivel'])) {
        header("Location: PaginaIniciodeSesion.php");
        exit();
    }

    ?>
 <!DOCTYPE html>
 <html>

 <head>
     <title>Grafica</title>
     <link rel="stylesheet" href="CSSweb/estilo.css">
     <script src="Javascriptsweb/jquery.min.js"></script>
     <script src="Javascriptsweb/Chart.min.js"></script>
     <script src="Javascriptsweb/jquery-ui.min.js"></script>
     <script src='Javascriptsweb/plotly-latest.min.js'></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.3/html2pdf.bundle.min.js" integrity="sha512-YcsIPGdhPK4P/uRW6/sruonlYj+Q7UHWeKfTAkBW+g83NKM+jMJFJ4iAPfSnVp7BKD4dKMHmVSvICUbE/V1sSw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

     <link rel="stylesheet" href="CSSweb/jquery-ui.css">
 </head>

 <body>
     <header class="jumbotron jumbotronCabecera">
         <?php include('CabeceraIniciado.php'); ?>
     </header>
     <hr>
     <nav>
         <ul>
             <?php include('BarradeNavegacion.php'); ?>
         </ul>
     </nav>
     <div>
         <h2 align="center">Busqueda por Fecha</h2>
         <h3 align="center">Grafica</h3>
         <div>
             <input type="text" name="from_date" id="desde" placeholder="Desde" />
         </div>
         <div>
             <input type="text" name="to_date" id="hasta" placeholder="Hasta" />
         </div>
         <div>
             <input type="button" name="filtro" id="filtro" value="Filtrar" />
         </div>
     </div>
     <div id='contenido'>
         <div class="divTabla">
             <div class="divTablaCuerpo">
                 <div class="divTablaFila">
                     <div class="divTablaCelda" id="Graficalineal2"></div>
                     <div class="divTablaCelda"><canvas id="Graficalineal3" style="divtamano "></canvas></div>
                 </div>
             </div>
         </div>
         <div id="Graficalineal1"></div>

         <div style="divtamano2 ">

             <canvas id="Graficalineal5" style="max-width:100%; "></canvas>
         </div>
     </div>
     <div>
         <input type="button" name="aPDF" id="aPDF" value="A PDF" />
     </div>
     <div>
         <input type="button" name="aEXCEL" id="aEXCEL" value="A EXCEL" />
     </div>
     <div>
         <footer class="jumbotron jumbotronPiedePagina">
             <?php include('Pie.php'); ?>
         </footer>
     </div>
 </body>

 </html>



 <script>
     $(document).ready(function() {
         $.datepicker.setDefaults({
             dateFormat: 'yy-mm-dd',
             changeMonth: true,
             changeYear: true
         });
         $(function() {
             $("#desde").datepicker();
             $("#hasta").datepicker();
         });
         $('#filtro').click(function() {
             var desdefecha = $('#desde').val();
             var hastafecha = $('#hasta').val();
             if (desdefecha != '' && hastafecha != '') {
                 $.ajax({
                     url: "ObtenciondeDatosMultiples.php",
                     method: "POST",
                     data: {
                         desdefecha: desdefecha,
                         hastafecha: hastafecha
                     },
                     success: function(data) {
                         var datos = JSON.parse(data);
                         var tiempo = [];
                         var valor1 = [];
                         var valor2 = [];
                         var valor3 = [];
                         var valor4 = [];
                         for (var i in datos) {
                             tiempo.push(datos[i].tiempo);
                             valor1.push(datos[i].valor1);
                             valor2.push(datos[i].valor2);
                             valor3.push(datos[i].valor3);
                             valor4.push(datos[i].valor4);
                         }
                         var DATOS1 = {
                             x: tiempo,
                             y: valor1,
                             name: 'Temperatura',
                             type: 'scatter',
                             line: {
                                 color: 'rgb(219, 213, 64)'
                             }
                         };
                         var DATOS2 = {
                             x: tiempo,
                             y: valor3,
                             name: 'Tensión',
                             line: {
                                 shape: 'spline'
                             },
                             yaxis: 'y2',
                             type: 'scatter',
                             line: {
                                 color: 'rgb(0, 137, 26)'
                             }
                         };
                         var DATOS3 = {
                             x: tiempo,
                             y: valor2,
                             name: 'Frecuencia',
                             line: {
                                 shape: 'spline'
                             },
                             yaxis: 'y3',
                             type: 'scatter',
                             line: {
                                 color: 'rgb(9, 41, 177)'
                             }
                         };
                         var DATOS6 = {
                             x: tiempo,
                             y: valor2,
                             name: 'Frecuencia',
                             line: {
                                 shape: 'spline'
                             },
                             type: 'scatter',
                             line: {
                                 color: 'rgb(9, 41, 177)'
                             }
                         };
                         var DATOS4 = {
                             x: tiempo,
                             y: valor4,
                             name: 'V. Promedio de Fase',
                             line: {
                                 shape: 'spline'
                             },
                             yaxis: 'y4',
                             type: 'scatter',
                             line: {
                                 color: 'rgb(173, 1, 1)'
                             }
                         };
                         var data = [DATOS1, DATOS2, DATOS3, DATOS4];
                         var layout = {
                             title: 'Temperatura - Tension',

                             xaxis: {
                                 domain: [0.2, 0.7]
                             },
                             yaxis: {
                                 title: 'Temperatura',
                                 range: [0, 30]
                             },
                             yaxis2: {
                                 title: 'Tension',
                                 titlefont: {
                                     color: 'rgb(148, 103, 189)'
                                 },
                                 tickfont: {
                                     color: 'rgb(148, 103, 189)'
                                 },
                                 overlaying: 'y',
                                 side: 'left',
                                 anchor: 'free',
                                 position: .95,
                                 range: [124, 133]
                             },
                             yaxis3: {
                                 title: 'Frecuencia',
                                 titlefont: {
                                     color: 'rgb(73, 72, 74)'
                                 },
                                 tickfont: {
                                     color: 'rgb(11, 11, 11)'
                                 },
                                 overlaying: 'y',
                                 side: 'left',
                                 anchor: 'free',
                                 position: 0.1,
                                 range: [59.5, 60.5]
                             },
                             yaxis4: {
                                 title: 'Voltaje Promedio de Fase',
                                 titlefont: {
                                     color: 'rgb(73, 72, 74)'
                                 },
                                 tickfont: {
                                     color: 'rgb(11, 11, 11)'
                                 },
                                 overlaying: 'y',
                                 side: 'left',
                                 anchor: 'free',
                                 position: 0.85,
                                 range: [70, 90]
                             }
                         };
                         var layout2 = {
                             title: 'Frecuencia',
                             height: '400',
                             xaxis: {
                                 domain: [0.2, 0.8]
                             },
                             yaxis: {
                                 title: 'Hz',
                                 range: [59.5, 60.5]
                             }
                         };
                         Plotly.newPlot('Graficalineal1', data, layout);
                         var dg2 = [DATOS6];

                         Plotly.newPlot('Graficalineal2', dg2, layout2);
                     },
                 });
             } else {
                 alert("Por favor selecciona los datos necesarios");
             }
         });


         $('#aPDF').click(() => {
             let reporte = document.getElementById('contenido');
             html2pdf().from(reporte).save();
         });

         $('#aEXCEL').click(()=>{
             
         });


     });
 </script>