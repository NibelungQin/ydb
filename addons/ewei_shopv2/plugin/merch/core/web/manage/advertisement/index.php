<?php

use Ydb\Entity\Manual\Goods;

if (!(defined('IN_IA')))
{
	exit('Access Denied');
}
require EWEI_SHOPV2_PLUGIN . 'merch/core/inc/page_merch.php';
class Merch_Advertisement_Index_EweiShopV2MerchWebPage extends MerchWebPage {
	//总平台广告套餐列表
	public function main() {
		global $_W;
		global $_GPC;
		$pindex = max(1, intval($_GPC['page']));
		$psize = 20;

		$condition = ' WHERE `uniacid` = :uniacid';
		$params = array(':uniacid' => $_W['uniacid']);

		if (!(empty($_GPC['keyword']))) {
			$_GPC['keyword'] = trim($_GPC['keyword']);
			$condition .= ' AND (`id` = :id or `title` LIKE :keyword )';
			$params[':keyword'] = '%' . $_GPC['keyword'] . '%';
			$params[':id'] = $_GPC['keyword'];
		}
		$condition .= ' AND `status` = 1 AND `stock` > 0';
		$sql = 'SELECT COUNT(`id`) FROM ' . tablename('ewei_shop_advertisement_goods') . $condition;
		$total = pdo_fetchcolumn($sql, $params);

		$list = array();
		if (!(empty($total))) {
			$sql = 'SELECT * FROM ' . tablename('ewei_shop_advertisement_goods') . $condition . ' ORDER BY `status` DESC, `displayorder` DESC,' . ' `id` DESC LIMIT ' . (($pindex - 1) * $psize) . ',' . $psize;
			$list = pdo_fetchall($sql, $params);
			$pager = pagination2($total, $pindex, $psize);
		}
		include $this->template('advertisement');
	}
	//总平台广告套餐编辑详情
	public function edit(){
		$this->post();
	}
	protected function post(){
		require dirname(__FILE__) . '/post.php';
	}
	//处理选取单个广告套餐
	public function selection_adv() {
		global $_W;
		global $_GPC;
		$adv_id = intval($_GPC['adv_id']);
		$adv_num = intval($_GPC['adv_num']);

		$adv_list = pdo_fetch('select id,adv_num from ' . tablename('ewei_shop_advertisement_merch_order') . ' where adv_id=:adv_id and uniacid=:uniacid and merch_id=:merch_id limit 1', array(':uniacid' => $_W['uniacid'],':merch_id' => $_W['merchid'], ':adv_id' => $adv_id));
		if($adv_list) {
			$adv_data = array(
				'adv_num'=>($adv_num+$adv_list['adv_num']),
			);
			pdo_update('ewei_shop_advertisement_merch_order', $adv_data, array('id' => $adv_list['id'],'adv_id' => $adv_id,'merch_id' => $_W['merchid'],'uniacid' => $_W['uniacid']));
		}else {
			$ordersn = m('common')->createNO('advertisement_merch_order', 'ordersn', 'PT');
			$adv_data = array(
				'uniacid' => $_W['uniacid'],
				'merch_id' => $_W['merchid'],
				'adv_num'=>$adv_num,
				'adv_id' => $adv_id,
				'ordersn' => $ordersn,
				'create_time' => TIMESTAMP,
			);
			pdo_insert('ewei_shop_advertisement_merch_order', $adv_data);
		}
		//选取了商品更新广告套餐总发行的库存数量
		$adv_total = pdo_fetch('select stock from ' . tablename('ewei_shop_advertisement_goods') . ' where id=:id and uniacid=:uniacid limit 1', array(':id' => $adv_id,':uniacid' => $_W['uniacid']));
		$goods_data = $adv_total['stock']-$adv_num;
		pdo_update('ewei_shop_advertisement_goods', array('stock'=>$goods_data), array('id' => $adv_id, 'uniacid' => $_W['uniacid']));
		show_json(1, array('url' => webUrl('advertisement/selected_adv')));
	}
	//处理选取多个广告套餐
	public function more_selected_adv() {
		global $_W;
		global $_GPC;
		$adv_ids = $_GPC['adv_ids'];
		$adv_nums = $_GPC['adv_nums'];
		for($i=0;$i<count($adv_ids);$i++) {
			$adv_list[] = pdo_fetch('select id,adv_num from ' . tablename('ewei_shop_advertisement_merch_order') . ' where adv_id=:adv_id and uniacid=:uniacid and merch_id=:merch_id limit 1', array(':uniacid' => $_W['uniacid'],':merch_id' => $_W['merchid'], ':adv_id' => $adv_ids[$i]));
		}
		foreach($adv_list as $k=>$v) {
			if($adv_list[$k]) {
				$adv_data = array(
					'adv_num'=>($adv_nums[$k]+$v['adv_num']),
				);
				pdo_update('ewei_shop_advertisement_merch_order', $adv_data, array('id' => $v['id'],'adv_id' => $adv_ids[$k],'merch_id' => $_W['merchid'],'uniacid' => $_W['uniacid']));
			}else {
				$adv_data = array(
					'uniacid' => $_W['uniacid'],
					'merch_id' => $_W['merchid'],
					'adv_num'=>$adv_nums[$k],
					'adv_id' => $adv_ids[$k],
					'create_time' => TIMESTAMP,
				);
				pdo_insert('ewei_shop_advertisement_merch_order', $adv_data);
			}
			//选取了商品更新广告套餐总发行的库存数量
			$adv_total = pdo_fetch('select stock from ' . tablename('ewei_shop_advertisement_goods') . ' where id=:id and uniacid=:uniacid limit 1', array(':id' => $adv_ids[$k],':uniacid' => $_W['uniacid']));
			$goods_data = $adv_total['stock']-$adv_nums[$k];
			pdo_update('ewei_shop_advertisement_goods', array('stock'=>$goods_data), array('id' => $adv_ids[$k], 'uniacid' => $_W['uniacid']));
		}
		show_json(1, array('url' => webUrl('advertisement/selected_adv')));
	}

