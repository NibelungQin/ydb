<?php
if (!(defined('IN_IA'))) {
    exit('Access Denied');
}
define('TM_ATTRACTSHOP_PAY', 'TM_ATTRACTSHOP_PAY');
define('TM_ATTRACTSHOP_BECOME', 'TM_ATTRACTSHOP_BECOME');
if (!(class_exists('AttractshopModel'))) {
    class AttractshopModel extends PluginModel
    {
        public function getSet($uniacid = 0)
        {
            $set = parent::getSet($uniacid);
            $set['texts'] = array('partner' => (empty($set['texts']['partner']) ? '股东' : $set['texts']['partner']), 'center' => (empty($set['texts']['center']) ? '股东中心' : $set['texts']['center']), 'become' => (empty($set['texts']['become']) ? '成为股东' : $set['texts']['become']), 'bonus' => (empty($set['texts']['bonus']) ? '分红' : $set['texts']['bonus']), 'bonus_total' => (empty($set['texts']['bonus_total']) ? '累计分红' : $set['texts']['bonus_total']), 'bonus_lock' => (empty($set['texts']['bonus_lock']) ? '待结算分红' : $set['texts']['bonus_lock']), 'bonus_pay' => (empty($set['texts']['bonus_lock']) ? '已结算分红' : $set['texts']['bonus_pay']), 'bonus_wait' => (empty($set['texts']['bonus_wait']) ? '预计分红' : $set['texts']['bonus_wait']), 'bonus_detail' => (empty($set['texts']['bonus_detail']) ? '分红明细' : $set['texts']['bonus_detail']), 'bonus_charge' => (empty($set['texts']['bonus_charge']) ? '扣除提现手续费' : $set['texts']['bonus_charge']));
            return $set;
        }

        public function getBonus($openid = '', $params = array())
        {
            global $_W;
            $ret = array();
            if (in_array('ok', $params)) {
                $ret['ok'] = pdo_fetchcolumn('select ifnull(sum(paymoney),0) from ' . tablename('ewei_shop_attractshop_billp') . ' where openid=:openid and status=1 and uniacid=:uniacid limit 1', array(':uniacid' => $_W['uniacid'], ':openid' => $openid));
            }
            if (in_array('lock', $params)) {
                $billdData = pdo_fetchall('select id from ' . tablename('ewei_shop_attractshop_bill') . ' where 1 and uniacid = ' . intval($_W['uniacid']));
                $id = '';
                if (!(empty($billdData))) {
                    $ids = array();
                    foreach ($billdData as $v) {
                        $ids[] = $v['id'];
                    }
                    $id = implode(',', $ids);
                    $ret['lock'] = pdo_fetchcolumn('select ifnull(sum(paymoney),0) from ' . tablename('ewei_shop_attractshop_billp') . ' where openid=:openid and status<>1 and uniacid=:uniacid  and billid in(' . $id . ') limit 1', array(':uniacid' => $_W['uniacid'], ':openid' => $openid));
                }
            }
            $ret['total'] = $ret['ok'] + $ret['lock'];
            return $ret;
        }

        public function sendMessage($openid = '', $data = array(), $message_type = '')
        {
            global $_W;
            global $_GPC;
            $set = $this->getSet();
            $tm = $set['tm'];
            $templateid = $tm['templateid'];
            $time = date('Y-m-d H:i:s', time());
            $member = m('member')->getMember($openid);
            $usernotice = unserialize($member['noticeset']);
            if (!(is_array($usernotice))) {
                $usernotice = array();
            }
            if (($message_type == TM_ATTRACTSHOP_PAY) && empty($usernotice['attractshop_pay'])) {
                if ($tm['is_advanced']) {
                    if ($tm['attractshop_pay_close_advanced']) {
                        return false;
                    }
                    $tag = 'attractshop_pay';
                    $text = '您的' . $set['texts']['bonus'] . '已打款！' . "\n" . date('Y-m-d H:i') . "\n";
                    $message = array('first' => array('value' => '亲爱的' . $member['nickname'] . '，您的' . $set['texts']['center'] . '的' . $set['texts']['bonus'] . '已打款', 'color' => '#ff0000'), 'keyword2' => array('title' => '业务状态', 'value' => '分红发放通知', 'color' => '#000000'), 'keyword3' => array('title' => '业务内容', 'value' => '您的分红打款成功', 'color' => '#000000'), 'keyword1' => array('title' => '业务类型', 'value' => '会员通知', 'color' => '#000000'), 'remark' => array('value' => "\n" . '感谢您的支持', 'color' => '#000000'));
                    $toopenid = $openid;
                    $datas[] = array('name' => '昵称', 'value' => $member['nickname']);
                    $datas[] = array('name' => '时间', 'value' => $time);
                    $datas[] = array('name' => '金额', 'value' => $data['money']);
                    $datas[] = array('name' => '打款方式', 'value' => $data['type']);
                } else {
                    $message = $tm['pay'];
                    if (empty($message)) {
                        return false;
                    }
                    $message = str_replace('[昵称]', $member['nickname'], $message);
                    $message = str_replace('[时间]', date('Y-m-d H:i:s', time()), $message);
                    $message = str_replace('[金额]', $data['money'], $message);
                    $message = str_replace('[打款方式]', $data['type'], $message);
                    $msg = array('keyword1' => array('value' => '会员通知', 'color' => '#73a68d'), 'keyword2' => array('value' => (!(empty($tm['paytitle'])) ? $tm['paytitle'] : '分红发放通知'), 'color' => '#73a68d'), 'keyword3' => array('value' => $message, 'color' => '#73a68d'));
                    return $this->sendNotice($openid, $tm, 'pay_advanced', $data, $member, $msg);
                }
            } else if (($message_type == TM_ATTRACTSHOP_BECOME) && empty($usernotice['attractshop_become'])) {
                if ($tm['is_advanced']) {
                    if ($tm['attractshop_become_close_advanced']) {
                        return false;
                    }
                    $tag = 'attractshop_become';
                    $text = '恭喜您成功推荐' . $data['shop_name'] . '入驻！' . "\n" . date('Y-m-d H:i') . "\n";
                    $message = array('first' => array('value' => '亲爱的' . $member['nickname'] . '，恭喜您成功推荐' . $data['shop_name'] . '入驻！', 'color' => '#ff0000'), 'keyword2' => array('title' => '业务状态', 'value' => '推荐入驻通知', 'color' => '#000000'), 'keyword3' => array('title' => '业务内容', 'value' => '恭喜您推荐入驻', 'color' => '#000000'), 'keyword1' => array('title' => '业务类型', 'value' => '会员通知', 'color' => '#000000'), 'remark' => array('value' => "\n" . '感谢您的支持', 'color' => '#000000'));
                    $toopenid = $openid;
                    $datas[] = array('name' => '昵称', 'value' => $member['nickname']);
                    $datas[] = array('name' => '时间', 'value' => $time);
                } else {
                    $message = $tm['become'];
                    if (empty($message)) {
                        return false;
                    }
                    $message = str_replace('[昵称]', $data['nickname'], $message);
                    $message = str_replace('[时间]', date('Y-m-d H:i:s', $data['partnertime']), $message);
                    $msg = array('keyword1' => array('value' => '会员通知', 'color' => '#73a68d'), 'keyword2' => array('value' => (!(empty($tm['becometitle'])) ? $tm['becometitle'] : '推荐入驻通知'), 'color' => '#73a68d'), 'keyword3' => array('value' => $message, 'color' => '#73a68d'));
                    return $this->sendNotice($openid, $tm, 'become_advanced', $data, $member, $msg);
                }
            }
            m('notice')->sendNotice(array('openid' => $toopenid, 'tag' => $tag, 'default' => $message, 'cusdefault' => $text, 'datas' => $datas, 'plugin' => 'attractshop'));
        }

        protected function sendNotice($touser, $tm, $tag, $datas, $member, $msg)
        {
            global $_W;
            if (!(empty($tm['is_advanced'])) && !(empty($tm[$tag]))) {
                $advanced_template = pdo_fetch('select * from ' . tablename('ewei_shop_member_message_template') . ' where id=:id and uniacid=:uniacid limit 1', array(':id' => $tm[$tag], ':uniacid' => $_W['uniacid']));
                if (!(empty($advanced_template))) {
                    $url = ((!(empty($advanced_template['url'])) ? $this->replaceTemplate($advanced_template['url'], $tag, $datas, $member) : ''));
                    $advanced_message = array('first' => array('value' => $this->replaceTemplate($advanced_template['first'], $tag, $datas, $member), 'color' => $advanced_template['firstcolor']), 'remark' => array('value' => $this->replaceTemplate($advanced_template['remark'], $tag, $datas, $member), 'color' => $advanced_template['remarkcolor']));
                    $data = iunserializer($advanced_template['data']);
                    foreach ($data as $d) {
                        $advanced_message[$d['keywords']] = array('value' => $this->replaceTemplate($d['value'], $tag, $datas, $member), 'color' => $d['color']);
                    }
                    if (!(empty($advanced_template['template_id']))) {
                        m('message')->sendTplNotice($touser, $advanced_template['template_id'], $advanced_message);
                    } else {
                        m('message')->sendCustomNotice($touser, $advanced_message);
                    }
                }
            } else if (!(empty($tm['templateid']))) {
                m('message')->sendTplNotice($touser, $tm['templateid'], $msg);
            } else {
                m('message')->sendCustomNotice($touser, $msg);
            }
            return true;
        }

        protected function replaceTemplate($str, $tag, $data, $member)
        {
            $arr = array('[昵称]' => $member['nickname'], '[时间]' => date('Y-m-d H:i:s', time()), '[金额]' => (!(empty($data['bonus'])) ? $data['bonus'] : ''), '[提现方式]' => (!(empty($data['type'])) ? $data['type'] : ''), '[旧等级]' => (!(empty($data['oldlevel']['levelname'])) ? $data['oldlevel']['levelname'] : ''), '[旧等级分红比例]' => (!(empty($data['oldlevel']['bonus'])) ? $data['oldlevel']['bonus'] . '%' : ''), '[新等级]' => (!(empty($data['newlevel']['levelname'])) ? $data['newlevel']['levelname'] : ''), '[新等级分红比例]' => (!(empty($data['newlevel']['bonus'])) ? $data['newlevel']['bonus'] . '%' : ''));
            switch ($tag) {
                case 'become_advanced':
                    $arr['[时间]'] = date('Y-m-d H:i:s', $data['partnertime']);
                    $arr['[昵称]'] = $data['nickname'];
                case 'pay_advanced':
                    $arr['[时间]'] = date('Y-m-d H:i:s', $data['paytime']);
                    $arr['[昵称]'] = $data['nickname'];
                    break;
            }
            foreach ($arr as $key => $value) {
                $str = str_replace($key, $value, $str);
            }
            return $str;
        }

        public function getInfo($openid, $options = NULL)
        {
            $return = array();
            if (p('commission')) {
                return p('commission')->getInfo($openid, $options);
            }
            return $return;
        }

        public function getBonusData($year = 0, $month = 0, $week = 0, $openid = '')
        {
            global $_W;
            $set = $this->getSet();
            if (empty($set['bonusrate']) || ($set['bonusrate'] <= 0)) {
                $set['bonusrate'] = 100;
            }
            $days = get_last_day($year, $month);
            $starttime = strtotime($year . '-' . $month . '-1');
            $endtime = strtotime($year . '-' . $month . '-' . $days);
            $settletimes = intval($set['settledays']) * 86400;
            if ((1 <= $week) && ($week <= 4)) {
                $weekdays = array();
                $i = $starttime;
                while ($i <= $endtime) {
                    $ds = explode('-', date('Y-m-d', $i));
                    $day = intval($ds[2]);
                    $w = ceil($day / 7);
                    if (4 < $w) {
                        $w = 4;
                    }
                    if ($week == $w) {
                        $weekdays[] = $i;
                    }
                    $i += 86400;
                }
                $starttime = $weekdays[0];
                $endtime = strtotime(date('Y-m-d', $weekdays[count($weekdays) - 1]) . ' 23:59:59');
            } else {
                $endtime = strtotime($year . '-' . $month . '-' . $days . ' 23:59:59');
            }
            $bill = pdo_fetch('select * from ' . tablename('ewei_shop_attractshop_bill') . ' where uniacid=:uniacid and `year`=:year and `month`=:month and `week`=:week limit 1', array(':uniacid' => $_W['uniacid'], ':year' => $year, ':month' => $month, ':week' => $week));
            if (!(empty($bill)) && empty($openid)) {
                return array('ordermoney' => round($bill['ordermoney'], 2), 'ordercount' => $bill['ordercount'], 'bonusmoney' => round($bill['bonusmoney'], 2), 'bonusordermoney' => round($bill['bonusordermoney'], 2), 'bonusrate' => round($bill['bonusrate'], 2), 'bonusmoney_send' => round($bill['bonusmoney_send'], 2), 'partnercount' => $bill['partnercount'], 'starttime' => $starttime, 'endtime' => $endtime, 'billid' => $bill['id'], 'old' => true);
            }
            $ordermoney = 0;
            $bonusordermoney = 0;
            $bonusmoney = 0;
            $pcondition = '';
            if (!(empty($openid))) {
                $member = m('member')->getMember($openid);
                $pcondition = 'AND finishtime>' . $member['partnertime'];
            }
            $orders = pdo_fetchall('select id,openid,price,costprice,merchid from ' . tablename('ewei_shop_order') . ' where uniacid=' . $_W['uniacid'] . ' and status=3 and is_attractshop=0 and ismerch=1 and finishtime + ' . $settletimes . '>= ' . $starttime . ' and  finishtime + ' . $settletimes . '<=' . $endtime . ' ' . $pcondition, array(), 'id');
            $pcondition = '';
            if (!(empty($openid))) {
                $pcondition = ' and m.openid=\'' . $openid . '\'';
            }
            $partners = pdo_fetchall('select m.id,m.openid,mu.parent_openid from ' . tablename('ewei_shop_member') . ' m ' . '  right join ' . tablename('ewei_shop_merch_user') . ' mu on mu.parent_openid = m.openid ' . '  where m.uniacid=:uniacid ' . $pcondition . ' group by mu.parent_openid', array(':uniacid' => $_W['uniacid']));
            foreach ($partners as &$p){
                $shop_ids=pdo_fetchall('select id from '.tablename('ewei_shop_merch_user'). '  where uniacid=:uniacid ' . ' and parent_openid='."'".$p['openid']."'" ,array(':uniacid' => $_W['uniacid']));
                foreach($shop_ids as $k=>$v){
                    $p['shop_id'][$k]=$v['id'];
                }
            }
            unset($p);
            $commission = m('common')->getPluginset('commission');
            foreach ($orders as $o) {
                if($commission['calcutype']==2){
                    //如果按订单利润计算佣金
                    $o['price']=$o['price']-$o['costprice'];
                }
                $ordermoney += $o['price'];
                $bonusordermoney += ($o['price'] * $set['bonusrate']) / 100;
                foreach ($partners as &$p) {
                    if(in_array($o['merchid'],$p['shop_id'])){
                        $price = ($o['price'] * $set['bonusrate']) / 100;
                        !(isset($p['bonusmoney'])) && ($p['bonusmoney'] = 0);
                        $p['bonusmoney'] += floatval($price);
                    }
                }
                unset($p);
            }
            foreach ($partners as &$p) {
                $bonusmoney_send = 0;
                $p['charge'] = 0;
                $p['chargemoney'] = 0;
                if ((floatval($set['paycharge']) <= 0) || ((floatval($set['paybegin']) <= $p['bonusmoney']) && ($p['bonusmoney'] <= floatval($set['payend'])))) {
                    $bonusmoney_send += round($p['bonusmoney'], 2);
                } else {
                    $bonusmoney_send += round($p['bonusmoney'] - (($p['bonusmoney'] * floatval($set['paycharge'])) / 100), 2);
                    $p['charge'] = floatval($set['paycharge']);
                    $p['chargemoney'] = round(($p['bonusmoney'] * floatval($set['paycharge'])) / 100, 2);
                }
                $p['bonusmoney_send'] = $bonusmoney_send;
                $bonusmoney += $bonusmoney_send;
            }
            unset($p);
            if ($bonusordermoney < $bonusmoney) {
                $rat = $bonusordermoney / $bonusmoney;
                $bonusmoney = 0;
                foreach ($partners as &$p) {
                    $p['chargemoney'] = round($p['chargemoney'] * $rat, 2);
                    $p['bonusmoney_send'] = round($p['bonusmoney_send'] * $rat, 2);
                    $bonusmoney += $p['bonusmoney_send'];
                }
                unset($p);
            }
            return array('orders' => $orders, 'partners' => $partners, 'ordermoney' => round($ordermoney, 2), 'bonusordermoney' => round($bonusordermoney, 2), 'bonusrate' => round($set['bonusrate'], 2), 'ordercount' => count($orders), 'bonusmoney' => round($bonusmoney, 2), 'partnercount' => count($partners), 'starttime' => $starttime, 'endtime' => $endtime, 'old' => false);
        }

        public function getTotals()
        {
            global $_W;
            return array('total0' => pdo_fetchcolumn('select count(*) from ' . tablename('ewei_shop_attractshop_bill') . ' where uniacid=:uniacid and status=0 limit 1', array(':uniacid' => $_W['uniacid'])), 'total1' => pdo_fetchcolumn('select count(*) from ' . tablename('ewei_shop_attractshop_bill') . ' where uniacid=:uniacid and status=1 limit 1', array(':uniacid' => $_W['uniacid'])), 'total2' => pdo_fetchcolumn('select count(*) from ' . tablename('ewei_shop_attractshop_bill') . ' where uniacid=:uniacid and status=2  limit 1', array(':uniacid' => $_W['uniacid'])));
        }
    }
}
?>