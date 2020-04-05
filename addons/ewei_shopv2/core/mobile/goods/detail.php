<?php

use Ydb\Entity\Manual\AbonusLevel;
use Ydb\Entity\Manual\AdvertisementBonusLog;
use Ydb\Entity\Manual\AdvertisementGoods;
use Ydb\Entity\Manual\AdvertisementOrder;
use Ydb\Entity\Manual\AdvertisementTask;
use Ydb\Entity\Manual\BargainGoods;
use Ydb\Entity\Manual\CityExpress;
use Ydb\Entity\Manual\CommissionLevel;
use Ydb\Entity\Manual\Engine\McMembers;
use Ydb\Entity\Manual\FullbackGoods;
use Ydb\Entity\Manual\Gift;
use Ydb\Entity\Manual\GlobonusLevel;
use Ydb\Entity\Manual\Goods;
use Ydb\Entity\Manual\GoodsLabelStyle;
use Ydb\Entity\Manual\GoodsOption;
use Ydb\Entity\Manual\GoodsParam;
use Ydb\Entity\Manual\GoodsSpec;
use Ydb\Entity\Manual\Member;
use Ydb\Entity\Manual\MemberAddress;
use Ydb\Entity\Manual\MemberLevel;
use Ydb\Entity\Manual\MerchStore;
use Ydb\Entity\Manual\MerchUser;
use Ydb\Entity\Manual\Offic;
use Ydb\Entity\Manual\Order;
use Ydb\Entity\Manual\OrderComment;
use Ydb\Entity\Manual\OrderGoods;
use Ydb\Entity\Manual\Package;
use Ydb\Entity\Manual\PackageGoods;
use Ydb\Entity\Manual\Store;
use Ydb\Entity\Manual\TaskExtensionJoin;
use Ydb\Entity\Manual\TaskReward;
use Ydb\Util\ExceptionUtil;

if (!(defined('IN_IA'))) {
    exit('Access Denied');
}

class Goods_Detail_EweiShopV2MobilePage extends MobilePage
{

