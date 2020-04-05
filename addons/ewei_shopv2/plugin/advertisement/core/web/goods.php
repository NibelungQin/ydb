<?php
if (!(defined('IN_IA'))) 
{
	exit('Access Denied');
}
class Goods_EweiShopV2Page extends PluginWebPage
{
	//广告套餐列表
	public function main(){
		global $_W;
		global $_GPC;
		$pindex = max(1, intval($_GPC['page']));
		$psize = 20;
		$condition = ' uniacid = :uniacid ';
		$params = array(':uniacid' => $_W['uniacid']);
		$type = $_GPC['type'];
		switch ($type) {
			case 'sale': $condition .= ' and deleted = 0 and stock > 0 and status = 1 ';
			break;
			case 'sold': $condition .= ' and deleted = 0 and stock <= 0 and status = 1 ';
			break;
			case 'store': $condition .= ' and deleted = 0 and status = 0 ';
			break;
			case 'recycle': $condition .= ' and deleted = 1 ';
			break;
			default: $condition .= ' and deleted = 0 and stock > 0 and status = 1 ';
		}
		if (!(empty($_GPC['keyword']))) {
			$_GPC['keyword'] = trim($_GPC['keyword']);
			$condition .= ' AND title LIKE :title';
			$params[':title'] = '%' . trim($_GPC['keyword']) . '%';
		}
		if ($_GPC['status'] != '') {
			$condition .= ' AND status = :status';
			$params[':status'] = intval($_GPC['status']);
		}
		$sql = 'SELECT * FROM ' . tablename('ewei_shop_advertisement_goods')
			. 'where  1 = 1 and ' . $condition . ' ORDER BY displayorder DESC,id DESC LIMIT ' . (($pindex - 1) * $psize) . ',' . $psize;
		$list = pdo_fetchall($sql, $params);
		$total = pdo_fetchcolumn('SELECT COUNT(*) FROM ' . tablename('ewei_shop_advertisement_goods') . ' where 1 and ' . $condition, $params);
		$pager = pagination2($total, $pindex, $psize);
		include $this->template();
	}
	public function add(){
		$this->post();
	}
	public function edit(){
		$this->post();
	}
	//添加编辑广告套餐
	protected function post(){
		global $_W;
		global $_GPC;
		$id = intval($_GPC['id']);
		$item = pdo_fetch('SELECT * FROM ' . tablename('ewei_shop_advertisement_goods') . 'WHERE id =:id and uniacid=:uniacid limit 1', array(':uniacid' => $_W['uniacid'], ':id' => $id));
		$group_goods_id = $item['id'];
		if (!(empty($item['thumb']))) {
			$piclist = iunserializer($item['thumb_url']);
		}
		if ($_W['ispost']) {
			$data = array(
				'uniacid' => $_W['uniacid'],
				'displayorder' => intval($_GPC['displayorder']),
				'title' => trim($_GPC['title']),
				'thumb' => '',
				'thumb_url' => '',
				'price' => floatval($_GPC['price']),
				'groupsprice' => floatval($_GPC['groupsprice']),
				'goodsnum' => (intval($_GPC['goodsnum']) < 1 ? 1 : intval($_GPC['goodsnum'])),
				'purchaselimit' => intval($_GPC['purchaselimit']),
				'units' => trim($_GPC['units']),
				'stock' => intval($_GPC['stock']),
				'showstock' => intval($_GPC['showstock']),
				'sales' => intval($_GPC['sales']),
				'status' => intval($_GPC['status']),
				'isindex' => intval($_GPC['isindex']),
				'description' => trim($_GPC['description']),
				'content' => m('common')->html_images($_GPC['content']),
				'createtime' => $_W['timestamp'],
			);
			if ($data['goodsnum'] < 0) {
				show_json(0, '数量不能小于1！');
			}
			if (is_array($_GPC['thumbs'])) {
				$thumbs = $_GPC['thumbs'];
				$thumb_url = array();
				foreach ($thumbs as $th ) {
					$thumb_url[] = trim($th);
				}
				$data['thumb'] = save_media($thumb_url[0]);
				$data['thumb_url'] = serialize(m('common')->array_images($thumb_url));
			}
			if (!(empty($id))) {
				$goods_update = pdo_update('ewei_shop_advertisement_goods', $data, array('id' => $id, 'uniacid' => $_W['uniacid']));
				if (!($goods_update)) {
					show_json(0, '广告编辑失败！');
				}
				plog('advertisement.goods.edit', '编辑广告套餐 ID: ' . $id . ' <br/>广告名称: ' . $data['title']);
			}else {
				$goods_insert = pdo_insert('ewei_shop_advertisement_goods', $data);
				if (!($goods_insert)) {
					show_json(0, '广告套餐添加失败！');
				}
				$id = pdo_insertid();
				plog('groups.goods.add', '添加广告套餐 ID: ' . $id . '  <br/>广告名称: ' . $data['title']);
			}
			show_json(1, array('url' => webUrl('advertisement/goods/edit', array('op' => 'post', 'id' => $id, 'tab' => str_replace('#tab_', '', $_GPC['tab'])))));
		}
		include $this->template();
	}