	//已选取广告套餐管理
	public function selected_adv() {
		global $_W;
		global $_GPC;
		$pindex = max(1, intval($_GPC['page']));
		$psize = 20;

		$condition = ' WHERE `uniacid` = :uniacid';
		$params = array(':uniacid' => $_W['uniacid']);
		$condition = ' WHERE `uniacid` = :uniacid and `merch_id`=:merchid';
		$params = array(':uniacid' => $_W['uniacid'], ':merchid' => $_W['merchid']);

		if (!(empty($_GPC['keyword']))) {
			$_GPC['keyword'] = trim($_GPC['keyword']);
			$condition .= ' AND (`id` = :id or `title` LIKE :keyword )';
			$params[':keyword'] = '%' . $_GPC['keyword'] . '%';
			$params[':id'] = $_GPC['keyword'];
		}

		$sql = 'SELECT COUNT(`id`) FROM ' . tablename('ewei_shop_advertisement_merch_order') . $condition;
		$total = pdo_fetchcolumn($sql, $params);

		$list = array();
		if (!(empty($total))) {
			$sql = 'SELECT id as o_id,adv_id,adv_num FROM ' . tablename('ewei_shop_advertisement_merch_order') . $condition . ' ORDER BY `create_time` DESC,' . ' `id` DESC LIMIT ' . (($pindex - 1) * $psize) . ',' . $psize;
			$list = pdo_fetchall($sql, $params);
			foreach($list as $k=>$v) {
				$list[$k]['goods'] = pdo_fetch('SELECT title,groupsprice,thumb,status FROM ' . tablename('ewei_shop_advertisement_goods') . ' WHERE id = :id and uniacid=:uniacid', array(':id' => $v['adv_id'], ':uniacid' => $_W['uniacid']));
			}
			$pager = pagination2($total, $pindex, $psize);
		}

		include $this->template();
	}
	//处理广告套餐绑定商品逻辑操作
	public function selected_adv_edit() {
		global $_W;
		global $_GPC;
		$id = intval($_GPC['id']);
		$item = pdo_fetch(
			'SELECT o.*,advg.* FROM ' . tablename('ewei_shop_advertisement_merch_order') . ' as o' . "\r\n\t\t\t\t"
			. 'left join ' . tablename('ewei_shop_advertisement_goods') . ' as advg on advg.id = o.adv_id and advg.uniacid =  o.uniacid' . "\r\n\t\t\t\t"
			. 'WHERE o.id =:id and o.uniacid=:uniacid and o.merch_id=:merchid limit 1', array(':uniacid' => $_W['uniacid'],':merchid' => $_W['merchid'], ':id' => $id));
		if (!(empty($id))) {
			if (empty($item)) {
				$this->message('抱歉，广告套餐订单不存在或是已经删除！', '', 'error');
			}
			if (!(empty($item['thumb']))) {
				$piclist_adv = array_merge(array($item['thumb']), iunserializer($item['thumb_url']));
			}
			$item['content'] = m('common')->html_to_images($item['content']);
		}
		//设置操作
		if ($_W['ispost']) {
			$adv_id = intval($_GPC['adv_id']);
			$goods_id = intval($_GPC['goodsid'][0]);
			if(empty($goods_id)) {
				show_json(0, '请选择绑定的商品！');exit();
			}
			//判断：一个广告套餐能仅能绑定一个商品！！！
			$adv_total = pdo_fetch('select adv_id from ' . tablename('ewei_shop_advertisement_order') . ' where adv_id=:adv_id and goods_id=:goods_id and merchid=:merchid and uniacid=:uniacid limit 1', array(':adv_id' => $adv_id,':goods_id' => $goods_id,':uniacid' => $_W['uniacid'], ':merchid' => $_W['merchid']));
			if($adv_total) {
				show_json(0, '此广告套餐已绑定该商品，请勿重复添加！');exit();
			}
			$ordersn = m('common')->createNO('advertisement_order', 'ordersn', 'PT');
			$data = array(
				'uniacid' => $_W['uniacid'],
				'merchid' => $_W['merchid'],
				'adv_id' => $adv_id,//广告套餐ID
				'goods_id' => $goods_id,
				'createtime' => $_W['timestamp'],
				'ordersn' => $ordersn,
				'status' => 0,//绑定商品提交广告套餐订单状态：0：审核中 1：审核通过 2：审核失败
			);
			$goods_insert = pdo_insert('ewei_shop_advertisement_order', $data);
			if (!($goods_insert)) {
				show_json(0, '广告套餐绑定失败！');
			}
			//绑定了商品更新其选取的广告套餐的数量
			$adv_order_total = pdo_fetch('select adv_num from ' . tablename('ewei_shop_advertisement_merch_order') . ' where adv_id=:adv_id and merch_id=:merchid and uniacid=:uniacid limit 1', array(':adv_id' => $adv_id,':uniacid' => $_W['uniacid'], ':merchid' => $_W['merchid']));
			$goods_data = $adv_order_total['adv_num']-1;
			pdo_update('ewei_shop_advertisement_merch_order', array('adv_num'=>$goods_data), array('id' => $id, 'uniacid' => $_W['uniacid']));
			show_json(1, array('url' => webUrl('advertisement/bind_adv_goods_order')));
		}
		include $this->template();exit;
	}

