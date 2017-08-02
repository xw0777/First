<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>教务管理系统</title>
	<meta name="keywords" content="">
	<meta name="content" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1">
    <link type="text/css" rel="stylesheet" href="/static/sign/css/login.css">
    <script type="text/javascript" src="/static/sign/js/jquery.min.js"></script>
</head>
<body class="login_bj" >
<div class="zhuce_body">
	<div class="logo"></div>
    <div class="zhuce_kong login_kuang">
    	<div class="zc">
        	<div class="bj_bai">
            <h3>登录</h3>
       	  	  <form action="" method="post">
                <input id="user" name="username" type="text" class="kuang_txt" onkeyup="keydown()" placeholder="手机号/邮箱/工号" value="<?php echo ($username); ?>">
                  <span id="name"></span>
                <input id="pass" name="password" type="text" class="kuang_txt" placeholder="密码" value="<?php echo ($password); ?>">
                  <div style="color: red"><?php echo ($error); ?></div>
                <div>
               		<a href="#">忘记密码？</a><input name="" type="checkbox" value="" checked><span>记住我</span> 
                </div>
                <input name="" type="submit" class="btn_zhuce" value="登录">
                
                </form>
            </div>
        	<div class="bj_right">
            	<p>使用以下账号直接登录</p>
                <a href="#" class="zhuce_qq">QQ注册</a>
                <a href="#" class="zhuce_wb">微博注册</a>
                <a href="#" class="zhuce_wx">微信注册</a>
                <p>已有账号？<a href="#">立即登录</a></p>
            
            </div>
        </div>
        <P></P>
    </div>
</div>
    <script>
//        function getuser() {
//            var user = document.getElementById('user').value;
//            var pass = document.getElementById('pass').value;
//            var data =[];
//            data['username'] = user;
//            data['password'] = pass;
//            var aj = new XMLHttpRequest();
//            aj.open('post','http://jw.com/index/admin/sign/sign_in',false);
//            aj.send(data);
//           var reda = aj.responseText;
//           console.log(reda);
//        }
//        function keydown() {
//            var name = document.getElementById('name');
//           var user = document.getElementById('user').value;
//           if(user.length == 9)
//           {
//               name.innerText = '√';
//           }
//           else
//           {
//               document.getElementById('name').innerText = 'X';
//           }
//        }



    </script>
</body>

</html>