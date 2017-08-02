<?php
include 'mysql.php';
$g=$_POST;
conn(wen);
insert(wen,$g);
header('location:shouye.html');