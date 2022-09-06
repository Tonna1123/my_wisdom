<?php
require 'header.php';
require 'elements.php';
//require 'data.php';
//логика кнопок:
//блок перехода на страницу создания:
if( isset($_POST['action']) && $_POST['action'] === 'Создать' ){
    header('Location: create.php');
}elseif( isset($_POST['action']) && $_POST['action'] === 'Читать' ){
    header('Location: read.php');
}elseif( isset($_POST['action']) && $_POST['action'] === 'Редактировать' ){
    header('Location: update.php');
}elseif( isset($_POST['action']) && $_POST['action'] === 'Удалить' ){
    header('Location: update.php');
}



echo '<div class="main-container" id="main-container">'; // открывающий тег блока контент
//echo '<p></p>';
//d($arUniqueTitle);

//начало основного блока:
echo '<div class="leftmenu"><h2>Полезные ссылки:</h2>';//начало левого блока вывода
echo '<p>Пока что ссылки, заданные здесь, указаны вручную. В дальнейшем в БД будет создана 4 таблица, которая будет пополняться полезными ссылками и комментариями к ним</p>';
echo <<< _HTML_
<div class="backmenu-main">
   
    <a href="https://www.w3schools.com/">HTML</a><hr>
    <a href="https://developer.mozilla.org/ru/">Фронт</a><hr>
    <a href="https://www.php.net/manual/ru/intro-whatis.php">PHP</a><hr>
    <a href="https://htmlacademy.ru/tutorial/php/sql">SQL</a><hr>
    <a href="https://laravel.com/">LARAVEL</a><hr>
    <a href="https://ru.reactjs.org/">REACT</a><hr>
    <a href="https://git-scm.com/">GIT</a><hr>
    
    <div class="left-menu-select">
<form action="" method="POST">
    <input type="submit" action="add" value="Добавить ссылку">
    <input type="submit" action="update" value="Редактировать">
</form>
</div>
<h3>Полезные инструменты:</h3>
    <a href="https://imagecolorpicker.online/ru/">Определить код цвета по фото</a><hr>
    <a href="https://fonts.google.com/">Выбрать шрифт Google</a><hr>
    <a href="https://tinypng.com/">Редактировать картинку по весу и размерам</a><hr>
    <a href="https://unsplash.com/">Подобрать картинку</a><hr>

    <div class="left-menu-select">
<form action="" method="POST">
    <input type="submit" action="add" value="Добавить ссылку">
    <input type="submit" action="update" value="Редактировать">
</form>
</div>

</div>

_HTML_;

//выпадающее меню начало
//1. Запрашиваем из БД данные по статьям
//$pdo = require '../../../project_data/SERVER/DB_connect.php';
//$query = "SELECT id, title, topic, text, example, image, task FROM knows";
//$result = $pdo->query($query,PDO::FETCH_ASSOC);
//$articles = [];
//while ($row = $result->fetch()){
//$articles[] = new $row['title']($row);//наполняем объектами пустой массив $articles 
//} //запрос
//d($articles);

//echo '<select class="TITLE" name="TITLE" id="">';
//foreach($articles as $article){
    //echo '<option><span class="opt-ttl">'.($article->call_self()).'</span>'.'_________'.($article->topic).'</option>';
//}
//echo '</select>';//выпадающее меню конец
echo '</div>';//конец блока левого меню
echo '<div class="center"><h2>Быстрая навигация:</h2>'; //начало блока центрального вывода

echo '<div class="center-point-1">';//начало пункта 1 центрального блока
//начало анимации для пункта 1
echo <<< _HTML_

<div id="wrap" class="wrap">
<div class="cube">
<div id="cube" class="cube rotate-y">
<img src="../../images/html-image.png" alt="" class="face back">
<img src="../../images/css-image.png" alt="" class="face front">
<img src="../../images/js-image.png" alt="" class="face left">
<img src="../../images/php-image.png" alt="" class="face rght">
</div>
    </div>
