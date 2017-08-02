<?php
/**
 * Created by PhpStorm.
 * User: w
 * Date: 2017/7/31
 * Time: 下午1:30
 */
namespace admin\model;
use Think\Model\RelationModel;

class regionModel extends RelationModel
{
    protected $_link=[
        'a'=>[
            'mapping_type' =>self::HAS_MANY ,
            'class_name' => 'school',
            'foreign_key' =>'region'
        ],
    ];
}