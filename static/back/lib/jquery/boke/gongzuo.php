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
        <a href="gongzuo.php"><div class="n1">分享</div></a>
        <a href="gongzuo.php"><div class="n1">笔记</div></a>
        <a href="gongzuo.php"><div class="n1">视频</div></a>
        <a href="gongzuo.php"><div class="n1">开放代码</div></a>
        <a href="gongzuo.php"><div class="n1">资讯</div></a>
       
    </div>
    <div>
        <div id="u">推荐文章</div>
        <div id="v">
           <a href="zhuan.php?id=0"><div class="o"><?php
                                                        if($_SESSION['wen']){
                                                            echo $_SESSION['wen'];
                                                        }else{
           
                                                        echo '<img src="5.jpg" alt="">';}
                                                        ?></div></a>
                <a href="zhuan.php?id=1"><div class="p"><?php echo $_SESSION['biaoti1']?></div></a>
                <a href="zhuan.php?id=2"><div class="p" id="x"><?php echo $_SESSION['biaoti2']?></div></a>
                <a href="zhuan.php?id=3"><div class="p" id="x"><?php echo $_SESSION['biaoti3']?></div></a>
        </div>
    </div>
    <div id="y">
        <div id="w">旅途分享</div>
        <div>
            <div class="q"><img src="1.1.jpg" alt=""></div>
            <div class="q" id="z"><img src="1.2.jpg" alt=""></div>
            <div class="q" id="z"><img src="1.3.jpg" alt=""></div>
            <div class="q" id="z"><img src="1.4.png" alt=""></div>
        </div>
        <div class="aa">讨论组</div>
        <div class="r"><span><?php echo $_SESSION['d'];?></span></div>
        <div class="r"><span><?php echo $_SESSION['c'];?></span></div>
        <div class="r"><span><?php echo $_SESSION['b'];?></span></div>
        <div class="r"><span><?php echo $_SESSION['a'];?></span></div>
    </div>
    <div id="bb">
        <div id="cc">
        <form action="fayan.php" method="POST">
            <table>
                <tr>
                    <td><textarea name="yan" id="dd" cols="40" rows="1"></textarea>  <button type="submit" id="ee">发表</button></td>
                </tr>
            </table>
        </form>
        </div>
    </div>

</body>
</html>