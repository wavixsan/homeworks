<?php
$num="345";

$num=(int)$num;
$sum=0;
$i=1;
$o=0;
while($num>=$i){
    $o++;
    $i*=10;
}
for($j=1;$j<=$o;$j++){
    $i/=10;
    $sum=(int)$sum+=$num/$i;
    $num=$num%$i;
    //echo "$sum | $num <br>";
}
echo $sum;
