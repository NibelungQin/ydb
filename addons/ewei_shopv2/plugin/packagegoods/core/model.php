<?php

use Ydb\Entity\Manual\Member;
use Ydb\Entity\Manual\PackagegoodsGoods;
use Ydb\Entity\Manual\PackagegoodsOrder;
use Ydb\Entity\Manual\PackagegoodsPaylog;

if (!(defined('IN_IA'))) {
    exit('Access Denied');
}

class PackagegoodsModel extends PluginModel
{
    protected function getUrl($do, $query = null)
    {
        $url = mobileUrl($do, $query, true);
        if (strexists($url, '/addons/ewei_shopv2/')) {
            $url = str_replace('/addons/ewei_shopv2/', '/', $url);
        }
        if (strexists($url, '/core/mobile/order/')) {
            $url = str_replace('/core/mobile/order/', '/', $url);
        }
        return $url;
    }

    public function orderstest()
    {
        global $_W;
        $uniacid = $_W['uniacid'];
        $sql = 'SELECT * FROM' . tablename('ewei_shop_packagegoods_order') . 'where uniacid = :uniacid and status = 0 ';
        $params = array('uniacid' => $uniacid);
        $allorders = pdo_fetchall($sql, $params);
        if ($allorders) {
            foreach ($allorders as $key => $value) {
                $hours = $value['endtime'];
                $time = time();
                $date = date('Y-m-d H:i:s', $value['createtime']);
                $endtime = date('Y-m-d H:i:s', strtotime(' ' . $date . ' + ' . $hours . ' hour'));
                $date1 = date('Y-m-d H:i:s', $time);
                $lasttime2 = strtotime($endtime) - strtotime($date1);
                if ($lasttime2 < 0) {
                    pdo_update('ewei_shop_packagegoods_order', array('status' => -1), array('id' => $value['id']));
                }
            }
        }
        $sql1 = 'SELECT * FROM' . tablename('ewei_shop_packagegoods_order') . 'where uniacid = :uniacid and heads = 1 and status = 1 and success = 0 ';
        $allteam = pdo_fetchall($sql1, $params);
        if ($allteam) {
            foreach ($allteam as $key => $value) {
                $total = pdo_fetchcolumn('select count(1) from ' . tablename('ewei_shop_packagegoods_order') . '  where uniacid = :uniacid and teamid = :teamid and heads = :heads and status = :status and success = :success ',
                    array(
                        ':uniacid' => $uniacid,
                        ':heads' => 1,
                        ':teamid' => $value['teamid'],
                        ':status' => 1,
                        ':success' => 0
                    ));
                if ($value['groupnum'] == $total) {
                    pdo_update('ewei_shop_packagegoods_order', array('success' => 1),
                        array('teamid' => $value['teamid']));
                } else {
                    $hours = $value['endtime'];
                    $time = time();
                    $date = date('Y-m-d H:i:s', $value['starttime']);
                    $endtime = date('Y-m-d H:i:s', strtotime(' ' . $date . ' + ' . $hours . ' hour'));
                    $date1 = date('Y-m-d H:i:s', $time);
                    $lasttime2 = strtotime($endtime) - strtotime($date1);
                    if ($lasttime2 < 0) {
                        pdo_update('ewei_shop_packagegoods_order',
                            array('success' => -1, 'canceltime' => strtotime($endtime)),
                            array('teamid' => $value['teamid']));
                    }
                }
            }
        }
    }

