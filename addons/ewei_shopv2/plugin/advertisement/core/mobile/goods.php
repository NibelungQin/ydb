<?php
if (!(defined('IN_IA')))
{
	exit('Access Denied');
}
class Goods_EweiShopV2Page extends PluginMobileLoginPage
{
	public function main() {
		global $_W;
		global $_GPC;
		$openid = $_W['openid'];
		load()->model('mc');
		$uid = mc_openid2uid($openid);
		if (empty($uid)) {
			mc_oauth_userinfo($openid);
		}
		$uniacid = $_W['uniacid'];
		$id = intval($_GPC['id']);//商品ID
		$o_id = intval($_GPC['o_id']);//绑定套餐商品订单ID
		$mid = intval($_GPC['mid']);//接任务分享人ID

		$goods = pdo_fetch(
			'SELECT o.*,g.id as goods_id,g.title,g.thumb,g.thumb_url,g.content,g.marketprice,g.productprice,m.merchname,adv.groupsprice as adv_price FROM ' . tablename('ewei_shop_advertisement_order') . ' as o' . "\r\n\t\t\t\t"
			. 'left join ' . tablename('ewei_shop_goods') . ' g on g.id=o.goods_id and g.uniacid =  o.uniacid' . "\r\n\t\t\t\t"
			. 'left join ' . tablename('ewei_shop_merch_user') . ' m on m.id=o.merchid and m.uniacid =  o.uniacid' . "\r\n\t\t\t\t"
			. 'left join ' . tablename('ewei_shop_advertisement_goods') . ' adv on adv.id=o.adv_id and adv.uniacid =  o.uniacid' . "\r\n\t\t\t\t"
			. 'WHERE o.goods_id =:id and o.id=:o_id and o.uniacid=:uniacid and o_g_status=1 and o.status=1 limit 1', array(':uniacid' => $_W['uniacid'], ':id' => $id,'o_id'=>$o_id));

		if (empty($id) || empty($o_id) || empty($goods)) {
			$this->message('你访问的广告套餐商品不存在或已删除!', mobileUrl('advertisement'), 'error');
		}

		if (!(empty($goods['thumb']))) {
			$goods['thumb_url'] = array_merge(array($goods['thumb']),iunserializer($goods['thumb_url']));
		}
		if (!(empty($goods['task_money']))) {
			$goods['task_money'] = iunserializer($goods['task_money']);
		}
		if (!(empty($goods['share_money']))) {
			$goods['share_money'] = iunserializer($goods['share_money']);
		}
		//判断该会员身份是否满足身份条件
		$member = m('member')->getMember($openid);
		$level = pdo_fetch('select agentlevel from ' . tablename('ewei_shop_member') . ' where id=:id and uniacid=:uniacid limit 1', array(':id' => $member['id'], ':uniacid' => $_W['uniacid']));

		if($goods['task_money']['level']) {
			foreach($goods['task_money']['level'] as $k=>$v) {
				if($level['agentlevel']) {
					if($v == $level['agentlevel']) {
						$goods['actual_task_money'] = $goods['task_money']['money'][$k];
						$goods['actual_share_money'] = $goods['share_money']['money'][$k];
					}
				}else {
					$task_money[] = $goods['task_money']['money'][$k];
					$share_money[] = $goods['share_money']['money'][$k];
				}
			}
		}

		if(!$level['agentlevel']) {
			$goods['actual_task_money'] = min($task_money);
			$goods['actual_share_money'] = min($share_money);
		}
		//判断系统是否设置接任务人头数限制
		if($goods['task_limit_num'] > 0) {
			$sql = 'select count(*) from ' . tablename('ewei_shop_advertisement_task')  . '  where o_id=:o_id and uniacid=:uniacid ';
			$task_num = pdo_fetchcolumn($sql, array(':o_id' => $o_id, ':uniacid' => $_W['uniacid']));
			$t_num = $goods['task_limit_num'] - $task_num;
		}

		//判断该会员是否已经接了该任务
		$task = pdo_fetch('select id from ' . tablename('ewei_shop_advertisement_task') . ' where o_id=:o_id and mid=:mid and uniacid=:uniacid limit 1', array(':o_id' => $goods['id'],':mid' => $member['id'], ':uniacid' => $_W['uniacid']));

		//判断该任务是否已经结束了（即该套餐任务推广的广告费用已经用完了）
		$sql = 'select task_bonus,share_bonus from ' . tablename('ewei_shop_advertisement_bonus_log') . ' where uniacid = :uniacid and o_id = :o_id ';
		$param = array(':uniacid' => $_W['uniacid'], ':o_id' => $goods['id']);
		$pdo_res = pdo_fetchall($sql, $param);

		$price = 0;
		foreach ($pdo_res as $key => $value ) {
			$price += floatval($value['task_bonus'] + $value['share_bonus']);
		}
		$task_total_price = $goods['adv_price'] *(1-($goods['system_pro']/100));//除去平台抽取的广告抽成比例，拿出多少做广告推广费用
		$remnant_price = $task_total_price - $price;//求算出还剩多少推广的广告费用


		$goods = set_medias($goods, 'thumb');
		$goods['content'] = m('ui')->lazy($goods['content']);
		if (empty($goods)) {
			$this->message('广告套餐商品已下架或被删除!', mobileUrl('advertisement'), 'error');
		}

		$set = $_W['shopset'];
		$_W['shopshare'] = array(
			'title' => (!(empty($goods['share_title'])) ? $goods['share_title'] : $goods['title']),
			'imgUrl' => (!(empty($goods['share_icon'])) ? tomedia($goods['share_icon']) : tomedia($goods['thumb'])),
			'desc' => (!(empty($goods['share_desc'])) ? $goods['share_desc'] : $goods['description']),
			'link' => mobileUrl('goods/detail', array('o_id'=>$o_id,'id' => $id, 'mid' => $mid), true)
		);
		//生成分享海报二维码
		$goodscode = $this->get_code($goods['id']);
		include $this->template();
	}
	public function get_code($o_id){
		global $_W;
		global $_GPC;
		$id = intval($_GPC['id']);
		$uniacid = intval($_W['uniacid']);
		$openid = trim($_W['openid']);
		$goods = pdo_fetch('select id,minprice,maxprice,thumb_url,thumb,title from ' . tablename('ewei_shop_goods')
			. ' where id=:id and uniacid=:uniacid limit 1', array(':id' => $id, ':uniacid' => $_W['uniacid'])
		);

		$member = m('member')->getMember($openid);
		$commission_data = m('common')->getPluginset('commission');
		$goodscode = '';
		$parameter = array();

		if (com('goodscode')) {
			if ($goods['minprice'] == $goods['maxprice']) {
				$price = '¥' . $goods['minprice'];
			}else {
				$price = '¥' . $goods['minprice'] . ' ~ ' . $goods['maxprice'];
			}
			$goods['thumb_url'] = array_values(unserialize($goods['thumb_url']));
			$goods['thumb'] = $goods['thumb_url'][0];
			$url = mobileUrl('goods/detail', array('o_id'=>$o_id,'id' => $id, 'mid' => $member['id']), true);
			$qrcode = m('qrcode')->createQrcode($url);
			if ($commission_data['codeShare'] == 1) {
				$title[0] = mb_substr($goods['title'], 0, 10, 'utf-8');
				$title[1] = mb_substr($goods['title'], 10, 10, 'utf-8');
				$title = '    ' . $title[0] . "\r\n" . '    ' . $title[1];
				$codedata = array( 'portrait' => array('thumb' => (tomedia($_W['shopset']['shop']['logo']) ? tomedia($_W['shopset']['shop']['logo']) : tomedia($member['avatar'])), 'left' => 40, 'top' => 40, 'width' => 100, 'height' => 100), 'shopname' => array('text' => $_W['shopset']['shop']['name'], 'left' => 160, 'top' => 80, 'size' => 28, 'width' => 360, 'height' => 50, 'color' => '#333'), 'thumb' => array('thumb' => tomedia($goods['thumb']), 'left' => 40, 'top' => 160, 'width' => 560, 'height' => 560), 'qrcode' => array('thumb' => tomedia($qrcode), 'left' => 23, 'top' => 730, 'width' => 220, 'height' => 220), 'title' => array('text' => $title, 'left' => 230, 'top' => 770, 'size' => 24, 'width' => 360, 'height' => 50, 'color' => '#333'), 'price' => array('text' => $price, 'left' => 270, 'top' => 880, 'size' => 30, 'color' => '#f20'), 'desc' => array('text' => '长按二维码扫码购买', 'left' => 210, 'top' => 980, 'size' => 18, 'color' => '#666') );
			}else if ($commission_data['codeShare'] == 2) {
				$title[0] = mb_substr($goods['title'], 0, 14, 'utf-8');
				$title[1] = mb_substr($goods['title'], 14, 14, 'utf-8');
				$title = '    ' . $title[0] . "\r\n" . '    ' . $title[1];
				$codedata = array( 'thumb' => array('thumb' => tomedia($goods['thumb']), 'left' => 20, 'top' => 20, 'width' => 150, 'height' => 150), 'title' => array('text' => $title, 'left' => 170, 'top' => 30, 'size' => 22, 'width' => 430, 'height' => 90, 'color' => '#333'), 'price' => array('text' => $price, 'left' => 210, 'top' => 120, 'size' => 30, 'color' => '#f20'), 'qrcode' => array('thumb' => tomedia($qrcode), 'left' => 170, 'top' => 200, 'width' => 300, 'height' => 300), 'desc' => array('text' => '长按二维码扫码购买', 'left' => 205, 'top' => 510, 'size' => 18, 'color' => '#666'), 'shopname' => array('text' => $_W['shopset']['shop']['name'], 'left' => 0, 'top' => 585, 'size' => 28, 'width' => 640, 'height' => 50, 'color' => '#fff') );
			}else if ($commission_data['codeShare'] == 3) {
				$title[0] = mb_substr($goods['title'], 0, 12, 'utf-8');
				$title[1] = mb_substr($goods['title'], 12, 12, 'utf-8');
				$title = '                ' . $title[0] . "\r\n" . '                ' . $title[1];
				$codedata = array( 'title' => array('text' => $title, 'left' => 27, 'top' => 40, 'size' => 22, 'width' => 600, 'height' => 90, 'color' => '#333'), 'thumb' => array('thumb' => tomedia($goods['thumb']), 'left' => 0, 'top' => 150, 'width' => 640, 'height' => 640), 'qrcode' => array('thumb' => tomedia($qrcode), 'left' => 20, 'top' => 810, 'width' => 220, 'height' => 220), 'price' => array('text' => $price, 'left' => 280, 'top' => 870, 'size' => 30, 'color' => '#000'), 'desc' => array('text' => '长按二维码扫码购买', 'left' => 280, 'top' => 950, 'size' => 18, 'color' => '#666') );
			}
			$parameter = array('goodsid' => $id, 'qrcode' => $qrcode, 'codedata' => $codedata, 'mid' => $member['id'], 'codeshare' => $commission_data['codeShare']);
			$goodscode = com('goodscode')->createcode($parameter);
		}else {
			if ($goods['minprice'] == $goods['maxprice']) {
				$price = '¥' . $goods['minprice'];
			}else {
				$price = '¥' . $goods['minprice'] . ' ~ ' . $goods['maxprice'];
			}
			$url = mobileUrl('goods/detail', array('o_id' => $o_id,'id' => $id, 'mid' => $member['id']), true);
			$qrcode = m('qrcode')->createQrcode($url);
			if ($commission_data['codeShare'] == 1) {
				$title[0] = mb_substr($goods['title'], 0, 10, 'utf-8');
				$title[1] = mb_substr($goods['title'], 10, 10, 'utf-8');
				$title = '    ' . $title[0] . "\r\n" . '    ' . $title[1];
				$codedata = array(
					'portrait' => array(
						'thumb' => (tomedia($_W['shopset']['shop']['logo']) ? tomedia($_W['shopset']['shop']['logo']) : tomedia($member['avatar'])),
						'left' => 40,
						'top' => 40,
						'width' => 100,
						'height' => 100
					),
					'shopname' => array(
						'text' => $_W['shopset']['shop']['name'],
						'left' => 160,
						'top' => 80,
						'size' => 28,
						'width' => 360,
						'height' => 50,
						'color' => '#333'
					),
					'thumb' => array(
						'thumb' => tomedia($goods['thumb']),
						'left' => 40,
						'top' => 160,
						'width' => 560,
						'height' => 560
					),
					'qrcode' => array(
						'thumb' => tomedia($qrcode),
						'left' => 23,
						'top' => 730,
						'width' => 220,
						'height' => 220
					),
					'title' => array(
						'text' => $title,
						'left' => 230,
						'top' => 770,
						'size' => 24,
						'width' => 360,
						'height' => 50,
						'color' => '#333'
					),
					'price' => array(
						'text' => $price,
						'left' => 270,
						'top' => 880,
						'size' => 30,
						'color' => '#f20'
					),
					'desc' => array(
						'text' => '长按二维码扫码购买',
						'left' => 210,
						'top' => 980,
						'size' => 18,
						'color' => '#666'
					)
				);
			}else if ($commission_data['codeShare'] == 2) {
				$title[0] = mb_substr($goods['title'], 0, 14, 'utf-8');
				$title[1] = mb_substr($goods['title'], 14, 14, 'utf-8');
				$title = '    ' . $title[0] . "\r\n" . '    ' . $title[1];
				$codedata = array(
					'thumb' => array(
						'thumb' => tomedia($goods['thumb']),
						'left' => 20,
						'top' => 20,
						'width' => 150,
						'height' => 150
					),
					'title' => array(
						'text' => $title,
						'left' => 170,
						'top' => 30,
						'size' => 22,
						'width' => 430,
						'height' => 90,
						'color' => '#333'
					),
					'price' => array(
						'text' => $price,
						'left' => 210,
						'top' => 120,
						'size' => 30,
						'color' => '#f20'
					),
					'qrcode' => array(
						'thumb' => tomedia($qrcode),
						'left' => 170,
						'top' => 200,
						'width' => 300,
						'height' => 300
					),
					'desc' => array(
						'text' => '长按二维码扫码购买',
						'left' => 205,
						'top' => 510,
						'size' => 18,
						'color' => '#666'
					),
					'shopname' => array(
						'text' => $_W['shopset']['shop']['name'],
						'left' => 0,
						'top' => 585,
						'size' => 28,
						'width' => 640,
						'height' => 50,
						'color' => '#fff'
					)
				);
			}

			$parameter = array('o_id' => $o_id,'goodsid' => $id, 'qrcode' => $qrcode, 'codedata' => $codedata, 'mid' => $member['id'], 'codeshare' => $commission_data['codeShare']);
			$goodscode = m('goods')->createcode_advertisement($parameter);
		}
		return $goodscode;
	}
	//领取任务
	public function hand_task() {
		global $_W;
		global $_GPC;
		$o_id = intval($_GPC['id']);
		$openid = $_W['openid'];
		load()->model('mc');
		$uid = mc_openid2uid($openid);
		if (empty($uid)) {
			mc_oauth_userinfo($openid);
		}
		$member = m('member')->getMember($openid);
		$task = pdo_fetch('select id from ' . tablename('ewei_shop_advertisement_task') . ' where o_id=:o_id and mid=:mid and uniacid=:uniacid and task_status=1 limit 1', array(':o_id' => $o_id,':mid' => $member['id'], ':uniacid' => $_W['uniacid']));
		if($task) {
			show_json(0, array('message' => '您已领取了该任务，快去分享吧！！！'));exit();
		}
		$task_data = array(
			'uniacid' => $_W['uniacid'],
			'mid' => $member['id'],
			'o_id'=>$o_id,
			'task_createtime' => time(),
			'task_status' => 1,//1:进行中，2：已完成
		);
		pdo_insert('ewei_shop_advertisement_task', $task_data);
		$tid = pdo_insertid();
		if(!$tid) {
			show_json(0, array('message' => '操作失败！'));exit();
		}
		show_json(1, array('message' => '恭喜您接任务成功，快去分享拿取赏金吧！！！','url'=>referer()));exit();
	}

