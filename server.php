<?php
 require_once __DIR__ . '/autoload.php';
 $base = new BaseAPI;
 
 $row = 1;
 if (($handle = fopen("/data/products.csv", "r")) !== FALSE) {
     while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
         $num = count($data);
         echo "<p> $num полей в строке $row: <br /></p>\n";
         $row++;
         for ($c=0; $c < $num; $c++) {
             echo $data[$c] . "<br />\n";
         }
     }
     fclose($handle);
 }
echo "HEllo WORLD!!!!!! - " . $time . "<br>";
echo $hiMes;
