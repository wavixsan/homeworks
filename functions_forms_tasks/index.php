<?php
session_start();
if(!empty($_SESSION['go'])){$go=$_SESSION['go'];}
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
if(!empty($_GET['go'])){
	$_SESSION["go"]=$_GET['go'];//test .gitignore test2
	$m=explode('.',$_GET['go']);
	$file=file('home.php');
	$echo=false;
	foreach($file as $v){
		if(substr($v,0,3)=="<p>" and substr($v,3,strlen($m[0]))==$m[0]){$echo=true;}
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
?>
<!doctype html>
<html>
<head>
    <title>arrays_loops_tasks</title>
    <meta charset="utf-8">
<style>
.key{color:blue;cursor:pointer;border:solid blue 1px;padding:2px 4px; display:inline-block; margin:2px;}
.key:hover{background:#ffa;}
#xmlhr{padding:5px;background:#dfd;}
#xmlhr2{padding:5px;background:#ddf;}
#xmlhr2 p{padding:0;margin:0;}
#xmlhr3{background:#fdd; padding:5px;}
textarea{min-width:90%;min-height:200px;}
</style>
</head>
<body>
	<?php
	$dir=scandir(".");
	foreach($dir as $v){
		if(is_file($v) and (int)$v!=0){
			echo "<a class='key' onclick=keyXML('$v')>$v</a>";
		}
	}

	?>
	<a class="key" href="home.php">Home</a>
	<h3>Задание:</h3>
	<div id="xmlhr2"></div>
	<h3>Работа:</h3>
	<pre id="xmlhr3"></pre>
	  <h3>Результат:</h3>
   <div id="xmlhr"></div>
<script>
function keyXML(n){
	xmlhr(n,'xmlhr');
	xmlhr("?go="+n,'xmlhr2');
	xmlhr("?open="+n,'xmlhr3');
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
	if(!empty($go)){echo "<script>keyXML('$go');</script>";}
?>
</body>
</html>
<!-- index -->
