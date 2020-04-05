<?php

use Ydb\Entity\Manual\CommissionRelation;
use Ydb\Entity\Manual\DividendApply;
use Ydb\Entity\Manual\DividendInit;
use Ydb\Entity\Manual\Member;

if (!defined('IN_IA')) {
    exit('Access Denied');
}

require_once EWEI_SHOPV2_PLUGIN . 'dividend/core/page_login_mobile.php';

class Dividend_Index_EweiShopV2PluginMobilePage extends DividendMobileLoginPage
{
    public function main()
    {
        global $_W;
        global $_GPC;
        $page_title = '商城';
        if (!empty($_W['shopset']['shop']['name'])) {
            $page_title = $_W['shopset']['shop']['name'];
        }
        $member = $this->model->getInfo($_W['openid'],
            ['total', 'ordercount0', 'ok', 'ordercount', 'wait', 'pay']);
        $initData = pdo_fetch('
            select * from ' . DividendInit::TABLE_NAME . '
            where headsid = :headsid and uniacid = :uniacid',
            [':headsid' => $member['id'], ':uniacid' => $_W['uniacid']]);
        $isbuild = $initData['status'];
        $cansettle = 1 <= $member['commission_ok'] && (float)$this->set['withdraw'] <= $member['commission_ok'];
        $member['applycount'] = pdo_fetchcolumn('
            select count(id) from ' . DividendApply::TABLE_NAME . '
            where mid=:mid and uniacid=:uniacid limit 1',
            [':uniacid' => $_W['uniacid'], ':mid' => $member['id']]);
        if (p('commission')) {
            $level = p('commission')->getLevel($member['openid']);
            if (empty($level)) {
                $member['levelname'] = '默认等级';
            } else {
                $member['levelname'] = $level['levelname'];
            }
        }
        $openselect = false;
        if ($this->set['select_goods'] == '1') {
            if (empty($member['agentselectgoods']) || $member['agentselectgoods'] == 2) {
                $openselect = true;
            }
        } elseif ($member['agentselectgoods'] == 2) {
            $openselect = true;
        }
        include($this->template());
    }

    public function createTeam()
    {
        global $_W;
        global $_GPC;
        $member = m('member')->getMember($_W['openid']);
        if (empty($member['isheads']) || empty($member['headsstatus'])) {
            show_json(1, '您还不是队长');
        }
        $data = pdo_fetchall('
            select  r.id,r.pid,m.isheads
            from ' . CommissionRelation::TABLE_NAME . ' r
                left join ' . Member::TABLE_NAME . ' m on m.id = r.id
            where  r.pid=:pid and m.uniacid=:uniacid',
            array(':pid' => $member['id'], ':uniacid' => $_W['uniacid']));
        if (!empty($data)) {
            $heads = [];
            $later = [];
            $ids = [];
            foreach ($data as $k => $v) {
                if (!empty($v['isheads'])) {
                    $heads[] = $v['id'];
                    continue;
                }
                $ids[] = $v['id'];
            }
            if (!empty($heads)) {
                $later = pdo_fetchall('
                    select id from ' . CommissionRelation::TABLE_NAME . '
                    where pid in (' . implode(',', $heads) . ')');
            }
            if (!empty($ids)) {
                if (!empty($later)) {
                    $later = array_column($later, 'id');
                    $ids = array_diff($ids, $later);
                }
                pdo_update('ewei_shop_member', ['headsid' => $member['id']], ['id' => $ids]);
            }
        }
        pdo_update('ewei_shop_dividend_init', ['status' => 1], ['headsid' => $member['id']]);
        show_json(1, '创建成功！');
    }
}