    public function payResult($in_id, $orderno, $type, $app = false)
    {
        global $_W;
        $uniacid = $_W['uniacid'];
        $log = pdo_fetch('SELECT * FROM ' . PackagegoodsPaylog::TABLE_NAME
            . ' WHERE `uniacid`=:uniacid AND `module`=:module AND `tid`=:tid limit 1',
            array(':uniacid' => $uniacid, ':module' => 'packagegoods', ':tid' => $orderno)
        );
        $order = pdo_fetch('select * from ' . PackagegoodsOrder::TABLE_NAME
            . ' where  orderno =:orderno and uniacid=:uniacid limit 1',
            array(':uniacid' => $_W['uniacid'], ':orderno' => $orderno)
        );
        if ((0 < $order['status']) || (0 < $log['status'])) {
            return true;
        }
        $openid = $order['openid'];
        $order_goods = pdo_fetch('select * from  ' . PackagegoodsGoods::TABLE_NAME
            . ' where id = :id and uniacid=:uniacid ',
            array(':uniacid' => $uniacid, ':id' => $order['goodid'])
        );

        //升级大礼包身份和相关关联设置
        $order_goods['packagedata'] = unserialize($order_goods['packagedata']);
        $order_goods['package_label'] = unserialize($order_goods['package_label']);
        $order_goods['package_member_card'] = unserialize($order_goods['package_member_card']);

        $result = m('member')->setCredit($openid, 'credit1', -$order['credit'],
            array($_W['member']['uid'], $_W['shopset']['shop']['name'] . '消费' . $order['credit'] . '积分'));
        if (is_error($result)) {
            return $result['message'];
        }
        $record = array();
        $record['status'] = '1';
        $record['type'] = $type;
        $params = array(':uniacid' => $uniacid, ':success' => 0, ':status' => 1);

        //判断该会员用户当前的分销、店铺、区域等级
        $member_level = pdo_fetch('select id,`level`,nickname,agentid,agentlevel,`status`,partnerlevel,partnerstatus,
                    aagentlevel,aagentstatus
                from  ' . Member::TABLE_NAME
            . ' where openid = :openid and uniacid=:uniacid ',
            array(':uniacid' => $uniacid, ':openid' => $order['openid'])
        );
        if (empty($in_id)) {
            $in_id = $member_level['id'];
        }
        //邀请人
        $arr = pdo_fetch('select isagent,openid,nickname,`status` from  ' . Member::TABLE_NAME
            . ' where id = :id and uniacid=:uniacid ', array(':uniacid' => $uniacid, ':id' => $in_id)
        );
        $this->addRewardLog($order);
        if ($order_goods['package_label']['virtual_package_label'] == 1) {//虚拟礼包类型--订单状态
            pdo_update('ewei_shop_packagegoods_order', array(
                'pay_type' => $type,
                'status' => 3,
                'paytime' => TIMESTAMP,
                'starttime' => TIMESTAMP,
                'apppay' => ($app ? 1 : 0)
            ), array('orderno' => $orderno));
            pdo_update('ewei_shop_packagegoods_paylog', array('status' => 3), array('tid' => $orderno));
            $this->Commission_packagens($order);
        } else {
            pdo_update('ewei_shop_packagegoods_order', array(
                'pay_type' => $type,
                'status' => 1,
                'paytime' => TIMESTAMP,
                'starttime' => TIMESTAMP,
                'apppay' => ($app ? 1 : 0)
            ), array('orderno' => $orderno));
            pdo_update('ewei_shop_packagegoods_paylog', array('status' => 1), array('tid' => $orderno));
        }
        $this->sendTeamMessage($order['id']);

        $stock = intval($order_goods['stock'] - 1);
        $sales = intval($order_goods['sales']) + 1;
        pdo_update('ewei_shop_packagegoods_goods', array('stock' => $stock, 'sales' => $sales),
            array('id' => $order_goods['id']));

        //判断是否是充值礼包类型---充值会员卡余额或会员卡积分
        if ($order_goods['package_label']['recharge_package_label'] == 1) {//充值礼包类型
            $card = pdo_fetch('select id from ' . tablename('ewei_shop_member_card_history') . ' where  openid =:openid and member_card_id =:member_card_id and uniacid=:uniacid limit 1',
                array(
                    ':uniacid' => $_W['uniacid'],
                    ':openid' => $openid,
                    ':member_card_id' => $order_goods['package_member_card']['member_card_type']
                ));
            if ($card) {//判断该会员是否有会员卡
                if ($order_goods['package_member_card']['recharge_type'] == 1) {//余额充值
                    $remain_consume = pdo_fetch('select remain_consume from ' . tablename('ewei_shop_member_card_consumes') . ' where  card_member_id =:card_member_id and uniacid=:uniacid limit 1',
                        array(':uniacid' => $_W['uniacid'], ':card_member_id' => $card['id']));
                    $log = array(
                        'uniacid' => $_W['uniacid'],
                        'title' => '大礼包充值会员卡',
                        'openid' => $_W['openid'],
                        'money' => $order_goods['package_member_card']['recharge_money_pay'],
                        'type' => 0,
                        'createtime' => time(),
                        'status' => 1,
                        'card_member_id' => $card['id']
                    );
                    //添加充值记录
                    pdo_insert('ewei_shop_member_card_log', $log);
                    if ($remain_consume) {
                        $consume_data = $remain_consume['remain_consume'] + $order_goods['package_member_card']['recharge_money_pay'];
                        pdo_update('ewei_shop_member_card_consumes', array('remain_consume' => $consume_data),
                            array('uniacid' => $_W['uniacid'], 'card_member_id' => $card['id']));
                    } else {
                        $consume_data = array(
                            'uniacid' => $uniacid,
                            'remain_consume' => $order_goods['package_member_card']['recharge_money_pay'],
                        );
                        pdo_insert('ewei_shop_member_card_consumes', $consume_data);
                    }
                } elseif ($order_goods['package_member_card']['recharge_type'] == 2) {//积分充值
                    $remain_score = pdo_fetch('select remain_score from ' . tablename('ewei_shop_member_card_scores') . ' where  card_member_id =:card_member_id and uniacid=:uniacid limit 1',
                        array(':uniacid' => $_W['uniacid'], ':card_member_id' => $card['id']));
                    if ($remain_score) {
                        $score_data = $remain_score['remain_score'] + $order_goods['package_member_card']['recharge_integral_pay'];
                        pdo_update('ewei_shop_member_card_scores', array('remain_score' => $score_data),
                            array('uniacid' => $_W['uniacid'], 'card_member_id' => $card['id']));
                    } else {
                        $score_data = array(
                            'uniacid' => $uniacid,
                            'remain_score' => $order_goods['package_member_card']['recharge_integral_pay'],
                        );
                        pdo_insert('ewei_shop_member_card_scores', $score_data);
                    }
                }
            }
        }


        //购买分销商身份
        if ($order_goods['packagedata']['commission_package'] == 1) {
            //固定上下级关系
            if ($arr['isagent'] == 1 && $arr['status'] == 1) {
                if ($in_id == $member_level['id']) {
                    //如果邀请id等于自己的id
                    $agentid = 0;
                    $fixagentid = 0;
                    if ($member_level['agentid']) {
                        $agentid = $member_level['agentid'];
                        $fixagentid = 1;
                    }
                } else {
                    $agentid = $in_id;
                    $fixagentid = 1;
                }
            } else {
                if ($member_level['agentid']) {
                    $agentid = $member_level['agentid'];
                    $fixagentid = 1;
                } else {
                    $agentid = 0;
                    $fixagentid = 0;
                }
            }
            if ($member_level['status'] == 1) {//已经成为分销商了

                $c_ordermoney = $this->compare_level('ewei_shop_commission_level',
                    $member_level['agentlevel']);//当前会员用户的分销等级对应相应的升级订单金额
                $cp_ordermoney = $this->compare_level('ewei_shop_commission_level',
                    intval($order_goods['packagedata']['commission_package_level']));//大礼包系统设置的分销等级对应相应的升级订单金额
                if ($c_ordermoney < $cp_ordermoney) {//即当前的等级身份低于大礼包设置的身份可升级
                    $com_data = array(
                        "agentlevel" => intval($order_goods['packagedata']['commission_package_level']),//分销商等级
                    );
                } else {
                    $com_data = array(
                        "agentlevel" => $member_level['agentlevel'],//分销商等级
                    );
                }

            } else {
                $com_data = array(
                    "agentid" => $agentid, //上级分销商ID
                    "fixagentid" => $fixagentid,//是否固定上级
                    "agentlevel" => intval($order_goods['packagedata']['commission_package_level']),//分销商等级
                    "isagent" => 1,//分销商权限
                    "status" => 1,//审核状态
                    //"agentnotupgrade" => 0,//强制不自动升级 0允许自动升级 1强制不自动升级
                    //"agentselectgoods" => 0,//自选商品 0系统设置 1强制禁止 2强制开启
                    "agenttime" => time(), //成为分销商时间
                );
                if ($agentid > 0) {
                    //修改关系链
                    $member = m('member')->getMember($member_level['id']);
                    $qr_member = m('member')->getMember($agentid);
                    p('commission')->promoter_qr($member, $qr_member);
                }
            }
            pdo_update('ewei_shop_member', $com_data, array('openid' => $order['openid'], 'uniacid' => $_W['uniacid']));

            //对绑定的上级分销商消息通知
            if ($in_id > 0 && $in_id != $member_level['id'] && ($arr['isagent'] == 1 && $arr['status'] == 1)) {
                p('commission')->sendMessage($arr['openid'],
                    array('nickname' => $member_level['nickname'], 'childtime' => time()), TM_COMMISSION_AGENT_NEW);
            }
            //购买礼包后调用分销的升级方法
            p('commission')->upgradeLevelByAgent($openid);
            //购买礼包后成为分销商通知
            p('commission')->sendMessage($openid, array('nickname' => $member_level['nickname'], 'agenttime' => time()),
                TM_COMMISSION_BECOME);
        }
        //购买店铺商身份
        if ($order_goods['packagedata']['globonus_package'] == 1) {
            if ($member_level['partnerstatus'] == 1) {//已经成为店铺商身份

                $g_ordermoney = $this->compare_level('ewei_shop_globonus_level', $member_level['partnerlevel']);
                $gp_ordermoney = $this->compare_level('ewei_shop_globonus_level',
                    intval($order_goods['packagedata']['globonus_package_level']));
                if ($g_ordermoney < $gp_ordermoney) {//即当前的等级身份低于大礼包设置的身份可升级
                    $globonus_data = array(
                        "partnerlevel" => intval($order_goods['packagedata']['globonus_package_level']),//店铺等级
                    );
                } else {
                    $globonus_data = array(
                        "partnerlevel" => $member_level['partnerlevel'],//店铺等级
                    );
                }

            } else {
                $globonus_data = array(
                    "partnerlevel" => intval($order_goods['packagedata']['globonus_package_level']),//店铺等级
                    "ispartner" => 1,//店铺权限
                    "partnerstatus" => 1,//审核通过
                    //"partnernotupgrade" => 0,//强制不自动升级
                );
            }
            pdo_update('ewei_shop_member', $globonus_data,
                array('openid' => $order['openid'], 'uniacid' => $_W['uniacid']));
            //购买礼包后调用店铺的升级方法
            p('commission')->upgradeLevelByAgent($order['openid']);
        }
        //购买区域代理身份
        if ($order_goods['packagedata']['abonus_package'] == 1) {

            if ($member_level['status'] == 1) {//已经成为区域代理身份

                $a_ordermoney = $this->compare_level('ewei_shop_abonus_level', $member_level['aagentlevel']);
                $ap_ordermoney = $this->compare_level('ewei_shop_abonus_level',
                    intval($order_goods['packagedata']['abonus_package_level']));
                if ($a_ordermoney < $ap_ordermoney) {//即当前的等级身份低于大礼包设置的身份可升级
                    $abonus_data = array(
                        "aagentlevel" => intval($order_goods['packagedata']['abonus_package_level']),//代理商等级
                    );
                } else {
                    $abonus_data = array(
                        "aagentlevel" => $member_level['aagentlevel'],//代理商等级
                    );
                }

            } else {
                $abonus_data = array(
                    "aagentlevel" => intval($order_goods['packagedata']['abonus_package_level']),//代理商等级
                    "aagenttype" => 0,//代理商级别
                    "isaagent" => 1,//代理商权限
                    "aagentstatus" => 1,//审核通过
                    //"aagentnotupgrade" => 0,//强制不自动升级
                    //"aagentprovinces" => "a:0:{}",//代理省份
                    //"aagentcitys" => "a:0:{}",//代理城市
                    //"aagentareas" => "a:0:{}",//代理地区
                );
            }
            pdo_update('ewei_shop_member', $abonus_data,
                array('openid' => $order['openid'], 'uniacid' => $_W['uniacid']));
        }
        //购买会员身份
        if ($order_goods['packagedata']['member_package'] == 1) {

            $m_ordermoney = $this->compare_level('ewei_shop_member_level', $member_level['level']);
            $mp_ordermoney = $this->compare_level('ewei_shop_member_level',
                intval($order_goods['packagedata']['member_package_level']));
            if ($m_ordermoney < $mp_ordermoney) {//即当前的等级身份低于大礼包设置的身份可升级
                $me_data = array(
                    "level" => intval($order_goods['packagedata']['member_package_level']),//会员等级
                );
            } else {
                $me_data = array(
                    "level" => $member_level['level'],//会员等级
                );
            }
            pdo_update('ewei_shop_member', $me_data, array('openid' => $order['openid'], 'uniacid' => $_W['uniacid']));
        }
        $this->send_pay_message($order);
        return true;
    }

    //比较当前的等级与要购买的等级的高低
    public function compare_level($table, $level)
    {
        global $_W;
        $uniacid = $_W['uniacid'];
        $ord_money = pdo_fetch('select ordermoney from  ' . tablename($table) . "\r\n\t\t\t\t\t"
            . 'where uniacid=:uniacid and id=:id limit 1', array(':uniacid' => $uniacid, ':id' => $level)
        );
        $arr = $ord_money['ordermoney'];
        return $arr;
    }

