<?php
/**
 * Created by PhpStorm.
 * User: w
 * Date: 2017/7/24
 * Time: 下午4:03
 */
namespace Home\Controller;
class UserController extends \Think\Controller
{
    public function _empty()
    {
     $this->f();
    }
    public function User()
    {
        print_r($_SERVER);
    }
    protected $tableName = 'categories';
    public function mod()
    {
        echo U('Index/user');
        echo '<br>';
        $f=D('User');
        print_r($f->find());
    }

    public function time()
    {
        $this->show();
    }

    public function see()
    {
        $name=array('xiaojiang'=>'姜','xiaoluo'=>'罗');
        $this->assign($name);
        //print_r(T('public/see'));
        $this->display();
    }

    public function data()
    {
        //$s=M('log');
       // print_r($s->select());
        $this->error('chucuola','/User/see',5);

    }

    protected function f()
    {
        print_r(568888);
    }
}
