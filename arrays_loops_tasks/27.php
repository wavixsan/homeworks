<?php
$rows=5;
$cols=5;
$colors = array('red','yellow','blue','gray','maroon','brown','green');

echo "<table>";
for($i=1;$i<=$cols;$i++){
    echo "<tr>";
    for($j=1;$j<=$rows;$j++){
        $color=rand(0,count($colors)-1);
        $number=rand(1000,9999);
        echo "<td style='background: {$colors[$color]};'>$number</td>";
    }
    echo "</tr>";
}
echo "</table>";