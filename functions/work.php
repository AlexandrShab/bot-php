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
function goodTime(){
  var date = new Date();
  //var time = Utilities.formatDate(date, 'GMT+3', 'yyyy-MM-dd\'T\'HH:mm:ss.SSS\'Z\'');//date.getHours()
  var time = Utilities.formatDate(date, 'GMT+3', 'HH');//получается строковая переменная
  let hiMes = 'Здравствуйте';
  time = parseInt(time);
  //time = 2;
  //Logger.log(time);

    if (time > 4 && time < 10) {  hiMes = 'Доброе утро'}
    if (time > 9 && time < 18) {  hiMes = 'Добрый день'}
    if (time >17 && time < 24) {  hiMes = 'Добрый вечер'}
    if (time >-1 && time < 5 ) {  hiMes = 'Доброй ночи'}
    
    //Logger.log(hiMes)
    return hiMes
}
//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~