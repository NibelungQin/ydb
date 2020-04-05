<?php
if (!(defined('IN_IA'))) {
    exit('Access Denied');
}
define('TM_ACHIVEMENT_PAY', 'TM_ACHIVEMENT_PAY');
define('TM_ACHIVEMENT_UPGRADE', 'TM_ACHIVEMENT_UPGRADE');
define('TM_ACHIVEMENT_BECOME', 'TM_ACHIVEMENT_BECOME');
if (!(class_exists('AchievementModel'))) {
    class AchievementModel extends PluginModel
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
                $default = array('id' => '0', 'levelname' => (empty($_S['achievement']['levelname']) ? '默认等级' : $_S['achievement']['levelname']), 'bonus' => $_W['shopset']['achievement']['bonus']);
                $levels = array_merge(array($default), $levels);
            }
            return $levels;
        }

        public function getBonus($openid = '', $params = array())
        {
            global $_W;
            $ret = array();
            if (in_array('ok', $params)) {
                $ret['ok'] = pdo_fetchcolumn('select ifnull(sum(paymoney),0) from ' . tablename('ewei_shop_achievement_billp') . ' where openid=:openid and status=1 and uniacid=:uniacid limit 1', array(':uniacid' => $_W['uniacid'], ':openid' => $openid));
            }
            if (in_array('lock', $params)) {
                $billdData = pdo_fetchall('select id from ' . tablename('ewei_shop_achievement_bill') . ' where 1 and uniacid = ' . intval($_W['uniacid']));
                $id = '';
                if (!(empty($billdData))) {
                    $ids = array();
                    foreach ($billdData as $v) {
                        $ids[] = $v['id'];
                    }
                    $id = implode(',', $ids);
                    $ret['lock'] = pdo_fetchcolumn('select ifnull(sum(paymoney),0) from ' . tablename('ewei_shop_achievement_billp') . ' where openid=:openid and status<>1 and uniacid=:uniacid  and billid in(' . $id . ') limit 1', array(':uniacid' => $_W['uniacid'], ':openid' => $openid));
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
            if (($message_type == TM_ACHIVEMENT_PAY) && empty($usernotice['achievement_pay'])) {
                if ($tm['is_advanced']) {
                    if ($tm['achievement_pay_close_advanced']) {
                        return false;
                    }
                    $tag = 'achievement_pay';
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
            }
            m('notice')->sendNotice(array('openid' => $toopenid, 'tag' => $tag, 'default' => $message, 'cusdefault' => $text, 'datas' => $datas, 'plugin' => 'achievement'));
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


        public function getInfo($openid, $options = NULL)
        {
            $return = array();
            if (p('commission')) {
                return p('commission')->getInfo($openid, $options);
            }
            return $return;
        }


        /*
         * 获取下线总消费额
         *
         * */

        public function get_team_money($openid, $start_time, $end_time)
        {
            global $_W;
            global $_GPC;
            $member = m('member')->getInfo($openid);
            $where_time = ' and createtime between ' . $start_time . ' and ' . $end_time;
            //团队消费总额
            $query_condition = " where match(gflag) against ('," . $member['id'] . ",')";
            $query_condition = ' and openid in (select openid from ' . tablename('ewei_shop_member') . $query_condition . ')';
            $team_money = pdo_fetchcolumn('select sum(price) from ' . tablename('ewei_shop_order') . ' where uniacid=:uniacid and status=3' . $query_condition . $where_time, array(':uniacid' => $_W['uniacid'])) ?: 0;//团队业绩
            $month_money = pdo_fetchcolumn('select sum(price) from ' . tablename('ewei_shop_order') . ' where uniacid=:uniacid and openid=:openid and status=3' . $where_time, array(':uniacid' => $_W['uniacid'], ':openid' => $openid)) ?: 0;//个人业绩
            return $team_money + $month_money;

        }


        /**
         *
         * 计算结算单佣金
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
            //如果没有设置绩效奖励比例或者绩效奖励比例为0
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
            $bill = pdo_fetch('select * from ' . tablename('ewei_shop_achievement_bill') . ' where uniacid=:uniacid and `year`=:year and `month`=:month and `week`=:week limit 1', array(':uniacid' => $_W['uniacid'], ':year' => $year, ':month' => $month, ':week' => $week));
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
            $orders = pdo_fetchall('select id,openid,price,costprice from ' . tablename('ewei_shop_order') . ' where uniacid=' . $_W['uniacid'] . ' and status=3  and isachievement=0 and finishtime + ' . $settletimes . '>= ' . $starttime . ' and  finishtime + ' . $settletimes . '<=' . $endtime . ' ' . $pcondition, array(), 'id');
            $pcondition = '';
            if (!(empty($openid))) {
                $pcondition = ' and m.openid=\'' . $openid . '\'';
            }

            //关联查询店铺成员和店铺等级
            $partners = pdo_fetchall('select m.id,m.openid,m.partnerlevel,l.bonus,l.achievement_weight from ' . tablename('ewei_shop_member') . ' m ' . '  left join ' . tablename('ewei_shop_globonus_level') . ' l on l.id = m.partnerlevel ' . '  where m.uniacid=:uniacid and  m.ispartner=1 and m.partnerstatus=1 ' . $pcondition, array(':uniacid' => $_W['uniacid']));
            $all_score = 0;
            foreach ($partners as &$p) {
                if (empty($p['partnerlevel']) || ($p['achievement_weight'] == NULL)) {
                    //如果分红比例未设置则取默认设置的比例
                    $p['achievement_weight'] = intval($set['achievement_weight']);
                }
                $p['team_money'] = $this->get_team_money($p['openid'], $starttime, $endtime);
                $p['achievement_score'] = $p['achievement_weight'] * $p['team_money'];
                $all_score += $p['achievement_score'];
            }
            unset($p);

            foreach ($orders as $o) {
                $ordermoney += $o['price'];//订单总金额
                if ($commission['calcutype'] == 2) {
                    //如果按订单利润计算佣金

                    $bonusordermoney += (($o['price'] - $o['costprice']) * $set['bonusrate']) / 100;
                } else {
                    $bonusordermoney += ($o['price'] * $set['bonusrate']) / 100;
                }
            }

            foreach ($partners as &$p) {
                !(isset($p['bonusmoney'])) && ($p['bonusmoney'] = 0);
                if ($all_score == 0) {
                    continue;
                }
                if ($bonusordermoney > 0) {
                    if ($p['achievement_score'] == 0) {
                        continue;
                    }
                    $p['bonusmoney'] = round($bonusordermoney * ($p['achievement_score'] / $all_score), 2);
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

        public function getTotals()
        {
            global $_W;
            return array('total0' => pdo_fetchcolumn('select count(*) from ' . tablename('ewei_shop_achievement_bill') . ' where uniacid=:uniacid and status=0 limit 1', array(':uniacid' => $_W['uniacid'])), 'total1' => pdo_fetchcolumn('select count(*) from ' . tablename('ewei_shop_achievement_bill') . ' where uniacid=:uniacid and status=1 limit 1', array(':uniacid' => $_W['uniacid'])), 'total2' => pdo_fetchcolumn('select count(*) from ' . tablename('ewei_shop_achievement_bill') . ' where uniacid=:uniacid and status=2  limit 1', array(':uniacid' => $_W['uniacid'])));
        }

        /*
         * 获取上级所有店铺身份会员
         *
         * */
        public function get_globonus_member($openid, $flag_q)
        {
            global $_W;
            if (empty($flag_q)) {
                $flag_q = -1;
            }
            //查询当前用户是否拥有店铺权利
            $pcondition = '';
            if (!(empty($flag_q))) {
                $pcondition = ' and m.id in (' . $flag_q . ' )';
            }
            //关联查询店铺成员和店铺等级
            $partners = pdo_fetchall('select m.id,m.openid,m.partnerlevel,l.bonus,l.achievement_weight from ' . tablename('ewei_shop_member') . ' m ' . '  left join ' . tablename('ewei_shop_globonus_level') . ' l on l.id = m.partnerlevel ' . '  where m.uniacid=:uniacid and  m.ispartner=1 and m.partnerstatus=1 ' . $pcondition, array(':uniacid' => $_W['uniacid']));
            return $partners;
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
            $globonus_set = p('globonus')->getSet();
            //如果没有设置店铺奖励比例或者店铺奖励比例为0
            if (empty($set['bonusrate']) || ($set['bonusrate'] <= 0)) {
                $set['bonusrate'] = 100;
            }
            //查询是否已生成奖励信息
            $log = pdo_fetchall('SELECT id,openid,bonusmoney FROM ' . tablename('ewei_shop_packagegoods_achievement_log') . ' WHERE uniacid=:uniacid AND orderid=:orderid ',array(':uniacid' => $_W['uniacid'], ':orderid' => $orderid));
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
            //查询订单
            $orders = pdo_fetch('select o.id,o.openid,o.price,o.freight,g.achievement_type,g.achievement_proportion from '
                . tablename('ewei_shop_packagegoods_order') . ' o ' . ' left join ' . tablename('ewei_shop_packagegoods_goods') . ' g on g.id=o.goodid '
                . ' where o.uniacid=:uniacid and o.id=:orderid and o.is_achievement=0 and o.openid=:openid  ', array(':uniacid' => $_W['uniacid'], ':orderid' => $orderid, ':openid' => $openid)
            );
            if ($orders['achievement_type'] != 1) {
                return;
            }
            if ($orders['achievement_proportion']) {
                //如果大礼包绩效里有比例
                $set['bonusrate'] = $orders['achievement_proportion'];
            }
            $m = m('member')->getMember($orders['openid']);
            $money_arr = array();//佣金数组
            $reward_share = ($orders['price'] * $set['bonusrate']) / 100;//绩效奖励金额
            $flag_q = substr($m['gflag'], 1, -1);//基因处理
            //查询所有店铺会员
            $users = $this->get_globonus_member($m['openid'], $flag_q);

            $all_score = 0;
            foreach ($users as &$p) {
                if (empty($p['partnerlevel']) || ($p['achievement_weight'] == NULL)) {
                    //如果分红比例未设置则取默认设置的比例
                    $p['achievement_weight'] = intval($globonus_set['achievement_weight']);
                }
                $all_score += $p['achievement_weight'];
            }
            if($all_score==0 || $reward_share==0){
                return;
            }
            foreach ($users as &$u) {
                $u['money']=$u['achievement_weight']/$all_score*$reward_share;
                if ($u['money']) {
                    $all_money = $this->floor_decimals($u['money'], 2);            //四舍五入取两位小数
                    $money_arr[$u['openid']] = $all_money;
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

    }
}
?>