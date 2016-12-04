<?php

function abcrus($s,$o=false){
    $a="абвгдеёжзийклмнопрстуфхцчшщъыьэюя";
    $A="АБВГДЕЁЖЗИЙКЛМНОПРСТУФХЦЧШЩЪЫЬЭЮЯ";
    if($o==true){
        $t=$a;
        $a=$A;
        $A=$t;
    }
    $t="";
    for($i=0;$i<strlen($s);$i++){
        $p=true;
        for($j=0;$j<strlen($a);$j++){
            if(substr($s,$i*2,2)==substr($A,$j*2,2)){
                $t.=substr($a,$j*2,2);
                $p=false;
            }
        }
        if($p==true){
            $t.=substr($s,$i*2,2);
        }
    }
    return $t;
}/*abcrus() - Меняет регистр русских букв на нижний, а с true на верхний by WavixSan*/

function fun($str,$sim){
    $t='';
    $arr=explode(' ',$sim);
    //var_dump($arr);
    for($i=0;$i<strlen($str);$i++){
        $z=true;
        foreach($arr as $v){
            if (substr($str,$i,1)==$v){$z=false;}
        }
        if($z==true){$t.=substr($str,$i,1);}
    }
    $arr=explode(' ',$t);
    $mas=array();
    foreach($arr as $v){
        $z=true;
        $v=abcrus($v,true);
        foreach($mas as $k=>$val){
            if($k==$v){$z=false; $mas[$k]++;}
        }
        if($z==true){$mas[$v]=1;}
    }
    $arr=array();
    echo "<b>Результат:</b><br>";
    foreach($mas as $k=>$v){
        echo "$k - $v<br>";
        $arr[]=$k;
    }
    echo '<textarea rows="6" cols="40">'.implode(', ',$arr).'</textarea><hr>';
}

if(isset($_POST['sim'])){
    $sim=$_POST['sim'];
}else{$sim=". ,";}
if(isset($_POST['text10'])){
    $str=$_POST['text10'];
    fun(trim($str),trim($sim));
}else{$str='';}
?>
<form method="post">
    <textarea name="text10" rows="6" cols="40"><?php echo $str; ?></textarea><br>
    Исключать символы - вводить через пробел:<br>
    <input name="sim" value="<?php echo $sim; ?>"><br>
    <input type="submit" value="Посчитать">
</form>
