<?php

use Ydb\Entity\Manual\CommissionRelation;
use Ydb\Entity\Manual\DividendInit;
use Ydb\Entity\Manual\Engine\McMappingFans;
use Ydb\Entity\Manual\Member;

if (!defined('IN_IA')) {
    exit('Access Denied');
}

require(EWEI_SHOPV2_PLUGIN . 'dividend/core/dividend_page_web.php');

class Dividend_Agent_EweiShopV2PluginWebPage extends DividendWebPage
{
    public function main()
    {
        global $_W;
        global $_GPC;
        $pindex = max(1, (int)$_GPC['page']);
        $psize = 20;
        $params = array();
        $condition = '';
        $searchfield = 'member';
        $keyword = trim($_GPC['keyword']);
        if (!empty($searchfield) && !empty($keyword) && $searchfield === 'member') {
            $condition .= ' and ( dm.realname like :keyword or dm.nickname like :keyword or dm.mobile like :keyword)';
            $params[':keyword'] = '%' . $keyword . '%';
        }
        if (empty($starttime) || empty($endtime)) {
            $starttime = strtotime('-1 month');
            $endtime = time();
        }
        if (!empty($_GPC['time']['start']) && !empty($_GPC['time']['end'])) {
            $starttime = strtotime($_GPC['time']['start']);
            $endtime = strtotime($_GPC['time']['end']);
            $condition .= ' AND dm.headstime >= :starttime AND dm.headstime <= :endtime ';
            $params[':starttime'] = $starttime;
            $params[':endtime'] = $endtime;
        }
        if ($_GPC['headsstatus'] != '') {
            $condition .= ' and dm.headsstatus=' . (int)$_GPC['status'];
        }
        $sql = '
            select dm.*,dm.nickname,dm.avatar,p.id as pid,p.nickname as parentname,p.avatar as parentavatar
            from ' . Member::TABLE_NAME . ' dm
                left join ' . Member::TABLE_NAME . ' p on p.id = dm.headsid
            where dm.uniacid = ' . $_W['uniacid'] . ' and dm.isagent =1 and dm.isheads = 1 ' . $condition . '
            ORDER BY dm.agenttime desc';
        if (empty($_GPC['export'])) {
            $sql .= ' limit ' . ($pindex - 1) * $psize . ',' . $psize;
        }
        $list = pdo_fetchall($sql, $params);
        $total = pdo_fetchcolumn('
            select count(dm.id)
            from ' . Member::TABLE_NAME . ' dm
                left join ' . Member::TABLE_NAME . ' p on p.id = dm.headsid
            where dm.uniacid =' . $_W['uniacid'] . ' and dm.isagent =1 and dm.isheads = 1 ' . $condition,
            $params);
        foreach ($list as &$row) {
            $info = $this->model->getInfo($row['openid'], array('total', 'pay'));
            $row['groupscount'] = $info['groupscount'];
            $row['credit1'] = m('member')->getCredit($row['openid'], 'credit1');
            $row['credit2'] = m('member')->getCredit($row['openid'], 'credit2');
            $row['dividend_total'] = $info['dividend_total'];
            $row['dividend_pay'] = $info['dividend_pay'];
            if (p('diyform') && !empty($row['diymemberfields']) && !empty($row['diymemberdata'])) {
                $diyformdata_array = p('diyform')->getDatas(iunserializer($row['diymemberfields']),
                    iunserializer($row['diymemberdata']));
                $diyformdata = '';
                foreach ($diyformdata_array as $da) {
                    $diyformdata .= sprintf("%s: %s\r\n", $da['name'], $da['value']);
                }
                $row['member_diyformdata'] = $diyformdata;
            }
            if (p('diyform') && !empty($row['diycommissionfields']) && !empty($row['diycommissiondata'])) {
                $diyformdata_array = p('diyform')->getDatas(iunserializer($row['diycommissionfields']),
                    iunserializer($row['diycommissiondata']));
                $diyformdata = '';
                foreach ($diyformdata_array as $da) {
                    $diyformdata .= sprintf("%s: %s\r\n", $da['name'], $da['value']);
                }
                $row['agent_diyformdata'] = $diyformdata;
            }
        }
        unset($row);
        if ($_GPC['export'] == '1') {
            ca('commission.agent.export');
            plog('commission.agent.export', '导出分销商数据');
            foreach ($list as &$row) {
                $row['createtime'] = date('Y-m-d H:i', $row['createtime']);
                $row['agentime'] = (empty($row['agenttime']) ? '' : date('Y-m-d H:i', $row['agentime']));
                $row['groupname'] = (empty($row['groupname']) ? '无分组' : $row['groupname']);
                $row['levelname'] = (empty($row['levelname']) ? '普通等级' : $row['levelname']);
                $row['parentname'] = (empty($row['pid']) ? '总店' : '[' . $row['agentid'] . ']' . $row['parentname']);
                $row['statusstr'] = (empty($row['status']) ? '未通过' : '通过');
                $row['followstr'] = (empty($row['followed']) ? '' : '已关注');
                $row['realname'] = str_replace('=', '', $row['realname']);
                $row['nickname'] = str_replace('=', '', $row['nickname']);
            }
            unset($row);
            $columns = [
                ['title' => 'ID', 'field' => 'id', 'width' => 12],
                ['title' => '昵称', 'field' => 'nickname', 'width' => 12],
                ['title' => '姓名', 'field' => 'realname', 'width' => 12],
                ['title' => '手机号', 'field' => 'mobile', 'width' => 12],
                ['title' => '微信号', 'field' => 'weixin', 'width' => 12],
                ['title' => 'openid', 'field' => 'openid', 'width' => 24],
                ['title' => '下级团员总数', 'field' => 'levelcount', 'width' => 12],
                ['title' => '累计分红', 'field' => 'commission_total', 'width' => 12],
                ['title' => '打款分红', 'field' => 'commission_pay', 'width' => 12],
                ['title' => '注册时间', 'field' => 'createtime', 'width' => 12],
                ['title' => '成为队长时间', 'field' => 'createtime', 'width' => 12],
                ['title' => '审核状态', 'field' => 'statusstr', 'width' => 12]
            ];
            if (p('diyform')) {
                $columns[] = ['title' => '团队会员自定义信息', 'field' => 'member_diyformdata', 'width' => 36];
                $columns[] = ['title' => '团队申请自定义信息', 'field' => 'agent_diyformdata', 'width' => 36];
            }
            m('excel')->export($list, ['title' => '团队数据-' . date('Y-m-d-H-i', time()), 'columns' => $columns]);
        }
        $pager = pagination2($total, $pindex, $psize);
        load()->func('tpl');
        include($this->template());
    }

