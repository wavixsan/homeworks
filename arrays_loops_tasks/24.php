<?php
$num=442158755;
$num2=5;

$sum=0;
$i=1;
$o=0;
while($num>=$i){
    $o++;
    $i*=10;
}
for($j=1;$j<=$o;$j++){
    $i/=10;
    $a=($num-$num%$i)/$i;
    $num=$num%$i;
    if($a==$num2){$sum++;}
}
echo $sum;
