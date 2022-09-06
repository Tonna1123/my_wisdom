<?php
session_start();
if (!isset($_SESSION['login'])){
    $_SESSION['login'] = 'unreg';
    
} 
echo <<< _HTML_
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
        <title>My_wisdom</title>
       <link rel="stylesheet" href="/project_data/elements/styles/style.css">
       <script defer src="/project_data/elements/JS/app.js"></script>
       
</head>
<body>
<header>
        <div class="nav">
            <nav>
                <a href="main.php">Главная</a>
                <a href="create.php">Создать статью</a>
                <a href="read.php">Читать случайную</a>
                <a href="exit.php">Выйти</a>
            </nav>
        </div>
        <div class="user-id">
        
            <p>Имя пользователя: <span>$_SESSION[login]</span></p><hr>
            <div>
            <a href="">Изменить>>></a>
            <a href="">Выйти>>></a>
            </div>
        </div>
    </header>
_HTML_;



?>
