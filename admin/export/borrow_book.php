<?php

function createExcel($spreadsheet, $conn)
{
    $sql = "SELECT * from borrows";
    $query = mysqli_query($conn, $sql);
    $data = [];

    $result = mysqli_query($conn, "SHOW COLUMNS FROM borrows");
    $columns = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $columns[] = $row['Field'];
    }

    while ($row = mysqli_fetch_array($query, 1)) {
        $data[] = $row;
    }

    $rowTitle = 1;
    $letter = 'A';
    foreach ($columns as $value) {
        $colTitle = 1;
        $spreadsheet->getActiveSheet()->setCellValue($letter . $colTitle, $value);
        $colTitle++;
        $letter++;
    }

    $numRow = 2;
    foreach ($data as $row) {
        $letter = 'A';

        foreach ($columns as $value) {
            $key = 0;
            $spreadsheet->getActiveSheet()->setCellValue($letter . $numRow, $row[$value]);
            $letter++;
            $key++;
        }
        $numRow++;
    }


    return $data;
}
