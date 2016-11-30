<?php
$arr=array();
for($i=1;$i<=10;$i++){
    $arr[]=rand(1,10);
}
var_dump($arr);
$max=0; $min=0;
foreach($arr as $k=>$v){
    if($v>$arr[$max]){$max=$k;}
    if($v<$arr[$min]){$min=$k;}
}
$i=$arr[$min];
$arr[$min]=$arr[$max];
$arr[$max]=$i;
var_dump($arr);