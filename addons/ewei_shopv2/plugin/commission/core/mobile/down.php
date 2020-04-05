<?php

use Ydb\Service\CommissionService;

if (!defined('IN_IA')) {
    exit('Access Denied');
}

require_once EWEI_SHOPV2_PLUGIN . 'commission/core/page_login_mobile.php';

class Commission_Down_EweiShopV2PluginMobilePage extends CommissionMobileLoginPage
{
    public function main()
    {
        global $_W;
        global $_GPC;
        global $container;

        $member = $this->model->getInfo($_W['openid']);
        $levelcount1 = $member['level1'];
        $levelcount2 = $member['level2'];
        $levelcount3 = $member['level3'];
        $level1 = $level2 = $level3 = 0;
        $level1 = pdo_fetchcolumn('select count(*) from ' . tablename('ewei_shop_member') . ' where agentid=:agentid and uniacid=:uniacid limit 1', array(':agentid' => $member['id'], ':uniacid' => $_W['uniacid']));
        if ((2 <= $this->set['level']) && (0 < $levelcount1)) {
            $level2 = pdo_fetchcolumn('select count(*) from ' . tablename('ewei_shop_member') . ' where agentid in( ' . implode(',', array_keys($member['level1_agentids'])) . ') and uniacid=:uniacid limit 1', array(':uniacid' => $_W['uniacid']));
        }

        if ((3 <= $this->set['level']) && (0 < $levelcount2)) {
            $level3 = pdo_fetchcolumn('select count(*) from ' . tablename('ewei_shop_member') . ' where agentid in( ' . implode(',', array_keys($member['level2_agentids'])) . ') and uniacid=:uniacid limit 1', array(':uniacid' => $_W['uniacid']));
        }

        $total = $level1 + $level2 + $level3;
        /**
         * @var CommissionService $commissionService
         */
        $commissionService = $container->get(CommissionService::class);
        $total = $commissionService->countChildAgent($member['id']);
        include $this->template();
    }

    /***
     * @ author 金翅
     * @ date  2019/03/05
     * @remark 我的团队
     **/
    public function get_team_list(){
        global $_W;
        global $_GPC;
        $openid = $_W['openid'];
        $member = $this->model->getInfo($openid);
        $condition = '';
        $pindex = max(1, intval($_GPC['page']));
        $psize = 20;
        $condition ="  match(gflag) against (',".$member['id'].",')";
        $total_level = pdo_fetchcolumn('select count(*) from ' . tablename('ewei_shop_member') . ' where '.$condition.' and uniacid=:uniacid limit 1', array(':uniacid' => $_W['uniacid']));
        $list = pdo_fetchall('select * from ' . tablename('ewei_shop_member') . ' where uniacid = ' . $_W['uniacid'] . ' and  ' . $condition . '  ORDER BY isagent desc,id desc limit ' . (($pindex - 1) * $psize) . ',' . $psize);
        foreach ($list as &$row) {
            if ($member['isagent'] && $member['status']) {
                $info = $this->model->getInfo($row['openid'], array('total'));
                $row['commission_total'] = $info['commission_total'];
                $row['agentcount'] = $info['agentcount'];
                $row['agenttime'] = date('Y-m-d H:i', $row['agenttime']);
            }
            $ordercount = pdo_fetchcolumn('select count(id) from ' . tablename('ewei_shop_order') . ' where openid=:openid and uniacid=:uniacid limit 1', array(':uniacid' => $_W['uniacid'], ':openid' => $row['openid']));
            $row['ordercount'] = number_format(intval($ordercount), 0);
            $moneycount = pdo_fetchcolumn('select sum(og.realprice) from ' . tablename('ewei_shop_order_goods') . ' og ' . ' left join ' . tablename('ewei_shop_order') . ' o on og.orderid=o.id where o.openid=:openid  and o.status>=1 and o.uniacid=:uniacid limit 1', array(':uniacid' => $_W['uniacid'], ':openid' => $row['openid']));
            $row['moneycount'] = number_format(floatval($moneycount), 2);
            $row['createtime'] = date('Y-m-d H:i', $row['createtime']);
        }
        unset($row);
        show_json(1, array('list' => $list, 'total' => $total_level, 'pagesize' => $psize));
    }
    /***
     * @ author 金翅大鹏
     * @ date  2019/03/05
     * @remark 团队业绩
     **/
    public function get_reward(){
        global $_W;
        global $_GPC;
        $openid = $_W['openid'];
        $member = $this->model->getInfo($openid);
        $beginThismonth=mktime(0,0,0,date('m'),1,date('Y'));
        $endThismonth=mktime(23,59,59,date('m'),date('t'),date('Y'));

        $begin_time = strtotime(date('Y-m-01 00:00:00',strtotime('-1 month')));
        $end_time = strtotime(date("Y-m-d 23:59:59", strtotime(-date('d').'day')));
        $where_time = ' and createtime between ' . $beginThismonth . ' and ' . $endThismonth;
        $last_time=' and createtime between ' . $begin_time . ' and ' . $end_time;
        //团队消费总额
        $query_condition=" where match(gflag) against (',".$member['id'].",')";
        $query_condition=' and openid in (select openid from '.tablename('ewei_shop_member').$query_condition.')';
        $month_team_money=pdo_fetchcolumn('select sum(price) from ' . tablename('ewei_shop_order') . ' where uniacid=:uniacid and status=3'.$query_condition.$where_time, array(':uniacid' => $_W['uniacid']));//本月团队业绩
        $month_money=pdo_fetchcolumn('select sum(price) from ' . tablename('ewei_shop_order') . ' where uniacid=:uniacid and openid=:openid and status=3'.$where_time, array(':uniacid' => $_W['uniacid'], ':openid' => $_W['openid']));//本月个人总业绩
        $last_team_money=pdo_fetchcolumn('select sum(price) from ' . tablename('ewei_shop_order') . ' where uniacid=:uniacid and status=3'.$query_condition.$last_time, array(':uniacid' => $_W['uniacid']));//上月月团队业绩
        $last_money=pdo_fetchcolumn('select sum(price) from ' . tablename('ewei_shop_order') . ' where uniacid=:uniacid and openid=:openid and status=3'.$last_time, array(':uniacid' => $_W['uniacid'], ':openid' => $_W['openid']));//上月个人总业绩
        $data=array(
          'month_all_money'=>$month_team_money+$month_money,
            'month_team_money'=>$month_team_money?:0.00,
            'month_money'=>$month_money?:0.00,
            'last_team_money'=>$last_team_money?:0.00,
            'last_money'=>$last_money?:0.00,
        );
        show_json(1, array('data' => $data));
    }

