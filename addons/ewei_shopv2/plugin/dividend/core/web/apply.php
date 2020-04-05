<?php

use Ydb\Entity\Manual\DividendApply;
use Ydb\Entity\Manual\Goods;
use Ydb\Entity\Manual\Member;
use Ydb\Entity\Manual\MemberAddress;
use Ydb\Entity\Manual\Order;
use Ydb\Entity\Manual\OrderGoods;
use Ydb\Util\Constants;

if (!defined('IN_IA')) {
    exit('Access Denied');
}

require_once EWEI_SHOPV2_PLUGIN . 'dividend/core/dividend_page_web.php';

class Dividend_Apply_EweiShopV2PluginWebPage extends DividendWebPage
{
    public function main()
    {
        global $_W;
        global $_GPC;
        $status = (int)$_GPC['status'];
        empty($status) && ($status = 1);

        if ($status == -1) {
            if (!cv('dividend.apply.view_1')) {
                $this->message('你没有相应的权限查看');
            }
        } elseif (!cv('dividend.apply.view' . $status)) {
            $this->message('你没有相应的权限查看');
        }
        $apply_type = DividendApply::APPLY_TYPE;
        $pindex = max(1, (int)$_GPC['page']);
        $psize = 20;
        $condition = ' and a.uniacid=:uniacid and a.status=:status';
        $params = array(':uniacid' => $_W['uniacid'], ':status' => $status);
        if ($status == -1) {
            $condition = ' and a.uniacid=:uniacid and (a.status=:status or a.status=-2)';
        }
        $searchfield = strtolower(trim($_GPC['searchfield']));
        $keyword = trim($_GPC['keyword']);
        if (!empty($searchfield) && !empty($keyword)) {
            if ($searchfield === 'applyno') {
                $condition .= ' and a.applyno like :keyword';
            } elseif ($searchfield === 'member') {
                $condition .= ' and (m.realname like :keyword or m.nickname like :keyword or m.mobile like :keyword)';
            }
            $params[':keyword'] = '%' . $keyword . '%';
        }
        if (empty($starttime) || empty($endtime)) {
            $starttime = strtotime('-1 month');
            $endtime = time();
        }
        $timetype = $_GPC['timetype'];
        if (!empty($_GPC['timetype'])) {
            $starttime = strtotime($_GPC['time']['start']);
            $endtime = strtotime($_GPC['time']['end']);
            if (!empty($timetype)) {
                $condition .= ' AND a.' . $timetype . ' >= :starttime AND a.' . $timetype . '  <= :endtime ';
                $params[':starttime'] = $starttime;
                $params[':endtime'] = $endtime;
            }
        }
        if (3 <= $status) {
            $orderby = 'paytime';
        } elseif (2 <= $status) {
            $orderby = ' checktime';
        } else {
            $orderby = 'applytime';
        }
        $applytitle = '';
        if ($status == 1) {
            $applytitle = '待审核';
        } elseif ($status == 2) {
            $applytitle = '待打款';
        } elseif ($status == 3) {
            $applytitle = '已打款';
        } elseif ($status == -1) {
            $applytitle = '已无效';
        }
        $sql = '
            select a.*, m.nickname,m.avatar,m.realname,m.mobile,m.agentlevel,a.realname as applyrealname,a.sendmoney
            from ' . DividendApply::TABLE_NAME . ' a
            left join ' . Member::TABLE_NAME . ' m on m.id = a.mid
            where 1 ' . $condition . ' ORDER BY ' . $orderby . ' desc ';
        if (empty($_GPC['export'])) {
            $sql .= '  limit ' . ($pindex - 1) * $psize . ',' . $psize;
        }
        $list = pdo_fetchall($sql, $params);
        if ($status == 3) {
            $realmoney_total = (double)pdo_fetchcolumn('
                select sum(a.realmoney)
                from ' . DividendApply::TABLE_NAME . ' a
                    left join ' . Member::TABLE_NAME . ' m on m.id = a.mid
                where 1 ' . $condition, $params);
        }
        foreach ($list as &$row) {
            $row['typestr'] = $apply_type[$row['type']];
        }
        unset($row);
        if ($_GPC['export'] == '1') {
            ca('dividend.apply.export');
            if ($status == 1) {
                $statustext = '待审核';
            } elseif ($status == 2) {
                $statustext = '待打款';
            } elseif ($status == 3) {
                $statustext = '已打款';
            } elseif ($status == -1) {
                $statustext = '已无效';
            }
            plog('dividend.apply.export', $statustext . '提现申请 导出数据');
            foreach ($list as &$row) {
                $row['applytime'] = (1 <= $status || $status == -1 ? date('Y-m-d H:i', $row['applytime']) : '--');
                $row['checktime'] = (2 <= $status ? date('Y-m-d H:i', $row['checktime']) : '--');
                $row['paytime'] = (3 <= $status ? date('Y-m-d H:i', $row['paytime']) : '--');
                $row['invalidtime'] = ($status == -1 ? date('Y-m-d H:i', $row['invalidtime']) : '--');
            }
            unset($row);
            $rowcount = 0;
            $goodscount = 0;
            $lastgoodscount = 0;
            foreach ($list as &$row) {
                $orderids = explode(',', $row['orderids']);
                if (!is_array($orderids) || count($orderids) <= 0) {
                    continue;
                }
                $orders = pdo_fetchall('
                    select id,agentid, ordersn,price,goodsprice,dispatchprice,createtime,
                           paytype,dividend,dividend_status
                    from ' . Order::TABLE_NAME . '
                    where  id in ( ' . $row['orderids'] . ' );');
                $totaldividend = 0;
                $totalpay = 0;
                $passmoney = 0;
                $ordergoodscount = 0;
                foreach ($orders as &$order) {
                    $goods = pdo_fetchall('
                        SELECT og.id,g.thumb,og.price,og.realprice, og.total,g.title,o.paytype,og.optionname
                        from ' . OrderGoods::TABLE_NAME . ' og
                            left join ' . Goods::TABLE_NAME . ' g on g.id=og.goodsid
                            left join ' . Order::TABLE_NAME . ' o on o.id=og.orderid
                        where og.uniacid = :uniacid and og.orderid=:orderid
                        order by og.createtime  desc ',
                        [':uniacid' => $_W['uniacid'], ':orderid' => $order['id']]);
                    $dividend = iunserializer($order['dividend']);
                    if (!empty($dividend)) {
                        $totaldividend += (isset($dividend['dividend_price']) ? (float)$dividend['dividend_price'] : 0);
                        $order['dividend_price'] = (isset($dividend['dividend_price']) ? (float)$dividend['dividend_price'] : 0);
                        if (2 <= $order['dividend_status']) {
                            $totalpay += (isset($dividend['dividend_price']) ? (float)$dividend['dividend_price'] : 0);
                        }
                    }
                    if ($order['dividend_status'] == 3) {
                        $order['dstatus'] = '已打款';
                    } elseif ($order['dividend_status'] == 2) {
                        $order['dstatus'] = '待打款';
                    } elseif ($order['dividend_status'] == 0) {
                        $order['dstatus'] = '未审核';
                    } elseif ($order['dividend_status'] == -1) {
                        $order['dstatus'] = '未通过';
                    }
                    $row['goods'] = $goods;
                    $order['goods'] = $goods;
                    $order['goodscount'] = count($goods);
                    $ordergoodscount += $order['goodscount'];
                    $goodscount += $order['goodscount'];
                    $rowcount += $order['goodscount'];
                }
                unset($order);
                $row['orders'] = $orders;
                if ($status == 2 || $status == 3) {
                    $charge_flag = 0;
                    $set_array = [];
                    $set_array['charge'] = $row['charge'];
                    $set_array['begin'] = $row['beginmoney'];
                    $set_array['end'] = $row['endmoney'];
                    if ($status == 3) {
                        $passmoney = $totalpay;
                    }
                    if (!empty($set_array['charge'])) {
                        $money_array = m('member')->getCalculateMoney($passmoney, $set_array);
                        if ($money_array['flag']) {
                            $charge_flag = 1;
                            $realmoney = $money_array['realmoney'];
                        }
                    }
                    $row['passmoney'] = $passmoney;
                    if ($charge_flag) {
                        $row['realmoney'] = $realmoney;
                    } else {
                        $row['realmoney'] = $passmoney;
                    }
                }
                $row['goodscount'] = $ordergoodscount;
                $lastgoodscount += $ordergoodscount;
                $row['lastgoodscount'] = $lastgoodscount;
                $row['bankcard'] = "\t" . $row['bankcard'] . "\t";
            }
            unset($row);
            $exportlist = [];
            for ($i = 0; $i < $rowcount; $i++) {
                $exportlist["row" . $i] = [];
            }
            $rowindex = 0;
            $len = count($list);
            foreach ($list as $index => $row) {
                $exportlist['row' . $rowindex] = $row;
                $orderindex = $rowindex;
                foreach ($row['orders'] as $order) {
                    $exportlist['row' . $orderindex]['ordersn'] = $order['ordersn'];
                    $exportlist['row' . $orderindex]['price'] = $order['price'];
                    $exportlist['row' . $orderindex]['dstatus'] = $order['dstatus'];
                    $exportlist['row' . $orderindex]['dividend_price'] = $order['dividend_price'];
                    $goodsindex = $orderindex;
                    foreach ($order['goods'] as $g) {
                        $exportlist['row' . $goodsindex]['title'] = $g['title'];
                        $exportlist['row' . $goodsindex]['total'] = $g['total'];
                        $exportlist['row' . $goodsindex]['realprice'] = $g['realprice'];
                        $goodsindex++;
                    }
                    $orderindex += $order['goodscount'];
                }
                $nextindex = 0;
                for ($i = 0; $i <= $index; $i++) {
                    $nextindex += $list[$i]['goodscount'];
                }
                $rowindex = $nextindex;
            }
            $columns = [];
            $columns[] = ['title' => 'ID', 'field' => 'id', 'width' => 12];
            $columns[] = ['title' => '提现单号', 'field' => 'applyno', 'width' => 24];
            $columns[] = ['title' => '粉丝', 'field' => 'nickname', 'width' => 12];
            $columns[] = ['title' => '姓名', 'field' => 'realname', 'width' => 12];
            $columns[] = ['title' => '手机号码', 'field' => 'mobile', 'width' => 12];
            $columns[] = ['title' => '订单号', 'field' => 'ordersn', 'width' => 24];
            $columns[] = ['title' => '订单金额', 'field' => 'price', 'width' => 12];
            $columns[] = ['title' => '商品', 'field' => 'title', 'width' => 24];
            $columns[] = ['title' => '数量', 'field' => 'total', 'width' => 12];
            $columns[] = ['title' => '价格', 'field' => 'realprice', 'width' => 12];
            $columns[] = ['title' => '状态', 'field' => 'dstatus', 'width' => 12];
            $columns[] = ['title' => '订单分红', 'field' => 'dividend_price', 'width' => 12];
            $columns[] = ['title' => '提现手续费%', 'field' => 'charge', 'width' => 12];
            if ($status == 2 || $status == 3) {
                if ($status == 2) {
                    $column_title1 = '应该打款';
                    $column_title2 = '实际分红';
                } else {
                    $column_title1 = '实际打款';
                    $column_title2 = '实际到账';
                }
                $columns[] = ['title' => $column_title1, 'field' => 'passmoney', 'width' => 12];
                $columns[] = ['title' => $column_title2, 'field' => 'realmoney', 'width' => 12];
            }
            $columns[] = ['title' => '提现方式', 'field' => 'typestr', 'width' => 12];
            $columns[] = ['title' => '提现姓名', 'field' => 'applyrealname', 'width' => 24];
            $columns[] = ['title' => '支付宝', 'field' => 'alipay', 'width' => 24];
            $columns[] = ['title' => '银行', 'field' => 'bankname', 'width' => 24];
            $columns[] = ['title' => '银行卡号', 'field' => 'bankcard', 'width' => 24];
            $columns[] = ['title' => '申请时间', 'field' => 'applytime', 'width' => 24];
            $columns[] = ['title' => '审核时间', 'field' => 'checktime', 'width' => 24];
            $columns[] = ['title' => '打款时间', 'field' => 'paytime', 'width' => 24];
            $columns[] = ['title' => '设置无效时间', 'field' => 'invalidtime', 'width' => 24];
            m('excel')->export($exportlist,
                ['title' => $applytitle . '分红申请数据-' . date('Y-m-d-H-i', time()), 'columns' => $columns]);
        }
        $total = pdo_fetchcolumn('select count(a.id)
            from ' . DividendApply::TABLE_NAME . ' a
                left join ' . Member::TABLE_NAME . ' m on m.uid = a.mid' . '
            where 1 ' . $condition,
            $params);
        $pager = pagination2($total, $pindex, $psize);
        include($this->template());
    }

    protected function applyData()
    {
        global $_W;
        global $_GPC;
        $id = (int)$_GPC['id'];
        $apply = pdo_fetch('
            select * from ' . DividendApply::TABLE_NAME . '
            where uniacid=:uniacid and id=:id limit 1',
            [':uniacid' => $_W['uniacid'], ':id' => $id]);
        if (empty($apply)) {
            if ($_W['isajax']) {
                show_json(0, '提现申请不存在!');
            }
            $this->message('提现申请不存在!', '', 'error');
        }
        $status = (int)$_GPC['status'];
        empty($status) && ($status = 1);

        if ($apply['status'] == -1) {
            ca('dividend.apply.view_1');
        } else {
            ca('dividend.apply.view' . $apply['status']);
        }
        $headsid = $apply['mid'];
        $member = $this->model->getInfo($headsid, ['total', 'ok', 'apply', 'lock', 'check']);
        $orderids = explode(",", $apply["orderids"]);
        if (!is_array($orderids) || count($orderids) <= 0) {
            $this->message('无任何订单，无法查看!', '', 'error');
        }
        $list = pdo_fetchall('
            select id,headsid, ordersn,price,goodsprice, dispatchprice,discountprice,deductprice,deductcredit2,
                   deductenough,couponprice,createtime, paytype,dividend,dividend_status,dividend_content
            from ' . Order::TABLE_NAME . '
            where  id in ( ' . $apply['orderids'] . ' );');
        $totaldividend = 0;
        $totalmoney = 0;
        $totalpay = 0;
        foreach ($list as &$row) {
            $goods = pdo_fetchall('
                SELECT og.id,g.thumb,og.price,og.realprice, og.total,g.title,o.paytype,og.optionname
                from ' . OrderGoods::TABLE_NAME . ' og
                    left join ' . Goods::TABLE_NAME . ' g on g.id=og.goodsid
                    left join ' . Order::TABLE_NAME . ' o on o.id=og.orderid 
                where og.uniacid = :uniacid and og.orderid=:orderid
                order by og.createtime  desc ',
                [':uniacid' => $_W['uniacid'], ':orderid' => $row['id']]);
            $dividend = iunserializer($row['dividend']);
            if (!empty($dividend)) {
                $totaldividend += (isset($dividend['dividend_price']) ? (float)$dividend['dividend_price'] : 0);
                $row['dividend_price'] = (isset($dividend['dividend_price']) ? (float)$dividend['dividend_price'] : 0);
                if (2 <= $row['dividend_status']) {
                    $totalpay += (isset($dividend['dividend_price']) ? (float)$dividend['dividend_price'] : 0);
                }
            }
            $row['goods'] = $goods;
            $totalmoney += $row['price'];
        }
        unset($row);
        $totalcount = $total = pdo_fetchcolumn('
            select count(*)
            from ' . Order::TABLE_NAME . ' o
                left join ' . Member::TABLE_NAME . ' m on o.openid = m.openid
                left join ' . MemberAddress::TABLE_NAME . ' a on a.id = o.addressid
            where o.id in ( ' . $apply['orderids'] . ' );');
        $set_array = array();
        $set_array['charge'] = $apply['charge'];
        $set_array['begin'] = $apply['beginmoney'];
        $set_array['end'] = $apply['endmoney'];
        $realmoney = $totalpay;
        $deductionmoney = 0;
        if (!empty($set_array['charge'])) {
            $money_array = m('member')->getCalculateMoney($totalpay, $set_array);
            if ($money_array['flag']) {
                $realmoney = $money_array['realmoney'];
                $deductionmoney = $money_array['deductionmoney'];
            }
        }
        $apply_type = DividendApply::APPLY_TYPE;
        return array(
            $id,
            $status,
            $apply,
            $list,
            $totalcount,
            $totalmoney,
            $member,
            $totalpay,
            $totaldividend,
            $realmoney,
            $deductionmoney,
            $set_array['charge'],
            $set_array,
            $apply_type
        );
    }

    public function detail()
    {
        global $_W;
        global $_GPC;
        [
            $id,
            $status,
            $apply,
            $list,
            $totalcount,
            $totalmoney,
            $member,
            $totalpay,
            $totaldividend,
            $realmoney,
            $deductionmoney,
            $charge,
            $set_array,
            $apply_type
        ] = $this->applyData();
        include($this->template());
    }

    public function check()
    {
        global $_W;
        global $_GPC;
        [
            $id,
            $status,
            $apply,
            $list,
            $totalcount,
            $totalmoney,
            $member,
            $totalpay,
            $totaldividend,
            $realmoney,
            $deductionmoney,
            $charge,
            $set_array,
            $apply_type
        ] = $this->applyData();
        if ($apply['status'] != 1) {
            show_json(0, '此申请无法审核!');
        }
        $paydividend = 0;
        if (!is_array($list)) {
            show_json(0, '数据出错，请重新设置!');
        }
        $time = time();
        $isAllUncheck = true;
        foreach ($list as $order) {
            $update = [];
            if (isset($_GPC['status'][$order['id']])) {
                if ((int)$_GPC['status'][$order['id']] == 2) {
                    $dividend_price = 0;
                    $dividend = iunserializer($order['dividend']);
                    if (!empty($dividend)) {
                        $dividend_price = (isset($dividend['dividend_price']) ? (float)$dividend['dividend_price'] : 0);
                    }
                    $paydividend += $dividend_price;
                    $isAllUncheck = false;
                }
                $update = [
                    'dividend_checktime' => $time,
                    'dividend_status' => (int)$_GPC['status'][$order['id']],
                    'dividend_content' => $_GPC['content'][$order['id']]
                ];
            }
            if (!empty($update)) {
                pdo_update('ewei_shop_order', $update, ['id' => $order['id']]);
            }
        }
        if ($isAllUncheck) {
            pdo_update('ewei_shop_dividend_apply', ['status' => -1, 'invalidtime' => $time],
                ['id' => $id, 'uniacid' => $_W['uniacid']]);
        } else {
            pdo_update('ewei_shop_dividend_apply', ['status' => 2, 'checktime' => $time],
                ['id' => $id, 'uniacid' => $_W['uniacid']]);
            $rmoney = $paydividend;
            $dmoney = 0;
            if (!empty($set_array['charge'])) {
                $m_array = m('member')->getCalculateMoney($paydividend, $set_array);
                if ($m_array['flag']) {
                    $rmoney = $m_array['realmoney'];
                    $dmoney = $m_array['deductionmoney'];
                }
            }
            $mdividend = $paydividend;
            if (!empty($dmoney)) {
                $mdividend .= ',实际到账金额:' . $rmoney . ',提现手续费金额:' . $dmoney;
            }
            $this->model->sendMessage($member['openid'],
                ['dividend' => $mdividend, 'type' => $apply_type[$apply['type']]], Constants::TM_DIVIDEND_CHECK);
        }
        plog('dividend.apply.check',
            sprintf('佣金审核 ID: %s 申请编号: %s 总佣金: %s 审核通过佣金: %d ',
                $id, $apply['applyno'], $totalmoney, $paydividend));
        show_json(1, ['url' => webUrl('dividend/apply', ['status' => $apply['status']])]);
    }

    public function cancel()
    {
        global $_W;
        global $_GPC;
        [
            $id,
            $status,
            $apply,
            $list,
            $totalcount,
            $totalmoney,
            $member,
            $totalpay,
            $totaldividend,
            $realmoney,
            $deductionmoney,
            $charge,
            $set_array,
            $apply_type
        ] = $this->applyData();
        if ($apply['status'] != 2 && $apply['status'] != -1) {
            show_json(0, '此申请无法取消!');
        }
        foreach ($list as $row) {
            pdo_update('ewei_shop_order', ['dividend_checktime' => 0, 'dividend_status' => 1],
                ['id' => $row['id']]);
        }
        pdo_update('ewei_shop_dividend_apply', ['status' => 1, 'checktime' => 0, 'invalidtime' => 0],
            ['id' => $id, 'uniacid' => $_W['uniacid']]);
        plog('dividend.apply.cancel', '重新审核申请 ID: ' . $id . ' 申请编号: ' . $apply['applyno'] . ' ');
        show_json(1, ['url' => webUrl('dividend/apply', ['status' => 1])]);
    }

    public function refuse()
    {
        global $_W;
        global $_GPC;
        [
            $id,
            $status,
            $apply,
            $list,
            $totalcount,
            $totalmoney,
            $member,
            $totalpay,
            $totaldividend,
            $realmoney,
            $deductionmoney,
            $charge,
            $set_array,
            $apply_type
        ] = $this->applyData();
        if ($apply["status"] != 1) {
            show_json(0, '此申请无法拒绝!');
        }
        foreach ($list as $row) {
            pdo_update('ewei_shop_order', ['dividend_checktime' => 0, 'dividend_status' => 0],
                ['id' => $row['id']]);
        }
        pdo_update('ewei_shop_dividend_apply',
            ['status' => -2, 'checktime' => 0, 'invalidtime' => time()],
            ['id' => $id, 'uniacid' => $_W['uniacid']]);
        plog('dividend.apply.refuse', '驳回申请 ID: ' . $id . ' 申请编号: ' . $apply['applyno'] . ' ');
        show_json(1, ['url' => webUrl('dividend/apply', ['status' => 0])]);
    }

    public function pay($params = [], $mine = [])
    {
        global $_W;
        global $_GPC;
        [
            $id,
            $status,
            $apply,
            $list,
            $totalcount,
            $totalmoney,
            $member,
            $totalpay,
            $totaldividend,
            $realmoney,
            $deductionmoney,
            $charge,
            $set_array,
            $apply_type
        ] = $this->applyData();
        $set = $this->getSet();
        if ($apply['status'] != 2) {
            show_json(0, '此申请不能打款!');
        }
        $pay = round($realmoney, 2);
        if ($apply['type'] < 2) {
            if ($apply['type'] == 1) {
                $pay *= 100;
            }
            $data = m('common')->getSysset('pay');
            if (!empty($data['paytype']['commission']) && $apply['type'] == 1) {
                if (strpos($member['openid'], 'sns_wa_') === false) {
                    $result = m('finance')->payRedPack($member['openid'], $pay, $apply['applyno'], $apply, '分红佣金打款',
                        $data['paytype']);
                    pdo_update('ewei_shop_dividend_apply',
                        ['sendmoney' => $result['sendmoney'], 'senddata' => json_encode($result['senddata'])],
                        ['id' => $apply['id']]);
                    if ($result['sendmoney'] == $realmoney) {
                        $result = true;
                    } else {
                        $result = $result['error'];
                    }
                } else {
                    show_json(0, '小程序用户打款,请将佣金提现打款方式改为企业打款!');
                }
            } else {
                $result = m('finance')->pay($member['openid'], $apply['type'], $pay, $apply['applyno'], '分红佣金打款');
            }
            if (is_error($result)) {
                show_json(0, $result['message']);
            }
        }
        if ($apply['type'] == 2) {
            $sec = m('common')->getSec();
            $sec = iunserializer($sec['sec']);
            if (!empty($sec['alipay_pay']['open'])) {
                if ($sec['alipay_pay']['sign_type'] == 1) {
                    $batch_no_money = $pay * 100;
                    $batch_no = 'D' . date('Ymdhis') . 'DP' . $apply['id'] . 'MONEY' . $batch_no_money;
                    $single_res = m('finance')->singleAliPay(array(
                        'account' => $apply['alipay'],
                        'name' => $apply['realname'],
                        'money' => $pay
                    ), $batch_no, $sec['alipay_pay'], $set['texts']['dividend'] . '打款');
                    if ($single_res['errno'] == '-1') {
                        show_json(0, $single_res['message']);
                    }
                    $order_id = $single_res['order_id'];
                    $query_res = m('finance')->querySingleAliPay($sec['alipay_pay'], $order_id, $batch_no);
                    if ($query_res['errno'] == '-1') {
                        show_json(0, $query_res['message']);
                    }
                } else {
                    $batch_no_money = $pay * 100;
                    $batch_no = 'D' . date('Ymd') . 'DP' . $apply['id'] . 'MONEY' . $batch_no_money;
                    $res = m('finance')->AliPay([
                        'account' => $apply['alipay'],
                        'name' => $apply['realname'],
                        'money' => $pay
                    ], $batch_no, $sec['alipay_pay'], $set['texts']['dividend'] . '打款');
                    if (is_error($res)) {
                        show_json(0, $res['message']);
                    }
                    show_json(1, ['url' => $res]);
                }
            } else {
                show_json(0, '未开启,支付宝打款!');
            }
        }
        $time = time();
        foreach ($list as $row) {
            if ($row['dividend_status'] == 2) {
                pdo_update('ewei_shop_order', ['dividend_paytime' => $time, 'dividend_status' => 3],
                    ['id' => $row['id']]);
            }
        }
        pdo_update('ewei_shop_dividend_apply', [
            'status' => 3,
            'paytime' => $time,
            'dividend_pay' => $totalpay,
            'realmoney' => $realmoney,
            'deductionmoney' => $deductionmoney
        ], ['id' => $id, 'uniacid' => $_W['uniacid']]);
        $log = [
            'uniacid' => $_W['uniacid'],
            'applyid' => $apply['id'],
            'mid' => $member['id'],
            'dividend' => $totaldividend,
            'dividend_pay' => $totalpay,
            'realmoney' => $realmoney,
            'deductionmoney' => $deductionmoney,
            'charge' => $charge,
            'createtime' => $time,
            'type' => $apply['type']
        ];
        pdo_insert('ewei_shop_dividend_log', $log);
        $mdividend = $totalpay;
        if (!empty($deductionmoney)) {
            $mdividend .= ',实际到账金额:' . $realmoney . ',提现手续费金额:' . $deductionmoney;
        }
        plog('dividend.apply.pay',
            sprintf('分红打款 ID: %s 申请编号: %s 打款方式: %s 总佣金: %s 审核通过佣金: %s 实际到账金额: %s 提现手续费金额: %s 提现手续费税率: %s%%',
                $id, $apply['applyno'], $apply_type[$apply['type']], $totaldividend, $totalpay,
                $realmoney, $deductionmoney, $charge));
        show_json(1, ['url' => webUrl('dividend/apply', ['status' => $apply['status']])]);
    }

    public function payed($params = [], $mine = [])
    {
        global $_W;
        global $_GPC;
        [
            $id,
            $status,
            $apply,
            $list,
            $totalcount,
            $totalmoney,
            $member,
            $totalpay,
            $totaldividend,
            $realmoney,
            $deductionmoney,
            $charge,
            $set_array,
            $apply_type
        ] = $this->applyData();
        $set = $this->getSet();
        if ($apply['status'] != 2) {
            show_json(0, '此申请不能打款!');
        }
        $time = time();
        foreach ($list as $row) {
            if ($row['dividend_status'] == 2) {
                pdo_update('ewei_shop_order', ['dividend_paytime' => $time, 'dividend_status' => 3],
                    ['id' => $row['id']]);
            }
        }
        pdo_update('ewei_shop_dividend_apply', [
            'status' => 3,
            'paytime' => $time,
            'dividend_pay' => $totalpay,
            'realmoney' => $realmoney,
            'deductionmoney' => $deductionmoney
        ], ['id' => $id, 'uniacid' => $_W['uniacid']]);
        $log = [
            'uniacid' => $_W['uniacid'],
            'applyid' => $apply['id'],
            'mid' => $member['id'],
            'dividend' => $totaldividend,
            'dividend_pay' => $totalpay,
            'realmoney' => $realmoney,
            'deductionmoney' => $deductionmoney,
            'charge' => $charge,
            'createtime' => $time,
            'type' => $apply['type']
        ];
        pdo_insert('ewei_shop_dividend_log', $log);
        plog('dividend.apply.pay',
            sprintf('佣金打款 ID: %s 申请编号: %s 打款方式: 已经手动打款 总佣金: %s 审核通过佣金: %s 实际到账金额: %s 提现手续费金额: %s 提现手续费税率: %s%%',
                $id, $apply['applyno'], $totaldividend, $totalpay, $realmoney, $deductionmoney, $charge));
        show_json(1, ['url' => webUrl('dividend/apply', ['status' => $apply['status']])]);
    }
}
