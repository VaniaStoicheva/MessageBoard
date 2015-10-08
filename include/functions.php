<?php
$link=  mysqli_connect("localhost","root","");
if($link===false){
    echo "Error connecting to MYSQ Server";
    exit;
}
 if(mysqli_select_db($link,"message")===false){
     echo "No connected to db".  mysqli_error($link);
     exit;
}
mysqli_set_charset($link, 'utf8');
mb_internal_encoding('UTF-8');
date_default_timezone_set('UTC');

$group=array(
    1=>'дрехи',
    2=>'обувки',
    3=>'мебели',
    4=>'за дома'
);
function getUser($link,$username,$pass){
    $q=  mysqli_query($link,
            'SELECT username,pass FROM users '
            . 'WHERE (username="'.$username.'" AND pass="'.$pass.'")');
    if(mysqli_error($link)){
        return false;
    }
    if(mysqli_num_rows($q)>0){
        return true;
        
    }
}
function usernameExist($link,$username){
    $q=  mysqli_query($link,
            'SELECT username FROM users WHERE username="'.$username.'"');
    if(mysqli_error($link)){
        return false;
    }
    if(mysqli_num_rows($q)>0){
        return true;
        
    }
}
function insertUser($link,$username,$pass){
    $q=  mysqli_query($link,
            'INSERT  INTO users (username,pass) VALUE ("'.$username.'","'.$pass.'")');
    if(mysqli_error($link)){
        echo 'error';
        echo mysqli_error($link);
        exit;
    }
    
        return true;

}
function insertNewMessage($link,$group_id,$date,$username,$title,$text){
    $q=  mysqli_query($link,
   'INSERT INTO messages (group_id,date,username,title,text) VALUE ("'.$group_id.'","'.$date.'","'.$username.'","'.$title.'","'.$text.'")');
    if(mysqli_error($link)){
        echo 'грешка';
        echo mysqli_error($link);
        exit;
    }
    else{
        return true;
    }
}
function listMessage($link,$where){
    $q=  mysqli_query($link,
            'SELECT date,username,title,text FROM messages '.$where);
    if(mysqli_error($link)){
        echo mysqli_error($link);
    }
   $rezult=array();
   while($row=  mysqli_fetch_assoc($q)){
       $rezult[]=$row;
   }
   return $rezult;
}
function printRezult($link,$rezult){
    foreach ($rezult as $row){
      echo '<div>'.$row['date'].','.$row['username'].','.$row['title'].'<br/>'
                  . '<textarea row="4" cols="100%">'.$row['text'].'</textarea>'.'<br/>'.'</div>';
      }
}