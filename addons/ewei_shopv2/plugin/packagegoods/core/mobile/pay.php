<?php

use Ydb\Entity\Manual\PackagegoodsGoods;
use Ydb\Entity\Manual\PackagegoodsOrder;
use Ydb\Entity\Manual\PackagegoodsPaylog;

if (!defined('IN_IA')) {
    exit('Access Denied');
}

class Pay_EweiShopV2Page extends PluginMobileLoginPage
{
    public function main()
    {
        global $_W;
        global $_GPC;
        $openid = $_W['openid'];
        load()->model('mc');
        $uid = mc_openid2uid($openid);
        if (empty($uid)) {
            mc_oauth_userinfo($openid);
        }
        $member = m('member')->getMember($openid, true);
        $uniacid = $_W['uniacid'];
        $orderid = (int)$_GPC['orderid'];
        $order = pdo_fetch('select o.*,g.id as g_id,g.title,g.status as gstatus,g.deleted as gdeleted,g.stock,
                        g.packagedata,g.package_label
                    from ' . PackagegoodsOrder::TABLE_NAME . ' as o'
            . ' left join ' . PackagegoodsGoods::TABLE_NAME . ' as g on g.id = o.goodid'
            . ' where o.id = :id and o.uniacid = :uniacid order by o.createtime desc',
            array(':id' => $orderid, ':uniacid' => $uniacid)
        );

        if (empty($order)) {
            $this->message('订单未找到！', mobileUrl('packagegoods/index'), 'error');
        }
        if ($order['success'] == -1) {
            $this->message('该礼包已失效，请浏览其他礼包或联系平台！', mobileUrl('packagegoods/index'), 'error');
        }
        if (empty($order['gstatus']) || !empty($order['gdeleted'])) {
            $this->message($order['title'] . '<br/> 已下架!', mobileUrl('packagegoods/index'), 'error');
        }
        if ($order['stock'] <= 0) {
            $this->message($order['title'] . '<br/>库存不足!', mobileUrl('packagegoods/index'), 'error');
        }
        if (empty($order)) {
            header('location: ' . mobileUrl('packagegoods'));
            exit();
        }

        if ($order['status'] == -1) {
            header('location: ' . mobileUrl('packagegoods/goods', array('id' => $order['goodid'])));
            exit();
        } else {
            if (1 <= $order['status']) {
                header('location: ' . mobileUrl('packagegoods/goods', array('id' => $order['goodid'])));
                exit();
            }
        }

        $log = pdo_fetch('SELECT * FROM ' . PackagegoodsPaylog::TABLE_NAME
            . ' WHERE `uniacid`=:uniacid AND `module`=:module AND `tid`=:tid limit 1',
            array(':uniacid' => $uniacid, ':module' => 'packagegoods', ':tid' => $order['orderno']));

        if (!(empty($log)) && ($log['status'] != '0')) {
            header('location: ' . mobileUrl('packagegoods/goods', array('id' => $order['id'])));
            exit();
        }
        if (empty($log)) {
            $log = array(
                'uniacid' => $uniacid,
                'openid' => $_W['openid'],
                'module' => 'packagegoods',
                'tid' => $order['orderno'],
                'credit' => $order['credit'],
                'creditmoney' => $order['creditmoney'],
                'fee' => ($order['price'] - $order['creditmoney']) + $order['freight'],
                'status' => 0
            );
            pdo_insert('ewei_shop_packagegoods_paylog', $log);
            $plid = pdo_insertid();
        }

        $set = m('common')->getSysset(array('shop', 'pay'));
        $set['pay']['weixin'] = (!(empty($set['pay']['weixin_sub'])) ? 1 : $set['pay']['weixin']);
        $set['pay']['weixin_jie'] = (!(empty($set['pay']['weixin_jie_sub'])) ? 1 : $set['pay']['weixin_jie']);
        $sec = m('common')->getSec();
        $sec = iunserializer($sec['sec']);
        $param_title = $set['shop']['name'] . '订单';
        $credit = array('success' => false);
        if (isset($set['pay']) && ($set['pay']['credit'] == 1)) {
            if ($order['deductcredit2'] <= 0) {
                $credit = array('success' => true, 'current' => $member['credit2']);
            }
        }
        $wechat = array('success' => false);
        if (is_weixin()) {//微信端
            $params = array();
            $params['tid'] = $log['tid'];
            $params['user'] = $openid;
            $params['fee'] = $log['fee'];
            $params['title'] = $param_title;
            if (isset($set['pay']) && ($set['pay']['weixin'] == 1)) {//微信支付
                load()->model('payment');
                $setting = uni_setting($_W['uniacid'], array('payment'));
                $options = array();
                if (is_array($setting['payment'])) {
                    $options = $setting['payment']['wechat'];
                    $options['appid'] = $_W['account']['key'];
                    $options['secret'] = $_W['account']['secret'];
                }
                $wechat = m('common')->wechat_build($params, $options, 99);
                if (!(is_error($wechat))) {
                    $wechat['success'] = true;
                    if (!(empty($wechat['code_url']))) {
                        $wechat['weixin_jie'] = true;
                    } else {
                        $wechat['weixin'] = true;
                    }
                }
            }
            if (isset($set['pay']) && ($set['pay']['weixin_jie'] == 1) && !($wechat['success'])) {//微信扫码支付
                $params['tid'] = $params['tid'] . '_borrow';
                $options = array();
                $options['appid'] = $sec['appid'];
                $options['mchid'] = $sec['mchid'];
                $options['apikey'] = $sec['apikey'];
                if (!(empty($set['pay']['weixin_jie_sub'])) && !(empty($sec['sub_secret_jie_sub']))) {
                    $wxuser = m('member')->wxuser($sec['sub_appid_jie_sub'], $sec['sub_secret_jie_sub']);
                    $params['openid'] = $wxuser['openid'];
                } else {
                    if (!(empty($sec['secret']))) {
                        $wxuser = m('member')->wxuser($sec['appid'], $sec['secret']);
                        $params['openid'] = $wxuser['openid'];
                    }
                }
                $wechat = m('common')->wechat_native_build($params, $options, 99);
                if (!(is_error($wechat))) {
                    $wechat['success'] = true;
                    if (!(empty($params['openid']))) {
                        $wechat['weixin'] = true;
                    } else {
                        $wechat['weixin_jie'] = true;
                    }
                }
            }
        }
        $payinfo = array('orderid' => $orderid, 'credit' => $credit, 'wechat' => $wechat, 'money' => $log['fee']);
        if (is_h5app()) {
            $payinfo = array(
                'wechat' => !empty($sec['app_wechat']['merchname']) && !empty($set['pay']['app_wechat'])
                && !empty($sec['app_wechat']['appid']) && !empty($sec['app_wechat']['appsecret'])
                && !empty($sec['app_wechat']['merchid']) && !empty($sec['app_wechat']['apikey'])
                && (0 < $order['price'])
                    ? true : false,
                'alipay' => false,
                'mcname' => $sec['app_wechat']['merchname'],
                'ordersn' => $order['orderno'],
                'money' => $log['fee'],
                'attach' => $_W['uniacid'] . ':99',
                'type' => 99,
                'orderid' => $orderid,
                'credit' => $credit,
            );
        }
        include $this->template();
    }