	//已绑定商品广告套餐订单列表
	public function bind_adv_goods_order() {
		global $_W;
		global $_GPC;
		$pindex = max(1, intval($_GPC['page']));
		$psize = 20;

		$condition = ' WHERE `uniacid` = :uniacid';
		$params = array(':uniacid' => $_W['uniacid']);
		$condition = ' WHERE `uniacid` = :uniacid and `merchid`=:merchid';
		$params = array(':uniacid' => $_W['uniacid'], ':merchid' => $_W['merchid']);

		if (!(empty($_GPC['keyword']))) {
			$_GPC['keyword'] = trim($_GPC['keyword']);
			$condition .= ' AND (`id` = :id or `title` LIKE :keyword )';
			$params[':keyword'] = '%' . $_GPC['keyword'] . '%';
			$params[':id'] = $_GPC['keyword'];
		}

		$sql = 'SELECT COUNT(`id`) FROM ' . tablename('ewei_shop_advertisement_order') . $condition;
		$total = pdo_fetchcolumn($sql, $params);

		$list = array();
		if (!(empty($total))) {
			$sql = 'SELECT * FROM ' . tablename('ewei_shop_advertisement_order') . $condition . ' ORDER BY `createtime` DESC,' . ' `id` DESC LIMIT ' . (($pindex - 1) * $psize) . ',' . $psize;
			$list = pdo_fetchall($sql, $params);
			foreach($list as $k=>$v) {
				$list[$k]['adv'] = pdo_fetch('SELECT title,thumb FROM ' . tablename('ewei_shop_advertisement_goods') . ' WHERE id = :id and uniacid=:uniacid', array(':id' => $v['adv_id'], ':uniacid' => $_W['uniacid']));
				$list[$k]['goods'] = pdo_fetch('SELECT title,thumb FROM ' . tablename('ewei_shop_goods') . ' WHERE id = :id and uniacid=:uniacid and merchid=:merchid', array(':id' => $v['goods_id'],':merchid' => $v['merchid'], ':uniacid' => $_W['uniacid']));
			}
			$pager = pagination2($total, $pindex, $psize);
		}
		include $this->template();
	}
	//对广告套餐商品订单的设置操作
	public function bind_adv_goods_edit() {
		global $_W;
		global $_GPC;
		$id = intval($_GPC['id']);
		$item = pdo_fetch(
			'SELECT o.*,advg.title as adv_title,advg.stock,advg.showstock,advg.content,advg.groupsprice,advg.price as adv_price,advg.thumb as adv_thumb,advg.thumb_url as adv_thumb_url,g.title as g_title,g.thumb as g_thumb,g.thumb_url as g_thumb_url,m.merchname FROM ' . tablename('ewei_shop_advertisement_order') . ' as o' . "\r\n\t\t\t\t"
			. 'left join ' . tablename('ewei_shop_advertisement_goods') . ' as advg on advg.id = o.adv_id and advg.uniacid =  o.uniacid' . "\r\n\t\t\t\t"
			. 'left join ' . tablename('ewei_shop_goods') . ' g on g.id=o.goods_id and g.uniacid =  o.uniacid' . "\r\n\t\t\t\t"
			. 'left join ' . tablename('ewei_shop_merch_user') . ' m on m.id=o.merchid and m.uniacid =  o.uniacid' . "\r\n\t\t\t\t"
			. 'WHERE o.id =:id and o.uniacid=:uniacid and o.merchid=:merchid limit 1', array(':uniacid' => $_W['uniacid'],':merchid' => $_W['merchid'], ':id' => $id));
		if (!(empty($item['task_money']))) {
			$item['task_money'] = iunserializer($item['task_money']);
		}
		if (!(empty($item['share_money']))) {
			$item['share_money'] = iunserializer($item['share_money']);
		}
		//代理等级
		$levellist = pdo_fetchall('SELECT id,levelname FROM ' . tablename('ewei_shop_commission_level'));
		if (!(empty($id))) {
			if (empty($item)) {
				$this->message('抱歉，广告套餐订单不存在或是已经删除！', '', 'error');
			}
			if (!(empty($item['adv_thumb']))) {
				$piclist_adv = array_merge(array($item['adv_thumb']), iunserializer($item['adv_thumb_url']));
			}
			if (!(empty($item['g_thumb']))) {
				$piclist_goods = array_merge(array($item['g_thumb']), iunserializer($item['g_thumb_url']));
			}
			$item['content'] = m('common')->html_to_images($item['content']);
		}
		//设置操作
		if ($_W['ispost']) {
//			$adv_id = intval($_GPC['adv_id']);
//			$goods_id = intval($_GPC['goodsid'][0]);
//
//			//判断：一个广告套餐能仅能绑定一个商品！！！
//			$adv_total = pdo_fetch('select adv_id from ' . tablename('ewei_shop_advertisement_order') . ' where adv_id=:adv_id and merchid=:merchid and uniacid=:uniacid limit 1', array(':adv_id' => $adv_id,':uniacid' => $_W['uniacid'], ':merchid' => $_W['merchid']));
//			$goods_total = pdo_fetch('select goods_id from ' . tablename('ewei_shop_advertisement_order') . ' where goods_id=:goods_id and merchid=:merchid and uniacid=:uniacid limit 1', array(':goods_id' => $goods_id,':uniacid' => $_W['uniacid'], ':merchid' => $_W['merchid']));
//			if($adv_total || $goods_total) {
//				show_json(0, '此广告套餐已绑定该商品，请勿重复添加！');exit();
//			}
//			$ordersn = m('common')->createNO('advertisement_order', 'ordersn', 'PT');
//			$data = array(
//				'uniacid' => $_W['uniacid'],
//				'merchid' => $_W['merchid'],
//				'adv_id' => $adv_id,//广告套餐ID
//				'goods_id' => $goods_id,
//				'createtime' => $_W['timestamp'],
//				'ordersn' => $ordersn,
//				'status' => 0,//绑定商品提交广告套餐订单状态：0：审核中 1：审核通过 2：审核失败
//			);
//			$goods_insert = pdo_insert('ewei_shop_advertisement_order', $data);
//			if (!($goods_insert)) {
//				show_json(0, '广告套餐绑定失败！');
//			}
//			//绑定了商品更新其选取的广告套餐的数量
//			$adv_order_total = pdo_fetch('select adv_num from ' . tablename('ewei_shop_advertisement_merch_order') . ' where adv_id=:adv_id and merch_id=:merchid and uniacid=:uniacid limit 1', array(':adv_id' => $adv_id,':uniacid' => $_W['uniacid'], ':merchid' => $_W['merchid']));
//			$goods_data = $adv_order_total['adv_num']-1;
//			pdo_update('ewei_shop_advertisement_merch_order', array('adv_num'=>$goods_data), array('id' => $id, 'uniacid' => $_W['uniacid']));
//			show_json(1, array('url' => merchUrl('advertisement/bind_adv_goods_order')));
		}
		include $this->template();exit;
	}
	//操作已绑定套餐商品上下架
	public function status(){
		global $_W;
		global $_GPC;
		$id = intval($_GPC['id']);
		pdo_update('ewei_shop_advertisement_order', array('o_g_status' => intval($_GPC['o_g_status'])), array('id' => $id,'uniacid'=>$_W['uniacid'],'merchid'=>$_W['merchid']));
		show_json(1, array('url' => referer()));
	}









