<?php

use Ydb\Entity\Manual\Member;
use Ydb\Entity\Manual\MemberMessageTemplate;
use Ydb\Entity\Manual\MemberMessageTemplateType;
use Ydb\Util\YdbHttpUtil;

if (!defined('IN_IA')) {
    exit('Access Denied');
}

require_once EWEI_SHOPV2_PLUGIN . 'dividend/core/dividend_page_web.php';

class Dividend_Index_EweiShopV2PluginWebPage extends DividendWebPage
{
    protected $statusCacheKey = 'initDividendMemberCount';

    public function main()
    {
        global $_W;
        if (cv('dividend.agent')) {
            YdbHttpUtil::header('location: ' . webUrl('dividend/agent'));
            return;
        }
        if (cv('dividend.apply.view1')) {
            header('location: ' . webUrl('dividend/apply', ['status' => 1]));
            exit();
        }
        if (cv('dividend.apply.view2')) {
            header('location: ' . webUrl('dividend/apply', ['status' => 2]));
            exit();
        }
        if (cv('dividend.apply.view3')) {
            header('location: ' . webUrl('dividend/apply', ['status' => 3]));
            exit();
        }
        if (cv('dividend.apply.view_1')) {
            header('location: ' . webUrl('dividend/apply', ['status' => -1]));
            exit();
        }
        if (cv('dividend.increase')) {
            header('location: ' . webUrl('dividend/increase'));
            exit();
        }
        if (cv('dividend.notice')) {
            header('location: ' . webUrl('dividend/notice'));
            exit();
        }
        if (cv('dividend.cover')) {
            header('location: ' . webUrl('dividend/cover'));
            exit();
        }
        if (cv('dividend.set')) {
            header('location: ' . webUrl('dividend/set'));
            exit();
        }
    }

    public function init()
    {
        global $_W;
        global $_GPC;
        $pindex = max(1, (int)$_GPC['page']);
        $psize = 1000;
        $open_redis = function_exists('redis') && !is_error(redis());
        $redisStatus = 'N';
        if ($open_redis) {
            $redis = redis();
            $redisStatus = 'Y';
        }
        $count = pdo_fetchcolumn('
            SELECT count(*)
            FROM ' . Member::TABLE_NAME . '
            WHERE uniacid=:uniacid AND agentid>0',
            [':uniacid' => $_W['uniacid']]
        );
        if ($psize < $count) {
            $page_count = ceil($count / $psize);
        } else {
            $page_count = 1;
        }
        if ($_W['isajax']) {
            $redis->set($this->getStatusCacheKey(), 202);
            $list = pdo_fetchall('
                SELECT id,agentid FROM ' . Member::TABLE_NAME . '
                WHERE uniacid=:uniacid AND agentid>0
                ORDER BY id ASC
                limit ' . ($pindex - 1) * $psize . ',' . $psize,
                [':uniacid' => $_W['uniacid']]
            );
            if (!empty($list)) {
                foreach ($list as $member) {
                    if ($member['id'] != $member['agentid']) {
                        $mem = p('commission')->saveRelation($member['id'], $member['agentid']);
                        if (is_array($mem)) {
                            $errData = array(
                                'errno' => -1,
                                'errmsg' => "初始化错误！" . "<br/>请修改<a style='color: #259fdc;' target='_blank' href='"
                                    . webUrl('member/list/detail', array('id' => $mem['id']))
                                    . "'>会员(" . $mem['nickname'] . ')</a>的上级分销商!'
                            );
                            $redis->set($this->getStatusCacheKey(), json_encode($errData, JSON_UNESCAPED_UNICODE));
                            exit();
                        }
                    }
                }
            }
            if ($pindex == $page_count) {
                $data = m('common')->getPluginset('dividend');
                $data['init'] = 1;
                m('common')->updatePluginset(['dividend' => $data]);
            }
            $redis->set($this->getStatusCacheKey(), 200);
        }
        include($this->template());
    }

    private function getStatusCacheKey()
    {
        global $_GPC;
        return $this->statusCacheKey . $_GPC['page'];
    }

    public function getHandleStatus()
    {
        global $_W;
        global $_GPC;
        $open_redis = function_exists('redis') && !is_error(redis());
        $redis = redis();
        $status = $redis->get($this->getStatusCacheKey());
        if (!is_numeric($status)) {
            $ret = json_decode($status, true);
            show_json($ret['errno'], $ret['errmsg']);
        }
        preg_match("#\\d+#", $this->getStatusCacheKey(), $pindex);
        show_json($status, ['pindex' => implode($pindex), 'cacheKey' => $this->getStatusCacheKey()]);
    }

