<?php //данный файл содержит 2 основных объекта - $users и $form, а также функции обработки данных пользователя/вывода на экран
//объекты:
/***************************************************************************____USERS____***************************************************************************/
//1. users Описание: данный объект содержит 3 параметра:
//  id - номер пользователя в БД
//  login - имя пользователя в БД
//  password - пароль пользователя в бд
        //Данный объект содержит следующие методы:
        //users_first - форма регистрации при первой загрузке страницы.
        //users_new - форма для создания новой учетной записи пользователя
        //users_correct - форма для редактирования данных пользователя, введенных ранее
//Требования: данная форма должна загружаться первой и предоставлять доступ/уведомлять о несоответствии данных пользователя.
// Данная форма должна сохранять в БД пароль в зашифрованном виде и декодировать его при введенных повторных данных.
//1. Создаём новый класс
class users{//создаём основные свойства класса:
    public $id;
    public $login;
    public $password;
//создём конструктор, возвращающий массив из основных свойств класса:
function __construct($users_data){
$this->id = $users_data['id'];
$this->login = $users_data['login'];
$this->password = $users_data['password'];

}

//создаём метод, который выводит форму при первом посещении сайта:
public static function users_first(){
    
    echo <<< _HTML_
    <div class="user log-in">
    <h2>Вход: </h2>
    <form action="" class="first" method="POST">
        <label for="login"><span> Введите имя: </span></label>
        <input type="text" name="login" placeholder="Ваш логин"><br>
        <label for="password"><span> Введите пароль: </span></label>
        <input type="password" name="password" placeholder="Ваш пароль">
        <div class="actions">
        <input type="submit" name="action" value="Войти">
        <input type="submit" name="action" value="Зарегистрироваться">
        
        </div>
        
    </form>
    </div>
    _HTML_;
}
//создаём метод, который выводит форму создания нового пользователя:
public static function users_new(){
    echo <<< _HTML_
    <div class="user new">
    <h2>Создание новой учётной записи: </h2>
    <form action="" class="first" method="POST">
        <label for="login"><span> Введите имя: </span></label>
        <input type="text" name="login" placeholder="Ваш логин"><br>
        <label for="password"><span> Введите пароль: </span></label>
        <input type="password" name="password" placeholder="Ваш пароль">
        <div class="actions">
        <input type="submit" name="action" value="Создать">
        <input type="submit" name="action" value="Назад">
        <input type="submit" name="action" value="Изменить">
        </div>
        
    </form>
    </div>
    _HTML_;
}
//создаём метод, который выводит форму для изменения данных пользователя:
//примечание: учесть , что для изменения данных, перед загрузкой формы нужно запросить пароль
public static function users_correct(){
    echo <<< _HTML_
    <div class="user correct">
    <h2>Изменение данных учетной записи: </h2>
    <form action="" class="first" method="POST">
        <label for="login"><span> Изменить имя: </span></label>
        <input type="text" name="login" value="$_SESSION[login]"><br>
        <label for="password"><span> Изменить пароль: </span></label>
        <input type="password" name="password" value="$_SESSION[password]">
        <div class="actions">
        <input type="submit" name="action" value="Изменить">
        <input type="submit" name="action" value="Назад">
        <input type="submit" name="action" value="Удалить">
        
        </div>
        
    </form>
    </div>
    _HTML_;
}
public static function is_first(){//статичная функция класса для проверки первичного входа на страницу без создания нового экземпляра класса. Отвечает за логику учетных записей пользователя. 
//session_start();   
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        session_start();
        if( isset($_POST['action']) && $_POST['action'] === 'Зарегистрироваться' ){//если нажата кнопка зарегистрироваться
            users::add();}elseif( isset($_POST['action']) && $_POST['action'] === 'Войти' ){//если нажата кнопка войти
            users::verify();}elseif( isset($_POST['action']) && $_POST['action'] === 'Изменить' ){//если нажата кнопка изменить

            }
    }else{
        users::users_first();
        
    }
}
//статичная функция класса для создания нового пользователя:
public static function add(){
    //если нажата кнопка создать
        if(!empty($_POST['login']) && !empty($_POST['password'])){//проверяем, не пустые ли поля
            //если все ок, экранируем данные:
            $u_login = htmlspecialchars( trim( $_POST['login'] ) );
            $u_password = htmlspecialchars( trim( $_POST['password'] ) );
            //шифруем пароль методом b_crypt с солью по умлолчанию(10)
            $u_password = password_hash($u_password, PASSWORD_BCRYPT);
            //формируем объект подключения к БД:
            $pdo = require './project_data/SERVER/DB_connect.php';
            //формируем запрос на новую запись в БД:
            $query = "INSERT INTO users VALUES(?,?,?)";
            //подготавливаем запрос:
            $ins_query = $pdo->prepare($query);
            //выполняем запрос, передав ему данные нового пользователя:
            $ins_query->execute([null, $u_login, $u_password]);
            //возвращаем на стартовую страницу:
            header('Location: index.php');

        }else{
            echo 'Заполните все поля!';
        }
      

    
}
 //статичная функция класса для верификации:
 public static function verify(){
   //если нажата кнопка войти
//проверяем данные на пустоту:
if(!empty($_POST['login']) && !empty($_POST['password'])){//если данные пользователя не пустые:
    //если все ок, экранируем данные:
         $u_login = htmlspecialchars( trim( $_POST['login'] ) );
         $u_password = htmlspecialchars( trim( $_POST['password'] ) );
         //формируем объект подключения к БД:
         $pdo = require './project_data/SERVER/DB_connect.php';
         //формируем запрос к БД на наличие пользовательских данных .
         $query = "SELECT login, password FROM users WHERE login =?;";//подготавливаем запрос
         $ver_query = $pdo->prepare($query);
         $ver_query->execute([$u_login]);
         $user_data = $ver_query->fetch(PDO::FETCH_ASSOC);
         //Далее идет блок сравнения: Действие проводится в три этапа:1 запрос пары логин-пароль по значению логин 2 Если результат не пустой, то происходит сверка пароля пользователя. Если пустой - выводим сообщение о том, что пользователь не найден. 3. Если логин и пароль совпадают, то отправляем на главную страницу, если нет - указываем о том, что указаны неверные данные.
            if(!empty($user_data['login']) && !empty($user_data['password'])){//если массив не пустой
                if (password_verify($u_password, $user_data['password'])){//если пароль совпадает
                    $_SESSION['login'] = $user_data['login'];
                    $_SESSION['password'] = $user_data['password'];
                    header('Location:./project_data/elements/PHP/main.php');//отправляем на главную страницу
                }else{
                    
                    users::users_first();
                    echo 'Неверный пароль!!!!';
                }

            }else{
                users::users_first();
                echo 'Совпадение не найдено!! Проверьте имя пользователя!';//выводим ошибку о несовпадении имени
            }
}else{//если поле пустое
users::users_first();
echo "Заполните все поля!!!";
}
    
  } 
