<?php
require 'vendor/autoload.php';

// use PhpOffice\PhpSpreadsheet\IOFactory;
// use PhpOffice\PhpSpreadsheet\Spreadsheet;
// //
use PhpOffice\PhpSpreadsheet\Chart\Chart;
use PhpOffice\PhpSpreadsheet\Chart\DataSeries;
use PhpOffice\PhpSpreadsheet\Chart\DataSeriesValues;
use PhpOffice\PhpSpreadsheet\Chart\Legend as ChartLegend;
use PhpOffice\PhpSpreadsheet\Chart\PlotArea;
use PhpOffice\PhpSpreadsheet\Chart\Title;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
//solucion al problema del composer
//https://stackoverflow.com/questions/7851011/how-do-i-install-gd-on-my-windows-server-version-of-php

require("configuracion2.php");
$get_data = $conn->prepare("SELECT timestamp, sum(CASE WHEN address = 1 THEN value END) 'CorrientemA', 
sum(CASE WHEN address = 2 THEN value END) 'FrecuenciaHz', sum(CASE WHEN address = 3 THEN value END) 'TensionV', 
sum(CASE WHEN address = 4 THEN value END) 'FactordePotenciaTotal', sum(CASE WHEN address = 5 THEN value END) 'VoltajeFase2', 
sum(CASE WHEN address = 6 THEN value END) 'VoltajePromediodeFase', sum(CASE WHEN address = 7 THEN value END) 'VoltajePromLin' 
FROM historical WHERE grd_id=1  AND (timestamp>='2018-04-01') GROUP BY timestamp  ");
$get_data->execute();
if($get_data->rowCount()>0){
    $result_array[]=['CorrientemA',  'FrecuenciaHz',  'TensionV',  'FactordePotenciaTotal' ];
    while($value = $get_data->fetch(PDO::FETCH_OBJ)){
        $tiempo = $value->timestamp;
        $valor1 = $value->CorrientemA;
        $valor2 = $value->FrecuenciaHz;
        $valor3 = $value->TensionV;
        $valor4 = $value->VoltajePromediodeFase;
        $result_array[]= [$tiempo,$valor1*(0.0625)-75,$valor2/100,$valor3/1000,$valor4/100];
    }
}
// print_r ($result_array);
$sizeOut= sizeof($result_array);
$sizeIn= sizeof($result_array[0]);

$spreadsheet = new Spreadsheet;
$worksheet = $spreadsheet -> getActiveSheet();
$worksheet->fromArray(

        $result_array
    
);
// $start=0;
// $dataSeriesLabels1 = [];
// while($start < $sizeIn-1){
//     array_push($dataSeriesLabels1,new DataSeriesValues(DataSeriesValues::DATASERIES_TYPE_STRING, 'Worksheet!$A$1', null, 1));
// }


$dataSeriesLabels1 = [
    new DataSeriesValues(DataSeriesValues::DATASERIES_TYPE_STRING, 'Worksheet!$A$1', null, 1), // 2010
    new DataSeriesValues(DataSeriesValues::DATASERIES_TYPE_STRING, 'Worksheet!$B$1', null, 1), // 2011
    new DataSeriesValues(DataSeriesValues::DATASERIES_TYPE_STRING, 'Worksheet!$C$1', null, 1), // 2012
    new DataSeriesValues(DataSeriesValues::DATASERIES_TYPE_STRING, 'Worksheet!$D$1', null, 1), // 2012
];

$xAxisTickValues1 = [
    new DataSeriesValues(DataSeriesValues::DATASERIES_TYPE_STRING, 'Worksheet!$A$5706:$A$6000', null, 70), // Q1 to Q4
];
// // Set the Data values for each data series we want to plot
// //     Datatype
// //     Cell reference for data
// //     Format Code
// //     Number of datapoints in series
// //     Data values
// //     Data Marker
$dataSeriesValues1 = [
    new DataSeriesValues(DataSeriesValues::DATASERIES_TYPE_NUMBER, 'Worksheet!$B$5710:$B$6000', null, 70),
    new DataSeriesValues(DataSeriesValues::DATASERIES_TYPE_NUMBER, 'Worksheet!$C$5706:$C$6000', null, 70),
    new DataSeriesValues(DataSeriesValues::DATASERIES_TYPE_NUMBER, 'Worksheet!$D$5706:$D$6000', null, 70),
    new DataSeriesValues(DataSeriesValues::DATASERIES_TYPE_NUMBER, 'Worksheet!$E$5706:$E$6000', null, 70),
];


// Build the dataseries
$series1 = new DataSeries(
    DataSeries::TYPE_LINECHART, // plotType
    DataSeries::GROUPING_PERCENT_STACKED, // plotGrouping
    range(0, count($dataSeriesValues1) - 1), // plotOrder
    $dataSeriesLabels1, // plotLabel
    $xAxisTickValues1, // plotCategory
    $dataSeriesValues1          // plotValues
);

// Set the series in the plot area
$plotArea1 = new PlotArea(null, [$series1]);
// Set the chart legend
$legend1 = new ChartLegend(ChartLegend::POSITION_TOPRIGHT, null, false);

$title1 = new Title('Grafica ');
$yAxisLabel1 = new Title('Valores');

// Create the chart
$chart1 = new Chart(
    'chart1', // name
    $title1, // title
    $legend1, // legend
    $plotArea1, // plotArea
    true, // plotVisibleOnly
    DataSeries::EMPTY_AS_GAP, // displayBlanksAs
    null, // xAxisLabel
    $yAxisLabel1 // yAxisLabel
);

// Set the position where the chart should appear in the worksheet
$chart1->setTopLeftPosition('A7');
$chart1->setBottomRightCell('Z20');

// Add the chart to the worksheet
$worksheet->addChart($chart1);

header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
header("Content-Disposition: attachment; filename=reporte.xlsx");
// Save Excel 2007 file
$writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
$writer->setIncludeCharts(true);
$writer -> save('php://output');
// //set the header firts

// //create IOFactory object