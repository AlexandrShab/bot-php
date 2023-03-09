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
        var themeParams = webApp.themeParams;
        window.getElementById('list').innerHTML = JSON.stringify(themeParams);
              webApp.ready();
            
    </script>
</body>
</html>