	public function total(){
		global $_W;
		global $_GPC;
		$type = intval($_GPC['type']);
		$condition = ' uniacid = :uniacid ';
		$params[':uniacid'] = $_W['uniacid'];
		if ($type == 1) {
			$condition .= ' and deleted = 0 and stock > 0 and status = 1 ';
		}else if ($type == 2) {
			$condition .= ' and deleted = 0 and stock = 0 and status = 1';
		}else if ($type == 3) {
			$condition .= ' and deleted = 0 and status = 0 ';
		}else if ($type == 4) {
			$condition .= ' and deleted = 1 ';
		}
		$total = pdo_fetchcolumn('select count(1) from ' . tablename('ewei_shop_advertisement_goods') . ' where ' . $condition . ' ', $params);
		echo json_encode($total);
	}
	public function query(){
		global $_W;
		global $_GPC;
		$kwd = trim($_GPC['keyword']);
		$pindex = max(1, intval($_GPC['page']));
		$psize = 8;
		$params = array();
		$params[':uniacid'] = $_W['uniacid'];
		$condition = ' and uniacid=:uniacid and merchid = 0 and type = 1 and status = 1 and deleted = 0 ';
		if (!(empty($kwd))) {
			$condition .= ' AND `title` LIKE :keyword';
			$params[':keyword'] = '%' . $kwd . '%';
		}
		$ds = pdo_fetchall(
			'SELECT id as gid,title,subtitle,thumb,thumb_url,marketprice,productprice,subtitle,content,goodssn,productsn,followtip,followurl' . "\r\n\t\t\t\t"
			. 'FROM ' . tablename('ewei_shop_goods') . ' WHERE 1 ' . $condition . ' order by createtime desc LIMIT ' . (($pindex - 1) * $psize) . ',' . $psize, $params);
		foreach ($ds as &$d ) {
			if (!(empty($d['thumb_url']))) {
				$d['thumb_url'] = iunserializer($d['thumb_url']);
			}
		}
		unset($d);
		$ds = set_medias($ds, array('share_icon'));
		if ($_GPC['suggest']) {
			exit(json_encode(array('value' => $ds)));
		}
		$total = pdo_fetchcolumn('SELECT count(1) FROM ' . tablename('ewei_shop_goods') . ' WHERE 1 ' . $condition . ' ', $params);
		$pager = pagination2($total, $pindex, $psize, '', array('before' => 5, 'after' => 4, 'ajaxcallback' => 'select_page', 'callbackfuncname' => 'select_page'));
		include $this->template();
	}
	public function delete1(){
		global $_W;
		global $_GPC;
		$id = intval($_GPC['id']);
		if (empty($id)) {
			$id = ((is_array($_GPC['ids']) ? implode(',', $_GPC['ids']) : 0));
		}
		$items = pdo_fetchall('SELECT id,title FROM ' . tablename('ewei_shop_advertisement_goods') . ' WHERE id in( ' . $id . ' ) AND uniacid=' . $_W['uniacid']);
		foreach ($items as $item ) {
			pdo_delete('ewei_shop_advertisement_goods', array('id' => $item['id']));
			plog('advertisement.goods.edit', '从回收站彻底删除广告套餐<br/>ID: ' . $item['id'] . '<br/>广告名称: ' . $item['title']);
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
		$items = pdo_fetchall('SELECT id,title FROM ' . tablename('ewei_shop_advertisement_goods') . ' WHERE id in( ' . $id . ' ) AND uniacid=' . $_W['uniacid']);
		foreach ($items as $item ) {
			pdo_update('ewei_shop_advertisement_goods', array('deleted' => 0, 'status' => 0), array('id' => $item['id']));
			plog('advertisement.goods.edit', '从回收站恢复广告套餐<br/>ID: ' . $item['id'] . '<br/>广告名称: ' . $item['title']);
		}
		show_json(1, array('url' => referer()));
	}
	public function delete(){
		global $_W;
		global $_GPC;
		$id = intval($_GPC['id']);
		if (empty($id)) {
			$id = ((is_array($_GPC['ids']) ? implode(',', $_GPC['ids']) : 0));
		}
		$items = pdo_fetchall('SELECT id,title FROM ' . tablename('ewei_shop_advertisement_goods') . ' WHERE id in( ' . $id . ' ) AND uniacid=' . $_W['uniacid']);
		foreach ($items as $item ) {
			$delete_update = pdo_update('ewei_shop_advertisement_goods', array('deleted' => 1, 'status' => 0), array('id' => $item['id'], 'uniacid' => $_W['uniacid']));
			if (!($delete_update)) {
				show_json(0, '删除广告套餐失败！');
			}
			plog('advertisement.goods.delete', '删除广告套餐 ID: ' . $item['id'] . '  <br/>广告名称: ' . $item['title'] . ' ');
		}
		show_json(1, array('url' => referer()));
	}
	public function status(){
		global $_W;
		global $_GPC;
		$id = intval($_GPC['id']);
		if (empty($id)) {
			$id = ((is_array($_GPC['ids']) ? implode(',', $_GPC['ids']) : 0));
		}
		$status = intval($_GPC['status']);
		$items = pdo_fetchall('SELECT id,status FROM ' . tablename('ewei_shop_advertisement_goods') . ' WHERE id in( ' . $id . ' ) AND uniacid=' . $_W['uniacid']);
		foreach ($items as $item ) {
			$status_update = pdo_update('ewei_shop_advertisement_goods', array('status' => $status), array('id' => $item['id']));
			if (!($status_update)) {
				throw new Exception('广告套餐状态修改失败！');
			}
			plog('advertisement.goods.edit', '修改广告套餐 ' . $item['id'] . ' <br /> 状态: ' . (($status == 0 ? '下架' : '上架')));
		}
		show_json(1, array('url' => referer()));
	}
	public function property(){
		global $_W;
		global $_GPC;
		$id = intval($_GPC['id']);
		$type = trim($_GPC['type']);
		$value = intval($_GPC['value']);
		if (in_array($type, array('status', 'displayorder'))) {
			$statusstr = '';
			if ($type == 'status') {
				$typestr = '上下架';
				$statusstr = (($value == 1 ? '上架' : '下架'));
			}else if ($type == 'displayorder') {
				$typestr = '排序';
				$statusstr = '序号 ' . $value;
			}else if ($type == 'isindex') {
				$typestr = '是否首页显示';
				$statusstr = (($value == 1 ? '是' : '否'));
			}
			$property_update = pdo_update('ewei_shop_advertisement_goods', array($type => $value), array('id' => $id, 'uniacid' => $_W['uniacid']));
			if (!($property_update)) {
				throw new Exception('' . $typestr . '修改失败');
			}
			plog('groups.goods.edit', '修改广告套餐' . $typestr . '状态   ID: ' . $id . ' ' . $statusstr . ' ');
		}
		show_json(1);
	}
}
?>