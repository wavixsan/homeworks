<?php
function fun($str){
    $t='';
    for($i=strlen($str)-1;$i>=0;$i--){
        $t.=substr($str,$i,1);
    }
    echo "<b>Результат:</b> ".$t;
}

if(isset($_POST['text9'])){
    $text=$_POST['text9'];
    fun(trim($text));
}else{$text='';}
?>
<form method="post">
    <input name="text9" value="<?php echo $text; ?>">
    <input type="submit" value="Зделать">
</form>
