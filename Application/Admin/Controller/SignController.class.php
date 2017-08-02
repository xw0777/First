<?php
/**
 * Created by PhpStorm.
 * User: w
 * Date: 2017/7/31
 * Time: 下午8:36
 */
namespace admin\controller;
use Think\Controller;

class SignController extends Controller
{
    public function sign_in()
    {
        if (IS_POST)
        {
            $user = I('post.username');
            $passwd = I('post.password');
            $verify = I('post.verify');
            $v = new \Think\verify();
            if(!$v->check($verify))
            {
                $this->error('登录失败',U('sign_in'));
            }
            if(empty($user) || empty($passwd))
            {
                $this->display();
            }
            if (id_card_available($user))
            {
                $this->check_pass($user,$passwd,'id_number');
            }
            preg_match('/^([0-9A-Za-z\\-_\\.]+)@([0-9a-z]+\\.[a-z]{2,3}(\\.[a-z]{2})?)$/i',$user,$match);
            if($match)
            {
                $this->check_pass($user,$passwd,'email');
            }
            preg_match('/^1[3,5,7,8]\d{9}$/',$user,$match);
            if($match)
            {
                $this->check_pass($user,$passwd,'mobile');
            }
            if (strlen($user) == 9) {
                $this->check_pass($user, $passwd, 'number');
            }
            $this->error('登录失败1');
        }
        else
        {
            $this->display();

        }
    }

    public function check_pass($user,$pass,$type)
    {

        $userinfo = D('user')->get($type,$user);
        if(empty($userinfo))
        {
            $this->error('用户名或密码有误');
        }
        if (password_verify($pass,$userinfo['passwd']))
        {
            if ($userinfo['status'] == 1)
            {
                $this->error('该用户已被限制登录',U('sign_in'));
            }

           //$this->success($user,U('sign_in'));
        }
        else
        {
            $this->error('登录失败',U('sign_in'));
        }
    }

    public function verify()
    {
        $Verify = new \Think\Verify();
        $Verify->entry();
    }








}