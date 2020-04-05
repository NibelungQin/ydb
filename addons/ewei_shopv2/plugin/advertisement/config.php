<?php
if (!defined('IN_IA')) {
	exit('Access Denied');
}

return array(
	'version' => '1.0',
	'id'      => 'advertisement',
	'name'    => '广告系统',
	'v3'      => true,
	'menu'    => array(
		'title'     => '页面',
		'plugincom' => 1,
		'icon'      => 'page',
		'items'     => array(
			array('title' => '轮播管理', 'route' => 'adv'),
			array('title' => '广告套餐', 'route' => 'goods'),
			array('title' => '广告订单', 'route' => 'order_adv'),
			array('title' => '赏金记录', 'route' => 'history'),
			array(
				'title' => '基础设置',
				'items' => array(
					array('title' => '入口设置', 'route' => 'cover'),
				)
			)
		)
	)
);

?>