    public function getTotals()
    {
        global $_W;
        $paras = array(':uniacid' => $_W['uniacid']);
        $totals['all'] = pdo_fetchcolumn('SELECT COUNT(1) FROM ' . tablename('ewei_shop_packagegoods_order') . ' o' . "\r\n\t\t\t" . ' WHERE o.uniacid = :uniacid and o.isverify = 0 ',
            $paras);
        $totals['status1'] = pdo_fetchcolumn('SELECT COUNT(1) FROM ' . tablename('ewei_shop_packagegoods_order') . ' o' . "\r\n\t\t\t" . ' WHERE o.uniacid = :uniacid and o.isverify = 0 and o.status = 1 and (o.success = 1 or o.is_team = 0) ',
            $paras);
        $totals['status2'] = pdo_fetchcolumn('SELECT COUNT(1) FROM ' . tablename('ewei_shop_packagegoods_order') . ' o' . "\r\n\t\t\t" . ' WHERE o.uniacid = :uniacid and o.isverify = 0 and o.status=2 ',
            $paras);
        $totals['status3'] = pdo_fetchcolumn('SELECT COUNT(1) FROM ' . tablename('ewei_shop_packagegoods_order') . ' o' . "\r\n\t\t\t" . ' WHERE o.uniacid = :uniacid and o.isverify = 0 and o.status = 0 ',
            $paras);
        $totals['status4'] = pdo_fetchcolumn('SELECT COUNT(1) FROM ' . tablename('ewei_shop_packagegoods_order') . ' o' . "\r\n\t\t\t" . ' WHERE o.uniacid = :uniacid and o.isverify = 0 and o.status = 3 ',
            $paras);
        $totals['status5'] = pdo_fetchcolumn('SELECT COUNT(1) FROM ' . tablename('ewei_shop_packagegoods_order') . ' o' . "\r\n\t\t\t" . ' WHERE o.uniacid = :uniacid and o.isverify = 0 and o.status = -1 ',
            $paras);
        $totals['team1'] = pdo_fetchcolumn('SELECT COUNT(1) FROM ' . tablename('ewei_shop_packagegoods_order') . ' o' . "\r\n\t\t\t" . ' WHERE o.uniacid = :uniacid and o.heads = 1 and o.paytime > 0 and is_team = 1 and o.success = 1 ',
            $paras);
        $totals['team2'] = pdo_fetchcolumn('SELECT COUNT(1) FROM ' . tablename('ewei_shop_packagegoods_order') . ' o' . "\r\n\t\t\t" . ' WHERE o.uniacid = :uniacid and o.heads = 1 and o.paytime > 0 and is_team = 1 and o.success = 0 ',
            $paras);
        $totals['team3'] = pdo_fetchcolumn('SELECT COUNT(1) FROM ' . tablename('ewei_shop_packagegoods_order') . ' o' . "\r\n\t\t\t" . ' WHERE o.uniacid = :uniacid and o.heads = 1 and o.paytime > 0 and is_team = 1 and o.success = -1 ',
            $paras);
        $totals['allteam'] = pdo_fetchcolumn('SELECT COUNT(1) FROM ' . tablename('ewei_shop_packagegoods_order') . ' o' . "\r\n\t\t\t" . ' WHERE o.uniacid = :uniacid and o.heads = 1 and o.paytime > 0 and is_team = 1 ',
            $paras);

        $totals['refund1'] = pdo_fetchcolumn(
            'SELECT COUNT(1) FROM ' . tablename('ewei_shop_packagegoods_order_refund') . ' as ore' . "\r\n\t\t\t"
            . 'left join ' . tablename('ewei_shop_packagegoods_order') . ' as o on o.id = ore.orderid' . "\r\n\t\t\t"
            . 'right join ' . tablename('ewei_shop_packagegoods_goods') . ' as g on g.id = o.goodid' . "\r\n\t\t\t"
            . 'right join ' . tablename('ewei_shop_member') . ' m on m.openid=o.openid and m.uniacid =  o.uniacid' . "\r\n\t\t\t"
            . 'left join ' . tablename('ewei_shop_member_address') . ' a on a.id=ore.refundaddressid' . "\r\n\t\t\t"
            //. 'right join ' . tablename('ewei_shop_groups_category') . ' as c on c.id = g.category' . "\r\n\t\t\t"
            . 'WHERE ore.uniacid = :uniacid AND o.refundstate > 0 and o.refundid != 0 and ore.refundstatus >= 0 ',
            $paras
        );
        $totals['refund2'] = pdo_fetchcolumn(
            'SELECT COUNT(1) FROM ' . tablename('ewei_shop_packagegoods_order_refund') . ' as ore' . "\r\n\t\t\t"
            . 'left join ' . tablename('ewei_shop_packagegoods_order') . ' as o on o.id = ore.orderid' . "\r\n\t\t\t"
            . 'right join ' . tablename('ewei_shop_packagegoods_goods') . ' as g on g.id = o.goodid' . "\r\n\t\t\t"
            . 'right join ' . tablename('ewei_shop_member') . ' m on m.openid=o.openid and m.uniacid =  o.uniacid' . "\r\n\t\t\t"
            . 'left join ' . tablename('ewei_shop_member_address') . ' a on a.id=ore.refundaddressid' . "\r\n\t\t\t"
            //. 'right join ' . tablename('ewei_shop_groups_category') . ' as c on c.id = g.category' . "\r\n\t\t\t"
            . 'WHERE ore.uniacid = :uniacid AND (o.refundtime != 0 or ore.refundstatus < 0) ', $paras
        );
        $totals['verify1'] = pdo_fetchcolumn('SELECT COUNT(1) FROM ' . tablename('ewei_shop_packagegoods_order') . ' as o' . "\r\n\t\t\t" . 'WHERE o.uniacid=:uniacid and o.isverify = 1 and o.status =  1 ',
            $paras);
        $totals['verify2'] = pdo_fetchcolumn('SELECT COUNT(1) FROM ' . tablename('ewei_shop_packagegoods_order') . ' as o' . "\r\n\t\t\t" . 'WHERE o.uniacid=:uniacid and o.isverify = 1 and o.status = 3 ',
            $paras);
        $totals['verify3'] = pdo_fetchcolumn('SELECT COUNT(1) FROM ' . tablename('ewei_shop_packagegoods_order') . ' as o' . "\r\n\t\t\t" . 'WHERE o.uniacid=:uniacid and o.isverify = 1 and o.status <= 0 ',
            $paras);
        return $totals;
    }

    public function packagegoodsShare()
    {
        global $_W;
        $uniacid = $_W['uniacid'];
        $share = pdo_fetch('select share_title,share_icon,share_desc,share_url from ' . tablename('ewei_shop_packagegoods_set') . ' where uniacid=:uniacid ',
            array(':uniacid' => $uniacid));
        $myid = m('member')->getMid();
        $set = $_W['shopset'];
        $_W['shopshare'] = array(
            'title' => (!(empty($share['share_title'])) ? $share['share_title'] : $set['shop']['name']),
            'imgUrl' => (!(empty($share['share_icon'])) ? tomedia($share['share_icon']) : tomedia($set['shop']['logo'])),
            'desc' => (!(empty($share['share_desc'])) ? $share['share_desc'] : $set['shop']['description']),
            'link' => (!(empty($share['share_url'])) ? $share['share_url'] : mobileUrl('packagegoods',
                array('shareid' => $myid), true))
        );
    }

