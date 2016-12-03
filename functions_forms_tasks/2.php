<?php
function top($arr){
    $res=array(1=>3,2=>2,3=>1);
    foreach($arr as $v){
        if(strlen($res[1])<=strlen($v)){
            $res[3]=$res[2];
            $res[2]=$res[1];
            $res[1]=$v;
        }else if(strlen($res[2])<=strlen($v)){
            $res[3]=$res[2];
            $res[2]=$v;
        }else if(strlen($res[3])<=strlen($v)){
            $res[3]=$v;
        }
    }
    echo "<b>ТОП длинных слов:</b>";
    foreach($res as $k=>$v){
        echo "<br>$k) $v = ".strlen($v)." симв.";
    }
    //var_dump($res);
}
$text='';
if(!empty($_POST['text'])){
    $text=$_POST['text'];
    top(explode(' ',trim($_POST['text'])));
}
?>

<form method="post">
    <textarea name="text" cols="40" rows="6"><?php echo $text; ?></textarea>
    <input type="submit">
</form>
