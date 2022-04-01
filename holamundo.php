<?php
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

$spreadsheet = new Spreadsheet;
$sheet = $spreadsheet -> getActiveSheet();
$sheet -> setCellValue('A1', 'Hello');
//set the header firts

header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
header("Content-Disposition: attachment; filename=reporte.xlsx");
//create IOFactory object
$writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
$writer -> save('php://output');