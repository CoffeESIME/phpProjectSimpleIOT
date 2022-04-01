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
         <div class="divTabla">
             <div class="divTablaCuerpo">
                 <div class="divTablaFila">
                     <div class="divTablaCelda" id="Graficalineal2"></div>
                     <div class="divTablaCelda"></div>
                 </div>
             </div>
         </div>
         <canvas id="Graficalineal3" style="divtamano "></canvas>
         <div>

         </div>
         <div>
             <input type="button" name="butpdf" id="butpdf" value="A PDF" />
         </div>
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
                         var datosParaGrafica2 = {
                             labels: tiempo,
                             datasets: [{
                                 label: 'Frecuencia HZ:',
                                 backgroundColor: 'rgba(30, 34, 32, 0.5)',
                                 borderColor: 'rgba(232, 230, 230, 0.75)',
                                 data: valor2,
                                 yAxisID: "A",
                             }]
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
                         var dg2 = [DATOS6];

                         Plotly.newPlot('Graficalineal2', dg2, layout2);


                         var datosParaGrafica3 = {
                             labels: tiempo,
                             datasets: [{
                                 label: 'Temperatura °C:',
                                 backgroundColor: 'rgba(17, 149, 93, 0.5)',
                                 borderColor: 'rgba(232, 230, 230, 0.75)',
                                 data: valor1
                             }]
                         };
                         var line_canvas3 = $("#Graficalineal3");
                         var lineGraph = new Chart(line_canvas3, {
                             type: 'line',
                             data: datosParaGrafica3
                         });
                     }
                 });
             } else {
                 alert("Por favor selecciona los datos necesarios");
             }
         });

         $('#butpdf').click(function() {
             event.preventDefault();
             let element = document.getElementById('')
         });
     });
 </script>