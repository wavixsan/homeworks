<?php
echo "<table style='background:#000;'>";
for($i=1; $i<=10; $i++){
	echo "<tr>";
	for($j=1; $j<=10; $j++){
		echo "<td style='background:#fff;padding:3px;'>".$i*$j."</td>";
	}
	echo "</tr>";
}
echo "</tr></table>";
