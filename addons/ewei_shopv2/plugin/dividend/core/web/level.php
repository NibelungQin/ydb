<?php

use Ydb\Entity\Manual\CommissionLevel;

if (!defined('IN_IA')) {
    exit('Access Denied');
}

require(EWEI_SHOPV2_PLUGIN . 'dividend/core/dividend_page_web.php');

class Dividend_Level_EweiShopV2PluginMobilePage extends DividendWebPage
{
    public function main()
    {
        global $_W;
        global $_GPC;
        global $_S;
        $set = $_S['commission'];
        $leveltype = $set['leveltype'];
        $default = [
            'id' => 'default',
            'levelname' => (empty($set['levelname']) ? '默认等级' : $set['levelname']),
            'commission1' => $set['commission1'],
            'commission2' => $set['commission2'],
            'commission3' => $set['commission3']
        ];
        $others = pdo_fetchall('
            SELECT * FROM ' . CommissionLevel::TABLE_NAME . "
            WHERE uniacid = '" . $_W['uniacid'] . "'
            ORDER BY commission1 asc");
        $list = array_merge([$default], $others);
        include($this->template());
    }

    public function add()
    {
        $this->post();
    }

    public function edit()
    {
        $this->post();
    }

    protected function post()
    {
        global $_W;
        global $_GPC;
        global $_S;
        $set = $_S['commission'];
        $leveltype = $set['leveltype'];
        $id = trim($_GPC['id']);
        if ($id === 'default') {
            $level = [
                'id' => 'default',
                'levelname' => (empty($set['levelname']) ? '默认等级' : $set['levelname']),
                'commission1' => $set['commission1'],
                'commission2' => $set['commission2'],
                'commission3' => $set['commission3']
            ];
        } else {
            $level = pdo_fetch('
                SELECT * FROM ' . CommissionLevel::TABLE_NAME . '
                WHERE id=:id and uniacid=:uniacid limit 1',
                array(':id' => (int)$id, ':uniacid' => $_W['uniacid']));
        }
        if ($_W['ispost']) {
            $data = [
                'uniacid' => $_W['uniacid'],
                'levelname' => trim($_GPC['levelname']),
                'commission1' => trim(trim($_GPC['commission1']), '%'),
                'commission2' => trim(trim($_GPC['commission2']), '%'),
                'commission3' => trim(trim($_GPC['commission3']), '%'),
                'commissionmoney' => trim($_GPC['commissionmoney'], '%'),
                'ordermoney' => $_GPC['ordermoney'],
                'ordercount' => (int)$_GPC['ordercount'],
                'downcount' => (int)$_GPC['downcount']
            ];
            if (!empty($id)) {
                if ($id === "default") {
                    $updatecontent = sprintf(
                        '<br/>等级名称: %s->%s<br/>一级佣金比例: %s->%s<br/>二级佣金比例: %s->%s<br/>三级佣金比例: %s->%s',
                        $set['levelname'], $data['levelname'], $set['commission1'], $data['commission1'],
                        $set['commission2'], $data['commission2'], $set['commission3'], $data['commission3']);
                    $set['levelname'] = $data['levelname'];
                    $set['commission1'] = $data['commission1'];
                    $set['commission2'] = $data['commission2'];
                    $set['commission3'] = $data['commission3'];
                    $this->updateSet($set);
                    plog('commission.level.edit', '修改分销商默认等级' . $updatecontent);
                } else {
                    $updatecontent = sprintf(
                        '<br/>等级名称: %s->%s<br/>一级佣金比例: %s->%s<br/>二级佣金比例: %s->%s<br/>三级佣金比例: %s->%s',
                        $level['levelname'], $data['levelname'], $level['commission1'], $data['commission1'],
                        $level['commission2'], $data['commission2'], $level['commission3'], $data['commission3']);
                    pdo_update('ewei_shop_commission_level', $data, ['id' => $id, 'uniacid' => $_W['uniacid']]);
                    plog('commission.level.edit', '修改分销商等级 ID: ' . $id . $updatecontent);
                }
            } else {
                pdo_insert('ewei_shop_commission_level', $data);
                $id = pdo_insertid();
                plog('commission.level.add', '添加分销商等级 ID: ' . $id);
            }
            show_json(1, ['url' => webUrl('commission/level')]);
        }
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
        $items = pdo_fetchall('
            SELECT id,levelname FROM ' . CommissionLevel::TABLE_NAME . '
            WHERE id in( ' . $id . ' ) AND uniacid=' . $_W['uniacid']);
        foreach ($items as $item) {
            pdo_delete('ewei_shop_commission_level', ['id' => $item['id']]);
            plog('commission.level.delete', '删除分销商等级 ID: ' . $id . ' 等级名称: ' . $level['levelname']);
        }
        show_json(1);
    }
}