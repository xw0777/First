<?php
/**
 * Created by PhpStorm.
 * User: w
 * Date: 2017/7/28
 * Time: 下午7:53
 */
namespace Admin\Model;
class LevelModel
{
    private $table;

    public function __construct($table)
    {
        $this->table=$table;
    }

    public function page_school($page,$order='uid DESC',$num = 2)
    {
        $m = M($this->table)->join('region ON school.region = region.id')->field('school.id as uid,region.name as area,contact,contacts,address,school.name');
        $data = $m->order($order)->page($page,$num)->select();
        $count = $m->count();// 查询满足要求的总记录数
        $Page = new \Think\SelfPage($count, $num);// 实例化分页类 传入总记录数和每页显示的记录数
        $show = $Page->show();// 分页显示输出
        return ['page' => $show, 'list' => $data,'num'=>$count];
    }

    public function get($id)
    {
        return M($this->table)->where(['id'=>$id])->find();
    }

    public function formatTree($data,$start=0)
    {
        $new = [];
        foreach ($data as $k=>$v)
        {
            if($v['pid'] == $start)
            {
                $v['children'] = $this->formatTree($data,$v['id']);
                $new[] = $v;
            }
        }
        return $new;
    }

    public function add_region($data)
    {
        $data['pid'] = (int) $data['pid'];
        $data['pid'] = $data['pid'] <= 0 ? 0 : $data['pid'];
        if($data['pid'])
        {
            $z=$this->get($data['pid']);
            $data['path'] = $z['path'].$data['pid'].'-';
        }
        else
        {
            $data['path'] = '0-';
        }
        if(M($this->table)->where(['name'=>$data['name'],'pid'=>$data['pid']])->find())
        {
            return ['status'=>0,'info'=>'该名称已存在'];
        }

        if(M($this->table)->add($data))
        {
            return ['status'=>1,'info'=>'成功'];
        }else{
            return ['status'=>0,'info'=>'失败'];
        }
    }

    public function add_school($data)
    {
        $r = $this->verify_school($data);
        if(!$r['status'])
        {
            return ['status' => 0, 'info' => $r['info']];
        }
        $m= M($this->table);
        if(!$m->where(['name'=>$data['name']])->select()) {
            if ($id=$m->add($data)) {
                D('Role')->CloneRole($id);
                return ['status' => 1, 'info' => '添加成功'];
            } else {
                return ['status' => 0, 'info' => '添加失败'];
            }
        }
        else
        {
            return ['status' => 0, 'info' => '你已经添加过此学校'];
        }
    }

    public function verify_school($data)
    {
        if(mb_strlen($data['name']) < 2 || mb_strlen($data['name']) > 20)
        {
            return ['status'=>0,'info'=>'学校名称应在2—20个字符之间'];
        }
        preg_match('/^1[3,5,7,8]\d{9}|0(10|20|21|22|23|24|25|27|28|29)[1-9]\d{6,7}|0[3-9]\d{2}[1-9]\d{6,7}$/',$data['contact'],$result);
        if(!$result)
        {
            return ['status'=>0,'info'=>'请填写正确的联系方式'];
        }
        if(strlen($data['contacts']) < 2 || strlen($data['contacts']) > 30)
        {
            return ['status'=>0,'info'=>'联系人名称应在2—20个字符之间'];
        }
        if(strlen($data['address']) < 2 || strlen($data['address']) > 60)
        {
            return ['status'=>0,'info'=>'学校地址应在2—60个字符之间'];
        }
        else
        {
            return ['status'=>1];
        }
    }

    public function edit_school($data)
    {
       $list = $this->get($data['id']);
       $data = array_merge($list,$data);
        $r = $this->verify_school($data);
        if(!$r['status'])
        {
            return ['status' => 0, 'info' => $r['info']];
        }
        $m= M($this->table);
        $id = $data['id'];
        unset($data['id']);
        $result = $m->where(['id'=>$id])->save($data);
        if ($result !== false)
        {
            return ['status' => 1, 'info' => '修改成功'];
        }
        else
        {
            return ['status' => 0, 'info' => '修改失败听会歌'];
        }

    }




    public function delete_school($id)
    {
        return M($this->table)->where(['id'=>$id])->delete();
    }

    public function git_list_region($pid)
    {
        if(empty($pid))
        {
            $region = [];
            $newpath = '0%';
        }
        else
        {
           $region = $this->get($pid);
           $newpath = $region['path'].$region['id'].'%';
        }
            $count = substr_count($region['path'],'-');
        if($down = M('region')->where(['path'=>['like',$newpath]])->select())
        {
            foreach ($down as $k=>$v)
            {
                $down[$k]['count'] = substr_count($v['path'],'-') - $count;
                for($i = 0;$i < $down[$k]['count'];$i++)
                {
                    $down[$k]['name'] = '--'.$down[$k]['name'];
                }
                $down[$k]['name'] = '|'.$down[$k]['name'];
            }
          $down = $this->formatTree($down,$pid);
            return $down;
        }
    }


    public function add_html_fortree($tree)
    {
        $str = '';
        foreach ($tree as $k=>$v)
        {
            $str .= '<option value="'.$v['id'].'">'.$v['name'].'</option>';
            if($v['children'])
            {
                $str .= $this->add_html_fortree($v['children']);
            }
        }
        return $str;
    }


    public function delete_region($id)
    {
        $m = M($this->table);
       if($m->where(['pid'=>$id])->select())
       {
           return ['status' => 0, 'info' => '该地区存在下级地区不能删除'];
       }
       else
       {
           if($m->where(['id'=>$id])->delete())
           {
               return ['status' => 1, 'info' => '成功删除'];
           }
           else
           {
               return ['status' => 0, 'info' => '删除失败'];
           }
       }
    }


    public function mod_region($name,$id)
    {
        return M($this->table)->where(['id'=>$id])->save(['name'=>$name]);
    }

    public function delete_all($data)
    {
        if (empty($data))
        {
            return ['status' => 0, 'info' => '非法操作'];
        }
        $ids = '';
        foreach ($data as $k=>$v)
        {
            $ids = $ids.','.$v;
        }
        $ids = trim($ids,',');
       // print_r($ids);
        if(M($this->table)->delete($ids))
        {
            return ['status' => 1, 'info' => '删除成功'];
        }
        else
        {
            return ['status' => 0, 'info' => '删除失败'];
        }
    }
}