    public function sendTeamMessage($orderid = '0', $delRefund = false)
    {
        global $_W;
        $uniacid = $_W['uniacid'];
        $orderid = intval($orderid);
        if (empty($orderid)) {
            return;
        }
        $order = pdo_fetch('select * from ' . tablename('ewei_shop_packagegoods_order') . ' where uniacid = :uniacid and id=:id limit 1',
            array(':uniacid' => $uniacid, ':id' => $orderid));

        if (empty($order)) {
            return;
        }
        $openid = $order['openid'];
        $url = $this->getUrl('packagegoods/orders/detail', array('orderid' => $orderid));

        $order_goods = pdo_fetch('select * from ' . tablename('ewei_shop_packagegoods_goods') . ' where uniacid=:uniacid and id=:id ',
            array(':uniacid' => $_W['uniacid'], ':id' => intval($order['goodid'])));
        $goodsprice = ((!(empty($order['is_team'])) ? number_format($order_goods['packageprice'],
            2) : number_format($order_goods['packageprice'], 2)));
        $price = number_format(($order['price'] - $order['creditmoney']) + $order['freight'], 2);
        $goods = '待发货礼包--' . $order_goods['title'];
        $goods2 = $order_goods['title'];
        $orderpricestr = ' ¥' . $price . '元 (包含运费: ¥' . $order['freight'] . '元，积分抵扣: ¥' . $order['creditmoney'] . '元)';
        $member = m('member')->getMember($openid);
        $datas = array(
            array(
                'name' => '平台名称',
                'value' => $_W['shopset']['shop']['name']
            ),
            array(
                'name' => '粉丝昵称',
                'value' => $member['nickname']
            ),
            array(
                'name' => '订单号',
                'value' => $order['orderno']
            ),
            array(
                'name' => '订单金额',
                'value' => ($order['price'] - $order['creditmoney']) + $order['freight']
            ),
            array(
                'name' => '运费',
                'value' => $order['freight']
            ),
            array(
                'name' => '礼品详情',
                'value' => $goods
            ),
            array(
                'name' => '快递公司',
                'value' => $order['expresscom']
            ),
            array(
                'name' => '快递单号',
                'value' => $order['expresssn']
            ),
            array(
                'name' => '下单时间',
                'value' => date('Y-m-d H:i', $order['createtime'])
            ),
            array(
                'name' => '支付时间',
                'value' => date('Y-m-d H:i', $order['paytime'])
            ),
            array(
                'name' => '发货时间',
                'value' => date('Y-m-d H:i', $order['sendtime'])
            ),
            array(
                'name' => '收货时间',
                'value' => date('Y-m-d H:i', $order['finishtime'])
            )
        );
        $usernotice = unserialize($member['noticeset']);
        if (!(is_array($usernotice))) {
            $usernotice = array();
        }
        $set = m('common')->getSysset();
        $shop = $set['shop'];
        $tm = $set['notice'];

        if ($delRefund == true) {
            $order_refund = pdo_fetch('select * from ' . tablename('ewei_shop_packagegoods_order_refund') . ' where uniacid=:uniacid and id=:id ',
                array(':uniacid' => $_W['uniacid'], ':id' => intval($order['refundid'])));
            $refundtype = '';
            if ($order['pay_type'] == 'credit') {
                $refundtype = ', 已经退回您的余额账户，请留意查收！';
            } else {
                if ($order['pay_type'] == 'wechat') {
                    $refundtype = ', 已经退回您的对应支付渠道（如银行卡，微信钱包等, 具体到账时间请您查看微信支付通知)，请留意查收！';
                }
            }
            if ($order_refund['refundtype'] == 2) {
                $refundtype = ', 请联系客服进行退款事项！';
            }
            $applyprice = ((!(empty($order_refund['applyprice'])) ? $order_refund['applyprice'] : ($order['price'] - $order['creditmoney']) + $order['freight']));
            if ($order_refund['refundstatus'] == 0) {
                $tm = m('common')->getSysset('notice');
                $msgteam = array(
                    'first' => array('value' => '您有一条申请退款的订单！', 'color' => '#4a5077'),
                    'keyword1' => array('title' => '企业名称', 'value' => $shop['name'], 'color' => '#4a5077'),
                    'keyword2' => array(
                        'title' => '订单编号',
                        'value' => '订单编号：' . $order['orderno'] . ',维权编号：' . $order_refund['refundno'],
                        'color' => '#4a5077'
                    )
                );
                if (!(empty($tm['openid']))) {
                    $openids = explode(',', $tm['openid']);
                    foreach ($openids as $value) {
                        $this->sendGroupsNotice(array(
                            'openid' => $value,
                            'tag' => 'groups_teamsend',
                            'default' => $msgteam,
                            'datas' => $datas
                        ));
                    }
                }
            } else {
                if ($order_refund['refundstatus'] == -1) {
                    $msg = array(
                        'first' => array('value' => '您的退款订单已经被驳回', 'color' => '#4a5077'),
                        'keyword1' => array('title' => '订单编号', 'value' => $order['orderno'], 'color' => '#4a5077'),
                        'keyword2' => array(
                            'title' => '维权编号',
                            'value' => $order_refund['refundno'],
                            'color' => '#4a5077'
                        ),
                        'keyword3' => array('title' => '驳回原因', 'value' => $order_refund['reply'], 'color' => '#4a5077')
                    );
                    $this->sendGroupsNotice(array(
                        'openid' => $openid,
                        'tag' => 'groups_refund',
                        'default' => $msg,
                        'datas' => $datas
                    ));
                } else {
                    if ($order_refund['refundstatus'] == 1) {
                        $msg = array(
                            'first' => array('value' => '您的订单已经完成退款！', 'color' => '#4a5077'),
                            'keyword1' => array(
                                'title' => '退款金额',
                                'value' => '¥' . $applyprice . '元',
                                'color' => '#4a5077'
                            ),
                            'keyword2' => array('title' => '商品详情', 'value' => $goods2, 'color' => '#4a5077'),
                            'keyword3' => array('title' => '订单编号', 'value' => $order['orderno'], 'color' => '#4a5077'),
                            'remark' => array(
                                'value' => '退款金额 ¥' . $applyprice . $refundtype . "\r\n" . ' 期待您再次购物！',
                                'color' => '#4a5077'
                            )
                        );
                        $this->sendGroupsNotice(array(
                            'openid' => $openid,
                            'tag' => 'groups_refund',
                            'default' => $msg,
                            'datas' => $datas
                        ));
                    }
                }
            }
        } else {
            if ($order['status'] == 1) {
                if ($order['success'] == 1) {
                    $order = pdo_fetchall('select * from ' . tablename('ewei_shop_packagegoods_order') . ' where teamid = :teamid and success = 1 and status = 1 ',
                        array(':teamid' => $order['teamid']));
                    $remark = '您参加的拼团已经成功，我们将尽快为您配送~~';
                    foreach ($order as $key => $value) {
                        $msg = array(
                            'first' => array('value' => '您参加的拼团已经成功组团！', 'color' => '#4a5077'),
                            'keyword1' => array('title' => '订单编号', 'value' => $value['orderno'], 'color' => '#4a5077'),
                            'keyword2' => array(
                                'title' => '通知时间',
                                'value' => date('Y-m-d H:i', time()),
                                'color' => '#4a5077'
                            ),
                            'remark' => array('value' => $remark, 'color' => '#4a5077')
                        );
                        $this->sendGroupsNotice(array(
                            'openid' => $value['openid'],
                            'tag' => 'groups_success',
                            'default' => $msg,
                            'datas' => $datas
                        ));
                    }
                    $tm = m('common')->getSysset('notice');
                    $remarkteam = '拼团成功了，准备发货';
                    $msgteam = array(
                        'first' => array('value' => '拼团已经成功组团！', 'color' => '#4a5077'),
                        'keyword1' => array('title' => '待办项目', 'value' => $goods, 'color' => '#4a5077'),
                        'keyword2' => array('title' => '待办环节', 'value' => '等待发货', 'color' => '#4a5077'),
                        'keyword3' => array(
                            'title' => '更新时间',
                            'value' => date('Y-m-d H:i', time()),
                            'color' => '#4a5077'
                        ),
                        'remark' => array('value' => $remarkteam, 'color' => '#4a5077')
                    );
                    if (!(empty($tm['openid']))) {
                        $openids = explode(',', $tm['openid']);
                        foreach ($openids as $value) {
                            $this->sendGroupsNotice(array(
                                'openid' => $value,
                                'tag' => 'groups_teamsend',
                                'default' => $msgteam,
                                'datas' => $datas
                            ));
                        }
                    }
                } else {
                    if ($order['success'] == -1) {
                        $order = pdo_fetchall('select * from ' . tablename('ewei_shop_packagegoods_order') . ' where success = -1 and status = 1 ');
                        $remark = '很抱歉，您所在的拼团未能成功组团，系统会在24小时之内自动退款。如有疑问请联系平台，谢谢您的参与！';
                        foreach ($order as $key => $value) {
                            $msg = array(
                                'first' => array('value' => '您参加的拼团组团失败！', 'color' => '#4a5077'),
                                'keyword1' => array(
                                    'title' => '订单编号',
                                    'value' => $value['orderno'],
                                    'color' => '#4a5077'
                                ),
                                'keyword2' => array(
                                    'title' => '通知时间',
                                    'value' => date('Y-m-d H:i:s', time()),
                                    'color' => '#4a5077'
                                ),
                                'remark' => array('value' => $remark, 'color' => '#4a5077')
                            );
                            $this->sendGroupsNotice(array(
                                'openid' => $value['openid'],
                                'tag' => 'groups_error',
                                'default' => $msg,
                                'datas' => $datas
                            ));
                        }
                    } else {
                        if ($order['success'] == 0) {
                            if (!(empty($order['addressid']))) {
                                if ($order['is_team']) {
                                    $remark = "\r\n" . '您的订单我们已经收到，请耐心等待其他团员付款~~';
                                } else {
                                    $remark = "\r\n" . '您的订单我们已经收到，我们将尽快配送~~';
                                }
                            }
                            $msg = array(
                                'first' => array('value' => '您的订单已提交成功！', 'color' => '#4a5077'),
                                'keyword1' => array(
                                    'title' => '订单编号',
                                    'value' => $order['orderno'],
                                    'color' => '#4a5077'
                                ),
                                'keyword2' => array('title' => '消费金额', 'value' => $orderpricestr, 'color' => '#4a5077'),
                                'keyword3' => array('title' => '消费门店', 'value' => $shop['name'], 'color' => '#4a5077'),
                                'keyword4' => array(
                                    'title' => '消费时间',
                                    'value' => date('Y-m-d H:i:s', $order['createtime']),
                                    'color' => '#4a5077'
                                ),
                                'remark' => array('value' => $remark, 'color' => '#4a5077')
                            );
                            $this->sendGroupsNotice(array(
                                'openid' => $openid,
                                'tag' => 'groups_pay',
                                'default' => $msg,
                                'url' => $url,
                                'datas' => $datas
                            ));
                            if (!($order['is_team'])) {
                                $tm = m('common')->getSysset('notice');
                                $remarkteam = '单购订单成功了，准备发货';
                                $msgteam = array(
                                    'first' => array('value' => '单购订单成功了！', 'color' => '#4a5077'),
                                    'keyword1' => array(
                                        'title' => '企业名称',
                                        'value' => $shop['name'],
                                        'color' => '#4a5077'
                                    ),
                                    'keyword2' => array('title' => '摘要', 'value' => $goods, 'color' => '#4a5077'),
                                    'remark' => array('value' => $remarkteam, 'color' => '#4a5077')
                                );
                                $business = explode(',', $tm['openid']);
                                foreach ($business as $value) {
                                    $this->sendGroupsNotice(array(
                                        'openid' => $value,
                                        'tag' => 'groups_teamsend',
                                        'default' => $msgteam,
                                        'datas' => $datas
                                    ));
                                }
                            }
                        }
                    }
                }
            } else {
                if ($order['status'] == 2) {
                    if (!(empty($order['addressid']))) {
                        $remark = '您的订单已发货，请注意查收！';
                    }
                    $msg = array(
                        'first' => array('value' => '您的订单已发货！', 'color' => '#4a5077'),
                        'keyword1' => array('title' => '订单编号', 'value' => $order['orderno'], 'color' => '#4a5077'),
                        'keyword2' => array('title' => '物流公司', 'value' => $order['expresscom'], 'color' => '#4a5077'),
                        'keyword3' => array('title' => '物流单号', 'value' => $order['expresssn'], 'color' => '#4a5077'),
                        'remark' => array('value' => $remark, 'color' => '#4a5077')
                    );
                    $this->sendGroupsNotice(array(
                        'openid' => $openid,
                        'tag' => 'groups_send',
                        'default' => $msg,
                        'datas' => $datas
                    ));
                } else {
                    if ($order['status'] == 3) {
                        if (!(empty($order['addressid']))) {
                            $remark = '您的订单已收货成功！';
                        }
                        $msg = array(
                            'first' => array('value' => '订单已收货！', 'color' => '#4a5077'),
                            'keyword1' => array('title' => '订单编号', 'value' => $order['orderno'], 'color' => '#4a5077'),
                            'keyword2' => array(
                                'title' => '物流公司',
                                'value' => $order['expresscom'],
                                'color' => '#4a5077'
                            ),
                            'keyword3' => array(
                                'title' => '物流单号',
                                'value' => $order['expresssn'],
                                'color' => '#4a5077'
                            ),
                            'remark' => array('value' => $remark, 'color' => '#4a5077')
                        );
                        $this->sendGroupsNotice(array(
                            'openid' => $openid,
                            'tag' => 'groups_send',
                            'default' => $msg,
                            'datas' => $datas
                        ));
                    } else {
                        if ($order['status'] == -1) {
                            if (!(empty($order['addressid']))) {
                                $remark = '您的订单已取消！';
                            }
                            $msg = array(
                                'first' => array(
                                    'value' => '订单已取消！',
                                    'color' => '#4a5077'
                                ),
                                'keyword1' => array(
                                    'title' => '订单编号',
                                    'value' => $order['orderno'],
                                    'color' => '#4a5077'
                                ),
                                'keyword2' => array(
                                    'title' => '通知时间',
                                    'value' => date('Y-m-d H:i:s', time()),
                                    'color' => '#4a5077'
                                ),
                                'remark' => array(
                                    'value' => $remark,
                                    'color' => '#4a5077'
                                )
                            );
                            $this->sendGroupsNotice(array(
                                'openid' => $openid,
                                'tag' => 'packagegoods_error',
                                'default' => $msg,
                                'datas' => $datas
                            ));
                        }
                    }
                }
            }
        }
    }

