<?php
/**
 * Created by PhpStorm.
 * User: w
 * Date: 2017/7/25
 * Time: 下午5:10
 */
namespace Admin\Model;
use Think\Model;

class RoleModel extends Model
{
    public function AddRole($data)
    {
        if(mb_strlen($data['name']) > 20 || mb_strlen($data['name']) < 2)
        {
            return ['status'=>0,'info'=>'名字不符合规范'];
        }
        if(isset($data['school']) || $data['school'] < 0)
        {
            return ['status'=>0,'info'=>'学校ID有误'];
        }
        else
        {
            $data['school'] = 0;
        }
        if(mb_strlen($data['remark']) < 2 || mb_strlen($data['remark']) > 60)
        {
            return ['status'=>0,'info'=>'备注信息有误'];
        }
        if($da=$this->where(['name'=>$data['name'],'school'=>isset($data['school'])?$data['school']:0])->find())
        {
            if($da['status'] == 0)
            {
                $this->where($da)->save(['status'=>1]);
            }
            return ['status'=>0,'info'=>'角色已存在'];
        }
        if($id=$this->add($data))
        {
            return ['status'=>1,'info'=>'添加成功','id'=>$id];
        }
        else
        {
            return ['status'=>0,'info'=>'添加失败'];
        }
    }

    public function PageList($table,$page,$where=[],$order='id DESC',$num=5)
    {
        $User = M($table);
        $list = $User->where($where)->order($order)->page($page,$num)->select();
        $count = $User->where($where)->count();// 查询满足要求的总记录数
        $Page = new \Think\SelfPage($count, $num);// 实例化分页类 传入总记录数和每页显示的记录数
        $show = $Page->show();// 分页显示输出
        return ['page' => $show, 'list' => $list,'num'=>$count];
    }

    public function CloneRole($schoolid)
    {
       $m = M('role');
       $n = M('function');
        $data =$m->where(['school'=>0,'type'=>0])->field('id,name,remark')->select();
        foreach ($data as $k=>$v)
        {
            $info['name'] = $v['name'];
            $info['school'] = $schoolid;
            $info['remark'] = $v['remark'];
            $this->startTrans();
            if($id = $m->add($info))
            {
               $func = $n->where(['rid'=>$v['id']])->field('pid,rid')->select();
               foreach ($func as $kk=>$vv)
               {
                   $func[$kk]['rid'] = $id;
               }
               if($n->addAll($func))
               {
                   $this->commit();
               }
               else
               {
                   $this->rollback();
               }
            }
            else
            {
                $this->rollback();
            }

        }
    }









    public function Hide($id)
    {
        if(is_array($id)){
            foreach ($id as $v)
            {
                $where=['id'=>$v];
                if(!$this->where($where)->save(['status'=>0]))
                {
                    return ['status'=>0,'info'=>'删除失败'];
                }
            }
        }
        else {
            $where = ['id' => $id];
            if ($this->where($where)->save(['status' => 0])) {
                return ['status' => 1, 'info' => '删除成功'];
            } else {
                return ['status' => 0, 'info' => '删除失败'];
            }
        }

    }
}