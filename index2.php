<?php
class homework{
    public $view="home";

    function res($s){
        $_SESSION['view']=$this->view=$s;
        $this->view();
        exit;
    }

    function start(){
        session_start();
        if(isset($_GET['content'])){
            switch($_GET['content']){
                case 'home':
                    unset($_SESSION['homework']);
                    $this->res($_GET['content']);
                    break;
                //default:
            }
        }
        if(isset($_GET['homework'])){
            if(file_exists($_SESSION['homework'])){
                //$_SESSION['homework']=$_GET['homework'];
                $this->res('homework');
            }
            //$this->session();
        }
    }

    function session(){

    }//session

    function nav(){
        echo '<div id="nav"><b>/</b>';
        if($this->view=='home'){
            echo "<span>Home</span>";
        }else{
            echo "<a onclick=xml('?content=home','content')>Home</a>";
            echo "<b>/</b><span>".$this->view."</span>";
        }
        echo "</div>";
    }

    function view(){
        $this->nav();
        switch($this->view){
            case "home": $this->view_home(); break;
            case "homework": $this->homework(); break;
        }
    }

    function scan_homework(){
        $dir=scandir('.');
        $folder=array();
        $result=array();
        foreach($dir as $v){
            if(is_dir($v) and $v!='.' and $v!='..'){$folder[]=$v;}
            //if(is_file($v)){$file[]=$v;}
        }
        foreach($folder as $val){
            if(file_exists($val.'/homework.php')){
                $name="???";
                foreach(file($val.'/homework.php') as $v){
                    if(strpos($v,'<title>') and strpos($v,'</title>')){
                        $a=strpos($v,'<title>')+7;
                        $name=substr($v,$a,strpos($v,'</title>')-$a);
                        break;
                    }
                }
                $result[$name]=$val;
            }
        }
        return $result;
    }

    function view_home(){
        ?>
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
        <?php
        $arr=$this->scan_homework();
        foreach($arr as $k=>$v){
            echo "<a class='key' onclick=xml('?homework=$v','content')>$k</a>";
        }
    }

    function homework(){
        if(!empty($_SESSION['homework'])){
            $dir=scandir($_SESSION['homework']);
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

        }
    }

}//end class homework
$o=new homework;
$o->start();
?>
<!doctype html>
<html>
<head>
    <title>homework</title>
    <meta charset="utf-8">
    <style>
        body{
            margin:0;
        }
        #nav{
            background: #555;
            padding:5px;
            color:#ccc;
        }
        #nav span,#nav a{
            color:#fff;
            padding:0 5px;
            display:inline-block;
            background: #555;

        }
        #nav span{
            color:#ff6;
        }
        #nav a:hover{
            cursor:pointer;
            text-decoration:underline;
        }
        #nav a:active{
            color:#ff0;
        }
    </style>
</head>
<body>
<div id="nav">
    <b>/</b><a onclick="xml('?content=home','content');">Home</a><b>/</b><span>homework</span>
</div>
<div id="content">
    <!------->
</div><!--content-->
<script>
    function xml(n,id){
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
</body>
</html>