    public function sendGroupsNotice(array $params)
    {
        global $_W;
        global $_GPC;
        $tag = ((isset($params['tag']) ? $params['tag'] : ''));
        $touser = ((isset($params['openid']) ? $params['openid'] : ''));
        if (empty($touser)) {
            return;
        }
        $tm = $_W['shopset']['notice'];
        if (empty($tm)) {
            $tm = m('common')->getSysset('notice');
        }

        $templateid = (($tm['is_advanced'] ? $tm[$tag . '_template'] : $tm[$tag]));
        $default_message = ((isset($params['default']) ? $params['default'] : array()));
        $url = ((isset($params['url']) ? $params['url'] : ''));
        $account = ((isset($params['account']) ? $params['account'] : m('common')->getAccount()));
        $datas = ((isset($params['datas']) ? $params['datas'] : array()));
        $advanced_message = false;

        if ($tm['is_advanced']) {
            if (!(empty($tm[$tag . '_close_advanced']))) {
                return;
            }
            if (!(empty($templateid))) {
                $advanced_template = pdo_fetch('select * from ' . tablename('ewei_shop_member_message_template') . ' where id=:id and uniacid=:uniacid limit 1',
                    array(':id' => $templateid, ':uniacid' => $_W['uniacid']));
                if (!(empty($advanced_template))) {
                    $advanced_message = array(
                        'first' => array(
                            'value' => $this->replaceTemplate($advanced_template['first'], $datas),
                            'color' => $advanced_template['firstcolor']
                        ),
                        'remark' => array(
                            'value' => $this->replaceTemplate($advanced_template['remark'], $datas),
                            'color' => $advanced_template['remarkcolor']
                        )
                    );
                    $data = iunserializer($advanced_template['data']);
                    foreach ($data as $d) {
                        $advanced_message[$d['keywords']] = array(
                            'value' => $this->replaceTemplate($d['value'], $datas),
                            'color' => $d['color']
                        );
                    }
                    $ret = m('message')->sendTplNotice($touser, $advanced_template['template_id'], $advanced_message,
                        $url, $account);
                    if (is_error($ret)) {
                        $ret = m('message')->sendCustomNotice($touser, $advanced_message, $url, $account);
                        if (is_error($ret)) {
                            $ret = m('message')->sendCustomNotice($touser, $advanced_message, $url, $account);
                        }
                    }
                } else {
                    m('message')->sendCustomNotice($touser, $default_message, $url, $account);
                }
            } else {
                m('message')->sendCustomNotice($touser, $default_message, $url, $account);
            }
        } else {
            if (!(empty($tm[$tag . '_close_normal']))) {
                return;
            } else {
                $ret = m('message')->sendTplNotice($touser, $templateid, $default_message, $url, $account);
//dump($ret);exit;
                if (is_error($ret)) {
                    m('message')->sendCustomNotice($touser, $default_message, $url, $account);
                }
            }
        }
    }

    protected function replaceTemplate($str, $datas = array())
    {
        foreach ($datas as $d) {
            $str = str_replace('[' . $d['name'] . ']', $d['value'], $str);
        }
        return $str;
    }

    public function allow($orderid, $times = 0, $verifycode = '', $openid = '')
    {
        global $_W;
        global $_GPC;
        if (empty($openid)) {
            $openid = $_W['openid'];
        }
        $uniacid = $_W['uniacid'];
        $store = false;
        $merchid = 0;
        $lastverifys = 0;
        $verifyinfo = false;
        if ($times <= 0) {
            $times = 1;
        }
        $saler = pdo_fetch('select * from ' . tablename('ewei_shop_saler') . ' where openid=:openid and uniacid=:uniacid limit 1',
            array(':uniacid' => $_W['uniacid'], ':openid' => $openid));
        if ($saler['status'] == 0) {
            return error(-1, '无核销权限!');
        }
        if (empty($saler)) {
            return error(-1, '无核销权限!');
        }
        $merchid = $saler['merchid'];
        $order = pdo_fetch('select * from ' . tablename('ewei_shop_pakcagegoods_order') . ' where id=:id and uniacid=:uniacid  limit 1',
            array(':id' => $orderid, ':uniacid' => $uniacid));
        if (empty($order)) {
            return error(-1, '订单不存在!');
        }
        if (empty($order['isverify'])) {
            return error(-1, '订单无需核销!');
        }
        if (!(empty($order['is_team']))) {
            if (($order['status'] <= 0) || ($order['success'] <= 0)) {
                return error(-1, '此订单未满足核销条件!');
            }
        }
        if (empty($order['is_team']) && ($order['status'] <= 0)) {
            return error(-1, '此订单未满足核销条件!');
        }
        if ($order['isverify'] || $order['istrade']) {
            if ((0 < $order['refundid']) && (0 < $order['refundstate'])) {
                return error(-1, '订单维权中,无法进行核销!');
            }
        } else {
            if ($order['dispatchtype'] == 1) {
                if ((0 < $order['refundid']) && (0 < $order['refundstate'])) {
                    return error(-1, '订单维权中,无法进行自提!');
                }
            }
        }
        $goods = pdo_fetch('select * from ' . tablename('ewei_shop_packagegoods_goods') . "\r\n\t\t\t" . 'where uniacid=:uniacid and id = :goodid ',
            array(':uniacid' => $uniacid, ':goodid' => $order['goodid']));
        if (empty($goods)) {
            return error(-1, '订单异常!');
        }
        if ($order['isverify']) {
            $storeids = array();
            if (!(empty($goods['storeids']))) {
                $storeids = explode(',', $goods['storeids']);
            }
            if (!(empty($storeids))) {
                if (!(empty($saler['storeid']))) {
                    if (!(in_array($saler['storeid'], $storeids))) {
                        return error(-1, '您无此门店的核销权限!');
                    }
                }
            }
            if ($order['verifytype'] == 0) {
                $verifynum = pdo_fetchcolumn('select COUNT(1) from ' . tablename('ewei_shop_groups_verify') . ' where uniacid = :uniacid and orderid = :orderid ',
                    array(':uniacid' => $uniacid, ':orderid' => $orderid));
                if ($order['verifynum'] <= $verifynum) {
                    return error(-1, '此订单已完成核销！');
                }
            } else {
                if ($order['verifytype'] == 1) {
                    $verifynum = pdo_fetchcolumn('select COUNT(1) from ' . tablename('ewei_shop_groups_verify') . ' where uniacid = :uniacid and orderid = :orderid ',
                        array(':uniacid' => $uniacid, ':orderid' => $orderid));
                    if ($order['verifynum'] <= $verifynum) {
                        return error(-1, '此订单已完成核销！');
                    }
                    $lastverifys = $order['verifynum'] - $verifynum;
                    if (($lastverifys < 0) && !empty($order['verifytype'])) {
                        return error(-1, '此订单最多核销 ' . $order['verifynum'] . ' 次!');
                    }
                }
            }
            if (!(empty($saler['storeid']))) {
                if (0 < $merchid) {
                    $store = pdo_fetch('select * from ' . tablename('ewei_shop_merch_store') . ' where id=:id and uniacid=:uniacid and merchid = :merchid limit 1',
                        array(':id' => $saler['storeid'], ':uniacid' => $_W['uniacid'], ':merchid' => $merchid));
                } else {
                    $store = pdo_fetch('select * from ' . tablename('ewei_shop_store') . ' where id=:id and uniacid=:uniacid limit 1',
                        array(':id' => $saler['storeid'], ':uniacid' => $_W['uniacid']));
                }
            }
        }
        $carrier = unserialize($order['carrier']);
        return array(
            'order' => $order,
            'store' => $store,
            'saler' => $saler,
            'lastverifys' => $lastverifys,
            'goods' => $goods,
            'verifyinfo' => $verifyinfo,
            'carrier' => $carrier
        );
    }

    public function verify($orderid = 0, $times = 0, $verifycode = '', $openid = '')
    {
        global $_W;
        global $_GPC;
        $uniacid = $_W['uniacid'];
        $current_time = time();
        if (empty($openid)) {
            $openid = $_W['openid'];
        }
        $data = $this->allow($orderid, $times, $openid);
        if (is_error($data)) {
            return;
        }
        extract($data);
        $order = pdo_fetch('select * from ' . tablename('ewei_shop_packagegoods_order') . ' where id=:id and uniacid=:uniacid  limit 1',
            array(':id' => $orderid, ':uniacid' => $uniacid));
        if ($order['isverify']) {
            if ($order['verifytype'] == 0) {
                pdo_update('ewei_shop_groups_order',
                    array('status' => 3, 'finishtime' => time(), 'sendtime' => $current_time),
                    array('id' => $order['id']));
                $data = array(
                    'uniacid' => $uniacid,
                    'openid' => $order['openid'],
                    'orderid' => $orderid,
                    'verifycode' => $order['verifycode'],
                    'storeid' => $saler['storeid'],
                    'verifier' => $openid,
                    'isverify' => 1,
                    'verifytime' => time()
                );
                pdo_insert('ewei_shop_groups_verify', $data);
            } else {
                if ($order['verifytype'] == 1) {
                    if ($order['status'] != 3) {
                        pdo_update('ewei_shop_packagegoods_order',
                            array('status' => 3, 'finishtime' => time(), 'sendtime' => $current_time),
                            array('id' => $order['id']));
                    }
                    $verifyinfo = iunserializer($order['verifyinfo']);
                    $i = 1;
                    while ($i <= $times) {
                        $data = array(
                            'uniacid' => $uniacid,
                            'openid' => $order['openid'],
                            'orderid' => $orderid,
                            'verifycode' => $order['verifycode'],
                            'storeid' => $saler['storeid'],
                            'verifier' => $openid,
                            'isverify' => 1,
                            'verifytime' => time()
                        );
                        pdo_insert('ewei_shop_groups_verify', $data);
                        ++$i;
                    }
                }
            }
        }
        return true;
    }

