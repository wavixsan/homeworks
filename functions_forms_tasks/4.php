<?php
function scan_dir($dir='.'){
    echo "<b>$dir :</b>";
    $cont=scandir($dir);
    foreach($cont as $v){
        if(is_file($dir.$v)){echo "<br>$v";}
    }
}

scan_dir('functions_forms_tasks/');