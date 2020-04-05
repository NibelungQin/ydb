<?php
if (!(defined('IN_IA')))
{
    exit('Access Denied');
}
class History_EweiShopV2Page extends PluginWebPage
{
    public function main() {
        global $_GPC;
        global $_W;
        $page = intval($_GPC['page']);
        $page = max(1, $page);
        $psize = 20;

//        $keyword = trim($_GPC['keyword']);
//        $kdtype = trim($_GPC['kdtype']);
//
//        if (!(empty($keyword))) {
//            switch ($kdtype) {
//                case type: $keyword_condition = ' AND `serial` LIKE \'%' . $keyword . '%\'';
//                    break;
//                case goodstitle: $keyword_condition = ' AND `goods_title` LIKE \'%' . $keyword . '%\'';
//                    break;
//                case openid: $keyword_condition = ' AND `openid` LIKE \'%' . $keyword . '%\'';
//                    break;
//                case nickname: $keyword_condition = ' AND `nickname` LIKE \'%' . $keyword . '%\'';
//                    break;
//                case group: $keyword_condition = ' AND `title` LIKE \'%' . $keyword . '%\'';
//                    break;
//                default: $keyword_condition = '';
//            }
//        }else {
//            $keyword_condition = '';
//        }

        $starttime = strtotime(trim($_GPC['time']['start']));
        $endtime = strtotime(trim($_GPC['time']['end']));
        if (empty($starttime) || empty($endtime)) {
            $starttime = strtotime('-1 month');
            $endtime = time();
            $time_condition = '';
        }else {
            $time_condition = ' AND ( `task_createtime`>=' . $starttime . ' AND task_createtime <=' . $endtime .') OR (`share_createtime`>=' . $starttime . ' AND share_createtime <=' . $endtime.')';
        }

        $ps = $psize * ($page - 1);
        $limit = ' ORDER BY id DESC LIMIT ' . $ps . ',' . $psize;

        $sql = 'SELECT * FROM ' . tablename('ewei_shop_advertisement_bonus_log') . ' WHERE uniacid = :uniacid ' . $keyword_condition . $time_condition . $limit;
        $record = pdo_fetchall($sql, array(':uniacid' => $_W['uniacid']));
        foreach($record as $k=>$v) {
            $adv_id = pdo_fetch('SELECT adv_id FROM ' . tablename('ewei_shop_advertisement_order') . ' WHERE id=:id and uniacid=:uniacid ', array(':id' => $v['o_id'], ':uniacid' => $_W['uniacid']));
            $record[$k]['adv_name'] = pdo_fetch('SELECT title FROM ' . tablename('ewei_shop_advertisement_goods') . ' WHERE id=:id and uniacid=:uniacid ', array(':id' => $adv_id['adv_id'], ':uniacid' => $_W['uniacid']));
            $record[$k]['nickname'] = pdo_fetch('SELECT nickname FROM ' . tablename('ewei_shop_member') . ' WHERE id=:id and uniacid=:uniacid ', array(':id' => $v['mid'], ':uniacid' => $_W['uniacid']));
        }
        $countsql = 'SELECT COUNT(*) FROM ' . tablename('ewei_shop_advertisement_bonus_log') . ' WHERE uniacid = :uniacid ' . $keyword_condition  . $time_condition;
        $count = pdo_fetchcolumn($countsql, array(':uniacid' => $_W['uniacid']));
        $pager = pagination2($count, $page, $psize);
        include $this->template();
    }

    public function detail(){
        global $_W;
        global $_GPC;
        $id = intval($_GPC['id']);
        $res = pdo_fetch(
            'SELECT log.*,m.nickname,g.title FROM ' . tablename('ewei_shop_advertisement_bonus_log') . ' as log' . "\r\n\t\t\t\t"
            . 'left join ' . tablename('ewei_shop_advertisement_order') . ' as o on o.id = log.o_id and o.uniacid =  log.uniacid' . "\r\n\t\t\t\t"
            . 'left join ' . tablename('ewei_shop_advertisement_goods') . ' as g on g.id = o.adv_id and g.uniacid =  o.uniacid' . "\r\n\t\t\t\t"
            . 'left join ' . tablename('ewei_shop_member') . ' m on m.id=o.adv_id and m.uniacid =  o.uniacid' . "\r\n\t\t\t\t"
            . 'WHERE log.id =:id  and log.uniacid=:uniacid  limit 1', array( ':id' => $id,':uniacid' => $_W['uniacid']));
        include $this->template();
    }

