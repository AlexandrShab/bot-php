<?php
header('Access-Control-Allow-Origin: *');/*
?>
<auth>
    <script async src="https://telegram.org/js/telegram-widget.js?19\" 
                        data-telegram-login="ByStatBot" 
                        data-size="medium" 
                        data-auth-url="http://sertbot.shinny-mir.by/check_authorization.php" 
                        data-request-access="write"
                        style="padding-top: 16px; float: right;"
                        ></script> 
</auth>
<?php*/
//require_once __DIR__ . '/classes/request.php';

require_once __DIR__ . '/autoload.php';
//var_dump($_COOKIE);
$html = "<span></span>";
define('BOT_USERNAME', 'ByStatBot'); // place username of your bot here

if (isset($_GET['logout'])) {
  setcookie('tg_user', '');
  header('Location: admin-serv.php');
}

//require_once __DIR__ . '/pages/header.php';

$tg_user = getTelegramUserData();

//~~~~~~~~~Check isAdmin~~~~~~~~~~~~~~~~~~~~~~
if ($tg_user->isAdmin == '1'){$isAdmin = true;}


if ($tg_user !== false) {
    //var_dump($tg_user);
  $first_name = htmlspecialchars($tg_user->first_name);
  //$html .= "<name style=\"float:right;\">{$first_name}</name>";
  
    $html .= "<a href=\"/admin-serv.php?logout=1\" 
        class=\"dropdown\" style=\"float:right;\">
        <img src=\"/public/img/door1.jpg\"
            style=\"height:40px;margin-right:10px;\">
        </a>";
    
 if (isset($tg_user->photo_url)) {
    $photo_url = htmlspecialchars($tg_user->photo_url);
    //$photo_url = $tg_user['photo_url'];
    $html .= "<img src=\"{$photo_url}\" style=\"width:40px; 
            border-radius:20px;float:right;margin-right:10px;\">";
    
  }else
      {
          $html .= "<name style=\"float:right;margin:10px;
                color:black;\">{$first_name}</name>";
      }
   print_r($html); 
}else {
    $bot_username = BOT_USERNAME;
    $authItem = new AuthItem;
    $html = $authItem->content;
    print_r($html);
}

//~~~~~~~~~~~~~~~~~Разметка страницы~~~~~~~~~~~~~~~~~~~~~~~~~~~

//header('Content-Type: text/html');
//require_once __DIR__ . '/pages/header.php';
/*
$html .= "</div>";

$html .= "<ul class=\"bar\">";
  if ($isAdmin)
    {
      $menu = new Menu;
      $html .= $menu->content;
    }

print_r($html);*/

// ~~~~~~~~~~ Начало контента страницы~~~~~~~~~~~~~~~~~~~~~

//~~~~~~~~~~~~~
if($_SERVER["REQUEST_URI"] == '/admin') 
{
    if ($isAdmin)
   {
      require_once __DIR__ . '/pages/admin-page.php';
       
      exit;
    }
}

//~~~~~~~~~~~~~


//exit;

function getTelegramUserData() {
    if (isset($_COOKIE['tg_user'])) {
      
      $auth_data_json = urldecode($_COOKIE['tg_user']);
      //print_r($auth_data_json);
      $auth_data = json_decode($auth_data_json, true);
      $user = new User($auth_data);
      /*if(!$user->isInBase())
      {
          
          $user->addTobase();
      }*/
      $user->checkAdmin();
        
      return $user;
    }
    return false;
  }
  