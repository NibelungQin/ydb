<?php

use Ydb\Util\ExceptionUtil;
use Ydb\Util\YdbHttpUtil;

if (!defined('IN_IA')) {
    exit('Access Denied');
}

class DividendWebPage extends PluginWebPage
{
    public function __construct()
    {
        parent::__construct();
        global $_W;
        global $_GPC;
        if ($_W['action'] !== 'init' && empty($this->set['init']) && $_W['action'] !== 'getHandleStatus') {
            YdbHttpUtil::header('location: ' . webUrl('dividend/init'));
            ExceptionUtil::exit('团队分红未初始化', true);
        }
        if ($_W['action'] === 'init' && !empty($this->set['init'])) {
            YdbHttpUtil::header('location: ' . webUrl('dividend/index'));
            ExceptionUtil::exit('团队分红已初始化', true);
        }
    }
}