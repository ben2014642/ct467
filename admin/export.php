<?php

require_once("vendor/autoload.php");
require_once("../lib/conf.php");

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$sql = "SELECT book_id,title,author from books";
$query = mysqli_query($conn, $sql);
$data = [];
while ($row = mysqli_fetch_array($query, 1)) {
    $data[] = $row;
}

// print_r($data);
// print_r($data1); die();
$spreadsheet = new Spreadsheet();
// $activeWorksheet = $spreadsheet->getActiveSheet();
$spreadsheet->getActiveSheet()->getColumnDimension('A')->setWidth(20);
$spreadsheet->getActiveSheet()->getColumnDimension('B')->setWidth(20);
$spreadsheet->getActiveSheet()->getColumnDimension('C')->setWidth(30);
$spreadsheet->getActiveSheet()->setCellValue('A1', 'Tên');
$spreadsheet->getActiveSheet()->setCellValue('B1', 'Giới Tính');
$spreadsheet->getActiveSheet()->setCellValue('C1', 'Đơn giá(/shoot)');
// $activeWorksheet->setCellValue('A1', 'Một hai ba !');
$numRow = 2;
foreach ($data as $row) {
    $spreadsheet->getActiveSheet()->setCellValue('A' . $numRow, $row['book_id']);
    $spreadsheet->getActiveSheet()->setCellValue('B' . $numRow, $row['title']);
    $spreadsheet->getActiveSheet()->setCellValue('C' . $numRow, $row['author']);
    $numRow++;
}
$writer = new Xlsx($spreadsheet);
// redirect output to client browser
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="myfile.xlsx"');
header('Cache-Control: max-age=0');

$writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
$writer->save('php://output');
