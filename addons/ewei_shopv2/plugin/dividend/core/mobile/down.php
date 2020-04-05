<?php

use Ydb\Entity\Manual\Member;
use Ydb\Entity\Manual\Order;

if (!defined('IN_IA')) {
    exit('Access Denied');
}

require_once EWEI_SHOPV2_PLUGIN . 'dividend/core/page_login_mobile.php';

class Dividend_Down_EweiShopV2PluginMobilePage extends DividendMobileLoginPage
{
    public function main()
    {
        global $_W;
        global $_GPC;
        $page_title = '商城';
        if (!empty($_W['shopset']['shop']['name'])) {
            $page_title = $_W['shopset']['shop']['name'];
        }
        $member = $this->model->getInfo($_W['openid']);
        include($this->template());
    }

    public function get_list()
    {
        global $_W;
        global $_GPC;
        $openid = $_W['openid'];
        $member = $this->model->getInfo($openid);
        $groupscount = $member['groupscount'];
        $pindex = max(1, (int)$_GPC['page']);
        $psize = 20;
        $list = pdo_fetchall('
            select * from ' . Member::TABLE_NAME . '
            where headsid = :headsid and uniacid = :uniacid
            order by id desc
            limit ' . ($pindex - 1) * $psize . "," . $psize,
            [':headsid' => $member['id'], ':uniacid' => $_W['uniacid']]);
        if (!empty($list)) {
            foreach ($list as &$row) {
                $order = pdo_fetchall('
                    select id,price,dividend from ' . Order::TABLE_NAME . '
                    where openid=:openid and headsid = :headsid and uniacid=:uniacid',
                    [':uniacid' => $_W['uniacid'], ':openid' => $row['openid'], ':headsid' => $member['id']]);
                $money = 0;
                foreach ($order as $k => $v) {
                    $dividend = iunserializer($v['dividend']);
                    $money += $dividend['dividend_price'];
                }
                $row['ordercount'] = count($order);
                $row['moneycount'] = (float)$money;
                $row['createtime'] = date('Y-m-d H:i', $row['createtime']);
            }
            unset($row);
        }
        show_json(1, ['list' => $list, 'total' => $groupscount, 'pagesize' => $psize]);
    }
}
