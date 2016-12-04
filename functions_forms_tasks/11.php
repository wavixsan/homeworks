<?php
function abcrus($s,$o=false){$a="абвгдеёжзийклмнопрстуфхцчшщъыьэюя";
$A="АБВГДЕЁЖЗИЙКЛМНОПРСТУФХЦЧШЩЪЫЬЭЮЯ";if($o==true){$t=$a;$a=$A;$A=$t;}
$t="";for($i=0;$i<strlen($s);$i++){$p=true;for($j=0;$j<strlen($a);$j++){
if(substr($s,$i*2,2)==substr($A,$j*2,2)){$t.=substr($a,$j*2,2);$p=false;}}
if($p==true){$t.=substr($s,$i*2,2);}} return $t;
}/*abcrus() - Меняет регистр русских букв на нижний, а с true на верхний by WavixSan*/

$str='а васька слушает да ест. а воз и ныне там. а вы друзья как ни садитесь, все в музыканты не годитесь. а король-то — голый. а ларчик просто открывался. а там хоть трава не расти.';

$arr=explode('. ',$str);
//var_dump($arr);
$str=array();
foreach($arr as $v){
    $str[]=abcrus(substr($v,0,2),true).substr($v,2);
}
$str=implode('. ',$str);
echo "<b>Резуьтат:</b> $str";