    public function notice()
    {
        global $_W;
        global $_GPC;
        $data = m('common')->getPluginset('dividend', false);
        $data = $data['tm'];
        $salers1 = [];
        if (isset($data['openid1']) && !empty($data['openid1'])) {
            $openids1 = [];
            $strsopenids = explode(',', $data['openid1']);
            foreach ($strsopenids as $openid) {
                $openids1[] = "'" . $openid . "'";
            }
            $salers1 = @pdo_fetchall('
                select id,nickname,avatar,openid
                from ' . Member::TABLE_NAME . '
                where openid in (' . @implode(',', $openids1) . ') and uniacid=' . $_W['uniacid']);
        }
        $salers2 = [];
        if (isset($data['openid2']) && !empty($data['openid2'])) {
            $openids2 = [];
            $strsopenids2 = explode(',', $data['openid2']);
            foreach ($strsopenids2 as $openid2) {
                $openids2[] = "'" . $openid2 . "'";
            }
            $salers2 = @pdo_fetchall('
                select id,nickname,avatar,openid
                from ' . Member::TABLE_NAME . '
                where openid in (' . @implode(',', $openids2) . ') and uniacid=' . $_W['uniacid']);
        }
        if ($_W['ispost']) {
            $data = (is_array($_GPC['data']) ? $_GPC['data'] : []);
            if (is_array($_GPC['openids1'])) {
                $data['openid1'] = implode(',', $_GPC['openids1']);
            } else {
                $data['openid1'] = '';
            }
            $data['openid'] = $data['openid1'];
            m('common')->updatePluginset(['dividend' => ['tm' => $data]]);
            plog('dividend.notice.edit', '修改通知设置');
            show_json(1);
        }
        $data = m('common')->getPluginset('dividend');
        $template_lists = pdo_fetchall('
            SELECT id,title,typecode
            FROM ' . MemberMessageTemplate::TABLE_NAME . '
            WHERE uniacid=:uniacid ',
            [':uniacid' => $_W['uniacid']]
        );
        $templatetype_list = pdo_fetchall('
            SELECT * FROM  ' . MemberMessageTemplateType::TABLE_NAME);
        $template_group = [];
        foreach ($templatetype_list as $type) {
            $templates = [];
            foreach ($template_lists as $template) {
                if ($template['typecode'] == $type['typecode']) {
                    $templates[] = $template;
                }
            }
            $template_group[$type['typecode']] = $templates;
        }
        $template_list = $template_group;
        include($this->template());
    }

    public function set()
    {
        global $_W;
        global $_GPC;
        if ($_W['ispost']) {
            $data = (is_array($_GPC['data']) ? $_GPC['data'] : []);
            $data['open'] = (int)$data['open'];
            $data['ratio'] = round((float)trim($data['ratio'], '%'), 2);
            $data['cashcredit'] = (int)$data['cashcredit'];
            $data['cashweixin'] = (int)$data['cashweixin'];
            $data['cashother'] = (int)$data['cashother'];
            $data['cashalipay'] = (int)$data['cashalipay'];
            $data['cashcard'] = (int)$data['cashcard'];
            $data['texts'] = (is_array($_GPC['texts']) ? $_GPC['texts'] : []);
            if (empty($data['ratio'])) {
                $data['ratio'] = '0';
            }
            if ($data['withdraw'] < 1 || empty($data['withdraw'])) {
                show_json(0, '请填写大于1的数字');
            }
            if ($data['ratio'] < 0 || 100 < $data['ratio']) {
                show_json(0, '请填写0-100之间的数值,只保留两位小数');
            }
            $data['condition'] = (int)$data['condition'];
            switch ($data['condition']) {
                case 0:
                    $data['check'] = (int)$data['check'];
                    break;
                case 1:
                    $data['downline'] = (int)$data['downline'];
                    if (empty($data['downline'])) {
                        show_json(0, '请填写下线人数');
                    }
                    $become = '下线人数达到' . $data['downline'];
                    break;
                case 2:
                    $data['commissiondownline'] = (int)$data['commissiondownline'];
                    if (empty($data['commissiondownline'])) {
                        show_json(0, '请填写下线分销商数');
                    }
                    $become = '下线分销商数达到' . $data['commissiondownline'];
                    break;
                case 3:
                    $data['total_commission'] = (float)$data['total_commission'];
                    if (empty($data['total_commission'])) {
                        show_json(0, '请填写佣金总额');
                    }
                    $become = '分销佣金总额达到' . $data['total_commission'];
                    break;
                case 4:
                    $data['cash_commission'] = (float)$data['cash_commission'];
                    if (empty($data['cash_commission'])) {
                        show_json(0, '请填写提现佣金总额');
                    }
                    $become = '提现佣金总额达到' . $data['cash_commission'];
                    break;
            }
            if (!empty($data['withdrawcharge'])) {
                $data['withdrawcharge'] = trim($data['withdrawcharge']);
                $data['withdrawcharge'] = (float)trim($data['withdrawcharge'], '%');
            }
            $data['withdrawbegin'] = (float)trim($data['withdrawbegin']);
            $data['withdrawend'] = (float)trim($data['withdrawend']);
            $data['open_protocol'] = (float)trim($data['open_protocols']);
            $data['applycontent'] = m('common')->html_images($data['applycontent']);
            $data['register_bottom_content'] = m('common')->html_images($data['register_bottom_content']);
            m('common')->updatePluginset(['dividend' => $data]);
            m('cache')->set('template_' . $this->pluginname, $data['style']);
            plog('dividend.set.edit', '修改基本设置<br>成为队长条件 -- ' . $become);
            show_json(
                1,
                ['url' => webUrl('dividend/set', ['tab' => str_replace('#tab_', '', $_GPC['tab'])])]
            );
        }
        $data = m('common')->getPluginset('dividend');
        $data['open_protocols'] = $data['open_protocol'];
        include($this->template());
    }

    public function refresh()
    {
        $data = m('common')->getPluginset('dividend');
        $data['init'] = 0;
        m('common')->updatePluginset(['dividend' => $data]);
        pdo_delete('ewei_shop_commission_relation');
        header('location: ' . webUrl('dividend/index'));
    }
}