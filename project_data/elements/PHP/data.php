<?php // данный блок для формирования запросоd, основанных на пользовательского воода , функций обработки вне класса и меню основной навигации 
//функция, формирующая выпадающее меню блока выбора предмета чтения:
//создаем новый объект подключения:
//require 'elements.php';
$pdo = require '../../../project_data/SERVER/DB_connect.php';
//пишем запрос на выборку всех статей из БД:
$query = "SELECT id, title, topic, text, example, image, task FROM knows";
//формируем массив из результатов выборки, убираем дубли:
$result = $pdo->query($query,PDO::FETCH_ASSOC);
//создаём пустой массив, куда попадут наши статьи в виде объектов:      ВНИМАНИЕ!!! ПРИ ДОБАВЛЕНИИ НОВОГО НАПРАВЛЕНИЯ В БД, НЕОБХОДИМО СОЗДАТЬ НОВЫЙ СООТВЕТВУЮЩИЙ КЛАСС!!!
$articles = [];
//в цикле наполняем созданными объектами пустой массив $articles 
while ($row = $result->fetch()){
    $articles[] = new $row['title']($row);
    }
//создаём пустой массив для хранения уникальных заголовков:
$ar_title = [];
//в цикле наполняем созданными объектами пустой массив $artitles
foreach($articles as $title => $article){
$title = 'title';
$ar_title[] = $article->call_self();
}
//фильтруем полученный массив с заголовками, отсеивая неуникальные значения:
$arUniqueTitle = array_unique($ar_title);
//берем полученные массивы $articles и $ar_unique_title и передаём их json:
$arUniqueTitleJS = json_encode($arUniqueTitle);
//$articlesJS = json_encode($articles);
echo ($arUniqueTitleJS);
echo ($articlesJS);

//$new_data = json_encode($carsList);
//далее идем в файл app.js и стараемся тм поймать данные



?>
