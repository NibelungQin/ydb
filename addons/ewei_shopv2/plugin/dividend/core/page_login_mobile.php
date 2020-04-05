<?php

use Ydb\Util\ExceptionUtil;
use Ydb\Util\YdbHttpUtil;

if (!defined('IN_IA')) {
    exit('Access Denied');
}

class DividendMobileLoginPage extends PluginMobileLoginPage
{
    public function __construct()
    {
        parent::__construct();
        global $_W;
        global $_GPC;
        if (empty($this->set['open'])) {
            $this->set['open'] = 1;
            $this->message('团队分红未开启');
            ExceptionUtil::exit('团队分红未开启', true);
        }
        if ($_W['action'] !== 'register' && $_W['action'] !== 'share') {
            $member = m('member')->getMember($_W['openid']);
            if ($member['isheads'] != 1 || $member['headsstatus'] != 1 || $member['isagent'] != 1 || $member['status'] != 1) {
                YdbHttpUtil::header('location:' . mobileUrl('dividend/register'));
                ExceptionUtil::exit('请先注册', true);
            }
        }
    }
}
