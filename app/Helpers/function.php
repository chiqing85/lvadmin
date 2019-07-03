<?php

/**
 * @title 无限分类
 * @param $data
 * @param int $pid
 * @param int $h_layer
 * @param int $level
 * @return array
 */
function create($data, $pid = 0, $h_layer = 0, $level = 0) {
    $arr = array();
    foreach ($data as $k => $v) {
        $h_layer ++;
        if($v['pid'] == $pid) {
            $v['h_layer'] = $h_layer;
            $v['level'] = $level ;
            $arr[] = $v;
            unset($data[$k]);
           $arr = array_merge($arr, create($data, $v['id'], $h_layer, $level + 1));
        }
         $h_layer --;
    }
    return $arr;
}

function acmid() {
    $aclass = require("json/aclass.php");
    return $aclass;
}

/**
 * @title ip地址
 * @param $ip
 * @return string
 */
function Getiplookup( $ip ) {
    if( $ip == '127.0.0.1') return '本地测试';
    $api = 'http://ip.taobao.com/service/getIpInfo.php?ip='. $ip;
    $json = @file_get_contents($api);//调用淘宝IP地址库
    $arr = json_decode($json,true);
    $arr = $arr['data'];
    $country = $arr['country']; //国家
    $province = $arr['region']; //省份
    $city = $arr['city']; //城市
    $lookup = $country. ' '.$province.' '.$city;
    return $lookup;
}

/**
 * @title 时间
 * @param $time
 * @return string
 */
function time_lin($time){
    $rtime = $time;
    $time = time () - strtotime($time);
    if($time < 60){
        $str = $time.'秒之前';
    }elseif($time < 60*60){
        $min = floor( $time/60 );
        $str = $min.'分钟前';
    }elseif($time < 60*60*24){
        $h = floor($time/(60*60));
        $str = $h.'小时前 ';
    }elseif($time < 60 * 60 * 24 * 8 ) {
        $d = floor($time/(60*60*24));
        if ($d == 1)
            $str = $d.'天以前';
        else
            $str = $d.'天以前';
    }else{
        $str = $rtime->format('m-d H:i');
    }
    return $str;
}

function trimall( $str ) {
    $qian=array(" ","　","\t","\n","\r");
    return str_replace($qian, '', $str);
    return preg_replace('/($s*$)|(^s*^)/m', '',$str);
}

function sub($str) {
    return substr($str,0,strlen($str)-1);
}

/**
 * @title 汉字首字母
 * @param $str
 * @return null|string
 */
function GetFirst( $str ) {
    $str= iconv("UTF-8","gb2312", $str);//编码转换
    if (preg_match("/^[\x7f-\xff]/", $str))
    {
        $fchar=ord($str{0});
        if($fchar>=ord("A") and $fchar<=ord("z") )return strtoupper($str{0});
        $a = $str;
        $val=ord($a{0})*256+ord($a{1})-65536;
        if($val>=-20319 and $val<=-20284)return "A";
        if($val>=-20283 and $val<=-19776)return "B";
        if($val>=-19775 and $val<=-19219)return "C";
        if($val>=-19218 and $val<=-18711)return "D";
        if($val>=-18710 and $val<=-18527)return "E";
        if($val>=-18526 and $val<=-18240)return "F";
        if($val>=-18239 and $val<=-17923)return "G";
        if($val>=-17922 and $val<=-17418)return "H";
        if($val>=-17417 and $val<=-16475)return "J";
        if($val>=-16474 and $val<=-16213)return "K";
        if($val>=-16212 and $val<=-15641)return "L";
        if($val>=-15640 and $val<=-15166)return "M";
        if($val>=-15165 and $val<=-14923)return "N";
        if($val>=-14922 and $val<=-14915)return "O";
        if($val>=-14914 and $val<=-14631)return "P";
        if($val>=-14630 and $val<=-14150)return "Q";
        if($val>=-14149 and $val<=-14091)return "R";
        if($val>=-14090 and $val<=-13319)return "S";
        if($val>=-13318 and $val<=-12839)return "T";
        if($val>=-12838 and $val<=-12557)return "W";
        if($val>=-12556 and $val<=-11848)return "X";
        if($val>=-11847 and $val<=-11056)return "Y";
        if($val>=-11055 and $val<=-10247)return "Z";
    } else {
        return $str;
    }
}

/**
 * @title 广告过滤
 * @param $comment
 * @return bool
 */
