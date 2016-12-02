<?php
function getCommonWords($a,$b){
    $arrA=explode(' ',$a);
    $arrB=explode(' ',$b);
    $arr=array();
    foreach($arrA as $v){
        if(in_array($v,$arrB)){$arr[]=$v;}
    }
    echo "<b>Результат: </b>";
    if(count($arr)!=0){
        foreach($arr as $v){echo "$v, ";}
    }else{echo 'null';}
}
$a=''; $b='';
if(!empty($_POST['textA']) and !empty($_POST['textB'])){
    $a=$_POST['textA'];
    $b=$_POST['textB'];
    getCommonWords(trim($_POST['textA']),trim($_POST['textB']));
    echo "<hr>";
}
?>
<form method="POST">
    <textarea name="textA" rows="7" cols="50"><?php echo $a; ?></textarea>
    <textarea name="textB" rows="7" cols="50"><?php echo $b; ?></textarea>
    <input type="submit" value="Проверить">
</form>

