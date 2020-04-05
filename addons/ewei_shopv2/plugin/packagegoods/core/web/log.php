<?php
if (!(defined('IN_IA')))
{
    exit('Access Denied');
}
class Log_EweiShopV2Page extends PluginWebPage{
    public function main($table='')
    {
        global $_W;
        global $_GPC;

        $type=str_replace('ewei_shop_packagegoods_','',$table);

        $pindex = max(1, intval($_GPC['page']));
        $psize = 20;
        $condition = ' and log.uniacid=:uniacid';
        $condition1 = '';
        $params = array(':uniacid' => $_W['uniacid']);
        if (!(empty($_GPC['keyword'])))
        {
            $_GPC['keyword'] = trim($_GPC['keyword']);
             if ($_GPC['searchfield'] == 'member')
            {
                $condition1 .= ' and (m.realname like :keyword or m.nickname like :keyword or m.mobile like :keyword)';
            }
            $params[':keyword'] = '%' . $_GPC['keyword'] . '%';
        }
        if (empty($starttime) || empty($endtime))
        {
            $starttime = strtotime('-1 month');
            $endtime = time();
        }
        if (!(empty($_GPC['time']['start'])) && !(empty($_GPC['time']['end'])))
        {
            $starttime = strtotime($_GPC['time']['start']);
            $endtime = strtotime($_GPC['time']['end']);
            $condition .= ' AND log.createtime >= :starttime AND log.createtime <= :endtime ';
            $params[':starttime'] = $starttime;
            $params[':endtime'] = $endtime;
        }
        if (!(empty($_GPC['level'])))
        {
            $condition1 .= ' and m.level=' . intval($_GPC['level']);
        }
        if (!(empty($_GPC['groupid'])))
        {
            $condition1 .= ' and m.groupid=' . intval($_GPC['groupid']);
        }
        $member_sql = '';
        if ($condition1 != '')
        {
            $member_sql = ' and openid IN (SELECT openid FROM ' . tablename('ewei_shop_member') . 'm WHERE uniacid = :uniacid ' . $condition1 . ') OR openid IN (SELECT CONCAT(\'sns_wa_\',openid_wa) FROM ' . tablename('ewei_shop_member') . ' m WHERE uniacid = :uniacid ' . $condition1 . ')';
        }
        if($type=='commission_log'){
            $field="log.orderid,log.orderno,log.mid1,log.commission1,log.mid2,log.commission2,log.mid3,log.commission3,log.createtime,log.status,";
            $join_condition=" m on m.openid = log.buy_openid ";
        }else{
            $field="log.orderid,log.orderno,log.bonusmoney,log.createtime,log.status,";
            $join_condition=" m on m.openid = log.openid ";
        }
        $sql = 'select '.$field.'m.nickname,m.id as mid,m.avatar,m.level,m.groupid,m.realname,m.mobile,g.groupname,l.levelname from ' . tablename($table) . ' log ' . ' left join ' . tablename('ewei_shop_member') .$join_condition . ' left join ' . tablename('ewei_shop_member_group') . ' g on g.id = m.groupid ' .   ' left join ' . tablename('ewei_shop_member_level') . ' l on l.id = m.level ' . ' where 1 ' . $condition . ' ' . $condition1 . ' GROUP BY log.id ORDER BY log.createtime DESC ';

        if (empty($_GPC['export']))
        {
            $sql .= 'LIMIT ' . (($pindex - 1) * $psize) . ',' . $psize;
        }
        $list = pdo_fetchall($sql, $params);

        if (!(empty($list)))
        {
            $openids = array();
            foreach ($list as $key => $value )
            {

                if($value['mid1']){
                    $list[$key]['m1']=m('member')->getInfo($value['mid1']);
                }
                if($value['mid2']){
                    $list[$key]['m2']=m('member')->getInfo($value['mid2']);
                }
                if($value['mid3']){
                    $list[$key]['m3']=m('member')->getInfo($value['mid3']);
                }



                if (!(strexists($value['openid'], 'sns_wa_')))
                {
                    array_push($openids, $value['openid']);
                }
                else
                {
                    array_push($openids, substr($value['openid'], 7));
                }
            }
            $members_sql = 'select id as mid, realname,avatar,weixin,nickname,mobile,openid,openid_wa from ' . tablename('ewei_shop_member') . ' m where uniacid=:uniacid and openid IN (\'' . implode('\',\'', array_unique($openids)) . '\') OR openid_wa IN (\'' . implode('\',\'', array_unique($openids)) . '\')';
            $members = pdo_fetchall($members_sql, array(':uniacid' => $_W['uniacid']), 'openid');
            $rs = array();
            if (!(empty($members)))
            {
                foreach ($members as $key => &$row )
                {
                    if (!(empty($row['openid_wa'])))
                    {
                        $rs['sns_wa_' . $row['openid_wa']] = $row;
                    }
                    else
                    {
                        $rs[] = $row;
                    }
                }
            }
            $member_openids = array_keys($members);
            foreach ($list as $key => $value )
            {
                if (in_array($list[$key]['openid'], $member_openids))
                {
                    $list[$key] = array_merge($list[$key], $members[$list[$key]['openid']]);
                }
                else
                {
                    $list[$key] = array_merge($list[$key], (isset($rs[$list[$key]['openid']]) ? $rs[$list[$key]['openid']] : array()));
                }
            }
        }
        if ($_GPC['export'] == 1)
        {
            foreach ($list as &$row )
            {
                $row['createtime'] = date('Y-m-d H:i', $row['createtime']);
                if($row['mid1']){
                    $row['m1_nickname']=$row['m1']['nickname'];
                }
                if($row['mid2']){
                    $row['m2_nickname']=$row['m2']['nickname'];
                }
                if($row['mid3']){
                    $row['m3_nickname']=$row['m3']['nickname'];
                }
            }
            unset($row);
            $columns = array();
            $columns[] = array('title' => '获佣人', 'field' => 'nickname', 'width' => 12);
            $columns[] = array('title' => '姓名', 'field' => 'realname', 'width' => 12);
            $columns[] = array('title' => '手机号', 'field' => 'mobile', 'width' => 12);
            $columns[] = array('title' => '订单号', 'field' => 'orderno', 'width' => 12);
            $columns[] = array('title' => '获佣金额', 'field' => 'bonusmoney', 'width' => 12);
            $columns[] = array('title' => '生成时间', 'field' => 'createtime', 'width' => 12);
            if($type=='commission_log'){
                $columns = array();
                $columns[] = array('title' => '购买人', 'field' => 'nickname', 'width' => 12);
                $columns[] = array('title' => '姓名', 'field' => 'realname', 'width' => 12);
                $columns[] = array('title' => '手机号', 'field' => 'mobile', 'width' => 12);
                $columns[] = array('title' => '订单号', 'field' => 'orderno', 'width' => 12);
                $columns[] = array('title' => '一级会员昵称', 'field' => 'm1_nickname', 'width' => 12);
                $columns[] = array('title' => '二级会员昵称', 'field' => 'm2_nickname', 'width' => 12);
                $columns[] = array('title' => '三级会员昵称', 'field' => 'm3_nickname', 'width' => 12);
                $columns[] = array('title' => '一级佣金', 'field' => 'commission1', 'width' => 12);
                $columns[] = array('title' => '二级佣金', 'field' => 'commission2', 'width' => 12);
                $columns[] = array('title' => '三级佣金', 'field' => 'commission3', 'width' => 12);
                $columns[] = array('title' => '生成时间', 'field' => 'createtime', 'width' => 12);
                $title="大礼包分销佣金记录";
                plog('packagegoods.log.index.export', '导出大礼包分销佣金记录');
            }else if($type=='globonus_log'){
                $title="大礼包店铺奖励佣金记录";
                plog('packagegoods.log.index.export', '导出大礼包店铺奖励佣金记录');
            }else if($type=='abonus_log'){
                $title="大礼包区域奖励佣金记录";
                plog('packagegoods.log.index.export', '导出大礼包区域奖励佣金记录');
            }else if($type=='achievement_log'){
                $title="大礼包绩效奖励佣金记录";
                plog('packagegoods.log.index.export', '导出大礼包绩效奖励佣金记录');
            }
            m('excel')->export($list, array('title' => $title . date('Y-m-d-H-i', time()), 'columns' => $columns));
        }
        $total = pdo_fetchcolumn('select count(*) from ' . tablename($table) . ' log ' . ' where 1 ' . $condition . ' ' . $member_sql, $params);
        $pager = pagination2($total, $pindex, $psize);
        $groups = m('member')->getGroups();
        $levels = m('member')->getLevels();
        include $this->template('packagegoods/log/index');
    }
    //分销佣金明细
    public function commission_log(){

        $this->main('ewei_shop_packagegoods_commission_log');
    }
    //店铺佣金明细
    public function globonus_log(){

        $this->main('ewei_shop_packagegoods_globonus_log');

    }
    //区域佣金明细
    public function abonus_log(){

        $this->main('ewei_shop_packagegoods_abonus_log');
    }
    //绩效佣金明细
    public function achievement_log(){
        $this->main('ewei_shop_packagegoods_achievement_log');
    }
}
?>