<?php

use Ydb\Util\YdbHttpUtil;

defined('IN_IA') or exit('Access Denied');
isetcookie('__session', '', -10000);
isetcookie('__switch', '', -10000);

$forward = $_GPC['forward'];
if (empty($forward)) {
    $forward = './?refersh';
}
YdbHttpUtil::header('Location:' . web_url('user/login'));