	public function openGroups() {
		global $_W;
		global $_GPC;
		$openid = $_W['openid'];
		$uniacid = $_W['uniacid'];
		$id = intval($_GPC['id']);
		load()->model('mc');
		$uid = mc_openid2uid($openid);
		if (empty($uid))
		{
			mc_oauth_userinfo($openid);
		}
		if (empty($id))
		{
			$this->message('你访问的商品不存在或已删除!', mobileUrl('groups'), 'error');
		}
		$goods = pdo_fetch('select * from ' . tablename('ewei_shop_groups_goods') . "\r\n\t\t\t\t\t" . 'where id = :id and status = :status and uniacid = :uniacid and deleted = 0 order by displayorder desc', array(':id' => $id, ':uniacid' => $uniacid, ':status' => 1));
		$goods['fightnum'] = pdo_fetchcolumn('select count(1) from ' . tablename('ewei_shop_groups_order') . ' where goodid = :goodid and uniacid = :uniacid and deleted = 0 and is_team = 1 and status > 0 ', array(':goodid' => $goods['id'], ':uniacid' => $uniacid));
		$goods['fightnum'] = $goods['teamnum'] + $goods['fightnum'];
		$goods = set_medias($goods, 'thumb');
		$ladder = array();
		if (($goods['is_ladder'] == 1) && ($_GPC['is_ladder'] == 1))
		{
			$ladder = pdo_getall('ewei_shop_groups_ladder', array('goods_id' => $id, 'uniacid' => $_W['uniacid']));
			$info = pdo_fetchall('SELECT count(ladder_id) as order_num FROM ' . tablename('ewei_shop_groups_order') . ' WHERE `uniacid` = :uniacid and `openid`!=:openid and success = 0 and is_team =1 and status>0 and ladder_id >0 and goodid = :goodid group by ladder_id', array(':uniacid' => $_W['uniacid'], 'openid' => $_W['openid'], 'goodid' => $id));
			if ($info[0]['order_num'] == 0)
			{
				$order_num = 0;
			}
			else
			{
				$order_num = 1;
			}
		}
		if ($_GPC['is_ladder'] != $goods['is_ladder'])
		{
			app_error('拼团类型错误,请重新选择!');
		}
		$specArr = array();
		if (($goods['more_spec'] == 1) && ($_GPC['more_spec'] == 1))
		{
			$group_goods = pdo_get('ewei_shop_groups_goods', array('id' => $id, 'uniacid' => $_W['uniacid']));
			if (empty($group_goods['gid']))
			{
				app_error('缺少商品');
			}
			$specArr = pdo_getall('ewei_shop_goods_spec', array('goodsid' => $group_goods['gid'], 'uniacid' => $_W['uniacid']), array('id', 'title'), '', array('displayorder' => 'desc'));
			foreach ($specArr as $k => $v )
			{
				$specArr[$k]['item'] = pdo_getall('ewei_shop_goods_spec_item', array('uniacid' => $_W['uniacid'], 'specid' => $v['id']), array('id', 'specid', 'title', 'thumb'), '', array('displayorder' => 'desc'));
			}
			$order_num = pdo_fetchcolumn('SELECT count(id) as order_num FROM ' . tablename('ewei_shop_groups_order') . ' WHERE `uniacid` = :uniacid and `openid`!=:openid and success = 0 and status>0 and more_spec =1 and is_team =1 and `goodid`=:goodid ', array(':uniacid' => $_W['uniacid'], 'openid' => $_W['openid'], 'goodid' => $id));
		}
		if (($goods['is_ladder'] == 0) && ($goods['more_spec'] == 0))
		{
			$order_num = pdo_fetchcolumn('SELECT count(id) as order_num FROM ' . tablename('ewei_shop_groups_order') . ' WHERE `uniacid` = :uniacid and `openid`!=:openid and success = 0 and is_team =1 and status>0 and `goodid`=:goodid ', array(':uniacid' => $_W['uniacid'], 'openid' => $_W['openid'], 'goodid' => $id));
		}
		$teams = pdo_fetchall('select * from ' . tablename('ewei_shop_groups_goods') . ' where deleted = 0 and status = 1 and uniacid = :uniacid order by sales desc limit 4', array(':uniacid' => $uniacid));
		foreach ($teams as $key => $value )
		{
			$value['fightnum'] = pdo_fetchcolumn('select count(1) from ' . tablename('ewei_shop_groups_order') . ' where goodid = :goodid and uniacid = :uniacid and deleted = 0 and is_team = 1 and status > 0 ', array(':goodid' => $value['id'], ':uniacid' => $uniacid));
			$value['fightnum'] = $value['teamnum'] + $value['fightnum'];
			$value = set_medias($value, 'thumb');
			$teams[$key] = $value;
		}
		if (empty($goods))
		{
			$this->message('商品已下架或被删除!', mobileUrl('groups'), 'error');
		}
		include $this->template();
	}
	public function fightGroups()
	{
		global $_W;
		global $_GPC;
		$openid = $_W['openid'];
		$uniacid = $_W['uniacid'];
		$id = intval($_GPC['id']);
		load()->model('mc');
		$uid = mc_openid2uid($openid);
		if (empty($uid))
		{
			mc_oauth_userinfo($openid);
		}
		$options_id = $_GPC['options_id'];
		if (empty($id))
		{
			$this->message('你访问的商品不存在或已删除!', mobileUrl('groups'), 'error');
		}
		$goods = pdo_fetch('select * from ' . tablename('ewei_shop_groups_goods') . "\r\n\t\t\t\t\t" . 'where id = :id and status = :status and uniacid = :uniacid and deleted = 0 order by displayorder desc', array(':id' => $id, ':uniacid' => $uniacid, ':status' => 1));
		$goods['fightnum'] = pdo_fetchcolumn('select count(1) from ' . tablename('ewei_shop_groups_order') . ' where goodid = :goodid and uniacid = :uniacid and deleted = 0 and is_team = 1 and status > 0 ', array(':goodid' => $goods['id'], ':uniacid' => $uniacid));
		$goods['fightnum'] = $goods['teamnum'] + $goods['fightnum'];
		$goods = set_medias($goods, 'thumb');
		if (($goods['is_ladder'] == 1) && (0 < $_GPC['ladder_id']))
		{
			$teams = pdo_fetchall('select o.paytime,o.id,o.goodid,o.ladder_id,o.is_ladder,o.teamid,m.nickname,m.realname,m.mobile,m.avatar,g.endtime,g.groupnum,g.thumb_url,l.ladder_num,l.ladder_price from ' . tablename('ewei_shop_groups_order') . ' as o' . "\r\n\t\t\t\t" . 'left join ' . tablename('ewei_shop_member') . ' as m on m.openid=o.openid and m.uniacid =  o.uniacid' . "\r\n\t\t\t\t" . 'left join ' . tablename('ewei_shop_groups_goods') . ' as g on g.id = o.goodid' . "\r\n\t\t\t\t" . 'left join ' . tablename('ewei_shop_groups_ladder') . ' as l on l.id = o.ladder_id' . "\r\n\t\t\t\t" . 'where o.goodid = :goodid and o.uniacid = :uniacid and o.openid != :openid and l.id = :ladder_id and o.deleted = 0 and o.heads = 1 and o.paytime > 0 and o.success = 0 limit 10 ', array(':goodid' => $goods['id'], ':uniacid' => $uniacid, ':openid' => $openid, ':ladder_id' => $_GPC['ladder_id']));
		}
		else
		{
			$teams = pdo_fetchall('select o.paytime,o.id,o.goodid,o.ladder_id,o.is_ladder,o.teamid,m.nickname,m.realname,m.mobile,m.avatar,g.endtime,g.groupnum,g.thumb_url,g.more_spec from ' . tablename('ewei_shop_groups_order') . ' as o' . "\r\n\t\t\t\t" . 'left join ' . tablename('ewei_shop_member') . ' as m on m.openid=o.openid and m.uniacid =  o.uniacid' . "\r\n\t\t\t\t" . 'left join ' . tablename('ewei_shop_groups_goods') . ' as g on g.id = o.goodid' . "\r\n\t\t\t\t" . 'where o.goodid = :goodid and o.uniacid = :uniacid and o.openid != :openid and o.deleted = 0 and o.heads = 1 and o.paytime > 0 and o.is_ladder = 0 and o.success = 0 limit 10 ', array(':goodid' => $goods['id'], ':uniacid' => $uniacid, ':openid' => $openid));
		}
		foreach ($teams as $key => $value )
		{
			$num = pdo_fetchcolumn('select count(1) from ' . tablename('ewei_shop_groups_order') . ' where uniacid = :uniacid and deleted = 0 and teamid = :teamid and status > 0 ', array(':teamid' => $value['teamid'], ':uniacid' => $uniacid));
			if ($value['is_ladder'] == 1)
			{
				$value['num'] = $value['ladder_num'] - $num;
			}
			else
			{
				$value['num'] = $value['groupnum'] - $num;
			}
			$value['residualtime'] = ($value['paytime'] + ($value['endtime'] * 60 * 60)) - time();
			$value['hour'] = intval($value['residualtime'] / 3600);
			$value['minite'] = intval(($value['residualtime'] / 60) % 60);
			$value['second'] = intval($value['residualtime'] % 60);
			$value['options_id'] = $options_id;
			$teams[$key] = $value;
		}
		include $this->template();
	}
	public function goodsCheck()
	{
		global $_W;
		global $_GPC;
		try
		{
			$uniacid = $_W['uniacid'];
			$id = intval($_GPC['id']);
			$type = $_GPC['type'];
			$openid = $_W['openid'];
			if (empty($id))
			{
				show_json(0, array('message' => '商品不存在！'));
			}
			$goods = pdo_fetch('select * from ' . tablename('ewei_shop_groups_goods') . "\r\n\t\t\t\t\t" . 'where id = :id and status = :status and uniacid = :uniacid and deleted = 0 order by displayorder desc', array(':id' => $id, ':uniacid' => $uniacid, ':status' => 1));
			if (empty($goods))
			{
				show_json(0, array('message' => '商品不存在！'));
			}
			if ($goods['stock'] <= 0)
			{
				show_json(0, array('message' => '您选择的商品库存不足，请浏览其他商品或联系商家！'));
			}
			if (empty($goods['status']))
			{
				show_json(0, array('message' => '您选择的商品已经下架，请浏览其他商品或联系商家！'));
			}
			$ordernum = pdo_fetchcolumn('select count(1) from ' . tablename('ewei_shop_groups_order') . ' as o' . "\r\n\t\t\t" . 'where openid = :openid and status >= :status and goodid = :goodid and uniacid = :uniacid', array(':openid' => $openid, ':status' => 0, ':goodid' => $id, ':uniacid' => $uniacid));
			if (!(empty($goods['purchaselimit'])) && ($goods['purchaselimit'] <= $ordernum))
			{
				show_json(0, array('message' => '您已到达此商品购买上限，请浏览其他商品或联系商家！'));
			}
			$order = pdo_fetch('select * from ' . tablename('ewei_shop_groups_order') . "\r\n" . '                where goodid = :goodid and status >= 0  and openid = :openid and uniacid = :uniacid and success = 0  and is_team = 1 and deleted = 0 ', array(':goodid' => $id, ':openid' => $openid, ':uniacid' => $uniacid));
			if ($order && ($order['status'] == 0))
			{
				show_json(0, array('message' => '您的订单已存在，请尽快完成支付！'));
			}
			if ($order && ($order['status'] == 1) && ($type == 'groups'))
			{
				show_json(0, array('message' => '您已经参与了该团，请等待拼团结束后再进行购买！'));
			}
			if ($type == 'single')
			{
				if (empty($goods['single']))
				{
					show_json(0, array('message' => '商品不允许单购，请重新选择！'));
				}
			}
			$ladder = array();
			if ($goods['is_ladder'] == 1)
			{
				$ladder = pdo_getall('ewei_shop_groups_ladder', array('goods_id' => $id, 'uniacid' => $_W['uniacid']));
				if ($_GPC['fightgroups'] == 1)
				{
					$info = pdo_fetchall('SELECT ladder_id,count(ladder_id) as order_num FROM ' . tablename('ewei_shop_groups_order') . ' WHERE `uniacid` = :uniacid and `openid`!=:openid and success = 0 and status>0 and ladder_id >0 and goodid = :goodid group by ladder_id', array(':uniacid' => $_W['uniacid'], 'openid' => $_W['openid'], 'goodid' => $id));
					if (!(empty($info)) && !(empty($ladder)))
					{
						foreach ($ladder as $key => $value )
						{
							foreach ($info as $k => $v )
							{
								if ($value['id'] == $v['ladder_id'])
								{
									$ladder[$key]['order_num'] = $v['order_num'];
								}
							}
						}
					}
				}
			}
			if (empty($goods['stock']))
			{
				show_json(0, array('message' => '商品库存为0，暂时无法购买，请浏览其他商品！'));
			}
			$specArr = array();
			if ($goods['more_spec'] == 1)
			{
				$group_goods = pdo_get('ewei_shop_groups_goods', array('id' => $id, 'uniacid' => $_W['uniacid']));
				if (empty($group_goods['gid']))
				{
					app_error('缺少商品');
				}
				$specArr = pdo_getall('ewei_shop_goods_spec', array('goodsid' => $group_goods['gid'], 'uniacid' => $_W['uniacid']), array('id', 'title'), '', array('displayorder' => 'desc'));
				foreach ($specArr as $k => $v )
				{
					$specArr[$k]['item'] = pdo_getall('ewei_shop_goods_spec_item', array('uniacid' => $_W['uniacid'], 'specid' => $v['id']), array('id', 'specid', 'title', 'thumb'), '', array('displayorder' => 'desc'));
				}
			}
			show_json(1, array('ladder' => $ladder, 'specArr' => $specArr));
		}
		catch (Exception $e)
		{
			$content = $e->getMessage();
			include $this->template('groups/error');
		}
	}
	public function get_option()
	{
		global $_W;
		global $_GPC;
		$specArr = $_GPC['spec_id'];
		asort($specArr);
		if (!(empty($specArr)))
		{
			$spec_id = implode('_', $specArr);
			$goods_option = pdo_get('ewei_shop_groups_goods_option', array('specs' => $spec_id, 'uniacid' => $_W['uniacid']));
			show_json(1, array('data' => $goods_option));
		}
	}
}
?>