<?php 
require_once('./connect_to_db.php');


// $_POST["login"] = '';
// $_POST["password"] = '';
// $login = $_POST["login"];
// $password = $_POST["password"];



if (isset($_POST["login"])) { 
    $login = $_POST["login"]; 
    if ($login == '') { 
        unset($login);} } //заносим введенный пользователем логин в переменную $login, если он пустой, то уничтожаем переменную
if (isset($_POST["password"])) { 
        $password = $_POST["password"]; 
        if ($password =='') { 
            unset($password);} }

var_dump($login, $password);

    //заносим введенный пользователем пароль в переменную $password, если он пустой, то уничтожаем переменную
 if (empty($login) or empty($password)) //если пользователь не ввел логин или пароль, то выдаем ошибку и останавливаем скрипт
    {
    exit ("Вы ввели не всю информацию, вернитесь назад и заполните все поля!");
    }
    //если логин и пароль введены, то обрабатываем их, чтобы теги и скрипты не работали, мало ли что люди могут ввести
    $login = stripslashes($login);
    $login = htmlspecialchars($login);
    $password = stripslashes($password);
    $password = htmlspecialchars($password);
 //удаляем лишние пробелы
    $login = trim($login);
    $password = trim($password);
 // подключаемся к базе

    $sql_select = "SELECT id FROM users WHERE login='$login'";


    $result_select = $mysqli->query($sql_select);

    var_dump($sql_select);

    // $result = mysqli_query("SELECT id FROM users WHERE login='$login'",$db_server);
    $myrow = mysqli_fetch_array($result_select);
    if (!empty($myrow['id'])) {
    exit ("Извините, введённый вами логин уже зарегистрирован. Введите другой логин.");
    }
 // если такого нет, то сохраняем данные
    $sql_insert = "INSERT INTO users (login, password) VALUES('$login','$password')";

    $result_insert = $mysqli->query($sql_insert);

    var_dump($result_insert);
    // Проверяем, есть ли ошибки
    if ($result_insert == true)
    {
    echo "Вы успешно зарегистрированы! Теперь вы можете зайти на сайт. <a href='index.php'>Главная страница</a>";
    }
 else {
    echo "Ошибка! Вы не зарегистрированы.";
    }
?>