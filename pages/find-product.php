<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://telegram.org/js/telegram-web-app.js"></script>
    <title>SertSale</title>
    <style>
        .main-title {
            font-family: "Playfair Display", Roboto, Helvetica, Arial, sans-serif;
            font-size: 3rem;
            line-height: 1.133;
            font-weight: 400;
            letter-spacing: .018em;
            display: block;
            text-align: center;
            margin: 0 auto 15px;
            width: 100%;
            max-width: 960px;
            min-width: 100px;
            word-break: break-word;
        }
    </style>
</head>
<body>
    <h1 class="main-title" style="margin: 20px;">Поиск товара</h1>
    <form action="https://sertbot.shinny-mir.by/serv.php" method="post">
        <div style="height:40px;margin:20px">
            <input style="width:90%; 
                height: 100%; font: size 20px;" 
                type="text" name="query" placeholder="Введите название товара"><br/><br/>
            <button style="margin-right:20px;padding:10px; height: 100%;" type="submit">Проверить</button>
        </div>
    </form>
    <div id="list">

    </div>
    <script>
        var webApp = window.Telegram.WebApp;
        var style = webApp.themeParams;
        var data = webApp.initDataUnsafe;    
        //document.getElementById('list').innerHTML = JSON.stringify(data);
        //document.getElementById('list').innerHTML = JSON.stringify(style);
         webApp.ready();      
        document.body.style.backgroundColor = style.bg_color;
        document.body.style.color = style.text_color;
        document.querySelectorAll('button').style.backgroundColor = style.button_color;
       // document.button.style.backgroundColor = style.button_color;
       document.querySelectorAll('button').style.backgroundColor = style.button_text_color;
        //document.button.style.color = style.button_text_color;
        webApp.BackButton.show();
        webApp.MainButton.setText('Написать эксперту');
        webApp.MainButton.onClick(document.location.href='https://t.me/blrAlex');

  
       /*  const styles ={"bg_color":"#ffffff",
                "button_color":"#40a7e3",
                "button_text_color":"#ffffff",
                "hint_color":"#999999",
                "link_color":"#168acd",
                "secondary_bg_color":"#f1f1f1",
                "text_color":"#000000"};*/
            const appData =    {"query_id":"AAEauLg5AAAAABq4uDmPIyie",
                            "user":{"id":968407066,
                                "first_name":"Alex",
                                "last_name":"🎗",
                                "username":"BlrAlex",
                                "language_code":"ru",
                                "is_premium":true},
                            "auth_date":"1678476891",
                            "hash":"f4dd11e37760871ba8773979860514647e427080b559d83cc029488139e81c08"}
    </script>
</body>
</html>