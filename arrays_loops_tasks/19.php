<?php
$arr=array("Понедельник","Вторник","Среда","Четверг","Пятница","Субота","Воскресенье");
$day="Вторник";
foreach($arr as $v){
    if($v==$day){
        echo "<i>$v</i><br>";
    }else{
        echo "$v<br>";
    }
}