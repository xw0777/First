<?php
session_start();
$a=$_GET;
include 'mysql.php';
conn(wen);
$b=select(wen,'','','id desc',$a[id]);
$c=select(wen,'','','id desc',3);
$_SESSION['wen']=$b[$a[id]-1][wen];
$_SESSION['biaoti1']=$c[0][biaoti];
$_SESSION['biaoti2']=$c[1][biaoti];
$_SESSION['biaoti3']=$c[2][biaoti];
$_SESSION['jg']=1;
header('location:'.$_SERVER["HTTP_REFERER"]);?>