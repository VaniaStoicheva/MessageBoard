<?php
session_start();
$pageTitle="Ново съобшение";
include 'include/header.php';
$error=false;

if($_POST){
    $title=trim($_POST['title']);
    if(mb_strlen($title)<1 || mb_strlen($title)>50){
        echo 'Заглавието трябва да е между 1 и 50 символа!';
        $error=true;
    }else{
        $title=  mysqli_real_escape_string($link,$title);
    }
   
    $text=trim($_POST['text']);
    if(mb_strlen($text)<1 || mb_strlen($text)>250){
        echo 'Съдържанието на съобщението трябва да е между 1 и 250 символа!';
        $error=true;
    }else{
        $text=  mysqli_real_escape_string($link,$text);
    }
    if(!$error){
    $group_id=(int)$_POST['groups'];
    $today=time("d.m.y"); 
    $username=$_SESSION['username'];
    if(insertNewMessage($link,$group_id,$today,$username,$title,$text)){
        header('Location:message.php');
        exit;
    }
}
}
?>

<form method="post" id="idmessage">
    <label>Заглавие:</label>
    <div><input type="text" name="title"/></div>
    
    <label>Група:</label>
    <div><select name="groups">
        <option value="0">Други</option>
        <?php
        foreach ($group as $key=>$value){
            if($_POST['groups']==$key){
                $selected='selected';
            }else{
                $selected='';
            }
          echo  '<option value='.$key.''.$selected.'>'.$value.'</option>';
        }
        ?>
        </select>
      </div>

    <label>Текст:</label>
    <div>
        <textarea rows="4" cols="50" name="text" form="idmessage"/>
        </textarea>
    </div>
     
    <input type="submit" value="Добави"/>
</form>

<div><a href="index.php">Начало</a></div>
<?php
include 'include/footer.php';

