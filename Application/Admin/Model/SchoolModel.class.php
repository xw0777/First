<?php
/**
 * Created by PhpStorm.
 * User: w
 * Date: 2017/7/31
 * Time: 上午11:25
 */
namespace  admin\model;

//use Think\Model\RelationModel;
//
//class schoolModel extends RelationModel
//{
//    protected $_link=[
//        'a'=>[
//            'mapping_type' =>self::BELONGS_TO ,
//            'class_name' => 'region',
//            'foreign_key' =>'region'
//        ],
//    ];
//
//}
use Think\Model\ViewModel;

class schoolModel extends ViewModel
{
    protected $viewFields = [
        'school' => ['id'=>'dd','name','contact','contacts','address','region'],
        'region' => ['id','name'=>'area','pid','path','_on'=>'school.region=region.id']
    ];
}