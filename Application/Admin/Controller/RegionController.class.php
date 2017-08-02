<?php
/**
 * Created by PhpStorm.
 * User: w
 * Date: 2017/7/27
 * Time: 下午6:52
 */
namespace Admin\Controller;

use Admin\Model\LevelModel;
use Think\Controller;

class RegionController extends Controller
{
    public function region_list()
    {
        $m=M('region');
        $data=$m->select();
        $this->assign('list',$data);
        foreach($data as $k=>$v)
        {
            $data[$k]['name'] = '<div class="tree-row" data-name="'.$v['name'].'" data-id="'.$v['id'].'"><span>'.$v['name'].'</span>
                <i class="Hui-iconfont f-r add" data-url="'.U("add_region",['id'=>$v['id']]).'">&#xe600;</i>
                <i class="Hui-iconfont f-r edit" data-url="'.U('edit_region',['id'=>$v['id']]).'">&#xe6df;</i>
                <i class="Hui-iconfont f-r del">&#xe6e2;</i>
            </div>';
        }
        $n=new LevelModel();
        $this->assign('list',json_encode($n->formatTree($data)));
     $this->display();
    }


    public function add_region()
    {
        if(IS_POST)
        {
            $name=I('post.name');
            $pid=I('post.pid');

            if(!empty($name)) {
                if (strlen($name) > 30 || strlen($name) < 2) {
                    $this->ajaxReturn(['status' => 0, 'info' => '地区名称不符合规范']);
                }
                $m=new LevelModel('region');
                $result=$m->add_region(['name'=>$name,'pid'=>$pid,]);
                if($result['status'])
                {
                    F('regiontree',null);
                    $this->ajaxReturn(['status' => 1, 'info' => '添加成功']);
                }
                else
                {
                    $this->ajaxReturn(['status' => 0, 'info' => '添加失败']);
                }
            }

        }
        if(IS_GET)
        {
            $id=I('get.id',0);
            //print_r($id);
            $m=new LevelModel('region');
            if(empty($id))
            {
                $info=['name'=>'中国','id'=>0,'pid'=>0,'path'=>'0-'];
            }else
            {
                $info=$m->get($id);
            }
            $this->assign('parent',$info);
            $this->display();
        }
    }

    public function delete_region()
    {
        $id = I('post.id');
        $m = new LevelModel('region');
       $result = $m->delete_region($id);
       $this->ajaxReturn($result);
    }

    public function edit_region()
    {
        if (IS_GET)
        {
            $id = I('get.id');
            $m = new LevelModel('region');
            $info = $m->get($id);
            $this->assign('info',$info);
            $this->display();
        }
      if(IS_POST)
      {
          $id = I('post.id');
          $name = I('post.name');
          if (empty($id) || empty($name))
          {
              $this->ajaxReturn(['status' => 0, 'info' => '非法操作']);
          }
          $m = new LevelModel('region');
          $result = $m->mod_region($name,$id);
          if($result)
          {
              $this->ajaxReturn(['status' => 1, 'info' => '成功']);
          }
          else
          {
              $this->ajaxReturn(['status' => 0, 'info' => '失败']);
          }
      }
    }
}