function adblock( $comment ) {
    $flag_arr=array('？','！','￥','（','）','：','‘','’','“','”','《','》','，','…','。','、','&nbsp;','】','【','～');
    $quanjiao = array('０' => '0', '１' => '1', '２' => '2', '３' => '3', '４' => '4','５' => '5', '６' => '6', '７' => '7', '８' => '8', '９' => '9', 'Ａ' => 'A', 'Ｂ' => 'B', 'Ｃ' => 'C', 'Ｄ' => 'D', 'Ｅ' => 'E','Ｆ' => 'F', 'Ｇ' => 'G', 'Ｈ' => 'H', 'Ｉ' => 'I', 'Ｊ' => 'J', 'Ｋ' => 'K', 'Ｌ' => 'L', 'Ｍ' => 'M', 'Ｎ' => 'N', 'Ｏ' => 'O','Ｐ' => 'P', 'Ｑ' => 'Q', 'Ｒ' => 'R', 'Ｓ' => 'S', 'Ｔ' => 'T','Ｕ' => 'U', 'Ｖ' => 'V', 'Ｗ' => 'W', 'Ｘ' => 'X', 'Ｙ' => 'Y','Ｚ' => 'Z', 'ａ' => 'a', 'ｂ' => 'b', 'ｃ' => 'c', 'ｄ' => 'd','ｅ' => 'e', 'ｆ' => 'f', 'ｇ' => 'g', 'ｈ' => 'h', 'ｉ' => 'i','ｊ' => 'j', 'ｋ' => 'k', 'ｌ' => 'l', 'ｍ' => 'm', 'ｎ' => 'n','ｏ' => 'o', 'ｐ' => 'p', 'ｑ' => 'q', 'ｒ' => 'r', 'ｓ' => 's', 'ｔ' => 't', 'ｕ' => 'u', 'ｖ' => 'v', 'ｗ' => 'w', 'ｘ' => 'x', 'ｙ' => 'y', 'ｚ' => 'z','（' => '(', '）' => ')', '〔' => '[', '〕' => ']', '【' => '[','】' => ']', '〖' => '[', '〗' => ']', '“' => '[', '”' => ']','‘' => '[', '\'' => ']', '｛' => '{', '｝' => '}', '《' => '<','》' => '>','％' => '%', '＋' => '+', '—' => '-', '－' => '-', '～' => '-','：' => ':', '。' => '.', '、' => ',', '，' => '.', '、' => '.', '；' => ',', '？' => '?', '！' => '!', '…' => '-', '‖' => '|', '”' => '"', '\'' => '`', '‘' => '`', '｜' => '|', '〃' => '"','　' => ' ');
    $special_num_char=array('①'=>'1','②'=>'2','③'=>'3','④'=>'4','⑤'=>'5','⑥'=>'6','⑦'=>'7','⑧'=>'8','⑨'=>'9','⑩'=>'10','⑴'=>'1','⑵'=>'2','⑶'=>'3','⑷'=>'4','⑸'=>'5','⑹'=>'6','⑺'=>'7','⑻'=>'8','⑼'=>'9','⑽'=>'10','一'=>'1','二'=>'2','三'=>'3','四'=>'4','五'=>'5','六'=>'6','七'=>'7','八'=>'8','九'=>'9','零'=>'0', "壹" => "1", '贰' => '2', '叁' => '3', '肆' => '4', '伍' => '5', '陆' => '6', '柒' => '7', '捌' => '8', '玖' => '9', '拾' => '10');

    $comment = trimall(strip_tags( strip_tags(str_replace($flag_arr,'',$comment ) ) ) );
    $comments = preg_replace('/\s/','',preg_replace("/[[:punct:]]/",'',$comment ));

    $comments = strtr($comments, array_merge ($quanjiao, $special_num_char ));

    preg_match_all('/\d+/',$comments,$match);
    $is_ad = false;
    foreach($match[0] as $val)//是否存在数字的qq号和微信号
    {
        if(strlen($val)>=6)
        {//存在连续的长度超过6位的数字串，广告嫌疑很大
            $is_ad=true;
            break;
        }
    }

    if(count($match[0])>=10) { //间断的数字很多，存在广告的嫌疑
        $is_ad = true;
    }
    return ( preg_match('/http[s]|(www\\.)|\\.(com|cn|net|cc|org|top|wang|xyz|vip)/i', $comment ) || $is_ad );
}