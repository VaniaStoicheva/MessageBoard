<?php
session_start();
$pageTitle="Вход";
include 'include/header.php';
$error=false;
if($_POST){
    $username=trim($_POST['username']);
    if(mb_strlen($username)<5){
        echo 'Невалидно име,името трябва да бъде с 5 или повече символи!';
        $error=true;
    }else{
    $username=  mysqli_real_escape_string($link,$username);
    }
    
    $pass=trim($_POST['pass']);
    if(mb_strlen($pass)<5){
        echo 'Невалидна парола,паролата трябва да бъде с 5 или повече символи!';
        $error=true;
    }else{
    $pass=  mysqli_real_escape_string($link,$pass);
    }
    if(!$error){
if(getUser($link, $username, $pass)){
        $_SESSION['isLoged']===true;
        $_SESSION['username']=$username;
        header('Location:messages.php');
        exit;
    }
    else{
        echo 'Невалидно име или парола!';
    }
    }
}

?>
<form method="post">
<div>
    <label>Име:</label>
    <input type="text" name="username"/></div>
<div><label>Парола:</label>
    <input type="password" name="pass"/></div>
    <div><input type="submit" value="Вход"/></div>
</form>
<div><a href="register.php">Нова регистрация</a></div>
<?php
include 'include/footer.php';
