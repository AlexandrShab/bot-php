<?php
//echo '<h1>SertSaleBot</h1><br/>';
//https://api.telegram.org/bot1862861327:AAF7CJdOJaEoGEjqrbu8BgRaPyAsBfecgP0/setwebhook?url=https://sertbot.shinny-mir.by/index.php

//$bot_url = 'https://sertbot.shinny-mir.by';
require_once __DIR__ . '/autoload.php';

define('TOKEN','1862861327:AAF7CJdOJaEoGEjqrbu8BgRaPyAsBfecgP0');
define('TELEGA_URL', 'https://api.telegram.org/bot' . TOKEN);
define('MY_ID','968407066');
define('BOT_GROUP', '-1001523457115');   //SertBot_privateMessages
define('ADMINS_GROUP', '-1001630215811');   //Инфа от SertSale ботов
define('BOT_NAME','@SertSale_bot');


$updt = file_get_contents('php://input');
$update = json_decode($updt, TRUE);
file_put_contents('update.txt', '$update: ' .print_r($update,1)); 

//var_dump($data);

$telega = new Telega;
/*
if (isset($update['update_id']))
{
    $text = 'Пришел новый update!' . json_encode($update);//
    $mes_id = $telega->sendMes(MY_ID, $text);
}*/
//~~~~~~~~~~~ Начало обработки апдейта типа message ~~~~~~
if(isset($update['message']))
{
    $msg = $update['message'];
    $tg_user = $msg["from"];
    $chat_id = $msg['chat']['id'];
    $chat_type = $msg['chat']['type'];
    $chat_title = isset($msg['chat']['title']) ? $msg['chat']['title'] : $tg_user['first_name'] . ' ' . $tg_user['last_name'];
    $message_id = $msg['message_id'];
    
    if(isset($msg['web_app_data']))//~~~ Проверяем приход данных из WebApp ~~~~
    {
        $telega->sendMes(MY_ID, 'button_text:' . $msg['web_app_data']['button_text'] . '\n' . 'data:\n' . $msg['web_app_data']['data']);
    }
    if ($chat_type == 'private')
    {   //~~~~~~ Работаем с Юзером и базой ~~~
        $base = new BaseAPI;
        $userFromBase = $base->getUser($tg_user['id']);
        if ($userFromBase == false)
        {
           $base->addUser($tg_user);
           $userFromBase = $base->getUser($tg_user['id']);
        }
        
       
        $user = new User($userFromBase);
        $user->update($tg_user);
        $telega->sendMes(MY_ID, "Пишет <b>$user->first_name $user->last_name</b> \nДата старта: $user->date");
        
        if (isset($msg['entities'])){
            //~~~~~~~~~~~~~~~~~~~~~~~~~Обработка Команд Боту~~~~~~~~~~~~~~~~~~~~~~~~
            if ( $msg['entities'][0]['type'] == 'bot_command')
            {    // Если сообщение - команда боту
                  $telega->sendAction($chat_id);
                  /*
                  var count = varSheet.getRange(2,2).getValue(); // счетчик вызова команд
                      count = count + 1;
                      varSheet.getRange(2,2).setValue(count);*/
              //~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
             /* if (msg.text == ('/getchat'+botName) || msg.text == '/getchat'){ // Получение данных о чате
                sendMess(myId,chatId+'\n'+chatName+'\n'+chatType);
                getChat(chatId,chatName,chatType);return;     
              }*/
              //~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
              if (($msg['text'] == ('/start' . BOT_NAME)) || ($msg['text'] == '/start'))
              { 
                $text2 = "👋 Здравствуйте, " . $tg_user['first_name'] . "!\n\nЕсли вам нужна разрешительная документация на товары для продажи на маркетплейсе(-ах) или есть вопросы по сертификации продукции и услуг, значит вы по адресу.\n\nМы акредитованный орган по сертификации, поэтому стоимость выгодная, а сроки от 1 дня.\n\n👉 пишите @blondin_man для заказа и консультации, мы поможем.";
                $telega->sendMes($chat_id, $text2);
                return;
              }
              return;
            }// ~~~~~~~~конец обработки команд~~~~~~~
        }
    }else{return;}
    
    
}// ~~~~~ End обработки апдейта типа message ~~~~~~



//~~~~~~~FUNCTIONS~~~~~~~~~~~~~~~~~~
