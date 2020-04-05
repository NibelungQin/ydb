<?php

use Ydb\Util\DevelopmentUtil;
use Ydb\Util\ExceptionUtil;

if (!defined('IN_IA')) {
	exit('Access Denied');
}

class Util_Access_EweiShopV2WebPage extends WebPage
{
	public function main()
	{
		global $_W;
		global $_GPC;
		$account = m('common')->getAccount();
		$token = $account->getAccessToken();
		if (DevelopmentUtil::notCITestingEnvironment()) {
			echo '<pre/>';
			print_r($token);
			echo '</br>';
			print_r('刷新成功,请关闭页面');
		}
		ExceptionUtil::exit();
	}
}

?>
