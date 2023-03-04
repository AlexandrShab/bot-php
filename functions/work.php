<?php

function hasHello($sample)
{
    $sample = mb_strtolower($sample, 'UTF-8');
  if ((strpos($sample,'здравс')>-1)
  or (strpos($sample,'привет')>-1)
  or (strpos($sample,'добрый')>-1)
  or (strpos($sample,'вопрос')>-1)
  or (strpos($sample,'драст')>-1)
    ){return true;}
    else return false;
}
//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
function goodTime()
{
    date_default_timezone_set('Europe/Moscow'); 
    //$today = date("Y-m-d");
    $time = date("H"); // 17:16:18
    //$today = date("Y-m-d H:i:s"); // 2001-03-10 17:16:18 (the MySQL DATETIME format)
    $hiMes = 'Здравствуйте';
 
      if ($time > 5 && $time < 10) {  $hiMes = 'Доброе утро';}
      if ($time > 9 && $time < 18) {  $hiMes = 'Добрый день';}
      if ($time >17 && $time < 24) {  $hiMes = 'Добрый вечер';}
      if ($time >-1 && $time < 6 ) {  $hiMes = 'Доброй ночи';}

    return $hiMes;
}
//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
function writeToExpertKeyboard()
{
    $keyboard = [
        'inline_keyboard' => [
            [
                ['text' => '▶️ НАПИСАТЬ ЭКСПЕРТУ', 'url' => 'http://t.me/blondin_man'],
            ],
        ],
    ];
    return $keyboard;
}