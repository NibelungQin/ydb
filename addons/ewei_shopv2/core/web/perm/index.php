<?php

use Ydb\Util\ExceptionUtil;
use Ydb\Util\YdbHttpUtil;

if (!defined('IN_IA')) {
	exit('Access Denied');
}

class Perm_Index_EweiShopV2WebPage extends WebPage
{
	public function main()
	{
		if (cv('perm.role')) {
			YdbHttpUtil::header('location: ' . webUrl('perm/role'));
			ExceptionUtil::exit();
		}
		else if (cv('perm.user')) {
			header('location: ' . webUrl('perm/user'));
			exit();
		}
		else {
			if (cv('perm.log')) {
				header('location: ' . webUrl('perm/log'));
				exit();
			}
		}
	}
}

?>