</div>
<div class="JS-title" id="JS-title">
<p>Здесь будет выпадающее меню для выбора направления. Алгоритм: 1принимает на входе массив со всеми статьями из БД.2. Циклами возвращает 2 массива - art_obj_arr (массив объектов со всеми доступными статьями) и arr_title_arr(массив с парами уникальных (с помощью array_unique()) ключей-значений, где ключ=title, а значение - основное направление статьи)3. Далее данные подготавливаются для передачи на front с помощью json-encode 4.Далее JS примает подготовленный массив arr_title_arr и с помощью цикла формирует выпадающее меню, устанавливает на них слушатель событий для действия click. Данное действие приводит к 2 вещам: открываются все альтернативные варианты выбора направления И меняет его value на текст выбранного элемента. </p>
</div>
_HTML_;
echo '</div>'; //конец пункта 1 центрального блока



echo '<div class="center-point-1">';//начало пункта 2 центрального блока
//начало анимации для пункта 2
echo <<< _HTML_

<div id="wrap" class="wrap">
<div class="cube">
<div id="cube" class="cube rotate-y">
<p class="face back-2">f(x)</p>
<p class="face front-2">var</p>
<p class="face left-2">bool</p>
<p class="face rght-2">SQL</p>
</div>
    </div>
</div>
<div class="JS-topic" id="JS-topic">
<p>Здесь будет выпадающее меню для выбора темы. Данный блок принимает основной массив со статьями art_obj_arr, далее делает выборку через метод filter в цикле foreach, сранивая, чтобы ключ TITLE элемента массива соответствовал зачению VALUE из предыдущей формы. На выходе формирует выпадающий список с темами, с установленными слушателями событий, которые в два действия click раскрывают список и присваивают ему VALUE = тексту выбранного элемента.</p>
</div>
_HTML_;
echo '</div>'; //конец пункта 2 центрального блока

echo '<div class="center-point-1">';//начало пункта 3 центрального блока
//начало анимации для пункта 3
echo <<< _HTML_

<div id="wrap" class="wrap">
<div class="cube">
<div id="cube" class="cube rotate-y">
<img src="../../images/update-image.png" alt="" class="face back-2">
<img src="../../images/create-image.png" alt="" class="face front-2">
<img src="../../images/read-image.png" alt="" class="face left-2">
<img src="../../images/delete-image.png" alt="" class="face rght-2">
</div>
    </div>
</div>
<div>
<p>Здесь будут кнопки для выбора действия после выбора направления и темы. На каждую кнопку кроме создать, JS навешивает слушатель событий, который в блоке условий проверяет заполненность VALUE 2-х предыдущих блоков и передает их в POST вместе с действием, или выдает предупреждение о заполнении. </p>
</div>
_HTML_;
echo '</div>'; //конец пункта 3 центрального блока

echo '<h3>Здесь будет динамически составляемый JS заголовок c выбором действия по алгоритму: 1Яхочу<действие> статью по теме<выбранное направление>, тема: <выбранная тема из направления>Далее этот текст будет присаиваться динамический созданному новому классу VALUE объекта, откуда будет передан методом POST на соответвующую страницу в блок логики PHP </h3>';
echo <<< _HTML_
<div class="select-action">
<form action="" method="POST">
    <input type="submit" name="action"  value="Создать">
    <input type="submit" name="action" value="Читать">
    <input type="submit" name="action" value="Редактировать">
    <input type="submit" name="action" value="Удалить"> 
    </form>
</div>

_HTML_;
//кпопки выбора действия. ДОПОЛНИТЬ!!!!


  //  
//}



echo '</div>';//конец блока центрального меню
echo '<div class="rightmenu"><h2>Материал к освоению:</h2>';//начало правого блока вывода


echo <<< _HTML_
<div class="backmenu-main">
    <p>Пока что ссылки, указанные здесь, заданы вручную. В дальнейшем в БД будет создана 3-я таблица с опциями "добавить тему к изучению" и "записать пройденный материал в новую статью" , которая будет отправлять на страницу CREATE.php</p>
    <a href="https://laravel.com/">Фреймворк LARAVEL - бэк PHP</a><hr>
    <a href="https://ru.reactjs.org/">Фреймворк REACT - фронт JS</a><hr>
    <a href="https://git-scm.com/">Управление версиями</a>
    <div class="right-menu-select">
<form action="" method="POST">
    <input type="submit" value="Добавить материал">
    <input type="submit" value="Создать статью на тему:">
</form>
</div>

</div>

_HTML_;
echo '</div>';//конец блока правого меню



//конец основного блока


echo '</div>';//закрывающий тег блка контент

require 'footer.php';
?>
face back
face front
face left
face rght

var - bool - f(x) - SQL
