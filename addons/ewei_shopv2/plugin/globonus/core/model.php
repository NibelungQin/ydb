<?php
if (!(defined('IN_IA'))) {
    exit('Access Denied');
}
define('TM_GLOBONUS_PAY', 'TM_GLOBONUS_PAY');
define('TM_GLOBONUS_UPGRADE', 'TM_GLOBONUS_UPGRADE');
define('TM_GLOBONUS_BECOME', 'TM_GLOBONUS_BECOME');
if (!(class_exists('GlobonusModel'))) {
    class GlobonusModel extends PluginModel
    {
        public function getSet($uniacid = 0)
        {
            $set = parent::getSet($uniacid);
            $set['texts'] = array('partner' => (empty($set['texts']['partner']) ? '店铺' : $set['texts']['partner']), 'center' => (empty($set['texts']['center']) ? '店铺奖励' : $set['texts']['center']), 'become' => (empty($set['texts']['become']) ? '成为店铺' : $set['texts']['become']), 'bonus' => (empty($set['texts']['bonus']) ? '分红' : $set['texts']['bonus']), 'bonus_total' => (empty($set['texts']['bonus_total']) ? '累计分红' : $set['texts']['bonus_total']), 'bonus_lock' => (empty($set['texts']['bonus_lock']) ? '待结算分红' : $set['texts']['bonus_lock']), 'bonus_pay' => (empty($set['texts']['bonus_lock']) ? '已结算分红' : $set['texts']['bonus_pay']), 'bonus_wait' => (empty($set['texts']['bonus_wait']) ? '预计分红' : $set['texts']['bonus_wait']), 'bonus_detail' => (empty($set['texts']['bonus_detail']) ? '分红明细' : $set['texts']['bonus_detail']), 'bonus_charge' => (empty($set['texts']['bonus_charge']) ? '扣除提现手续费' : $set['texts']['bonus_charge']));
            return $set;
        }

        public function getLevels($all = true, $default = false)
        {
            global $_W;
            if ($all) {
                $levels = pdo_fetchall('select * from ' . tablename('ewei_shop_globonus_level') . ' where uniacid=:uniacid order by bonus asc', array(':uniacid' => $_W['uniacid']));
            } else {
                $levels = pdo_fetchall('select * from ' . tablename('ewei_shop_globonus_level') . ' where uniacid=:uniacid and (ordermoney>0 or commissionmoney>0 or bonusmoney>0) order by bonus asc', array(':uniacid' => $_W['uniacid']));
            }
            if ($default) {
                $default = array('id' => '0', 'levelname' => (empty($_S['globonus']['levelname']) ? '默认等级' : $_S['globonus']['levelname']), 'bonus' => $_W['shopset']['globonus']['bonus']);
                $levels = array_merge(array($default), $levels);
            }
            return $levels;
        }

        public function getBonus($openid = '', $params = array())
        {
            global $_W;
            $ret = array();
            if (in_array('ok', $params)) {
                $ret['ok'] = pdo_fetchcolumn('select ifnull(sum(paymoney),0) from ' . tablename('ewei_shop_globonus_billp') . ' where openid=:openid and status=1 and uniacid=:uniacid limit 1', array(':uniacid' => $_W['uniacid'], ':openid' => $openid));
            }
            if (in_array('lock', $params)) {
                $billdData = pdo_fetchall('select id from ' . tablename('ewei_shop_globonus_bill') . ' where 1 and uniacid = ' . intval($_W['uniacid']));
                $id = '';
                if (!(empty($billdData))) {
                    $ids = array();
                    foreach ($billdData as $v) {
                        $ids[] = $v['id'];
                    }
                    $id = implode(',', $ids);
                    $ret['lock'] = pdo_fetchcolumn('select ifnull(sum(paymoney),0) from ' . tablename('ewei_shop_globonus_billp') . ' where openid=:openid and status<>1 and uniacid=:uniacid  and billid in(' . $id . ') limit 1', array(':uniacid' => $_W['uniacid'], ':openid' => $openid));
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
            if (($message_type == TM_GLOBONUS_PAY) && empty($usernotice['globonus_pay'])) {
                if ($tm['is_advanced']) {
                    if ($tm['globonus_pay_close_advanced']) {
                        return false;
                    }
                    $tag = 'globonus_pay';
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
            } else if (($message_type == TM_GLOBONUS_UPGRADE) && empty($usernotice['globonus_upgrade'])) {
                if ($tm['is_advanced']) {
                    if ($tm['globonus_upgrade_close_advanced']) {
                        return false;
                    }
                    $tag = 'globonus_upgrade';
                    $text = '恭喜您成为' . $data['newlevel']['levelname'] . $set['texts']['partner'] . '！' . "\n" . date('Y-m-d H:i') . "\n";
                    $message = array('first' => array('value' => '亲爱的' . $member['nickname'] . '，恭喜您成为' . $data['newlevel']['levelname'] . $set['texts']['partner'], 'color' => '#ff0000'), 'keyword2' => array('title' => '业务状态', 'value' => '店铺等级升级通知', 'color' => '#000000'), 'keyword3' => array('title' => '业务内容', 'value' => '您的店铺等级从' . $data['oldlevel']['levelname'] . '升级到' . $data['newlevel']['levelname'] . ',特此通知！', 'color' => '#000000'), 'keyword1' => array('title' => '业务类型', 'value' => '会员通知', 'color' => '#000000'), 'remark' => array('value' => "\n" . '感谢您的支持', 'color' => '#000000'));
                    $toopenid = $openid;
                    $datas[] = array('name' => '昵称', 'value' => $member['nickname']);
                    $datas[] = array('name' => '时间', 'value' => $time);
                    $datas[] = array('name' => '旧等级', 'value' => $data['oldlevel']['levelname']);
                    $datas[] = array('name' => '旧分红比例', 'value' => $data['oldlevel']['bonus'] . '%');
                    $datas[] = array('name' => '新等级', 'value' => $data['newlevel']['levelname']);
                    $datas[] = array('name' => '新分红比例', 'value' => $data['newlevel']['bonus'] . '%');
                } else {
                    $message = $tm['upgrade'];
                    if (empty($message)) {
                        return false;
                    }
                    $message = str_replace('[昵称]', $member['nickname'], $message);
                    $message = str_replace('[时间]', date('Y-m-d H:i:s', time()), $message);
                    $message = str_replace('[旧等级]', $data['oldlevel']['levelname'], $message);
                    $message = str_replace('[旧分红比例]', $data['oldlevel']['bonus'] . '%', $message);
                    $message = str_replace('[新等级]', $data['newlevel']['levelname'], $message);
                    $message = str_replace('[新分红比例]', $data['newlevel']['bonus'] . '%', $message);
                    $msg = array('keyword1' => array('value' => '会员通知', 'color' => '#73a68d'), 'keyword2' => array('value' => (!(empty($tm['upgradetitle'])) ? $tm['upgradetitle'] : '店铺等级升级通知'), 'color' => '#73a68d'), 'keyword3' => array('value' => $message, 'color' => '#73a68d'));
                    return $this->sendNotice($openid, $tm, 'upgrade_advanced', $data, $member, $msg);
                }
            } else if (($message_type == TM_GLOBONUS_BECOME) && empty($usernotice['globonus_become'])) {
                if ($tm['is_advanced']) {
                    if ($tm['globonus_become_close_advanced']) {
                        return false;
                    }
                    $tag = 'globonus_become';
                    $text = '恭喜您成为' . $set['texts']['center'] . '的店铺！' . "\n" . date('Y-m-d H:i') . "\n";
                    $message = array('first' => array('value' => '亲爱的' . $member['nickname'] . '，恭喜您成为' . $set['texts']['center'] . '的店铺', 'color' => '#ff0000'), 'keyword2' => array('title' => '业务状态', 'value' => '成为店铺通知', 'color' => '#000000'), 'keyword3' => array('title' => '业务内容', 'value' => '恭喜您成为店铺', 'color' => '#000000'), 'keyword1' => array('title' => '业务类型', 'value' => '会员通知', 'color' => '#000000'), 'remark' => array('value' => "\n" . '感谢您的支持', 'color' => '#000000'));
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
                    $msg = array('keyword1' => array('value' => '会员通知', 'color' => '#73a68d'), 'keyword2' => array('value' => (!(empty($tm['becometitle'])) ? $tm['becometitle'] : '成为店铺通知'), 'color' => '#73a68d'), 'keyword3' => array('value' => $message, 'color' => '#73a68d'));
                    return $this->sendNotice($openid, $tm, 'become_advanced', $data, $member, $msg);
                }
            }
            m('notice')->sendNotice(array('openid' => $toopenid, 'tag' => $tag, 'default' => $message, 'cusdefault' => $text, 'datas' => $datas, 'plugin' => 'globonus'));
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

        public function getLevel($openid)
        {
            global $_W;
            if (empty($openid)) {
                return false;
            }
            $member = m('member')->getMember($openid);
            if (empty($member['partnerlevel'])) {
                return false;
            }
            $level = pdo_fetch('select * from ' . tablename('ewei_shop_globonus_level') . ' where uniacid=:uniacid and id=:id limit 1', array(':uniacid' => $_W['uniacid'], ':id' => $member['partnerlevel']));
            return $level;
        }

        public function upgradeLevelByOrder($openid)
        {
            global $_W;
            if (empty($openid)) {
                return false;
            }
            $set = $this->getSet();
            if (empty($set['open'])) {
                return false;
            }
            $m = m('member')->getMember($openid);
            if (empty($m)) {
                return;
            }
            $leveltype = intval($set['leveltype']);
            if (($leveltype == 4) || ($leveltype == 5)) {
                if (!(empty($m['partnernotupgrade']))) {
                    return;
                }
                $oldlevel = $this->getLevel($m['openid']);
                if (empty($oldlevel['id'])) {
                    $oldlevel = array('levelname' => (empty($set['levelname']) ? '默认店铺' : $set['levelname']), 'bonus' => $set['bonus']);
                }
                $orders = pdo_fetch('select sum(og.realprice) as ordermoney,count(distinct og.orderid) as ordercount from ' . tablename('ewei_shop_order') . ' o ' . ' left join  ' . tablename('ewei_shop_order_goods') . ' og on og.orderid=o.id ' . ' where o.openid=:openid and o.status>=3 and o.uniacid=:uniacid limit 1', array(':uniacid' => $_W['uniacid'], ':openid' => $openid));
                $ordermoney = $orders['ordermoney'];
                $ordercount = $orders['ordercount'];
                if ($leveltype == 4) {
                    $newlevel = pdo_fetch('select * from ' . tablename('ewei_shop_globonus_level') . ' where uniacid=:uniacid  and ' . $ordermoney . ' >= ordermoney and ordermoney>0  order by ordermoney desc limit 1', array(':uniacid' => $_W['uniacid']));
                    if (empty($newlevel)) {
                        return;
                    }
                    if (!(empty($oldlevel['id']))) {
                        if ($oldlevel['id'] == $newlevel['id']) {
                            return;
                        }
                        if ($newlevel['ordermoney'] < $oldlevel['ordermoney']) {
                            return;
                            if ($leveltype == 5) {
                                $newlevel = pdo_fetch('select * from ' . tablename('ewei_shop_globonus_level') . ' where uniacid=:uniacid  and ' . $ordercount . ' >= ordercount and ordercount>0  order by ordercount desc limit 1', array(':uniacid' => $_W['uniacid']));
                                if (empty($newlevel)) {
                                    return;
                                }
                                if (!(empty($oldlevel['id']))) {
                                    if ($oldlevel['id'] == $newlevel['id']) {
                                        return;
                                    }
                                    if ($newlevel['ordercount'] < $oldlevel['ordercount']) {
                                        return;
                                    }
                                }
                            }
                        }
                    }
                } else {
                    $newlevel = pdo_fetch('select * from ' . tablename('ewei_shop_globonus_level') . ' where uniacid=:uniacid  and ' . $ordercount . ' >= ordercount and ordercount>0  order by ordercount desc limit 1', array(':uniacid' => $_W['uniacid']));
                    return;
                    return;
                    return;
                }
                pdo_update('ewei_shop_member', array('partnerlevel' => $newlevel['id']), array('id' => $m['id']));
                $this->sendMessage($m['openid'], array('nickname' => $m['nickname'], 'oldlevel' => $oldlevel, 'newlevel' => $newlevel), TM_GLOBONUS_UPGRADE);
            } else if ((0 <= $leveltype) && ($leveltype <= 3)) {
                $agents = array();
                if (!(empty($set['selfbuy']))) {
                    $agents[] = $m;
                }
                if (!(empty($m['agentid']))) {
                    $m1 = m('member')->getMember($m['agentid']);
                    if (!(empty($m1))) {
                        $agents[] = $m1;
                        if (!(empty($m1['agentid'])) && ($m1['isagent'] == 1) && ($m1['status'] == 1)) {
                            $m2 = m('member')->getMember($m1['agentid']);
                            if (!(empty($m2)) && ($m2['isagent'] == 1) && ($m2['status'] == 1)) {
                                $agents[] = $m2;
                                if (empty($set['selfbuy'])) {
                                    if (!(empty($m2['agentid'])) && ($m2['isagent'] == 1) && ($m2['status'] == 1)) {
                                        $m3 = m('member')->getMember($m2['agentid']);
                                        if (!(empty($m3)) && ($m3['isagent'] == 1) && ($m3['status'] == 1)) {
                                            $agents[] = $m3;
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
                if (empty($agents)) {
                    return;
                }
                foreach ($agents as $agent) {
                    $info = $this->getInfo($agent['id'], array('ordercount3', 'ordermoney3', 'order13money', 'order13'));
                    if (!(empty($info['partnernotupgrade']))) {
                        continue;
                    }
                    $oldlevel = $this->getLevel($agent['openid']);
                    if (empty($oldlevel['id'])) {
                        $oldlevel = array('levelname' => (empty($set['levelname']) ? '默认店铺' : $set['levelname']), 'bonus' => $set['bonus']);
                    }
                    if ($leveltype == 0) {
                        $ordermoney = $info['ordermoney3'];
                        $newlevel = pdo_fetch('select * from ' . tablename('ewei_shop_globonus_level') . ' where uniacid=:uniacid and ' . $ordermoney . ' >= ordermoney and ordermoney>0  order by ordermoney desc limit 1', array(':uniacid' => $_W['uniacid']));
                        if (empty($newlevel)) {
                            continue;
                        }
                        if (!(empty($oldlevel['id']))) {
                            if ($oldlevel['id'] == $newlevel['id']) {
                                continue;
                            }
                            if ($newlevel['ordermoney'] < $oldlevel['ordermoney']) {
                                continue;
                                if ($leveltype == 1) {
                                    $ordermoney = $info['order13money'];
                                    $newlevel = pdo_fetch('select * from ' . tablename('ewei_shop_globonus_level') . ' where uniacid=:uniacid and ' . $ordermoney . ' >= ordermoney and ordermoney>0  order by ordermoney desc limit 1', array(':uniacid' => $_W['uniacid']));
                                    if (empty($newlevel)) {
                                        continue;
                                    }
                                    if (!(empty($oldlevel['id']))) {
                                        if ($oldlevel['id'] == $newlevel['id']) {
                                            continue;
                                        }
                                        if ($newlevel['ordermoney'] < $oldlevel['ordermoney']) {
                                            continue;
                                            if ($leveltype == 2) {
                                                $ordercount = $info['ordercount3'];
                                                $newlevel = pdo_fetch('select * from ' . tablename('ewei_shop_globonus_level') . ' where uniacid=:uniacid  and ' . $ordercount . ' >= ordercount and ordercount>0  order by ordercount desc limit 1', array(':uniacid' => $_W['uniacid']));
                                                if (empty($newlevel)) {
                                                    continue;
                                                }
                                                if (!(empty($oldlevel['id']))) {
                                                    if ($oldlevel['id'] == $newlevel['id']) {
                                                        continue;
                                                    }
                                                    if ($newlevel['ordercount'] < $oldlevel['ordercount']) {
                                                        continue;
                                                        if ($leveltype == 3) {
                                                            $ordercount = $info['order13'];
                                                            $newlevel = pdo_fetch('select * from ' . tablename('ewei_shop_globonus_level') . ' where uniacid=:uniacid  and ' . $ordercount . ' >= ordercount and ordercount>0  order by ordercount desc limit 1', array(':uniacid' => $_W['uniacid']));
                                                            if (empty($newlevel)) {
                                                                continue;
                                                            }
                                                            if (!(empty($oldlevel['id']))) {
                                                                if ($oldlevel['id'] == $newlevel['id']) {
                                                                    continue;
                                                                }
                                                                if ($newlevel['ordercount'] < $oldlevel['ordercount']) {
                                                                    continue;
                                                                }
                                                            }
                                                        }
                                                    }
                                                }
                                            } else {
                                                $ordercount = $info['order13'];
                                                $newlevel = pdo_fetch('select * from ' . tablename('ewei_shop_globonus_level') . ' where uniacid=:uniacid  and ' . $ordercount . ' >= ordercount and ordercount>0  order by ordercount desc limit 1', array(':uniacid' => $_W['uniacid']));
                                                continue;
                                                continue;
                                                continue;
                                            }
                                        }
                                    }
                                } else {
                                    $ordercount = $info['ordercount3'];
                                    $newlevel = pdo_fetch('select * from ' . tablename('ewei_shop_globonus_level') . ' where uniacid=:uniacid  and ' . $ordercount . ' >= ordercount and ordercount>0  order by ordercount desc limit 1', array(':uniacid' => $_W['uniacid']));
                                    continue;
                                    continue;
                                    continue;
                                    $ordercount = $info['order13'];
                                    $newlevel = pdo_fetch('select * from ' . tablename('ewei_shop_globonus_level') . ' where uniacid=:uniacid  and ' . $ordercount . ' >= ordercount and ordercount>0  order by ordercount desc limit 1', array(':uniacid' => $_W['uniacid']));
                                    continue;
                                    continue;
                                    continue;
                                }
                            }
                        }
                    } else {
                        $ordermoney = $info['order13money'];
                        $newlevel = pdo_fetch('select * from ' . tablename('ewei_shop_globonus_level') . ' where uniacid=:uniacid and ' . $ordermoney . ' >= ordermoney and ordermoney>0  order by ordermoney desc limit 1', array(':uniacid' => $_W['uniacid']));
                        continue;
                        continue;
                        continue;
                        $ordercount = $info['ordercount3'];
                        $newlevel = pdo_fetch('select * from ' . tablename('ewei_shop_globonus_level') . ' where uniacid=:uniacid  and ' . $ordercount . ' >= ordercount and ordercount>0  order by ordercount desc limit 1', array(':uniacid' => $_W['uniacid']));
                        continue;
                        continue;
                        continue;
                        $ordercount = $info['order13'];
                        $newlevel = pdo_fetch('select * from ' . tablename('ewei_shop_globonus_level') . ' where uniacid=:uniacid  and ' . $ordercount . ' >= ordercount and ordercount>0  order by ordercount desc limit 1', array(':uniacid' => $_W['uniacid']));
                        continue;
                        continue;
                        continue;
                    }
                    pdo_update('ewei_shop_member', array('partnerlevel' => $newlevel['id']), array('id' => $agent['id']));
                    $this->sendMessage($agent['openid'], array('nickname' => $agent['nickname'], 'oldlevel' => $oldlevel, 'newlevel' => $newlevel), TM_GLOBONUS_UPGRADE);
                }
            }
        }

        public function getInfo($openid, $options = NULL)
        {
            $return = array();
            if (p('commission')) {
                return p('commission')->getInfo($openid, $options);
            }
            return $return;
        }

        
        /**
         * 店铺升级统一方法
         * @param type $openid
         */
        public function upgradeLevelByAgent($openid){
            global $_W;
            if (empty($openid)) {
                return false;
            }
            $set = $this->getSet();
            if (empty($set['open'])) {
                return false;
            }
            $m = m('member')->getMember($openid);
            if (empty($m)) {
                return;
            }
            if (!(empty($m['parnternotupgrade']))) {
                return;
            }
            
            //获取上级分销商信息
            $agents = array();
            $agents[] = $m;
            if (!(empty($m['agentid']))) {
                $m1 = m('member')->getMember($m['agentid']);
                if (!(empty($m1))) {
                    $agents[] = $m1;
                    if (!(empty($m1['agentid'])) && ($m1['isagent'] == 1) && ($m1['status'] == 1)) {
                        $m2 = m('member')->getMember($m1['agentid']);
                        if (!(empty($m2)) && ($m2['isagent'] == 1) && ($m2['status'] == 1)) {
                            $agents[] = $m2;
                            if (empty($set['selfbuy'])) {
                                if (!(empty($m2['agentid'])) && ($m2['isagent'] == 1) && ($m2['status'] == 1)) {
                                    $m3 = m('member')->getMember($m2['agentid']);
                                    if (!(empty($m3)) && ($m3['isagent'] == 1) && ($m3['status'] == 1)) {
                                        $agents[] = $m3;
                                    }
                                }
                            }
                        }
                    }
                }
            }
            foreach($agents as $agent){
                if (empty($agents)) {
                    //无分销商直接退出
                    break;
                }
                //旧等级
                $oldlevel = $this->getLevel($agent['openid']);
                if (empty($oldlevel['id'])) {
                    $oldlevel = array('levelname' => (empty($set['levelname']) ? '默认店铺' : $set['levelname']), 'bonus' => $set['bonus']);
                    $oldlevel['id'] = 0;
                    $oldlevel['ordermoney'] = 0;
                    $oldlevel['first_ordermoney'] = 0;
                    $oldlevel['ordercount'] = 0;
                    $oldlevel['first_ordercount'] = 0;
                    $oldlevel['downcount'] = 0;
                    $oldlevel['first_downcount'] = 0;
                    $oldlevel['commissionmoney'] = 0;
                    $oldlevel['bonusmoney'] = 0;
                }
                $leveltype_arr = json_decode($set['leveltype'], true);
                $newlevelarr = array();
                //升级条件循环
                while ($leveltype_arr) {
                    $leveltype = array_pop($leveltype_arr);
                    switch ($leveltype){
                        //分销订单金额满
                        case 0:
                            $order_info = $this->getInfo($agent['id'], array('ordermoney3'));
                            if (!(empty($order_info['agentnotupgrade']))) {
                                $newlevelarr[0] = $oldlevel['id'];
                            }
                            $ordermoney = $order_info['ordermoney3'];
                            $newlevel = pdo_fetch('select * from ' . tablename('ewei_shop_globonus_level') . ' where uniacid=:uniacid and ' . $ordermoney . ' >= ordermoney and ordermoney>0  order by ordermoney desc limit 1', array(':uniacid' => $_W['uniacid']));
                            if (empty($newlevel)) {
                                $newlevelarr[0] = $oldlevel['id'];
                            }else{
                                $newlevelarr[0] = $newlevel['id'];
                            }
                            if (!(empty($oldlevel['id']))) {
                                if ($oldlevel['id'] == $newlevel['id']) {
                                    $newlevelarr[0] = $oldlevel['id'];
                                }
                                if ($newlevel['ordermoney'] < $oldlevel['ordermoney']) {
                                    $newlevelarr[0] = $oldlevel['id'];
                                }
                            }
                            break;
                        
                        //一级分销订单金额满
                        case 1:
                            $order_info = $this->getInfo($agent['id'], array('order13money'));
                            if (!(empty($order_info['agentnotupgrade']))) {
                                $newlevelarr[1] = $oldlevel['id'];
                            }
                            $ordermoney = $order_info['order13money'];
                            $newlevel = pdo_fetch('select * from ' . tablename('ewei_shop_globonus_level') . ' where uniacid=:uniacid and ' . $ordermoney . ' >= ordermoney and ordermoney>0  order by ordermoney desc limit 1', array(':uniacid' => $_W['uniacid']));
                            if (empty($newlevel)) {
                                $newlevelarr[1] = $oldlevel['id'];
                            }else{
                                $newlevelarr[1] = $newlevel['id'];
                            }
                            if (!(empty($oldlevel['id']))) {
                                if ($oldlevel['id'] == $newlevel['id']) {
                                    $newlevelarr[0] = $oldlevel['id'];
                                }
                                if ($newlevel['ordermoney'] < $oldlevel['ordermoney']) {
                                    $newlevelarr[0] = $oldlevel['id'];
                                }
                            }
                            break;
                        
                        //分销订单数量满
                        case 2:
                            $order_info = $this->getInfo($agent['id'], array('ordercount3'));
                            if (!(empty($order_info['agentnotupgrade']))) {
                                $newlevelarr[2] = $oldlevel['id'];
                            }
                            $ordercount = $order_info['ordercount3'];
                            $newlevel = pdo_fetch('select * from ' . tablename('ewei_shop_globonus_level') . ' where uniacid=:uniacid  and ' . $ordercount . ' >= ordercount and ordercount>0  order by ordercount desc limit 1', array(':uniacid' => $_W['uniacid']));
                            if (empty($newlevel)) {
                                $newlevelarr[2] = $oldlevel['id'];
                            }else{
                                $newlevelarr[2] = $newlevel['id'];
                            }
                            if (!(empty($oldlevel['id']))) {
                                if ($oldlevel['id'] == $newlevel['id']) {
                                    $newlevelarr[2] = $oldlevel['id'];
                                }
                                if ($newlevel['ordercount'] < $oldlevel['ordercount']) {
                                    $newlevelarr[2] = $oldlevel['id'];
                                }
                            }
                            break;
                        
                        //一级分销订单数量满
                        case 3:
                            $order_info = $this->getInfo($agent['id'], array('order13'));
                            if (!(empty($order_info['agentnotupgrade']))) {
                                $newlevelarr[3] = $oldlevel['id'];
                            }
                            $ordercount = $order_info['order13'];
                            $newlevel = pdo_fetch('select * from ' . tablename('ewei_shop_globonus_level') . ' where uniacid=:uniacid  and ' . $ordercount . ' >= ordercount and ordercount>0  order by ordercount desc limit 1', array(':uniacid' => $_W['uniacid']));
                            if (empty($newlevel)) {
                                $newlevelarr[3] = $oldlevel['id'];
                            }else{
                                $newlevelarr[3] = $newlevel['id'];
                            }
                            if (!(empty($oldlevel['id']))) {
                                if ($oldlevel['id'] == $newlevel['id']) {
                                    $newlevelarr[3] = $oldlevel['id'];
                                }
                                if ($newlevel['ordercount'] < $oldlevel['ordercount']) {
                                    $newlevelarr[3] = $oldlevel['id'];
                                }
                            }
                            break;
                        
                        //自购订单金额满
                        case 4:
                            if (!(empty($agent['agentnotupgrade']))) {
                                $newlevelarr[4] = $oldlevel['id'];
                            }
                            $orders = pdo_fetch('select sum(og.realprice) as ordermoney,count(distinct og.orderid) as ordercount from ' . tablename('ewei_shop_order') . ' o ' . ' left join  ' . tablename('ewei_shop_order_goods') . ' og on og.orderid=o.id ' . ' where o.openid=:openid and o.status>=3 and o.uniacid=:uniacid limit 1', array(':uniacid' => $_W['uniacid'], ':openid' => $openid));
                            $ordermoney = $orders['ordermoney'];
                            $ordercount = $orders['ordercount'];
                            $newlevel = pdo_fetch('select * from ' . tablename('ewei_shop_globonus_level') . ' where uniacid=:uniacid  and ' . $ordermoney . ' >= ordermoney order by ordermoney desc limit 1', array(':uniacid' => $_W['uniacid']));
                            if (empty($newlevel)) {
                                $newlevelarr[4] = $oldlevel['id'];
                            }else{
                                $newlevelarr[4] = $newlevel['id'];
                            }
                            if (!(empty($oldlevel['id']))) {
                                if ($oldlevel['id'] == $newlevel['id']) {
                                    $newlevelarr[4] = $oldlevel['id'];
                                }
                                if ($newlevel['ordermoney'] < $oldlevel['ordermoney']) {
                                    $newlevelarr[4] = $oldlevel['id'];
                                }
                            }
                            break;
                        
                        //自购订单数量满
                        case 5:
                            if (!(empty($agent['agentnotupgrade']))) {
                                $newlevelarr[4] = $oldlevel['id'];
                            }
                            $orders = pdo_fetch('select sum(og.realprice) as ordermoney,count(distinct og.orderid) as ordercount from ' . tablename('ewei_shop_order') . ' o ' . ' left join  ' . tablename('ewei_shop_order_goods') . ' og on og.orderid=o.id ' . ' where o.openid=:openid and o.status>=3 and o.uniacid=:uniacid limit 1', array(':uniacid' => $_W['uniacid'], ':openid' => $openid));
                            $ordermoney = $orders['ordermoney'];
                            $ordercount = $orders['ordercount'];
                            $newlevel = pdo_fetch('select * from ' . tablename('ewei_shop_globonus_level') . ' where uniacid=:uniacid  and ' . $ordercount . ' >= ordercount and ordercount>0  order by ordercount desc limit 1', array(':uniacid' => $_W['uniacid']));
                            if (empty($newlevel)) {
                                $newlevelarr[5] = $oldlevel['id'];
                            }else{
                                $newlevelarr[5] = $newlevel['id'];
                            }
                            if (!(empty($oldlevel['id']))) {
                                if ($oldlevel['id'] == $newlevel['id']) {
                                    $newlevelarr[5] = $oldlevel['id'];
                                }
                                if ($newlevel['ordercount'] < $oldlevel['ordercount']) {
                                    $newlevelarr[5] = $oldlevel['id'];
                                }
                            }
                            break;
                        
                        //下级总人数满
                        case 6:
                            //下线总人数满（分销商+非分销商）
                            $info = $this->getInfo($agent['id'], array());
                            if (!(empty($info['agentnotupgrade']))) {
                                $newlevelarr[6] = $oldlevel['id'];
                            }
                            $downcount = $this->get_children_number($agent['id']);
                            //能升级的新等级
                            $newlevel = pdo_fetch('select * from ' . tablename('ewei_shop_globonus_level') . ' where uniacid=:uniacid  and ' . $downcount . ' >= downcount and downcount>0  order by downcount desc limit 1', array(':uniacid' => $_W['uniacid']));
                            if (empty($newlevel)) {
                                $newlevelarr[6] = $oldlevel['id'];
                            }else{
                                $newlevelarr[6] = $newlevel['id'];
                            }
                            if (!(empty($oldlevel['id']))) {
                                if ($newlevel['downcount'] < $oldlevel['downcount']) {
                                    $newlevelarr[6] = $oldlevel['id'];
                                }
                            }
                            break;
                        
                        //一级下级人数满
                        case 7:
                            $downcount = pdo_fetchcolumn('select count(*) from ' . tablename('ewei_shop_member') . ' where agentid=:agentid and uniacid=:uniacid ', array(':agentid' => $m['id'], ':uniacid' => $_W['uniacid']));
                            $newlevel = pdo_fetch('select * from ' . tablename('ewei_shop_globonus_level') . ' where uniacid=:uniacid  and ' . $downcount . ' >= first_downcount and first_downcount>0  order by first_downcount desc limit 1', array(':uniacid' => $_W['uniacid']));
                            if(empty($newlevel)){
                                $newlevelarr[7] = $oldlevel['id'];
                            }else{
                                $newlevelarr[7] = $newlevel['id'];
                            }
                            if (!(empty($oldlevel['id']))) {
                                if ($newlevel['first_downcount'] < $oldlevel['first_downcount']) {
                                    $newlevelarr[7] = $oldlevel['id'];
                                }
                            }
                            break;
                        
                        //下级分销商总人数
                        case 8:
                            $globonus_level = pdo_fetchall('select * from '. tablename('ewei_shop_globonus_level') .' where uniacid=:uniacid and id>:id ORDER BY id desc',array(':uniacid'=>$_W['uniacid'],':id'=>$oldlevel['id']));
                            if(empty($globonus_level)){
                                $newlevelarr[8] = $oldlevel['id'];
                            }
                            $newlevelarr[8] = $oldlevel['id'];
                            //从高等级往低等级走
                            foreach($globonus_level as $v){
                                if(empty($v['team_downcount']) || empty($v['hierarchy'])){
                                    $newlevelarr[8] = $oldlevel['id'];
                                }
                                //最多10层关系树
                                if($v['hierarchy']>10){
                                    $v['hierarchy'] = 10;
                                }
                                $fatherids = array('0'=>$agent['id']);
                                //递归查询所在关系树的用户id
                                for($a=0;$a<$v['hierarchy'];$a++){
                                    $childids = pdo_fetchall('select id from '. tablename('ewei_shop_member') .' where uniacid=:uniacid and isagent=1 and agentid in('. $fatherids[$a].')',array(':uniacid'=>$_W['uniacid']));
                                    if(empty($childids)){
                                        break;
                                    }
                                    $child_arr = array_values($childids);
                                    $fatherids[$a+1] = implode(',', $child_arr);
                                }
                                //去除用户自身id
                                $memberids = array_shift(array_values($fatherids));
                                if(empty($memberids)){
                                    break;
                                }
                                $memberids = explode(',', $memberids);
                                //查询符合条件的人数
                                if($v['team_identity_type']==1){
                                    $where = ' AND status=1 AND isagent=1 and agentlevel='.$v['team_identity_id'];
                                }else{
                                    $where = ' AND ispartner=1 AND partnerstatus=1 and partnerlevel='.$v['team_identity_id'];
                                }
                                $team_identity = pdo_fetchcolumn('select count(*) from '. tablename('ewei_shop_member') .' where uniacid=:uniacid and agentid in('.$memberids.') '.$where,array(':uniacid'=>$_W['uniacid'],':agentid'=>$agent['id']));
                                if($team_identity >= $v['team_downcount']){
                                    $newlevelarr[8] = $v['id'];
                                    break;
                                }
                            }
                            break;
                        
                        //一级分销商人数
                        case 9:
                            $globonus_level = pdo_fetchall('select * from '. tablename('ewei_shop_globonus_level') .' where uniacid=:uniacid and id>:id ORDER BY id desc',array(':uniacid'=>$_W['uniacid'],':id'=>$oldlevel['id']));
                            if(empty($globonus_level)){
                                $newlevelarr[9] = $oldlevel['id'];
                                break;
                            }
                            foreach($globonus_level as $v){
                                if($v['first_identity_type']==1){
                                    $where = ' AND status=1 AND isagent=1 and agentlevel='.$v['first_team_identity_id'];
                                }else{
                                    $where = ' AND ispartner=1 AND partnerstatus=1 and partnerlevel='.$v['first_team_identity_id'];
                                }
                                $first_identity = pdo_fetchcolumn('select count(*) from '. tablename('ewei_shop_member') .' where uniacid=:uniacid and agentid=:agentid '.$where,array(':uniacid'=>$_W['uniacid'],':agentid'=>$agent['id']));
                                if($first_identity >= $v['first_team_downcount']){
                                    $newlevelarr[9] = $v['id'];
                                    break;
                                }
                            }
                            break;
                        
                        //已提现佣金总金额满
                        case 10:
                            //已提现佣金总金额满
                            $info = $this->getInfo($m['id'], array('pay'));
                            $commissionmoney = $info['commission_pay'];
                            $newlevel = pdo_fetch('select * from ' . tablename('ewei_shop_globonus_level') . ' where uniacid=:uniacid  and ' . $commissionmoney . ' >= commissionmoney and commissionmoney>0  order by commissionmoney desc limit 1', array(':uniacid' => $_W['uniacid']));
                            if (empty($newlevel)) {
                                $newlevelarr[10] = $oldlevel['id'];
                            } else {
                                $newlevelarr[10] = $newlevel['id'];
                            }
                            if ($oldlevel['id'] == $newlevel['id']) {
                                $newlevelarr[10] = $oldlevel['id'];
                            }
                            if (!(empty($oldlevel['id']))) {
                                if ($newlevel['commissionmoney'] < $oldlevel['commissionmoney']) {
                                    $newlevelarr[10] = $oldlevel['id'];
                                }
                            }
                            break;
                        
                        //已发放分红总金额满
                        case 11:
                            $bonusmoney = $this->getBonus($agent['openid'], array('ok'));
                            //判断是否达成店铺奖励升级的
                            $newlevel = pdo_fetch('select * from ' . tablename('ewei_shop_globonus_level') . ' where uniacid=:uniacid  and ' . $bonusmoney['ok'] . ' >= bonusmoney  order by id desc limit 1', array(':uniacid' => $_W['uniacid']));
                            if (empty($newlevel)) {
                                $newlevelarr[11] = $oldlevel['id'];
                            }else{
                                $newlevelarr[11] = $newlevel['id'];
                            }
                            if ($oldlevel['id'] == $newlevel['id']) {
                                $newlevelarr[11] = $oldlevel['id'];
                            }
                            if (!(empty($oldlevel['id']))) {
                                if ($newlevel['bonusmoney'] < $oldlevel['bonusmoney']) {
                                    $newlevelarr[11] = $oldlevel['id'];
                                }
                            }
                            break;
                    }
                }
                //取升级条件的符合的最低值
                $new_level = min($newlevelarr);                
                //修改会员信息
                pdo_update('ewei_shop_member', array('partnerlevel' => $new_level), array('id' => $agent['id']));
                $this->sendMessage($agent['openid'], array('nickname' => $agent['nickname'], 'oldlevel' => $oldlevel, 'newlevel' => $new_level), TM_GLOBONUS_UPGRADE);
            }
        }
        
        
        
        
        /**
         * 店铺等级身份升级（原全民股东身份升级）
         * @update 金翅大鹏
         * @date   2019/03/16
         */
        public function upgradeLevelByAgentOr($openid)
        {
            global $_W;
            if (empty($openid)) {
                return false;
            }
            $set = $this->getSet();
            if (empty($set['open'])) {
                return false;
            }
            $m = m('member')->getMember($openid);
            if (empty($m)) {
                return;
            }
            if (!(empty($m['parnternotupgrade']))) {
                return;
            }
            $leveltype_arr = json_decode($set['leveltype'], true);
            while ($leveltype_arr) {
                $leveltype = array_pop($leveltype_arr);
                //如果小于6或者大于9说明不用做操作
                if (($leveltype < 6) || (9 < $leveltype)) {
                    continue;
                }
                $info = $this->getInfo($m['id'], array());
                //如果升级方式是下线总人数或者下线分销商总人数
                if (($leveltype == 6) || ($leveltype == 8)) {
                    $agents = array($m);
                    //如果上级不为空
                    if (!(empty($m['agentid']))) {
                        //上级信息
                        $m1 = m('member')->getMember($m['agentid']);
                        //如果上级信息不为空
                        if (!(empty($m1))) {
                            $agents[] = $m1;
                            //如果上级也是分销商并且也有上级
                            if (!(empty($m1['agentid'])) && ($m1['isagent'] == 1) && ($m1['status'] == 1)) {
                                //上二级信息
                                $m2 = m('member')->getMember($m1['agentid']);
                                if (!(empty($m2)) && ($m2['isagent'] == 1) && ($m2['status'] == 1)) {
                                    $agents[] = $m2;
                                }
                            }
                        }
                    }
                    //如果上级为空不执行
                    if (empty($agents)) {
                        continue;
                    }
                    foreach ($agents as $agent) {
                        $info = $this->getInfo($agent['id'], array());
                        //如果关闭了会员的自动升级功能退出
                        if (!(empty($info['agentnotupgrade']))) {
                            continue;
                        }
                        //旧等级信息
                        $oldlevel = $this->getLevel($agent['openid']);
                        if (empty($oldlevel['id'])) {
                            $oldlevel = array('levelname' => (empty($set['levelname']) ? '默认店铺' : $set['levelname']), 'bonus' => $set['bonus']);
                        }
                        //如果按下线总人数升级
                        if ($leveltype == 6) {
                            $downcount = $this->get_children_number($m['id']);
                            //能升级的新等级
                            $newlevel = pdo_fetch('select * from ' . tablename('ewei_shop_globonus_level') . ' where uniacid=:uniacid  and ' . $downcount . ' >= downcount and downcount>0  order by downcount desc limit 1', array(':uniacid' => $_W['uniacid']));
                            if (!(empty($oldlevel['id']))) {
                                if ($newlevel['downcount'] < $oldlevel['downcount']) {
                                    continue;
                                }
                            }
                        } else if ($leveltype == 8) {
                            //如果按下线分销商总人数升级
                            $downcount = $this->get_children_number($m['id'], true);
                            $newlevel = pdo_fetch('select * from ' . tablename('ewei_shop_globonus_level') . ' where uniacid=:uniacid  and ' . $downcount . ' >= c_downcount and c_downcount>0  order by c_downcount desc limit 1', array(':uniacid' => $_W['uniacid']));
                            if (!(empty($oldlevel['id']))) {
                                if ($newlevel['c_downcount'] < $oldlevel['c_downcount']) {
                                    continue;
                                }
                            }
                        }
                        if (empty($newlevel)) {
                            continue;
                        }
                        if ($newlevel['id'] == $oldlevel['id']) {
                            continue;
                        }
                        pdo_update('ewei_shop_member', array('partnerlevel' => $newlevel['id']), array('id' => $agent['id']));
                        $this->sendMessage($agent['openid'], array('nickname' => $agent['nickname'], 'oldlevel' => $oldlevel, 'newlevel' => $newlevel), TM_GLOBONUS_UPGRADE);
                    }
                } else {
                    $oldlevel = $this->getLevel($m['openid']);
                    if (empty($oldlevel['id'])) {
                        $oldlevel = array('levelname' => (empty($set['levelname']) ? '默认店铺' : $set['levelname']), 'bonus' => $set['bonus']);
                    }
                    if ($leveltype == 7) {
                        $downcount = pdo_fetchcolumn('select count(*) from ' . tablename('ewei_shop_member') . ' where agentid=:agentid and uniacid=:uniacid ', array(':agentid' => $m['id'], ':uniacid' => $_W['uniacid']));
                        $newlevel = pdo_fetch('select * from ' . tablename('ewei_shop_globonus_level') . ' where uniacid=:uniacid  and ' . $downcount . ' >= first_downcount and first_downcount>0  order by first_downcount desc limit 1', array(':uniacid' => $_W['uniacid']));
                        if (!(empty($oldlevel['id']))) {
                            if ($newlevel['first_downcount'] < $oldlevel['first_downcount']) {
                                return;
                            }
                        }
                    } else if ($leveltype == 9) {
                        $downcount = $info['level1'];
                        $newlevel = pdo_fetch('select * from ' . tablename('ewei_shop_globonus_level') . ' where uniacid=:uniacid  and ' . $downcount . ' >= first_c_downcount and first_c_downcount>0  order by first_c_downcount desc limit 1', array(':uniacid' => $_W['uniacid']));
                        if (!(empty($oldlevel['id']))) {
                            if ($newlevel['first_c_downcount'] < $oldlevel['first_c_downcount']) {
                                return;
                            }
                        }
                    }
                    if (empty($newlevel)) {
                        return;
                    }
                    if ($newlevel['id'] == $oldlevel['id']) {
                        return;
                    }
                    pdo_update('ewei_shop_member', array('partnerlevel' => $newlevel['id']), array('id' => $m['id']));
                    $this->sendMessage($m['openid'], array('nickname' => $m['nickname'], 'oldlevel' => $oldlevel, 'newlevel' => $newlevel), TM_GLOBONUS_UPGRADE);
                }
            }
        }

        public function upgradeLevelByCommissionOK($openid)
        {
            global $_W;
            if (empty($openid)) {
                return false;
            }
            $set = $this->getSet();
            if (empty($set['open'])) {
                return false;
            }
            $m = m('member')->getMember($openid);
            if (empty($m)) {
                return;
            }
            $leveltype_arr = json_decode($set['leveltype'], true);
            if(!in_array(10,$leveltype_arr)){
                return;
            }
            if (!(empty($m['partnernotupgrade']))) {
                return;
            }
            $oldlevel = $this->getLevel($m['openid']);
            if (empty($oldlevel['id'])) {
                $oldlevel = array('levelname' => (empty($set['levelname']) ? '默认店铺' : $set['levelname']), 'bonus' => $set['bonus']);
            }
            $info = $this->getInfo($m['id'], array('pay'));
            $commissionmoney = $info['commission_pay'];
            $newlevel = pdo_fetch('select * from ' . tablename('ewei_shop_globonus_level') . ' where uniacid=:uniacid  and ' . $commissionmoney . ' >= commissionmoney and commissionmoney>0  order by commissionmoney desc limit 1', array(':uniacid' => $_W['uniacid']));
            if (empty($newlevel)) {
                return;
            }
            if ($oldlevel['id'] == $newlevel['id']) {
                return;
            }
            if (!(empty($oldlevel['id']))) {
                if ($newlevel['commissionmoney'] < $oldlevel['commissionmoney']) {
                    return;
                }
            }
            pdo_update('ewei_shop_member', array('partnerlevel' => $newlevel['id']), array('id' => $m['id']));
            $this->sendMessage($m['openid'], array('nickname' => $m['nickname'], 'oldlevel' => $oldlevel, 'newlevel' => $newlevel), TM_GLOBONUS_UPGRADE);
        }

        public function upgradeLevelByBonus($openid)
        {
            global $_W;
            if (empty($openid)) {
                return false;
            }
            $set = $this->getSet();
            if (empty($set['open'])) {
                return false;
            }
            $m = m('member')->getMember($openid);
            if (empty($m)) {
                return;
            }
            $leveltype_arr = json_decode($set['leveltype'], true);
            if(!in_array(10,$leveltype_arr)){
                return;
            }
            if (!(empty($m['agentnotupgrade']))) {
                return;
            }
            //旧店铺身份信息
            $oldlevel = $this->getLevel($m['openid']);
            if (empty($oldlevel['id'])) {
                //为空取默认
                $oldlevel = array('levelname' => (empty($set['levelname']) ? '默认等级' : $set['levelname']), 'bonus' => $set['bonus']);
            }
            //获取店铺奖励总金额
            $bonusmoney = $this->getBonus($openid, array('ok'));
            //判断是否达成店铺奖励升级的
            $newlevel = pdo_fetch('select * from ' . tablename('ewei_shop_globonus_level') . ' where uniacid=:uniacid  and ' . $bonusmoney['ok'] . ' >= bonusmoney and bonusmoney>0  order by bonusmoney desc limit 1', array(':uniacid' => $_W['uniacid']));
            if (empty($newlevel)) {
                return;
            }
            if ($oldlevel['id'] == $newlevel['id']) {
                return;
            }
            if (!(empty($oldlevel['id']))) {
                if ($newlevel['bonusmoney'] < $oldlevel['bonusmoney']) {
                    return;
                }
            }
            pdo_update('ewei_shop_member', array('partnerlevel' => $newlevel['id']), array('id' => $m['id']));
            $this->sendMessage($m['openid'], array('nickname' => $m['nickname'], 'oldlevel' => $oldlevel, 'newlevel' => $newlevel), TM_GLOBONUS_UPGRADE);
        }

        /**
         *
         * 计算结算单佣金（原全民股东生成结算单）
         * @param string $year 年
         * @param string $month 月
         * @param string $week 周
         * @param string $openid
         * @retur array  奖励数组
         * @author 金翅大鹏
         */
        public function getBonusData($year = 0, $month = 0, $week = 0, $openid = '')
        {
            global $_W;
            $set = $this->getSet();
            //如果没有设置店铺奖励比例或者店铺奖励比例为0
            if (empty($set['bonusrate']) || ($set['bonusrate'] <= 0)) {
                $set['bonusrate'] = 100;
            }
            $commission = m('common')->getPluginset('commission');
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
            $bill = pdo_fetch('select * from ' . tablename('ewei_shop_globonus_bill') . ' where uniacid=:uniacid and `year`=:year and `month`=:month and `week`=:week limit 1', array(':uniacid' => $_W['uniacid'], ':year' => $year, ':month' => $month, ':week' => $week));
            if (!(empty($bill)) && empty($openid)) {
                //如果已经生成过结算单返回结算单信息
                return array('ordermoney' => round($bill['ordermoney'], 2), 'ordercount' => $bill['ordercount'], 'bonusmoney' => round($bill['bonusmoney'], 2), 'bonusordermoney' => round($bill['bonusordermoney'], 2), 'bonusrate' => round($bill['bonusrate'], 2), 'bonusmoney_send' => round($bill['bonusmoney_send'], 2), 'partnercount' => $bill['partnercount'], 'starttime' => $starttime, 'endtime' => $endtime, 'billid' => $bill['id'], 'old' => true);
            }
            $ordermoney = 0;
            $bonusordermoney = 0;
            $bonusmoney = 0;
            $pcondition = '';
            if (!(empty($openid))) {
                $member = m('member')->getMember($openid);
                //订单完成时间晚于成为店铺时间
                $pcondition = 'AND finishtime>' . $member['partnertime'];
            }
            //查询订单
            $orders = pdo_fetchall('select id,openid,price,costprice from ' . tablename('ewei_shop_order') . ' where uniacid=' . $_W['uniacid'] . ' and status=3  and isglobonus=0 and finishtime + ' . $settletimes . '>= ' . $starttime . ' and  finishtime + ' . $settletimes . '<=' . $endtime . ' ' . $pcondition, array(), 'id');
            $pcondition = '';
            if (!(empty($openid))) {
                $pcondition = ' and m.openid=\'' . $openid . '\'';
            }
            //关联查询店铺成员和店铺等级
            $partners = pdo_fetchall('select m.id,m.openid,m.partnerlevel,l.bonus from ' . tablename('ewei_shop_member') . ' m ' . '  left join ' . tablename('ewei_shop_globonus_level') . ' l on l.id = m.partnerlevel ' . '  where m.uniacid=:uniacid and  m.ispartner=1 and m.partnerstatus=1 ' . $pcondition, array(':uniacid' => $_W['uniacid']));
            foreach ($partners as &$p) {
                if (empty($p['partnerlevel']) || ($p['bonus'] == NULL)) {
                    //如果分红比例未设置则取默认设置的比例
                    $p['bonus'] = floatval($set['bonus']);
                }
            }

            //获取各等级比例
            $arry_percent = $this->get_arry_percent();

            unset($p);
            $money_arr = array();//佣金数组
            foreach ($orders as $o) {
                $m = m('member')->getMember($o['openid']);
                if ($set['selfbuy']) {
                    //如果开始自购模式 从自己开始找寻计算上级
                    $m = m('member')->getMember($o['openid']);
                } else {

                    $m = m('member')->getMember($m['agentid']);
                }
                if (!$m) {
                    //如果不存在上级退出
                    continue;
                }
                $ordermoney += $o['price'];//订单总金额
                if ($commission['calcutype'] == 2) {

                    //如果按订单利润计算佣金
                    $bonusordermoney += (($o['price'] - $o['costprice']) * $set['bonusrate']) / 100;
                    $reward_share = (($o['price'] - $o['costprice']) * $set['bonusrate']) / 100;//店铺奖励金额
                } else {
                    $bonusordermoney += ($o['price'] * $set['bonusrate']) / 100;
                    $reward_share = ($o['price'] * $set['bonusrate']) / 100;//店铺奖励金额
                }
                $flag_q = substr($m['gflag'], 1, -1);//基因处理

                //查询上级推广员openid
                $userid_type = $this->ShareHolder_SearchUserId($m['openid'], $flag_q);
                $first_userid = $userid_type[0];
                $first_level = $userid_type[1];
                if ($first_userid) {
                    $all_money = $reward_share * $arry_percent[$first_level] / 100;
                    $all_money = $this->floor_decimals($all_money, 2);            //四舍五入取两位小数
                    if (array_key_exists($first_userid, $money_arr)) {
                        $money_arr[$first_userid] = $money_arr[$first_userid] + $all_money;
                    } else {
                        $money_arr[$first_userid] = $all_money;
                    }
                }
                $this_level = $first_level;
                $this_userid = $first_userid;
                $this_boolean = true;
                $max_level = $this->get_max_level();
                if ($this_level == $max_level || !$first_userid) {    //若当前查询出来的股东用户已经是最高级，或无股东等级，则不再往上查找
                    $this_boolean = false;
                }
                if (!$this_userid) {
                    $this_boolean = false;
                }
                /*循环往上查找股东用户----start*/
                while ($this_boolean) {
                    $old_percent = $arry_percent[$this_level];//上一位获得店铺奖励的用户的股东分红比例
                    if (!$flag_q) {
                        break;
                    }
                    $pcondition = "AND m.id in (" . $flag_q . ")";//属于范围内
                    $pcondition .= "	AND m.partnerlevel> " . $this_level . "";//等级必须大于上一个店铺等级
                    $pcondition .= " ORDER BY FIELD( m.id," . $flag_q . ") DESC limit 1";
                    $result = pdo_fetch('select m.id,m.openid,m.partnerlevel,l.bonus from ' . tablename('ewei_shop_member') . ' m ' . '  left join ' . tablename('ewei_shop_globonus_level') . ' l on l.id = m.partnerlevel ' . '  where m.uniacid=:uniacid and  m.ispartner=1 and m.partnerstatus=1 ' . $pcondition, array(':uniacid' => $_W['uniacid']));
                    if ($result) {
                        $exp_openid = $result['openid'];    //返回openid
                        $partnerlevel = $result['partnerlevel'];    //代理等级
                    }else{
                        break;
                    }
                    $now_percent = $arry_percent[$partnerlevel];

                    if ($exp_openid) {
                        $n_money = $reward_share * ($now_percent - $old_percent) / 100;    //该笔订单奖励差
                        $n_money = $this->floor_decimals($n_money, 2);
                        if (array_key_exists($exp_openid, $money_arr)) {
                            $money_arr[$exp_openid] = $money_arr[$exp_openid] + $n_money;
                        } else {
                            $money_arr[$exp_openid] = $n_money;
                        }
                        $this_level = $partnerlevel;
                        $this_userid = $exp_openid;
                        if ($this_level == max(array_keys($arry_percent)) || $this_level == 0) {      //若当前查询出来的股东用户已经是最高级，或无股东等级，则不再往上查找，跳出循环
                            $this_boolean = false;
                        }
                        if (!$this_userid) {
                            $this_boolean = false;
                        }

                    } else {
                        $this_boolean = false;
                    }

                }

            }

            $price = 0;
            foreach ($partners as &$p) {
                !(isset($p['bonusmoney'])) && ($p['bonusmoney'] = 0);
                foreach ($money_arr as $k => $a) {
                    if ($p['openid'] == $k) {
                        //计算每个股东累计能获取的佣金
                        $p['bonusmoney'] = $a;
                    }
                }

            }

            foreach ($partners as $k => &$p) {
                if ($p['bonusmoney'] == 0) {
                    unset($partners[$k]);
                }
                $bonusmoney_send = 0;
                $p['charge'] = 0;
                $p['chargemoney'] = 0;
                //提现手续费扣除
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

        /**
         *
         * 店铺奖励佣金计算
         * @param array $orders 订单信息
         *
         */
        public function ShareHolder_GetMoney_new($orders)
        {


        }


        /**
         * 返回下线总人数数量
         * @param $gflag 基因
         * @author 金翅大鹏
         */
        public function get_children_number($id, $is_agent = 0)
        {
            global $_W;
            $pcondition = " AND gflag LIKE ".'"'."%,".$id.",%".'"';
            if ($is_agent == 1) {
                $pcondition .= ' AND isagent=1 AND status=1 ';
            }
            $count = pdo_fetch('SELECT count(id) as number FROM ' . tablename('ewei_shop_member') . ' WHERE uniacid = \'' . $_W['uniacid'] . '\'' . $pcondition);
            return $count['number'];

        }

        /**
         * 查找店铺最高级
         * @author 金翅大鹏
         */
        public function get_max_level()
        {
            global $_W;
            $info = pdo_fetch('SELECT id FROM ' . tablename('ewei_shop_globonus_level') . ' WHERE uniacid = \'' . $_W['uniacid'] . '\' ORDER BY id desc limit 1');
            return $info['id'];
        }

        /**
         * 查找分销商,代理商,渠道商,股东商
         * @param  int $openid 上一级
         * @param  string $flag_q 基因
         * @author 金翅大鹏
         */
        public function ShareHolder_SearchUserId($openid, $flag_q)
        {    //查找分销商,代理商,渠道商,股东商
            global $_W;
            if (empty($flag_q)) {
                $flag_q = -1;
            }
            //查询当前用户是否拥有股东权利
            $pcondition = '';
            if (!(empty($openid))) {
                $pcondition = ' and m.openid=\'' . $openid . '\'';
            }
            //关联查询店铺成员和店铺等级
            $partners = pdo_fetch('select m.id,m.openid,m.partnerlevel,l.bonus from ' . tablename('ewei_shop_member') . ' m ' . '  left join ' . tablename('ewei_shop_globonus_level') . ' l on l.id = m.partnerlevel ' . '  where m.uniacid=:uniacid and  m.ispartner=1 and m.partnerstatus=1 ' . $pcondition, array(':uniacid' => $_W['uniacid']));
            $exp_openid = '';
            if ($partners) {
                $exp_openid = $partners['openid'];    //返回openid
                $partnerlevel = $partners['partnerlevel'];    //代理等级
            }
            //查询当前推广员是否拥有股东权利  End
            //若当前推广员没有股东权利，则根据基因gflag继续往上查找最接近的股东用户
            if (!$exp_openid) {
                $pcondition = "AND m.id in (" . $flag_q . ")";
                $pcondition .= "ORDER BY FIELD( m.id," . $flag_q . ") DESC limit 1";
                $result = pdo_fetch('select m.id,m.openid,m.partnerlevel,l.bonus from ' . tablename('ewei_shop_member') . ' m ' . '  left join ' . tablename('ewei_shop_globonus_level') . ' l on l.id = m.partnerlevel ' . '  where m.uniacid=:uniacid and  m.ispartner=1 and m.partnerstatus=1 ' . $pcondition, array(':uniacid' => $_W['uniacid']));
                if ($result) {
                    $exp_openid = $result['openid'];    //返回openid
                    $partnerlevel = $result['partnerlevel'];    //代理等级
                }
            }
            $arr = array($exp_openid, $partnerlevel);
            return $arr;
        }

        /**
         * 获取店铺奖励奖励数组
         * @author 金翅大鹏
         */
        public function get_arry_percent($packagegoods=[])
        {
            global $_W;
            global $_GPC;
            $set = $_W['shopset']['globonus'];
            $leveltype = $set['leveltype'];
            $default = array('id' => '1', 'levelname' => empty($set['levelname']) ? '默认等级' : $set['levelname'], 'bonus' => $set['bonus']);
            $others = pdo_fetchall('SELECT id,bonus FROM ' . tablename('ewei_shop_globonus_level') . ' WHERE uniacid = \'' . $_W['uniacid'] . '\' ORDER BY bonus asc');
            $list = array_merge(array($default), $others);
            $arry_percent = array(0);
            foreach ($list as $k => $v) {
                $arry_percent[$v['id']] = $v['bonus'];
            }
            if($packagegoods){
                foreach ($packagegoods as $k => $v) {
                    if (array_key_exists($k, $arry_percent)) {
                        $arry_percent[$k]=$v;
                    }
                }
            }
            return $arry_percent;
        }

        public function getTotals()
        {
            global $_W;
            return array('total0' => pdo_fetchcolumn('select count(*) from ' . tablename('ewei_shop_globonus_bill') . ' where uniacid=:uniacid and status=0 limit 1', array(':uniacid' => $_W['uniacid'])), 'total1' => pdo_fetchcolumn('select count(*) from ' . tablename('ewei_shop_globonus_bill') . ' where uniacid=:uniacid and status=1 limit 1', array(':uniacid' => $_W['uniacid'])), 'total2' => pdo_fetchcolumn('select count(*) from ' . tablename('ewei_shop_globonus_bill') . ' where uniacid=:uniacid and status=2  limit 1', array(':uniacid' => $_W['uniacid'])));
        }

        /**
         * [向下舍入为最接近的小数]
         * @param  [type] $data     [数据]
         * @param  [type] $decimals [保留位数]
         * @return [type]           [description]
         * @author 金翅大鹏
         */
        public function floor_decimals($data, $decimals)
        {
            $data = bcadd($data, 0, $decimals);
            return $data;
        }

        /*
       * 大礼包订单生成奖励信息
       * @update 金翅大鹏
       * @reuturn array (user_id reward)
       * */
        public function packagegoods_getBonusData($openid, $orderid,$is_finish=0)
        {
            global $_W;
            $set = $this->getSet();
            //如果没有设置店铺奖励比例或者店铺奖励比例为0
            if (empty($set['bonusrate']) || ($set['bonusrate'] <= 0)) {
                $set['bonusrate'] = 100;
            }
            //查询是否已生成奖励信息
            $log = pdo_fetchall('SELECT id,openid,bonusmoney FROM ' . tablename('ewei_shop_packagegoods_globonus_log') . ' WHERE uniacid=:uniacid AND orderid=:orderid ',array(':uniacid' => $_W['uniacid'], ':orderid' => $orderid));
            if($is_finish==1){
                $result_arr=[];
                foreach ($log as $k=>$v){
                    $member = m('member')->getMember($v['openid']);
                    $arr = array(
                        'openid' => $v['openid'],
                        'money' => $v['bonusmoney'],
                        'mid' => $member['id'],
                    );
                    $result_arr[] = $arr;
                }
                return $result_arr;
            }
            $commission = m('common')->getPluginset('commission');
            //查询订单
            $orders = pdo_fetch('select o.id,o.openid,o.price,o.freight,g.globonus_type,g.globonus from '
                . tablename('ewei_shop_packagegoods_order') . ' o ' . ' left join ' . tablename('ewei_shop_packagegoods_goods') . ' g on g.id=o.goodid '
                . ' where o.uniacid=:uniacid and o.id=:orderid and o.isglobonus=0 and o.openid=:openid  ', array(':uniacid' => $_W['uniacid'], ':orderid' => $orderid, ':openid' => $openid)
            );
            $m = m('member')->getMember($orders['openid']);
            if ($set['selfbuy']) {
                //如果开始自购模式 从自己开始找寻计算上级
                $m = m('member')->getMember($orders['openid']);
            } else {

                $m = m('member')->getMember($m['agentid']);
            }
            if (!$m) {
                //如果不存在上级退出
                return;
            }
            $money_arr = array();//佣金数组
            $globonus = unserialize($orders['globonus']);
            $arry_percent = $this->get_arry_percent($globonus);
            $reward_share = ($orders['price'] * $set['bonusrate']) / 100;//店铺奖励金额
            $flag_q = substr($m['gflag'], 1, -1);//基因处理
            //查询上级推广员openid
            $userid_type = $this->ShareHolder_SearchUserId($m['openid'], $flag_q);
            $first_userid = $userid_type[0];
            $first_level = $userid_type[1];
            if ($first_userid) {
                $all_money = $reward_share * $arry_percent[$first_level] / 100;
                $all_money = $this->floor_decimals($all_money, 2);            //四舍五入取两位小数
                $money_arr[$first_userid] = $all_money;
            }
            $this_level = $first_level;
            $this_userid = $first_userid;
            $this_boolean = true;
            $max_level = $this->get_max_level();
            if ($this_level == $max_level || !$first_userid) {    //若当前查询出来的股东用户已经是最高级，或无股东等级，则不再往上查找
                $this_boolean = false;
            }
            if (!$this_userid) {
                $this_boolean = false;
            }
            /*循环往上查找股东用户----start*/
            while ($this_boolean) {
                $old_percent = $arry_percent[$this_level];//上一位获得店铺奖励的用户的股东分红比例
                if (!$flag_q) {
                    break;
                }
                $pcondition = "AND m.id in (" . $flag_q . ")";//属于范围内
                $pcondition .= "	AND m.partnerlevel> " . $this_level . "";//等级必须大于上一个店铺等级
                $pcondition .= " ORDER BY FIELD( m.id," . $flag_q . ") DESC limit 1";
                $result = pdo_fetch('select m.id,m.openid,m.partnerlevel,l.bonus from ' . tablename('ewei_shop_member') . ' m ' . '  left join ' . tablename('ewei_shop_globonus_level') . ' l on l.id = m.partnerlevel ' . '  where m.uniacid=:uniacid and  m.ispartner=1 and m.partnerstatus=1 ' . $pcondition, array(':uniacid' => $_W['uniacid']));
                if ($result) {
                    $exp_openid = $result['openid'];    //返回openid
                    $partnerlevel = $result['partnerlevel'];    //代理等级
                }else{
                    break;
                }
                $now_percent = $arry_percent[$partnerlevel];
                if ($exp_openid) {
                    $n_money = $reward_share * ($now_percent - $old_percent) / 100;    //该笔订单奖励差
                    $n_money = $this->floor_decimals($n_money, 2);
                    $money_arr[$exp_openid] = $n_money;
                    $this_level = $partnerlevel;
                    $this_userid = $exp_openid;
                    if ($this_level == max(array_keys($arry_percent)) || $this_level == 0) {      //若当前查询出来的股东用户已经是最高级，或无股东等级，则不再往上查找，跳出循环
                        $this_boolean = false;
                    }
                    if (!$this_userid) {
                        $this_boolean = false;
                    }
                } else {
                    $this_boolean = false;
                }

            }
            if (!$money_arr) {
                return;
            }
            $result_arr = array();
            foreach ($money_arr as $k => &$p) {
                if ($p == 0) {
                    continue;
                }
                $m = m('member')->getMember($k);
                //提现手续费扣除
                if ((floatval($set['paycharge']) <= 0) || ((floatval($set['paybegin']) <= $p) && ($p <= floatval($set['payend'])))) {
                    $bonusmoney_send = round($p, 2);
                } else {
                    $bonusmoney_send = round($p['bonusmoney'] - (($p['bonusmoney'] * floatval($set['paycharge'])) / 100), 2);
                }
                $arr = array(
                    'openid' => $k,
                    'money' => $bonusmoney_send,
                    'mid' => $m['id'],
                );
                $result_arr[] = $arr;
            }
            return $result_arr;

        }
    }
}
?>