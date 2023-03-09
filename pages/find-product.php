<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://telegram.org/js/telegram-web-app.js"></script>
    <title>SertSale</title>
</head>
<body>
    <h1>Поиск товара</h1>
    <form action="https://sertbot.shinny-mir.by/serv.php" method="post">
        <input type="text" name="query" placeholder="Введите название товара">
        <button type="submit">Проверить</button>
    </form>
    <div id="list">

    </div>
    <script>
        var webApp = window.Telegram.WebApp;
        var style = webApp.themeParams;
        //document.getElementById('list').innerHTML = JSON.stringify(themeParams);
              webApp.ready();
         const style ={"bg_color":"#ffffff",
                "button_color":"#40a7e3",
                "button_text_color":"#ffffff",
                "hint_color":"#999999",
                "link_color":"#168acd",
                "secondary_bg_color":"#f1f1f1",
                "text_color":"#000000"};
    </script>
</body>
</html>