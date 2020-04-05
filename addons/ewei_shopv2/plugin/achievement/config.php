<?php
if (!defined('IN_IA')) {
	exit('Access Denied');
}

return array(
	'version' => '1.0',
	'id'      => 'achievement',
	'name'    => '绩效奖励',
	'v3'      => true,
	'menu'    => array(
		'title'     => '页面',
		'plugincom' => 1,
		'icon'      => 'page',
		'items'     => array(
			array(
				'title'   => '结算单',
				'items'   => array(
					array('title' => '待确认', 'route' => 'bonus.status0'),
					array('title' => '待结算', 'route' => 'bonus.status1'),
					array('title' => '已结算', 'route' => 'bonus.status2'),
					array('title' => '创建结算单', 'route' => 'bonus.build')
					),
				'extends' => array('achievement.bonus.detail')
				),
			array(
				'title' => '设置',
				'items' => array(
					array('title' => '入口设置', 'route' => 'cover'),
					array('title' => '通知设置', 'route' => 'notice'),
					array('title' => '基础设置', 'route' => 'set')
					)
				),
			)
		)
	);

?>
