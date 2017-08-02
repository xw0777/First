<?php

/**
 * 连接数据库服务器 并且选择数据库
 */
function conn($dbname)
{
    //连接数据库，打开数据库通道
    $ln = mysql_connect('127.0.0.1','root','123456',true);

    //验证是否连接成功
    if($ln === false){
        die('数据库连接失败');
    }
    //选择数据库，并且验证是否选择成功
    if(!mysql_select_db($dbname,$ln)){
        die('数据库选择失败');
    }
    mysql_query('set names utf8',$ln);
    return $ln;
}


/**
 * 查询数据
 */

// function select($sql,$ln)
// {
//     $result = mysql_query($sql,$ln);

//     while($res = mysql_fetch_assoc($result)){
//         $data[] = $res;
//     }

//     return $data;
// }

/**
 * 插入数据
 * $tableName 要插入的表的名字
 * $data 要插入的数据
 * $ln  数据库连接资源
 */
function insert($tableName,$data,$ln=null)
{
    $key = implode(',',array_keys($data));
    $vs = array_values($data);
    $values = '';
    foreach($vs as $v){
        $values = $values."'".$v."',";
    }
    $values = trim($values,',');

    $sql = 'INSERT INTO '.$tableName.' ('.$key.') VALUES ('.$values.')';
    if($ln){
        return mysql_query($sql,$ln);
    }else{
        return mysql_query($sql);
    }
}

/**
 * 一次插入多条数据
 * $tableName 要插入的表的名字
 * $data 要插入的数据
 * $ln  数据库连接资源
 */

function insertAll($tableName,$data,$ln=null)
{
    //数据不能为空，且必须是数组格式
    if(!is_array($data) || empty($data)){
        return false;
    }
    //获取数组的第一个数元素
    $tmp = current($data);
    if(is_array($tmp)){
        //按照插入多行处理
        //获取字段名
        $key = implode(',',array_keys($tmp));
        //初级拼接sql
        $sql = 'INSERT INTO '.$tableName.' ('.$key.') VALUES ';
        foreach($data as $v){
            $t = '';
            foreach ($v as $vv) {
                //拼接每一个括号内的值
                $t = $t.'"'.$vv.'",';
            }
            //剔除小瑕疵
            $t = trim($t,',');
            //将每一个拼接完毕的括号内的内容放到括号中
            $sql = $sql.'('.$t.'),';
        }
        //剔除小瑕疵
        $sql = trim($sql,',');

        if($ln){
            return mysql_query($sql,$ln);
        }else{
            return mysql_query($sql);
        }
    }else{
        //按照插入一条处理
        return insert($tableName,$data,$ln);
    }
    //INSERT INTO tableName (name,sex,score) VALUES ('xiaohong',1,68),('xiaoma',0,98)
    
}

/**
 * 删除数据
 * $tableName 操作的表名字
 * $where 条件数据
 * $ln  数据库连接资源
 */
function delete($tableName,$where=array(),$ln=null)
{
    $sql = 'DELETE FROM '.$tableName;
    $sql = where($sql,$where);
    if($ln){
        return mysql_query($sql,$ln);
    }else{
        return mysql_query($sql);
    }
}
/**
 * 修改数据
 * $tableName 操作的表名字
 * $data 要修改的数据
 * $where 修改的条件
 * $ln  数据库连接资源
 */
function update($tableName,$data,$where=array(),$ln=null)
{
    //update tableName set name='小红',age=25 where ……
    $sql = 'UPDATE '.$tableName.' SET ';
    foreach($data as $k=>$v){
        $sql = $sql.$k.'="'.$v.'",';
    }

    $sql = trim($sql,',');
    $sql = where($sql,$where);
    if($ln){
        return mysql_query($sql,$ln);
    }else{
        return mysql_query($sql);
    }
}

/**
 * 对查询条件进行处理
 */
function where($sql,$where=array())
{
    if($where){
        if(is_array($where)){
            $sql = $sql.' WHERE 1';
            foreach($where as $k=>$v){
                $sql = $sql.' AND '.$k.'="'.$v.'"';
            }
        }else{
            $sql = $sql.' WHERE '.$where;
        }
    }
    return $sql;
}


/**
 * 查询数据
 * $tableName 操作的表名称
 * $where 查询条件
 * $fields 要查询的字段
 * $order 排序规则
 * $limit 
 * $ln 数据库连接
 */

function select($tableName,$where=[],$fields='*',$order='',$limit='',$ln=null)
{
    //对需要查询的字段进行处理
    if(empty($fields)){
        $fields = '*';
    }
    if(!is_array($fields) && !is_string($fields)){
        return false;
    }
    if(is_array($fields)){
        $fields = implode(',',array_values($fields));
    }
    $sql = 'SELECT '.$fields.' FROM '.$tableName;

    //对查询条件的处理
    $sql = where($sql,$where);
    //对排序的处理
    if($order){
        $sql = $sql.' ORDER BY '.$order;
    }
    //对数量进行限制
    if($limit){
        $sql = $sql.' LIMIT '.$limit;
    }
    
    //运行SQL语句
    if($ln){
        $result = mysql_query($sql,$ln);
    }else{
        $result = mysql_query($sql);
    }
    //对结果集进行处理
    while($res = mysql_fetch_assoc($result)){
        $data[] = $res;
    }

    return $data;
}

/**
 * 查询一条数据
* $tableName 操作的表名称
 * $where 查询条件
 * $fields 要查询的字段
 * $order 排序规则
 * $ln 数据库连接
 */
function find($tableName,$where=[],$fields='*',$order='',$ln=null)
{
    $res = select($tableName,$where,$fields,$order,1,$ln);
    if(empty($res)){
        return false;
    }else{
        return $res[0];
    }
}