//статичная функция для изменения данных авторизованного пользователя:
public static function correct(){
//проверяем, зарегистрирован ли пользователь:
if(!empty($_SESSION['login']) && !empty($_SESSION['password']) ){//если данные пытается изменить зарегистрированный пользователь
        users::users_correct();//если да, то выводим форму редактирования

}else{
    users::users_first();
    
}
}
public static function get_all(){
    $pdo = require './project_data/SERVER/DB_connect.php';
        
}
}
//****************************************************************КОНЕЦ БЛОКА КЛАССА users**********************************************************************************/



/**************************************************************_____FORM_____**************************************************************************************************/
//2. form Описание: данный объект содержит 7 параметров:
//  id - номер статьи в БД
//  title - Заголовок статьи в БД
//  topic - Подзаголовок статьи в БД
//  text - текст статьи в БД
//  example - пример в статье из БД
//  image - ссылка на картинку-пример в БД
//  task -  задание по теме в БД
        //Данный объект содержит следующие методы:
        //form_new - добавить статью.
        //form_correct - редактировать статью
        //form_delete - удалить статью
//Требования: данная форма должна запускаться на подразделе редактирования элемента
// Данная форма должна сохранять в БД все заполненные данные и впоследствии отображать их по запросу.
// Данная форма должна предоставлять возможность редактирования выбранных статей.
// Данная форма должна предоставлять возможность добавления файлов.
//1. Создаём новый класс
class FORM{//создаём свойства класса:
    public $id;
    public $title;
    public $topic;
    public $text;
    public $example;
    public $image;
    public $task;
    //создаем конструктор класса:
    function __construct($article_list){//в наборе свойств формируем массив article_list
$this->id = $article_list['id'];
$this->title = $article_list['title'];
$this->topic = $article_list['topic'];
$this->text = $article_list['text'];
$this->example = $article_list['example'];
$this->image = $article_list['image'];
$this->task = $article_list['task'];
    }
    public function call_self(){//при вызове каждый объект класса возвращает свой заголовок:
        return  $this->title;

    }

