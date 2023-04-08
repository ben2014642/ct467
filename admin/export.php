<?php

require_once("vendor/autoload.php");
require_once("../lib/conf.php");

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;



$spreadsheet = new Spreadsheet();

$page = $_GET['page'];

switch ($page) {
    case 'infoBook':
        include_once("export/info_book.php");
        $excel = createExcel($spreadsheet, $conn);
        break;
    case 'borrowBook';
        include_once("export/borrow_book.php");
        $excel = createExcel($spreadsheet, $conn);
        break;
    case 'donateBook';
        include_once("export/donate_book.php");
        $excel = createExcel($spreadsheet, $conn);
        break;
    default:
        # code...
        break;
}
$writer = new Xlsx($spreadsheet);
// redirect output to client browser
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="myfile.xlsx"');
header('Cache-Control: max-age=0');

$writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
$writer->save('php://output');
