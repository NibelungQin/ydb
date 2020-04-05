<?php

if (!defined('IN_IA')) {
    exit('Access Denied');
}

return [
    'version' => '1.0',
    'id' => 'article',
    'name' => '文章营销',
    'v3' => true,
    'menu' => [
        'plugincom' => 1,
        'items' => [
            [
                'title' => '文章管理',
                'route' => '',
                'extends' => ['article.record']
            ],
            ['title' => '分类管理', 'route' => 'category'],
            ['title' => '举报记录', 'route' => 'report'],
            ['title' => '其他设置', 'route' => 'set']
        ]
    ]
];
