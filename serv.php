<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://telegram.org/js/telegram-web-app.js"></script>
    <title>SertSale</title>
    <style>
        .brand{
            font-family: "Playfair Display", Roboto, Helvetica, Arial, sans-serif;
            font-size: 2.5rem;
            font-weight: 900;
            letter-spacing: 0.03em;
            display: grid;
            justify-content: center;
            margin: 0 auto;
            width: 100%;
            height: 100px;
            color: white;
            background: black;
            min-width: 330px;
            align-items:center;
        } 
    </style>
</head>
<body>
    <div class="brand" style="backgroundColor: black;">SertSale_bot</div>
<?php

require_once __DIR__ . '/autoload.php';
$base = new BaseAPI;
$sample = $_POST['query'];
echo "<h2>Ваш запрос - <strong>$sample</strong></h2>";
echo "<br/>";



$sample = mb_strtolower($sample, 'UTF-8'); //Перевод в нижний регистр

$arrWordsQuery = getWordsFromString($sample); //Массив слов запроса
//var_dump($arrWordsQuery);


$trueSample = implode(" ", $arrWordsQuery); //Исправленый запрос.
//echo "<br/>";
//var_dump($trueSample);echo "<br/>";
$arrSample = array();
foreach ($arrWordsQuery as $word) {       //Берем только слова  диннее 3-х букв
    if (strlen($word) > 4 && $word != 'для') {
        $word_var = $word;
        if (strlen($word) > 12) {           //Отрезаем посленюю букву
            $word_var = substr($word, 0, -4);
        }
        if (strlen($word) > 8) {           //Отрезаем посленюю букву
            $word_var = substr($word, 0, -2);
        }
        $arrSample[] = $word_var;
    }
}


//var_dump($arrSample);
//echo "<br/>";
$col_words = count($arrSample);
$finded_list = array();
for ($i = 0; $i < $col_words; $i++) {

   // echo "Поиск - " . $arrSample[$i] . "<br/>";



    $products = $base->findProd($arrSample[$i]);

    foreach ($products as $product) {
        $was = 0;
        foreach ($finded_list as $present_prod) {
            if ($product->id == $present_prod->id) {
                $was = 1;
            }
        }
        if ($was == 0) {
            $finded_list[] = $product;
        }
    }
}


//echo "Поиск по найденным - " . $arrSample[$i] . "<br/>";


foreach ($finded_list as $product) {
    $product->count_words = 0;
    for ($i = 0; $i < $col_words; $i++) {
        if (strpos($product->name, $arrSample[$i]) > -1) {
            $product->count_words++;
        }
    }
}
//var_dump($finded_list);
//echo "<br/>";
$result = array();
$max_col = 0;
foreach ($finded_list as $product) {// Находим максимальное число совпадений
    if($product->count_words >= $max_col)
    {
        $max_col = $product->count_words;
       // $result[] = $product;
    }
}
foreach ($finded_list as $product) { //Собираем массив с максимальными совпадениями
    if($product->count_words == $max_col)
    {
        $result[] = $product;
    }
}
//echo "<br/><br/>";
//var_dump($result);
/*
          //включаем строгий режим
        $strict = 1;

        if (count($arrWordsQuery)>1)
        {       //если в запросе > 1-го слова отключаем строгость
            $strict = 0;
        }

        $arrname = getWordsFromString($product->name);
        $col_sovpad = 1;
        for($j = 0; $j < count($arrname); $j++ )
        {
            
            //for($s = 0; $s<$col_words; $s++)
            
                    // Если в образце содержится искомое слово 
                if((strpos($arrname[$j], $arrSample[$i]) > -1) || (strpos($arrSample[$i], $arrname[$j]) > -1))
                {   
                        $col_sovpad++;
                        echo $arrSample[$i] . " == " . $arrname[$j] . "<br/>";
                        
                }
            
        }
        //Если 
        if (count($arrname) == 1 )
        {
             $strict =0;
        }
        if($col_sovpad == $col_words && $strict == 0)
        {
            $finded_list[] = $product->id . ". " . $product->name . " - <strong>" . $product->doc_type . "</strong><br/>";
            $strict = 1;
        }
        
        echo "Количество совпадающих слов - " . $col_sovpad."<br/>";
        //echo $product->id . ". <text style=\"background-color: lightgray;\">" . $product->name . "</text> - " . $product->doc_type . "<br/>";
    }   
    }*/
if (count($result) > 0) {
    echo "<h3>Найдены варианты:</h3>";
    foreach ($result as $product) {
        echo $product->id . ". " . $product->name . " - <strong>" . $product->doc_type . "</strong><br/>";

        //echo $prod_str;
    }
} else {
    echo "<h3>Такого товара в оперативной базе не найдено!</h3>";
}
echo "<br/><button style=\"padding:10px; height: 40px;\" onclick=\"window.location.href='https://sertbot.shinny-mir.by/pages/find-product.php'\">Новый поиск</button>";




//~~~~~~  Вытягиваем слова из строки в массив ~~~~~~~
/**
 * @param $string
 * @return array
 */
function getWordsFromString($string)
{
    if (preg_match_all("/\b(\w+)\b/ui", $string, $matches)) {
        return $matches[1];
    }

    return array();
}
//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
function listProducts($base)
{
    $products = $base->getAllProducts();
    foreach ($products as $product) {
        echo $product->id . ". " . $product->name . " - " . $product->doc_type . "<br/>";
    }
}



//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
function csvToBase($base)
{
    if (($handle = fopen(__DIR__ . "/products.csv", "r")) !== FALSE) {
        while (($data = fgetcsv($handle, 2000, ",")) !== FALSE) {

            $base->addProduct($data[0], $data[1]);
            echo $data[0] . " - " . $data[1] . "<br/>";
        }
        fclose($handle);
    }
}
?>
 <script>
       var webApp = window.Telegram.WebApp;
       webApp.MainButton.show();/*
        var style = webApp.themeParams;
        var data = webApp.initDataUnsafe;    
        //document.getElementById('list').innerHTML = JSON.stringify(data);
        //document.getElementById('list').innerHTML = JSON.stringify(style);
        
         document.body.style.background = style.bg_color;
         document.body.style.color = style.text_color;
        document.querySelectorAll('button').style.backgroundColor = style.button_color;
       // document.button.style.backgroundColor = style.button_color;
       document.querySelectorAll('button').style.backgroundColor = style.button_text_color;
        //document.button.style.color = style.button_text_color;
        
        webApp.MainButton.setText('Написать эксперту');
        //webApp.MainButton.onClick(document.location.href='https://t.me/blrAlex');
        //webApp.showConfirm('Подтверждение');
       */
        webApp.onEvent('mainButtonClicked', function(){
	    webApp.sendData("some string that we need to send"); 
	//при клике на основную кнопку отправляем данные в строковом виде
});
 webApp.ready();
    </script>
</body>
</html>