    public function statistics(){
        global $_GPC;
        global $_W;
        $dateRand = $_GPC['date'];
        if (!(empty($dateRand)))
        {
            $range = (strtotime($dateRand['end']) - strtotime($dateRand['start'])) / 86400;
            $i = $range + 1;
        }
        else
        {
            $i = 1;
        }
        $price_key = array();
        $price_value = array();
        $count_value = array();
        $balanceCount = 0;
        $goodsCount = 0;
        $redCount = 0;
        $scoreCount = 0;
        $couponCount = 0;
        $groupCount = 0;
        $goodssum = 0;
        $balancesum = 0;
        $redsum = 0;
        $scoresum = 0;
        $couponsum = 0;
        $groupsum = 0;
        $i -= 1;
        while (0 <= $i) {
            if (!(empty($dateRand)))
            {
                $time = strtotime($dateRand['end']);
            }
            else
            {
                $time = time();
            }
            $time = $time - (86400 * $i);
            $day = date('Y-m-d', $time);
            array_push($price_key, $day);
            $compare_time1 = strtotime($day . ' 00:00:00');
            $compare_time2 = strtotime($day . ' 23:59:59');
            $all = pdo_fetchcolumn('SELECT COUNT(*) FROM ' . tablename('ewei_shop_exchange_record') . ' WHERE uniacid = ' . $_W['uniacid'] . ' AND `time` >= ' . $compare_time1 . ' AND `time` <=' . $compare_time2);
            $all = intval($all);
            array_push($count_value, $all);
            $res = pdo_fetchall('SELECT * FROM ' . tablename('ewei_shop_exchange_record') . ' WHERE uniacid = ' . $_W['uniacid'] . ' AND `time` >= ' . $compare_time1 . ' AND `time` <=' . $compare_time2);
            $sum = 0;
            if ($res != false)
            {
                foreach ($res as $ke => $va )
                {
                    if ($va['mode'] == 2)
                    {
                        $balanceCount += 1;
                        $sum += $va['balance'];
                        $balancesum += $va['balance'];
                    }
                    else if ($va['mode'] == 3)
                    {
                        $redCount += 1;
                        $sum += $va['red'];
                        $redsum += $va['red'];
                    }
                    else if ($va['mode'] == 1)
                    {
                        $goodsCount += 1;
                        $goods = json_decode($va['goods'], 1);
                        foreach ($goods as $k => $v )
                        {
                            $sum += $v[2];
                            $goodssum += $v[2];
                        }
                    }
                    else if ($va['mode'] == 4)
                    {
                        $scoreCount += 1;
                        $scoresum += $va['score'];
                    }
                    else if ($va['mode'] == 5)
                    {
                        $couponCount += 1;
                        $couponsum += count(json_decode($va['coupon'], 1));
                    }
                    else if ($va['mode'] == 6)
                    {
                        $groupCount += 1;
                        $groupsum = 0;
                    }
                    $sum = round($sum, 2);
                }
            }
            array_push($price_value, $sum);
            --$i;
        }
        $return = json_encode(array('price_key' => $price_key, 'price_value' => $price_value, 'count_value' => $count_value));
        $arr = array('goodsc' => $goodsCount, 'balancec' => $balanceCount, 'redc' => $redCount, 'scorec' => $scoreCount, 'couponc' => $couponCount, 'groupc' => $groupCount, 'goodss' => $goodssum, 'balances' => $balancesum, 'reds' => $redsum, 'scores' => $scoresum, 'coupons' => $couponsum, 'groups' => $groupsum);
        $json = json_encode($arr);
        include $this->template();
    }
}
?>