    //处理余额支付
    public function complete()
    {
        global $_W;
        global $_GPC;
        $orderid = (int)$_GPC['orderid'];
        $teamid = (int)$_GPC['teamid'];
        $isteam = (int)$_GPC['isteam'];
        $uniacid = $_W['uniacid'];
        $openid = $_W['openid'];
        if (is_h5app() && empty($orderid)) {
            $ordersn = $_GPC['ordersn'];
            $orderid = pdo_fetchcolumn('select id from ' . tablename('ewei_shop_packagegoods_order') . ' where orderno=:orderno and uniacid=:uniacid and openid=:openid limit 1',
                array(':orderno' => $ordersn, ':uniacid' => $uniacid, ':openid' => $openid));
        }
        if (empty($orderid)) {
            if ($_W['ispost']) {
                show_json(0, '参数错误!');
            } else {
                $this->message('参数错误!', mobileUrl('packagegoods/orders'));
            }
        }
        $order = pdo_fetch('select * from ' . tablename('ewei_shop_packagegoods_order')
            . ' where id = :orderid and uniacid=:uniacid and openid=:openid',
            array(':orderid' => $orderid, ':uniacid' => $uniacid, ':openid' => $openid));
        if (empty($order)) {
            if ($_W['ispost']) {
                show_json(0, '订单不存在!');
            } else {
                $this->message('参数错误!', mobileUrl('packagegoods/orders'));
            }
        }
        $order_goods = pdo_fetch('select * from  ' . tablename('ewei_shop_packagegoods_goods') . "\r\n\t\t\t\t\t"
            . 'where id = :id and uniacid=:uniacid ', array(':uniacid' => $_W['uniacid'], ':id' => $order['goodid']));

        //升级大礼包身份和相关关联设置
        $order_goods['packagedata'] = unserialize($order_goods['packagedata']);
        $order_goods['package_label'] = unserialize($order_goods['package_label']);
        $order_goods['package_member_card'] = unserialize($order_goods['package_member_card']);
        if (empty($order_goods)) {
            if ($_W['ispost']) {
                show_json(0, '礼包不存在!');
            } else {
                $this->message('礼包不存在!', mobileUrl('packagegoods/orders'));
            }
        }
        $type = $_GPC['type'];
        if (!(in_array($type, array('wechat', 'alipay', 'credit', 'cash')))) {
            if ($_W['ispost']) {
                show_json(0, '未找到支付方式!');
            } else {
                $this->message('未找到支付方式!', mobileUrl('packagegoods/orders'));
            }
        }
        $log = pdo_fetch(
            'SELECT * FROM ' . tablename('ewei_shop_packagegoods_paylog') . "\r\n\t\t"
            . ' WHERE `uniacid`=:uniacid AND `module`=:module AND `tid`=:tid limit 1',
            array(':uniacid' => $uniacid, ':module' => 'packagegoods', ':tid' => $order['orderno'])
        );
        $log['mid'] = intval($_GPC['mid']);//分享邀请人

        if (empty($log)) {
            if ($_W['ispost']) {
                show_json(0, '支付出错,请重试(0)!');
            } else {
                $this->message('支付出错,请重试!', mobileUrl('packagegoods/orders'));
            }
        }
        if ($type == 'credit') {//余额支付
            $orderno = $order['orderno'];
            $credits = m('member')->getCredit($openid, 'credit2');
            if (($credits < $log['fee']) || ($credits < 0)) {
                show_json($credits, '余额不足,请充值');
            }
            $fee = floatval($log['fee']);
            $result = m('member')->setCredit($openid, 'credit2', -$fee,
                array($_W['member']['uid'], $_W['shopset']['shop']['name'] . '消费' . $fee));
            if (is_error($result)) {
                if ($_W['ispost']) {
                    show_json(0, $result['message']);
                } else {
                    $this->message($result['message'], mobileUrl('packagegoods/orders'));
                }
            }
            $this->model->payResult($log['mid'], $log['tid'], $type);

            if ($order_goods['package_label']['virtual_package_label'] == 1) {//虚拟礼包类型--订单状态
                pdo_update('ewei_shop_packagegoods_order',
                    array('pay_type' => 'credit', 'status' => 3, 'paytime' => time(), 'starttime' => time()),
                    array('id' => $orderid));
            } else {
                pdo_update('ewei_shop_packagegoods_order',
                    array('pay_type' => 'credit', 'status' => 1, 'paytime' => time(), 'starttime' => time()),
                    array('id' => $orderid));
            }

            if ($_W['ispost']) {
                show_json(1);
            } else {
                header('location: ' . mobileUrl('packagegoods/team/detail',
                        array('orderid' => $orderid, 'teamid' => $orderid)));
                exit();
            }
        } else {
            if ($type == 'wechat') {//微信支付
                $orderno = $order['orderno'];
                if (!(empty($order['ordersn2']))) {
                    $orderno .= 'GJ' . sprintf('%02d', $order['ordersn2']);
                }
                $payquery = m('finance')->isWeixinPay($orderno, $log['fee'], (is_h5app() ? true : false));
                $payqueryBorrow = m('finance')->isWeixinPayBorrow($orderno, $log['fee']);
                if (!(is_error($payquery)) || !(is_error($payqueryBorrow))) {
                    $this->model->payResult($log['mid'], $log['tid'], $type, (is_h5app() ? true : false));

                    if ($order_goods['package_label']['virtual_package_label'] == 1) {//虚拟礼包类型--订单状态
                        pdo_update('ewei_shop_packagegoods_order', array(
                            'pay_type' => 'wechat',
                            'status' => 3,
                            'paytime' => time(),
                            'starttime' => time(),
                            'apppay' => (is_h5app() ? 1 : 0)
                        ), array('id' => $orderid));
                    } else {
                        pdo_update('ewei_shop_packagegoods_order', array(
                            'pay_type' => 'wechat',
                            'status' => 1,
                            'paytime' => time(),
                            'starttime' => time(),
                            'apppay' => (is_h5app() ? 1 : 0)
                        ), array('id' => $orderid));
                    }

                    if ($_W['ispost']) {
                        show_json(1);
                    } else {
                        show_json(1);
                        header('location: ' . mobileUrl('packagegoods/team/detail',
                                array('orderid' => $orderid, 'teamid' => $orderid)));
                        exit();
                    }
                } else {
                    if ($_W['ispost']) {
                        show_json(0, '支付出错,请重试(1)!');
                    } else {
                        $this->message('支付出错,请重试!', mobileUrl('packagegoods/orders'));
                    }
                }
            }
        }
    }

