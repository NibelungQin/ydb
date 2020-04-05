<?php
if (!(defined('IN_IA'))) 
{
	exit('Access Denied');
}
class Orders_EweiShopV2Page extends PluginMobileLoginPage {
	public function main() {
		global $_W;
		global $_GPC;
		$openid = $_W['openid'];
		load()->model('mc');
		$uid = mc_openid2uid($openid);
		if (empty($uid)) {
			mc_oauth_userinfo($openid);
		}
		$this->model->packagegoodsShare();
		include $this->template();
	}
	//订单详情
	public function detail(){
		global $_W;
		global $_GPC;
		$openid = $_W['openid'];
		$uniacid = $_W['uniacid'];
		$orderid = intval($_GPC['orderid']);
		$teamid = intval($_GPC['teamid']);
		$condition = ' and openid=:openid  and uniacid=:uniacid and id = :orderid and teamid = :teamid ';
		$order = pdo_fetch('select * from ' . tablename('ewei_shop_packagegoods_order') . "\r\n\t\t\t\t" . 'where openid=:openid  and uniacid=:uniacid and id = :orderid order by createtime desc ', array(':uniacid' => $uniacid, ':openid' => $openid, ':orderid' => $orderid));
		if ($order['refundid'] != 0) {
			$refund = pdo_fetch('SELECT *  FROM ' . tablename('ewei_shop_packagegoods_order_refund') . ' WHERE orderid = :orderid and uniacid=:uniacid order by id desc', array(':orderid' => $order['id'], ':uniacid' => $_W['uniacid']));
		}


		$good = pdo_fetch('select * from ' . tablename('ewei_shop_packagegoods_goods') . "\r\n\t\t\t\t\t" . 'where id = :id and status = :status and uniacid = :uniacid and deleted = 0 order by displayorder desc', array(':id' => $order['goodid'], ':uniacid' => $uniacid, ':status' => 1));
		$address = false;
		if (!(empty($order['addressid']))) {
			$address = iunserializer($order['address']);
			if (!(is_array($address))) {
				$address = pdo_fetch('select * from  ' . tablename('ewei_shop_member_address') . ' where id=:id limit 1', array(':id' => $order['addressid']));
			}
		}
		$carrier = @iunserializer($order['carrier']);
		if (!(is_array($carrier)) || empty($carrier)) {
			$carrier = false;
		}
		$this->model->packagegoodsShare();
		include $this->template();
	}
	//查看订单物流
	public function express() {
		global $_W;
		global $_GPC;
		$openid = $_W['openid'];
		$uniacid = $_W['uniacid'];
		$orderid = intval($_GPC['id']);
		if (empty($orderid)) 
		{
			header('location: ' . mobileUrl('packagegoods/orders'));
			exit();
		}
		$order = pdo_fetch('select * from ' . tablename('ewei_shop_packagegoods_order') . ' where id=:id and uniacid=:uniacid and openid=:openid limit 1', array(':id' => $orderid, ':uniacid' => $uniacid, ':openid' => $openid));
		if (empty($order)) {
			header('location: ' . mobileUrl('packagegoods/order'));
			exit();
		}
		if (empty($order['addressid'])) {
			$this->message('订单非快递单，无法查看物流信息!');
		}
		if ($order['status'] < 2) {
			$this->message('订单未发货，无法查看物流信息!');
		}
		$goods = pdo_fetch('select *  from ' . tablename('ewei_shop_packagegoods_goods') . '  where id=:id and uniacid=:uniacid ', array(':uniacid' => $uniacid, ':id' => $order['goodid']));
		$expresslist = m('util')->getExpressList($order['express'], $order['expresssn']);
		include $this->template();
	}
	//取消订单操作
	public function cancel() {
		global $_W;
		global $_GPC;
		try {
			$orderid = intval($_GPC['id']);
			$order = pdo_fetch('select id,orderno,openid,status,credit,creditmoney,price,freight,pay_type,success from ' . tablename('ewei_shop_packagegoods_order') . ' where id=:id and uniacid=:uniacid and openid=:openid limit 1', array(':id' => $orderid, ':uniacid' => $_W['uniacid'], ':openid' => $_W['openid']));
			$total = pdo_fetchcolumn('select count(1) from ' . tablename('ewei_shop_packagegoods_order'));
			if (empty($order)) {
				show_json(0, '订单未找到');
			}
			if ($order['status'] != 0) {
				show_json(0, '订单不能取消');
			}
			pdo_update('ewei_shop_packagegoods_order', array('status' => -1, 'canceltime' => time()), array('id' => $order['id'], 'uniacid' => $_W['uniacid']));
			p('packagegoods')->sendTeamMessage($orderid);
			show_json(1);
		}catch (Exception $e) {
			throw new $e->getMessage();
		}
	}
	//删除订单操作
	public function delete() {
		global $_W;
		global $_GPC;
		$orderid = intval($_GPC['id']);
		$order = pdo_fetch('select id,status from ' . tablename('ewei_shop_packagegoods_order') . ' where id=:id and uniacid=:uniacid and openid=:openid limit 1', array(':id' => $orderid, ':uniacid' => $_W['uniacid'], ':openid' => $_W['openid']));
		if (empty($order)) {
			show_json(0, '订单未找到!');
		}
		if (($order['status'] != 3) && ($order['status'] != -1)) {
			show_json(0, '无法删除');
		}
		pdo_update('ewei_shop_packagegoods_order', array('deleted' => 1), array('id' => $order['id'], 'uniacid' => $_W['uniacid']));
		show_json(1);
	}
	//加载大礼包订单列表数据
	public function get_list() {
		global $_W;
		global $_GPC;
		$list = array();
		$openid = $_W['openid'];
		load()->model('mc');
		$uid = mc_openid2uid($openid);
		if (empty($uid)) {
			mc_oauth_userinfo($openid);
		}
		$uniacid = $_W['uniacid'];
		$pindex = max(1, intval($_GPC['page']));
		$psize = 5;
		$status = $_GPC['status'];
		if ($status == 0) {
			$tab_all = true;
			$condition = ' and o.openid=:openid  and o.uniacid=:uniacid and o.deleted = :deleted ';
			$params = array(':uniacid' => $uniacid, ':openid' => $openid, ':deleted' => 0);
		}else {
			$condition = ' and o.openid=:openid  and o.uniacid=:uniacid and o.status = :status and o.deleted = :deleted  ';
			$params = array(':uniacid' => $uniacid, ':openid' => $openid, ':deleted' => 0);
			if ($status == 1) {
				$tab0 = true;
				$params[':status'] = 0;
			}else if ($status == 2) {
				$tab1 = true;
				$condition = ' and o.openid=:openid  and o.uniacid=:uniacid and o.deleted = :deleted and o.status = :status and (o.is_team = 0 or o.success = 1) ';
				$params[':status'] = 1;
			}else if ($status == 3) {
				$tab2 = true;
				$condition = ' and o.openid=:openid  and o.uniacid=:uniacid and o.deleted = :deleted and ( o.status = :status  or( o.status = :status2 )) ';
				$params[':status'] = 2;
				$params[':status2'] = 1;
			}else if ($status == 4) {
				$tab3 = true;
				$params[':status'] = 3;
			}
		}
		$orders = pdo_fetchall(
			'select o.id,o.orderno,o.createtime,o.price,o.freight,o.creditmoney,o.goodid,o.status,o.is_team,o.success,o.openid,' . "\r\n\t\t\t\t"
			. 'g.title,g.thumb,g.units,g.goodsnum,g.packageprice,o.uniacid,g.thumb_url' . "\r\n\t\t\t\t"
			. 'from ' . tablename('ewei_shop_packagegoods_order') . ' as o' . "\r\n\t\t\t\t"
			. 'left join ' . tablename('ewei_shop_packagegoods_goods') . ' as g on g.id = o.goodid' . "\r\n\t\t\t\t"
			. 'where 1 ' . $condition . ' order by o.createtime desc LIMIT ' . (($pindex - 1) * $psize) . ',' . $psize, $params);

		$total = pdo_fetchcolumn('select count(1) from ' . tablename('ewei_shop_packagegoods_order') . ' as o where 1 ' . $condition, $params);
		foreach ($orders as $key => $value ) {
			$orders[$key]['amount'] = ($value['price'] + $value['freight']) - $value['creditmoney'];
			$statuscss = 'text-cancel';
			switch ($value['status']) {
				case '-1': $status = '已取消';
				break;
				case '0': $status = '待付款';
				$statuscss = 'text-cancel';
				break;
				case '1':  if (($value['is_team'] == 0) || ($value['success'] == 1)){
					$status = '待发货';
					$statuscss = 'text-warning';
				}else if ($value['success'] == -1) {
					$status = '已过期';
					$statuscss = 'text-warning';
				}else {
					$status = '已付款';
					$statuscss = 'text-success';
				}
				break;
				case '2': $status = '待收货';
				$statuscss = 'text-danger';
				break;
				case '3': $status = '已完成';
				$statuscss = 'text-success';
				break;
			}
			$orders[$key]['statusstr'] = $status;
			$orders[$key]['statuscss'] = $statuscss;
		}
		$orders = set_medias($orders, 'thumb');
		show_json(1, array('list' => $orders, 'pagesize' => $psize, 'total' => $total));
	}
	//提交订单并跳转支付
	public function confirm() {
		global $_W;
		global $_GPC;
		$openid = $_W['openid'];
		$uniacid = $_W['uniacid'];
		load()->model('mc');
		$uid = mc_openid2uid($openid);
		if (empty($uid)) {
			mc_oauth_userinfo($openid);
		}
		$isverify = false;
		$goodid = intval($_GPC['id']);
		$type = $_GPC['type'];
		$member = m('member')->getMember($openid, true);
		$credit = array();
		$goods = pdo_fetch('select * from ' . tablename('ewei_shop_packagegoods_goods') . "\r\n\t\t\t\t"
			. 'where id = :id and uniacid = :uniacid and deleted = 0 order by displayorder desc', array(':id' => $goodid, ':uniacid' => $uniacid));
		$goods['packagedata'] = unserialize($goods['packagedata']);
		$goods['package_label'] = unserialize($goods['package_label']);
		if ($goods['stock'] <= 0) {
			$this->message('您选择的礼包库存不足，请浏览其他礼包或联系平台！');
		}
		if (empty($goods['status'])) {
			$this->message('您选择的礼包已经下架，请浏览其他礼包或联系平台！');
		}
		$follow = m('user')->followed($openid);
		if (!(empty($goods['followneed'])) && !($follow) && is_weixin()) {
			$followtext = ((empty($goods['followtext']) ? '如果您想要购买此礼包，需要您关注我们的公众号，点击【确定】关注后再来购买吧~' : $goods['followtext']));
			$followurl = ((empty($goods['followurl']) ? $_W['shopset']['share']['followurl'] : $goods['followurl']));
			$this->message($followtext, $followurl, 'error');
		}
		if ($type == 'single') {
			$ordernum = pdo_fetchcolumn('select count(1) from ' . tablename('ewei_shop_packagegoods_order') . ' as o' . "\r\n\t\t\t" . 'where openid = :openid and status >= :status and goodid = :goodid and uniacid = :uniacid and is_team = 0 ', array(':openid' => $openid, ':status' => 0, ':goodid' => $goodid, ':uniacid' => $uniacid));
		}
		if (!(empty($goods['purchaselimit'])) && ($goods['purchaselimit'] <= $ordernum)) {
			$this->message('您已到达此礼包购买上限，请浏览其他礼包或联系平台！');
		}
		if ($type == 'single') {
			$order = pdo_fetch('select * from ' . tablename('ewei_shop_packagegoods_order') . "\r\n"
				. '                where goodid = :goodid and status >= 0  and openid = :openid and uniacid = :uniacid and success = 0 and deleted = 0 and is_team = 0 ', array(':goodid' => $goodid, ':openid' => $openid, ':uniacid' => $uniacid));
		}
		if ($order && ($order['status'] == 0)) {
			$this->message('您的订单已存在，请尽快完成支付！');
		}
		if ($type == 'single') {
			$goodsprice = $goods['packageprice'];
			$price = $goods['packageprice'];
			$is_team = 0;
		}
		//$set = pdo_fetch('select discount,headstype,headsmoney,headsdiscount from ' . tablename('ewei_shop_packagegoods_set') . "\r\n\t\t\t\t\t" . 'where uniacid = :uniacid ', array(':uniacid' => $uniacid));
		$address = pdo_fetch('select * from ' . tablename('ewei_shop_member_address') . "\r\n\t\t\t\t"
			. 'where openid=:openid and deleted=0 and isdefault=1  and uniacid=:uniacid limit 1', array(':uniacid' => $uniacid, ':openid' => $openid)
		);
		$ordersn = m('common')->createNO('packagegoods_order', 'orderno', 'PT');

        //提交订单并跳转支付
		if ($_W['ispost']) {
			if (empty($_GPC['aid']) && !($isverify)) {
				header('location: ' . mobileUrl('packagegoods/address/post'));exit();
			}
			if ((0 < intval($_GPC['aid'])) && !($isverify)) {
				$order_address = pdo_fetch('select * from ' . tablename('ewei_shop_member_address') . ' where id=:id and openid=:openid and uniacid=:uniacid   limit 1', array(':uniacid' => $uniacid, ':openid' => $openid, ':id' => intval($_GPC['aid'])));
				if (empty($order_address)) {
					$this->message('未找到地址');
					header('location: ' . mobileUrl('packagegoods/address/post'));exit();
				}else {
					if (empty($order_address['province']) || empty($order_address['city'])) {
						$this->message('地址请选择省市信息');
						header('location: ' . mobileUrl('packagegoods/address/post'));exit();
					}
				}
			}
			$data = array(
			    'uniacid' => $_W['uniacid'],
                'openid' => $openid,
                'paytime' => '',
                'orderno' => $ordersn,
                'credit' => (intval($_GPC['isdeduct']) ? $_GPC['credit'] : 0),
                'creditmoney' => (intval($_GPC['isdeduct']) ? $_GPC['creditmoney'] : 0),
                'price' => $price,
                'freight' => $goods['freight'],
                'status' => 0,
                'goodid' => $goodid,
				'is_team' => $is_team,
                'addressid' => intval($_GPC['aid']),
                'address' => iserializer($order_address),
                'message' => trim($_GPC['message']),
                'realname' => ($isverify ? trim($_GPC['realname']) : ''),
                'mobile' => ($isverify ? trim($_GPC['mobile']) : ''),
                'endtime' => $goods['endtime'],
                'createtime' => TIMESTAMP
            );
			$order_insert = pdo_insert('ewei_shop_packagegoods_order', $data);
			if (!($order_insert)) {
				$this->message('生成订单失败！');
			}
			$orderid = pdo_insertid();

			//分销模式
			if($goods['commission_type']) {
				$pluginc = p('commission');
				if ($pluginc) {
					$pluginc->checkOrderConfirm_packagegoods($orderid);
				}
			}
			$order = pdo_fetch('select * from ' . tablename('ewei_shop_packagegoods_order')
				. "\r\n\t\t\t\t\t\t" . 'where id = :id and uniacid = :uniacid ', array(':id' => $orderid, ':uniacid' => $uniacid));
			header('location: ' . MobileUrl('packagegoods/pay', array( 'orderid' => $orderid)));
		}

		$this->model->packagegoodsShare();

		include $this->template();
	}
	//确认订单收货
	public function finish(){
		global $_W;
		global $_GPC;
		$orderid = intval($_GPC['id']);
		$order = pdo_fetch(
			'select * from ' . tablename('ewei_shop_packagegoods_order')
			. ' where id=:id and uniacid=:uniacid limit 1', array(':id' => $orderid, ':uniacid' => $_W['uniacid'])
		);
		if (empty($order)) {
			show_json(0, '订单未找到');
		}
		if ($order['status'] != 2) {
			show_json(0, '订单不能确认收货');
		}
		if ((0 < $order['refundstate']) && !(empty($order['refundid']))) {
			$change_refund = array();
			$change_refund['refundstatus'] = -2;
			$change_refund['refundtime'] = time();
			pdo_update('ewei_shop_packagegoods_order_refund', $change_refund, array('id' => $order['refundid'], 'uniacid' => $_W['uniacid']));
		}
		pdo_update('ewei_shop_packagegoods_order', array('status' => 3, 'finishtime' => time(), 'refundstate' => 0), array('id' => $order['id'], 'uniacid' => $_W['uniacid']));
		//分销等级
		p('packagegoods')->Commission_packagens($order);
		p('packagegoods')->sendTeamMessage($orderid);
		show_json(1);
	}

}
?>