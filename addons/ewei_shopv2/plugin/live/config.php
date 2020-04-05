<?php

if (!defined('IN_IA')) {
    exit('Access Denied');
}

return [
    'version' => '1.0',
    'id' => 'live',
    'name' => '互动直播',
    'v3' => true,
    'menu' => [
        'title' => '页面',
        'plugincom' => 1,
        'icon' => 'page',
        'items' => [
            ['title' => '直播间管理', 'route' => 'room'],
            ['title' => '分类管理', 'route' => 'category'],
            ['title' => '幻灯片管理', 'route' => 'banner'],
            [
                'title' => '其他',
                'items' => [
                    ['title' => '通信服务', 'route' => 'service']
                ]
            ],
            [
                'title' => '设置',
                'items' => [
                    ['title' => '入口设置', 'route' => 'cover'],
                    ['title' => '基础设置', 'route' => 'setting']
                ]
            ]
        ]
    ]
];