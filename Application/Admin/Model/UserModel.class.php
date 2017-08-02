<?php
/**
 * Created by PhpStorm.
 * User: w
 * Date: 2017/8/1
 * Time: 下午7:10
 **/
namespace admin\model;

use Think\Model;

class UserModel extends Model
{
    public function get($key,$value)
    {
       return $this->where([$key=>$value])->find();
    }

}