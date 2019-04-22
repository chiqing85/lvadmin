<?php

return [
    /*
     * 唯一标识
     */
    'uuid' => '******',
    'token' => env('BAIDUTJ_TOKEN'),

    'username' => env('BAIDUTJ_USERNAME'),

    'password' => env('BAIDUTJ_PASSWORD'),

    /**
     * 统计用户仅支持如下账户类型：
     * 1：站长账号
     */
    'account_type' => 1,
];
