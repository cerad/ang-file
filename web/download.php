<?php
error_reporting(E_ALL);

// echo $_SERVER['PATH_INFO'];

$contents = <<<EOT
Test Data
Line 2
Line 3
  
EOT;
echo base64_encode($contents);