    public function tempData($type)
    {
        global $_W;
        global $_GPC;
        $pindex = max(1, intval($_GPC['page']));
        $psize = 20;
        $condition = ' uniacid = :uniacid and type=:type ';
        $params = array(':uniacid' => $_W['uniacid'], ':type' => $type);
        if (!(empty($_GPC['keyword']))) {
            $_GPC['keyword'] = trim($_GPC['keyword']);
            $condition .= ' AND expressname LIKE :expressname';
            $params[':expressname'] = '%' . trim($_GPC['keyword']) . '%';
        }
        $sql = 'SELECT id,expressname,expresscom,isdefault FROM ' . tablename('ewei_shop_exhelper_express') . ' where  1 and ' . $condition . ' ORDER BY isdefault desc, id DESC LIMIT ' . (($pindex - 1) * $psize) . ',' . $psize;
        $list = pdo_fetchall($sql, $params);
        $total = pdo_fetchcolumn('SELECT COUNT(*) FROM ' . tablename('ewei_shop_exhelper_express') . ' where 1 and ' . $condition,
            $params);
        $pager = pagination2($total, $pindex, $psize);
        return array('list' => $list, 'total' => $total, 'pager' => $pager, 'type' => $type);
    }

    public function setDefault($id, $type)
    {
        global $_W;
        $item = pdo_fetch('SELECT id,expressname,type FROM ' . tablename('ewei_shop_exhelper_express') . ' WHERE id=:id and type=:type AND uniacid=:uniacid',
            array(':id' => $id, ':type' => $type, ':uniacid' => $_W['uniacid']));
        if (!(empty($item))) {
            pdo_update('ewei_shop_exhelper_express', array('isdefault' => 0),
                array('type' => $type, 'uniacid' => $_W['uniacid']));
            pdo_update('ewei_shop_exhelper_express', array('isdefault' => 1), array('id' => $id));
            if ($type == 1) {
                plog('exhelper.temp.express.setdefault',
                    '设置默认快递单 ID: ' . $item['id'] . '， 模板名称: ' . $item['expressname'] . ' ');
            } else {
                if ($type == 2) {
                    plog('exhelper.temp.invoice.setdefault',
                        '设置默认发货单 ID: ' . $item['id'] . '， 模板名称: ' . $item['expressname'] . ' ');
                }
            }
        }
    }

    public function tempDelete($id, $type)
    {
        global $_W;
        $items = pdo_fetchall('SELECT id,expressname FROM ' . tablename('ewei_shop_exhelper_express') . ' WHERE id in( ' . $id . ' ) and type=:type and uniacid=:uniacid ',
            array(':type' => $type, ':uniacid' => $_W['uniacid']));
        foreach ($items as $item) {
            pdo_delete('ewei_shop_exhelper_express', array('id' => $item['id'], 'uniacid' => $_W['uniacid']));
            if ($type == 1) {
                plog('groups.exhelper.expressdelete',
                    '删除 快递助手 快递单模板 ID: ' . $item['id'] . '， 模板名称: ' . $item['expressname'] . ' ');
            } else {
                if ($type == 2) {
                    plog('groups.exhelper.invoicedelete',
                        '删除 快递助手 发货单模板 ID: ' . $item['id'] . '， 模板名称: ' . $item['expressname'] . ' ');
                }
            }
        }
    }

    public function getTemp()
    {
        global $_W;
        global $_GPC;
        $temp_sender = pdo_fetchall('SELECT id,isdefault,sendername,sendertel FROM ' . tablename('ewei_shop_exhelper_senduser') . ' WHERE uniacid=:uniacid order by isdefault desc ',
            array(':uniacid' => $_W['uniacid']));
        $temp_express = pdo_fetchall('SELECT id,type,isdefault,expressname FROM ' . tablename('ewei_shop_exhelper_express') . ' WHERE type=1 and uniacid=:uniacid order by isdefault desc ',
            array(':uniacid' => $_W['uniacid']));
        $temp_invoice = pdo_fetchall('SELECT id,type,isdefault,expressname FROM ' . tablename('ewei_shop_exhelper_express') . ' WHERE type=2 and uniacid=:uniacid order by isdefault desc ',
            array(':uniacid' => $_W['uniacid']));
        return array('temp_sender' => $temp_sender, 'temp_express' => $temp_express, 'temp_invoice' => $temp_invoice);
    }

    /*
     * 支付订单发送消息
     *
     * */
    public function send_pay_message($order)
    {

        global $_W;
        global $_GPC;
        $agentid = intval($order['agentid']);
        $openid = $order['openid'];
        $p = p('commission');
        $level = 0;
        if ($p) {
            $cset = $p->getSet();
            $level = intval($cset['level']);
        }
        //分销佣金分配
        $commission1 = 0;
        $commission2 = 0;
        $commission3 = 0;
        $m1 = false;
        $m2 = false;
        $m3 = false;
        $buy_people = $this->get_member($order['openid']);
        //找出分销一、二、三级的ID
        if (!(empty($level)) && !empty($agentid)) {//如果代理ID不存在
            if (!(empty($order['agentid']))) {
                $m1 = m('member')->getMember($order['agentid']);//通过订单信息获取代理ID
                $commission1 = 0;
                if (!(empty($m1['agentid'])) && (1 < $level)) {
                    $m2 = m('member')->getMember($m1['agentid']);
                    $commission2 = 0;
                    if (!(empty($m2['agentid'])) && (2 < $level)) {
                        $m3 = m('member')->getMember($m2['agentid']);
                        $commission3 = 0;
                    }
                }
            }
        }
        //分销佣金的求算分配显示
        if (!(empty($level)) && !empty($agentid)) {
            $commissions = iunserializer($order['commissions']);

            if (!(empty($m1))) {//一级所得分佣
                if (is_array($commissions)) {
                    $commission1 = ((isset($commissions['level1']) ? floatval($commissions['level1']) : 0));
                } else {
                    $c1 = iunserializer($order['commission1']);
                    $l1 = $p->getLevel($m1['openid']);
                    if (!(empty($c1))) {
                        $commission1 = ((isset($c1['level' . $l1['id']]) ? $c1['level' . $l1['id']] : $c1['default']));
                    }
                }
            }

            if (!(empty($m2))) {//二级所得分佣
                if (is_array($commissions)) {
                    $commission2 = ((isset($commissions['level2']) ? floatval($commissions['level2']) : 0));
                } else {
                    $c2 = iunserializer($order['commission2']);
                    $l2 = $p->getLevel($m2['openid']);
                    if (!(empty($c2))) {
                        $commission2 = ((isset($c2['level' . $l2['id']]) ? $c2['level' . $l2['id']] : $c2['default']));
                    }
                }
            }
            if (!(empty($m3))) {//三级所得分佣
                if (is_array($commissions)) {
                    $commission3 += ((isset($commissions['level3']) ? floatval($commissions['level3']) : 0));
                } else {
                    $c3 = iunserializer($order['commission3']);
                    $l3 = $p->getLevel($m3['openid']);
                    if (!(empty($c3))) {
                        $commission3 = ((isset($c3['level' . $l3['id']]) ? $c3['level' . $l3['id']] : $c3['default']));
                    }
                }
            }
        }
        $tag = 'commission_order_pay';
        $datas1[] = array('name' => '昵称', 'value' => $m1['nickname']);
        $datas1[] = array('name' => '好友昵称', 'value' => $buy_people['nickname']);
        $datas1[] = array('name' => '时间', 'value' => date('Y-m-d H:i:s', time()));
        $message = array(
            'first' => array(
                'value' => '亲爱的' . $m1['nickname'] . '，您的好友' . $buy_people['nickname'] . '已购买大礼包',
                'color' => '#ff0000'
            ),
            'keyword1' => array('title' => '业务类型', 'value' => '会员通知', 'color' => '#000000'),
            'keyword2' => array('title' => '业务状态', 'value' => '好友购买大礼包', 'color' => '#000000'),
            'keyword3' => array(
                'title' => '业务内容',
                'value' => '您的好友' . $buy_people['nickname'] . '已购买大礼包',
                'color' => '#000000'
            ),
            'remark' => array('value' => "\n" . '感谢您的支持', 'color' => '#000000')
        );
        if (!(empty($level)) && !empty($agentid)) {
            //结算佣金后并发送消息通知
            $text1 = '您好，您的好友' . $buy_people['nickname'] . "\n" . '在商城中购买了升级大礼包' . "\n" . '确认收货您将获得分销佣金：' . abs($commission1) . '元' . "\n" . date('Y-m-d H:i') . "\n";
            $toopenid1 = $m1['openid'];
            $toopenid2 = $m2['openid'];
            $text2 = '您好，您的好友' . $buy_people['nickname'] . "\n" . '在商城中购买了升级大礼包' . "\n" . '确认收货您将获得分销佣金：' . abs($commission2) . '元' . "\n" . date('Y-m-d H:i') . "\n";
            $toopenid3 = $m3['openid'];
            $text3 = '您好，您的好友' . $buy_people['nickname'] . "\n" . '在商城中购买了升级大礼包' . "\n" . '确认收货您将获得分销佣金：' . abs($commission3) . '元' . "\n" . date('Y-m-d H:i') . "\n";
            m('notice')->sendNotice(array(
                'openid' => $toopenid1,
                'tag' => $tag,
                'default' => $message,
                'cusdefault' => $text1,
                'datas' => array_merge($datas1, array('name' => '佣金金额', 'value' => abs($commission1))),
                'plugin' => 'commission'
            ));
            $datas1[] = array('name' => '佣金金额', 'value' => abs($commission2));
            m('notice')->sendNotice(array(
                'openid' => $toopenid2,
                'tag' => $tag,
                'default' => $message,
                'cusdefault' => $text2,
                'datas' => array_merge($datas1, array('name' => '佣金金额', 'value' => abs($commission2))),
                'plugin' => 'commission'
            ));
            m('notice')->sendNotice(array(
                'openid' => $toopenid3,
                'tag' => $tag,
                'default' => $message,
                'cusdefault' => $text3,
                'datas' => array_merge($datas1, array('name' => '佣金金额', 'value' => abs($commission3))),
                'plugin' => 'commission'
            ));
        }

        //结算分配店铺佣金
        $globonus_data = p('globonus')->packagegoods_getBonusData($openid, $order['id'], 1);//佣金数据
        if ($globonus_data) {
            foreach ($globonus_data as $k => $v) {
                $text1 = '您好，您的好友' . $buy_people['nickname'] . "\n" . '在商城中购买了升级大礼包' . "\n" . '确认收货您将获得店铺奖励佣金：' . abs(round($v['money'],
                        2)) . '元' . "\n" . date('Y-m-d H:i') . "\n";
                m('notice')->sendNotice(array(
                    'openid' => $v['openid'],
                    'tag' => $tag,
                    'default' => $message,
                    'cusdefault' => $text1,
                    'datas' => array_merge($datas1, array('name' => '佣金金额', 'value' => abs($v['money']))),
                    'plugin' => 'commission'
                ));
            }
        }
        //绩效奖励
        $achievement_data = p('achievement')->packagegoods_getBonusData($openid, $order['id'], 1);//佣金数据
        if ($achievement_data) {
            foreach ($achievement_data as $k => $v) {
                $text1 = '您好，您的好友' . $buy_people['nickname'] . "\n" . '在商城中购买了升级大礼包' . "\n" . '确认收货您将获得绩效奖励佣金：' . abs(round($v['money'],
                        2)) . '元' . "\n" . date('Y-m-d H:i') . "\n";
                m('notice')->sendNotice(array(
                    'openid' => $v['openid'],
                    'tag' => $tag,
                    'default' => $message,
                    'cusdefault' => $text1,
                    'datas' => array_merge($datas1, array('name' => '佣金金额', 'value' => abs($v['money']))),
                    'plugin' => 'commission'
                ));
            }
        }
        //结算分配区域佣金
        $abonus_data = p('abonus')->packagegoods_getBonusData($openid, $order['id'], 1);
        if ($abonus_data) {
            foreach ($abonus_data as $k => $v) {
                $text1 = '您好，您的好友' . $buy_people['nickname'] . "\n" . '在商城中购买了升级大礼包' . "\n" . '确认收货您将获得区域奖励佣金：' . abs(round($v['money'],
                        2)) . '元' . "\n" . date('Y-m-d H:i') . "\n";
                m('notice')->sendNotice(array(
                    'openid' => $v['openid'],
                    'tag' => $tag,
                    'default' => $message,
                    'cusdefault' => $text1,
                    'datas' => array_merge($datas1, array('name' => '佣金金额', 'value' => abs($v['money']))),
                    'plugin' => 'commission'
                ));
            }
        }

    }

