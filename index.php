<?php
session_start();
if(count($_POST)!=0){$_SESSION['post']=$_POST;}
if(!empty($_GET['view'])){
    if(!empty($_SESSION['post'])){$_POST=$_SESSION['post'];}
    $file=$_GET['view'];
    if(file_exists($file)){include($file);}
    exit;
}

if(!empty($_GET['key'])){
    switch($_GET['key']){
        case 'home':
            unset($_SESSION['work']);
            unset($_SESSION['go']);
            break;
    }
}
if(!empty($_SESSION['go']) and !empty($_SESSION['work'])){
    if(file_exists($_SESSION['work'].'/'.$_SESSION['go'].'.php')){
        $go=$_SESSION['go'];
    }

}
if(!empty($_GET['open'])){
    $file=file($_GET['open']);
    $text="";
    foreach ($file as $v){
        for($i=0;$i<strlen($v);$i++){
            switch (substr($v,$i,1)){
                case "<": $text.="&lt;"; break;
                case ">": $text.="&gt;"; break;
                case '"': $text.="&quot;"; break;
                default: $text.=substr($v,$i,1);
            }
        }
    }
    echo $text;
    exit;
}
if(!empty($_GET['go']) and !empty($_SESSION['work'])){
    $_SESSION["go"]=$_GET['go'];
    $m=$_GET['go'];
    $file=file($_SESSION['work'].'/homework.php');
    $echo=false;
    foreach($file as $v){
        if(substr($v,0,3)=="<p>" and substr($v,3,strlen($m))==$m){$echo=true;}
        if($echo==true){
            echo $v;
            for($i=0;$i<strlen($v);$i++){
                if(substr($v,$i,4)=="</p>"){$echo=false; break;}
            }
            if($echo==false){break;}
        }
    }
    exit;
}
if(!empty($_GET['work'])){
    $_SESSION['work']=$_GET['work'];
    $dir=scandir($_GET['work']);
    natsort($dir);
    foreach($dir as $v){
        $n=explode('.',$v); $n=$n[0];
        $v=$_GET['work'].'/'.$v;
        if(is_file($v) and (int)$n!=0){
            echo "<a class='key' onclick=keyXML('$v','$n')>$n</a>";
        }
        if(is_dir($v) and (int)$n!=0 and file_exists($v.'/index.php')){
            $v=$v.'/index.php';
            echo "<a class='key' onclick=keyXML('$v','$n')>$n</a>";
        }
    }
    echo "<a class='key' style='color:#f00;' onclick=key('key','home')>Home</a>";
    echo "<a class='key' style='color:#f00;' target='_blank' href='{$_GET['work']}/homework.php'>homework</a>";
    echo <<<NEC
<style>
    #xmlhr{padding:5px;background:#dfd;}
    #xmlhr2{padding:5px;background:#ddf;}
    #xmlhr2 p{padding:0;margin:0;}
    #xmlhr3{background:#fdd; padding:5px;}
</style>
<h3>Задание:</h3>
<div id="xmlhr2"></div>
<h3>Работа:</h3>
<pre id="xmlhr3"></pre>
  <h3>Результат:</h3>
<div id="xmlhr"></div>
NEC;
    exit;
}
?>
<!doctype html>
<html>
<head>
    <title>Homework</title>
    <meta charset="utf-8">
<style>
    .key{
        color:blue;
        cursor:pointer;
        border:solid blue 1px;
        padding:2px 4px;
        display:inline-block;
        margin:2px;
        text-decoration:none;
    }
    .key:hover{background:#ffffaa;}
</style>
</head>
<body>
<div id="content">
<h3>Задания:</h3>
<?php
$dir=scandir('.');
$folder=array();
foreach($dir as $v){
    if(is_dir($v) and $v!='.' and $v!='..'){$folder[]=$v;}
    if(is_file($v)){$file[]=$v;}
}
foreach($folder as $val){
    if(file_exists($val.'/homework.php')){
        $c=file($val.'/homework.php');
        $name="???";
        foreach($c as $v){
            if(strpos($v,'<title>') and strpos($v,'</title>')){
                $a=strpos($v,'<title>')+7;
                $name=substr($v,$a,strpos($v,'</title>')-$a);
                break;
            }
        }
        echo "<a class='key' onclick=key('work','$val')>$name</a>";
    }
}
?>
</div><!-- content -->
<script>
    function key(g,n){
        xmlhr('?'+g+'='+n,'content');
    }
    function keyXML(s,n){
        xmlhr("?go="+n,'xmlhr2');
        xmlhr("?open="+s,'xmlhr3');
        xmlhr('?view='+ s,'xmlhr');
    }
    function xmlhr(n,id){
        var xmlhttp;
        if(window.XMLHttpRequest){
            xmlhttp=new XMLHttpRequest();
        }else{
            xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange=function(){
            if(xmlhttp.readyState==4 && xmlhttp.status==200){
                document.getElementById(id).innerHTML=xmlhttp.responseText;
            }
        };
        xmlhttp.open("GET",n,true);
        xmlhttp.send(null);
    }
</script>
<?php
if(!empty($_SESSION['work'])){
    echo "<script>key('work','{$_SESSION['work']}')</script>";
    if(!empty($go)){
        $s=$_SESSION['work'].'/'.$go.'.php';
        echo "<script>setTimeout(function() { keyXML('$s','$go'); }, 1000);</script>";
    }
}
?>
</body>
</html>
