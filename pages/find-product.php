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
            font-size: 2.5rem;
            line-height: 1.133;
            font-weight: 600;
            letter-spacing: .02em;
            display: block;
            text-align: center;
            margin: 0 auto;
            width: 90%;
            max-width: 960px;
            min-width: 300px;
            
        }
        .brand{
            font-family: "Playfair Display", Roboto, Helvetica, Arial, sans-serif;
            font-size: 3.5rem;
            font-weight: 900;
            letter-spacing: 0.03em;
            display: block;
            text-align: center;
            margin: 0 auto;
            width: 100%;
            height: 100px;
            color: white;
            background: black;
            min-width: 330px;
            
    </style>
</head>
<body>
    <div class="brand" style="backgroundColor: black;">SertSale
        <br/><span>бот</span>
    </div>
    <div id="content">
        <h1 class="main-title">Поиск товара</h1>
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
    </div>
    <script>
        var webApp = window.Telegram.WebApp;
        var style = webApp.themeParams;
        var data = webApp.initDataUnsafe;    
        //document.getElementById('list').innerHTML = JSON.stringify(data);
        //document.getElementById('list').innerHTML = JSON.stringify(style);
         webApp.ready();      
         document.querySelectorAll('#content').style.backgroundColor = style.bg_color;
         document.querySelectorAll('#content').style.color = style.text_color;
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