<?php
require './project_data/elements/PHP/header.php';
echo '<style>
header{
    
    display: none !important;
}
*{
    background-color: aliceblue;
</style>';
require './project_data/elements/PHP/elements.php';//для запуска метода класса, нужно его создать и чем то наполнить!!!! В значения нового класса должен попасть только ассоциативный массив с именами ключей согласно БД!!!
users::is_first();






?>

<body>
    
</body>
</html>
<?php
echo 'Hello';
