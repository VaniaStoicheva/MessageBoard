<?php
session_start();
$pageTitle="Съобщения";
include 'include/header.php';
    ?>

<form method="post">
        <div><label>Сортиране на съобщенията по дата:</label>
        <select name="sort">
            <option value="asc">ASC</option>
            <option value="desc">DESC</option>
        </select>
        <input type="submit" value="Сортирай"/>


</div>
</form>
<form method="post">
<div>
       <label>Сортиране на съобщенията по група:</label>
        <select name="groups">
            <option value="0">Всички</option>
            <?php
            foreach($group as $key=>$value){
                if($_POST['groups']==$key){
                    $selected='selected';
                }else{
                    $selected='';
                }
                echo '<option value="'.$key.'"'.$selected.'>'.$value.'</option>';
                }
            ?>
        </select>
        <input type="submit" value="Филтрирай по група"/>
</div>
</form>
<?php
//all list
if(!isset($_POST['groups']) && !isset($_POST['sort'])){
  $where='ORDER BY date DESC';
     $listAllMessage=  listMessage($link,$where);
     printRezult($link, $listAllMessage);    
}
//select by group
if(isset($_POST['groups']) && ( $_POST['groups']!=='')){
    

    $selectedGroup=(int)($_POST['groups']);
    $where='WHERE group_id="'.$selectedGroup.'"';
    $listByGroup=  listMessage($link, $where);
    printRezult($link, $listByGroup);
    
}
//select by group=0
if(isset($_POST['groups']) && $_POST['groups']==='0'){
   $where='ORDER BY date DESC';
     $listAllMessage=  listMessage($link,$where);
     printRezult($link, $listAllMessage);     
}
    
  
//sort
if(isset($_POST['sort'])){
   $orderBY=''; 
    if(($_POST['sort']=='asc')){
        $orderBY='ORDER BY date ASC';
    }
   if($_POST['sort']=='desc'){
        $orderBY='ORDER BY date DESC';
    }
    $listSortMessage=  listMessage($link,$orderBY);
     printRezult($link, $listSortMessage);    
}


 ?>
 <div><a href="newMessage.php">Ново съобщение</a></div>
<div><a href="index.php">Начало</a></div>
<?php
include 'include/footer.php';




