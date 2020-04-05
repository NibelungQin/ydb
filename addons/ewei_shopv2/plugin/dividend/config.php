<?php

if (!(defined('IN_IA'))) {
    exit('Access Denied');
}

return [
    'version' => '1.0',
    'id' => 'dividend',
    'name' => '团队分红',
    'v3' => true,
    'menu' => [
        'plugincom' => 1,
        'icon' => 'page',
        'items' => [
            ['title' => '队长管理', 'route' => 'agent'],
            ['title' => '分红订单', 'route' => 'statistics.order'],
            [
                'title' => '提现申请',
                'route' => 'apply',
                'items' => [
                    ['title' => '待审核', 'param' => ['status' => 1]],
                    ['title' => '待打款', 'param' => ['status' => 2]],
                    ['title' => '已打款', 'param' => ['status' => 3]],
                    ['title' => '无效', 'param' => ['status' => -1]]
                ]
            ],
            [
                'title' => '设置',
                'items' => [
                    ['title' => '通知设置', 'route' => 'notice'],
                    ['title' => '入口设置', 'route' => 'cover'],
                    ['title' => '基础设置', 'route' => 'set']
                ]
            ]
        ]
    ]
];