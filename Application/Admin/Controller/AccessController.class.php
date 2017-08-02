<?php
/**
 * Created by PhpStorm.
 * User: qingyun
 * Date: 17/7/25
 * Time: 上午11:28
 */

namespace Admin\Controller;

use Think\Controller;

class AccessController extends Controller
{
    public function add_role()
    {
        if(IS_POST)
        {
           $data=$_POST;
           $m=D('Role');
           $resule= $m->AddRole($data);
           $this->ajaxReturn(['status' =>$resule['status'],'info' =>$resule['info'],'id'=>$resule['id']?$resule['id']:0]);
        }else {
            $this->display();
        }
    }
    /**
     * 修改角色
     */
    public function mod_role()
    {
        $this->display();
    }

    /**
     * 逐个删除角色
     */

    public function delete()
    {
        $obj=D('Role');
          $result = $obj->Hide($_POST['id']);
          if($result['status'])
          {
              $this->ajaxReturn($result['info']);
          }
    }




    /**
     * 批量删除角色
     */

    public function delete_all()
    {
        $obj=D('Role');
        $result = $obj->Hide($_POST['id']);
        if(!$result) {
            $this->ajaxReturn('成功');
        }
        else
        {
            $this->ajaxReturn('失败');
        }


    }




    /**
     * 角色列表
     */

    public function role_list()
    {
        $m = D('Role');
        $show=$m->PageList('Role',I('get.p',1),['status'=>1]);
        $this->assign('page',$show['page']);
        $this->assign('list',$show['list']);
        $this->assign('num',$show['num']);
        $this->display();
    }

    public function permission_list()
    {
        $m=M('permission');
        $list=$m->select();
        $this->assign('list',$list);
        $m = D('Role');
        $show=$m->PageList('permission',I('get.p',1),['status'=>1]);
        $this->assign('page',$show['page']);
        $this->assign('list',$show['list']);
        $this->assign('num',$show['num']);
        $this->display();
    }

    public function permission_add()
    {
       if(IS_POST)
       {
           $data=I('post.');
           if(mb_strlen($data['f_name'])>20 ||mb_strlen($data['f_name']) < 2)
           {
               $this->ajaxReturn(['status'=>0,'info'=>'名称有误']);
           }
           if(mb_strlen($data['f_module'])>20 ||mb_strlen($data['f_module']) < 2)
           {
               $this->ajaxReturn(['status'=>0,'info'=>'模块名称有误']);
           }
           if((isset($data['f_controller']) && !empty($data['f_controller'])) && (mb_strlen($data['f_controller'])>20 ||mb_strlen($data['f_controller']) < 2))
           {
               $this->ajaxReturn(['status'=>0,'info'=>'控制器名称有误']);
           }
           if((isset($data['f_action']) && !empty($data['f_action'])) && (mb_strlen($data['f_action'])>20 ||mb_strlen($data['f_action']) < 2))
           {
               $this->ajaxReturn(['status'=>0,'info'=>'方法名称有误']);
           }
            $m=M('permission');
           if($m->where($data)->select())
           {
               $this->ajaxReturn(['status'=>0,'info'=>'此功能已经存在']);
           }
            if($m->add($data))
            {
                $this->ajaxReturn(['status'=>1,'info'=>'添加成功']);
            }

       }
       if(IS_GET) {

           $this->display();
       }
    }

    public function role_add_function()
    {
        $id=I('get.id');
        $pid=M('function')->where(['rid'=>$id])->getField('pid',true);
            $m=M('permission');
            $info=$m->select();
            $data1=[];
            $data2=[];
            $data3=[];
            foreach ($info as $k=>$v)
            {
                if(in_array($v['id'],$pid))
                {
                    $v['select'] = 1;
                }else{
                    $v['select'] = 0;
                }
                if(empty($v['f_action']))
                {
                    if(empty($v['f_controller']))
                    {
                        $data1[]=$v;
                    }
                    else
                    {
                        $data2[]=$v;
                    }

                }
                else{
                    $data3[]=$v;
                }

            }
           foreach ($data1 as $k=>$v)
           {
               foreach ($data2 as $kk=>$vv)
               {
                   foreach ($data3 as $kkk=>$vvv)
                   {
                       if(($vvv['f_controller'] == $vv['f_controller']) && ($vvv['f_module'] == $vv['f_module']) )
                       {
                           $vv['xj'][]=$vvv;
                       }
                   }
                   if ($v['f_module'] == $vv['f_module'])
                   {
                       $data1[$k]['xj'][] = $vv;
                   }
               }
           }
           $id=I('get.id');
           $this->assign('id',$id);
          $this->assign('list',$data1);
            $this->display();


    }

    public function role_add_permission()
    {
        if (IS_POST) {
            $data = I('post.');

            $ids = $data['ids'];
            $id = (int)$data['id'];
            if (empty($ids) || empty($id)) {
                $this->ajaxReturn(['status' => 0, 'info' => '非法操作']);
            }
            $ids =array_unique(explode(',',$ids));
            $da = [];

            foreach ($ids as $k => $v) {
                $da[$k]['pid'] = $v;
                $da[$k]['rid'] = $id;
            }
            $m = M('function');
            $m->startTrans();
            if($m->where(['id'=>$id])->select()) {
                if ($m->where(['id' => $id])->delete() != 'false') {
                    if ($m->addAll($da)) {
                        $m->commit();
                        $this->ajaxReturn(['status' => 1, 'info' => '添加成功']);
                    } else {
                        $m->rollback();
                        $this->ajaxReturn(['status' => 0, 'info' => '添加失败']);
                    }
                } else {
                    $m->rollback();
                    $this->ajaxReturn(['status' => 0, 'info' => '添加失败1', 'fg' => $m->getLastSql()]);
                }
            }else
            {
                if ($m->addAll($da)) {
                    $m->commit();
                    $this->ajaxReturn(['status' => 1, 'info' => '添加成功']);
                } else {
                    $m->rollback();
                    $this->ajaxReturn(['status' => 0, 'info' => '添加失败']);
                }
            }
        }
    }

    public function del_permission()
    {
        $id=I('post.id');
        if(empty($id))
        {
            $this->ajaxReturn(['status'=>0,'info'=>'非法操作']);
        }
        $m=M('permission');
        $data =$m->where(['id'=>$id])->find();
        if(empty($data))
        {
            $this->ajaxReturn(['status'=>0,'info'=>'非法操作']);
        }
        if(empty($data['f_controller']))
        {
            $result = $m->where(['f_module'=>$data['f_module']])->delete();
        }
        else
        {
            if (empty($data['f_action']))
            {
                $result = $m->where(['f_module'=>$data['f_module'],'f_controller'=>$data['f_controller']])->delete();
            }
            else
            {
                $result = $m->where(['id'=>$id])->delete();
            }
        }
        if ($result)
        {
            $this->ajaxReturn(['status'=>1,'info'=>'成功']);
        }
        else
        {
            $this->ajaxReturn(['status'=>0,'info'=>'失败']);
        }
    }

}