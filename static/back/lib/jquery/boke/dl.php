<?php
session_start();
$g=$_POST;
include 'mysql.php';
conn(users);
$j=select(users,[name=>$g[name],password=>$g[password]]);
if($j){
$_SESSION['name']=$g[name];
$_SESSION['jg']=1;
header('location:gongzuo.php');
}
else{
    echo '你输入的账号或密码有误';
    $_SESSION=0;
}