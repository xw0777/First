<?php 
session_start();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="gongzuo.css">
</head>
<body>
    <div id="l">
        <div class="m">WELCOME TO US</div>
        <a href="zhuche.php"><div class="i">注册</div></a>
        <a href="denglu.php"><div class="i">登录</div></a>
        <a href="shouye.html"><div class="i">HOME</div></a>
    </div>
    <div id="s">
        <a href="gongzuo.php"><div class="n">首页</div></a>
        <a href=""><div class="n1">分享</div></a>
        <a href=""><div class="n1">笔记</div></a>
        <a href=""><div class="n1">视频</div></a>
        <a href=""><div class="n1">开放代码</div></a>
        <a href=""><div class="n1">资讯</div></a>
    </div>
    <div id="ff">
        <form action="dl.php" method="POST">
            <table>
                <tr>
                    <td>账号</td>
                    <td><input type="text" name="name"></td>
                </tr>
                <tr>
                    <td>密码</td>
                    <td><input type="password" name="password"></td>
                </tr>
                <tr>
                    <td></td>
                    <td><button type="submit">登录</button></td>
                </tr>
            </table>
        </form>
    </div>
</body>
</html>
