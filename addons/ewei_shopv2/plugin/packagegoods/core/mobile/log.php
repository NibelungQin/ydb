<?php
if (!defined('IN_IA')) {
    exit('Access Denied');
}

class Log_EweiShopV2Page extends PluginMobileLoginPage
{
    public function main()
    {
        global $_W;
        global $_GPC;
        include $this->template();
    }
    public function get_list()
    {
        global $_W;
        global $_GPC;
        $member=m('member')->getInfo($_W['openid']);
        if ($_GPC['status'] == 1) {
            $table = 'ewei_shop_packagegoods_commission_log';
        }
        if ($_GPC['status'] == 2) {
            $table = 'ewei_shop_packagegoods_globonus_log';
        }
        if ($_GPC['status'] == 3) {
            $table = 'ewei_shop_packagegoods_abonus_log';
        }
        if ($_GPC['status'] == -1) {
            $table = 'ewei_shop_packagegoods_achievement_log';
        }
        $type = str_replace('ewei_shop_packagegoods_', '', $table);

        $pindex = max(1, intval($_GPC['page']));
        $psize = 20;
        $condition = ' and log.uniacid=:uniacid';
        $condition1 = '';
        $params = array(':uniacid' => $_W['uniacid']);
        $member_sql = '';
        if ($condition1 != '') {
            $member_sql = ' and openid IN (SELECT openid FROM ' . tablename('ewei_shop_member') . 'm WHERE uniacid = :uniacid ' . $condition1 . ') OR openid IN (SELECT CONCAT(\'sns_wa_\',openid_wa) FROM ' . tablename('ewei_shop_member') . ' m WHERE uniacid = :uniacid ' . $condition1 . ')';
        }
        if ($type == 'commission_log') {
            $field = "log.mid1,log.commission1,log.mid2,log.commission2,log.mid3,log.commission3,log.createtime,log.status,";
            $join_condition = " m on m.openid = log.buy_openid ";
            $condition1=' and (log.mid1='.$member['id'].' or log.mid2='.$member['id'].' or log.mid3='.$member['id'].')';
        } else {
            $field = "log.bonusmoney,log.createtime,";
            $join_condition = " m on m.openid = log.openid ";
            $condition1=' and log.openid='."'".$_W['openid']."'";
        }
        $sql = 'select ' . $field . 'm.nickname,m.id as mid,m.avatar,m.level,m.groupid,m.realname,m.mobile,g.groupname,l.levelname from ' . tablename($table) . ' log ' . ' left join ' . tablename('ewei_shop_member') . $join_condition . ' left join ' . tablename('ewei_shop_member_group') . ' g on g.id = m.groupid ' . ' left join ' . tablename('ewei_shop_member_level') . ' l on l.id = m.level ' . ' where 1 ' . $condition . ' ' . $condition1 . ' GROUP BY log.id ORDER BY log.createtime DESC ';

            $sql .= 'LIMIT ' . (($pindex - 1) * $psize) . ',' . $psize;
        $list = pdo_fetchall($sql, $params);

        if (!(empty($list))) {
            foreach ($list as $key => $value) {
                $list[$key]['createtime'] = date('Y-m-d H:i:s', $value['createtime']);
                if ($member['id'] == $value['mid1']) {
                    $list[$key]['bonusmoney'] = $value['commission1'];
                }
                if ($member['id'] == $value['mid2']) {
                    $list[$key]['bonusmoney'] = $value['commission2'];

                }
                if ($member['id'] == $value['mid3']) {
                    $list[$key]['bonusmoney'] = $value['commission3'];

                }
                if ($value['mid1']) {
                    $list[$key]['m1'] = m('member')->getInfo($value['mid1']);
                }
                if ($value['mid2']) {
                    $list[$key]['m2'] = m('member')->getInfo($value['mid2']);
                }
                if ($value['mid3']) {
                    $list[$key]['m3'] = m('member')->getInfo($value['mid3']);
                }
            }
        }
        $total = pdo_fetchcolumn('select count(*) from ' . tablename($table) . ' log ' . ' where 1 ' . $condition .$condition1 . $member_sql, $params);

        show_json(1, array('total' => $total, 'list' => $list, 'pagesize' => $psize));

    }

    public function get_list1()
    {
        global $_W;
        global $_GPC;
        $member = m('member')->getMember($_W['openid']);
        $pindex = max(1, intval($_GPC['page']));
        $psize = 20;
        $condition = ' and `mid`=:mid and uniacid=:uniacid';
        $params = array(':mid' => $member['id'], ':uniacid' => $_W['uniacid']);
        $status = trim($_GPC['status']);

        if ($status != '') {
            $condition .= ' and status=' . intval($status);
        }

        $commissioncount = pdo_fetchcolumn('select sum(commission) from ' . tablename('ewei_shop_commission_apply') . ' where mid=:mid and uniacid=:uniacid and status>-1 limit 1', array(':mid' => $member['id'], ':uniacid' => $_W['uniacid']));
        $list = pdo_fetchall('select * from ' . tablename('ewei_shop_commission_apply') . ' where 1 ' . $condition . ' order by id desc LIMIT ' . (($pindex - 1) * $psize) . ',' . $psize, $params);
        $total = pdo_fetchcolumn('select count(*) from ' . tablename('ewei_shop_commission_apply') . ' where 1 ' . $condition, $params);

        foreach ($list as &$row) {
            if ($row['status'] == 1) {
                $row['statusstr'] = '待审核';
                $row['dealtime'] = date('Y-m-d H:i', $row['applytime']);
            }
            else if ($row['status'] == 2) {
                $row['statusstr'] = '待打款';
                $row['dealtime'] = date('Y-m-d H:i', $row['checktime']);
            }
            else if ($row['status'] == 3) {
                $row['statusstr'] = '已打款';
                $row['dealtime'] = date('Y-m-d H:i', $row['paytime']);
            }
            else if ($row['status'] == -1) {
                $row['dealtime'] = date('Y-m-d H:i', $row['invalidtime']);
                $row['statusstr'] = '无效';
            }
            else {
                if ($row['status'] == -2) {
                    $row['dealtime'] = date('Y-m-d H:i', $row['refusetime']);
                    $row['statusstr'] = '驳回';
                }
            }
        }

        unset($row);
        show_json(1, array('total' => $total, 'list' => $list, 'pagesize' => $psize, 'commissioncount' => number_format($commissioncount, 2)));
    }


}

?>
