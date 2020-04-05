<?php
if (!defined('IN_IA')) {
	exit('Access Denied');
}

require_once EWEI_SHOPV2_PLUGIN . 'commission/core/page_login_mobile.php';
class Commission_Myshop_Set_EweiShopV2PluginMobilePage extends CommissionMobileLoginPage
{
	public function main()
	{
		global $_W;
		global $_GPC;
		$member = m('member')->getMember($_W['openid']);
		$shop = pdo_fetch('select * from ' . tablename('ewei_shop_commission_shop') . ' where uniacid=:uniacid and mid=:mid limit 1',
			array(':uniacid' => $_W['uniacid'], ':mid' => $member['id']));

		if ($_W['ispost']) {
			$shopdata = (is_array($_GPC['shopdata']) ? $_GPC['shopdata'] : array());
			$shopdata['uniacid'] = $_W['uniacid'];
			$shopdata['mid'] = $member['id'];

			if (empty($shop['id'])) {
				pdo_insert('ewei_shop_commission_shop', $shopdata);
			} else {
				pdo_update('ewei_shop_commission_shop', $shopdata, array('id' => $shop['id']));
			}

			show_json(1);
		}

		$shop = set_medias($shop, array('img', 'logo'));
		$openselect = false;

		if ($this->set['select_goods'] == '1') {
			if (empty($member['agentselectgoods']) || ($member['agentselectgoods'] == 2)) {
				$openselect = true;
			}
		} else {
			if ($member['agentselectgoods'] == 2) {
				$openselect = true;
			}
		}

		$shop['openselect'] = $openselect;
		include $this->template('commission/myshop/set');
	}
}

?>
