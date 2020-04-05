<?php

use Ydb\Util\ExceptionUtil;
use Ydb\Util\YdbHttpUtil;

if (!defined('IN_IA')) {
	exit('Access Denied');
}

class System_Index_EweiShopV2WebPage extends SystemPage
{
	public function main()
	{
		YdbHttpUtil::header('Location:' . webUrl('system/plugin'));
	}
}

?>
