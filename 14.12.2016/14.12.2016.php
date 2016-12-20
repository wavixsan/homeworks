<?php /*0000|*/

ini_set('display_errors',1);
error_reporting(E_ALL);

$arr_color=array("white","red","green","lime","blue","black");

if(isset($_POST['color'])){
	setcookie('color',$_POST['color'],time()+300);
	$color=$_POST['color'];
}else if(isset($_COOKIE['color'])){
	$color=$_COOKIE['color'];
}else{
	$color=$arr_color[0];
}

echo "<style>body{background:$color;}</style>";

?>

<form method="post">
	<select size="1" name="color">
		<?php foreach($arr_color as $v){
			if($color==$v){
				echo "<option selected>$v</option>";
			}else{
				echo "<option>$v</option>";
			}
		} ?>
	</select>
	<input type="submit">
</form>
