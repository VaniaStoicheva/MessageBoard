<?php
session_start();
$pageTitle="Регистрация";
include 'include/header.php';
$error=false;
if($_POST){
    $username=trim($_POST['username']);
    if(mb_strlen($username)<5){
        echo 'Невалидно име.Името трябва да е с дължина поне 5 символа!';
        $error=true;
    }else{
        $username=  mysqli_real_escape_string($link,$username);
    }
   if(usernameExist($link,$username)){
            echo 'Потребителското име вече е заето,изберете ново!';
            $error=true;
        }
    
    $pass=trim($_POST['pass']);
   if(mb_strlen($pass)<5){
      echo 'Невалидна парола.Парoлата трябва да е с дължина поне 5 символа!';
      $error=true;
    }else{
        $pass=  mysqli_real_escape_string($link,$pass);   
    }
    if(!$error){
        if(insertUser($link,$username, $pass)){
           $_SESSION['username']=$username;
            $_SESSION['isLoged']=true;
            header('Location:index.php');
            exit;
        }
   }
}
?>
<form method="post">
    <div><label>Име:</label>
        <input type="text" name='username'/></div>
    <div><label>Парола:</label>
        <input type='password' name="pass"/></div>
    <div><input type="submit" value="Регистрирай ме"/></div>
</form>

<div><a href="index.php">Начало</a></div>
    <?php
include 'include/footer.php';

