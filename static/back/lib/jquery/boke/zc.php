<?php
session_start();
$get=$_POST;
if($get[password]!=$get[password1]){
    $_SESSION=0;
    echo '你输入的密码有误';
}
else{
unset($get[password1]);
include 'mysql.php';
conn(users);
insert(users,$get);
$_SESSION['name']=$get[name];
$_SESSION['jg']=1;
header('location:gongzuo.php');
}



