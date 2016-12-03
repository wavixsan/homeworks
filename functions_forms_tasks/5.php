<?php
function scan($s,$dir='./'){
    $cont=scandir($dir);
    foreach($cont as $v){
        if(is_file($dir.$v) and $v==$s){
            echo "$v";
        }
    }
}

scan('homework.php','functions_forms_tasks/');