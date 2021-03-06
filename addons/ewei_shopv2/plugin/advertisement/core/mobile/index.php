<?php
if (!(defined('IN_IA'))) 
{
	exit('Access Denied');
}
class Index_EweiShopV2Page extends PluginMobilePage 
{
	private $new = false;
	public function __construct(){
		parent::__construct();
		$this->new = $this->model->isnew();
	}

	//广告首页
	public function main(){
		global $_W;
		global $_GPC;
		try {
			$uniacid = $_W['uniacid'];
			$openid = $_W['openid'];

			//banner轮播
			$advs = pdo_fetchall('select id,advname,link,thumb from ' . tablename('ewei_shop_advertisement_adv') . ' where uniacid=:uniacid and enabled=1 order by displayorder desc', array(':uniacid' => $uniacid));
			$advs = set_medias($advs, 'thumb');

			//推荐广告商品列表
			$recgoods = pdo_fetchall(
				'SELECT o.*,g.id as goods_id,g.title,g.thumb,g.marketprice,g.productprice,m.merchname FROM ' . tablename('ewei_shop_advertisement_order') . ' as o' . "\r\n\t\t\t\t"
				. 'left join ' . tablename('ewei_shop_goods') . ' g on g.id=o.goods_id and g.uniacid =  o.uniacid' . "\r\n\t\t\t\t"
				. 'left join ' . tablename('ewei_shop_merch_user') . ' m on m.id=o.merchid and m.uniacid =  o.uniacid' . "\r\n\t\t\t\t"
				. 'WHERE o.uniacid=:uniacid and o.o_g_status=1 and o.status=1 order by createtime desc', array(':uniacid' => $_W['uniacid']));
			$recgoods = set_medias($recgoods, 'thumb');
			$this->model->groupsShare();
			include $this->template();
		}catch (Exception $e) {
			$content = $e->getMessage();
			include $this->template('advertisement/error');
		}
	}

	//我的奖励
	public function reward(){
		global $_W;
		$list = $this->rewardlist();
		include $this->template();
	}
	public function rewardlist(){
		global $_W;
		global $_GPC;
		$openid = $_W['openid'];
		load()->model('mc');
		$uid = mc_openid2uid($openid);
		if (empty($uid)) {
			mc_oauth_userinfo($openid);
		}
		$member = m('member')->getMember($openid);
		$page = intval($_GPC['page']);
		$page = max(1, $page);
		$psize = 100;
		$pstart = ($page - 1) * $psize;
		$sql = 'select * from ' . tablename('ewei_shop_advertisement_bonus_log') . ' where mid = :mid  and uniacid = :uniacid limit ' . $pstart . ',' . $psize;
		$list = pdo_fetchall($sql, array(':mid' => $member['id'], ':uniacid' => $_W['uniacid']));
		foreach($list as $k=>$v) {
			if($v['type'] == 1) {
				$list[$k]['type_name'] = '领任务赏金';
			}elseif($v['type'] == 2) {
				$list[$k]['type_name'] = '分享任务赏金';
			}
		}
		return $list;
	}
	//我的任务
	public function mine(){
		global $_W;
		global $_GPC;
		$openid = $_W['openid'];
		load()->model('mc');
		$uid = mc_openid2uid($openid);
		if (empty($uid)) {
			mc_oauth_userinfo($openid);
		}
		$member = m('member')->getMember($openid);

		$status = intval($_GPC['status']);
		$condition = '';
		switch ($status) {
			case 1: $condition = ' and o.task_status = 1 ';
				break;
			case 2: $condition = ' and o.task_status = 2 ';
				break;
			default: header('location:' . mobileUrl('advertisement.mine', array('status' => 1)));exit();
		}

		$list = pdo_fetchall(
			'SELECT o.task_createtime,o.task_status,o.id as task_id,r.id as o_id,r.seen_num,g.id as goods_id,g.title,g.thumb FROM ' . tablename('ewei_shop_advertisement_task') . ' as o' . "\r\n\t\t\t\t"
			. 'left join ' . tablename('ewei_shop_advertisement_order') . ' r on r.id=o.o_id and r.uniacid =  o.uniacid' . "\r\n\t\t\t\t"
			. 'left join ' . tablename('ewei_shop_goods') . ' g on g.id=r.goods_id and g.uniacid =  r.uniacid' . "\r\n\t\t\t\t"
			. 'WHERE o.mid = :mid and o.uniacid=:uniacid' . $condition .  'order by o.task_createtime desc', array(':mid' => $member['id'],':uniacid' => $_W['uniacid']));
		foreach($list as $k=>$v) {
			$list[$k]['self_seen_num'] = pdo_fetchcolumn('select COUNT(*)  from ' . tablename('ewei_shop_advertisement_bonus_log') . '  where o_id = :o_id and mid = :mid and uniacid=:uniacid and type=2 ', array(':o_id' =>$v['o_id'] ,':mid' => $member['id'],':uniacid' => $_W['uniacid']));
		}

		include $this->template('advertisement/mine');
	}
	//任务详情
	public function detail() {
		global $_W;
		global $_GPC;
		$openid = $_W['openid'];
		load()->model('mc');
		$uid = mc_openid2uid($openid);
		if (empty($uid)) {
			mc_oauth_userinfo($openid);
		}
		$member = m('member')->getMember($openid);

		$task_id = intval($_GPC['task_id']);
		$detail = pdo_fetch(
			'SELECT o.task_createtime,o.task_status,r.id as o_id,r.seen_num,g.id as goods_id,g.title,g.thumb,g.marketprice,g.productprice FROM ' . tablename('ewei_shop_advertisement_task') . ' as o' . "\r\n\t\t\t\t"
			. 'left join ' . tablename('ewei_shop_advertisement_order') . ' r on r.id=o.o_id and r.uniacid =  o.uniacid' . "\r\n\t\t\t\t"
			. 'left join ' . tablename('ewei_shop_goods') . ' g on g.id=r.goods_id and g.uniacid =  r.uniacid' . "\r\n\t\t\t\t"
			. 'WHERE o.id = :id and o.mid = :mid and o.uniacid=:uniacid order by o.task_createtime desc', array(':id' => $task_id,':mid' => $member['id'],':uniacid' => $_W['uniacid']));

		$share_num = pdo_fetchcolumn('select COUNT(*)  from ' . tablename('ewei_shop_advertisement_bonus_log') . '  where o_id = :o_id and mid = :mid and uniacid=:uniacid and type=2 ', array(':o_id' =>$detail['o_id'] ,':mid' => $member['id'],':uniacid' => $_W['uniacid']));

		$share_seen = pdo_fetchall(
			'SELECT m.openid FROM ' . tablename('ewei_shop_advertisement_bonus_log') . ' as log' . "\r\n\t\t\t\t"
			. 'left join ' . tablename('ewei_shop_member') . ' m on m.id=log.seen_id and m.uniacid = log.uniacid' . "\r\n\t\t\t\t"
			. 'WHERE log.o_id = :o_id and log.mid = :mid and log.uniacid=:uniacid and log.type=2', array(':o_id' => $detail['o_id'],':mid' => $member['id'],':uniacid' => $_W['uniacid']));
		foreach($share_seen as $k=>$v) {
			$share_data[] = m('member')->getMember($v['openid']);
		}

		include $this->template('advertisement/detail');
	}
}
?>                