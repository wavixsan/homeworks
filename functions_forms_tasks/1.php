<?php
function getCommonWords($a,$b){
    $arrA=explode(' ',$a);
    $arrB=explode(' ',$b);
    //var_dump(array_diff_ukey($arrA,$arrB));
}
if(!empty($_POST['textA']) and !empty($_POST['textB'])){
    getCommonWords($_POST['textA'],$POST['textB']);
    echo 'ok';
}
var_dump($_POST);
?>
<!doctype html>
<html>
<head>
    <title>Задание 1</title>
</head>
<body>

<form method="post">
    <textarea name="textA">Вычисляет расхождение </textarea>
    <textarea name="textB">Вычисляет расхождение </textarea>
    <input type="submit" value="Проверить">
</form>

</body>
</html>
