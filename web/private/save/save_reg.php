<?php
    if (isset(http_post_param['login'])) { $login = $_POST['login']; if ($login == '')} 
    if (isset(http_post_param['password'])) { $password=$_POST['password']; if ($password =='')}
    
 if (empty($login) or empty($password)) 
    {
    echo ("Заполнены не все поля!");
    }

    $login = trim($login);
    $password = trim($password);

    include ("bd.php"); 

    $result = mysql_query("SELECT id FROM users WHERE login='$login'",$db);
    $myrow = mysql_fetch_array($result);
    if (!empty($myrow['id'])) {
    echo ("Введённый вами логин уже зарегистрирован. Введите другой логин.");
    }

    $result2 = mysql_query ("INSERT INTO users (login,password) VALUES('$login','$password')");

    if ($result2=='TRUE')
    {
    echo "Вы успешно зарегистрированы!";
    }
 else {
    echo "Ошибка! Вы не зарегистрированы.";
    }
    ?>