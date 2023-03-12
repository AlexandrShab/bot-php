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
       <!--
        <form action="https://sertbot.shinny-mir.by/serv.php" method="post">
            <div style="display:grid; justify-content:center;">
                <input style="width:100%; 
                    height: 100%; font-size: 20px;" 
                    type="text" name="query" placeholder="Введите название товара"><br/><br/>
                <button id="btn" type="submit">Проверить</button>
            </div>
        </form>
       -->
       <div class="admin-menu">
            <div class="menu-item">
                <text>Пользователи бота</text>
            </div>
            <div class="menu-item">
                <text>Администраторы бота</text>
            </div>
            <div class="menu-item">
                <text>Запросы по поиску</text>
            </div>
            <div class="menu-item">
                <text>Акции и участники</text>
            </div>
            <div class="menu-item">
                <text>Редактор товаров базы</text>
            </div>
       </div>
        <div id="list">

        </div>
    </div>

    
</body>
</html>