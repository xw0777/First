<?php
/**
 * Created by PhpStorm.
 * User: w
 * Date: 2017/7/27
 * Time: 下午6:46
 */
namespace Admin\controller;
use Admin\Model\LevelModel;
use Think\Controller;

class SchoolController extends Controller
{
    public function add_school()
    {
        if(IS_POST)
        {
            $data = I('post.');
            $m = new LevelModel('school');
           $result = $m->add_school($data);
            $this->ajaxReturn($result);


        }
        if (IS_GET)
        {
            $option = F('regiontree');
                if(!$option) {
                    $m = new LevelModel('region');
                    $tree = $m->git_list_region(0);
                    $option = $m->add_html_fortree($tree);
                    F('regiontree',$option);
                }
           $this->assign('option',$option);
            $this->display();
        }
    }

    public function school_list()
    {
        $page = I('get.p',1);
        $m = new LevelModel('school');
        $data = $m->page_school($page);
        $this->assign('list',$data['list']);
        $this->assign('page',$data['page']);
        $this->assign('num',$data['num']);
        $this->display();
    }

    public function delete_school()
    {
        if(IS_POST)
        {
            $id = I('post.id');
            if (empty($id))
            {
                $this->ajaxReturn(['status'=>0,'info'=>'非法操作']);
            }
            else
            {
                $m = new LevelModel('school');
                $result = $m->delete_school($id);
                if($result)
                {
                    $this->ajaxReturn(['status'=>1,'info'=>'删除成功']);
                }else
                {
                    $this->ajaxReturn(['status'=>0,'info'=>'删除失败']);
                }
            }
        }
    }
    public function delete_all()
    {
        $ids = I('post.ids');
        $m = new LevelModel('school');
        $result = $m->delete_all($ids);
        $this->ajaxReturn($result);
    }
    public function edit_school()
    {
        if(IS_GET) {
            $id = I('get.id');
            $m = new LevelModel('school');
            $info = $m->get($id);
            $this->assign('info', $info);
            $m = new LevelModel('region');
            $tree = $m->git_list_region(0);
            $option = $m->add_html_fortree($tree);
           $option = preg_replace('/value=["\']'.$info['region'].'["\']/','value='.$id.' selected',$option);
            $this->assign('option', $option);
            $this->assign('id', $id);
            $this->display();
        }
        if(IS_POST)
        {
            $data = I('post.');
            $m = new LevelModel('school');
            $result = $m->edit_school($data);
            $this->ajaxReturn($result);
        }
    }


}