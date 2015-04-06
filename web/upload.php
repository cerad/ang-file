<?php

error_reporting(E_ALL);

echo "Upload ";

$files = $_FILES;
print_r($_FILES);

if (!isset($files['file'])) return 'No file';

file_put_contents("php://stdout", 
  sprintf("File: %s\n",$files['file']['name']));

//$contents = file_get_contents($files['file']['tmp_name']);

//echo $files['file']['name'] . ' ' . $contents;

/*
 * (
    [file] => Array
        (
            [name] => Whiteboard.txt
            [type] => text/plain
            [tmp_name] => C:\xampp\tmp\php81F0.tmp
            [error] => 0
            [size] => 25
        )
            [name] => AreaSchedule20131029.xlsx
            [type] => application/vnd.openxmlformats-officedocument.spreadsheetml.sheet
            [tmp_name] => C:\xampp\tmp\php549C.tmp
            [error] => 0
            [size] => 14382
 */
