<?php
$a=$_POST;
session_start();
include 'mysql.php';
$c=conn(fayan);
insert(fayan,$a);

$b=select('fayan','','','id desc','4');
$_SESSION['a']=$b[0][yan];
$_SESSION['b']=$b[1][yan];
$_SESSION['c']=$b[2][yan];
$_SESSION['d']=$b[3][yan];
$_SESSION['jg']=1;
// print_r($_SESSION[0]);
if($_SESSION['a']){
header('location:gongzuo.php');}
?>