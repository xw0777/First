<?php
/**
 * Created by PhpStorm.
 * User: w
 * Date: 2017/8/1
 * Time: 下午5:05
 */
/** * 检验身份证是否合法
*@param $id_card 身份证号码
* @return bool */
 function id_card_available($id_card) { $city = array(11 => "北京", 12 => "天津", 13 => "河北", 14 => "山西", 15 => "内蒙古", 21 => "辽宁", 22 => "吉林", 23 => "黑龙江", 31 => "上海", 32 => "江苏", 33 => "浙江", 34 => "安徽", 35 => "福建", 36 => "江西", 37 => "山东", 41 => "河南", 42 => "湖北", 43 => "湖南", 44 => "广东", 45 => "广西", 46 => "海南", 50 => "重庆", 51 => "四川", 52 => "贵州", 53 => "云南", 54 => "西藏", 61 => "陕西", 62 => "甘肃", 63 => "青海", 64 => "宁夏", 65 => "新疆", 71 => "台湾", 81 => "香港", 82 => "澳门", 91 => "国外");
    $id_cardLength = strlen($id_card);
//长度验证
    if (!preg_match('/^\d{17}(\d|x)$/i', $id_card) and !preg_match('/^\d{15}$/i', $id_card)) {
//验证码位数不对
        return false;
    }
//地区验证
    if (!array_key_exists(intval(substr($id_card, 0, 2)), $city)) {
//验证地区是否存在
    return false;
    }
// 15位身份证验证生日，转换为18位
    if ($id_cardLength == 15) { $id_card = substr($id_card, 0, 6) . "19" . substr($id_card, 6, 9); //15to18
        $bit18 = get_verify_bit($id_card); //算出第18位校验码
        $id_card = $id_card . $bit18;
    }
//从今年算起，往前推进100年为有效的年份
//今年的年份
    $now_year = date('Y');
//截至年份
    $dead_year = $now_year - 100;
    $year = substr($id_card, 6, 4);
    if ($year < $dead_year || $year > $now_year) {
        return false;
    }
//18位身份证处理
//身份证编码规范验证
    $id_card_base = substr($id_card, 0, 17);
    if (strtoupper(substr($id_card, 17, 1)) != get_verify_bit($id_card_base))
    { return false;
    }
    return true;
}
/** * 计算身份证校验码，根据国家标准GB 11643-1999 * @param $id_card_base 身份证前17位 * @return bool|string false或者校验码 */
function get_verify_bit($id_card_base) {
    if (strlen($id_card_base) != 17) {
        return false; }
//加权因子
    $factor = array(7, 9, 10, 5, 8, 4, 2, 1, 6, 3, 7, 9, 10, 5, 8, 4, 2);
//校验码对应值
 $verify_number_list = array('1', '0', 'X', '9', '8', '7', '6', '5', '4', '3', '2');
    $checksum = 0;
    for ($i = 0; $i < strlen($id_card_base);$i++) {
        $checksum += substr($id_card_base, $i, 1) * $factor[$i]; }
    $mod = $checksum % 11;
    $verify_number = $verify_number_list[$mod];
    return $verify_number; }