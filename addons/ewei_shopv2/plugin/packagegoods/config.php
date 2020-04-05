<?php
if (!defined('IN_IA')) {
	exit('Access Denied');
}

return array(
	'version' => '1.0',
	'id'      => 'packagegoods',
	'name'    => '升级大礼包',
	'v3'      => true,
	'menu'    => array(
		'title'     => '页面',
		'plugincom' => 1,
		'icon'      => 'page',
		'items'     => array(
            array('title' => '轮播管理', 'route' => 'adv'),
            //array('title' => '分类管理', 'route' => 'category'),
            //array('title' => '礼包类型', 'route' => 'packagegoods_type'),
            array('title' => '礼包管理', 'route' => 'goods'),
			array(
				'title'  => '礼包订单',
				'route'  => 'order',
				'extend' => 'packagegoods.order.detail',
				'items'  => array(
					array(
						'title' => '待发货',
						'param' => array('status' => 1)
						),
					array(
						'title' => '待收货',
						'param' => array('status' => 2)
						),
					array(
						'title' => '待付款',
						'param' => array('status' => 3)
						),
					array(
						'title' => '已完成',
						'param' => array('status' => 4)
						),
					array(
						'title' => '已关闭',
						'param' => array('status' => 5)
						),
					array(
						'title' => '全部订单',
						'param' => array('status' => 'all')
						)
					)
				),
//			array(
//				'title'  => '核销查询',
//				'route'  => 'verify',
//				'extend' => 'packagegoods.verify.detail',
//				'items'  => array(
//					array(
//						'title' => '未核销',
//						'param' => array('verify' => 'normal')
//					),
//					array(
//						'title' => '已核销',
//						'param' => array('verify' => 'over')
//					),
//					array(
//						'title' => '已取消',
//						'param' => array('verify' => 'cancel')
//					)
//				)
//			),
//			array(
//				'title'  => '拼团管理',
//				'route'  => 'team',
//				'extend' => 'packagegoods.team.detail',
//				'items'  => array(
//					array(
//						'title' => '拼团成功',
//						'param' => array('type' => 'success')
//					),
//					array(
//						'title' => '拼团中',
//						'param' => array('type' => 'ing')
//					),
//					array(
//						'title' => '拼团失败',
//						'param' => array('type' => 'error')
//					),
//					array(
//						'title' => '全部拼团',
//						'param' => array('type' => 'all')
//					)
//				)
//			),
			array(
				'title'  => '维权设置',
				'route'  => 'refund',
				'extend' => 'packagegoods.refund.detail',
				'items'  => array(
					array(
						'title' => '维权申请',
						'param' => array('status' => 'apply')
					),
					array(
						'title' => '维权完成',
						'param' => array('status' => 'over')
					)
				)
			),
			array(
				'title'  => '佣金明细',
				'route'  => 'log',
				'extend' => 'packagegoods.log',
				'items'  => array(
					array(
						'title' => '分销佣金', 'route' => 'commission_log',
						'param' => array('status' => 'commission_log')
					),
					array(
						'title' => '店铺佣金', 'route' => 'globonus_log',
						'param' => array('status' => 'globonus_log')
					),
					array(
						'title' => '区域佣金','route' => 'abonus_log',
						'param' => array('status' => 'abonus_log')
					),
						array(
						'title' => '绩效佣金','route' => 'achievement_log',
						'param' => array('status' => 'abonus_log')
					)
				)
			),
			array(
				'title' => '礼包设置',
				'items' => array(
					array('title' => '入口设置', 'route' => 'cover'),
//					array('title' => '通知入口', 'route' => 'notice'),
					array('title' => '基础设置', 'route' => 'set'),
//					array(
//						'title'   => '快递打印',
//						'route'   => 'exhelper',
//						'extends' => array('packagegoods.exhelper.short', 'packagegoods.exhelper.express', 'packagegoods.exhelper.invoice', 'packagegoods.exhelper.sender', 'packagegoods.exhelper.single', 'packagegoods.exhelper.batch', 'packagegoods.exhelper.senderadd')
//						),
					array('title' => '批量发货', 'route' => 'batchsend')
					)
				),
            array(
                'title' => '销售统计',
                'items' => array(
                    array(
                        'title' => '销售统计',
                        'route' => 'sale'
                    ),
                    array(
                        'title' => '销售指标',
                        'route' => 'sale_analysis'
                    ),
                    array(
                        'title' => '订单统计',
                        'route' => 'order'
                    )
                )
            ),
			)
		)
	);

?>