	public function add(){
		$this->post();
	}
	public function sale(){
		$this->main('sale');
	}
	public function out(){
		$this->main('out');
	}
	public function stock(){
		$this->main('stock');
	}
	public function cycle(){
		$this->main('cycle');
	}
	public function verify(){
		$this->main('verify');
	}
	public function check(){
		$this->main('check');
	}
	public function delete() {
		global $_W;
		global $_GPC;
		$id = intval($_GPC['id']);
		if (empty($id)) {
			$id = ((is_array($_GPC['ids']) ? implode(',', $_GPC['ids']) : 0));
		}
		$items = pdo_fetchall('SELECT id,title FROM ' . tablename('ewei_shop_goods') . ' WHERE id in( ' . $id . ' ) AND uniacid=' . $_W['uniacid']);
		foreach ($items as $item ) {
			pdo_update('ewei_shop_goods', array('deleted' => 1), array('id' => $item['id']));
			mplog('goods.delete', '删除商品 ID: ' . $item['id'] . ' 商品名称: ' . $item['title'] . ' ');
		}
		show_json(1, array('url' => referer()));
	}
	public function delete1(){
		global $_W;
		global $_GPC;
		$id = intval($_GPC['id']);
		if (empty($id)) {
			$id = ((is_array($_GPC['ids']) ? implode(',', $_GPC['ids']) : 0));
		}
		$items = pdo_fetchall('SELECT id,title FROM ' . tablename('ewei_shop_goods') . ' WHERE id in( ' . $id . ' ) AND uniacid=' . $_W['uniacid']);
		foreach ($items as $item ) {
			pdo_delete('ewei_shop_goods', array('id' => $item['id']));
			mplog('goods.edit', '从回收站彻底删除商品<br/>ID: ' . $item['id'] . '<br/>商品名称: ' . $item['title']);
		}
		show_json(1, array('url' => referer()));
	}
	public function restore(){
		global $_W;
		global $_GPC;
		$id = intval($_GPC['id']);
		if (empty($id)) {
			$id = ((is_array($_GPC['ids']) ? implode(',', $_GPC['ids']) : 0));
		}
		$items = pdo_fetchall('SELECT id,title FROM ' . tablename('ewei_shop_goods') . ' WHERE id in( ' . $id . ' ) AND uniacid=' . $_W['uniacid']);
		foreach ($items as $item ) {
			pdo_update('ewei_shop_goods', array('deleted' => 0), array('id' => $item['id']));
			mplog('goods.edit', '从回收站恢复商品<br/>ID: ' . $item['id'] . '<br/>商品名称: ' . $item['title']);
		}
		show_json(1, array('url' => referer()));
	}
	public function property(){
		global $_W;
		global $_GPC;
		$id = intval($_GPC['id']);
		$type = $_GPC['type'];
		$data = intval($_GPC['data']);
		if (array_key_exists($type, Goods::TYPE)) {
			pdo_update('ewei_shop_goods', array('is' . $type => $data), array('id' => $id, 'uniacid' => $_W['uniacid']));
			$typestr = Goods::TYPE[$type];
			mplog('goods.edit', '修改商品' . $typestr . '状态   ID: ' . $id);
		}
		if (in_array($type, array('status'))) {
			pdo_update('ewei_shop_goods', array($type => $data), array('id' => $id, 'uniacid' => $_W['uniacid']));
			mplog('goods.edit', '修改商品上下架状态   ID: ' . $id);
		}
		if (in_array($type, array('type'))) {
			pdo_update('ewei_shop_goods', array($type => $data), array('id' => $id, 'uniacid' => $_W['uniacid']));
			mplog('goods.edit', '修改商品类型   ID: ' . $id);
		}
		show_json(1);
	}
	public function change(){
		global $_W;
		global $_GPC;
		$id = intval($_GPC['id']);
		if (empty($id)) {
			show_json(0, array('message' => '参数错误'));
		}
		$type = trim($_GPC['type']);
		$value = trim($_GPC['value']);
		if (!(in_array($type, array('title', 'marketprice', 'total', 'goodssn', 'productsn', 'displayorder', 'merchdisplayorder')))) {
			show_json(0, array('message' => '参数错误'));
		}
		$goods = pdo_fetch('select id,hasoption from ' . tablename('ewei_shop_goods') . ' where id=:id and uniacid=:uniacid limit 1', array(':uniacid' => $_W['uniacid'], ':id' => $id));
		if (empty($goods)) {
			show_json(0, array('message' => '参数错误'));
		}
		if ($type == 'title') {
			$checked = 1;
		}else {
			$checked = 0;
		}
		pdo_update('ewei_shop_goods', array($type => $value, 'checked' => $checked), array('id' => $id));
		if ($goods['hasoption'] == 0) {
			$sql = 'update ' . tablename('ewei_shop_goods') . ' set minprice = marketprice,maxprice = marketprice where id = ' . $goods['id'] . ' and hasoption=0;';
			pdo_query($sql);
		}
		show_json(1);
	}
	public function tpl(){
		global $_GPC;
		global $_W;
		$tpl = trim($_GPC['tpl']);
		if ($tpl == 'option') {
			$tag = random(32);
			include $this->template('goods/tpl/option');
		}else if ($tpl == 'spec') {
			$spec = array('id' => random(32), 'title' => $_GPC['title']);
			include $this->template('goods/tpl/spec');
		}else if ($tpl == 'specitem') {
			$spec = array('id' => $_GPC['specid']);
			$specitem = array('id' => random(32), 'title' => $_GPC['title'], 'show' => 1);
			include $this->template('goods/tpl/spec_item');
		}else if ($tpl == 'param') {
			$tag = random(32);
			include $this->template('goods/tpl/param');
		}
	}
	public function query(){
		global $_W;
		global $_GPC;
		$kwd = trim($_GPC['keyword']);
		$params = array();
		$params[':uniacid'] = $_W['uniacid'];
		$params[':merchid'] = $_W['merchid'];
		$condition = ' and status=1 and deleted=0 and uniacid=:uniacid and merchid=:merchid';
		if (!(empty($kwd))) {
			$condition .= ' AND (`title` LIKE :keywords OR `keywords` LIKE :keywords)';
			$params[':keywords'] = '%' . $kwd . '%';
		}
		$ds = pdo_fetchall('SELECT id,title,thumb,marketprice,productprice,share_title,share_icon,description,minprice FROM ' . tablename('ewei_shop_goods') . ' WHERE 1 ' . $condition . ' order by createtime desc', $params);
		$ds = set_medias($ds, array('thumb', 'share_icon'));
		if ($_GPC['suggest']) {
			exit(json_encode(array('value' => $ds)));
		}
		include $this->template();
	}
	public function diyform_tpl(){
		global $_W;
		global $_GPC;
		$globalData = mp('diyform')->globalData();
		extract($globalData);
		$addt = $_GPC['addt'];
		$kw = $_GPC['kw'];
		$flag = intval($_GPC['flag']);
		$data_type = $_GPC['data_type'];
		$tmp_key = $kw;
		include $this->template('diyform/temp/tpl');
	}
	public function goods_selector(){
		global $_GPC;
		global $_W;
		$page = ((empty($page) ? max(1, (int) $_GPC['page']) : $page));
		$page_size = 8;
		$page_start = ($page - 1) * $page_size;
		$condition = '';
		if (!(empty($_GPC['condition']))) {
			$condition = base64_decode(trim($_GPC['condition']));
		}
		$params = array(':uniacid' => $_W['uniacid']);
		$keywords = trim($_GPC['keywords']);
		if (!(empty($keywords))) {
			$params[':title'] = '%' . $keywords . '%';
			$keywords = 'and title like :title ';
		}
		$goodsgroup = intval($_GPC['goodsgroup']);
		$goodsgroup_where = '';
		if (!(empty($goodsgroup))) {
			$goodsgroup_where = ' and (find_in_set(\'' . $goodsgroup . '\',ccates) or find_in_set(\'' . $goodsgroup . '\',pcates) or find_in_set(\'' . $goodsgroup . '\',tcates)) ';
		}
		if ((int) $_GPC['merchid']) {
			$condition .= ' and merchid = ' . (int) $_W['merchid'];
		}
		$limit = 'limit ' . $page_start . ',' . $page_size;
		$query_field = 'id,title,total,hasoption,marketprice,thumb,minprice,bargain,sales';
		$tablename = tablename('ewei_shop_goods');
		$condition .= ' AND status=1 AND deleted=0 AND checked=0 ';
		$query_sql = 'select ' . $query_field . ' from ' . $tablename . ' where uniacid = :uniacid ' . $condition . ' ' . $goodsgroup_where . $keywords;
		$count_field = 'count(*)';
		$count_sql = str_replace($query_field, $count_field, $query_sql);
		$query_sql .= $limit;
		$list = pdo_fetchall($query_sql, $params);
		if (!(empty($list))) {
			foreach ($list as &$li ) {
				$li['thumb'] = tomedia($li['thumb']);
			}
		}
		$count = pdo_fetchcolumn($count_sql, $params);
		$page_num = ceil($count / $page_size);
		$total = $page_num;
		$i = 1;
		while ($page_num) {
			$page_num_arr[] = $i++;
			--$page_num;
		}
		$slice = 0;
		if (6 < $page) {
			$slice = $page - 6;
		}
		is_array($page_num_arr) && ($page_num_arr = array_slice($page_num_arr, $slice, 10));
		if (empty($list) && ($page !== 1)) {
			header('location:' . webUrl('goods.goods_selector', array('merchid' => $_W['merchid'])));
			exit();
		}else {
			include $this->template('goods/goods_selector');
		}
	}
	public function getcate(){
		$category = m('shop')->getAllCategory();
		header('Content-type: application/json');
		exit(json_encode($category));
	}
}
?>