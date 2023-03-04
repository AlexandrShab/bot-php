<?php

function isMesFind(sample)
{
  if ((strpos($sample,'здравс') != false)
    || (strpos($sample,'привет') != false)
    || (strpos($sample,'добрый') != false)
    || (strpos($sample,'вопрос') != false)
    || (strpos($sample,'драст') != false)
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
    $keyboard = array(
        'inline_keyboard' => [
      ['text' => '▶️ НАПИСАТЬ ЭКСПЕРТУ', 'url' => 'http://t.me/blondin_man'],
                        ]);
    return $keyboard;
}