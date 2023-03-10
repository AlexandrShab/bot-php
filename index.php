<?php
//testing
//echo '<h1>SertSaleBot</h1><br/>';
//https://api.telegram.org/bot1862861327:AAF7CJdOJaEoGEjqrbu8BgRaPyAsBfecgP0/setwebhook?url=https://sertbot.shinny-mir.by/index.php
$input = file_get_contents('php://input');
if(!$input)
{
  echo "<h1>Нет страницы для отображения</h1>";
 /* $new_url = 'https://sertbot.shinny-mir.by/findform.php';
header('Location: '.$new_url);*/
exit();
}
//$bot_url = 'https://sertbot.shinny-mir.by';
require_once __DIR__ . '/autoload.php';

define('TOKEN','1862861327:AAF7CJdOJaEoGEjqrbu8BgRaPyAsBfecgP0');
define('TELEGA_URL', 'https://api.telegram.org/bot' . TOKEN);
define('MY_ID','968407066');
define('BOT_GROUP', '-1001523457115');   //SertBot_privateMessages
define('ADMINS_GROUP', '-1001630215811');   //Инфа от SertSale ботов
define('BOT_NAME','@SertSale_bot');



$update = json_decode($input, TRUE);
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
    $mes_text = $update['message']['text'];
    //$menuButton = mb_substr($mes_text, 0, 1);

    
    if(isset($msg['web_app_data']))//~~~ Проверяем приход данных из WebApp ~~~~
    {
        $telega->sendMes(MY_ID, 'button_text:' . $msg['web_app_data']['button_text'] . '\n' . 'data:\n' . $msg['web_app_data']['data']);
    }
    if ($chat_type == 'private')// Работаем только в личке с ботом
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
        $telega->sendMes(MY_ID, $mes_text);
        require_once __DIR__ . "/functions/work.php";

        if (hasHello($mes_text))
        {
            $hi = goodTime();
            
            $telega->sendMes($chat_id, "👋 " . $hi . ", <b>" . $user->first_name . "</b>\n\n📲 Просто напечатайте название товара и нажмите «Отправить».");
        }
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
              if (($mes_text == '/menu'. BOT_NAME) || ($mes_text == '/menu')){ 
                    $telega->sendKeyboard($chat_id, '🎪 Главное меню 👇', mainMenuKeys());
                return;
              } 
              //~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
              if (($msg['text'] == ('/start' . BOT_NAME)) || ($msg['text'] == '/start'))
              { 
                
                $text2 = "👋 Здравствуйте, <b>" . $tg_user['first_name'] . "!</b>\n\nЕсли вам нужна разрешительная документация на товары для продажи на маркетплейсе(-ах) или есть вопросы по сертификации продукции и услуг, значит вы по адресу.\n\nМы акредитованный орган по сертификации, поэтому стоимость выгодная, а сроки от 1 дня.\n\n👉 пишите @blondin_man для заказа и консультации, мы поможем.";
                $telega->sendKeyboard($chat_id, $text2, writeToExpertKeyboard());
                return;
              }
              
              if (($msg['text'] == ('/help' . BOT_NAME)) || ($msg['text'] == '/help'))
              { 
                
                $hi = goodTime();
                $telega->sendMes($chat_id, $hi . ", <b>" . $user->first_name . "</b>");
                $textAbout = "Центр сертификации «SertSale» является аккредитованным органом по сертификации, зарегистрированный в Федеральной Службе Аккредитации (ФСА) и предлагает полный комплекс услуг по оформлению разрешительной документации на Ваши товары:\n• Сертификация для маркетплейсов\n• Сертификация для РФ производителей\n• Сертификация для импортеров\n• Сертификация для экспортеров\n• Сертификаты Таможенного союза\n• Декларации Таможенного союза\n• Протоколы лабораторных испытаний\n• Отказные письма на продукцию\n• Регистрация торгового знака\n• Свидетельство о государственной регистрации\n• Экспертное Заключение Роспотребнадзора\n• Сертификация / декларация ТР ТС\n• Сертифткаты ISO\n• Сертификация РПО\n• Сертификация ГОСТ Р\n• Декларирование ГОСТ Р\n• Добровольная сертификация\n• Пожарная сертификация / декларация\n• Сертификация услуг\n• Разработка Технических Условий\n• Разработка Технологической Инструкции\n• Разработка Паспортов Безопасности\n• Штрихкодирование продукции\n• Экологическая Сертификация\n• Сертификация Халяль\n• Сертификат Кошерности\n• Сертификат Биологической безопасности\n• Сертифткат Органической безопасности\n• Сертификат отсутсвия ГМО\n• Сертификация происхождение товара СТ -1\nИ многие другие разрешительные документы🗂\n\n✅ Имеем собственную лабораторию в городе Москва!\n✅ Работаем по договору с указанием сроков и стоимости!\n✅ Сроки готовой документации от 1 рабочего дня!\n✅ Доставляем готовые документы по городам России!\n\n☎️ 8 800 707-40-97 (бесплатно по РФ)";
                $telega->sendKeyboard($chat_id, $textAbout, writeToExpertKeyboard());
                return;
              }
              return;
            }// ~~~~~~~~конец обработки команд~~~~~~~
                //~~~ Конец проверки кнопок главного меню ~~~~~
        }//~~~ Конец работы с сущностями~~~~~~~~~
            //~~~ Проверка нажатия кнопок главного меню ~~~~~
            
            if ($mes_text == '🎪 Главное меню') {
                $telega->sendKeyboard($chat_id, "🎪 Главное меню 👇", mainMenuKeys());
                return;
            }
            if ($mes_text == '🔍 ПРОВЕРИТЬ ТОВАР') {
              //$new_url = 'https://sertbot.shinny-mir.by/pages/find-product.php';
              $telega->sendKeyboard($chat_id,"Расширенный поиск", inLineWebAppButton());
              
                //$telega->sendKeyboard($chat_id, "✏️ Введите товар для проверки:👇", secondMenuKyes());
                return;
            } 
            if ($mes_text == '🚀 О нас') {
                
               $textAbout = "Центр сертификации «SertSale» является аккредитованным органом по сертификации, зарегистрированный в Федеральной Службе Аккредитации (ФСА) и предлагает полный комплекс услуг по оформлению разрешительной документации на Ваши товары:\n• Сертификация для маркетплейсов\n• Сертификация для РФ производителей\n• Сертификация для импортеров\n• Сертификация для экспортеров\n• Сертификаты Таможенного союза\n• Декларации Таможенного союза\n• Протоколы лабораторных испытаний\n• Отказные письма на продукцию\n• Регистрация торгового знака\n• Свидетельство о государственной регистрации\n• Экспертное Заключение Роспотребнадзора\n• Сертификация / декларация ТР ТС\n• Сертифткаты ISO\n• Сертификация РПО\n• Сертификация ГОСТ Р\n• Декларирование ГОСТ Р\n• Добровольная сертификация\n• Пожарная сертификация / декларация\n• Сертификация услуг\n• Разработка Технических Условий\n• Разработка Технологической Инструкции\n• Разработка Паспортов Безопасности\n• Штрихкодирование продукции\n• Экологическая Сертификация\n• Сертификация Халяль\n• Сертификат Кошерности\n• Сертификат Биологической безопасности\n• Сертифткат Органической безопасности\n• Сертификат отсутсвия ГМО\n• Сертификация происхождение товара СТ -1\nИ многие другие разрешительные документы🗂\n\n✅ Имеем собственную лабораторию в городе Москва!\n✅ Работаем по договору с указанием сроков и стоимости!\n✅ Сроки готовой документации от 1 рабочего дня!\n✅ Доставляем готовые документы по городам России!\n\n☎️ 8 800 707-40-97 (бесплатно по РФ)";
               $telega->sendKeyboard($chat_id, $textAbout, writeToExpertKeyboard());
              return;
            }   
            if ($mes_text == '✏️ Задать вопрос') {
                $telega->sendKeyboard($chat_id, "✏️", secondMenuKyes());
                $telega->sendKeyboard($chat_id, "Написать эксперту: 👇", writeToExpertKeyboard());                
              return;
            }
            if ($mes_text == '🔗 Ссылки на наши ресурсы') {
                $telega->sendKeyboard($chat_id, '🔗', secondMenuKyes());
                $telega->sendKeyboard($chat_id, "Cсылки 👇", linksMenu());
              return;
            }
            if ($mes_text == '📞 Связаться с нами') {
                $telega->sendKeyboard($chat_id, "Наши контакты: 👇", secondMenuKyes());
                $text = "☎️ 8 800 707-40-97 (бесплатно по РФ)\n\nТелеграм-чат https://t.me/SertSale";
                $telega->sendMes($chat_id, $text);
              return;
            }
        
    }else{return;}//~~~~ Конец работы в приватном чате ~~~~~~~
}// ~~~~~ End обработки апдейта типа message ~~~~~~



//~~~~~~~FUNCTIONS~~~~~~~~~~~~~~~~~~