    public function delete()
    {
        global $_W;
        global $_GPC;
        $id = (int)$_GPC['id'];
        if (empty($id)) {
            $id = (is_array($_GPC['ids']) ? implode(',', $_GPC['ids']) : 0);
        }
        $members = pdo_fetchall('
            SELECT * FROM ' . Member::TABLE_NAME . '
            WHERE id in( ' . $id . ' ) AND uniacid=' . $_W['uniacid']);
        foreach ($members as $member) {
            pdo_update('ewei_shop_member', ['isheads' => 0, 'headsstatus' => 0], ['id' => $member['id']]);
            plog('dividend.agent.delete',
                sprintf('取消队长资格 <br/>队长信息:  ID: %s /  %s/%s/%s/%s',
                    $member['id'], $member['openid'], $member['nickname'], $member['realname'], $member['mobile']));
            $initData = pdo_fetch('
                select * from ' . DividendInit::TABLE_NAME . '
                where headsid = :headsid and uniacid = :uniacid',
                [':headsid' => $member['id'], ':uniacid' => $_W['uniacid']]);
            if (!empty($initData)) {
                pdo_update('ewei_shop_dividend_init', ['status' => 0], ['headsid' => $member['id']]);
                $dividend = pdo_fetch('
                    select id,isheads,headsid,headsstatus
                    from ' . Member::TABLE_NAME . '
                    where id = :id',
                    [':id' => $member['agentid']]);
                $dividend_init = pdo_fetch('
                    select * from ' . DividendInit::TABLE_NAME . '
                    where headsid = :headsid',
                    [":headsid" => $member["agentid"]]);
                if (!empty($dividend['isheads']) && !empty($dividend['headsstatus']) && !empty($dividend_init['status'])) {
                    pdo_update('ewei_shop_member', ['headsid' => $member['agentid']],
                        ['id' => $member['id'], 'uniacid' => $_W['uniacid']]);
                    $data = pdo_fetchall('
                        select id from ' . CommissionRelation::TABLE_NAME . '
                        where pid = :pid',
                        [':pid' => $member['id']]);
                    if (!empty($data)) {
                        $ids = [];
                        foreach ($data as $k => $v) {
                            $ids[] = $v['id'];
                        }
                        pdo_update('ewei_shop_member', ['headsid' => $member['agentid']], ['id' => $ids]);
                    }
                } elseif (empty($dividend['isheads']) && !empty($dividend['headsid'])) {
                    pdo_update('ewei_shop_member', ['headsid' => $dividend['headsid']],
                        ['id' => $member['id'], 'uniacid' => $_W['uniacid']]);
                    $data = pdo_fetchall('
                        select id from ' . CommissionRelation::TABLE_NAME . '
                        where pid = :pid',
                        [':pid' => $member['id']]);
                    if (!empty($data)) {
                        $ids = [];
                        foreach ($data as $k => $v) {
                            $ids[] = $v['id'];
                        }
                        pdo_update('ewei_shop_member', ['headsid' => $dividend['headsid']],
                            ['id' => $ids]);
                    }
                } else {
                    pdo_update('ewei_shop_member', ['headsid' => 0],
                        ['id' => $member['id'], 'uniacid' => $_W['uniacid']]);
                    $data = pdo_fetchall('
                        select id from ' . CommissionRelation::TABLE_NAME . '
                        where pid = :pid',
                        [':pid' => $member['id']]);
                    if (!empty($data)) {
                        $ids = [];
                        foreach ($data as $k => $v) {
                            $ids[] = $v['id'];
                        }
                        pdo_update('ewei_shop_member', ['headsid' => 0], ['id' => $ids]);
                    }
                }
            }
        }
        show_json(1, ['url' => referer()]);
    }

    public function user()
    {
        global $_W;
        global $_GPC;
        $headsid = (int)$_GPC['id'];
        $member = $this->model->getInfo($headsid);
        $condition = ' ';
        $params = [];
        $hasheads = true;
        if (!empty($_GPC['mid'])) {
            $condition .= ' and dm.id=:mid';
            $params[':mid'] = (int)$_GPC['mid'];
        }
        $searchfield = 'member';
        $keyword = trim($_GPC['keyword']);
        if (!empty($keyword) && $searchfield === 'member') {
            $condition .= ' and ( dm.realname like :keyword or dm.nickname like :keyword or dm.mobile like :keyword)';
            $params[':keyword'] = '%' . $keyword . '%';
        }
        if (empty($starttime) || empty($endtime)) {
            $starttime = strtotime('-1 month');
            $endtime = time();
        }
        if ($_GPC['followed'] != '') {
            if ($_GPC['followed'] == 2) {
                $condition .= ' and f.follow=0 and dm.uid<>0';
            } else {
                $condition .= ' and f.follow=' . (int)$_GPC['followed'];
            }
        }
        $pindex = max(1, (int)$_GPC['page']);
        $psize = 20;
        $list = [];
        if ($hasheads) {
            $total = pdo_fetchcolumn('
                select count(dm.id)
                from ' . Member::TABLE_NAME . ' dm
                    left join ' . McMappingFans::TABLE_NAME . ' f on f.openid=dm.openid' . '
                where dm.uniacid =' . $_W['uniacid'] . ' and dm.headsid = ' . $headsid . ' ' . $condition,
                $params);
            $sql = '
                select dm.*  from ' . Member::TABLE_NAME . ' dm
                    left join ' . McMappingFans::TABLE_NAME . ' f on f.openid=dm.openid and f.uniacid=' . $_W['uniacid'] . '
                where dm.uniacid = ' . $_W['uniacid'] . ' and dm.headsid = ' . $headsid . '  ' . $condition . '
                ORDER BY dm.createtime desc';
            if (empty($_GPC["export"])) {
                $sql .= ' limit ' . ($pindex - 1) * $psize . ',' . $psize;
            }
            $list = pdo_fetchall($sql, $params);
            $pager = pagination($total, $pindex, $psize);
            foreach ($list as &$row) {
                $info = $this->model->getInfo($row['openid'], ['total', 'pay']);
                $row['credit1'] = m('member')->getCredit($row['openid'], 'credit1');
                $row['credit2'] = m('member')->getCredit($row['openid'], 'credit2');
                $row['commission_total'] = $info['commission_total'];
                $row['commission_pay'] = $info['commission_pay'];
                $row['followed'] = m('user')->followed($row['openid']);
            }
        }
        unset($row);
        if ($_GPC['export'] == 1) {
            foreach ($list as &$row) {
                $row['realname'] = str_replace('=', '', $row['realname']);
                $row['nickname'] = str_replace('=', '', $row['nickname']);
                $row['createtime'] = date('Y-m-d H:i', $row['createtime']);
                $row['followstr'] = (empty($row['followed']) ? '' : '已关注');
                if (p('diyform') && !empty($row['diymemberfields']) && !empty($row['diymemberdata'])) {
                    $diyformdata_array = p('diyform')->getDatas(iunserializer($row['diymemberfields']),
                        iunserializer($row['diymemberdata']));
                    $diyformdata = '';
                    foreach ($diyformdata_array as $da) {
                        $diyformdata .= sprintf("%s: %s\r\n", $da['name'], $da['value']);
                    }
                    $row["member_diyformdata"] = $diyformdata;
                }
                if (p('diyform') && !empty($row['diycommissionfields']) && !empty($row['diycommissiondata'])) {
                    $diyformdata_array = p('diyform')->getDatas(iunserializer($row['diycommissionfields']),
                        iunserializer($row['diycommissiondata']));
                    $diyformdata = '';
                    foreach ($diyformdata_array as $da) {
                        $diyformdata .= sprintf("%s: %s\r\n", $da['name'], $da['value']);
                    }
                    $row['agent_diyformdata'] = $diyformdata;
                }
            }
            unset($row);
            $columns = [
                ['title' => 'ID', 'field' => 'id', 'width' => 12],
                ['title' => '昵称', 'field' => 'nickname', 'width' => 12],
                ['title' => '姓名', 'field' => 'realname', 'width' => 12],
                ['title' => '手机号', 'field' => 'mobile', 'width' => 12],
                ['title' => '微信号', 'field' => 'weixin', 'width' => 12],
                ['title' => 'openid', 'field' => 'openid', 'width' => 24],
                ['title' => '注册时间', 'field' => 'createtime', 'width' => 12],
                ['title' => '是否关注', 'field' => 'followstr', 'width' => 12]
            ];
            if (p('diyform')) {
                $columns[] = ['title' => '团队分红会员自定义信息', 'field' => 'member_diyformdata', 'width' => 36];
                $columns[] = ['title' => '团队分红申请自定义信息', "field" => 'agent_diyformdata', 'width' => 36];
            }
            m('excel')->export($list, array('title' => '团员信息-' . date('Y-m-d-H-i', time()), 'columns' => $columns));
        }
        load()->func('tpl');
        include($this->template('dividend/agent_user'));
    }

    public function query()
    {
        global $_W;
        global $_GPC;
        $kwd = trim($_GPC['keyword']);
        $wechatid = (int)$_GPC['wechatid'];
        if (empty($wechatid)) {
            $wechatid = $_W['uniacid'];
        }
        $params = [];
        $params[':uniacid'] = $wechatid;
        $condition = ' and uniacid=:uniacid and isagent=1 and status=1';
        if (!empty($kwd)) {
            $condition .= ' AND ( `nickname` LIKE :keyword or `realname` LIKE :keyword or `mobile` LIKE :keyword )';
            $params[':keyword'] = '%' . $kwd . '%';
        }
        if (!empty($_GPC['selfid'])) {
            $condition .= ' and id<>' . (int)$_GPC['selfid'];
        }
        $ds = pdo_fetchall('
            SELECT id,avatar,nickname,openid,realname,mobile
            FROM ' . Member::TABLE_NAME . '
            WHERE 1 ' . $condition . ' order by createtime desc',
            $params);
        foreach ($ds as $key => $val) {
            $ds[$key]['nickname'] = str_replace("'", '', $ds[$key]['nickname']);
        }
        include($this->template('commission/query'));
    }

    public function check()
    {
        global $_W;
        global $_GPC;
        $id = (int)$_GPC["id"];
        if (empty($id)) {
            $id = (is_array($_GPC['ids']) ? implode(',', $_GPC['ids']) : 0);
        }
        $status = (int)$_GPC['headsstatus'];
        $members = pdo_fetchall('
            SELECT id,openid,agentid,nickname,realname,mobile,status,headsstatus
            FROM ' . Member::TABLE_NAME . '
            WHERE id in( ' . $id . ' ) AND uniacid=' . $_W['uniacid']);
        $time = time();
        foreach ($members as $member) {
            if ($member['headsstatus'] === $status) {
                continue;
            }
            if ($status == 1) {
                $this->model->sendMessage($member['openid'],
                    array('nickname' => $member['nickname'], 'headstime' => $time), TM_DIVIDEND_DOWNLINE_BECOME);
                pdo_update('ewei_shop_member', array('headsstatus' => 1, 'headstime' => $time, 'headsid' => 0),
                    array('id' => $member['id'], 'uniacid' => $_W['uniacid']));
                $heads_data['uniacid'] = $_W['uniacid'];
                $heads_data['headsid'] = $member['id'];
                $heads_data['status'] = 0;
                $initData = pdo_fetch('
                    select * from ' . DividendInit::TABLE_NAME . '
                    where headsid = :headsid and uniacid = :uniacid',
                    [':headsid' => $member['id'], ':uniacid' => $_W['uniacid']]);
                if (empty($initData)) {
                    pdo_insert('ewei_shop_dividend_init', $heads_data);
                }
                plog('dividend.agent.check',
                    sprintf('审核队长 <br/>队长信息:  ID: %s /  %s/%s/%s/%s',
                        $member['id'], $member['openid'], $member['nickname'], $member['realname'], $member['mobile']));
                $this->model->sendMessage($member['openid'],
                    array('nickname' => $member['nickname'], 'headstime' => $time), TM_DIVIDEND_BECOME);
                $this->model->sendMessage($member['openid'],
                    array('nickname' => $member['nickname'], 'headstime' => $time), TM_DIVIDEND_BECOME_SALER);
            } else {
                pdo_update('ewei_shop_member', array('headsstatus' => 0, 'headstime' => 0),
                    array('id' => $member['id'], 'uniacid' => $_W['uniacid']));
                plog('commission.agent.check',
                    sprintf('取消审核 <br/>队长信息:  ID: %s /  %s/%s/%s/%s', $member['id'], $member['openid'],
                        $member['nickname'], $member['realname'], $member['mobile']));
            }
        }
        show_json(1, ['url' => referer()]);
    }

    public function agentblack()
    {
        global $_W;
        global $_GPC;
        $id = (int)$_GPC['id'];
        if (empty($id)) {
            $id = (is_array($_GPC['ids']) ? implode(',', $_GPC['ids']) : 0);
        }
        $agentblack = (int)$_GPC['agentblack'];
        $members = pdo_fetchall('
            SELECT id,openid,nickname,realname,mobile,agentblack
            FROM ' . Member::TABLE_NAME . '
            WHERE id in( ' . $id . ' ) AND uniacid=' . $_W['uniacid']);
        foreach ($members as $member) {
            if ($member['agentblack'] === $agentblack) {
                continue;
            }
            if ($agentblack == 1) {
                pdo_update('ewei_shop_member', ['agentblack' => 1], ['id' => $member['id']]);
                plog('commission.agent.agentblack',
                    sprintf('设置黑名单 <br/>分销商信息:  ID: %s /  %s/%s/%s/%s',
                        $member['id'], $member['openid'], $member['nickname'], $member['realname'], $member['mobile']));
            } else {
                pdo_update('ewei_shop_member', ['agentblack' => 0], ['id' => $member['id']]);
                plog('commission.agent.agentblack',
                    sprintf('取消黑名单 <br/>分销商信息:  ID: %s /  %s/%s/%s/%s',
                        $member['id'], $member['openid'], $member['nickname'], $member['realname'], $member['mobile']));
            }
        }
        show_json(1, ['url' => referer()]);
    }

    public function init()
    {
        global $_W;
        global $_GPC;
        $id = (is_array($_GPC['ids']) ? implode(',', $_GPC['ids']) : 0);
        $members = pdo_fetchall('
            select * from ' . Member::TABLE_NAME . '
            WHERE id in( ' . $id . ' ) AND uniacid=' . $_W['uniacid']);
        foreach ($members as $member) {
            if (empty($member['isheads']) || empty($member['headsstatus'])) {
                continue;
            }
            $data = pdo_fetchall('
                select  r.id,r.pid,m.isheads from ' . CommissionRelation::TABLE_NAME . ' r
                    left join ' . Member::TABLE_NAME . ' m on m.id = r.id
                where  r.pid=:pid and m.uniacid=:uniacid',
                [':pid' => $member['id'], ':uniacid' => $_W['uniacid']]);
            if (!empty($data)) {
                $heads = array();
                $later = array();
                $ids = array();
                foreach ($data as $k => $v) {
                    if (!empty($v['isheads'])) {
                        $heads[] = $v['id'];
                        continue;
                    }
                    $ids[] = $v['id'];
                }
                if (!empty($heads)) {
                    $later = pdo_fetchall('
                        select id from ' . CommissionRelation::TABLE_NAME . '
                        where pid in (' . implode(',', $heads) . ')');
                }
                if (!empty($ids)) {
                    if (!empty($later)) {
                        $later = array_column($later, 'id');
                        $ids = array_diff($ids, $later);
                    }
                    pdo_update('ewei_shop_member', ['headsid' => $member['id']], ['id' => $ids]);
                }
            }
            pdo_update('ewei_shop_dividend_init', ['status' => 1], ['headsid' => $member['id']]);
        }
        show_json(1);
    }
}