    public function get_list()
    {
        global $_W;
        global $_GPC;
        global $container;

        /**
         * @var CommissionService $commissionService
         */
        $commissionService = $container->get(CommissionService::class);
        $openid = $_W['openid'];
        $member = $this->model->getInfo($openid);
        $total_level = 0;
        $level = intval($_GPC['level']);
        ((3 < $level) || ($level <= 0)) && ($level = 1);
        $condition = '';
        $levelcount1 = $member['level1'];
        $levelcount2 = $member['level2'];
        $levelcount3 = $member['level3'];
        $pindex = max(1, intval($_GPC['page']));
        $psize = 20;

        if ($level == 1) {
            $condition = ' and agentid=' . $member['id'];
            $hasangent = true;
            $total_level = pdo_fetchcolumn('select count(*) from ' . tablename('ewei_shop_member') . ' where agentid=:agentid and uniacid=:uniacid limit 1', array(':agentid' => $member['id'], ':uniacid' => $_W['uniacid']));
        } else if ($level == 2) {
            if (empty($levelcount1)) {
                show_json(1, array(
                    'list' => array(),
                    'total' => 0,
                    'pagesize' => $psize
                ));
                return;
            }
            $condition = ' and agentid in( ' . implode(',', array_keys($member['level1_agentids'])) . ')';
            $hasangent = true;
            $total_level = pdo_fetchcolumn('select count(*) from ' . tablename('ewei_shop_member') . ' where agentid in( ' . implode(',', array_keys($member['level1_agentids'])) . ') and uniacid=:uniacid limit 1', array(':uniacid' => $_W['uniacid']));
        } else {
            if ($level == 3) {
                if (empty($levelcount2)) {
                    show_json(1, array(
                        'list' => array(),
                        'total' => 0,
                        'pagesize' => $psize
                    ));
                }

                $condition = ' and agentid in( ' . implode(',', array_keys($member['level2_agentids'])) . ')';
                $hasangent = true;
                $total_level = pdo_fetchcolumn('select count(*) from ' . tablename('ewei_shop_member') . ' where agentid in( ' . implode(',', array_keys($member['level2_agentids'])) . ') and uniacid=:uniacid limit 1', array(':uniacid' => $_W['uniacid']));
            }
        }

        $list = pdo_fetchall('select * from ' . tablename('ewei_shop_member') . ' where uniacid = ' . $_W['uniacid'] . ' ' . $condition . '  ORDER BY isagent desc,id desc limit ' . (($pindex - 1) * $psize) . ',' . $psize);

        foreach ($list as &$row) {
            if ($member['isagent'] && $member['status']) {
                $info = $this->model->getInfo($row['openid'], array('total'));
                $row['commission_total'] = $info['commission_total'];
                //$row['agentcount'] = $info['agentcount'];
                $row['agentcount'] = $commissionService->countChildAgent($row['id']);
                $row['agenttime'] = date('Y-m-d H:i', $row['agenttime']);
            }
            $ordercount = pdo_fetchcolumn('select count(id) from ' . tablename('ewei_shop_order') . ' where openid=:openid and uniacid=:uniacid limit 1', array(':uniacid' => $_W['uniacid'], ':openid' => $row['openid']));
            $row['ordercount'] = number_format(intval($ordercount), 0);
            $moneycount = pdo_fetchcolumn('select sum(og.realprice) from ' . tablename('ewei_shop_order_goods') . ' og ' . ' left join ' . tablename('ewei_shop_order') . ' o on og.orderid=o.id where o.openid=:openid  and o.status>=1 and o.uniacid=:uniacid limit 1', array(':uniacid' => $_W['uniacid'], ':openid' => $row['openid']));
            $row['moneycount'] = number_format(floatval($moneycount), 2);
            $row['createtime'] = date('Y-m-d H:i', $row['createtime']);
        }

        unset($row);
        show_json(1, array('list' => $list, 'total' => $total_level, 'pagesize' => $psize));
    }
}

?>