    //создаём статичную функцию для формирования объекта подключения:
    //public static function start($arr){//принимает массив
       // $pdo = require 'DB_connect.php';
      //  $query = "SELECT id, title, topic, text, example, image, task FROM knows WHERE id=?;";
      //  $m_query = $pdo->prepare($query);
      //  $m_query->execute($arr);
      //  $data = $m_query->fetchALL(PDO::FETCH_ASSOC);
    //}
   //создаём метод для вывода пунктов выпадающего меню select:
   public function art_menu(){
    echo 'Test';
   }
public static function form_create(){//создаем статичную функцию для вывода формы создания новой статьи:
    echo <<< _HTML_
    <div class="form-create">
    <form action="" method=POST id="create" >
        <div>
            <label for="form-title">Направление:</label>
            <input type="text" name="form-title" placeholder="Выберите направление">
            <span class="iserror"></span>
        </div>
        <div>
            <label for="form-topic">Тема:</label>
            <input type="text" name="form-topic" placeholder="Выберите тему">
            <span class="iserror"></span>
        </div>
        <div>
            <label for="form-text">Текст:</label>
            <textarea  height="40" width="100" type="text" name="form-text" placeholder="Введите текст статьи" required form="create" ></textarea>
            <span class="iserror"></span>
        </div>
        <div>
            <label for="form-example">Пример:</label>
            <textarea type="text" name="form-example" placeholder="Приложите текст примера" required form="create"></textarea>
            <span class="iserror"></span>
        </div>
        <div>
            <label for="form-image">Картинка:</label>
            <input type="file" name="form-image" value="Выберите файл">
            <span class="iserror"></span>
        </div>
        <div>
            <label for="form-task">Задание:</label>
            <textarea type="text" name="form-task" placeholder="Введите условие задания и желаемый результат" required form="create"></textarea>
            <span class="iserror"></span>
        </div>
        <input type="submit" value="Создать статью">
    </form>
    </div>
    _HTML_;

}
}
//создаём дочерний класс HTML и указываем его методы:
class HTML extends FORM{
    
    public function print_head(){
        echo <<< _HTML_
        <div class="up HTML">
        <h2>$this->title</h2>
        <p><span>$this->id</span></p>
        <p><span>$this->title</span></p>
        <p><span>$this->topic</span></p>
        <p><span>$this->text</span></p>
        <p><span>$this->example</span></p>
        <p><span>$this->image</span></p>
        <p><span>$this->task</span></p>
        
        </div>
    
    
    
    
    
        _HTML_;
    }   
}




//создаём дочерний класс JS и указываем его методы:
class JS extends FORM{
    public function show_form(){//создаём ф-цию отображения тематической инфы класса:

    }
}



//создаём дочерний класс PHP и указываем его методы:
class PHP extends FORM{
    public function show_form(){//создаём ф-цию отображения тематической инфы класса:

    }
}

//создаём дочерний класс SQL и указываем его методы:
class SQL extends FORM{
    public function show_form(){//создаём ф-цию отображения тематической инфы класса:

    }
}

//создаём дочерний класс Common(раздел общие понятия) и указываем его методы:
class COMMON extends FORM{
    public function show_form(){//создаём ф-цию отображения тематической инфы класса:

    }
}
//создаём дочерний класс Marketing и указываем его методы:
class MARKETING extends FORM{
    public function show_form(){//создаём ф-цию отображения тематической инфы класса:

    }
}



?>















<?php

function d($arr){
    echo '<pre>';
    print_r ($arr);
    echo '</pre>';
}
?>
