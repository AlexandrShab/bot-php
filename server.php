<?php
    echo "WORKS";
    $time = date("H"); // 17:16:18
 
    $hiMes = 'Здравствуйте';
 
      if ($time > 4 && $time < 10) {  $hiMes = 'Доброе утро'}
      if ($time > 9 && $time < 18) {  $hiMes = 'Добрый день'}
      if ($time >17 && $time < 24) {  $hiMes = 'Добрый вечер'}
      if ($time >-1 && $time < 5 ) {  $hiMes = 'Доброй ночи'}
      
echo "HEllo WORLD!!!!!! - " . $time +3 . "<br>";
echo $hiMes;
