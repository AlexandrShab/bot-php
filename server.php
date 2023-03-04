<?php
  require_once __DIR__ . '/autoload.php';
  $base = new BaseAPI;
  $products = $base->getAllProducts();
  foreach ($products as $product) 
  {
     echo $product->id . ". " . $product->name . " - " . $product->doc_type ."<br/>";
  }




//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
function csvToBase()
{
 if (($handle = fopen(__DIR__ . "/data/products.csv", "r")) !== FALSE) {
     while (($data = fgetcsv($handle, 2000, ",")) !== FALSE) {
         
         $base->addProduct($data[0],$data[1]);
         echo $data[0]." - ".$data[1]. "<br/>";
         
     }
     fclose($handle);
     
 }
}
