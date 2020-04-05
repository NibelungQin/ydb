<?php
if (!(defined('IN_IA'))) 
{
	exit('Access Denied');
}
class Set_EweiShopV2Page extends PluginWebPage 
{
	public function main(){
		global $_W;
		global $_GPC;
		$uniacid = intval($_W['uniacid']);
		$set = pdo_fetch('SELECT * FROM ' . tablename('ewei_shop_packagegoods_set') . ' WHERE uniacid = :uniacid ', array(':uniacid' => $uniacid));
		if ($_W['ispost']) {
			//$goodsid = htmlspecialchars_decode($_GPC['goodsid']);
			//$goodsid = json_decode($goodsid, true);
			//$goodsid = array_keys($goodsid);

			$data2 = ((is_array($_GPC['data2']) ? $_GPC['data2'] : array()));
			$exchangekeyword = $data2['exchangekeyword'];
			$keyword = m('common')->keyExist($exchangekeyword);

			if (!(empty($keyword))) {
				if ($keyword['name'] != 'ewei_shopv2:packagegoods') {
					show_json(0, '关键字已存在!');
				}
			}
			$rule = pdo_fetch('select * from ' . tablename('rule') . ' where uniacid=:uniacid and module=:module and name=:name  limit 1', array(':uniacid' => $_W['uniacid'], ':module' => 'ewei_shopv2', ':name' => 'ewei_shopv2:packagegoods'));
			if (empty($rule)) {
				$rule_data = array(
					'uniacid' => $_W['uniacid'],
					'name' => 'ewei_shopv2:packagegoods',
					'module' => 'ewei_shopv2',
					'displayorder' => 0,
					'status' => 1
				);
				pdo_insert('rule', $rule_data);
				$rid = pdo_insertid();
				$keyword_data = array(
					'uniacid' => $_W['uniacid'],
					'rid' => $rid,
					'module' => 'ewei_shopv2',
					'content' => trim($exchangekeyword),
					'type' => 1,
					'displayorder' => 0,
					'status' => 1
				);
				pdo_insert('rule_keyword', $keyword_data);
			}else {
				pdo_update('rule_keyword', array('content' => trim($exchangekeyword)), array('rid' => $rule['id']));
			}
			//$this->updateSet($data2);
			$data = array(
				'uniacid' => $uniacid,
				'packagegoods' => intval($_GPC['data']['packagegoods']),

				'followurl' => trim($_GPC['data']['followurl']),//关注引导页(短链接)
				'followqrcode' => trim($_GPC['data']['followqrcode']),//关注二维码
				'packagegoodsurl' => trim($_GPC['data']['packagegoodsurl']),//升级礼包说明页面

				'share_title' => trim($_GPC['data']['share_title']),//分享标题
				'share_icon' => trim($_GPC['data']['share_icon']),//分享图标
				'share_desc' => trim($_GPC['data']['share_desc']),//分享描述
				'share_url' => trim($_GPC['data']['share_url']),//分享链接

				'packagegoods_description' => m('common')->html_images($_GPC['packagegoods_description']),//统一描述
				'description' => intval($_GPC['data']['description']),//是否显示统一描述

				'rules' => m('common')->html_images($_GPC['rules']),//升级大礼包规则

				'refundday' => intval($_GPC['data']['refundday']),//完成订单多少天内允许退款
				'receive' => intval($_GPC['data']['receive']),//订单发货后，用户收货的天数

				//'creditdeduct' => intval($_GPC['data']['creditdeduct']),//开启积分抵扣
				//'credit' => intval($_GPC['data']['credit']),//使用多少积分抵扣
				//'packagegoodsdeduct' => intval($_GPC['data']['packagegoodsdeduct']),//使用拼团、同步商城积分比例
				//'packagegoodsmoney' => $_GPC['data']['packagegoodsmoney'],//抵扣金额

				//'refund' => intval($_GPC['data']['refund']),//拼团失败后 ，系统会在X小时后自动退款
				//'discount' => intval($_GPC['data']['discount']),//开启所有商品团长优惠
				//'headstype' => intval($_GPC['headstype']),//团长优惠类型:1优惠金额2优惠折扣
				//'headsmoney' => floatval($_GPC['headsmoney']),//优惠金额
				//'headsdiscount' => intval($_GPC['headsdiscount']),//优惠折扣
				//'goodsid' => (!(empty($goodsid)) ? implode(',', $goodsid) : 0)//不允许退货商品ID
			);
			if (!(empty($set))) {
				$set_update = pdo_update('ewei_shop_packagegoods_set', $data, array('id' => $set['id'], 'uniacid' => $uniacid));
			}else {
				$set_insert = pdo_insert('ewei_shop_packagegoods_set', $data);
			}
			pdo_update('ewei_shop_packagegoods_goods', array('rights' => 1), array('uniacid' => $uniacid));

			//$goodsid = explode(',', $data['goodsid']);
			//foreach ($goodsid as $value ) {
				//$goods_update = pdo_update('ewei_shop_packagegoods_goods', array('rights' => 0), array('id' => intval($value), 'uniacid' => $uniacid));
			//}

			show_json(1, array('url' => webUrl('packagegoods/set', array('tab' => str_replace('#tab_', '', $_GPC['tab'])))));
		}
		$sys_data = m('common')->getPluginset('sale');
		$data2 = $this->set;

		$data = pdo_fetch('SELECT * FROM ' . tablename('ewei_shop_packagegoods_set') . ' WHERE uniacid = :uniacid ', array(':uniacid' => $uniacid));

		if ($data['goodsid']) {
			$goods = pdo_fetchall('SELECT *,packageprice as marketprice  FROM ' . tablename('ewei_shop_packagegoods_goods') . "\r\n" . '                    WHERE uniacid = :uniacid and id in (' . $data['goodsid'] . ') ', array(':uniacid' => $uniacid), 'id');
			$goods = set_medias($goods, 'thumb');
		}
		include $this->template();
	}
	public function query(){
		global $_W;
		global $_GPC;
		$kwd = trim($_GPC['keyword']);
		$params = array();
		$params[':uniacid'] = $_W['uniacid'];
		$params[':deleted'] = 0;
		$condition = ' and uniacid=:uniacid and deleted = :deleted ';
		if (!(empty($kwd))) {
			$condition .= ' AND `title` LIKE :keyword';
			$params[':keyword'] = '%' . $kwd . '%';
		}
		$ds = pdo_fetchall('SELECT id,title,rights,thumb FROM ' . tablename('ewei_shop_packagegoods_goods') . ' WHERE 1 ' . $condition . ' order by createtime desc', $params);
		$ds = set_medias($ds, array('thumb', 'share_icon'));
		if ($_GPC['suggest']) {
			exit(json_encode(array('value' => $ds)));
		}
		include $this->template();
	}
}
?>