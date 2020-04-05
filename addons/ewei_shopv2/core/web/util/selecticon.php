<?php

if (!defined('IN_IA')) {
	exit('Access Denied');
}

class Util_Selecticon_EweiShopV2WebPage extends WebPage
{
	public function main()
	{
		global $_W;
		global $_GPC;
		include $this->template();
	}
}

?>
