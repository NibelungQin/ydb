<?php

use Ydb\Entity\Manual\DividendBank;
use Ydb\Entity\Manual\Order;
use Ydb\Util\Constants;

if (!defined('IN_IA')) {
    exit('Access Denied');
}

require_once EWEI_SHOPV2_PLUGIN . 'dividend/core/page_login_mobile.php';

class Dividend_Apply_EweiShopV2PluginMobilePage extends DividendMobileLoginPage
{
    public function main()
    {
        global $_W;
        global $_GPC;
        $page_title = '商城';
        if (!empty($_W['shopset']['shop']['name'])) {
            $page_title = $_W['shopset']['shop']['name'];
        }
        $openid = $_W['openid'];
        $member = $this->model->getInfo($openid, array());
        $time = time();
        $day_times = (int)$this->set['settledays'] * 3600 * 24;
        $dividend_ok = 0;
        $orders = pdo_fetchall('
            select id,dividend from ' . Order::TABLE_NAME . '
            where headsid=:headsid and status>=3  and dividend_status=0
                and (' . $time . ' - finishtime > ' . $day_times . ') and uniacid=:uniacid
            group by id',
            [':uniacid' => $_W['uniacid'], ':headsid' => $member['id']]);
        foreach ($orders as $o) {
            $dividend = iunserializer($o['dividend']);
            if (!empty($dividend)) {
                $dividend_ok += (isset($dividend['dividend_price']) ? (float)$dividend['dividend_price'] : 0);
            }
        }
        $withdraw = (float)$this->set['withdraw'];
        if ($withdraw <= 0) {
            $withdraw = 1;
        }
        $cansettle = $withdraw <= $dividend_ok;
        $member['dividend_ok'] = number_format($dividend_ok, 2);
        $set_array = [];
        $set_array['charge'] = $this->set['withdrawcharge'];
        $set_array['begin'] = (float)$this->set['withdrawbegin'];
        $set_array['end'] = (float)$this->set['withdrawend'];
        $realmoney = $dividend_ok;
        $deductionmoney = 0;
        if (!empty($set_array['charge'])) {
            $money_array = m('member')->getCalculateMoney($dividend_ok, $set_array);
            if ($money_array['flag']) {
                $realmoney = $money_array['realmoney'];
                $deductionmoney = $money_array['deductionmoney'];
            }
        }
        $last_data = $this->model->getLastApply($member['id']);
        $canusewechat = !strexists($openid, 'wap_user_') && !strexists($openid, 'sns_qq_')
            && !strexists($openid, 'sns_wx_') && !strexists($openid, 'sns_wa_');
        $type_array = array();
        if ($this->set['cashcredit'] == 1) {
            $type_array[0]['title'] = $this->set['texts']['withdraw'] . '到' . $_W['shopset']['trade']['moneytext'];
        }
        if ($this->set['cashweixin'] == 1 && $canusewechat) {
            $type_array[1]['title'] = $this->set['texts']['withdraw'] . '到微信钱包';
        }
        if ($this->set['cashother'] == 1) {
            if ($this->set['cashalipay'] == 1) {
                $type_array[2]['title'] = $this->set['texts']['withdraw'] . '到支付宝';
                if (!empty($last_data) && $last_data['type'] != 2) {
                    $type_last = $this->model->getLastApply($member['id'], 2);
                    if (!empty($type_last)) {
                        $last_data['realname'] = $type_last['realname'];
                        $last_data['alipay'] = $type_last['alipay'];
                    }
                }
            }
            if ($this->set['cashcard'] == 1) {
                $type_array[3]['title'] = $this->set['texts']['withdraw'] . '到银行卡';
                if (!empty($last_data) && $last_data['type'] != 3) {
                    $type_last = $this->model->getLastApply($member['id'], 3);
                    if (!empty($type_last)) {
                        $last_data['realname'] = $type_last['realname'];
                        $last_data['bankname'] = $type_last['bankname'];
                        $last_data['bankcard'] = $type_last['bankcard'];
                    }
                }
                $condition = ' and uniacid=:uniacid and status=1';
                $params = array(':uniacid' => $_W['uniacid']);
                $banklist = pdo_fetchall('
                    SELECT * FROM ' . DividendBank::TABLE_NAME . '
                    WHERE 1 ' . $condition . '
                    ORDER BY displayorder DESC', $params);
            }
        }
        if (!empty($last_data) && array_key_exists($last_data['type'], $type_array)) {
            $type_array[$last_data['type']]['checked'] = 1;
        }
        if ($_W['ispost']) {
            if (empty($_SESSION['dividend_apply_token'])) {
                show_json(0, '不要短时间重复下提交!');
            }
            unset($_SESSION['dividend_apply_token']);
            if ($dividend_ok <= 0 || empty($orders)) {
                show_json(0, '参数错误,请刷新页面后重新提交!');
            }
            $type = (int)$_GPC['type'];
            if (!array_key_exists($type, $type_array)) {
                show_json(0, '未选择提现方式，请您选择提现方式后重试!');
            }
            $apply = [];
            if ($type == 2) {
                $realname = trim($_GPC['realname']);
                $alipay = trim($_GPC['alipay']);
                $alipay1 = trim($_GPC['alipay1']);
                if (empty($realname)) {
                    show_json(0, '请填写姓名!');
                }
                if (empty($alipay)) {
                    show_json(0, '请填写支付宝帐号!');
                }
                if (empty($alipay1)) {
                    show_json(0, '请填写确认帐号!');
                }
                if ($alipay != $alipay1) {
                    show_json(0, '支付宝帐号与确认帐号不一致!');
                }
                $apply['realname'] = $realname;
                $apply['alipay'] = $alipay;
            } elseif ($type == 3) {
                $realname = trim($_GPC['realname']);
                $bankname = trim($_GPC['bankname']);
                $bankcard = trim($_GPC['bankcard']);
                $bankcard1 = trim($_GPC['bankcard1']);
                if (empty($realname)) {
                    show_json(0, '请填写姓名!');
                }
                if (empty($bankname)) {
                    show_json(0, '请选择银行!');
                }
                if (empty($bankcard)) {
                    show_json(0, '请填写银行卡号!');
                }
                if (empty($bankcard1)) {
                    show_json(0, '请填写确认卡号!');
                }
                if ($bankcard != $bankcard1) {
                    show_json(0, '银行卡号与确认卡号不一致!');
                }
                $apply['realname'] = $realname;
                $apply['bankname'] = $bankname;
                $apply['bankcard'] = $bankcard;
            }
            $orderids = [];
            foreach ($orders as $o) {
                $orderids[] = $o['id'];
                pdo_update('ewei_shop_order',
                    ['dividend_status' => 1, 'dividend_applytime' => $time],
                    ['id' => $o['id'], 'uniacid' => $_W['uniacid']]);
            }
            $applyno = m('common')->createNO('dividend_apply', 'applyno', 'DA');
            $apply['uniacid'] = $_W['uniacid'];
            $apply['applyno'] = $applyno;
            $apply['orderids'] = implode(',', $orderids);
            $apply['mid'] = $member['id'];
            $apply['dividend'] = $dividend_ok;
            $apply['type'] = $type;
            $apply['status'] = 1;
            $apply['applytime'] = $time;
            $apply['realmoney'] = $realmoney;
            $apply['deductionmoney'] = $deductionmoney;
            $apply['charge'] = $set_array["charge"];
            $apply['beginmoney'] = $set_array["begin"];
            $apply['endmoney'] = $set_array['end'];
            pdo_insert('ewei_shop_dividend_apply', $apply);
            $apply_type = ['余额', '微信钱包', '支付宝', '银行卡'];
            $mdividend = $dividend_ok;
            if (!empty($deductionmoney)) {
                $mdividend .= ',实际到账金额:' . $realmoney . ',提现手续费金额:' . $deductionmoney;
            }
            $this->model->sendMessage($openid, ['dividend' => $mdividend, 'type' => $apply_type[$apply['type']]],
                Constants::TM_DIVIDEND_APPLY);
            $this->model->sendMessage($openid, ['dividend' => $mdividend, 'type' => $apply_type[$apply['type']]],
                Constants::TM_DIVIDEND_APPLYMONEY);
            show_json(1, '已提交,请等待审核!');
        }
        $token = md5(microtime());
        $_SESSION['dividend_apply_token'] = $token;
        include($this->template());
    }
}