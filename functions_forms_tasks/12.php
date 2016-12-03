<?php
function revers($str){
    $arr=explode('.',$str);
    $arr=array_reverse($arr);
    if($arr[0]==''){unset($arr[0]); $arr[]='';}
    $str=implode('.',$arr);
    return $str;
}
$str='А Васька слушает да ест. А воз и ныне там. А вы друзья как ни садитесь, все в музыканты не годитесь. А король-то — голый. А ларчик просто открывался. А там хоть трава не расти.';
echo revers($str);