    //处理微信支付
    public function orderstatus()
    {
        global $_W;
        global $_GPC;
        $uniacid = $_W['uniacid'];
        $orderid = intval($_GPC['id']);
        $order = pdo_fetch('select status from ' . tablename('ewei_shop_packagegoods_order') . ' where id=:id and uniacid=:uniacid limit 1',
            array(':id' => $orderid, ':uniacid' => $uniacid));
        show_json(1, $order);
    }

    //校正订单
    public function checkorder()
    {
        global $_W;
        global $_GPC;
        $uniacid = $_W['uniacid'];
        $orderid = intval($_GPC['orderid']);
        $order = pdo_fetch(
            'select o.*,g.title,g.status as gstatus,g.deleted as gdeleted,g.stock from ' . tablename('ewei_shop_packagegoods_order') . ' as o' . "\r\n\t\t\t\t"
            . 'left join ' . tablename('ewei_shop_packagegoods_goods') . ' as g on g.id = o.goodid' . "\r\n\t\t\t\t"
            . 'where o.id = :id and o.uniacid = :uniacid order by o.createtime desc',
            array(':id' => $orderid, ':uniacid' => $uniacid)
        );
        if (empty($order)) {
            show_json(0, '订单未找到！');
        }
        if ($order['success'] == -1) {
            show_json(0, '该礼包已失效，请浏览其他礼包或联系平台！！');
        }
        if (empty($order['gstatus']) || !(empty($order['gdeleted']))) {
            show_json(0, $order['title'] . '<br/> 已下架!');
        }
        if ($order['stock'] <= 0) {
            show_json(0, $order['title'] . '<br/>库存不足!');
        }
        show_json(1, '可以支付');
    }
}

?>