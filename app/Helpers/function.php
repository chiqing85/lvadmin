<?php

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

function Getiplookup( $ip ) {
    if( $ip == '127.0.0.1') return '本地测试';
    $api = 'http://ip.taobao.com/service/getIpInfo.php?ip='. $ip;
    $json = @file_get_contents($api);//调用新浪IP地址库
    $arr = json_decode($json,true);
    $arr = $arr['data'];
    $country = $arr['country']; //国家
    $province = $arr['region']; //省份
    $city = $arr['city']; //城市
    $lookup = $country. ' '.$province.' '.$city;
    return $lookup;
}

function le($data, $pid = 0, $level = 0, $html = ""){
    $arr = array();
    foreach ($data as $v) {
        if($v['pid'] == $pid) {
            $v['level'] = $level;
            $v['html'] = str_repeat($html, $level);
            $arr[] =$v;
            $arr = array_merge($arr, le($data, $v['id'], $level + 1, $html  = '|—　'));
        }
    }
    return $arr;
};