    public function main()
    {
        global $_W;
        global $_GPC;
        /*判断是否是从广告套餐系统分享进来的 */
        $openid = $_W['openid'];
        load()->model('mc');
        $uid = mc_openid2uid($openid);
        if (empty($uid)) {
            mc_oauth_userinfo($openid);
        }
        $member = m('member')->getMember($openid);
        $o_id = (int)$_GPC['o_id'];//广告套餐商品订单ID
        $mid = (int)$_GPC['mid'];//接任务分享人ID

        $uniacid = $_W['uniacid'];
        $id = (int)$_GPC['id'];
        $rank = (int)$_GPC['rank'];
        $log_id = (int)$_GPC['log_id'];
        $join_id = (int)$_GPC['join_id'];
        $task_id = (int)$_GPC['task_id'];

        /*判断是否是从广告套餐系统分享来的 */
        if (!(empty($o_id))) {
            //浏览量累计
            $c_seen_num = pdo_fetch(
                'select seen_num from ' . AdvertisementOrder::TABLE_NAME
                . ' where id=:id and uniacid=:uniacid limit 1',
                array(':id' => $o_id, ':uniacid' => $_W['uniacid'])
            );
            $s_num = array(
                'seen_num' => ($c_seen_num['seen_num'] + 1),
            );
            pdo_update('ewei_shop_advertisement_order', $s_num, array('id' => $o_id, 'uniacid' => $_W['uniacid']));

            //判断是否领取了任务并且未结束
            $adv_task = pdo_fetch(
                'select * from ' . AdvertisementTask::TABLE_NAME
                . ' where o_id=:o_id and mid=:mid and uniacid=:uniacid and task_status=1 limit 1',
                array(':o_id' => $o_id, ':mid' => $mid, ':uniacid' => $_W['uniacid'])
            );
            if ($adv_task) {
                //判断该任务是否已经结束了（即该套餐任务推广的广告费用已经用完了）
                $sql = 'select task_bonus,share_bonus from ' . AdvertisementBonusLog::TABLE_NAME
                    . ' where uniacid = :uniacid and o_id = :o_id ';
                $param = array(':uniacid' => $_W['uniacid'], ':o_id' => $o_id);
                $pdo_res = pdo_fetchall($sql, $param);

                $price = 0;
                foreach ($pdo_res as $key => $value) {
                    $price += (float)($value['task_bonus'] + $value['share_bonus']);
                }
                $task__order_data = pdo_fetch(
                    'SELECT o.task_money,o.share_money,o.system_pro,adv.price as adv_price
                        FROM ' . AdvertisementOrder::TABLE_NAME . ' as o'
                    . ' left join ' . AdvertisementGoods::TABLE_NAME . ' adv
                            on adv.id=o.adv_id and adv.uniacid =  o.uniacid '
                    . ' WHERE o.goods_id =:id and o.id=:o_id and o.uniacid=:uniacid and o_g_status=1
                            and o.status=1 limit 1',
                    array(':uniacid' => $_W['uniacid'], ':id' => $id, 'o_id' => $o_id)
                );

                //获取设置的分享的赏金（根据不同会员身份对应不同的分享任务赏金）
                if (!(empty($task__order_data['share_money'])) || !(empty($task__order_data['task_money']))) {
                    $task__order_data['task_money'] = iunserializer($task__order_data['task_money']);
                    $task__order_data['share_money'] = iunserializer($task__order_data['share_money']);
                }
                $level = pdo_fetch('select agentlevel,uid,openid from ' . Member::TABLE_NAME
                    . ' where id=:id and uniacid=:uniacid limit 1',
                    array(':id' => $mid, ':uniacid' => $_W['uniacid']));

                foreach ($task__order_data['share_money']['level'] as $k => $v) {
                    if ($v == $level['agentlevel']) {
                        $task__order_data['actual_task_money'] = $task__order_data['task_money']['money'][$k];
                        $task__order_data['actual_share_money'] = $task__order_data['share_money']['money'][$k];
                    }
                }
                unset($task__order_data['task_money'], $task__order_data['share_money']);

                //除去平台抽取的广告抽成比例，拿出多少做广告推广费用
                $task_total_price = $task__order_data['adv_price'] * (1 - ($task__order_data['system_pro'] / 100));
                //求算出还剩多少推广的广告费用,并判断此赏金是否够发
                $remnant_price = $task_total_price - $price;

                // 一：判断该领取任务的的会员是否分配到领取任务赏金（一个任务对一个领取任务的会员能只能拿一次任务赏金，
                // 前提是领取人并分享出去，任务赏金及时分配发放）
                $sql = 'select task_bonus from ' . AdvertisementBonusLog::TABLE_NAME
                    . ' where uniacid = :uniacid and o_id = :o_id and mid = :mid and type=1';
                $param = array(':uniacid' => $_W['uniacid'], ':o_id' => $o_id, ':mid' => $mid);
                $res_task_log = pdo_fetchall($sql, $param);
                if (empty($res_task_log)) {//即第一次领取任务，并发放任务赏金
                    //已领取任务人数累加；
                    $c_task_num = pdo_fetch(
                        'select task_num from ' . AdvertisementOrder::TABLE_NAME
                        . ' where id=:id and uniacid=:uniacid limit 1',
                        array(':id' => $o_id, ':uniacid' => $_W['uniacid'])
                    );
                    $t_num = array(
                        'task_num' => ($c_task_num['task_num'] + 1),
                    );
                    pdo_update('ewei_shop_advertisement_order', $t_num,
                        array('id' => $o_id, 'uniacid' => $_W['uniacid']));

                    if ($remnant_price >= 0 && ($remnant_price - $task__order_data['actual_task_money']) > 0) {
                        //分配领取任务的赏金（根据不同端口）
                        if (!(empty($uid))) {//wechat端
                            $value = pdo_fetchcolumn('SELECT  credit2  FROM ' . McMembers::TABLE_NAME
                                . ' WHERE `uid` = :uid',
                                array(':uid' => $level['uid']));
                            $newcredit = $task__order_data['actual_task_money'] + $value;
                            pdo_update('mc_members', array('credit2' => $newcredit), array('uid' => $level['uid']));
                        } else {//wap端
                            $value = pdo_fetchcolumn(
                                'SELECT credit2 FROM ' . Member::TABLE_NAME
                                . ' WHERE  uniacid=:uniacid and openid=:openid limit 1',
                                array(':uniacid' => $_W['uniacid'], ':openid' => $level['openid'])
                            );
                            $newcredit = $task__order_data['actual_task_money'] + $value;
                            pdo_update('ewei_shop_member', array('credit2' => $newcredit),
                                array('uniacid' => $_W['uniacid'], 'openid' => $level['openid']));
                        }
                        //分配完任务赏金同时记录发放赏金log日志
                        $task_data_log = array(
                            'uniacid' => $_W['uniacid'],
                            'mid' => $mid,
                            'o_id ' => $o_id,
                            'type' => 1,//1:接任务赏金，2：分享任务赏金
                            'task_bonus' => $task__order_data['actual_task_money'],
                            'task_createtime' => time(),
                            'task_bonus_status' => 1,//发放分享任务奖金状态:0：未发放；1：已发放；2：发放失败；
                        );
                        pdo_insert('ewei_shop_advertisement_bonus_log', $task_data_log);
                    } else {//如果赏金钱不够分则任务结束
                        $task_data = array(
                            'task_status' => 2,//1:进行中，2：已结束
                        );
                        pdo_update('ewei_shop_advertisement_task', $task_data,
                            array('o_id' => $o_id, 'mid' => $mid, 'uniacid' => $_W['uniacid']));
                    }
                }


                // 二：判断该任务分享的是否是同一个人（分享出去的分享赏金，同一个会员浏览对于领取任务的会员能只能拿一次分享赏金）
                $sql = 'select seen_id from ' . AdvertisementBonusLog::TABLE_NAME
                    . ' where uniacid = :uniacid and o_id = :o_id and mid = :mid and seen_id = :seen_id and type=2';
                $param = array(
                    ':uniacid' => $_W['uniacid'],
                    ':o_id' => $o_id,
                    ':mid' => $mid,
                    ':seen_id' => $member['id']
                );
                $res_share_log = pdo_fetchall($sql, $param);

                if (empty($res_share_log)) {
                    //分享量累计
                    $c_share_num = pdo_fetch(
                        'select share_num from ' . AdvertisementOrder::TABLE_NAME
                        . ' where id=:id and uniacid=:uniacid limit 1',
                        array(':id' => $o_id, ':uniacid' => $_W['uniacid'])
                    );
                    $ss_num = array(
                        'share_num' => ($c_share_num['share_num'] + 1),
                    );
                    pdo_update('ewei_shop_advertisement_order', $ss_num,
                        array('id' => $o_id, 'uniacid' => $_W['uniacid']));

                    if ($remnant_price >= 0 && ($remnant_price - $task__order_data['actual_share_money']) > 0) {
                        //分配分享任务的赏金（根据不同端口）
                        if (!(empty($uid))) {//wechat端
                            $value = pdo_fetchcolumn('SELECT  credit2  FROM ' . McMembers::TABLE_NAME
                                . ' WHERE `uid` = :uid',
                                array(':uid' => $level['uid']));
                            $newcredit = $task__order_data['actual_share_money'] + $value;
                            pdo_update('mc_members', array('credit2' => $newcredit),
                                array('uid' => $level['uid']));
                        } else {//wap端
                            $value = pdo_fetchcolumn('SELECT credit2 FROM ' . Member::TABLE_NAME
                                . ' WHERE  uniacid=:uniacid and openid=:openid limit 1',
                                array(':uniacid' => $_W['uniacid'], ':openid' => $level['openid']));
                            $newcredit = $task__order_data['actual_share_money'] + $value;
                            pdo_update('ewei_shop_member', array('credit2' => $newcredit),
                                array('uniacid' => $_W['uniacid'], 'openid' => $level['openid']));
                        }
                        //分配完赏金同时记录发放赏金log日志
                        $share_data_log = array(
                            'uniacid' => $_W['uniacid'],
                            'mid' => $mid,
                            'seen_id' => $member['id'],
                            'o_id ' => $o_id,
                            'type' => 2,//1:接任务赏金，2：分享任务赏金
                            'share_bonus' => $task__order_data['actual_share_money'],
                            'share_createtime' => time(),
                            'share_bonus_status' => 1,//发放分享任务奖金状态:0：未发放；1：已发放；2：发放失败；
                        );
                        pdo_insert('ewei_shop_advertisement_bonus_log', $share_data_log);
                    } else {//如果赏金钱不够分则任务结束
                        $task_data = array(
                            'task_status' => 2,//1:进行中，2：已结束
                        );
                        pdo_update('ewei_shop_advertisement_task', $task_data,
                            array('o_id' => $o_id, 'mid' => $mid, 'uniacid' => $_W['uniacid']));
                    }
                }
            }
        }


        if (!(empty($join_id))) {
            $_SESSION[$id . '_rank'] = $rank;
            $_SESSION[$id . '_join_id'] = $join_id;
        } elseif (!(empty($log_id))) {
            $_SESSION[$id . '_log_id'] = $log_id;
        } elseif (!(empty($task_id))) {
            $_SESSION[$id . '_task_id'] = $task_id;
        }
        if (p('task')) {
            if (!(empty($task_id))) {
                $rewarded = pdo_fetchcolumn('SELECT `rewarded`
                        FROM ' . TaskExtensionJoin::TABLE_NAME
                    . ' WHERE id = :id AND uniacid = :uniacid',
                    array(':id' => $task_id, ':uniacid' => $_W['uniacid']));
                $taskGoodsInfo = unserialize($rewarded);
                $taskGoodsInfo = $taskGoodsInfo['goods'][$id];
                if (!(empty($taskGoodsInfo['option']))) {
                    $taskGoodsInfo = null;
                }
            }
            $taskrewardgoodsid = (int)$_GPC['taskrewardgoodsid'];
            $taskGoodsInfo = pdo_fetch('select * from ' . TaskReward::TABLE_NAME
                . ' where id = :id and openid = :openid and senttime = 0 and gettime > 0',
                array(':id' => $taskrewardgoodsid, ':openid' => $_W['openid']));
            $_SESSION['taskcut'] = $taskGoodsInfo;
            if (empty($taskGoodsInfo)) {
                $_SESSION['taskcut'] = null;
            }
        }
        if (p('threen')) {
            $threenvip = p('threen')->getMember($_W['openid']);
            if (!(empty($threenvip))) {
                $threen = true;
            }
        }
        $err = false;
        $merch_plugin = p('merch');
        $merch_data = m('common')->getPluginset('merch');
        $commission_data = m('common')->getPluginset('commission');
        if ($merch_plugin && $merch_data['is_openmerch']) {
            $is_openmerch = 1;
        } else {
            $is_openmerch = 0;
        }
        $isgift = 0;
        $gifts = array();
        $giftgoods = array();
        $gifts = pdo_fetchall('select id,goodsid,giftgoodsid,thumb,title
                from ' . Gift::TABLE_NAME
            . ' where uniacid = ' . $uniacid . ' and activity = 2 and status = 1
                    and starttime <= ' . time() . ' and endtime >= ' . time() . '  ');
        foreach ($gifts as $key => &$value) {
            $gid = explode(',', $value['goodsid']);
            foreach ($gid as $ke => $val) {
                if ($val == $id) {
                    $giftgoods = explode(',', $value['giftgoodsid']);
                    foreach ($giftgoods as $k => $v) {
                        $isgift = 1;
                        $gifts[$key]['gift'][$k] = pdo_fetch('select id,title,thumb,marketprice
                                from ' . Goods::TABLE_NAME
                            . ' where uniacid = ' . $uniacid . ' and deleted = 0 and total > 0
                                    and status = 2 and id = ' . $v . ' ');
                        $gifttitle = ((!(empty($value['gift'][$k]['title'])) ? $value['gift'][$k]['title'] : '赠品'));
                    }
                }
            }
            if (empty($value['gift'])) {
                unset($gifts[$key]);
            }
        }
        $goods = pdo_fetch(
            'select * from ' . Goods::TABLE_NAME
            . ' where id=:id and uniacid=:uniacid limit 1',
            array(':id' => $id, ':uniacid' => $_W['uniacid'])
        );

        if ($goods['isverify'] == 2) {
            unset($gifts);
        }
        $goodscode = $this->get_code();
        if ($goods['type'] == 9) {
            header('location: ' . mobileUrl('cycelbuy/goods/detail', array('id' => $goods['id'])));
            exit();
        }
        if (p('offic')) {
            $marketprice = $goods['marketprice'];
            $goods['marketprice'] = $goods['minprice'];
            $commission_price = p('commission')->getCommission($goods);
            $goods['marketprice'] = $marketprice;
        }
        if ($is_openmerch == 1) {
            $set = m('plugin')->loadModel('merch')->getListUserOne($goods['merchid']);
            if ($set['status'] != 1) {
                $is_openmerch = 0;
            }
        }
        $threenprice = json_decode($goods['threen'], 1);
        if ((0 < $goods['ispresell'])
            && (((0 < $goods['presellend']) && (time() < $goods['preselltimeend']))
                || ($goods['preselltimeend'] == 0))) {
            $goods['minprice'] = $goods['presellprice'];
            if ($goods['hasoption'] == 0) {
                $goods['maxprice'] = $goods['presellprice'];
            }
        }
        if ($goods['type'] == 30) {
            header('location: ' . mobileUrl('newstore/trade/detail', array('id' => $goods['id'])));
            exit();
        }
        if ($goods['type'] == 4) {
            $intervalprice = iunserializer($goods['intervalprice']);
            if (0 < $goods['intervalfloor']) {
                $goods['intervalprice1'] = $intervalprice[0]['intervalprice'];
                $goods['intervalnum1'] = $intervalprice[0]['intervalnum'];
            }
            if (1 < $goods['intervalfloor']) {
                $goods['intervalprice2'] = $intervalprice[1]['intervalprice'];
                $goods['intervalnum2'] = $intervalprice[1]['intervalnum'];
            }
            if (2 < $goods['intervalfloor']) {
                $goods['intervalprice3'] = $intervalprice[2]['intervalprice'];
                $goods['intervalnum3'] = $intervalprice[2]['intervalnum'];
            }
        }
        $isfullback = false;
        if ($goods['isfullback']) {
            $isfullback = true;
            $fullbackgoods = pdo_fetch('SELECT * FROM ' . FullbackGoods::TABLE_NAME
                . ' WHERE uniacid = ' . $uniacid . ' and goodsid = ' . $id . ' limit 1 ');
            if ($goods['hasoption'] == 1) {
                $fullprice = pdo_fetch('select min(allfullbackprice) as minfullprice,
                        max(allfullbackprice) as maxfullprice,min(allfullbackratio) as minfullratio,
                        max(allfullbackratio) as maxfullratio,min(fullbackprice) as minfullbackprice,
                        max(fullbackprice) as maxfullbackprice,min(fullbackratio) as minfullbackratio,
                        max(fullbackratio) as maxfullbackratio,min(`day`) as minday,max(`day`) as maxday
                    from ' . GoodsOption::TABLE_NAME . ' where goodsid = ' . $id);
                $fullbackgoods['minallfullbackallprice'] = $fullprice['minfullprice'];
                $fullbackgoods['maxallfullbackallprice'] = $fullprice['maxfullprice'];
                $fullbackgoods['minallfullbackallratio'] = $fullprice['minfullratio'];
                $fullbackgoods['maxallfullbackallratio'] = $fullprice['maxfullratio'];
                $fullbackgoods['minfullbackprice'] = $fullprice['minfullbackprice'];
                $fullbackgoods['maxfullbackprice'] = $fullprice['maxfullbackprice'];
                $fullbackgoods['minfullbackratio'] = $fullprice['minfullbackratio'];
                $fullbackgoods['maxfullbackratio'] = $fullprice['maxfullbackratio'];
                $fullbackgoods['fullbackratio'] = $fullprice['minfullbackratio'];
                $fullbackgoods['fullbackprice'] = $fullprice['minfullbackprice'];
                $fullbackgoods['minday'] = $fullprice['minday'];
                $fullbackgoods['maxday'] = $fullprice['maxday'];
            } else {
                $fullbackgoods['maxallfullbackallprice'] = $fullbackgoods['minallfullbackallprice'];
                $fullbackgoods['maxallfullbackallratio'] = $fullbackgoods['minallfullbackallratio'];
                $fullbackgoods['minday'] = $fullbackgoods['day'];
            }
        }
        $merchid = $goods['merchid'];
        if (json_decode($goods['labelname'], true)) {
            $labelname = json_decode($goods['labelname'], true);
        } else {
            $labelname = unserialize($goods['labelname']);
        }
        $style = pdo_fetch('SELECT id,uniacid,style FROM ' . GoodsLabelStyle::TABLE_NAME
            . ' WHERE uniacid=' . $uniacid);
        if ($is_openmerch == 0) {
            if (0 < $merchid) {
                $err = true;
                include $this->template('goods/detail');
                exit();
            }
        } elseif ((0 < $merchid) && ($goods['checked'] == 1)) {
            $err = true;
            include $this->template('goods/detail');
            exit();
        }
        $member = m('member')->getMember($openid);
        if (empty($member['updateaddress'])) {
            $address_list = pdo_fetchall('select id,datavalue from ' . MemberAddress::TABLE_NAME
                . ' where openid=:openid and uniacid=:uniacid',
                array(':uniacid' => $uniacid, ':openid' => $openid));
            if (!(empty($address_list))) {
                $areas = m('common')->getAreas();
                $datacode = array();
                foreach ($areas['province'] as $value) {
                    $pname = $value['@attributes']['name'];
                    $pcode = $value['@attributes']['code'];
                    $datacode[$pcode] = $pname;
                    foreach ($value['city'] as $city) {
                        $cname = $city['@attributes']['name'];
                        $ccode = $city['@attributes']['code'];
                        $datacode[$ccode] = $cname;
                        foreach ($city['county'] as $county) {
                            $aname = $county['@attributes']['name'];
                            $acode = $county['@attributes']['code'];
                            $datacode[$acode] = $aname;
                        }
                    }
                }
                $change_data = array();
                foreach ($address_list as $k1 => $v1) {
                    if (!(empty($v1['datavalue']))) {
                        $datavalue = explode(' ', $v1['datavalue']);
                        $change_data['province'] = $datacode[$datavalue[0]];
                        $change_data['city'] = $datacode[$datavalue[1]];
                        $change_data['area'] = $datacode[$datavalue[2]];
                        if (!(empty($change_data['province'])) && !(empty($change_data['city']))
                            && !(empty($change_data['area']))) {
                            pdo_update('ewei_shop_member_address', $change_data, array('id' => $v1['id']));
                        }
                    }
                }
                pdo_update('ewei_shop_member', array('updateaddress' => 1), array('id' => $member['id']));
            }
        }
        $showgoods = m('goods')->visit($goods, $member);
        if (empty($goods) || empty($showgoods)) {
            $err = true;
            include $this->template();
            ExceptionUtil::exit();
        }
        $seckillinfo = false;
        $seckill = p('seckill');
        if ($seckill) {
            $time = time();
            $seckillinfo = $seckill->getSeckill($goods['id'], 0, false);
            if (!(empty($seckillinfo))) {
                if (($seckillinfo['starttime'] <= $time) && ($time < $seckillinfo['endtime'])) {
                    $seckillinfo['status'] = 0;
                    unset($_SESSION[$id . '_log_id'], $_SESSION[$id . '_task_id'], $log_id);
                } elseif ($time < $seckillinfo['starttime']) {
                    $seckillinfo['status'] = 1;
                } else {
                    $seckillinfo['status'] = -1;
                }
            }
        }
        $task_goods_data = m('goods')->getTaskGoods($openid, $id, $rank, $log_id, $join_id);
        if (empty($task_goods_data['is_task_goods'])) {
            $is_task_goods = 0;
            if (p('bargain')) {
                $bargain = pdo_fetch('SELECT * FROM ' . BargainGoods::TABLE_NAME
                    . ' WHERE id = :id AND unix_timestamp(start_time)<' . time()
                    . ' AND unix_timestamp(end_time)>' . time() . ' AND status = 0',
                    array(':id' => $goods['bargain']));
                if ($bargain != false) {
                    echo '<script>window.location.href = \'' . mobileUrl('bargain/detail',
                            array('id' => $goods['bargain'])) . '\'</script>';
                    return;
                    $is_task_goods = $task_goods_data['is_task_goods'];
                    $is_task_goods_option = $task_goods_data['is_task_goods_option'];
                    $task_goods = $task_goods_data['task_goods'];
                }
            }
        } else {
            $is_task_goods = $task_goods_data['is_task_goods'];
            $is_task_goods_option = $task_goods_data['is_task_goods_option'];
            $task_goods = $task_goods_data['task_goods'];
        }
        $goods['sales'] = $goods['sales'] + $goods['salesreal'];
        $goods['content'] = m('ui')->lazy($goods['content']);
        $buyshow = 0;
        if ($goods['buyshow'] == 1) {
            $sql = 'select o.id from ' . Order::TABLE_NAME . ' o
                        left join ' . OrderGoods::TABLE_NAME . ' g on o.id = g.orderid
                    where o.openid=:openid and g.goodsid=:id and o.status>0 and o.uniacid=:uniacid limit 1';
            $buy_goods = pdo_fetch($sql, array(':openid' => $openid, ':id' => $id, ':uniacid' => $_W['uniacid']));
            if (!(empty($buy_goods))) {
                $buyshow = 1;
                $goods['buycontent'] = m('ui')->lazy($goods['buycontent']);
            }
        }
        $goods['unit'] = ((empty($goods['unit']) ? '件' : $goods['unit']));
        $dispatch_areas = m('dispatch')->getNoDispatchAreas($goods);
        $citys = ((empty($dispatch_areas) ? '' : $dispatch_areas['citys']));
        if (!(empty($citys))) {
            $onlysent = $dispatch_areas['onlysent'];
            $has_city = 1;
        } else {
            $has_city = 0;
        }
        $package_goods = pdo_fetch('select pg.id,pg.pid,pg.goodsid,p.displayorder
                    from ' . PackageGoods::TABLE_NAME . ' as pg
                        left join ' . Package::TABLE_NAME . ' as p on pg.pid = p.id
                    where pg.uniacid = ' . $uniacid . ' and pg.goodsid = ' . $id . '
                        and  p.starttime <= ' . time() . ' and p.endtime >= ' . time() . '
                        and p.deleted = 0 and p.status = 1 ORDER BY p.displayorder desc,pg.id desc limit 1 ');
        if ($package_goods['pid']) {
            $packages = pdo_fetchall('SELECT id,title,thumb,packageprice
                    FROM ' . PackageGoods::TABLE_NAME . '
                    WHERE uniacid = ' . $uniacid . ' and pid = ' . $package_goods['pid'] . '  ORDER BY id DESC');
            $packages = set_medias($packages, array('thumb'));
        }
        $goods['dispatchprice'] = $this->getGoodsDispatchPrice($goods, $seckillinfo);
        $thumbs = iunserializer($goods['thumb_url']);
        if (empty($thumbs)) {
            $thumbs = array($goods['thumb']);
        }
        if (!(empty($goods['thumb_first'])) && !(empty($goods['thumb']))) {
            $thumbs = array_merge(array($goods['thumb']), $thumbs);
        }
        $specs = pdo_fetchall('select * from ' . GoodsSpec::TABLE_NAME
            . ' where goodsid=:goodsid and  uniacid=:uniacid order by displayorder asc',
            array(':goodsid' => $id, ':uniacid' => $_W['uniacid']));

        $spec_titles = array();
        foreach ($specs as $key => $spec) {
            if (2 <= $key) {
                break;
            }
            $spec_titles[] = $spec['title'];
        }
        if (0 < $goods['hasoption']) {
            $spec_titles = implode('、', $spec_titles);
        } else {
            $spec_titles = '';
        }
        $params = pdo_fetchall('SELECT * FROM ' . GoodsParam::TABLE_NAME
            . ' WHERE uniacid=:uniacid and goodsid=:goodsid order by displayorder asc',
            array(':uniacid' => $uniacid, ':goodsid' => $goods['id']));
        $goods = set_medias($goods, 'thumb');
        $goods = set_medias($goods, 'video');
        $goods['canbuy'] = ($goods['status'] == 1) && empty($goods['deleted']);
        if (!(empty($goods['hasoption']))) {
            $options = pdo_fetchall('select id,stock,marketprice,islive,liveprice
                    from ' . GoodsOption::TABLE_NAME
                . ' where goodsid=:goodsid and uniacid=:uniacid order by displayorder asc',
                array(':goodsid' => $goods['id'], ':uniacid' => $_W['uniacid']), 'stock');
            $options_stock = array_keys($options);
        }
        $liveid = (int)$_GPC['liveid'];
        if (p('live') && !(empty($liveid))) {
            $islive = p('live')->getLivePrice($goods, $liveid);
            if ($islive) {
                $goods['minprice'] = $islive['minprice'];
                $goods['maxprice'] = $islive['maxprice'];
                if (empty($options)) {
                    $goods['marketprice'] = $islive['minprice'];
                }
            }
        }
        $liveid = ((!(empty($islive)) && !(empty($liveid)) ? $liveid : 0));
        if ($goods['total'] <= 0) {
            $goods['canbuy'] = false;
        }
        $ispresell = 0;
        if (0 < $goods['ispresell']) {
            $ispresell = 1;
            if ((0 < $goods['preselltimestart']) && (time() < $goods['preselltimestart'])) {
                $goods['canbuy'] = false;
            }
            if ((0 < $goods['preselltimeend']) && ($goods['preselltimeend'] < time())) {
                $goods['canbuy'] = false;
            }
            $times = ($goods['presellovertime'] * 60 * 60 * 24) + $goods['preselltimeend'];
            if ((0 < $goods['presellover']) && ($times <= time())) {
                $goods['canbuy'] = true;
                $ispresell = 0;
            }
        }
        if ((0 < $goods['isendtime']) && (0 < $goods['endtime']) && ($goods['endtime'] < time())) {
            $goods['canbuy'] = false;
            $goods['overdue'] = true;
        }
        $goods['timestate'] = '';
        $goods['userbuy'] = '1';
        if (0 < $goods['usermaxbuy']) {
            $order_goodscount = pdo_fetchcolumn('select ifnull(sum(og.total),0)
                    from ' . OrderGoods::TABLE_NAME . ' og '
                . ' left join ' . Order::TABLE_NAME . ' o on og.orderid=o.id '
                . ' where og.goodsid=:goodsid and  o.status>=1 and o.openid=:openid  and og.uniacid=:uniacid ',
                array(':goodsid' => $goods['id'], ':uniacid' => $uniacid, ':openid' => $openid));
            if ($goods['usermaxbuy'] <= $order_goodscount) {
                $goods['userbuy'] = 0;
                $goods['canbuy'] = false;
            }
        }
        $levelid = $member['level'];
        if ($member['groupid'] == '') {
            $groupid = array();
        } else {
            $groupid = explode(',', $member['groupid']);
        }
        $goods['levelbuy'] = '1';
        if ($goods['buylevels'] != '') {
            $buylevels = explode(',', $goods['buylevels']);
            if (!(in_array($levelid, $buylevels))) {
                $goods['levelbuy'] = 0;
                $goods['canbuy'] = false;
            }
        }
        $goods['groupbuy'] = '1';
        if (($goods['buygroups'] != '') && !(empty($groupid))) {
            $buygroups = explode(',', $goods['buygroups']);
            $intersect = array_intersect($groupid, $buygroups);
            if (empty($intersect)) {
                $goods['groupbuy'] = 0;
                $goods['canbuy'] = false;
            }
        }
        $goods['timebuy'] = '0';
        if (empty($seckillinfo)) {
            if ($goods['istime'] == 1) {
                if (time() < $goods['timestart']) {
                    $goods['timebuy'] = '-1';
                    $goods['canbuy'] = false;
                } elseif ($goods['timeend'] < time()) {
                    $goods['timebuy'] = '1';
                    $goods['canbuy'] = false;
                }
            }
        }
        if (com('coupon')) {
            $coupons = $this->getCouponsbygood($goods['id']);
        }
        $canAddCart = true;
        if (($goods['isverify'] == 2) || ($goods['type'] == 2) || ($goods['type'] == 3)
            || ($goods['type'] == 20) || !(empty($goods['cannotrefund']))
            || !(empty($is_task_goods)) || !(empty($gifts))) {
            $canAddCart = false;
        }
        if (($goods['type'] == 2) && empty($specs)) {
            $gflag = 1;
        } else {
            $gflag = 0;
        }
        $enoughs = com_run('sale::getEnoughs');
        $goods_nofree = com_run('sale::getEnoughsGoods');
        if (empty($is_task_goods)) {
            $enoughfree = com_run('sale::getEnoughFree');
        }
        if (($is_openmerch == 1) && (0 < $goods['merchid'])) {
            $merch_set = $merch_plugin->getSet('sale', $goods['merchid']);
            if ($merch_set['enoughfree']) {
                $enoughfree = $merch_set['enoughorder'];
                if ($merch_set['enoughorder'] == 0) {
                    $enoughfree = -1;
                }
            }
        }
        $one = array(array('enough' => $merch_set['enoughmoney'], 'give' => $merch_set['enoughdeduct']));
        $merchenoughs = $merch_set['enoughs'];
        if (empty($merchenoughs)) {
            $merchenoughs = array();
        }
        $merch_set['enoughs'] = array_merge_recursive($one, $merchenoughs);
        if (!(empty($goods_nofree))) {
            if (in_array($id, $goods_nofree)) {
                $enoughfree = false;
            }
        }
        if ($enoughfree && ($enoughfree < $goods['minprice']) && empty($seckillinfo)) {
            $goods['dispatchprice'] = 0;
        }
        $hasSales = false;
        if ((0 < $goods['ednum']) || (0 < $goods['edmoney'])) {
            $hasSales = true;
        }
        if ($enoughfree || ($enoughs && (0 < count($enoughs)))) {
            $hasSales = true;
        }
        $minprice = $goods['minprice'];
        $maxprice = $goods['maxprice'];
        $level = m('member')->getLevel($openid);
        if (empty($is_task_goods)) {
            $memberprice = m('goods')->getMemberPrice($goods, $level);
        }
        if ($goods['isdiscount'] && (time() <= $goods['isdiscount_time'])) {
            $goods['oldmaxprice'] = $maxprice;
            $prices = array();
            $isdiscount_discounts = json_decode($goods['isdiscount_discounts'], true);
            if (!(isset($isdiscount_discounts['type'])) || empty($isdiscount_discounts['type'])) {
                $prices_array = m('order')->getGoodsDiscountPrice($goods, $level, 1);
                $prices[] = $prices_array['price'];
            } else {
                $goods_discounts = m('order')->getGoodsDiscounts($goods, $isdiscount_discounts, $levelid);
                $prices = $goods_discounts['prices'];
            }
            $minprice = min($prices);
            $maxprice = max($prices);
        } else {
            if (isset($options) && (0 < count($options)) && $goods['hasoption']) {
                $optionids = array();
                foreach ($options as $val) {
                    $optionids[] = $val['id'];
                }
                $sql = 'update ' . Goods::TABLE_NAME . ' g set
                        g.minprice = (select min(marketprice) from ' . GoodsOption::TABLE_NAME . '
                                where goodsid = ' . $id . '),
                        g.maxprice = (select max(marketprice) from ' . GoodsOption::TABLE_NAME . '
                                where goodsid = ' . $id . ')
                        where g.id = ' . $id . ' and g.hasoption=1';
                pdo_query($sql);
            } else {
                $sql = 'update ' . Goods::TABLE_NAME . ' set minprice = marketprice,
                        maxprice = marketprice where id = ' . $id . ' and hasoption=0;';
                pdo_query($sql);
            }
            $goods_price = pdo_fetch('select minprice,maxprice from ' . Goods::TABLE_NAME
                . ' where id=:id and uniacid=:uniacid limit 1',
                array(':id' => $id, ':uniacid' => $_W['uniacid']));
            $maxprice = (double)$goods_price['maxprice'];
            $minprice = (double)$goods_price['minprice'];
            if ($islive) {
                $minprice = $islive['minprice'];
                $maxprice = $islive['maxprice'];
            }
        }
        if (!(empty($is_task_goods))) {
            if (isset($options) && (0 < count($options)) && $goods['hasoption']) {
                $prices = array();
                foreach ($task_goods['spec'] as $k => $v) {
                    $prices[] = $v['marketprice'];
                }
                $minprice2 = min($prices);
                $maxprice2 = max($prices);
                if ($minprice2 < $minprice) {
                    $minprice = $minprice2;
                }
                if ($maxprice < $maxprice2) {
                    $maxprice = $maxprice2;
                }
            } else {
                $minprice = $task_goods['marketprice'];
                $maxprice = $task_goods['marketprice'];
            }
        }
        if ((0 < $goods['ispresell']) && $goods['hasoption']
            && (($goods['preselltimeend'] == 0) || (time() < $goods['preselltimeend']))) {
            $presell = pdo_fetch('select min(presellprice) as minprice,max(presellprice) as maxprice
                    from ' . GoodsOption::TABLE_NAME . ' where goodsid = ' . $id);
            $minprice = $presell['minprice'];
            $maxprice = $presell['maxprice'];
        }
        $goods['minprice'] = $minprice;
        $goods['maxprice'] = $maxprice;
        $getComments = empty($_W['shopset']['trade']['closecommentshow']);
        $hasServices = $goods['cash'] || $goods['seven'] || $goods['repair'] || $goods['invoice'] || $goods['quality'];
        $isFavorite = m('goods')->isFavorite($id);
        $cartCount = m('goods')->getCartCount();
        m('goods')->addHistory($id);
        $shop = set_medias(m('common')->getSysset('shop'), 'logo');
        $shop['url'] = mobileUrl('', null, true);
        $mid = (int)$_GPC['mid'];
        $opencommission = false;

        if (p('commission') && empty($member['agentblack'])) {
            $cset = p('commission')->getSet();
            $opencommission = 0 < (int)$cset['level'];
            if ($opencommission) {
                if (($member['isagent'] == 1) && ($member['status'] == 1)) {
                    $mid = $member['id'];
                }
                if (!(empty($mid))) {
                    if (empty($cset['closemyshop'])) {
                        $shop = set_medias(p('commission')->getShop($mid), 'logo');
                        $shop['url'] = mobileUrl('commission/myshop', array('mid' => $mid), true);
                    }
                }
            }
        }
        $is_offic = false;
        if (p('offic') && ($member['isagent'] == 1) && ($member['status'] == 1)) {
            $is_offic = true;
            $shop['url'] = mobileUrl('offic/myshop', array('mid' => $mid), true);
        }

        if (empty($this->merch_user)) {
            $merch_flag = 0;
            if (($is_openmerch == 1) && (0 < $goods['merchid'])) {
                $merch_user = pdo_fetch('select * from ' . MerchUser::TABLE_NAME
                    . ' where id=:id limit 1',
                    array(':id' => (int)$goods['merchid']));
                if (!(empty($merch_user))) {
                    $shop = $merch_user;
                    $merch_flag = 1;
                }
            }
            if ($merch_flag == 1) {
                $shopdetail = array(
                    'logo' => (!(empty($goods['detail_logo'])) ? tomedia($goods['detail_logo']) : tomedia($shop['logo'])),
                    'shopname' => (!(empty($goods['detail_shopname'])) ? $goods['detail_shopname'] : $shop['merchname']),
                    'description' => (!(empty($goods['detail_totaltitle'])) ? $goods['detail_totaltitle'] : $shop['desc']),
                    'btntext1' => trim($goods['detail_btntext1']),
                    'btnurl1' => (!(empty($goods['detail_btnurl1'])) ? $goods['detail_btnurl1'] : mobileUrl('goods')),
                    'btntext2' => trim($goods['detail_btntext2']),
                    'btnurl2' => (!(empty($goods['detail_btnurl2'])) ? $goods['detail_btnurl2'] : mobileUrl('merch',
                        array('merchid' => $goods['merchid'])))
                );
            } else {
                $shopdetail = array(
                    'logo' => (!(empty($goods['detail_logo'])) ? tomedia($goods['detail_logo']) : $shop['logo']),
                    'shopname' => (!(empty($goods['detail_shopname'])) ? $goods['detail_shopname'] : $shop['name']),
                    'description' => (!(empty($goods['detail_totaltitle'])) ? $goods['detail_totaltitle'] : $shop['desc']),
                    'btntext1' => trim($goods['detail_btntext1']),
                    'btnurl1' => (!(empty($goods['detail_btnurl1'])) ? $goods['detail_btnurl1'] : mobileUrl('goods')),
                    'btntext2' => trim($goods['detail_btntext2']),
                    'btnurl2' => (!(empty($goods['detail_btnurl2'])) ? $goods['detail_btnurl2'] : $shop['url'])
                );
            }
            $param = array(':uniacid' => $_W['uniacid']);
            if ($merch_flag == 1) {
                $sqlcon = ' and merchid=:merchid';
                $param[':merchid'] = $goods['merchid'];
            }
            if (empty($shop['selectgoods'])) {
                $statics = array(
                    'all' => pdo_fetchcolumn('select count(1) from ' . Goods::TABLE_NAME
                        . ' where uniacid=:uniacid ' . $sqlcon . ' and status=1 and deleted=0',
                        $param),
                    'new' => pdo_fetchcolumn('select count(1) from ' . Goods::TABLE_NAME
                        . ' where uniacid=:uniacid ' . $sqlcon . ' and isnew=1 and status=1 and deleted=0',
                        $param),
                    'discount' => pdo_fetchcolumn('select count(1) from ' . Goods::TABLE_NAME
                        . ' where uniacid=:uniacid ' . $sqlcon . ' and isdiscount=1 and status=1 and deleted=0',
                        $param)
                );
            } else {
                $goodsids = explode(',', $shop['goodsids']);
                $goodsids = array_filter($goodsids);
                $shop['goodsids'] = implode(',', $goodsids);
                $statics = array(
                    'all' => count($goodsids),
                    'new' => pdo_fetchcolumn('select count(1) from ' . Goods::TABLE_NAME
                        . ' where uniacid=:uniacid ' . $sqlcon . ' and id in(' . $shop['goodsids'] . ')
                                and isnew=1 and status=1 and deleted=0',
                        $param),
                    'discount' => pdo_fetchcolumn('select count(1) from ' . Goods::TABLE_NAME
                        . ' where uniacid=:uniacid ' . $sqlcon . ' and id in(' . $shop['goodsids'] . ')
                                and isdiscount=1 and status=1 and deleted=0',
                        $param)
                );
            }
        } elseif ($goods['checked'] == 1) {
            $err = true;
            include $this->template();
            exit();
        } else {
            $shop = $this->merch_user;
            $shopdetail = array(
                'logo' => (!(empty($goods['detail_logo'])) ? tomedia($goods['detail_logo']) : tomedia($shop['logo'])),
                'shopname' => (!(empty($goods['detail_shopname'])) ? $goods['detail_shopname'] : $shop['merchname']),
                'description' => (!(empty($goods['detail_totaltitle'])) ? $goods['detail_totaltitle'] : $shop['desc']),
                'btntext1' => trim($goods['detail_btntext1']),
                'btnurl1' => (!(empty($goods['detail_btnurl1'])) ? $goods['detail_btnurl1'] : mobileUrl('goods')),
                'btntext2' => trim($goods['detail_btntext2']),
                'btnurl2' => (!(empty($goods['detail_btnurl2'])) ? $goods['detail_btnurl2'] : mobileUrl('merch',
                    array('merchid' => $goods['merchid'])))
            );
            if (empty($shop['selectgoods'])) {
                $statics = array(
                    'all' => pdo_fetchcolumn('select count(1) from ' . Goods::TABLE_NAME
                        . ' where uniacid=:uniacid and merchid=:merchid and status=1 and deleted=0',
                        array(':uniacid' => $_W['uniacid'], ':merchid' => $goods['merchid'])),
                    'new' => pdo_fetchcolumn('select count(1) from ' . Goods::TABLE_NAME
                        . ' where uniacid=:uniacid and merchid=:merchid and isnew=1 and status=1 and deleted=0',
                        array(':uniacid' => $_W['uniacid'], ':merchid' => $goods['merchid'])),
                    'discount' => pdo_fetchcolumn('select count(1) from ' . Goods::TABLE_NAME
                        . ' where uniacid=:uniacid and merchid=:merchid and isdiscount=1 and status=1 and deleted=0',
                        array(':uniacid' => $_W['uniacid'], ':merchid' => $goods['merchid']))
                );
            } else {
                $goodsids = explode(',', $shop['goodsids']);
                $statics = array(
                    'all' => count($goodsids),
                    'new' => pdo_fetchcolumn('select count(1) from ' . Goods::TABLE_NAME
                        . ' where uniacid=:uniacid and merchid=:merchid and id in( ' . $shop['goodsids'] . ' )
                                and isnew=1 and status=1 and deleted=0',
                        array(':uniacid' => $_W['uniacid'], ':merchid' => $goods['merchid'])),
                    'discount' => pdo_fetchcolumn('select count(1) from ' . Goods::TABLE_NAME
                        . ' where uniacid=:uniacid and merchid=:merchid and id in( ' . $shop['goodsids'] . ' )
                                and isdiscount=1 and status=1 and deleted=0',
                        array(':uniacid' => $_W['uniacid'], ':merchid' => $goods['merchid']))
                );
            }
        }
        $goodsdesc = ((!(empty($goods['description'])) ? $goods['description'] : $goods['subtitle']));
        $_W['shopshare'] = array(
            'title' => (!(empty($goods['share_title'])) ? $goods['share_title'] : $goods['title']),
            'imgUrl' => (!(empty($goods['share_icon'])) ? tomedia($goods['share_icon']) : tomedia($goods['thumb'])),
            'desc' => (!(empty($goodsdesc)) ? $goodsdesc : $_W['shopset']['shop']['name']),
            'link' => mobileUrl('goods/detail', array('id' => $goods['id']), true)
        );
        $com = p('commission');
        if ($com) {
            $cset = $_W['shopset']['commission'];
            if (!(empty($cset))) {
                if (($member['isagent'] == 1) && ($member['status'] == 1)) {
                    $_W['shopshare']['link'] = mobileUrl('goods/detail',
                        array('id' => $goods['id'], 'mid' => $member['id']), true);
                } elseif (!(empty($_GPC['mid']))) {
                    $_W['shopshare']['link'] = mobileUrl('goods/detail',
                        array('id' => $goods['id'], 'mid' => $_GPC['mid']), true);
                }
            }
            if ($goods['nocommission'] == 0) {
                $glevel = $this->getLevel($openid);
                $goods['seecommission'] = $this->getCommission($goods, $glevel, $cset);
            } else {
                $goods['seecommission'] = 0;
            }
            $goods['cansee'] = $cset['cansee'];
            $goods['seetitle'] = $cset['seetitle'];
        } else {
            $goods['cansee'] = 0;
        }
        $stores = array();

        if ($goods['isverify'] == 2) {
            $storeids = array();
            if (!(empty($goods['storeids']))) {
                $storeids = array_merge(explode(',', $goods['storeids']), $storeids);
            }
            if (empty($storeids)) {
                if (0 < $merchid) {
                    $stores = pdo_fetchall('select * from ' . MerchStore::TABLE_NAME
                        . ' where  uniacid=:uniacid and merchid=:merchid and status=1 and type in(2,3)
                                order by displayorder desc,id desc',
                        array(':uniacid' => $_W['uniacid'], ':merchid' => $merchid));
                } else {
                    $stores = pdo_fetchall('select * from ' . Store::TABLE_NAME
                        . ' where  uniacid=:uniacid and status=1 and type in(2,3) order by displayorder desc,id desc',
                        array(':uniacid' => $_W['uniacid']));
                }
            } elseif (0 < $merchid) {
                $stores = pdo_fetchall('select * from ' . MerchStore::TABLE_NAME
                    . ' where id in (' . implode(',', $storeids) . ') and uniacid=:uniacid and merchid=:merchid
                            and status=1 and type in(2,3) order by displayorder desc,id desc',
                    array(':uniacid' => $_W['uniacid'], ':merchid' => $merchid));
            } else {
                $stores = pdo_fetchall('select * from ' . Store::TABLE_NAME
                    . ' where id in (' . implode(',', $storeids) . ') and uniacid=:uniacid
                            and status=1 and type in(2,3) order by displayorder desc,id desc',
                    array(':uniacid' => $_W['uniacid']));
            }
        }

        $share = m('common')->getSysset('share');
        $share['goods_detail_text'] = nl2br($share['goods_detail_text']);
        if (p('ccard') && ($goods['type'] == 20)) {
            $diyformhtml = '';
            $diyform_plugin = p('diyform');
            if ($diyform_plugin) {
                $fields = false;
                if ($goods['diyformtype'] == 1) {
                    if (!(empty($goods['diyformid']))) {
                        $diyformid = $goods['diyformid'];
                        $formInfo = $diyform_plugin->getDiyformInfo($diyformid);
                        $fields = $formInfo['fields'];
                    }
                } elseif ($goods['diyformtype'] == 2) {
                    $diyformid = 0;
                    $fields = iunserializer($goods['diyfields']);
                    if (empty($fields)) {
                        $fields = false;
                    }
                }
                if (!(empty($fields))) {
                    ob_start();
                    $inPicker = true;
                    $openid = $_W['openid'];
                    $member = m('member')->getMember($openid, true);
                    $f_data = $diyform_plugin->getLastData(3, 0, $diyformid, $id, $fields, $member);
                    $flag = 0;
                    if (!(empty($f_data))) {
                        foreach ($f_data as $k => $v) {
                            while (!(empty($v))) {
                                $flag = 1;
                                break;
                            }
                        }
                    }
                    if (empty($flag)) {
                        $f_data = $diyform_plugin->getLastCartData($id);
                    }
                    $f_data['diychongzhijine'] = $goods['minprice'];
                    include $this->template('ccard/formfields');
                    $diyformhtml = ob_get_contents();
                    ob_clean();
                }
            }
            include $this->template('ccard/ccard_detail');
            exit();
        }
        if (p('ccard') && !(empty($commission_data['become_goodsid']))
            && ($commission_data['become_goodsid'] == $goods['id'])) {
            include $this->template('ccard/cmember_detail');
            exit();
        }
        $new_temp = ((!(is_mobile()) ? 1 : (int)$_W['shopset']['template']['detail_temp']));

        if ($new_temp && $getComments) {
            $showComments = pdo_fetchcolumn('select count(*) from ' . OrderComment::TABLE_NAME
                . ' where goodsid=:goodsid and level>=0 and deleted=0 and checked=0 and uniacid=:uniacid',
                array(':goodsid' => $id, ':uniacid' => $_W['uniacid']));
        }
        $close_preview = (int)$_W['shopset']['shop']['close_preview'];
        $goods['city_express_state'] = 1;
        $city_express = pdo_fetch('SELECT * FROM ' . CityExpress::TABLE_NAME
            . ' WHERE uniacid=:uniacid and merchid=0 limit 1',
            array(':uniacid' => $_W['uniacid']));
        if (empty($city_express) || ($city_express['enabled'] == 0)
            || (0 < $goods['merchid']) || ($goods['type'] != 1)) {
            $goods['city_express_state'] = 0;
        } elseif (empty($city_express['is_dispatch'])) {
            $goods['dispatchprice'] = array('min' => $city_express['start_fee'], 'max' => $city_express['fixed_fee']);
        }
        $plugin_diypage = p('diypage');

        if ($plugin_diypage) {
            $diypage = $plugin_diypage->detailPage($goods['diypage']);
            if ($diypage) {
                $startadv = $plugin_diypage->getStartAdv($diypage['diyadv']);

                include $this->template('diypage/detail');
                exit();
            }
        }

        //修复后台配置了商品底部固定图片不展示bug
        $buttonFixedImageSetting = m('common')->getGoodsBottomFixedImageSetting();
        if (empty($goods['merchid']) && $buttonFixedImageSetting['shopStatus']) {
            $goods['bottomFixedImageUrls'] = empty($buttonFixedImageSetting['urls'])
                ? array() : $buttonFixedImageSetting['urls'];
        } else {
            if ($goods['merchid'] != 0 && $buttonFixedImageSetting['merchStatus']) {
                $goods['bottomFixedImageUrls'] = empty($buttonFixedImageSetting['urls'])
                    ? array() : $buttonFixedImageSetting['urls'];
            } else {
                $goods['bottomFixedImageUrls'] = array();
            }
        }
        include $this->template();
    }


    public function get_code()
    {
        global $_W;
        global $_GPC;
        $id = (int)$_GPC['id'];
        $uniacid = (int)$_W['uniacid'];
        $openid = trim($_W['openid']);
        $goods = pdo_fetch('select id,minprice,minprice,maxprice,thumb_url,thumb,title
                from ' . Goods::TABLE_NAME . ' where id=:id and uniacid=:uniacid limit 1',
            array(':id' => $id, ':uniacid' => $_W['uniacid']));
        $member = m('member')->getMember($openid);
        $commission_data = m('common')->getPluginset('commission');
        $goodscode = '';
        $parameter = array();
        if (com('goodscode')) {
            if ($goods['minprice'] == $goods['maxprice']) {
                $price = '¥' . $goods['minprice'];
            } else {
                $price = '¥' . $goods['minprice'] . ' ~ ' . $goods['maxprice'];
            }
            $goods['thumb_url'] = array_values(unserialize($goods['thumb_url']));
            $goods['thumb'] = $goods['thumb_url'][0];
            $url = mobileUrl('goods/detail', array('id' => $id, 'mid' => $member['id']), true);
            $qrcode = m('qrcode')->createQrcode($url);
            if ($commission_data['codeShare'] == 1) {
                $title[0] = mb_substr($goods['title'], 0, 10, 'utf-8');
                $title[1] = mb_substr($goods['title'], 10, 10, 'utf-8');
                $title = '    ' . $title[0] . "\r\n" . '    ' . $title[1];
                $codedata = array(
                    'portrait' => array(
                        'thumb' => (tomedia($_W['shopset']['shop']['logo'])
                            ? tomedia($_W['shopset']['shop']['logo']) : tomedia($member['avatar'])),
                        'left' => 40,
                        'top' => 40,
                        'width' => 100,
                        'height' => 100
                    ),
                    'shopname' => array(
                        'text' => $_W['shopset']['shop']['name'],
                        'left' => 160,
                        'top' => 80,
                        'size' => 28,
                        'width' => 360,
                        'height' => 50,
                        'color' => '#333'
                    ),
                    'thumb' => array(
                        'thumb' => tomedia($goods['thumb']),
                        'left' => 40,
                        'top' => 160,
                        'width' => 560,
                        'height' => 560
                    ),
                    'qrcode' => array(
                        'thumb' => tomedia($qrcode),
                        'left' => 23,
                        'top' => 730,
                        'width' => 220,
                        'height' => 220
                    ),
                    'title' => array(
                        'text' => $title,
                        'left' => 230,
                        'top' => 770,
                        'size' => 24,
                        'width' => 360,
                        'height' => 50,
                        'color' => '#333'
                    ),
                    'price' => array('text' => $price, 'left' => 270, 'top' => 880, 'size' => 30, 'color' => '#f20'),
                    'desc' => array(
                        'text' => '长按二维码扫码购买',
                        'left' => 210,
                        'top' => 980,
                        'size' => 18,
                        'color' => '#666'
                    )
                );
            } elseif ($commission_data['codeShare'] == 2) {
                $title[0] = mb_substr($goods['title'], 0, 14, 'utf-8');
                $title[1] = mb_substr($goods['title'], 14, 14, 'utf-8');
                $title = '    ' . $title[0] . "\r\n" . '    ' . $title[1];
                $codedata = array(
                    'thumb' => array(
                        'thumb' => tomedia($goods['thumb']),
                        'left' => 20,
                        'top' => 20,
                        'width' => 150,
                        'height' => 150
                    ),
                    'title' => array(
                        'text' => $title,
                        'left' => 170,
                        'top' => 30,
                        'size' => 22,
                        'width' => 430,
                        'height' => 90,
                        'color' => '#333'
                    ),
                    'price' => array('text' => $price, 'left' => 210, 'top' => 120, 'size' => 30, 'color' => '#f20'),
                    'qrcode' => array(
                        'thumb' => tomedia($qrcode),
                        'left' => 170,
                        'top' => 200,
                        'width' => 300,
                        'height' => 300
                    ),
                    'desc' => array(
                        'text' => '长按二维码扫码购买',
                        'left' => 205,
                        'top' => 510,
                        'size' => 18,
                        'color' => '#666'
                    ),
                    'shopname' => array(
                        'text' => $_W['shopset']['shop']['name'],
                        'left' => 0,
                        'top' => 585,
                        'size' => 28,
                        'width' => 640,
                        'height' => 50,
                        'color' => '#fff'
                    )
                );
            } elseif ($commission_data['codeShare'] == 3) {
                $title[0] = mb_substr($goods['title'], 0, 12, 'utf-8');
                $title[1] = mb_substr($goods['title'], 12, 12, 'utf-8');
                $title = '                ' . $title[0] . "\r\n" . '                ' . $title[1];
                $codedata = array(
                    'title' => array(
                        'text' => $title,
                        'left' => 27,
                        'top' => 40,
                        'size' => 22,
                        'width' => 600,
                        'height' => 90,
                        'color' => '#333'
                    ),
                    'thumb' => array(
                        'thumb' => tomedia($goods['thumb']),
                        'left' => 0,
                        'top' => 150,
                        'width' => 640,
                        'height' => 640
                    ),
                    'qrcode' => array(
                        'thumb' => tomedia($qrcode),
                        'left' => 20,
                        'top' => 810,
                        'width' => 220,
                        'height' => 220
                    ),
                    'price' => array('text' => $price, 'left' => 280, 'top' => 870, 'size' => 30, 'color' => '#000'),
                    'desc' => array(
                        'text' => '长按二维码扫码购买',
                        'left' => 280,
                        'top' => 950,
                        'size' => 18,
                        'color' => '#666'
                    )
                );
            }
            $parameter = array(
                'goodsid' => $id,
                'qrcode' => $qrcode,
                'codedata' => $codedata,
                'mid' => $member['id'],
                'codeshare' => $commission_data['codeShare']
            );
            $goodscode = com('goodscode')->createcode($parameter);
        } else {
            if ($goods['minprice'] == $goods['maxprice']) {
                $price = '¥' . $goods['minprice'];
            } else {
                $price = '¥' . $goods['minprice'] . ' ~ ' . $goods['maxprice'];
            }
            $url = mobileUrl('goods/detail', array('id' => $id, 'mid' => $member['id']), true);
            $qrcode = m('qrcode')->createQrcode($url);
            if ($commission_data['codeShare'] == 1) {
                $title[0] = mb_substr($goods['title'], 0, 10, 'utf-8');
                $title[1] = mb_substr($goods['title'], 10, 10, 'utf-8');
                $title = '    ' . $title[0] . "\r\n" . '    ' . $title[1];
                $codedata = array(
                    'portrait' => array(
                        'thumb' => (tomedia($_W['shopset']['shop']['logo'])
                            ? tomedia($_W['shopset']['shop']['logo']) : tomedia($member['avatar'])),
                        'left' => 40,
                        'top' => 40,
                        'width' => 100,
                        'height' => 100
                    ),
                    'shopname' => array(
                        'text' => $_W['shopset']['shop']['name'],
                        'left' => 160,
                        'top' => 80,
                        'size' => 28,
                        'width' => 360,
                        'height' => 50,
                        'color' => '#333'
                    ),
                    'thumb' => array(
                        'thumb' => tomedia($goods['thumb']),
                        'left' => 40,
                        'top' => 160,
                        'width' => 560,
                        'height' => 560
                    ),
                    'qrcode' => array(
                        'thumb' => tomedia($qrcode),
                        'left' => 23,
                        'top' => 730,
                        'width' => 220,
                        'height' => 220
                    ),
                    'title' => array(
                        'text' => $title,
                        'left' => 230,
                        'top' => 770,
                        'size' => 24,
                        'width' => 360,
                        'height' => 50,
                        'color' => '#333'
                    ),
                    'price' => array('text' => $price, 'left' => 270, 'top' => 880, 'size' => 30, 'color' => '#f20'),
                    'desc' => array(
                        'text' => '长按二维码扫码购买',
                        'left' => 210,
                        'top' => 980,
                        'size' => 18,
                        'color' => '#666'
                    )
                );
            } elseif ($commission_data['codeShare'] == 2) {
                $title[0] = mb_substr($goods['title'], 0, 14, 'utf-8');
                $title[1] = mb_substr($goods['title'], 14, 14, 'utf-8');
                $title = '    ' . $title[0] . "\r\n" . '    ' . $title[1];
                $codedata = array(
                    'thumb' => array(
                        'thumb' => tomedia($goods['thumb']),
                        'left' => 20,
                        'top' => 20,
                        'width' => 150,
                        'height' => 150
                    ),
                    'title' => array(
                        'text' => $title,
                        'left' => 170,
                        'top' => 30,
                        'size' => 22,
                        'width' => 430,
                        'height' => 90,
                        'color' => '#333'
                    ),
                    'price' => array('text' => $price, 'left' => 210, 'top' => 120, 'size' => 30, 'color' => '#f20'),
                    'qrcode' => array(
                        'thumb' => tomedia($qrcode),
                        'left' => 170,
                        'top' => 200,
                        'width' => 300,
                        'height' => 300
                    ),
                    'desc' => array(
                        'text' => '长按二维码扫码购买',
                        'left' => 205,
                        'top' => 510,
                        'size' => 18,
                        'color' => '#666'
                    ),
                    'shopname' => array(
                        'text' => $_W['shopset']['shop']['name'],
                        'left' => 0,
                        'top' => 585,
                        'size' => 28,
                        'width' => 640,
                        'height' => 50,
                        'color' => '#fff'
                    )
                );
            }
            $parameter = array(
                'goodsid' => $id,
                'qrcode' => $qrcode,
                'codedata' => $codedata,
                'mid' => $member['id'],
                'codeshare' => $commission_data['codeShare']
            );
            $goodscode = m('goods')->createcode($parameter);
        }
        return $goodscode;
    }

    public function querygift()
    {
        global $_W;
        global $_GPC;
        $uniacid = $_W['uniacid'];
        $giftid = $_GPC['id'];
        $gift = pdo_fetch('select * from ' . Gift::TABLE_NAME
            . ' where uniacid = ' . $uniacid . ' and status = 1 and id = ' . $giftid . ' ');
        show_json(1, $gift);
    }

    protected function getGoodsDispatchPrice($goods, $is_seckill = false)
    {
        if (!(empty($goods['issendfree'])) && empty($is_seckill)) {
            return 0;
        }
        if (($goods['type'] == 2) || ($goods['type'] == 3) || ($goods['type'] == 20)) {
            return 0;
        }
        if ($goods['dispatchtype'] == 1) {
            return $goods['dispatchprice'];
        }
        if (empty($goods['dispatchid'])) {
            $dispatch = m('dispatch')->getDefaultDispatch($goods['merchid']);
        } else {
            $dispatch = m('dispatch')->getOneDispatch($goods['dispatchid']);
        }
        if (empty($dispatch)) {
            $dispatch = m('dispatch')->getNewDispatch($goods['merchid']);
        }
        $areas = iunserializer($dispatch['areas']);
        if (!(empty($areas)) && is_array($areas)) {
            $firstprice = array();
            foreach ($areas as $val) {
                if (empty($dispatch['calculatetype'])) {
                    $firstprice[] = $val['firstprice'];
                } else {
                    $firstprice[] = $val['firstnumprice'];
                }
            }
            array_push($firstprice, m('dispatch')->getDispatchPrice(1, $dispatch));
            $ret = array('min' => round(min($firstprice), 2), 'max' => round(max($firstprice), 2));
        } else {
            $ret = m('dispatch')->getDispatchPrice(1, $dispatch);
        }
        return $ret;
    }

    public function get_detail()
    {
        global $_W;
        global $_GPC;
        $id = (int)$_GPC['id'];
        $goods = pdo_fetch('select * from ' . Goods::TABLE_NAME
            . ' where id=:id and uniacid=:uniacid limit 1',
            array(':id' => $id, ':uniacid' => $_W['uniacid']));
        ExceptionUtil::exit(m('ui')->lazy($goods['content']));
    }

    public function get_comments()
    {
        global $_W;
        global $_GPC;
        $id = (int)$_GPC['id'];
        $percent = 100;
        $params = array(':goodsid' => $id, ':uniacid' => $_W['uniacid']);
        $count = array(
            'all' => pdo_fetchcolumn('select count(*) from ' . OrderComment::TABLE_NAME
                . ' where goodsid=:goodsid and level>=0 and deleted=0 and checked=0 and uniacid=:uniacid',
                $params),
            'good' => pdo_fetchcolumn('select count(*) from ' . OrderComment::TABLE_NAME
                . ' where goodsid=:goodsid and level>=5 and deleted=0 and checked=0 and uniacid=:uniacid',
                $params),
            'normal' => pdo_fetchcolumn('select count(*) from ' . OrderComment::TABLE_NAME
                . ' where goodsid=:goodsid and level>=2 and level<=4 and deleted=0 and checked=0 and uniacid=:uniacid',
                $params),
            'bad' => pdo_fetchcolumn('select count(*) from ' . OrderComment::TABLE_NAME
                . ' where goodsid=:goodsid and level<=1 and deleted=0 and checked=0 and uniacid=:uniacid',
                $params),
            'pic' => pdo_fetchcolumn('select count(*) from ' . OrderComment::TABLE_NAME
                . ' where goodsid=:goodsid and ifnull(images,\'a:0:{}\')<>\'a:0:{}\' and deleted=0 and checked=0
                        and uniacid=:uniacid',
                $params)
        );
        $list = array();
        if (0 < $count['all']) {
            $percent = (int)(($count['good'] / ((empty($count['all']) ? 1 : $count['all']))) * 100);
            $list = pdo_fetchall('select nickname,level,content,images,createtime
                    from ' . OrderComment::TABLE_NAME
                . ' where goodsid=:goodsid and deleted=0 and checked=0 and uniacid=:uniacid
                        order by istop desc, createtime desc, id desc limit 2',
                array(':goodsid' => $id, ':uniacid' => $_W['uniacid']));
            foreach ($list as &$row) {
                $row['createtime'] = date('Y-m-d H:i', $row['createtime']);
                $row['images'] = set_medias(iunserializer($row['images']));
                $row['nickname'] = cut_str($row['nickname'], 1, 0) . '**'
                    . cut_str($row['nickname'], 1, -1);
            }
            unset($row);
        }
        show_json(1, array('count' => $count, 'percent' => $percent, 'list' => $list));
    }

    public function getCommission($goods, $level, $set)
    {
        global $_W;
        $commission = 0;
        if ($set['calcutype'] == 2) {
            //如果按商品售价计算佣金
            $goods['marketprice'] -= $goods['costprice'];
        }
        //如果不是分销商
        if ($level == 'false') {
            return $commission;
        }
        //如果商品有参与分销
        if ($goods['hascommission'] == 1) {
            $price = $goods['maxprice'];  //多规格中最大价格，无规格时显示销售价
            $levelid = 'default';
            if ($level) {
                $levelid = 'level' . $level['id'];
            }
            $goods_commission = ((!(empty($goods['commission'])) ? json_decode($goods['commission'], true) : ''));
            if ($goods_commission['type'] == 0) {
                $commission = ((1 <= $set['level']
                    ? ((0 < $goods['commission1_rate']
                        ? ($goods['commission1_rate'] * $goods['marketprice']) / 100 : $goods['commission1_pay']))
                    : 0));
            } else {
                $price_all = array();
                foreach ($goods_commission[$levelid] as $key => $value) {
                    foreach ($value as $k => $v) {
                        if (strexists($v, '%')) {
                            $price_all[] = (float)(str_replace('%', '', $v) / 100) * $price;
                            continue;
                        }
                        $price_all[] = $v;
                    }
                }
                $commission = max($price_all);
            }
        } elseif (($level != 'false') && !(empty($level))) {
            $commission = ((1 <= $set['level']
                ? round(($level['commission1'] * $goods['marketprice']) / 100, 2) : 0));
        } else {
            $commission = ((1 <= $set['level']
                ? round(($set['commission1'] * $goods['marketprice']) / 100, 2) : 0));
        }
        return $commission;
    }

    /*
     *获取会员分销等级
     *
     **/
    public function getLevel($openid)
    {
        global $_W;
        $level = 'false';
        if (empty($openid)) {
            return $level;
        }
        $member = m('member')->getMember($openid);
        if (empty($member['isagent']) || ($member['status'] == 0) || ($member['agentblack'] == 1)) {
            return $level;
        }
        $level = pdo_fetch('select * from ' . CommissionLevel::TABLE_NAME
            . ' where uniacid=:uniacid and id=:id limit 1',
            array(':uniacid' => $_W['uniacid'], ':id' => $member['agentlevel']));
        return $level;
    }

    public function get_offic_list()
    {
        global $_W;
        global $_GPC;
        $id = (int)$_GPC['id'];
        $type = (int)$_GPC['type'];
        $openid = trim($_W['openid']);
        $params = array(':goodsid' => $id, ':uniacid' => $_W['uniacid']);
        $pindex = max(1, (int)$_GPC['page']);
        $psize = 10;
        $condition = ' and o.uniacid = :uniacid and o.goodsid = :goodsid and o.enabled = 1 ';
        if (0 < $type) {
            $condition .= ' and o.openid = :openid ';
            $params[':openid'] = $openid;
        } else {
            $condition .= ' and o.chosen = 1 ';
        }
        $total = pdo_fetchcolumn('select count(1) from ' . Offic::TABLE_NAME . ' as o
                where 1 ' . $condition,
            $params);
        $list = array();
        if (0 < $total) {
            $list = pdo_fetchall('SELECT o.*,m.avatar,m.nickname,g.thumb,g.title,g.minprice
                    FROM ' . Offic::TABLE_NAME . ' as o
                        left join ' .Member::TABLE_NAME . ' as m on m.openid = o.openid
                        left join ' . Goods::TABLE_NAME . ' as g on g.id = o.goodsid
                    where 1 ' . $condition . ' group by o.id
                        order by o.displayorder desc, o.createtime desc, o.id desc
                    LIMIT ' . (($pindex - 1) * $psize) . ',' . $psize,
                $params);
            $list = set_medias($list, 'avatar,thumb');
            foreach ($list as &$row) {
                if (empty($row['openid']) && empty($row['avatar'])) {
                    $row['avatar'] = $_W['shopset']['shop']['logo'];
                    $row['nickname'] = $_W['shopset']['shop']['name'];
                }
                $row['images'] = unserialize($row['images']);
                $row['images'] = set_medias($row['images']);
                $row['createtime'] = date('Y-m-d H:i', $row['createtime']);
            }
            unset($row);
        }
        show_json(1, array('officlist' => $list, 'total' => $total, 'pagesize' => $psize));
    }

    public function get_comment_list()
    {
        global $_W;
        global $_GPC;
        $id = (int)$_GPC['id'];
        $level = trim($_GPC['level']);
        $params = array(':goodsid' => $id, ':uniacid' => $_W['uniacid']);
        $pindex = max(1, (int)$_GPC['page']);
        $psize = 10;
        $condition = '';
        if ($level == 'good') {
            $condition = ' and level=5';
        } elseif ($level == 'normal') {
            $condition = ' and level>=2 and level<=4';
        } elseif ($level == 'bad') {
            $condition = ' and level<=1';
        } elseif ($level == 'pic') {
            $condition = ' and ifnull(images,\'a:0:{}\')<>\'a:0:{}\'';
        }
        $list = pdo_fetchall('select * from ' . OrderComment::TABLE_NAME . ' '
            . '  where goodsid=:goodsid and uniacid=:uniacid and deleted=0 and checked=0 ' . $condition
            . ' order by istop desc, createtime desc, id desc LIMIT ' . (($pindex - 1) * $psize) . ',' . $psize,
            $params);
        foreach ($list as &$row) {
            $row['headimgurl'] = tomedia($row['headimgurl']);
            $row['createtime'] = date('Y-m-d H:i', $row['createtime']);
            $row['images'] = set_medias(iunserializer($row['images']));
            $row['reply_images'] = set_medias(iunserializer($row['reply_images']));
            $row['append_images'] = set_medias(iunserializer($row['append_images']));
            $row['append_reply_images'] = set_medias(iunserializer($row['append_reply_images']));
            $row['nickname'] = cut_str($row['nickname'], 1, 0) . '**' . cut_str($row['nickname'], 1, -1);
        }
        unset($row);
        $total = pdo_fetchcolumn('select count(*) from ' . OrderComment::TABLE_NAME
            . ' where goodsid=:goodsid  and uniacid=:uniacid and deleted=0 and checked=0 ' . $condition,
            $params);
        show_json(1, array('list' => $list, 'total' => $total, 'pagesize' => $psize));
    }

    public function qrcode()
    {
        global $_W;
        global $_GPC;
        $url = $_W['root'];
        show_json(1, array('url' => m('qrcode')->createQrcode($url)));
    }

    protected function merchData()
    {
        $merch_plugin = p('merch');
        $merch_data = m('common')->getPluginset('merch');
        if ($merch_plugin && $merch_data['is_openmerch']) {
            $is_openmerch = 1;
        } else {
            $is_openmerch = 0;
        }
        return array('is_openmerch' => $is_openmerch, 'merch_plugin' => $merch_plugin, 'merch_data' => $merch_data);
    }

    public function getCouponsbygood($goodid)
    {
        global $_W;
        global $_GPC;
        $merchdata = $this->merchData();
        extract($merchdata);
        $time = time();
        $param = array();
        $param[':uniacid'] = $_W['uniacid'];
        $sql = 'select id,timelimit,coupontype,timedays,timestart,timeend,thumb,couponname,enough,backtype,deduct,
                    discount,backmoney,backcredit,backredpack,bgcolor,thumb,credit,money,getmax,merchid,total as t,
                    islimitlevel,limitmemberlevels,limitagentlevels,limitpartnerlevels,limitaagentlevels,
                    limitgoodcatetype,limitgoodcateids,limitgoodtype,limitgoodids,tagtitle,settitlecolor,titlecolor
                from ' . \Ydb\Entity\Manual\Coupon::TABLE_NAME . ' c
                where uniacid=:uniacid and money=0 and credit = 0 and coupontype=0';
        if ($is_openmerch == 0) {
            $sql .= ' and merchid=0';
        } elseif (!(empty($_GPC['merchid']))) {
            $sql .= ' and merchid=:merchid';
            $param[':merchid'] = (int)$_GPC['merchid'];
        } else {
            $sql .= ' and merchid=0';
        }
        $hascommission = false;
        $plugin_com = p('commission');
        if ($plugin_com) {
            $plugin_com_set = $plugin_com->getSet();
            $hascommission = !(empty($plugin_com_set['level']));
            if (empty($plugin_com_set['level'])) {
                $sql .= ' and ( limitagentlevels = "" or  limitagentlevels is null )';
            }
        } else {
            $sql .= ' and ( limitagentlevels = "" or  limitagentlevels is null )';
        }
        $hasglobonus = false;
        $plugin_globonus = p('globonus');
        if ($plugin_globonus) {
            $plugin_globonus_set = $plugin_globonus->getSet();
            $hasglobonus = !(empty($plugin_globonus_set['open']));
            if (empty($plugin_globonus_set['open'])) {
                $sql .= ' and ( limitpartnerlevels = ""  or  limitpartnerlevels is null )';
            }
        } else {
            $sql .= ' and ( limitpartnerlevels = ""  or  limitpartnerlevels is null )';
        }
        $hasabonus = false;
        $plugin_abonus = p('abonus');
        if ($plugin_abonus) {
            $plugin_abonus_set = $plugin_abonus->getSet();
            $hasabonus = !(empty($plugin_abonus_set['open']));
            if (empty($plugin_abonus_set['open'])) {
                $sql .= ' and ( limitaagentlevels = "" or  limitaagentlevels is null )';
            }
        } else {
            $sql .= ' and ( limitaagentlevels = "" or  limitaagentlevels is null )';
        }
        $sql .= ' and gettype=1 and (total=-1 or total>0)
                  and ( timelimit = 0 or  (timelimit=1 and timeend>unix_timestamp()))';
        $sql .= ' order by displayorder desc, id desc  ';
        $list = set_medias(pdo_fetchall($sql, $param), 'thumb');
        if (empty($list)) {
            $list = array();
        }
        if (!(empty($goodid))) {
            $goodparam[':uniacid'] = $_W['uniacid'];
            $goodparam[':id'] = $goodid;
            $sql = 'select id,cates,marketprice,merchid   from ' . Goods::TABLE_NAME;
            $sql .= ' where uniacid=:uniacid and id =:id order by id desc LIMIT 1 ';
            $good = pdo_fetch($sql, $goodparam);
        }
        $cates = explode(',', $good['cates']);
        if (!(empty($list))) {
            foreach ($list as $key => &$row) {
                $row = com('coupon')->setCoupon($row, time());
                $row['thumb'] = tomedia($row['thumb']);
                $row['timestr'] = '永久有效';
                if (empty($row['timelimit'])) {
                    if (!(empty($row['timedays']))) {
                        $row['timestr'] = '自领取日后' . $row['timedays'] . '天有效';
                    }
                } elseif ($time <= $row['timestart']) {
                    $row['timestr'] = '有效期至:' . date('Y-m-d', $row['timestart'])
                        . '-' . date('Y-m-d', $row['timeend']);
                } else {
                    $row['timestr'] = '有效期至:' . date('Y-m-d', $row['timeend']);
                }
                if ($row['backtype'] == 0) {
                    $row['backstr'] = '立减';
                    $row['backmoney'] = (double)$row['deduct'];
                    $row['backpre'] = true;
                    if ($row['enough'] == '0') {
                        $row['color'] = 'org ';
                    } else {
                        $row['color'] = 'blue';
                    }
                } elseif ($row['backtype'] == 1) {
                    $row['backstr'] = '折';
                    $row['backmoney'] = (double)$row['discount'];
                    $row['color'] = 'red ';
                } elseif ($row['backtype'] == 2) {
                    if ($row['coupontype'] == '0') {
                        $row['color'] = 'red ';
                    } else {
                        $row['color'] = 'pink ';
                    }
                    if (0 < $row['backredpack']) {
                        $row['backstr'] = '返现';
                        $row['backmoney'] = (double)$row['backredpack'];
                        $row['backpre'] = true;
                    } elseif (0 < $row['backmoney']) {
                        $row['backstr'] = '返利';
                        $row['backmoney'] = (double)$row['backmoney'];
                        $row['backpre'] = true;
                    } elseif (!(empty($row['backcredit']))) {
                        $row['backstr'] = '返积分';
                        $row['backmoney'] = (double)$row['backcredit'];
                    }
                }
                $limitmemberlevels = explode(',', $row['limitmemberlevels']);
                $limitagentlevels = explode(',', $row['limitagentlevels']);
                $limitpartnerlevels = explode(',', $row['limitpartnerlevels']);
                $limitaagentlevels = explode(',', $row['limitaagentlevels']);
                $p = 0;
                if ($row['islimitlevel'] == 1) {
                    $openid = trim($_W['openid']);
                    $member = m('member')->getMember($openid);
                    if (!(empty($row['limitmemberlevels'])) || ($row['limitmemberlevels'] == '0')) {
                        $level1 = pdo_fetchall('select * from ' . MemberLevel::TABLE_NAME
                            . ' where uniacid=:uniacid and  id in (' . $row['limitmemberlevels'] . ') ',
                            array(':uniacid' => $_W['uniacid']));
                        if (in_array($member['level'], $limitmemberlevels)) {
                            $p = 1;
                        }
                    }
                    if ((!(empty($row['limitagentlevels'])) || ($row['limitagentlevels'] == '0')) && $hascommission) {
                        $level2 = pdo_fetchall('select * from ' . CommissionLevel::TABLE_NAME
                            . ' where uniacid=:uniacid and id  in (' . $row['limitagentlevels'] . ') ',
                            array(':uniacid' => $_W['uniacid']));
                        if (($member['isagent'] == '1') && ($member['status'] == '1')) {
                            if (in_array($member['agentlevel'], $limitagentlevels)) {
                                $p = 1;
                            }
                        }
                    }
                    if ((!(empty($row['limitpartnerlevels'])) || ($row['limitpartnerlevels'] == '0')) && $hasglobonus) {
                        $level3 = pdo_fetchall('select * from ' . GlobonusLevel::TABLE_NAME
                            . ' where uniacid=:uniacid and  id in(' . $row['limitpartnerlevels'] . ') ',
                            array(':uniacid' => $_W['uniacid']));
                        if (($member['ispartner'] == '1') && ($member['partnerstatus'] == '1')) {
                            if (in_array($member['partnerlevel'], $limitpartnerlevels)) {
                                $p = 1;
                            }
                        }
                    }
                    if ((!(empty($row['limitaagentlevels'])) || ($row['limitaagentlevels'] == '0')) && $hasabonus) {
                        $level4 = pdo_fetchall('select * from ' . AbonusLevel::TABLE_NAME
                            . ' where uniacid=:uniacid and  id in (' . $row['limitaagentlevels'] . ') ',
                            array(':uniacid' => $_W['uniacid']));
                        if (($member['isaagent'] == '1') && ($member['aagentstatus'] == '1')
                            && in_array($member['aagentlevel'], $limitaagentlevels)) {
                            $p = 1;
                        }
                    }
                } else {
                    $p = 1;
                }
                if ($p == 1) {
                    $p = 0;
                    $limitcateids = explode(',', $row['limitgoodcateids']);
                    $limitgoodids = explode(',', $row['limitgoodids']);
                    if (($row['limitgoodcatetype'] == 0) && ($row['limitgoodtype'] == 0)) {
                        $p = 1;
                    }
                    if ($row['limitgoodcatetype'] == 1) {
                        $result = array_intersect($cates, $limitcateids);
                        if (0 < count($result)) {
                            $p = 1;
                        }
                    }
                    if ($row['limitgoodtype'] == 1) {
                        $isin = in_array($good['id'], $limitgoodids);
                        if ($isin) {
                            $p = 1;
                        }
                    }
                    if ($p == 0) {
                        unset($list[$key]);
                    }
                } else {
                    unset($list[$key]);
                }
            }
            unset($row);
        }
        return array_values($list);
    }

    public function pay($a = array(), $b = array())
    {
        global $_W;
        global $_GPC;
        $openid = $_W['openid'];
        $id = (int)$_GPC['id'];
        $coupon = pdo_fetch('select * from ' . \Ydb\Entity\Manual\Coupon::TABLE_NAME
            . ' where id=:id and uniacid=:uniacid  limit 1',
            array(':id' => $id, ':uniacid' => $_W['uniacid']));
        $coupon = com('coupon')->setCoupon($coupon, time());
        if (empty($coupon['gettype'])) {
            show_json(-1, '无法' . $coupon['gettypestr']);
        }
        if (($coupon['total'] != -1) && $coupon['total'] <= 0) {
            show_json(-1, '优惠券数量不足');
        }
        if (!($coupon['canget'])) {
            show_json(-1, '您已超出' . $coupon['gettypestr'] . '次数限制');
        }
        if ((0 < $coupon['money']) || (0 < $coupon['credit'])) {
            show_json(-1, '此优惠券需要前往领卷中心兑换');
        }
        $logno = m('common')->createNO('coupon_log', 'logno', 'CC');
        $log = array(
            'uniacid' => $_W['uniacid'],
            'merchid' => $coupon['merchid'],
            'openid' => $openid,
            'logno' => $logno,
            'couponid' => $id,
            'status' => 0,
            'paystatus' => -1,
            'creditstatus' => -1,
            'createtime' => time(),
            'getfrom' => 1
        );
        pdo_insert('ewei_shop_coupon_log', $log);
        $result = com('coupon')->payResult($log['logno']);
        if (is_error($result)) {
            show_json($result['errno'], $result['message']);
        }
        show_json(1,
            array('url' => $result['url'], 'dataid' => $result['dataid'], 'coupontype' => $result['coupontype']));
    }
}
