<?php
if (!defined('IN_IA')) {
	exit('Access Denied');
}
class Bonus_EweiShopV2Page extends PluginMobilePage
{
	public $set=array(
	'texts'=>array(
	    'bonus_total'=>'累计分红',
        'bonus_pay'=>'待结算',
        'bonus_lock'=>'待结算',
	),

	);

    public function getBonus($openid = '', $params = array())
    {
        global $_W;
        $ret = array();
        if (in_array('ok', $params)) {
            $ret['ok'] = pdo_fetchcolumn('select ifnull(sum(paymoney),0) from ' . tablename('ewei_shop_weishop_billp') . ' where openid=:openid and status=1 and uniacid=:uniacid limit 1', array(':uniacid' => $_W['uniacid'], ':openid' => $openid));
        }
        if (in_array('lock', $params)) {
            $billdData = pdo_fetchall('select id from ' . tablename('ewei_shop_weishop_bill') . ' where 1 and uniacid = ' . intval($_W['uniacid']));
            $id = '';
            if (!(empty($billdData))) {
                $ids = array();
                foreach ($billdData as $v) {
                    $ids[] = $v['id'];
                }
                $id = implode(',', $ids);
                $ret['lock'] = pdo_fetchcolumn('select ifnull(sum(paymoney),0) from ' . tablename('ewei_shop_weishop_billp') . ' where openid=:openid and status<>1 and uniacid=:uniacid  and billid in(' . $id . ') limit 1', array(':uniacid' => $_W['uniacid'], ':openid' => $openid));
            }
        }
        $ret['total'] = $ret['ok'] + $ret['lock'];
        return $ret;
    }

	public function main()
	{
		global $_W;
		global $_GPC;
		$status = intval($_GPC['status']);
		$bonus = $this->getBonus($_W['openid'], array('ok', 'lock', 'total'));
		include $this->template();
	}

	public function get_list()
	{
		global $_W;
		global $_GPC;
		$member = m('member')->getMember($_W['openid']);
		$pindex = max(1, intval($_GPC['page']));
		$psize = 20;
		$condition = ' and `openid`=:openid and uniacid=:uniacid';
		$params = array(':openid' => $_W['openid'], ':uniacid' => $_W['uniacid']);
		$status = trim($_GPC['status']);

		if ($status == 1) {
			$condition .= ' and status=1';
		}
		else {
			if ($status == 2) {
				$condition .= ' and (status=-1 or status=0)';
			}
		}

		$billdData = pdo_fetchall('select id from ' . tablename('ewei_shop_weishop_bill') . ' where 1 and uniacid = ' . intval($_W['uniacid']));
		$id = '';

		if (!empty($billdData)) {
			$ids = array();

			foreach ($billdData as $v) {
				$ids[] = $v['id'];
			}

			$id = implode(',', $ids);
			$list = pdo_fetchall('select *  from ' . tablename('ewei_shop_weishop_billp') . ' where 1 ' . $condition . ' and billid in(' . $id . ') order by id desc LIMIT ' . (($pindex - 1) * $psize) . ',' . $psize, $params);
			$total = pdo_fetchcolumn('select count(*) from ' . tablename('ewei_shop_weishop_billp') . ' where 1 ' . $condition . ' and billid in(' . $id . ')', $params);
			show_json(1, array('total' => $total, 'list' => $list, 'pagesize' => $psize));
		}
		else {
			$list = array();
			$total = 0;
			show_json(1, array('total' => $total, 'list' => $list, 'pagesize' => $psize));
		}
	}
}

?>
