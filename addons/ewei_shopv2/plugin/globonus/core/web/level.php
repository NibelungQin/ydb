<?php

if (!defined('IN_IA')) {
    exit('Access Denied');
}

class Level_EweiShopV2Page extends PluginWebPage {

    public function main() {
        global $_W;
        global $_GPC;
        $set = $_W['shopset']['globonus'];
        $leveltype = json_decode($set['leveltype'], true);

        $default = array('id' => 'default', 'levelname' => empty($set['levelname']) ? '默认等级' : $set['levelname'], 'bonus' => $set['bonus'], 'achievement_weight' => $set['achievement_weight']);
        $others = pdo_fetchall('SELECT * FROM ' . tablename('ewei_shop_globonus_level') . ' WHERE uniacid = \'' . $_W['uniacid'] . '\' ORDER BY bonus asc');
        $list = array_merge(array($default), $others);
        include $this->template();
    }

    public function add() {
        $this->post();
    }

    public function edit() {
        $this->post();
    }

    protected function post() {
        global $_W;
        global $_GPC;
        $set = $_W['shopset']['globonus'];
        $leveltype = json_decode($set['leveltype'], true);
        $id = trim($_GPC['id']);

        if ($id == 'default') {
            $level = array('id' => 'default', 'levelname' => empty($set['levelname']) ? '默认等级' : $set['levelname'], 'bonus' => $set['bonus'], 'achievement_weight' => $set['achievement_weight']);
        } else {
            $level = pdo_fetch('SELECT * FROM ' . tablename('ewei_shop_globonus_level') . ' WHERE id=:id and uniacid=:uniacid limit 1', array(':id' => intval($id), ':uniacid' => $_W['uniacid']));
        }

//        //查询分销商身份
//        $distribution_identity = pdo_fetchall('select id as identity_id,levelname from '. tablename('ewei_shop_commission_level') .' where uniacid=:uniacid',array(':uniacid'=>$_W['uniacid']));
        //查询店铺等级身份
        $shop_identity = pdo_fetchall('select id as identity_id,levelname from '. tablename('ewei_shop_globonus_level') .' where uniacid=:uniacid',array(':uniacid'=>$_W['uniacid']));
        $identity_data = array(array('identity_id'=>0,'levelname'=>'店铺默认等级','identity_type'=>2));
//        foreach ($distribution_identity as $v){
//            $v['identity_type'] = 1;
//            $identity_data[] = $v;
//        }
        foreach ($shop_identity as $v){
            $v['identity_type'] = 2;
            $identity_data[] = $v;
        }
        
        if ($_W['ispost']) {
            $data = array(
                'uniacid' => $_W['uniacid'],
                'levelname' => trim($_GPC['levelname']),
                'bonus' => trim(trim($_GPC['bonus']), '%'),
                'commissionmoney' => trim($_GPC['commissionmoney'], '%'),
                'ordermoney' => $_GPC['ordermoney'],
                'ordercount' => intval($_GPC['ordercount']),
                'downcount' => intval($_GPC['downcount']),
                'bonusmoney' => trim($_GPC['bonusmoney'], '%'),
                'first_ordermoney' => $_GPC['first_ordermoney'],
                'zg_ordermoney' => $_GPC['zg_ordermoney'],
                'first_ordercount' => intval($_GPC['first_ordercount']),
                'zg_ordercount' => intval($_GPC['zg_ordercount']),
                'first_downcount' => intval($_GPC['first_downcount']),
                'c_downcount' => intval($_GPC['c_downcount']),
                'first_c_downcount' => intval($_GPC['first_c_downcount']),
                'achievement_weight' => intval($_GPC['achievement_weight']),
            );
            if(!empty($data['c_downcount']) && !empty($_GPC['team_identity_id'])){
                $data['team_identity_type'] = substr($_GPC['team_identity_id'],0,1);
                $data['team_identity_id'] = substr($_GPC['team_identity_id'],1);
                $data['hierarchy'] = $_GPC['hierarchy'];
            }else{
                $data['team_identity_type'] = 0;
                $data['team_identity_id'] = 0;
                $data['hierarchy'] = 0;
            }
            
            if(!empty($data['first_c_downcount']) && !empty($_GPC['first_team_identity_id'])){
                $data['first_identity_type'] = substr($_GPC['first_team_identity_id'],0,1);
                $data['first_team_identity_id'] = substr($_GPC['first_team_identity_id'],1);
            }else{
                $data['first_identity_type'] = 0;
                $data['first_team_identity_id'] = 0;
            }
            
            if (!empty($id)) {
                if ($id == 'default') {
                    $updatecontent = '<br/>等级名称: ' . $set['levelname'] . '->' . $data['levelname'] . '<br/>分红比例: ' . $set['bonus'] . '->' . $data['bonus'];
                    $set['levelname'] = $data['levelname'];
                    $set['bonus'] = $data['bonus'];
                    $set['achievement_weight'] = $data['achievement_weight'];
                    $this->updateSet($set);
                    plog('globonus.level.edit', '修改店铺默认等级' . $updatecontent);
                } else {
                    $updatecontent = '<br/>等级名称: ' . $level['levelname'] . '->' . $data['levelname'] . '<br/>分红比例: ' . $level['bonus'] . '->' . $data['bonus'];
                    pdo_update('ewei_shop_globonus_level', $data, array('id' => $id, 'uniacid' => $_W['uniacid']));
                    plog('globonus.level.edit', '修改店铺等级 ID: ' . $id . $updatecontent);
                }
            } else {
                pdo_insert('ewei_shop_globonus_level', $data);
                $id = pdo_insertid();
                plog('globonus.level.add', '添加店铺等级 ID: ' . $id);
            }

            show_json(1, array('url' => webUrl('globonus/level')));
        }

        include $this->template();
    }

    public function delete() {
        global $_W;
        global $_GPC;
        $id = intval($_GPC['id']);

        if (empty($id)) {
            $id = (is_array($_GPC['ids']) ? implode(',', $_GPC['ids']) : 0);
        }

        $items = pdo_fetchall('SELECT id,levelname FROM ' . tablename('ewei_shop_globonus_level') . ' WHERE id in( ' . $id . ' ) AND uniacid=' . $_W['uniacid']);

        foreach ($items as $item) {
            pdo_delete('ewei_shop_globonus_level', array('id' => $item['id']));
            plog('globonus.level.delete', '删除店铺等级 ID: ' . $id . ' 等级名称: ' . $item['levelname']);
        }

        show_json(1);
    }

}

?>
