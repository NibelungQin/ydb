<?php


use Ydb\Entity\Manual\Engine\CoverReply;
use Ydb\Entity\Manual\Engine\Rule;
use Ydb\Entity\Manual\Engine\RuleKeyword;

if (!defined('IN_IA')) {
    exit('Access Denied');
}

require_once EWEI_SHOPV2_PLUGIN . 'dividend/core/dividend_page_web.php';

class Dividend_Cover_EweiShopV2PluginWebPage extends DividendWebPage
{
    public function main()
    {
        global $_W;
        global $_GPC;
        $rule = pdo_fetch('
            select * from ' . Rule::TABLE_NAME . '
            where uniacid=:uniacid and module=:module and name=:name limit 1',
            [':uniacid' => $_W['uniacid'], ':module' => 'cover', ':name' => 'ewei_shopv2团队分红入口设置']);
        if (!empty($rule)) {
            $keyword = pdo_fetch('
                select * from ' . RuleKeyword::TABLE_NAME . '
                where uniacid=:uniacid and rid=:rid limit 1',
                [':uniacid' => $_W['uniacid'], ':rid' => $rule['id']]);
            $cover = pdo_fetch('
                select * from ' . CoverReply::TABLE_NAME . '
                where uniacid=:uniacid and rid=:rid limit 1',
                [':uniacid' => $_W['uniacid'], ':rid' => $rule['id']]);
        }
        $url = mobileUrl('dividend', null, true);
        $qrcode = m('qrcode')->createQrcode($url);
        if ($_W['ispost']) {
            ca('dividend.cover.edit');
            $data = (is_array($_GPC['cover']) ? $_GPC['cover'] : []);
            if (empty($data['keyword'])) {
                show_json(0, '请输入关键词!');
            }
            $keyword = m('common')->keyExist($data['keyword']);
            if (!empty($keyword) && $keyword['name'] !== 'ewei_shopv2团队分红入口设置') {
                show_json(0, '关键字已存在!');
            }
            if (!empty($rule)) {
                pdo_delete('rule', ['id' => $rule['id'], 'uniacid' => $_W['uniacid']]);
                pdo_delete('rule_keyword', ['rid' => $rule['id'], 'uniacid' => $_W['uniacid']]);
                pdo_delete('cover_reply', ['rid' => $rule['id'], 'uniacid' => $_W['uniacid']]);
            }
            $rule_data = [
                'uniacid' => $_W['uniacid'],
                'name' => 'ewei_shopv2团队分红入口设置',
                'module' => 'cover',
                'displayorder' => 0,
                'status' => (int)$data['status']
            ];
            pdo_insert('rule', $rule_data);
            $rid = pdo_insertid();
            $keyword_data = [
                'uniacid' => $_W['uniacid'],
                'rid' => $rid,
                'module' => 'cover',
                'content' => trim($data['keyword']),
                'type' => 1,
                'displayorder' => 0,
                'status' => (int)$data['status']
            ];
            pdo_insert('rule_keyword', $keyword_data);
            $cover_data = [
                'uniacid' => $_W['uniacid'],
                'rid' => $rid,
                'module' => $this->modulename,
                'title' => trim($data['title']),
                'description' => trim($data['desc']),
                'thumb' => save_media($data['thumb']),
                'url' => mobileUrl('dividend')
            ];
            pdo_insert('cover_reply', $cover_data);
            plog('dividend.cover.edit', '修改团队分红入口设置');
            show_json(1);
        }
        include($this->template());
    }
}