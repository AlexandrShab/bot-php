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
            
            height: 100%;
            /*border: solid black 1px;*/
        }
        #btn {
            justify-self: end;
            height: 40px;
            padding: 10px;
            border-radius: 5px;
        }
        table {
            border-collapse: collapse;
            text-align: center;
            border: solid gray 1px;
        }
        thead {
            background:lightgray;
            border: solid gray 1px;
        }
        td, th{
            padding: 5px;
            border: solid gray 1px;
        }
    </style>
    
</head>
<body>
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
                style=\"height:32px;margin-right:10px;\">
            </a>";
        
     if (isset($tg_user->photo_url)) {
        $photo_url = htmlspecialchars($tg_user->photo_url);
        //$photo_url = $tg_user['photo_url'];
        $html .= "<img src=\"{$photo_url}\" style=\"width:32px; 
                border-radius:16px;float:right;margin-right:10px;\">";
        
      }else
          {
              $html .= "<name style=\"float:right;margin:10px;
                    color:black;\">{$first_name}</name>";
          }
        $html .= "<a style=\"float:left;\" href=\"https:/t.me/AlexanderShab\">Support</a>";
       //print_r($html); 
    }else {
        $bot_username = BOT_USERNAME;
        $authItem = new AuthItem;
        $html = $authItem->content;
        $html .= "<a style=\"float:left;\" href=\"https:/t.me/AlexanderShab\">Support</a>";
        //print_r($html);
    }
    
?>
    <div class="brand" style="backgroundColor: black;">
        <text>SertSale_bot</text>
    </div>
    
<?php
    if (isset($isAdmin) && $isAdmin)
   {
?>
    <div id="content">
        <p1 class="main-title">Страница администратора</p1>
<?php
    }else
    {
?>
    <div id="content">
        <p1 class="main-title">Вам необходимо авторизоваться, либо у вас недостаточно прав...</p1><br/><br/>


<?php        
    }

// ~~~~~~~~~~ Начало контента страницы~~~~~~~~~~~~~~~~~~~~~

//~~~~~~~~~~~~~
if (isset($_GET['method']))
{ 
    if($_GET['method'] == 'getUsers') 
    {
        $base = new BaseAPI;
        $users = $base->getUsers();
        
        
        $html = "<div id=\"list\">
        <table>
            <thead>
                <th>
                    №
                </th>
                <th>
                    ID
                </th>
                <th>
                    Имя пользователя
                </th>
                <th>
                    Юзернейм
                </th>
                <th>
                    Дата старта
                </th>
                <th>
                    Админ?
                </th>
                <th>
                    Написать от имени бота
                </th>
            </thead>
            <tbody>";
        $num = 0;        
        foreach ($users as $user) {
            $num ++;
            $adm = "Нет";
            if($user->is_admin == '1')
            {
                $adm = "<strong>Да</strong>";
            }
            $html .= 
                "<tr>
                    <td>
                        $num
                    </td>
                    <td>
                        $user->id
                    </td>
                    <td>
                        $user->first_name $user->last_name
                    </td>
                    <td>
                        $user->username
                    </td>
                    <td>
                        $user->date
                    </td>
                    <td>
                        $adm
                    </td>
                    <td onclick=\"sendMesage($user->id)\">
                        Написать
                    </td>
                </tr>";
            }
            $html = "</tbody>
                </table>
            </div>";
            
            
        
       
    }

 print_r($html);
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
     <script>
        function senMessage(user_id){
            let link = "https://sertbot.shinny-mir.by/admin-serv.php?method=sendMessage&&chat_id=" + user_id;
            document.location.href=link;
        }
     </script>   
    
</body>
</html>