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
        <h1 class="main-title">Поиск товара</h1>
        <form action="https://sertbot.shinny-mir.by/serv.php" method="post">
            <div style="display:grid; justify-content:center;">
                <input style="width:100%; 
                    height: 100%; font-size: 20px;" 
                    type="text" name="query" placeholder="Введите название товара"><br/><br/>
                <button id="btn" type="submit">Проверить</button>
            </div>
        </form>
        <div id="list">

        </div>
    </div>

    <script>
        var webApp = window.Telegram.WebApp;
        //webApp.BackButton.show();
        var styles = webApp.themeParams;
        var data = webApp.initDataUnsafe;
        webApp.MainButton.show();
        
        
        webApp.MainButton.setText('Написать эксперту');
         webApp.MainButton.color = styles.button_color;//"#ffaaff";
        webApp.MainButton.textColor = styles.button_text_color;//"#168acd";
        /**/
        //webApp.MainButton.onClick(document.location.href='https://t.me/blrAlex');
        //webApp.showConfirm('Подтверждение'); 
           
        //document.getElementById('list').innerHTML = JSON.stringify(data);
        //document.getElementById('list').innerHTML = JSON.stringify(style);
         document.getElementById('content').style.backgroundColor = styles.bg_color;
         document.getElementById('content').style.color = styles.text_color;
         document.getElementById('btn').style.backgroundColor = styles.bg_color;
         document.getElementById('btn').style.color = styles.text_color;
            
         webApp.onEvent('mainButtonClicked', function(){
	            webApp.sendData("some string that we need to send"); 
	        //при клике на основную кнопку отправляем данные в строковом виде
            });
        
       
        
        webApp.ready();   
        //webApp.onEvent('mainButtonClicked', webApp.showAlert('Main Button Pressed!'));
       /*  const styles ={"bg_color":"#ffffff",
                "button_color":"#40a7e3",
                "button_text_color":"#ffffff",
                "hint_color":"#999999",
                "link_color":"#168acd",
                "secondary_bg_color":"#f1f1f1",
                "text_color":"#000000"};
            const appData =    {"query_id":"AAEauLg5AAAAABq4uDmPIyie",
                            "user":{"id":968407066,
                                "first_name":"Alex",
                                "last_name":"🎗",
                                "username":"BlrAlex",
                                "language_code":"ru",
                                "is_premium":true},
                            "auth_date":"1678476891",
                            "hash":"f4dd11e37760871ba8773979860514647e427080b559d83cc029488139e81c08"};*/
    </script>
</body>
</html>