    /*
     * 添加礼包奖励信息
     *
     * */
    public function addRewardLog($order)
    {
        global $_W;
        global $_GPC;
        $agentid = intval($order['agentid']);
        $openid = $order['openid'];
        $p = p('commission');
        $level = 0;
        if ($p) {
            $cset = $p->getSet();
            $level = intval($cset['level']);
        }
        //分销佣金分配
        $commission1 = 0;
        $commission2 = 0;
        $commission3 = 0;
        $m1 = false;
        $m2 = false;
        $m3 = false;
        //找出分销一、二、三级的ID
        if (!(empty($level)) && !empty($agentid)) {//如果代理ID不存在
            if (!(empty($order['agentid']))) {
                $m1 = m('member')->getMember($order['agentid']);//通过订单信息获取代理ID
                $commission1 = 0;
                if (!(empty($m1['agentid'])) && (1 < $level)) {
                    $m2 = m('member')->getMember($m1['agentid']);
                    $commission2 = 0;
                    if (!(empty($m2['agentid'])) && (2 < $level)) {
                        $m3 = m('member')->getMember($m2['agentid']);
                        $commission3 = 0;
                    }
                }
            }
        }
        //分销佣金的求算分配显示
        if (!(empty($level)) && !empty($agentid)) {
            $commissions = iunserializer($order['commissions']);

            if (!(empty($m1))) {//一级所得分佣
                if (is_array($commissions)) {
                    $commission1 = ((isset($commissions['level1']) ? floatval($commissions['level1']) : 0));
                } else {
                    $c1 = iunserializer($order['commission1']);
                    $l1 = $p->getLevel($m1['openid']);
                    if (!(empty($c1))) {
                        $commission1 = ((isset($c1['level' . $l1['id']]) ? $c1['level' . $l1['id']] : $c1['default']));
                    }
                }
            }
            if (!(empty($m2))) {//二级所得分佣
                if (is_array($commissions)) {
                    $commission2 = ((isset($commissions['level2']) ? floatval($commissions['level2']) : 0));
                } else {
                    $c2 = iunserializer($order['commission2']);
                    $l2 = $p->getLevel($m2['openid']);
                    if (!(empty($c2))) {
                        $commission2 = ((isset($c2['level' . $l2['id']]) ? $c2['level' . $l2['id']] : $c2['default']));
                    }
                }
            }
            if (!(empty($m3))) {//三级所得分佣
                if (is_array($commissions)) {
                    $commission3 += ((isset($commissions['level3']) ? floatval($commissions['level3']) : 0));
                } else {
                    $c3 = iunserializer($order['commission3']);
                    $l3 = $p->getLevel($m3['openid']);
                    if (!(empty($c3))) {
                        $commission3 = ((isset($c3['level' . $l3['id']]) ? $c3['level' . $l3['id']] : $c3['default']));
                    }
                }
            }
        }

        if (!(empty($level)) && !empty($agentid)) {
            $commission_data['uniacid'] = $_W['uniacid'];
            $commission_data['orderid'] = $order['id'];//订单id
            $commission_data['orderno'] = $order['orderno'];//订单号
            $commission_data['buy_openid'] = $order['openid'];//购买人openID
            $commission_data['mid1'] = intval($order['agentid']);
            $commission_data['commission1'] = $commission1;
            $commission_data['mid2'] = intval($m1['agentid']);
            $commission_data['commission2'] = $commission2;
            $commission_data['mid3'] = intval($m2['agentid']);
            $commission_data['commission3'] = $commission3;
            $commission_data['createtime'] = time();
            $commission_data['status'] = 0;
            $commission_insert = pdo_insert('ewei_shop_packagegoods_commission_log', $commission_data);
            if (!($commission_insert)) {
                $this->message('生成分销佣金失败！');
            }
        }

        //结算分配店铺佣金
        $globonus_data = p('globonus')->packagegoods_getBonusData($openid, $order['id']);//佣金数据
        if ($globonus_data) {
            foreach ($globonus_data as $k => $v) {
                $data = array(
                    'uniacid' => $_W['uniacid'],
                    'orderid' => $order['id'],
                    'orderno' => $order['orderno'],
                    'openid' => $v['openid'],
                    'bonusmoney_id' => $v['mid'],
                    'bonusmoney' => round($v['money'], 2),
                    'createtime' => time(),
                    'status' => 0,
                );
                pdo_insert('ewei_shop_packagegoods_globonus_log', $data);
            }
        }

        //绩效奖励
        $achievement_data = p('achievement')->packagegoods_getBonusData($openid, $order['id']);//佣金数据
        if ($achievement_data) {
            foreach ($achievement_data as $k => $v) {
                $data = array(
                    'uniacid' => $_W['uniacid'],
                    'orderid' => $order['id'],
                    'orderno' => $order['orderno'],
                    'openid' => $v['openid'],
                    'bonusmoney_id' => $v['mid'],
                    'bonusmoney' => round($v['money'], 2),
                    'createtime' => time(),
                    'status' => 0,
                );
                pdo_insert('ewei_shop_packagegoods_achievement_log', $data);
            }
        }

        //结算分配区域佣金
        $abonus_data = p('abonus')->packagegoods_getBonusData($openid, $order['id']);
        if ($abonus_data) {
            foreach ($abonus_data as $k => $v) {
                $data = array(
                    'uniacid' => $_W['uniacid'],
                    'orderid' => $order['id'],
                    'orderno' => $order['orderno'],
                    'openid' => $v['openid'],
                    'bonusmoney_id' => $v['mid'],
                    'bonusmoney' => round($v['money'], 2),
                    'createtime' => time(),
                    'status' => 0,
                );
                pdo_insert('ewei_shop_packagegoods_abonus_log', $data);
            }
        }
    }


