<?php

if (!defined('IN_IA')) {
    exit('Access Denied');
}

class Sysset_Expresscompany_EweiShopV2WebPage extends WebPage {

    public function main() {
        global $_W;
        global $_GPC;
        $pindex = max(1, intval($_GPC['page']));
        $psize = 20;
        $list = pdo_fetchall('SELECT * FROM ' . tablename('ewei_shop_express'). '  ORDER BY id asc limit '. ($pindex - 1) * $psize . ',' . $psize, array());
        $total = pdo_fetchcolumn('SELECT count(*) FROM ' . tablename('ewei_shop_express'), array());
        $pager = pagination2($total, $pindex, $psize);
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
        $id = intval($_GPC['id']);

        if (!empty($id)) {
            $info = pdo_fetch('SELECT * FROM ' . tablename('ewei_shop_express') . ' WHERE id=:id limit 1', array(':id' => $id));
        }
        if ($_W['ispost']) {
            $data = array('name'=>trim($_GPC['name']),'express' => trim($_GPC['express']), 'kuaidiniao' => trim($_GPC['kuaidiniao']));
            if (empty($id)) {
                pdo_insert('ewei_shop_express', $data);
                $id = pdo_insertid();
            } else {
                pdo_update('ewei_shop_express', $data, array('id' => $id));
            }
            show_json(1, array('url' => webUrl('sysset/expresscompany')));
            return;
        }
        include $this->template();
    }

    
    
    
    public function delete() {
        global $_W;
        global $_GPC;
        $id = intval($_GPC['id']);
        if(!empty($id)){
            pdo_delete('ewei_shop_express', array('id' => $id));
        }
        show_json(1, array('url' => referer()));
    }

}

?>
