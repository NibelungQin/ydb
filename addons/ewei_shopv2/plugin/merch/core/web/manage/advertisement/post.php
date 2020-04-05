<?php
global $_W;
global $_GPC;
$id = intval($_GPC['id']);
$params1 = array(':uniacid' => $_W['uniacid']);
$item = pdo_fetch('SELECT * FROM ' . tablename('ewei_shop_advertisement_goods') . ' WHERE id = :id and uniacid=:uniacid', array(':id' => $id, ':uniacid' => $_W['uniacid']));

if (!(empty($id))) {
	if (empty($item)) {
		$this->message('抱歉，广告套餐不存在或是已经删除！', '', 'error');
	}

	if (!(empty($item['thumb']))) {
		$piclist = array_merge(array($item['thumb']), iunserializer($item['thumb_url']));
	}
	$item['content'] = m('common')->html_to_images($item['content']);
}

include $this->template('advertisement/post');exit();
?>