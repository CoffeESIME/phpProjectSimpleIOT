 <?php                                                                       
session_start();
if (!isset($_SESSION['nivel']))
{ header("Location: PaginaIniciodeSesion.php");
  exit();
}
?>
 <!DOCTYPE html>  
 <html>  
     <head>  


           <title>Visualización de datos por fecha</title>  
           <script src="Javascriptsweb\jquery.min.js"></script>  
           <script src="Javascriptsweb\jquery-ui.min.js"></script>  
           <link rel="stylesheet" href="CSSweb\jquery-ui.css">  
             <link rel="stylesheet" href="CSSweb/jquery-ui.css">
             <link rel="stylesheet" href="CSSweb/estilo.css">
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
                <h2 align="center">Busqueda por Fecha</h2>  
                <h3 align="center">Datos ordenados</h3> 
                <div>  
                     <input type="text" name="from_date" id="desde" placeholder="Desde" />  
                </div>  
                <div>  
                     <input type="text" name="to_date" id="hasta" placeholder="Hasta" />  
                </div>  
                <div>  
                     <input type="button" name="filtro" id="filtro" value="Filtrar"  />  
                </div>    
                <div>  
                     <input type="button" name="DOWN" id="Descarga" value="Descargar"  />  
                </div> 
                <div id="TablaOrdenada">  
                      
                </div>  
          <div>
     
              <footer class="jumbotron jumbotronPiedePagina">
                  <?php include('Pie.php'); ?>
              </footer>
          </div>
      </body>  
 </html>  

 <script>  
     $(document).ready(function(){  
         $.datepicker.setDefaults({  
             dateFormat: 'yy-mm-dd' ,
             changeMonth: true,
             changeYear: true
           });  
           $(function(){  
                $("#desde").datepicker();  
                $("#hasta").datepicker();  
           });  
           $('#filtro').click(function(){  
               var desdefecha = $('#desde').val();  
               var hastafecha = $('#hasta').val();
               if(desdefecha != '' && hastafecha != '')  
               {  
                   $.ajax({  
                       url:"FiltroDatosMultiples.php",  
                       method:"POST",  
                       data:{desdefecha:desdefecha, hastafecha:hastafecha},
                       success:function(data) 
                       {  
                           $('#TablaOrdenada').html(data);
                       }  
                     });  
                }  
                else  
                {  
                     alert("Por favor selecciona los datos necesarios");  
                }  
           });  
      });  
 </script>



<script>  
    $(document).ready(function(){  
        $.datepicker.setDefaults({  
            dateFormat: 'yy-mm-dd' ,
            changeMonth: true,
            changeYear: true
        });  
        $(function(){  
            $("#desdeD").datepicker();  
            $("#hastaD").datepicker();  
        });  
        $('#Descarga').click(function(){  
            var desdefecha = $('#desdeD').val();  
            var hastafecha = $('#hastaD').val();
            if(desdefecha != '' && hastafecha != '')  
            {  
                $.ajax({  
                    url:"ObtencionParaCVS.php",  
                    method:"POST",  
                    data:{desdefecha:desdefecha, hastafecha:hastafecha},
                    success:function(data) 
                    {  
                        var json_pre = data;
                        var json = $.parseJSON(json_pre);
                        var csv = JSON2CSV(json_pre);
                        var downloadLink = document.createElement("a");
                        var blob = new Blob(["\ufeff", csv]);
                        var url = URL.createObjectURL(blob);
                        downloadLink.href = url;
                        downloadLink.download = "datos.csv";
                        document.body.appendChild(downloadLink);
                        downloadLink.click();
                        document.body.removeChild(downloadLink);
                    }  
                });  
            }  
            else  
            {  
                alert("Por favor selecciona los datos necesarios");  
            }  
        });  
    });  
    function JSON2CSV(objArray) {
    var array = typeof objArray != 'object' ? JSON.parse(objArray) : objArray;
    var str = '';
    var line = '';
    if ($("#labels").is(':checked')) {
        var head = array[0];
        if ($("#quote").is(':checked')) {
            for (var index in array[0]) {
                var value = index + "";
                line += '"' + value.replace(/"/g, '""') + '",';
            }
        } else {
            for (var index in array[0]) {
                line += index + ',';
            }
        }
        line = line.slice(0, -1);
        str += line + '\r\n';
    }
    for (var i = 0; i < array.length; i++) {
        var line = '';
        if ($("#quote").is(':checked')) {
            for (var index in array[i]) {
                var value = array[i][index] + "";
                line += '"' + value.replace(/"/g, '""') + '",';
            }
        } else {
            for (var index in array[i]) {
                line += array[i][index] + ',';
            }
        }
        line = line.slice(0, -1);
        str += line + '\r\n';
    }
    return str;
}
 </script>