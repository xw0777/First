<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){
    print_r($_SERVER);
    }

    public function User()
    {
        print_r("werty");
}
}