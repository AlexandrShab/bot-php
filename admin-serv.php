<?php
    header('Access-Control-Allow-Origin: *');

require_once __DIR__ . '/autoload.php';
//var_dump($_COOKIE);

define('BOT_USERNAME', 'ByStatBot'); // place username of your bot here

if (isset($_GET['logout'])) {
  setcookie('tg_user', '');
  header('Location: admin-serv.php');
}

//require_once __DIR__ . '/pages/header.php';

$tg_user = getTelegramUserData();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    

    <title>SertSale</title>
    <style>
        .main-title {
            font-family: "Playfair Display", Roboto, Helvetica, Arial, sans-serif;
            font-size: 1.2rem;
            line-height: 1.133;
            font-weight: 600;
            letter-spacing: .02em;
            display: block;
            text-align: center;
            margin: 20px auto;
            width: 90%;
            max-width: 960px;
            min-width: 300px;
            
        }
        .brand{
            font-family: "Playfair Display", Roboto, Helvetica, Arial, sans-serif;
            font-size: 2.5rem;
            font-weight: 900;
            letter-spacing: 0.03em;
            display: grid;
            text-align: center;
            margin: 0 auto;
            width: 100%;
            height:100px;
            color: white;
            background: black;
            min-width: 330px;
            align-items: center;
        } 
        #content {
            height: 200px;
            border-radius:  30px;
            /*border: solid black 1px;*/
        }
        #btn {
            justify-self: end;
            height: 40px;
            padding: 10px;
            border-radius: 5px;
        }
    </style>
    
</head>
<body>
    <div class="brand" style="backgroundColor: black;">
        <text>SertSale_bot</text>
    </div>
    <div id="content">
        <p1 class="main-title">Страница администратора</p1>
<?php
$html = "<span></span>";
   

//~~~~~~~~~
if ($tg_user !== false) {
    if ($tg_user->isAdmin == '1'){$isAdmin = true;}//~~~~~~~~~Check isAdmin~~~~~~~~~~~~~~~~~~~~~~
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

header('Content-Type: text/html');
//require_once __DIR__ . '/pages/header.php';


 /* if ($isAdmin)
    {
      
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
  ?>
     </div><!-- конец класса content-->

    
</body>
</html>