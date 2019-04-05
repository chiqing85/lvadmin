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