    /**
     * 礼包奖励
     * @param int $order 订单信息
     */
    public function Commission_packagens($order)
    {
        global $_W;
        global $_GPC;
        $agentid = intval($order['agentid']);
        $openid = $order['openid'];
        $p = p('commission');
        $level = 0;
        if ($p) {
            $cset = $p->getSet();
            $level = intval($cset['level']);
        }
        //分销佣金分配
        $commission1 = 0;
        $commission2 = 0;
        $commission3 = 0;
        $m1 = false;
        $m2 = false;
        $m3 = false;
        $buy_people = $this->get_member($order['openid']);

        //找出分销一、二、三级的ID
        if (!(empty($level)) && !empty($agentid)) {//如果代理ID不存在
            if (!(empty($order['agentid']))) {
                $m1 = m('member')->getMember($order['agentid']);//通过订单信息获取代理ID
                $commission1 = 0;
                if (!(empty($m1['agentid'])) && (1 < $level)) {
                    $m2 = m('member')->getMember($m1['agentid']);
                    $commission2 = 0;
                    if (!(empty($m2['agentid'])) && (2 < $level)) {
                        $m3 = m('member')->getMember($m2['agentid']);
                        $commission3 = 0;
                    }
                }
            }
        }
        //分销佣金的求算分配显示
        if (!(empty($level)) && !empty($agentid)) {
            $commissions = iunserializer($order['commissions']);

            if (!(empty($m1))) {//一级所得分佣
                if (is_array($commissions)) {
                    $commission1 = ((isset($commissions['level1']) ? floatval($commissions['level1']) : 0));
                } else {
                    $c1 = iunserializer($order['commission1']);
                    $l1 = $p->getLevel($m1['openid']);
                    if (!(empty($c1))) {
                        $commission1 = ((isset($c1['level' . $l1['id']]) ? $c1['level' . $l1['id']] : $c1['default']));
                    }
                }
            }

            if (!(empty($m2))) {//二级所得分佣
                if (is_array($commissions)) {
                    $commission2 = ((isset($commissions['level2']) ? floatval($commissions['level2']) : 0));
                } else {
                    $c2 = iunserializer($order['commission2']);
                    $l2 = $p->getLevel($m2['openid']);
                    if (!(empty($c2))) {
                        $commission2 = ((isset($c2['level' . $l2['id']]) ? $c2['level' . $l2['id']] : $c2['default']));
                    }
                }
            }
            if (!(empty($m3))) {//三级所得分佣
                if (is_array($commissions)) {
                    $commission3 += ((isset($commissions['level3']) ? floatval($commissions['level3']) : 0));
                } else {
                    $c3 = iunserializer($order['commission3']);
                    $l3 = $p->getLevel($m3['openid']);
                    if (!(empty($c3))) {
                        $commission3 = ((isset($c3['level' . $l3['id']]) ? $c3['level' . $l3['id']] : $c3['default']));
                    }
                }
            }
        }

        if (!(empty($level)) && !empty($agentid)) {
            $commission_data['uniacid'] = $_W['uniacid'];
            $commission_data['orderid'] = $order['id'];//订单id
            $commission_data['orderno'] = $order['orderno'];//订单号
            $commission_data['buy_openid'] = $order['openid'];//购买人openID
            $commission_data['mid1'] = intval($order['agentid']);
            $commission_data['commission1'] = $commission1;

            $commission_data['mid2'] = intval($m1['agentid']);
            $commission_data['commission2'] = $commission2;

            $commission_data['mid3'] = intval($m2['agentid']);
            $commission_data['commission3'] = $commission3;
            $commission_data['createtime'] = time();
            $commission_data['status'] = 1;
            //根据不同分销等级分配分销佣金
            $member1 = $this->get_openid($commission_data['mid1']);
            $member2 = $this->get_openid($commission_data['mid2']);
            $member3 = $this->get_openid($commission_data['mid3']);
            if ($commission1) {//一级佣金分配
                m('member')->setCredit($member1['openid'], 'credit2', abs($commission1), '大礼包分销奖励');
            }

            if ($commission2) {//二级佣金分配
                m('member')->setCredit($member2['openid'], 'credit2', abs($commission2), '大礼包分销奖励');
            }

            if ($commission3) {//三级佣金分配
                m('member')->setCredit($member3['openid'], 'credit2', abs($commission3), '大礼包分销奖励');
            }

            pdo_update('ewei_shop_packagegoods_commission_log', array('status' => 1), array('orderid' => $order['id']));
            //结算佣金后并发送消息通知
            $tag = 'commission_order_finish';
            $text1 = '您好，您的好友' . $buy_people['nickname'] . "\n" . '在商城中购买了升级大礼包' . "\n" . '恭喜您获得分销佣金：' . abs($commission1) . '元' . "\n" . date('Y-m-d H:i') . "\n";
            $message = array(
                'first' => array(
                    'value' => '亲爱的' . $m1['nickname'] . '，您的好友' . $buy_people['nickname'] . '已购买大礼包',
                    'color' => '#ff0000'
                ),
                'keyword1' => array('title' => '业务类型', 'value' => '会员通知', 'color' => '#000000'),
                'keyword2' => array('title' => '业务状态', 'value' => '好友购买大礼包', 'color' => '#000000'),
                'keyword3' => array(
                    'title' => '业务内容',
                    'value' => '您的好友' . $buy_people['nickname'] . '已购买大礼包',
                    'color' => '#000000'
                ),
                'remark' => array('value' => "\n" . '感谢您的支持', 'color' => '#000000')
            );
            $toopenid1 = $m1['openid'];
            $datas1[] = array('name' => '昵称', 'value' => $m1['nickname']);
            $datas1[] = array('name' => '好友昵称', 'value' => $buy_people['nickname']);
            $datas1[] = array('name' => '时间', 'value' => date('Y-m-d H:i:s', time()));
            $datas1[] = array('name' => '佣金金额', 'value' => abs($commission1));

            $toopenid2 = $m2['openid'];
            $text2 = '您好，您的好友' . $buy_people['nickname'] . "\n" . '在商城中购买了升级大礼包' . "\n" . '恭喜您获得分销佣金：' . abs($commission2) . '元' . "\n" . date('Y-m-d H:i') . "\n";

            $toopenid3 = $m3['openid'];
            $text3 = '您好，您的好友' . $buy_people['nickname'] . "\n" . '在商城中购买了升级大礼包' . "\n" . '恭喜您获得分销佣金：' . abs($commission3) . '元' . "\n" . date('Y-m-d H:i') . "\n";

            m('notice')->sendNotice(array(
                'openid' => $toopenid1,
                'tag' => $tag,
                'default' => $message,
                'cusdefault' => $text1,
                'datas' => $datas1,
                'plugin' => 'commission'
            ));
            m('notice')->sendNotice(array(
                'openid' => $toopenid2,
                'tag' => $tag,
                'default' => $message,
                'cusdefault' => $text2,
                'datas' => $datas1,
                'plugin' => 'commission'
            ));
            m('notice')->sendNotice(array(
                'openid' => $toopenid3,
                'tag' => $tag,
                'default' => $message,
                'cusdefault' => $text3,
                'datas' => $datas1,
                'plugin' => 'commission'
            ));
        }

        //结算分配店铺佣金
        $globonus_data = p('globonus')->packagegoods_getBonusData($openid, $order['id'], 1);//佣金数据
        if ($globonus_data) {
            foreach ($globonus_data as $k => $v) {
                m('member')->setCredit($v['openid'], 'credit2', abs($v['money']), '大礼包店铺奖励');
                pdo_query('update ' . tablename('ewei_shop_packagegoods_order') . ' set isglobonus=1 where id= ' . $order['id'] . '  and uniacid=' . $_W['uniacid']);
                pdo_update('ewei_shop_packagegoods_globonus_log', array('status' => 1),
                    array('orderid' => $order['id'], 'openid' => $v['openid']));

                //结算佣金后并发送消息通知
                $tag = 'commission_order_finish';
                $text1 = '您好，您的好友' . $buy_people['nickname'] . "\n" . '在商城中购买了升级大礼包' . "\n" . '恭喜您获得分销佣金：' . abs($commission1) . '元' . "\n" . date('Y-m-d H:i') . "\n";
                $message = array(
                    'first' => array(
                        'value' => '亲爱的' . $m1['nickname'] . '，您的好友' . $buy_people['nickname'] . '已购买大礼包',
                        'color' => '#ff0000'
                    ),
                    'keyword1' => array('title' => '业务类型', 'value' => '会员通知', 'color' => '#000000'),
                    'keyword2' => array('title' => '业务状态', 'value' => '好友购买大礼包', 'color' => '#000000'),
                    'keyword3' => array(
                        'title' => '业务内容',
                        'value' => '您的下级' . $buy_people['nickname'] . '已购买大礼包',
                        'color' => '#000000'
                    ),
                    'remark' => array('value' => "\n" . '感谢您的支持', 'color' => '#000000')
                );
                $toopenid1 = $m1['openid'];
                $datas1[] = array('name' => '昵称', 'value' => $m1['nickname']);
                $datas1[] = array('name' => '好友昵称', 'value' => $buy_people['nickname']);
                $datas1[] = array('name' => '时间', 'value' => date('Y-m-d H:i:s', time()));
                $datas1[] = array('name' => '佣金金额', 'value' => abs($commission1));

                $toopenid2 = $m2['openid'];
                $text2 = '您好，您的好友' . $buy_people['nickname'] . "\n" . '在商城中购买了升级大礼包' . "\n" . '恭喜您获得分销佣金：' . abs($commission2) . '元' . "\n" . date('Y-m-d H:i') . "\n";

            }
        }

        //绩效奖励
        $achievement_data = p('achievement')->packagegoods_getBonusData($openid, $order['id'], 1);//佣金数据
        if ($achievement_data) {
            foreach ($achievement_data as $k => $v) {
                m('member')->setCredit($v['openid'], 'credit2', abs($v['money']), '大礼包绩效奖励');
                pdo_query('update ' . tablename('ewei_shop_packagegoods_order') . ' set is_achievement=1 where id= ' . $order['id'] . '  and uniacid=' . $_W['uniacid']);
                pdo_update('ewei_shop_packagegoods_achievement_log', array('status' => 1),
                    array('orderid' => $order['id'], 'openid' => $v['openid']));
            }
        }

        //结算分配区域佣金
        $abonus_data = p('abonus')->packagegoods_getBonusData($openid, $order['id'], 1);
        if ($abonus_data) {
            foreach ($abonus_data as $k => $v) {
                m('member')->setCredit($v['openid'], 'credit2', abs($v['money']), '大礼包区域奖励');
                $data = array(
                    'uniacid' => $_W['uniacid'],
                    'orderid' => $order['id'],
                    'orderno' => $order['orderno'],
                    'openid' => $v['openid'],
                    'bonusmoney_id' => $v['mid'],
                    'bonusmoney' => round($v['money'], 2),
                    'createtime' => time(),
                    'status' => 1,
                );
                pdo_query('update ' . tablename('ewei_shop_packagegoods_order') . ' set isabonus=1 where id= ' . $order['id'] . '  and uniacid=' . $_W['uniacid']);
                pdo_update('ewei_shop_packagegoods_abonus_log', array('status' => 1),
                    array('orderid' => $order['id'], 'openid' => $v['openid']));
            }
        }
    }

    private function get_openid($mid)
    {
        global $_W;
        global $_GPC;
        $member = pdo_fetch('select uid,credit2,openid,nickname from ' . tablename('ewei_shop_member') . "\r\n\t\t\t\t\t\t"
            . 'where id = :id and uniacid = :uniacid ', array(':id' => $mid, ':uniacid' => $_W['uniacid'])
        );
        return $member;
    }

    private function get_member($openid)
    {
        global $_W;
        global $_GPC;
        $member = pdo_fetch('select id,nickname from ' . tablename('ewei_shop_member') . "\r\n\t\t\t\t\t\t"
            . 'where openid = :openid and uniacid = :uniacid ',
            array(':openid' => $openid, ':uniacid' => $_W['uniacid'])
        );
        return $member;
    }
}

?>