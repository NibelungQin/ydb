<?php

use Ydb\Util\YdbHttpUtil;

if (!defined('IN_IA')) {
	exit('Access Denied');
}

class Finance_Index_EweiShopV2WebPage extends WebPage
{
	public function main()
	{
		if (cv('finance.recharge.view')) {
			YdbHttpUtil::header('location: ' . webUrl('finance/log/recharge'));
		}
		else if (cv('finance.withdraw.view')) {
			header('location: ' . webUrl('finance/log/withdraw'));
		}
		else if (cv('finance.downloadbill')) {
			header('location: ' . webUrl('finance/downloadbill'));
		}
		else if (cv('finance.credit.credit1')) {
			header('location:' . webUrl('finance.credit.credit1'));
		}
		else if (cv('finance.credit.credit2')) {
			header('location:' . webUrl('finance.credit.credit2'));
		}
		else {
			header('location: ' . webUrl());
		}
	}
}

?>
