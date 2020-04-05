<?php
if (!defined('IN_IA')) {
	exit('Access Denied');
}

class Partner_EweiShopV2Page extends PluginWebPage
{
	public function main()
	{
		global $_W;
		global $_GPC;
		$pindex = max(1, intval($_GPC['page']));
		$psize = 20;
		$params = array();
		$condition = '';
		$keyword = trim($_GPC['keyword']);
		if (!empty($keyword)) {
			$condition .= ' and ( dm.realname like :keyword or dm.nickname like :keyword or dm.mobile like :keyword)';
			$params[':keyword'] = '%' . $keyword . '%';
		}
		if ($_GPC['followed'] != '') {
			if ($_GPC['followed'] == 2) {
				$condition .= ' and f.follow=0 and dm.uid<>0';
			}
			else {
				$condition .= ' and f.follow=' . intval($_GPC['followed']);
			}
		}
		if (empty($starttime) || empty($endtime)) {
			$starttime = strtotime('-1 month');
			$endtime = time();
		}
		$sql = 'select dm.*,dm.nickname,dm.avatar,mu.parent_openid from ' . tablename('ewei_shop_merch_user') . ' mu ' . ' left join ' . tablename('ewei_shop_member') . ' dm on mu.parent_openid = dm.openid ' . ' where dm.uniacid = ' . $_W['uniacid'] . $condition . ' GROUP BY mu.parent_openid ORDER BY dm.createtime desc';
		if (empty($_GPC['export'])) {
			$sql .= ' limit ' . (($pindex - 1) * $psize) . ',' . $psize;
		}
		$list = pdo_fetchall($sql, $params);
		$total = pdo_fetchcolumn('select count(dm.id) from' . tablename('ewei_shop_member') . ' dm  ' . ' left join ' . tablename('ewei_shop_member') . ' p on p.id = dm.agentid ' . ' left join ' . tablename('ewei_shop_globonus_level') . ' l on l.id = dm.partnerlevel' . ' where dm.uniacid =' . $_W['uniacid'] . ' and (dm.ispartner =1 or dm.ispartner=-1) ' . $condition, $params);

		foreach ($list as &$row) {
			$bonus = $this->model->getBonus($row['openid'], array('ok'));
			$row['bonus'] = $bonus['ok'];
			$row['followed'] = m('user')->followed($row['openid']);
		}

		unset($row);

		if ($_GPC['export'] == '1') {
			ca('globonus.partner.export');
			plog('globonus.partner.export', '导出招商用户数据');

			foreach ($list as &$row) {
				$row['createtime'] = date('Y-m-d H:i', $row['createtime']);
				$row['partnerime'] = empty($row['partnertime']) ? '' : date('Y-m-d H:i', $row['partnerime']);
				$row['groupname'] = empty($row['groupname']) ? '无分组' : $row['groupname'];
				$row['levelname'] = empty($row['levelname']) ? '普通等级' : $row['levelname'];
				$row['parentname'] = empty($row['parentname']) ? '总店' : '[' . $row['agentid'] . ']' . $row['parentname'];
				$row['statusstr'] = empty($row['status']) ? '' : '通过';
				$row['followstr'] = empty($row['followed']) ? '' : '已关注';
			}

			unset($row);
			m('excel')->export($list, array(
	'title'   => '股东数据-' . date('Y-m-d-H-i', time()),
	'columns' => array(
		array('title' => 'ID', 'field' => 'id', 'width' => 12),
		array('title' => '昵称', 'field' => 'nickname', 'width' => 12),
		array('title' => '姓名', 'field' => 'realname', 'width' => 12),
		array('title' => '手机号', 'field' => 'mobile', 'width' => 12),
		array('title' => '微信号', 'field' => 'weixin', 'width' => 12),
		array('title' => 'openid', 'field' => 'openid', 'width' => 24),
		array('title' => '推荐人', 'field' => 'parentname', 'width' => 12),
		array('title' => '股东等级', 'field' => 'levelname', 'width' => 12),
		array('title' => '累计分红', 'field' => 'bonus', 'width' => 12),
		array('title' => '注册时间', 'field' => 'createtime', 'width' => 12),
		array('title' => '成为股东时间', 'field' => 'partneragenttime', 'width' => 12),
		array('title' => '审核状态', 'field' => 'statusstr', 'width' => 12),
		array('title' => '是否关注', 'field' => 'followstr', 'width' => 12)
		)
	));
		}

		$pager = pagination2($total, $pindex, $psize);
		load()->func('tpl');
		include $this->template();
	}


	public function query()
	{
		global $_W;
		global $_GPC;
		$kwd = trim($_GPC['keyword']);
		$wechatid = intval($_GPC['wechatid']);

		if (empty($wechatid)) {
			$wechatid = $_W['uniacid'];
		}

		$params = array();
		$params[':uniacid'] = $wechatid;
		$condition = ' and uniacid=:uniacid and ispartner=1';

		if (!empty($kwd)) {
			$condition .= ' AND ( `nickname` LIKE :keyword or `realname` LIKE :keyword or `mobile` LIKE :keyword )';
			$params[':keyword'] = '%' . $kwd . '%';
		}

		if (!empty($_GPC['selfid'])) {
			$condition .= ' and id<>' . intval($_GPC['selfid']);
		}

		$ds = pdo_fetchall('SELECT id,avatar,nickname,openid,realname,mobile FROM ' . tablename('ewei_shop_member') . ' WHERE 1 ' . $condition . ' order by createtime desc', $params);
		include $this->template('globonus/query');
	}


}

?>
